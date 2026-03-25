<?php
    session_start();

    require "../Model/Usuario.php";
    
    //Errors 1- invalid email, 2- unexpected error
    if($_POST["url"] == "register"){
        try{
            $usuario = new Usuario();

            if($_POST["nome"] && $_POST["email"] && $_POST["senha"]){
                $usuario->set("nomeUsuario", $_POST["nome"]);
                $usuario->set("emailUsuario", $_POST["email"]);
                $usuario->set("senhaUsuario", $_POST["senha"]);
                
                $data = $usuario->isEmailValid();
                
                if($data){
                    header("Location: ../View/register.php?error=1");
                    exit;
                }

                $usuario->insertUsuario();

                $data = $usuario->loginUsuario();

                if(!$data->idUsuario){
                    header("Location: ../View/register.php?error=2");
                    exit;
                }
                $_SESSION["idUsuario"] = $data->idUsuario;
                header("Location: ../View/index.php");
                exit;
                
            }
        }catch(Exception $e){
            header("Location: ../View/register.php?error=2");
        }
    }
   
    //Errors 1- invalid credentials, 2- unexpected error
    if($_POST["url"] == "login"){
        try{
            $usuario = new Usuario();

            if($_POST["email"] && $_POST["senha"]){
                $usuario->set("emailUsuario", $_POST["email"]);
                $usuario->set("senhaUsuario", $_POST["senha"]);

                $data = $usuario->loginUsuario();

                if(!$data->idUsuario){
                    header("Location: ../View/login.php?error=1");
                    exit;
                }

                $_SESSION['idUsuario'] = $data->idUsuario;
                header("Location: ../View/index.php");
                exit;
            }
        }catch(Exception $e){
            header("Location: ../View/login.php?error=2");
            exit;
        }
    }

    if($_POST["url"] == "logout"){
        session_destroy();
        header("Location: ../View/login.php");
        exit;
    }
