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
$sql_get = "SELECT * FROM hewan WHERE id = $id";
$result_get = mysqli_query($conn, $sql_get);
$data = mysqli_fetch_assoc($result_get);
?>

<?php require 'header.php' ?>

 <!-- Header -->
 <nav class="navbar navbar-expand-lg navbar-light">
    <span class="navbar-brand text-white">Edit Data Hewan</span>
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
    <div class="row">
        <div class="col-md-6">
            <form action="web/proses/edit_hewan.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="form-group">
                    <label for="nama">Nama:</label><br>
                    <input class="form-control" type="text" id="nama" name="nama" required value="<?= $data['nama'] ?>">
                </div>  
        
                <div class="form-group">
                    <label for="jenis">Jenis:</label><br>
                    <select id="jenis" class="form-control" name="jenis" required>
                        <option value="Kucing" <?= ($data['jenis'] == 'Kucing') ? 'selected' : ''; ?> >Kucing</option>
                        <option value="Anjing" <?= ($data['jenis'] == 'Anjing') ? 'selected' : ''; ?> >Anjing</option>
                    </select>
                </div>
        
                <div class="form-group">
                    <label for="ras">Ras:</label><br>
                    <input class="form-control" type="text" id="ras" name="ras" value="<?= $data['ras'] ?>">
                </div>
        
                <div class="form-group">
                    <label for="umur">Umur (tahun):</label><br>
                    <input class="form-control" type="number" id="umur" name="umur" min="0" value="<?= $data['umur'] ?>">
                </div>
        
                <div class="form-group">
                    <label for="gender">Gender:</label><br>
                    <select id="gender" class="form-control" name="gender" required>
                        <option value="Jantan" <?= ($data['jenis'] == 'Jantan') ? 'selected' : ''; ?> >Jantan</option>
                        <option value="Betina" <?= ($data['jenis'] == 'Betina') ? 'selected' : ''; ?> >Betina</option>
                    </select>
                </div>
        
                <div class="form-group">
                    <label for="berat">Berat (kg):</label><br>
                    <input class="form-control" type="number" id="berat" name="berat" step="0.1" min="0" value="<?= $data['berat'] ?>">
                </div>
        
                <div class="form-group">
                    <label for="foto">Foto:</label><br>
                    <input class="form-control" type="file" id="foto" name="foto" accept="image/*" class="form-control">
                </div>
        
                <div class="form-group">
                    <label for="keterangan">Keterangan:</label><br>
                    <textarea id="keterangan" name="keterangan" rows="4" class="form-control"><?= $data['keterangan'] ?></textarea>
                </div>
        
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
    
<?php require 'footer.php' ?>