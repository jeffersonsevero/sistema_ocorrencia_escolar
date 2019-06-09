<?php

class Notificacao{
    private $pdo;

    public function __construct(){
        $infos = "mysql:dbname=soe;host=localhost";
        $usuario = "teste";
        $senha = "teste";

        $this->pdo = new PDO($infos, $usuario, $senha);
    }


    public function obterNomeDeEscolaApartirDeID($id){
        $sql = "SELECT * FROM escola WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->execute();

        if($sql->rowCount() > 0){
            $tupla = $sql->fetch();
            return $tupla['nome_escola'];
        }
    }

    public function adicionarOcorrencia($idAluno, $data, $serie){
        $sql = "INSERT INTO ocorrencias SET id_aluno = :id, data = :data, serie = :serie";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $idAluno);
        $sql->bindValue(":data", $data);
        $sql->bindValue(":serie", $serie);
        $sql->execute();

    }





    
        
    
}




?>