<?php
include "../koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id'");
$row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
</head>

<body>

<div class="container mt-4">

<h3>📖 Detail Buku</h3>

<table class="table table-bordered">
    <tr><th>Kode Buku</th><td><?= $row['kode_buku']; ?></td></tr>
    <tr><th>ISBN</th><td><?= $row['isbn']; ?></td></tr>
    <tr><th>Judul</th><td><?= $row['judul']; ?></td></tr>
    <tr><th>Pengarang</th><td><?= $row['pengarang']; ?></td></tr>
    <tr><th>Penerbit</th><td><?= $row['penerbit']; ?></td></tr>
    <tr><th>Tahun</th><td><?= $row['tahun_terbit']; ?></td></tr>
    <tr><th>Kategori</th><td><?= $row['kategori']; ?></td></tr>
    <tr><th>Rak</th><td><?= $row['rak']; ?></td></tr>
    <tr><th>Stok</th><td><?= $row['stok']; ?></td></tr>
</table>

<!-- BARCODE -->
<svg id="barcode"></svg>

<script>
JsBarcode("#barcode", "<?= $row['kode_buku']; ?>", {
    format: "CODE128",
    width: 2,
    height: 60,
    displayValue: true
});
</script>

<a href="index.php" class="btn btn-secondary mt-3">Kembali</a>

</div>

</body>
</html>