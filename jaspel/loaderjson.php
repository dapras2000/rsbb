<?php
include '../include/connect.php';
$action	= $_REQUEST['action'];
if($action =='save'){

$sql	= mysql_query('select kode_tindakan from m_tarif2012 where kode_tindakan = "'.str_replace('_','.',$_REQUEST['id']).'"');
if(mysql_num_rows($sql) > 0){
	mysql_query ('update m_tarif2012 set tarif = "'.$_REQUEST['tarif'].'",
										jasa_pelayanan = "'.$_REQUEST['jaspel'].'",
										jasa_sarana = "'.$_REQUEST['jasrana'].'",
										dr_spesialis = "'.$_REQUEST['dr_spesialis'].'",
										dr_umum	= "'.$_REQUEST['dr_umum'].'",
										manajemen_sp	= "'.$_REQUEST['manajemen_sp'].'",
										pendukung_sp	= "'.$_REQUEST['pendukung_sp'].'",
										asisten_sp		= "'.$_REQUEST['asisten_sp'].'",
										manajemen_um	= "'.$_REQUEST['manajemen_um'].'",
										pendukung_um	= "'.$_REQUEST['pendukung_um'].'",
										asisten_um		= "'.$_REQUEST['asisten_um'].'",
										bidan			= "'.$_REQUEST['bidan'].'",
										manajemen_bd	= "'.$_REQUEST['manajemen_bd'].'",
										pendukung_bd	= "'.$_REQUEST['pendukung_bd'].'",
										asisten_bd	 	= "'.$_REQUEST['asisten_bd'].'",
										drOperator		= "'.$_REQUEST['drOperator'].'",
										drAnestesi		= "'.$_REQUEST['drAnestesi'].'",
										drAnak			= "'.$_REQUEST['drAnak'].'",
										perawat_ok		= "'.$_REQUEST['perawat_ok'].'",
										perawat_perina	= "'.$_REQUEST['perawat_perina'].'",
										manajemen_ok	= "'.$_REQUEST['manajemen_ok'].'",
										asisten_ok		= "'.$_REQUEST['asisten_ok'].'",
										pendukung_ok	= "'.$_REQUEST['pendukung_ok'].'",
										drRadiologi		= "'.$_REQUEST['drRadiologi'].'",
										drPerujuk		= "'.$_REQUEST['drPerujuk'].'",
										perawat_rad		= "'.$_REQUEST['perawat_rad'].'",
										manajemen_rad	= "'.$_REQUEST['manajemen_rad'].'",
										pendukung_rad	= "'.$_REQUEST['pendukung_rad'].'",
										asisten_rad		= "'.$_REQUEST['asisten_rad'].'",
										drPerujuk_rad	= "'.$_REQUEST['drPerujuk_rad'].'",
										petugas_rad		= "'.$_REQUEST['petugas_rad'].'",
										drLab			= "'.$_REQUEST['drLab'].'",
										petugas_lab		= "'.$_REQUEST['petugas_lab'].'",
										asisten_lab		= "'.$_REQUEST['asisten_lab'].'",
										manajemen_lab	= "'.$_REQUEST['manajemen_lab'].'",
										pendukung_lab	= "'.$_REQUEST['pendukung_lab'].'",
										drPerujuk_lab 	= "'.$_REQUEST['drPerujuk_lab'].'"
										where kode_tindakan = "'.str_replace('_','.',$_REQUEST['id']).'"');
					echo 'Sukses';
														
				}else{		
					echo 'Kode Tindakan Tidak Terdaftar';
				}

}elseif($action == 'update'){

}elseif($action == 'remove'){
	
}else{
	$sql = mysql_query('SELECT a.nama_tindakan as name,REPLACE(a.kode_tindakan,".","_") as id, REPLACE(a.kode_tindakan,".","_") as code, 
	CASE WHEN (a.tarif = 0) THEN "closed" ELSE "open" END AS state, a.tarif as tarif, a.jasa_pelayanan as jaspel, a.jasa_sarana as jasrana,
	a.dr_spesialis, a.dr_umum, a.manajemen_sp, a.pendukung_sp, a.asisten_sp,a.manajemen_um,a.pendukung_um, a.asisten_um, a.bidan, a.manajemen_bd,
	a.pendukung_bd, a.asisten_bd, a.drOperator, a.drAnestesi, a.drAnak, a.perawat_ok,a.perawat_perina,a.manajemen_ok,a.asisten_ok,a.pendukung_ok, a.drRadiologi,a.drPerujuk,a.perawat_rad, a.manajemen_rad, a.pendukung_rad, a.asisten_rad, a.drPerujuk_rad, a.petugas_rad, a.drLab, a.petugas_lab, a.asisten_lab, a.manajemen_lab, a.pendukung_lab, a.drPerujuk_lab
	FROM m_tarif2012 a  where a.kode_gruptindakan = "'.str_replace('_','.',$_REQUEST['id']).'"');
	if(mysql_num_rows($sql) > 0){
		$response = array();
		while($row = mysql_fetch_array($sql)){
			array_push($response,$row);
		}
		echo json_encode($response);
	}
}
?>