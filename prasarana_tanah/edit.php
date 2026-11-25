<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"
    SELECT *
    FROM tabel_prasarana_tanah
    WHERE id_tanah='$id'
");

$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $kode_tanah        = mysqli_real_escape_string($conn, $_POST['kode_tanah']);
    $luas              = mysqli_real_escape_string($conn, $_POST['luas']);
    $status_kepemilikan = mysqli_real_escape_string($conn, $_POST['status_kepemilikan']);
    $nomor_sertifikat  = mysqli_real_escape_string($conn, $_POST['nomor_sertifikat']);
    $keterangan        = mysqli_real_escape_string($conn, $_POST['keterangan']);

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_prasarana_tanah
        WHERE kode_tanah='$kode_tanah'
        AND id_tanah != '$id'
    ");

    if(mysqli_num_rows($cek) > 0){

        echo "
        <script>
            alert('Kode tanah sudah digunakan');
            window.history.back();
        </script>
        ";

    }else{

        mysqli_query($conn,"
            UPDATE tabel_prasarana_tanah
            SET
                kode_tanah='$kode_tanah',
                luas='$luas',
                status_kepemilikan='$status_kepemilikan',
                nomor_sertifikat='$nomor_sertifikat',
                keterangan='$keterangan'
            WHERE id_tanah='$id'
        ");

        echo "
        <script>
            alert('Data tanah berhasil diupdate');
            window.location='halaman.php?menu=prasarana_tanah';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            Edit Data Tanah
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="row">

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Kode Tanah
                            </label>

                            <input type="text"
                                   name="kode_tanah"
                                   value="<?= htmlspecialchars($d['kode_tanah']); ?>"
                                   class="form-control"
                                   required>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Luas (m²)
                            </label>

                            <input type="number"
                                   name="luas"
                                   value="<?= htmlspecialchars($d['luas']); ?>"
                                   class="form-control"
                                   step="0.01"
                                   required>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Status Kepemilikan
                            </label>

                            <input type="text"
                                   name="status_kepemilikan"
                                   value="<?= htmlspecialchars($d['status_kepemilikan'] ?? ''); ?>"
                                   class="form-control">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Nomor Sertifikat
                            </label>

                            <input type="text"
                                   name="nomor_sertifikat"
                                   value="<?= htmlspecialchars($d['nomor_sertifikat'] ?? ''); ?>"
                                   class="form-control">

                        </div>

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Keterangan
                    </label>

                    <textarea name="keterangan"
                              class="form-control"
                              rows="3"><?= htmlspecialchars($d['keterangan'] ?? ''); ?></textarea>

                </div>

                <button type="submit"
                        name="update"
                        class="btn btn-warning">

                    Update

                </button>

                <a href="halaman.php?menu=prasarana_tanah"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>