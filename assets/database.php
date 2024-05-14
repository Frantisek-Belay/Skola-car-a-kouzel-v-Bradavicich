<?php

    // TUTO FUNKCI MUSÍM NÁSLEDNĚ ZAVOLAT V SOUBORECH, KTERÉ MAJÍ PŘIPOJENÍ NA DATABÁZI A POUŽÍVAJÍ DATA Z DATABÁZE.

    /**
     * Připojení k databázi
     * 
     * @return object pro připojení k databázi
     * 
     */

    function connectionDB() {
        $db_host = "localhost"; // (127.0.0.1)
        $db_user = "frantisek";
        $db_password = "adminadmin";
        $db_name = "skola";

        $connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

        if (mysqli_connect_error()){ // jestliže se zde objeví CHYBA,
            echo mysqli_connect_error(); // nalezenou CHYBU VYPIŠ, a
            exit; // program UKONČI.
        }

        return $connection; // Vrať mi připojení k databázi do proměnné $connection
    }
  
