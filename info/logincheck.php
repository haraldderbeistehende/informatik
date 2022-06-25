<?php
include 'stdlib.php';

//Daten aus dem Login-Formular
$username = $_POST["username"];
$password = $_POST["password"];

//Verbindung mit Datenbankserver (siehe stdlib.php)
$con = datenbankverbindung();

//abfrage des passworts zum username
$sql = "SELECT pwd FROM user WHERE uname = '$username'";
$res = $con->query($sql);
$i = $res->fetch_assoc();
$pwdfromdb = $i["pwd"];

if(!password_verify($password, $pwdfromdb)){
    exit();
}


//abfrage der userid zum username
$sql = "SELECT uid FROM user WHERE uname = '$username'";
$res = $con->query($sql);
$i = $res->fetch_assoc();
$uid = $i["uid"];

//setzen des session cookies
//etwas dezent unschön gelöst aber geht schon
$random1 = mt_rand(10000, 100000000000000);
$random2 = mt_rand(10000, 100000000000000);
$random3 = $random1.$random2;
$session = base64_encode($random3);
//dass das mit diesem wunderschönen array geht stand irgendwo auf stackoverflow
setrawcookie("session", $session, [
    'expires' => time() + 86400,
    'path' => '/',
    'domain' => 'harald.ga',
    'secure' => true,
    'httponly' => true,
    'samesite' => Lax,
]);
$sql = "UPDATE user SET session = '$session' WHERE uid = '$uid'";
$con->query($sql);
$con->close();
?>
<script>window.location='https://www.harald.ga/allwissend/main/view.php'</script>