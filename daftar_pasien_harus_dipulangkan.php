<?php include 'include/connect.php'; ?>
<style>
h1{ font-size: 16px;}
#detail th{background:#09C; font-size:13px; color:#000; padding:3px;}
#detail td{font-size:13px; color:#000; padding:3px; border-bottom:1px solid #CCC;}
#detail td a{text-decoration:none;}
.text{border:1px solid #000; background:#CCC; cursor:pointer;}
.text:hover{border:1px solid #000; background:#FF9; cursor:pointer;}
</style>
<script src="js/jquery-1.7.min.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript">
	jQuery.noConflict();
</script>
<script>
jQuery(document).ready(function(){
	jQuery('.detail').click(function(){
		var links = jQuery(this).attr('link');
		window.close();
		if (window.opener && !window.opener.closed) {
			//window.opener.location.reload();
			window.opener.location='<?php echo _BASE_;?>'+links;
		}
	});
});
</script>
<?php
$sql = 'SELECT a.nomr, a.id_admission,a.masukrs, a.keluarrs,c.NAMA, d.nama as namaruang
FROM t_admission a
JOIN t_bayarranap b ON a.nomr = b.NOMR 
JOIN m_pasien c on c.nomr = a.nomr
JOIN m_ruang d on d.no = a.noruang
WHERE b.status = "LUNAS" AND a.keluarrs IS null
GROUP BY id_admission';
$sql		= mysql_query($sql);
if(mysql_num_rows($sql) > 0){
	$i = 1;
	echo '<h1> PASIEN HARUS DI PULANGKAN ( Sudah Lunas Pembayaran )</h1>';
	echo '<table style="width:100%;" id="detail">';
	echo '<tr><th style="width:20px;">No</th><th style="width:100px;">NOMR</th><th>Nama Pasien</th><th style="width:120px;">Ruang</th></tr>';
	while($d	= mysql_fetch_array($sql)){
		echo '<tr><td>'.$i.'</td><td>'.$d['nomr'].'</td><td>'.$d['NAMA'].'</td><td>'.$d['namaruang'].'</td><td><a href="#" link="index.php?link=121&id_admission=214004" class="detail"></tr>';
		$i++;
	};
	echo '</table>';
	echo '<input type="button" value="close" class="text" onClick="window.close();">';
}
?>
