<?php 
/*
if(!isset($dbhost))
{

}
   */
$hostname = $dbhost;
$database = $dbname;
$username = $dbuser;
$password = $dbpass;
$connect = mysql_connect($hostname, $username, $password,true,65536) or die(mysql_error()); 
mysql_select_db($database,$connect)or die(mysql_error());


?>
<div align="center">
	<div id="frame">
    	<div id="frame_title"><h3>Rekap Mordibilitas Rajal</h3></div>
<form name="formsearch" method="get" >
<table class="tb">
  <tr>
    <td>Poly</td>
    <td><select name="POLY" class="text" id="POLY">
      <?  
		  $qrypoly  = mysql_query("SELECT * FROM m_poly ORDER BY kode ASC");
				while ($listpoly = mysql_fetch_array($qrypoly)){
			 ?>
      
      <option value="<? echo $listpoly['kode'];?>"> <? echo $listpoly['nama'];?></option>
      <? } ?>
    </select></td>
  </tr>
  <tr>
    <td>BULAN</td>
    <td><select name="kdbulan" class="text" id="kdbulan">   
              <option value="00">-Pilih Bulan-</option>
              <option value="01">Januari</option>
              <option value="02">Februari</option>
              <option value="03">Maret</option>
              <option value="04">April</option>
              <option value="05">Mei</option>
              <option value="06">Juni</option>
              <option value="07">July</option>
              <option value="08">Agustus</option>
              <option value="09">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>              
        </select>
    </td>
  </tr>
  <tr>
    <td>TAHUN</td>
    <td><input type="text" name="tahun" id="tahun" class="text" value="" /></td>
  </tr>
  <tr>
    <td colspan="2" ><input type="hidden" name="link" value="143R" />      <input type="submit" value="CARI" class="text" /></td>
  </tr>
</table>
</form>
<p>
  <?php 
     if (!empty($_GET['kdbulan'])) {
		 $bln=$_GET['kdbulan'];
	} else {$bln='00';}
	 if (!empty($_GET['tahun'])){
		 $thn=$_GET['tahun'];
	} else {$thn='1000';}
	 if (!empty($_GET['POLY'])){
		 $poly=$_GET['POLY'];
	} else {$poly='1000';}
$sql="select a.kdpoly, sum( if(b.jeniskelamin='P',1, null)) as P, sum( if(b.jeniskelamin='L',1, null)) as L,
sum( if(a.tglreg-b.tgllahir >= 0 and a.tglreg-b.tgllahir<28,1, null)) as _28hr,
sum( if(a.tglreg-b.tgllahir >= 28 and year(a.tglreg)-year(b.tgllahir)<1,1, null)) as _1thn,
sum( if(year(a.tglreg)-year(b.tgllahir) >= 1 and year(a.tglreg)-year(b.tgllahir)<=4,1, null)) as _4thn,
sum( if(year(a.tglreg)-year(b.tgllahir) >= 5 and year(a.tglreg)-year(b.tgllahir)<=14,1, null)) as _14thn,
sum( if(year(a.tglreg)-year(b.tgllahir) >= 15 and year(a.tglreg)-year(b.tgllahir)<=24,1, null)) as _24thn,
sum( if(year(a.tglreg)-year(b.tgllahir) >= 25 and year(a.tglreg)-year(b.tgllahir)<=44,1, null)) as _44thn,
sum( if(year(a.tglreg)-year(b.tgllahir) >= 45 and year(a.tglreg)-year(b.tgllahir)<=64,1, null)) as _64thn,
sum( if(year(a.tglreg)-year(b.tgllahir) >= 65,1, null)) as _65thn,
sum( if(a.pasienbaru=1,1, null)) as PengunjungB,
sum( if(a.pasienbaru=0,1, null)) as PengunjungL,
sum( if(d.kunjungan_bl=1,1, null)) as KunjunganB,
sum( if(d.kunjungan_bl=0,1, null)) as KunjunganL,
sum( if(d.kasus_bl=1,1, null)) as KasusB,
sum( if(d.kasus_bl=0,1, null)) as KasusL,
d.diagnosa,d.icd_code
from t_pendaftaran a
inner join m_pasien b on a.nomr=b.nomr
left join t_diagnosadanterapi d on a.idxdaftar=d.idxdaftar
where CONCAT(YEAR(a.tglreg),LPAD(MONTH(a.tglreg),2,0)) =".$thn.$bln." and a.kdpoly=".$poly." 
group by a.kdpoly,d.diagnosa,d.icd_code";
$qry = mysql_query($sql) or die (mysql_error());
?>
</p>
<p>INDEX PENYAKIT RAWAT JALAN <br />
POLY <?php $a="select nama from m_poly where kode=".$poly; $q=mysql_query($a) or die (mysql_error());  
while ($list = mysql_fetch_array($q)){ echo $list['nama'];}?> 
<BR />PERIODE BULAN
  <?= $_GET["kdbulan"]?>
