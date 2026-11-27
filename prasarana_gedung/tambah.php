<?php
include __DIR__ . '/../config.php';

if(isset($_POST['simpan'])){

    $kode_gedung    = mysqli_real_escape_string($conn, $_POST['kode_gedung']);
    $nama_gedung    = mysqli_real_escape_string($conn, $_POST['nama_gedung']);
    $luas_bangunan  = mysqli_real_escape_string($conn, $_POST['luas_bangunan']);
    $tahun_dibangun = mysqli_real_escape_string($conn, $_POST['tahun_dibangun']);
    $kondisi        = mysqli_real_escape_string($conn, $_POST['kondisi']);

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_prasarana_gedung
        WHERE kode_gedung='$kode_gedung'
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
            INSERT INTO tabel_prasarana_gedung(
                kode_gedung,
                nama_gedung,
                luas_bangunan,
                tahun_dibangun,
                kondisi
            ) VALUES (
                '$kode_gedung',
                '$nama_gedung',
                '$luas_bangunan',
                '$tahun_dibangun',
                '$kondisi'
            )
        ");

        echo "
        <script>
            alert('Data gedung berhasil disimpan');
            window.location='halaman.php?menu=prasarana_gedung';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">
            Tambah Data Gedung
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

                            
                            <input type="text"
                                   name="kondisi"
                                   class="form-control"
                                   placeholder="Contoh: Baik / Rusak Ringan"
                                   required>

                        </div>

                    </div>

                </div>

                <button type="submit"
                        name="simpan"
                        class="btn btn-success">

                    Simpan

                </button>

                <a href="halaman.php?menu=prasarana_gedung"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>