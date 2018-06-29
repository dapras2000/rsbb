<div align="center">
    <div id="frame" style="width:95%">
    <div id="frame_title"><h3>BUKU REGISTER RANAP</h3></div>
<?php
include("../include/connect.php");
?>
<div align="right" >
<form name="formsearch" method="get" >
<table class="tb" width="294" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="158">Ruang</td>
    <td width="136"><select name="kdruang" class="text" id="kdruang">   
              <option value=0 <?php if ($ruangskrg==0) echo "selected=selected"?>>-Pilih Ruang-</option>
              <?php 
			    if (empty($_GET['kdbulan']) || $_GET['kdbulan']=="00") 
					{$blnskrg=date("m");} else{$blnskrg=$_GET['kdbulan'];}
				if (empty($_GET['tahun'])) 
					{$thnskrg=date("Y");} else{$thnskrg=$_GET['tahun'];}
				if (empty($_GET['pasien'])) 
					{$pasienskrg="";} else{$pasienskrg=" and b.nama like '%".$_GET['pasien']."%' ";}
				if (empty($_GET['diagnosa'])) 
					{$diagnosa="";} else{$diagnosa=" and concat(IFNULL(g.jenis_penyakit,''),IFNULL(h.jenis_penyakit,'')) like '%".$_GET['diagnosa']."%' ";}	
				if (empty($_GET['kdruang']) || $_GET['kdruang']==0) 
					{$ruangskrg="";} else{$ruangskrg=" and a.noruang =".$_GET['kdruang'];}
			    		$sql='select no,nama from m_ruang ';
			    		$rs=mysql_query($sql);
		 		if(!$rs) die(mysql_error());
       				while ($data = mysql_fetch_array($rs)) { 
			  ?>
              <option value=<?= $data['no'];?> <?php if ($_GET['kdruang']==$data['no']) echo "selected=selected"?>> <?=$data['nama'];?></option>
              <?php }  ?>
        </select></td>
  </tr>
  <tr>
    <td>Bulan</td>
    <td><select name="kdbulan" class="text" id="kdbulan" >   
              <option value="00">-Pilih Bulan-</option>
              <option value="01" <?php if ($blnskrg=="01") echo "selected=selected"?> >Januari</option>
              <option value="02" <?php if ($blnskrg=="02") echo "selected=selected"?>>Februari</option>
              <option value="03" <?php if ($blnskrg=="03") echo "selected=selected"?>>Maret</option>
              <option value="04" <?php if ($blnskrg=="04") echo "selected=selected"?>>April</option>
              <option value="05" <?php if ($blnskrg=="05") echo "selected=selected"?>>Mei</option>
              <option value="06" <?php if ($blnskrg=="06") echo "selected=selected"?>>Juni</option>
              <option value="07" <?php if ($blnskrg=="07") echo "selected=selected"?>>July</option>
              <option value="08" <?php if ($blnskrg=="08") echo "selected=selected"?>>Agustus</option>
              <option value="09" <?php if ($blnskrg=="09") echo "selected=selected"?>>September</option>
              <option value="10" <?php if ($blnskrg=="10") echo "selected=selected"?>>Oktober</option>
              <option value="11" <?php if ($blnskrg=="11") echo "selected=selected"?>>November</option>
              <option value="12" <?php if ($blnskrg=="12") echo "selected=selected"?>>Desember</option>              
        </select></td>
  </tr>
  <tr>
    <td>Tahun</td>
    <td><input type="text" name="tahun" id="tahun" class="text" value="<?=$thnskrg;?>" /></td>
  </tr>
  <tr>
    <td>Nama Pasien</td>
    <td><input type="text" name="pasien" id="pasien" class="text" value="<?=$_GET['pasien']?>" /></td>
  </tr>
  <tr>
    <td>Diagnosa</td>
    <td><input type="text" name="diagnosa" id="diagnosa" class="text" value="<?=$_GET['diagnosa']?>" /></td>
  </tr>
  <tr>
    <td><input type="hidden" name="link" value="122x" /></td>
    <td><input type="submit" value="CARI" class="text" /></td>
  </tr>
  
