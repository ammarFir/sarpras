<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"
    SELECT *
    FROM tabel_mutasi
    WHERE id_mutasi='$id'
");

$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $tanggal_mutasi   = mysqli_real_escape_string($conn, $_POST['tanggal_mutasi']);
    $id_sarana        = mysqli_real_escape_string($conn, $_POST['id_sarana']);
    $id_ruangan_asal  = mysqli_real_escape_string($conn, $_POST['id_ruangan_asal']);
    $id_ruangan_tujuan = mysqli_real_escape_string($conn, $_POST['id_ruangan_tujuan']);
    $jumlah           = (int) $_POST['jumlah'];
    $alasan           = mysqli_real_escape_string($conn, $_POST['alasan']);

    mysqli_query($conn,"
        UPDATE tabel_mutasi
        SET
            tanggal_mutasi='$tanggal_mutasi',
            id_sarana='$id_sarana',
            id_ruangan_asal='$id_ruangan_asal',
            id_ruangan_tujuan='$id_ruangan_tujuan',
            jumlah='$jumlah',
            alasan='$alasan'
        WHERE id_mutasi='$id'
    ");

    echo "
    <script>
        alert('Data mutasi berhasil diupdate');
        window.location='halaman.php?menu=mutasi';
    </script>
    ";

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            Edit Mutasi Barang
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Mutasi</label>
                            <input type="date" name="tanggal_mutasi" value="<?= $d['tanggal_mutasi']; ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Jumlah Dipindah</label>
                            <input type="number" name="jumlah" value="<?= $d['jumlah']; ?>" class="form-control" min="1" required>
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Barang (Sarana)</label>
                    <input type="text" name="id_sarana" value="<?= htmlspecialchars($d['id_sarana']); ?>" class="form-control" required>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Ruangan Asal</label>
                            <input type="text" name="id_ruangan_asal" value="<?= htmlspecialchars($d['id_ruangan_asal'] ?? ''); ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Ruangan Tujuan</label>
                            <input type="text" name="id_ruangan_tujuan" value="<?= htmlspecialchars($d['id_ruangan_tujuan']); ?>" class="form-control" required>
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label">Alasan Pemindahan</label>
                    <textarea name="alasan" class="form-control" rows="3"><?= htmlspecialchars($d['alasan'] ?? ''); ?></textarea>
                </div>

                <button type="submit" name="update" class="btn btn-warning">Update</button>
                <a href="halaman.php?menu=mutasi" class="btn btn-secondary">Kembali</a>

            </form>

        </div>

    </div>

</div>