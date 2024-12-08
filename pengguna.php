<?php
require_once 'db.php';

session_start();
if (!isset($_SESSION['user'])) {
    // Jika tidak ada session, arahkan ke halaman login
    header("Location: login.php");
    exit;
}

$conn = connect();

$query = "SELECT * FROM pengguna";
$data = mysqli_query($conn, $query);

?>

<?php require 'header.php' ?>

 <!-- Header -->
 <nav class="navbar navbar-expand-lg navbar-light">
    <span class="navbar-brand text-white">Pengguna</span>
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
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>No HP</th>
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
                                <td>{$row['jenis_kelamin']}</td>
                                <td>{$row['alamat']}</td>
                                <td>{$row['no_telepon']}</td>
                            </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center'>Tidak ada data</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
    
<?php require 'footer.php' ?>