<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"
    SELECT *
    FROM tabel_satuan
    WHERE id_satuan='$id'
");

$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $nama_satuan = mysqli_real_escape_string($conn, $_POST['nama_satuan']);

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_satuan
        WHERE nama_satuan='$nama_satuan'
        AND id_satuan != '$id'
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
            UPDATE tabel_satuan
            SET nama_satuan='$nama_satuan'
            WHERE id_satuan='$id'
        ");

        echo "
        <script>
            alert('Satuan berhasil diupdate');
            window.location='halaman.php?menu=satuan';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            Edit Satuan
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Nama Satuan
                    </label>

                    <input type="text"
                           name="nama_satuan"
                           value="<?= htmlspecialchars($d['nama_satuan']); ?>"
                           class="form-control"
                           required>

                </div>

                <button type="submit"
                        name="update"
                        class="btn btn-warning">

                    Update

                </button>

                <a href="halaman.php?menu=satuan"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>