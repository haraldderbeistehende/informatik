<?php
//ein relativ sinnloses file, man könnte auch direkt den iframe über js ins html bekommen, wir wollten am anfang aber eine iframe-api machen :)
$action = htmlspecialchars($_GET["action"]);
if($action == "newchat"){
echo "<iframe src='new.html' width='100%' height='100%' frameborder='0'</iframe>";
}
?>