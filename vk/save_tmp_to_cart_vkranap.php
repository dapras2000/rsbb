<?php session_start();
include '../include/connect.php';
include '../include/function.php';
$tadm	= check_t_bayarranap($_REQUEST['nomr'],$_REQUEST['idxdaftar']);
if(!$tadm){
	$sql='CALL pr_savebill_ranap("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'",CURDATE(),0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['ruang'].',0,"'.$_REQUEST['ruang'].'")';
	mysql_query($sql);
}else{
	if($tadm['LUNAS'] == 0){
		$sql='CALL pr_savebill_ranap_add("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'",CURDATE(),0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['ruang'].',0,"'.$tadm['NOBILL'].'")';
		mysql_query($sql);
	}else{
		$sql='CALL pr_savebill_ranap("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'",CURDATE(),0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['ruang'].',0,"'.$_REQUEST['ruang'].'")';
		mysql_query($sql);
	}
}
?>