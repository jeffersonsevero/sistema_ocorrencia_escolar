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
        <h1>Enviar Telegram para responsável</h1>

        <form method="POST">
            Nome do aluno: <br>
            <input type="text" value="<?php echo $nomeAluno ?>" name="nome"> <br><br>

            Série: <br>
            <input type="text" value="<?php echo $serie ?>" name="serie"> <br><br>

            Nome responsável: <br>
            <input type="text" value="<?php echo $nomeResponsavel ?>" name="nomeResponsavel"> <br><br>

            Token Telegram: <br>
            <input type="text" name="token"> <br><br>

            ID Telegram: <br>
            <input type="text" name="id"> <br><br>

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

function enviarMensagemTelegram($chatID, $mensagem, $token){

    $url = "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chatID;
    $url = $url."&text=".urlencode($mensagem);
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );

    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
    echo "Mensagem enviada com sucesso";
    return true;
}


if(isset($_POST['acao'])){

    $sql = "SELECT * FROM escola WHERE id_escola = ".$_SESSION['id'];

    $sql = $pdo->query($sql);
    if($sql->rowCount() > 0){
        $dados = $sql->fetch();
        print_r($dados);
        exit();
    }

    $nomeAluno = $_POST['nome'];
    $serie = $_POST['serie'];
    $nomeResponsavel = $_POST['nomeResponsavel'];
    $token = $_POST['token'];
    $id = $_POST['id'];
    $mensagem = $_POST['mensagem'];

    $novaMensagem = "Senhor/senhora ".$nomeResponsavel. ". Foi detectado que o aluno/aluna ".$nomeAluno.
    " aluno do ".$serie."ª desta instituição cometeu a seguinte situação: ". $mensagem;

    if(enviarMensagemTelegram($id, $novaMensagem, $token) == true){
        echo "<script>
            Swal.fire(
              'Ok!',
              'Telegram enviado!',
              'success'
            )
            </script>";
    }
    else{
        echo 
        "<script>
            Swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Telegram não pôde ser enviado!',
        })
        </script>";
    }

}


?>