<?php
include("../include/connect.php");
$ret_operasi="select a.nomr,b.nama,a.IDXDAFTAR from t_operasi a join m_pasien b on a.nomr=b.nomr where a.id_operasi='".$_GET['idoperasi']."' and a.tanggal='".$_GET['tanggal']."'";
$res_operasi=mysql_query($ret_operasi);
$row_operasi=@mysql_fetch_array($res_operasi);


$ret_operasi1="SELECT YEAR(NOW())-YEAR(TGLLAHIR) as usia from m_pasien where nomr='".$row_operasi[0]."'";
$res_operasi1=mysql_query($ret_operasi1);
$row_operasi1=@mysql_fetch_array($res_operasi1);

$ret_operasi2="select a.noruang,a.nott,b.nama from t_admission a,m_ruang b where a.noruang=b.no and a.nomr='".$row_operasi['nomr']."' and a.id_admission = '".$row_operasi['IDXDAFTAR']."'";
$res_operasi2=mysql_query($ret_operasi2);
$row_operasi2=@mysql_fetch_array($res_operasi2);

$ret_operasi3="select * from t_operasi  where id_operasi='".$_GET['idoperasi']."'";
$res_operasi3=mysql_query($ret_operasi3);
$row_operasi3=@mysql_fetch_array($res_operasi3);

?>

<div align="center">
  <div id="frame" style="width:100%;">
  <div id="frame_title">
  <h3 align="left">LAPORAN OPERASI</h3></div>
<form id="form1" name="form1" method="POST" action="index.php?link=204">
<input type="hidden" value="<?php echo $row_operasi3['JNSOPERASI'];?>" name="jnsoperasi" />
<input type="hidden" value="<?php echo $row_operasi['nomr'];?>" name="nomr" />
<input type="hidden" value="<?php echo $row_operasi['IDXDAFTAR'];?>" name="idxdaftar" />
<input type="hidden" value="<?php echo $row_operasi2['noruang'];?>" name="noruang" />
  <table width="900" border="0" cellpadding="0" cellspacing="0" class="tb" align="center">
    <tr valign="top">
      <td colspan="4"><div align="center"><a href="index.php?link=20" class="text">KEMBALI</a>
      <br />
      <br />
      
          <input name="id" type="hidden" id="id" value="<? echo $_GET['idoperasi'];?>">
      </div></td>
    </tr>
    <tr valign="top">
      <td colspan="4"><table width="100%" border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>Nomer Pasien (NOMR)</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi['nomr'];?>
          </strong></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>Nama</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi['nama'];?>
          </strong></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>Umur</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi1['usia'];?>
          </strong>Tahun</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>RUANG/Nomer Tempat Tidur</td>
          <td>:</td>
          <td><strong><? echo $row_operasi2[2]."/".$row_operasi2[1];?></strong></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Nama Ahli Bedah</td>
          <td>:</td>
          <td><strong>
          <select class="text" name="dokteroperator" id="dokteroperator">
          	<option value=""> -- </option>
		<?php 
	  		$q="SELECT a.kddokter, b.NAMADOKTER FROM m_dokter_jaga a 
JOIN m_dokter b ON a.kddokter = b.kddokter
WHERE a.kdpoly = 4 ORDER BY NAMADOKTER ASC";
	  		$h=mysql_query($q);
	 		while($b=mysql_fetch_array($h)){
	  			?><option value="<?=$b['kddokter'];?>" <? if($row_operasi3['kode_dokteroperator']==$b['kddokter']) echo "selected=selected"; ?> ><?=$b['NAMADOKTER'];?></option>
              <? }?>
          </select>
           </strong></td>
          <td>&nbsp;</td>
          <td>Jenis Anestesi</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi3['jenisanastesi'];?>
          </strong></td>
        </tr>
        <tr>
          <td>Nama Ahli Anesthesi</td>
          <td>:</td>
          <td><strong>
          <select class="text" name="dokteranastesi" id="dokteranastesi">
          	<option value=""> -- </option>
              <?php 
			  	$q1="SELECT a.kddokter, b.NAMADOKTER FROM m_dokter_jaga a 
