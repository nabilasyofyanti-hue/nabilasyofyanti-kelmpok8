<?php
include "../koneksi.php";

/* SEARCH */
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

/* PAGINATION */
$batas = 5;
$halaman = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$mulai = ($halaman - 1) * $batas;

/* TOTAL DATA */
$total_data = mysqli_num_rows(mysqli_query($koneksi,"
SELECT p.*
FROM peminjaman p
JOIN anggota a ON p.id_anggota=a.id_anggota
JOIN buku b ON p.id_buku=b.id_buku
WHERE a.nama LIKE '%$cari%'
OR b.judul LIKE '%$cari%'
"));

$total_halaman = ceil($total_data / $batas);

/* QUERY DATA */
$query = mysqli_query($koneksi,"
SELECT p.*, a.nama, b.judul
FROM peminjaman p
JOIN anggota a ON p.id_anggota=a.id_anggota
JOIN buku b ON p.id_buku=b.id_buku
WHERE a.nama LIKE '%$cari%'
OR b.judul LIKE '%$cari%'
ORDER BY p.id_pinjam DESC
LIMIT $mulai,$batas
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Peminjaman</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<div class="d-flex justify-content-between mb-3">
    <h3>📚 Data Peminjaman</h3>

    <div>
        <a href="../dashboard.php" class="btn btn-secondary">
            🏠 Dashboard
        </a>

        <a href="tambah.php" class="btn btn-primary">
            + Peminjaman
        </a> 

        <a href="../laporan/export_excel.php"
           class="btn btn-success">
           Export Excel
        </a>
    </div>
</div>


</div>

</div>

</form>

<table class="table table-bordered table-striped">

<tr class="table-dark">
    <th>No</th>
    <th>Anggota</th>
    <th>Buku</th>
    <th>Tgl Pinjam</th>
    <th>Batas Kembali</th>
    <th>Status</th>
    <th>Denda</th>
    <th>Aksi</th>
</tr>

<?php
$no = $mulai + 1;

while($row=mysqli_fetch_assoc($query)){
?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama']; ?></td>

<td><?= $row['judul']; ?></td>
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
?><?php
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
<td><?= $row['tgl_pinjam']; ?></td>

<td><?= $row['tgl_kembali']; ?></td>

<td>

<?php if($row['status']=="Pinjam"){ ?>

<span class="badge bg-warning">
Pinjam
</span>

<?php } elseif($row['status']=="Kembali"){ ?>

<span class="badge bg-success">
Kembali
</span>

<?php } else { ?>

<span class="badge bg-danger">
Terlambat
</span>

<?php } ?>

</td>

<td>
Rp <?= number_format($row['denda']); ?>
</td>

<td>

<?php if($row['status']=="Pinjam"){ ?>

<a href="pengembalian.php?id=<?= $row['id_pinjam']; ?>"
class="btn btn-success btn-sm">
Kembalikan
</a>

<?php } ?>

 <a href="edit.php?id=<?= $row['id_pinjam']; ?>"
       class="btn btn-warning btn-sm">
    <i class="bi bi-pencil-square"></i> ✏️Edit
</a>

   <a href="hapus.php?id=<?= $row['id_pinjam']; ?>"
   class="btn btn-danger btn-sm"
   onclick="return confirm('Yakin hapus data ini?')">
    🗑 Hapus
</a>

</td>

</tr>

<?php } ?>

</table>

<!-- PAGINATION -->
<nav>

<?php for($i=1;$i<=$total_halaman;$i++){ ?>

<a href="?hal=<?= $i ?>&cari=<?= $cari ?>"
class="btn btn-sm <?= ($halaman==$i)?'btn-primary':'btn-outline-primary'; ?>">
<?= $i ?>
</a>

<?php } ?>

</nav>

</div>

</body>
</html>