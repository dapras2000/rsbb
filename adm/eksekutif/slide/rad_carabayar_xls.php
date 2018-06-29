<?php
include_once('../../../include/connect.php');
include_once('../../../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("rad_carabayar_xls2.php","rad_carabayar.xls");
?>	
	