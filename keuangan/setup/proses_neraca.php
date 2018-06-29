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
	$icon  		= isset($_POST['icon']) ? htmlspecialchars($_POST['icon']) : "";	 
 
	require_once("neraca.php");
	$objSetupNeraca = new neraca();
	$objSetupNeraca->db_host=$hostname;
	$objSetupNeraca->db_user=$username;
	$objSetupNeraca->db_pass=$password;
	$objSetupNeraca->db_database=$database; 	
	if(!$objSetupNeraca->db_connect()) {
		echo "<h1>Sorry! Could not connect to the database server.</h1>";	
		exit();	
	}	
	if ($modus=='modify'){
		if ($objSetupNeraca->updateAkun(str_replace('_','.',$noakun),$namaakun,$nogrupakun,$icon)) {?>
			<script language="javascript">alert(<?php echo $hideId;?>);</script>	<?php echo 'ok';
		}
		else {
			echo $objSetupNeraca->strDBError;
		}
	}
	if ($modus=='insert'){
		if ($objSetupNeraca->insertAkun($noakun,$namaakun,$nogrupakun,$icon)) {?>
			<script language="javascript">alert('sukses');</script>	<?php echo 'ok';
		}
		else {
			echo $objSetupNeraca->strDBError;
		}
	}
		
				
?>

<?php 
}else{
 	?><script language="javascript">document.location.href="index.php?<?php echo 'status=forbidden'?>"</script><?php 
}
?>