<div id="frame_title"><h3>Rekap Poli Rawat Jalan</h3></div>
<p>DATA PASIEN RAWAT JALAN PERIODE BULAN <?= $_GET["kdbulan"]?> Tahun <?=$_GET["tahun"] ?></p>
<?php 
     if (!empty($_GET['kdbulan'])) {
		 $bln=$_GET['kdbulan'];
	} else {$bln='00';}
	 if (!empty($_GET['tahun'])){
		 $thn=$_GET['tahun'];
	} else {$thn='1000';}

	$ss	= mysql_query('select a.kdkecamatan, b.namakecamatan from (SELECT kdkecamatan FROM m_pasien group by kdkecamatan order by kdkecamatan DESC) as a left join m_kecamatan b on a.kdkecamatan = b.idkecamatan');
	$sql="SELECT b.nama, sum( if(a.jeniskelamin='P',1, null)) as P, sum( if(a.jeniskelamin='L',1, null)) as L,";
	$jumlahKec = 0;
	while($ds = mysql_fetch_array($ss)){
		if($ds['kdkecamatan'] == '0' || $ds['kdkecamatan'] == null){
			//$sql = $sql."sum( if(a.kdkecamatan=".$ds['kdkecamatan'].",1, null)) as ".$ds['namakecamatan'].",";
		}else{
			$sql = $sql."sum( if(a.kdkecamatan=".$ds['kdkecamatan'].",1, null)) as '".$ds['namakecamatan']."',";
			$jumlahKec++;
		}
	}
$sql = $sql."sum( if(c.kdcarabayar=1,1, null)) as umum,
sum( if(c.kdcarabayar=2,1, null)) as askes,
sum( if(c.kdcarabayar=3,1, null)) as jmks,
sum( if(c.kdcarabayar=4,1, null)) as sktm,
sum( if(c.kdcarabayar=5,1, null)) as crbayarlain,
sum( if(c.kdcarabayar=6,1, null)) as jmks_bgr,
sum( if(c.kdcarabayar=8,1, null)) as jampersal,
sum( if(c.status=1,1, null)) as Pulang,
sum( if(c.status=2,1, null)) as Rawat,
sum( if(c.status=5,1, null)) as PoliLain,
sum( if(c.status=6,1, null)) as RsLain,
sum( if(c.status=7,1, null)) as DOA,
sum( if(c.status=8,1, null)) as Meninggal,
sum( if(c.status=9,1, null)) as ODC,
sum( if(c.status=10,1, null)) as Kabur,
sum( if(c.pasienbaru=1,1, null)) as KunjunganB,
sum( if(c.pasienbaru=0,1, null)) as KunjunganL,
sum( if(d.kasus_bl=1,1, null)) as KasusB,
sum( if(ifnull(d.kasus_bl,0)=0,1, null)) as KasusL
FROM t_pendaftaran c
inner join m_poly b on c.kdpoly=b.kode
inner join m_pasien a on a.nomr=c.nomr
left join t_diagnosadanterapi d on c.idxdaftar=d.idxdaftar
where CONCAT(YEAR(c.tglreg),LPAD(MONTH(c.tglreg),2,0)) =".$thn.$bln."
GROUP BY b.nama";
?>

<table width="1050" cellpadding="0" cellspacing="0">
  <col width="73" />
  <col width="41" span="28" />
  
 
