<?php

require_once '../../db.php';
$conn = connect();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header("Location: ../../surat_adopsi.php?id={$_GET['id']}");
    exit;
}