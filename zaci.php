<?php

    require "assets/database.php"; // požaduji připojení k databázi
    require "assets/zak.php"; // požaduji napojení na soubor zak.php

    $connection = connectionDB(); // Zavolám funkci connectionDB(), kterou mám v souboru: database.php
    // Tímto se tato stránka webu připojí k databázi a na stránce se zobrazí VŠICHNI ŽÁCI v databázi.
    $students = getAllStudents($connection, "id, first_name, second_name" ); // funkci MUSÍM MÍT ULOŽENOU v proměnné $students, která je v HTML kódu
    // jako parametr jsem přidal string se SEZNAMEM sloupečků, KTERÉ CHCI Z DATABÁZE TADY VYTÁHNOUT DO STRÁNKY
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <meta name="author" content="František Belay" />
    <meta name="contact" content="frabel@volny.cz" />
    <meta http-equiv="X-UA-Compatible" content="ie-edge" />
    <meta name="description" content="Hlavní stránka databáze" />
    
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./query/header-query.css">
    <link rel="stylesheet" href="./css/zaci.css">
    <link rel="stylesheet" href="./css/footer.css">

    <script src="https://kit.fontawesome.com/fc1864d9f1.js" crossorigin="anonymous"></script>

    <title>Žáci</title>
</head>

<body>
    <?php require "assets/header.php";?>
    <main>
        <section class="main-heading">
            <h1>Seznam žáků školy</h1>
        </section>

        <section class="students-list"></section>
            <?php if(empty($students)):?>
                <p>Žádní žáci nebyli nalezeni.</p>
            <?php else: ?>
                <ul>
                    <?php foreach($students as $one_student): ?>
                        <li>
                            <?php echo htmlspecialchars($one_student["first_name"]) . " " . htmlspecialchars($one_student["second_name"]) ?>   
                        </li>
                            <a href="jeden-zak.php?id=<?=$one_student["id"]?>">Více informací</a>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
        <br>
        <section>
            <a href="index.php">Zpět na hlavní stránku.</a>
        </section>
    </main>
    
    <?php require "assets/footer.php";?>
    
<script language="javascript" src="./js/header.js"></script>
</body>
</html>