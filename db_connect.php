<?php
// db_connect.php
$host = 'sql6.webzdarma.cz';
$dbname = 'hrbitoveuweb4553';
$username = 'hrbitoveuweb4553';
$password = 'Heslo1234_';

try {
    $link = new mysqli($host, $username, $password, $dbname);

    if ($link->connect_error) {
        throw new Exception("Connection failed: " . $link->connect_error);
    }


} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'error' => 'Database connection failed: ' . $e->getMessage()
    ]);
    exit();
}
