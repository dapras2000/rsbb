<?php 

$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
}else{
    $tgl_kunjungan =date('Y/m/d'); 
}

$tgl_kunjungan2 = "";
if(!empty($_GET['tgl_kunjungan2'])){
	$tgl_kunjungan2 =$_GET['tgl_kunjungan2']; 
}else{
    $tgl_kunjungan2 =date('Y/m/d'); 
}

$poly = "";
if(!empty($_GET['poly'])) {
    $poly =$_GET['poly'];
}
else $poly=0;
$bayar=1;
if(!empty($_GET['carabayar'])) {
    $bayar =$_GET['carabayar'];
} 				
?>

<div align="center">
<div id="frame">
	<div id="frame_title">
	  <h3>JASPEL LABORATORIUM</h3></div>
<table width="910" border="1" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <th colspan="8">Laboratorium</th>
  </tr>
  <tr>
    <td width="116">Nama Jasa</td>
    <td width="116">Jumlah</td>
    <td width="118">Petugas Lab</td>
    <td width="118">Dokter  perujuk</td>
    <td width="112">Jasa dr Perujuk</td>
  
    <td width="112">Jasa Petugas  lab.</td>
    <td width="87">Manajemen</td>
    <td width="88">Pendukung</td>
  </tr>
    <? $sql="CALL pr_jaspel_lab('".$tgl_kunjungan."','".$tgl_kunjungan2."',".$bayar.")";
$qry = mysql_query($sql) or die (mysql_error());

	while ($list = mysql_fetch_array($qry)){  ?>  
  <tr>
    <td><?=$list['nama_tindakan'];?></td>
    <td><?=$list['jml'];?></td>
    <td><?=$list['pemeriksa'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?=$list['drPerujuk_lab'];?></td>
    <td><?=$list['petugas_lab'];?></td>
    <td><?=$list['manajemen'];?></td>
    <td><?=$list['pendukung'];?></td>
  </tr>
 <? } ?>   
</table>
