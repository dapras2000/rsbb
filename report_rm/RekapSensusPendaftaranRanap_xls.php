<?php
include_once('../include/connect.php');
include_once('../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("RekapSensusPendaftaranRanap_xls2.php","RekapSensusPendaftaranRanap_xls.xls");
?>	


