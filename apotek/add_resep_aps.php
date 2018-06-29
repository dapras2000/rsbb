<?php session_start();
$_SESSION['apt_type']	= 'APS';
$_SESSION['apotekrajal'] = $_REQUEST['rajal']
?>
<script type='text/javascript' src='<?php echo _BASE_;?>js/facebox.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo _BASE_;?>css/facebox.css" />
<script>
jQuery(document).ready(function(){
	//alert(jQuery('#jenis_barang').val());
	jQuery('#nm_barang').autocomplete('<?php echo _BASE_; ?>apotek/autocomplete_obat.php',{
			width: 450,
			multiple: false,
			matchContains: true,
			extraParams: {
			   jenis: function() { return jQuery("#jenis_barang").val(); }
		   }
	}).result(function(event, data, formatted) {
		if(data){
			jQuery('#sediaan_obat_nr').val(data[3]);
			jQuery('#kode_obat_nr').val(data[1]);			
			jQuery('#harga_obat_nr').val(data[2]);	
		}else{
			jQuery('#sediaan_obat_nr').val('-');
			jQuery("#kode_obat_nr").val('');
			jQuery('#harga_obat_nr').val(0);	
		}
	});
	
	jQuery('#add_nonracikan').click(function(){
		var idx = jQuery('#txtIdxDaftar').val();
		var nm_barang = jQuery('#nm_barang').val();
		var aturan_nr = jQuery('#aturan_obat_nr').val();
		var aturan_text_nr = jQuery('#aturan_text_nr').val();
		var sediaan_nr = jQuery('#sediaan_obat_nr').val();
		var sediaan_text_nr = jQuery('#sediaan_text_nr').val();
		var perminttan_nr = jQuery('#jml_permintaan_nr').val();
		var dokter		= jQuery('#dokter_resep').val();
		var lapkemenkes = jQuery('#lapkemenkes').val();
		var laplain		= jQuery('#laplain').val();
		if(dokter == ''){
			alert('Dokter Pengirim Resep Belum diisi');
			return false;
		}
		if(nm_barang == ''){
			alert('Nama obat non-racikan belum diisi');
			return false;
		}
		if(sediaan_nr == '...'){
			if(sediaan_text_nr == ''){
				alert('Sediaan obat non-racikan belum diisi');
				return false;
			}
		}
		if(aturan_nr == '...'){
			if(aturan_text_nr == ''){
				alert('Aturan obat non-racikan belum diisi');
				return false;
			}
		}
		if(perminttan_nr == ''){
			alert('Permintaan obat non-racikan belum diisi');
			return false;
		}
		jQuery.post('<?php echo _BASE_;?>apotek/save_obat_nonracikan_tmp_cartresep.php',jQuery('#addnonracikan').serialize(),function(data){
			jQuery('#validbarang').load('<?php echo _BASE_;?>apotek/load_obat_tmp_cartresep.php?idxdaftar='+idx);
			jQuery('#nm_barang').val('');
			jQuery('#aturan_obat_nr').val('');
			jQuery('#sediaan_obat_nr').val('');
			jQuery('#jml_permintaan_nr').val('');
			jQuery('#aturan_text_nr').css('display','none').val('');
			jQuery('#sediaan_text_nr').css('display','none').val('');
		});
	});
	
	jQuery('#add_jenislayanan').click(function(){
		var id_jenis	= jQuery('#jenis_pelayanan').val();
		var idx			= jQuery('#txtIdxDaftar').val();
		var qty			= jQuery('#qty_jenislayanan').val();
		var dokter		= jQuery('#dokter_resep').val();
		if(dokter == ''){
			alert('Dokter Pengirim Resep Belum diisi');
			return false;
		}
		if(qty == ''){
			alert('Qty Layanan Belum diisi');
			return false;
		}
		if(id_jenis	== ''){
			alert('Jenis Layanan Belum diisi');
			return false;
		}
		jQuery.post('<?php echo _BASE_;?>apotek/save_jenislayanan_tmpcartresep.php',{id_jenis:id_jenis,idx:idx,qty:qty,dokter:dokter},function(data){
			jQuery('#validbarang').load('<?php echo _BASE_;?>apotek/load_obat_tmp_cartresep.php?idxdaftar='+idx);
		});
	});
	
	jQuery('#add_detail_racikan').click(function(){
		var qty 	= jQuery('#jml_permintaan').val();
		var aturan 	= jQuery('#aturan').val();
		var atext	= jQuery('#aturan_text').val();
		var dokter		= jQuery('#dokter_resep').val();
		if(dokter == ''){
			alert('Dokter Pengirim Resep Belum diisi');
			return false;
		}
		if(aturan == '...'){
			if(atext == ''){
				alert('Aturan pakai obat racikan belum diisi');
				return false;
			}
		}
		if(qty == ''){
			alert('Jumlah Permintaan Obat Racikan Belum diisi');
			return false;
		}
		
		jQuery.facebox.settings.overlay = 'false';
		jQuery.facebox(function() {
			jQuery.post('<?php echo _BASE_;?>apotek/form_add_obatracik.php',jQuery('#add_racikan').serialize(),function(data) {
				jQuery.facebox(data)
			})
		})
	});
	
	jQuery('#aturan').change(function(){
		var i	= jQuery(this).val();
		if(i == '...'){
			jQuery('#aturan_text').css({'display':'inline'});
		}else{
			jQuery('#aturan_text').css({'display':'none'});
		}
	});
	
	jQuery('#sediaan_obat_nr').change(function(){
		var i	= jQuery(this).val();
		if(i == '...'){
			jQuery('#sediaan_text_nr').css({'display':'inline'});
		}else{
			jQuery('#sediaan_text_nr').css({'display':'none'});
		}
	});
	jQuery('#aturan_obat_nr').change(function(){
		var i	= jQuery(this).val();
		if(i == '...'){
			jQuery('#aturan_text_nr').css({'display':'inline'});
		}else{
			jQuery('#aturan_text_nr').css({'display':'none'});
		}
	});
	jQuery('#setdokter').click(function(){
		var dokter = jQuery('#dokter_set').val();
		var nmdokter = jQuery('#dokter_set option[value="'+dokter+'"]').text();
		jQuery('#dokter_resep').val(dokter);
		jQuery('#dokter_resep_nr').val(dokter);
		jQuery('#text_dokter_resep').text(nmdokter);
		jQuery('#dokter_set').css('display','none');
		jQuery(this).css('display','none');
	});
});
</script>
<?php include '../include/function.php';?>
<div align="center">
    <div id="frame" style="width: 100%;">
        <div id="frame_title"><h3>PENGELUARAN RESEP</h3></div>
        <div align="left" style="margin:5px;">
