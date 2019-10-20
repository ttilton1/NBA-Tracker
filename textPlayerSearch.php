<?php

include("/etc/php/pdo-nba.php");
$dbh = dbconnect();

$first = isset($_GET['playerFirst']) ? $_GET['playerFirst'] : null;
$last = isset($_GET['playerLast']) ? $_GET['playerLast'] : null;
$team = isset($_GET['playerTeam']) ? $_GET['playerTeam'] : null;
$pos = isset($_GET['playerPos']) ? $_GET['playerPos'] : null;


if(!empty($first) AND empty($last) AND empty($team) and ($pos === 'Position')){
  $st = $dbh->query("WITH t as (SELECT * from playersTable WHERE LOWER (firstName) LIKE LOWER('%".$first."%'))SELECT json_agg(t) from t");
       while ($myrow = $st->fetch()) {
           echo json_encode($myrow);
         }
}
if(!empty($first) AND !empty($last) AND empty($team) and ($pos === 'Position')){
  $st = $dbh->query("WITH t as (SELECT * from playersTable WHERE LOWER (playersTable.firstName) LIKE LOWER('".$first."') AND LOWER (playersTable.lastName) LIKE LOWER('".$last."'))SELECT json_agg(t) from t");
   while ($myrow = $st->fetch()) {
       echo json_encode($myrow);

   }
}
if(!empty($first) AND !empty($last) AND !empty($team) and ($pos === 'Position')){
  $st = $dbh->query("WITH t as (SELECT * from playersTable WHERE LOWER (playersTable.firstName) LIKE LOWER('".$first."') AND LOWER (playersTable.lastName) LIKE LOWER('".$last."') AND playersTable.currentTeamID = (SELECT teamID FROM teamsTable WHERE LOWER (teamsTable.teamName) LIKE LOWER('".$team."')))SELECT json_agg(t) from t");
   while ($myrow = $st->fetch()) {
       echo json_encode($myrow);

   }
}
if(empty($first) AND !empty($last) AND !empty($team) and ($pos === 'Position')){
  $st = $dbh->query("WITH t as (SELECT * from playersTable WHERE LOWER (playersTable.lastName) LIKE LOWER('".$last."') AND playersTable.currentTeamID = (SELECT teamID FROM teamsTable WHERE LOWER (teamsTable.teamName) LIKE LOWER('".$team."')))SELECT json_agg(t) from t");
   while ($myrow = $st->fetch()) {
       echo json_encode($myrow);

   }
}
if(empty($first) AND !empty($last) AND empty($team) and ($pos === 'Position')){
  $st = $dbh->query("WITH t as (SELECT * from playersTable WHERE LOWER(playersTable.lastName) LIKE LOWER('".$last."'))SELECT json_agg(t) from t");
   while ($myrow = $st->fetch()) {
       echo json_encode($myrow);

   }
}
if(empty($first) AND empty($last) AND !empty($team) and ($pos === 'Position')){
  $st = $dbh->query("WITH t as (SELECT * from playersTable WHERE playersTable.currentTeamID = (SELECT teamID FROM teamsTable WHERE LOWER(teamsTable.teamName) LIKE LOWER('".$team."')))SELECT json_agg(t) from t");
   while ($myrow = $st->fetch()) {
       echo json_encode($myrow);

   }
}
if(!empty($first) AND empty($last) AND !empty($team) and ($pos === 'Position')){
  $st = $dbh->query("WITH t as (SELECT * from playersTable WHERE LOWER(playersTable.firstName) LIKE LOWER('".$first."') AND playersTable.currentTeamID = (SELECT teamID FROM teamsTable WHERE LOWER(teamsTable.teamName) LIKE LOWER('".$team."')))SELECT json_agg(t) from t");
   while ($myrow = $st->fetch()) {
       echo json_encode($myrow);

   }
}
if(empty($first) AND empty($last) AND empty($team) and ($pos === 'Position')){
  $st = $dbh->query("WITH t as (SELECT * from playersTable)SELECT json_agg(t) from t");
   while ($myrow = $st->fetch()) {
       echo json_encode($myrow);

   }
}




