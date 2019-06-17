
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Template Bootstrap</title>
    <link rel="stylesheet" href="assets/css/sweet.min.css">
    <script src="assets/js/sweet.min.js"></script>
</head>
<body>

    


    <script src="assets/js/jquery.js"></script>    
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>






<?php
session_start();
require "config.php";

if(isset($_SESSION['id']) && empty($_SESSION['id']) == false){
    
    header("Location: pagina-restrita.php");
    echo "<script>
    Swal.fire(
      'Good job!',
      'You clicked the button!',
      'success'
    )
</script>";
}
else{
    echo "<script>
	Swal.fire({
  	type: 'error',
  	title: 'Oops...',
  	text: 'Something went wrong!',
  	footer: '<a href>Why do I have this issue?</a>'
})
</script>";
    header("Location: login.php");
}

?>
