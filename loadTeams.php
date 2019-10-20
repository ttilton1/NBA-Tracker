<?php
// This is my php page that has my db info and connection
include("/etc/php/pdo-nba.php");
$dbh = dbconnect();

// Get cURL resource
$ch = curl_init();


// Set url
curl_setopt($ch, CURLOPT_URL, "https://api.mysportsfeeds.com/v2.0/pull/nba/2018-2019-regular/team_stats_totals.json");

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
   foreach ($realdata['teamStatsTotals'] as &$value) {

      $fgAttPerGame = $value['stats']['fieldGoals']['fgAttPerGame'];
      $tovPerGame = $value['stats']['defense']['tovPerGame'];
      $ftTrips = $value['stats']['freeThrows']['ftAttPerGame'] / 2;
      $possessionsPerGame = $fgAttPerGame + $tovPerGame + $ftTrips;
      $imageURL = "";



       $sql = "INSERT INTO teamsTable (teamID, teamCity, teamName, teamAbbreviation, ptsPerGame, ptsAgainstPerGame,
       wins, losses, plusMinusPerGame, fgAttPerGame, possessionsPerGame, imageURL)
       VALUES (
         ".$value['team']['id'].",
         '".$value['team']['city']."',
         '".$value['team']['name']."',
         '".$value['team']['abbreviation']."',
         ".$value['stats']['offense']['ptsPerGame'].",
         ".$value['stats']['defense']['ptsAgainstPerGame'].",
         ".$value['stats']['standings']['wins'].",
         ".$value['stats']['standings']['losses'].",
         ".$value['stats']['miscellaneous']['plusMinusPerGame'].",
         ".$value['stats']['fieldGoals']['fgAttPerGame'].",
         ".$possessionsPerGame.",
         '".$imageURL."'
       )
       ON CONFLICT (teamID) DO UPDATE SET
       ptsPerGame =  ".$value['stats']['offense']['ptsPerGame'].",
       ptsAgainstPerGame = ".$value['stats']['defense']['ptsAgainstPerGame'].",
       wins = ".$value['stats']['standings']['wins'].",
       losses = ".$value['stats']['standings']['losses'].",
       plusMinusPerGame= ".$value['stats']['miscellaneous']['plusMinusPerGame'].",
       fgAttPerGame= ".$value['stats']['fieldGoals']['fgAttPerGame'].",
       imageURL = '".$imageURL."'
       ";

       // echo '<pre>';
       //     $query = print_r($sql, true);
       //     echo $query;
       // echo '</pre>';
       $dbh->exec($sql);

   }
?>
