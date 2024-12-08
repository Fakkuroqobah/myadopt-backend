<?php

require_once '../../db.php';
$conn = connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama']);
    $jenis = trim($_POST['jenis']);
    $ras = trim($_POST['ras']);
    $umur = $_POST['umur'];
    $gender = $_POST['gender'];
    $berat = $_POST['berat'];
    $keterangan = trim($_POST['keterangan']);

    // Upload Foto
    $foto = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto_dir = "../../foto/";
        $foto_name = uniqid() . "_" . basename($_FILES['foto']['name']);
        $foto_path = $foto_dir . $foto_name;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $foto_path)) {
            $foto = $foto_name;
        } else {
            echo "Gagal mengupload foto!";
            exit;
        }
    }

    // Simpan data ke database
    $sql = "INSERT INTO hewan (nama, jenis, ras, umur, gender, berat, foto, keterangan)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssisdss", $nama, $jenis, $ras, $umur, $gender, $berat, $foto, $keterangan);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data hewan berhasil disimpan!'); window.location.href='../../hewan.php';</script>";
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
}