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
    exit("Unauthenticated");
}
$roomid = htmlspecialchars($_GET["roomid"]);
?>
<input id="addinput" class="addinput" type="text" placeholder="enter username you want to add"></input>
<button class="addsubmit" onclick="addexec(<?php echo $roomid; ?>)">ADD!</button>
<div class="managearea">
<?php
//Abfrage und auflistung der Mitglieder in einem chat
$sql = "SELECT uid FROM member WHERE roomid = '$roomid'";
$res = $con->query($sql);
if($res->num_rows > 0) {
    while($i = $res->fetch_assoc()) {
        echo "<div class='manage-member'>";
        $sql = "SELECT uname, pfp FROM user WHERE uid = ".$i['uid'];
        $res2 = $con->query($sql);
        if($res2->num_rows > 0) {
            while($i2 = $res2->fetch_assoc()) {
                echo "<img class='manage-pfp' src='".$i2["pfp"]."'>";
                echo "<span class='manage-uname'>".$i2["uname"]."</span>";
                echo "<button class='manage-remove' onclick='chatremove(".$roomid.", ".$i["uid"].")'> Click To Remove</button>";
            }
        }
        echo "</div>";
        //paar brakes weil wir kein css können
        echo "<br><br><br><br><br>";
    }
}
?>
</div>