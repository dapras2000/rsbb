<?php
include_once('../include/connect.php');
include_once('../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("RekapanPolyRawatJalan_xls2.php","RekapanPolyRawatJalan_xls.xls");
?>	


