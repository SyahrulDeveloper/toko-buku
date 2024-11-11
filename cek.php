<?php
// jika belum login 
if(isset($_SESSION['log'])){
    // Session ada, lanjutkan
} else {
    // Cek cookie jika session tidak ada
    if(isset($_COOKIE['user_email']) && isset($_COOKIE['last_login'])) {
        $email = $_COOKIE['user_email'];
        // Verifikasi cookie dengan database
        $query = mysqli_query($koneksi, "SELECT * FROM login WHERE email='$email'");
        $count = mysqli_num_rows($query);
        
        if($count > 0) {
            $_SESSION['log'] = 'True';
        } else {
            // Cookie tidak valid, hapus cookie
            setcookie('user_email', '', time() - 3600, '/');
            setcookie('last_login', '', time() - 3600, '/');
            header("location: login.php");
        }
    } else {
        header("location: login.php");
    }
}
?>