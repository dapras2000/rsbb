<?php session_start();
include 'include/connect.php';
include 'include/function.php';
#if(!empty($_REQUEST['kddokter'])){
if( ($_SESSION['KDUNIT'] != 19) and ($_SESSION['KDUNIT'] != 15) and ($_SESSION['KDUNIT'] != 27) ){
	if($_SESSION['KDUNIT'] == 32){
		$u = $_REQUEST['poly'];
	}else{
		$u = $_SESSION['KDUNIT'];
	}
	mysql_query('CALL pr_savebill_tindakanrajal_tmpdokter("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'","'.date("Y-m-d").'",0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['poly'].',0,'.$u.')');
}else{
	$sql = 'select * from t_bayarranap where NOMR = "'.$_REQUEST['nomr'].'"	and IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"';
	$sql = mysql_query($sql);
	if(mysql_num_rows($sql) > 0){
		$data = mysql_fetch_array($sql);
		if($data['LUNAS'] == 0){
			$sql='CALL pr_savebill_ranap_add("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'","'.date("Y-m-d").'",0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['noruang'].',0,"'.$data['NOBILL'].'")';
			mysql_query($sql);
		}else{
			$sql='CALL pr_savebill_ranap("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'","'.date("Y-m-d").'",0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['noruang'].',"0")';
			mysql_query($sql);
		}
	}else{
		$sql='CALL pr_savebill_ranap("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'","'.date("Y-m-d").'",0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['noruang'].',"0")';
		mysql_query($sql);
	}


}
#}else{
#	mysql_query('CALL pr_savebill_tindakanrajal("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'","'.date("Y-m-d").'",0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['poly'].',0)');
#}
?>