<?php

require "assets/database.php";
require "assets/zak.php";

$connection = connectionDB();

if($_SERVER["REQUEST_METHOD"] === "POST") { // PODMÍNKA NEJPRVE ZOBRAZÍ STRÁNKU S TLAČÍTKEM "Smazat"
deleteStudent($connection, $_GET ["id"]);
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
    <meta name="description" content="Stránka pro vymazání žáka z databáze" />

    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./query/header-query.css">
    <link rel="stylesheet" href="./css/delete-zak.css">
    <link rel="stylesheet" href="./css/footer.css">

    <script src="https://kit.fontawesome.com/fc1864d9f1.js" crossorigin="anonymous"></script>

    <title>Vymazat žáka</title>
</head>
<body>

<?php require "assets/header.php" ?>

<main>
<section class="delete-form">
    <form method="POST"> 
<!-- Pokud nepřidám Atribut action, BUDE fungovat I BEZ tohoto Atributu a automaticky se to odešle na TENTO stejný soubor -->
        <p>Jste si jisti, že chcete tohoto žáka vymazat z databáze žáků?</p>
        <a href="jeden-zak.php?id=<?= $_GET ['id'] ?>">Zrušit</a>
        <br>
        <br>
        <button>Smazat</button>
    </form>

</section>
</main>

<?php require "assets/footer.php" ?>
<script language="javascript" src="./js/header.js"></script>
</body>
</html>