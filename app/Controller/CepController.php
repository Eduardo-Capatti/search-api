<?php
    require "../Model/Cep.php";
    session_start();
    
    // Error: 1- CEP wasn`t sent, 2- JSON returned error true, 3- Unexpected Error
    if($_POST["url"] == "insert"){
        if(!$_POST["cep"]){
            header("Location: ../View/index.php?error=1");
            exit;
        }
        try{
            $cep = new Cep();
            $cep->set("cep", $_POST["cep"]);
            $cep->set("idUsuario", $_SESSION["idUsuario"]);
 
            $data = $cep->selectSearchedCep();
            $cepJSON = $cep->getJSON();

            $cep->set("ufCep", $cepJSON->uf);
            $cep->set("bairroCep", $cepJSON->bairro);
            $cep->set("estadoCep", $cepJSON->estado);
            $cep->set("cidadeCep", $cepJSON->localidade);
            $cep->set("logradouroCep", $cepJSON->logradouro);
            

            $cepMaps = $cep->getMapsInfo();

            if(empty($data)){
            
                if(!empty($cepJSON->erro) && $cepJSON->erro == true){
                    header("Location: ../View/index.php?error=2");
                    exit;
                }

                $cep->set("latitudeCep", null);
                $cep->set("longitudeCep", null);
                if(!empty($cepMaps)){
                    $cep->set("latitudeCep", $cepMaps[0]->lat);
                    $cep->set("longitudeCep", $cepMaps[0]->lon);
                }

                $cep->insertCep();
            }else{
                $cep->set("idCep", $data->idCep);
                $cep->updateCepDate();
            }

            $_SESSION["cepData"] = $cepJSON;
            $_SESSION["cepMaps"] = $cepMaps;

            header("Location: ../View/index.php");
            exit;
        }catch(Exception $e){
            header("Location: ../View/index.php?error=3");
            exit;
        }
    }

    if($_POST["url"] == "searchAllCep"){
        try{
            $cep = new Cep();
            $cep->set("idUsuario", $_SESSION["idUsuario"]);
            $data = $cep->selectAllUserCep();
            echo json_encode($data);
        }catch(Exception $e){
            echo json_encode(array("error"=>1));
        }
    }
    