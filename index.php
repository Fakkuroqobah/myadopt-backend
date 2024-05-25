<?php
header("Content-Type: application/json");

require_once 'db.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($method === 'POST') {
    switch ($action) {
        case 'daftar':
            require 'api/daftar.php';
            break;
        case 'login':
            require 'api/login.php';
            break;
        case 'ajukan_adopsi':
            require 'api/ajukan_adopsi.php';
            break;
        default:
            echo json_encode(['message' => 'Invalid action']);
    }
} elseif ($method === 'GET' && $action === 'hewan') {
    require 'api/hewan.php';
} else {
    echo json_encode(['message' => 'Invalid request method']);
}