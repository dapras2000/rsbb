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

$sql_nourut = "SELECT NOLAB FROM t_radiologi ORDER BY IDXORDERRAD DESC LIMIT 1";
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

$sql = 'select LUNAS from t_bayarranap where NOMR = "'.$_REQUEST['nomr'].'"	and IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"';
$sql = mysql_query($sql);

/*
mysql_query('insert into tmp_cartbayar (KODETARIF,QTY,IP,poly,KDDOKTER,UNIT,TARIF,TOTTARIF,JASA_SARANA,JASA_PELAYANAN)
SELECT a.kode_tindakan, SUM(a.qty),"'.$ip.'",'.$_REQUEST['unit'].','.$_REQUEST['kddokter'].','.$_SESSION['KDUNIT'].',b.tarif,SUM(a.qty * b.tarif),b.jasa_sarana,b.jasa_pelayanan 
FROM tmp_orderpenunjang a 
JOIN m_tarif2012 b on b.kode_tindakan = a.kode_tindakan
WHERE a.ip = "'.$ip.'" GROUP BY a.kode_tindakan');
*/

$yyy = mysql_num_rows(mysql_query("SELECT * FROM t_radiologi WHERE NOMR='".$_REQUEST['nomr']."' AND IDXDAFTAR='".$_REQUEST['idxdaftar']."' AND POLYPENGIRIM='".$_REQUEST['unit']."'"));


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
		$sumqty			= array_sum($qty);
		$sumtotalrif	= array_sum($totalrif);
		
		mysql_query('insert into t_radiologi (JENISPHOTO,TGLORDER,DRPENGIRIM,POLYPENGIRIM,IDXDAFTAR,NOMR,RAJAL,APS)
						values ("'.$kode_tindakan.'",CURDATE(),"'.$_REQUEST['kddokter'].'","'.$_REQUEST['unit'].'","'.$_REQUEST['idxdaftar'].'","'.$_REQUEST['nomr'].'","'.$rajal.'","'.$_REQUEST['aps'].'")');
		mysql_query('insert into tmp_cartbayar (KODETARIF,QTY,IP,poly,KDDOKTER,UNIT,TARIF,TOTTARIF,JASA_SARANA,JASA_PELAYANAN,JENIS)
						values ("'.$kode_tindakan.'","'.$qty.'","'.$ip.'","'.$_REQUEST['unit'].'","'.$_REQUEST['kddokter'].'","'.$_SESSION['KDUNIT'].'","'.$tarif.'","'.$totalrif.'","'.$jasa_sarana.'","'.$jasa_pelayanan.'","'.$jenis.'")');

	}
	
}else{
	while($row = mysql_fetch_array($get_tmptindakan2)){
		$kode_tindakan	= $row['kode_tindakan'];
		$qty			= $row['qty'];
		$tarif			= $row['tarif'];
		$jenis			= $row['jenis'];
		$jasa_pelayanan= $row['jasa_pelayanan'];
		$jasa_sarana	= $row['jasa_sarana'];
		$totalrif		= $qty * $tarif;

		$xxx = mysql_num_rows(mysql_query("SELECT * FROM t_radiologi WHERE NOMR='".$_REQUEST['nomr']."' AND IDXDAFTAR='".$_REQUEST['idxdaftar']."' AND POLYPENGIRIM='".$_REQUEST['unit']."' AND JENISPHOTO='".$kode_tindakan."'"));
		echo $xxx;

		if($xxx == 0){
			mysql_query('insert into t_radiologi (JENISPHOTO,TGLORDER,DRPENGIRIM,POLYPENGIRIM,IDXDAFTAR,NOMR,RAJAL,APS)
					values ("'.$kode_tindakan.'",CURDATE(),"'.$_REQUEST['kddokter'].'","'.$_REQUEST['unit'].'","'.$_REQUEST['idxdaftar'].'","'.$_REQUEST['nomr'].'","'.$rajal.'","'.$_REQUEST['aps'].'")');
			mysql_query('insert into tmp_cartbayar (KODETARIF,QTY,IP,poly,KDDOKTER,UNIT,TARIF,TOTTARIF,JASA_SARANA,JASA_PELAYANAN,JENIS)
						values ("'.$kode_tindakan.'","'.$qty.'","'.$ip.'","'.$_REQUEST['unit'].'","'.$_REQUEST['kddokter'].'","'.$_SESSION['KDUNIT'].'","'.$tarif.'","'.$totalrif.'","'.$jasa_sarana.'","'.$jasa_pelayanan.'","'.$jenis.'")');

		}
	}
}

if($rajal == 1){
	$sql='CALL pr_savebill_tindakanrajal_dokter("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'",CURDATE(),0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_REQUEST['unit'].','.$_REQUEST['aps'].',"'.$_REQUEST['kddokter'].'","'.$_SESSION['KDUNIT'].'")';
	mysql_query($sql);
}else{
	$sql = 'select NOBILL,LUNAS from t_bayarranap where NOMR = "'.$_REQUEST['nomr'].'"	and IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"';
	$sql = mysql_query($sql);
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
mysql_query('delete from tmp_cartorderrad where NOMR = "'.$_REQUEST['nomr'].'" and IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"');
mysql_query('delete from tmp_orderpenunjang');