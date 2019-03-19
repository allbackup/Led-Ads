//Led-Ads - PHP/MYSQL V1.0
//By: Jon Coulter - ledjon@ledscripts.com
//http://www.ledscripts.com
//This script is freeware. I accept no responsibility for damage it may cause (which should be none).
//This script can be freely modify, as long as this copyright is included.
//Copyright 2000 Jon Coulter - ledjon@ledscripts.com
//Bugs: bugs@ledscripts.com
//Support: support@ledscripts.com

Version Histroy:
.7 - Initial Release
.7.1 - Fix random bumber error (my bad).
1.0 - Full release... Added ablility to input HTML for the displayed banners. More secure too!

*Upgrade Info (bottom),

Installation:

Open ad_inc.php and change the appropriate variables.

Upload all the files into a directory and run ad_install.php. Click "First Install". If you get a successful message, delete ad_install.php from the server.

That's it! Baring any error... it sould be working.

New to this version! I received several E-mail from people that wanted to be able to add flash ect. to their ads. Well now you can.
 When inserting a new add, you can choose to input all the html (or whatever you want) manually.. allowing for flash ect. to be inserted!
 
 NOTE: Clicks are NOT counted on these ads (displays still are). I also suggest naming the zone as something to remember the ad by, because it will now show up as NULL in the Stats report.

To include it in an .html .htm .shtml .asp page, use this:
<!--#include virtual="/php-bin/ads/ad.php"-->
Change the path to ad.php depending on where you put the ad.

To include the ad in another PHP page use this:
<? include "/php-bin/ads/ad.php" ?>

Upgrade:
To upgrade from version .7 or .7.1, just upload ad.php, ad_admin.php, ad_install.php and run ad_install.php. Choose the option that allows you to upgrade this to this version.

