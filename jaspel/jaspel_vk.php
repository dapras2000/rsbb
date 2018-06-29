<?php 
include("include/connect.php");

$search = "tglreg=curdate()";
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
} 

if($tgl_kunjungan !=""){
	$search = " tglreg between  '".$tgl_kunjungan."' ";
}

$tgl_kunjungan2 = "";
if(!empty($_GET['tgl_kunjungan2'])){
	$tgl_kunjungan2 =$_GET['tgl_kunjungan2']; 
} 


if($tgl_kunjungan !=""){
if($tgl_kunjungan2 !=""){
	$search = $search." and '".$tgl_kunjungan2."' ";
}else{
	$search = $search." and '".$tgl_kunjungan."' ";
}
}

$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif , 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  0.2*sum(d.tarifrs*d.qty) as pendukung
from t_pendaftaran a
left join m_dokter b on a.kddokter=b.kddokter 
inner join  m_poly c on a.kdpoly=c.kode 
inner join t_billrajal d on a.idxdaftar=d.idxdaftar aND a.kdpoly=d.kdpoly and a.kdpoly in(10) and d.kodetarif in(
'010401','010402','010403','010404','010405','010406','010407','010408','010409','010410','010411','010412','010413','010414')
where ".$search." and a.kdcarabayar=1
group by a.kdpoly,c.nama, a.kddokter,b.namadokter order by a.kdpoly") or die (mysql_error());
?>


	<div>
    	<form name="formsearch" method="get" >
     <table width="248" border="0" cellspacing="0" class="tb">
 

  <tr>
    <td>Tanggal</td>
    <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? if($_REQUEST['tgl_kunjungan'] !=""): echo $_REQUEST['tgl_kunjungan']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
   <tr>
    <td>Sd</td>
    <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" 
              value="<? if($_REQUEST['tgl_kunjungan2'] !=""): echo $_REQUEST['tgl_kunjungan2']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cari" class="text"/>
    <input type="hidden" name="link" value="jas3" /></td>
  </tr>
</table>

    </form> 
  </div>   

<div align="center">
<div id="frame">
	<div id="frame_title"><h3>A. Pasien Umum</h3></div>

