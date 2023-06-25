<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'classes/signupClass.php';

    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');
    $password2 = htmlspecialchars($_POST["password2"], ENT_QUOTES, 'UTF-8');

    $signUp = new signUp($username, $email, $password, $password2);
    $result = $signUp->signUp();

    if (str_contains($result, "Error")){
        $error = explode("-", $result);
        // will use to fill in tables when user enters wrong credentials to avoid annoyance
        // session_start();
        // $_SESSION["emailTemp"] = $email;
        // $_SESSION["usernameTemp"] = $username;
        header("location: ../login.php?error=" . $error[0]);
    }
    else{
    header("location: ../profile.php");}
}
