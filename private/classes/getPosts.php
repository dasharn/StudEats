<?php

include 'databaseCOnnection.php';

class getPosts extends db{
  private $PDO;
  private $arr;
  private $count;

  function __construct(){
    $this->PDO = $this->connectdb();
    $this->arr = array();
    $this->count = 0;
  }

  function setBaseArray(){
    $this->arr = array();
  }

  function getLandingPosts(){
    $this->setBaseArray();
    $sql = "SELECT * FROM Recipes LIMIT 6"; //Select top 6 recipes from db
    $stmt = $this->PDO->prepare($sql);
    if (!$stmt->execute()){
      return false;
    }
    $r = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // FETCHING DATA FROM DATABASE
    $result = $stmt->fetchAll();
    // OUTPUT DATA OF EACH ROW
    foreach ($result as $row) {
      $values = array("recipeID" => $row["recipeID"],
                        "userID" => $row["userID"],
                        "title" => $row["title"],
                        "intructions" => $row["instructions"],
                        "imageID" => $row["imageID"],
                        "description" => $row["description"]);
      array_push($this->arr, $values);
    }
  }

  function getSearchPosts($search) {
    $this->setBaseArray();
    $sql = "SELECT * FROM Recipes WHERE title LIKE :search LIMIT 16";
    $stmt = $this->PDO->prepare($sql);
    if (!$stmt->execute(["search" => "%" . $search . "%"])){
      return false;
    }

    $r = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    foreach ($result as $row) {
      $values = array("recipeID" => $row["recipeID"], "userID" => $row["userID"], "title" => $row["title"], "intructions" => $row["instructions"], "imageID" => $row["imageID"], "description" => $row["description"]);
      array_push($this->arr, $values);
    }
  }

  //Gets recipe image from a specific post
  function getRecipeImage($recipeID){
    $sql = "SELECT * FROM Images INNER JOIN Recipes ON (Images.imageID=Recipes.imageID) WHERE Recipes.recipeID = :recipeID";
    $stmt = $this->PDO->prepare($sql);
    if (!$stmt->execute(['recipeID' => $recipeID])){
      return false;
    } //Replace :recipeID with $recipeID in $sql
    $result = $stmt->fetch(PDO::FETCH_ASSOC); //Get the fetched data, stored as a dict
    $directory = $result["directory"]; //Get value in column 'password'
    $title = $result["name"];

    return array($directory, $title);
  }

  function getRecipeAuthor($recipeID){
    $sql = "SELECT username FROM Users INNER JOIN Recipes ON (Users.ID=Recipes.userID) WHERE Recipes.recipeID = :recipeID";
    $stmt = $this->PDO->prepare($sql);
    if (!$stmt->execute(['recipeID' => $recipeID])){
      return false;
    } //Replace :recipeID with $recipeID in $sql
    $result = $stmt->fetch(PDO::FETCH_ASSOC); //Get the fetched data, stored as a dict
    $username = $result['username'];

    return $username;
  }

  function getLandingHTML() {
    $this->getLandingPosts();
    $htmlArray = array();
    foreach ($this->arr as $key => $value) {
      $recipeID = $this->arr[$key]["recipeID"];
      $array = $this->getRecipeImage($recipeID);
      $directory = $array[0];
      $title = $array[1];
      $htmlPiece = array("link" => "<div class=\"postthumbnail\" onclick=\"location.href='post.php?recipeID=" . $this->arr[$key]["recipeID"] . "'\">",
                         "image" => "<img src=\"" . $directory . "\" alt=\"" . $title . "\">",
                         "name" => "<h3>" . $this->arr[$key]["title"] . "</h3>",
                         "description" => "<p>" . $this->arr[$key]["description"] . "</p> </div>");
      array_push($htmlArray, $htmlPiece);
    }

    return $htmlArray;

  }

