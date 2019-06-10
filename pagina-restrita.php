<?php
session_start();
require 'config.php';

if (isset($_SESSION['id']) && empty($_SESSION['id'])) {
    $session_id = $_SESSION['id'];
}

$quantidadeOcorrenciasEmCadaMes = array();

$sql = "
SELECT Month(data) as mes,  COUNT(Month(data)) as quantidade
FROM ocorrencias
GROUP BY Month(data)
ORDER BY Month(data);
";
$sql = $pdo->query($sql);


if ($sql->rowCount() > 0) {
    $dados = $sql->fetchAll();
    foreach ($dados as $dadosMensais) {
        $quantidadeOcorrenciasEmCadaMes[$dadosMensais['mes']] = $dadosMensais['quantidade'];
    }
}


for ($i = 1; $i <= 12; $i++) {
    if ($quantidadeOcorrenciasEmCadaMes[$i] == null) {
        $quantidadeOcorrenciasEmCadaMes[$i] = 0;
    }
}
ksort($quantidadeOcorrenciasEmCadaMes);







?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Página restrita</title>
</head>

<body>

    <div class="side-bar">
        <div class="topo">
            <h3>SOE</h3>
        </div>
        <!--topo-->
        <div class="menu">
            <ul>
                <li><i class="fas fa-tachometer-alt"></i><a href="#">Home</a></li>
                <li><i class="fas fa-user-plus"></i><a href="adicionar_ocorrencia.php">Adicionar aluno</a></li>
                <li><i class="far fa-list-alt"></i><a href="listar_alunos.php">Lista de alunos</a></li>
                <li><i class="fas fa-sign-out-alt"></i><a href="logout.php">Sair</a></li>

            </ul>
        </div>
        <!--menu-->

    </div>
    <!--side_bar-->

    <div class="main-content">
        <header>
            <div class="pesquisa-campo">
                <div class="icone-pesquisa"></div>
            </div>
            <!--pesquisa-campo-->
        </header>
        <div style="width: 600px">
            <canvas id="grafico"></canvas>
        </div>
       

    </div> <!-- main-content -->





    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="assets/js/Chart.min.js"></script>

    <script type="text/javascript">
        window.onload = function() {
            var contexto = document.getElementById("grafico").getContext("2d");
            var grafico = new Chart(contexto, {
                type: 'line',
                data: {
                    labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    datasets: [{
                        label: 'Número de ocorrências por mês',
                        backgroundColor: 'blue',
                        borderColor: 'blue',
                        data: [
                            <?php echo implode(',', $quantidadeOcorrenciasEmCadaMes)   ?>
                        ],
                        fill:false
                    }],
                },
 
            });
        }
    </script>

</body>

</html>