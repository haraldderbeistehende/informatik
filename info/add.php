<?php
include 'stdlib.php';

//Verbindung mit Datenbankserver (siehe stdlib.php)
$con = datenbankverbindung();

//ueberpruefung der session

$session = $_COOKIE["session"];

$sql = "SELECT uid FROM user WHERE session = '$session'";
$res = $con->query($sql);
$i = $res->fetch_assoc();
$uid = $i["uid"];


if($uid == ""){
    exit();
}

//eintragen der in den link gegebenen parametere in die Datenbank
$roomid = htmlspecialchars($_GET["roomid"]);
$uname = htmlspecialchars($_GET["uname"]);

$sql = "SELECT uid FROM user WHERE uname = '$uname'";
$res = $con->query($sql);
$i = $res->fetch_assoc();
$uid = $i["uid"];

if($uid == ""){
    exit();
}

$sql = "INSERT INTO member (uid, roomid) VALUES ('$uid','$roomid')";
echo $con->query($sql);
$con->close();
?>