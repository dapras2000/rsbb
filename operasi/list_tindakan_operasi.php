<?php
include '../include/connect.php';
include '../include/function.php';
?>
<script>
jQuery(document).ready(function(){
	jQuery('.batal').click(function(){
		var idxbayar	= jQuery(this).attr('id');
		jQuery.post('<?php echo _BASE_;?>operasi/cancel_tindakan_operasi.php',{idxbayar:idxbayar},function(data){
			jQuery('#listordersss').load('<?php echo _BASE_;?>operasi/list_tindakan_operasi.php');
		});
	});
	
	jQuery('#simpan').click(function(){
		var idoperasi = jQuery('#id_operasi').val();
		var tgl	= jQuery(this).attr('tanggal');
		jQuery.post('<?php echo _BASE_;?>operasi/simpancart_tindakan_operasi.php',jQuery('#order_lab').serialize(),function(data){
			if(!data){
				window.location ='<?php echo _BASE_;?>index.php?link=209&idoperasi='+idoperasi+'&tanggal='+tgl;
			}
		});
	});
});
</script>

<?php
$sqlsss 	= 'SELECT a.nomr, b.NAMA, b.ALAMAT, b.TGLLAHIR,b.JENISKELAMIN, d.nama as nama_ruang, c.nott, a.tanggal as tgl_operasi,a.id_operasi, c.noruang, c.statusbayar as carabayar, a.IDXDAFTAR as idxdaftar
FROM t_operasi a 
JOIN m_pasien b ON b.NOMR = a.nomr 
JOIN t_admission c ON c.id_admission = a.IDXDAFTAR
JOIN m_ruang d ON d.no = c.noruang
			where a.nomr = "'.$_REQUEST['nomr'].'" and a.IDXDAFTAR = "'.$_REQUEST['idx'].'"';
$sqlsss	= mysql_query($sqlsss);
			$d	 = mysql_fetch_array($sqlsss);
			?>
            <form id="order_lab">
       		<input type="hidden" name="id_operasi" id="id_operasi" value="<?php echo $d['id_operasi'];?>"/>
            <input type="hidden" name="ruang" id="ruang" value="<?php echo $d['noruang'];?>"/>
            <input type="hidden" name="nott" id="nott" value="<?php echo $d['nott'];?>"/>
            <input type="hidden" name="nomr" id="nomr" value="<?php echo $d['nomr'];?>" />
            <input type="hidden" name="idxdaftar" id="idxdaftar" value="<?php echo $d['idxdaftar'];?>" />
            <input type="hidden" name="carabayar" id="carabayar" value="<?php echo $d['carabayar'];?>" />
            </form>
            <?php
$id	= $_REQUEST['id'];
$ip	= getRealIpAddr();
$sql23	= 'select a.*, b.nama_tindakan from tmp_cartbayar a join m_tarif2012 b on b.kode_tindakan = a.KODETARIF where a.IP = "'.$ip.'"';
$sql23 = mysql_query($sql23);
if(mysql_num_rows($sql23) > 0){
		$t	= 0;
		echo '<table style="width:100%;">';
		echo '<tr><th>Nama Pemeriksaan</th><th>Qty</th><th>Tarif</th><th>Aksi</th></tr>';
		while($datas = mysql_fetch_array($sql23)){
			$t = $t + $datas['TARIF'] * $datas['QTY'];
			echo '<tr><td>'.$datas['nama_tindakan'].'</td><td>'.$datas['QTY'].'</td><td align="right">'.curformat($datas['TARIF']).'</td><td><span class="batal text" id="'.$datas['IDXBAYAR'].'">Batal</span></td></tr>';													
		}
		echo '<tr><td colspan="2" style="border-top:1px solid #000; text-align:center;">Total</td><td style="border-top:1px solid #000; text-align:right;">'.curformat($t).'</td><td></td></tr>';
		echo '<tr><td colspan="4" style="border-top:1px solid #000; text-align:center;"><input type="button" tanggal="'.$d['tgl_operasi'].'" name="simpan" value="S I M P A N" id="simpan" class="text" /></td></tr>';
		echo '</table>';
};
