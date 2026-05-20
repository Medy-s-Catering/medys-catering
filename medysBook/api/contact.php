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

foreach (['name', 'email', 'subject', 'message'] as $f) {
    if (empty(trim($input[$f] ?? ''))) {
        http_response_code(422);
        echo json_encode(['message' => "Field '$f' is required."]);
        exit;
    }
}

$stmt = $pdo->prepare("INSERT INTO contact_messages (full_name, email, phone, subject, message) VALUES (?,?,?,?,?)");
$stmt->execute([
    trim($input['name']),
    trim($input['email']),
    trim($input['phone']   ?? ''),
    trim($input['subject']),
    trim($input['message']),
]);

http_response_code(200);
echo json_encode(['message' => 'Message sent successfully.']);
