<title>Profil</title>
<?php
session_start();

// odhlásenie
if(isset($_GET['logout'])){
    session_destroy();
    echo "Odhlásenie prebehlo úspešne";
    echo '<meta http-equiv="refresh" content="1;user.php" />';
    exit();
}

// pripojenie na databázu
require_once ('db_conn.php');

// prihlásenie
if(isset($_GET['name']) && isset($_GET['pass'])){
    // vyhľadanie používateľa podľa mena a zobrazenie jeho status
    $sql = "SELECT * FROM users WHERE name = '" . $_GET['name'] . "' AND pass ='" . $_GET['pass'] . "'";
    $ret = pg_query($db, $sql);

    // ziskam data z odpovede
    $row = pg_fetch_assoc($ret);

    $_SESSION['login'] = $row['name'];
    $_SESSION['status'] = $row['status'];

    echo '<meta http-equiv="refresh" content="0;user.php" />';
    exit();
}

// zmena statusu
if(isset($_GET['status']) && isset($_SESSION['login'])){
    $sql = "UPDATE users SET status = '" . $_GET['status'] . "' WHERE name = '" . $_SESSION['login'] . "'";
    $ret = pg_query($db, $sql);

    $_SESSION['status'] = $_GET['status'];

    if(isset($_GET['hide'])){
        echo "<script>window.close();</script>";
    } else {
        echo '<meta http-equiv="refresh" content="0;user.php" />';
    }
    exit();
}

// zobrazenie prihláseného používateľa alebo formulára na prihlásenie
if(isset($_SESSION['login'])){
    ?>
    Prihlásený ako <?php echo $_SESSION['login']; ?>
    <a href='user.php?logout'>Odhlásenie</a>
    </br></br>
    Status : <?php echo $_SESSION['status']; ?></br></br>
    <form action="user.php" method="get">
        Zmena statusus <input name="status">
        <input type="submit" value="Zmeniť">
    </form>
    <?php
} else {
    ?>
    Prihlásenie
    <form action="user.php" method="get">
        Meno <input name="name"></br>
        Heslo <input name="pass"></br>
        <input type="submit" value="Odoslať">
    </form>
    <?php
}