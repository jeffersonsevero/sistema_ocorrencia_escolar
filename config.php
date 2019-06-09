<?php

$infos = "mysql:dbname=soe;host=localhost";
$db_user = "teste";
$db_senha = "teste";

try{
    $pdo = new PDO($infos, $db_user, $db_senha);
}catch(PDOException $e){
    echo "ERROR: ". $e->getMessage();
    exit();
}






?>