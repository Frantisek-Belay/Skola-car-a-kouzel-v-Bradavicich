<?php

require "assets/database.php";
require "assets/zak.php";

$connection = connectionDB();

if( isset($_GET["id"]) ) {
    $one_student = getStudent($connection, $_GET["id"]);
    
    // TÍMTO ZÍSKÁVÁM DATA Z DATABÁZE:
    if($one_student) { // pokud bude $one_student: true, přidej mi data z asoc. pole do proměnných.
        // Proměnné jsou uvedeny ve formuláři u Atributu value.
        // Proměnné MUSÍM NADEFINOVAT, ODKUD BUDU DATA DO POLÍ FORMULÁŘE ZÍSKÁVAT:
        $first_name = $one_student["first_name"]; // TOTO ZAJISTÍ zobrazení dat z asociativního pole $one_student 
        $second_name = $one_student["second_name"]; // názvy proměnných jsou názvy sloupečků v databázi
        $age = $one_student["age"];
        $life = $one_student["life"];
        $college = $one_student["college"];
        $id = $one_student["id"];
        
    } else { // pokud bude $one_student: false
        die("Student nenalezen."); // PROGRAM "zabij" = UKONČI a vypiš hlášku.
    } // Po této HLÁŠCE se už ŽÁDNÝ FORMULÁŘ na stránce NEOBJEVÍ  a program SKONČÍ s PRÁZDNOU STRÁNKOU.

} else { // pokud v URL neuvedu ŽÁDNÉ ID (v URL adrese NEBUDE: ?id=xxx),
    die("ID nebylo zadáno, student nebyl nalezen."); // PROGRAM "zabij" = UKONČI a vypiš hlášku.
}

// TÍMTO BUDU DATA DO DATBÁZE ODESÍLAT:
// Pokud došlo k odeslání dat, tato podmínka skončí jako: true, a začne se provádět {kód v závorkách}
if($_SERVER["REQUEST_METHOD"] == "POST") { // toto se spustí AŽ v okamžiku, kdy kliknu na tlačítko ULOŽIT.
    // "POST" - znamená místo ve formuláři:
    $first_name = $_POST["first_name"]; 
    $second_name = $_POST["second_name"]; // názvy proměnných jsou názvy sloupečků v databázi
    $age = $_POST["age"];
    $life = $_POST["life"];
    $college = $_POST["college"];
    // <= TOTO JSOU NOVÉ HODNOTY VE FORMULÁŘI.

    // ZAVOLÁM FUNKCI PRO UPDATE INFORMACÍ O ŽÁKOVI, která je v souboru: zak.php
    updateStudent($connection, $first_name, $second_name, $age, $life, $college, $id);
    // Tyto NOVÉ HODNOTY potřebuju POSLAT DO DATABÁZE POMOCÍ SQL dotazu ve funkci updateStudent.

}

// Jsem na stránce s daty studenta s id=302 v URL adrese.
// var_dump($one_student); // Na stránce vypíše:
// array(6) { ["id"]=> int(302) ["first_name"]=> string(4) "Jana" ["second_name"]=> string(10) "Magicková" ["age"]=> int(15) ["life"]=> NULL ["college"]=> NULL }

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="František Belay" />
    <meta name="contact" content="frabel@volny.cz" />
    <meta http-equiv="X-UA-Compatible" content="ie-edge" />
    <meta name="description" content="Stránka pro editaci záznamů o žákovi" />

    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./query/header-query.css">
    <link rel="stylesheet" href="./css/editace-zaka.css">
    <link rel="stylesheet" href="./css/footer.css">

    <script src="https://kit.fontawesome.com/fc1864d9f1.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>

<?php require "assets/header.php";?>

<main>

<?php require "assets/formular-zak.php";?> <!-- požaduju tady formulář -->

</main>

<?php require "assets/footer.php";?>
<script language="javascript" src="./js/header.js"></script>
</body>
</html>