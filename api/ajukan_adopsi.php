<?php
$data = json_decode(file_get_contents('php://input'), true);

$id_user = $data['id_user'];
$id_hewan = $data['id_hewan'];
$pekerjaan = $data['pekerjaan'];
$alasan = $data['alasan'];

$conn = connect();
$query = sprintf("INSERT INTO adopsi (id_pengguna, id_hewan, pekerjaan, alasan, status) VALUES (%d, %d, '%s', '%s', '%s')",
    $id_user,
    $id_hewan,
    $pekerjaan,
    $alasan,
    'menunggu'
);

if (mysqli_query($conn, $query)) {
    echo json_encode(['message' => 'success']);
} else {
    echo json_encode(['message' => 'error']);
}

mysqli_close($conn);