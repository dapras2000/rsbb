<?php

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

$bayar=1;
if(!empty($_GET['carabayar'])) {
    $bayar =$_GET['carabayar'];
}

?>

	<div id="frame_title">
	  <h3>JASPEL RAWAT INAP</h3></div>
     
 
    <table width="488" border="1" class="tb">
  <tr>
    <th colspan="6">Visit Dokter</th>
  </tr>
  <tr>
    <td width="68">Ruangan</td>
    <td width="68">Dokter</td>
    <td width="82">Jml Visit</td>

    <td width="82">Jasa Dokter</td>
    <td width="71">Manajemen</td>
    <td width="83">Pendukung</td>
  </tr>
 <?php		
 $mysqli = new mysqli($hostname,$username,$password,$database);
 $sql="CALL pr_jaspel_visit_ranap('".$tgl_kunjungan."','".$tgl_kunjungan2."',".$bayar.")";
//$qry = mysqli_query($sql) or die (mysql_error());
$qry = $mysqli->query($sql);
while ($list = mysqli_fetch_array($qry)){  
?> 
  <tr>
    <td><?=$list['namaruang'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?=$list['jmlvisit'];?></td>
    <td><?=$list['jsdr'];?></td>
    <td><?=$list['manajemen'];?></td>
    <td><?=$list['pendukung'];?></td>
  </tr>
 <? } ?>  
</table>

<?php
mysqli_free_result($qry);
mysqli_close($mysqli);
//$mysqli = new mysqli($hostname,$username,$password,$database);
$sql="CALL pr_jaspel_tindakanmedis_ranap('".$tgl_kunjungan."','".$tgl_kunjungan2."',".$bayar.")";
$qry = mysql_query($sql) or die (mysql_error());
//$qry = $mysqli->query($sql) ;

?>   
<table width="728" border="1" class="tb">
  <tr>
    <th colspan="7">Tindakan  Medis</th>
  </tr>
  <tr>
    <td width="103">Ruangan</td>
    <td width="105">Nama Dokter</td>
    <td width="82">Tindakan</td>
    <td width="82">Jml Tindakan</td>

    <td width="71">Jasa Dr.</td>
    <td width="71">Manajemen</td>
    <td width="82">Pendukung</td>
  </tr>
<? while ($list = mysql_fetch_array($qry)){  ?>  
  <tr>
    <td><?= $list['namaruang'];?></td>
    <td><?= $list['namadokter'];?></td>
    <td><?= $list['nama_tindakan'];?></td>
    <td><?= $list['jmltindakan'];?></td>
    <td><?= $list['jsdr'],0);?></td>
    <td><?= $list['manajemen'],0);?></td>
    <td><?= $list['pendukung'],0);?></td>
  </tr>
 <? } ?>  
</table>
