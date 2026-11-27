<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"
    SELECT *
    FROM tabel_peminjaman
    WHERE id_peminjaman='$id'
");

$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $kode_peminjaman = mysqli_real_escape_string($conn, $_POST['kode_peminjaman']);
    $nama_peminjam   = mysqli_real_escape_string($conn, $_POST['nama_peminjam']);
    $id_sarana       = mysqli_real_escape_string($conn, $_POST['id_sarana']);
    $jumlah_pinjam   = (int) $_POST['jumlah_pinjam'];
    $tanggal_pinjam  = mysqli_real_escape_string($conn, $_POST['tanggal_pinjam']);
    $rencana_kembali = mysqli_real_escape_string($conn, $_POST['rencana_kembali']);

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_peminjaman
        WHERE kode_peminjaman='$kode_peminjaman'
        AND id_peminjaman != '$id'
    ");

    if(mysqli_num_rows($cek) > 0){

        echo "
        <script>
            alert('Kode Peminjaman sudah digunakan');
            window.history.back();
        </script>
        ";

    }else{

        mysqli_query($conn,"
            UPDATE tabel_peminjaman
            SET
                kode_peminjaman='$kode_peminjaman',
                nama_peminjam='$nama_peminjam',
                id_sarana='$id_sarana',
                jumlah_pinjam='$jumlah_pinjam',
                tanggal_pinjam='$tanggal_pinjam',
                rencana_kembali='$rencana_kembali'
            WHERE id_peminjaman='$id'
        ");

        echo "
        <script>
            alert('Data peminjaman berhasil diupdate');
            window.location='halaman.php?menu=peminjaman';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            Edit Peminjaman
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kode Peminjaman</label>
                            <input type="text" name="kode_peminjaman" value="<?= htmlspecialchars($d['kode_peminjaman']); ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Peminjam</label>
                            <input type="text" name="nama_peminjam" value="<?= htmlspecialchars($d['nama_peminjam']); ?>" class="form-control" required>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Barang (Sarana)</label>
                            <input type="text" name="id_sarana" value="<?= htmlspecialchars($d['id_sarana']); ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Jumlah Dipinjam</label>
                            <input type="number" name="jumlah_pinjam" value="<?= $d['jumlah_pinjam']; ?>" class="form-control" min="1" required>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" value="<?= $d['tanggal_pinjam']; ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Rencana Kembali</label>
                            <input type="date" name="rencana_kembali" value="<?= $d['rencana_kembali']; ?>" class="form-control" required>
                        </div>
                    </div>

                </div>

                <button type="submit" name="update" class="btn btn-warning">Update</button>
                <a href="halaman.php?menu=peminjaman" class="btn btn-secondary">Kembali</a>

            </form>

        </div>

    </div>

</div>