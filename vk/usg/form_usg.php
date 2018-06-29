<?
include("../../include/connect.php");
$sql_usg = "SELECT t_usg.idx, t_usg.tanggal_periksa, t_usg.hasil_periksa,
  				t_usg.kd_dokter, t_usg.KDUNIT, t_usg.JNS_ELEKTROMEDIK, m_dokter.NAMADOKTER, t_usg.QTY
			FROM t_usg
  			INNER JOIN m_dokter ON (t_usg.kd_dokter = m_dokter.KDDOKTER)
			WHERE t_usg.idxdaftar = ".$_GET['idx'];
$get_usg = mysql_query($sql_usg);

?>
<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>FORM USG</h3></div>
<form id="formperiksaradiologi" name="formperiksaradiologi" method="post" action="vk/usg/save_usg.php">
  <table width="700" border="0" cellspacing="0" cellpadding="2" align="center" class="tb">
    <tr>
      <td width="111">&nbsp;</td>
      <td colspan="3"><? if($_GET['psn'] !=''){echo $psn;}?></td>
    </tr>
    <tr valign="top">
      <td>Dokter</td>
      <td colspan="3"><? 
	  	$sqlx = "select a.kdpoly, a.kddokter, b.NAMADOKTER from m_dokter_jaga a join m_dokter b ON a.kddokter = b.KDDOKTER where a.kdpoly =".$_SESSION['KDUNIT'];
		$getx = mysql_query($sqlx);
		
			echo "<select class='text' name='dokter' id='dokter".$data['kode']."'>";
			while($datax =  mysql_fetch_array($getx)){
			echo "<option value='".$datax['kddokter']."' ";		
			echo ">".$datax['NAMADOKTER']."</option>";
			}
			echo "</select>";
	  ?></td>
    </tr>
    <tr valign="top">
      <td colspan="4">
  </td>
    </tr>
    <tr>
      <td colspan="4">Pemeriksaan</td>
      
    </tr>
    <!--
    <tr>
      <td>Pemeriksaan</td>
      <td width="92"><input type="checkbox name="USG" value="USG" />&nbsp;USG</td>
      <td width="65"><input type="text" name="USG_qty" style="width:50px" class="text" /></td>
      <td width="416">Kali</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="checkbox" name="Dopler" value="Dopler" />&nbsp;Dopler</td>
      <td><input type="text" name="Dopler_qty" style="width:50px"  class="text" /></td>
      <td>Kali</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="checkbox" name="CTG" value="CTG" />&nbsp;CTG</td>
      <td><input type="text" name="CTG_qty" style="width:50px" class="text" /></td>
      <td>Kali</td>
    </tr>
    -->
    <tr>
    <td colspan="4">
    <table width="100%">
    <tr>
    <?php
	$sql = mysql_query('SELECT * FROM m_tarif2012 WHERE kode_tindakan BETWEEN "06.02.30" AND "06.02.43" OR kode_tindakan IN ("06.03.02","06.03.03")');
	$i = 0;
	while($dtindakan = mysql_fetch_array($sql)){
		if($i == 2){
			echo '</tr><tr>';
			$i = 0;
		}
		?>
          <td><input type="checkbox" name="tindakan[]" value="<?php echo $dtindakan['kode_tindakan'];?>" />&nbsp;<?php echo $dtindakan['nama_tindakan'];?></td>
          <td><input type="text" name="qty[]" style="width:50px" class="text" /></td>
          <td>Kali</td>
        <?php
		$i++;
	}
	?>
    </tr>
    </table>
    </td></tr>
    <tr>
      <td>Hasil Periksa</td>
      <td colspan="3"><textarea name="resume" id="resume" cols="70" rows="7"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">
      	<?php $s = mysql_query('select * from t_pendaftaran where nomr = "'.$_REQUEST['nomr'].'" and idxdaftar = "'.$_REQUEST['idx'].'"');
		$ds = mysql_fetch_array($s);
		?>
      	<input class="text" type="submit" name="submit"  value="Simpan" />
        <input type="hidden" name="carabayar" value="<?=$ds['KDCARABAYAR']?>" />
      	<input type="hidden" name="idxdaftar" value="<?=$_GET['idx']?>" />
        <input type="hidden" name="nomr" value="<?=$_GET['nomr']?>" />
        <input type="hidden" name="idx" value="<?=$dat_usg['idx']?>" />
        <input class="text" type="button" name="kembali" id="kembali" value="Batal" onClick="history.back();" />        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>
</form>
<br />
<? if(mysql_num_rows($get_usg) > 0) {?>
<table class="tb" >
   <tr>
      <th>Jenis Periksa</th>
      <th>Jumlah</th>
      <th>Dokter</th>
      <th>Tanggal</th>
      <th>Hasil</th>
      <th>&nbsp;</th>
   </tr>
<? while($dat_usg = mysql_fetch_array($get_usg)){ ?>
    <tr>
       <td><?=$dat_usg['JNS_ELEKTROMEDIK']?></td>
       <td align="right"><?=$dat_usg['QTY']?></td>
       <td><?=$dat_usg['NAMADOKTER']?></td>
       <td><?=$dat_usg['tanggal_periksa']?></td>
       <td><?=$dat_usg['hasil_periksa']?></td>
       <td><a href="vk/usg/save_usg.php?idx=<?=$dat_usg['idx']?>&opt=2&idxdaftar=<?=$_GET['idx']?>&nomr=<?=$_GET['nomr']?>"><input type="button" value="HAPUS" class="text" /></a></td>
    </tr>
<? } ?>   
</table>
<? } ?>
</div></div>
