<?php
include_once('../include/connect.php');
include_once('../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("sensusharian_ugd_xls2.php","sensusharian_ugd_xls.xls");
?>
