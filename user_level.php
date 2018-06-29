<?php 
session_start();
include("include/connect.php");

$NIP1 		= $_SESSION['NIP'];
$sql		="SELECT * FROM m_login WHERE NIP = '".$NIP1."' AND PWD = '".$_REQUEST['PWD']."'"; 
$query 		= mysql_query($sql)or die(mysql_error());
if(mysql_num_rows($query) > 0){
	$data  		= mysql_fetch_assoc($query);
	$_SESSION['SES_REG'] = $data['SES_REG'];
	if($data['ROLES']=="100") {
		$_SESSION['ROLES']="100";
		header("location:index.php?link=page_pantri");
	}elseif($data['ROLES']=="1017") {
		$_SESSION['ROLES']="1017";
		header("location:index.php?link=private");
	}elseif($data['ROLES']=="1") {
		$_SESSION['ROLES']="1";
		header("location:index.php?link=2");
	}elseif($data['ROLES']=="2") {
		$_SESSION['ROLES']="2";
		header("location:index.php?link=3");
	}elseif($data['ROLES']=="4") {
		$_SESSION['ROLES']="4";
		header("location:index.php?link=5");
	}elseif($data['ROLES']=="5") {
		$_SESSION['ROLES']="5";
		header("location:index.php?link=6order");
	}elseif($data['ROLES']=="6") {
		$_SESSION['ROLES']="6";
		header("location:index.php?link=71");
	}elseif($data['ROLES']=="7") {
		$_SESSION['ROLES']="7";
		header("location:index.php?link=8");
	}elseif($data['ROLES']=="8") {
		$_SESSION['ROLES']="8";
		header("location:index.php?link=9");
	}elseif($data['ROLES']=="9") {
		$_SESSION['ROLES']="9";
		header("location:index.php?link=3");
	}elseif($data['ROLES']=="10") {
		$_SESSION['ROLES']="10";
		header("location:index.php?link=11");
	}elseif($data['ROLES']=="11") {
		$_SESSION['ROLES']="11";
		header("location:index.php?link=12");
	}elseif($data['ROLES']=="12") {
		$_SESSION['ROLES']="12";
		header("location:index.php?link=13");
	}elseif($data['ROLES']=="13") {
		$_SESSION['ROLES']="13";
		header("location:index.php?link=14_");
	}elseif($data['ROLES']=="14") {
		$_SESSION['ROLES']="14";
		header("location:index.php?link=15");
	}elseif($data['ROLES']=="15") {
		$_SESSION['ROLES']="15";
		header("location:index.php?link=16");
	}elseif($data['ROLES']=="14") {
		$_SESSION['ROLES']="14";
		header("location:index.php?link=15");
	}elseif($data['ROLES']=="15") {
		$_SESSION['ROLES']="15";
		header("location:index.php?link=16");		
	}elseif($data['ROLES']=="16") {
		$_SESSION['ROLES']="16";
		header("location:index.php?link=private21");
	}elseif($data['ROLES']=="17") {
		$_SESSION['ROLES']="17";
		header("location:index.php?link=17a");
	}elseif($data['ROLES']=="18") {
		$_SESSION['ROLES']="18";
		header("location:index.php?link=19");
	}elseif($data['ROLES']=="19") {
		$_SESSION['ROLES']="19";
		header("location:index.php?link=20");
	}elseif($data['ROLES']=="22") {
		$_SESSION['ROLES']="22";
		header("location:index.php?link=23");
	}elseif($data['ROLES']=="23") {
		$_SESSION['ROLES']="23";
		header("location:index.php?link=24k");
	}elseif($data['ROLES']=="24") {
		$_SESSION['ROLES']="24";
		header("location:index.php?link=jas1");
	}elseif($data['ROLES']=="25") {
		$_SESSION['ROLES']="25";
		header("location:index.php?link=jdoc");
	}elseif($data['ROLES']=="26") {
		$_SESSION['ROLES']="26";
		header("location:index.php?link=adminrajal");
	}elseif($data['ROLES']=="27") {
		$_SESSION['ROLES']="27";
		header("location:index.php");
		/*}elseif($data['ROLES']=="16"){
		$_SESSION['ROLES']="16";
		header("location:index.php?link=5");		
	}elseif($data['ROLES']=="17"){
		$_SESSION['ROLES']="17";
		header("location:index.php?link=5");		
	}elseif($data['ROLES']=="18"){
		$_SESSION['ROLES']="18";
		header("location:index.php?link=5");		
	}elseif($data['ROLES']=="19"){
		$_SESSION['ROLES']="19";
		header("location:index.php?link=5");*/		
	}else {
		echo"no roles";
	}

}else{
	header('location:login.php');
}

?>

