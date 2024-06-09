<?php
require_once 'db.php';

$conn = connect();

$query = "SELECT adopsi.*, hewan.nama AS nama_hewan, pengguna.nama AS nama_pengguna FROM adopsi JOIN hewan ON hewan.id = adopsi.id_hewan JOIN pengguna ON pengguna.id = adopsi.id_pengguna WHERE status = 'menunggu'";
$data = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyAdopt</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 250px;
            background: #EC877D;
            color: #fff;
            flex-shrink: 0;
        }

        .sidebar .nav-link {
            color: #fff;
        }

        .sidebar .nav-link.active {
            background-color: #d36f67;
        }

        .content {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px;
            background-color: #fff;
        }

        .navbar-light {
            background-color: #EC877D;
        }

        .navbar-light .navbar-brand,
        .navbar-light .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-light .navbar-toggler-icon {
            background-color: #fff;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
        <h2 class="text-center mb-4">MyAdopt</h2>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">Pengajuan Adopsi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Hewan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pengguna</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
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
                        <a class="nav-link" href="#">Logout</a>
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
                                        </td>
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
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
