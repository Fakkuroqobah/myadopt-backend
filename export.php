<?php

require_once 'db.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$conn = connect();

// Buat Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Tulis data
$sheet->setCellValue('A1', 'Nama Pengguna');
$sheet->setCellValue('B1', 'Nama Hewan');
$sheet->setCellValue('C1', 'Ras');
$sheet->setCellValue('D1', 'Pekerjaan');
$sheet->setCellValue('E1', 'Hobi');
$sheet->setCellValue('F1', 'Alamat');
$sheet->setCellValue('G1', 'Penghasilan');
$sheet->setCellValue('H1', 'Alasan');
$sheet->setCellValue('I1', 'Status');

$mulai = $_GET['mulai'];
$selesai = $_GET['selesai'];
if(!empty($mulai) && !empty($selesai)) {
    $query = "SELECT adopsi.*, hewan.nama AS nama_hewan, pengguna.nama AS nama_pengguna, hewan.ras FROM adopsi JOIN hewan ON hewan.id = adopsi.id_hewan JOIN pengguna ON pengguna.id = adopsi.id_pengguna WHERE status = 'disetujui' AND tanggal_pengajuan BETWEEN '$mulai' AND '$selesai' ";
}else{
    $query = "SELECT adopsi.*, hewan.nama AS nama_hewan, pengguna.nama AS nama_pengguna, hewan.ras FROM adopsi JOIN hewan ON hewan.id = adopsi.id_hewan JOIN pengguna ON pengguna.id = adopsi.id_pengguna WHERE status = 'disetujui' ";
}
$data = mysqli_query($conn, $query);

foreach ($data as $key => $value) {
    $row = $key + 2;
    $sheet->setCellValue('A' . $row, $value['nama_pengguna']);
    $sheet->setCellValue('B' . $row, $value['nama_hewan']);
    $sheet->setCellValue('C' . $row, $value['ras']);
    $sheet->setCellValue('D' . $row, $value['pekerjaan']);
    $sheet->setCellValue('E' . $row, $value['hobi']);

    // Tambahkan gambar
    // $drawing = new Drawing();
    // $drawing->setName($value['nama_hewan']);
    // $drawing->setDescription('Gambar Hewan');
    // $drawing->setPath('ktp/' . $value['ktp']);
    // $drawing->setHeight(80);
    // $drawing->setCoordinates('E' . $row);
    // $drawing->setWorksheet($sheet);

    $sheet->setCellValue('F' . $row, $value['alamat']);
    $sheet->setCellValue('G' . $row, $value['penghasilan']);
    $sheet->setCellValue('H' . $row, $value['alasan']);
    $sheet->setCellValue('I' . $row, $value['status']);
    
    if ($key === 0) {
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(30);
        $sheet->getColumnDimension('H')->setWidth(30);
        $sheet->getColumnDimension('I')->setWidth(30);
    }

    // $sheet->getRowDimension($row)->setRowHeight(80);
}

$sheet->getStyle('A2:I100')->getAlignment()->setVertical(Alignment::VERTICAL_TOP);

// Ekspor ke Excel
$filename = 'data_adopsi.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;