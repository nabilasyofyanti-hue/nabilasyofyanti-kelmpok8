<?php
include "../koneksi.php";

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

$data = mysqli_query($koneksi,"
SELECT *
FROM buku
WHERE judul LIKE '%$cari%'
ORDER BY id_buku DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>📚 Data Buku</h3>

    <div>
        <a href="../dashboard.php" class="btn btn-secondary">🏠 Dashboard</a>
        <a href="tambah.php" class="btn btn-primary">+ Tambah Buku</a>
    </div>
</div>

<!-- SEARCH -->
<form method="GET" class="mb-3">
    <input type="text" name="cari" class="form-control"
           placeholder="Cari judul buku..."
           value="<?= $cari; ?>"> 
           
</form>

<table class="table table-bordered table-striped">

<tr class="table-dark">
    <th>No</th>
    <th>Kode Buku</th>
    <th>ISBN</th>
    <th>Judul</th>
    <th>Pengarang</th>
    <th>Penerbit</th>
    <th>Tahun</th>
    <th>Kategori</th>
    <th>Rak</th>
    <th>Stok</th>
    <th>Aksi</th>
    <th>Barkode</th>
</tr>

<?php
$no = 1;
while($row = mysqli_fetch_assoc($data)){
?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $row['kode_buku']; ?></td>
    <td><?= $row['isbn']; ?></td>
    <td><?= $row['judul']; ?></td>
    <td><?= $row['pengarang']; ?></td>
    <td><?= $row['penerbit']; ?></td>
    <td><?= $row['tahun_terbit']; ?></td>
    <td><?= $row['kategori']; ?></td>
    <td><?= $row['rak']; ?></td>
    <td><?= $row['stok']; ?></td>

    <td>

    <a href="edit.php?id=<?= $row['id_buku']; ?>"
       class="btn btn-warning btn-sm">
        <i class="bi bi-pencil-square"></i> ✏️ Edit
    </a>

    <a href="hapus.php?id=<?= $row['id_buku']; ?>"
       class="btn btn-danger btn-sm"
       onclick="return confirm('Yakin hapus data ini?')">
        <i class="bi bi-trash"></i> 🗑 Hapus
    </a>

</td>
    <td>
    <svg id="barcode<?= $row['id_buku']; ?>"></svg>

    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>

    <script>
        JsBarcode("#barcode<?= $row['id_buku']; ?>",
        "<?= $row['kode_buku']; ?>", {
            format: "CODE128",
            lineColor: "#000",
            width: 2,
            height: 15,
            displayValue: true
        });
    </script>
</td>
    
</tr>

<?php } ?>

</table>

</div>

</body>
</html>