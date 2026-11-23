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

    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $level    = mysqli_real_escape_string($conn, $_POST['level']);
    $password = $_POST['password'];

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

            $password = md5($password);

            mysqli_query($conn,"
                UPDATE tabel_user
                SET
                    nama='$nama',
                    username='$username',
                    password='$password',
                    level='$level'
                WHERE id_user='$id'
            ");

        }else{

            mysqli_query($conn,"
                UPDATE tabel_user
                SET
                    nama='$nama',
                    username='$username',
                    level='$level'
                WHERE id_user='$id'
            ");

        }

        echo "
        <script>
            alert('Data user berhasil diupdate');
            window.location='halaman.php?menu=user';
        </script>
        ";

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Edit User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body>

<div class="container-fluid mt-4">

    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            Edit User
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Nama
                    </label>

                    <input type="text"
                           name="nama"
                           value="<?= htmlspecialchars($d['nama']); ?>"
                           class="form-control"
                           required>

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
                        Level
                    </label>

                    <select name="level"
                            class="form-select"
                            required>

                        <option value="admin"
                            <?= ($d['level'] == 'admin') ? 'selected' : ''; ?>>

                            Admin

                        </option>

                        <option value="petugas"
                            <?= ($d['level'] == 'petugas') ? 'selected' : ''; ?>>

                            Petugas

                        </option>

                        <option value="pimpinan"
                            <?= ($d['level'] == 'pimpinan') ? 'selected' : ''; ?>>

                            Pimpinan

                        </option>

                    </select>

                </div>

                <button type="submit"
                        name="update"
                        class="btn btn-success">

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

</body>
</html>