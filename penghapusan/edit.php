<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"
    SELECT *
    FROM tabel_penghapusan
    WHERE id_penghapusan='$id'
");

$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $tanggal_penghapusan = mysqli_real_escape_string($conn, $_POST['tanggal_penghapusan']);
    $id_sarana_lama      = $d['id_sarana'];
    $jumlah_lama         = $d['jumlah'];

    $id_sarana_baru      = mysqli_real_escape_string($conn, $_POST['id_sarana']);
    $jumlah_baru         = (int) $_POST['jumlah'];
    $alasan              = mysqli_real_escape_string($conn, $_POST['alasan']);
    $no_berita_acara     = mysqli_real_escape_string($conn, $_POST['no_berita_acara']);

    // LOGIKA SINKRONISASI STOK:
    // 1. Kembalikan stok lama (tambahkan lagi berdasarkan nama barang lama)
    mysqli_query($conn,"
        UPDATE tabel_sarana
        SET jumlah = jumlah + $jumlah_lama
        WHERE nama_barang='$id_sarana_lama'
    ");

    // 2. Kurangi stok baru (berdasarkan nama barang baru)
    mysqli_query($conn,"
        UPDATE tabel_sarana
        SET jumlah = jumlah - $jumlah_baru
        WHERE nama_barang='$id_sarana_baru'
    ");

    // 3. Update data penghapusan
    mysqli_query($conn,"
        UPDATE tabel_penghapusan
        SET
            tanggal_penghapusan='$tanggal_penghapusan',
            id_sarana='$id_sarana_baru',
            jumlah='$jumlah_baru',
            alasan='$alasan',
            no_berita_acara='$no_berita_acara'
        WHERE id_penghapusan='$id'
    ");

    echo "
    <script>
        alert('Data penghapusan berhasil diupdate, stok sarana telah disesuaikan');
        window.location='halaman.php?menu=penghapusan';
    </script>
    ";

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            Edit Penghapusan Aset
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Penghapusan</label>
                            <input type="date" name="tanggal_penghapusan" class="form-control" value="<?= $d['tanggal_penghapusan']; ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">No. Berita Acara</label>
                            <input type="text" name="no_berita_acara" class="form-control" value="<?= htmlspecialchars($d['no_berita_acara'] ?? ''); ?>" required>
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Barang (Sarana)</label>
                    <input type="text" name="id_sarana" class="form-control" value="<?= htmlspecialchars($d['id_sarana']); ?>" required>
                    <small class="text-muted">*Jika Anda mengganti barang, stok barang lama akan dikembalikan, dan stok barang baru akan dikurangi.</small>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Jumlah yang Dihapus</label>
                            <input type="number" name="jumlah" class="form-control" value="<?= $d['jumlah']; ?>" min="1" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Alasan Penghapusan</label>
                            <input type="text" name="alasan" class="form-control" value="<?= htmlspecialchars($d['alasan']); ?>" required>
                        </div>
                    </div>

                </div>

                <button type="submit" name="update" class="btn btn-warning">Update</button>
                <a href="halaman.php?menu=penghapusan" class="btn btn-secondary">Kembali</a>

            </form>

        </div>

    </div>

</div>