<table width="518" border="1" class="tb">
  <tr>
    <th colspan="6">Pemeriksaan VK</th>
  </tr>
  <tr>
    <td width="78">Poly</td>
    <td width="92">Nama Dokter</td>    
    <td width="71">Pendapatan</td>


    <td width="76">Jasa Dokter</td>    
    <td width="90">Manajemen</td>
    <td width="71">Pendukung</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>
    <td><?=$list['poly'];?></td>
   <td><?=$list['namadokter'];?></td>    
    <td><?= number_format($list['tarif'],0);?></td>
 
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?> 
 
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.2*sum(d.tarifrs*d.qty) as 	pendukung
					from t_pendaftaran a
					left join m_dokter b on a.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join t_billrajal d on a.idxdaftar=d.idxdaftar aND a.kdpoly=d.kdpoly 
					inner join m_tarif e on d.kodetarif=e.kode and kodetarif in ('010405','010410') 
					where ".$search." and a.kdpoly in(10) and a.kdcarabayar=1
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?>   
<table width="581" border="1" class="tb">
  <tr>
    <th colspan="6">Konsultasi dokter spesialis</th>
  </tr>
  <tr>
    <td width="148">Poly</td>
    <td width="82">Dokter/Bidan</td>    
    <td width="71">Pendapatan</td>
    <td width="83">Jasa Dokter</td>


    <td width="71">Manajemen</td>
    <td width="86">Pendukung</td>
  </tr>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.3*sum(d.tarifrs*d.qty) as jsdr, 0.15*sum(d.tarifrs*d.qty) as manajemen,  
					   0.55*sum(d.tarifrs*d.qty) as 	pendukung
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search."
						 aND a.kdpoly=d.kdpoly and a.kdpoly in(10) and kodetarif in ('010415') and d.kodetarif=e.kode and a.kdcarabayar=1
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?> 
<table width="565" border="1" class="tb">
  <tr>
    <th colspan="6">One Day Care</th>
  </tr>
  <tr>
    <td width="150">Poly</td>
    <td width="82">Dokter/Bidan</td>    
    <td width="68">Jumlah</td>
    <td width="71">Jasa Dokte</td>


    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
  </tr>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.125*sum(d.tarifrs*d.qty) as 	pendukung,0.075*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search."
						 aND a.kdpoly in(10) and kodetarif like '0108%' and d.kodetarif=e.kode and a.kdcarabayar=1
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?>                    
<table width="728" border="1" class="tb">
  <tr>
    <th colspan="8">Tindakan  paket medis IIIA/ IIIB/ IIIC</th>
  </tr>
  <tr>
    <td width="103">Poly</td>
    <td width="105">Nama Dokter</td>
    <td width="82">Paket</td>

    <td width="80">Pendapatan</td>
    <td width="71">Jasa Dr.</td>
    <td width="71">Manajemen</td>
    <td width="82">Pendukung</td>
    <td width="82">Asisten</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  <tr>
    <td><?= $list['poly'];?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
    <td><?= number_format($list['asisten'],0);?></td>
  </tr>
 <? } ?>  
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.125*sum(d.tarifrs*d.qty) as 	pendukung,0.075*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search."
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(10) and kodetarif in('010322','010323','010324') and d.kodetarif=e.kode and a.kdcarabayar=1
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?> 
<table width="537" border="1" class="tb">
  <tr>
    <th colspan="6">Kuretase</th>
  </tr>
  <tr>
  <td width="56">Jumlah</td>
    <td width="109">Dokter Operator</td>

    <td width="102">Dokter Anastesi</td>
    
    <td width="71">Manajemen</td>
    <td width="77">Pendukung</td>

    <td width="82">Asisten</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.1*sum(d.tarifrs*d.qty) as 	pendukung,0.1*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(10) and 
					 kodetarif in('010302',
								  '010306','010307','010308','010309','010310','010311','010312',
								  '010313','010314','010315','010316') 
					 and d.kodetarif=e.kode and a.kdcarabayar=1
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?> 
<table width="542" border="1" class="tb">
  <tr>
    <th colspan="7">Persalinan Normal</th>
  </tr>
  <tr>
    <td width="111">Dokter</td>
    <td width="71">Pendapatan</td>
    <td width="70">Jasa Dr.</td>

    <td width="76">Manajemen</td>
    <td width="70">Pendukung</td>
    <td width="104">Asisten</td>
  </tr>
  <tr>

    <td><?= $list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
    <td><?= number_format($list['asisten'],0);?></td>
  </tr>
</table>

<p>&nbsp;</p>
<table width="488" border="1" class="tb">
  <tr>
    <th colspan="6">Persalinan dengan penyulit</th>
  </tr>
  <tr>
      <td width="68">Jumlah</td>
    <td width="150">Dokter</td>

    <td width="82">Bidan</td>
    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
    <td width="83">Asisten</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="488" border="1" class="tb">
  <tr>
    <th colspan="6">Elektromedik</th>
  </tr>
  <tr>
    <td width="150">Jenis Tindakan</td>
    <td width="68">Jumlah</td>

    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
    <td width="83">Asisten</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
</div>
<br />

<div align="center">
<div id="frame">
	<div id="frame_title">
	  <h3>B. Pasien Askes</h3></div>

