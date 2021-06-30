<?php

session_start();

if(!isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

    require 'functions.php';

    //ambil data id di url
    $id = $_GET["id"];

    //query data mahasiswa
    $student = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

    
    //cek submit dipencet apa blom
    if(isset($_POST["submit"]) ){
        if(update($_POST) > 0){
            echo "
                <script>
                    alert('data berhasil diubah!');
                    document.location.href = 'index.php';
                </script>
            ";
        }
        else{
            echo "
            <script>
            alert('data gagal diubah!');
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
    <title>Update data mahasiswa</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body{
            background-color: #F8EDED;
        }
        .update button{
            color: #F8EDED;
            background-color: #4C4C6D;
        }
        .update{
            background-color: #EDEDD0;
        }
    </style>
</head>
<body>
    <div class="container p-5 rounded update mt-5">
        <h2>Update data mahasiswa</h2>

        <div class="container mt-5">
            <form action="" method="post" enctype="multipart/form-data">

                <!-- Hidden -->
                <input type="hidden" name="id" value="<?= $student["id"]; ?>">
                <input type="hidden" name="gambarLama" value="<?= $student["gambar"]; ?>">

                <div class="row mb-5">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control" id="name" required value="<?= $student["nama"]; ?>">
                    </div>
                </div>
                <div class="row mb-5">
                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                    <div class="col-sm-10">
                        <input type="text" name="nim" class="form-control" id="nim" required value="<?= $student["nim"]; ?>">
                    </div>
                </div>
                <div class="row mb-5">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="mail" name="email" class="form-control" id="email" required value="<?= $student["email"]; ?>">
                    </div>
                </div>
                <div class="row mb-5">
                    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <input type="text" name="jurusan" class="form-control" id="jurusan" required value="<?= $student["jurusan"]; ?>">
                    </div>
                </div>
                <div class="row mb-5">
                    <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="gambar" type="file" id="gambar">
                    </div>
                </div>
                <button type="submit" name="submit" class="btn">Ubah Data</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>