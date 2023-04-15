<?php
class User{
    private $userID;
    private $username;
    private $email;
    private $type;

    function __construct($userID,$username,$email,$type){
        $this->userID = $userID;
        $this->username = $username;
        $this->email = $email;
        $this->type = $type;
    }
    function getUserID(){
        return $this->userID;
    }
    function getUsername(){
        return $this->username;
    }
     
    function getEmail(){
        return $this->email;
    }
    
    function getType(){
        return $this->type;
    }
}
?>
