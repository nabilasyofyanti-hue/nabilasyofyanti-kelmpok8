<?php
include "../koneksi.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT * FROM buku
WHERE id_buku='$id'
"));

if(isset($_POST['update'])){

$isbn = $_POST['isbn'];
$kode_buku = $_POST['kode_buku'];
$judul = $_POST['judul'];
$pengarang = $_POST['pengarang'];
$penerbit = $_POST['penerbit'];
$tahun = $_POST['tahun'];
$kategori = $_POST['kategori'];
$rak = $_POST['rak'];
$stok = $_POST['stok'];

mysqli_query($koneksi,"
UPDATE buku SET
isbn='$isbn',
kode_buku='$kode_buku',
judul='$judul',
pengarang='$pengarang',
penerbit='$penerbit',
tahun_terbit='$tahun',
kategori='$kategori',
rak='$rak',
stok='$stok'
WHERE id_buku='$id'
");

header("Location:index.php");
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
<h3>Edit Buku</h3>

<form method="POST">

<input type="text" name="isbn" class="form-control mb-2" value="<?= $data['isbn']; ?>">

<input type="text" name="kode_buku" class="form-control mb-2" value="<?= $data['kode_buku']; ?>">

<input type="text" name="judul" class="form-control mb-2" value="<?= $data['judul']; ?>">

<input type="text" name="pengarang" class="form-control mb-2" value="<?= $data['pengarang']; ?>">

<input type="text" name="penerbit" class="form-control mb-2" value="<?= $data['penerbit']; ?>">

<input type="number" name="tahun" class="form-control mb-2" value="<?= $data['tahun_terbit']; ?>">

<input type="text" name="kategori" class="form-control mb-2" value="<?= $data['kategori']; ?>">

<input type="text" name="rak" class="form-control mb-2" value="<?= $data['rak']; ?>">

<input type="number" name="stok" class="form-control mb-2" value="<?= $data['stok']; ?>">

<button name="update" class="btn btn-warning">
Update
</button>

<a href="index.php" class="btn btn-secondary">
Kembali
</a>

</form>
</div>s