<fieldset class="fieldset">
	<legend>Data Pasien</legend>
    <?php
		$ip	= getRealIpAddr();
		mysql_query('delete from tmp_racikan_obat where IP = "'.$ip.'"');
		mysql_query('delete from tmp_cartresep where IP = "'.$ip.'"');
		
		$sql	= 'SELECT a.NOMR, b.NAMA, b.ALAMAT, b.TGLLAHIR,a.KDCARABAYAR, a.IDXDAFTAR, c.NAMA AS carabayar
FROM t_pendaftaran_aps a 
JOIN m_pasien_aps b ON a.NOMR = b.NOMR 
JOIN m_carabayar c ON a.KDCARABAYAR = c.KODE
WHERE a.NOMR = "'.$_REQUEST['nomr'].'" and a.IDXDAFTAR = "'.$_REQUEST['idx'].'"';
		$sql	= mysql_query($sql);
		$d = mysql_fetch_array($sql);
		extract($d);
		$sqldokter = mysql_query("SELECT DISTINCT NAMADOKTER, KDDOKTER as kddokter FROM m_dokter GROUP BY NAMADOKTER ORDER BY NAMADOKTER ASC");
		?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td>No MR</td><td>: <?php echo $NOMR;?></td></tr>
<tr><td width="21%">Nama Pasien</td><td width="79%">: <?php echo $NAMA;?></td></tr>
<tr><td>Umur</td><td>: <?php echo $a[years].' tahun '.$a[months].' bulan '.$a[days].' hari'; ?></td><td>&nbsp;</td></tr>
<tr><td valign="top">Alamat</td><td>: <?php echo $ALAMAT;?></td></tr>
<tr><td valign="top">Dokter</td><td>: <span id="text_dokter_resep"></span><select name="dokter" id="dokter_set" class="text">
											<?php 
											while($row = mysql_fetch_array($sqldokter)){
//												if($row['kddokter'] == $KDDOKTER): $sel = 'selected="selected"'; else: $sel = ''; endif;
												echo '<option value="'.$row['kddokter'].'" '.$sel.'>'.$row['NAMADOKTER'].'</option>';
											}
											?>
										</select>&nbsp;&nbsp;<input type="button" name="setdokter" value="Set Dokter" id="setdokter" class="text" />
