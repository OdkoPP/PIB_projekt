<title>Registrácia</title>
Registrácia
<form action="register.php" method="get">
    Meno <input name="name"></br>
    Heslo <input name="pass"></br>
    Status <input name="status"></br>
    <input type="submit" value="Odoslať">
</form>

<?php
// overenie, či mám vstup
if(empty($_GET)) { exit(); }

// pripojenie na databázu
require_once ('db_conn.php');

// vyhľadanie používateľa podľa mena a zobrazenie jeho tajomstva
$sql = "
  INSERT INTO users (name, pass, status) 
  VALUES ('" . $_GET['name'] . "', '" . $_GET['pass'] . "', '" . $_GET['status'] . "');
";
$ret = pg_query($db, $sql);
if(!$ret) {
    echo pg_last_error($db);
    exit;
} else {
    echo "Registrácia prebehla úspešne";
    echo '<meta http-equiv="refresh" content="1;register.php" />';
}

