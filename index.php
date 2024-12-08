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

<div class="mt-4">
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pengguna</th>
                    <th>Hewan</th>
                    <th>Pekerjaan</th>
                    <th>Hobi</th>
                    <th>KTP</th>
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
                                <td><a href='ktp/{$row['ktp']}' target='__BLANK'>Lihat</a></td>
                                <td>{$row['alamat']}</td>
                                <td>{$row['penghasilan']}</td>
                                <td>{$row['alasan']}</td>
                                <td>
                                    <a href='web/proses/aksi_adopsi.php?id={$row['id']}&aksi=disetujui' class='btn btn-sm btn-success'>Setujui</a>
                                    <span class='mx-1'></span>
                                    <a href='web/proses/aksi_adopsi.php?id={$row['id']}&aksi=ditolak' class='btn btn-sm btn-danger'>Tolak</a>
                                    <span class='mx-1'></span>
                                    <a href='web/proses/print_surat.php?id={$row['id']}' class='btn btn-sm btn-secondary'>Print</a>
                                </td>
                            </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='10' class='text-center'>Tidak ada data</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
    
<?php require 'footer.php' ?>