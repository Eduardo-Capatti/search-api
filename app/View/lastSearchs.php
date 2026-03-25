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
</head>
<body>
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
    .then(data => console.log(data))
    .catch(error => console.log(error));
</script>