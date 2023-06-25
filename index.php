<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Landing</title>
    <script src="scripts.js" charset="utf-8"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/48d28d329b.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&display=swap|Sofia" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
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
    <div id="FilterBox">
      <div id="FilterBoxTop">

      </div>
      <div id="FilterBoxBottom">

      </div>
      <h1 id="Header">Welcome!</h1>
      <div class="NavMid">
        <button class="sectionlinks" onclick="showSection(event, 'Section1')" id="defaultOpen">Recipes</button>
        <button class="sectionlinks" onclick="showSection(event, 'Section2')">Skills</button>
      </div>

      <div id="Section1" class="sectioncontent">
        <?php
          include 'private/classes/getPosts.php';

          $dbCon = new getPosts();
          $html = $dbCon->getLandingHTML();
          foreach ($html as $key => $value) {
            echo($html[$key]["link"]);
            echo($html[$key]["image"]);
            echo($html[$key]["name"]);
            echo($html[$key]["description"]);
          }
        ?>
      </div>

      <div id="Section2" class="sectioncontent">
        <h3 class="comingSoon">Coming Soon!</h3>
      </div>

      <script type="text/javascript">

        let usernameSession = "<?php if(isset($_SESSION['username'])) {
                                      echo($_SESSION['username']);}
                                      else {
                                        echo(null);
                                      }
          ?>";
        document.getElementById("defaultOpen").click();

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

    </div>
  </body>
</html>
