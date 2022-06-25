
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

$chatname = htmlspecialchars($_GET["chat"]);
//abfrage der roomid aus dem über den link gegebenen roomname
$sql = "SELECT roomid FROM rooms WHERE roomname = '$chatname'";
$res = $con->query($sql);
$i = $res->fetch_assoc();
$chat = $i["roomid"];
?>
<div class="chatbar">
<span class="chatname"><?php echo $chatname; ?></span>
<img class="manage" src="https://cdn-icons-png.flaticon.com/512/681/681494.png" onclick="memberedit('<?php echo $chat; ?>')">
</div>
<div id="messages" class="messages">
<?php
//abfrage und ausgabe der nachrichten mit sortierung ob man absender order Empfänger ist (Nachricht link/recht, vgl z.B whatsapp)
$sql = "SELECT uid, content, msgid FROM msg WHERE roomid = '$chat'";
$res = $con->query($sql);
if($res->num_rows > 0) {
    while($i = $res->fetch_assoc()) {
        if($i["uid"] == $uid){
            $class = "msgout";
        } else {
            $class = "msgin";
        }
        echo "<div class='".$class."' id='".$i["msgid"]."'>";
        echo $i["content"];
    echo "</div>";
    }
}
$con->close();

?>
</div>
<textarea id="msginput" placeholder="type a message"></textarea>
<button class="sendmsg" type="submit" onclick="sendmsg(<?php echo $chat; ?>, <?php echo $uid; ?>, '<?php echo $chatname; ?>')">SEND</button>
