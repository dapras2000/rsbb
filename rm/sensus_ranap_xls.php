<?php
include_once('../include/connect.php');
include_once('../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("sensus_ranap_xls2.php","sensus_ranap_xls.xls");
?>	
