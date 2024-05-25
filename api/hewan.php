<?php
$conn = connect();
$query = "SELECT * FROM hewan";
$result = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $row['id'] = intval($row['id']);
    $row['umur'] = intval($row['umur']);
    $row['berat'] = intval($row['berat']);
    $row['foto'] = URL_SERVER . $row['foto'];
    $data[] = $row;
}

echo json_encode($data);

mysqli_close($conn);