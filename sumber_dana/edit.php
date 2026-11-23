<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"
    SELECT *
    FROM tabel_sumber_dana
    WHERE id_sumber_dana='$id'
");

$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $kode_sumber_dana = mysqli_real_escape_string($conn, $_POST['kode_sumber_dana']);
    $keterangan       = mysqli_real_escape_string($conn, $_POST['keterangan']);

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_sumber_dana
        WHERE kode_sumber_dana='$kode_sumber_dana'
        AND id_sumber_dana != '$id'
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
            UPDATE tabel_sumber_dana
            SET
                kode_sumber_dana='$kode_sumber_dana',
                keterangan='$keterangan'
            WHERE id_sumber_dana='$id'
        ");

        echo "
        <script>
            alert('Sumber dana berhasil diupdate');
            window.location='halaman.php?menu=sumber_dana';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            Edit Sumber Dana
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Kode Sumber Dana
                    </label>

                    <input type="text"
                           name="kode_sumber_dana"
                           value="<?= htmlspecialchars($d['kode_sumber_dana']); ?>"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Keterangan
                    </label>

                    <input type="text"
                           name="keterangan"
                           value="<?= htmlspecialchars($d['keterangan']); ?>"
                           class="form-control"
                           required>

                </div>

                <button type="submit"
                        name="update"
                        class="btn btn-warning">

                    Update

                </button>

                <a href="halaman.php?menu=sumber_dana"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>