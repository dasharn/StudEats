<?php
$targetDir = "images/recipeImages/"; //Get directory to save image into
$fileName = basename($_FILES["fileToUpload"]["name"]); //Get filename
$targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]); //Create full file path
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION)); //Gets filetype
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }
}

move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile); //Stores file in the file system

addImage($fileName, $imageFileType, $targetFile);

?>
