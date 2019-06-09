<?php
require "config.php";




function adicionarZeroAFrenteDoNumero($numero)
{
    $regex = "/^([0-9]{1})$/";
    if (preg_match($regex, $numero, $matches)) {
        $numero = '0' . $numero;
        echo $numero;
    } else {
        echo $numero;
    }
}



//echo adicionarZeroAFrenteDoNumero(1);




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







/*
$n = 1;
while($n <= 12){
    if($n == $dados[$n - 1][0]){
        $quantidadeOcorrenciasEmCadaMes[$n] = $dados['quantidade'];
    }
    else{
        $quantidadeOcorrenciasEmCadaMes[$n - 1] = 0;
    }
    $n++;
}
//print_r($quantidadeOcorrenciasEmCadaMes);

/*
while($n <= 12){
    $sql = "SELECT COUNT(*)
    FROM ocorrencias
    WHERE data LIKE '%-{$n}-%'";


    $sql = $pdo->prepare($sql);
    $sql->execute();
    
    if($sql->rowCount() > 0){

        $dados = $sql->fetch();
   
        $quantidadeOcorrenciasNoMesN = $dados[0];
        $quantidadeOcorrenciasEmCadaMes[$n - 1] = $quantidadeOcorrenciasNoMesN;
        
    }
    else{
        $quantidadeOcorrenciasEmCadaMes[$n - 1] = 0;    
    }

    $n++;

    
}
*/



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gráficos</title>
</head>

<body>
    <div style="width: 600px">
        <canvas id="grafico"></canvas>
    </div>


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