<?php

//Led-Ads - PHP/MYSQL V1.0
//By: Jon Coulter - ledjon@ledscripts.com
//http://www.ledscripts.com
//This script is freeware. I accept no responsibility for damage it may cause (which should be none).
//This script can be freely modify, as long as this copyright is included.

//Include file - Only change if you renamed file/put in a different directory
require "ad_inc.php";

//NO NEED TO EDIT BELOW THIS LINE//

  /*Declair Variables*/
$pagename = $PHP_SELF; #This Page's Name - Don't modify.
$qstring=split("&", $QUERY_STRING);
$action=$qstring[0];
$ad_id=$qstring[1];

/* Don't modify below this line! */
/* make connection to database */
MYSQL_CONNECT($hostname, $username, $password) OR DIE("Unable to connect to database");
@mysql_select_db("$dbName") or die("Unable to select database");

if($action == add):

head();
?>

	<b>Add an Image-Based Ad (Standard)</b>
	<form action="<? echo $pagename ?>?do_add" method=POST>
	Image Location:<br><input type="text" name="image" size="60"><br>
	Link:<br><input type="text" name="link" size="60"><br>
	Zone (Optional):<br><input type="text" name="zone"><br>
	Password:<br><input type="password" name="admin_password"><br>
	<input type="hidden" name="dat_type" value="image">
	<input type="submit" value="Add Banner">
	</form>
	<br>
	OR<br><br>
	<b>Input HTML for an Ad</b><br>
	<form action="<? echo $pagename ?>?do_add" method=POST>
	<textarea name="html_input" rows="10" cols="80"></textarea><br>
	Zone (Optional):<br><input type="text" name="zone"><br>
	Password:<br><input type="password" name="admin_password"><br>
	<input type="hidden" name="dat_type" value="html">
	<input type="submit" value="Add Banner">
	</form>

<?php
foot();

elseif($action == do_add):
 //Check the Password
  if($admin_password != $admin_pass):
  bad_pass();
  endif;

  head();  
  
  if($dat_type == 'image'):
     $query = "INSERT INTO $table (zone,url,image_url,dat_type) VALUES ('$zone', '$link', '$image', '$dat_type')";
     $result = MYSQL_QUERY($query);
  print "Added";
  elseif($dat_type == 'html'):
     $query = "INSERT INTO $table (zone, url, html, dat_type) VALUES ('$zone', 'NULL', '$html_input', '$dat_type')";
     $result = MYSQL_QUERY($query);
  print "Added";
  else:
  print "Bad Data Type";
  endif;
  foot();

elseif($action == modify):
head();

//Get number of ads in the database
$query = "SELECT * FROM $table";
$result = MYSQL_QUERY($query);
$number = MYSQL_NUMROWS($result);
$i=0;

print "<center>(Click on the ad to be modified)<br>";

WHILE ($i < $number):

    //Get the details for that entry
    $id		= mysql_result($result,$i,"id");
    $image_url	= mysql_result($result,$i,"image_url");
    $url	= mysql_result($result,$i,"url");
    $dat_type	= mysql_result($result,$i,"dat_type");
    $html	= mysql_result($result,$i,"html");
    
    if($dat_type == 'image'):    
    print "<img src=\"$image_url\" border=\"0\">\n<br><a href=\"$pagename?mod_id&$id\">Modify</a><br>";
    elseif($dat_type == 'html'):
    print "$html<br><a href=\"$pagename?mod_id&$id\">Modify</a><br>";
    else:
    print "<img src=\"$image_url\" border=\"0\">\n<br><a href=\"$pagename?mod_id&$id\">Modify</a><br>";
    endif;
    
    $i++;
ENDWHILE;
print "</center>";
foot();

elseif($action == mod_id):
$query = "SELECT * FROM $table WHERE id = '$ad_id'";
$result = MYSQL_QUERY($query);
    
    //Get the details for that entry
    $id		= mysql_result($result,0,"id");
    $zone	= mysql_result($result,0,"zone");
    $image_url	= mysql_result($result,0,"image_url");
    $url	= mysql_result($result,0,"url");
    $dat_type	= mysql_result($result,0,"dat_type");
    $html	= mysql_result($result,0,"html");
    
head();
    if($dat_type == 'image'):
?>
<b>Modify</b>
<form action="<? echo $pagename ?>?do_modify" method=POST>
Image Location:<br><input type="text" name="image" size="60" value="<? echo $image_url ?>"><br>
Link:<br><input type="text" name="link" size="60" value="<? echo $url ?>"><br>
Zone (Optional):<br><input type="text" name="zone" value="<? echo $zone ?>"><br>
Password:<br><input type="password" name="admin_password"><br>
<input type="hidden" name="dat_type" value="image">
<input type="hidden" name="mod_id" value="<? echo $id ?>">
<input type="submit" value="Modify Banner">
</form>
<?php
    elseif($dat_type == 'html'):
