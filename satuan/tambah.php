<?php
include __DIR__ . '/../config.php';

if(isset($_POST['simpan'])){

    $nama_satuan = mysqli_real_escape_string($conn, $_POST['nama_satuan']);

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_satuan
        WHERE nama_satuan='$nama_satuan'
    ");

    if(mysqli_num_rows($cek) > 0){

        echo "
        <script>
            alert('Satuan sudah ada');
            window.history.back();
        </script>
        ";

    }else{

        mysqli_query($conn,"
            INSERT INTO tabel_satuan(nama_satuan)
            VALUES ('$nama_satuan')
        ");

        echo "
        <script>
            alert('Satuan berhasil disimpan');
            window.location='halaman.php?menu=satuan';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">
            Tambah Satuan
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Nama Satuan
                    </label>

                    <input type="text"
                           name="nama_satuan"
                           class="form-control"
                           required>

                </div>

                <button type="submit"
                        name="simpan"
                        class="btn btn-success">

                    Simpan

                </button>

                <a href="halaman.php?menu=satuan"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>