<!-- Admission-->
<script type="text/javascript" src="ranap/datetimepicker_css.js"></script>
<script type="text/javascript">
jQuery().ready(function() {
jQuery("#targetDiv").autocomplete("admission/include/mysql.php",{width: 260});
jQuery("#icdmasuk").autocomplete("admission/include/icdmasuk.php",{width:260});
});
</script>
<?php
$ss = mysql_query('select * from t_admission where id_admission = "'.$_REQUEST['idx'].'" and keluarrs is null');
if(mysql_num_rows($ss) > 0){
	?>
    <script>
	alert("pasien sudah berada di rawatinap");
	window.location = '<?php echo _BASE_;?>index.php?link=175&indeks=<?php echo $_REQUEST['idx'];?>';
	</script>
    <?
}
$query="SELECT a.NOMR, a.KDCARABAYAR, a.KDPOLY, 
			a.KDRUJUK, a.IDXDAFTAR, a.TGLREG, 
        	b.NAMA, b.ALAMAT, b.TEMPAT, b.TGLLAHIR, b.JENISKELAMIN, 
        	c.NAMA AS POLY, 
        	d.NAMA AS RUJUKAN, 
        	e.NAMADOKTER, e.KDDOKTER, 
        	f.NAMA AS CARABAYAR
		FROM t_pendaftaran a, m_pasien b, 
        	m_poly c, m_rujukan d, m_dokter e, m_carabayar f
		WHERE a.NOMR=b.NOMR AND a.KDPOLY=c.KODE 
        	AND a.KDRUJUK=d.KODE AND a.KDDOKTER=e.KDDOKTER 
        	AND a.KDCARABAYAR=f.KODE AND a.IDXDAFTAR = ".$_GET['idx'];
$hasil=mysql_query($query);
$baris=mysql_fetch_assoc($hasil);
 ?>  
<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>FORM DAFTAR RAWAT INAP</h3></div>
    <div align="center" style="margin:5px;"> 

<form id="form_admission" name="form_admission" method="post" action="index.php?link=174x">
	<input name="idx" type="hidden" value="<?=$_GET['idx']?>">
  <table width="100%" border="0" align="center" class="tb">
    <tr>
      <td width="140"><strong>DATA PASIEN</strong></td>
      <td width="160">&nbsp;</td>
      <td width="216"><strong>DAFTAR</strong></td>
      <td width="450">&nbsp;</td>
    </tr>
    <tr>
      <td><div>Nomer MR</div></td>
      <td><?=$baris['NOMR']?>
        <input name="nomr" type="hidden" value="<?=$baris['NOMR']?>" /></td>
      <td>Ruang Rawat:</td>
      <td><a href="index.php?link=173x&amp;no=<?=$_GET['idx'];?>">
        <input type="button" class="text" value="Pilih Kamar" />
      </a></td>
    </tr>
          
        