?>
	<form action="<? echo $pagename ?>?do_add" method=POST>
	<textarea name="html_input" rows="10" cols="80"><? echo $html ?></textarea><br>
	Zone (Optional):<br><input type="text" name="zone" value="<? echo $zone ?>"><br>
	Password:<br><input type="password" name="admin_password"><br>
	<input type="hidden" name="mod_id" value="<? echo $id ?>">
	<input type="hidden" name="dat_type" value="html">
	<input type="submit" value="Add Banner">
	</form>
<?php
    else:
?>
<form action="<? echo $pagename ?>?do_modify" method=POST>
Image Location:<br><input type="text" name="image" size="60" value="<? echo $image_url ?>"><br>
Link:<br><input type="text" name="link" size="60" value="<? echo $url ?>"><br>
Zone (Optional):<br><input type="text" name="zone" value="<? echo $zone ?>"><br>
Password:<br><input type="password" name="admin_password"><br>
<input type="hidden" name="dat_type" value="image">
<input type="hidden" name="mod_id" value="<? echo $id ?>">
<input type="submit" value="Modify Banner">
</form>

<?php
endif;
foot();

elseif($action == do_modify):
 //Check the Password
  if($admin_password != $admin_pass):
  bad_pass();
  endif;
  
  if($dat_type == 'image'):
   $update_query = "UPDATE $table SET zone = '$zone' WHERE id = '$mod_id'";
   $update_result = MYSQL_QUERY($update_query);
   $update_query = "UPDATE $table SET image_url = '$image' WHERE id = '$mod_id'";
   $update_result = MYSQL_QUERY($update_query);
   $update_query = "UPDATE $table SET url = '$link' WHERE id = '$mod_id'";
   $update_result = MYSQL_QUERY($update_query);
   
  elseif($dat_type == 'html'):
   $update_query = "UPDATE $table SET zone = '$zone' WHERE id = '$mod_id'";
   $update_result = MYSQL_QUERY($update_query);
   $update_query = "UPDATE $table SET html = '$html' WHERE id = '$mod_id'";
   $update_result = MYSQL_QUERY($update_query);
   
  else:
   $update_query = "UPDATE $table SET zone = '$zone' WHERE id = '$mod_id'";
   $update_result = MYSQL_QUERY($update_query);
   $update_query = "UPDATE $table SET image_url = '$image' WHERE id = '$mod_id'";
   $update_result = MYSQL_QUERY($update_query);
   $update_query = "UPDATE $table SET url = '$link' WHERE id = '$mod_id'";
   $update_result = MYSQL_QUERY($update_query);
  endif;

   head();
   print "Updated";
   foot();

elseif($action == delete):
head();

//Get number of ads in the database
$query = "SELECT * FROM $table";
$result = MYSQL_QUERY($query);
$number = MYSQL_NUMROWS($result);
$i=0;

print "<center>(Check Ads to be deleted)<br>";
print "<form action=\"$pagename?do_del\" method=POST>";

WHILE ($i < $number):

    //Get the details for that entry
    $id		= mysql_result($result,$i,"id");
    $image_url	= mysql_result($result,$i,"image_url");
    $url	= mysql_result($result,$i,"url");
    $dat_type	= mysql_result($result,$i,"dat_type");
    $html	= mysql_result($result,$i,"html");
    
  if($dat_type == 'image'):
    print "<img src=\"$image_url\" border=\"0\"><br>\n<input type=\"checkbox\" name=\"del_id[]\" value=\"$id\"><br>\n";
  elseif($dat_type == 'html'):
    print "$html<br>\n<input type=\"checkbox\" name=\"del_id[]\" value=\"$id\"><br>\n";
  else:
    print "<img src=\"$image_url\" border=\"0\"><br>\n<input type=\"checkbox\" name=\"del_id[]\" value=\"$id\"><br>\n";
  endif;
  
    $i++;
ENDWHILE;
print "<hr width=\"100\">Password:<br><input type=\"password\" name=\"admin_password\"><br>";
print "<input type=\"submit\" value=\"Delete Selected Ad\">\n";
print "</form>\n";
print "</center>\n";

foot();

elseif($action == do_del):
 //Check the Password
  if($admin_password != $admin_pass):
  bad_pass();
  endif;
  
//Remove the ad
 head();
 for($i=0; $i < count($del_id); $i++)
 {
  $query = "DELETE FROM $table WHERE id = '$del_id[$i]'";
  $exec = MYSQL_QUERY($query);
 
  if($exec == 1):
   print "Deleted Ad with id number: $del_id[$i]<br>\n";
  else:
   print "Error: $del_id[$i] didn't delete properly<br>\n";
  endif;
 }
  
  print "\n<br>Delete Complete";
  foot();

elseif($action == stats):
head();
$font="<font face=\"Arial\" size=\"2\">";
?>
	<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=0 WIDTH="95%">
	<TR ALIGN="left" VALIGN="top">
		<TH><? echo $font ?> Site (Zone)</TH>
	    	<TH><? echo $font ?> Displays - Lifetime</TH>
	    	<TH><? echo $font ?> Displays - Today</TH>
	    	<TH><? echo $font ?> Clicks - Lifetime</TH>
	    	<TH><? echo $font ?> Clicks - Today</TH>
	</tr>
