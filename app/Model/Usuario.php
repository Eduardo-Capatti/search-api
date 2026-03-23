<?php
    namespace Usuario\Model;
    
    class Usuario{
        private int $idUsuario;
        private string $emailUsuario;
        private string $nomeUsuario;
        private string $senhaUsuario;

        public function __construct($idUsuario, $emailUsuario, $nomeUsuario, $senhaUsuario){
            $this->idUsuario = $idUsuario;
            $this->emailUsuario = $emailUsuario;
            $this->nomeUsuario = $nomeUsuario;
            $this->senhaUsuario = $senhaUsuario;
        }

        public function get($var){
            return $this->$var;
        }

        public function set($var, $value){
            $this->$var = $value;
        }
    }

    $usuario = new Usuario(1,"teste@gmail.com","Teste2","123456");
    $usuario->set("idUsuario", 12);
    echo $usuario->get("idUsuario");