<?php
include_once('../include/connect.php');
include_once('../ExportToExcel.class.php');
$exp=new ExportToExcel();
$exp->exportWithPage("RekapanPendaftaranRajal_xls2.php","RekapanPendaftaranRajal_xls.xls");
?>	

