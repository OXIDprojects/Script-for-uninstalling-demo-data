<?php
// uninstall demo data in oxid-database
// 1. copy this file and additionally unistall_demo_data.sql to the root directory
// 2. run www.myshop.tld/unistall_demo_data.php
// 3. delete these two files !

$sAbsDir = dirname(__FILE__) . DIRECTORY_SEPARATOR;
if (!is_file ($sAbsDir . 'config.inc.php')) {
  echo $sAbsDir . ' is not the root-directory of an oxid-shop';
	return;
  }
$sSqlFile = $sAbsDir . 'uninstall_demo_data.sql';
if (!is_file ($sSqlFile)) {
  echo $sSqlFile . ' not found';
	return;
  }

$oDB = new myDB;
$oDB->init();

$I = 0;
$handle = fopen($sSqlFile, 'r');
while (($sLine = fgets($handle, 4096)) !== false) {
  $sLine = trim($sLine);
  if ($sLine != '' && substr($sLine,0,1) != '#') {
	  if ($oDB->myquery($sLine)) {
      echo 'executed -> ' . $sLine . '<br>';
			$I += 1;
			}
		}
  }
fclose($handle);
echo $I . ' commands executed<br>';
echo 'done<br>';
return;

// -----------------------------------------------------------------------------	
class myDB {
  function init() {
	  global $sAbsDir;
    $oConfig = new myconfig;
		$oConfig->init();
    $mydb = @mysql_connect($oConfig->dbHost, $oConfig->dbUser, $oConfig->dbPwd);
    mysql_select_db($oConfig->dbName, $mydb);
		if (mysql_error()) {
		  die ('no connection to database - ' . mysql_error()); 
		  }
    echo 'database connection ok ... <br>';
		}
  function myquery($sQuery) {
	  if (trim($sQuery) == '') return false;
	  mysql_query($sQuery) || die(mysql_error() . ' - ' . $sQuery);
		if (!mysql_affected_rows()) return false; 
		return true;
	  }
  }

class myconfig {
  function init() {
	  global $sAbsDir;
    include $sAbsDir . 'config.inc.php';
		}
	}
