<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

// HAPUS DATA TANAH
mysqli_query($conn,"
    DELETE FROM tabel_prasarana_tanah
    WHERE id_tanah='$id'
");

echo "<script>
    alert('Data tanah berhasil dihapus');
    window.location='halaman.php?menu=prasarana_tanah';
</script>";