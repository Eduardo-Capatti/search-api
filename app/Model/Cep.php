<?php
    require "../Model/Connection.php";

    class Cep extends Connection{
        private $idCep;
        private $cep;
        private $ufCep;
        private $bairroCep;
        private $estadoCep;
        private $cidadeCep;
        private $logradouroCep;
        private $dataCep;
        private $latitudeCep;
        private $longitudeCep;
        private $idUsuario;

        public function get($var){
            return $this->$var;
        }

        public function set($var, $value){
            $this->$var = $value;
        }

        public function getJSON(){
            $options = array(
                CURLOPT_URL => "https://viacep.com.br/ws/$this->cep/json/",
                CURLOPT_RETURNTRANSFER => true
            );
            $ci = curl_init();
            curl_setopt_array($ci, $options);

            $response = curl_exec($ci);
            curl_close($ci);

            return json_decode($response);
        }

        public function insertCep(){
            $query = "INSERT INTO cep (cep, ufCep, bairroCep, cidadeCep, estadoCep, logradouroCep, idUsuario, latitudeCep, longitudeCep) 
                      VALUES (:cep, :ufCep, :bairroCep, :cidadeCep, :estadoCep, :logradouroCep, :idUsuario, :latitudeCep, :longitudeCep);";

            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(":cep", $this->cep);
            $stmt->bindValue(":ufCep", $this->ufCep);
            $stmt->bindValue(":bairroCep", $this->bairroCep);
            $stmt->bindValue(":cidadeCep", $this->cidadeCep);
            $stmt->bindValue(":logradouroCep", $this->logradouroCep);
            $stmt->bindValue(":estadoCep", $this->estadoCep);
            $stmt->bindValue(":idUsuario", $this->idUsuario);
            $stmt->bindValue(":latitudeCep", $this->latitudeCep);
            $stmt->bindValue(":longitudeCep", $this->longitudeCep);

            $stmt->execute();
        }

        public function updateCepDate(){
            $query = "UPDATE cep set dataCep = current_timestamp WHERE idCep = :idCep";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":idCep", $this->idCep);
            $stmt->execute();
        }

        public function selectAllUserCep(){
            $query = "SELECT * FROM cep WHERE idUsuario = :idUsuario ORDER BY dataCep DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":idUsuario", $this->idUsuario);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function selectSearchedCep(){
            $query = "SELECT * FROM cep WHERE cep = :cep AND idUsuario = :idUsuario";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":cep", $this->cep);
            $stmt->bindValue(":idUsuario", $this->idUsuario);

            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function getMapsInfo(){
            $search = urlencode("$this->logradouroCep $this->cidadeCep $this->ufCep $this->estadoCep");
            $options = array(
                CURLOPT_URL => "https://nominatim.openstreetmap.org/search?format=json&q=$search",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    "User-Agent: searchCEP"
                ]
            );
            $ci = curl_init();
            curl_setopt_array($ci, $options);
        
            $response = curl_exec($ci);
            curl_close($ci);

            return json_decode($response);
        }
    }
