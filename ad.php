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

/* Don't modify below this line! */
/* make connection to database */
MYSQL_CONNECT($hostname, $username, $password) OR DIE("Unable to connect to database");
@mysql_select_db( "$dbName") or die( "Unable to select database");

//Get number of ads in the database
$query = "SELECT * FROM $table";
$result = MYSQL_QUERY($query);
$number = MYSQL_NUMROWS($result);

//Get a random number based on the info
  //Fix the sql Number to start with 0
  if($number == 0):
  print "No Images to display";
  exit();
  elseif($number == 1):
  $randomnumber = 0;
  else:
  --$number;
  srand((double)microtime()*1000000); 
  $randomnumber = rand(0,$number);
  endif;

//Get the details for that entry
$id		= mysql_result($result,$randomnumber,"id");
$image_url	= mysql_result($result,$randomnumber,"image_url");
$url		= mysql_result($result,$randomnumber,"url");
$zone		= mysql_result($result,$randomnumber,"zone");
$displays_life	= mysql_result($result,$randomnumber,"displays_life");
$displays_day	= mysql_result($result,$randomnumber,"displays_day");
$dat_type	= mysql_result($result,$randomnumber,"dat_type");
$html		= mysql_result($result,$randomnumber,"html");
 
 //Generate the HTML
 print "<!-- Ad Code Generated by Led-Ads (PHP/MYSQL version .7) http://www.ledscripts.com -->";
 
if($dat_type == 'image'):
 print "<a href=\"$redirect?$id\"><img src=\"$image_url\" border=\"0\"></a>";
elseif($dat_type == 'html'):
 print "$html";
else:
 print "<a href=\"$redirect?$id\"><img src=\"$image_url\" border=\"0\"></a>";
endif;
 print "<!-- End Ad Code -->";
 
 //Record the hit. 
++$displays_life;
++$displays_day;

 //Update the DB with the hit
$update_query = "UPDATE $table SET displays_life = '$displays_life' WHERE id = '$id'";
$update_result = MYSQL_QUERY($update_query);
$update_query = "UPDATE $table SET displays_day = '$displays_day' WHERE id = '$id'";
$update_result = MYSQL_QUERY($update_query);

MYSQL_CLOSE();
?>