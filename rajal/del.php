<?php 
session_start();
	if(!$_SESSION['SES_REG']){
	header("location:login.php");						  
	}

include("../include/connect.php");

if($_GET['idxterapi']){
	mysql_query("DELETE FROM t_diagnosadanterapi WHERE IDXTERAPI=".$_GET['idxterapi']);
	$psn='Data Telah Terhapus';
	header("Location:../index.php?pesan=$psn&menu=2&link=51&nomr=".$_GET['nomr']."&idx=".$_GET['idx']);
	}
?>