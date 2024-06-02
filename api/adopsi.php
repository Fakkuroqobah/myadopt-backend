<?php
$conn = connect();
$id_pengguna = $_GET['id_pengguna'];
$query = "SELECT * FROM adopsi INNER JOIN hewan ON adopsi.id_hewan = hewan.id WHERE id_pengguna = '$id_pengguna'";
$result = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $row['id'] = intval($row['id']);
    $row['id_pengguna'] = intval($row['id_pengguna']);
    $row['id_hewan'] = intval($row['id_hewan']);
    $row['umur'] = intval($row['umur']);
    $row['berat'] = intval($row['berat']);
    $row['foto'] = URL_SERVER . 'foto/' . $row['foto'];
    $data[] = $row;
}

echo json_encode($data);

mysqli_close($conn);