<?php
include "../koneksi.php";

$data=mysqli_query($koneksi,"
SELECT p.*,a.nama,b.judul
FROM peminjaman p
JOIN anggota a ON p.id_anggota=a.id_anggota
JOIN buku b ON p.id_buku=b.id_buku
WHERE status='Kembali'
");
?>

<h3>Laporan Pengembalian</h3>

<table border="1">

<tr>
<th>Nama</th>
<th>Buku</th>
<th>Tanggal Kembali</th>
</tr>

<?php while($d=mysqli_fetch_assoc($data)){ ?>

<tr>
<td><?= $d['nama']; ?></td>
<td><?= $d['judul']; ?></td>
<td><?= $d['tgl_real_kembali']; ?></td>
</tr>

<?php } ?>

</table>