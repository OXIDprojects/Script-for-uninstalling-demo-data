# Script for uninstalling demo data

Many thanks to @patchwork.de, who originally created this script: http://forum.oxid-esales.com/showthread.php?t=40161

Likely you installed the shop (v4.10.1 in this case) including demo data - products, categories, manufacturers, orders etc. and want to get rid of this data completely.

Of course you can ditch them item by item in the admin panel but this is really cumbersome.

Simply copy uninstall_demo_data.php and uninstall_demo_data.sql into the root folder of your OXID eShop (same level with config.inc.php) and point your browser to http://[yourshop.com]/uninstall_demo_data.php. Please don't forget to delete these files afterwards immediately!

Only the default demo data will be deleted; all self created products, categories etc. will remain.
