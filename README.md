# cs316

## Project setup
```
npm install
```

### Compiles and hot-reloads for development
```
npm run serve
```

### Compiles and minifies for production
```
npm run build
```

### Run your tests
```
npm run test
```

### Lints and fixes files
```
npm run lint
```

### Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).

## Database Set Up
This is the README to understand how to set up our database on your virtual machine

You can find our Project Description in the NBA_Database_App-1.pdf in n the folder.

We assume you have the virtual machine setup for the course using vagrant and virtualBox.
If not follow commands from the CS316 site: https://sites.duke.edu/compsci316_01_f2018/help/vbvagrant/

Please ensure all of the submitted files are in a "nba-admin" folder within your
"Shared" folder with the VagrantFile.

Next

1. Access VM shell
2. Refresh VM: /opt/dbcourse/sync.sh
3. Run the following commands in your VM to download php apache server used for php-beers:

/opt/dbcourse/install/install-apache-php.sh

Unfortunately, this still does not give you the php module Curl which we use in our php code to make API calls. So do the following step: 

sudo apt install php-pear php-fpm php-dev php-zip php-curl php-xmlrpc php-gd php-mysql php-mbstring php-xml libapache2-mod-php


Double check that you have the php curl module by typing in 

php -m 

And look for "curl". Once you have established that you have the package, continue. 
Next step into your nba-admin folder "cd shared/nba-admin/"

4. Move the pdo-nba.php file to /etc/php/ with the following command:

sudo mv ~/shared/nba-admin/pdo-nba.php /etc/php/ 

*************************************************************
Okay, now you have php installed along with the necessary files to allow php and PostgreSQL to work together.

To access our database, you need to have the following files that we submitted:
- create.sql 
- loadTeams.php
- loadTeamURL.php
- loadPlayers.php
- loadURL.php 

Now follow these steps to get into our postreSQL database called "nba" - but first make sure you are in the same directory as all the files above in your php-nba 

1. dropdb nba //drops database in your local if it was already created, if not previously created, you will get an error - just ignore and move to step 2 
2. createdb nba  //creates fresh postgreSQL database 
3. psql nba -f create.sql //creates playersTable and teamsTable with all attributes for each table 
4. php -f loadTeams.php  //inserts all NBA teams and associated data gathered from api call into the database table teamsTable using a php script that parses the returned JSON object from the API 
5. php -f loadTeamURL.php //manually updates teams in teamsTable to include logo image URLs that we will then use in our web app display 
6. php -f loadPlayers.php  //inserts all NBA players and associated data gathered from api call into the database table playersTable using a php script that parses the returned JSON object from the API 
7. php -f loadURL.php //updates all nba player rows in our database with their image URLs obtained from a different API call and again parses the JSON object returned by the API call using a php script 
8. psql nba //just a command that gets you into the database on your VM where you can run your queries!!

*********
Now that you have all tools and controls for the php set up and have also created the database, you can deploy and access the web-app

Assuming your files in the shared directory are in /shared/php-nba
Enter into your vm: 

sudo ln -s ~/shared/nba-admin/ /var/www/html

You should then be able to access the PHP app in your browser at: 

http://localhost:8080/nba-admin/