JOIN m_dokter b ON a.kddokter = b.kddokter
WHERE a.kdpoly = 8 ORDER BY NAMADOKTER ASC";
	 	 		$h1=mysql_query($q1);
	  			while($b1=mysql_fetch_array($h1)){
	  			?><option value="<?=$b1['kddokter'];?>" <? if($row_operasi3['kode_dokteranastesi']==$b1['kddokter']) echo "selected=selected"; ?>  ><?=$b1['NAMADOKTER'];?></option>
              	<? 
				}
				?>
          </select>
            
          </strong></td>
          <td>&nbsp;</td>
          <td>Metode</td>
          <td>:</td>
          <td><strong>
            <input type="text" name="metode" class="text" value="<?=$row_operasi3['metodeanastesi'];?>" />
          </strong></td>
        </tr>
        <tr>
            <td>Nama Dokter Anak</td>
            <td>:</td>
            <td> <select class="text" name="dokteranak" id="dokteranak">
            	<option value=""> -- </option>
		<?php 
	  		$q="SELECT a.kddokter, b.NAMADOKTER FROM m_dokter_jaga a 
JOIN m_dokter b ON a.kddokter = b.kddokter
WHERE a.kdpoly = 3 ORDER BY NAMADOKTER ASC";
	  		$h=mysql_query($q);
	 		while($b=mysql_fetch_array($h)){
	  			?><option value="<?=$b['kddokter'];?>" <? if($row_operasi3['kode_dokteranak']== $b['kddokter']) echo "selected=selected"; ?> ><?=$b['NAMADOKTER'];?></option>
              <? }?>
          </select></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Nama Asisten</td>
          <td>:</td>
          <td><strong>
            <input name="asistenoperator" class="text" type="text" id="asistenoperator" size="40" value="<?=$row_operasi3['asistenoperator']?>" />
			          </strong></td>
          <td>&nbsp;</td>
          <td rowspan="2" valign="top">Diagnosis pre-operatif </td>
          <td rowspan="2" valign="top">:</td>
          <td rowspan="2" valign="top"><strong>
            <textarea name="tindakan" id="tindakan" cols="40" rows="7"><?=$row_operasi3['diagnosa'];?></textarea>
          </strong></td>
        </tr>
        <tr>
          <td>Nama Perawat </td>
          <td>:</td>
          <td><strong>
            <input name="perawatinstrumen" class="text" type="text" id="perawatinstrumen" size="40" value="<?=$row_operasi3['perawatinstrumen']?>" />
            ,
            <input name="perawatsirkuler" class="text" type="text" id="perawatsirkuler" size="40" value="<?=$row_operasi3['perawatsirkuler']?>" />
          </strong></td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
      </tr>
    <tr valign="top">
      <td width="31%">&nbsp;</td>
      <td width="27%">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr valign="top">
      <td colspan="2">Diagnosis post-operatif :<br>
        <label>
        <textarea name="tindakan" id="tindakan" cols="40" rows="10"><?=$row_operasi3['tindakan']?></textarea>
        
      </label></td>
      <td colspan="2"><fieldset><legend>Macam pembedahan : </legend><br> 
        <label>
        <input type="radio" name="pembedahan" value="BESAR" id="pembedahan_0" <? if($row_operasi3['pembedahan']=="BESAR") echo "checked=checked"; ?> >
Besar</label>
        <br>
        <label>
        <input type="radio" name="pembedahan" value="SEDANG" id="pembedahan_1" <? if($row_operasi3['pembedahan']=="SEDANG") echo "checked=checked"; ?> >
Sedang</label>
        <br>
        <label>
        <input type="radio" name="pembedahan" value="KECIL" id="pembedahan_2" <? if($row_operasi3['pembedahan']=="KECIL") echo "checked=checked"; ?> >
