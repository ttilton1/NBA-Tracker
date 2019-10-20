<?php

include("/etc/php/pdo-nba.php");
$dbh = dbconnect();

$city = isset($_GET['teamCity']) ? $_GET['teamCity'] : null;
$name = isset($_GET['teamName']) ? $_GET['teamName'] : null;


if(!empty($city) AND empty($name)){
  $st = $dbh->query("WITH t as (SELECT * from teamsTable WHERE LOWER (teamCity) LIKE LOWER('%".$city."%'))SELECT json_agg(t) from t");
       while ($myrow = $st->fetch()) {
           echo json_encode($myrow);
         }
}
if(!empty($city) AND !empty($name)){
  $st = $dbh->query("WITH t as (SELECT * from teamsTable WHERE LOWER (teamCity) LIKE LOWER('%".$city."%') AND LOWER (teamName) LIKE LOWER('".$name."'))SELECT json_agg(t) from t");
       while ($myrow = $st->fetch()) {
           echo json_encode($myrow);
         }
}

if(empty($city) AND !empty($name)){
  $st = $dbh->query("WITH t as (SELECT * from teamsTable WHERE LOWER (teamName) LIKE LOWER('".$name."'))SELECT json_agg(t) from t");
       while ($myrow = $st->fetch()) {
           echo json_encode($myrow);
         }
}

if(empty($city) AND empty($name)){
  $st = $dbh->query("WITH t as (SELECT * from teamsTable)SELECT json_agg(t) from t");
       while ($myrow = $st->fetch()) {
           echo json_encode($myrow);
         }
}



?>
