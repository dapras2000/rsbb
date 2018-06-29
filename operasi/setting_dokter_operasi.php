<?php
$sql_operasi = 'SELECT a.id_operasi, a.nomr, a.jammulai, a.tanggal, a.IDXDAFTAR, a.DRPENGIRIM, 
b.NAMA, b.ALAMAT, b.JENISKELAMIN, b.TGLLAHIR,a.diagnosa
FROM t_operasi a
JOIN m_pasien b ON b.nomr = a.nomr
where id_operasi = '.$_REQUEST['idoperasi'];
$get_operasi = mysql_query($sql_operasi);		 
$dat_operasi = mysql_fetch_array($get_operasi);
#echo '<pre>';print_r($dat_operasi);echo'</pre>';
?>

<div align="center">
  <div id="frame" style="width:100%;">
  <div id="frame_title"><h3 align="left">Form Daftar Operasi</h3></div>
<script language="JavaScript" type="text/JavaScript">
 
function showKab()
{
if (document.daftar.jenisanastesi.value == "UMUM")
   {
     document.getElementById('metodeanastesi').innerHTML="<option value='IV' <? if($dat_operasi['metodeanastesi']=="IV") echo "selected=selected"; ?> >IV</option><option value='SUNGKUP MUKA' <? if($dat_operasi['metodeanastesi']=="SUNGKUP MUKA") echo "selected=selected"; ?> >SUNGKUP MUKA</option><option value='ETT/LMA' <? if($dat_operasi['metodeanastesi']=="ETT/LMA") echo "selected=selected"; ?> >ETT/LMA</option>";
   }
else if (document.daftar.jenisanastesi.value == "REGIONAL")
   {
     document.getElementById('metodeanastesi').innerHTML="<option value='SPINAL' <? if($dat_operasi['metodeanastesi']=="SPINAL") echo "selected=selected"; ?> >SPINAL</option><option value='EPIDURAL' <? if($dat_operasi['metodeanastesi']=="EPIDURAL") echo "selected=selected"; ?> >EPIDURAL</option>";
   }
else if (document.daftar.jenisanastesi.value == "BLOG PERIFER")
   {
     document.getElementById('metodeanastesi').innerHTML="<option value='BRAKHIAL' <? if($dat_operasi['metodeanastesi']=="BRAKHIAL") echo "selected=selected"; ?> >BRAKHIAL</option><option value='AKSILAR' <? if($dat_operasi['metodeanastesi']=="AKSILAR") echo "selected=selected"; ?> >AKSILAR</option><option value='FEMORAL' <? if($dat_operasi['metodeanastesi']=="FEMORAL") echo "selected=selected"; ?> >FEMORAL</option><option value='LAIN-LAIN' <? if($dat_operasi['metodeanastesi']=="LAIN-LAIN") echo "selected=selected"; ?> >LAIN-LAIN</option>";
   }
else if (document.daftar.jenisanastesi.value == "LOKAL")
   {
     document.getElementById('metodeanastesi').innerHTML="<option value='NULL' <? if($dat_operasi['metodeanastesi']=="NULL") echo "selected=selected"; ?> >TIDAK ADA</option>";
   }

   
}
jQuery(document).ready(function(){
	jQuery("#daftar").validate();
});
</script>
<style>
input.error{border:2px solid #F00;}
</style>

<form action="operasi/save_dokter_operasi.php" name="daftar" id="daftar" method="post">
<input type="hidden" name="idorder" value="<?php echo $dat_operasi['id_operasi']; ?>" />
<input type="hidden" name="orderadmission" value="0" />
<table width="95%" class="tb" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="221">NOMR</td>
		<td width="266"><?php echo $dat_operasi['nomr']; ?></td>
		<td width="131">&nbsp;</td>
		<td width="404">&nbsp;</td>
	</tr>
	<tr>
		<td>Nama Pasien</td>
		<td colspan="3"><?php echo $dat_operasi['NAMA']?></td>
  </tr>
  <tr>
		<td>Alamat</td>
		<td colspan="3"><?php echo $dat_operasi['ALAMAT']?></td>
  </tr>
  <tr>
		<td>Jenis Kelamin</td>
		<td colspan="3"><? if($dat_operasi['JENISKELAMIN']=="L") { echo "Laki-laki"; }else{ echo "Perempuan"; }?></td>
  </tr>
  <tr>
		<td>Umur</td>
		<td colspan="3"><?php $a = datediff($dat_operasi['TGLLAHIR'],$dat_operasi['tanggal']); echo $a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td>
  </tr>
  <tr>
		<td>Tanggal Operasi</td>
		<td colspan="3"><?php echo $dat_operasi['tanggal']?></td>
  </tr>
  <tr>
		<td>Jam Mulai Operasi</td>
		<td colspan ="3"><?php echo $dat_operasi['jammulai']?></td>
  </tr>
  <tr>
		<td>Diagnosa</td>
		<td colspan="3"><label><?=$dat_operasi['diagnosa']?></td>
  </tr>
  <!--
  <tr>
    <td>Jenis Operasi</td>
    <td colspan="3"><input type="radio" name="cito" value="c" <?php if($dat_operasi['JNSOPERASI'] == "c"): echo 'checked="checked"'; endif; ?> />Cito 
    				<input type="radio" name="cito" value="e" <?php if($dat_operasi['JNSOPERASI'] != "c"): echo 'checked="checked"'; endif; ?> />Elektif</tr>
	-->
	<tr>
		<td>Jenis Anastesi</td>
		<td colspan="3">
		<select class="text" name="jenisanastesi" id="jenisanastesi" onchange="showKab()">
			<option value="0">PILIH JENIS ANASTESI</option>
			<option value="UMUM" <? if($dat_operasi['jenisanastesi']=="UMUM") echo "selected=selected"; ?> >UMUM</option>
			<option value="REGIONAL" <? if($dat_operasi['jenisanastesi']=="REGIONAL") echo "selected=selected"; ?> >REGIONAL</option>
			<option value="BLOG PERIFER" <? if($dat_operasi['jenisanastesi']=="BLOG PERIFER") echo "selected=selected"; ?> >BLOG PERIFER</option>
			<option value="LOKAL" <? if($dat_operasi['jenisanastesi']=="LOKAL") echo "selected=selected"; ?> >LOKAL</option>
		</select>
		</td></tr>
	<tr>
		<td>Metode Anastesi</td>
		<td  colspan="3"><select name="metodeanastesi" id="metodeanastesi" class="text"></select></td></tr>
	<tr>
		<td colspan="4">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
			<td>Dokter Operator</td>
			<td><select class="text" name="dokteroperator" id="dokteroperator">
				<option value=""> Pilih Dokter Operator </option>
				<?php
					$q	= "SELECT a.kddokter, b.NAMADOKTER FROM m_dokter_jaga a 
JOIN m_dokter b ON a.kddokter = b.kddokter
WHERE a.kdpoly = 4 ORDER BY NAMADOKTER ASC";
					$h	= mysql_query($q);
					while($b=mysql_fetch_array($h)){
						if($dat_operasi['kode_dokteroperator'] == $b['kddokter']): $sel_operator = 'selected="selected"'; else: $sel_operator = ''; endif;
						echo '<option value="'.$b['kddokter'].'" '.$sel_operator.'>'.$b['NAMADOKTER'].'</option>';
					}
					?>
				</select>
			</td>
			<td>Asisten Operator </td>
			<td><input name="asistenoperator" class="text" type="text" id="asistenoperator" value="<?=$dat_operasi['asistenoperator']?>" /></td>
			<td>Perawat Instrumen </td>
			<td><input name="perawatinstrumen" class="text" type="text" id="perawatinstrumen" value="<?=$dat_operasi['perawatinstrumen']?>" /></td>
        </tr>
        <tr>
			<td>Dokter Anastesi</td>
			<td><select class="text" name="dokteranastesi" id="dokteranastesi">
				<option value=""> Pilih Dokter Anastesi </option>
			<?php
				$q1	= "SELECT a.kddokter, b.NAMADOKTER FROM m_dokter_jaga a 
JOIN m_dokter b ON a.kddokter = b.kddokter
WHERE a.kdpoly = 8 ORDER BY NAMADOKTER ASC";
				$h1	= mysql_query($q1);
				while($b1=mysql_fetch_array($h1)){
					if($dat_operasi['kode_dokteranastesi'] == $b1['kddokter']): $sel_anastesi = 'selected="selected"'; else: $sel_anastesi = ''; endif;
					echo '<option value="'.$b1['kddokter'].'" '.$sel_anastesi.'>'.$b1['NAMADOKTER'].'</option>';
				}
				?>
				</select>
			</td>
			<td>Asisten Anastesi</td>
			<td><input name="asistenanastesi" class="text" type="text" id="asistenanastesi" value="<?=$dat_operasi['asistenanastesi']?>" /></td>
			<td>Perawat Sirkuler</td>
			<td><input name="perawatsirkuler" class="text" type="text" id="perawatsirkuler" value="<?=$dat_operasi['perawatsirkuler']?>" /></td>
        </tr>
        <tr>
			<td>Dokter Anak</td>
			<td><select class="text" name="dokteranak" id="dokteranak">
				<option value="" >Pilih Dokter Anak </option>
				<?php
				$q2	= "SELECT a.kddokter, b.NAMADOKTER FROM m_dokter_jaga a 
JOIN m_dokter b ON a.kddokter = b.kddokter
WHERE a.kdpoly = 3 ORDER BY NAMADOKTER ASC";
				$h2	= mysql_query($q2);
				while($b2=mysql_fetch_array($h2)){
					if($dat_operasi['kode_dokteranak'] == $b2['kddokter']): $sel_dokanak = 'selected="selected"'; else: $sel_dokanak = ''; endif;
					echo '<option value="'.$b2['kddokter'].'" '.$sel_dokanak.'>'.$b2['NAMADOKTER'].'</option>';
				}
				?>
				</select>
			</td>
			<td>Asisten Anak</td>
			<td><input name="asistenanak" class="text" type="text" id="asistenanak" value="<?=$dat_operasi['asistenanak']?>" /></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
        </tr>
		</table>
		
		</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input type="submit" name="Submit" id="Submit" class="text" value="DAFTAR OPERASI" />
    </label></td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</form>
</div>
</div>
<?
if($_GET['psn']=='sukses')
{
?>
<script language="javascript">
alert('ORDER DATA PASIEN TELAH TERSIMPAN!');
</script>
<?
}else {echo '';}
?>