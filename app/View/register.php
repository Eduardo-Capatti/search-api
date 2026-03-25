<?php
    session_start();
    if(!empty($_SESSION["idUsuario"])){
        header("Location: index.php");
    }

    if(!empty($_GET["error"])){
        $msg = "An unexpected error occurred, try again later!";
        if($_GET["error"] == 1){
            $msg = "This email is being used, try another one or login your account!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to SearchCEP</title>
    <script type="module" src="http://localhost:5173/resources/main.js"></script>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-5">Welcome to SearchCep!</h2>
                <form method="POST" action="../Controller/UsuarioController.php">
                    <div class="form-floating">
                        <input class="form-control" type="text" name="nome" id="nome" placeholder="Your username">
                        <label for="nome" id="nomeLabel">Your username</label>
                    </div>
                    <div class="form-floating">
                        <input class="form-control" type="text" name="email" id="email" placeholder="Your email">
                        <label for="email" id="emailLabel">Your email</label>
                    </div>
                    <div class="form-floating my-3">
                        <input class="form-control" type="password" name="senha" id="senha" placeholder="Your Password">
                        <label for="senha" id="senhaLabel">Your password</label>
                    </div>
                    <input type="hidden" name="url" id="url" value="register">
                    <button  type="submit" class="btn btn-primary">Register</button>
                </form>
                
                <? if(!empty($_GET["error"])){?>
                    <p><?=$msg?></p>
                <?}?>
                <div>
                    <a href="login.php" class="primary">Already have an account?</a>
                </div>
            </div>
        <div>
    </div>
    
</body>
</html>