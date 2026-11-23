<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

// CEK APAKAH KATEGORI DIPAKAI DI SARANA
$cek = mysqli_query($conn,"
    SELECT COUNT(*) as total
    FROM tabel_sarana
    WHERE id_kategori='$id'
");

$row = mysqli_fetch_assoc($cek);

if ($row['total'] > 0) {

    echo "<script>
        alert('Kategori tidak bisa dihapus karena masih digunakan di data sarana!');
        window.location='halaman.php?menu=kategori';
    </script>";

    exit;
}

// HAPUS KATEGORI
mysqli_query($conn,"
    DELETE FROM tabel_kategori
    WHERE id_kategori='$id'
");

echo "<script>
    alert('Kategori berhasil dihapus');
    window.location='halaman.php?menu=kategori';
</script>";