<?

$query = "SELECT * FROM $table";
$result = MYSQL_QUERY($query);
$number = MYSQL_NUMROWS($result);
$i=0;

WHILE ($i < $number):

//Get the details for that entry
$id		= mysql_result($result,$i,"id");
$image_url	= mysql_result($result,$i,"image_url");
$url		= mysql_result($result,$i,"url");
$zone		= mysql_result($result,$i,"zone");
$displays_life	= mysql_result($result,$i,"displays_life");
$displays_day	= mysql_result($result,$i,"displays_day");
$clicks_life	= mysql_result($result,$i,"clicks_life");
$clicks_day	= mysql_result($result,$i,"clicks_day");
    
	  print "
	  <TR ALIGN=\"left\" VALIGN=\"top\">
	    	<TD>$font <a href=\"$url\" target=\"_blank\">$url</a> ($zone)</TD>
	    	<TD>$font $displays_life</TD>
	    	<TD>$font $displays_day</TD>
	    	<TD>$font $clicks_life</TD>
	    	<TD>$font $clicks_day</TD>
	  </tr>";
	  
	    $tdisplays_life=$tdisplays_life+$displays_life;
	    $tdisplays_day=$tdisplays_day+$displays_day;
	    $tclicks_life=$tclicks_life+$clicks_life;
	    $tclicks_day=$tclicks_day+$clicks_day;
    $i++;
ENDWHILE;
	  print "
	  <TR ALIGN=\"left\" VALIGN=\"top\">
	    	<TD bgcolor=\"#000080\">$font Totals:</TD>
	    	<TD bgcolor=\"#000080\">$font $tdisplays_life</TD>
	    	<TD bgcolor=\"#000080\">$font $tdisplays_day</TD>
	    	<TD bgcolor=\"#000080\">$font $tclicks_life</TD>
	    	<TD bgcolor=\"#000080\">$font $tclicks_day</TD>
	    </tr>";
	 print "</TABLE>";
	 
	 foot();

elseif($action == clear_day):
head();
?>

<form action="<? echo $pagename ?>?do_clear_day" method=POST>
Password:<br><input type="password" name="admin_password"><br>
<input type="submit" value="Clear Stats">
</form>

<?php
foot();

elseif($action == do_clear_day):
 //Check the Password
  if($admin_password != $admin_pass):
  bad_pass();
  endif;
//Get number of ads in the database
$query = "SELECT * FROM $table";
$result = MYSQL_QUERY($query);
$number = MYSQL_NUMROWS($result);
$i=0;

WHILE ($i < $number):
    //Get the details for that entry
$id = mysql_result($result,$i,"id");
$update_query="UPDATE $table SET clicks_day = '0' WHERE id = '$id'";
$update_result=MYSQL_QUERY($update_query);
$update_query="UPDATE $table SET displays_day = '0' WHERE id = '$id'";
$update_result=MYSQL_QUERY($update_query);
    $i++;
ENDWHILE;

head();
print "All \"Today\" Columns have been set to zero.";
foot();

elseif($action == lframe):
?>
  <html>
  <head>
  <title>Left Frame</title>
  </head>
  <body bgcolor="#000066" text="#FFFFFF" link="#00CCFF" vlink="#00CCFF" alink="#00FFFF">
  <font face="Verdana,Arial" size="1">
<b>Main Menu</b><br>
<a href="<? echo $pagename ?>?add" target="mainFrame">Add an Ad</a><br>
<a href="<? echo $pagename ?>?modify" target="mainFrame">Modify an Ad</a><br>
<a href="<? echo $pagename ?>?delete" target="mainFrame">Delete Ads</a><br><br>
<a href="<? echo $pagename ?>?stats" target="mainFrame">View Stats</a><br><br>
<a href="<? echo $pagename ?>?clear_day" target="mainFrame">Clear "Today" Columns</a><br>
   </font>
  </body>
  </html>
<?php

elseif($action == rframe):
head();
?>
Welcome to Led-Ads by <a href="mailto:ledjon@ledjon.com">Jon Coulter</a><br>
<br>
Please choose and action from the left menu.
<?php
foot();

else:
?>
  <html>
  <head>
  <title>Led-Ads Admin by Jon Coulter</title>
  </head>
  <frameset cols="150,*" frameborder="no" border="0" framespacing="0"> 
    <frame name="leftFrame" scrolling="auto" noresize src="<? echo $pagename ?>?lframe">
    <frame name="mainFrame" src="<? echo $pagename ?>?rframe">
  </frameset>
  <noframes>
  <body>
  This Page Requires Frames, but your browser doesn't support them.
  </body>
  </noframe>
  </html>
<?php
endif;

MYSQL_CLOSE();
?>