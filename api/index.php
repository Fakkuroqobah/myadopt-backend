<?php
header("Content-Type: application/json");

require_once '../db.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($method === 'POST') {
    switch ($action) {
        case 'daftar':
            require 'daftar.php';
            break;
        case 'login':
            require 'login.php';
            break;
        case 'ajukan_adopsi':
            require 'ajukan_adopsi.php';
            break;
        case 'ubah_profil':
            require 'ubah_profil.php';
            break;
        case 'donasi':
            require 'donasi.php';
            break;
        default:
            echo json_encode(['message' => 'Invalid action']);
    }
} elseif ($method === 'GET') {
    switch ($action) {
        case 'hewan':
            require 'hewan.php';
            break;
        case 'adopsi':
            require 'adopsi.php';
            break;
        default:
            echo json_encode(['message' => 'Invalid action']);
            break;
    }
} else {
    echo json_encode(['message' => 'Invalid request method']);
}