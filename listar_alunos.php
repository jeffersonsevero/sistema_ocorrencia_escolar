
<?php
session_start();


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Listar alunos</title>
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
        <h1>Lista de alunos</h1>

        <table class="table table-striped table-bordered">
            <tr class="table-primary">
                <th>Nome</th>
                <th>série</th>
                <th>Nome do responsável</th>
                <th>E-mail do responsável</th>
                <th>Ações</th>
            </tr>

            <?php
            require "config.php";

            $sql = "SELECT * FROM aluno WHERE id_escola = ".$_SESSION['id'];

            $sql = $pdo->query($sql);

            if ($sql->rowCount() > 0) {
                $dados = $sql->fetchAll();
                foreach ($dados as $dado) {
                    echo "<tr>";
                    echo "<td>" . $dado['nome_aluno'] . "</td>";
                    echo "<td>" . $dado['serie'] . "</td>";
                    echo "<td>" . $dado['nome_responsavel'] . "</td>";
                    echo "<td>" . $dado['email_responsavel'] . "</td>";
                    echo '<td> <a href="notificacao.php?id='.$dado['id'].'">Enviar notificação</a>  </td>';
                    echo "</tr>";
                    
                }
                
            }


            ?>




        </table>

    </div>




    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>