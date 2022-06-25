<?php
include 'stdlib.php';

//Daten aus dem Signup-Formular
$username = $_POST["username"];
$password = $_POST["password"];
$password2 = $_POST["password2"];

//prüfen ob passwort richtig widerholt wurde
if($password != $password2){
    exit("bruh repeat you password correctly");
}

//Verbindung mit Datenbankserver (siehe stdlib.php)
$con = datenbankverbindung();

//prüfen ob username vergeben ist
$sql = "SELECT uid FROM user WHERE uname = '$username'";
$res = $con->query($sql);
if($res->num_rows > 0) {
    while($i = $res->fetch_assoc()) {
        $idfromdb = $i["uid"];
    }
}
if($idfromdb != ""){
    exit("user already exists lol");
}

//pasword hashing und in datenbank eintragen
$password = password_hash($password, PASSWORD_DEFAULT);
if($password === FALSE){
    exit("An unexpexted error occured, please try again");
}
$sql = "INSERT INTO user (uname, pwd) VALUES ('$username','$password')";
$con->query($sql);
?>
