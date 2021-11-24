<?php
include_once "connect.php";

$feedback = mysqli_real_escape_string($conn, $_POST["message"]);


$sql = "INSERT INTO tickets (message) VALUES('$feedback')";

mysqli_query($conn, $sql);
header ("location: palaute.php");





?>