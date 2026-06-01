<?php
$client_id   = $argv[1] ?? '';
$receipt_url = $argv[2] ?? '';
if ($client_id === '' || $receipt_url === '') exit(1);

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../config/db.php';
require __DIR__ . '/send_receipt_email.php';

$stmt = $pdo->prepare("SELECT * FROM bookings WHERE client_id = ?");
$stmt->execute([$client_id]);
$booking = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$booking) exit(1);

send_receipt_email($booking, $receipt_url);
