<? 
$diag_sql = "SELECT a.IDXTERAPI, a.DIAGNOSA, a.TERAPI, a.ICD_CODE, 
					a.KASUS_BL, a.ICDCM, b.jenis_penyakit, c.keterangan 
		  FROM t_diagnosadanterapi a 
		  left join icd b on (a.ICD_CODE=b.icd_code) 
		  left join icd_cm c on (a.ICDCM=c.kode)
		  WHERE a.IDXDAFTAR=".$idxdaftar;
$diag_qry = mysql_query($diag_sql); 
$dvd = mysql_fetch_assoc($diag_qry);
?>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery("#icd").autocomplete("ugd/scripts/mysql.php", { width: 260, selectFirst: true });
	jQuery("#icdcm").autocomplete("ugd/scripts/mysql2.php", { width: 260, selectFirst: true });
	jQuery("#nm_barang").autocomplete("autocomplete/nama_obat.php", { width: 260, selectFirst: true });
});
</script>

<form method="post" action="ugd/valid_dignosa.php" name="diagnosa" id="diagnosa">
<input name="txtNoMR" id="txtNoMR" type="hidden" value=<?php echo $nomr; ?> >
<input name="txtIdxDaftar" id="txtIdxDaftar" type="hidden" value=<?php echo $idxdaftar; ?> >
<input name="txtKdPoly" id="txtKdPoly" type="hidden" value=<?php echo $kdpoly; ?> >
<input name="txtKdDokter" id="txtKdDokter" type="hidden" value=<?php echo $kddokter; ?> >
<input name="txtTglReg" id="txtTglReg" type="hidden" value=<?php echo $tglreg; ?> >
<input name="txtNip" id="txtNip" type="hidden" value=<?php echo $_SESSION['NIP'];?> >
<input type="hidden" name="idxterapi" value="<? echo $dvd['IDXTERAPI']; ?>" />
<table class="tb" width="98%" align="center" >
  <tr>
     <td width="50%">
     <table width="100%" style="vertical-align:top">
      <tr><td colspan="2">&nbsp;</td></tr>
      <tr><td>Kasus</td><td><input type="radio" value="1" <?php if($dvd['KASUS_BL'] == 1): echo 'checked="checked"'; endif;?> name="new_kasus"/> Kasus Baru 
      						<input type="radio" value="0" <?php if($dvd['KASUS_BL'] == 0): echo 'checked="checked"'; endif;?> name="new_kasus" /> Kasus Lama</td></tr>
      <tr><td>Kunjungan</td><td><input type="radio" value="1" <?php if($dvd['KUNJUNGAN_BL'] == 1): echo 'checked="checked"'; endif;?> name="new_visit" /> Kunjungan Baru 
      							<input type="radio" value="0" <?php if($dvd['KUNJUNGAN_BL'] == 0): echo 'checked="checked"'; endif;?> name="new_visit" /> Kunjungan Lama</td></tr>
      </table>
     
     <table align="center" width="95%" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <th width="49%">Diagnosa</th>
        </tr>
        <tr>
          <td valign="top"><textarea class="text" id="elm1" name="elm1" rows="10" cols="50" style="width:100%" >
  		  		<? 
				if(isset($_GET['elm1'])){
					echo $_GET['elm1'];			
				}else{
					if(!empty($dvd['DIAGNOSA'])) echo $dvd['DIAGNOSA']; 
				}
				?>
				</textarea></td>
        </tr>
      </table>
     <!-- -->
     </td>
     <td>
     <!-- -->
     <table width="100%" style="vertical-align:top">
      <tr><td>&nbsp;</td><td>
      						</td></tr>
      <tr><td>Kejadian Luar Biasa</td><td><input type="radio" value="1" <?php #if($dvd['KKL'] == 1): echo 'checked="checked"'; endif;?> name="KLL"/> Kejadian Luar Biasa
      						<input type="radio" value="0" <?php #if($dvd['KKL'] == 0): echo 'checked="checked"'; endif;?> name="KLL" /> Bukan Kejadian Luar Biasa</td></tr>

	  <tr><td>Jenis</td><td><input type="radio" value="1" <?php #if($dvd['KKL'] == 1): echo 'checked="checked"'; endif;?> name="jenis"/> Kebidanan
      						<input type="radio" value="2" <?php #if($dvd['KKL'] == 0): echo 'checked="checked"'; endif;?> name="jenis" /> Psikiatri
                            <input type="radio" value="3" <?php #if($dvd['KKL'] == 0): echo 'checked="checked"'; endif;?> name="jenis" /> Anak
                            <input type="radio" value="4" <?php #if($dvd['KKL'] == 1): echo 'checked="checked"'; endif;?> name="jenis"/> Bedah
                            <input type="radio" value="5" <?php #if($dvd['KKL'] == 0): echo 'checked="checked"'; endif;?> name="jenis" /> Penyakit Dalam</td></tr>
                                 
      </table>
     <table align="center" width="95%" border="0" cellpadding="1" cellspacing="1">
       <tr>
          <th valign="top">Terapi</th>
        </tr>
        <tr>
          <td valign="top"><textarea class="text"id="elm2" name="elm2" rows="10" cols="50" style="width:100%">
  		  		<? 
				if(isset($_GET['elm2'])){
					echo $_GET['elm2'];			
				}else{
				if(!empty($dvd['TERAPI'])) echo $dvd['TERAPI']; 
				}?>
  		  	  </textarea></td>
        </tr>
      </table>

     </td>
  </tr>
  <tr>
    <td colspan="2">
      <div  align="left" style="margin:5px; padding:5px;">
        <input type="submit" class="text" name="save" value=" S i m p a n " />
        <input type="reset" class="text" name="reset" value=" R e s e t " />
      </div>
    </td> 
  </tr>
</table>
</form>