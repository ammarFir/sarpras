
<?php

$host = "localhost";
$user = "root";
$pass = "mar1234";
$db   = "db_koperasi";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal : " . mysqli_connect_error());
}

/*
=====================================================
SESSION
=====================================================
*/

if (session_status() == PHP_SESSION_NONE) {

    session_start();
}

?>

