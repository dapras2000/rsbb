<?php
session_start();
//require_once("../encryption/function.php");
//$var=decode($_SERVER['REQUEST_URI']);

if (isset($_SESSION['id_admin']))
{
	$modus  = isset($_POST['modus']) ? htmlspecialchars($_POST['modus']) : "";
	$hideId  = isset($_POST['hideId']) ? htmlspecialchars($_POST['hideId']) : "";
	$noakun  = isset($_POST['noakun']) ? htmlspecialchars($_POST['noakun']) : "";	
	$nilai=isset($_POST['nilai']) ? htmlspecialchars($_POST['nilai'])	: "";	
	$tahun=isset($_POST['tahun']) ? htmlspecialchars($_POST['tahun'])	: "";	 
	require_once("tk_neraca.php");
	$objTKNeraca = new tk_neraca();
	$objTKNeraca->db_host=$_SESSION['host'];
	$objTKNeraca->db_user=$_SESSION['user'];
	$objTKNeraca->db_pass=$_SESSION['psw'];
	$objTKNeraca->db_database=$_SESSION['db']; 	
	if(!$objTKNeraca->db_connect()) {
		echo "<h1>Sorry! Could not connect to the database server.</h1>";	
		exit();	
	}	
	if ($modus=='modify'){
		if ($objTKNeraca->updateTKAkun(str_replace('_','.',$noakun),$tahun,$nilai)) {?>
			<script language="javascript">alert(<?php echo $hideId;?>);</script>	<?php echo 'ok';
		}
		else {
			echo $objTKNeraca->strDBError;
		}
	}
	
		
				
?>

<?php 
}else{
	require_once("../encryption/function.php");
	?><script language="javascript">document.location.href="index.php?<?php echo paramEncrypt('status=forbidden')?>"</script><?php 
}
?>