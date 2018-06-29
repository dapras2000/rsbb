<?
set_time_limit(10000);

$con = mysql_connect('localhost','root','webappbuk2013');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("database", $con);
mysql_query("DELETE FROM user_emonev_tw3");

$fp = fopen("C:\emonev\hasil csv\dak.csv", "r");

while( !feof($fp) ) {
  if( !$line = fgetcsv($fp, 1000, ';', '"')) {
     continue;
  }
	
    $importSQL = "INSERT INTO user_emonev_tw3 VALUES('','','".$line[0]."','".$line[1]."','-')";
	
    mysql_query($importSQL) or die(mysql_error());  
}
include "trigger_emonev.php";
fclose($fp);
mysql_close($con);
?>