<?php # echo $dokter;?><input type="hidden" name="dokter_resep" id="dokter_resep" value="" /></td></tr>

<tr><td valign="top">Cara Bayar</td><td>: <?php echo $carabayar;?></td></tr>
</table>
</fieldset>
<fieldset class="fieldset">
<legend>Add Item Obat </legend>
<input type="hidden" name="kode_barang" id="kode_barang" />
<input type="hidden" name="harga" id="harga" />
<input type="hidden" name="unit" id="unit" value="<?php $KDPOLY;?>" />
<input type="hidden" name="dokter" id="dokter" value="<?php $KDDOKTER;?>" />

<table align="center" width="50%">
<tr><td>Jenis Pelayanan Apotek</td>
	<td><select name="jenis_pelayanan" id="jenis_pelayanan" class="text">
    	<option value=""> -- Pilih Jenis Layanan -- </option>
    	<?php 
		$sql_jespel = mysql_query('select * from m_tarif2012 where kode_lampiran = "07"');
		while($djespel = mysql_fetch_array($sql_jespel)){
			echo '<option value="'.$djespel['kode_tindakan'].'">'.$djespel['nama_tindakan'].'</option>';
		}
		?>
    	</select></td><td>Qty Layanan&nbsp;<input type="text" name="qty_jenislayanan" id="qty_jenislayanan" size="5" class="text" /></td><td><input type="button" name="add" value="add" id="add_jenislayanan" class="text" /></td></tr>
</table>
<br clear="all" />
<form name="addbarang" id="add_racikan" method="post">
<input name="txtIdxDaftar" id="txtIdxDaftar" type="hidden" value=<?php echo $_REQUEST['idx']; ?> >
<table width="40%" style="float:left;">
<tr><th colspan="2"> Pelayanan Obat Racikan </th></tr>
<tr><td width="150px;">Nama Obat Racikan</td><td>
<select name="nama_racikan" id="nama_racikan" class="text">
<?php 
$sqls = mysql_query('select * from m_barang where kode_barang like "R%" order by kode_barang'); 
while($rows = mysql_fetch_array($sqls)){
	echo '<option value="'.$rows['kode_barang'].'">'.$rows['nama_barang'].'</option>';
}
?>
</select>
<!--<input type="text" class="text" name="nama_racikan"  id="nama_racikan" style="width:150px"/>--></td></tr>
<tr><td>Sediaan</td><td>
	<select name="sediaan" class="text" id="sediaan">
        <option value="puyer" >puyer</option>
		<option value="sirup" >sirup</option>
        <option value="salep" >salep</option>
        <option value="kapsul" >kapsul</option>
	</select></td></tr>
<tr><td>Aturan Pakai</td>
 <td><select name="aturan" class="text" id="aturan">
     <option value="3 x 1 tablet" >3 x 1 tablet</option>
     <option value="3 x 1 sendok takar" >3 x 1 sendok takar</option>
     <option value="3 x 1 sendok makan" >3 x 1 sendok makan</option>
     <option value="3 x 0.1 ml" >3 x 0.1 ml</option>
     <option value="3 x 0.2 ml" >3 x 0.2 ml</option>
     <option value="3 x 0.3 ml" >3 x 0.3 ml</option>
     <option value="3 x 0.4 ml" >3 x 0.4 ml</option>
     <option value="3 x 0.5 ml" >3 x 0.5 ml</option>
     <option value="3 x 0.6 ml" >3 x 0.6 ml</option>
     <option value="3 x 0.7 ml" >3 x 0.7 ml</option>
     <option value="3 x 0.8 ml" >3 x 0.8 ml</option>
     <option value="3 x 0.9 ml" >3 x 0.9 ml</option>
     <option value="3 x 2 tetes" >3 x 2 tetes</option>
     <option value="..." >Lainnya</option>
  </select> &nbsp; &nbsp; <input type="text" name="aturan_text" value="" style="display:none;"  class="text" id="aturan_text" /></td>
