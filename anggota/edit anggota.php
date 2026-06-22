<?php
include "../koneksi.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT * FROM anggota WHERE id_anggota='$id'
"));

if(isset($_POST['update'])){

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$nim = $_POST['nim'];
$kelas = $_POST['kelas'];
$prodi = $_POST['prodi'];
$hp = $_POST['hp'];

mysqli_query($koneksi,"
UPDATE anggota SET
kode_anggota='$kode',
nama='$nama',
nim='$nim',
kelas='$kelas',
prodi='$prodi',
no_hp='$hp'
WHERE id_anggota='$id'
");

header("Location: index.php");
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

<h3>Edit Anggota</h3>

<form method="post">

<input name="kode" value="<?= $data['kode_anggota']; ?>" class="form-control mb-2">
<input name="nama" value="<?= $data['nama']; ?>" class="form-control mb-2">
<input name="nim" value="<?= $data['nim']; ?>" class="form-control mb-2">
<input name="kelas" value="<?= $data['kelas']; ?>" class="form-control mb-2">
<input name="prodi" value="<?= $data['prodi']; ?>" class="form-control mb-2">
<input name="hp" value="<?= $data['no_hp']; ?>" class="form-control mb-2">

<button name="update" class="btn btn-warning">Update</button>
<a href="index.php" class="btn btn-secondary">Kembali</a>

</form>

</div>