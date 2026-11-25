<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

// HAPUS DATA MUTASI
mysqli_query($conn,"
    DELETE FROM tabel_mutasi
    WHERE id_mutasi='$id'
");

echo "<script>
    alert('Data mutasi berhasil dihapus');
    window.location='halaman.php?menu=mutasi';
</script>";