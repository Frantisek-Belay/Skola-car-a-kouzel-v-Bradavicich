<?php

require "assets/database.php"; // odkaz na soubor database.php, ve kterém je uložená proměnná $connection
require "assets/zak.php"; // požaduji soubor zak.php s funkcí pro přidání žáka do databáze

$first_name = null;
$second_name = null;
$age = null;
$life = null;
$college = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") { // POST = OBSAH FORMULÁŘE HTML

    $first_name = $_POST["first_name"]; // vyplním pole formuláře skutečnými hodnotami
    $second_name = $_POST["second_name"];
    $age = $_POST["age"];
    $life = $_POST["life"];
    $college = $_POST["college"];
    
    $connection = connectionDB(); // připojím se k databázi
    
    createStudent($connection, $first_name, $second_name, $age, $life, $college);

}
   
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="František Belay" />
    <meta name="contact" content="frabel@volny.cz" />
    <meta http-equiv="X-UA-Compatible" content="ie-edge" />
    <meta name="description" content="Stránka pro přidání žáka do databáze" />

    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./query/header-query.css">
    <link rel="stylesheet" href="./css/pridat-zaka.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/footer.css">

    <script src="https://kit.fontawesome.com/fc1864d9f1.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>

<?php require "assets/header.php";?>

<main>

    <section class="add-form">
        
    <?php require "assets/formular-zak.php";?> <!-- požaduju tady formulář -->

    </section>
    <br>
    <a href="index.php">Zpět na hlavní stránku.</a>

</main>

<?php require "assets/footer.php";?>
<script language="javascript" src="./js/header.js"></script>
</body>
</html>