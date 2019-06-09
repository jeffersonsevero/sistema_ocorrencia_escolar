<?php

session_start();

if(isset($_SESSION) && empty($_SESSION) == false){
    session_destroy();

    header("Location: index.php");
}


?>