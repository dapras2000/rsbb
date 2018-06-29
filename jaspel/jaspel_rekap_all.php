<?php
include 'include/connect.php';

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
<div align="center">
<div id="frame">
	<div id="frame_title">
	  <h3>A. Pasien Umum dan Lain Lain</h3></div>
<div>
    	<form name="formsearch" method="get" >
     <table width="288" border="0" cellspacing="0" class="tb">
 

  <tr>
    <td width="101">Tanggal</td>
    <td width="183"><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? if($_REQUEST['tgl_kunjungan'] !=""): echo $_REQUEST['tgl_kunjungan']; else: echo date('Y/m/d'); endif;
?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
   <tr>
    <td>Sd</td>
    <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" 
              value="<? if($_REQUEST['tgl_kunjungan2'] !=""): echo $_REQUEST['tgl_kunjungan2']; else: echo date('Y/m/d'); endif;
?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
<tr>
<td>Dokter</td>
<td><select name="dokter" id="dokter" class="text" >
<option value="-1">All Dokter</option>
       <?
                                $qrydokter = mysql_query("SELECT DISTINCT NAMADOKTER, KDDOKTER FROM m_dokter GROUP BY NAMADOKTER ORDER BY NAMADOKTER ASC")or die (mysql_error());								
                                while ($listdokter = mysql_fetch_array($qrydokter)) {
                                    ?>
       <option value="<? echo $listdokter['KDDOKTER'];?>" <? if($listdokter['KDDOKTER']==$dr) echo "selected=selected"; ?>><? echo $listdokter['NAMADOKTER'];?></option>
       <? } ?>
     </select></td>
      </tr>     
  <tr>
    <td>Cara Bayar</td>
    <td><select name="carabayar" id="carabayar" class="text" >
    		<option value="0"> Semua Carabayar </option>
       <?
                                $qrybayar = mysql_query("SELECT kode,nama FROM m_carabayar ORDER BY kode ASC")or die (mysql_error());
                                while ($listbayar = mysql_fetch_array($qrybayar)) {
                                    ?>
       <option value="<? echo $listbayar['kode'];?>" <? if($listbayar['kode']==$bayar) echo "selected=selected"; ?>><? echo $listbayar['nama'];?></option>
       <? } ?>
     </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cari" class="text"/>
    <input type="hidden" name="link" value="jas10" /></td>
  </tr>
</table>

    </form> 
  </div> 
     
   
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

<p><form action="jaspel/jaspel_rekap_all_xls.php" method="get">
				 <input type="hidden" name="tgl_kunjungan" id="tgl_kunjungan" value=<?=$tgl_kunjungan?> />
                <input type="hidden" name="tgl_kunjungan2" id="tgl_kunjungan2" value=<?=$tgl_kunjungan2?> />                
                <input type="hidden" name="poly" id="poly" value=<?=$dr?> />    
                <input type="hidden" name="carabayar" id="carabayar" value=<?=$bayar?> />                                
                   <input type="submit" value="export xls"  />
                </form></p>

