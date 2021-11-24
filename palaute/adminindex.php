<?php
session_start();
include "connect.php";
error_reporting(0);
if ($_SESSION['adminlogged']) {
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin sivu</title>
    <link rel="stylesheet" href="tyyliuustest.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div class="topnav">
<a href="index.php"> Takaisin etusivulle</a>
    </div>
</form>
</body>
</html>

<!--- LAJITTELUNAPIT --->

<form action="adminindex.php" method="post">
 <input type="submit" name="kayttajanmukaan1" value="Lajittele käyttäjän mukaan">
 <input type="submit" name="uusimmanmukaan1" value="Lajittele uusimman tiketin mukaan">
 </form>

<?php

// LAJITTELUT

$sql = mysqli_query($conn, "SELECT * FROM tickets WHERE response IS NULL ORDER BY id DESC");
if($_POST['kayttajanmukaan1'] == true) {
    $sql = mysqli_query($conn, "SELECT * FROM tickets WHERE response IS NULL ORDER BY user, id DESC");
    }

if($_POST['uusimmanmukaan1'] == true) {
        $sql = mysqli_query($conn, "SELECT * FROM tickets WHERE response IS NULL ORDER BY id DESC");
        }



//UUDET TIKETIT

echo '<h1> Uudet tiketit </h1>';
echo '<div class="row">';

while ($row = $sql->fetch_assoc()) {
echo '<div class="column">';
echo '<div class="card">';
$id = $row['id'];
echo '<input type="hidden" name="id" value='; echo $id; echo '>';
echo '<i class="material-icons">calendar_today</i>';
echo '<h3>';
echo date('d.m.Y', strtotime($row["date"]));
echo '</h3>';
echo '<i class="material-icons">email</i>';
echo '<h3>';
echo $row ['user'];
echo '</h3>';
echo '<i class="material-icons">description</i>';
echo '<h4>';
echo $row['title'];
echo '</h4>';
echo '<div class="cardvastausviestit">';
echo '<u><b><p> Palaute: </p></b></u>';
echo '<u>';
echo $row['message'];
echo '</u>';
echo '<br>';
echo '<br>';

if (isset($row['image']) && !empty($row['image'])) {
    echo "<img src='image/".$row['image']."' height='200' width='200'  >"; 
    } else {
        echo "<img src='image/default.jpg' style='height:200px'draggable='false'>";
    }  

echo '<br>';
echo '</div>';
echo '<form action="adminindex.php" method="POST">';
echo '<input type="hidden" name="id" value='; echo $id; echo '>';
echo '<input type="submit" name="vastaa" value="Vastaa tikettiin">';
echo '<br>';
echo '<input type="submit" name="poista" value="Poista tiketti">';
echo '</form>';

// vastauspainike

if ($id == $_SESSION['vastaa']) {
    echo '<div class="cardvastaus">';
    echo '<form action="adminindex.php" method="POST">';
    echo '<input type="text" name="vastaa2" placeholder="Vastaa tikettiin">';
    echo '<input type="submit" value="vastaa">';
    echo '<input type="submit" value="Peru vastaus" name="peruvastaus2">';
    echo '</form>';
    echo '</div>';


    }
    echo '</div>';
    echo '</div>';
}
echo '</div>';

// peru vastaus

if (isset($_POST['peruvastaus2'])) {
    unset($_SESSION['vastaa']);
    header ("Location: adminindex.php");
}

//poistopainike

if (isset($_POST['poista'])) {
    $poistatiketti = $_POST['id'];  
    $sql = mysqli_query($conn, "DELETE FROM tickets WHERE id = '$poistatiketti'");  
    header ("Location: adminindex.php");
}

//vastauspainikkeen funktiot

if (isset($_POST['vastaa'])) {
    $_SESSION['vastaa'] = $_POST['id']; 
    header ("Location: adminindex.php");
}


if (isset($_POST['vastaa2'])) {
    $id = ($_SESSION['vastaa']); 
    $vastaus = $_POST['vastaa2'];  
    $sql = mysqli_query($conn, "UPDATE tickets SET response = '$vastaus' WHERE id = '$id'");
    unset($_SESSION['vastaa']); 
    header ("Location: adminindex.php");
}






?>

<br>
<br>
<br>
<br>
<br>
<br>


<!--- LAJITTELUNAPIT --->


<form action="adminindex.php" method="post">
 <input type="submit" name="kayttajanmukaan2" value="Lajittele käyttäjän mukaan">
 <input type="submit" name="uusimmanmukaan2" value="Lajittele uusimman tiketin mukaan">
 </form>

<?php

//ODOTTAVAT TIKETIT


$sql = mysqli_query($conn, "SELECT * FROM tickets WHERE response IS NOT NULL AND status=0 ORDER by id DESC");

// LAJITTELUT

if($_POST['kayttajanmukaan2'] == true) {
    $sql = mysqli_query($conn, "SELECT * FROM tickets WHERE response IS NOT NULL AND status=0 ORDER BY user, id DESC");
    }

if($_POST['uusimmanmukaan2'] == true) {
        $sql = mysqli_query($conn, "SELECT * FROM tickets WHERE response IS NOT NULL AND status=0 ORDER BY id DESC");
        }


echo '<h1> Odottavat tiketit </h1>';
echo '<div class="row">';

while ($row = $sql->fetch_assoc()) {
    echo '<div class="column">';
    echo '<div class="card">';
    $id = $row['id'];
    echo '<input type="hidden" name="id" value='; echo $id; echo '>';
    echo '<i class="material-icons">calendar_today</i>';
    echo '<h3>';
    echo date('d.m.Y', strtotime($row["date"]));
    echo '</h3>';
    echo '<i class="material-icons">email</i>';
    echo '<h3>';
    echo $row ['user'];
    echo '</h3>';
    echo '<i class="material-icons">description</i>';
    echo '<h4>';
    echo $row['title'];
    echo '</h4>';
    echo '<div class="cardvastausviestit">';
    echo '<u><b><p> Palaute: </p></b></u>';
    echo '<u>';
    echo $row['message'];
    echo '</u>';
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
    echo '</u>';
    echo '</div>';
echo '<form action="adminindex.php" method="POST">';
echo '<input type="hidden" name="id" value='; echo $id; echo '>';
echo '<input type="submit" name="poista" value="Poista tiketti">';
echo '</form>';


// vastausketjut
echo '<div class="cardvastaus">';

$sql2 = mysqli_query($conn, "SELECT * FROM ketjut WHERE original_id = '$id' ORDER by id ASC");
while ($row = $sql2->fetch_assoc()) {
    echo '<div class="cardvastausviestit">';
    echo '<b>';
    echo date('d.m.Y', strtotime($row["date"]));
    echo '<p> Vastaus: </p>';
    echo $row['user'];
    echo '<br>';
    echo '</b>';
    echo $row ['reply'];
    echo '<br>';
    echo '</div>';
    }
echo '</div>';
echo '</div>';
echo '</div>';

}
echo '</div>';

//poisto nappi
if (isset($_POST['poista'])) {
    $poistatiketti = $_POST['id'];  
    $sql = mysqli_query($conn, "DELETE FROM tickets WHERE id = '$poistatiketti'");  
    header ("Location: adminindex.php");
}


?>

<!--- LAJITTELUNAPIT --->

<form action="adminindex.php" method="post">
 <input type="submit" name="kayttajanmukaan3" value="Lajittele käyttäjän mukaan">
 <input type="submit" name="uusimmanmukaan3" value="Lajittele uusimman tiketin mukaan">
 </form>


<?php

//VASTAUSTA VAILLE OLEVAT TIKETIT


$sql = mysqli_query($conn, "SELECT * FROM tickets WHERE status=2 ORDER by id DESC");

// LAJITTELUT

if($_POST['kayttajanmukaan3'] == true) {
    $sql = mysqli_query($conn, "SELECT * FROM tickets WHERE status=2 ORDER BY user, id DESC");
    }

if($_POST['uusimmanmukaan3'] == true) {
        $sql = mysqli_query($conn, "SELECT * FROM tickets WHERE status=2 ORDER BY id DESC");
        }


echo '<div class="row">';
echo '<h1> Vastausta vailla olevat tiketit </h1>';

while ($row = $sql->fetch_assoc()) {
echo '<div class="column">';
echo '<div class="card">';
$id = $row['id'];
echo '<input type="hidden" name="id" value='; echo $id; echo '>';
echo '<i class="material-icons">calendar_today</i>';
echo '<h3>';
echo date('d.m.Y', strtotime($row["date"]));
echo '</h3>';
echo '<i class="material-icons">email</i>';
echo '<h3>';
echo $row ['user'];
echo '</h3>';
echo '<i class="material-icons">description</i>';
echo '<h4>';
echo $row['title'];
echo '</h4>';
echo '<div class="cardvastausviestit">';
echo '<u><b><p> Palaute: </p></b></u>';
echo '<u>';
echo $row['message'];
echo '</u>';
echo '<br>';
echo '<br>';

if (isset($row['image']) && !empty($row['image'])) {
    echo "<img src='image/".$row['image']."' height='200' width='200'  >"; 
    } else {
        echo "<img src='image/default.jpg' style='height:200px'draggable='false'>";
    }  
    
echo '<br>';
echo '<br>';
echo '<u><b><p> Ylläpidon vastaus: </p></b></u>';
echo '<u>';
echo $row['response'];
echo '</u>';
echo '<br>';
echo '</div>';

//vastausnappi form
echo '<form action="adminindex.php" method="POST">';
echo '<input type="hidden" name="id" value='; echo $id; echo '>';
echo '<br>';
echo '<input type="submit" name="vastausnappi" value="Vastaa">';
echo '</form>';

// vastaus boksi
if ($id == $_SESSION['vastausadmin']) {
    echo '<form action="adminvastaus.php" method="POST">';
    echo '<input type="text" name="vastaus2admin" value="'; echo '" id="">'; 
    echo '<input type="submit" value="vastaa tikettiin">';
    echo '</form>';
    echo '<form action="adminindex.php" method="POST">';
    echo '<input type="submit" value="Peru vastaus" name="peruvastaus">';
    echo '</form>';


} 

// VASTAUSKETJUN TULOKSET

echo '<div class="cardvastaus">';
$sql2 = mysqli_query($conn, "SELECT * FROM ketjut WHERE original_id = '$id' ORDER by id DESC");
while ($row = $sql2->fetch_assoc()) {
    echo '<div class="cardvastausviestit">';
    echo '<b>';
    echo date('d.m.Y', strtotime($row["date"]));
    echo '<br>';
    echo $row['user'];
    echo '<br>';
    echo '</b>';
    echo $row ['reply'];
    echo '<br>';
    echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';

//vastausnapin funktiot

// vastaus session

if (isset($_POST['vastausnappi'])) {
    $_SESSION['vastausadmin'] = $_POST['id']; 
    $_SESSION['statussessionadmin'] = $_POST['id']; 
    header ("Location: adminindex.php");
}

//peru vastaus
if (isset($_POST['peruvastaus'])) {
    unset($_SESSION['vastausadmin']);
    header ("Location: adminindex.php");
}




?>

<!--- LAJITTELUNAPIT --->

<form action="adminindex.php" method="post">
 <input type="submit" name="kayttajanmukaan4" value="Lajittele käyttäjän mukaan">
 <input type="submit" name="uusimmanmukaan4" value="Lajittele uusimman tiketin mukaan">
 </form>

<?php

//SELVITETYT TIKETIT


$sql = mysqli_query($conn, "SELECT * FROM tickets WHERE status=1 ORDER by id DESC");
// LAJITTELUT

if($_POST['kayttajanmukaan4'] == true) {
    $sql = mysqli_query($conn, "SELECT * FROM tickets WHERE status=1 ORDER BY user, id DESC");
    }

if($_POST['uusimmanmukaan4'] == true) {
        $sql = mysqli_query($conn, "SELECT * FROM tickets WHERE status=1 ORDER BY id DESC");
        }

echo '<div class="row">';
echo '<h1> Selvitetyt tiketit </h1>';

while ($row = $sql->fetch_assoc()) {
echo '<div class="column">';
echo '<div class="card">';
$id = $row['id'];
echo '<input type="hidden" name="id" value='; echo $id; echo '>';
echo '<i class="material-icons">calendar_today</i>';
echo '<h3>';
echo date('d.m.Y', strtotime($row["date"]));
echo '</h3>';
echo '<i class="material-icons">email</i>';
echo '<h3>';
echo $row ['user'];
echo '</h3>';
echo '<i class="material-icons">description</i>';
echo '<h4>';
echo $row['title'];
echo '</h4>';
echo '<div class="cardvastausviestit">';
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
echo '<br>';
echo '<u><b><p> Vastaus: </p></b></u>';
echo '<u>';
echo $row['response'];
echo '</u>';
echo '<br>';
echo '</div>';

echo '<div class="cardvastaus">';
$sql2 = mysqli_query($conn, "SELECT * FROM ketjut WHERE original_id = '$id' ORDER by id ASC");
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


?>

</body>
</html>


<?php
} else {
    echo '<h1> Et ole kirjautunut sisään adminina. </h1>';
    echo '<br>';
    echo '<a href="adminlogin.php"> admin </a>';
}
?>