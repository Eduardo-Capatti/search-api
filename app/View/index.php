<?php
    session_start();
    if(empty($_SESSION["idUsuario"])){
        header("Location: login.php");
    }

    if(!empty($_GET["error"])){
        $msg = "An unexpected error occurred, try again later!";
        if($_GET["error"] == 1){
            $msg = "The CEP is invalid!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SearchCEP</title>
    <script type="module" src="http://localhost:5173/resources/main.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>
<body>
    <form method="POST" action="../Controller/UsuarioController.php">
        <button type="submit">Logout</button>
        <input type="hidden" name="url" value="logout">
    </form>
    <a href="lastSearchs.php">Last Searchs</a>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="input-group">
                    <form method="POST" action="../Controller/CepController.php">
                        <input class="form-control" name="cep" id="cep" type="text" placeholder="Digite CEP que você deseja procurar">
                        <input class="form-control" name="url" id="url" type="hidden" value="insert">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
                <? if(!empty($_GET["error"])){?>
                    <p><?=$msg?></p>
                <?}?>
            </div>

            <? if(!empty($_SESSION["cepData"])){?>
                <div class="col-12">
                    <h2>CEP: <?=$_SESSION["cepData"]->cep?></h2>
                    <h2>Cidade: <?=$_SESSION["cepData"]->localidade?></h2>
                    <h2>Estado: <?=$_SESSION["cepData"]->estado?></h2>
                    <h2>Logradouro: <?=$_SESSION["cepData"]->logradouro?></h2>
                    <h2>UF: <?=$_SESSION["cepData"]->uf?></h2>
                    <h2>Bairro: <?=$_SESSION["cepData"]->bairro?></h2>
                    <?if(!empty($_SESSION["cepMaps"])){?>
                        <h2>Latitude: <?=number_format($_SESSION["cepMaps"][0]->lat, 2)?></h2>
                        <h2>Longitude: <?=number_format($_SESSION["cepMaps"][0]->lon,2)?></h2>
                        <div id="map" style="height:360px"></div>

                        <script>
                            let map = L.map("map").setView([<?=$_SESSION["cepMaps"][0]->lat?>, <?=$_SESSION["cepMaps"][0]->lon?>], 13);
                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 19,
                                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                            }).addTo(map);

                            L.marker([<?=$_SESSION["cepMaps"][0]->lat?>, <?=$_SESSION["cepMaps"][0]->lon?>])
                            .addTo(map)
                            .bindPopup("Your location")
                            .openPopup();
                        </script>
                    <?}?>
                </div>
            <?}?>
            
        </div>
    </div>
</body>
</html>