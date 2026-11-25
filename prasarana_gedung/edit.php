<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"
    SELECT *
    FROM tabel_prasarana_gedung
    WHERE id_gedung='$id'
");

$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $kode_gedung    = mysqli_real_escape_string($conn, $_POST['kode_gedung']);
    $nama_gedung    = mysqli_real_escape_string($conn, $_POST['nama_gedung']);
    $luas_bangunan  = mysqli_real_escape_string($conn, $_POST['luas_bangunan']);
    $tahun_dibangun = mysqli_real_escape_string($conn, $_POST['tahun_dibangun']);
    $kondisi        = mysqli_real_escape_string($conn, $_POST['kondisi']);

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_prasarana_gedung
        WHERE kode_gedung='$kode_gedung'
        AND id_gedung != '$id'
    ");

    if(mysqli_num_rows($cek) > 0){

        echo "
        <script>
            alert('Kode gedung sudah digunakan');
            window.history.back();
        </script>
        ";

    }else{

        mysqli_query($conn,"
            UPDATE tabel_prasarana_gedung
            SET
                kode_gedung='$kode_gedung',
                nama_gedung='$nama_gedung',
                luas_bangunan='$luas_bangunan',
                tahun_dibangun='$tahun_dibangun',
                kondisi='$kondisi'
            WHERE id_gedung='$id'
        ");

        echo "
        <script>
            alert('Data gedung berhasil diupdate');
            window.location='halaman.php?menu=prasarana_gedung';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            Edit Data Gedung
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="row">

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Kode Gedung
                            </label>

                            <input type="text"
                                   name="kode_gedung"
                                   value="<?= htmlspecialchars($d['kode_gedung']); ?>"
                                   class="form-control"
                                   required>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Nama Gedung
                            </label>

                            <input type="text"
                                   name="nama_gedung"
                                   value="<?= htmlspecialchars($d['nama_gedung']); ?>"
                                   class="form-control"
                                   required>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">

                        <div class="mb-3">

                            <label class="form-label">
                                Luas Bangunan (m²)
                            </label>

                            <input type="number"
                                   name="luas_bangunan"
                                   value="<?= htmlspecialchars($d['luas_bangunan'] ?? ''); ?>"
                                   class="form-control"
                                   step="0.01">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="mb-3">

                            <label class="form-label">
                                Tahun Dibangun
                            </label>

                            <input type="number"
                                   name="tahun_dibangun"
                                   value="<?= htmlspecialchars($d['tahun_dibangun'] ?? ''); ?>"
                                   class="form-control"
                                   min="1900"
                                   max="2100">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="mb-3">

                            <label class="form-label">
                                Kondisi
                            </label>

                            <select name="kondisi"
                                    class="form-select"
                                    required>

                                <option value="Baik"
                                    <?= ($d['kondisi'] == 'Baik') ? 'selected' : ''; ?>>
                                    Baik
                                </option>

                                <option value="Rusak Ringan"
                                    <?= ($d['kondisi'] == 'Rusak Ringan') ? 'selected' : ''; ?>>
                                    Rusak Ringan
                                </option>

                                <option value="Rusak Berat"
                                    <?= ($d['kondisi'] == 'Rusak Berat') ? 'selected' : ''; ?>>
                                    Rusak Berat
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                <button type="submit"
                        name="update"
                        class="btn btn-warning">

                    Update

                </button>

                <a href="halaman.php?menu=prasarana_gedung"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>