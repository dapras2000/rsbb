<?php session_start();
include_once('../include/connect.php');
include_once('../include/function.php');
include_once('../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("sensusranap_harianpasienkeluar_xls2.php","sensusranap_harianpasienkeluar_xls.xls");
?>
