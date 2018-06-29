<?php
include_once('../../../include/connect.php');
include_once('../../../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("rekap_ranap_xls2.php","rekap_ranap.xls");
?>	

	  