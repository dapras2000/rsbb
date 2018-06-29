<?php
include_once('../../../include/connect.php');
include_once('../../../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("gizi_carabayar_xls2.php","gizi_carabayar.xls");
?>	
	
