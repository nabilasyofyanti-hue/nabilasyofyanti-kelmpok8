<?php
include "../koneksi.php";

if(isset($_POST['simpan'])){

    $id_anggota = $_POST['id_anggota'];
    $id_buku = $_POST['id_buku'];

    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];

    mysqli_query($koneksi,"
    INSERT INTO peminjaman
    (
        id_anggota,
        id_buku,
        tgl_pinjam,
        tgl_kembali,
        status
    )
    VALUES
    (
        '$id_anggota',
        '$id_buku',
        '$tgl_pinjam',
        '$tgl_kembali',
        'Pinjam'
    )
    ") or die(mysqli_error($koneksi));

    mysqli_query($koneksi,"
    UPDATE buku
    SET stok = stok - 1
    WHERE id_buku='$id_buku'
    ");

    header("Location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Peminjaman Buku</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<div class="card shadow">

<div class="card-header bg-primary text-white">
    <h4>📚 Peminjaman Buku</h4>
</div>

<div class="card-body">

<form method="POST">

<label>Anggota</label>

<select name="id_anggota" class="form-control mb-3" required>

<?php
$a = mysqli_query($koneksi,"SELECT * FROM anggota");

while($aa = mysqli_fetch_assoc($a)){
?>

<option value="<?= $aa['id_anggota']; ?>">
    <?= $aa['nama']; ?>
</option>

<?php } ?>

</select>

<label>Buku</label>

<select name="id_buku" class="form-control mb-3" required>

<?php
$b = mysqli_query($koneksi,"
SELECT * FROM buku
WHERE stok > 0
");

while($bb = mysqli_fetch_assoc($b)){
?>

<option value="<?= $bb['id_buku']; ?>">
    <?= $bb['judul']; ?> (Stok <?= $bb['stok']; ?>)
</option>

<?php } ?>

</select>

<label>Tanggal Pinjam</label>

<input type="date"
       name="tgl_pinjam"
       class="form-control mb-3"
       value="<?= date('Y-m-d'); ?>"
       required>

<label>Batas Kembali</label>

<input type="date"
       name="tgl_kembali"
       class="form-control mb-3"
       value="<?= date('Y-m-d', strtotime('+7 days')); ?>"
       required>

<button type="submit"
        name="simpan"
        class="btn btn-success">
    💾 Simpan
</button>

<a href="index.php"
   class="btn btn-secondary">
   ↩ Kembali
</a>

<a href="../dashboard.php"
   class="btn btn-dark">
   🏠 Dashboard
</a>

</form>

</div>

</div>

</div>

</body>
</html>