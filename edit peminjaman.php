<?php
include "../koneksi.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT * FROM peminjaman
WHERE id_pinjam='$id'
"));

if(isset($_POST['update'])){

$id_anggota = $_POST['id_anggota'];
$id_buku = $_POST['id_buku'];

mysqli_query($koneksi,"
UPDATE peminjaman SET
id_anggota='$id_anggota',
id_buku='$id_buku'
WHERE id_pinjam='$id'
");

header("Location:index.php");
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

<h3>Edit Peminjaman</h3>

<form method="POST">

<label>Anggota</label>

<select name="id_anggota" class="form-control mb-3">

<?php
$a=mysqli_query($koneksi,"SELECT * FROM anggota");

while($aa=mysqli_fetch_assoc($a)){
?>

<option value="<?= $aa['id_anggota']; ?>"
<?= ($aa['id_anggota']==$data['id_anggota'])?'selected':'';?>>

<?= $aa['nama']; ?>

</option>

<?php } ?>

</select>

<label>Buku</label>

<select name="id_buku" class="form-control mb-3">

<?php
$b=mysqli_query($koneksi,"SELECT * FROM buku");

while($bb=mysqli_fetch_assoc($b)){
?>

<option value="<?= $bb['id_buku']; ?>"
<?= ($bb['id_buku']==$data['id_buku'])?'selected':'';?>>

<?= $bb['judul']; ?>

</option>

<?php } ?>

</select>

<button name="update" class="btn btn-warning">
Update
</button>

<a href="index.php" class="btn btn-secondary">
Kembali
</a>

</form>

</div>