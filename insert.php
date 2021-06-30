<?php 
session_start();

if(!isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}


//cek submit dipencet apa blom
require 'functions.php';

if(isset($_POST["submit"]) ){

    if(insert($_POST) > 0){
          echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";        }
    else{
        echo "
        <script>
        alert('data gagal ditambahkan!');
        document.location.href = 'index.php';   
        </script>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data mahasiswa</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body{
            background-color: #F8EDED;
        }
        .insert{
            background-color: #EDEDD0;
        }
        .insert button{
            color: #F8EDED;
            background-color: #4C4C6D;
        }
        
    </style>
</head>
<body>
    <div class="container p-5 rounded insert mt-5">
        <h2>Tambah data mahasiswa</h2>

        <div class="container mt-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row mb-5">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control" id="name" required>
                    </div>
                </div>
                <div class="row mb-5">
                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                    <div class="col-sm-10">
                        <input type="text" name="nim" class="form-control" id="nim" required>
                    </div>
                </div>
                <div class="row mb-5">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="mail" name="email" class="form-control" id="email" required>
                    </div>
                </div>
                <div class="row mb-5">
                    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <input type="text" name="jurusan" class="form-control" id="jurusan" required>
                    </div>
                </div>
                <div class="row mb-5">
                    <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="gambar" type="file" id="gambar" required>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn">Tambah Data</button>
            </form>
        </div>
    </div>

    <!-- <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="name">nama : </label>
                <input type="text" name="nama" id="name" required>
            </li>
            <li>
                <label for="nim">nim : </label>
                <input type="text" name="nim" id="nim" required>
            </li>
            <li>
                <label for="email">email : </label>
                <input type="mail" name="email" id="email" required>
            </li>
            <li>
                <label for="jurusan">jurusan : </label>
                <input type="text" name="jurusan" id="jurusan" required>
            </li>
            <li>
                <label for="gambar">gambar : </label>
                <input type="file" name="gambar" id="gambar" required>
            </li>
            <li>
                <button type="submit" name="submit">tambah data</button>
            </li>
        </ul>
    </form> -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>