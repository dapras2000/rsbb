<html>
<head>
</head>
<style type="text/css">
#popup-windows {font-size:11px; font-family:Verdana,Geneva,sans-serif;}
.popup-table{ border:1px solid #999; border-collapse:0px; border-spacing:0px;}
.popup-table th{background:#069; padding:3px; font-size:11px; color:#FFF; font-weight:bold;}
.popup-table td{padding:3px; font-size:11px;}
.add, .batal, .simpan{cursor:pointer; border:1px solid #000; padding:2px 3px; background:#FF6; font-size:10px;}
.popup-table tr.footer td{border-top:1px solid #666; font-weight:bold;}
.selectbox{ font-size:10px;}
.text { border:1px solid #000; font-size:11px;}
.text:focus { background:#FF6;}
</style>
<body>
<script src="js/jquery-1.7.min.js" language="JavaScript" type="text/javascript"></script>
<script src="js/jqclock_201.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript">
	jQuery.noConflict();
</script>
<div id="popup-windows">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="popup-table" style="float:left;" >
<tr><th>No</th><th>NOMR</th><th>Nama Pasien</th><th>Nama Tindakan</th><th>Keterangan Lain Lain</th><th>Total Billing</th></tr>
<?php
include '../../../include/connect.php';
include '../../../include/function.php';
$sql	= mysql_query('SELECT a.NOMR,b.KETBAYAR, c.NAMA,a.TOTTARIFRS, d.QTY, d.TARIFRS, d.KODETARIF, e.nama_tindakan
					  FROM t_bayarrajal a
					  INNER JOIN t_pendaftaran b ON a.IDXDAFTAR = b.IDXDAFTAR
					  INNER JOIN m_pasien c ON c.NOMR = b.NOMR
					  JOIN t_billrajal d on d.NOBILL = a.NOBILL
					  JOIN m_tarif2012 e on e.kode_tindakan = d.KODETARIF
					  WHERE a.TGLBAYAR = "'.$_REQUEST['tgl'].'" AND a.CARABAYAR = 5 AND a.STATUS="LUNAS"
AND ( d.KODETARIF LIKE "01.%" OR d.KODETARIF LIKE "02.%" OR d.KODETARIF LIKE "05.%")');
if(mysql_num_rows($sql) > 0){
	$i = 1;
	while($d	= mysql_fetch_array($sql)){
	echo '<tr><td>'.$i.'</td><td>'.$d['NOMR'].'</td><td>'.$d['NAMA'].'</td><td>'.$d['nama_tindakan'].'</td><td>'.$d['KETBAYAR'].'</td><td align="right">'.curformat($d['QTY'] * $d['TARIFRS']).'</td></tr>';
	$i++;
	}
}
?>
</table>
</div>
</body>
</html>