<?php

require_once 'db.php';

session_start();
if (!isset($_SESSION['user'])) {
    // Jika tidak ada session, arahkan ke halaman login
    header("Location: login.php");
    exit;
}

$conn = connect();

$id = intval($_GET['id']);
$query = "SELECT adopsi.*, hewan.nama AS nama_hewan, hewan.jenis, hewan.ras, hewan.umur, hewan.gender, pengguna.nama AS nama_pengguna, pengguna.alamat FROM adopsi JOIN hewan ON hewan.id = adopsi.id_hewan JOIN pengguna ON pengguna.id = adopsi.id_pengguna WHERE adopsi.id = $id";
$data = mysqli_fetch_assoc(mysqli_query($conn, $query));

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Persetujuan Adopsi Hewan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        .surat {
            max-width: 700px;
            margin: auto;
            padding: 20px;
            border: 1px solid #000;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="surat">
        <h2 class="text-center">Surat Keterangan Persetujuan Adopsi Hewan</h2>
        <p>Yang bertanda tangan di bawah ini:</p>
        <p><strong>Nama Adopter:</strong> <?= $data['nama_pengguna']; ?></p>
        <p><strong>Alamat:</strong> <?= $data['alamat']; ?></p>
        <p>Dengan ini, adopter menyatakan bersedia dan berkomitmen penuh untuk:</p>
        <ol>
            <li>Merawat hewan dengan sebaik-baiknya, termasuk memberi makan, minum, dan tempat tinggal yang layak.</li>
            <li>Memberikan perawatan kesehatan, seperti vaksinasi, pengobatan, dan pemeriksaan rutin sesuai kebutuhan hewan.</li>
            <li>Tidak menyakiti, menelantarkan, atau menjual hewan kepada pihak lain tanpa pemberitahuan kepada pihak penyerah.</li>
        </ol>
        <p>Demikian surat ini dibuat pada tanggal <?= date('d-m-Y H:i'); ?> dengan penuh kesadaran tanpa paksaan dari pihak manapun.</p>
        <br>
        <p class="text-center">(<?= $data['nama_pengguna']; ?>)</p>
    </div>
</body>
</html>
