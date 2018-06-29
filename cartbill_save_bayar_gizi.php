<?php session_start();
include 'include/connect.php';
include 'include/function.php';
#if(!empty($_REQUEST['kddokter'])){
$kode	= '01.01.18.01';
$ip		= getRealIpAddr();
$tarif	= getTarif($kode);
$unit	= '18';
$ss = 'insert into tmp_cartbayar set KODETARIF = "'.$kode.'", IP = "'.$ip.'", poly = '.$_REQUEST['poly'].', KDDOKTER = '.$_REQUEST['dokter'].', UNIT = "'.$unit.'", TARIF = '.$tarif['tarif'].', JASA_PELAYANAN = '.$tarif['jasa_pelayanan'].', JASA_SARANA = '.$tarif['jasa_sarana'].', TOTTARIF = '.$tarif['tarif'].', QTY = 1';
mysql_query($ss);
if($_REQUEST['rajal'] == 1){
	mysql_query('CALL pr_savebill_tindakanrajal_tmpdokter("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idx'].'",CURDATE(),0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['poly'].',0,'.$unit.')');
}else{
	$sql = 'select * from t_bayarranap where NOMR = "'.$_REQUEST['nomr'].'"	and IDXDAFTAR = "'.$_REQUEST['idx'].'"';
	$sql = mysql_query($sql);
	if(mysql_num_rows($sql) > 0){
		$data = mysql_fetch_array($sql);
		if($data['LUNAS'] == 0){
			$sql='CALL pr_savebill_ranap_add("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idx'].'",CURDATE(),0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['poly'].',0,"'.$data['NOBILL'].'")';
			mysql_query($sql);
		}else{
			echo 'aaaxxx';
			$sql='CALL pr_savebill_ranap("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idx'].'",CURDATE(),0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['poly'].',"0","'.$_REQUEST['nott'].'")';
			mysql_query($sql);
		}
	}else{
		echo 'aaaaaasss';
		$sql='CALL pr_savebill_ranap("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idx'].'",CURDATE(),0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['poly'].',"0","'.$_REQUEST['nott'].'")';
		mysql_query($sql);
	}


}
#}else{
#	mysql_query('CALL pr_savebill_tindakanrajal("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idx'].'","'.date("Y-m-d").'",0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['poly'].',0)');
#}
?>