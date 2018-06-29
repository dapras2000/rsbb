<? 
session_start();
include("../include/connect.php"); 
include("../include/function.php"); 
?>

<?php $sql_rsm_pulang="SELECT * FROM t_resumemedis WHERE IDXRANAP = '".$_POST['id_admission']."'";
		$get_rsm_pulang =  mysql_query($sql_rsm_pulang);
		$dat_rp = mysql_fetch_assoc($get_rsm_pulang); 
		if(isset($dat_rp['IDX'])){ ?>
<form action="ranap/save_resume_medis.php" name="resume_medis" method="post" id="resume_medis">
	<? echo '<input type="hidden" name="idx" value="'.$dat_rp['IDX'].'" />';
		} else {	?>
<form action="ranap/save_resume_medis.php" name="resume_medis" method="post" id="resume_medis">
	<? } ?>
<input type="hidden" name="id_admission" value="<?php echo $_REQUEST['id_admission'];?>" />
<input type="hidden" name="nomr" value="<?php echo $_REQUEST['nomr'];?>" />
<input type="hidden" name="masukrs" value="<?php echo $masukrs;?>" />
<table width="95%" border="0" class="tb">
  <!--<tr>
    <td width="11%">Tanggal Keluar</td>
    <td width="89%"><input onblur="calage(this.value,'umur');" type="text" class="text" name="tgl_keluar" id="tgl_keluar" size="20" />
      <a href="javascript:showCal('Calendar5')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>-->
  <tr>
    <td colspan="2">1. Keluhan utama dan riwayat penyakit</td>
  </tr>
  <tr>
    <td colspan="2"><textarea name="keluhan" cols="60" rows="5" class="text"><?=$dat_rp['KELUHANUTAMA']?></textarea></td>
    </tr>
  <tr>
    <td colspan="2">2. Pemeriksaan fisik</td>
    </tr>
  <tr>
    <td colspan="2"><textarea name="pemeriksaan_fisik" cols="60" rows="5" class="text"><?=$dat_rp['PEMERIKSAANFISIK']?></textarea></td>
    </tr>
  <tr>
    <td colspan="2">3. Pemeriksaan Penunjang (Lab, Ro, dll)</td>
    </tr>
  <tr>
    <td colspan="2"><textarea name="pemeriksaan_penunjuang" cols="60" rows="5" class="text"><?=$dat_rp['PEMERIKSAANPENUNJANG']?></textarea></td>
    </tr>
  <tr>
    <td colspan="2">4. Jalannya penyakit selama perawatan (konsultasi, pemeriksaan khusus)</td>
    </tr>
  <tr>
    <td colspan="2"><textarea name="konsultasi" cols="60" rows="5" class="text"><?=$dat_rp['JALANNYAPENYAKIT']?></textarea></td>
    </tr>
  <tr>
    <td colspan="2">5. Diagnosa ( Satu atau Lebih )</td>
    </tr>
  <tr>
    <td colspan="2"><textarea name="diagnosa_akhir" cols="60" rows="5" class="text"><?=$dat_rp['DIAGNOSAAKHIR']?></textarea></td>
    </tr>
  <tr>
    <td colspan="2">6. Tindakan ( Satu atau Lebih )</td>
    </tr>
  <tr>
    <td colspan="2"><textarea name="diagnosa" cols="60" rows="5" class="text"><?=$dat_rp['PROGNOSA']?></textarea></td>
    </tr>
  <tr>
    <td colspan="2">7. Keadaan pasien waktu dipulangkan dan obat-obatan yang diberikan</td>
    </tr>
  <tr>
    <td colspan="2"><textarea name="keadaan_pasien" cols="60" rows="5" class="text"><?=$dat_rp['PASIENWAKTUPULANG']?></textarea></td>
    </tr>
  <tr>
    <td colspan="2">8. Anjuran / Pemeriksaan lanjut</td>
    </tr>
  <tr>
    <td colspan="2"><textarea name="anjuran" cols="60" rows="5" class="text"><?=$dat_rp['ANJURAN']?></textarea></td>
    </tr>
  </table>
	<div><input type="submit" name="Submit" value="Simpan" class="text" onclick="newsubmitform (document.getElementById('resume_medis'),'ranap/save_resume_medis.php','valid_resume_medis',validatetask); return false;"/>
</form>    
<div id="valid_resume_medis"></div>