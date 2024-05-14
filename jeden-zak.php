<?php

    require "assets/database.php";
    require "assets/zak.php";

    // Zavolám-li funkci connectionDB() jako první z tohoto místa "ručně",
    // potřebuju přidat do URL: ?id=2 (číslo je existující id)  
    // Zbylé soubory webu ještě zatím tuto fci nevolají, proto budou vracet chybu.

    $connection = connectionDB(); 

    if ( isset($_GET["id"]) and is_numeric($_GET["id"]) ) { // id je přiděleno? id je číslo?
        $students = getStudent($connection, $_GET["id"]); // zavolám funkci getStudent v souboru zak.php
        // do funkce potřebuji poslat připojení k databázi a id z URL adresy.
        // do $students se vrátí asociativní pole ze souboru zak.php: 
        // return mysqli_fetch_array($result, MYSQLI_ASSOC);
        // vracenou hodnotu MUSÍM ULOŽIT DO PROMĚNNÉ!!!
    } else {
        $students = null;
    }
    
?>

<!DOCTYPE html>
<html lang="cz">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="František Belay" />
    <meta name="contact" content="frabel@volny.cz" />
    <meta http-equiv="X-UA-Compatible" content="ie-edge" />
    <meta name="description" content="Zobrazení záznamů jednoho žáka" />

    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./query/header-query.css">
    <link rel="stylesheet" href="./css/jeden-zak.css">
    <link rel="stylesheet" href="./css/footer.css">

    <script src="https://kit.fontawesome.com/fc1864d9f1.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>

    <?php require "assets/header.php";?>

    <main>
        <section class="main-heading">
            <h1>Informace o žákovi</h1>
        </section>

    <section>
            <?php if($students === null):?>
                <p>Žák nenalezen</p>
            <?php else: ?>
                <h2><?= htmlspecialchars($students["first_name"]) . " " . htmlspecialchars($students["second_name"]) ?></h2>
                <p>Věk: <?= htmlspecialchars($students["age"])?></p>
                <p>Dodatečné informace: <br><?= htmlspecialchars($students["life"])?></p>
                <p>Kolej: <?= htmlspecialchars($students["college"])?></p>
            <?php endif ?>
    </section>
    <br>

    <section class="bottons">
        <a href="editace-zaka.php?id=<?=$students['id'] ?>">Editovat </a>

        <a href="delete-zak.php?id=<?=$students['id'] ?>"> Vymazat žáka</a>
        <!-- Tímto odkazem řeknu, že budu chtít TOHOTO žáka, kterého mám zobrazeného, VYMAZAT -->
    </section>

    <br>
    <a href="pridat-zaka.php">Přidat žáka do databáze žáků.</a>
    <br>
    <a href="zaci.php">Zpět na zaci.php</a>
    <br>
    <a href="index.php">Zpět na hlavní stránku.</a>
    </main>
    
    <?php require "assets/footer.php";?>
    <script language="javascript" src="./js/header.js"></script>
</body>
</html>