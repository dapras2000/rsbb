<?
include("../../include/connect.php");
$sql_usg = "SELECT idxdaftar, tanggal_periksa, hasil_periksa, kd_dokter
			FROM t_usg 
			WHERE JNS_ELEKTROMEDIK = 'MATA' AND idxdaftar = ".$_GET['idx'];
$get_usg = mysql_query($sql_usg);
$dat_usg = mysql_fetch_assoc($get_usg);
?>
<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>PEM. MATA</h3></div>
<form id="formperiksaradiologi" name="formperiksaradiologi" method="post" action="rajal/mata/save_mata.php">
  <table width="700" border="0" cellspacing="0" cellpadding="2" align="center" class="tb">
    <tr>
      <td width="114">&nbsp;</td>
      <td width="578"><? if($_GET['psn'] !=''){echo $psn;}?></td>
    </tr>
    <tr valign="top">
      <td>Dokter</td>
      <td><? 
	  	$sqlx = "select * from m_dokter where kdpoly = 29";
		$getx = mysql_query($sqlx);
		
			echo "<select class='text' name='dokter' id='dokter".$data['kode']."'>";
			while($datax =  mysql_fetch_array($getx)){
			echo "<option value='".$datax['KDDOKTER']."' ";
			
			if($dat_usg['kd_dokter']==$datax['KDDOKTER']) echo "selected='selected'"; 
			
			echo ">".$datax['NAMADOKTER']."</option>";
			}
			echo "</select>";
	  ?></td>
    </tr>
    <tr valign="top">
      <td colspan="2">
  </td>
    </tr>
    <tr>
      <td>Hasil Periksa</td>
      <td><textarea name="resume" id="resume" cols="70" rows="7"><?=$dat_usg['hasil_periksa']?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="text" type="submit" name="submit"  value="Simpan" />
      	<input type="hidden" name="idx" value="<?=$_GET['idx']?>" />
        <input type="hidden" name="nomr" value="<?=$_GET['nomr']?>" />
        <input class="text" type="button" name="kembali" id="kembali" value="Batal" onClick="history.back();" />        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</div></div>