<table width="518" border="1" class="tb">
  <tr>
    <th colspan="6">Pemeriksaan VK</th>
  </tr>
  <tr>
    <td width="78">Poly</td>
    <td width="92">Nama Dokter</td>    
    <td width="71">Pendapatan</td>


    <td width="76">Jasa Dokter</td>    
    <td width="90">Manajemen</td>
    <td width="71">Pendukung</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>
    <td><?=$list['poly'];?></td>
   <td><?=$list['namadokter'];?></td>    
    <td><?= number_format($list['tarif'],0);?></td>
 
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?> 
 
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.2*sum(d.tarifrs*d.qty) as 	pendukung
					from t_pendaftaran a
					left join m_dokter b on a.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join t_billrajal d on a.idxdaftar=d.idxdaftar aND a.kdpoly=d.kdpoly 
					inner join m_tarif e on d.kodetarif=e.kode and kodetarif in ('010405','010410') 
					where ".$search." and a.kdpoly in(10) and a.kdcarabayar=2
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?>   
<table width="581" border="1" class="tb">
  <tr>
    <th colspan="6">Konsultasi dokter spesialis</th>
  </tr>
  <tr>
    <td width="148">Poly</td>
    <td width="82">Dokter/Bidan</td>    
    <td width="71">Pendapatan</td>
    <td width="83">Jasa Dokter</td>


    <td width="71">Manajemen</td>
    <td width="86">Pendukung</td>
  </tr>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.3*sum(d.tarifrs*d.qty) as jsdr, 0.15*sum(d.tarifrs*d.qty) as manajemen,  
					   0.55*sum(d.tarifrs*d.qty) as 	pendukung
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search."
						 aND a.kdpoly=d.kdpoly and a.kdpoly in(10) and kodetarif in ('010415') and d.kodetarif=e.kode and a.kdcarabayar=2
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?> 
<table width="565" border="1" class="tb">
  <tr>
    <th colspan="6">One Day Care</th>
  </tr>
  <tr>
    <td width="150">Poly</td>
    <td width="82">Dokter/Bidan</td>    
    <td width="68">Jumlah</td>
    <td width="71">Jasa Dokte</td>


    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
  </tr>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.125*sum(d.tarifrs*d.qty) as 	pendukung,0.075*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search."
						 aND a.kdpoly in(10) and kodetarif like '0108%' and d.kodetarif=e.kode and a.kdcarabayar=2
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?>                    
<table width="728" border="1" class="tb">
  <tr>
    <th colspan="8">Tindakan  paket medis IIIA/ IIIB/ IIIC</th>
  </tr>
  <tr>
    <td width="103">Poly</td>
    <td width="105">Nama Dokter</td>
    <td width="82">Paket</td>

    <td width="80">Pendapatan</td>
    <td width="71">Jasa Dr.</td>
    <td width="71">Manajemen</td>
    <td width="82">Pendukung</td>
    <td width="82">Asisten</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  <tr>
    <td><?= $list['poly'];?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
    <td><?= number_format($list['asisten'],0);?></td>
  </tr>
 <? } ?>  
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.125*sum(d.tarifrs*d.qty) as 	pendukung,0.075*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search."
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(10) and kodetarif in('010322','010323','010324') and d.kodetarif=e.kode and a.kdcarabayar=2
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?> 
<table width="537" border="1" class="tb">
  <tr>
    <th colspan="6">Kuretase</th>
  </tr>
  <tr>
  <td width="56">Jumlah</td>
    <td width="109">Dokter Operator</td>

    <td width="102">Dokter Anastesi</td>
    
    <td width="71">Manajemen</td>
    <td width="77">Pendukung</td>

    <td width="82">Asisten</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.1*sum(d.tarifrs*d.qty) as 	pendukung,0.1*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(10) and 
					 kodetarif in('010302',
								  '010306','010307','010308','010309','010310','010311','010312',
								  '010313','010314','010315','010316') 
					 and d.kodetarif=e.kode and a.kdcarabayar=2
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?> 
<table width="542" border="1" class="tb">
  <tr>
    <th colspan="7">Persalinan Normal</th>
  </tr>
  <tr>
    <td width="111">Dokter</td>
    <td width="71">Pendapatan</td>
    <td width="70">Jasa Dr.</td>

    <td width="76">Manajemen</td>
    <td width="70">Pendukung</td>
    <td width="104">Asisten</td>
  </tr>
  <tr>

    <td><?= $list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
    <td><?= number_format($list['asisten'],0);?></td>
  </tr>
</table>

