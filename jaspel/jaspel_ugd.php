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


?>


	<div>
    	<form name="formsearch" method="get" >
     <table width="248" border="0" cellspacing="0" class="tb">
 

  <tr>
    <td>Tanggal</td>
    <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan!=""){
			  echo $tgl_kunjungan;}?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
   <tr>
    <td>Sd</td>
    <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan2!=""){
			  echo $tgl_kunjungan2;}?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
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
<?php
 $sql="select a.kdpoly,c.nama as poly, d.tarifrs, e.tarifjaspel,sum(d.qty) as qty, a.kddokter,b.namadokter,sum(e.tarifjaspel*d.qty) as tarif , 
							case kdprofesi when 2 then 0.3*sum(e.tarifjaspel*d.qty) else 0.7*sum(e.tarifjaspel*d.qty) end as jsdr,
							case kdprofesi when 2 then 0.15*sum(e.tarifjaspel*d.qty) else 0.1*sum(e.tarifjaspel*d.qty) end as manajemen,
							case kdprofesi when 2 then 0.55*sum(e.tarifjaspel*d.qty) else 0.2*sum(e.tarifjaspel*d.qty) end as pendukung
from t_pendaftaran a
inner join m_dokter b on a.kddokter=b.kddokter 
inner join  m_poly c on a.kdpoly=c.kode 
inner join t_billrajal d on a.idxdaftar=d.idxdaftar aND  a.kdpoly in(9) and d.kodetarif in(
'010401','010402','010403','010404','010406','010407','010408','010409','010411','010412','010413','010414')
inner join m_tarif e on e.kode=d.kodetarif 
where ".$search." and a.kdcarabayar=1
group by a.kdpoly,c.nama, a.kddokter,b.namadokter,d.tarifrs,d.qty order by a.kdpoly";
$qry = mysql_query($sql) or die (mysql_error());
?>
<table width="840" border="1" class="tb">
  <tr>
    <th colspan="9">Pemeriksaan UGD</th>
  </tr>
  <tr>
    <td width="78">Poly</td>
    <td width="138">Nama Dokter</td>
    <td width="84">Tarif RS</td>
    <td width="75">Tarif Jaspel</td>
    <td width="75">Jumlah</td>    
    <td width="73">Total</td>


    <td width="79">Jasa Dokter</td>    
    <td width="95">Manajemen</td>
    <td width="85">Pendukung</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>
    <td><?=$list['poly'];?></td>
   <td><?=$list['namadokter'];?></td>
   <td><?= number_format($list['tarifrs'],0);?></td>
   <td><?= number_format($list['tarifjaspel'],0);?></td>
   <td><?= number_format($list['qty'],0);?></td>    
    <td><?= number_format($list['tarif'],0);?></td>
 
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?> 
 
</table>
<p>&nbsp;</p>
<?php
/*echo $sql="select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.2*sum(d.tarifrs*d.qty) as 	pendukung
					from t_pendaftaran a
					
					left join m_dokter b on a.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join t_billrajal d on a.idxdaftar=d.idxdaftar
					inner join m_tarif e on d.kodetarif=e.kode and kodetarif in ('010405','010410') 
					where ".$search." and a.kdpoly in(9) and a.kdcarabayar=1
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly";*/
 $sql="select a.kdpoly,c.nama as poly, f.kddokter,b.namadokter,e.tarif, e.tarifjaspel, count(f.idxdaftar) as jml, e.tarifjaspel*count(f.idxdaftar)  as total ,
					   e.nama_jasa, 0.7*e.tarifjaspel*count(f.idxdaftar) as jsdr, 0.1*e.tarifjaspel*count(f.idxdaftar) as manajemen,  
					   0.2*e.tarifjaspel*count(f.idxdaftar) as 	pendukung
					from t_pendaftaran a
					inner join t_konsul_dokter f on a.idxdaftar=f.idxdaftar and rajal=1
					inner join m_dokter b on f.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join m_tarif e on f.kodetarif=e.kode and f.kodetarif in ('010405','010410') 
					where ".$search." and a.kdpoly in(9) and a.kdcarabayar=1
					group by a.kdpoly,c.nama, f.kddokter,b.namadokter,e.nama_jasa ,e.tarif
					order by a.kdpoly";					
