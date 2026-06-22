<?php
include "../koneksi.php";

/* ========================
   AUTO KODE BUKU
======================== */
$queryKode = mysqli_query($koneksi, "SELECT MAX(kode_buku) AS kode_terakhir FROM buku");
$dataKode = mysqli_fetch_assoc($queryKode);

$kode_lama = $dataKode['kode_terakhir'];

if(empty($kode_lama)){
    $kode_baru = "BK0001";
}else{
    $urutan = (int) substr($kode_lama, 2);
    $urutan++;
    $kode_baru = "BK" . sprintf("%04s", $urutan);
}

/* ========================
   SIMPAN DATA
======================== */
if(isset($_POST['simpan'])){

    $isbn       = $_POST['isbn'];
    $kode_buku  = $_POST['kode_buku'];
    $judul      = $_POST['judul'];
    $pengarang  = $_POST['pengarang'];
    $penerbit   = $_POST['penerbit'];
    $tahun      = $_POST['tahun'];
    $kategori   = $_POST['kategori'];
    $rak        = $_POST['rak'];
    $stok       = $_POST['stok'];

    $query = mysqli_query($koneksi,"
        INSERT INTO buku
        (isbn, kode_buku, judul, pengarang, penerbit, tahun_terbit, kategori, rak, stok, barcode)
        VALUES
        ('$isbn', '$kode_buku', '$judul', '$pengarang', '$penerbit', '$tahun', '$kategori', '$rak', '$stok', '$kode_buku')
    ");

    if(!$query){
        die("Error: " . mysqli_error($koneksi));
    } else {
        echo "<script>
                alert('Data Buku Berhasil Disimpan');
                window.location='index.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

<div class="card shadow">

<div class="card-header bg-primary text-white">
    <h4>📚 Tambah Buku</h4>
</div>

<div class="card-body">

<form method="POST">

    <label>ISBN</label>
    <input type="text" name="isbn" class="form-control mb-3" required>

    <label>Kode Buku</label>
    <input type="text" name="kode_buku"
           value="<?= $kode_baru; ?>"
           class="form-control mb-3" readonly>

    <label>Judul Buku</label>
    <input type="text" name="judul" class="form-control mb-3" required>

    <label>Pengarang</label>
    <input type="text" name="pengarang" class="form-control mb-3">

    <label>Penerbit</label>
    <input type="text" name="penerbit" class="form-control mb-3">

    <label>Tahun Terbit</label>
    <input type="number" name="tahun" class="form-control mb-3">

    <label>Kategori</label>
    <select name="kategori" class="form-control mb-3">
        <option>Informatika</option>
        <option>Matematika</option>
        <option>Bahasa</option>
        <option>Sejarah</option>
        <option>IPA</option>
        <option>Umum</option>
    </select>

    <label>Rak</label>
    <input type="text" name="rak" class="form-control mb-3">

    <label>Stok</label>
    <input type="number" name="stok" class="form-control mb-3">

    <button type="submit" name="simpan" class="btn btn-success">
        💾 Simpan
    </button>

    <a href="index.php" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>

</div>

</body>
</html>