<p>&nbsp;</p>
<table width="488" border="1" class="tb">
  <tr>
    <th colspan="6">Persalinan dengan penyulit</th>
  </tr>
  <tr>
      <td width="68">Jumlah</td>
    <td width="150">Dokter</td>

    <td width="82">Bidan</td>
    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
    <td width="83">Asisten</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="488" border="1" class="tb">
  <tr>
    <th colspan="6">Elektromedik</th>
  </tr>
  <tr>
    <td width="150">Jenis Tindakan</td>
    <td width="68">Jumlah</td>

    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
    <td width="83">Asisten</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
</div><br />

<div align="center">
<div id="frame">
	<div id="frame_title">
	  <h3>C. Pasien Jamkesmas</h3></div>

<table width="518" border="1" class="tb">
  <tr>
    <th colspan="6">Pemeriksaan VK</th>
  </tr>
  <tr>
    <td width="78">Poly</td>
    <td width="92">Nama Dokter</td>    
    <td width="71">Pendapatan</td>


    <td width="76">Jasa Dokter</td>    
    <td width="90">Manajemen</td>
    <td width="71">Pendukung</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>
    <td><?=$list['poly'];?></td>
   <td><?=$list['namadokter'];?></td>    
    <td><?= number_format($list['tarif'],0);?></td>
 
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?> 
 
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.2*sum(d.tarifrs*d.qty) as 	pendukung
					from t_pendaftaran a
					left join m_dokter b on a.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join t_billrajal d on a.idxdaftar=d.idxdaftar aND a.kdpoly=d.kdpoly 
					inner join m_tarif e on d.kodetarif=e.kode and kodetarif in ('010405','010410') 
					where ".$search." and a.kdpoly in(10) and a.kdcarabayar=3
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?>   
<table width="581" border="1" class="tb">
  <tr>
    <th colspan="6">Konsultasi dokter spesialis</th>
  </tr>
  <tr>
    <td width="148">Poly</td>
    <td width="82">Dokter/Bidan</td>    
    <td width="71">Pendapatan</td>
    <td width="83">Jasa Dokter</td>


    <td width="71">Manajemen</td>
    <td width="86">Pendukung</td>
  </tr>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.3*sum(d.tarifrs*d.qty) as jsdr, 0.15*sum(d.tarifrs*d.qty) as manajemen,  
					   0.55*sum(d.tarifrs*d.qty) as 	pendukung
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search."
						 aND a.kdpoly=d.kdpoly and a.kdpoly in(10) and kodetarif in ('010415') and d.kodetarif=e.kode and a.kdcarabayar=3
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?> 
<table width="565" border="1" class="tb">
  <tr>
    <th colspan="6">One Day Care</th>
  </tr>
  <tr>
    <td width="150">Poly</td>
    <td width="82">Dokter/Bidan</td>    
    <td width="68">Jumlah</td>
    <td width="71">Jasa Dokte</td>


    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
  </tr>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.125*sum(d.tarifrs*d.qty) as 	pendukung,0.075*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search."
						 aND a.kdpoly in(10) and kodetarif like '0108%' and d.kodetarif=e.kode and a.kdcarabayar=3
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?>                    
<table width="728" border="1" class="tb">
  <tr>
    <th colspan="8">Tindakan  paket medis IIIA/ IIIB/ IIIC</th>
  </tr>
  <tr>
    <td width="103">Poly</td>
    <td width="105">Nama Dokter</td>
    <td width="82">Paket</td>

    <td width="80">Pendapatan</td>
    <td width="71">Jasa Dr.</td>
    <td width="71">Manajemen</td>
    <td width="82">Pendukung</td>
    <td width="82">Asisten</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  <tr>
    <td><?= $list['poly'];?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
    <td><?= number_format($list['asisten'],0);?></td>
  </tr>
 <? } ?>  
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.125*sum(d.tarifrs*d.qty) as 	pendukung,0.075*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search."
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(10) and kodetarif in('010322','010323','010324') and d.kodetarif=e.kode and a.kdcarabayar=3
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?> 
<table width="537" border="1" class="tb">
  <tr>
    <th colspan="6">Kuretase</th>
  </tr>
  <tr>
  <td width="56">Jumlah</td>
    <td width="109">Dokter Operator</td>

    <td width="102">Dokter Anastesi</td>
    
    <td width="71">Manajemen</td>
    <td width="77">Pendukung</td>

    <td width="82">Asisten</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.1*sum(d.tarifrs*d.qty) as 	pendukung,0.1*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(10) and 
					 kodetarif in('010302',
								  '010306','010307','010308','010309','010310','010311','010312',
								  '010313','010314','010315','010316') 
					 and d.kodetarif=e.kode and a.kdcarabayar=3
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?> 
<table width="542" border="1" class="tb">
  <tr>
    <th colspan="7">Persalinan Normal</th>
  </tr>
  <tr>
    <td width="111">Dokter</td>
    <td width="71">Pendapatan</td>
    <td width="70">Jasa Dr.</td>

    <td width="76">Manajemen</td>
    <td width="70">Pendukung</td>
    <td width="104">Asisten</td>
  </tr>
  <tr>

    <td><?= $list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
    <td><?= number_format($list['asisten'],0);?></td>
  </tr>
