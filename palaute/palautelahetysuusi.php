<?php
error_reporting(0);
session_start();
include_once "connect.php";

$msg = "";

$filename = $_FILES["uploadfile"]["name"];
$tempname = $_FILES["uploadfile"]["tmp_name"];    
$folder = "image/".$filename;

$user = $_SESSION['user_session'];
$otsikko = mysqli_real_escape_string($conn, $_POST["otsikko"]);
$feedback = mysqli_real_escape_string($conn, $_POST["message"]);


$sql = "INSERT INTO tickets (title, message, date, user, image) VALUES('$otsikko', '$feedback', CURDATE(), '$user', '$filename')";

mysqli_query($conn, $sql);

if (move_uploaded_file($tempname, $folder))  {
    $msg = "onnistui";
}else{
    $msg = "epäonnistui";
}

  header ("location: index.php");



?>