</table>
<div>
<table width="95%" border="1" cellpadding="1" cellspacing="1">
  <tr>
    <th rowspan="3">POLI <br />  KLINIK</th>
    <th colspan="2"><div align="center">Jenis Kelamin</div></th>
    <th rowspan="3">Total</th>
    <th colspan="<?=$jumlahKec;?>"><div align="center">ASAL WILAYAH KECAMATAN</div></th>
    <th rowspan="3">Total</th>
    <th colspan="7"><div align="center">Cara Bayar</div></th>
    <th rowspan="3">Total</th>
    <th colspan="8"><div align="center">Keadaan Keluar</div></th>
    <th rowspan="3">Total</th>
    <th colspan="2"><div align="center">Pengunjung</div></th>
    <th rowspan="3"><div align="center">Total</div></th>
    <th colspan="2"><div align="center">Kunjungan</div></th>
    <th rowspan="3"><div align="center">Total</div></th>
  </tr>
  <tr>
    <th rowspan="2">L</th>
    <th rowspan="2">P</th>
    <?
		$ss	= mysql_query('select a.kdkecamatan, b.namakecamatan from (SELECT kdkecamatan FROM m_pasien group by kdkecamatan order by kdkecamatan DESC) as a left join m_kecamatan b on a.kdkecamatan = b.idkecamatan');
		while($ds = mysql_fetch_array($ss)){
		if($ds['kdkecamatan'] == '0' || $ds['kdkecamatan'] == null){
		}else{
			echo '<th rowspan="2">'.$ds['namakecamatan'].'</th>';
		}
	}?>
    <th rowspan="2">Tunai</th>
    <th rowspan="2">askes</th>
    <th rowspan="2">Jmks</th>
    <th rowspan="2">Jmks Depok</th>
    <th rowspan="2">Jmks Bogor</th>
    <th rowspan="2">Jampersal</th>
    <th rowspan="2">Lain2</th>
    <th rowspan="2">Pulang</th>
    <th rowspan="2">Rawat</th>
    <th rowspan="2">ODC</th>
    <th colspan="2">Rujuk</th>
    <th rowspan="2">Kabur</th>
    <th rowspan="2">DOA</th>
    <th rowspan="2">Meninggal</th>
    <th rowspan="2">B</th>
    <th rowspan="2">L</th>
    <th rowspan="2">B</th>
    <th rowspan="2">L</th>
  </tr>
  <tr>
    <th>Poly Lain</th>
    <th>Rs Lain </th>
  </tr>
  <?php
       $rs=mysql_query($sql);
	  if(!$rs) die(mysql_error());
       while ($data = mysql_fetch_array($rs)) {
  ?>
  <tr>
    <td><?=$data['nama'];?></td>
    <td><?=$data['L'];?></td>
    <td><?=$data['P'];?></td>
    <td><?=$data['L']+$data['P'];?></td>
    <? $tampung = 0;
	$ss	= mysql_query('select a.kdkecamatan, b.namakecamatan from (SELECT kdkecamatan FROM m_pasien group by kdkecamatan order by kdkecamatan DESC) as a left join m_kecamatan b on a.kdkecamatan = b.idkecamatan');
	while($ds = mysql_fetch_array($ss)){
		if($ds['kdkecamatan'] == '0' || $ds['kdkecamatan'] == null){
			//$sql = $sql."sum( if(a.kdkecamatan=".$ds['kdkecamatan'].",1, null)) as ".$ds['namakecamatan'].",";
		}else{
			echo '<td>'.$data[$ds['namakecamatan']].'</td>';
			$tampung = $tampung + $data[$ds['namakecamatan']];
		}
	}?>
    <td><?=$tampung;?></td>
    <td><?=$data['umum'];?></td>
    <td><?=$data['askes'];?></td>
    <td><?=$data['jmks'];?></td>
    <td><?=$data['sktm'];?></td>
    <td><?=$data['jmks_bgr'];?></td>
    <td><?=$data['jampersal'];?></td>
    <td><?=$data['crbayarlain'];?></td>
    <td><?=$data['umum']+$data['askes']+$data['jmks']+$data['sktm']+$data['crbayarlain']+$data['jmks_bgr']+$data['jampersal'];?></td>
    <td><?=$data['Pulang'];?></td>
    <td><?=$data['Rawat'];?></td>
    <td><?=$data['ODC'];?></td>
    <td><?=$data['PoliLain'];?></td>
    <td><?=$data['RsLain'];?></td>
    <td><?=$data['Kabur'];?></td>
    <td><?=$data['DOA'];?></td>
    <td><?=$data['Meninggal'];?></td>
    <td><?=$data['Pulang']+$data['Rawat']+$data['ODC']+$data['PoliLain']+$data['RsLain']+$data['Kabur']+$data['DOA']+$data['Meninggal'];?></td>
    <td><?=$data['KunjunganB'];?></td>
    <td><?=$data['KunjunganL'];?></td>
    <td><?=$data['KunjunganB']+$data['KunjunganL'];?></td>
    <td><?=$data['KasusB'];?></td>
    <td><?=$data['KasusL'];?></td>
    <td><?=$data['KasusB']+$data['KasusL'];?></td>
  </tr>
   <?php } ?>   
</table>