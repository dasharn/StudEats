<?php

if(!class_exists("db")){
    include 'databaseConnection.php';}
class profile extends db{

    private $username;
    private $email;
    private $date;
    public $PDO;

    function __construct($username){
        $this->PDO = $this->connectdb();
        $this->username = $username;
        $profileData = $this->getInfo();
        // change when using userid -- $this->username = $profileData[0]["username"];
        $this->email = $profileData[0]["email"];
        $date = $profileData[0]["dateCreated"];
        $date = new DateTime($date);
        $this->date = $date->format("d-m-Y");
        $this->PDO = null;
    }

    function getInfo(){
        $sql = 'SELECT * FROM Users WHERE username = ?';
        $stmt = $this->PDO->prepare($sql);

        //copied so change a lil
        if(!$stmt->execute([$this->username])){
            $stmt = null;
            header("location: profile.php?error=stmtfailed");
            exit();
        }

        //same deal
        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: profile.php?error=profileNotFound");
            exit();
        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $profileData;

    }

    function getEmail(){
        echo $this->email;
    }

    function getDate(){
        echo $this->date;
    }
    //function changeInfo(){}


}
