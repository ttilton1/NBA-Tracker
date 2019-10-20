<?php

include("/etc/php/pdo-nba.php");
$dbh = dbconnect();

$pID = isset($_GET['playerID']) ? $_GET['playerID'] : null;



$st = $dbh->query("WITH t as (SELECT * from playersTable WHERE playerID = ".$pID.")SELECT json_agg(t) from t");
while ($myrow = $st->fetch()) {
    echo json_encode($myrow);

}







?>
