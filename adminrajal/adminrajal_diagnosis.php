<? 
$diag_sql = "SELECT a.IDXTERAPI, a.DIAGNOSA, a.TERAPI, a.ICD_CODE, a.KASUS_BL, a.ICDCM, b.jenis_penyakit, c.keterangan  FROM t_diagnosadanterapi a 
		  left join icd b on (a.ICD_CODE=b.icd_code) 
		  left join icd_cm c on (a.ICDCM=c.kode)
		  WHERE a.IDXDAFTAR=".$_REQUEST['idxdaftar'];
$diag_qry = mysql_query($diag_sql); 
$dvd = mysql_fetch_assoc($diag_qry);

$sql2	= mysql_query('select * from t_pendaftaran where IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"');
$p_dat = mysql_fetch_assoc($sql2);


#print_r($p_dat);
?>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery("#icd").autocomplete("rajal/jscripts/mysql.php", { width: 260, selectFirst: true });
	jQuery("#icdcm").autocomplete("rajal/jscripts/mysql2.php", { width: 260, selectFirst: true });
	jQuery("#nm_barang2").autocomplete("rajal/jscripts/nm_barang.php", { width: 260, selectFirst: true });
});
</script>
<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>DIAGNOSIS PASIEN</h3></div>
    <form method="post" action="rajal/valid_dignosa.php" name="diagnosa" id="diagnosa">
