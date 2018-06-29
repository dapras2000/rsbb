<?php
include 'include/connect.php';
include 'include/function.php';
?>
<html>
<head>
</head>
<style type="text/css">
#popup-windows {font-size:10px; font-family:Verdana,Geneva,sans-serif;}
.popup-table{ border:1px solid #999; border-collapse:0px; border-spacing:0px;}
.popup-table th{background:#069; padding:3px; font-size:11px; color:#FFF; font-weight:bold;}
.popup-table td{padding:3px; font-size:11px;}
.add, .batal, .simpan{cursor:pointer; border:1px solid #000; padding:2px 3px; background:#FF6; font-size:10px;}
.popup-table tr.footer td{border-top:1px solid #666; font-weight:bold;}
.selectbox{ font-size:10px;}
</style>
<body>
<script src="js/jquery-1.7.min.js" language="JavaScript" type="text/javascript"></script>
<script src="js/jqclock_201.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript">
	jQuery.noConflict();
</script>
<script>
jQuery(document).ready(function(){
	jQuery('.add').click(function(){
		var id 	= jQuery(this).attr('id');
		var nomr= jQuery(this).attr('svn');
		var kode= jQuery(this).attr('kode');
		var poly= jQuery(this).attr('poly');
		jQuery.post('<?php echo _BASE_;?>cartbill_save_tmp.php',{id:id,nomr:nomr,kode:kode,poly:poly},function(data){
			jQuery('#load_tmp_cartbayar').load('<?php echo _BASE_;?>tmp_cartbayar.php');
		});
	});
	jQuery('#load_tmp_cartbayar').load('<?php echo _BASE_;?>tmp_cartbayar.php');
});
</script>
<div id="popup-windows">
<form id="form-popup">
<table width="600px" border="0" cellpadding="0" cellspacing="0" class="popup-table" style="float:left;" >
<tr>
    <th style="width:20px;">No</th>
    <th>Jenis Tindakan</th>
    <th></th>
    <th style="width:120px;">Tarif</th>
    <th style="width:70px;">Pilih</th>
</tr>
<?php
	$sql = mysql_query('SELECT a.KODETARIF,t.nama_tindakan,a.KDPOLY,a.TANGGAL,a.SHIFT,a.KDDOKTER,d.NAMADOKTER,a.QTY,a.TARIFRS
FROM t_billrajal a 
INNER JOIN m_tarif2012 t ON t.kode_tindakan = a.KODETARIF
LEFT JOIN m_dokter d ON d.KDDOKTER = a.KDDOKTER 
WHERE nomr = "'.$_REQUEST['nomr'].'" AND idxdaftar = "'.$_REQUEST['idx'].'"');
	if(mysql_num_rows($sql) > 0):
		$i = 1;
		while($data = mysql_fetch_array($sql)){
			echo'
			<tr>
				<td style="widtd:20px;">'.$i.'</td>
				<td>'.$data['nama_tindakan'].'</td>
				<td></td>
				<td style="widtd:120px; text-align:right;">Rp. '.curformat($data['tarif']).'</td>
				<td style="widtd:70px;"><input type="button" value="add" id="'.$data['kode_tindakan'].'" svn="'.$_REQUEST['nomr'].'" kode="'.$data['kode_tindakan'].'" class="add" poly="'.$_REQUEST['poly'].'"></td>
			</tr>
			';
			$i++;
		}
	else:
		echo 'Tidak ada tindakan poly';
	endif;
?>
</table>
<div id="load_tmp_cartbayar" style="width:340px; float:right;">
</div>
<br clear="all">
</form>
</div>
</body>
</html>