<?php
include __DIR__ . '/../config.php';

if(isset($_POST['simpan'])){

    $tanggal_mutasi   = mysqli_real_escape_string($conn, $_POST['tanggal_mutasi']);
    $id_sarana        = (int) $_POST['id_sarana'];
    $id_ruangan_asal  = (int) $_POST['id_ruangan_asal'];
    $id_ruangan_tujuan = (int) $_POST['id_ruangan_tujuan'];
    $jumlah           = (int) $_POST['jumlah'];
    $alasan           = mysqli_real_escape_string($conn, $_POST['alasan']);

    // Simpan data mutasi
    mysqli_query($conn,"
        INSERT INTO tabel_mutasi(
            tanggal_mutasi,
            id_sarana,
            id_ruangan_asal,
            id_ruangan_tujuan,
            jumlah,
            alasan
        ) VALUES (
            '$tanggal_mutasi',
            '$id_sarana',
            '$id_ruangan_asal',
            '$id_ruangan_tujuan',
            '$jumlah',
            '$alasan'
        )
    ");

    // Update lokasi ruangan di tabel sarana
    mysqli_query($conn,"
        UPDATE tabel_sarana
        SET id_ruangan='$id_ruangan_tujuan'
        WHERE id_sarana='$id_sarana'
    ");

    echo "
    <script>
        alert('Data mutasi berhasil disimpan, lokasi barang telah diperbarui');
        window.location='halaman.php?menu=mutasi';
    </script>
    ";

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">
            Tambah Mutasi Barang
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="row">

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Tanggal Mutasi
                            </label>

                            <input type="date"
                                   name="tanggal_mutasi"
                                   class="form-control"
                                   value="<?= date('Y-m-d'); ?>"
                                   required>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Jumlah Dipindah
                            </label>

                            <input type="number"
                                   name="jumlah"
                                   class="form-control"
                                   min="1"
                                   required>

                        </div>

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Pilih Barang (Sarana)
                    </label>

                    <select name="id_sarana"
                            class="form-select"
                            required>

                        <option value="">
                            -- Pilih Barang --
                        </option>

                        <?php
                        $sarana = mysqli_query($conn,"
                            SELECT id_sarana, kode_barang, nama_barang
                            FROM tabel_sarana
                            ORDER BY nama_barang ASC
                        ");

                        while($s = mysqli_fetch_assoc($sarana)){
                        ?>

                        <option value="<?= $s['id_sarana']; ?>">
                            <?= htmlspecialchars($s['kode_barang'] . ' - ' . $s['nama_barang']); ?>
                        </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Ruangan Asal
                            </label>

                            <select name="id_ruangan_asal"
                                    class="form-select"
                                    required>

                                <option value="">
                                    -- Pilih Ruangan Asal --
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

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Ruangan Tujuan
                            </label>

                            <select name="id_ruangan_tujuan"
                                    class="form-select"
                                    required>

                                <option value="">
                                    -- Pilih Ruangan Tujuan --
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
                        Alasan Pemindahan
                    </label>

                    <textarea name="alasan"
                              class="form-control"
                              rows="3"></textarea>

                </div>

                <button type="submit"
                        name="simpan"
                        class="btn btn-success">

                    Simpan Mutasi

                </button>

                <a href="halaman.php?menu=mutasi"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>