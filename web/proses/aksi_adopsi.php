<?php

require_once '../../db.php';
$conn = connect();

$id = $_GET['id'];
$aksi = $_GET['aksi'];

$query = sprintf("UPDATE adopsi SET status = '%s', tanggal_status = '%s' WHERE id = $id",
    mysqli_real_escape_string($conn, $aksi),
    mysqli_real_escape_string($conn, date('Y-m-d'))
);


if (mysqli_query($conn, $query)) {
    header('Location: ../../index.php?status=success');
} else {
    header('Location: ../../index.php?status=error');
}
