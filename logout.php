<?php
session_start();
ini_set("display_errors", "1"); 
$_SESSION = []; //①
//  クッキーの削除
if (ini_get("session.use_cookies")) { //②
    setcookie(session_name(), '', time() - 42000);// ③
}
// セッションの削除
session_destroy(); //④
header('location: login.php');
exit();