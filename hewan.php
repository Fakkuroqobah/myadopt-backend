<?php
require_once 'db.php';

session_start();
if (!isset($_SESSION['user'])) {
    // Jika tidak ada session, arahkan ke halaman login
    header("Location: login.php");
    exit;
}

$conn = connect();

$query = "SELECT * 
    FROM hewan 
    WHERE NOT EXISTS (
    SELECT 1 
    FROM adopsi 
    WHERE adopsi.id_hewan = hewan.id 
        AND adopsi.status = 'disetujui'
    )";
$data = mysqli_query($conn, $query);
?>

<?php require 'header.php' ?>

 <!-- Header -->
 <nav class="navbar navbar-expand-lg navbar-light">
    <span class="navbar-brand text-white">Kelola Data Hewan</span>
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

<div class="mt-4">
    <a href="tambah_hewan.php" class="btn btn-success mb-3">Tambah Hewan Adopsi</a>
    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Ras</th>
                <th>Umur</th>
                <th>Gender</th>
                <th>Berat</th>
                <th>Foto</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (mysqli_num_rows($data) > 0) {
                    $no = 1;
                    while($row = mysqli_fetch_assoc($data)) {
                        echo "<tr>
                            <td class='text-center'>{$no}</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['jenis']}</td>
                            <td>{$row['ras']}</td>
                            <td>{$row['umur']} Bulan</td>
                            <td>{$row['gender']}</td>
                            <td>{$row['berat']} Kg</td>
                            <td><img src='foto/{$row['foto']}' style='max-width: 150px' /></td>
                            <td>{$row['keterangan']}</td>
                            <td>
                                <div style='width:120px'>
                                <a href='web/proses/edit_hewan.php?id={$row['id']}' class='btn btn-sm btn-success'>Edit</a>
                                <span class='mx-1'></span>
                                <a href='web/proses/hapus_hewan.php?id={$row['id']}' class='btn btn-sm btn-danger'>Hapus</a>
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
    
<?php require 'footer.php' ?>