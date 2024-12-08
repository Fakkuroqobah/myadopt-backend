<?php

require_once '../../db.php';
$conn = connect();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header("Location: ../../edit_hewan.php?id={$_GET['id']}");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jenis = mysqli_real_escape_string($conn, $_POST['jenis']);
    $ras = mysqli_real_escape_string($conn, $_POST['ras']);
    $umur = intval($_POST['umur']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $berat = floatval($_POST['berat']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    // Ambil data lama untuk menghapus file foto jika ada
    $sql_get = "SELECT foto FROM hewan WHERE id = $id";
    $result_get = mysqli_query($conn, $sql_get);
    $data = mysqli_fetch_assoc($result_get);
    $old_foto = $data['foto'];

    // Upload Foto Baru
    $foto = $old_foto; // Default ke foto lama
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto_dir = "../../foto/";
        $foto_name = uniqid() . "_" . basename($_FILES['foto']['name']);
        $foto_path = $foto_dir . $foto_name;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $foto_path)) {
            $foto = $foto_name;

            // Hapus file foto lama jika ada
            if ($old_foto && file_exists($foto_dir . $old_foto)) {
                unlink($foto_dir . $old_foto);
            }
        } else {
            echo "Gagal mengupload foto!";
            exit;
        }
    }

    // Update data di database
    $sql_update = "UPDATE hewan 
                   SET nama = '$nama', jenis = '$jenis', ras = '$ras', umur = $umur, gender = '$gender', berat = $berat, foto = '$foto', keterangan = '$keterangan' 
                   WHERE id = $id";

    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Data berhasil diupdate!'); window.location.href='../../hewan.php';</script>";
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
    }
}