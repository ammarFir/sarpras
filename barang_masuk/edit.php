<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"
    SELECT *
    FROM tabel_barang_masuk
    WHERE id_barang_masuk='$id'
");

$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $no_transaksi   = mysqli_real_escape_string($conn, $_POST['no_transaksi']);
    $tanggal_masuk  = mysqli_real_escape_string($conn, $_POST['tanggal_masuk']);
    $id_sarana      = mysqli_real_escape_string($conn, $_POST['id_sarana']);
    $jumlah_masuk   = (int) $_POST['jumlah_masuk'];
    $id_sumber_dana = mysqli_real_escape_string($conn, $_POST['id_sumber_dana']);

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_barang_masuk
        WHERE no_transaksi='$no_transaksi'
        AND id_barang_masuk != '$id'
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
            UPDATE tabel_barang_masuk
            SET
                no_transaksi='$no_transaksi',
                tanggal_masuk='$tanggal_masuk',
                id_sarana='$id_sarana',
                jumlah_masuk='$jumlah_masuk',
                id_sumber_dana='$id_sumber_dana'
            WHERE id_barang_masuk='$id'
        ");

        echo "
        <script>
            alert('Barang masuk berhasil diupdate');
            window.location='halaman.php?menu=barang_masuk';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            Edit Barang Masuk
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">No. Transaksi</label>
                            <input type="text" name="no_transaksi" value="<?= htmlspecialchars($d['no_transaksi']); ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" value="<?= $d['tanggal_masuk']; ?>" class="form-control" required>
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
                            <label class="form-label">Jumlah Masuk</label>
                            <input type="number" name="jumlah_masuk" value="<?= $d['jumlah_masuk']; ?>" class="form-control" min="1" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Sumber Dana</label>
                            <input type="text" name="id_sumber_dana" value="<?= htmlspecialchars($d['id_sumber_dana']); ?>" class="form-control" required>
                        </div>
                    </div>

                </div>

                <button type="submit" name="update" class="btn btn-warning">Update</button>
                <a href="halaman.php?menu=barang_masuk" class="btn btn-secondary">Kembali</a>

            </form>

        </div>

    </div>

</div>