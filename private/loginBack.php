<?php

session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
echo("on login page");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    echo("isset!");
    include "classes/loginClass.php";

    //grabbing data
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');

    $login = new login($email, $password);
    $result = $login->loginUser();

    if (str_contains($result, "Error")){
        $error = explode("-", $result);
        session_start();
        $_SESSION["emailTemp"] = $email;
        header("location: ../login.php?error=" . $error[0]);
    }
    else if(isset($_SESSION["username"])){
        header("location: ../profile.php?username=" . $_SESSION["username"]);
    }



}

//make error for if not set, same for signup
