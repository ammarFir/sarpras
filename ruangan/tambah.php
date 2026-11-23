<?php
include __DIR__ . '/../config.php';

if(isset($_POST['simpan'])){

    $kode_ruangan     = mysqli_real_escape_string($conn, $_POST['kode_ruangan']);
    $nama_ruangan     = mysqli_real_escape_string($conn, $_POST['nama_ruangan']);
    $penanggung_jawab = mysqli_real_escape_string($conn, $_POST['penanggung_jawab']);

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_ruangan
        WHERE kode_ruangan='$kode_ruangan'
    ");

    if(mysqli_num_rows($cek) > 0){

        echo "
        <script>
            alert('Kode ruangan sudah digunakan');
            window.history.back();
        </script>
        ";

    }else{

        mysqli_query($conn,"
            INSERT INTO tabel_ruangan(
                kode_ruangan,
                nama_ruangan,
                penanggung_jawab
            ) VALUES (
                '$kode_ruangan',
                '$nama_ruangan',
                '$penanggung_jawab'
            )
        ");

        echo "
        <script>
            alert('Ruangan berhasil disimpan');
            window.location='halaman.php?menu=ruangan';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">
            Tambah Ruangan
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Kode Ruangan
                    </label>

                    <input type="text"
                           name="kode_ruangan"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Nama Ruangan
                    </label>

                    <input type="text"
                           name="nama_ruangan"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Penanggung Jawab
                    </label>

                    <input type="text"
                           name="penanggung_jawab"
                           class="form-control">

                </div>

                <button type="submit"
                        name="simpan"
                        class="btn btn-success">

                    Simpan

                </button>

                <a href="halaman.php?menu=ruangan"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>