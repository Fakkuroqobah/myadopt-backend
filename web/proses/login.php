<?php
session_start();

require_once '../../db.php';
$conn = connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Cek apakah input kosong
    if (empty($username) || empty($password)) {
        echo "<script>alert('Username dan password wajib diisi!'); window.location.href='../../login.php';</script>";
        exit;
    }

    // Ambil data pengguna berdasarkan username
    $sql = "SELECT * FROM pengguna WHERE username = '$username'";
    $user = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    // Verifikasi password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        header("Location: ../../index.php");
        exit;
    } else {
        echo "<script>alert('Username atau password salah!'); window.location.href='../../login.php';</script>";
        exit;
    }
}