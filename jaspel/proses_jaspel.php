<?php
session_start();
require_once("../include/connect.php");
if (isset($_SESSION['KDUNIT']))
{
	$modus  = isset($_POST['modus']) ? htmlspecialchars($_POST['modus']) : "";
	$hideId  = isset($_POST['hideId']) ? htmlspecialchars($_POST['hideId']) : "";	
	$noakun  = isset($_POST['noakun']) ? htmlspecialchars($_POST['noakun']) : "";	
	$namaakun  = isset($_POST['namaakun']) ? htmlspecialchars($_POST['namaakun']) : "";
	$nogrupakun  = isset($_POST['nogrupakun']) ? htmlspecialchars($_POST['nogrupakun']) : "";	
	//$icon  		= $_POST['icon'] ;	
	$tarif=isset($_POST['tarif']) ? htmlspecialchars($_POST['tarif']) : "";	
	$jasa_sarana=isset($_POST['jassar']) ? htmlspecialchars($_POST['jassar']) : "";	
	$jasa_pelayanan=isset($_POST['jaspel']) ? htmlspecialchars($_POST['jaspel']) : "";		
	
$dr_spesialis =isset($_POST['drsp']) ? htmlspecialchars($_POST['drsp']) : "";		
$dr_umum =isset($_POST['dr_um']) ? htmlspecialchars($_POST['dr_um']) : "";		
$manajemen_sp =isset($_POST['manajemen_sp']) ? htmlspecialchars($_POST['manajemen_sp']) : "";		
$pendukung_sp =isset($_POST['pendukung_sp']) ? htmlspecialchars($_POST['pendukung_sp']) : "";		
$asisten_sp =isset($_POST['asisten_sp']) ? htmlspecialchars($_POST['asisten_sp']) : "";		
$manajemen_um =isset($_POST['manajemen_um']) ? htmlspecialchars($_POST['manajemen_um']) : "";		
$pendukung_um =isset($_POST['pendukung_um']) ? htmlspecialchars($_POST['pendukung_um']) : "";		
$asisten_um =isset($_POST['asisten_um']) ? htmlspecialchars($_POST['asisten_um']) : "";		
$bidan=isset($_POST['bidan']) ? htmlspecialchars($_POST['bidan']) : "";		
$manajemen_bd =isset($_POST['manajemen_bd']) ? htmlspecialchars($_POST['manajemen_bd']) : "";		
$pendukung_bd =isset($_POST['pendukung_bd']) ? htmlspecialchars($_POST['pendukung_bd']) : "";		
$asisten_bd =isset($_POST['asisten_bd']) ? htmlspecialchars($_POST['asisten_bd']) : "";		
$drOperator =isset($_POST['drOperator_ok']) ? htmlspecialchars($_POST['drOperator_ok']) : "";		
$drAnestesi =isset($_POST['drAnestesi_ok']) ? htmlspecialchars($_POST['drAnestesi_ok']) : "";		
$drAnak =isset($_POST['dranak_ok']) ? htmlspecialchars($_POST['dranak_ok']) : "";		
$perawat_ok  =isset($_POST['perawat_ok']) ? htmlspecialchars($_POST['perawat_ok']) : "";		
$perawat_perina =isset($_POST['perawat_perina']) ? htmlspecialchars($_POST['perawat_perina']) : "";		
$manajemen_ok =isset($_POST['manajemen_ok']) ? htmlspecialchars($_POST['manajemen_ok']) : "";		
$asisten_ok =isset($_POST['asisten_ok']) ? htmlspecialchars($_POST['asisten_ok']) : "";		
$pendukung_ok	=isset($_POST['pendukung_ok']) ? htmlspecialchars($_POST['pendukung_ok']) : "";		
	

	require_once("m_jaspel2012.php");
	$objSetupTarif = new m_jaspel2012();
	$objSetupTarif->db_host=$hostname;
	$objSetupTarif->db_user=$username;
	$objSetupTarif->db_pass=$password;
	$objSetupTarif->db_database=$database; 	
	
	if(!$objSetupTarif->db_connect()) {
		echo "<h1>Sorry! Could not connect to the database server.</h1>";	
		exit();	
	}	
	if ($modus=='modify'){
		if ($objSetupTarif->updateAkun(str_replace('_','.',$noakun), $dr_spesialis , $dr_umum, $manajemen_sp , $pendukung_sp , $asisten_sp ,$manajemen_um, $pendukung_um , $asisten_um , $bidan,$manajemen_bd ,$pendukung_bd , $asisten_bd , $drOperator , $drAnestesi , $drAnak, $perawat_ok  , $perawat_perina , $manajemen_ok , $asisten_ok , $pendukung_ok)) {?>
			<!--<script language="javascript">alert('sukses');</script>-->	<?php echo 'ok';
		}
		else {
			echo $objSetupTarif->strDBError;
		}
	}
	if ($modus=='insert'){
		if ($objSetupTarif->insertAkun($noakun,$namaakun,$nogrupakun,$jasa_sarana,$jasa_pelayanan,$tarif)) {?>
			<script language="javascript">alert('sukses');</script>	<?php echo 'ok';
		}
		else {
			echo $objSetupTarif->strDBError;
		}
	}
		
				
?>

<?php 
}else{
	?><script language="javascript">document.location.href="index.php?<?php echo paramEncrypt('status=forbidden')?>"</script><?php 
}
?>