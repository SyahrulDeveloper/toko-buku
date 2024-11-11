<?php
session_start();
session_destroy();
header("location: login.php");
setcookie('user_email', '', time() - 3600, '/');
setcookie('last_login', '', time() - 3600, '/');
?>