</table>

<p>&nbsp;</p>
<table width="488" border="1" class="tb">
  <tr>
    <th colspan="6">Persalinan dengan penyulit</th>
  </tr>
  <tr>
      <td width="68">Jumlah</td>
    <td width="150">Dokter</td>

    <td width="82">Bidan</td>
    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
    <td width="83">Asisten</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="488" border="1" class="tb">
  <tr>
    <th colspan="6">Elektromedik</th>
  </tr>
  <tr>
    <td width="150">Jenis Tindakan</td>
    <td width="68">Jumlah</td>

    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
    <td width="83">Asisten</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
</div><br />

<div align="center">
<div id="frame">
	<div id="frame_title">
	  <h3>D. Pasien SKTM</h3></div>

<table width="518" border="1" class="tb">
  <tr>
    <th colspan="6">Pemeriksaan VK</th>
  </tr>
  <tr>
    <td width="78">Poly</td>
    <td width="92">Nama Dokter</td>    
    <td width="71">Pendapatan</td>


    <td width="76">Jasa Dokter</td>    
    <td width="90">Manajemen</td>
    <td width="71">Pendukung</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>
    <td><?=$list['poly'];?></td>
   <td><?=$list['namadokter'];?></td>    
    <td><?= number_format($list['tarif'],0);?></td>
 
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?> 
 
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.2*sum(d.tarifrs*d.qty) as 	pendukung
					from t_pendaftaran a
					left join m_dokter b on a.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join t_billrajal d on a.idxdaftar=d.idxdaftar aND a.kdpoly=d.kdpoly 
					inner join m_tarif e on d.kodetarif=e.kode and kodetarif in ('010405','010410') 
					where ".$search." and a.kdpoly in(10) and a.kdcarabayar=4
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?>   
<table width="581" border="1" class="tb">
  <tr>
    <th colspan="6">Konsultasi dokter spesialis</th>
  </tr>
  <tr>
    <td width="148">Poly</td>
    <td width="82">Dokter/Bidan</td>    
    <td width="71">Pendapatan</td>
    <td width="83">Jasa Dokter</td>


    <td width="71">Manajemen</td>
    <td width="86">Pendukung</td>
  </tr>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.3*sum(d.tarifrs*d.qty) as jsdr, 0.15*sum(d.tarifrs*d.qty) as manajemen,  
					   0.55*sum(d.tarifrs*d.qty) as 	pendukung
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search."
						 aND a.kdpoly=d.kdpoly and a.kdpoly in(10) and kodetarif in ('010415') and d.kodetarif=e.kode and a.kdcarabayar=4
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?> 
<table width="565" border="1" class="tb">
  <tr>
    <th colspan="6">One Day Care</th>
  </tr>
  <tr>
    <td width="150">Poly</td>
    <td width="82">Dokter/Bidan</td>    
    <td width="68">Jumlah</td>
    <td width="71">Jasa Dokte</td>


    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
  </tr>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.125*sum(d.tarifrs*d.qty) as 	pendukung,0.075*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search."
						 aND a.kdpoly in(10) and kodetarif like '0108%' and d.kodetarif=e.kode and a.kdcarabayar=4
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?>                    
<table width="728" border="1" class="tb">
  <tr>
    <th colspan="8">Tindakan  paket medis IIIA/ IIIB/ IIIC</th>
  </tr>
  <tr>
    <td width="103">Poly</td>
    <td width="105">Nama Dokter</td>
    <td width="82">Paket</td>

    <td width="80">Pendapatan</td>
    <td width="71">Jasa Dr.</td>
    <td width="71">Manajemen</td>
    <td width="82">Pendukung</td>
    <td width="82">Asisten</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  <tr>
    <td><?= $list['poly'];?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
    <td><?= number_format($list['asisten'],0);?></td>
  </tr>
 <? } ?>  
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.125*sum(d.tarifrs*d.qty) as 	pendukung,0.075*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search."
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(10) and kodetarif in('010322','010323','010324') and d.kodetarif=e.kode and a.kdcarabayar=4
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?> 
<table width="537" border="1" class="tb">
  <tr>
    <th colspan="6">Kuretase</th>
  </tr>
  <tr>
  <td width="56">Jumlah</td>
    <td width="109">Dokter Operator</td>

    <td width="102">Dokter Anastesi</td>
    
    <td width="71">Manajemen</td>
    <td width="77">Pendukung</td>

    <td width="82">Asisten</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.1*sum(d.tarifrs*d.qty) as 	pendukung,0.1*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(10) and 
					 kodetarif in('010302',
								  '010306','010307','010308','010309','010310','010311','010312',
								  '010313','010314','010315','010316') 
					 and d.kodetarif=e.kode and a.kdcarabayar=4
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?> 
<table width="542" border="1" class="tb">
  <tr>
    <th colspan="7">Persalinan Normal</th>
  </tr>
  <tr>
    <td width="111">Dokter</td>
    <td width="71">Pendapatan</td>
    <td width="70">Jasa Dr.</td>

    <td width="76">Manajemen</td>
    <td width="70">Pendukung</td>
    <td width="104">Asisten</td>
  </tr>
  <tr>

    <td><?= $list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
    <td><?= number_format($list['asisten'],0);?></td>
  </tr>
