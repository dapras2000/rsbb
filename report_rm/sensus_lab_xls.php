<?php 
include_once('../include/connect.php');
include_once('../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("sensus_lab_xls2.php","sensus_lab.xls");
?>
