<?php

require "url.php"; // ještě doplním požadavek na soubor url.php, kde je funkce uložena.

// TATO FUNKCE MI VRÁTÍ ASOCIATIVNÍ POLE JEDNOHO ŽÁKA:

/**
 * ZÍSKÁ JEDNOHO ŽÁKA PODLE ID
 * 
 * @param object $connection = připojení k databázi
 * @param integer $id - id jednoho konkrétního žáka
 * 
 * @return mixed asociativní pole, které obsahuje informace o jednom konkrétním žákovi nebo vrátí null, pokude žák nebyl nalezen.
 *
 */

function getStudent($connection, $id, $columns = "*") { // <= Parametry; columns = jaké sloupečky chci použít
    // "Získat studenta" - Připoj se do databáze na KONKRÉTNÍ id:
    // Pokud columns NEJSOU zadány (nepošlu ti je), columns = * (All)
    $sql = "SELECT $columns  
            FROM student
            WHERE id = ?"; // pro bezpečnost požiju na místě id otazník.
            // Vytvoř SQL dotaz, kde mi vyber všechny sloupečky z tabulky student kde id je konkrétní hodnota

        $stmt = mysqli_prepare($connection, $sql); // připrav se na spojení a připrav SQL dotaz

        if($stmt === false) {
            echo mysqli_error($connection); // pokud příprava na spojení skončila false, vypiš CHYBU
        } else {
            mysqli_stmt_bind_param($stmt, "i", $id);// jinak mi doplň otazník v SQL dotazu konkrétní hodnotou
            // připojení + nahradím otazník v SQL dotazu: datový typ int("i") + id bude mít konkrétní 
            // hodnotu, kterou do funkce budu posílat.

            if(mysqli_stmt_execute($stmt)) {// proveď to.
                $result = mysqli_stmt_get_result($stmt); // bude-li VŠE OK, ulož mi data do $result.
                return mysqli_fetch_array($result, MYSQLI_ASSOC); // $result mi převeď na ASOCIATIVNÍ POLE a vrať mi to.
        } 
    }
}


/**
 * Updatuje informace o žákovi v databázi
 * 
 * @param object $connection = připojení k databázi
 * @param string $first_name - křestní jméno žáka
 * @param string $second_name - příjmení
 * @param integer $age - věk žáka
 * @param string $life - informace o žákovi
 * @param string $college - kolej žáka
 * @param integer $id - id jednoho konkrétního žáka
 * 
 * @return void - funkce NEVRACÍ ŽÁDNOU hodnotu, pouze vypisuje HLÁŠKY.
 *
 */

 // FUNKCE PRO UPDATE INFORMACÍ O ŽÁKOVI:
function updateStudent($connection, $first_name, $second_name, $age, $life, $college, $id){ // <= Parametry

    $sql = "UPDATE student
    SET first_name = ?,
        second_name = ?,
        age = ?,
        life = ?,
        college = ?
    WHERE id = ?";

    $stmt = mysqli_prepare($connection, $sql); // připrav se na spojení s databází a k odeslání SQL dotazu.

    if($stmt === false) { // 2. způsob NEGATIVNÍ PODMÍNKY: (!$stmt) => NEGACE toho, že stmt je OK.
        echo mysqli_error($connection); // TENTO ŘÁDEK VŽDY PATŘÍ PODMÍNCE, KTERÁ JE: true !!
        // Mě ALE ZAJÍMÁ, jestli PODMÍNKA NENÍ: true, ALE: false !!!
    } else { // POKUD je stmt OK (true), NAPLŇ SQL dotaz:
        mysqli_stmt_bind_param($stmt, "ssissi", $first_name, $second_name, $age, $life, $college, $id);
        // tím jsem SQL dotaz NAPLNIL.

        if(mysqli_stmt_execute($stmt)) { // TEĎ TEN NAPLNĚNÝ SQL dotaz POŠLI (PROVEĎ)
            
            // Funkce pro přesměrování (viz. soubor: url.php)
            redirectUrl("/www2databaze/jeden-zak.php?id=$id"); // <= tato adresa nahrazuje: $path
        }
    }
}

/**
 * Vymaže studenta z databáze podle daného id
 * 
 * @param object $connection = připojení k databázi
 * @param integer $id = id daného žáka
 * 
 * @return void (NIC NEVRACÍ)
 */
function deleteStudent($connection, $id) { // Parametry: $connection, $id
    
    $sql = "DELETE 
            FROM student
            WHERE id = ?";

    $stmt = mysqli_prepare($connection, $sql); // připrav se na spojení s databází a k odeslání SQL dotazu. 
            
    if($stmt === false) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if(mysqli_stmt_execute($stmt)) {
            redirectUrl("/www2databaze/zaci.php");
        }
    }
}


/**
 * 
 * Vrátí VŠECHNY žáky z databáze
 * 
 * @param object $connection připojení k databázi
 * 
 * @return array pole objektů, kde každý objekt je jeden žák
 * 
 */
function getAllStudents($connection, $columns = "*") { // = Parametr - potřebuju se do databáze VŽDY NEJDŘÍVE PŘIPOJIT
    // Pokud columns NEJSOU zadány (nepošlu ti je), columns = * (All)
        $sql = "SELECT $columns
            FROM student"; 
         // WHERE college = 'Nebelvír'  // 1. SQL DOTAZ
       
    // echo "<br>"; 
    $result = mysqli_query($connection, $sql); // 2. ODEŠLU SQL DOTAZ DO DATABÁZE

    if($result === false){
        echo mysqli_error($connection);
    } else { 
        $allStudents = mysqli_fetch_all($result, MYSQLI_ASSOC); // 3. PŘEVEDU CELÉ POLE NA ASOCIATIVNÍ POLE
        // fetch_all = načíst_vše   
        return $allStudents;   
    }
}


/**
 * Přidá žáka do databáze a přesměruje nás na žáka
 * 
 * @param object $connection - připojení do databáze
 * @param string $first_name - křestní jméno žáka
 * @param string $second_name - příjmení ýáka
 * @param integer $age - věk žáka
 * @param string $life - informace o žákovi
 * @param string $college - kolej žáka
 * 
 * @return void // nic nevrací
 * 
 */
function createStudent($connection, $first_name, $second_name, $age, $life, $college) { 
        // id se vytvoří AŽ v databázi
        // Tady je formulován SQL dotaz pro můj formulář v HTML kódu:  // názvy sloupečků
        $sql = "INSERT INTO student (first_name, second_name, age, life, college) 
        VALUES (?,?,?,?,?)"; 
        // otazníky připravují místa pro všech pět polí formuláře
        
        $statement = mysqli_prepare($connection, $sql); // příprava na spojení s databází a odeslání SQL dotazu
        
        if($statement === false ) {
            echo mysqli_error($connection);
        } else { // Konkrétní hodnoty v polích:
            mysqli_stmt_bind_param($statement, "ssiss", $first_name, $second_name, $age, $life, $college); // parametry SQL dotazu se specifikací datových typů polí formuláře: ssiss
                // ssiss => string,string,int,string,string
    
            if (mysqli_stmt_execute($statement)) { // vlož data do databáze
                    $id = mysqli_insert_id($connection); // Vytáhne id posledně vloženého žáka z databáze
                    // Funkce pro přesměrování (viz. soubor: url.php)
                    redirectUrl("/www2databaze/jeden-zak.php?id=$id"); // = tato adresa nahrazuje: $path
                } else {
                    echo mysqli_stmt_error($statement);
            }
        }
    }
