<?php session_start();
include 'include/connect.php';
include 'include/function.php';
$sql = 'select * from t_bayarranap where NOMR = "'.$_REQUEST['nomr'].'"	and IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"';
$sql = mysql_query($sql);
if(mysql_num_rows($sql) > 0){
	$data = mysql_fetch_array($sql);
	
	echo $_REQUEST['nomr'];
	if($data['LUNAS'] == 0){
		$sql='CALL pr_savebill_ranap_add("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'","'.date("Y-m-d").'",0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['noruang'].',0,"'.$data['NOBILL'].'")';
		mysql_query($sql);
	}else{
		$sql='CALL pr_savebill_ranap("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'","'.date("Y-m-d").'",0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['noruang'].',0,"'.$_REQUEST['nott'].'")';
		mysql_query($sql);
	}
}else{
	$sql='CALL pr_savebill_ranap("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'","'.date("Y-m-d").'",0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['noruang'].',0,"'.$_REQUEST['nott'].'")';
	mysql_query($sql);
}
?>