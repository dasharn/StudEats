<?php
//TODO get header same on all pages so look same and code is consistent
//also need to change the session data to purely userID so the user can change username
require_once('private/classes/getPosts.php');
require_once("private/classes/profileclass.php");

session_start();
$profile = null;
$profileState = 0;  //0 means isnt logged in and not viewing another persons profile, 1 is another persons profile and 2 is own profile
$sessionSet = isset($_SESSION["username"]);
$username = null;
if(isset($_POST["username"])){
  if($sessionSet){
    if ($_SESSION["username"] == $_POST["username"]){
      $profile = new profile($_SESSION["username"]);
      $profileState = 2;
      $username = $_SESSION["username"];
    }
    else{
      $profile = new profile($_POST["username"]);
      $profileState = 1;
      $username = $_GET["username"];
    }
  }
}
else if(isset($_SESSION["username"])){
  $profile = new profile($_SESSION["username"]);
  $profileState = 2;
  $username = $_SESSION["username"];
}
 ?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link rel="stylesheet" href="styles.css?<?php echo time();//remove timestamp when done ?>">
    <script src="scripts.js" charset="utf-8"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/48d28d329b.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&display=swap|Sofia" rel="stylesheet">
  </head>

  <body>
    <nav id="NavTop">
      <button type="button" name="button" id="Login">

      </button>
      <input type="text" placeholder="&#x1F50E;&#xFE0E; Search.." id="SearchBox">
      <a href="index.php" id="Logo">
        <img src="images/logo_transperent_bg.png" alt="logo image" class="Logo">
      </a>
    </nav>

   <div class="profile-head">
     <i class="fa-regular fa-user user-icon-profile" style="color: var(--orange);"></i>
     <h1 class="profile-name"><?php
      switch ($profileState){
        case 0:
          break;
        case 1 or 2:
          echo $username;
      }
    ?></h1> <!-- Add code to get name from id -->
   </div>

   <div class="profile-section-header">
     <h3>Recipes</h3>
     <h3>User Information</h3>
   </div>
   <div class="profile-content">
     <div class="profile-left">
       <?php
       if($profile == null){
        echo '<p style="text-align:center;">Log in or create an account to start making posts<p>'; //add proper css
       }
        $numberOfPosts = 0;
        if($profileState == 1 or $profileState == 2){

          $dbCon = new getPosts();
          $html = $dbCon->getProfileHTML($username);
          if (count($html) != 0) {
            foreach ($html as $key => $value) {
              echo($html[$key]["link"]);
              echo($html[$key]["image"]);
              echo($html[$key]["name"]);
              echo($html[$key]["description"]);
              $numberOfPosts++;
            }
          } else {
            echo("<h3 style=\"text-align:center;\"> No posts have been made yet.</h3>");

          }
        }
      ?>

     </div>
     <div id="right-no-edit" class="profile-right">
       <div class="settings-textbox">
         <p>Date Account Was Created - <?php
         if($profile != null){
            $profile->getDate();} ?></p>
       </div>
       <div class="settings-textbox">
         <p>Number Of Recipes Posted - <?php echo $numberOfPosts; ?></p>
       </div>
       <?php
       if($profileState == 2){
        include("private/profilechangableFields.php");}

       ?>
       <!--
       Add if to this button so it only apppears if user is logged in and viewing own account
       <button type="button" name="button" id="edit-profile" onclick="showRightProfile('event', 'right-edit')">Edit Profile</button>
       -->
     </div>

     <?php //if(isset($_SESSION)){
      //echo "hello";
      //include("private/profileEdit.php");}
     ?>
   </div>

   <script type="text/javascript">
   let usernameSession = "<?php if(isset($_SESSION['username'])) {
                                 echo($_SESSION['username']);}
                                 else {
                                   echo(null);
                                 }
     ?>";

     if (usernameSession != null && usernameSession != ""){
       document.getElementById("Login").innerHTML = "<i class=\"fa-regular fa-user user-icon\" style=\"color: var(--orange);\"></i>\
                                                    <pre class=\"user-name\">" + usernameSession + "</pre>\
                                                    <i class=\"fa-solid fa-chevron-up chevron-login\" style=\"color: var(--orange)\"></i>\
                                                    <div id=\"drop-menu-container\">\
                                                    </div>";
       document.getElementById("drop-menu-container").innerHTML = "<div class=\"drop-menu-LoggedIn\">\
                                                                    <a href=\"profile.php?username=" + usernameSession + "\">Profile Page</a>\
                                                                    <a href=\"submit.php\">Submit Recipe</a>\
                                                                    <a href=\"deletesession.php\">Log Out</a>\
                                                                  </div>";
    }

    if (usernameSession == null || usernameSession == "") {
      document.getElementById("Login").innerHTML = "<i class=\"fa-regular fa-user user-icon\" style=\"color: var(--orange);\"></i>\
                                                    <pre class=\"user-name\">Login</pre>\
                                                    <i class=\"fa-solid fa-chevron-up chevron-login\" style=\"color: var(--orange)\"></i>\
                                                    <div id=\"drop-menu-container\">\
                                                    </div>";

      document.getElementById("drop-menu-container").innerHTML = "<div class=\"drop-menu\">\
                                                                     <a href=\"login.php\">Log in</a>\
                                                                  </div>";
    }

     var search = document.getElementById("SearchBox");
     search.addEventListener("keypress", function(event) {
       // If the user presses the "Enter" key on the keyboard
       if (event.key === "Enter") {
         window.location.href = "/searchpage.php?search=" + search.value;
       }
     });

     document.getElementById("view-profile").click();
     document.getElementById("defaultOpenEdit").click();

     document.getElementById("defaultOpen").click();
   </script>
 </body>
