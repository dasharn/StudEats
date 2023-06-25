<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();
    include("classes/databaseConnection.php");
    $db = new db();
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $email2 = htmlspecialchars($_POST["email2"], ENT_QUOTES, 'UTF-8');

    if($email == $email2){
        $PDO = $db->connectdb();
    $sql = "SELECT email FROM Users WHERE email = ?";
    $stmt = $PDO->prepare($sql);
    if (!$stmt->execute([$email])){
        header("location: ../profile.php?error=STMTFAILED#email");
        exit();
    }
    if($stmt->rowcount() > 0){
        header("location: ../profile.php?error=EMAILTAKEN#email");
        exit();
    }
    $sql = "UPDATE Users SET email = ? WHERE username = ?";
    $stmt = $PDO->prepare($sql);
    if (!$stmt->execute([$email, $_SESSION["username"]])){
        header("location: ../profile.php?error=STMTFAILED#email");
        exit();}
    header("location: ../profile.php");
    }
}
