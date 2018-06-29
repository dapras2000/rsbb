<?php
include '../include/connect.php';
$sql	= mysql_query('select kode_tindakan from m_tarif2012 where kode_tindakan = "'.$_REQUEST['kode_tindakan'].'"');
if(mysql_num_rows($sql) > 0){
	mysql_query('update m_tarif2012 set dr_spesialis = "'.$_REQUEST['dr_spesialis'].'",
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
										where kode_tindakan = "'.$_REQUEST['kode_tindakan'].'"');
	echo 'Sukses';
										
}else{		
	echo 'Kode Tindakan Tidak Terdaftar';
}