<tr>
      <td><div>Nama Pasien:</div></td>
      <td><label><? echo $baris['NAMA'];?></label>
        <input name="idxdaftar" type="hidden" value="<?=$baris['IDXDAFTAR']?>" /></td>
      <td>Nama Kamar:</td>
      <td><input name="ruang" type="text" id="ruang" class="text" value="<?=$_GET['namaruang'];?>" readonly="readonly"/></td>
    </tr>
    <tr>
      <td><div>Tempat/Tgl Lahir:</div></td>
      <td><label><? echo $baris['TEMPAT'];?>/<? echo $baris['TGLLAHIR'];?></label></td>
      <td>Nomer Tempat Tidur:</td>
      <td><input name="nott" type="text" id="nott" class="text" value="<?=$_GET['no_tt'];?>" readonly="readonly"/>
        <input name="idruang" type="hidden" id="idruang" value="<?=$_GET['idruang'];?>" /></td>
    </tr>
    <tr>
      <td><div>Jenis Kelamin:</div></td>
      <td><? if($baris['JENISKELAMIN']=="L"){echo "Laki-laki";}elseif($baris['JENISKELAMIN']=="P"){ echo"Perempuan"; }else{ echo"-";}?></td>
      <td>Kode ICD masuk: (autocomplete)</td>
      <td><input type="text" name="q" class="text" size="65" id="icdmasuk" onkeypress="if(enter_pressed(event))
          {
                        var str=document.getElementById('icdmasuk').value;
                        var kode=str.split('--');
                        document.getElementById('kicd').value=kode[1];  
                        }"/>
        <input type="text" readonly="readonly" class="text" size="5" name="kicd" id="kicd"/>
      </td>
    </tr>
    <tr>
      <td><div>Alamat Pasien:</div></td>
      <td><? echo $baris['ALAMAT'];?></td>
      <td><div>Keluarga Terdekat:</div></td>
      <td><label>
        <input type="text" name="keluargadekat" class="text" id="keluargadekat" />
        #</label></td>
      </tr>
    <tr>
      <td><div>Masuk Rumah Sakit :</div></td><?php date('Y/m/d',mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'))); mktime(jam,min,sec,mon,day,year)?>
      <td><input type="text" name="tgl_masuk" id="tgl_masuk"  class="text" 
              value="<?php echo date("Y/m/d h:m:s"); ?>"/><a href="javascript: NewCssCal('tgl_masuk','yyyymmdd','arrow',true)"><img src="ranap/images/cal.gif" width="16" height="16" alt="Pick a date"></a> </td>
      <td><div>Penanggung Jawab Pasien:</div></td>
      <td><label>
        <input type="text" name="penanggungjawab" class="text" id="penanggungjawab" />
        #</label></td>
      </tr>
    <tr>
      <td><div>Dokter Pengirim/Poly : </div></td>
      <td><?php echo $baris['NAMADOKTER']; ?>
        <input name="namadokter" type="hidden" value="<?=$baris['KDDOKTER']?>" /></td>
      <td><div>Uang Deposit:</div></td>
      <td><label> Rp.
        <input type="text" name="deposit" class="text" id="deposit" />
        #</label></td>
      </tr>
    <tr>
      <td>Asal Pasien</td>
      <td><? echo $baris['RUJUKAN'];?>
        <input name="kirimdari" type="hidden" value="<?=$baris['KDRUJUK']?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div>Status Pembayaran:</div></td>
      <td><? echo $baris['CARABAYAR'];?>
        <input name="statusbayar" type="hidden" value="<?=$baris['KDCARABAYAR']?>" /></td>
      <td>Dokter Penangung Jawab</td>
      <td><select name="dokter" class="text">
        <option value="" >-- Pilih dokter --</option>
        <? 
	  		
			$sql_dokter = "SELECT KDDOKTER, NAMADOKTER FROM m_dokter";
			$get_dokter = mysql_query($sql_dokter);
			while($dat_dokter = mysql_fetch_array($get_dokter)){
	  ?>
        <option value="<?=$dat_dokter['KDDOKTER']?>" >
          <?=$dat_dokter['NAMADOKTER']?>
          </option>
        <? } ?>
      </select></td>
    </tr>
    <tr>
      <td>Kiriman dari:</td>
      <td><? echo $baris['POLY'];?>
        <input name="asal" type="hidden" value="<?=$baris['POLYPENGIRIM']?>" /></td>
      <td>Perawat Penangung Jawab</td>
      <td>
	  <select name="perawat" class="text" >
	  <option value="" >-- Pilih perawat --</option>
	  <? 
	  		
			$sql_perawat = "SELECT DISTINCT NAMA, IDPERAWAT FROM m_perawat ORDER BY NAMA ASC";
			$get_perawat = mysql_query($sql_perawat);
			while($dat_perawat = mysql_fetch_array($get_perawat)){
	  ?>
      <option value="<?=$dat_perawat['IDPERAWAT']?>" ><?=$dat_perawat['NAMA']?></option>
      <? } ?>
      </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="simpan" id="simpan" class="text" value="Simpan" />
        </label></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</div></div></div>