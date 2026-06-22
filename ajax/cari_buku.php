<?php
include "../koneksi.php";

$keyword=$_GET['keyword'];

$data=mysqli_query($koneksi,"
SELECT *
FROM buku
WHERE judul LIKE '%$keyword%'
");

while($row=mysqli_fetch_assoc($data)){
echo $row['judul']."<br>";
}
?>