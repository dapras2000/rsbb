<?php
include_once('../../../include/connect.php');
include_once('../../../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("carabayar_rajal_xls2.php","carabayar_rajal.xls");
?>