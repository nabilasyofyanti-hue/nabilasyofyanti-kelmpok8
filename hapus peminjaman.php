<?php
include "../koneksi.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT * FROM peminjaman
WHERE id_pinjam='$id'
"));

mysqli_query($koneksi,"
UPDATE buku
SET stok = stok + 1
WHERE id_buku='".$data['id_buku']."'
");

mysqli_query($koneksi,"
DELETE FROM peminjaman
WHERE id_pinjam='$id'
");

header("Location:index.php");
exit;
?>