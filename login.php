<?php
include 'config.php';

if(isset($_SESSION['login'])){
    header("Location: halaman.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h4>LOGIN</h4>
                </div>

                <div class="card-body">

                    <form method="POST" action="proses_login.php">

                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Login
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>
