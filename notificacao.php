<?php
session_start();
use Dompdf\Dompdf;

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



if (isset($_POST['mensagem']) && empty($_POST['mensagem']) == false) {
    $mensagem = $_POST['mensagem'];

    $sql = "INSERT INTO ocorrencias SET id_aluno = :id, data = :data, serie = :serie";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":id", $idAluno);
    $sql->bindValue(":data", date('Y-m-d'));
    $sql->bindValue(":serie", $serie);
    $sql->execute();
}
/*
//obter nome da escola
if(isset($_SESSION['id']) && empty($_SESSION['id']) == false){
    $idEscola = $_SESSION['id'];

    $sql = "SELECT * FROM escola WHERE id = :idEscola";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":idEscola", $idEscola);
    if($sql->rowCount() > 0){
        $dados = $sql->fetch();
        $nomeEscola = $dados['nome_escola'];
    }
}
*/



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

function enviarEmail($emailDestinatario, $nomeDestinatario)
{
    include("phpmailer/class.phpmailer.php");


    // Load Composer's autoloader

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer;

    try {
        //Server settings
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'jeffersonsevero08@gmail.com';                     // SMTP username
        $mail->Password   = 'jefinho1234';                               // SMTP password
        $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('jeffersonsevero08@gmail.com', 'Jefferson');
        $mail->addAddress($emailDestinatario, $nomeDestinatario);     // Add a recipient
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Attachments
        $mail->addAttachment('/var/www/html/soe/arquivos/arquivo.pdf');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}






if (isset($_POST['acao']) && empty($_POST['acao']) == false) {
    $nomeEscola = obterNomeDaEscola($_SESSION['id']);
    //Gerar PDF


    include_once 'dompdf/autoload.inc.php';


    $dompdf = new Dompdf();

    $corpo = "<h1> Oficio de ocorrência </h1>
             <h3>" . $nomeEscola . "</h3>   <br>

    Senhor/senhora " . $nomeResponsavel . ", foi detectado que (a) estudante " . $nomeAluno . ",  do " . $serie . "º ano 
    desta instituição cometeu a seguinte situação: " . $mensagem . "
";

    $dompdf->load_html($corpo);

    $dompdf->render();
    $pdf = $dompdf->output();
    $file_location = $_SERVER['DOCUMENT_ROOT'] . "/soe/arquivos/arquivo.pdf";
    file_put_contents($file_location, $pdf);
    enviarEmail('jeffersontubiba@gmail.com', 'Jefferson');
    exit();
    header("Location: listar_alunos.php");

}





/*
if(isset($_POST['acao']) && empty($_POST['acao']) == false){
    $notificacao = new Notificacao();
    $notificacao->adicionarOcorrencia($idAluno, date('Y-m-d'), $serie);
}
*/





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