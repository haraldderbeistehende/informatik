<!-- NUR die lines mit einem "added", "changed" oder "new" kommentar sind hier von uns-->
<script>
// see https://stackoverflow.com/questions/31106189/create-a-simple-10-second-countdown
ProgressCountdown(5, 'pageBeginCountdown', 'pageBeginCountdownText');

function ProgressCountdown(timeleft, bar, text) {
  return new Promise((resolve, reject) => {
    var countdownTimer = setInterval(() => {
      timeleft--;

      document.getElementById(bar).value = timeleft;
      document.getElementById(text).textContent = timeleft;

      if (timeleft <= 0) {
        clearInterval(countdownTimer);
        resolve(true);
        window.location = "view.php"; //added
      }
    }, 1000); //changed
  });
}
</script>
<div>
  <div>
    <progress value="5" max="5" id="pageBeginCountdown"></progress>
    <p> Automatic redirect in <span id="pageBeginCountdownText">5 </span> seconds</p>
  </div>
</div>
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
// EDIT IN LINE 48 !!!!!
 
//vgl. https://www.codexworld.com/compress-image-before-upload-using-php/ ,  https://www.devopsschool.com/blog/how-to-upload-and-compress-an-image-using-php/
// all lines with a "new" or "edted" comment are written by us
function compressImage($source, $destination, $quality) { 
    //Information zum Bild
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // Create a new image from file 
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
    $size = filesize($source); //edited
    if($size > 500000){ //edted
        exit("ERROR! Maximum upload size is 500KB."); //edited
    }
    // edited
    // Save image 
    imagejpeg($image, $destination, $quality); 
     
    // Return compressed image 
    return $destination; 
}

// File upload path 
$uploadPath = "uploads/"; //edited
 
// If file upload form is submitted 
$status = $statusMsg = ''; 
if(isset($_POST["submit"])){ 
    $status = 'error'; 
    if(!empty($_FILES["image"]["name"])) { 
        // File info 
        $fileName = basename($_FILES["image"]["name"]); 
        $pos = stripos($fileName, "."); //new
        $type = substr($fileName, $pos); //new
        $imageUploadPath = $uploadPath . $uid.$type; //id insted of fileName, new
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);   
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 

            // Image temp source 
            $imageTemp = $_FILES["image"]["tmp_name"]; 
             
            // Compress size and upload image 
            $compressedImage = compressImage($imageTemp, $imageUploadPath, 1); 
            if($compressedImage){ 
                $status = 'success'; 
                $statusMsg = "Image compressed successfully."; 
            }else{ 
                $statusMsg = "Image compress failed!"; 
            } 
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
} 
 
// Display status message 
echo $statusMsg;
//new
if($status == "success"){
    $sql = "UPDATE user SET pfp = '$imageUploadPath' WHERE uid = '$uid'";
    $con->query($sql);
}
?>