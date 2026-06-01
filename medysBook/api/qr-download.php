<?php
require __DIR__ . '/../config/db.php';

$client_id = trim($_GET['id'] ?? '');

if ($client_id === '') {
    http_response_code(400);
    exit('Missing booking ID.');
}

$stmt = $pdo->prepare("SELECT client_id FROM bookings WHERE client_id = ?");
$stmt->execute([$client_id]);
if (!$stmt->fetch()) {
    http_response_code(404);
    exit('Booking not found.');
}

$scheme      = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$receipt_url = $scheme . '://' . $_SERVER['HTTP_HOST'] . '/medysBook/booking-receipt.php?id=' . urlencode($client_id);
$qr_api_url  = 'https://api.qrserver.com/v1/create-qr-code/?size=400x400&format=png&data=' . urlencode($receipt_url);

$img = @file_get_contents($qr_api_url);
if ($img === false) {
    http_response_code(502);
    exit('Could not generate QR code. Please try again.');
}

$safe_id = preg_replace('/[^A-Z0-9\-]/', '', strtoupper($client_id));

header('Content-Type: image/png');
header('Content-Disposition: attachment; filename="medys-booking-' . $safe_id . '.png"');
header('Content-Length: ' . strlen($img));
header('Cache-Control: no-store');
echo $img;
