<?php
require_once 'db.php';

session_start();
if (!isset($_SESSION['user'])) {
    // Jika tidak ada session, arahkan ke halaman login
    header("Location: login.php");
    exit;
}

$conn = connect();

$query = "SELECT adopsi.*, hewan.nama AS nama_hewan, pengguna.nama AS nama_pengguna FROM adopsi JOIN hewan ON hewan.id = adopsi.id_hewan JOIN pengguna ON pengguna.id = adopsi.id_pengguna WHERE status = 'menunggu'";
$data = mysqli_query($conn, $query);

$queryAdopsi = "SELECT adopsi.*, hewan.nama AS nama_hewan, pengguna.nama AS nama_pengguna FROM adopsi JOIN hewan ON hewan.id = adopsi.id_hewan JOIN pengguna ON pengguna.id = adopsi.id_pengguna WHERE status = 'disetujui'";
$dataAdopsi = mysqli_query($conn, $queryAdopsi);

$queryDitolak = "SELECT adopsi.*, hewan.nama AS nama_hewan, pengguna.nama AS nama_pengguna FROM adopsi JOIN hewan ON hewan.id = adopsi.id_hewan JOIN pengguna ON pengguna.id = adopsi.id_pengguna WHERE status = 'ditolak'";
$dataDitolak = mysqli_query($conn, $queryDitolak);

?>

<?php require 'header.php' ?>

 <!-- Header -->
 <nav class="navbar navbar-expand-lg navbar-light">
    <span class="navbar-brand text-white">Pengajuan Adopsi</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="web/proses/logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success') {
            echo '<div class="alert mt-3 alert-success">Status berhasil diperbarui</div>';
        } else if ($_GET['status'] == 'error') {
            echo '<div class="alert mt-3 alert-danger">Terjadi kesalahan. Silakan coba lagi.</div>';
        }
    }
?>

<form action="">
    <div class="row mt-3">
        <div class="col-md-6">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="mulai" class="form-control">
        </div>
        <div class="col-md-6">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" id="selesai" class="form-control">
        </div>
    </div>
</form>

<button type="button" onclick="exportData()" class="btn btn-success mt-3">Download Excel</button>

<ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Menunggu Persetujuan</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Telah Di Adopsi</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Pengajuan Ditolak</button>
    </li>
</ul>
<div class="tab-content pt-3" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-bordered table-striped" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pengguna</th>
                    <th>Hewan</th>
                    <th>Pekerjaan</th>
                    <th>Hobi</th>
                    <th>Alamat</th>
                    <th>Penghasilan</th>
                    <th>Alasan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (mysqli_num_rows($data) > 0) {
                        $no = 1;
                        while($row = mysqli_fetch_assoc($data)) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['nama_pengguna']}</td>
                                <td>{$row['nama_hewan']}</td>
                                <td>{$row['pekerjaan']}</td>
                                <td>{$row['hobi']}</td>
                                <td>{$row['alamat']}</td>
                                <td>{$row['penghasilan']}</td>
                                <td>{$row['alasan']}</td>
                                <td>
                                    <div style='width: 200px'>
                                        <a href='web/proses/aksi_adopsi.php?id={$row['id']}&aksi=disetujui' class='btn btn-sm btn-success'>Setujui</a>
                                        <span class='mx-1'></span>
                                        <a href='web/proses/aksi_adopsi.php?id={$row['id']}&aksi=ditolak' class='btn btn-sm btn-danger'>Tolak</a>
                                    </div>
                                </td>
                            </tr>";
                            $no++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <table class="table table-bordered table-striped" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pengguna</th>
                    <th>Hewan</th>
                    <th>Pekerjaan</th>
                    <th>Hobi</th>
                    <th>Alamat</th>
                    <th>Penghasilan</th>
                    <th>Alasan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (mysqli_num_rows($dataAdopsi) > 0) {
                        $no = 1;
                        while($rowAdopsi = mysqli_fetch_assoc($dataAdopsi)) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$rowAdopsi['nama_pengguna']}</td>
                                <td>{$rowAdopsi['nama_hewan']}</td>
                                <td>{$rowAdopsi['pekerjaan']}</td>
                                <td>{$rowAdopsi['hobi']}</td>
                                <td>{$rowAdopsi['alamat']}</td>
                                <td>{$rowAdopsi['penghasilan']}</td>
                                <td>{$rowAdopsi['alasan']}</td>
                                <td>
                                    <div style='width: 200px'>
                                        <a href='web/proses/print_surat.php?id={$rowAdopsi['id']}' class='btn btn-sm btn-secondary'>Print</a>
                                        <span class='mx-1'></span>
                                        <a href='web/proses/batal.php?id={$rowAdopsi['id']}' class='btn btn-sm btn-danger'>Batalkan</a>
                                    </div>
                                </td>
                            </tr>";
                            $no++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <table class="table table-bordered table-striped" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pengguna</th>
                    <th>Hewan</th>
                    <th>Pekerjaan</th>
                    <th>Hobi</th>
                    <th>Alamat</th>
                    <th>Penghasilan</th>
                    <th>Alasan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (mysqli_num_rows($dataDitolak) > 0) {
                        $no = 1;
                        while($rowDitolak = mysqli_fetch_assoc($dataDitolak)) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$rowDitolak['nama_pengguna']}</td>
                                <td>{$rowDitolak['nama_hewan']}</td>
                                <td>{$rowDitolak['pekerjaan']}</td>
                                <td>{$rowDitolak['hobi']}</td>
                                <td>{$rowDitolak['alamat']}</td>
                                <td>{$rowDitolak['penghasilan']}</td>
                                <td>{$rowDitolak['alasan']}</td>
                                <td>
                                    <div style='width: 200px'>
                                        <a href='web/proses/batal.php?id={$rowDitolak['id']}' class='btn btn-sm btn-danger'>Batalkan</a>
                                    </div>
                                </td>
                            </tr>";
                            $no++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
    
<script>
function exportData() {
    var mulai = document.getElementById('mulai').value;
    var selesai = document.getElementById('selesai').value;
    window.location.href = 'export.php?mulai=' + mulai + '&selesai=' + selesai;
}
</script>
<?php require 'footer.php' ?>