<?php 
include 'include/connect.php';
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
       <input type="hidden" name="link" value="jas6" /></td>
   </tr>
</table>

    </form> 
  </div>   

<div align="center">
<div id="frame">
	<div id="frame_title">
	  <h3>A. Pasien Umum dan Lain Lain</h3></div>
<p><form action="jaspel/jaspel_rad_xls.php" method="get">
				 <input type="hidden" name="tgl_kunjungan" id="tgl_kunjungan" value="<?=$tgl_kunjungan?>" />
                <input type="hidden" name="tgl_kunjungan2" id="tgl_kunjungan2" value="<?=$tgl_kunjungan2?>" />                
                <input type="hidden" name="poly" id="poly" value="<?=$poly?>" />    
                <input type="hidden" name="carabayar" id="carabayar" value="<?=$carabayar?>" />                                
                   <input type="submit" value="export xls"  />
                </form></p>      
      
<table width="1002" border="1" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <th colspan="9">Radiologi</th>
  </tr>
  <tr>
    <td width="116">Nama Jasa</td>
    <td width="116">Jumlah</td>
    <td width="118">dr Radiologi</td>
    <td width="118">Dokter  perujuk</td>
    <td width="112">Jasa dr Perujuk</td>
  
    <td width="112">Jasa dr Radiologi</td>
    <td width="87">Perawat Unit</td>
    <td width="87">Manajemen</td>
    <td width="88">Pendukung</td>
  </tr>
    <?
	$sql="CALL pr_jaspel_rad('".$tgl_kunjungan."','".$tgl_kunjungan2."',".$bayar.")";
$qry = mysql_query($sql) or die (mysql_error());

while ($list = mysql_fetch_array($qry)){  ?>  
  <tr>
    <td><?=$list['nama_tindakan'];?></td>
    <td><?=$list['jml'];?></td>
    <td><?=$list['pemeriksa'];?></td>
    <td><?=$list['namadokter'];?></td>
    <td><?=$list['drPerujuk_rad'];?></td>
    <td><?=$list['petugas_rad'];?></td>
    <td><?=$list['perawat_rad'];?></td>
    <td><?=$list['manajemen'];?></td>
    <td><?=$list['pendukung'];?></td>
  </tr>
 <? } ?>   
</table>
</div>
</div><br />
