<?  require_once("../../include/connect.php");
 if(!empty($_GET['paket'])){   
	$paket=$_GET['paket'];
	
	if($paket=="1"){
	  include("order_lab_1.php");
	
	}else if($paket=="2"){
	  include("order_lab_2.php");
	
	}else if($paket=="3"){
	  include("order_lab_3.php"); 
	}
 }
?>