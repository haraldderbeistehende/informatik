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
?>
<!DOCTYPE html>
<html>
<body>
<h1> Upload a profile picture here </h1>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <label>Select Image File:</label>
    <input type="file" name="image">
    <input type="submit" name="submit" value="Upload">
</form>
</body>
</html>