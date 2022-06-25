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
//msg wird html-encoded im header gesendet (siehe view.js)
$msg = getallheaders();
$msg = $msg["msg"];
$roomid = htmlspecialchars($_GET["roomid"]);
$uid = htmlspecialchars($_GET["uid"]);
$msg = urldecode($msg);
//eintragen der nachricht
$sql = "INSERT INTO msg (uid, roomid, content) VALUES ('$uid', '$roomid', '$msg')";
echo $con->query($sql);
$time = time();
$sql = "UPDATE rooms SET recentmsg = '$time' WHERE roomid = '$roomid'";
$con->query($sql);
$con->close();
?>