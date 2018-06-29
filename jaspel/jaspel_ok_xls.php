<?php
include_once('../include/connect.php');
include_once('../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("jaspel_ok_xls2.php","jaspel_ok.xls");
?>	


