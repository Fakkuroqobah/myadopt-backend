<?php
$data = json_decode(file_get_contents('php://input'), true);

$nama = $data['nama'];
$jenis_kelamin = $data['jenis_kelamin'];
$alamat = $data['alamat'];
$no_telepon = $data['no_telepon'];
$username = $data['username'];
$password = password_hash($data['password'], PASSWORD_DEFAULT);

$conn = connect();

$query = "SELECT * FROM pengguna WHERE username = '$username'";
$check = mysqli_fetch_assoc(mysqli_query($conn, $query));

if(!is_null($check)) {
    echo json_encode(['message' => 'username ini sudah ada']);
    die();
}

$query = sprintf("INSERT INTO pengguna (nama, jenis_kelamin, alamat, no_telepon, username, password) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
    mysqli_real_escape_string($conn, $nama),
    mysqli_real_escape_string($conn, $jenis_kelamin),
    mysqli_real_escape_string($conn, $alamat),
    mysqli_real_escape_string($conn, $no_telepon),
    mysqli_real_escape_string($conn, $username),
    mysqli_real_escape_string($conn, $password)
);

if (mysqli_query($conn, $query)) {
    echo json_encode(['message' => 'success']);
} else {
    echo json_encode(['message' => 'error']);
}
var_dump(mysqli_error($conn));

mysqli_close($conn);