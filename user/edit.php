<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

// Ambil data user
$data = mysqli_query($conn,"
    SELECT *
    FROM tabel_user
    WHERE id_user='$id'
");

$d = mysqli_fetch_assoc($data);

// Proses update
if(isset($_POST['update'])){

    $nama      = mysqli_real_escape_string($conn, $_POST['nama']);
    $nip_nik   = mysqli_real_escape_string($conn, $_POST['nip_nik']);
    $username  = mysqli_real_escape_string($conn, $_POST['username']);
    $hak_akses = mysqli_real_escape_string($conn, $_POST['hak_akses']);
    $password  = $_POST['password'];

    // cek username selain user sendiri
    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_user
        WHERE username='$username'
        AND id_user != '$id'
    ");

    if(mysqli_num_rows($cek) > 0){

        echo "
        <script>
            alert('Username sudah digunakan');
            window.history.back();
        </script>
        ";

    }else{

        // jika password diisi
        if(!empty($password)){

            mysqli_query($conn,"
                UPDATE tabel_user
                SET
                    nama='$nama',
                    nip_nik='$nip_nik',
                    username='$username',
                    password='$password',
                    hak_akses='$hak_akses'
                WHERE id_user='$id'
            ");

        }else{

            mysqli_query($conn,"
                UPDATE tabel_user
                SET
                    nama='$nama',
                    nip_nik='$nip_nik',
                    username='$username',
                    hak_akses='$hak_akses'
                WHERE id_user='$id'
            ");

        }

        echo "
        <script>
            alert('Data pengguna berhasil diupdate');
            window.location='halaman.php?menu=user';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            Edit Pengguna
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Nama Lengkap
                    </label>

                    <input type="text"
                           name="nama"
                           value="<?= htmlspecialchars($d['nama']); ?>"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        NIP / NIK
                    </label>

                    <input type="text"
                           name="nip_nik"
                           value="<?= htmlspecialchars($d['nip_nik'] ?? ''); ?>"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Username
                    </label>

                    <input type="text"
                           name="username"
                           value="<?= htmlspecialchars($d['username']); ?>"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Password Baru
                    </label>

                    <input type="password"
                           name="password"
                           class="form-control">

                    <small class="text-muted">
                        Kosongkan jika password tidak diubah
                    </small>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Hak Akses
                    </label>
                    <input type="text"
                           name="hak_akses"
                           value="<?= htmlspecialchars($d['hak_akses']); ?>"
                           class="form-control"
                           required>

                </div>

                <button type="submit"
                        name="update"
                        class="btn btn-warning">

                    Update

                </button>

                <a href="halaman.php?menu=user"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>