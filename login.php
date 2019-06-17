

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/css/sweet.min.css">
    <script src="assets/js/sweet.min.js"></script>
    <title>Login - SOE</title>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <a href="#" class="navbar-brand">
            SOE
        </a>
    </nav>

    <div class="container">
        <div class="row">
            <div class="card-login">
                <div class="logo">
                    <img src="assets/images/logo-completa.png">
                </div>
                <div class="card-header">
                    Login
                </div>

                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="E-mail" name="email" id="email">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Senha" name="senha" id="senha">
                        </div>

                        <input type="submit" class="btn btn-lg btn-info btn-block" value="Entrar" id="submit">

                        <a href="cadastrar.php" class="btn btn-lg btn-info btn-block">Cadastrar</a>
                    </form>
                </div>

            </div>

        </div>

    </div>






    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>







<?php
require "config.php";


session_start();

if (isset($_POST['email']) && empty($_POST['email']) == false) {
    $email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));



    $sql = "SELECT * FROM escola WHERE email = :email AND senha = :senha";

    $sql = $pdo->prepare($sql);

    $sql->bindValue(":email", $email);
    $sql->bindValue(":senha", $senha);

    $sql->execute();

    if ($sql->rowCount() > 0) {
        $dados = $sql->fetch();

        $_SESSION['id'] = $dados['id'];
       
    
        header("Location: index.php");

    } else {
        echo "<script>
        Swal.fire({
          type: 'error',
          title: 'Oops...',
          text: 'Usuário ou senha inválidos!',
          
    })
    </script>";
    }
}

?>