  function getPostHTML($recipeID){ //Will return a string that contains all the html for a gievn post
    $sql = "SELECT * FROM Recipes WHERE recipeID = :recipeID";
    $stmt = $this->PDO->prepare($sql);
    if (!$stmt->execute(['recipeID' => $recipeID])){
      return false;
    } //Replace :recipeID with $recipeID in $sql
    $resultRecipe = $stmt->fetch(PDO::FETCH_ASSOC); //Get the fetched data, stored as a dict
    $imageID = $resultRecipe["imageID"];
    $array = $this->getRecipeImage($recipeID);
    $imgDirectory = $array[0];
    $imgTitle = $array[1];
    $username = $this->getRecipeAuthor($recipeID);
    $tags = json_decode($resultRecipe["tags"]);
    $tags = json_decode(json_encode($tags), true);
    //Identifiers section
    $html = "<div id=\"Identifiers\">";
    $html = $html . "<img src=\"" . $imgDirectory . "\" alt=\"" . $imgTitle . "\">";
    $html = $html . "<div class=\"postdetails\">";
    $html = $html . "<h1>" . $resultRecipe["title"] . "</h1>";
    $html = $html . "<a href=\"profile.php?username=" . $username . "\"><i class=\"fa-solid fa-user postusername\">      " . $username . "</i></a>";
    //Tags
    $html = $html . "<div id=\"Tags\">";
    $html = $html . "<i class=\"fa-solid fa-earth-americas\">      " . $tags["country"] . "</i>";
    $html = $html . "<i class=\"fa-solid fa-clock\">      " . $tags["prepTime"] . "</i>";
    $html = $html . "<i class=\"fa-solid fa-square-check\">      " . $tags["difficulty"] . "</i>";
    $html = $html . "</div></div></div>";
    //description
    $html = $html . "<p>" . $resultRecipe["description"] . "</p>";
    //Ingredients and recipe
    $html = $html . "<div id=\"Ingredients\"><ul>";
    $instructions = json_decode(json_encode($resultRecipe["instructions"]), true);
    $instructions = json_decode($instructions, true);
    foreach ($instructions["ingredients"] as $value) {
      $html = $html . "<li>" . $value . "</li>";
    }
    $html = $html . "</ul></div>";
    $html = $html . "<div id=\"Instructions\"><ol>";
    foreach ($instructions["instructions"] as $value) {
      $html = $html . "<li>" . $value . "</li>";
    }
    $html = $html . "</ol></div>";

    return $html;

    //recipe
  }

  function getSearchHTML($search) {
    $this->getSearchPosts($search);
    $htmlArray = array();
    if (count($this->arr) != 0) {
      foreach ($this->arr as $key => $value) {
        $recipeID = $this->arr[$key]["recipeID"];
        $array = $this->getRecipeImage($recipeID);
        $directory = $array[0];
        $title = $array[1];
        $htmlPiece = array("link" => "<div class=\"postthumbnail\" onclick=\"location.href='post.php?recipeID=" . $this->arr[$key]["recipeID"] . "'\">
                                        <li class=\"common_sp_list_li\" style=\"margin-left: 110px;\">
                                          <div class=\"common_sp_thumb\"><a>",
                           "image" => "<img src=\"" . $directory . "\" alt=\"" . $title . "\">
                                        </a>
                                        </div>
                                        <div class=\"common_sp_caption\">
                                        <div class=\"common_sp_caption_tit line2\">",
                           "name" => "<b>" . $this->arr[$key]["title"] . "</b></div>
                                      <div class=\"common_sp_caption_rv_name\" style=\"display: inline-block; vertical-align: bottom;\">
                                      <a href=\"profile.php?username=" . $this->getRecipeAuthor($recipeID) . "\">" . $this->getRecipeAuthor($recipeID) . "</a>
                                      </div></li></div>");
        array_push($htmlArray, $htmlPiece);
      }
    }

    return $htmlArray;

  }

  function getProfileHTML($username){
    $htmlArray = array();
    $sql = "SELECT * FROM Recipes INNER JOIN Users ON (Users.ID=Recipes.userID) WHERE Users.username = :username";
    $stmt = $this->PDO->prepare($sql);
    if (!$stmt->execute(['username' => $username])){
      return false;
    }
    $result = $stmt->fetch(PDO::FETCH_ASSOC); //Get the fetched data, stored as a dict
    $result = $stmt->fetchAll();
    foreach ($result as $row) {
      $recipeID = $row["recipeID"];
      $imageArray = $this->getRecipeImage($recipeID);
      $htmlPiece = array("link" => "<div class=\"recipe-profile\" onclick=\"location.href='post.php?recipeID=" . $recipeID . "'\">",
                         "image" => "<div class=\"image-recipe-profile\" style=\"background: url('" . $imageArray[0] . "') no-repeat;\"></div>",
                         "name" => "<h4>" . $row["title"] . "</h4>",
                         "description" => "<p>" . $row["description"] . "</p> </div>");
      array_push($htmlArray, $htmlPiece);
    }
    return $htmlArray;
  }
}
?>
