<?php
include 'stdlib.php';

//Verbindung mit Datenbankserver (siehe stdlib.php)
$con = datenbankverbindung();

//überprüfung der session
$session = $_COOKIE["session"];

$sql = "SELECT uid FROM user WHERE session = '$session'";
$res = $con->query($sql);
$i = $res->fetch_assoc();
$uid = $i["uid"];


if($uid == ""){
    exit();
}

//username + profilbild
$sql = "SELECT uname FROM user WHERE uid = '$uid'";
$res = $con->query($sql);
$i = $res->fetch_assoc();
$uname = $i["uname"];


$sql = "SELECT pfp FROM user WHERE uid = '$uid'";
$res = $con->query($sql);
$i = $res->fetch_assoc();
$pfpsrc = $i["pfp"];
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="view.css">
<body>
<div id="chatlist" class="chats">
</div>
<div class="profile">
    <img class="pfp" src="<?php echo $pfpsrc ?>"> <!-- Profilbild link hierhin -->
    <span id="username" class="username-profile"><?php echo $uname; ?></span>
    <img class="settings" src="https://cdn-icons-png.flaticon.com/512/74/74035.png" onclick="settings()"> 
    <img class="newchat" src="https://cdn-icons-png.flaticon.com/512/1828/1828919.png" onclick="chatareaedit('newchat')">
</div>
<div id="chatarea" class="chatarea">
</div>
<div id="overlay" class="overlay">
</div>
<!-- script für onclick-functions-->
<script async type="text/javascript" src="view.js"></script>
</body>
</html>