<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Post Name</title>
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js" charset="utf-8"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/48d28d329b.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;500;700&display=swap|Sofia" rel="stylesheet">
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

    <main id="PostContent">
      <?php
      if(isset($_GET["recipeID"])) {
        $recipeID = $_GET["recipeID"];
        include 'private/classes/getPosts.php';

        $dbCon = new getPosts();
        $html = $dbCon->getPostHTML($recipeID);
        echo($html);
      }
      ?>
      <!--
      <div id="Identifiers">
        <img src="images/foodplaceholder.jpg" alt="Placeholder Image">
        <div class="postdetails">
          <h1>Recipe Name</h1>
          <i class="fa-solid fa-user postusername"> Name</i>
          <i class="fa-solid fa-calendar-days postdate"> Date</i>
          <div id="Tags">
            <button type="button" name="button">Vegan</button>
            <button type="button" name="button">Vegetarian</button>
            <button type="button" name="button">Lactose Free</button>
            <button type="button" name="button">Quick</button>
          </div>
        </div>
      </div>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <div id="Ingredients">
        <ul>
          <li>2 eggs</li>
          <li>500g flour</li>
          <li>40g baking soda</li>
          <li>50ml honey</li>
          <li>200ml water</li>
          <li>100g sugar</li>
        </ul>
      </div>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    -->
    </main>
  </body>
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
  </script>
</html>
