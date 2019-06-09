
<?php
session_start();
require "config.php";

if(isset($_SESSION['id']) && empty($_SESSION['id']) == false){
    header("Location: pagina-restrita.php");
}
else{
    header("Location: login.php");
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

    


    <script src="assets/js/jquery.js"></script>    
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>