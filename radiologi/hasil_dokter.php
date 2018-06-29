<div align="center">
	<div id="frame" style="width:100%;">
		<div id="frame_title"><h3>FORM PERIKSA DOKTER</h3></div>
		<form id="formperiksaradiologi" name="formperiksaradiologi" method="post" action="radiologi/updateperiksa_dokter.php">
  <table width="700" border="0" cellspacing="0" cellpadding="2" align="center" class="tb">
    <tr>
      <td>&nbsp;</td>
      <td width="522"><? if($_GET['psn'] !=''){echo $psn;}?></td>
    </tr>
    <tr>
      <td width="158">No. Foto</td>
      <td><? echo $_GET['nofilm'];?>
      <input name="idxorder" type="hidden" id="idxorder" value="<? echo $_GET['idxorder'];?>" /></td>
    </tr>
    <tr valign="top">
      <td> Dokter Radiologi</td>
      <td rowspan="2">
	  <?php if(isset($_REQUEST['readonly']) == 1): 
			$sel = mysql_query('select DRRADIOLOGI from t_radiologi where idxorderrad='.$_REQUEST['idxorder']); 
			$row = mysql_fetch_array($sel);
			$sql_dokter = "select NAMADOKTER from m_dokter where KDDOKTER = '".$row['DRRADIOLOGI']."'";
			$get_dokter = mysql_query($sql_dokter);
			$row = mysql_fetch_array($get_dokter);
			echo $row['NAMADOKTER'];
		else:?>
	  <select name="dokter" class="text" >
      <? $sql_dokter = "select KDDOKTER, NAMADOKTER from m_dokter where KDPOLY = 100";
	     $get_dokter = mysql_query($sql_dokter);
		 while($dat_dokter = mysql_fetch_array($get_dokter)){
	  ?>
         <option value="<?=$dat_dokter['KDDOKTER']?>" ><?=$dat_dokter['NAMADOKTER']?></option>
      <? } 
		endif; ?>
      </select>
	  </td>
    </tr>
    <tr valign="top">
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">Hasil Expertise</td>
      <td>
      <?php $sel = mysql_query('select HASILRESUME from t_radiologi where idxorderrad='.$_REQUEST['idxorder']); 
      $row = mysql_fetch_array($sel); 
	  if(isset($_REQUEST['readonly']) == 1): 
		echo $row['HASILRESUME'];
	  else: ?>
      <textarea name="resume" cols="70" rows="10" ><?php echo $row['HASILRESUME'];?></textarea></td>
	  <? endif; ?>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
      	<?php if(isset($_REQUEST['readonly']) == 1): ?>
      	<input class="text" type="button" name="kembali" id="kembali" value="K e m b a l i" onClick="history.back();" />        
        <?php else: ?>
        <input class="text" type="submit" name="submit"  value="U p d a t e" />
        <input class="text" type="button" name="kembali" id="kembali" value="K e m b a l i" onClick="history.back();" />        
        <?php endif; ?>
        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</div></div>
