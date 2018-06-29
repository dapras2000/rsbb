<? 
include("../include/connect.php");

$sql_kunj_kamar = "SELECT 
  t_kunjungan_kamar.idxkunjungan_kamar,
  t_kunjungan_kamar.idxdaftar,
  t_kunjungan_kamar.nomr,
  t_kunjungan_kamar.tanggal,
  t_kunjungan_kamar.icd_code,
  (SELECT jenis_penyakit from icd where icd_code=trim(t_kunjungan_kamar.icd_code)) AS jenis_penyakit,
  t_kunjungan_kamar.subjektif,
  t_kunjungan_kamar.objektif,
  t_kunjungan_kamar.assasement,
  t_kunjungan_kamar.planning
FROM t_kunjungan_kamar
WHERE idxdaftar = ".$idxdaftar;
$get_kunj_kamar = mysql_query($sql_kunj_kamar);
$dakk = mysql_fetch_assoc($get_kunj_kamar);

$sql_masuk = "SELECT DATE_FORMAT(TGLREG, '%Y-%m-%d') as tgl_masuk,
				DATE_FORMAT(MASUKPOLY, '%H:%i:%s') as jam_masuk
				FROM t_pendaftaran 
				WHERE IDXDAFTAR = ".$idxdaftar;
$get_masuk = mysql_query($sql_masuk);
$dat_masuk = mysql_fetch_assoc($get_masuk);
$tgl_masuk = $dat_masuk["tgl_masuk"];
$jam_masuk = $dat_masuk["jam_masuk"];
?>  

<form name="kunjungan_kamar" id="kunjungan_kamar" method="post" action="vk/addkunjungan_kamar.php" >
  <table class="tb">
     <tr>
      <td width="205">Tanggal Kunjungan</td> 
      <td colspan="2"><input type="text" name="tgl_kunjungan" id="tgl_kunjungan" class="text"  value="<?=$tgl_masuk?>" readonly="readonly"/><input type="hidden" name="idxkunjungan_kamar" value="<?=$dakk['idxkunjungan_kamar']?>" /></td>
     </tr>
     <tr>
      <td>Jam</td>     
      <td colspan="2"><input type="text" name="jam_kunjungan"  id="jam_kunjungan" class="text" value="<?=$jam_masuk?>" readonly="readonly"/></td>
     </tr>
    <tr>
      <td>ICD</td>
      <td colspan="2"><input name="icdv" type="text" class="text" id="icdv" size="50" onKeyPress="if(enter_pressed(event))
          				{
                        var str=document.getElementById('icdv').value;
                        var kode=str.split('--');
                        document.getElementById('icd_code').value=kode[1];
                        document.getElementById('icdv').value=kode[0];  
                        document.getElementById('subjektif').focus();                    
                        }" value="<? if(!empty($dakk['jenis_penyakit'])){ echo $dakk['jenis_penyakit']; 
	  }?>" /></td>
     </tr>
    <tr>
      <td>Kode ICD</td>
      <td colspan="2"><input type="text" name="icd_code" id="icd_code" class="text" onKeyPress="if(enter_pressed(event))
          				{
                        var str=document.getElementById('icd_code').value;
                        var kode=str.split('--');
                        document.getElementById('icd_code').value=kode[0];
                        document.getElementById('icdv').value=kode[1];  
                        document.getElementById('subjektif').focus();                    
                        }" value="<? if(!empty($dakk['icd_code'])){ echo $dakk['icd_code']; 
	  }?>" /></td>
     </tr>  
    <tr>
      <td>Subjektif</td>
      <td colspan="2"><textarea name="subjektif" type="text" class="text" id="subjektif" cols="100" rows="5"  ><? if(!empty($dakk['subjektif'])){ echo $dakk['subjektif']; 
	  }?></textarea></td>
     </tr> 
      <tr>
      <td>Objektif</td>
      <td colspan="2"><textarea name="objektif" type="text" class="text" id="objektif" cols="100" rows="5" ><? if(!empty($dakk['objektif'])){ echo $dakk['objektif']; 
	  }?></textarea></td>
     </tr>
     <tr>
       <td>Assasement</td>
       <td colspan="2"><textarea name="assasement" type="text" class="text" id="assasement" cols="100" rows="5" ><? if(!empty($dakk['assasement'])){ echo $dakk['assasement']; 
	  }?></textarea></td>
     </tr>
     <tr>
       <td>Planning</td>
       <td colspan="2"><textarea name="planning" type="text" class="text" id="planning" cols="100" rows="5" ><? if(!empty($dakk['planning'])){ echo $dakk['planning']; 
	  }?></textarea></td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td width="110">&nbsp;</td>
       <td width="525">&nbsp;</td>
     </tr>
    <tr>
      <td >
        <input type="hidden" name="idxdaftar" value="<?=$idxdaftar?>" />
        <input type="hidden" name="nomr" value="<?=$nomr?>" />
        <input type="hidden" name="NIP" value="<?=$_SESSION['NIP']?>" />
        <input type="hidden" name="KDUNIT" value="<?=$_SESSION['KDUNIT']?>" />
        <input type="hidden" name="link" value="51" />
        <input type="hidden" name="menu" value="1" />
      <input type="submit" value="S i m p a n" class="text" /></td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
    </tr>    
  </table>
 
</form>
