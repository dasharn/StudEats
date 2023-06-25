<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();
    include("classes/databaseConnection.php");
    $db = new db();
    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $username2 = htmlspecialchars($_POST["username2"], ENT_QUOTES, 'UTF-8');

    if($username == $username2){
        $PDO = $db->connectdb();
    $sql = "SELECT username FROM Users WHERE username = ?";
    $stmt = $PDO->prepare($sql);
    if (!$stmt->execute([$username])){
        header("location: ../profile.php?error=STMTFAILED#username");
        exit();
    }
    if($stmt->rowcount() > 0){
        header("location: ../profile.php?error=USERNAMETAKEN#username");
        exit();
    }
    $sql = "UPDATE Users SET username = ? WHERE username = ?";
    $stmt = $PDO->prepare($sql);
    if (!$stmt->execute([$username, $_SESSION["username"]])){
        header("location: ../profile.php?error=STMTFAILED#username");
        exit();}
    $_SESSION["username"] = $username;
    header("location: ../profile.php");
    }
}