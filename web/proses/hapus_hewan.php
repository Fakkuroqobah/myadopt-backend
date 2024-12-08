<?php

require_once '../../db.php';
$conn = connect();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ambil data lama untuk menghapus file foto
    $sql_get = "SELECT foto FROM hewan WHERE id = $id";
    $result_get = mysqli_query($conn, $sql_get);
    $data = mysqli_fetch_assoc($result_get);
    $old_foto = $data['foto'];

    // Hapus file foto jika ada
    $foto_dir = "uploads/";
    if ($old_foto && file_exists($foto_dir . $old_foto)) {
        unlink($foto_dir . $old_foto);
    }

    // Hapus data dari database
    $sql_delete = "DELETE FROM hewan WHERE id = $id";

    if (mysqli_query($conn, $sql_delete)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href='../../hewan.php';</script>";
    } else {
        echo "<script>alert('Data tidak dapat dihapus. Hewan tersebut sudah di adopsi!'); window.location.href='../../hewan.php';</script>";
    }
} else {
    echo "ID tidak ditemukan!";
}