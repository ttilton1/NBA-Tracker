<?php
// This is my php page that has my db info and connection
include("/etc/php/pdo-nba.php");
$dbh = dbconnect();

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/atl.png' WHERE 91 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/bos.png' WHERE 82 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/bkn.png' WHERE 84 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/cha.png' WHERE 93 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/chi.png' WHERE 89 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/cle.png' WHERE 86 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);


$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/dal.png' WHERE 108 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/den.png' WHERE 99 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/det.png' WHERE 88 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/gsw.png' WHERE 101 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/hou.png' WHERE 109 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/ind.png' WHERE 87 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/lac.png' WHERE 102 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/lal.png' WHERE 105 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/lal.png' WHERE 105 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/mem.png' WHERE 107 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/mia.png' WHERE 92 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/mil.png' WHERE 90 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/min.png' WHERE 100 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/nor.png' WHERE 110 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/nyk.png' WHERE 83 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/okc.png' WHERE 96 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/orl.png' WHERE 95 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/phi.png' WHERE 85 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/pho.png' WHERE 104 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/por.png' WHERE 97 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/sac.png' WHERE 103 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/sas.png' WHERE 106 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/tor.png' WHERE 81 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/uth.png' WHERE 98 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);

$sql = "UPDATE teamsTable SET imageURL = 'https://a.espncdn.com/i/teamlogos/nba/500/was.png' WHERE 94 = teamID";
echo '<pre>';
    $query = print_r($sql, true);
    echo $query;
echo '</pre>';
$dbh->exec($sql);


?>
