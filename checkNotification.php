<?php
session_start();

include("include/connect.php");
	if($_GET[checkNum]){ // if your load with ?checkNum=1 you just want to check if there is anything new (this is for optimization)
		$q = mysql_query("select count(*) as nb from t_notification where status is null  AND roles = ".$_SESSION['ROLES']) or die(mysql_error());
		$r = mysql_fetch_array($q);
		echo $r[nb];
	} else { // otherwhise you want to load the info about the newest notification to display and set the status to 1 so it wont be displayed again
		$q = mysql_query("select * from t_notification where status is null AND roles = ".$_SESSION['ROLES']." order by id limit 1") or die(mysql_error());
		$r = mysql_fetch_array($q);
		mysql_query("update t_notification set status = 1 WHERE roles = ".$_SESSION['ROLES']."");
		echo $r[info];
	}
?>
