<?php
include 'stdlib.php';

//Daten aus dem Login-Formular
$roomname = $_POST["roomname"];

//Verbindung mit Datenbankserver (siehe stdlib.php)
$con = datenbankverbindung();

//überprüfung der session
$session = $_COOKIE["session"];

$sql = "SELECT uid FROM user WHERE session = '$session'";
$res = $con->query($sql);
$i = $res->fetch_assoc();
$uid = $i["uid"];

if($uid == ""){
    exit("403 Unauthenticated");
}

$time = time();

//überprüfen, ob chat schon existiert
$sql = "SELECT roomid FROM rooms WHERE roomname = '$roomname'";
$res = $con->query($sql);
$i = $res->fetch_assoc();
$roomnamedb = $i["roomname"];

if($roomnamedb != ""){
    exit("error, chat already exists");
}
//falls der chat nich nicht exitiert, in datenbank eintragen
$sql = "INSERT INTO rooms (roomname, recentmsg) VALUES ('$roomname','$time')";
$con->query($sql);
$sql = "SELECT roomid FROM rooms WHERE roomname = '$roomname'";
$res = $con->query($sql);
$i = $res->fetch_assoc();
$roomid = $i["roomid"];

$sql = "INSERT INTO member (uid, roomid) VALUES ('$uid','$roomid')";
$con->query($sql);
echo "operation successful, please reload the page";
?>