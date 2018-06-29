<?php
include_once('../../../include/connect.php');
include_once('../../../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("apotek_carabayar_xls2.php","apotek_carabayar.xls");
?>	
	