</table>

<p>&nbsp;</p>
<table width="488" border="1" class="tb">
  <tr>
    <th colspan="6">Persalinan dengan penyulit</th>
  </tr>
  <tr>
      <td width="68">Jumlah</td>
    <td width="150">Dokter</td>

    <td width="82">Bidan</td>
    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
    <td width="83">Asisten</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="488" border="1" class="tb">
  <tr>
    <th colspan="6">Elektromedik</th>
  </tr>
  <tr>
    <td width="150">Jenis Tindakan</td>
    <td width="68">Jumlah</td>

    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
    <td width="83">Asisten</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
</div><br />

<div align="center">
<div id="frame">
	<div id="frame_title">
	  <h3>E. Pasien Lain-lain</h3></div>

<table width="518" border="1" class="tb">
  <tr>
    <th colspan="6">Pemeriksaan VK</th>
  </tr>
  <tr>
    <td width="78">Poly</td>
    <td width="92">Nama Dokter</td>    
    <td width="71">Pendapatan</td>


    <td width="76">Jasa Dokter</td>    
    <td width="90">Manajemen</td>
    <td width="71">Pendukung</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>
    <td><?=$list['poly'];?></td>
   <td><?=$list['namadokter'];?></td>    
    <td><?= number_format($list['tarif'],0);?></td>
 
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?> 
 
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.2*sum(d.tarifrs*d.qty) as 	pendukung
					from t_pendaftaran a
					left join m_dokter b on a.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join t_billrajal d on a.idxdaftar=d.idxdaftar aND a.kdpoly=d.kdpoly 
					inner join m_tarif e on d.kodetarif=e.kode and kodetarif in ('010405','010410') 
					where ".$search." and a.kdpoly in(10) and a.kdcarabayar=5
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?>   
<table width="581" border="1" class="tb">
  <tr>
    <th colspan="6">Konsultasi dokter spesialis</th>
  </tr>
  <tr>
    <td width="148">Poly</td>
    <td width="82">Dokter/Bidan</td>    
    <td width="71">Pendapatan</td>
    <td width="83">Jasa Dokter</td>


    <td width="71">Manajemen</td>
    <td width="86">Pendukung</td>
  </tr>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.3*sum(d.tarifrs*d.qty) as jsdr, 0.15*sum(d.tarifrs*d.qty) as manajemen,  
					   0.55*sum(d.tarifrs*d.qty) as 	pendukung
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search."
						 aND a.kdpoly=d.kdpoly and a.kdpoly in(10) and kodetarif in ('010415') and d.kodetarif=e.kode and a.kdcarabayar=5
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?> 
<table width="565" border="1" class="tb">
  <tr>
    <th colspan="6">One Day Care</th>
  </tr>
  <tr>
    <td width="150">Poly</td>
    <td width="82">Dokter/Bidan</td>    
    <td width="68">Jumlah</td>
    <td width="71">Jasa Dokte</td>


    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
  </tr>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.125*sum(d.tarifrs*d.qty) as 	pendukung,0.075*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search."
						 aND a.kdpoly in(10) and kodetarif like '0108%' and d.kodetarif=e.kode and a.kdcarabayar=5
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?>                    
<table width="728" border="1" class="tb">
  <tr>
    <th colspan="8">Tindakan  paket medis IIIA/ IIIB/ IIIC</th>
  </tr>
  <tr>
    <td width="103">Poly</td>
    <td width="105">Nama Dokter</td>
    <td width="82">Paket</td>

    <td width="80">Pendapatan</td>
    <td width="71">Jasa Dr.</td>
    <td width="71">Manajemen</td>
    <td width="82">Pendukung</td>
    <td width="82">Asisten</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  <tr>
    <td><?= $list['poly'];?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
    <td><?= number_format($list['asisten'],0);?></td>
  </tr>
 <? } ?>  
