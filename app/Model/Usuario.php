<?php    
    require "../Model/Connection.php";
    
    class Usuario extends Connection{
        private $idUsuario;
        private $emailUsuario;
        private $nomeUsuario;
        private $senhaUsuario;

        public function get($var){
            return $this->$var;
        }

        public function set($var, $value){
            $this->$var = $value;
        }

        public function insertUsuario(){
            $query = "INSERT INTO usuario (nomeUsuario, emailUsuario, senhaUsuario) 
                      VALUES (:nomeUsuario, :emailUsuario, :senhaUsuario);";

            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(":nomeUsuario", $this->nomeUsuario);
            $stmt->bindValue(":emailUsuario", $this->emailUsuario);
            $stmt->bindValue(":senhaUsuario", $this->senhaUsuario);

            $stmt->execute();
        }

        public function loginUsuario(){
            $query = "SELECT idUsuario FROM usuario WHERE emailUsuario = :emailUsuario AND senhaUsuario = :senhaUsuario";

            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(":emailUsuario", $this->emailUsuario);
            $stmt->bindValue(":senhaUsuario", $this->senhaUsuario);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function isEmailValid(){
            $query = "SELECT idUsuario FROM usuario WHERE emailUsuario = :emailUsuario";

            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(":emailUsuario", $this->emailUsuario);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        }
    }
