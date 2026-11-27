<?php
include __DIR__ . '/../config.php';

if(isset($_POST['simpan'])){

    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $nip_nik  = mysqli_real_escape_string($conn, $_POST['nip_nik']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $hak_akses = mysqli_real_escape_string($conn, $_POST['hak_akses']);

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
                nip_nik,
                username,
                password,
                hak_akses
            ) VALUES (
                '$nama',
                '$nip_nik',
                '$username',
                '$password',
                '$hak_akses'
            )
        ");

        echo "
        <script>
            alert('Data pengguna berhasil disimpan');
            window.location='halaman.php?menu=user';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">
            Tambah Pengguna
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Nama Lengkap
                    </label>

                    <input type="text"
                           name="nama"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        NIP / NIK
                    </label>

                    <input type="text"
                           name="nip_nik"
                           class="form-control">

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
                        Hak Akses
                    </label>


                                        <input type="text"
                           name="hak_akses"
                           class="form-control"
                           placeholder="Contoh: Admin / Umum"
                           required>

                </div>

                <button type="submit"
                        name="simpan"
                        class="btn btn-success">

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