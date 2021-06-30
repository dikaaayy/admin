<?php 
session_start();

if(!isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

require 'functions.php';

// pagination
// config
$dataPerHalaman = 4;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $dataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($dataPerHalaman * $halamanAktif) - $dataPerHalaman;

$students = query("SELECT * FROM mahasiswa LIMIT $awalData, $dataPerHalaman");

if(isset($_POST["search"])){
    $students = search($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP & MYSQL</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body{
            background-color: #F8EDED;
        }
        a{
            color : #4C4C6D;
            text-decoration: none;
        }
        .head button{
            color: #F8EDED;
            background-color: #4C4C6D;
        }
    </style>
</head>
<body>
    <div class="container-md head">
        <h1>Daftar Mahasiswa</h1>
        <a href="insert.php">Tambah data mahasiswa</a>
        <a href="logout.php">logout</a>
        <hr>
        <form action="" method="post">
            <!-- <input type="text" name="keyword" id="" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off"> -->
            <div class="col-5 mb-2">
                <input type="text" name="keyword" id="" class="form-control" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off">
            </div>
            <button type="submit" name="search" class="btn">Search</button>
        </form>
    </div>
    <!-- <br><br> -->

    
    <table class="table table table-hover">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Aksi</th>
            <th scope="col">Nama</th>
            <th scope="col">NIM</th>
            <th scope="col">Email</th>
            <th scope="col">Jurusan</th>
            <th scope="col">Gambar</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach($students as $student) : ?>
            <tr>
                <th scope="row"><?= $i ?></th>
                <td><a href="update.php?id=<?= $student["id"]; ?>">update</a> | <a href="delete.php?id=<?= $student["id"]; ?>" onclick="return confirm('yakin?');">delete</a></td>
                <td><?= $student["nama"]; ?></td>
                <td><?= $student["nim"]; ?></td>
                <td><?= $student["email"]; ?></td>
                <td><?= $student["jurusan"]; ?></td>
                <td><img src="gambar/ugm.png" alt="" width=100px></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- To create pagination -->
    <div class="container text-center">
        <?php if($halamanAktif > 1) : ?>
            <a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
        <?php endif; ?>
        <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
            <?php if($i == $halamanAktif) : ?>
                <a href="?halaman=<?= $i; ?>" style="font-weight: bold;"><?= $i; ?></a>
            <?php else: ?>
                <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if($halamanAktif < $jumlahHalaman) : ?>
            <a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>