<?php
// PostgreSQL connection. Reads from DATABASE_URL (Render) or individual env vars.

$dsn = null;
$user = null;
$pass = null;

if (!empty($_ENV['DATABASE_URL']) || !empty(getenv('DATABASE_URL'))) {
    $url = $_ENV['DATABASE_URL'] ?? getenv('DATABASE_URL');
    $p = parse_url($url);
    $host = $p['host'] ?? 'localhost';
    $port = $p['port'] ?? 5432;
    $db   = ltrim($p['path'] ?? '', '/');
    $user = $p['user'] ?? null;
    $pass = isset($p['pass']) ? urldecode($p['pass']) : null;
    $sslmode = (strpos($url, 'sslmode=') === false) ? ';sslmode=require' : '';
    $dsn = "pgsql:host=$host;port=$port;dbname=$db$sslmode";
} else {
    $host = getenv('DB_HOST') ?: 'db';
    $port = getenv('DB_PORT') ?: '5432';
    $db   = getenv('DB_NAME') ?: 'medys_catering';
    $user = getenv('DB_USER') ?: 'medys';
    $pass = getenv('DB_PASS') ?: 'medys';
    $dsn  = "pgsql:host=$host;port=$port;dbname=$db";
}

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'message' => 'Database connection failed.',
        'detail'  => getenv('APP_DEBUG') ? $e->getMessage() : null,
    ]);
    exit;
}

// Auto-cancel pending/confirmed bookings whose event date has already passed
$pdo->exec("UPDATE bookings SET status = 'cancelled' WHERE event_date < CURRENT_DATE AND status IN ('pending', 'confirmed')");
