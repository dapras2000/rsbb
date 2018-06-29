<?php
include_once('../../../include/connect.php');
include_once('../../../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("pendapatan_rajal_xls2.php","pendapatan_rajal.xls");
?>	

	