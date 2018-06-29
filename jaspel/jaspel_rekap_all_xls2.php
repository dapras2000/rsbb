<?php
include '../include/connect.php';
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

$bayar=0;
if(!empty($_GET['carabayar'])) {
    $bayar =$_GET['carabayar'];
}

$dr=0;
if(!empty($_GET['dokter'])) {
    $dr =$_GET['dokter'];
}

?>

   <div id="frame_title">
	  <h3>JASPEL REKAP ALL</h3></div>
    <table width="737" border="1" class="tb">
  <tr>
    <th colspan="11">Jaspel All</th>
  </tr>
  <tr>
    <td width="69">Ruang/Poly</td>
    <td width="67">Nama Jaspel</td>
    <td width="82">Tindakan</td>
    <td width="94">Dokter</td>
    <td width="24">Jml </td>

    <td width="80">Jasa Dokter</td>
    <td width="71">Manajemen</td>
    <td width="67">Pendukung</td>
    <td width="44">Asisten</td>
    <td width="75">Perawat Rad</td>
    <td width="75">Carabayar</td>
  </tr>
 <?php		
 $mysqli = new mysqli($hostname,$username,$password,$database);
 $sql="CALL pr_jaspel_all('".$tgl_kunjungan."','".$tgl_kunjungan2."',".$bayar.",".$dr.")";
//$qry = mysqli_query($sql) or die (mysql_error());
$qry = $mysqli->query($sql);
while ($list = mysqli_fetch_array($qry)){  
?> 
  <tr>
    <td><?=$list['ruang'];?></td>
    <td><?=$list['nama_jaspel'];?></td>
    <td><?=$list['tindakan'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?=$list['jml'];?></td>
    <td><?=$list['js_dr'];?></td>
    <td><?=$list['js_manajemen'];?></td>
    <td><?=$list['js_pendukung'];?></td>
    <td><?=$list['js_asisten'];?></td>
    <td><?=$list['js_perawat_rad'];?></td>
    <td><?=$list['carabayar'];?></td>
  </tr>
 <? } ?>  
</table>