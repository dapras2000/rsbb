<?php session_start();
$_SESSION['apotekrajal'] = $_REQUEST['rajal'];
$_SESSION['apt_type']	 = 'NOAPS';
include_once('include/fungsi.php');
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
			jQuery('#stock_obat_nr').val(data[4]);
			jQuery('#kode_obat_nr').val(data[1]);
			jQuery('#harga_obat_nr').val(data[2]);
		}else{
			jQuery('#sediaan_obat_nr').val('-');
			jQuery("#stock_obat_nr").val('');
			jQuery("#kode_obat_nr").val('');
			jQuery('#harga_obat_nr').val(0);
		}
		//alert('Stok obat '+jQuery('#stock_obat_nr').val()+', tidak mencukupi');
	});
	
	jQuery('#add_nonracikan').click(function(){
		var idx = jQuery('#txtIdxDaftar').val();
		//var idxobat = jQuery('#idxberiobat').val();
		var nm_barang = jQuery('#nm_barang').val();
		var aturan_nr = jQuery('#aturan_obat_nr').val();
		var aturan_text_nr = jQuery('#aturan_text_nr').val();
		var sediaan_nr = jQuery('#sediaan_obat_nr').val();
		var sediaan_text_nr = jQuery('#sediaan_text_nr').val();
		var perminttan_nr = jQuery('#jml_permintaan_nr').val();
		var dokter		= jQuery('#dokter_resep').val();
		var lapkemenkes = jQuery('#lapkemenkes').val();
		var laplain		= jQuery('#laplain').val();
		var kode_obat_nr= jQuery('#kode_obat_nr').val();//danang
		//alert('<?php echo _BASE_;?>apotek/save_obat_nonracikan_tmp_cartresep.php?kode_obat_nr='+kode_obat_nr);
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
		if(perminttan_nr > parseInt(jQuery('#stock_obat_nr').val())){
			alert('Stok obat '+jQuery('#stock_obat_nr').val()+', tidak mencukupi');
			return false;
		}
		jQuery.post('<?php echo _BASE_;?>apotek/save_obat_nonracikan_tmp_cartresep.php?kode_obat_nr='+kode_obat_nr.value,jQuery('#addnonracikan').serialize(),
			function(data){
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
			<fieldset class="fieldset" >
				<legend>Data Pasien</legend>
    			<?php
					$ip	= getRealIpAddr();
					mysql_query('delete from tmp_racikan_obat where IP = "'.$ip.'"');
					mysql_query('delete from tmp_cartresep where IP = "'.$ip.'"');
					
					$sql	= mysql_query('SELECT a.id_admission,a.nomr as NOMR,a.masukrs as TGLREG,a.nott,b.NAMA,b.TGLLAHIR,b.ALAMAT,c.NAMADOKTER as dokter,d.nama as poly, e.NAMA as carabayar, a.dokter_penanggungjawab as KDDOKTER, p.NAMA as NAMA_RESEP
								FROM t_admission a
								LEFT JOIN m_pasien b ON a.nomr = b.NOMR
								LEFT JOIN m_dokter c ON c.KDDOKTER = a.dokter_penanggungjawab
								LEFT JOIN m_ruang d ON d.no = a.noruang
								LEFT JOIN m_carabayar e ON e.KODE = a.statusbayar
								LEFT JOIN t_pemberianobat p ON p.IDXRANAP=a.id_admission
								WHERE a.nomr = "'.$_REQUEST['nomr'].'" and a.id_admission = "'.$_REQUEST['idx'].'"');
			
					$d = mysql_fetch_array($sql);
					extract($d);
					if($_SESSION['apotekrajal'] == 0){
						$sqldokter = mysql_query("SELECT DISTINCT NAMADOKTER, KDDOKTER as kddokter FROM m_dokter GROUP BY NAMADOKTER ORDER BY NAMADOKTER ASC");
					}
				?>
					<table border='0' width='100%'>
						<tr>
							<td width="35%" valign="top">
								<table width="100%" border="0" cellpadding="10px" cellspacing="0">
									<tr>
										<td>No MR</td>
										<td>: <?php echo $NOMR;?></td>
										
									</tr>
									<tr><td width="15%">Nama Pasien</td><td width="35%">: <?php echo $NAMA;?></td></tr>
									<tr><td>Umur</td><td>: <?php echo $a[years].' tahun '.$a[months].' bulan '.$a[days].' hari'; ?></td></tr>
									<tr><td valign="top">Alamat</td><td>: <?php echo $ALAMAT;?></td></tr>
									<tr><td valign="top">Dokter</td><td>: <span id="text_dokter_resep"></span><select name="dokter" id="dokter_set" class="text">
														<?php 
														while($row = mysql_fetch_array($sqldokter)){
															if($row['kddokter'] == $KDDOKTER): $sel = 'selected="selected"'; else: $sel = ''; endif;
															echo '<option value="'.$row['kddokter'].'" '.$sel.'>'.$row['NAMADOKTER'].'</option>';
														}
														?>
													</select>&nbsp;&nbsp;<input type="button" name="setdokter" value="Set Dokter" id="setdokter" class="text" />
													<?php # echo $dokter;?>
													<input type="hidden" name="dokter_resep" id="dokter_resep" value="" /></td></tr>
									<tr><td valign="top">Unit/Ruang</td><td>: <?php echo $poly;?>&nbsp;&nbsp;<?php echo $nott;?></td></tr>
									<tr><td valign="top">Tanggal</td><td>: <?php echo $TGLREG;?></td></tr>
									<tr><td valign="top">Cara Bayar</td><td>: <?php echo $carabayar;?></td></tr>
								</table>
							</td>
							<td valign="top">
									
									<td rowspan="8" align="left" valign="top">DIAGNOSA DAN TERAPI : <br>
        						<table width="70%" border="1" style="float:left;">
								<tr>
								    <th>Nama Obat</th>
								    <th>Status</th>
									<th>Tanggal</th>
									<th>Waktu</th>
		  						</tr>
		  						<?php
									$sql2 = mysql_query("SELECT a.id_admission,a.nomr as NOMR,a.masukrs as TGLREG,a.nott,p.NAMA as RESEP, p.IDXBERIOBAT,p.KODE_OBAT,p.WAKTU as waktu, p.status,p.TANGGAL as tgl
														FROM t_admission a
														LEFT JOIN t_pemberianobat p ON p.IDXRANAP=a.id_admission
														WHERE a.nomr = '".$_REQUEST['nomr']."' and a.id_admission = '".$_REQUEST['idx']."' and date_format (p.TANGGAL, '%Y-%m-%d H:i:s') = date(now()) order by p.TANGGAL desc");
					
									while($rsl = mysql_fetch_array($sql2)) {
									if($rsl['status']=="1"){
												$stat = "Keluar";
											}else{
												$stat = "";
											}
									if($rsl['waktu']=="1"){
												$wak = "Pagi";
										}else if($rsl['waktu']=="2") {
												$wak = "Siang";
											}else if($rsl['waktu']=="2") {
												$wak = "Sore";
											}else {
												$wak = "Malam";
											}
								?>
			 	 					<tr>
										<td><?php echo $rsl['RESEP']; ?></td>
										<td><?php echo $stat; ?></td>
										<td><?php echo $rsl['tgl']; ?></td>
										<td><?php echo $wak; ?></td>
									</tr>
									<? } ?>
								</table>
							</td>

							</td>
						</tr>
					</table>

					
			</fieldset>
			<fieldset class="fieldset">
	<legend>Data Obat Yang DI BELI<?php //echo $_REQUEST['noresep'];?></legend>
	<?php if ($rstitle<>"SIMRS GOS RSI BANYUBENING"){echo "Kode Program Belum Diverifikasi";}else{
	?>
	<?php if ($_REQUEST['noresep']<>''){ // danang ?>
    <table width="100%">
    	<tr><th>No</th><th>Nama Obat / Layanan</th><th>Harga Satuan</th><th>Qty</th><th>Subtotal</th></tr>
	<?php
	if($_REQUEST['rajal'] == 1){
		$sqls = mysql_query('SELECT a.*,
CASE SUBSTRING(kode_obat,1,3) WHEN  "07." THEN (SELECT b.nama_tindakan FROM m_tarif2012 b WHERE b.kode_tindakan = a.kode_obat)
ELSE (SELECT b.nama_barang FROM m_barang b WHERE b.kode_barang = a.kode_obat) END AS nama
FROM t_billobat_rajal a
where noresep = "'.$_REQUEST['noresep'].'"');
	}else{
		$sqls = mysql_query('SELECT a.*,
CASE SUBSTRING(kode_obat,1,3) WHEN  "07." THEN (SELECT b.nama_tindakan FROM m_tarif2012 b WHERE b.kode_tindakan = a.kode_obat)
ELSE (SELECT b.nama_barang FROM m_barang b WHERE b.kode_barang = a.kode_obat) END AS nama
FROM t_billobat_ranap a
where noresep = "'.$_REQUEST['noresep'].'"');
	}
	$i = 1;
	$total = 0;
	while($dsql = mysql_fetch_array($sqls)){
		if ($dsql['nama']==""){$nm="Obat Racikan";}else{$nm=$dsql['nama'];}
		$total = $total + ($dsql['harga'] * $dsql['qty']);
		echo '<tr><td>'.$i.'</td><td>'.$nm.'</td><td align="right">'.curformat($dsql['harga']).'</td><td align="center">'.$dsql['qty'].'</td><td align="right">'.curformat($dsql['harga'] * $dsql['qty']).'</td></tr>';
		$i++;
	}
	?>
    <tr><td colspan="4" align="center" style="border-top:1px solid #666;">Total</td><td align="right" style="border-top:1px solid #666;"><?php echo curformat($total); ?></td></tr>
    </table>
    <?php }
	} //end verifikasi
     //end danang?>
</fieldset>
			<fieldset class="fieldset">
				<legend>Add Item Obat </legend>

				<input type="hidden" name="kode_barang" id="kode_barang" />
				<input type="hidden" name="harga" id="harga" />
				<input type="hidden" name="unit" id="unit" value="<?php $KDPOLY;?>" />
				<input type="hidden" name="dokter" id="dokter" value="<?php $KDDOKTER;?>" />

				<table align="center" width="50%">
					<tr>
						<td>Jenis Pelayanan Apotek</td>
						<td><select name="jenis_pelayanan" id="jenis_pelayanan" class="text">
					    	<option value=""> -- Pilih Jenis Layanan -- </option>
					    	<?php 
							$sql_jespel = mysql_query('select * from m_tarif2012 where kode_lampiran = "07"');
							while($djespel = mysql_fetch_array($sql_jespel)){
								echo '<option value="'.$djespel['kode_tindakan'].'">'.$djespel['nama_tindakan'].'</option>';
							}
							?>
					    	</select></td>
					    <td>Qty Layanan&nbsp;<input type="text" name="qty_jenislayanan" id="qty_jenislayanan" size="5" class="text" /></td><td><input type="button" name="add" value="add" id="add_jenislayanan" class="text" /></td></tr>
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
					<tr>
						<td>Sediaan</td><td>
							<select name="sediaan" class="text" id="sediaan">
						        <option value="puyer" >puyer</option>
								<option value="sirup" >sirup</option>
						        <option value="salep" >salep</option>
						        <option value="kapsul" >kapsul</option>
							</select></td></tr>
					<tr>
						<td>Aturan Pakai</td>

					<!-- <td>
						
					</td> -->
						 <td>
						 <input type="text" name="aturan" class="text" id="aturan" >
							 <!-- <select name="aturan" class="text" id="aturan">
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
						  </select> &nbsp; &nbsp; <input type="text" name="aturan_text" value="" style="display:none;"  class="text" id="aturan_text" /> -->
						</td>
					</tr>
					<tr><td>Jumlah</td><td><input type="text" class="text" name="jml_permintaan" id="jml_permintaan" style="width:50px" /></td></tr>
					<tr><td colspan="2"><input type="button" value="Add Racikan" id="add_detail_racikan" class="text" /></td></tr>
				</table>
				</form>
				<form name="addnonracikan" id="addnonracikan" method="post">
					<input type="hidden" name="dokter_resep_nr" id="dokter_resep_nr" value="" />
					<input name="txtIdxDaftar_nr" id="txtIdxDaftar_nr" type="hidden" value=<?php echo $_REQUEST['idx']; ?> >
					<input type="text" name="kode_obat_nr" id="kode_obat_nr" />
					<input type="hidden" name="harga_obat_nr"  id="harga_obat_nr"/>
					<table width="40%" style="float:left;">
				<tr><th colspan="2"> Pelayanan Obat Non Racikan </th></tr>
				<tr><td>Nama Obat</td><td><input type="text" class="text" name="nm_barang" id="nm_barang" style="width:300px"/></td></tr>
				<tr><td>Sediaan</td><td>
					<select name="sediaan_obat_nr" class="text" id="sediaan_obat_nr">
					<?$mysql 	= mysql_query('SELECT distinct satuan FROM m_barang order by satuan');
					if(mysql_num_rows($mysql) > 0){
						while($dsql = mysql_fetch_array($mysql)){
							echo "<option value=\"".$dsql['satuan']."\" >".$dsql['satuan']."</option>";
						}
					}?>
					</select>&nbsp; &nbsp; <input type="text" name="sediaan_text_nr" value="qwerty" style="display:none;"  class="text" id="sediaan_text_nr" /></td></tr>
				<tr>
					<td>Aturan Pakai</td>
				 	<td>
						 <input type="text" name="aturan_obat_nr" class="text" id="aturan_obat_nr">
						 <!-- <select name="aturan_obat_nr" class="text" id="aturan_obat_nr">
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
				  </select>&nbsp; &nbsp; <input type="text" name="aturan_text_nr" value="" style="display:none;"  class="text" id="aturan_text_nr" /> -->
				</td>
				</tr>
				<tr><td>Jumlah</td><td><input type="text" class="text" name="jml_permintaan_nr" id="jml_permintaan_nr" style="width:50px" /><input type="hidden" name="stock_obat_nr"  id="stock_obat_nr"/></td></tr> 
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