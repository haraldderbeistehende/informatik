<html>
<link rel="stylesheet" href="/allwissend/tests/test.css">
<body>
<div class="login2">
  <form method="post" action="logincheck.php">
    <label>your username</label>
    <input type="text" name="username" placeholder="your username">
	<label>password</label>
    <input type="password" name="password" placeholder="your password">
    <input type="submit" value="Login">
  </form>
</div>
<div style="position: absolute; bottom: 0%; height: 5%; right:36.5%;">
    &nbsp;&nbsp; theres a 20% chance of being rickrolled on this page >:) &nbsp;
</div>
<?php
$random = mt_rand(1, 5);
if($random == 3){
  //DIESES SCRIPT IST NICHT VON MIR GEWESEN
  //und leider nicht im backup enthalten
  //idr rickrollt es die person mit einer 20% chance
  //vgl https://tigersystems.cf/
    echo "<style>/*Made by Markus Tieger. Thanks to Markus Tieger for allowing me to use this css and some javascript*/
/*adapted by haraldderbeistehende*/
.overlay{position:fixed!important;z-index:9997!important;right:0!important;bottom:-200px!important;top:0!important;left:0!important}#gray-overlay{background-color:#a779ac!important}#click-overlay{background-color:transparent!important}.rickroll{position:fixed;right:0;bottom:0;top:0;left:0;z-index:9998;vertical-align:middle;white-space:nowrap;max-height:100%;max-width:100%;overflow-x:auto;overflow-y:auto;text-align:center;-webkit-tap-highlight-color:transparent}.rickrollsub{border-radius:16px;display:inline-block;z-index:9999;background-color:#a779ac;text-align:left;white-space:normal;overflow-y:hidden;box-shadow:0 2px 10px 0 rgb(0 0 0/20%);position:relative;vertical-align:middle;height:400px;width:640px;top:50%;-ms-transform:translateY(-50%);transform:translateY(-50%)}.rickrollframe{position:absolute;top:0;left:0}.rickrolltext{position:absolute;left:10px;bottom:0px;color:black;font-size:17px;}#rickrollskip{border-radius:10px;background-color:#ff9810;color:#fff;position:absolute;width:100px;height:25px;right:10px;bottom:5px;transition:box-shadow 200ms cubic-bezier(.4,0,.2,1);border:none;box-sizing:border-box;text-decoration:none}.rickrollaktivated:hover{background-color:#0048a7!important;width:104px!important;height:29px!important;right:8px!important;bottom:3px!important}.rickrollaktivated{background-color:#1a73e8!important}#service-selection{position:absolute;right:25px;top:25px}</style><div id='clickoverlay' class='overlay'></div>
<script id='rickrollscript' src='rickroll.js' type='text/javascript'></script>";
} ?>
</body>
</html>