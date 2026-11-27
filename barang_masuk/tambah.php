<?php
include __DIR__ . '/../config.php';

if(isset($_POST['simpan'])){

    $no_transaksi   = mysqli_real_escape_string($conn, $_POST['no_transaksi']);
    $tanggal_masuk  = mysqli_real_escape_string($conn, $_POST['tanggal_masuk']);
    $id_sarana      = mysqli_real_escape_string($conn, $_POST['id_sarana']);
    $jumlah_masuk   = (int) $_POST['jumlah_masuk'];
    $id_sumber_dana = mysqli_real_escape_string($conn, $_POST['id_sumber_dana']);

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_barang_masuk
        WHERE no_transaksi='$no_transaksi'
    ");

    if(mysqli_num_rows($cek) > 0){

        echo "
        <script>
            alert('No. Transaksi sudah digunakan');
            window.history.back();
        </script>
        ";

    }else{

        mysqli_query($conn,"
            INSERT INTO tabel_barang_masuk(
                no_transaksi,
                tanggal_masuk,
                id_sarana,
                jumlah_masuk,
                id_sumber_dana
            ) VALUES (
                '$no_transaksi',
                '$tanggal_masuk',
                '$id_sarana',
                '$jumlah_masuk',
                '$id_sumber_dana'
            )
        ");

        echo "
        <script>
            alert('Barang masuk berhasil disimpan');
            window.location='halaman.php?menu=barang_masuk';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">
            Tambah Barang Masuk
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">No. Transaksi</label>
                            <input type="text" name="no_transaksi" class="form-control" placeholder="Contoh: BM-20231124-001" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control" value="<?= date('Y-m-d'); ?>" required>
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
                            <label class="form-label">Jumlah Masuk</label>
                            <input type="number" name="jumlah_masuk" class="form-control" min="1" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Sumber Dana</label>
                            <input type="text" name="id_sumber_dana" class="form-control" placeholder="Ketik sumber dana..." required>
                        </div>
                    </div>

                </div>

                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                <a href="halaman.php?menu=barang_masuk" class="btn btn-secondary">Kembali</a>

            </form>

        </div>

    </div>

</div>