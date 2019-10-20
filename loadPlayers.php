<?php
// This is my php page that has my db info and connection
include("/etc/php/pdo-nba.php");
$dbh = dbconnect();
// Get cURL resource
$ch = curl_init();
// Set url
curl_setopt($ch, CURLOPT_URL, "https://api.mysportsfeeds.com/v2.0/pull/nba/2018-2019-regular/player_stats_totals.json");
// Set method
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
// Set options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// Set compression
curl_setopt($ch, CURLOPT_ENCODING, "gzip");
//Trying
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
   "Authorization: Basic " . base64_encode("188046c3-71dd-4568-ba90-338174" . ":" . "MYSPORTSFEEDS")
]);
// Send the request & save response to $resp
$resp = curl_exec($ch);
if (!$resp) {
   die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
} else {
   //echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
//    echo "\nResponse HTTP Body : " . $resp;
}
//this takes the json data and creates a php array
$realdata = json_decode($resp, true);
//This just prints the array so you can see what the data you are pulling gets returned
   // echo '<pre>';
   //     $results = print_r($realdata, true);
   //     echo $results;
   // echo '</pre>';
//In this Array loop through all the teams to pick up their stats. teamStatsTotals is array of teams with a separate stats array.
foreach ($realdata['playerStatsTotals'] as &$value) {
      $injuryStatus = "HEALTHY";
      $imageURL = "";
      if (!is_null($value['player']['currentInjury'])){
        $injuryStatus = $value['player']['currentInjury']['playingProbability'];
      }
      $trueShootingAtt = $value['stats']['fieldGoals']['fgAttPerGame'] + 0.44*$value['stats']['freeThrows']['ftAttPerGame'];
      $points = $value['stats']['offense']['ptsPerGame'];
      if ($trueShootingAtt !=0){
        $trueShootingPct = $points / (2*$trueShootingAtt );
      }
      $minutesPlayedPerGame = $value['stats']['miscellaneous']['minSecondsPerGame'] / 60;
      $mins = $value['stats']['miscellaneous']['minSeconds'] / 60;
      $fgMade = $value['stats']['fieldGoals']['fgMade'];
      $stls = $value['stats']['defense']['stl'];
      $fg3Made = $value['stats']['fieldGoals']['fg3PtMade'];
      $ftMade = $value['stats']['freeThrows']['ftMade'];
      $blks = $value['stats']['defense']['blk'];
      $offRebs = $value['stats']['rebounds']['offReb'];
      $asts = $value['stats']['offense']['ast'];
      $defRebs = $value['stats']['rebounds']['defReb'];
      $fouls = $value['stats']['miscellaneous']['fouls'];
      $ftAtts = $value['stats']['freeThrows']['ftAtt'];
      $ftMade = $value['stats']['freeThrows']['ftMade'];
      $ftMissed = $ftAtts - $ftMade;
      $fgAtts = $value['stats']['fieldGoals']['fgAtt'];
      $fgMade = $value['stats']['fieldGoals']['fgMade'];
      $fgMissed = $fgAtts - $fgMade;
      $tov = $value['stats']['defense']['tov'];
      $firstName = str_replace("'","",$value['player']['firstName']);
      $lastName = str_replace("'","",$value['player']['lastName']);
      if ($mins != 0){
        $PER = ($fgMade * 85.910 + $stls*53.897 + $fg3Made*51.757 + $ftMade*46.845 + $blks*39.190 + $offRebs*39.190 + $asts*34.677 + $defRebs*14.707 + $fouls*17.174 + $ftMissed*20.091 + $fgMissed
        * 39.190 + $tov*53.897) / $mins;
      }
       $sql = "INSERT INTO playersTable (playerID, firstName, lastName, primaryPosition, currentTeamID, currentTeamAbbrev,injuryStatus,
               gamesPlayed, fgAttPerGame, fgPct, fg2PtAttPerGame, fg2PtPct, fg3PtAttPerGame, fg3PtPct, ftAttPerGame, ftPct, rebPerGame, offRebPerGame, defRebPerGame,
               astPerGame, ptsPerGame, tovPerGame, stlPerGame, blkPerGame, plusMinusPerGame, minutesPlayedPerGame,trueShootingPct, PER, imageURL)
       VALUES (
        ".$value['player']['id'].",
        '".$firstName."',
        '".$lastName."',
        '".$value['player']['primaryPosition']."',
        ".$value['player']['currentTeam']['id'].",
        '".$value['player']['currentTeam']['abbreviation']."',
        '".$injuryStatus."',
        ".$value['stats']['gamesPlayed'].",
        ".$value['stats']['fieldGoals']['fgAttPerGame'].",
        ".$value['stats']['fieldGoals']['fgPct'].",
        ".$value['stats']['fieldGoals']['fg2PtAttPerGame'].",
        ".$value['stats']['fieldGoals']['fg2PtPct'].",
        ".$value['stats']['fieldGoals']['fg3PtAttPerGame'].",
        ".$value['stats']['fieldGoals']['fg3PtPct'].",
        ".$value['stats']['freeThrows']['ftAttPerGame'].",
        ".$value['stats']['freeThrows']['ftPct'].",
        ".$value['stats']['rebounds']['rebPerGame'].",
        ".$value['stats']['rebounds']['offRebPerGame'].",
        ".$value['stats']['rebounds']['defRebPerGame'].",
        ".$value['stats']['offense']['astPerGame'].",
        ".$value['stats']['offense']['ptsPerGame'].",
        ".$value['stats']['defense']['tovPerGame'].",
        ".$value['stats']['defense']['stlPerGame'].",
        ".$value['stats']['defense']['blkPerGame'].",
        ".$value['stats']['miscellaneous']['plusMinusPerGame'].",
        ".$minutesPlayedPerGame.",
        ".$trueShootingPct.",
        ".$PER.",
        '".$imageURL."'
        )
        ON CONFLICT (playerID) DO UPDATE SET
        currentTeamID = ".$value['player']['currentTeam']['id'].",
        currentTeamAbbrev = '".$value['player']['currentTeam']['abbreviation']."',
        injuryStatus = '".$injuryStatus."',
        gamesPlayed= ".$value['stats']['gamesPlayed'].",
        fgAttPerGame = ".$value['stats']['fieldGoals']['fgAttPerGame'].",
        fgPct = ".$value['stats']['fieldGoals']['fgPct'].",
        fg2PtAttPerGame = ".$value['stats']['fieldGoals']['fg2PtAttPerGame'].",
        fg2PtPct = ".$value['stats']['fieldGoals']['fg2PtPct'].",
        fg3PtAttPerGame =".$value['stats']['fieldGoals']['fg3PtAttPerGame'].",
        fg3PtPct = ".$value['stats']['fieldGoals']['fg3PtPct'].",
        ftAttPerGame = ".$value['stats']['freeThrows']['ftAttPerGame'].",
        ftPct = ".$value['stats']['freeThrows']['ftPct'].",
        rebPerGame = ".$value['stats']['rebounds']['rebPerGame'].",
        offRebPerGame = ".$value['stats']['rebounds']['offRebPerGame'].",
        defRebPerGame = ".$value['stats']['rebounds']['defRebPerGame'].",
        astPerGame = ".$value['stats']['offense']['astPerGame'].",
        ptsPerGame = ".$value['stats']['offense']['ptsPerGame'].",
        tovPerGame = ".$value['stats']['defense']['tovPerGame'].",
        stlPerGame = ".$value['stats']['defense']['stlPerGame'].",
        blkPerGame = ".$value['stats']['defense']['blkPerGame'].",
        plusMinusPerGame = ".$value['stats']['miscellaneous']['plusMinusPerGame'].",
        minutesPlayedPerGame = ".$minutesPlayedPerGame.",
        trueShootingPct = ".$trueShootingPct.",
        PER = ".$PER.",
	      imageURL = '".$imageURL."'
        ";

        // echo '<pre>';
        //     $query = print_r($sql, true);
        //     echo $query;
        // echo '</pre>';
       $dbh->exec($sql);
     }
?>
