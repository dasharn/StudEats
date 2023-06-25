<?php

if(!class_exists("db")){
include 'databaseConnection.php';}

class login extends db{
    private $email;
    private $password;
    private $PDO;
	
    //passed when constructing class
    function __construct( $email, $password){
        $this->email = $email;
        $this->password = $password;
        $this->PDO = $this->connectdb(); 
    }

    private function stringsValid(){
        if (empty($this->email) || empty($this->password)){
            return false;
        }
        else{
            return true;
        }
    }

    public function loginUser(){
        if(!$this->stringsValid()){
            echo("strings aint valid");
            exit();
        }

        $sql = "SELECT password FROM Users WHERE email = ?";
        $stmt = $this->PDO->prepare($sql);

        if(!$stmt->execute([$this->email])){
            return "SQL-Error";
        }

        if($stmt->rowcount() == 0){
            return "DE-Error"; //email and/or password dont exist
        }

        $pwdHash = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pwdSame = password_verify($this->password, $pwdHash[0]["password"]);
        
        if($pwdSame == false){
            return "PW-Error"; //password is wrong
        }
        else if ($pwdSame){
            $sql = "SELECT * FROM Users WHERE email = ?";
            $stmt = $this->PDO->prepare($sql);
            if(!$stmt->execute([$this->email])){
                return "SQL-Error";
            }
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION["userID"] = $user[0]["ID"];
            $_SESSION["username"] = $user[0]["username"];
            return "based!";
        }

    }

}

    

?>