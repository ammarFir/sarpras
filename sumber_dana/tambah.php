<?php
include __DIR__ . '/../config.php';

if(isset($_POST['simpan'])){

    $kode_sumber_dana = mysqli_real_escape_string($conn, $_POST['kode_sumber_dana']);
    $keterangan       = mysqli_real_escape_string($conn, $_POST['keterangan']);

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_sumber_dana
        WHERE kode_sumber_dana='$kode_sumber_dana'
    ");

    if(mysqli_num_rows($cek) > 0){

        echo "
        <script>
            alert('Kode sumber dana sudah digunakan');
            window.history.back();
        </script>
        ";

    }else{

        mysqli_query($conn,"
            INSERT INTO tabel_sumber_dana(
                kode_sumber_dana,
                keterangan
            ) VALUES (
                '$kode_sumber_dana',
                '$keterangan'
            )
        ");

        echo "
        <script>
            alert('Sumber dana berhasil disimpan');
            window.location='halaman.php?menu=sumber_dana';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">
            Tambah Sumber Dana
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Kode Sumber Dana
                    </label>

                    <input type="text"
                           name="kode_sumber_dana"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Keterangan
                    </label>

                    <input type="text"
                           name="keterangan"
                           class="form-control"
                           required>

                </div>

                <button type="submit"
                        name="simpan"
                        class="btn btn-success">

                    Simpan

                </button>

                <a href="halaman.php?menu=sumber_dana"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>