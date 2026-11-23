<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"
    SELECT *
    FROM tabel_kategori
    WHERE id_kategori='$id'
");

$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $kode_kategori = mysqli_real_escape_string($conn, $_POST['kode_kategori']);
    $nama_kategori = mysqli_real_escape_string($conn, $_POST['nama_kategori']);

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_kategori
        WHERE kode_kategori='$kode_kategori'
        AND id_kategori != '$id'
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
            UPDATE tabel_kategori
            SET
                kode_kategori='$kode_kategori',
                nama_kategori='$nama_kategori'
            WHERE id_kategori='$id'
        ");

        echo "
        <script>
            alert('Kategori berhasil diupdate');
            window.location='halaman.php?menu=kategori';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            Edit Kategori
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Kode Kategori
                    </label>

                    <input type="text"
                           name="kode_kategori"
                           value="<?= htmlspecialchars($d['kode_kategori']); ?>"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Nama Kategori
                    </label>

                    <input type="text"
                           name="nama_kategori"
                           value="<?= htmlspecialchars($d['nama_kategori']); ?>"
                           class="form-control"
                           required>

                </div>

                <button type="submit"
                        name="update"
                        class="btn btn-warning">

                    Update

                </button>

                <a href="halaman.php?menu=kategori"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>