<?php

session_start();

include 'phpFunctions.php';

$username = $_SESSION["username"];
if(isset($_SESSION['username'])) {
    echo "Your session is running " . $_SESSION['username'];
    }
$userID = getUserID($username);
echo($userID);


// uploadRecipeImage.php copied and pasted into a function
function uploadImage() {
    $targetDir = "images/recipeImages/"; //Get directory to save image into
    $fileName = $_FILES['fileToUpload']['name']; //Get filename
    $targetFile = $targetDir . $fileName; //Create full file path
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
    move_uploaded_file($_FILES["fileToUpload"]['tmp_name'], $targetFile); //Stores file in the file system
    return addImage($fileName, $imageFileType, $targetFile);
}


// Retrieve the title and description, then perform some basic safety
$title = $_POST['foodName'];
$title = htmlentities($title, ENT_QUOTES, 'UTF-8');

// Get the three tag fields and store in an array
$prepTime = $_POST['prepTime'];
$difficulty = $_POST['difficulty'];
$country = $_POST['country'];
$tags_array = array("prepTime" => $prepTime, "difficulty" => $difficulty, "country" => $country);

$description = $_POST['description'];
$description = htmlentities($description, ENT_QUOTES, 'UTF-8');


// Create an associative array with 2 catergories, instructions and ingredients.
$json = array("instructions" => array(), "ingredients" => array());

$instruction_count = 1;
$current_instruction = $_POST['step1'];

// Loop through every step and append them to the array.
while ($current_instruction != "")
{
    $json['instructions'][] = $current_instruction;
    $instruction_count++;
    $current_instruction = $_POST['step' . $instruction_count];
}


// Initialise ingredient loop variables
$current_ingredient = $_POST['ingredient1'];
$ingredient_count = 1;

// Loop through the ingredients inputted until one is empty
while ($current_ingredient != "")
{
    $json['ingredients'][] = $current_ingredient;
    $ingredient_count++;
    $current_ingredient = $_POST['ingredient' . $ingredient_count];
}

// Encode to json format
$jsonComp = json_encode($json);
$jsonTags = json_encode($tags_array);

$image = uploadImage();

// Send recipe details to database
$recipeID = addRecipe($userID, $title, $jsonComp, $image, $description, $jsonTags);
exit(header("Location: post.php?recipeID=" . $recipeID));
?>