Tahun
<?=$_GET["tahun"] ?>
</p>
<table width="200" border="1" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <td rowspan="2">No</td>
    <td colspan="2">Jenis Kelamin</td>
    <td rowspan="2">Total</td>
    <td colspan="8">Umur</td>
    <td rowspan="2">Total</td>
    <td colspan="2">Pengunjung</td>
    <td rowspan="2">Total</td>
    <td colspan="2">Kunjungan</td>
    <td rowspan="2">Total</td>
    <td colspan="2">Kasus Penyakit</td>
    <td rowspan="2">Diagnosa</td>
    <td rowspan="2">ICD</td>
    <td rowspan="2">Total</td>
  </tr>
  <tr>
    <td>L</td>
    <td>P</td>
    <td>0-28hr</td>
    <td>&lt; 1thn</td>
    <td>1-4thn</td>
    <td>5-14thn</td>
    <td>15-24thn</td>
    <td>25-44thn</td>
    <td>45-64thn</td>
    <td>65+ thn</td>
    <td>B</td>
    <td>L</td>
    <td>B</td>
    <td>L</td>
    <td>B</td>
    <td>L</td>
  </tr>
  <? $i=1; while ($list = mysql_fetch_array($qry)){  ?>  
  <tr>
    <td><?= $i;?></td>
    <td><?= $list['L'];?></td>
    <td><?= $list['P'];?></td>
    <td><?= $list['L']+$list['P'];?></td>
    <td><?= $list['_28hr'];?></td>
    <td><?= $list['_1thn'];?></td>
    <td><?= $list['_4thn'];?></td>
    <td><?= $list['_14thn'];?></td>
    <td><?= $list['_24thn'];?></td>
    <td><?= $list['_44thn'];?></td>
    <td><?= $list['_64thn'];?></td>
    <td><?= $list['_65thn'];?></td>
    <td><?= $list['_28hr']+$list['_1thn']+$list['_4thn']+$list['_14thn']+$list['_24thn']+$list['_44thn']+$list['_64thn']+$list['_65thn'];?></td>
    <td><?= $list['PengunjungB'];?></td>
    <td><?= $list['PengunjungL'];?></td>
    <td><?= $list['PengunjungB']+$list['PengunjungL'];?></td>
    <td><?= $list['KunjunganB'];?></td>
    <td><?= $list['KunjunganL'];?></td>
    <td><?= $list['KunjunganB']+$list['KunjunganL'];?></td>
    <td><?= $list['KasusB'];?></td>
    <td><?= $list['KasusL'];?></td>
    <td><?= $list['diagnosa'];?></td>
    <td><?= $list['icd_code'];?></td>
    <td><?= $list['KasusB']+$list['KasusL'];?></td>
  </tr>
   <? $i=$i+1; } ?>  
</table>
	</div>
  <div>
<br />
<form name="formprint" method="post" action="rm/excelexport.php" target="_blank" >
<input type="hidden" name="query" value="<?=$sql?>" />
<input type="hidden" name="header" value="Rekap Mordibilitas Rajal" />
<input type="hidden" name="filename" value="RekapMordibitasRajal" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
    
    </div>    
</div>
