#!/bin/bash
dropdb nba
createdb nba
psql nba -f create.sql
php -f loadTeams.php
php -f loadPlayers.php
php -f loadTeamURL.php
php -f loadURL.php
echo "done"