<input name="txtNoMR" id="txtNoMR" type="hidden" value=<?php echo $p_dat['NOMR']; ?> >
<input name="txtIdxDaftar" id="txtIdxDaftar" type="hidden" value=<?php echo $p_dat['IDXDAFTAR']; ?> >
<input name="txtKdPoly" id="txtKdPoly" type="hidden" value=<?php echo $p_dat['KDPOLY']; ?> >
<input name="txtKdDokter" id="txtKdDokter" type="hidden" value=<?php echo $p_dat['KDDOKTER']; ?> >
<input name="txtTglReg" id="txtTglReg" type="hidden" value=<?php echo $p_dat['TGLREG']; ?> >
<input name="txtNip" id="txtNip" type="hidden" value=<?php echo $_SESSION['NIP'];?> >
<input type="hidden" name="idxterapi" value="<? echo $dvd['IDXTERAPI']; ?>" />
<table class="tb" width="98%" align="center" >
  <tr>
     <td width="50%">
     <!-- -->
	<div align="left" id="diagnosa_valid"></div>
    <table width="100%" height="100px" style="vertical-align:top">
      <tr>
        <td width="6%">Kasus</td>
        <td width="31%"><input type="radio" value="1" name="new_kasus" <? 
		 if(isset($_GET['new_kasus'])){
			if($_GET['new_kasus']=="1"){
			   echo "checked=checked";
			}
		 }else{
		 	if(!empty($dvd['KASUS_BL'])){ 
		    	if($dvd['KASUS_BL']=="1"){
			   		echo "checked=checked";
				}
		 	}
		 }
		 ?> />
          Kasus Baru
          <input type="radio" value="0" name="new_kasus" <? 
		 if(isset($_GET['new_kasus'])){
			if($_GET['new_kasus']=="0"){
			   echo "checked=checked";
			}
		 }else{
		 	if(!empty($dvd['KASUS_BL'])){ 
		    	if($dvd['KASUS_BL']=="0"){
			   		echo "checked=checked";
				}
		 	}
		 }
		 ?> />
          Kasus Lama</td>
      </tr>
      <tr>
        <td>ICD</td>
        <td><input type="text" class="text" name="icd" id="icd" size="50" onkeypress="if(enter_pressed(event))
          				{
                        var str=document.getElementById('icd').value;
                        var kode=str.split('++');
                        document.getElementById('icd_code').value=kode[0];  
                        document.getElementById('elm1').focus();                    
                        }" value="<? 
		 if(isset($_GET['icd'])){
			echo $_GET['icd']; 
		 }else{
		 	if(!empty($dvd['jenis_penyakit'])){ 
		          echo $dvd['jenis_penyakit'];
		 	} 
		 } ?>" /></td>
      </tr>
      <tr>
        <td>Kode</td>
        <td><input type="text" name="icd_code" id="icd_code" class="text" value="<? 
		 if(isset($_GET['icd_code'])){
		    echo $_GET['icd_code'];
		 }else{
		 	if(!empty($dvd['ICD_CODE'])){ 
		          echo $dvd['ICD_CODE'];
		 	} 
		 }?>" readonly="readonly"/></td>
      </tr>
      <tr>
        <td>ICD CM</td>
        <td><input type="text" class="text" name="icdcm" id="icdcm" size="50" onkeypress="if(enter_pressed(event))
          				{
                        var str=document.getElementById('icdcm').value;
                        var kode=str.split('++');
                        document.getElementById('icd_code2').value=kode[0];  
                        document.getElementById('elm1').focus();                    
                        }" value="<? 
		 if(isset($_GET['icdcm'])){
		      echo $_GET['icdcm'];
		 }else{
		 	if(!empty($dvd['keterangan'])){ 
		          echo $dvd['keterangan'];
		 	} 
		 }?>" /></td>
      </tr>
      <tr>
        <td>Kode</td>
        <td><input type="text" name="icd_code2" id="icd_code2" class="text" value="<? 
		 if(isset($_GET['icd_code2'])){
			echo $_GET['icd_code2']; 
		 }else{
		 	if(!empty($dvd['ICDCM'])){ 
		          echo $dvd['ICDCM'];
		 	} 
		 }?>" readonly="readonly"/></td>
      </tr>
    </table>
      <span style="background-color:#FFF;"></span>
      
     <!-- -->
     </td>
     <td width="50%">
     <!-- -->
            <table width="100%" height="100px" style="vertical-align:top">
              <tr>
                <td width="33%">Nama Obat</td>
                <td width="67%"><input type="text" class="text" name="nm_barang2"  id="nm_barang2" style="width:200px"/></td>
              </tr>
              <tr>
                <td>Sediaan</td>
                <td><select name="sediaan2" class="text">
                  <option selected="selected" >-Pilih-</option>
                  <option value="tablet" >tablet</option>
                  <option value="sirup" >sirup</option>
                  <option value="injeksi" >injeksi</option>
                  <option value="sup" >sup</option>
                  <option value="salep" >salep</option>
                  <option value="infus" >infus</option>
                  <option value="kapsul" >kapsul</option>
                  <option value="drop" >drop</option>
                </select></td>
              </tr>
              <tr>
                <td>Aturan Pakai</td>
                <td><select name="aturan2" class="text">
                  <option selected="selected" value="" >-pilih-</option>
                  <option value="1 x 1 tablet" >1 x 1 tablet</option>
                  <option value="2 x 1/2 tablet" >2 x 1/2 tablet</option>
                  <option value="2 x 1 tablet" >2 x 1 tablet</option>
                  <option value="3 x 1 tablet" >3 x 1 tablet</option>
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
                </select></td>
              </tr>
              <tr>
                <td>Jumlah</td>
                <td><input type="text" class="text" name="jml_permintaan2" id="jml_permintaan2" style="width:50px" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td align="left">
	         	<input name="idxdaftarz" id="idxdaftarz" type="hidden" value=<?php echo $idxdaftar; ?> >
                <input type="submit" value=" Add Terapi " onclick="submitform (document.getElementById('diagnosa'),'rajal/add_obat.php','cart_obat',validatetask); return false;" name="add" class="text" /></td>
              </tr>
              </table>
        <div id="cart_obat">
        </div>
     <!-- -->
     </td>
  </tr>
  <tr>
     <td>
     <!-- -->
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
     <!-- -->
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
    </div>
</div>