<?php
include "../koneksi.php";

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

$data = mysqli_query($koneksi, "
SELECT *
FROM anggota
WHERE nama_anggota LIKE '%$keyword%'
ORDER BY id_anggota DESC
");

while($row = mysqli_fetch_assoc($data)){
    echo $row['nama_anggota']."<br>";
}
?>