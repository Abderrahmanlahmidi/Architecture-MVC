<?php

Class usersConnection{

    private  $host = "localhost";
    private  $dbname = "mvcdb";
    private  $username = "root";
    private  $password = "123123321321@instance";

    private $conn;


    public function __construct(){
        $dsn ="mysql:host=$this->host;dbname:$this->dbname";
        $this-> conn = new PDO($dsn, $this->username, $this->password);
        $this -> conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection(){
        if($this -> conn){
           return $this->conn;
        }else{
            return null;
        }
    }

}


$usersConnection = new usersConnection();





