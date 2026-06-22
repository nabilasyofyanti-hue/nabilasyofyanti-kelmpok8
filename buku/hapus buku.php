<?php
include "../koneksi.php";

if(isset($_GET['id'])){

    $id = $_GET['id'];

    // Hapus data peminjaman yang memakai buku ini
    mysqli_query($koneksi,"
    DELETE FROM peminjaman
    WHERE id_buku='$id'
    ");

    // Hapus buku
    $hapus = mysqli_query($koneksi,"
    DELETE FROM buku
    WHERE id_buku='$id'
    ");

    if($hapus){
        echo "<script>
        alert('Data buku berhasil dihapus');
        window.location='index.php';
        </script>";
    }else{
        echo mysqli_error($koneksi);
    }

}
?>