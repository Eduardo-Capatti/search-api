<?php
    session_start();
    if(!empty($_SESSION["idUsuario"])){
        header("Location: index.php");
    }

    if(!empty($_GET["error"])){
        $msg = "An unexpected error occurred, try again later!";
        if($_GET["error"] == 1){
            $msg = "Your credentials are incorrect!";
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
                <h2 class="mb-5">Welcome Back!</h2>
                <form method="POST" action="../Controller/UsuarioController.php">
                    <div class="form-floating">
                        <label for="email" id="emailLabel">Your email</label>
                        <input class="form-control" type="text" name="email" id="email" placeholder="Your email">
                    </div>
                    <div class="form-floating">
                        <label for="senha" id="senhaLabel">Your password</label>
                        <input class="form-control" type="password" name="senha" id="senha" placeholder="Your Password">
                    </div>
                    <input type="hidden" name="url" id="url" value="login">
                    <button  type="submit" class="btn btn-primary">Login</button>

                    <? if(!empty($_GET["error"])){?>
                        <p><?=$msg?></p>
                    <?}?>
                </form>
                <div>
                    <a href="register.php" class="text-primary me-3">Doesn`t have an account?</a>
                    <!-- <a href="forgotpassword.php" class="text-primary">Forgot your password?</a> -->
                </div>
            </div>
        <div>
    </div>
    
</body>
</html>