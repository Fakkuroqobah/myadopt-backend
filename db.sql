CREATE TABLE pengguna (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    alamat TEXT NOT NULL,
    no_telepon VARCHAR(20) NOT NULL,
    foto VARCHAR(255) NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE hewan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    jenis ENUM('Kucing', 'Anjing') NOT NULL,
    ras VARCHAR(255) NOT NULL,
    umur INT NOT NULL,
    gender ENUM('Jantan', 'Betina') NOT NULL,
    berat INT NOT NULL,
    foto VARCHAR(255) NOT NULL,
    keterangan TEXT NOT NULL
);

CREATE TABLE adopsi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pengguna INT NOT NULL,
    id_hewan INT NOT NULL,
    pekerjaan VARCHAR(255) NOT NULL,
    alasan TEXT NOT NULL,
    status VARCHAR(50) DEFAULT 'menunggu',
    FOREIGN KEY (id_pengguna) REFERENCES pengguna(id),
    FOREIGN KEY (id_hewan) REFERENCES hewan(id)
);

-- Data dummy untuk tabel 'pengguna'
INSERT INTO pengguna (nama, jenis_kelamin, alamat, no_telepon, username, password) VALUES
('Andi Wijaya', 'Laki-laki', 'Jl. Merpati No. 5, Jakarta', '081234567890', 'admin', '$2y$10$kngBOyBO0XSuWC2xbX31H.QvwvCAZemJyqCpvrinf7qe1RfBvQr8.'),
('Budi Santoso', 'Laki-laki', 'Jl. Kenari No. 8, Bandung', '082345678901', 'budisantoso', '$2y$10$kngBOyBO0XSuWC2xbX31H.QvwvCAZemJyqCpvrinf7qe1RfBvQr8.'),
('Citra Dewi', 'Perempuan', 'Jl. Kutilang No. 12, Surabaya', '083456789012', 'citradewi', '$2y$10$kngBOyBO0XSuWC2xbX31H.QvwvCAZemJyqCpvrinf7qe1RfBvQr8.'),
('Dewi Lestari', 'Perempuan', 'Jl. Rajawali No. 3, Yogyakarta', '084567890123', 'dewilestari', '$2y$10$kngBOyBO0XSuWC2xbX31H.QvwvCAZemJyqCpvrinf7qe1RfBvQr8.'),
('Eko Prasetyo', 'Laki-laki', 'Jl. Cendrawasih No. 9, Semarang', '085678901234', 'ekoprasetyo', '$2y$10$kngBOyBO0XSuWC2xbX31H.QvwvCAZemJyqCpvrinf7qe1RfBvQr8.');

-- Data dummy untuk tabel 'hewan'
INSERT INTO hewan (nama, jenis, ras, umur, gender, berat, foto, keterangan) VALUES
('Milo', 'Kucing', 'Persia', 2, 'Jantan', 2, 'milo.png', 'Kucing Persia yang sangat lucu dan ramah.'),
('Bella', 'Anjing', 'Labrador', 3, 'Betina', 1, 'bella.png', 'Anjing Labrador yang aktif dan suka bermain.'),
('Simba', 'Kucing', 'Maine Coon', 1, 'Jantan', 1, 'simba.png', 'Kucing Maine Coon yang besar dan lembut.'),
('Rocky', 'Anjing', 'Bulldog', 4, 'Betina', 2, 'rocky.png', 'Anjing Bulldog yang tenang dan penyayang.'),
('Luna', 'Kucing', 'Siam', 2, 'Jantan', 3, 'luna.png', 'Kucing Siam yang elegan dan pintar.');

-- Data dummy untuk tabel 'adopsi'
INSERT INTO adopsi (id_pengguna, id_hewan, pekerjaan, alasan, status) VALUES
(1, 1, 'Dokter', 'Saya ingin memberikan rumah yang penuh kasih untuk hewan peliharaan.', 'disetujui'),
(2, 3, 'Guru', 'Anak-anak saya sangat menyukai kucing dan ingin memeliharanya.', 'menunggu'),
(3, 2, 'Pengusaha', 'Anjing ini akan menjadi teman yang baik di rumah saya.', 'ditolak'),
(4, 4, 'Mahasiswa', 'Saya mencari teman untuk menemani saya belajar.', 'disetujui'),
(5, 5, 'Karyawan', 'Saya ingin memiliki hewan peliharaan untuk mengurangi stres.', 'menunggu');