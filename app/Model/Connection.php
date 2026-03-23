<?php

    namespace App;

    class Connection{

        private string $host = "mysql:host=localhost;dbname=cep;charset=utf8";
        private string $user = "root";
        private string $password = "";

        public function getDb(){
            try{
                $conn = new \PDO($this->host,$this->user,$this->password);
                return $conn;
            }catch(\PDOException $e){
                echo $e;
            }
        }
    }

    $conn = new Connection();
    $conn->getDb();