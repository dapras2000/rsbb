<?php
session_start();
require_once("../../include/connect.php"); 
//$var=decode($_SERVER['REQUEST_URI']);
if (isset($_SESSION['KDUNIT']))
{
	$modus  = isset($_POST['modus']) ? htmlspecialchars($_POST['modus']) : "";
	$hideId  = isset($_POST['hideId']) ? htmlspecialchars($_POST['hideId']) : "";
	$noakun  = isset($_POST['noakun']) ? htmlspecialchars($_POST['noakun']) : "";	
	$namaakun  = isset($_POST['namaakun']) ? htmlspecialchars($_POST['namaakun']) : "";
	$nogrupakun  = isset($_POST['nogrupakun']) ? htmlspecialchars($_POST['nogrupakun']) : "";	
	$icon  		= $_POST['icon'] ;	
	$tarif=isset($_POST['tarif']) ? htmlspecialchars($_POST['tarif']) : "";	
	$jasa_sarana=isset($_POST['jassar']) ? htmlspecialchars($_POST['jassar']) : "";	
	$jasa_pelayanan=isset($_POST['jaspel']) ? htmlspecialchars($_POST['jaspel']) : "";		

	require_once("m_tarif2012.php");
	$objSetupTarif = new m_tarif2012();
	$objSetupTarif->db_host=$hostname;
	$objSetupTarif->db_user=$username;
	$objSetupTarif->db_pass=$password;
	$objSetupTarif->db_database=$database; 	
	if(!$objSetupTarif->db_connect()) {
		echo "<h1>Sorry! Could not connect to the database server.</h1>";	
		exit();	
	}	
	if ($modus=='modify'){
		if ($objSetupTarif->updateAkun(str_replace('_','.',$noakun),$namaakun,$nogrupakun,$jasa_sarana,$jasa_pelayanan,$tarif)) {?>
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
	?><script language="javascript">document.location.href="index.php?<?php echo 'status=forbidden'?>"</script><?php 
}
?>