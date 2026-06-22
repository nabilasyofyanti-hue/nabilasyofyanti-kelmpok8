<?php

$kode = isset($_GET['kode'])
? $_GET['kode']
: 'B001';

?>

<h3>Barcode Buku</h3>

<img src="https://barcode.tec-it.com/barcode.ashx?data=<?= $kode; ?>">