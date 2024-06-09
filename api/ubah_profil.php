<?php

$conn = connect();

$id = $_POST['id'];
$nama = $_POST['nama'];
$jenisKelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$noTelepon = $_POST['no_telepon'];
$foto = $_FILES['foto'];

$originalFilename = pathinfo($foto['name'], PATHINFO_FILENAME);
$extension = pathinfo($foto['name'], PATHINFO_EXTENSION);
$uniqueFilename = $originalFilename . '_' . time() . '.' . $extension;
$uploadFile = $uniqueFilename;

if($extension != 'unknown') {
    if (!move_uploaded_file($foto['tmp_name'], '../profil/' . $uploadFile)) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to upload file']);
        exit;
    }

    $query = sprintf("UPDATE pengguna SET nama = '%s', jenis_kelamin = '%s', alamat = '%s', no_telepon = '%s', foto = '%s' WHERE id = $id",
        mysqli_real_escape_string($conn, $nama),
        mysqli_real_escape_string($conn, $jenisKelamin),
        mysqli_real_escape_string($conn, $alamat),
        mysqli_real_escape_string($conn, $noTelepon),
        mysqli_real_escape_string($conn, $uploadFile),
    );
}else{
    $query = sprintf("UPDATE pengguna SET nama = '%s', jenis_kelamin = '%s', alamat = '%s', no_telepon = '%s' WHERE id = $id",
        mysqli_real_escape_string($conn, $nama),
        mysqli_real_escape_string($conn, $jenisKelamin),
        mysqli_real_escape_string($conn, $alamat),
        mysqli_real_escape_string($conn, $noTelepon)
    );
}


if (mysqli_query($conn, $query)) {
    http_response_code(200);
    echo json_encode(['message' => 'success']);
} else {
    http_response_code(500);
    echo json_encode(['message' => 'error']);
}
