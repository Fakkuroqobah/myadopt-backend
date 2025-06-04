<?php

require_once 'db.php';
require_once 'config.php';

$conn = connect();

$serverKey = 'SB-Mid-server-GxWMfcqlQzXokg7gPmaqDnDd';
$auth = base64_encode($serverKey . ':');

$query = "SELECT * FROM donasi WHERE tanggal IS NULL";
$dataDb = mysqli_query($conn, $query);

foreach ($dataDb as $valueDb) {
    $order_id = $valueDb['id_midtrans'];
    $url = "https://api.sandbox.midtrans.com/v2/" . $order_id . "/status";
    
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Basic $auth",
            "Accept: application/json"
        ],
    ]);
    
    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($httpCode == 200) {
        $data = json_decode($response, true);
    
        if (!empty($data)) {
            $orderId = mysqli_real_escape_string($conn, $data['order_id']);
            $transactionId = mysqli_real_escape_string($conn, $data['transaction_id']);
            $transactionTime = mysqli_real_escape_string($conn, $data['transaction_time']);
            $paymentType = mysqli_real_escape_string($conn, $data['payment_type']);
            $status = mysqli_real_escape_string($conn, $data['transaction_status']);
            $amount = mysqli_real_escape_string($conn, $data['gross_amount']);

            var_dump($status);
            if($status == 'settlement') {
                $query = "UPDATE donasi SET jumlah = $amount, tanggal = '$transactionTime' WHERE id_midtrans = '$orderId' ";
    
                if (!mysqli_query($conn, $query)) {
                    echo "Gagal menyimpan data: " . mysqli_error($conn);
                }
            }
    
            mysqli_close($conn);
            echo "Data berhasil disimpan.";
            header("location:". 'donasi.php');
        } else {
            echo "Tidak ada data transaksi.";
        }
    } else {
        echo "Gagal mengambil data dari Midtrans. HTTP Code: $httpCode";
    }
}