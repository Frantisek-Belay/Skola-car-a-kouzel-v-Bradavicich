<?php


/**
 * Funkce PŘESMĚROVÁVÁ NA ZADANOU URL ADRESU
 * 
 * @param string $path = adresa, na kterou se má přesměrovat
 * 
 * @return void = Funkce NIC NEVRACÍ (proto void)
 * 
 */
function redirectUrl($path) { // $path = "cesta", tedy adresa, kam budu přesměrovávat.

    // PŘESMĚROVÁNÍ NA STRÁNKU S DATY JEDNOHO ŽÁKA:
    if(isset($_SERVER["HTTPS"]) and $_SERVER["HTTPS"] != "off") { // máš nast. protokol HTTPS a NENÍ VYPNUTÝ?
        $url_protocol = "https"; // pokud ANO, platí tento protokol.
    } else {
        $url_protocol = "http"; // pokud NE, platí tento protokol.
    }

    // Tady se tvoří ADRESA PRO PŘESMĚROVÁNÍ:
    header ("location: $url_protocol://" . $_SERVER["HTTP_HOST"] . $path);
    // $path = "cesta", tedy adresa, kam budu přesměrovávat.

}