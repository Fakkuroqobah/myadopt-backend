<?php

require_once '../../db.php';
$conn = connect();

$id = $_GET['id'];

$query = sprintf("UPDATE adopsi SET status = '%s' WHERE id = $id",
    mysqli_real_escape_string($conn, 'menunggu')
);


if (mysqli_query($conn, $query)) {
    header('Location: ../../index.php?status=success');
} else {
    header('Location: ../../index.php?status=error');
}
