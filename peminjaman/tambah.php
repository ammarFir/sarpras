<?php
include __DIR__ . '/../config.php';

if(isset($_POST['simpan'])){

    $kode_peminjaman = mysqli_real_escape_string($conn, $_POST['kode_peminjaman']);
    $nama_peminjam   = mysqli_real_escape_string($conn, $_POST['nama_peminjam']);
    $id_sarana       = mysqli_real_escape_string($conn, $_POST['id_sarana']);
    $jumlah_pinjam   = (int) $_POST['jumlah_pinjam'];
    $tanggal_pinjam  = mysqli_real_escape_string($conn, $_POST['tanggal_pinjam']);
    $rencana_kembali = mysqli_real_escape_string($conn, $_POST['rencana_kembali']);
    $status          = 'Dipinjam';

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_peminjaman
        WHERE kode_peminjaman='$kode_peminjaman'
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
            INSERT INTO tabel_peminjaman(
                kode_peminjaman,
                nama_peminjam,
                id_sarana,
                jumlah_pinjam,
                tanggal_pinjam,
                rencana_kembali,
                status
            ) VALUES (
                '$kode_peminjaman',
                '$nama_peminjam',
                '$id_sarana',
                '$jumlah_pinjam',
                '$tanggal_pinjam',
                '$rencana_kembali',
                '$status'
            )
        ");

        echo "
        <script>
            alert('Peminjaman berhasil disimpan');
            window.location='halaman.php?menu=peminjaman';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">
            Tambah Peminjaman
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kode Peminjaman</label>
                            <input type="text" name="kode_peminjaman" class="form-control" placeholder="Contoh: PJM-20231124-001" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Peminjam</label>
                            <input type="text" name="nama_peminjam" class="form-control" placeholder="Guru / Siswa / Staf" required>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Barang (Sarana)</label>
                            <input type="text" name="id_sarana" class="form-control" placeholder="Ketik nama barang..." required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Jumlah Dipinjam</label>
                            <input type="number" name="jumlah_pinjam" class="form-control" min="1" required>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Rencana Kembali</label>
                            <input type="date" name="rencana_kembali" class="form-control" value="<?= date('Y-m-d', strtotime('+3 days')); ?>" required>
                        </div>
                    </div>

                </div>

                <button type="submit" name="simpan" class="btn btn-success">Simpan Peminjaman</button>
                <a href="halaman.php?menu=peminjaman" class="btn btn-secondary">Kembali</a>

            </form>

        </div>

    </div>

</div>