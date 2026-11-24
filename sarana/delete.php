<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

// CEK APAKAH SARANA DIPAKAI DI PEMINJAMAN
$cek = mysqli_query($conn,"
    SELECT COUNT(*) as total
    FROM tabel_peminjaman
    WHERE id_sarana='$id'
");

$row = mysqli_fetch_assoc($cek);

if ($row['total'] > 0) {

    echo "<script>
        alert('Sarana tidak bisa dihapus karena masih ada data peminjaman!');
        window.location='halaman.php?menu=sarana';
    </script>";

    exit;
}

// HAPUS SARANA
mysqli_query($conn,"
    DELETE FROM tabel_sarana
    WHERE id_sarana='$id'
");

echo "<script>
    alert('Sarana berhasil dihapus');
    window.location='halaman.php?menu=sarana';
</script>";