if(!empty($first) AND empty($last) AND empty($team) and !($pos === 'Position')){
  $st = $dbh->query("WITH t as (SELECT * from playersTable WHERE LOWER (firstName) LIKE LOWER('%".$first."%') AND primaryPosition ='".$pos."')SELECT json_agg(t) from t");
       while ($myrow = $st->fetch()) {
           echo json_encode($myrow);
         }
}
if(!empty($first) AND !empty($last) AND empty($team) and !($pos === 'Position')){
  $st = $dbh->query("WITH t as (SELECT * from playersTable WHERE LOWER (playersTable.firstName) LIKE LOWER('".$first."') AND  primaryPosition ='".$pos."' AND LOWER (playersTable.lastName) LIKE LOWER('".$last."'))SELECT json_agg(t) from t");
   while ($myrow = $st->fetch()) {
       echo json_encode($myrow);

   }
}
if(!empty($first) AND !empty($last) AND !empty($team) and !($pos === 'Position')){
  $st = $dbh->query("WITH t as (SELECT * from playersTable WHERE LOWER (playersTable.firstName) LIKE LOWER('".$first."') AND primaryPosition ='".$pos."' AND LOWER (playersTable.lastName) LIKE LOWER('".$last."') AND playersTable.currentTeamID = (SELECT teamID FROM teamsTable WHERE LOWER (teamsTable.teamName) LIKE LOWER('".$team."')))SELECT json_agg(t) from t");
   while ($myrow = $st->fetch()) {
       echo json_encode($myrow);

   }
}
if(empty($first) AND !empty($last) AND !empty($team) and !($pos === 'Position')){
  $st = $dbh->query("WITH t as (SELECT * from playersTable WHERE LOWER (playersTable.lastName) LIKE LOWER('".$last."') AND primaryPosition ='".$pos."' AND playersTable.currentTeamID = (SELECT teamID FROM teamsTable WHERE LOWER (teamsTable.teamName) LIKE LOWER('".$team."')))SELECT json_agg(t) from t");
   while ($myrow = $st->fetch()) {
       echo json_encode($myrow);

   }
}
if(empty($first) AND !empty($last) AND empty($team) and !($pos === 'Position')){
  $st = $dbh->query("WITH t as (SELECT * from playersTable WHERE LOWER(playersTable.lastName) LIKE LOWER('".$last."') AND primaryPosition ='".$pos."')SELECT json_agg(t) from t");
   while ($myrow = $st->fetch()) {
       echo json_encode($myrow);

   }
}
if(empty($first) AND empty($last) AND !empty($team) and !($pos === 'Position')){
  $st = $dbh->query("WITH t as (SELECT * from playersTable WHERE playersTable.currentTeamID = (SELECT teamID FROM teamsTable WHERE LOWER(teamsTable.teamName) LIKE LOWER('".$team."')) AND primaryPosition ='".$pos."')SELECT json_agg(t) from t");
   while ($myrow = $st->fetch()) {
       echo json_encode($myrow);

   }
}
if(!empty($first) AND empty($last) AND !empty($team) and !($pos === 'Position')){
  $st = $dbh->query("WITH t as (SELECT * from playersTable WHERE LOWER(playersTable.firstName) LIKE LOWER('".$first."') AND primaryPosition ='".$pos."' AND playersTable.currentTeamID = (SELECT teamID FROM teamsTable WHERE LOWER(teamsTable.teamName) LIKE LOWER('".$team."')))SELECT json_agg(t) from t");
   while ($myrow = $st->fetch()) {
       echo json_encode($myrow);

   }
}
if(empty($first) AND empty($last) AND empty($team) and !($pos === 'Position')){
  $st = $dbh->query("WITH t as (SELECT * from playersTable WHERE primaryPosition ='".$pos."')SELECT json_agg(t) from t");
   while ($myrow = $st->fetch()) {
       echo json_encode($myrow);

   }
}







?>
