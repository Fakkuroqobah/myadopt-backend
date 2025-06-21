<?php
$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'];
$password = $data['password'];

$conn = connect();
$query = sprintf("SELECT * FROM pengguna WHERE username = '%s'",
    mysqli_real_escape_string($conn, $username)
);
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) === 1) {
    $data = mysqli_fetch_assoc($result);
    if (password_verify($password, $data['password'])) {
        $data['id'] = intval($data['id']);
        $data['foto'] = URL_SERVER . 'profil/' . $data['foto'];
        unset($data['password']);

        http_response_code(200);
        echo json_encode(['message' => 'success', 'data' => $data]);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Username atau password salah']);
    }
} else {
    http_response_code(500);
    echo json_encode(['message' => 'Username atau password salah']);
}

mysqli_close($conn);