<html>
<head>
    <title>Palaute prototyyppi</title>
</head>
<body>
    <ul>
        <li><a href="adminindex.php"> admin sivu tulee tänne</a></li>
        <li><a href="register.php"> käyttäjän rekisteröinti </a></li>
        <li><a href="kirjaudu.php"> kirjautuminen </a></li>

</ul>
    <h2> FEEDBACK FORM </H2>
    <form action="palautelahetys.php" method="POST">
        <input type="text" name="message" placeholder="Kirjoita palautteesi tähän"><br>
        <input type="submit"><br>
</form>
</body>
</html>



<?php
include_once "connect.php";
?>