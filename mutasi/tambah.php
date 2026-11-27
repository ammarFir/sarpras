<?php
include __DIR__ . '/../config.php';

if(isset($_POST['simpan'])){

    $tanggal_mutasi   = mysqli_real_escape_string($conn, $_POST['tanggal_mutasi']);
    $id_sarana        = mysqli_real_escape_string($conn, $_POST['id_sarana']);
    $id_ruangan_asal  = mysqli_real_escape_string($conn, $_POST['id_ruangan_asal']);
    $id_ruangan_tujuan = mysqli_real_escape_string($conn, $_POST['id_ruangan_tujuan']);
    $jumlah           = (int) $_POST['jumlah'];
    $alasan           = mysqli_real_escape_string($conn, $_POST['alasan']);

    // Simpan data mutasi
    mysqli_query($conn,"
        INSERT INTO tabel_mutasi(
            tanggal_mutasi,
            id_sarana,
            id_ruangan_asal,
            id_ruangan_tujuan,
            jumlah,
            alasan
        ) VALUES (
            '$tanggal_mutasi',
            '$id_sarana',
            '$id_ruangan_asal',
            '$id_ruangan_tujuan',
            '$jumlah',
            '$alasan'
        )
    ");

    echo "
    <script>
        alert('Data mutasi berhasil disimpan');
        window.location='halaman.php?menu=mutasi';
    </script>
    ";

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">
            Tambah Mutasi Barang
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Mutasi</label>
                            <input type="date" name="tanggal_mutasi" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Jumlah Dipindah</label>
                            <input type="number" name="jumlah" class="form-control" min="1" required>
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Barang (Sarana)</label>
                    <input type="text" name="id_sarana" class="form-control" placeholder="Ketik nama barang..." required>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Ruangan Asal</label>
                            <input type="text" name="id_ruangan_asal" class="form-control" placeholder="Ketik ruangan asal..." required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Ruangan Tujuan</label>
                            <input type="text" name="id_ruangan_tujuan" class="form-control" placeholder="Ketik ruangan tujuan..." required>
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label">Alasan Pemindahan</label>
                    <textarea name="alasan" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" name="simpan" class="btn btn-success">Simpan Mutasi</button>
                <a href="halaman.php?menu=mutasi" class="btn btn-secondary">Kembali</a>

            </form>

        </div>

    </div>

</div>