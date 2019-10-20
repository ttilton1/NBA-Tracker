<?php
// This is my php page that has my db info and connection
include("/etc/php/pdo-nba.php");
$dbh = dbconnect();

// Get cURL resource
$ch = curl_init();


// Set url
curl_setopt($ch, CURLOPT_URL, "https://api.mysportsfeeds.com/v2.0/pull/nba/players.json");

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
   echo '<pre>';
       $results = print_r($realdata, true);
       echo $results;
   echo '</pre>';


//In this Array loop through all the platers to pick up their urls.
   foreach ($realdata['players'] as &$value) {

      $imageURL = "";

      if (!is_null($value['player']["officialImageSrc"])){
        $imageURL = $value['player']["officialImageSrc"];
      }

       $sql = "UPDATE playersTable SET imageURL = '".$imageURL."' WHERE ".$value['player']['id']." = playerID";

       // echo '<pre>';
       //     $query = print_r($sql, true);
       //     echo $query;
       // echo '</pre>';
       $dbh->exec($sql);

   }
?>
