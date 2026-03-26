<?
    session_start();
    if(empty($_SESSION["idUsuario"])){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Last Searchs</title>
    <script type="module" src="http://localhost:5173/resources/main.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>
<body>
    <a href="index.php">Search CEP</a>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Last Searched CEPS</h2>
                <div id="idSearchedCEPS"></div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    const formData = new FormData();
    formData.append("url", "searchAllCep")
    fetch("../Controller/CepController.php",{
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        let idSearchedCeps = document.querySelector("#idSearchedCEPS");

        if(data.length == 0){
            idSearchedCeps.innerHTML = "<p>No search found!</p>"
        }
        data.forEach(data => {
            console.log(data);
            let div = document.createElement("div");
            let cep = document.createElement("h2");
            let cidade = document.createElement("h2");
            let estado = document.createElement("h2");
            let uf = document.createElement("h2");
            let bairro = document.createElement("h2");
            let logradouro = document.createElement("h2");
            let latitude = document.createElement("h2");
            let longitude = document.createElement("h2");

            cep.innerHTML = "CEP: " + data.cep;
            cidade.innerHTML = "Cidade: " + data.cidadeCep;
            estado.innerHTML = "Estado: " + data.estadoCep;
            uf.innerHTML = "UF: " + data.ufCep;
            bairro.innerHTML = "Bairro: " + data.bairroCep;
            logradouro.innerHTML = "Logradouro: " + data.logradouroCep;

            latitude.innerHTML = data.latitudeCep != null ? "Latitude: " + data.latitudeCep : "Latitude: Not found";
            longitude.innerHTML = data.longitudeCep != null ? "Longitude: " + data.longitudeCep : "Longitude: Not found";

            itens = [cep, cidade, estado, uf, bairro, logradouro, latitude, longitude];

            itens.forEach(item=>{
                div.appendChild(item);
            });

            let divMap = document.createElement("div");

            div.appendChild(divMap);
            div.appendChild(document.createElement("hr"));
            idSearchedCeps.appendChild(div);
            if(data.latitudeCep != null &&  data.longitudeCep != null){   
                divMap.style.height = "360px";
                divMap.id = "map_" + data.idCep;
                let map = L.map("map_" + data.idCep).setView([data.latitudeCep, data.longitudeCep], 13);
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                L.marker([data.latitudeCep, data.longitudeCep])
                .addTo(map)
                .bindPopup("Your location")
                .openPopup();
                
            }
            
            

            
        });
    })
    .catch(error => console.log(error));
</script>