Kecil</label>
        <br>
        <label>
        <input type="radio" name="pembedahan" value="ELECTIVE" id="pembedahan_3" <? if($row_operasi3['pembedahan']=="ELECTIVE") echo "checked=checked"; ?> >
Elective</label>
        <br>
        <label>
        <input type="radio" name="pembedahan" value="EMERGENCY" id="pembedahan_4" <? if($row_operasi3['pembedahan']=="EMERGENCY") echo "checked=checked"; ?> >
Emergency</label>
        <br />
         <input type="radio" name="pembedahan" value="KHUSUS" id="pembedahan_5" <? if($row_operasi3['pembedahan']=="KHUSUS") echo "checked=checked"; ?> >
Khusus</label></fieldset>
        <br />
        <fieldset><legend>Dikirim untuk Pemeriksaan PA : </legend><br>
        <label>
        <input type="radio" name="pemeriksaanPA" value="YA" id="RadioGroup2_0" <? if($row_operasi3['pemeriksaanPA']=="YA") echo "checked=checked"; ?> >
Ya</label>
        <br>
        <label>
        <input type="radio" name="pemeriksaanPA" value="TIDAK" id="RadioGroup2_1" <? if($row_operasi3['pemeriksaanPA']=="TIDAK") echo "checked=checked"; ?> >
Tidak</label>
           </fieldset></td>
    </tr>
    <tr valign="top">
      <td colspan="2">Jaringan yang di-Eksisis-Insisi : <br>
        <label>
        <textarea name="jaringan" id="jaringan" cols="40" rows="7"><?=$row_operasi3['jaringan']?></textarea>
      </label>
        <br>
      <label></label></td>
      <td colspan="2"><p>
          <label></label>
          Nama/Macam Operasi : <br>
          <input type="text" name="macamoperasi" id="macamoperasi" size="50" class="text" maxlength="30" value="<?php echo $row_operasi3['macamoperasi'];?>" />
          <br><br>ICD 9 : <br>
          <input type="text" name="icd9" id="macamoperasi" size="50" class="text" maxlength="6" value="<?php echo $row_operasi3['ICD9'];?>" />
          <br><br>ICD 10 : <br>
          <input type="text" name="icd10" id="macamoperasi" size="50" class="text" maxlength="10" value="<?php echo $row_operasi3['ICD10'];?>" />
		  <?php if($row_operasi2['noruang'] == 15){ ?>
          <br><br>Tujuan Keluar<br>
          <input type="radio" name="keluar" value="pulang" <?php if($row_operasi3['KELUAR'] == 'pulang'){ echo 'checked="checked"'; }?>> Pulang
          <input type="radio" name="keluar" value="ranap" <?php if($row_operasi3['KELUAR'] == 'ranap'){ echo 'checked="checked"'; }?>> Perlu Rawat Inap
		  <?php } ?>
          <br>
      </p></td>
    </tr>
    
  
    <tr valign="top">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr valign="top">
      <td colspan="4"><table width="100%" border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td>Tanggal Operasi</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi3['tanggal'];?>
          </strong></td>
          <td>Jam Operasi dimulai</td>
          <td>:</td>
          <td><input name="jammulai" type="text" id="jammulai" size="10" value="<?=$row_operasi3['jammulai'];?>" class="text"/></td>
          <td>Jam Operasi Selesai</td>
          <td>:</td>
          <td><input name="jamselesai" type="text" id="jamselesai" value="<?=$row_operasi3['jamselesai'];?>" size="10" maxlength="10" class="text" /></td>
        </tr>
      </table></td>
      </tr>
    <tr valign="top">
      <td colspan="4"><p>
        <input type="hidden" name="laporan" id="laporan" value="KOSONG"/>
      </p>
            <label><br><input name="Submit" type="submit" id="Submit" class="text" value="Simpan Laporan">
            </label></td>
    </tr>
  </table>
</form>
</div></div>