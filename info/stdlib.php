<?php
function test(){
    echo "test";
}
function datenbankverbindung(){
    $servername = "sql210.epizy.com";
    $user = "epiz_31216411";
    $pw = "7lz7OXDNaWMqAR";
    $db = "epiz_31216411_chatsys";
    $con = new mysqli($servername, $user, $pw, $db);
    if($con->connect_error){
        die("holy fuck, there's an error. rüdiger ist tot and taisia was here".$con->connect_error);
    } else {
        return $con;
    }
}
?>