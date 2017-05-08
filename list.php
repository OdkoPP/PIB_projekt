<title>Zoznam</title>
<?php
// pripojenie na databázu
require_once ('db_conn.php');

// zobrazenie všetkých záznamov z tabuľky používateľov
$sql = "SELECT * FROM users";
$ret = pg_query($db, $sql);
if(!$ret) {
    echo pg_last_error($db);
    exit();
} else {
    echo "<table border='1'>";
    echo "<tr style='background-color: lightcyan'><td>Meno</td><td> &nbsp; Status</td></tr>";
    while($row = pg_fetch_assoc($ret)) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td><td> &nbsp; " . $row['status'] ."</td>";
        echo "</tr>";
    }
}