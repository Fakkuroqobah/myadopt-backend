<?php
require_once 'db.php';

session_start();
if (!isset($_SESSION['user'])) {
    // Jika tidak ada session, arahkan ke halaman login
    header("Location: login.php");
    exit;
}

?>

<?php require 'header.php' ?>

 <!-- Header -->
 <nav class="navbar navbar-expand-lg navbar-light">
    <span class="navbar-brand text-white">Tambah Data Hewan</span>
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
            <form action="web/proses/tambah_hewan.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama">Nama:</label><br>
                    <input class="form-control" type="text" id="nama" name="nama" required>
                </div>  
        
                <div class="form-group">
                    <label for="jenis">Jenis:</label><br>
                    <select id="jenis" class="form-control" name="jenis" required>
                        <option value="Kucing">Kucing</option>
                        <option value="Anjing">Anjing</option>
                    </select>
                </div>
        
                <div class="form-group">
                    <label for="ras">Ras:</label><br>
                    <input class="form-control" type="text" id="ras" name="ras">
                </div>
        
                <div class="form-group">
                    <label for="umur">Umur (bulan):</label><br>
                    <input class="form-control" type="number" id="umur" name="umur" min="0">
                </div>
        
                <div class="form-group">
                    <label for="gender">Gender:</label><br>
                    <select id="gender" class="form-control" name="gender" required>
                        <option value="Jantan">Jantan</option>
                        <option value="Betina">Betina</option>
                    </select>
                </div>
        
                <div class="form-group">
                    <label for="berat">Berat (kg):</label><br>
                    <input class="form-control" type="number" id="berat" name="berat" step="0.1" min="0">
                </div>
        
                <div class="form-group">
                    <label for="foto">Foto:</label><br>
                    <input class="form-control" type="file" id="foto" name="foto" accept="image/*" class="form-control">
                </div>
        
                <div class="form-group">
                    <label for="keterangan">Keterangan:</label><br>
                    <textarea id="keterangan" name="keterangan" rows="4" class="form-control"></textarea>
                </div>
        
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
    
<?php require 'footer.php' ?>