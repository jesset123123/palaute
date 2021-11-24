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
<form action="kirjauduttu.php" method="POST">
<h1>Kirjaudu</h1>
<br>
        <?php
        session_start();
        ?>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Salasana" required><br>
    <input type="submit">
    <?php 
if (isset($_SESSION['success'])) {   
echo "<br><center>";
echo $_SESSION['success'];
unset($_SESSION['success']);  

}

if (isset($_SESSION['virhe'])) {   
    echo "<br><center>";
    echo $_SESSION['virhe'];
    unset($_SESSION['virhe']);  
    
    }
?>
</form>
</div>
<br>
<br>
<br>
    
</body>
</html>