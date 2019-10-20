CREATE TABLE teamsTable
(
teamID DECIMAL(10,0) NOT NULL PRIMARY KEY,
teamCity VARCHAR(256),
teamName VARCHAR(256),
teamAbbreviation VARCHAR(256),
ptsPerGame DECIMAL(8, 3),
ptsAgainstPerGame DECIMAL(8, 3),
wins DECIMAL(8,0),
losses DECIMAL(8,0),
plusMinusPerGame DECIMAL(8,3),
fgAttPerGame DECIMAL(8,3),
possessionsPerGame Decimal (8,3),
imageURL VARCHAR(256)
);

CREATE TABLE playersTable
(
playerID DECIMAL(10,0) NOT NULL,
firstName CHAR(256),
lastName CHAR(256),
primaryPosition CHAR(256),
currentTeamID DECIMAL(10,0) NOT NULL REFERENCES teamsTable(teamID),
currentTeamAbbrev VARCHAR(256),
injuryStatus CHAR(256),
gamesPlayed INTEGER,
fgAttPerGame DECIMAL(8,3),
fgPct DECIMAL(8, 3),
fg2PtAttPerGame DECIMAL(8,3),
fg2PtPct DECIMAL(8,3),
fg3PtAttPerGame DECIMAL (8,3),
fg3PtPct DECIMAL(8,3),
ftAttPerGame DECIMAL(8, 3),
ftPct DECIMAL(8, 3),
rebPerGame DECIMAL(8,3),
offRebPerGame DECIMAL(8,3),
defRebPerGame DECIMAL(8, 3),
astPerGame DECIMAL(8,3),
ptsPerGame DECIMAL(8,3),
tovPerGame DECIMAL(8,3),
stlPerGame DECIMAL(8,3),
blkPerGame DECIMAL(8,3),
plusMinusPerGame DECIMAL(8,3),
minutesPlayedPerGame DECIMAL(8,3),
trueShootingPct DECIMAL(8,3),
PER DECIMAL(8,3),
imageURL VARCHAR(256),
PRIMARY KEY(playerID)
);

-- CREATE TABLE Is_part_of
-- (
-- player_name VARCHAR(256) NOT NULL PRIMARY KEY,
--   	REFERENCES Player(player_name),
-- player_number VARCHAR(256) NOT NULL PRIMARY KEY,
--   	REFERENCES Player(player_number),
-- team_name VARCHAR(256) NOT NULL PRIMARY KEY
-- REFERENCES Team(team_name)
-- );
