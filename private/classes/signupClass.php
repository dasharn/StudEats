
<?php

if(!class_exists("db")){
include 'databaseConnection.php';}

class signUp extends db{
    private $email;
    private $username;
    private $password;
    private $password2;
    private $PDO;
	
    //passed when constructing class
    function __construct($username, $email, $password, $password2){
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->password2 = $password2;
        $this->PDO = $this->connectdb(); 
    }
    

    //functions to check if user entires are valid

    private function emailValid(){
        if((filter_var($this->email, FILTER_VALIDATE_EMAIL)) == false || empty($this->email)){
            return false;
        }
        else {
            return true;
        }
    }

    private function usernameValid(){
        if((preg_match("/^[a-zA-Z0-9!?]*$/", $this->username)) == false || empty($this->username)){
            return false;
        }
        else {
            return true;
        }
    }

    private function passwordValid(){
        if((preg_match("/^[a-zA-Z0-9!?]*$/", $this->password)) == false || empty($this->password)){
            return false;
        }
        else {
            return true;
        }
    
    }

    private function passwordsMatch(){
        if($this->password != $this->password2){
            return false;
        }
        else {
            return true;
        }
    }

    //signup PDO statements -- needs error handling for when executes dont work

    //checks to see if there are any rows where username or email is already taken
    private function checkIfExists(){
    $sql = "SELECT username FROM Users WHERE username = ?";
    $stmt = $this->PDO->prepare($sql);
    if (!$stmt->execute([$this->username])){ //returns 0 for error if the statment doesnt execute
        return 0;
    }
    if($stmt->rowcount() > 0){
        return 1;
    }
    $sql = "SELECT email FROM Users WHERE email = ?";
    $stmt = $this->PDO->prepare($sql);
    if (!$stmt->execute([$this->email])){
        return 0;
    }
    if($stmt->rowcount() > 0){
        return 2;
    }
    return 3;
    }

    private function addUser(){
    $sql = "INSERT INTO Users (email, password, username) VALUES (:email, :password, :username)";
    
    $pwdHash = password_hash($this->password, PASSWORD_BCRYPT);

    $stmt = $this->PDO->prepare($sql);
    if (!$stmt->execute(['email' => $this->email,
                  'password' => $pwdHash,
                  'username' => $this->username
                  ])){
                    return false;
                  }
    return true;
                }
    

    //need html shits for the errors in this fucntion 👍
    public function signUp(){
        if(!$this->emailValid()){
            return "ENV-Error"; //email not valid
        }
        if(!$this->usernameValid()){
            return "UNV-Error";//username not valid
        }
        if(!$this->passwordValid()){
            return "PNV-Error";//password not valid
        }
        if(!$this->passwordsMatch()){
            return "PNM-Error"; //passwords dont match
        }
        switch ($this->checkIfExists()){
            case 0:
                return "SQL-Error";//error executing the SQL
            case 1:
                return "UT-Error";//username taken
            case 2:
                return "ET-Error";//email taken
            case 3:
                break;
        }
        if (!$this->addUser()){
            return "FAU-Error";//Failed adding user
        }
        else{
            session_start();
            $_SESSION["username"] = $this->username;
            return "Success!";
        }

        
    }
    
}

    

?>