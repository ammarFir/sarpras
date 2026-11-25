<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

// HAPUS DATA PEMELIHARAAN
mysqli_query($conn,"
    DELETE FROM tabel_pemeliharaan
    WHERE id_pemeliharaan='$id'
");

echo "<script>
    alert('Data pemeliharaan berhasil dihapus');
    window.location='halaman.php?menu=pemeliharaan';
</script>";