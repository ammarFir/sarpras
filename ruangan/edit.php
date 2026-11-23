<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"
    SELECT *
    FROM tabel_ruangan
    WHERE id_ruangan='$id'
");

$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $kode_ruangan     = mysqli_real_escape_string($conn, $_POST['kode_ruangan']);
    $nama_ruangan     = mysqli_real_escape_string($conn, $_POST['nama_ruangan']);
    $penanggung_jawab = mysqli_real_escape_string($conn, $_POST['penanggung_jawab']);

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_ruangan
        WHERE kode_ruangan='$kode_ruangan'
        AND id_ruangan != '$id'
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
            UPDATE tabel_ruangan
            SET
                kode_ruangan='$kode_ruangan',
                nama_ruangan='$nama_ruangan',
                penanggung_jawab='$penanggung_jawab'
            WHERE id_ruangan='$id'
        ");

        echo "
        <script>
            alert('Ruangan berhasil diupdate');
            window.location='halaman.php?menu=ruangan';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            Edit Ruangan
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Kode Ruangan
                    </label>

                    <input type="text"
                           name="kode_ruangan"
                           value="<?= htmlspecialchars($d['kode_ruangan']); ?>"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Nama Ruangan
                    </label>

                    <input type="text"
                           name="nama_ruangan"
                           value="<?= htmlspecialchars($d['nama_ruangan']); ?>"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Penanggung Jawab
                    </label>

                    <input type="text"
                           name="penanggung_jawab"
                           value="<?= htmlspecialchars($d['penanggung_jawab'] ?? ''); ?>"
                           class="form-control">

                </div>

                <button type="submit"
                        name="update"
                        class="btn btn-warning">

                    Update

                </button>

                <a href="halaman.php?menu=ruangan"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>