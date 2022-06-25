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

$roomid = htmlspecialchars($_GET["roomid"]);
$uid = htmlspecialchars($_GET["uid"]);
//abfrage der IDs (Werte, die unique sind zum löschen benötigt :)) und Löschen der row
$sql = "SELECT memberid FROM member WHERE roomid = '$roomid' AND uid = '$uid'";
$res = $con->query($sql);
$i = $res->fetch_assoc();
$memberid = $i["memberid"];
$sql = "DELETE FROM member WHERE memberid = '$memberid'";
echo $con->query($sql);
$sql = "SELECT memberid FROM member WHERE roomid = '$roomid'";
$res = $con->query($sql);
$i = $res->fetch_assoc();
$memberid = $i["memberid"];
if($memberid == ""){
    $sql = "DELETE FROM rooms WHERE roomid = '$roomid'";
    $con->query($sql);   
    $sql = "DELETE FROM msg WHERE roomid = '$roomid'";
    $con->query($sql);
}
?>