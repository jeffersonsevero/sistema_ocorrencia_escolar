<?php
session_start();
require "config.php";





if (isset($_GET['id']) && empty($_GET['id']) == false) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM aluno WHERE id = " . $id;

    $sql = $pdo->query($sql);

    if ($sql->rowCount() > 0) {
        $dadosAluno = $sql->fetch();
        $idAluno = $dadosAluno['id'];
        $nomeAluno = $dadosAluno['nome_aluno'];
        $serie = $dadosAluno['serie'];
        $nomeResponsavel = $dadosAluno['nome_responsavel'];
        $emailResponsavel = $dadosAluno['email_responsavel'];
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
    <title>SOE - Notificação</title>
    <link rel="stylesheet" href="assets/css/sweet.min.css">
    <script src="assets/js/sweet.min.js"></script>
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
        <h1>Enviar sms para responsável</h1>

        <form method="POST">
            Nome do aluno: <br>
            <input type="text" value="<?php echo $nomeAluno ?>" name="nome"> <br><br>

            Série: <br>
            <input type="text" value="<?php echo $serie ?>" name="serie"> <br><br>

            Nome responsável: <br>
            <input type="text" value="<?php echo $nomeResponsavel ?>" name="nomeResponsavel"> <br><br>

            Número responsável: <br>
            <input type="text" name="numero"> <br><br>

            Descrição da notificação: <br>
            <textarea name="mensagem" id="" cols="50" rows="8"></textarea> <br><br>

            <input type="submit" value="Enviar notificação" name="acao">
        </form>


    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>


<?php

require __DIR__ . '/vendor/autoload.php';
use TotalVoice\Client as TotalVoiceClient;



if(isset($_POST['acao'])){
    $nomeAluno = $_POST['nome'];
    $serie = $_POST['serie'];
    $nomeResponsavel = $_POST['nomeResponsavel'];
    $numero = $_POST['numero'];
    $mensagem = $_POST['mensagem'];

    $novaMensagem = $nomeEscola."     
    Foi detectado que o aluno ".$nomeAluno." fez a seguinte situação: ".$mensagem."
    ";




    if(preg_match('/([0-9]{11})/', $numero)){
        if(preg_match('/([a-z0-9]{1,50})/',$novaMensagem)){
            
            $client = new TotalVoiceClient('1b26d77ad9ebb5a89e22da9951fe623d');
            $response = $client->sms->enviar($numero, $novaMensagem);
            echo "<script>
            Swal.fire(
              'Ok!',
              'SMS enviado!',
              'success'
            )
            </script>";

            echo $response->getContent();

            
        }
        else{
            echo 
            "<script>
                Swal.fire({
                  type: 'error',
                  title: 'Oops...',
                  text: 'SMS não pôde ser enviado!',
            })
            </script>";
        }
    }
    else{
        echo 
        "<script>
            Swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Número inválido!',
        })
        </script>";
    }

}



?>