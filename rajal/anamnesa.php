<?
$sql_anamnesa = "SELECT a.IDXTERAPI, a.anamnesa
		  FROM t_diagnosadanterapi a 
		  left join icd b on (a.ICD_CODE=b.icd_code) 
		  left join icd_cm c on (a.ICDCM=c.kode)
		  WHERE a.IDXDAFTAR=".$idxdaftar;
$get_anamnesa = mysql_query($sql_anamnesa);
$dat_anamnesa = mysql_fetch_assoc($get_anamnesa);
?>
<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>ANAMNESA DENGAN POLA</h3></div>
<form id="anamnesa" name="anamnesa" method="post" action="rajal/save_anamnesa.php">
  <table width="700" border="0" cellspacing="0" cellpadding="2" align="center" class="tb">
    <tr valign="top">
      <td colspan="2">
  </td>
    </tr>
    <tr>
      <td>Anamnesa</td>
      <td><textarea name="resume_anamnesa" id="resume_anamnesa" cols="70" rows="7"><?=$dat_anamnesa['anamnesa']?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="text" type="submit" name="submit"  value="Simpan" />
      	<input name="txtNoMR" id="txtNoMR" type="hidden" value=<?php echo $nomr; ?> >
		<input name="txtIdxDaftar" id="txtIdxDaftar" type="hidden" value=<?php echo $idxdaftar; ?> >
		<input name="txtKdPoly" id="txtKdPoly" type="hidden" value=<?php echo $kdpoly; ?> >
		<input name="txtKdDokter" id="txtKdDokter" type="hidden" value=<?php echo $kddokter; ?> >
		<input name="txtTglReg" id="txtTglReg" type="hidden" value=<?php echo $tglreg; ?> >
		<input name="txtNip" id="txtNip" type="hidden" value=<?php echo $_SESSION['NIP'];?> >
		<input type="hidden" name="idxterapi" value="<? echo $dat_anamnesa['IDXTERAPI']; ?>" />
        <input class="text" type="button" name="kembali" id="kembali" value="Batal" onClick="history.back();" />        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</div></div>
