<?php

include("/etc/php/pdo-nba.php");
$dbh = dbconnect();

$stat = isset($_GET['inputGroupTSelectStats']) ? $_GET['inputGroupTSelectStats'] : null;
$comp = isset($_GET['inputGroupTSelectComp']) ? $_GET['inputGroupTSelectComp'] : null;
$num = isset($_GET['statTInput']) ? $_GET['statTInput'] : null;







$st = $dbh->query("WITH t as (SELECT * from teamsTable WHERE ".$stat." ".$comp." ".$num." ORDER BY ".$stat." DESC)SELECT json_agg(t) from t");
while ($myrow = $st->fetch()) {
    echo json_encode($myrow);

}

?>
