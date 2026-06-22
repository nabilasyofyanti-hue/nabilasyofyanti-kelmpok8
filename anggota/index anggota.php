<?php
include "../koneksi.php";

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

/* PAGINATION */
$batas = 5;
$halaman = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$halaman = max($halaman, 1);

$mulai = ($halaman - 1) * $batas;

/* TOTAL DATA */
$totalQuery = mysqli_query($koneksi, "
    SELECT COUNT(*) as total 
    FROM anggota
    WHERE nama LIKE '%$cari%'
");

$totalData = mysqli_fetch_assoc($totalQuery);
$total = $totalData['total'];

$totalHalaman = ceil($total / $batas);

/* DATA */
$data = mysqli_query($koneksi, "
    SELECT *
    FROM anggota
    WHERE nama LIKE '%$cari%'
    ORDER BY id_anggota DESC
    LIMIT $mulai, $batas
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>📚 Data Anggota</h3>

        <div>
            <a href="tambah.php" class="btn btn-primary">+ Tambah Anggota</a>
            <a href="../dashboard.php" class="btn btn-secondary">🏠 Dashboard</a>
        </div>
    </div>

    <!-- SEARCH -->
    <form method="GET" class="mb-3">
        <input type="text" name="cari" class="form-control"
               placeholder="Cari nama anggota..."
               value="<?= $cari; ?>">
    </form>

    <!-- TABLE -->
    <table class="table table-bordered table-striped mt-3">
        <tr class="table-dark">
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Kelas</th>
            <th>Prodi</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>

        <?php $no = $mulai + 1; while ($d = mysqli_fetch_assoc($data)) { ?>

        <tr>
            <td><?= $no++; ?></td>
            <td><?= $d['kode_anggota']; ?></td>
            <td><?= $d['nama']; ?></td>
            <td><?= $d['nim']; ?></td>
            <td><?= $d['kelas']; ?></td>
            <td><?= $d['prodi']; ?></td>
            <td><?= $d['no_hp']; ?></td>

            <td>
                <a href="edit.php?id=<?= $d['id_anggota']; ?>" class="btn btn-warning btn-sm">✏️ Edit</a>
                <a href="hapus.php?id=<?= $d['id_anggota']; ?>" class="btn btn-danger btn-sm"
                   onclick="return confirm('Hapus data ini?')">🗑 Hapus</a>
            </td>
        </tr>

        <?php } ?>

    </table>

    <!-- PAGINATION -->
    <div class="mt-3">

        <?php for ($i = 1; $i <= $totalHalaman; $i++) { ?>

            <a href="?hal=<?= $i; ?>&cari=<?= $cari; ?>"
               class="btn btn-sm <?= ($i == $halaman) ? 'btn-primary' : 'btn-outline-primary'; ?>">
                <?= $i; ?>
            </a>

        <?php } ?>

    </div>

</div>

</body>
</html>