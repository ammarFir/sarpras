<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

// CEK APAKAH RUANGAN DIPAKAI DI SARANA
$cek = mysqli_query($conn,"
    SELECT COUNT(*) as total
    FROM tabel_sarana
    WHERE id_ruangan='$id'
");

$row = mysqli_fetch_assoc($cek);

if ($row['total'] > 0) {

    echo "<script>
        alert('Ruangan tidak bisa dihapus karena masih digunakan di data sarana!');
        window.location='halaman.php?menu=ruangan';
    </script>";

    exit;
}

// HAPUS RUANGAN
mysqli_query($conn,"
    DELETE FROM tabel_ruangan
    WHERE id_ruangan='$id'
");

echo "<script>
    alert('Ruangan berhasil dihapus');
    window.location='halaman.php?menu=ruangan';
</script>";