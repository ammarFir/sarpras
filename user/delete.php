<?php
include '../config.php';

$id = $_GET['id'];

mysqli_query($conn,"
    DELETE FROM tabel_user
    WHERE id_user='$id'
");

echo "
    <script>
        alert('Data berhasil dihapus');
        window.location='halaman.php?menu=user';
    </script>
    ";
?>


