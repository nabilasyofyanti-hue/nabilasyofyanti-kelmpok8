<?php
include "../koneksi.php";

$data=mysqli_query($koneksi,"
SELECT b.judul,
COUNT(*) jumlah
FROM peminjaman p
JOIN buku b ON p.id_buku=b.id_buku
GROUP BY p.id_buku
ORDER BY jumlah DESC
");
?>

<h3>Buku Paling Sering Dipinjam</h3>

<table border="1" cellpadding="10">

<tr>
<th>Judul Buku</th>
<th>Total Dipinjam</th>
</tr>

<?php while($d=mysqli_fetch_assoc($data)){ ?>

<tr>
<td><?= $d['judul']; ?></td>
<td><?= $d['jumlah']; ?></td>
</tr>

<?php } ?>

</table>