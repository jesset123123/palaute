<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="tyyliuustest.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">
</head>
<?php
session_start();
include "connect.php";
error_reporting(0);
if ($_SESSION['user_session']) {
?>




<body>
    <div class="topnav">
    <?php
    echo '<a>';
    echo $_SESSION['user_session'];
    echo '</a>';
    ?>
    <a href="logout.php"> kirjaudu ulos</a>
    </div>

    <div class="cardpalauteboksi">
    <form action="palautelahetysuusi.php" method="POST" enctype="multipart/form-data">
    <h1> Lähetä palautetta </h1>
<input type="file" 
                   name="uploadfile" 
                   value="" />

    <input type="text" name="otsikko" placeholder="Otsikko" required><br>
    <input type="text" name="message" placeholder="Syötä palaute tähän" required><br>
    <input type="submit"> <br>
    <br>
    <br>
</form>
</div>


<?php

//VASTAAMATTOMAT TIKETIT

$logged_user = $_SESSION['user_session'];
$sql = mysqli_query($conn, "SELECT * FROM tickets WHERE user= '$logged_user' AND response IS NULL ORDER by id DESC");




echo '<h1> Vastaamattomat tiketit </h1>';
echo '<div class="row">';
while ($row = $sql->fetch_assoc()) {
echo '<div class="column">';
echo '<div class="card">';
$id = $row['id'];
echo '<i class="material-icons">calendar_today</i>';
echo '<h3>';
echo date('d.m.Y', strtotime($row["date"]));
echo '</h3>';
echo '<i class="material-icons">description</i>';
echo '<h4>';
echo $row['title'];
echo '</h4>';
echo '<div class=cardvastausviestit>';
echo '<u><b><p> Palaute: </p></b></u>';
echo $row['message'];
echo '</b>';
echo '<br>';
echo '<br>';


if (isset($row['image']) && !empty($row['image'])) {
echo "<img src='image/".$row['image']."' height='200' width='200'  >"; 
} else {
    echo "<img src='image/default.jpg' style='height:200px'draggable='false'>";
}     


echo '<br>';
echo '</div>';
echo '<form action="index.php" method="POST">';
echo '<input type="hidden" name="id" value='; echo $id; echo '>';
echo '<input type="submit" name="poista" value="Poista tiketti">';
echo '<br>';
echo '<input type="submit" name="muokkaa" value="Muokkaa tikettiäsi">';
echo '</form>';

if ($id == $_SESSION['muokkaa']) {
    echo '<form action="index.php" method="POST">';
    echo '<input type="text" name="muokkaa2" value="'; echo $row['message']; echo '" id="">'; 
    echo '<input type="submit" value="Muokkaa">';
    echo '<input type="submit" value="Peru muokkaus" name="peru">';
    echo '</form>';
} 
echo '</div>';
echo '</div>';


}
echo '</div>';




if (isset($_POST['muokkaa'])) {
    $_SESSION['muokkaa'] = $_POST['id']; 
    header ("Location: index.php");
}

if (isset($_POST['muokkaa2'])) {
    $id = ($_SESSION['muokkaa']);
    $muokkaateksti = $_POST['muokkaa2']; 
    $sql = mysqli_query($conn, "UPDATE tickets SET message = '$muokkaateksti' WHERE id = '$id'");
    unset($_SESSION['muokkaa']);
    header ("Location: index.php");
}



if (isset($_POST['peru'])) {
    unset($_SESSION['muokkaa']);
    header ("Location: index.php");
}


if (isset($_POST['poista'])) {
    $poistatiketti = $_POST['id'];  
    $sql = mysqli_query($conn, "DELETE FROM tickets WHERE id = '$poistatiketti'");  
    header ("Location: index.php");
}

?>

<?php

//VASTATUT TIKETIT, VAILLA SELVITYSTÄ

$logged_user = $_SESSION['user_session'];
$sql = mysqli_query($conn, "SELECT * FROM tickets WHERE user= '$logged_user' AND response IS NOT NULL AND status=0 ORDER by id DESC");

echo '<h1> Vastatut tiketit vailla selvitystä </h1>';
echo '<div class="row">';

while ($row = $sql->fetch_assoc()) {
    $id = $row['id'];
echo '<div class="column">';
echo '<div class="card">';
echo '<input type="hidden" name="id" value='; echo $id; echo '>';
echo '<i class="material-icons">calendar_today</i>';
echo '<h3>';
echo date('d.m.Y', strtotime($row["date"]));
echo '</h3>';
echo '<i class="material-icons">description</i>';
echo '<h4>';
echo $row['title'];
echo '</h4>';
echo '<div class=cardvastausviestit>';
echo '<u><b><p> Palaute: </p></b></u>';
echo $row['message'];
echo '<br>';
echo '<br>';

if (isset($row['image']) && !empty($row['image'])) {
    echo "<img src='image/".$row['image']."' height='200' width='200'  >"; 
    } else {
        echo "<img src='image/default.jpg' style='height:200px'draggable='false'>";
    }  
    
echo '<br>';
echo '<u><b><p> Ylläpidon vastaus: </p></b></u>';
echo '<u>';
echo $row['response'];
echo '<br>';
echo '<br>';
echo '</u>';
echo '</div>';

    // selvitys napit
    echo '<form action="index.php" method="POST">';
    echo '<input type="hidden" name="id" value='; echo $id; echo '>';
    echo '<input type="submit" name="selvitetty" value="Merkitse selvitetyksi">';
    echo '<br>';
    echo '<input type="submit" name="vastausnappi" value="Vastaa">';
    echo '</form>';
echo '<div class="cardvastaus">';

// vastaus boksi
if ($id == $_SESSION['vastaus']) {
    echo '<form action="vastaus.php" method="POST">';
    echo '<input type="text" name="vastaus2" value="'; echo '" id="">'; 
    echo '<input type="submit" value="vastaa tikettiin">';
    echo '</form>';
    echo '<form action="index.php" method="POST">';
    echo '<input type="submit" value="Peru vastaus" name="peruvastaus">';
    echo '</form>';


} 
//testi 2
$sql2 = mysqli_query($conn, "SELECT * FROM ketjut WHERE user= '$logged_user' AND original_id = '$id'  OR user= 'admin' AND original_id = '$id' ORDER by id ASC");
while ($row = $sql2->fetch_assoc()) {
    echo '<div class="cardvastausviestit">';
    echo '<b>';
    echo date('d.m.Y', strtotime($row["date"]));
    echo '<br>';
    echo $row['user'];
    echo '</b>';
    echo '<br>';
    echo $row ['reply'];
    echo '<br>';
    echo '</div>';
    }
echo '</div>';




echo '</div>';
echo '</div>';

}
echo '</div>';




//peru vastaus
if (isset($_POST['peruvastaus'])) {
    unset($_SESSION['vastaus']);
    header ("Location: index.php");
}


// selvitys nappi


if (isset($_POST['selvitetty'])) {
    $selvitatiketti = $_POST['id'];  
    $sql = mysqli_query($conn, "UPDATE tickets SET status = '1' WHERE id = '$selvitatiketti'");  
    header ("Location: index.php");
}

// vastaus

if (isset($_POST['vastausnappi'])) {
    $_SESSION['vastaus'] = $_POST['id']; 
    $_SESSION['statussession'] = $_POST['id']; 
    header ("Location: index.php");
}


?>




<?php

// ODOTTAVAT TIKETIT


$logged_user = $_SESSION['user_session'];
$sql = mysqli_query($conn, "SELECT * FROM tickets WHERE user= '$logged_user' AND status=2 ORDER by id DESC");

echo '<h1> Odottavat tiketit </h1>';
echo '<div class="row">';

while ($row = $sql->fetch_assoc()) {
    $id = $row['id'];
echo '<div class="column">';
echo '<div class="card">';
echo '<input type="hidden" name="id" value='; echo $id; echo '>';
echo '<i class="material-icons">calendar_today</i>';
echo '<h3>';
echo date('d.m.Y', strtotime($row["date"]));
echo '</h3>';
echo '<i class="material-icons">description</i>';
echo '<h4>';
echo $row['title'];
echo '</h4>';
echo '<div class=cardvastausviestit>';
echo '<u><b><p> Palaute: </p></b></u>';
echo $row['message'];
echo '<br>';
echo '<br>';

if (isset($row['image']) && !empty($row['image'])) {
    echo "<img src='image/".$row['image']."' height='200' width='200'  >"; 
    } else {
        echo "<img src='image/default.jpg' style='height:200px'draggable='false'>";
    }  
    
echo '<br>';
echo '<u><b><p> Ylläpidon vastaus: </p></b></u>';
echo $row['response'];
echo '<br>';
echo '<br>';
echo '</div>';


echo '<div class="cardvastaus">';

//testi 2
$sql2 = mysqli_query($conn, "SELECT * FROM ketjut WHERE user= '$logged_user' AND original_id = '$id'  OR user= 'admin' AND original_id = '$id' ORDER by id ASC");
while ($row = $sql2->fetch_assoc()) {
    echo '<div class="cardvastausviestit">';
    echo '<b>';
    echo date('d.m.Y', strtotime($row["date"]));
    echo '<br>';
    echo $row['user'];
    echo '<br>';
    echo '</b>';
    echo '<br>';
    echo $row ['reply'];
    echo '<br>';
    echo '</div>';
    }
echo '</div>';

echo '</div>';
echo '</div>';

}
echo '</div>';



?>

<?php

// SELVITETYT TIKETIT

$logged_user = $_SESSION['user_session'];
$sql = mysqli_query($conn, "SELECT * FROM tickets WHERE user= '$logged_user' AND status=1 ORDER by id DESC");

echo '<h1> Selvitetyt tiketit </h1>';
echo '<div class="row">';

while ($row = $sql->fetch_assoc()) {
    $id = $row['id'];
echo '<div class="column">';
echo '<div class="card">';
echo '<input type="hidden" name="id" value='; echo $id; echo '>';
echo '<i class="material-icons">calendar_today</i>';
echo '<h3>';
echo date('d.m.Y', strtotime($row["date"]));
echo '</h3>';
echo '<i class="material-icons">description</i>';
echo '<h4>';
echo $row['title'];
echo '</h4>';
echo '<div class=cardvastausviestit>';
echo '<u><b><p> Palaute: </p></b></u>';
echo $row['message'];
echo '<br>';
echo '<br>';


if (isset($row['image']) && !empty($row['image'])) {
    echo "<img src='image/".$row['image']."' height='200' width='200'  >"; 
    } else {
        echo "<img src='image/default.jpg' style='height:200px'draggable='false'>";
    }  
    
echo '<br>';
echo '<u><b><p> Ylläpidon vastaus: </p></b></u>';
echo '<u>';
echo $row['response'];
echo '<br>';
echo '<br>';
echo '</u>';
echo '</div>';


echo '<div class="cardvastaus">';

//testi 2
$sql2 = mysqli_query($conn, "SELECT * FROM ketjut WHERE user= '$logged_user' AND original_id = '$id'  OR user= 'admin' AND original_id = '$id' ORDER by id ASC");
while ($row = $sql2->fetch_assoc()) {
    echo '<div class="cardvastausviesti">';
    echo '<b>';
    echo date('d.m.Y', strtotime($row["date"]));
    echo '<br>';
    echo $row['user'];
    echo '</b>';
    echo '<br>';
    echo $row ['reply'];
    echo '<br>';
    echo '<br>';
    echo '</div>';
    }
echo '</div>';




echo '</div>';
echo '</div>';

}
echo '</div>';


?>



</body>
</html>

 
<?php
} else {
    echo '<div class="topnav">';
 echo '<a href="register.php"> Rekisteröi</a>';
 echo '<a href="kirjaudu.php"> Kirjaudu sisään</a>';
 echo '<a href="adminlogin.php"> Ylläpito</a>';
    echo '</div>';
    echo '<div class="card">';
    echo '<h1> Et ole kirjautunut sisään. Kirjaudu sisään joko ylläpitona tai käyttäjänä. </h1>';
    echo '<br>';
    echo '<h2> Käytä yläpalkkia navigointiin. </h2>';
    echo '</div>';

}
?>
