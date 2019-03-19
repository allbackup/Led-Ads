<?php

//Led-Ads - PHP/MYSQL V1.0
//By: Jon Coulter - ledjon@ledscripts.com
//http://www.ledscripts.com
//This script is freeware. I accept no responsibility for damage it may cause (which should be none).
//This script can be freely modify, as long as this copyright is included.

//Include file - Only change if you renamed file/put in a different directory
require "ad_inc.php";

$action=$QUERY_STRING;
$pagename=$PHP_SELF;

/* make connection to database */
MYSQL_CONNECT($hostname, $username, $password) OR DIE("Unable to connect to database");
@mysql_select_db( "$dbName") or die( "Unable to select database");

head();
if($action == 'create_new'):
$create= "CREATE TABLE $table (id TINYINT not null AUTO_INCREMENT, zone VARCHAR (50) not null , image_url VARCHAR (200) not null , url VARCHAR (200) not null , displays_life VARCHAR (20) DEFAULT '0' not null , displays_day VARCHAR (20) DEFAULT '0' not null , clicks_life VARCHAR (20) DEFAULT '0' not null , clicks_day VARCHAR (20) DEFAULT '0' not null , dat_type VARCHAR (15) not null , html BLOB not null , PRIMARY KEY (id)) ";
$exec = MYSQL_QUERY($create);
 if($exec == 1):
 print "Table should have been created and everything should be ready to roll!";
 else:
 print "Something went wrong! Maybe the table already exists. Maybe the Username/Password is wrong. Try again";
 endif;
 
elseif($action == 'upgrade'):
$create= "ALTER TABLE $table ADD dat_type VARCHAR (15) not null , ADD html BLOB not null";
$exec = MYSQL_QUERY($create);
 if($exec == 1):
 print "Table should have been created and everything should be ready to roll!";
 else:
 print "Something went wrong! Try again";
 endif;
else:
print "<center>";
print "Choose one of the options below:<br><br>";
print "<a href=\"$pagename?upgrade\">Upgrade From .7.*</a><br>";
print "<a href=\"$pagename?create_new\">First Install</a><br><br>";
print "</center>";
endif;
foot();
MYSQL_CLOSE();
?>