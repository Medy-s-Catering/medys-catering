<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') exit;

require __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $rows  = $pdo->query("SELECT client_name, event_type, star_rating, comments FROM feedback ORDER BY created_at DESC LIMIT 30")->fetchAll();
    $total = (int) $pdo->query("SELECT COUNT(*) FROM feedback")->fetchColumn();
    $avg   = $total > 0 ? round((float) $pdo->query("SELECT AVG(star_rating) FROM feedback")->fetchColumn(), 1) : null;

    echo json_encode(['items' => $rows, 'avg_rating' => $avg, 'total_count' => $total]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];

    foreach (['client_name', 'star_rating', 'comments'] as $f) {
        if (empty(trim((string)($input[$f] ?? '')))) {
            http_response_code(422);
            echo json_encode(['message' => "Field '$f' is required."]);
            exit;
        }
    }

    $rating = (int) $input['star_rating'];
    if ($rating < 1 || $rating > 5) {
        http_response_code(422);
        echo json_encode(['message' => 'star_rating must be 1–5.']);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO feedback
        (client_name, email, event_type, has_booked, star_rating, comments, liked_tags, date_submitted, status)
        VALUES (?,?,?,?,?,?,?,?,'new')");
    $stmt->execute([
        trim($input['client_name']),
        trim($input['email']     ?? ''),
        $input['event_type']     ?? null,
        $input['has_booked']     ?? 'yes',
        $rating,
        trim($input['comments']),
        $input['liked_tags']     ?? null,
        $input['date_submitted'] ?? date('Y-m-d'),
    ]);

    http_response_code(201);
    echo json_encode(['message' => 'Feedback submitted. Thank you!']);
    exit;
}

http_response_code(405);
echo json_encode(['message' => 'Method not allowed']);
