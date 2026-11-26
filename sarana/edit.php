<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"
    SELECT *
    FROM tabel_sarana
    WHERE id_sarana='$id'
");

$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $kode_barang    = mysqli_real_escape_string($conn, $_POST['kode_barang']);
    $nama_barang    = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $merek_tipe     = mysqli_real_escape_string($conn, $_POST['merek_tipe']);
    $spesifikasi    = mysqli_real_escape_string($conn, $_POST['spesifikasi']);
    $tahun_pengadaan = mysqli_real_escape_string($conn, $_POST['tahun_pengadaan']);
    $harga_perolehan = mysqli_real_escape_string($conn, $_POST['harga_perolehan']);
    $jumlah         = (int) $_POST['jumlah'];
    $kondisi        = mysqli_real_escape_string($conn, $_POST['kondisi']);
    $id_kategori    = (int) $_POST['id_kategori'];
    $id_ruangan     = (int) $_POST['id_ruangan'];
    $id_sumber_dana = (int) $_POST['id_sumber_dana'];
    $keterangan     = mysqli_real_escape_string($conn, $_POST['keterangan'] ?? '');

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_sarana
        WHERE kode_barang='$kode_barang'
        AND id_sarana != '$id'
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
            UPDATE tabel_sarana
            SET
                kode_barang='$kode_barang',
                nama_barang='$nama_barang',
                merek_tipe='$merek_tipe',
                spesifikasi='$spesifikasi',
                tahun_pengadaan='$tahun_pengadaan',
                harga_perolehan='$harga_perolehan',
                jumlah='$jumlah',
                kondisi='$kondisi',
                id_kategori='$id_kategori',
                id_ruangan='$id_ruangan',
                id_sumber_dana='$id_sumber_dana',
                keterangan='$keterangan'
            WHERE id_sarana='$id'
        ");

        echo "
        <script>
            alert('Sarana berhasil diupdate');
            window.location='halaman.php?menu=sarana';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            Edit Sarana
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kode Barang</label>
                            <input type="text" name="kode_barang" value="<?= htmlspecialchars($d['kode_barang']); ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" value="<?= htmlspecialchars($d['nama_barang']); ?>" class="form-control" required>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Merek / Tipe</label>
                            <input type="text" name="merek_tipe" value="<?= htmlspecialchars($d['merek_tipe'] ?? ''); ?>" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Spesifikasi</label>
                            <input type="text" name="spesifikasi" value="<?= htmlspecialchars($d['spesifikasi'] ?? ''); ?>" class="form-control">
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tahun Pengadaan</label>
                            <input type="number" name="tahun_pengadaan" value="<?= htmlspecialchars($d['tahun_pengadaan'] ?? ''); ?>" class="form-control" min="1900" max="2100">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Harga Perolehan</label>
                            <input type="number" name="harga_perolehan" value="<?= htmlspecialchars($d['harga_perolehan'] ?? ''); ?>" class="form-control" step="0.01">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" value="<?= htmlspecialchars($d['jumlah']); ?>" class="form-control" min="1" required>
                        </div>
                    </div>

                </div>

                <div class="row">

                

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Kondisi</label>
                            <select name="kondisi" class="form-select" required>
                                <option value="Baik" <?= ($d['kondisi'] == 'Baik') ? 'selected' : ''; ?>>Baik</option>
                                <option value="Rusak Ringan" <?= ($d['kondisi'] == 'Rusak Ringan') ? 'selected' : ''; ?>>Rusak Ringan</option>
                                <option value="Rusak Berat" <?= ($d['kondisi'] == 'Rusak Berat') ? 'selected' : ''; ?>>Rusak Berat</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="id_kategori" class="form-select" required>
                                <?php
                                $kategori = mysqli_query($conn,"SELECT * FROM tabel_kategori ORDER BY nama_kategori ASC");
                                while($k = mysqli_fetch_assoc($kategori)){
                                ?>
                                <option value="<?= $k['id_kategori']; ?>" <?= ($d['id_kategori'] == $k['id_kategori']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($k['nama_kategori']); ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Ruangan</label>
                            <select name="id_ruangan" class="form-select" required>
                                <?php
                                $ruangan = mysqli_query($conn,"SELECT * FROM tabel_ruangan ORDER BY nama_ruangan ASC");
                                while($r = mysqli_fetch_assoc($ruangan)){
                                ?>
                                <option value="<?= $r['id_ruangan']; ?>" <?= ($d['id_ruangan'] == $r['id_ruangan']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($r['nama_ruangan']); ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label">Sumber Dana</label>
                    <select name="id_sumber_dana" class="form-select" required>
                        <?php
                        $dana = mysqli_query($conn,"SELECT * FROM tabel_sumber_dana ORDER BY keterangan ASC");
                        while($dn = mysqli_fetch_assoc($dana)){
                        ?>
                        <option value="<?= $dn['id_sumber_dana']; ?>" <?= ($d['id_sumber_dana'] == $dn['id_sumber_dana']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($dn['keterangan']); ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan Tambahan</label>
                    <textarea name="keterangan" class="form-control" rows="3"><?= htmlspecialchars($d['keterangan'] ?? ''); ?></textarea>
                </div>

                <button type="submit" name="update" class="btn btn-warning">Update</button>
                <a href="halaman.php?menu=sarana" class="btn btn-secondary">Kembali</a>

            </form>

        </div>

    </div>

</div>