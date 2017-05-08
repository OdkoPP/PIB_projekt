<?php
// prihlasovacie údaje na pripojenie na databázu
$db_host = "localhost";
$db_port = 5432;
$db_name = "PIB";       // táto databáza je vopred vytvorená
$db_user = "postgres";
$db_pass = "postgres";

// pripojenie sa na databázu pomocou zadaných údajov
$db = $dbconn3 = pg_connect(
    " host=" . $db_host .
    " port=" . $db_port .
    " dbname=" . $db_name .
    " user=" . $db_user .
    " password=" . $db_pass
);

// overenie úspešnosti pripojenia k databáze
if(!$db) {
    echo "<b>ERROR</b> - Nepodarilo sa pripojiť ku databáze</br>";
    echo pg_last_error($db);
    exit;
} else {
    //echo "Pripojenie prebehlo úspešne</br>";
}