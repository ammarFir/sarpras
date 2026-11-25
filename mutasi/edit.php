<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"
    SELECT *
    FROM tabel_mutasi
    WHERE id_mutasi='$id'
");

$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $tanggal_mutasi   = mysqli_real_escape_string($conn, $_POST['tanggal_mutasi']);
    $id_sarana        = (int) $_POST['id_sarana'];
    $id_ruangan_asal  = (int) $_POST['id_ruangan_asal'];
    $id_ruangan_tujuan = (int) $_POST['id_ruangan_tujuan'];
    $jumlah           = (int) $_POST['jumlah'];
    $alasan           = mysqli_real_escape_string($conn, $_POST['alasan']);

    // Simpan data mutasi
    mysqli_query($conn,"
        UPDATE tabel_mutasi
        SET
            tanggal_mutasi='$tanggal_mutasi',
            id_sarana='$id_sarana',
            id_ruangan_asal='$id_ruangan_asal',
            id_ruangan_tujuan='$id_ruangan_tujuan',
            jumlah='$jumlah',
            alasan='$alasan'
        WHERE id_mutasi='$id'
    ");

    // Update lokasi ruangan di tabel sarana (agar jika ada revisi tujuan, data sarana tetap sinkron)
    mysqli_query($conn,"
        UPDATE tabel_sarana
        SET id_ruangan='$id_ruangan_tujuan'
        WHERE id_sarana='$id_sarana'
    ");

    echo "
    <script>
        alert('Data mutasi berhasil diupdate');
        window.location='halaman.php?menu=mutasi';
    </script>
    ";

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            Edit Mutasi Barang
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
                                   value="<?= $d['tanggal_mutasi']; ?>"
                                   class="form-control"
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
                                   value="<?= $d['jumlah']; ?>"
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

                        <?php
                        $sarana = mysqli_query($conn,"
                            SELECT id_sarana, kode_barang, nama_barang
                            FROM tabel_sarana
                            ORDER BY nama_barang ASC
                        ");

                        while($s = mysqli_fetch_assoc($sarana)){
                        ?>

                        <option value="<?= $s['id_sarana']; ?>"
                            <?= ($d['id_sarana'] == $s['id_sarana']) ? 'selected' : ''; ?>>

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

                                <?php
                                $ruangan = mysqli_query($conn,"
                                    SELECT *
                                    FROM tabel_ruangan
                                    ORDER BY nama_ruangan ASC
                                ");

                                while($r = mysqli_fetch_assoc($ruangan)){
                                ?>

                                <option value="<?= $r['id_ruangan']; ?>"
                                    <?= ($d['id_ruangan_asal'] == $r['id_ruangan']) ? 'selected' : ''; ?>>

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

                                <?php
                                $ruangan = mysqli_query($conn,"
                                    SELECT *
                                    FROM tabel_ruangan
                                    ORDER BY nama_ruangan ASC
                                ");

                                while($r = mysqli_fetch_assoc($ruangan)){
                                ?>

                                <option value="<?= $r['id_ruangan']; ?>"
                                    <?= ($d['id_ruangan_tujuan'] == $r['id_ruangan']) ? 'selected' : ''; ?>>

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
                              rows="3"><?= htmlspecialchars($d['alasan'] ?? ''); ?></textarea>

                </div>

                <button type="submit"
                        name="update"
                        class="btn btn-warning">

                    Update

                </button>

                <a href="halaman.php?menu=mutasi"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>