mypath=`realpath $0`
mybase=`dirname $mypath`
source $mybase/utils.bashrc

sudo apt-get -qq update
sudo apt-get -qq --yes install apache2 php libapache2-mod-php php-pgsql
sudo systemctl enable apache2
sudo systemctl restart apache2
sudo apt install php-pear php-fpm php-dev php-zip php-curl php-xmlrpc php-gd php-mysql php-mbstring php-xml libapache2-mod-php
if [ ! -e /etc/php/pdo-nba.php ]; then
    sudo tee /etc/php/pdo-nba.php << EOF
<?php
  function dbconnect() {
    $PDO_CONN = 'pgsql:host=localhost;dbname=nba';
    $PDO_USER = 'vagrant';
    $PDO_PASS = 'dbpasswd';
    $dbh = new PDO($PDO_CONN, $PDO_USER, $PDO_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
    return $dbh;
  }
?>

EOF
fi