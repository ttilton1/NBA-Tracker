<?php

include("/etc/php/pdo-nba.php");
$dbh = dbconnect();

$tID = isset($_GET['teamID']) ? $_GET['teamID'] : null;



$st = $dbh->query("WITH t as (SELECT * from teamsTable WHERE teamID = ".$tID.")SELECT json_agg(t) from t");
while ($myrow = $st->fetch()) {
    echo json_encode($myrow);

}







?>
