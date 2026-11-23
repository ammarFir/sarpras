<?php
include 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn,"
    SELECT *
    FROM tabel_user
    WHERE username='$username'
    AND password='$password'
");

$cek = mysqli_num_rows($query);

if($cek > 0){

    $_SESSION['login'] = true;

    header("Location: halaman.php");

}else{

    echo "
    <script>
        alert('Username / Password salah');
        window.location='login.php';
    </script>
    ";

}
?>
