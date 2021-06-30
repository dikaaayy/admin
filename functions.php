<?php 

//connct db
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// var_dump($result);

    // while($mhs = mysqli_fetch_assoc($result)){
    //     var_dump($mhs);
    // }

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;
}

function insert($data){
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    // upload gambar
    $gambar = upload();
    if(!$gambar){
        return false;
    }
    
    //insert
    $query = "INSERT INTO mahasiswa
    VALUES('id', '$nama', '$nim', '$email', '$jurusan', '$gambar')";
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
}

function search($keyword){
    $query = "SELECT * FROM mahasiswa
            WHERE 
        nama LIKE '%$keyword%' OR
        nim LIKE '%$keyword%' OR
        email LIKE '%$keyword%' OR
        jurusan LIKE '%$keyword%'
    ";

    return query($query);
}

function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tempName = $_FILES['gambar']['tmp_name'];

    //cek gambar upload
    if($error === 4){
        echo "<script>
            alert('pilih gambar!')
        </script>";
        return false;
    }

    // cek apakah yg diupload gambar
    $ekstensi = ['jpg', 'jpeg', 'png'];
    $cekEkstensi = explode('.', '$namaFile');
    $cekEkstensi = strtolower(end($cekEkstensi));

    if(!in_array($cekEkstensi, $ekstensi)){
        echo "
            <script>
                alert('yang anda upload bukan gambar');
            </script>
        ";
        return false;
    }

    // cek ukuran gambar
    if($ukuranFile > 2000000){
        echo "
            <script>
                alert('ukuran gambar terlalu besar');
            </script>
        ";
        return false;
    }

    // generate new name
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $cekEkstensi;

    //siap upload
    move_uploaded_file($tempName, 'img/' . $namaFileBaru);
    
    return $namaFileBaru;
}

function update($data){
    global $conn;
    
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = htmlspecialchars($data["gambar"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user upload gambar baru
    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    }else{
        $gambar = upload();
    }

    //update
    $query = "UPDATE mahasiswa SET
            nama = '$nama',
            nim = '$nim',
            email = '$email',
            jurusan = '$jurusan',
            gambar = '$gambar'
            WHERE id = $id
    ";

mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function delete($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}



function register($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username udah ada / belom
    $cekUsername = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if(mysqli_fetch_assoc($cekUsername)){
        echo "
            <script>
            alert('username sudah terpakai!');
            </script>";
        return false;
    }

    //cek apakah pass == pass2
    if($password !== $password2){
        echo "
            <script>
            alert('password tidak sama');
            </script>"; 
        
        return false;
    }
    // enkripsi pass
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambah user baru ke db
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");
    
    return mysqli_affected_rows($conn);
}

?>