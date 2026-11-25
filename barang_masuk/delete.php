<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

// Ambil data untuk hapus file nota jika ada
$data = mysqli_query($conn,"
    SELECT bukti_nota
    FROM tabel_barang_masuk
    WHERE id_barang_masuk='$id'
");

$d = mysqli_fetch_assoc($data);

if($d && $d['bukti_nota']){
    $file_path = __DIR__ . "/../assets/uploads/" . $d['bukti_nota'];
    if(file_exists($file_path)){
        unlink($file_path);
    }
}

// HAPUS DATA
mysqli_query($conn,"
    DELETE FROM tabel_barang_masuk
    WHERE id_barang_masuk='$id'
");

echo "<script>
    alert('Barang masuk berhasil dihapus');
    window.location='halaman.php?menu=barang_masuk';
</script>";