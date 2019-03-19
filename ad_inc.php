<?php

//Led-Ads - PHP/MYSQL V1.0

 //Host Name. Usually "localhost".
$hostname = "localhost";

 //Location of ad_click.php relative to the web root.
$redirect = "/php-bin/ads/ad_click.php";

 //Database Name
$dbName = "ledbanners_adstats";

 //mySQL Database User Name
$username = "root"; #SQL User Name (Don't worry, this wont showup on the page)

 //mySQL Database Password
$password = ""; #SQL User Passworld (Don't worry, this wont showup on the page)

 //mySQL table name
$table = "ledbanners_adstats"; #Table Name data is to be entered into.

 //Admin Password for the interface
$admin_pass = "admin";
 
 //No need to edit below this line!
 ##################################
 //Header and footer
 
 function head() {
 print "
 <html>
 
 <head>
 <meta http-equiv=\"Content-Language\" content=\"en-us\">
 <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1252\">
 <title>Led-Ads Admin</title>
 <style>
 <!--
 textarea     { font-family: Tahoma; font-size: 8pt; padding: 3 }
 input        { font-family: Tahoma; font-size: 8pt;  }
 select        { font-family: Tahoma; font-size: 8pt; }
 a {text-decoration: none}
 A:hover {color: #00FFFF; text-decoration: underline}
 -->
 </style>
 </head>
 
 <body bgcolor=\"#000000\" text=\"#FFFFFF\" link=\"#00CCFF\" vlink=\"#00CCFF\" alink=\"#00FFFF\" style=\"font-family: Verdana;\">
<font face=\"Arial\" size=\"2\">
<center><b>Led-Ads Admin v1.0 (PHP/MYSQL version)</b></center>";
 }
 
 function foot() {
 print "\n<center><br>Copyright <a href=\"mailto:ledjon@ledscripts.com\">Jon Coulter</a><br>\n";
 print "<a href=\"http://www.ledscripts.com\" target=\"_top\">Ledscripts.com</a></font></center>\n</body>\n</html>";
 }
 
 //Bad Password
 function bad_pass() {
 head();
 print "Bad Password";
 foot();
 exit();
 }
 
?>