<?php
$data = json_decode(file_get_contents('php://input'), true);

$id_pengguna = $data['id_pengguna'];
$id_hewan = $data['id_hewan'];
$pekerjaan = $data['pekerjaan'];
$hobi = $data['hobi'];
$alamat = $data['alamat'];
$penghasilan = $data['penghasilan'];
$alasan = $data['alasan']; 
$ktp = $_FILES['ktp'];

$uploadDir = 'ktp/';
$originalFilename = pathinfo($ktp['name'], PATHINFO_FILENAME);
$extension = pathinfo($ktp['name'], PATHINFO_EXTENSION);
$uniqueFilename = $originalFilename . '_' . time() . '.' . $extension;
$uploadFile = $uploadDir . $uniqueFilename;

$conn = connect();

if (!move_uploaded_file($ktp['tmp_name'], $uploadFile)) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to upload file']);
    exit;
}

$query = sprintf("INSERT INTO adopsi (id_pengguna, id_hewan, pekerjaan, hobi, alamat, penghasilan, ktp, alasan, status) VALUES (%d, %d, '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
    mysqli_real_escape_string($conn, $id_pengguna),
    mysqli_real_escape_string($conn, $id_hewan),
    mysqli_real_escape_string($conn, $pekerjaan),
    mysqli_real_escape_string($conn, $hobi),
    mysqli_real_escape_string($conn, $alamat),
    mysqli_real_escape_string($conn, $penghasilan),
    mysqli_real_escape_string($conn, $uploadFile),
    mysqli_real_escape_string($conn, $alasan),
    mysqli_real_escape_string($conn, 'menunggu')
);


if (mysqli_query($conn, $query)) {
    http_response_code(200);
    echo json_encode(['message' => 'success']);
} else {
    http_response_code(500);
    echo json_encode(['message' => 'error']);
}

mysqli_close($conn);