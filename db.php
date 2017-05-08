<title>Databáza</title>
<?php
// pripojenie na databázu
require_once ('db_conn.php');

// vymazanie tabuľky s používateľmi
$sql = "DROP TABLE users;";
$ret = pg_query($db, $sql);

// overenie úspešnosti vymazania tabuľky používateľov
if(!$ret) {
    echo "<b>ERROR</b> - Tabuľa nebola vymazaná. Pravdepodobne neexistovala</br>";
    echo pg_last_error($db);
} else {
    echo "Tabuľka vymazaná úspešne</br>";
}

// --------------------------------------------------------

// vytvorenie tabuľky používateľov (meno, heslo, tajomstvo)
$sql = "
CREATE TABLE users (
  id      BIGSERIAL   PRIMARY KEY,
  name    TEXT                    NOT NULL,
  pass    VARCHAR (32)            NOT NULL,
  status TEXT                     NOT NULL
);
";
$ret = pg_query($db, $sql);

// overenie úspešnosti vytvorenia tabuľky pre používatelov
if(!$ret) {
    echo "<b>ERROR</b> - Tabuľka nebola vytvorená</br>";
    echo pg_last_error($db);
    exit();
} else {
    echo "Tabuľka bola vytvorená úspešne</br>";
}

// --------------------------------------------------------

// naplnenie tabuľky používateľmi a ich údajmi
$sql = "
INSERT INTO users (name, pass, status) VALUES
  ('Ondrej', 'A123', 'Dnes je pekný deň'),
  ('Patrik', 'B123', 'Konečne doma'),
  ('Tomas',  'C123', 'Barca :(')
";
$ret = pg_query($db, $sql);

// overenie úspešnosti vloženia záznamov
if(!$ret) {
    echo "<b>ERROR</b> - záznamy sa nepodarilo pridať do databázy</br>";
    echo pg_last_error($db);
    exit();
} else {
    echo "záznamy pridané do databázy úspešne</br>";
}

// --------------------------------------------------------

// zobrazenie všetkých záznamov z tabuľky používateľov
$sql = "
SELECT * FROM users
";
$ret = pg_query($db, $sql);
if(!$ret) {
    echo "Nepodarilo sa získať záznamy z tabuľky";
    echo pg_last_error($db);
    exit();
} else {
    echo "</br>Záznamy z tabuľky používateľov";
    echo "<table>";
    while($row = pg_fetch_assoc($ret)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td><td>" . $row['name'] ."</td>";
        echo "</tr>";
    }
}

// --------------------------------------------------------

// zatvorenie spojenia s databázou
pg_close($db);