$qry = mysql_query($sql) or die (mysql_error());
?>   
<table width="812" border="1" class="tb">
  <tr>
    <th colspan="9">Konsultasi dokter spesialis</th>
  </tr>
  <tr>
    <td width="148">Poly</td>
    <td width="82">Dokter/Bidan</td>
    <td width="71">Tarif RS</td>
    <td width="71">Tarif Jaspel</td>
    <td width="71">Jumlah</td>    
    <td width="71">Total</td>
    <td width="83">Jasa Dokter</td>


    <td width="71">Manajemen</td>
    <td width="86">Pendukung</td>
  </tr>
  <? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['jml'],0);?></td>
    <td><?= number_format($list['total'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
  <? } ?> 
</table>
<p>&nbsp;</p>
<?php
 /*$sql = "select a.kdpoly,c.nama as poly,f.kddokter,b.namadokter,e.nama_jasa,0.3*sum(d.tarifrs*d.qty) as jsdr, 0.15*sum(d.tarifrs*d.qty) as manajemen,  
   0.55*sum(d.tarifrs*d.qty) as  pendukung from t_pendaftaran a
inner join t_billrajal d on a.idxdaftar=d.idxdaftar and d.kodetarif='010415'
inner join m_poly c on a.kdpoly=c.kode 
inner join t_konsul_dokter f on a.idxdaftar=f.idxdaftar
inner join m_dokter b on f.kddokter=b.kddokter 
inner join m_tarif e on d.kodetarif=e.kode 
where ".$search." and a.kdpoly in(9) and  a.kdcarabayar=1
group by a.kdpoly,c.nama, f.kddokter,b.namadokter,e.nama_jasa 
order by a.kdpoly";*/
$sql="select a.kdpoly,c.nama as poly, f.kddokter,b.namadokter,e.tarif, e.tarifjaspel,count(f.idxdaftar) as jml, e.tarifjaspel*count(f.idxdaftar)  as total ,
					   e.nama_jasa, 0.7*e.tarifjaspel*count(f.idxdaftar) as jsdr, 0.1*e.tarifjaspel*count(f.idxdaftar) as manajemen,  
					   0.2*e.tarifjaspel*count(f.idxdaftar) as 	pendukung
					from t_pendaftaran a
					inner join t_konsul_dokter f on a.idxdaftar=f.idxdaftar and rajal=1
					inner join m_dokter b on f.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join m_tarif e on f.kodetarif=e.kode and f.kodetarif in ('010415') 
					where ".$search." and a.kdpoly in(9) and a.kdcarabayar=1
					group by a.kdpoly,c.nama, f.kddokter,b.namadokter,e.nama_jasa ,e.tarif
					order by a.kdpoly";					
$qry = mysql_query($sql) or die (mysql_error());
?> 
<table width="812" border="1" class="tb">
  <tr>
    <th colspan="9">ODC</th>
  </tr>
  <tr>
    <td width="148">Poly</td>
    <td width="82">Dokter</td>
    <td width="71">Tarif RS</td>
    <td width="71">Tarif Jaspel</td>
    <td width="71">Jumlah</td>    
    <td width="71">Total</td>
    <td width="83">Jasa Dokter</td>


    <td width="71">Manajemen</td>
    <td width="86">Pendukung</td>
  </tr>
  <? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['jml'],0);?></td>
    <td><?= number_format($list['total'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?> 
</table>
<p>&nbsp;</p>
<?php
 $sql="select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        case kdprofesi when 1 then 0.7*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.4*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.35*(f.tarifjaspel)*count(a.idxdaftar) end as jsdr,
       case kdprofesi when 1 then 0.075*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.2*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0*(f.tarifjaspel)*count(a.idxdaftar) end as asisten,
       case kdprofesi when 1 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.15*(f.tarifjaspel)*count(a.idxdaftar) end as manajemen, 
       case kdprofesi when 1 then 0.125*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.3*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.5*(f.tarifjaspel)*count(a.idxdaftar) end as pendukung, 
      d.namadokter, c.nama as poly, f.nama_jasa 
from t_tindakan_medis a
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=1 and b.kdpoly in(9)
inner join m_pasien m on b.nomr=m.nomr
inner join m_poly c on b.kdpoly=c.kode 
inner join m_dokter d on a.kddokter=d.kddokter
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif like '0108%' and rajal=1 and ".$search." group by d.namadokter, c.nama,f.nama_jasa,a.idxdaftar,f.tarif";
$qry = mysql_query($sql) or die (mysql_error());
?>                    
<table width="1072" border="1" class="tb">
  <tr>
    <th colspan="12">Tindakan  paket medis IIIA/ IIIB/ IIIC</th>
  </tr>
  <tr>
    <td width="103">Poly</td>
    <td width="105">Nama Dokter</td>
    <td width="82">Paket</td>
    <td width="80">Tarif</td>
    <td width="80">Tarif Jaspel</td>
    <td width="80">Pasien</td>
    <td width="80">Jml Tindakan</td>

    <td width="80">Total</td>
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
    <td><?= number_format($list['tarifrs'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= $list['pasien'];?></td>
    <td><?= number_format($list['qty'],0);?></td>
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
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(9) and kodetarif in('010322','010323','010324') and d.kodetarif=e.kode and a.kdcarabayar=1
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
$qrys = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.1*sum(d.tarifrs*d.qty) as 	pendukung,0.1*sum(d.tarifrs*d.qty) as asisten 

					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(9) and 
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
<? while ($listx = mysql_fetch_array($qrys)){  ?>  
  <tr>
    <td><?= $listx['namadokter'];?></td>
    <td><?= number_format($listx['tarif'],0);?></td>
    <td><?= number_format($listx['jsdr'],0);?></td>
    <td><?= number_format($listx['manajemen'],0);?></td>
    <td><?= number_format($listx['pendukung'],0);?></td>
    <td><?= number_format($listx['asisten'],0);?></td>
  </tr>
<? } ?>
</table>

<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.1*sum(d.tarifrs*d.qty) as 	pendukung,0.1*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(9) and 
					 kodetarif in('010304','010305') 
					 and d.kodetarif=e.kode and a.kdcarabayar=1
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?>
<table width="488" border="1" class="tb">
  <tr>
    <th colspan="5">Persalinan dengan penyulit</th>
  </tr>
  <tr>
      <td width="68">Pendapatan</td>
    <td width="150">Dokter</td>

    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
    <td width="83">Asisten</td>
  </tr>
  <tr>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
  </tr>
</table>
<p>&nbsp;</p>
<?php 
$sql="select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,d.tarifrs,e.tarifjaspel, sum(d.qty) as qty,sum(e.tarifjaspel*d.qty) as tarif ,
e.nama_jasa, 0.7*sum(e.tarifjaspel*d.qty) as jsdr, 0.1*sum(e.tarifjaspel*d.qty) as manajemen,  0.20*sum(e.tarifjaspel*d.qty) as pendukung
from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
 where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." and a.kdpoly =9 and kodetarif in('01050202','01050203','01050204','01050205') and d.kodetarif=e.kode and a.kdcarabayar=1 
 group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa,d.tarifrs 
UNION
select a.kdpoly,c.nama as poly, f.kd_dokter,b.namadokter,e.tarif as tarifrs,e.tarifjaspel, count(f.idxdaftar)  as qty,
        e.tarifjaspel*count(f.idxdaftar)  as tarif ,
e.nama_jasa, 0.7* e.tarifjaspel*count(f.idxdaftar)  as jsdr, 0.1* e.tarifjaspel*count(f.idxdaftar) as manajemen,  
0.20* e.tarifjaspel*count(f.idxdaftar)  as pendukung
from t_pendaftaran a
inner join t_ekg f on a.idxdaftar=f.idxdaftar
inner join m_dokter b on f.kd_dokter=b.kddokter 
inner join m_poly c on a.kdpoly=c.kode 
inner join m_tarif e on e.kode=f.kd_tarif
 where a.kdpoly =9 and ".$search." and a.kdcarabayar=1  
group by a.kdpoly,c.nama, f.kd_dokter,b.namadokter,e.nama_jasa ";

$qry=mysql_query($sql) or die (mysql_error())
?>
<table width="765" border="1" class="tb">
  <tr>
    <th colspan="11">Elektromedik</th>
  </tr>
  <tr>
    <td width="69">Poly</td>
    <td width="119">Nama Dokter</td>    
    <td width="102"> Tindakan</td>
    <td width="73">Tarif RS</td>
    <td width="53">TarifJaspel</td>
    <td width="53">Jumlah</td>

    <td width="76">Total</td>
    <td width="56">Jasa Dr</td>
    <td width="77">Manajemen</td>
    <td width="82">Pendukung</td>

  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  
  <tr>
    <td><?= $list['poly'];?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= number_format($list['tarifrs'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['qty'],0);?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?>    
</table>
<p>
<p> <?php 
 $sql="select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,e.tarifjaspel, d.tarifrs,d.qty,
e.nama_jasa, 0.7*sum(e.tarifjaspel*d.qty) as jsdr, 0.1*sum(e.tarifjaspel*d.qty) as manajemen,  0.20*sum(e.tarifjaspel*d.qty) as pendukung
from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
 where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
 and a.kdpoly in(9)
and kodetarif like '010903%' and d.kodetarif=e.kode and a.kdcarabayar=1
 group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
order by a.kdpoly";
$qry = mysql_query($sql) or die (mysql_error());?>  
<table width="851" border="1" class="tb">
  <tr>
    <th colspan="11">Visum </th>
  </tr>
  <tr>
    <td width="87">Poly</td>
    <td width="122">Dokter</td>
    <td width="96">Tindakan</td>


    <td width="63">Tarif RS</td>
    <td width="71">Tarif Jaspel</td>
    <td width="42">Jumlah</td>
    <td width="72">Pendapatan</td>
    <td width="58">Jasa Dr</td>
    <td width="71">Manajemen</td>
    <td width="105">Pendukung</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  
  <tr>
    <td><?= $list['poly'];?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= number_format($list['tarifrs'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['qty'],0);?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?>     
</table>

</div></div><br />

<div align="center">
  <div id="frame">
    <div id="frame_title">
      <h3>B. Pasien Askes</h3>
    </div>
<?php
 $sql="select a.kdpoly,c.nama as poly, d.tarifrs, e.tarifjaspel,sum(d.qty) as qty, a.kddokter,b.namadokter,sum(e.tarifjaspel*d.qty) as tarif , 
							case kdprofesi when 2 then 0.3*sum(e.tarifjaspel*d.qty) else 0.7*sum(e.tarifjaspel*d.qty) end as jsdr,
							case kdprofesi when 2 then 0.15*sum(e.tarifjaspel*d.qty) else 0.1*sum(e.tarifjaspel*d.qty) end as manajemen,
							case kdprofesi when 2 then 0.55*sum(e.tarifjaspel*d.qty) else 0.2*sum(e.tarifjaspel*d.qty) end as pendukung
from t_pendaftaran a
inner join m_dokter b on a.kddokter=b.kddokter 
inner join  m_poly c on a.kdpoly=c.kode 
inner join t_billrajal d on a.idxdaftar=d.idxdaftar aND  a.kdpoly in(9) and d.kodetarif in(
'010401','010402','010403','010404','010406','010407','010408','010409','010411','010412','010413','010414')
inner join m_tarif e on e.kode=d.kodetarif 
where ".$search." and a.kdcarabayar=2
group by a.kdpoly,c.nama, a.kddokter,b.namadokter,d.tarifrs,d.qty order by a.kdpoly";
$qry = mysql_query($sql) or die (mysql_error());
?>
<table width="840" border="1" class="tb">
  <tr>
    <th colspan="9">Pemeriksaan UGD</th>
  </tr>
  <tr>
    <td width="78">Poly</td>
    <td width="138">Nama Dokter</td>
    <td width="84">Tarif RS</td>
    <td width="75">Tarif Jaspel</td>
    <td width="75">Jumlah</td>    
    <td width="73">Total</td>


    <td width="79">Jasa Dokter</td>    
    <td width="95">Manajemen</td>
    <td width="85">Pendukung</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>
    <td><?=$list['poly'];?></td>
   <td><?=$list['namadokter'];?></td>
   <td><?= number_format($list['tarifrs'],0);?></td>
   <td><?= number_format($list['tarifjaspel'],0);?></td>
   <td><?= number_format($list['qty'],0);?></td>    
    <td><?= number_format($list['tarif'],0);?></td>
 
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?> 
 
</table>
<p>&nbsp;</p>
<?php
/*echo $sql="select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.2*sum(d.tarifrs*d.qty) as 	pendukung
					from t_pendaftaran a
					
					left join m_dokter b on a.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join t_billrajal d on a.idxdaftar=d.idxdaftar
					inner join m_tarif e on d.kodetarif=e.kode and kodetarif in ('010405','010410') 
					where ".$search." and a.kdpoly in(9) and a.kdcarabayar=2
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly";*/
 $sql="select a.kdpoly,c.nama as poly, f.kddokter,b.namadokter,e.tarif, e.tarifjaspel, count(f.idxdaftar) as jml, e.tarifjaspel*count(f.idxdaftar)  as total ,
					   e.nama_jasa, 0.7*e.tarifjaspel*count(f.idxdaftar) as jsdr, 0.1*e.tarifjaspel*count(f.idxdaftar) as manajemen,  
					   0.2*e.tarifjaspel*count(f.idxdaftar) as 	pendukung
					from t_pendaftaran a
					inner join t_konsul_dokter f on a.idxdaftar=f.idxdaftar and rajal=1
					inner join m_dokter b on f.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join m_tarif e on f.kodetarif=e.kode and f.kodetarif in ('010405','010410') 
					where ".$search." and a.kdpoly in(9) and a.kdcarabayar=2
					group by a.kdpoly,c.nama, f.kddokter,b.namadokter,e.nama_jasa ,e.tarif
					order by a.kdpoly";					
$qry = mysql_query($sql) or die (mysql_error());
?>   
<table width="812" border="1" class="tb">
  <tr>
    <th colspan="9">Konsultasi dokter spesialis</th>
  </tr>
  <tr>
    <td width="148">Poly</td>
    <td width="82">Dokter/Bidan</td>
    <td width="71">Tarif RS</td>
    <td width="71">Tarif Jaspel</td>
    <td width="71">Jumlah</td>    
    <td width="71">Total</td>
    <td width="83">Jasa Dokter</td>


    <td width="71">Manajemen</td>
    <td width="86">Pendukung</td>
  </tr>
  <? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['jml'],0);?></td>
    <td><?= number_format($list['total'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
  <? } ?> 
</table>
<p>&nbsp;</p>
<?php
 /*$sql = "select a.kdpoly,c.nama as poly,f.kddokter,b.namadokter,e.nama_jasa,0.3*sum(d.tarifrs*d.qty) as jsdr, 0.15*sum(d.tarifrs*d.qty) as manajemen,  
   0.55*sum(d.tarifrs*d.qty) as  pendukung from t_pendaftaran a
inner join t_billrajal d on a.idxdaftar=d.idxdaftar and d.kodetarif='010415'
inner join m_poly c on a.kdpoly=c.kode 
inner join t_konsul_dokter f on a.idxdaftar=f.idxdaftar
inner join m_dokter b on f.kddokter=b.kddokter 
inner join m_tarif e on d.kodetarif=e.kode 
where ".$search." and a.kdpoly in(9) and  a.kdcarabayar=2
group by a.kdpoly,c.nama, f.kddokter,b.namadokter,e.nama_jasa 
order by a.kdpoly";*/
$sql="select a.kdpoly,c.nama as poly, f.kddokter,b.namadokter,e.tarif, e.tarifjaspel,count(f.idxdaftar) as jml, e.tarifjaspel*count(f.idxdaftar)  as total ,
					   e.nama_jasa, 0.7*e.tarifjaspel*count(f.idxdaftar) as jsdr, 0.1*e.tarifjaspel*count(f.idxdaftar) as manajemen,  
					   0.2*e.tarifjaspel*count(f.idxdaftar) as 	pendukung
					from t_pendaftaran a
					inner join t_konsul_dokter f on a.idxdaftar=f.idxdaftar and rajal=1
					inner join m_dokter b on f.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join m_tarif e on f.kodetarif=e.kode and f.kodetarif in ('010415') 
					where ".$search." and a.kdpoly in(9) and a.kdcarabayar=2
					group by a.kdpoly,c.nama, f.kddokter,b.namadokter,e.nama_jasa ,e.tarif
					order by a.kdpoly";					
$qry = mysql_query($sql) or die (mysql_error());
?> 
<table width="812" border="1" class="tb">
  <tr>
    <th colspan="9">ODC</th>
  </tr>
  <tr>
    <td width="148">Poly</td>
    <td width="82">Dokter</td>
    <td width="71">Tarif RS</td>
    <td width="71">Tarif Jaspel</td>
    <td width="71">Jumlah</td>    
    <td width="71">Total</td>
    <td width="83">Jasa Dokter</td>


    <td width="71">Manajemen</td>
    <td width="86">Pendukung</td>
  </tr>
  <? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['jml'],0);?></td>
    <td><?= number_format($list['total'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?> 
</table>
<p>&nbsp;</p>
<?php
 $sql="select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        case kdprofesi when 1 then 0.7*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.4*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.35*(f.tarifjaspel)*count(a.idxdaftar) end as jsdr,
       case kdprofesi when 1 then 0.075*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.2*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0*(f.tarifjaspel)*count(a.idxdaftar) end as asisten,
       case kdprofesi when 1 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.15*(f.tarifjaspel)*count(a.idxdaftar) end as manajemen, 
       case kdprofesi when 1 then 0.125*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.3*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.5*(f.tarifjaspel)*count(a.idxdaftar) end as pendukung, 
      d.namadokter, c.nama as poly, f.nama_jasa 
from t_tindakan_medis a
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=2 and b.kdpoly in(9)
inner join m_pasien m on b.nomr=m.nomr
inner join m_poly c on b.kdpoly=c.kode 
inner join m_dokter d on a.kddokter=d.kddokter
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif like '0108%' and rajal=1 and ".$search." group by d.namadokter, c.nama,f.nama_jasa,a.idxdaftar,f.tarif";
$qry = mysql_query($sql) or die (mysql_error());
?>                    
<table width="1072" border="1" class="tb">
  <tr>
    <th colspan="12">Tindakan  paket medis IIIA/ IIIB/ IIIC</th>
  </tr>
  <tr>
    <td width="103">Poly</td>
    <td width="105">Nama Dokter</td>
    <td width="82">Paket</td>
    <td width="80">Tarif</td>
    <td width="80">Tarif Jaspel</td>
    <td width="80">Pasien</td>
    <td width="80">Jml Tindakan</td>

    <td width="80">Total</td>
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
    <td><?= number_format($list['tarifrs'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= $list['pasien'];?></td>
    <td><?= number_format($list['qty'],0);?></td>
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
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(9) and kodetarif in('010322','010323','010324') and d.kodetarif=e.kode and a.kdcarabayar=2
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
$qrys = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.1*sum(d.tarifrs*d.qty) as 	pendukung,0.1*sum(d.tarifrs*d.qty) as asisten 

					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(9) and 
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
<? while ($listx = mysql_fetch_array($qrys)){  ?>  
  <tr>
    <td><?= $listx['namadokter'];?></td>
    <td><?= number_format($listx['tarif'],0);?></td>
    <td><?= number_format($listx['jsdr'],0);?></td>
    <td><?= number_format($listx['manajemen'],0);?></td>
    <td><?= number_format($listx['pendukung'],0);?></td>
    <td><?= number_format($listx['asisten'],0);?></td>
  </tr>
<? } ?>
</table>

<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.1*sum(d.tarifrs*d.qty) as 	pendukung,0.1*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(9) and 
					 kodetarif in('010304','010305') 
					 and d.kodetarif=e.kode and a.kdcarabayar=2
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?>
<table width="488" border="1" class="tb">
  <tr>
    <th colspan="5">Persalinan dengan penyulit</th>
  </tr>
  <tr>
      <td width="68">Pendapatan</td>
    <td width="150">Dokter</td>

    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
    <td width="83">Asisten</td>
  </tr>
  <tr>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
  </tr>
</table>
<p>&nbsp;</p>
<?php 
$sql="select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,d.tarifrs,e.tarifjaspel, sum(d.qty) as qty,sum(e.tarifjaspel*d.qty) as tarif ,
e.nama_jasa, 0.7*sum(e.tarifjaspel*d.qty) as jsdr, 0.1*sum(e.tarifjaspel*d.qty) as manajemen,  0.20*sum(e.tarifjaspel*d.qty) as pendukung
from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
 where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." and a.kdpoly =9 and kodetarif in('01050202','01050203','01050204','01050205') and d.kodetarif=e.kode and a.kdcarabayar=2 
 group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa,d.tarifrs 
UNION
select a.kdpoly,c.nama as poly, f.kd_dokter,b.namadokter,e.tarif as tarifrs,e.tarifjaspel, count(f.idxdaftar)  as qty,
        e.tarifjaspel*count(f.idxdaftar)  as tarif ,
e.nama_jasa, 0.7* e.tarifjaspel*count(f.idxdaftar)  as jsdr, 0.1* e.tarifjaspel*count(f.idxdaftar) as manajemen,  
0.20* e.tarifjaspel*count(f.idxdaftar)  as pendukung
from t_pendaftaran a
inner join t_ekg f on a.idxdaftar=f.idxdaftar
inner join m_dokter b on f.kd_dokter=b.kddokter 
inner join m_poly c on a.kdpoly=c.kode 
inner join m_tarif e on e.kode=f.kd_tarif
 where a.kdpoly =9 and ".$search." and a.kdcarabayar=2  
group by a.kdpoly,c.nama, f.kd_dokter,b.namadokter,e.nama_jasa ";

$qry=mysql_query($sql) or die (mysql_error())
?>
<table width="765" border="1" class="tb">
  <tr>
    <th colspan="11">Elektromedik</th>
  </tr>
  <tr>
    <td width="69">Poly</td>
    <td width="119">Nama Dokter</td>    
    <td width="102"> Tindakan</td>
    <td width="73">Tarif RS</td>
    <td width="53">TarifJaspel</td>
    <td width="53">Jumlah</td>

    <td width="76">Total</td>
    <td width="56">Jasa Dr</td>
    <td width="77">Manajemen</td>
    <td width="82">Pendukung</td>

  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  
  <tr>
    <td><?= $list['poly'];?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= number_format($list['tarifrs'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['qty'],0);?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?>    
</table>
<p>
<p> <?php 
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,e.tarifjaspel, d.tarifrs,d.qty,
e.nama_jasa, 0.7*sum(e.tarifjaspel*d.qty) as jsdr, 0.1*sum(e.tarifjaspel*d.qty) as manajemen,  0.20*sum(e.tarifjaspel*d.qty) as pendukung
from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
 where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
 and a.kdpoly in(9)
and kodetarif like '010903%' and d.kodetarif=e.kode and a.kdcarabayar=2
 group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
order by a.kdpoly") or die (mysql_error());?>  
<table width="851" border="1" class="tb">
  <tr>
    <th colspan="11">Visum </th>
  </tr>
  <tr>
    <td width="87">Poly</td>
    <td width="122">Dokter</td>
    <td width="96">Tindakan</td>


    <td width="63">Tarif RS</td>
    <td width="71">Tarif Jaspel</td>
    <td width="42">Jumlah</td>
    <td width="72">Pendapatan</td>
    <td width="58">Jasa Dr</td>
    <td width="71">Manajemen</td>
    <td width="105">Pendukung</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  
  <tr>
    <td><?= $list['poly'];?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= number_format($list['tarifrs'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['qty'],0);?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?>     
</table>

</div>
</div>
<br />

<div align="center">
  <div id="frame">
    <div id="frame_title">
      <h3>C. Pasien Jamkesmas</h3></div>
<?php
 $sql="select a.kdpoly,c.nama as poly, d.tarifrs, e.tarifjaspel,sum(d.qty) as qty, a.kddokter,b.namadokter,sum(e.tarifjaspel*d.qty) as tarif , 
							case kdprofesi when 2 then 0.3*sum(e.tarifjaspel*d.qty) else 0.7*sum(e.tarifjaspel*d.qty) end as jsdr,
							case kdprofesi when 2 then 0.15*sum(e.tarifjaspel*d.qty) else 0.1*sum(e.tarifjaspel*d.qty) end as manajemen,
							case kdprofesi when 2 then 0.55*sum(e.tarifjaspel*d.qty) else 0.2*sum(e.tarifjaspel*d.qty) end as pendukung
from t_pendaftaran a
inner join m_dokter b on a.kddokter=b.kddokter 
inner join  m_poly c on a.kdpoly=c.kode 
inner join t_billrajal d on a.idxdaftar=d.idxdaftar aND  a.kdpoly in(9) and d.kodetarif in(
'010401','010402','010403','010404','010406','010407','010408','010409','010411','010412','010413','010414')
inner join m_tarif e on e.kode=d.kodetarif 
where ".$search." and a.kdcarabayar=3
group by a.kdpoly,c.nama, a.kddokter,b.namadokter,d.tarifrs,d.qty order by a.kdpoly";
$qry = mysql_query($sql) or die (mysql_error());
?>
<table width="840" border="1" class="tb">
  <tr>
    <th colspan="9">Pemeriksaan UGD</th>
  </tr>
  <tr>
    <td width="78">Poly</td>
    <td width="138">Nama Dokter</td>
    <td width="84">Tarif RS</td>
    <td width="75">Tarif Jaspel</td>
    <td width="75">Jumlah</td>    
    <td width="73">Total</td>


    <td width="79">Jasa Dokter</td>    
    <td width="95">Manajemen</td>
    <td width="85">Pendukung</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>
    <td><?=$list['poly'];?></td>
   <td><?=$list['namadokter'];?></td>
   <td><?= number_format($list['tarifrs'],0);?></td>
   <td><?= number_format($list['tarifjaspel'],0);?></td>
   <td><?= number_format($list['qty'],0);?></td>    
    <td><?= number_format($list['tarif'],0);?></td>
 
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?> 
 
</table>
<p>&nbsp;</p>
<?php
/*echo $sql="select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.2*sum(d.tarifrs*d.qty) as 	pendukung
					from t_pendaftaran a
					
					left join m_dokter b on a.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join t_billrajal d on a.idxdaftar=d.idxdaftar
					inner join m_tarif e on d.kodetarif=e.kode and kodetarif in ('010405','010410') 
					where ".$search." and a.kdpoly in(9) and a.kdcarabayar=3
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly";*/
 $sql="select a.kdpoly,c.nama as poly, f.kddokter,b.namadokter,e.tarif, e.tarifjaspel, count(f.idxdaftar) as jml, e.tarifjaspel*count(f.idxdaftar)  as total ,
					   e.nama_jasa, 0.7*e.tarifjaspel*count(f.idxdaftar) as jsdr, 0.1*e.tarifjaspel*count(f.idxdaftar) as manajemen,  
					   0.2*e.tarifjaspel*count(f.idxdaftar) as 	pendukung
					from t_pendaftaran a
					inner join t_konsul_dokter f on a.idxdaftar=f.idxdaftar and rajal=1
					inner join m_dokter b on f.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join m_tarif e on f.kodetarif=e.kode and f.kodetarif in ('010405','010410') 
					where ".$search." and a.kdpoly in(9) and a.kdcarabayar=3
					group by a.kdpoly,c.nama, f.kddokter,b.namadokter,e.nama_jasa ,e.tarif
					order by a.kdpoly";					
$qry = mysql_query($sql) or die (mysql_error());
?>   
<table width="812" border="1" class="tb">
  <tr>
    <th colspan="9">Konsultasi dokter spesialis</th>
  </tr>
  <tr>
    <td width="148">Poly</td>
    <td width="82">Dokter/Bidan</td>
    <td width="71">Tarif RS</td>
    <td width="71">Tarif Jaspel</td>
    <td width="71">Jumlah</td>    
    <td width="71">Total</td>
    <td width="83">Jasa Dokter</td>


    <td width="71">Manajemen</td>
    <td width="86">Pendukung</td>
  </tr>
  <? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['jml'],0);?></td>
    <td><?= number_format($list['total'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
  <? } ?> 
</table>
<p>&nbsp;</p>
<?php
 /*$sql = "select a.kdpoly,c.nama as poly,f.kddokter,b.namadokter,e.nama_jasa,0.3*sum(d.tarifrs*d.qty) as jsdr, 0.15*sum(d.tarifrs*d.qty) as manajemen,  
   0.55*sum(d.tarifrs*d.qty) as  pendukung from t_pendaftaran a
inner join t_billrajal d on a.idxdaftar=d.idxdaftar and d.kodetarif='010415'
inner join m_poly c on a.kdpoly=c.kode 
inner join t_konsul_dokter f on a.idxdaftar=f.idxdaftar
inner join m_dokter b on f.kddokter=b.kddokter 
inner join m_tarif e on d.kodetarif=e.kode 
where ".$search." and a.kdpoly in(9) and  a.kdcarabayar=3
group by a.kdpoly,c.nama, f.kddokter,b.namadokter,e.nama_jasa 
order by a.kdpoly";*/
$sql="select a.kdpoly,c.nama as poly, f.kddokter,b.namadokter,e.tarif, e.tarifjaspel,count(f.idxdaftar) as jml, e.tarifjaspel*count(f.idxdaftar)  as total ,
					   e.nama_jasa, 0.7*e.tarifjaspel*count(f.idxdaftar) as jsdr, 0.1*e.tarifjaspel*count(f.idxdaftar) as manajemen,  
					   0.2*e.tarifjaspel*count(f.idxdaftar) as 	pendukung
					from t_pendaftaran a
					inner join t_konsul_dokter f on a.idxdaftar=f.idxdaftar and rajal=1
					inner join m_dokter b on f.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join m_tarif e on f.kodetarif=e.kode and f.kodetarif in ('010415') 
					where ".$search." and a.kdpoly in(9) and a.kdcarabayar=3
					group by a.kdpoly,c.nama, f.kddokter,b.namadokter,e.nama_jasa ,e.tarif
					order by a.kdpoly";					
$qry = mysql_query($sql) or die (mysql_error());
?> 
<table width="812" border="1" class="tb">
  <tr>
    <th colspan="9">ODC</th>
  </tr>
  <tr>
    <td width="148">Poly</td>
    <td width="82">Dokter</td>
    <td width="71">Tarif RS</td>
    <td width="71">Tarif Jaspel</td>
    <td width="71">Jumlah</td>    
    <td width="71">Total</td>
    <td width="83">Jasa Dokter</td>


    <td width="71">Manajemen</td>
    <td width="86">Pendukung</td>
  </tr>
  <? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['jml'],0);?></td>
    <td><?= number_format($list['total'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?> 
</table>
<p>&nbsp;</p>
<?php
 $sql="select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        case kdprofesi when 1 then 0.7*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.4*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.35*(f.tarifjaspel)*count(a.idxdaftar) end as jsdr,
       case kdprofesi when 1 then 0.075*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.2*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0*(f.tarifjaspel)*count(a.idxdaftar) end as asisten,
       case kdprofesi when 1 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.15*(f.tarifjaspel)*count(a.idxdaftar) end as manajemen, 
       case kdprofesi when 1 then 0.125*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.3*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.5*(f.tarifjaspel)*count(a.idxdaftar) end as pendukung, 
      d.namadokter, c.nama as poly, f.nama_jasa 
from t_tindakan_medis a
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=3 and b.kdpoly in(9)
inner join m_pasien m on b.nomr=m.nomr
inner join m_poly c on b.kdpoly=c.kode 
inner join m_dokter d on a.kddokter=d.kddokter
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif like '0108%' and rajal=1 and ".$search." group by d.namadokter, c.nama,f.nama_jasa,a.idxdaftar,f.tarif";
$qry = mysql_query($sql) or die (mysql_error());
?>                    
<table width="1072" border="1" class="tb">
  <tr>
    <th colspan="12">Tindakan  paket medis IIIA/ IIIB/ IIIC</th>
  </tr>
  <tr>
    <td width="103">Poly</td>
    <td width="105">Nama Dokter</td>
    <td width="82">Paket</td>
    <td width="80">Tarif</td>
    <td width="80">Tarif Jaspel</td>
    <td width="80">Pasien</td>
    <td width="80">Jml Tindakan</td>

    <td width="80">Total</td>
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
    <td><?= number_format($list['tarifrs'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= $list['pasien'];?></td>
    <td><?= number_format($list['qty'],0);?></td>
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
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(9) and kodetarif in('010322','010323','010324') and d.kodetarif=e.kode and a.kdcarabayar=3
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
$qrys = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.1*sum(d.tarifrs*d.qty) as 	pendukung,0.1*sum(d.tarifrs*d.qty) as asisten 

					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(9) and 
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
<? while ($listx = mysql_fetch_array($qrys)){  ?>  
  <tr>
    <td><?= $listx['namadokter'];?></td>
    <td><?= number_format($listx['tarif'],0);?></td>
    <td><?= number_format($listx['jsdr'],0);?></td>
    <td><?= number_format($listx['manajemen'],0);?></td>
    <td><?= number_format($listx['pendukung'],0);?></td>
    <td><?= number_format($listx['asisten'],0);?></td>
  </tr>
<? } ?>
</table>

<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.1*sum(d.tarifrs*d.qty) as 	pendukung,0.1*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(9) and 
					 kodetarif in('010304','010305') 
					 and d.kodetarif=e.kode and a.kdcarabayar=3
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?>
<table width="488" border="1" class="tb">
  <tr>
    <th colspan="5">Persalinan dengan penyulit</th>
  </tr>
  <tr>
      <td width="68">Pendapatan</td>
    <td width="150">Dokter</td>

    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
    <td width="83">Asisten</td>
  </tr>
  <tr>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
  </tr>
</table>
<p>&nbsp;</p>
<?php 
$sql="select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,d.tarifrs,e.tarifjaspel, sum(d.qty) as qty,sum(e.tarifjaspel*d.qty) as tarif ,
e.nama_jasa, 0.7*sum(e.tarifjaspel*d.qty) as jsdr, 0.1*sum(e.tarifjaspel*d.qty) as manajemen,  0.20*sum(e.tarifjaspel*d.qty) as pendukung
from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
 where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." and a.kdpoly =9 and kodetarif in('01050202','01050203','01050204','01050205') and d.kodetarif=e.kode and a.kdcarabayar=3 
 group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa,d.tarifrs 
UNION
select a.kdpoly,c.nama as poly, f.kd_dokter,b.namadokter,e.tarif as tarifrs,e.tarifjaspel, count(f.idxdaftar)  as qty,
        e.tarifjaspel*count(f.idxdaftar)  as tarif ,
e.nama_jasa, 0.7* e.tarifjaspel*count(f.idxdaftar)  as jsdr, 0.1* e.tarifjaspel*count(f.idxdaftar) as manajemen,  
0.20* e.tarifjaspel*count(f.idxdaftar)  as pendukung
from t_pendaftaran a
inner join t_ekg f on a.idxdaftar=f.idxdaftar
inner join m_dokter b on f.kd_dokter=b.kddokter 
inner join m_poly c on a.kdpoly=c.kode 
inner join m_tarif e on e.kode=f.kd_tarif
 where a.kdpoly =9 and ".$search." and a.kdcarabayar=3  
group by a.kdpoly,c.nama, f.kd_dokter,b.namadokter,e.nama_jasa ";

$qry=mysql_query($sql) or die (mysql_error())
?>
<table width="765" border="1" class="tb">
  <tr>
    <th colspan="11">Elektromedik</th>
  </tr>
  <tr>
    <td width="69">Poly</td>
    <td width="119">Nama Dokter</td>    
    <td width="102"> Tindakan</td>
    <td width="73">Tarif RS</td>
    <td width="53">TarifJaspel</td>
    <td width="53">Jumlah</td>

    <td width="76">Total</td>
    <td width="56">Jasa Dr</td>
    <td width="77">Manajemen</td>
    <td width="82">Pendukung</td>

  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  
  <tr>
    <td><?= $list['poly'];?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= number_format($list['tarifrs'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['qty'],0);?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?>    
</table>
<p> <?php 
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,e.tarifjaspel, d.tarifrs,d.qty,
e.nama_jasa, 0.7*sum(e.tarifjaspel*d.qty) as jsdr, 0.1*sum(e.tarifjaspel*d.qty) as manajemen,  0.20*sum(e.tarifjaspel*d.qty) as pendukung
from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
 where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and  ".$search." 
 and a.kdpoly in(9)
and kodetarif like '010903%' and d.kodetarif=e.kode and a.kdcarabayar=3
 group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
order by a.kdpoly") or die (mysql_error());?>  
<table width="851" border="1" class="tb">
  <tr>
    <th colspan="11">Visum </th>
  </tr>
  <tr>
    <td width="87">Poly</td>
    <td width="122">Dokter</td>
    <td width="96">Tindakan</td>


    <td width="63">Tarif RS</td>
    <td width="71">Tarif Jaspel</td>
    <td width="42">Jumlah</td>
    <td width="72">Pendapatan</td>
    <td width="58">Jasa Dr</td>
    <td width="71">Manajemen</td>
    <td width="105">Pendukung</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  
  <tr>
    <td><?= $list['poly'];?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= number_format($list['tarifrs'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['qty'],0);?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?>     
</table>

  </div>
</div><br />

<div align="center">
  <div id="frame">
    <div id="frame_title">
      <h3>D. Pasien SKTM</h3></div>
<?php
 $sql="select a.kdpoly,c.nama as poly, d.tarifrs, e.tarifjaspel,sum(d.qty) as qty, a.kddokter,b.namadokter,sum(e.tarifjaspel*d.qty) as tarif , 
							case kdprofesi when 2 then 0.3*sum(e.tarifjaspel*d.qty) else 0.7*sum(e.tarifjaspel*d.qty) end as jsdr,
							case kdprofesi when 2 then 0.15*sum(e.tarifjaspel*d.qty) else 0.1*sum(e.tarifjaspel*d.qty) end as manajemen,
							case kdprofesi when 2 then 0.55*sum(e.tarifjaspel*d.qty) else 0.2*sum(e.tarifjaspel*d.qty) end as pendukung
from t_pendaftaran a
inner join m_dokter b on a.kddokter=b.kddokter 
inner join  m_poly c on a.kdpoly=c.kode 
inner join t_billrajal d on a.idxdaftar=d.idxdaftar aND  a.kdpoly in(9) and d.kodetarif in(
'010401','010402','010403','010404','010406','010407','010408','010409','010411','010412','010413','010414')
inner join m_tarif e on e.kode=d.kodetarif 
where ".$search." and a.kdcarabayar=4
group by a.kdpoly,c.nama, a.kddokter,b.namadokter,d.tarifrs,d.qty order by a.kdpoly";
$qry = mysql_query($sql) or die (mysql_error());
?>
<table width="840" border="1" class="tb">
  <tr>
    <th colspan="9">Pemeriksaan UGD</th>
  </tr>
  <tr>
    <td width="78">Poly</td>
    <td width="138">Nama Dokter</td>
    <td width="84">Tarif RS</td>
    <td width="75">Tarif Jaspel</td>
    <td width="75">Jumlah</td>    
    <td width="73">Total</td>


    <td width="79">Jasa Dokter</td>    
    <td width="95">Manajemen</td>
    <td width="85">Pendukung</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>
    <td><?=$list['poly'];?></td>
   <td><?=$list['namadokter'];?></td>
   <td><?= number_format($list['tarifrs'],0);?></td>
   <td><?= number_format($list['tarifjaspel'],0);?></td>
   <td><?= number_format($list['qty'],0);?></td>    
    <td><?= number_format($list['tarif'],0);?></td>
 
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?> 
 
</table>
<p>&nbsp;</p>
<?php
/*echo $sql="select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.2*sum(d.tarifrs*d.qty) as 	pendukung
					from t_pendaftaran a
					
					left join m_dokter b on a.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join t_billrajal d on a.idxdaftar=d.idxdaftar
					inner join m_tarif e on d.kodetarif=e.kode and kodetarif in ('010405','010410') 
					where ".$search." and a.kdpoly in(9) and a.kdcarabayar=4
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly";*/
 $sql="select a.kdpoly,c.nama as poly, f.kddokter,b.namadokter,e.tarif, e.tarifjaspel, count(f.idxdaftar) as jml, e.tarifjaspel*count(f.idxdaftar)  as total ,
					   e.nama_jasa, 0.7*e.tarifjaspel*count(f.idxdaftar) as jsdr, 0.1*e.tarifjaspel*count(f.idxdaftar) as manajemen,  
					   0.2*e.tarifjaspel*count(f.idxdaftar) as 	pendukung
					from t_pendaftaran a
					inner join t_konsul_dokter f on a.idxdaftar=f.idxdaftar and rajal=1
					inner join m_dokter b on f.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join m_tarif e on f.kodetarif=e.kode and f.kodetarif in ('010405','010410') 
					where ".$search." and a.kdpoly in(9) and a.kdcarabayar=4
					group by a.kdpoly,c.nama, f.kddokter,b.namadokter,e.nama_jasa ,e.tarif
					order by a.kdpoly";					
$qry = mysql_query($sql) or die (mysql_error());
?>   
<table width="812" border="1" class="tb">
  <tr>
    <th colspan="9">Konsultasi dokter spesialis</th>
  </tr>
  <tr>
    <td width="148">Poly</td>
    <td width="82">Dokter/Bidan</td>
    <td width="71">Tarif RS</td>
    <td width="71">Tarif Jaspel</td>
    <td width="71">Jumlah</td>    
    <td width="71">Total</td>
    <td width="83">Jasa Dokter</td>


    <td width="71">Manajemen</td>
    <td width="86">Pendukung</td>
  </tr>
  <? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['jml'],0);?></td>
    <td><?= number_format($list['total'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
  <? } ?> 
</table>
<p>&nbsp;</p>
<?php
 /*$sql = "select a.kdpoly,c.nama as poly,f.kddokter,b.namadokter,e.nama_jasa,0.3*sum(d.tarifrs*d.qty) as jsdr, 0.15*sum(d.tarifrs*d.qty) as manajemen,  
   0.55*sum(d.tarifrs*d.qty) as  pendukung from t_pendaftaran a
inner join t_billrajal d on a.idxdaftar=d.idxdaftar and d.kodetarif='010415'
inner join m_poly c on a.kdpoly=c.kode 
inner join t_konsul_dokter f on a.idxdaftar=f.idxdaftar
inner join m_dokter b on f.kddokter=b.kddokter 
inner join m_tarif e on d.kodetarif=e.kode 
where ".$search." and a.kdpoly in(9) and  a.kdcarabayar=4
group by a.kdpoly,c.nama, f.kddokter,b.namadokter,e.nama_jasa 
order by a.kdpoly";*/
$sql="select a.kdpoly,c.nama as poly, f.kddokter,b.namadokter,e.tarif, e.tarifjaspel,count(f.idxdaftar) as jml, e.tarifjaspel*count(f.idxdaftar)  as total ,
					   e.nama_jasa, 0.7*e.tarifjaspel*count(f.idxdaftar) as jsdr, 0.1*e.tarifjaspel*count(f.idxdaftar) as manajemen,  
					   0.2*e.tarifjaspel*count(f.idxdaftar) as 	pendukung
					from t_pendaftaran a
					inner join t_konsul_dokter f on a.idxdaftar=f.idxdaftar and rajal=1
					inner join m_dokter b on f.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join m_tarif e on f.kodetarif=e.kode and f.kodetarif in ('010415') 
					where ".$search." and a.kdpoly in(9) and a.kdcarabayar=4
					group by a.kdpoly,c.nama, f.kddokter,b.namadokter,e.nama_jasa ,e.tarif
					order by a.kdpoly";					
$qry = mysql_query($sql) or die (mysql_error());
?> 
<table width="812" border="1" class="tb">
  <tr>
    <th colspan="9">ODC</th>
  </tr>
  <tr>
    <td width="148">Poly</td>
    <td width="82">Dokter</td>
    <td width="71">Tarif RS</td>
    <td width="71">Tarif Jaspel</td>
    <td width="71">Jumlah</td>    
    <td width="71">Total</td>
    <td width="83">Jasa Dokter</td>


    <td width="71">Manajemen</td>
    <td width="86">Pendukung</td>
  </tr>
  <? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['jml'],0);?></td>
    <td><?= number_format($list['total'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?> 
</table>
<p>&nbsp;</p>
<?php
 $sql="select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        case kdprofesi when 1 then 0.7*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.4*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.35*(f.tarifjaspel)*count(a.idxdaftar) end as jsdr,
       case kdprofesi when 1 then 0.075*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.2*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0*(f.tarifjaspel)*count(a.idxdaftar) end as asisten,
       case kdprofesi when 1 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.15*(f.tarifjaspel)*count(a.idxdaftar) end as manajemen, 
       case kdprofesi when 1 then 0.125*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.3*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.5*(f.tarifjaspel)*count(a.idxdaftar) end as pendukung, 
      d.namadokter, c.nama as poly, f.nama_jasa 
from t_tindakan_medis a
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=4 and b.kdpoly in(9)
inner join m_pasien m on b.nomr=m.nomr
inner join m_poly c on b.kdpoly=c.kode 
inner join m_dokter d on a.kddokter=d.kddokter
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif like '0108%' and rajal=1 and ".$search." group by d.namadokter, c.nama,f.nama_jasa,a.idxdaftar,f.tarif";
$qry = mysql_query($sql) or die (mysql_error());
?>                    
<table width="1072" border="1" class="tb">
  <tr>
    <th colspan="12">Tindakan  paket medis IIIA/ IIIB/ IIIC</th>
  </tr>
  <tr>
    <td width="103">Poly</td>
    <td width="105">Nama Dokter</td>
    <td width="82">Paket</td>
    <td width="80">Tarif</td>
    <td width="80">Tarif Jaspel</td>
    <td width="80">Pasien</td>
    <td width="80">Jml Tindakan</td>

    <td width="80">Total</td>
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
    <td><?= number_format($list['tarifrs'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= $list['pasien'];?></td>
    <td><?= number_format($list['qty'],0);?></td>
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
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(9) and kodetarif in('010322','010323','010324') and d.kodetarif=e.kode and a.kdcarabayar=4
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
$qrys = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.1*sum(d.tarifrs*d.qty) as 	pendukung,0.1*sum(d.tarifrs*d.qty) as asisten 

					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(9) and 
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
<? while ($listx = mysql_fetch_array($qrys)){  ?>  
  <tr>
    <td><?= $listx['namadokter'];?></td>
    <td><?= number_format($listx['tarif'],0);?></td>
    <td><?= number_format($listx['jsdr'],0);?></td>
    <td><?= number_format($listx['manajemen'],0);?></td>
    <td><?= number_format($listx['pendukung'],0);?></td>
    <td><?= number_format($listx['asisten'],0);?></td>
  </tr>
<? } ?>
</table>

<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.1*sum(d.tarifrs*d.qty) as 	pendukung,0.1*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(9) and 
					 kodetarif in('010304','010305') 
					 and d.kodetarif=e.kode and a.kdcarabayar=4
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?>
<table width="488" border="1" class="tb">
  <tr>
    <th colspan="5">Persalinan dengan penyulit</th>
  </tr>
  <tr>
      <td width="68">Pendapatan</td>
    <td width="150">Dokter</td>

    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
    <td width="83">Asisten</td>
  </tr>
  <tr>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
  </tr>
</table>
<p>&nbsp;</p>
<?php 
$sql="select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,d.tarifrs,e.tarifjaspel, sum(d.qty) as qty,sum(e.tarifjaspel*d.qty) as tarif ,
e.nama_jasa, 0.7*sum(e.tarifjaspel*d.qty) as jsdr, 0.1*sum(e.tarifjaspel*d.qty) as manajemen,  0.20*sum(e.tarifjaspel*d.qty) as pendukung
from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
 where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." and a.kdpoly =9 and kodetarif in('01050202','01050203','01050204','01050205') and d.kodetarif=e.kode and a.kdcarabayar=4 
 group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa,d.tarifrs 
UNION
select a.kdpoly,c.nama as poly, f.kd_dokter,b.namadokter,e.tarif as tarifrs,e.tarifjaspel, count(f.idxdaftar)  as qty,
        e.tarifjaspel*count(f.idxdaftar)  as tarif ,
e.nama_jasa, 0.7* e.tarifjaspel*count(f.idxdaftar)  as jsdr, 0.1* e.tarifjaspel*count(f.idxdaftar) as manajemen,  
0.20* e.tarifjaspel*count(f.idxdaftar)  as pendukung
from t_pendaftaran a
inner join t_ekg f on a.idxdaftar=f.idxdaftar
inner join m_dokter b on f.kd_dokter=b.kddokter 
inner join m_poly c on a.kdpoly=c.kode 
inner join m_tarif e on e.kode=f.kd_tarif
 where a.kdpoly =9 and ".$search." and a.kdcarabayar=4  
group by a.kdpoly,c.nama, f.kd_dokter,b.namadokter,e.nama_jasa ";

$qry=mysql_query($sql) or die (mysql_error())
?>
<table width="765" border="1" class="tb">
  <tr>
    <th colspan="11">Elektromedik</th>
  </tr>
  <tr>
    <td width="69">Poly</td>
    <td width="119">Nama Dokter</td>    
    <td width="102"> Tindakan</td>
    <td width="73">Tarif RS</td>
    <td width="53">TarifJaspel</td>
    <td width="53">Jumlah</td>

    <td width="76">Total</td>
    <td width="56">Jasa Dr</td>
    <td width="77">Manajemen</td>
    <td width="82">Pendukung</td>

  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  
  <tr>
    <td><?= $list['poly'];?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= number_format($list['tarifrs'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['qty'],0);?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?>    
</table>
<p>
<p> <?php 
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,e.tarifjaspel, d.tarifrs,d.qty,
e.nama_jasa, 0.7*sum(e.tarifjaspel*d.qty) as jsdr, 0.1*sum(e.tarifjaspel*d.qty) as manajemen,  0.20*sum(e.tarifjaspel*d.qty) as pendukung
from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
 where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
 and a.kdpoly in(9)
and kodetarif like '010903%' and d.kodetarif=e.kode and a.kdcarabayar=4
 group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
order by a.kdpoly") or die (mysql_error());?>  
<table width="851" border="1" class="tb">
  <tr>
    <th colspan="11">Visum </th>
  </tr>
  <tr>
    <td width="87">Poly</td>
    <td width="122">Dokter</td>
    <td width="96">Tindakan</td>


    <td width="63">Tarif RS</td>
    <td width="71">Tarif Jaspel</td>
    <td width="42">Jumlah</td>
    <td width="72">Pendapatan</td>
    <td width="58">Jasa Dr</td>
    <td width="71">Manajemen</td>
    <td width="105">Pendukung</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  
  <tr>
    <td><?= $list['poly'];?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= number_format($list['tarifrs'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['qty'],0);?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?>     
</table>

  </div>
</div><br />

<div align="center">
  <div id="frame">
    <div id="frame_title">
      <h3>E. Pasien Lain-lain</h3>
    </div>
<?php
 $sql="select a.kdpoly,c.nama as poly, d.tarifrs, e.tarifjaspel,sum(d.qty) as qty, a.kddokter,b.namadokter,sum(e.tarifjaspel*d.qty) as tarif , 
							case kdprofesi when 2 then 0.3*sum(e.tarifjaspel*d.qty) else 0.7*sum(e.tarifjaspel*d.qty) end as jsdr,
							case kdprofesi when 2 then 0.15*sum(e.tarifjaspel*d.qty) else 0.1*sum(e.tarifjaspel*d.qty) end as manajemen,
							case kdprofesi when 2 then 0.55*sum(e.tarifjaspel*d.qty) else 0.2*sum(e.tarifjaspel*d.qty) end as pendukung
from t_pendaftaran a
inner join m_dokter b on a.kddokter=b.kddokter 
inner join  m_poly c on a.kdpoly=c.kode 
inner join t_billrajal d on a.idxdaftar=d.idxdaftar aND  a.kdpoly in(9) and d.kodetarif in(
'010401','010402','010403','010404','010406','010407','010408','010409','010411','010412','010413','010414')
inner join m_tarif e on e.kode=d.kodetarif 
where ".$search." and a.kdcarabayar=5
group by a.kdpoly,c.nama, a.kddokter,b.namadokter,d.tarifrs,d.qty order by a.kdpoly";
$qry = mysql_query($sql) or die (mysql_error());
?>
<table width="840" border="1" class="tb">
  <tr>
    <th colspan="9">Pemeriksaan UGD</th>
  </tr>
  <tr>
    <td width="78">Poly</td>
    <td width="138">Nama Dokter</td>
    <td width="84">Tarif RS</td>
    <td width="75">Tarif Jaspel</td>
    <td width="75">Jumlah</td>    
    <td width="73">Total</td>


    <td width="79">Jasa Dokter</td>    
    <td width="95">Manajemen</td>
    <td width="85">Pendukung</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>
    <td><?=$list['poly'];?></td>
   <td><?=$list['namadokter'];?></td>
   <td><?= number_format($list['tarifrs'],0);?></td>
   <td><?= number_format($list['tarifjaspel'],0);?></td>
   <td><?= number_format($list['qty'],0);?></td>    
    <td><?= number_format($list['tarif'],0);?></td>
 
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?> 
 
</table>
<p>&nbsp;</p>
<?php
/*echo $sql="select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.2*sum(d.tarifrs*d.qty) as 	pendukung
					from t_pendaftaran a
					
					left join m_dokter b on a.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join t_billrajal d on a.idxdaftar=d.idxdaftar
					inner join m_tarif e on d.kodetarif=e.kode and kodetarif in ('010405','010410') 
					where ".$search." and a.kdpoly in(9) and a.kdcarabayar=5
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly";*/
 $sql="select a.kdpoly,c.nama as poly, f.kddokter,b.namadokter,e.tarif, e.tarifjaspel, count(f.idxdaftar) as jml, e.tarifjaspel*count(f.idxdaftar)  as total ,
					   e.nama_jasa, 0.7*e.tarifjaspel*count(f.idxdaftar) as jsdr, 0.1*e.tarifjaspel*count(f.idxdaftar) as manajemen,  
					   0.2*e.tarifjaspel*count(f.idxdaftar) as 	pendukung
					from t_pendaftaran a
					inner join t_konsul_dokter f on a.idxdaftar=f.idxdaftar and rajal=1
					inner join m_dokter b on f.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join m_tarif e on f.kodetarif=e.kode and f.kodetarif in ('010405','010410') 
					where ".$search." and a.kdpoly in(9) and a.kdcarabayar=5
					group by a.kdpoly,c.nama, f.kddokter,b.namadokter,e.nama_jasa ,e.tarif
					order by a.kdpoly";					
$qry = mysql_query($sql) or die (mysql_error());
?>   
<table width="812" border="1" class="tb">
  <tr>
    <th colspan="9">Konsultasi dokter spesialis</th>
  </tr>
  <tr>
    <td width="148">Poly</td>
    <td width="82">Dokter/Bidan</td>
    <td width="71">Tarif RS</td>
    <td width="71">Tarif Jaspel</td>
    <td width="71">Jumlah</td>    
    <td width="71">Total</td>
    <td width="83">Jasa Dokter</td>


    <td width="71">Manajemen</td>
    <td width="86">Pendukung</td>
  </tr>
  <? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['jml'],0);?></td>
    <td><?= number_format($list['total'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
  <? } ?> 
</table>
<p>&nbsp;</p>
<?php
 /*$sql = "select a.kdpoly,c.nama as poly,f.kddokter,b.namadokter,e.nama_jasa,0.3*sum(d.tarifrs*d.qty) as jsdr, 0.15*sum(d.tarifrs*d.qty) as manajemen,  
   0.55*sum(d.tarifrs*d.qty) as  pendukung from t_pendaftaran a
inner join t_billrajal d on a.idxdaftar=d.idxdaftar and d.kodetarif='010415'
inner join m_poly c on a.kdpoly=c.kode 
inner join t_konsul_dokter f on a.idxdaftar=f.idxdaftar
inner join m_dokter b on f.kddokter=b.kddokter 
inner join m_tarif e on d.kodetarif=e.kode 
where ".$search." and a.kdpoly in(9) and  a.kdcarabayar=5
group by a.kdpoly,c.nama, f.kddokter,b.namadokter,e.nama_jasa 
order by a.kdpoly";*/
$sql="select a.kdpoly,c.nama as poly, f.kddokter,b.namadokter,e.tarif, e.tarifjaspel,count(f.idxdaftar) as jml, e.tarifjaspel*count(f.idxdaftar)  as total ,
					   e.nama_jasa, 0.7*e.tarifjaspel*count(f.idxdaftar) as jsdr, 0.1*e.tarifjaspel*count(f.idxdaftar) as manajemen,  
					   0.2*e.tarifjaspel*count(f.idxdaftar) as 	pendukung
					from t_pendaftaran a
					inner join t_konsul_dokter f on a.idxdaftar=f.idxdaftar and rajal=1
					inner join m_dokter b on f.kddokter=b.kddokter 
					inner join m_poly c on a.kdpoly=c.kode 
					inner join m_tarif e on f.kodetarif=e.kode and f.kodetarif in ('010415') 
					where ".$search." and a.kdpoly in(9) and a.kdcarabayar=5
					group by a.kdpoly,c.nama, f.kddokter,b.namadokter,e.nama_jasa ,e.tarif
					order by a.kdpoly";					
$qry = mysql_query($sql) or die (mysql_error());
?> 
<table width="812" border="1" class="tb">
  <tr>
    <th colspan="9">ODC</th>
  </tr>
  <tr>
    <td width="148">Poly</td>
    <td width="82">Dokter</td>
    <td width="71">Tarif RS</td>
    <td width="71">Tarif Jaspel</td>
    <td width="71">Jumlah</td>    
    <td width="71">Total</td>
    <td width="83">Jasa Dokter</td>


    <td width="71">Manajemen</td>
    <td width="86">Pendukung</td>
  </tr>
  <? while ($list = mysql_fetch_array($qry)){  ?>
  <tr>

    <td><?=$list['poly'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['jml'],0);?></td>
    <td><?= number_format($list['total'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?> 
</table>
<p>&nbsp;</p>
<?php
 $sql="select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        case kdprofesi when 1 then 0.7*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.4*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.35*(f.tarifjaspel)*count(a.idxdaftar) end as jsdr,
       case kdprofesi when 1 then 0.075*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.2*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0*(f.tarifjaspel)*count(a.idxdaftar) end as asisten,
       case kdprofesi when 1 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.15*(f.tarifjaspel)*count(a.idxdaftar) end as manajemen, 
       case kdprofesi when 1 then 0.125*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.3*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.5*(f.tarifjaspel)*count(a.idxdaftar) end as pendukung, 
      d.namadokter, c.nama as poly, f.nama_jasa 
from t_tindakan_medis a
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=5 and b.kdpoly in(9)
inner join m_pasien m on b.nomr=m.nomr
inner join m_poly c on b.kdpoly=c.kode 
inner join m_dokter d on a.kddokter=d.kddokter
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif like '0108%' and rajal=1 and ".$search." group by d.namadokter, c.nama,f.nama_jasa,a.idxdaftar,f.tarif";
$qry = mysql_query($sql) or die (mysql_error());
?>                    
<table width="1072" border="1" class="tb">
  <tr>
    <th colspan="12">Tindakan  paket medis IIIA/ IIIB/ IIIC</th>
  </tr>
  <tr>
    <td width="103">Poly</td>
    <td width="105">Nama Dokter</td>
    <td width="82">Paket</td>
    <td width="80">Tarif</td>
    <td width="80">Tarif Jaspel</td>
    <td width="80">Pasien</td>
    <td width="80">Jml Tindakan</td>

    <td width="80">Total</td>
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
    <td><?= number_format($list['tarifrs'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= $list['pasien'];?></td>
    <td><?= number_format($list['qty'],0);?></td>
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
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(9) and kodetarif in('010322','010323','010324') and d.kodetarif=e.kode and a.kdcarabayar=5
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
$qrys = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.1*sum(d.tarifrs*d.qty) as 	pendukung,0.1*sum(d.tarifrs*d.qty) as asisten 

					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(9) and 
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
<? while ($listx = mysql_fetch_array($qrys)){  ?>  
  <tr>
    <td><?= $listx['namadokter'];?></td>
    <td><?= number_format($listx['tarif'],0);?></td>
    <td><?= number_format($listx['jsdr'],0);?></td>
    <td><?= number_format($listx['manajemen'],0);?></td>
    <td><?= number_format($listx['pendukung'],0);?></td>
    <td><?= number_format($listx['asisten'],0);?></td>
  </tr>
<? } ?>
</table>

<p>&nbsp;</p>
<?php
$qry = mysql_query("select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,sum(d.tarifrs*d.qty) as tarif ,
					   e.nama_jasa, 0.7*sum(d.tarifrs*d.qty) as jsdr, 0.1*sum(d.tarifrs*d.qty) as manajemen,  
					   0.1*sum(d.tarifrs*d.qty) as 	pendukung,0.1*sum(d.tarifrs*d.qty) as asisten 
					from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
					where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." 
					 aND a.kdpoly=d.kdpoly and a.kdpoly in(9) and 
					 kodetarif in('010304','010305') 
					 and d.kodetarif=e.kode and a.kdcarabayar=5
					group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa 
					order by a.kdpoly") or die (mysql_error());
?>
<table width="488" border="1" class="tb">
  <tr>
    <th colspan="5">Persalinan dengan penyulit</th>
  </tr>
  <tr>
      <td width="68">Pendapatan</td>
    <td width="150">Dokter</td>

    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
    <td width="83">Asisten</td>
  </tr>
  <tr>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
  </tr>
</table>
<p>&nbsp;</p>
<?php 
$sql="select a.kdpoly,c.nama as poly, a.kddokter,b.namadokter,d.tarifrs,e.tarifjaspel, sum(d.qty) as qty,sum(e.tarifjaspel*d.qty) as tarif ,
e.nama_jasa, 0.7*sum(e.tarifjaspel*d.qty) as jsdr, 0.1*sum(e.tarifjaspel*d.qty) as manajemen,  0.20*sum(e.tarifjaspel*d.qty) as pendukung
from t_pendaftaran a, m_dokter b, m_poly c, t_billrajal d, m_tarif e
 where a.kddokter=b.kddokter and a.kdpoly=c.kode and a.idxdaftar=d.idxdaftar and ".$search." and a.kdpoly =9 and kodetarif in('01050202','01050203','01050204','01050205') and d.kodetarif=e.kode and a.kdcarabayar=5 
 group by a.kdpoly,c.nama, a.kddokter,b.namadokter,e.nama_jasa,d.tarifrs 
UNION
select a.kdpoly,c.nama as poly, f.kd_dokter,b.namadokter,e.tarif as tarifrs,e.tarifjaspel, count(f.idxdaftar)  as qty,
        e.tarifjaspel*count(f.idxdaftar)  as tarif ,
e.nama_jasa, 0.7* e.tarifjaspel*count(f.idxdaftar)  as jsdr, 0.1* e.tarifjaspel*count(f.idxdaftar) as manajemen,  
0.20* e.tarifjaspel*count(f.idxdaftar)  as pendukung
from t_pendaftaran a
inner join t_ekg f on a.idxdaftar=f.idxdaftar
inner join m_dokter b on f.kd_dokter=b.kddokter 
inner join m_poly c on a.kdpoly=c.kode 
inner join m_tarif e on e.kode=f.kd_tarif
 where a.kdpoly =9 and ".$search." and a.kdcarabayar=5  
group by a.kdpoly,c.nama, f.kd_dokter,b.namadokter,e.nama_jasa ";

$qry=mysql_query($sql) or die (mysql_error())
?>
<table width="765" border="1" class="tb">
  <tr>
    <th colspan="11">Elektromedik</th>
  </tr>
  <tr>
    <td width="69">Poly</td>
    <td width="119">Nama Dokter</td>    
    <td width="102"> Tindakan</td>
    <td width="73">Tarif RS</td>
    <td width="53">TarifJaspel</td>
    <td width="53">Jumlah</td>

    <td width="76">Total</td>
    <td width="56">Jasa Dr</td>
    <td width="77">Manajemen</td>
    <td width="82">Pendukung</td>

  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  
  <tr>
    <td><?= $list['poly'];?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= number_format($list['tarifrs'],0);?></td>
    <td><?= number_format($list['tarifjaspel'],0);?></td>
    <td><?= number_format($list['qty'],0);?></td>
    <td><?= number_format($list['tarif'],0);?></td>
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?>    
</table>  </div>
</div>

