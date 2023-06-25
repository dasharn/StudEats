<?php

$database_host = "dbhost.cs.man.ac.uk";
$database_user = "v52665lm";
$database_pass = "22886464BAa+";
$database_name = "2022_comp10120_z12";


function addUser($email, $password, $username) {
  global $database_host, $database_user, $database_pass, $database_name;
  $sql = "INSERT INTO Users (email, password, username) VALUES (:email, :password, :username)";
  try {
    $pdo = new pdo("mysql:dbname=$database_name;host=$database_host", $database_user, $database_pass);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

  $stmt = $pdo->prepare($sql);
  $stmt->execute(['email' => $email,
                  'password' => $password,
                  'username' => $username
                  ]);
}

//Need this functon to be passed the user ID and the image id
//For this, in the AddRecipe.php file, need to get fetch ID of user
//Also need to pass the newly created ImageID, use LAST_INCREMENT_ID() to get this ID
function addRecipe($ID, $title, $instructions, $ImageID, $description) {
  global $database_host, $database_user, $database_pass, $database_name;
  $sql = "INSERT INTO Recipes (userID, title, instructions, imageID, description) VALUES (:userID, :title, :instructions, :imageID, :description)";
  $pdo = new pdo("mysql:dbname=$database_name;host=$database_host", $database_user, $database_pass);
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['userID' => $ID,
                  'title' => $title,
                  'instructions' => $instructions, //Instructions in json for, {"instructions": ["", "", ""], "ingredients": ["", "", ""]}
                  'imageID' => $ImageID,
                  'description' => $description
                  ]);
}

function addImage($name, $filetype, $directory) {
  global $database_host, $database_user, $database_pass, $database_name;
  $sql = "INSERT INTO Images (name, filetype, directory) VALUES (:name, :filetype, :directory)";
  $pdo = new pdo("mysql:dbname=$database_name;host=$database_host", $database_user, $database_pass);
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['name' => $name, //Replace each : value with their $ counterpart in $sql
                  'filetype' => $filetype,
                  'directory' => $directory
                ]);
  $last_id = $pdo->lastInsertId(); //Gets id of last record added
  return $last_id;
}

function getUserID($username) {
  global $database_host, $database_user, $database_pass, $database_name;
  $sql = "SELECT ID FROM Users WHERE username = :username";
  $pdo = new pdo("mysql:dbname=$database_name;host=$database_host", $database_user, $database_pass);
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':username' => $username]); //Replace :recipeID with $recipeID in $sql
  $result = $stmt->fetch(PDO::FETCH_ASSOC); //Get the fetched data, stored as a dict
  $userID = $result['ID']; //Get value in column 'password'

  return $userID;
}

function getRecipeImage($recipeID){
  global $database_host, $database_user, $database_pass, $database_name;
  $sql = "SELECT directory FROM Images INNER JOIN Recipes ON (Images.imageID=Recipes.imageID) WHERE Recipes.recipeID = :recipeID";
  $pdo = new pdo("mysql:dbname=$database_name;host=$database_host", $database_user, $database_pass);
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['recipeID' => $recipeID]); //Replace :recipeID with $recipeID in $sql
  $result = $stmt->fetch(PDO::FETCH_ASSOC); //Get the fetched data, stored as a dict
  $directory = $result['directory']; //Get value in column 'password'

  return $directory;
}

//Parameter can be either username or password
function getPasswordHash($parameter) {
  global $database_host, $database_user, $database_pass, $database_name;
  $sql = "SELECT password FROM Users WHERE email = :parameter OR username = :parameter";
  $pdo = new pdo("mysql:dbname=$database_name;host=$database_host", $database_user, $database_pass);
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['parameter' => $parameter]); //Replace :parameter with $parameter in $sql
  $result = $stmt->fetch(PDO::FETCH_ASSOC); //Get the fetched data, stored as a dict
  $passwordHash = $result['password']; //Get value in column 'password'

  return $passwordHash;
}

function getNameFromCookie($cookie_name){
  if(!isset($_COOKIE[$cookie_name])) {
    return false;
  } else {
    return $_COOKIE[$cookie_name];
  }
}

function getIDFromCookie($cookie_name){
  $username = getNameFromCookie($cookie_name);
  if ($username == false){
    return false;
  } else {
    return getUserID($username);
  }
}

getNameFromID($id){
  global $database_host, $database_user, $database_pass, $database_name;
  $sql = "SELECT username FROM Users WHERE ID = :id";
  $pdo = new pdo("mysql:dbname=$database_name;host=$database_host", $database_user, $database_pass);
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':id' => $id]); //Replace :recipeID with $recipeID in $sql
  $result = $stmt->fetch(PDO::FETCH_ASSOC); //Get the fetched data, stored as a dict
  $username = $result['username']; //Get value in column 'password'

  return $username;
}
//addUser("kian@gmail.com", "fojfaiugh", "kiankd");
//echo(getPasswordHash("lewis@gmail.com"));
//echo(addImage("file2.jpeg", "jpeg", "some/directory/file2.jpeg"));
//$json = array("instructions" => array("Chop onion", "Kick pope", "Burn Pasta"), "ingredients" => array("onion", "pope", "pasta"));
//$jsonComp = json_encode($json);
//addRecipe(1, "recipe one", $jsonComp, 2, "Recipe description");
//echo(getRecipeImage(1));
?>
