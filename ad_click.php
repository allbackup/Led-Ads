<?php

//Led-Ads - PHP/MYSQL V1.0
//By: Jon Coulter - ledjon@ledscripts.com
//http://www.ledscripts.com
//This script is freeware. I accept no responsibility for damage it may cause (which should be none).
//This script can be freely modify, as long as this copyright is included.

//Include file - Only change if you renamed file/put in a different directory
require "ad_inc.php";

  /*Declair Variables*/
$pagename = "$PHP_SELF"; #This Page's Name - Don't modify.
$req_id = $QUERY_STRING;

/* Don't modify below this line! */
/* make connection to database */
MYSQL_CONNECT($hostname, $username, $password) OR DIE("Unable to connect to database");
@mysql_select_db( "$dbName") or die( "Unable to select database");

//Get number of ads in the database
$query = "SELECT * FROM $table WHERE id = '$req_id'";
$result = MYSQL_QUERY($query);
$number = MYSQL_NUMROWS($result);

 if($number > 1):
 print "Something's messed up!... Muliple id's!";
 endif;

$url		= mysql_result($result,$randomnumber,"url");
$clicks_life	= mysql_result($result,$randomnumber,"clicks_life");
$clicks_day	= mysql_result($result,$randomnumber,"clicks_day");

header("Location: $url");

 //Record the click. 
++$clicks_life;
++$clicks_day;

 //Update the DB with the hit
$update_query = "UPDATE $table SET clicks_life = '$clicks_life' WHERE id = '$req_id'";
$update_result = MYSQL_QUERY($update_query);
$update_query = "UPDATE $table SET clicks_day = '$clicks_day' WHERE id = '$req_id'";
$update_result = MYSQL_QUERY($update_query);

MYSQL_CLOSE();
?>