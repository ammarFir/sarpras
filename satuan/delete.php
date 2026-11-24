<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

// CEK APAKAH SATUAN DIPAKAI DI SARANA
$cek = mysqli_query($conn,"
    SELECT COUNT(*) as total
    FROM tabel_sarana
    WHERE id_satuan='$id'
");

$row = mysqli_fetch_assoc($cek);

if ($row['total'] > 0) {

    echo "<script>
        alert('Satuan tidak bisa dihapus karena masih digunakan di data sarana!');
        window.location='halaman.php?menu=satuan';
    </script>";

    exit;
}

// HAPUS SATUAN
mysqli_query($conn,"
    DELETE FROM tabel_satuan
    WHERE id_satuan='$id'
");

echo "<script>
    alert('Satuan berhasil dihapus');
    window.location='halaman.php?menu=satuan';
</script>";