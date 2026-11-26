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
    $id_kategori    = (int) $_POST['id_kategori'];
    $id_ruangan     = (int) $_POST['id_ruangan'];
    $id_sumber_dana = (int) $_POST['id_sumber_dana'];
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

                            <label class="form-label">
                                Kode Barang
                            </label>

                            <input type="text"
                                   name="kode_barang"
                                   class="form-control"
                                   required>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Nama Barang
                            </label>

                            <input type="text"
                                   name="nama_barang"
                                   class="form-control"
                                   required>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Merek / Tipe
                            </label>

                            <input type="text"
                                   name="merek_tipe"
                                   class="form-control">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Spesifikasi
                            </label>

                            <input type="text"
                                   name="spesifikasi"
                                   class="form-control">

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">

                        <div class="mb-3">

                            <label class="form-label">
                                Tahun Pengadaan
                            </label>

                            <input type="number"
                                   name="tahun_pengadaan"
                                   class="form-control"
                                   min="1900"
                                   max="2100">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="mb-3">

                            <label class="form-label">
                                Harga Perolehan
                            </label>

                            <input type="number"
                                   name="harga_perolehan"
                                   class="form-control"
                                   step="0.01">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="mb-3">

                            <label class="form-label">
                                Jumlah
                            </label>

                            <input type="number"
                                   name="jumlah"
                                   class="form-control"
                                   min="1"
                                   value="1"
                                   required>

                        </div>

                    </div>

                </div>

                <div class="row">

                    

                    <div class="col-md-3">

                        <div class="mb-3">

                            <label class="form-label">
                                Kondisi
                            </label>

                            <select name="kondisi"
                                    class="form-select"
                                    required>

                                <option value="Baik">Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                                <option value="Rusak Berat">Rusak Berat</option>

                            </select>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="mb-3">

                            <label class="form-label">
                                Kategori
                            </label>

                            <select name="id_kategori"
                                    class="form-select"
                                    required>

                                <option value="">
                                    -- Pilih --
                                </option>

                                <?php
                                $kategori = mysqli_query($conn,"
                                    SELECT *
                                    FROM tabel_kategori
                                    ORDER BY nama_kategori ASC
                                ");

                                while($k = mysqli_fetch_assoc($kategori)){
                                ?>

                                <option value="<?= $k['id_kategori']; ?>">
                                    <?= htmlspecialchars($k['nama_kategori']); ?>
                                </option>

                                <?php } ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="mb-3">

                            <label class="form-label">
                                Ruangan
                            </label>

                            <select name="id_ruangan"
                                    class="form-select"
                                    required>

                                <option value="">
                                    -- Pilih --
                                </option>

                                <?php
                                $ruangan = mysqli_query($conn,"
                                    SELECT *
                                    FROM tabel_ruangan
                                    ORDER BY nama_ruangan ASC
                                ");

                                while($r = mysqli_fetch_assoc($ruangan)){
                                ?>

                                <option value="<?= $r['id_ruangan']; ?>">
                                    <?= htmlspecialchars($r['nama_ruangan']); ?>
                                </option>

                                <?php } ?>

                            </select>

                        </div>

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Sumber Dana
                    </label>

                    <select name="id_sumber_dana"
                            class="form-select"
                            required>

                        <option value="">
                            -- Pilih --
                        </option>

                        <?php
                        $dana = mysqli_query($conn,"
                            SELECT *
                            FROM tabel_sumber_dana
                            ORDER BY keterangan ASC
                        ");

                        while($d = mysqli_fetch_assoc($dana)){
                        ?>

                        <option value="<?= $d['id_sumber_dana']; ?>">
                            <?= htmlspecialchars($d['keterangan']); ?>
                        </option>

                        <?php } ?>

                    </select>

                </div>

                                <div class="mb-3">

                    <label class="form-label">
                        Keterangan Tambahan
                    </label>

                    <textarea name="keterangan"
                              class="form-control"
                              rows="3"
                              placeholder="Opsional, isi jika ada catatan tambahan..."></textarea>

                </div>

                <button type="submit"
                        name="simpan"
                        class="btn btn-success">

                    Simpan

                </button>

                <a href="halaman.php?menu=sarana"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>