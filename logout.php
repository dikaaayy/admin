<?php 

session_start();
$_SESSION = [];
session_unset();
session_destroy();



setcookie('id', '', time()-1000);
setcookie('key', '', time()-1000);


header("Location: login.php");
exit;
?>