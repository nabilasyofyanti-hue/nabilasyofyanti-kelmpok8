<?php
include "../koneksi.php";

if(!isset($_GET['id'])){
    die("ID Peminjaman Tidak Ditemukan");
}

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT p.*, a.nama, b.judul
FROM peminjaman p
JOIN anggota a ON p.id_anggota=a.id_anggota
JOIN buku b ON p.id_buku=b.id_buku
WHERE p.id_pinjam='$id'
"));

if(!$data){
    die("Data Peminjaman Tidak Ditemukan");
}

$tanggal_hari_ini = date('Y-m-d');

$tgl_pinjam = $data['tgl_pinjam'];
$batas_kembali = $data['tgl_kembali'];

$lama_pinjam = floor(
    (strtotime($tanggal_hari_ini) - strtotime($tgl_pinjam))
    / 86400
);

$terlambat = floor(
    (strtotime($tanggal_hari_ini) - strtotime($batas_kembali))
    / 86400
);

if($terlambat > 0){
    $denda = $terlambat * 1000;
    $status = "Terlambat";
}else{
    $denda = 0;
    $status = "Kembali";
}

if(isset($_POST['simpan'])){

    mysqli_query($koneksi,"
    UPDATE peminjaman SET
    tgl_real_kembali='$tanggal_hari_ini',
    status='$status',
    denda='$denda'
    WHERE id_pinjam='$id'
    ");

    echo "
    <script>
        alert('Pengembalian Berhasil');
        window.location='index.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Pengembalian Buku</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-4">

<div class="card shadow">

<div class="card-header bg-success text-white">
    <h4>Pengembalian Buku</h4>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label>Nama Anggota</label>
<input type="text"
class="form-control"
value="<?= $data['nama']; ?>"
readonly>
</div>

<div class="mb-3">
<label>Judul Buku</label>
<input type="text"
class="form-control"
value="<?= $data['judul']; ?>"
readonly>
</div>

<div class="mb-3">
<label>Tanggal Pinjam</label>
<input type="date"
class="form-control"
value="<?= $tgl_pinjam; ?>"
readonly>
</div>

<div class="mb-3">
<label>Batas Kembali</label>
<input type="date"
class="form-control"
value="<?= $batas_kembali; ?>"
readonly>
</div>

<div class="mb-3">
<label>Tanggal Dikembalikan</label>
<input type="date"
class="form-control"
value="<?= $tanggal_hari_ini; ?>"
readonly>
</div>

<div class="mb-3">
<label>Lama Peminjaman</label>
<input type="text"
class="form-control"
value="<?= $lama_pinjam; ?> Hari"
readonly>
</div>

<div class="mb-3">
<label>Keterlambatan</label>
<input type="text"
class="form-control"
value="<?= ($terlambat > 0 ? $terlambat : 0); ?> Hari"
readonly>
</div>

<div class="mb-3">
<label>Denda</label>
<input type="text"
class="form-control"
value="Rp <?= number_format($denda); ?>"
readonly>
</div>

<button type="submit"
name="simpan"
class="btn btn-success">
Simpan Pengembalian
</button>

<a href="index.php"
class="btn btn-secondary">
Kembali
</a>

</form>

</div>
</div>

</div>

</body>
</html>