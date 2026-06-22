<?php
include "../koneksi.php";

if(isset($_POST['simpan'])){

    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $kelas = $_POST['kelas'];
    $prodi = $_POST['prodi'];
    $hp = $_POST['hp'];

    mysqli_query($koneksi,"
    INSERT INTO anggota
    (kode_anggota,nama,nim,kelas,prodi,no_hp,status)
    VALUES
    ('$kode','$nama','$nim','$kelas','$prodi','$hp','Aktif')
    ");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Anggota</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

    <h3 class="mb-3">➕ Tambah Anggota</h3>

    <!-- Tombol Navigasi -->
    <div class="mb-3">

        <a href="../dashboard.php" class="btn btn-secondary">
            🏠 Dashboard
        </a>

        <a href="index.php" class="btn btn-info">
            📋 Data Anggota
        </a>

    </div>

    <div class="card">
        <div class="card-body">

            <form method="POST">

                <label>Kode Anggota</label>
                <input type="text" name="kode"
                       class="form-control mb-2"
                       placeholder="AG001" required>

                <label>Nama Anggota</label>
                <input type="text" name="nama"
                       class="form-control mb-2"
                       placeholder="Nama Anggota" required>

                <label>NIM</label>
                <input type="text" name="nim"
                       class="form-control mb-2"
                       placeholder="NIM" required>

                <label>Kelas</label>
                <input type="text" name="kelas"
                       class="form-control mb-2"
                       placeholder="Kelas">

                <label>Program Studi</label>
                <input type="text" name="prodi"
                       class="form-control mb-2"
                       placeholder="Program Studi">

                <label>No HP</label>
                <input type="text" name="hp"
                       class="form-control mb-3"
                       placeholder="08xxxxxxxxxx">

                <button type="submit"
                        name="simpan"
                        class="btn btn-primary">
                    💾 Simpan
                </button>

                <a href="index.php"
                   class="btn btn-warning">
                   ↩ Kembali
                </a>

            </form>

        </div>
    </div>

</div>

</body>
</html>