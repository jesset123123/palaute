<?php

include "connect.php";
session_start();

$username =  mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);



$sql = "SELECT * FROM user WHERE email = '$username'";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck < 1) {
    $_SESSION['virhe'] = "Virheelliset kirjautumistiedot";
    header("Location: kirjaudu.php");


} else {

if($row = mysqli_fetch_assoc($result)) {
    $salasananmuunnos = password_verify($password, $row['password']);
    if ($salasananmuunnos == FALSE) {
        $_SESSION['virhe'] = "Virheelliset kirjautumistiedot";
    header("Location: kirjaudu.php");
} else if ($salasananmuunnos == TRUE) {
    $_SESSION['user_session'] = $username;
    header("Location: index.php");
    ?>

<?php



}


}

}


?>