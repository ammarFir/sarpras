<?php
include __DIR__ . '/../config.php';

if(isset($_POST['simpan'])){

    $kode_kategori = mysqli_real_escape_string($conn, $_POST['kode_kategori']);
    $nama_kategori = mysqli_real_escape_string($conn, $_POST['nama_kategori']);

    // cek kode kategori
    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_kategori
        WHERE kode_kategori='$kode_kategori'
    ");

    if(mysqli_num_rows($cek) > 0){

        echo "
        <script>
            alert('Kode kategori sudah digunakan');
            window.history.back();
        </script>
        ";

    }else{

        mysqli_query($conn,"
            INSERT INTO tabel_kategori(
                kode_kategori,
                nama_kategori
            ) VALUES (
                '$kode_kategori',
                '$nama_kategori'
            )
        ");

        echo "
        <script>
            alert('Kategori berhasil disimpan');
            window.location='halaman.php?menu=kategori';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">
            Tambah Kategori
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Kode Kategori
                    </label>

                    <input type="text"
                           name="kode_kategori"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Nama Kategori
                    </label>

                    <input type="text"
                           name="nama_kategori"
                           class="form-control"
                           required>

                </div>

                <button type="submit"
                        name="simpan"
                        class="btn btn-success">

                    Simpan

                </button>

                <a href="halaman.php?menu=kategori"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>