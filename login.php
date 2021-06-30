<?php
session_start();
require 'functions.php';

// cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username by id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

    // cek cooki dan username
    if($key === hash('sha256', $row['username'])){
        $_SESSION['login'] = true;
    }
}

if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}


if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $cekUser = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // cek apakah ada username
    if(mysqli_num_rows($cekUser) === 1){

        // cek password
        $row = mysqli_fetch_assoc($cekUser);
        if(password_verify($password, $row["password"])){

            //set session
            $_SESSION["login"] = true;

            // cek cookie
            if(isset($_POST["remember"])){

                //buat cookie
                
                setcookie('id', $row["id"]);
                setcookie('key', hash('sha256', $row['username']));
            }

            header("Location: index.php");
            exit;
        }
    }

    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body{
            background-color: #F8EDED;
        }
        .login button{
            color: #F8EDED;
            background-color: #4C4C6D;
        }
        .login{
            background-color: #EDEDD0;
        }
    </style>
</head>
<body>
    <div class="container p-5 rounded login mt-5">
        <h1>Halaman Login</h1>

        <?php if(isset($error)) :?>
            <p style="color: red; font-style: italic;">username atau password salah!</p>
        <?php endif; ?>

        <form action="" method="post">
            <div class="mb-3 col-5">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username">
            </div>
            <div class="mb-3 col-5">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>