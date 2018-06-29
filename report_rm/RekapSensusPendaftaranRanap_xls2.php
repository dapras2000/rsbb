<div id="frame_title" ><h3>Rekap Sensus Pendaftaran Rawat Inap</h3></div>
<p>DATA PASIEN RAWAT INAP PERIODE BULAN <?= $_GET["kdbulan"]?> Tahun <?=$_GET["tahun"] ?></p>
<?php 
     if (!empty($_GET['kdbulan'])) {
		 $bln=$_GET['kdbulan'];
	} else {$bln='00';}
	 if (!empty($_GET['tahun'])){
		 $thn=$_GET['tahun'];
	} else {$thn='1000';}

$sql="
SELECT date(c.masukrs) as tgl , sum( if(a.jeniskelamin='P',1, null)) as P, sum( if(a.jeniskelamin='L',1, null)) as L,
sum(  if(e.kdpoly=9,1, null)) as UGD,
sum(  if(e.kdpoly=10,1, null)) as VK,
sum(  if(e.kdpoly in(1,2,3,4,5,6,7,8,11,28,29,30),1, null)) as POLY,
sum( if(e.kdrujuk=1,1, null)) as DS,
sum( if(e.kdrujuk=2,1, null)) as PKM,
sum( if(e.kdrujuk=3,1, null)) as RS,
sum( if(e.kdrujuk=4,1, null)) as DS_LAIN,
sum( if(c.statusbayar=1,1, null)) as umum,
sum( if(c.statusbayar=2,1, null)) as askes,
sum( if(c.statusbayar=3,1, null)) as jmks,
sum( if(c.statusbayar=4,1, null)) as sktm,
sum( if(c.statusbayar=6,1, null)) as jmks_bogor,
sum( if(c.statusbayar=8,1, null)) as jampersal,
sum( if(c.statusbayar=5,1, null)) as crbayarlain
FROM t_admission c
inner join t_pendaftaran e on c.id_admission=e.idxdaftar
inner join m_pasien a on a.nomr=c.nomr
where CONCAT(YEAR(date(c.masukrs)),LPAD(MONTH(date(c.masukrs)),2,0)) =".$thn.$bln."
GROUP BY date(c.masukrs)";

?>

<table width="95%" border="1" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <th rowspan="3">Tanggal <br /></th>
    <th colspan="2"><div align="center">Jenis Kelamin</div></th>
    <th rowspan="3">Total</th>
    <th colspan="3">Cara Penerimaan</th>
    <th rowspan="3">Total<br /></th>
    <th colspan="7"><div align="center">Cara Bayar</div></th>
    <th rowspan="3">Total</th>
    <th colspan="4">Asal Pasien</th>
    <th rowspan="3">Total</th>
  </tr>
  <tr>
    <th rowspan="2">L</th>
    <th rowspan="2">P</th>
    <th rowspan="2">UGD</th>
    <th rowspan="2">Poly</th>
    <th rowspan="2">VK</th>
    <th rowspan="2">Tunai</th>
    <th rowspan="2">askes</th>
    <th rowspan="2">Jmks</th>
    <th rowspan="2">Jmks Depok</th>
    <th rowspan="2">Jmks Bogor</th>
    <th rowspan="2">Jampersal</th>
    <th rowspan="2">Lain2</th>
    <th rowspan="2">Datang Sendiri </th>
    <th colspan="3">Rujuk</th>
  </tr>
  <tr>
    <th>PKM</th>
    <th>RS </th>
    <th>Lain Lain</th>
  </tr>
  <?php
       $rs=mysql_query($sql);
	  if(!$rs) die(mysql_error());
       while ($data = mysql_fetch_array($rs)) {
  ?>
  <tr>
    <td><?=$data['tgl'];?></td>
    <td><?=$data['L'];?></td>
    <td><?=$data['P'];?></td>
    <td><?=$data['L']+$data['P'];?></td>
    <td><?=$data['UGD'];?></td>
    <td><?=$data['POLY'];?></td>
    <td><?=$data['VK'];?></td>
    <td><?=$data['UGD']+$data['POLY']+$data['VK'];?></td>
    <td><?=$data['umum'];?></td>
    <td><?=$data['askes'];?></td>
    <td><?=$data['jmks'];?></td>
    <td><?=$data['sktm'];?></td>
    <td><?=$data['jmks_bogor'];?></td>
    <td><?=$data['jampersal'];?></td>
    <td><?=$data['crbayarlain'];?></td>
    <td><?=$data['umum']+$data['askes']+$data['jmks']+$data['sktm']+$data['crbayarlain']+$data['jmks_bogor']+$data['jampersal'];?></td>
    <td><?=$data['DS'];?></td>
    <td><?=$data['PKM'];?></td>
    <td><?=$data['RS'];?></td>
    <td><?=$data['DS_LAIN'];?></td>
    <td><?=$data['DS']+$data['PKM']+$data['RS']+$data['DS_LAIN'];?></td>
  </tr>
   <?php } ?>   
</table>