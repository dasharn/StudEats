<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Search</title>
    <link rel="stylesheet" href="search.css">
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

    <!--
    <div class="m_list_tit" style="margin-top: 50px; margin-left: 40px; font-size: 22px;">
        There are a total of <b style="color: darkorange;">100</b> delicious recipes.
    </div>
  -->

    <!--
    <div class="NavMid" style="margin-left: 40px; margin-top: 30px;">
      <button class="sectionlinks" onclick="showSection(event, 'Section1')" id="defaultOpen">In exact order</button>
      <button class="sectionlinks" onclick="showSection(event, 'Section2')">Newest</button>
      <button class="sectionlinks" onclick="showSection(event, 'Section3')">Recommendation order</button>
    </div>
    -->

      <?php
        if(isset($_GET["search"])){
          include 'private/classes/getPosts.php';

          $dbCon = new getPosts();
          $html = $dbCon->getSearchHTML($_GET["search"]);
          if (count($html) != 0) {
            echo("<ul class=\"common_sp_list_ul ea4\" style=\"padding:0 0 0 8px; margin-top: 70px;\">");
            foreach ($html as $key => $value) {
              echo($html[$key]["link"]);
              echo($html[$key]["image"]);
              echo($html[$key]["name"]);
            }
            echo("</ul>");
          } else {
            echo("<h3 style=\"text-align:center;\"> There don't seem to be any results for what you're looking for.</h3>");
            echo("<h3 style=\"text-align:center;\"> Try searching something else, or browse the home page.</h3>");
          }
        }
      ?>
      <!--
      <li class="common_sp_list_li" style="margin-left: 110px;">
          <div class="common_sp_thumb">
              <a>
                  <img src="https://recipe1.ezmember.co.kr/cache/recipe/2018/09/09/9308e339ab6033260f1e18b6945ca7bf1_m.jpg">
              </a>
          </div>
          <div class="common_sp_caption">
              <div class="common_sp_caption_tit line2"><b>Title of the recipe</b></div>
              <div class="common_sp_caption_rv_name" style="display: inline-block; vertical-align: bottom;">
                  <a href="index.html">username</a>
              </div>
              <div class="common_sp_caption_rv">
                <span class="common_sp_caption_rv_star"><img src="https://recipe1.ezmember.co.kr/img/mobile/icon_star2_on.png"><img src="https://recipe1.ezmember.co.kr/img/mobile/icon_star2_on.png"><img src="https://recipe1.ezmember.co.kr/img/mobile/icon_star2_on.png"><img src="https://recipe1.ezmember.co.kr/img/mobile/icon_star2_on.png"><img src="https://recipe1.ezmember.co.kr/img/mobile/icon_star2_on.png"></span>
                    <span class="common_sp_caption_buyer" style="vertical-align: middle;">views 2.5k</span>
              </div>
          </div>
      </li>
    -->

    <!--
    <nav class="text-center" style="text-align: center;;">
      <ul class="pagination">
        <li class="active"><a href="index.html">1</a></li>
        <li><a href="index.html">2</a></li>
        <li><a href="index.html">3</a></li>
        <li><a href="index.html">4</a></li>
        <li><a href="index.html">5</a></li>
        <li><a href="index.html">6</a></li>
        <li><a href="index.html">7</a></li>
        <li><a href="index.html">8</a></li>
        <li><a href="index.html">9</a></li>
        <li><a href="index.html">10</a></li>
        <li><a href="index.html" aria-label="Next"><span aria-hidden="true">&gt;</span></a></li>
      </ul>
    </nav>
  -->
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
