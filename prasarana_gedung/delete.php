<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

// HAPUS DATA GEDUNG
mysqli_query($conn,"
    DELETE FROM tabel_prasarana_gedung
    WHERE id_gedung='$id'
");

echo "<script>
    alert('Data gedung berhasil dihapus');
    window.location='halaman.php?menu=prasarana_gedung';
</script>";