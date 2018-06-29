<div align="center">
    <div id="frame" style="width:100%;">
    <div id="frame_title">
      <h3>FORM PERIKSA DOKTER</h3></div>
<form id="formperiksaradiologi" name="formperiksaradiologi" method="post" action="radiologi/updateperiksa_dokter_aps.php">
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
      <td rowspan="2"><select name="dokter[]" class="text" >
      <? $sql_dokter = "select KDDOKTER, NAMADOKTER from m_dokter where KDPOLY = 100";
	     $get_dokter = mysql_query($sql_dokter);
		 while($dat_dokter = mysql_fetch_array($get_dokter)){
	  ?>
         <option value="<?=$dat_dokter['KDDOKTER']?>" ><?=$dat_dokter['NAMADOKTER']?></option>
      <? } ?>
      </select></td>
    </tr>
    <tr valign="top">
      <td>&nbsp;</td>
    </tr>
    <tr valign="top">
      <td colspan="2">

      
      </td>
    </tr>
    <tr>
      <td valign="top">Hasil Expertise</td>
      <td><textarea name="resume" cols="70" rows="10" ></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="text" type="submit" name="submit"  value="S i m p a n" />
      
        <input class="text" type="button" name="kembali" id="kembali" value="B a t a l" onClick="history.back();" />        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</div></div>
