
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="assets/css/sweet.min.css">
    <script src="assets/js/sweet.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <a href="index.php" class="navbar-brand">
            SOE
        </a>

        <a href="index.php" class="btn btn-outline-info">Voltar</a>

    </nav>


    <div class="container">




        <form method="POST" class="formulario">
            <div class="form-group">
                <label>Nome da instituição</label>
                <input type="text" class="form-control" placeholder="Nome" name="nome">
                <small class="form-text text-muted">Nome completo da instituição.</small>
            </div>

            <div class="form-group">
                <label>Endereço</label>
                <input type="text" class="form-control" placeholder="Endereço" name="endereco">
                <small class="form-text text-muted">Bairro, rua, número e cidade da instituição.</small>
            </div>

            <div class="form-group">
                <label>Email da instituição</label>
                <input type="email" class="form-control" placeholder="E-mail" name="email">
                <small class="form-text text-muted">Email para contato.</small>
            </div>

            <div class="form-group">
                <label>Senha</label>
                <input type="password" class="form-control" placeholder="Senha" name="senha">
                <small class="form-text text-muted">Digite uma senha forte.</small>
            </div>



            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>



    </div>


    </form>

    </div>


    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>



<?php
session_start();
require "config.php";

if (isset($_POST['email']) && empty($_POST['email']) == false) {
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    $sql = "SELECT * FROM escola WHERE email = :email";

    $sql = $pdo->prepare($sql);

    $sql->bindValue(":email", $email);
    //$sql->bindValue(":senha", $senha);

    $sql->execute();

    if ($sql->rowCount() > 0) {

        echo 
        "<script>
            Swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'E-mail já cadastrado!',
        })
        </script>";
        
    }
    else {
        $sql = "INSERT INTO escola SET nome_escola = :nome, endereco = :endereco, email = :email, senha = :senha";

        $sql = $pdo->prepare($sql);

        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":endereco", $endereco);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);

        $sql->execute();

        echo "<script>
        Swal.fire(
          'Ok!',
          'Instituição adicionada com sucesso!',
          'success'
        )
        </script>";


    }

}   


?>

