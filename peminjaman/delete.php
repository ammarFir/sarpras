<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

// HAPUS DATA PEMINJAMAN
mysqli_query($conn,"
    DELETE FROM tabel_peminjaman
    WHERE id_peminjaman='$id'
");

echo "<script>
    alert('Data peminjaman berhasil dihapus');
    window.location='halaman.php?menu=peminjaman';
</script>";