<?php
session_start();
include "koneksi.php";
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

/* =======================
   STATISTIK (AMAN)
======================= */
$buku = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM buku"));
$anggota = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM anggota"));
$pinjam = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM peminjaman"));

/* =======================
   GRAFIK BULANAN (ANTI ERROR)
======================= */
$data_bulan = [];

for($i=1;$i<=12;$i++){

    $q = mysqli_query($koneksi,"
        SELECT COUNT(*) as total
        FROM peminjaman
        WHERE MONTH(tgl_pinjam) = '$i'
    ");

    // kalau query gagal
    if(!$q){
        $data_bulan[] = 0;
        continue;
    }

    $d = mysqli_fetch_assoc($q);

    $data_bulan[] = $d['total'] ?? 0;
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard Perpustakaan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{
    background:#FFEB99;
}

.sidebar{
    height:100vh;
    background:#FFC0CB;
    padding:20px;
    position:fixed;
    width:220px;
}

.sidebar a{
    display:block;
    color:white;
    padding:10px;
    text-decoration:none;
    margin-bottom:5px;
    border-radius:5px;
}

.sidebar a:hover{
    background:#0d6efd;
}

.content{
    margin-left:240px;
    padding:20px;
}

.card{
    border:none;
    border-radius:15px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}
</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

<h4 class="text-white">📚 PERPUS</h4>
<hr class="text-white">

<a href="dashboard.php">Dashboard</a>
<a href="anggota/index.php">Data Anggota</a>
<a href="buku/index.php">Data Buku</a>
<a href="peminjaman/index.php">Peminjaman</a>

<a href="laporan/peminjaman.php" class="btn btn-danger mt-3">
📄 Laporan Peminjaman
</a>

<a href="logout.php">Logout</a>

</div>

<!-- CONTENT -->
<div class="content">

<h2 class="mb-4">Dashboard Perpustakaan</h2>

<div class="row">

<div class="col-md-4">
<div class="card bg-primary text-white p-4">
<h5>Total Buku</h5>
<h1><?= $buku ?></h1>
</div>
</div>

<div class="col-md-4">
<div class="card bg-success text-white p-4">
<h5>Total Anggota</h5>
<h1><?= $anggota ?></h1>
</div>
</div>

<div class="col-md-4">
<div class="card bg-warning text-dark p-4">
<h5>Total Peminjaman</h5>
<h1><?= $pinjam ?></h1>
</div>
</div>

</div>

<!-- MENU -->
<div class="mt-4">

<a href="anggota/index.php" class="btn btn-primary">Kelola Anggota</a>
<a href="buku/index.php" class="btn btn-dark">Kelola Buku</a>
<a href="peminjaman/index.php" class="btn btn-success">Peminjaman</a>
<a href="laporan/export_excel.php" class="btn btn-info">Export Excel</a>

</div>

<!-- GRAFIK -->
<div class="card mt-4 p-4">

<h4>Grafik Peminjaman Buku</h4>

<canvas id="grafik"></canvas>

</div>

</div>

<script>
const ctx = document.getElementById('grafik');

new Chart(ctx,{
    type:'bar',
    data:{
        labels:[
            'Jan','Feb','Mar','Apr',
            'Mei','Jun','Jul','Ags',
            'Sep','Okt','Nov','Des'
        ],
        datasets:[{
            label:'Jumlah Peminjaman',
            data:[
                <?= implode(',', $data_bulan); ?>
            ]
        }]
    }
});
</script>

</body>
</html>