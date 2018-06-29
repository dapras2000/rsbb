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

$bayar=1;
if(!empty($_GET['carabayar'])) {
    $bayar =$_GET['carabayar'];
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
<td>Cara Bayar</td>
<td><select name="carabayar" id="carabayar" class="text" >
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
    <input type="hidden" name="link" value="jas4" /></td>
  </tr>
</table>

    </form> 
  </div> 
     
   
    <table width="488" border="1" class="tb">
  <tr>
    <th colspan="7">Visit Dokter</th>
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
    <td><?= number_format($list['jsdr'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>
  </tr>
 <? } ?>  
</table>
<p><form action="jaspel/jaspel_ranap_xls.php" method="get">
				 <input type="hidden" name="tgl_kunjungan" id="tgl_kunjungan" value=<?=$tgl_kunjungan?> />
                <input type="hidden" name="tgl_kunjungan2" id="tgl_kunjungan2" value=<?=$tgl_kunjungan2?> />                
                <input type="hidden" name="poly" id="poly" value=<?=$poly?> />    
                <input type="hidden" name="carabayar" id="carabayar" value=<?=$carabayar?> />                                
                   <input type="submit" value="export xls"  />
                </form></p>

