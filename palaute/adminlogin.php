<?php
include "connect.php";
session_start();

if (isset($_POST['username'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM admin WHERE username='".$username."'AND password='".$password."'LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['adminlogged'] = $username;
        header("Location: adminindex.php");
    } else {
        echo "Väärä käyttäjänimi tai salasana, palaa edelliselle sivulle.";
        exit();
    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="tyyliuustest.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">
<div class="topnav">
<a href="index.php"> Takaisin etusivulle</a>
    </div>
</head>
<body>
<div class="cardpalauteboksi">
    <h1> Kirjaudu sisään </h1>
<form action="adminlogin.php" method="POST">
<input type="text" name="username" placeholder="Käyttäjätunnus"> <br>
<input type="password" name="password" placeholder="Salasana"> <br>
<input type="submit">
</form>
</div>
</body>
</html>