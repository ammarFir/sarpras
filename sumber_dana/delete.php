<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

// CEK APAKAH SUMBER DANA DIPAKAI DI SARANA
$cek = mysqli_query($conn,"
    SELECT COUNT(*) as total
    FROM tabel_sarana
    WHERE id_sumber_dana='$id'
");

$row = mysqli_fetch_assoc($cek);

if ($row['total'] > 0) {

    echo "<script>
        alert('Sumber dana tidak bisa dihapus karena masih digunakan di data sarana!');
        window.location='halaman.php?menu=sumber_dana';
    </script>";

    exit;
}

// HAPUS SUMBER DANA
mysqli_query($conn,"
    DELETE FROM tabel_sumber_dana
    WHERE id_sumber_dana='$id'
");

echo "<script>
    alert('Sumber dana berhasil dihapus');
    window.location='halaman.php?menu=sumber_dana';
</script>";