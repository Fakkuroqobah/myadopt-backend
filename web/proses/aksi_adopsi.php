<?php

require_once '../../db.php';
$conn = connect();

$id = $_GET['id'];
$aksi = $_GET['aksi'];

$query = sprintf("UPDATE adopsi SET status = '%s' WHERE id = $id",
    mysqli_real_escape_string($conn, $aksi)
);


if (mysqli_query($conn, $query)) {
    header('Location: ../../index.php?status=success');
} else {
    header('Location: ../../index.php?status=error');
}
