<?php

include("/etc/php/pdo-nba.php");
$dbh = dbconnect();

$stat = isset($_GET['inputGroupSelectStats']) ? $_GET['inputGroupSelectStats'] : null;
$comp = isset($_GET['inputGroupSelectComp']) ? $_GET['inputGroupSelectComp'] : null;
$num = isset($_GET['statInput']) ? $_GET['statInput'] : null;







$st = $dbh->query("WITH t as (SELECT * from playersTable WHERE ".$stat." ".$comp." ".$num." ORDER BY ".$stat." DESC)SELECT json_agg(t) from t");
while ($myrow = $st->fetch()) {
    echo json_encode($myrow);

}

?>
