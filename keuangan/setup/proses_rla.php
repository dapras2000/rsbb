<?php
session_start();
require_once("../../include/connect.php"); 

if (isset($_SESSION['KDUNIT']))
{
	$modus  = isset($_POST['modus']) ? htmlspecialchars($_POST['modus']) : "";
	$hideId  = isset($_POST['hideId']) ? htmlspecialchars($_POST['hideId']) : "";
	$noakun  = isset($_POST['noakun']) ? htmlspecialchars($_POST['noakun']) : "";	
	$namaakun  = isset($_POST['namaakun']) ? htmlspecialchars($_POST['namaakun']) : "";
	$nogrupakun  = isset($_POST['nogrupakun']) ? htmlspecialchars($_POST['nogrupakun']) : "";	
	$icon  		= $_POST['icon'] ;	

	require_once("rla.php");
	$objSetupRLA = new rla();

	$objSetupRLA->db_host=$hostname;
	$objSetupRLA->db_user=$username;
	$objSetupRLA->db_pass=$password;
	$objSetupRLA->db_database=$database; 	
	if(!$objSetupRLA->db_connect()) {
		echo "<h1>Sorry! Could not connect to the database server.</h1>";	
		exit();	
	}	
	if ($modus=='modify'){
		if ($objSetupRLA->updateAkun(str_replace('_','.',$noakun),$namaakun,$nogrupakun,$icon)) {?>
			<!--<script language="javascript">alert('sukses');</script>-->	<?php echo 'ok';
		}
		else {
			echo $objSetupRLA->strDBError;
		}
	}
	if ($modus=='insert'){
		if ($objSetupRLA->insertAkun($noakun,$namaakun,$nogrupakun,$icon)) {?>
			<script language="javascript">alert('sukses');</script>	<?php echo 'ok';
		}
		else {
			echo $objSetupRLA->strDBError;
		}
	}
		
				
?>

<?php 
}else{
	?><script language="javascript">document.location.href="index.php?<?php echo  'status=forbidden'?>"</script><?php 
}
?>