<?php
$koneksi = mysqli_connect("localhost","root","","db_perpus");

if(!$koneksi){
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>