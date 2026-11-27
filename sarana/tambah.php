<?php
include __DIR__ . '/../config.php';

if(isset($_POST['simpan'])){

    $kode_barang    = mysqli_real_escape_string($conn, $_POST['kode_barang']);
    $nama_barang    = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $merek_tipe     = mysqli_real_escape_string($conn, $_POST['merek_tipe']);
    $spesifikasi    = mysqli_real_escape_string($conn, $_POST['spesifikasi']);
    $tahun_pengadaan = mysqli_real_escape_string($conn, $_POST['tahun_pengadaan']);
    $harga_perolehan = mysqli_real_escape_string($conn, $_POST['harga_perolehan']);
    $jumlah         = (int) $_POST['jumlah'];
    $kondisi        = mysqli_real_escape_string($conn, $_POST['kondisi']);
    $id_kategori    = mysqli_real_escape_string($conn, $_POST['id_kategori']);
    $id_ruangan     = mysqli_real_escape_string($conn, $_POST['id_ruangan']);
    $id_sumber_dana = mysqli_real_escape_string($conn, $_POST['id_sumber_dana']);
    $keterangan     = mysqli_real_escape_string($conn, $_POST['keterangan']);

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_sarana
        WHERE kode_barang='$kode_barang'
    ");

    if(mysqli_num_rows($cek) > 0){

        echo "
        <script>
            alert('Kode barang sudah digunakan');
            window.history.back();
        </script>
        ";

    }else{

        mysqli_query($conn,"
            INSERT INTO tabel_sarana(
                kode_barang,
                nama_barang,
                merek_tipe,
                spesifikasi,
                tahun_pengadaan,
                harga_perolehan,
                jumlah,
                kondisi,
                id_kategori,
                id_ruangan,
                id_sumber_dana,
                keterangan  
            ) VALUES (
                '$kode_barang',
                '$nama_barang',
                '$merek_tipe',
                '$spesifikasi',
                '$tahun_pengadaan',
                '$harga_perolehan',
                '$jumlah',
                '$kondisi',
                '$id_kategori',
                '$id_ruangan',
                '$id_sumber_dana',
                '$keterangan'
            )
        ");

        echo "
        <script>
            alert('Sarana berhasil disimpan');
            window.location='halaman.php?menu=sarana';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">
            Tambah Sarana
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" required>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Merek / Tipe</label>
                            <input type="text" name="merek_tipe" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Spesifikasi</label>
                            <input type="text" name="spesifikasi" class="form-control">
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tahun Pengadaan</label>
                            <input type="number" name="tahun_pengadaan" class="form-control" min="1900" max="2100">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Harga Perolehan</label>
                            <input type="number" name="harga_perolehan" class="form-control" step="0.01">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" min="1" value="1" required>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Kondisi</label>
                            <input type="text" name="kondisi" class="form-control" placeholder="Contoh: Baik / Rusak Ringan" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <input type="text" name="id_kategori" class="form-control" placeholder="Ketik nama kategori..." required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Ruangan</label>
                            <input type="text" name="id_ruangan" class="form-control" placeholder="Ketik nama ruangan..." required>
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label">Sumber Dana</label>
                    <input type="text" name="id_sumber_dana" class="form-control" placeholder="Ketik sumber dana..." required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan Tambahan</label>
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Opsional, isi jika ada catatan tambahan..."></textarea>
                </div>

                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                <a href="halaman.php?menu=sarana" class="btn btn-secondary">Kembali</a>

            </form>

        </div>

    </div>

</div>