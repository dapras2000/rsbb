<?php
include_once('../../../include/connect.php');
include_once('../../../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("ok_carabayar_xls2.php","ok_carabayar.xls");
?>	
	
