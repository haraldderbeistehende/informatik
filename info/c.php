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


//array mit den ids der rooms aus member-tabelle

$roomids = [];

$sql = "SELECT roomid FROM member WHERE uid = '$uid'";
$res = $con->query($sql);
if($res->num_rows > 0) {
    while($i = $res->fetch_assoc()) {
        array_push($roomids[], $i["roomid"]);
    }
}



//übersetzung in namen der rooms

$roomnames = [];


//sortierte chatnamen aus den ids WARUM HANDLED SQL KEINE ARRAYS ARGH
//sehr ekliges sql statement ich weiß
$sql = ""
$sql = "SELECT roomname, recentmsg FROM rooms WHERE roomid = 0 ";
foreach($roomids as $i2){
    $sql = $sql." OR roomid = ".$i2;
}
$sql = $sql." ORDER BY recentmsg DESC;";

$res = $con->query($sql);

while($i = $res->fetch_assoc()){
    array_push($roomnames, $i["roomname"]);
}


//ausgeben der namen der chats
$i = 1;
foreach($roomnames as $i2){
    echo '<p class="chat" ';
    ?> onclick="chatsedit('<?php echo $i2 ?>')"
    <?php
    echo 'id="chat'.$i.'"';
    echo '>';
    echo $i2;
    echo "</p>";
    $i++;
}
$con->close();
?>
