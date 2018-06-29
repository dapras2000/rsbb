<?php
session_start();
include ('../../include/connect.php');
$modus  = isset($_POST['modus']) ? htmlspecialchars($_POST['modus']) : "";
$hideId  = isset($_POST['hideid']) ? htmlspecialchars($_POST['hideid']) : "";
$noakun  = isset($_POST['noakun']) ? htmlspecialchars($_POST['noakun']) : "";	
$nilai=isset($_POST['nilai']) ? htmlspecialchars($_POST['nilai'])	: "";	
$tahun=isset($_POST['tahun']) ? htmlspecialchars($_POST['tahun'])	: "";	 
require_once("tk_realisasi_anggaran.php");

$sql	= mysql_query('select * from tk_realisasi_anggaran where id = "'.$hideId.'" and MONTH('.$tahun.') and YEAR('.$tahun.')');
if(mysql_num_rows($sql) > 0){
	$data	= mysql_fetch_array($sql);
	mysql_query('update tk_realisasi_anggaran set nilai = "'.$nilai.'"where id = "'.$hideId.'" and MONTH('.$tahun.') and YEAR('.$tahun.')');
}else{
	mysql_query('insert into tk_realisasi_anggaran (id,tahun,nilai) values ("'.$hideId.'","'.$tahun.'","'.$nilai.'")');
}
/*
$objTKRLA = new tk_realisasi_anggaran();
$objTKRLA->db_host=$_SESSION['host'];
$objTKRLA->db_user=$_SESSION['user'];
$objTKRLA->db_pass=$_SESSION['psw'];
$objTKRLA->db_database=$_SESSION['db']; 	
if(!$objTKRLA->db_connect()) {
	echo "<h1>Sorry! Could not connect to the database server.</h1>";	
	exit();	
}	
if ($modus=='modify'){
	if ($objTKRLA->updateTKAkun(str_replace('_','.',$noakun),$tahun,$nilai)) {?>
		<script language="javascript">alert(<?php echo $hideId;?>);</script>	<?php echo 'ok';
	}
	else {
		echo $objTKRLA->strDBError;
	}
}
*/