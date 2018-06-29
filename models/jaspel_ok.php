<?php 
include("include/connect.php");


$search = "and a.tanggal=curdate()";
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
} 

if($tgl_kunjungan !=""){
	$search = " and a.tanggal between  '".$tgl_kunjungan."' ";
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
<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>JASPEL KAMAR OPERASI</h3></div>
<div align="left" >
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
    <input type="hidden" name="link" value="jas2" /></td>
  </tr>
</table>

    </form> 
    </div>
  <br />
<fieldset>
<legend >A. Pasien Umum</legend>

<?php $sql=
"select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        0.40*(f.tarifjaspel)*count(a.idxdaftar) as jsdrOperator,
        0.20*(f.tarifjaspel)*count(a.idxdaftar) as jsdranastesi,
        0.10*(f.tarifjaspel)*count(a.idxdaftar) as jsdranak,
        0.105*(f.tarifjaspel)*count(a.idxdaftar) as asisten,
        0.045*(f.tarifjaspel)*count(a.idxdaftar)  as manajemen, 
        0.15*(f.tarifjaspel)*count(a.idxdaftar)  as pendukung, 
        op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa 
from t_tindakan_medis a
inner join t_operasi op on a.idxdaftar=op.idxdaftar
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=1 
inner join m_pasien m on b.nomr=m.nomr
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif in ('01080304','01080305','01080306') and a.rajal=1  and
a.nip in(select nip from m_login where kdunit=15) ".$search." group by op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa,a.idxdaftar,f.tarif
union
select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        0.50*(f.tarifjaspel)*count(a.idxdaftar) as jsdrOperator,
        0.20*(f.tarifjaspel)*count(a.idxdaftar) as jsdranastesi,
        0*(f.tarifjaspel)*count(a.idxdaftar) as jsdranak,
        0.15*(f.tarifjaspel)*count(a.idxdaftar) as asisten,
        0.045*(f.tarifjaspel)*count(a.idxdaftar)  as manajemen, 
        0.105*(f.tarifjaspel)*count(a.idxdaftar)  as pendukung, 
        op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa 
from t_tindakan_medis a
inner join t_operasi op on a.idxdaftar=op.idxdaftar
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=1 
inner join m_pasien m on b.nomr=m.nomr
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif in ('01080301','01080302','01080303') and a.rajal=1  and
a.nip in(select nip from m_login where kdunit=15) ".$search." group by op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa,a.idxdaftar,f.tarif
";
$qry = mysql_query($sql) or die (mysql_error());
?>    
<table width="1184" border="0" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <th colspan="12">Tindakan Operatif Kecil, Sedang, Besar, Kuretase, dan Tubektomi</th>
  </tr>
  <tr>
    <th  align="center"  align="center" width="140">Tindakan</th>
    <th  align="center" width="75">Pasien</th>
    <th  align="center" width="75">Jml Tindakan</th>

    <th  align="center" width="111">Dokter  Operator</th>
    <th  align="center" width="116">Jasa dr Operator</th>
    <th  align="center" width="116">Dokter Anaestesi</th>
    <th  align="center" width="94">Jasa dr Anastesi</th>
    <th  align="center" width="94">Dokter Anak</th>
    <th  align="center" width="69">Jasa dr Anak</th>
    <th  align="center" width="69">Asisten</th>    
    <th  align="center" width="71">Manajemen</th>    
    <th  align="center" width="78">Pendukung</th>
  </tr>
  <? while ($list = mysql_fetch_array($qry)){  ?>  
  <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= $list['pasien'];?></td>
    <td><?= number_format($list['qty'],0);?></td>
    <td><?= $list['dokteroperator'];?> </td>
    <td><?= number_format($list['jsdrOperator'],0);?></td>
    <td><?= $list['dokteranastesi'];?> </td>
    <td><?= number_format($list['jsdranastesi'],0);?></td>
    <td><?= $list['dokteranak'];?></td>
    <td><?= number_format($list['jsdranak'],0);?></td>
    <td><?= number_format($list['asisten'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>    
  </tr>
 <?php } ?>
</table>
<br />
<?php
$sql="select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        case kdprofesi when 1 then 0.7*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.4*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.35*(f.tarifjaspel)*count(a.idxdaftar) end as jsdr,
       case kdprofesi when 1 then 0.075*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.2*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0*(f.tarifjaspel)*count(a.idxdaftar) end as asisten,
       case kdprofesi when 1 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.15*(f.tarifjaspel)*count(a.idxdaftar) end as manajemen, 
       case kdprofesi when 1 then 0.125*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.3*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.5*(f.tarifjaspel)*count(a.idxdaftar) end as pendukung, 
      d.namadokter, c.nama as poly, f.nama_jasa 
from t_tindakan_medis a
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=1 
inner join m_pasien m on b.nomr=m.nomr
inner join m_poly c on b.kdpoly=c.kode 
inner join m_dokter d on a.kddokter=d.kddokter
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif like '010801%' and a.rajal=1 and a.nip in(select nip from m_login where kdunit=15) 
 ".$search." group by d.namadokter, c.nama,f.nama_jasa,a.idxdaftar,f.tarif";
$qry = mysql_query($sql) or die (mysql_error());
?>                    
<table width="1072" border="0" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <th colspan="12">Tindakan Paket Medis IIIA/ IIIB/ IIIC</th>
  </tr>
  <tr>
    <th  align="center" width="103">Poly</th>
    <th  align="center" width="105">Nama Dokter</th>
    <th  align="center" width="82">Paket</th>
    <th  align="center" width="80">Tarif</th>
    <th  align="center" width="80">Tarif Jaspel</th>
    <th  align="center" width="80">Pasien</th>
    <th  align="center" width="80">Jml Tindakan</th>

    <th  align="center" width="80">Total</th>
    <th  align="center" width="71">Jasa Dr.</th>
    <th  align="center" width="71">Manajemen</th>
    <th  align="center" width="82">Pendukung</th>
    <th  align="center" width="82">Asisten</th>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
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
</fieldset>
<br />
<fieldset>
<legend>B. Pasien Askes</legend>
<?php $sql=
"select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        0.40*(f.tarifjaspel)*count(a.idxdaftar) as jsdrOperator,
        0.20*(f.tarifjaspel)*count(a.idxdaftar) as jsdranastesi,
        0.10*(f.tarifjaspel)*count(a.idxdaftar) as jsdranak,
        0.105*(f.tarifjaspel)*count(a.idxdaftar) as asisten,
        0.045*(f.tarifjaspel)*count(a.idxdaftar)  as manajemen, 
        0.15*(f.tarifjaspel)*count(a.idxdaftar)  as pendukung, 
        op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa 
from t_tindakan_medis a
inner join t_operasi op on a.idxdaftar=op.idxdaftar
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=2 
inner join m_pasien m on b.nomr=m.nomr
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif in ('01080304','01080305','01080306') and a.rajal=1  and
a.nip in(select nip from m_login where kdunit=15) ".$search." group by op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa,a.idxdaftar,f.tarif
union
select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        0.50*(f.tarifjaspel)*count(a.idxdaftar) as jsdrOperator,
        0.20*(f.tarifjaspel)*count(a.idxdaftar) as jsdranastesi,
        0*(f.tarifjaspel)*count(a.idxdaftar) as jsdranak,
        0.15*(f.tarifjaspel)*count(a.idxdaftar) as asisten,
        0.045*(f.tarifjaspel)*count(a.idxdaftar)  as manajemen, 
        0.105*(f.tarifjaspel)*count(a.idxdaftar)  as pendukung, 
        op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa 
from t_tindakan_medis a
inner join t_operasi op on a.idxdaftar=op.idxdaftar
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=2 
inner join m_pasien m on b.nomr=m.nomr
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif in ('01080301','01080302','01080303') and a.rajal=1  and
a.nip in(select nip from m_login where kdunit=15) ".$search." group by op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa,a.idxdaftar,f.tarif
";
$qry = mysql_query($sql) or die (mysql_error());
?>    
<table width="1184" border="0" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <th colspan="12">Tindakan Operatif Kecil, Sedang, Besar, Kuretase, dan Tubektomi</th>
  </tr>
  <tr>
    <th  align="center" width="140">Tindakan</th>
    <th  align="center" width="75">Pasien</th>
    <th  align="center" width="75">Jml Tindakan</th>

    <th  align="center" width="111">Dokter Operator</th>
    <th  align="center" width="116">Jasa dr Operator</th>
    <th  align="center" width="116">Dokter Anaestesi</th>
    <th  align="center" width="94">Jasa dr Anastesi</th>
    <th  align="center" width="94">Dokter Anak</th>
    <th  align="center" width="69">Jasa dr Anak</th>
    <th  align="center" width="69">Asisten</th>    
    <th  align="center" width="71">Manajemen</th>    
    <th  align="center" width="78">Pendukung</th>
  </tr>
  <? while ($list = mysql_fetch_array($qry)){  ?>  
  <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= $list['pasien'];?></td>
    <td><?= number_format($list['qty'],0);?></td>
    <td><?= $list['dokteroperator'];?> </td>
    <td><?= number_format($list['jsdrOperator'],0);?></td>
    <td><?= $list['dokteranastesi'];?> </td>
    <td><?= number_format($list['jsdranastesi'],0);?></td>
    <td><?= $list['dokteranak'];?></td>
    <td><?= number_format($list['jsdranak'],0);?></td>
    <td><?= number_format($list['asisten'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>    
  </tr>
 <?php } ?>
</table>
<br />
<?php
$sql="select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        case kdprofesi when 1 then 0.7*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.4*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.35*(f.tarifjaspel)*count(a.idxdaftar) end as jsdr,
       case kdprofesi when 1 then 0.075*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.2*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0*(f.tarifjaspel)*count(a.idxdaftar) end as asisten,
       case kdprofesi when 1 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.15*(f.tarifjaspel)*count(a.idxdaftar) end as manajemen, 
       case kdprofesi when 1 then 0.125*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.3*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.5*(f.tarifjaspel)*count(a.idxdaftar) end as pendukung, 
      d.namadokter, c.nama as poly, f.nama_jasa 
from t_tindakan_medis a
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=2 
inner join m_pasien m on b.nomr=m.nomr
inner join m_poly c on b.kdpoly=c.kode 
inner join m_dokter d on a.kddokter=d.kddokter
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif like '010801%' and a.rajal=1 and a.nip in(select nip from m_login where kdunit=15) 
 ".$search." group by d.namadokter, c.nama,f.nama_jasa,a.idxdaftar,f.tarif";
$qry = mysql_query($sql) or die (mysql_error());
?>                    
<table width="1072" border="0" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <th colspan="12">Tindakan Paket Medis IIIA/ IIIB/ IIIC</th>
  </tr>
  <tr>
    <th  align="center" width="103">Poly</th>
    <th  align="center" width="105">Nama Dokter</th>
    <th  align="center" width="82">Paket</th>
    <th  align="center" width="80">Tarif</th>
    <th  align="center" width="80">Tarif Jaspel</th>
    <th  align="center" width="80">Pasien</th>
    <th  align="center" width="80">Jml Tindakan</th>

    <th  align="center" width="80">Total</th>
    <th  align="center" width="71">Jasa Dr.</th>
    <th  align="center" width="71">Manajemen</th>
    <th  align="center" width="82">Pendukung</th>
    <th  align="center" width="82">Asisten</th>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
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
</fieldset>
<br />
<fieldset>
<legend>C. Pasien Jamkesmas</legend>
<?php $sql=
"select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        0.40*(f.tarifjaspel)*count(a.idxdaftar) as jsdrOperator,
        0.20*(f.tarifjaspel)*count(a.idxdaftar) as jsdranastesi,
        0.10*(f.tarifjaspel)*count(a.idxdaftar) as jsdranak,
        0.105*(f.tarifjaspel)*count(a.idxdaftar) as asisten,
        0.045*(f.tarifjaspel)*count(a.idxdaftar)  as manajemen, 
        0.15*(f.tarifjaspel)*count(a.idxdaftar)  as pendukung, 
        op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa 
from t_tindakan_medis a
inner join t_operasi op on a.idxdaftar=op.idxdaftar
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=3 
inner join m_pasien m on b.nomr=m.nomr
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif in ('01080304','01080305','01080306') and a.rajal=1  and
a.nip in(select nip from m_login where kdunit=15) ".$search." group by op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa,a.idxdaftar,f.tarif
union
select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        0.50*(f.tarifjaspel)*count(a.idxdaftar) as jsdrOperator,
        0.20*(f.tarifjaspel)*count(a.idxdaftar) as jsdranastesi,
        0*(f.tarifjaspel)*count(a.idxdaftar) as jsdranak,
        0.15*(f.tarifjaspel)*count(a.idxdaftar) as asisten,
        0.045*(f.tarifjaspel)*count(a.idxdaftar)  as manajemen, 
        0.105*(f.tarifjaspel)*count(a.idxdaftar)  as pendukung, 
        op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa 
from t_tindakan_medis a
inner join t_operasi op on a.idxdaftar=op.idxdaftar
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=3 
inner join m_pasien m on b.nomr=m.nomr
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif in ('01080301','01080302','01080303') and a.rajal=1  and
a.nip in(select nip from m_login where kdunit=15) ".$search." group by op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa,a.idxdaftar,f.tarif
";
$qry = mysql_query($sql) or die (mysql_error());
?>    
<table width="1184" border="0" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <th colspan="12">Tindakan Operatif kecil, Sedang, Besar, Kuretase, dan Tubektomi</th>
  </tr>
  <tr>
    <th  align="center" width="140">Tindakan</th>
    <th  align="center" width="75">Pasien</th>
    <th  align="center" width="75">Jml Tindakan</th>

    <th  align="center" width="111">Dokter  operator</th>
    <th  align="center" width="116">Jasa dr Operator</th>
    <th  align="center" width="116">Dokter  anaestesi</th>
    <th  align="center" width="94">Jasa dr Anastesi</th>
    <th  align="center" width="94">Dokter  anak</th>
    <th  align="center" width="69">Jasa dr Anak</th>
    <th  align="center" width="69">Asisten</th>    
    <th  align="center" width="71">Manajemen</th>    
    <th  align="center" width="78">Pendukung</th>
  </tr>
  <? while ($list = mysql_fetch_array($qry)){  ?>  
  <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= $list['pasien'];?></td>
    <td><?= number_format($list['qty'],0);?></td>
    <td><?= $list['dokteroperator'];?> </td>
    <td><?= number_format($list['jsdrOperator'],0);?></td>
    <td><?= $list['dokteranastesi'];?> </td>
    <td><?= number_format($list['jsdranastesi'],0);?></td>
    <td><?= $list['dokteranak'];?></td>
    <td><?= number_format($list['jsdranak'],0);?></td>
    <td><?= number_format($list['asisten'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>    
  </tr>
 <?php } ?>
</table>
<br />
<?php
$sql="select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        case kdprofesi when 1 then 0.7*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.4*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.35*(f.tarifjaspel)*count(a.idxdaftar) end as jsdr,
       case kdprofesi when 1 then 0.075*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.2*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0*(f.tarifjaspel)*count(a.idxdaftar) end as asisten,
       case kdprofesi when 1 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.15*(f.tarifjaspel)*count(a.idxdaftar) end as manajemen, 
       case kdprofesi when 1 then 0.125*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.3*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.5*(f.tarifjaspel)*count(a.idxdaftar) end as pendukung, 
      d.namadokter, c.nama as poly, f.nama_jasa 
from t_tindakan_medis a
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=3 
inner join m_pasien m on b.nomr=m.nomr
inner join m_poly c on b.kdpoly=c.kode 
inner join m_dokter d on a.kddokter=d.kddokter
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif like '010801%' and a.rajal=1 and a.nip in(select nip from m_login where kdunit=15) 
 ".$search." group by d.namadokter, c.nama,f.nama_jasa,a.idxdaftar,f.tarif";
$qry = mysql_query($sql) or die (mysql_error());
?>                    
<table width="1072" border="0" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <th colspan="12">Tindakan Paket Medis IIIA/ IIIB/ IIIC</th>
  </tr>
  <tr>
    <th  align="center" width="103">Poly</th>
    <th  align="center" width="105">Nama Dokter</th>
    <th  align="center" width="82">Paket</th>
    <th  align="center" width="80">Tarif</th>
    <th  align="center" width="80">Tarif Jaspel</th>
    <th  align="center" width="80">Pasien</th>
    <th  align="center" width="80">Jml Tindakan</th>

    <th  align="center" width="80">Total</th>
    <th  align="center" width="71">Jasa Dr.</th>
    <th  align="center" width="71">Manajemen</th>
    <th  align="center" width="82">Pendukung</th>
    <th  align="center" width="82">Asisten</th>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
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
</fieldset>
<br />
<fieldset>
<legend>D. Pasien SKTM</legend>
<?php $sql=
"select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        0.40*(f.tarifjaspel)*count(a.idxdaftar) as jsdrOperator,
        0.20*(f.tarifjaspel)*count(a.idxdaftar) as jsdranastesi,
        0.10*(f.tarifjaspel)*count(a.idxdaftar) as jsdranak,
        0.105*(f.tarifjaspel)*count(a.idxdaftar) as asisten,
        0.045*(f.tarifjaspel)*count(a.idxdaftar)  as manajemen, 
        0.15*(f.tarifjaspel)*count(a.idxdaftar)  as pendukung, 
        op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa 
from t_tindakan_medis a
inner join t_operasi op on a.idxdaftar=op.idxdaftar
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=4 
inner join m_pasien m on b.nomr=m.nomr
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif in ('01080304','01080305','01080306') and a.rajal=1  and
a.nip in(select nip from m_login where kdunit=15) ".$search." group by op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa,a.idxdaftar,f.tarif
union
select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        0.50*(f.tarifjaspel)*count(a.idxdaftar) as jsdrOperator,
        0.20*(f.tarifjaspel)*count(a.idxdaftar) as jsdranastesi,
        0*(f.tarifjaspel)*count(a.idxdaftar) as jsdranak,
        0.15*(f.tarifjaspel)*count(a.idxdaftar) as asisten,
        0.045*(f.tarifjaspel)*count(a.idxdaftar)  as manajemen, 
        0.105*(f.tarifjaspel)*count(a.idxdaftar)  as pendukung, 
        op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa 
from t_tindakan_medis a
inner join t_operasi op on a.idxdaftar=op.idxdaftar
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=4 
inner join m_pasien m on b.nomr=m.nomr
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif in ('01080301','01080302','01080303') and a.rajal=1  and
a.nip in(select nip from m_login where kdunit=15) ".$search." group by op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa,a.idxdaftar,f.tarif
";
$qry = mysql_query($sql) or die (mysql_error());
?>    
<table width="1184" border="0" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <th colspan="12">Tindakan Operatif Kecil, Sedang, Besar, Kuretase, dan Tubektomi</th>
  </tr>
  <tr>
    <th  align="center" width="140">Tindakan</th>
    <th  align="center" width="75">Pasien</th>
    <th  align="center" width="75">Jml Tindakan</th>

    <th  align="center" width="111">Dokter  operator</th>
    <th  align="center" width="116">Jasa dr Operator</th>
    <th  align="center" width="116">Dokter  anaestesi</th>
    <th  align="center" width="94">Jasa dr Anastesi</th>
    <th  align="center" width="94">Dokter  anak</th>
    <th  align="center" width="69">Jasa dr Anak</th>
    <th  align="center" width="69">Asisten</th>    
    <th  align="center" width="71">Manajemen</th>    
    <th  align="center" width="78">Pendukung</th>
  </tr>
  <? while ($list = mysql_fetch_array($qry)){  ?>  
  <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= $list['pasien'];?></td>
    <td><?= number_format($list['qty'],0);?></td>
    <td><?= $list['dokteroperator'];?> </td>
    <td><?= number_format($list['jsdrOperator'],0);?></td>
    <td><?= $list['dokteranastesi'];?> </td>
    <td><?= number_format($list['jsdranastesi'],0);?></td>
    <td><?= $list['dokteranak'];?></td>
    <td><?= number_format($list['jsdranak'],0);?></td>
    <td><?= number_format($list['asisten'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>    
  </tr>
 <?php } ?>
</table>
<br />
<?php
$sql="select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        case kdprofesi when 1 then 0.7*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.4*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.35*(f.tarifjaspel)*count(a.idxdaftar) end as jsdr,
       case kdprofesi when 1 then 0.075*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.2*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0*(f.tarifjaspel)*count(a.idxdaftar) end as asisten,
       case kdprofesi when 1 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.15*(f.tarifjaspel)*count(a.idxdaftar) end as manajemen, 
       case kdprofesi when 1 then 0.125*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.3*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.5*(f.tarifjaspel)*count(a.idxdaftar) end as pendukung, 
      d.namadokter, c.nama as poly, f.nama_jasa 
from t_tindakan_medis a
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=4 
inner join m_pasien m on b.nomr=m.nomr
inner join m_poly c on b.kdpoly=c.kode 
inner join m_dokter d on a.kddokter=d.kddokter
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif like '010801%' and a.rajal=1 and a.nip in(select nip from m_login where kdunit=15) 
 ".$search." group by d.namadokter, c.nama,f.nama_jasa,a.idxdaftar,f.tarif";
$qry = mysql_query($sql) or die (mysql_error());
?>                    
<table width="1072" border="0" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <th colspan="12">Tindakan Paket Medis IIIA/ IIIB/ IIIC</th>
  </tr>
  <tr>
    <th  align="center" width="103">Poly</th>
    <th  align="center" width="105">Nama Dokter</th>
    <th  align="center" width="82">Paket</th>
    <th  align="center" width="80">Tarif</th>
    <th  align="center" width="80">Tarif Jaspel</th>
    <th  align="center" width="80">Pasien</th>
    <th  align="center" width="80">Jml Tindakan</th>

    <th  align="center" width="80">Total</th>
    <th  align="center" width="71">Jasa Dr.</th>
    <th  align="center" width="71">Manajemen</th>
    <th  align="center" width="82">Pendukung</th>
    <th  align="center" width="82">Asisten</th>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
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
</fieldset>
<br />
<fieldset>
<legend>E. Pasien Lain-Lain</legend>
<?php $sql=
"select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        0.40*(f.tarifjaspel)*count(a.idxdaftar) as jsdrOperator,
        0.20*(f.tarifjaspel)*count(a.idxdaftar) as jsdranastesi,
        0.10*(f.tarifjaspel)*count(a.idxdaftar) as jsdranak,
        0.105*(f.tarifjaspel)*count(a.idxdaftar) as asisten,
        0.045*(f.tarifjaspel)*count(a.idxdaftar)  as manajemen, 
        0.15*(f.tarifjaspel)*count(a.idxdaftar)  as pendukung, 
        op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa 
from t_tindakan_medis a
inner join t_operasi op on a.idxdaftar=op.idxdaftar
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=5
inner join m_pasien m on b.nomr=m.nomr
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif in('01080304','01080305','01080306') and a.rajal=1  and
a.nip in(select nip from m_login where kdunit=15) ".$search." group by op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa,a.idxdaftar,f.tarif
union
select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        0.50*(f.tarifjaspel)*count(a.idxdaftar) as jsdrOperator,
        0.20*(f.tarifjaspel)*count(a.idxdaftar) as jsdranastesi,
        0*(f.tarifjaspel)*count(a.idxdaftar) as jsdranak,
        0.15*(f.tarifjaspel)*count(a.idxdaftar) as asisten,
        0.045*(f.tarifjaspel)*count(a.idxdaftar)  as manajemen, 
        0.105*(f.tarifjaspel)*count(a.idxdaftar)  as pendukung, 
        op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa 
from t_tindakan_medis a
inner join t_operasi op on a.idxdaftar=op.idxdaftar
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=5
inner join m_pasien m on b.nomr=m.nomr
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif in('01080301','01080302','01080303') and a.rajal=1  and
a.nip in(select nip from m_login where kdunit=15) ".$search." group by op.dokteroperator, op.dokteranastesi,op.dokteranak, f.nama_jasa,a.idxdaftar,f.tarif
";
$qry = mysql_query($sql) or die (mysql_error());
?>    
<table width="1184" border="0" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <th colspan="12">Tindakan Operatif Kecil, Sedang, Besar, Kuretase, dan Tubektomi</th>
  </tr>
  <tr>
    <th  align="center" width="140">Tindakan</th>
    <th  align="center" width="75">Pasien</th>
    <th  align="center" width="75">Jml Tindakan</th>

    <th  align="center" width="111">Dokter  operator</th>
    <th  align="center" width="116">Jasa dr Operator</th>
    <th  align="center" width="116">Dokter  anaestesi</th>
    <th  align="center" width="94">Jasa dr Anastesi</th>
    <th  align="center" width="94">Dokter  anak</th>
    <th  align="center" width="69">Jasa dr Anak</th>
    <th  align="center" width="69">Asisten</th>    
    <th  align="center" width="71">Manajemen</th>    
    <th  align="center" width="78">Pendukung</th>
  </tr>
  <? while ($list = mysql_fetch_array($qry)){  ?>  
  <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= $list['pasien'];?></td>
    <td><?= number_format($list['qty'],0);?></td>
    <td><?= $list['dokteroperator'];?> </td>
    <td><?= number_format($list['jsdrOperator'],0);?></td>
    <td><?= $list['dokteranastesi'];?> </td>
    <td><?= number_format($list['jsdranastesi'],0);?></td>
    <td><?= $list['dokteranak'];?></td>
    <td><?= number_format($list['jsdranak'],0);?></td>
    <td><?= number_format($list['asisten'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>    
  </tr>
 <?php } ?>
</table>
<br />
<?php
$sql="select f.tarif as tarifrs,count(a.idxdaftar) as qty,f.tarifjaspel,(f.tarifjaspel)*count(a.idxdaftar) as tarif, m.nama as pasien,
        case kdprofesi when 1 then 0.7*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.4*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.35*(f.tarifjaspel)*count(a.idxdaftar) end as jsdr,
       case kdprofesi when 1 then 0.075*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.2*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0*(f.tarifjaspel)*count(a.idxdaftar) end as asisten,
       case kdprofesi when 1 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.1*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.15*(f.tarifjaspel)*count(a.idxdaftar) end as manajemen, 
       case kdprofesi when 1 then 0.125*(f.tarifjaspel)*count(a.idxdaftar) when 0 then 0.3*(f.tarifjaspel)*count(a.idxdaftar) when 2 then 0.5*(f.tarifjaspel)*count(a.idxdaftar) end as pendukung, 
      d.namadokter, c.nama as poly, f.nama_jasa 
from t_tindakan_medis a
inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar and b.kdcarabayar=5 
inner join m_pasien m on b.nomr=m.nomr
inner join m_poly c on b.kdpoly=c.kode 
inner join m_dokter d on a.kddokter=d.kddokter
inner join m_tarif f on a.kodetarif=f.kode
where a.kodetarif like '010801%' and a.rajal=1 and a.nip in(select nip from m_login where kdunit=15) 
 ".$search." group by d.namadokter, c.nama,f.nama_jasa,a.idxdaftar,f.tarif";
$qry = mysql_query($sql) or die (mysql_error());
?>                    
<table width="1072" border="0" cellspacing="1" cellpadding="1" class="tb">
  <tr>
    <th colspan="12">Tindakan Paket Medis IIIA/ IIIB/ IIIC</th>
  </tr>
  <tr>
    <th  align="center" width="103">Poly</th>
    <th  align="center" width="105">Nama Dokter</th>
    <th  align="center" width="82">Paket</th>
    <th  align="center" width="80">Tarif</th>
    <th  align="center" width="80">Tarif Jaspel</th>
    <th  align="center" width="80">Pasien</th>
    <th  align="center" width="80">Jml Tindakan</th>

    <th  align="center" width="80">Total</th>
    <th  align="center" width="71">Jasa Dr.</th>
    <th  align="center" width="71">Manajemen</th>
    <th  align="center" width="82">Pendukung</th>
    <th  align="center" width="82">Asisten</th>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
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
</fieldset>
</div>
</div>
