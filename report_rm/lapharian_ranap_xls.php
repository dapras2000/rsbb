<?php
include_once('../include/connect.php');
include_once('../include/function.php');
include_once('../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("lapharian_ranap_xls2.php","lapharian_ranap_xls.xls");
?>
