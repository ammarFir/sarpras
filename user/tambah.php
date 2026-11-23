<?php
include __DIR__ . '/../config.php';

if(isset($_POST['simpan'])){

    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);
    $level    = mysqli_real_escape_string($conn, $_POST['level']);

    // cek username
    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_user
        WHERE username='$username'
    ");

    if(mysqli_num_rows($cek) > 0){

        echo "
        <script>
            alert('Username sudah digunakan');
            window.history.back();
        </script>
        ";

    }else{

        mysqli_query($conn,"
            INSERT INTO tabel_user(
                nama,
                username,
                password,
                level
            ) VALUES (
                '$nama',
                '$username',
                '$password',
                '$level'
            )
        ");

        echo "
        <script>
            alert('Data user berhasil disimpan');
            window.location='halaman.php?menu=user';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            Tambah User
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Nama
                    </label>

                    <input type="text"
                           name="nama"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Username
                    </label>

                    <input type="text"
                           name="username"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Password
                    </label>

                    <input type="password"
                           name="password"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Level
                    </label>

                    <select name="level"
                            class="form-select"
                            required>

                        <option value="">
                            -- Pilih Level --
                        </option>

                        <option value="admin">
                            Admin
                        </option>

                        <option value="petugas">
                            Petugas
                        </option>

                        <option value="pimpinan">
                            Pimpinan
                        </option>

                    </select>

                </div>

                <button type="submit"
                        name="simpan"
                        class="btn btn-primary">

                    Simpan

                </button>

                <a href="halaman.php?menu=user"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>