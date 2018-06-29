<?php session_start();
include("../include/connect.php");
include("../include/function.php");
$kode 		= $_REQUEST['checkbox'];
$jml_kode	= count($_REQUEST['checkbox']);
$ip			= getRealIpAddr();
$rajal		= getGroupUnit($_REQUEST['unit']);
$jenis		= $_REQUEST['cito_status'];

if($jenis == "c"){
	$faktor = 1.25;
}else{
	$faktor = 1;
}

$sql_nourut = "SELECT NOLAB FROM t_orderlab WHERE NOLAB LIKE '".date('y')."%' ORDER BY IDXORDERLAB DESC LIMIT 1";
$get_nourut = mysql_query($sql_nourut);
if(mysql_num_rows($get_nourut) > 0){
     $dat_nourut = mysql_fetch_assoc($get_nourut);
	 $no_last = $dat_nourut['NOLAB'] + 1;
	 $nourut = $no_last;
}else{
     $nourut = date('y').'00001';
}

for($y=0; $y<$jml_kode; $y++)
{	
	mysql_query('insert into tmp_orderpenunjang (kode_tindakan,nama_tindakan,qty,tarif,ip,jenis,jasa_pelayanan,jasa_sarana)
				select kode_tindakan, nama_tindakan,1,tarif,"'.$ip.'","e",jasa_pelayanan,jasa_sarana from m_tarif2012 where kode_tindakan = "'.$kode[$y].'"');
}

//$yyy = mysql_num_rows(mysql_query("SELECT * FROM t_orderlab WHERE NOMR='".$_REQUEST['nomr']."' AND IDXDAFTAR='".$_REQUEST['idxdaftar']."' AND KDPOLY='".$_REQUEST['unit']."'"));
$yyy = mysql_num_rows(mysql_query("SELECT * FROM t_orderlab WHERE NOMR='".$_REQUEST['nomr']."' AND IDXDAFTAR='".$_REQUEST['idxdaftar']."'"));

$get_tmptindakan2 = mysql_query("SELECT * FROM tmp_orderpenunjang");
if($yyy == 0){
	while($row = mysql_fetch_array($get_tmptindakan2)){
		$kode_tindakan	= $row['kode_tindakan'];
		$qty			= $row['qty'];
		$tarif			= $row['tarif'];
		$jenis			= $row['jenis'];
		$jasa_pelayanan	= $row['jasa_pelayanan'];
		$jasa_sarana	= $row['jasa_sarana'];
		$totalrif		= $qty * $tarif;

		mysql_query('insert into t_orderlab (KODE,QTY,IDXDAFTAR,NOMR,TANGGAL,DRPENGIRIM,KDPOLY,RAJAL,NOLAB,APS,JENIS)
						VALUES ("'.$kode_tindakan.'","'.$qty.'","'.$_REQUEST['idxdaftar'].'","'.$_REQUEST['nomr'].'",CURDATE(),"'.$_REQUEST['kddokter'].'","'.$_REQUEST['unit'].'","'.$rajal.'","'.$nourut.'", "'.$_REQUEST['aps'].'","'.$jenis.'")');	
		
		mysql_query('insert into tmp_cartbayar (KODETARIF,QTY,IP,poly,KDDOKTER,UNIT,TARIF,TOTTARIF,JASA_SARANA,JASA_PELAYANAN,JENIS)
										Values ("'.$kode_tindakan.'","'.$qty.'","'.$ip.'","'.$_REQUEST['unit'].'","'.$_REQUEST['kddokter'].'", "'.$_SESSION['KDUNIT'].'","'.$tarif.'","'.$totalrif.'","'.$jasa_sarana.'","'.$jasa_pelayanan.'","'.$jenis.'")');
	}
}else{
	while($row = mysql_fetch_array($get_tmptindakan2)){
		$kode_tindakan	= $row['kode_tindakan'];
		$qty			= $row['qty'];
		$tarif			= $row['tarif'];
		$jenis			= $row['jenis'];
		$jasa_pelayanan	= $row['jasa_pelayanan'];
		$jasa_sarana	= $row['jasa_sarana'];
		$totalrif		= $qty * $tarif;

		//$xxx = mysql_num_rows(mysql_query("SELECT * FROM t_orderlab WHERE NOMR='".$_REQUEST['nomr']."' AND IDXDAFTAR='".$_REQUEST['idxdaftar']."' AND KDPOLY='".$_REQUEST['unit']."' AND KODE='".$kode_tindakan."' "));
		$xxx = mysql_num_rows(mysql_query("SELECT * FROM t_orderlab WHERE NOMR='".$_REQUEST['nomr']."' AND IDXDAFTAR='".$_REQUEST['idxdaftar']."'"));
		echo $xxx;

		//if($xxx == 0){
			mysql_query('insert into t_orderlab (KODE,QTY,IDXDAFTAR,NOMR,TANGGAL,DRPENGIRIM,KDPOLY,RAJAL,NOLAB,APS,JENIS)
						VALUES ("'.$kode_tindakan.'","'.$qty.'","'.$_REQUEST['idxdaftar'].'","'.$_REQUEST['nomr'].'",CURDATE(),"'.$_REQUEST['kddokter'].'","'.$_REQUEST['unit'].'","'.$rajal.'","'.$nourut.'", "'.$_REQUEST['aps'].'","'.$jenis.'")');	
			
			mysql_query('insert into tmp_cartbayar (KODETARIF,QTY,IP,poly,KDDOKTER,UNIT,TARIF,TOTTARIF,JASA_SARANA,JASA_PELAYANAN,JENIS)
										Values ("'.$kode_tindakan.'","'.$qty.'","'.$ip.'","'.$_REQUEST['unit'].'","'.$_REQUEST['kddokter'].'", "'.$_SESSION['KDUNIT'].'","'.$tarif.'","'.$totalrif.'","'.$jasa_sarana.'","'.$jasa_pelayanan.'","'.$jenis.'")');
		//}
	}
}

if($rajal == 1){
	if($_REQUEST['nobill'] != ''){
		$sql_pr='CALL pr_savebill_tindakanrajal_dokter_tambahan("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'",CURDATE(),0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['unit'].','.$_REQUEST['aps'].',"'.$_REQUEST['kddokter'].'", "'.$_SESSION['KDUNIT'].'", "'.$_REQUEST['nobill'].'")';
		mysql_query($sql_pr);
	}else{
		$sql_pr='CALL pr_savebill_tindakanrajal_tmpdokter("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'",CURDATE(),0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['unit'].','.$_REQUEST['aps'].', "'.$_SESSION['KDUNIT'].'")';
		mysql_query($sql_pr);
	}
}else{
	$sql = mysql_query('select * from t_bayarranap where NOMR = "'.$_REQUEST['nomr'].'"	and IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"');
	if(mysql_num_rows($sql) > 0){
		$data = mysql_fetch_array($sql);
		if($data['LUNAS'] == 0){
			$sql='CALL pr_savebill_ranap_add("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'",CURDATE(),0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['ruang'].',0,"'.$data['NOBILL'].'")';
			mysql_query($sql);
		}else{
			$sql='CALL pr_savebill_ranap("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'",CURDATE(),0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['ruang'].',0,"'.$_REQUEST['nott'].'")';
			mysql_query($sql);
		}
	}else{
		$sql='CALL pr_savebill_ranap("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'",CURDATE(),0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['ruang'].',0,"'.$_REQUEST['nott'].'")';
		mysql_query($sql);
	}
}
mysql_query('delete from tmp_cartorderlab where NOMR = "'.$_REQUEST['nomr'].'" and IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"');
mysql_query('delete from tmp_orderpenunjang');