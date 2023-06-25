<?php session_start(); ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/48d28d329b.js" crossorigin="anonymous"></script>
    <script src="scripts.js" charset="utf-8"></script>
    <script src="backgroundChange.js" charset="utf-8"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&display=swap|Sofia" rel="stylesheet">
    <link rel="stylesheet" href="loginStyles.css">
  </head>
  <body>
    <div class="backgroundContainer">
      <a href="index.php" id="Logo">
        <img src="images/logo_transperent_bg.png" alt="logo image" class="Logo">
      </a>
      <div class="foregroundContainer">
        <div id="loginButtonBack" class="loginSections">
          <h2>Login</h2>
          <?php if(isset($_GET["error"])){
                                if($_GET["error"] == "DE" or $_GET["error"] == "PW"){
                                    echo "<p style=\"color: red;\">The Password or email is wrong</p>";
                                }
                            }
                            ?>
          <form class="loginForm" action="private/loginBack.php" method="post">
            <input class="inputBoxes" type="email" name="email" value="" placeholder="Email" required>
            <input class="inputBoxes" type="password" name="password" value="" placeholder="Password" required>
            <p class="loginError"></p>
            <div class="submitButtons">
              <input type="submit" name="submitButtonLogin" value="Login">
              <input type="button" name="submitButton" onclick="showLogin(event, 'signupButtonBack')" value="Sign Up" class="signupLinks">
            </div>
          </form>
        </div>

        <div id="signupButtonBack" class="loginSections">
          <h2>Sign Up</h2>
          <?php if(isset($_GET["error"])){
                                if($_GET["error"] == "ET"){
                                    echo "<p style=\"color: red;\">This email is taken, try another</p>";
                                }
                                else if ($_GET["error"] == "UT"){
                                    echo "<p style=\"color: red;\">This email is taken, try another</p>";
                                }
                            }
                            ?>
          <form class="loginForm" action="private/signupBack.php" method="post">
            <input class="inputBoxes" type="email" name="email" value="" placeholder="Enter an Email" required>
            
            <input class="inputBoxes" type="text" name="username" value="" placeholder="Enter an Username" required pattern="^[a-zA-Z0-9!?]*$">
            <input class="inputBoxes" type="password" name="password" value="" placeholder="Enter a Password" required pattern="^[a-zA-Z0-9!?]*$">

            <input class="inputBoxes" type="password" name="password2" value="" placeholder="Reenter the Password" required>
            <!-- <p class="password2Error"></p> -->
            <div class="submitButtons">
              <input type="submit" value="Create Account" name="submitButtonSignup">
              <input type="button" name="loginButton" onclick="showLogin(event, 'loginButtonBack')" value="Login" class="signupLinks" id="defaultOpen">
            </div>
          </form>
        </div>
      </div>
    </div>





    <script type="text/javascript">
      document.getElementById("defaultOpen").click();
    </script>

  </body>
</html>
