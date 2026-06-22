<?php
include "../koneksi.php";

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

$query = mysqli_query($koneksi,"
SELECT p.*, a.nama, b.judul
FROM peminjaman p
JOIN anggota a ON p.id_anggota=a.id_anggota
JOIN buku b ON p.id_buku=b.id_buku
WHERE MONTH(p.tgl_pinjam)='$bulan'
AND YEAR(p.tgl_pinjam)='$tahun'
ORDER BY p.tgl_pinjam DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Laporan Peminjaman Buku</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
@media print{
    .no-print{
        display:none;
    }
}
</style>

</head>
<body>

<div class="container mt-4">

<h3 class="text-center">
LAPORAN PEMINJAMAN BUKU
</h3>

<form method="GET" class="row g-2 mb-3 no-print">

<div class="col-md-3">
<select name="bulan" class="form-control">

<?php
for($i=1;$i<=12;$i++){
?>

<option value="<?= sprintf("%02d",$i); ?>"
<?= ($bulan==sprintf("%02d",$i))?'selected':''; ?>>
Bulan <?= $i ?>
</option>

<?php } ?>

</select>
</div>

<div class="col-md-3">
<input type="number"
name="tahun"
value="<?= $tahun; ?>"
class="form-control">
</div>

<div class="col-md-6">

<button class="btn btn-primary">
Tampilkan
</button>

<button type="button"
onclick="window.print()"
class="btn btn-success">
Cetak
</button>

<a href="../dashboard.php"
class="btn btn-secondary">
Dashboard
</a>

</div>

</form>

<table class="table table-bordered">

<tr class="table-dark">

<th>No</th>
<th>Nama Anggota</th>
<th>Judul Buku</th>
<th>Tanggal Pinjam</th>
<th>Batas Kembali</th>
<th>Status</th>

</tr>

<?php
$no=1;

while($row=mysqli_fetch_assoc($query)){
?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama']; ?></td>

<td><?= $row['judul']; ?></td>

<td><?= $row['tgl_pinjam']; ?></td>

<td><?= $row['tgl_kembali']; ?></td>

<td><?= $row['status']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>