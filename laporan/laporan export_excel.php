<?php
include "../koneksi.php";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_peminjaman.xls");
?>

<table border="1">

<tr>
<th>ID</th>
<th>Nama</th>
<th>Buku</th>
<th>Tanggal Pinjam</th>
<th>Status</th>
</tr>

<?php

$query=mysqli_query($koneksi,"
SELECT p.*,a.nama,b.judul
FROM peminjaman p
JOIN anggota a ON p.id_anggota=a.id_anggota
JOIN buku b ON p.id_buku=b.id_buku
");

while($row=mysqli_fetch_assoc($query)){
?>

<tr>
<td><?= $row['id_pinjam']; ?></td>
<td><?= $row['nama']; ?></td>
<td><?= $row['judul']; ?></td>
<td><?= $row['tgl_pinjam']; ?></td>
<td><?= $row['status']; ?></td>
</tr>

<?php } ?>

</table>