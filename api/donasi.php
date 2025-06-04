<?php

require_once '../db.php';
require_once '../vendor/autoload.php'; // Pastikan path sesuai dengan lokasi library

$conn = connect();

header('Content-Type: application/json');

// Konfigurasi Midtrans
$serverKey = 'SB-Mid-server-GxWMfcqlQzXokg7gPmaqDnDd';
$apiUrl = 'https://app.sandbox.midtrans.com/snap/v1/transactions';

// Ambil data dari Flutter (JSON)
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['error' => 'Invalid input']);
    exit;
}

$email = str_replace("@mail.com", "", $data['customer_details']['email']);
$query = "SELECT * FROM pengguna WHERE username = '$email' LIMIT 1 ";
$dataDb = mysqli_query($conn, $query);
$dataDb = mysqli_fetch_assoc($dataDb);

$orderId = $data['order_id'];
$idPengguna = $dataDb['id'];
$query = "INSERT INTO donasi (id_midtrans, id_pengguna) VALUES ('$orderId', $idPengguna)";

if (!mysqli_query($conn, $query)) {
    echo json_encode(['error' => 'Invalid input']);
    exit;
}

$transactionData = [
    'transaction_details' => [
        'order_id' => $data['order_id'],
        'gross_amount' => $data['gross_amount'],
    ],
    'customer_details' => $data['customer_details'],
    'callbacks' => [
        'finish' => URL_SERVER . 'midtrans_success.php',
        'unfinish' => URL_SERVER . 'midtrans_unfinish.php',
        'error' => URL_SERVER . 'midtrans_error.php'
    ]
];

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => $apiUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        'Authorization: Basic ' . base64_encode($serverKey . ':'),
        'Content-Type: application/json',
    ],
    CURLOPT_POSTFIELDS => json_encode($transactionData),
]);

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo json_encode(['error' => curl_error($curl)]);
    curl_close($curl);
    exit;
}

curl_close($curl);

echo $response;