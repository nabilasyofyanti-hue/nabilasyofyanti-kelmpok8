<?php
include "../koneksi.php";

$data=mysqli_query($koneksi,"
SELECT p.*,a.nama,b.judul
FROM peminjaman p
JOIN anggota a ON p.id_anggota=a.id_anggota
JOIN buku b ON p.id_buku=b.id_buku
WHERE denda > 0
");
?>

<h3>Laporan Denda</h3>

<table border="1">

<tr>
<th>Nama</th>
<th>Buku</th>
<th>Denda</th>
</tr>

<?php while($d=mysqli_fetch_assoc($data)){ ?>

<tr>
<td><?= $d['nama']; ?></td>
<td><?= $d['judul']; ?></td>
<td>Rp <?= number_format($d['denda']); ?></td>
</tr>

<?php } ?>

</table>