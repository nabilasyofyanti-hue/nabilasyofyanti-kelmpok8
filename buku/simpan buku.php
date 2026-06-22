<?php
include "../koneksi.php";

$kode_buku = $_POST['kode_buku'];
$isbn = $_POST['isbn'];
$judul = $_POST['judul'];
$pengarang = $_POST['pengarang'];
$penerbit = $_POST['penerbit'];
$tahun = $_POST['tahun_terbit'];
$kategori = $_POST['kategori'];
$rak = $_POST['rak'];
$stok = $_POST['stok'];

mysqli_query($koneksi,"
INSERT INTO buku
(kode_buku, isbn, judul, pengarang, penerbit, tahun_terbit, kategori, rak, stok)
VALUES
('$kode_buku', '$isbn', '$judul', '$pengarang', '$penerbit', '$tahun', '$kategori', '$rak', '$stok')
");

header("location:index.php");
?>