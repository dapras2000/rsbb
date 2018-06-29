<?php
include '../include/connect.php';
?>
<script>
jQuery(document).ready(function(){
	jQuery('.footer').empty().append('<input type="button" name="close" id="close" class="button text" value="Close" />');
	jQuery('#close').click(function(){
		jQuery(this).trigger('close.facebox');
	});

	/*jQuery('#simpan_permintaan_obat_racik').click(function(){
		jQuery.post('<?php echo _BASE_;?>apotek/save_permintaan_obat_racik.php',jQuery('#save_obat_racikan').serialize(),function(data){
			//alert("data berhasil disimpan");
		});
		//jQuery(this).trigger('close.facebox');
	});*/
});
</script>

<h1> Form Detail Proses Obat Racikan</h1>
<br />
<hr />
<br />
<!--<form id="save_obat_racikan">-->

<table width="700px">
	<tr>
        <th width="300px">Nama Racikan</th>
        <th width="80px">Jumlah Pesan</th>
		<th width="80px">Stok Unit</th>
		<th align='center' width='100px'>Jmlh Didisetujui</th>
		<th width="100px">Status</th>
		<th width="80px">Option</th>
	</tr>
	<?php
        $sqlr = "SELECT *,b.farmasi,a.koderacik,
		(SELECT saldo FROM t_barang_stok WHERE kode_barang = a.kode_obat AND KDUNIT = 14 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR2
            FROM t_permintaan_apotek_rajal_racikan a
			JOIN m_barang b ON a.kode_obat=b.kode_barang
            JOIN t_permintaan_apotek_rajal c ON a.idxpesanobat=c.idxpesanobat
            WHERE a.idxpesanobat=$_REQUEST[idxpesanobat] and b.farmasi='1' and a.no=c.no ";
        $rowor = mysql_query($sqlr)or die(mysql_error());
        while ( $datar = mysql_fetch_array($rowor)) {
        	$idx_urut='jml'.$datar['idxracik'];
    ?>
	<tr>
		<td><?= $datar['nama_barang'];?></td>
		<td><?= $datar['jumlah']; ?></td>
		<td><?= $datar['STOKAKHIR2']; ?></td>
		<td align="center">
			<input type="text" class="text" name="jml<?php echo $idx_urut;?>" id="jml<?php echo $idx_urut;?>" style="width:30px"/>
		</td>
		<td><div id="div2<?=$datar['idxracik']?>" ></div></td>
        <td align="center">
        	<a href="#" onclick="javascript: MyAjaxRequest('div2<?=$datar['idxracik']?>','apotek/save_permintaan_obat_racik.php?koderacik=<?= $datar['koderacik'];?>&idxracik=<?=$datar['idxracik']?>&amp;opt=4&amp;jml_pesan=<?= $datar['jumlah']; ?>&amp;jml=' + document.getElementById('jml<?php echo $idx_urut;?>').value); return false;" >Setujui</a>
			<br>--------<br><a href="#" onclick="javascript: MyAjaxRequest('div2<?=$datar['idxracik']?>','apotek/save_permintaan_obat_racik.php?idxracik=<?=$datar['idxracik']?>&amp;opt=5'); return false;" >Tidak Disetujui</a>
        </td>
	</tr>
	<?php } ?>
	<tr>
		<td colspan="6" align="center">
			<a href="<?php echo _BASE_;?>apotek/save_permintaan_obat_racik.php?no=<?php echo $_REQUEST['no']; ?>&idxpesanobat=<?php echo $_REQUEST['idxpesanobat']; ?>" >
				<input type="button" name="simpan" value="Simpan" id="simpan_permintaan_obat_racik" class="text" />
			</a>
		</td>
	</tr>
</table>

<!--</form>-->
<br />
<hr />
<br />
<div id="table_list_racikan"></div>