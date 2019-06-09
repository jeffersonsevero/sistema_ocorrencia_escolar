<?php
session_start();
require "config.php";

if (isset($_POST['nome']) && empty($_POST['nome']) == false) {
    $nome = $_POST['nome'];
    $serie = $_POST['serie'];
    $nome_responsavel = $_POST['nome_responsavel'];
    $email_responsavel = $_POST['email_responsavel'];





    $sql = "SELECT * FROM aluno WHERE nome_aluno = :nome";

    $sql = $pdo->prepare($sql);

    $sql->bindValue(":nome", $nome);

    $sql->execute();



    if ($sql->rowCount() > 0) {
        echo "<div class='alerta-geral'>
        <div class='alert alert-danger' role='alert'>
            Aluno já está cadastrado
        </div>
        </div>";
    } else {

        $query = "INSERT INTO aluno SET nome_aluno = :nome, serie = :serie, nome_responsavel = :nome_responsavel,
        email_responsavel = :email_responsavel";


        $query = $pdo->prepare($query);

        $query->bindValue(":nome", $nome);
        $query->bindValue(":serie", $serie);
        $query->bindValue(":nome_responsavel", $nome_responsavel);
        $query->bindValue(":email_responsavel", $email_responsavel);


        $query->execute();

        echo "<div class='alerta-geral'>
            <div class='alert alert-success' role='alert'>
                Aluno cadastrado com sucesso.
            </div>
        </div>";
    }
}







?>









<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Template Bootstrap</title>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <a href="#" class="navbar-brand">
            SOE
        </a>

        <div class="d-flex justify-content-end sair">
            <a href="pagina-restrita.php" class="btn btn-outline-info">Voltar</a>
        </div>

        

    </nav>

    <div class="container">
        <h1>Cadastro de alunos</h1>
        <form method="POST">
            <div class="form-group">
                <label>Nome do aluno</label>
                <input type="text" class="form-control" placeholder="Nome" name="nome">
                <small class="form-text text-muted">Aluno que provocou uma ocorrência.</small>
            </div>

            <div class="form-group">
                <label>Série</label>
                <input type="number" class="form-control" placeholder="Série" name="serie">
                <small class="form-text text-muted">Ex: primeiro ano, segundo ano.</small>
            </div>



            <div class="form-group">
                <label>Nome do responsável</label>
                <input type="text" class="form-control" placeholder="Nome responsável" name="nome_responsavel">
                <small class="form-text text-muted">Insira o nome do pai ou da mãe do aluno.</small>
            </div>

            <div class="form-group">
                <label>E-mail do responsável</label>
                <input type="email" class="form-control" placeholder="E-mail responsável" name="email_responsavel">
                <small class="form-text text-muted">Insira um e-mail válido (De preferência email do google).</small>
            </div>



            <button type="submit" name="enviar" class="btn btn-primary">Cadastrar aluno</button>
        </form>
    </div>



    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>