<?php
    namespace Cep\Model;
    
    class Cep{
        private int $idCep;
        private string $cep;
        private string $ufCep;
        private string $bairroCep;
        private string $estadoCep;
        private string $dataCep;
        private int $idUsuario;

        public function __construct($idCep, $cep, $ufCep, $bairroCep, $estadoCep, $dataCep, $idUsuario){
            $this->idCep = $idCep;
            $this->cep = $cep;
            $this->ufCep = $ufCep;
            $this->bairroCep = $bairroCep;
            $this->estadoCep = $estadoCep;
            $this->dataCep = $dataCep;
            $this->idUsuario = $idUsuario;
        }

        public function get($var){
            return $this->$var;
        }

        public function set($var, $value){
            $this->$var = $value;
        }
    }

    $cep = new Cep(1, "15002500", "SP", "Bairroteste", "São Paulo", "2025-12-03", 1);
    $cep->set("idCep", 21);
    echo $cep->get("idCep");