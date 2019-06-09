<?php
session_start();
use Dompdf\Dompdf;

include_once 'dompdf/autoload.inc.php';


$dompdf = new Dompdf();

$corpo = "<h1> Oficio de ocorrência </h1>

O aluno Jefferson Costa Severo fez uma ocorrência de nível 2

";

$fileName = 'tmp/arquivo.pdf';
$dompdf->load_html($corpo);

$dompdf->render();

$dompdf->stream('arquivo.pdf', array("Attachment" => false));






?>