<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "db_perpustakaan");

// Fungsi Cookie Management
function setLoginCookie($email) {
    setcookie('user_email', $email, time() + (86400 * 30), '/'); // 30 hari
    setcookie('last_login', date('d-m-Y H:i:s'), time() + (86400 * 30), '/');
}

function getLoginCookie($name) {
    return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
}

function deleteLoginCookies() {
    setcookie('user_email', '', time() - 3600, '/');
    setcookie('last_login', '', time() - 3600, '/');
    setcookie('remember_me', '', time() - 3600, '/');
}

// Fungsi Login
function userLogin($email, $password, $remember = false) {
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT * FROM login WHERE email='$email' AND password='$password'");
    $count = mysqli_num_rows($query);
    
    if($count > 0) {
        $_SESSION['log'] = 'True';
        $_SESSION['email'] = $email;
        
        if($remember) {
            setLoginCookie($email);
        }
        return true;
    }
    return false;
}

// Fungsi Logout
function userLogout() {
    session_destroy();
    deleteLoginCookies();
}

// Fungsi Cek Login Status
function isLoggedIn() {
    if(isset($_SESSION['log'])) {
        return true;
    }
    
    // Cek cookie jika session tidak ada
    $email = getLoginCookie('user_email');
    if($email) {
        global $koneksi;
        $query = mysqli_query($koneksi, "SELECT * FROM login WHERE email='$email'");
        $count = mysqli_num_rows($query);
        
        if($count > 0) {
            $_SESSION['log'] = 'True';
            $_SESSION['email'] = $email;
            return true;
        } else {
            deleteLoginCookies();
        }
    }
    return false;
}

// Fungsi untuk mendapatkan last login time
function getLastLoginTime() {
    return getLoginCookie('last_login');
}


// Menambah buku baru
if(isset($_POST['tambahbuku'])) {
    $judulbuku = $_POST['judul_buku'];
    $foto = $_POST['foto'];
    $isbn = $_POST['isbn'];
    $tahunterbit = $_POST['tahun_terbit'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $namapublisher = $_POST['nama_publisher'];
    $namapenulis = $_POST['nama_penulis'];
    
    $addtobuku = mysqli_query($koneksi, "INSERT INTO buku VALUES ('', '$judulbuku', '$foto', '$isbn', '$tahunterbit', '$harga', '$stok', '$namapublisher', '$namapenulis')");
    if($addtobuku) {
        header("location: index.php");
    } else {
        echo "Gagal";
        header("location: index.php");
    }
}

// Menampilkan data buku
function query($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Update buku
if (isset($_POST['updatebuku'])) {
    $idbuku = $_POST['id_buku'];
    $judulbuku = $_POST['judul_buku'];
    $foto = $_POST['foto'];
    $isbn = $_POST['isbn'];
    $tahunterbit = $_POST['tahun_terbit'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $publisher = $_POST['nama_publisher'];
    $penulis = $_POST['nama_penulis'];
    $update = mysqli_query($koneksi, "UPDATE buku SET judul_buku='$judulbuku', foto='$foto', isbn='$isbn', tahun_terbit='$tahunterbit', harga='$harga', stok='$stok', nama_publisher='$publisher', nama_penulis='$penulis' WHERE id_buku='$idbuku'");
    if($update) {
        header("location: index.php");
    } else {
        echo "Gagal";
        header("location: index.php");
    }
}

// Delete buku 
if(isset($_POST['deletebuku'])) {
    $idbuku = $_POST['id_buku'];

    $hapus = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku='$idbuku'");
    if($update) {
        header("location: index.php");
    } else {
        echo "Gagal";
        header("location: index.php");
    }

}

// Menambah publisher baru
if(isset($_POST['tambahpublisher'])) { 
    $namapublisher = $_POST['nama_publisher'];
    $alamat = $_POST['alamat'];
    $tahunberdiri = $_POST['tahun_berdiri'];

    $addtopublisher = mysqli_query($koneksi, "INSERT INTO publisher VALUES ('', '$namapublisher', '$alamat', '$tahunberdiri')");
    if($addtopublisher) {
        header("location: publisher.php");
    } else {
        echo "Gagal";
        header("location: publisher.php");
    }
}

// Menampilkan data publisher
function query1($query1) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query1);
    $rows_pubs = [];
    while ( $row_pub = mysqli_fetch_assoc($result)) {
        $rows_pubs[] = $row_pub;
    }
    return $rows_pubs;
}

// Update publisher
if (isset($_POST['updatepublisher'])) {
    $idpublisher = $_POST['id_publisher'];
    $namapublisher = $_POST['nama_publisher'];
    $alamat = $_POST['alamat'];
    $tahunberdiri = $_POST['tahun_berdiri'];
    $update = mysqli_query($koneksi, "UPDATE publisher SET nama_publisher='$namapublisher', alamat='$alamat', tahun_berdiri='$tahunberdiri' WHERE id_publisher='$idpublisher'");
    if($update) {
        header("location: publisher.php");
    } else {
        echo "Gagal";
        header("location: publisher.php");
    }
}

// Delete publisher
if(isset($_POST['deletepublisher'])) {
    $idpublisher = $_POST['id_publisher'];

    $hapus = mysqli_query($koneksi, "DELETE FROM publisher WHERE id_publisher='$idpublisher'");
    if($update) {
        header("location: publisher.php");
    } else {
        echo "Gagal";
        header("location: publisher.php");
    }

}

// Menambah penulis baru
if(isset($_POST['tambahpenulis'])) {
    $namapenulis = $_POST['nama_penulis'];
    $usia = $_POST['usia'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $addtopenulis = mysqli_query($koneksi, "INSERT INTO penulis VALUES ('', '$namapenulis', '$usia', '$phone' , '$email')");
    if($addtopenulis) {
        header("location: penulis.php");
    } else {
        echo "Gagal";
        header("location: penulis.php");
    }
}

// Menampilkan data penulis
function query2($query2) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query2);
    $rows_pens = [];
    while ( $row_pen = mysqli_fetch_assoc($result)) {
        $rows_pens[] = $row_pen;
    }
    return $rows_pens;
}

// Update penulis
if (isset($_POST['updatepenulis'])) {
    $idpenulis = $_POST['id_penulis'];
    $namapenulis = $_POST['nama_penulis'];
    $usia = $_POST['usia'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $update = mysqli_query($koneksi, "UPDATE penulis SET nama_penulis='$namapenulis', usia='$usia', phone='$phone', email='$email' WHERE id_penulis='$idpenulis'");
    if($update) {
        header("location: penulis.php");
    } else {
        echo "Gagal";
        header("location: penulis.php");
    }
}

// Delete penulis
if(isset($_POST['deletepenulis'])) {
    $idpenulis = $_POST['id_penulis'];

    $hapus = mysqli_query($koneksi, "DELETE FROM penulis WHERE id_penulis='$idpenulis'");
    if($update) {
        header("location: penulis.php");
    } else {
        echo "Gagal";
        header("location: penulis.php");
    }

}
?>