</table>
<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.125*sum(d.tarifrs*d.qty) as 	pendukung,0.075*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search."
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(10) and kodetarif in('010322','010323','010324') and d.kodetarif=e.kode and a.kdcarabayar=5
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?> 
<table width="537" border="1" class="tb">
  <tr>
    <th colspan="6">Kuretase</th>
  </tr>
  <tr>
  <td width="56">Jumlah</td>
    <td width="109">Dokter Operator</td>

    <td width="102">Dokter Anastesi</td>
    
    <td width="71">Manajemen</td>
    <td width="77">Pendukung</td>

    <td width="82">Asisten</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.1*sum(d.tarifrs*d.qty) as 	pendukung,0.1*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(10) and 
					 kodetarif in('010302',
								  '010306','010307','010308','010309','010310','010311','010312',
								  '010313','010314','010315','010316') 
					 and d.kodetarif=e.kode and a.kdcarabayar=5
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?> 
<table width="542" border="1" class="tb">
  <tr>
    <th colspan="7">Persalinan Normal</th>
  </tr>
  <tr>
    <td width="111">Dokter</td>
    <td width="71">Pendapatan</td>
    <td width="70">Jasa Dr.</td>

    <td width="76">Manajemen</td>
    <td width="70">Pendukung</td>
    <td width="104">Asisten</td>
  </tr>
  <tr>

    <td><?= $list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
    <td><?= number_format($list['asisten'],0);?></td>
  </tr>
</table>

<p>&nbsp;</p>
<table width="488" border="1" class="tb">
  <tr>
    <th colspan="6">Persalinan dengan penyulit</th>
  </tr>
  <tr>
      <td width="68">Jumlah</td>
    <td width="150">Dokter</td>

    <td width="82">Bidan</td>
    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
    <td width="83">Asisten</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="488" border="1" class="tb">
  <tr>
    <th colspan="6">Elektromedik</th>
  </tr>
  <tr>
    <td width="150">Jenis Tindakan</td>
    <td width="68">Jumlah</td>

    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
    <td width="83">Asisten</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
</div>