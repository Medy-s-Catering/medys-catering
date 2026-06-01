<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') exit;

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);
    echo json_encode(['message' => 'Method not allowed']);
    exit;
}

require __DIR__ . '/../config/db.php';


$input = json_decode(file_get_contents('php://input'), true) ?? [];

foreach (['client_name', 'email', 'phone', 'event_type', 'event_date', 'event_time', 'guest_count', 'package', 'venue'] as $f) {
    if (empty($input[$f])) {
        http_response_code(422);
        echo json_encode(['message' => "Field '$f' is required."]);
        exit;
    }
}

$event_date  = $input['event_date'];
$guest_count = (int) $input['guest_count'];
$package     = $input['package'];

if ($event_date < date('Y-m-d')) {
    http_response_code(422);
    echo json_encode(['message' => 'Event date cannot be in the past.']);
    exit;
}

if ($package === 'Food Only' || $package === 'Party Tray') {
    $min_days = 2;
    $min_msg  = 'Food-only and party tray orders must be booked at least 2 days before the event.';
} elseif ($guest_count >= 150) {
    $min_days = 7;
    $min_msg  = 'Events with 150 or more guests must be booked at least 1 week (7 days) before the event.';
} else {
    $min_days = 3;
    $min_msg  = 'Bookings must be made at least 3 days before the event date.';
}

if ($event_date < date('Y-m-d', strtotime("+{$min_days} days"))) {
    http_response_code(422);
    echo json_encode(['message' => $min_msg]);
    exit;
}

$dateCheck = $pdo->prepare("SELECT COUNT(*) FROM bookings WHERE event_date = ? AND status != 'cancelled'");
$dateCheck->execute([$event_date]);
if ((int) $dateCheck->fetchColumn() >= 2) {
    http_response_code(422);
    echo json_encode(['message' => 'Sorry, we are fully booked on that date. Please choose a different date.']);
    exit;
}

do {
    $client_id = 'MC-' . date('Ymd') . '-' . strtoupper(substr(bin2hex(random_bytes(2)), 0, 4));
    $dup = $pdo->prepare("SELECT id FROM bookings WHERE client_id = ?");
    $dup->execute([$client_id]);
} while ($dup->rowCount() > 0);

$stmt = $pdo->prepare("INSERT INTO bookings
    (client_id, client_name, email, phone, alt_phone, event_type, event_date, event_time,
     guest_count, package, venue, duration, decoration, theme, special_requests, referral, status)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'pending')");

$stmt->execute([
    $client_id,
    trim($input['client_name']),
    trim($input['email']),
    trim($input['phone']),
    trim($input['alt_phone']   ?? ''),
    $input['event_type'],
    $input['event_date'],
    $input['event_time'],
    (int) $input['guest_count'],
    $input['package'],
    trim($input['venue']),
    $input['duration']         ?? null,
    $input['decoration']       ?? 'no',
    $input['theme']            ?? null,
    (function() use ($input) {
        $food    = trim($input['food_selections'] ?? '');
        $pax     = trim($input['tray_pax'] ?? '');
        $addons  = trim($input['add_ons'] ?? '');
        $special = trim($input['special_requests'] ?? '');
        $parts   = [];
        if ($food !== '') {
            $pkg = $input['package'] ?? '';
            $parts[] = ($pkg === 'Party Tray' && $pax !== '')
                ? "Party Tray ({$pax} Pax): {$food}"
                : "Food Order: {$food}";
        }
        if ($addons !== '') $parts[] = "Add-Ons: {$addons}";
        if ($special !== '') $parts[] = $special;
        return implode("\n", $parts) ?: null;
    })(),
    $input['referral']         ?? null,
]);

$scheme      = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$receipt_url = $scheme . '://' . $_SERVER['HTTP_HOST'] . '/medysBook/booking-receipt.php?id=' . urlencode($client_id);

$booking_row = $pdo->prepare("SELECT * FROM bookings WHERE client_id = ?");
$booking_row->execute([$client_id]);
$booking_data = $booking_row->fetch(PDO::FETCH_ASSOC);

if ($booking_data) {
    require_once __DIR__ . '/../lib/send_receipt_email.php';
    send_receipt_email($booking_data, $receipt_url);
}

http_response_code(201);
echo json_encode([
    'message'     => 'Booking submitted successfully.',
    'client_id'   => $client_id,
    'receipt_url' => $receipt_url,
]);
