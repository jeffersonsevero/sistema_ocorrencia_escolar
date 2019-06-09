
<?php
session_start();

if(isset($_SESSION['id']) && empty($_SESSION['id'])){
    $session_id = $_SESSION['id'];

}


?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Página restrita</title>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <a href="#" class="navbar-brand">
            SOE
        </a>

        <div class="d-flex justify-content-end sair">
            <a href="logout.php" class="btn btn-outline-info">Sair</a>
        </div>
    </nav>

    <div class="container-fluid md-">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="pagina-restrita.php">
                                <span data-feather="home"></span>
                                Dashboard <span class="sr-only">(atual)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="adicionar_ocorrencia.php">
                                <span data-feather="file"></span>
                                Adicionar aluno
                            </a>
                        </li>
             
                        <li class="nav-item">
                            <a class="nav-link" href="listar_alunos.php">
                                <span data-feather="users"></span>
                                Lista de alunos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="bar-chart-2"></span>
                                Relatórios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="layers"></span>
                                Integrações
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>







    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>