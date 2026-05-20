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
    $input['special_requests'] ?? null,
    $input['referral']         ?? null,
]);

http_response_code(201);
echo json_encode(['message' => 'Booking submitted successfully.', 'client_id' => $client_id]);
