<?php
require_once 'db.php';

session_start();
if (!isset($_SESSION['user'])) {
    // Jika tidak ada session, arahkan ke halaman login
    header("Location: login.php");
    exit;
}

$conn = connect();

$query = "SELECT donasi.*, pengguna.username, pengguna.nama FROM donasi JOIN pengguna ON donasi.id_pengguna = pengguna.id";
$data = mysqli_query($conn, $query);

?>

<?php require 'header.php' ?>

 <!-- Header -->
 <nav class="navbar navbar-expand-lg navbar-light">
    <span class="navbar-brand text-white">Donasi</span>
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
    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (mysqli_num_rows($data) > 0) {
                    $no = 1;
                    while($row = mysqli_fetch_assoc($data)) {
                        echo "<tr>
                            <td class='text-center'>{$no}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['jumlah']}</td>
                            <td>{$row['tanggal']}</td>
                        </tr>";
                        $no++;
                    }
                }
            ?>
        </tbody>
    </table>
</div>
    
<?php require 'footer.php' ?>