<?php

class database{
    private $hostname = '172.31.22.43';
    private $username = 'Richard200182873';
    private $password = '6iG35kFj7Y';
    private $database = 'Richard200182873';
    public $conn;

    public function __construct(){
        $this -> conn = mysqli_connect( $this -> hostname, $this -> username, $this -> password, $this -> database);
        if(mysqli_connect_error()){
            die("Failed to connect to the server. " . mysqli_connect_error());
        }
        if(!$this->conn){
            echo "<p>Cannot connect to database.</p>";
            exit;
        }
    }

    public function read($login, $password){
        $query = "SELECT * FROM family where (username = '$login' or email = '$login') and password = '$password';";
        $res = $this -> conn -> query($query);
        $row = $res -> fetch_assoc();
        
        if(!$row['userID']){
            return false;
        }
        
        
        if(isset($_SESSION['userID'])){
            session_unset();
            session_destroy();
        }
        
        session_start();
        $_SESSION['userID'] = $row['userID'];
        return true;
    }

    public function create($firstName, $lastName, $username, $email, $password, $mailList){
        $query = "INSERT INTO family VALUES( Null, '$firstName', '$lastName', '$username', '$email', '$password', '$mailList');";
        $res = $this -> conn -> query($query);
        if(!$res){
            return false;
        }
        return true;
    }

    
}