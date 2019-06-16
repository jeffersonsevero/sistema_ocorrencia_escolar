<?php
session_start();
use Dompdf\Dompdf;

require "config.php";
require "mensagem.php";





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



if (isset($_POST['mensagem']) && empty($_POST['mensagem']) == false) {
    $mensagem = $_POST['mensagem'];

    $sql = "INSERT INTO ocorrencias SET id_aluno = :id, data = :data, serie = :serie, id_escola = :id_escola";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":id", $idAluno);
    $sql->bindValue(":data", date('Y-m-d'));
    $sql->bindValue(":serie", $serie);
    $sql->bindValue(":id_escola", $_SESSION['id']);
    $sql->execute();
}


function conectarAoBanco()
{
    $infos = "mysql:dbname=soe;host=localhost";
    $db_user = "teste";
    $db_senha = "teste";

    try {
        $pdo = new PDO($infos, $db_user, $db_senha);
        return $pdo;
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
        exit();
    }
}




function obterNomeDaEscola($id)
{
    $pdo = conectarAoBanco();

    $sql = "SELECT * FROM escola WHERE id = " . $id;
    $sql = $pdo->query($sql);
    if ($sql->rowCount() > 0) {
        $dados = $sql->fetch();
        return $dados['nome_escola'];
    } else {
        echo "Algo deu errado";
    }
}




if (isset($_POST['acao']) && empty($_POST['acao']) == false) {
    $nomeEscola = obterNomeDaEscola($_SESSION['id']);
    //Gerar PDF


    include_once 'dompdf/autoload.inc.php';


    $dompdf = new Dompdf();

    $corpo = "<meta charset='UTF-8'>
    <u><h1 style='text-align: center'> Oficio de ocorrência </h1></u>
             <h3 style='text-align: center'>" . $nomeEscola . "</h3>   <br>

    Senhor/senhora " . $nomeResponsavel . ", foi detectado que o/a estudante " . $nomeAluno . ",  do " . $serie . "º ano 
    desta instituição cometeu a seguinte situação: " . $mensagem . ". <br>
    Nossa missão é cultivar a transparência desta instituição e manter os pais informados sobre todos os passos dos
    seus filhos. <br><br>
    Esperamos que o comportamento ruin seja corrigido. <br><br>

    Att, <br><br>
    ".$nomeEscola."
";

    $dompdf->load_html($corpo);

    $dompdf->render();
    $pdf = $dompdf->output();
    $file_location = $_SERVER['DOCUMENT_ROOT'] . "/soe/arquivos/arquivo.pdf";
    file_put_contents($file_location, $pdf);
   $msg = new Mensagem();
   $msg->enviarEmail($emailResponsavel, $nomeResponsavel, $nomeEscola);
   echo "<div class='alerta-geral'>
            <div class='alert alert-success' role='alert'>
                E-mail enviado com sucesso!
            </div>
        </div>";
    sleep(2);    
    header("Location: listar_alunos.php");
}



?>












<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
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
        <h1>Enviar notificação para responsável</h1>

        <form method="POST">
            Nome do aluno: <br>
            <input type="text" value="<?php echo $nomeAluno ?>"> <br><br>

            Série: <br>
            <input type="text" value="<?php echo $serie ?>"> <br><br>

            Nome responsável: <br>
            <input type="text" value="<?php echo $nomeResponsavel ?>"> <br><br>

            E-mail responsável: <br>
            <input type="text" value="<?php echo $emailResponsavel ?>"> <br><br>

            Descrição da notificação: <br>
            <textarea name="mensagem" id="" cols="50" rows="8"></textarea> <br><br>

            <input type="submit" value="Enviar notificação" name="acao">
        </form>


    </div>







    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>