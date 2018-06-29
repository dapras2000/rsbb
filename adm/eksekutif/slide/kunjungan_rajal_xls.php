<?php
include_once('../../../include/connect.php');
include_once('../../../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("kunjungan_rajal_xls2.php","kunjungan_rajal.xls");
?>		