</tr>
<tr><td>Jumlah</td><td><input type="text" class="text" name="jml_permintaan" id="jml_permintaan" style="width:50px" /></td></tr>
<tr><td colspan="2"><input type="button" value="Add Racikan" id="add_detail_racikan" class="text" /></td></tr>
</table>
</form>
<form name="addnonracikan" id="addnonracikan" method="post">
<input type="hidden" name="dokter_resep_nr" id="dokter_resep_nr" value="" />
<input name="txtIdxDaftar_nr" id="txtIdxDaftar_nr" type="hidden" value=<?php echo $_REQUEST['idx']; ?> >
<input type="hidden" name="kode_obat_nr" id="kode_obat_nr" />
<input type="hidden" name="harga_obat_nr"  id="harga_obat_nr"/>
<table width="40%" style="float:left;">
<tr><th colspan="2"> Pelayanan Obat Non Racikan </th></tr>
<tr><td>Nama Obat</td><td><input type="text" class="text" name="nm_barang"  id="nm_barang" style="width:300px"/></td></tr>
<tr><td>Sediaan</td><td>
	<select name="sediaan_obat_nr" class="text" id="sediaan_obat_nr">
	<?$mysql 	= mysql_query('SELECT distinct satuan FROM `m_barang` order by satuan');
	if(mysql_num_rows($mysql) > 0){
		while($dsql = mysql_fetch_array($mysql)){
			echo "<option value=\"".$dsql['satuan']."\" >".$dsql['satuan']."</option>";
		}
	}?>
	</select>&nbsp; &nbsp; <input type="text" name="sediaan_text_nr" value="" style="display:none;"  class="text" id="sediaan_text_nr" /></td></tr>
<tr><td>Aturan Pakai</td>
 <td><select name="aturan_obat_nr" class="text" id="aturan_obat_nr">
     <option value="3 x 1 tablet" >3 x 1 tablet</option>
     <option value="3 x 1 sendok takar" >3 x 1 sendok takar</option>
     <option value="3 x 1 sendok makan" >3 x 1 sendok makan</option>
     <option value="3 x 0.1 ml" >3 x 0.1 ml</option>
     <option value="3 x 0.2 ml" >3 x 0.2 ml</option>
     <option value="3 x 0.3 ml" >3 x 0.3 ml</option>
     <option value="3 x 0.4 ml" >3 x 0.4 ml</option>
     <option value="3 x 0.5 ml" >3 x 0.5 ml</option>
     <option value="3 x 0.6 ml" >3 x 0.6 ml</option>
     <option value="3 x 0.7 ml" >3 x 0.7 ml</option>
     <option value="3 x 0.8 ml" >3 x 0.8 ml</option>
     <option value="3 x 0.9 ml" >3 x 0.9 ml</option>
     <option value="3 x 2 tetes" >3 x 2 tetes</option>
     <option value="..." >Lainnya</option>
  </select>&nbsp; &nbsp; <input type="text" name="aturan_text_nr" value="" style="display:none;"  class="text" id="aturan_text_nr" /></td>
</tr>
<tr><td>Jumlah</td><td><input type="text" class="text" name="jml_permintaan_nr" id="jml_permintaan_nr" style="width:50px" /></td></tr> 
<tr><td>Lap. Kemenkes</td><td><input type="radio" name="lapkemenkes" value="Generik" checked="checked" />Generik <input type="radio" name="lapkemenkes" value="Non Generik" />Non Generik</td></tr> 
<tr><td>Lap. ......</td><td><input type="radio" name="laplain" value="Generik" checked="checked" />Generik <input type="radio" name="laplain" value="Non Generik" />Non Generik</td></tr> 
<tr><td colspan="2"><input type="button" value="add" id="add_nonracikan" class="text" /></td></tr>
</table>
</form>
</fieldset>
<div id="validbarang" ></div>

		</div>
    </div>
</div>