<? 
$diag_sql = "SELECT a.IDXTERAPI, a.DIAGNOSA, a.TERAPI, a.ICD_CODE, a.KASUS_BL, a.ICDCM, b.jenis_penyakit, c.keterangan, a.KUNJUNGAN_BL, TEKANAN_DARAH, GOLONGAN_DARAH, TINGGI_BADAN, BERAT_BADAN
		  FROM t_diagnosadanterapi a 
		  left join icd b on (a.ICD_CODE=b.icd_code) 
		  left join icd_cm c on (a.ICDCM=c.kode)
		  WHERE a.IDXDAFTAR=".$idxdaftar;
$diag_qry = mysql_query($diag_sql); 
$dvd = mysql_fetch_assoc($diag_qry);

$tekanan_darah	= !empty($dvd['TEKANAN_DARAH']) ? $dvd['TEKANAN_DARAH'] : '';
$golongan_darah	= !empty($dvd['GOLONGAN_DARAH']) ? $dvd['GOLONGAN_DARAH'] : '';
$tinggi_badan	= !empty($dvd['TINGGI_BADAN']) ? $dvd['TINGGI_BADAN'] : '';
$berat_badan	= !empty($dvd['BERAT_BADAN']) ? $dvd['BERAT_BADAN'] : '';
//print_r($dvd);
?>
<script type='text/javascript' src='rajal/jscripts/jquery.autocomplete.pack.js'></script>
<link rel="stylesheet" type="text/css" href="rajal/jscripts/jquery.autocomplete.css" />
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery("#icd").autocomplete("rajal/jscripts/mysql.php", { width: 260, selectFirst: true });
	jQuery("#icdcm").autocomplete("rajal/jscripts/mysql2.php", { width: 260, selectFirst: true });
	jQuery("#nm_barang2").autocomplete("rajal/jscripts/nm_barang.php", { width: 260, selectFirst: true });
});
</script>

<form method="post" action="rajal/valid_dignosa.php" name="diagnosa" id="diagnosa">
<input name="txtNoMR" id="txtNoMR" type="hidden" value=<?php echo $_REQUEST['nomr']; ?> >
<input name="txtIdxDaftar" id="txtIdxDaftar" type="hidden" value=<?php echo $idxdaftar; ?> >
<?php 
	if ($_SESSION['KDUNIT']=='40'){
	?><input name="txtKdPoly" id="txtKdPoly" type="hidden" value=<?php echo "40"; ?> ><?php
	}else {
	?><input name="txtKdPoly" id="txtKdPoly" type="hidden" value=<?php echo $kdpoly; ?> ><?php
	}
?>
<input name="txtKdDokter" id="txtKdDokter" type="hidden" value=<?php echo $kddokter; ?> >
<input name="txtTglReg" id="txtTglReg" type="hidden" value=<?php echo $tglreg; ?> >
<input name="txtNip" id="txtNip" type="hidden" value=<?php echo $_SESSION['NIP'];?> >
<input type="hidden" name="idxterapi" value="<? echo $dvd['IDXTERAPI']; ?>" />
<table class="tb" width="98%" align="center" >
  <tr>
     <td width="50%">
      <table width="100%" style="vertical-align:top">
      <tr><td>Kasus</td><td><input type="radio" value="1" <?php if($dvd['KASUS_BL'] == 1): echo 'checked="checked"'; endif;?> name="new_kasus"/> Kasus Baru 
      						<input type="radio" value="0" <?php if($dvd['KASUS_BL'] == 0): echo 'checked="checked"'; endif;?> name="new_kasus" /> Kasus Lama</td></tr>
      <tr><td>Kunjungan</td><td><input type="radio" value="1" <?php if($dvd['KUNJUNGAN_BL'] == 1): echo 'checked="checked"'; endif;?> name="new_visit" /> Kunjungan Baru 
      							<input type="radio" value="0" <?php if($dvd['KUNJUNGAN_BL'] == 0): echo 'checked="checked"'; endif;?> name="new_visit" /> Kunjungan Lama</td></tr>
			
      </table>
     <!-- -->
     
	<div align="left" id="diagnosa_valid"></div>
      <!--
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
      
    
     </td>
     <td width="50%">
    
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
        	<? #require_once("rajal/add_obat.php"); ?>
        </div>

     </td>
  </tr>
  <tr>
     <td>
	-->
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
     <tr><td>Tekanan Darah</td><td><input type="text" name="tekanan_darah" value="<?php echo $tekanan_darah;?>" id="tekanan_darah"></td>
		 <td>Berat Badan</td><td><input type="text" name="berat_badan" value="<?php echo $berat_badan;?>" id="berat_badan"></td></tr>
	 <tr><td>Golongan Darah</td><td><select name="golongan_darah" id="golongan_darah">
		<option value=""> Pilih Golongan Darah </option>
		<option value="A" <?php if($golongan_darah == 'A'): echo 'selected="selected"'; endif;?>> Gol A </option>
		<option value="B" <?php if($golongan_darah == 'B'): echo 'selected="selected"'; endif;?>> Gol B </option>
		<option value="AB"<?php if($golongan_darah == 'AB'): echo 'selected="selected"'; endif;?>> Gol AB </option>
		<option value="O" <?php if($golongan_darah == 'O'): echo 'selected="selected"'; endif;?>> Gol O </option>
		
	 </select></td>
		 <td>Tinggi Badan</td><td><input type="text" name="tinggi_badan" value="<?php echo $tinggi_badan;?>" id="tinggi_badan"></td></tr>
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
     <!-- -->
     </td>
  </tr>
  <tr>
  	<td>
    	<table align="center" width="95%" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <th width="49%">Laboratorium</th>
        </tr>
        <tr>
          <td valign="top">
          	<?php 
			#$sql2 = 'SELECT * FROM t_orderlab WHERE idxdaftar = "'.$_REQUEST['idx'].'" AND nomr = "'.$nomr.'" GROUP BY idxdaftar, nomr';
			#$qry2 = mysql_query($sql2);
			#while($data2 = mysql_fetch_array($qrt2)){
				$myquery = "SELECT a.`NOLAB`,a.`TANGGAL`,b.`NAMA`, b.`JENISKELAMIN`, b.`TGLLAHIR`, c.`NAMADOKTER`, d.`nama` AS POLY, a.`NOMR`, a.IDXDAFTAR