</table>
</form>
</div>
<p>&nbsp;</p>
<?php 
$sql="SELECT DATE_FORMAT(a.masukrs,'%d/%m/%Y') AS tglmasuk, DATE_FORMAT(a.masukrs,'%H:%i') AS jammasuk, a.nomr, b.NAMA,
YEAR(a.masukrs)-YEAR(b.tgllahir) AS umur, 
b.JENISKELAMIN, b.PEKERJAAN, b.ALAMAT, a.panggungjawab, c.nama AS ruang, d.jenis_penyakit AS diagnosa_masuk, e.nama AS poly,
f.NAMADOKTER, f.NAMADOKTER AS dokter_merawat, DATE_FORMAT(a.keluarrs,'%d/%m/%Y') AS tglkeluar, DATE_FORMAT(a.keluarrs,'%H:%i') AS jamkeluar,
h.jenis_penyakit AS diagnosa_keluar, i.NAMA AS carabayar
FROM t_admission a
JOIN m_pasien b ON a.nomr = b.NOMR
JOIN m_ruang c ON a.noruang = c.no
LEFT JOIN icd d ON a.icd_masuk = d.icd_code
JOIN m_poly e ON e.kode = a.kirimdari
LEFT JOIN m_dokter f ON f.KDDOKTER = a.dokterpengirim
LEFT JOIN m_dokter g ON g.KDDOKTER = a.dokter_penanggungjawab
LEFT JOIN icd h ON h.icd_code = a.icd_keluar 
JOIN m_carabayar i ON i.KODE = a.statusbayar
where DATE_FORMAT(a.masukrs,'%Y%m')='".$thnskrg.$blnskrg."'".$pasienskrg.$ruangskrg.$diagnosa." 
order by a.masukrs" ;
?>
<div style="overflow:scroll" >
<table class="tb" width="1341" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <th width="20">No</th>
    <th width="52">Tgl Masuk</th>
    <th width="44">Jam Masuk</th>
    <th width="60">No RM</th>
    <th width="93">Nama Pasien</th>
    <th width="39">Umur</th>
    <th width="39">Jenis</th>
    <th width="66">Pekerjaan</th>
    <th width="83">Alamat</th>
    <th width="83">Penanggung</th>
    <th width="79">Ruang</th>
    <th width="107">Diagnosa Masuk</th>
    <th width="49">Entry</th>
    <th width="90">Dr Pengirim</th>
    <th width="81">Dr Merawat</th>
    <th width="67">Tgl Keluar</th>
    <th width="43">Jam Keluar</th>
    <th width="99">Diagnosa Keluar</th>
    <th width="55">Status ADM</th>
  </tr>
  <?php $i = 1;
    $rs=mysql_query($sql);
	if(!$rs) die(mysql_error());
	while($data = mysql_fetch_array($rs)) {?>
  <tr>
    <td align="center"><?=$i?></td>
    <td><?=$data['tglmasuk'];?></td>
    <td><?=$data['jammasuk'];?></td>
	<td><?=$data['nomr'];?></td>
	<td><?=$data['NAMA'];?></td>
	<td><?=$data['umur'];?></td>
	<td><?=$data['JENISKELAMIN'];?></td>
	<td><?=$data['PEKERJAAN'];?></td>
	<td><?=$data['ALAMAT'];?></td>
	<td><?=$data['panggungjawab'];?></td>
	<td><?=$data['ruang'];?></td>
	<td><?=$data['diagnosa_masuk'];?></td>
	<td><?=$data['poly'];?></td>
	<td><?=$data['NAMADOKTER'];?></td>
	<td><?=$data['dokter_merawat'];?></td>
	<td><?=$data['tglkeluar'];?></td>
	<td><?=$data['jamkeluar'];?></td>
	<td><?=$data['diagnosa_keluar'];?></td>
	<td><?=$data['carabayar'];?></td>
  </tr>
  <?php $i++; 
  } ?>
</table>
</div>
</div>
</div>
<br />

<form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
<input type="hidden" name="query" value="<?=$sql?>" />
<input type="hidden" name="header" value="BUKU REGISTER RAWAT INAP <?=$blnskrg." ".$thnskrg?>" />
<input type="hidden" name="filename" value="reg_ranap" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
</div>
