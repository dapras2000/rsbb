<?php
include_once('../../include/connect.php');
include_once('../../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("pendapatan_pertindakan_xls2.php","pendapatan_pertindakan.xls");
?>	
