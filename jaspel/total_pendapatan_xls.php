<?php
include_once('../../../include/connect.php');
include_once('../../../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("total_pendapatan_xls2.php","total_pendapatan.xls");
?>	
	  