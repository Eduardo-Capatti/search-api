<?php

    abstract class Connection{

        private string $host = "mysql:host=localhost;dbname=cep;charset=utf8";
        private string $user = "root";
        private string $password = "";
        protected $conn;

        public function __construct(){
            try{
                $this->conn = new PDO($this->host,$this->user,$this->password);
            }catch(PDOException $e){
                echo $e;
            }
        }
    }    