FROM t_orderlab a
JOIN m_pasien b ON a.`NOMR` = b.`NOMR`
JOIN m_dokter c ON a.`DRPENGIRIM` = c.`KDDOKTER`
JOIN m_poly d ON a.`KDPOLY` = d.`kode`
WHERE a.IDXDAFTAR = '".$_REQUEST['idx']."'";
				$get 		= mysql_query ($myquery)or die(mysql_error());
				$userdata 	= mysql_fetch_assoc($get); 		
				$nomr		=$userdata['NOMR'];
				$idxdaftar	=$userdata['IDXDAFTAR'];
				$kdpoly		=$userdata['POLY'];
				$kddokter	=$userdata['NAMADOKTER'];
				$tglreg		=$userdata['TANGGAL'];
				$nolab		= $userdata['NOLAB'];
			#}
			?>
			<table width="100%">
              <tr>
                <td>No Lab</td>
                <td>:&nbsp;<?php echo $userdata['NOLAB']?></td>
                <td>&nbsp;</td>
                <td>Dokter</td>
                <td>:&nbsp;<?php echo $kddokter?></td>
              </tr>
              <tr>
                <td>Tanggal</td>
                <td>:&nbsp;<?=$tglreg?></td>
                <td>&nbsp;</td>
                <td>Ruangan</td>
                <td>:&nbsp;<?php echo $kdpoly?></td>
              </tr>
              <tr>
                    <td height="91" colspan="5" valign="top">
                    <table width="95%" border="0" cellspacing="1" class="tb">
                      <tr>
                        <th>Nama Test</th>
                        <th>Hasil</th>
                        <th>Unit</th>
                        <th>Nilai Normal</th>
                      </tr>
                <?php 
					$sql = "SELECT b.`nama_tindakan`, a.`HASIL_PERIKSA`, a.`nilai_normal`, a.`UNIT` 
FROM t_orderlab a
JOIN m_tarif2012 b ON a.`KODE` = b.`kode_tindakan` where a.nolab = '".$nolab."'";
$rowxx= mysql_query($sql)or die(mysql_error());
					while($data = mysql_fetch_array($rowxx)){  ?>      
                      <tr>
                        <td><strong>-<?php echo $data['nama_tindakan']?></strong></td>
                        <td><?php echo $data['HASIL_PERIKSA'];?></td>
                        <td><?php echo $data['nilai_normal'];?></td>
                        <td><?php echo $data['UNIT'];?></td>
                      </tr>
                
                <? 
                }
				?>
                </table>
                </td></tr>
              </table>
          </td>
        </tr>
      </table>
    </td>
    <td>
    <table align="center" width="95%" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <th width="49%">Radiologi</th>
        </tr>
        <tr>
          <td valign="top">
          	<?php
				$myquerys = "SELECT a.`TGLORDER`, b.`nama_tindakan`, a.`DIAGNOSA`, c.`nama` AS POLY, d.`NAMADOKTER`, a.`HASILRESUME`
FROM t_radiologi a
JOIN m_tarif2012 b ON a.`JENISPHOTO` = b.`kode_tindakan`
JOIN m_poly c ON a.`POLYPENGIRIM` = c.`kode`
JOIN m_dokter d ON a.`DRPENGIRIM` = d.`KDDOKTER` 
WHERE a.idxdaftar = '".$_REQUEST['idx']."'
AND a.nomr = '".$_REQUEST['nomr']."'";
			?>
                    <table width="95%" border="0" cellspacing="1" class="tb">
                      <tr>
                        <th>Foto</th>
                        <th>Dokter</th>
                        <th>Poly</th>
                        <th>Hasil</th>
                      </tr>
                <?php 
					$rowxx= mysql_query($myquerys)or die(mysql_error());
					while($data = mysql_fetch_array($rowxx)){  ?>      
                      <tr>
                        <td><strong>-<?php echo $data['nama_tindakan']?></strong></td>
                        <td><?php echo $data['NAMADOKTER'];?></td>
                        <td><?php echo $data['POLY'];?></td>
                        <td><?php echo $data['HASILRESUME'];?></td>
                      </tr>
                
                <? 
                }
				?>
                </table>
               
          </td>
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