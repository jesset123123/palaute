<?php
error_reporting(0);
session_start();
include_once "connect.php";

$statusvaihto = $_SESSION['statussessionadmin'];
$originalid = $_SESSION['vastausadmin'];
$reply = mysqli_real_escape_string($conn, $_POST["vastaus2admin"]);


$sql = "INSERT INTO ketjut (original_id, reply, user, date) VALUES('$originalid', '$reply', 'admin', CURDATE())";
$sql2 = "UPDATE tickets SET status = '0' WHERE id = '$statusvaihto'";

mysqli_query($conn, $sql);
mysqli_query($conn, $sql2);



unset($_SESSION['vastausadmin']);

  header ("location: adminindex.php");



?>