<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

// Ambil data untuk mengembalikan stok jika penghapusan dibatalkan
$data = mysqli_query($conn,"
    SELECT id_sarana, jumlah 
    FROM tabel_penghapusan 
    WHERE id_penghapusan='$id'
");

$d = mysqli_fetch_assoc($data);

if($d){
    $id_sarana = $d['id_sarana'];
    $jumlah = $d['jumlah'];

    // Kembalikan stok ke tabel sarana
    mysqli_query($conn,"
        UPDATE tabel_sarana
        SET jumlah = jumlah + $jumlah
        WHERE id_sarana='$id_sarana'
    ");

    // HAPUS DATA PENGHAPUSAN
    mysqli_query($conn,"
        DELETE FROM tabel_penghapusan
        WHERE id_penghapusan='$id'
    ");
}

echo "<script>
    alert('Data penghapusan dibatalkan, stok barang telah dikembalikan');
    window.location='halaman.php?menu=penghapusan';
</script>";