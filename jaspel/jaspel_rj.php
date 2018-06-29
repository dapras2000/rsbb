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


/*

$qry_poly = "SELECT  m_poly.nama
			FROM m_poly
			WHERE m_poly.kode = ".$_SESSION['KDUNIT'];
$get_poly = mysql_query($qry_poly);
$dat_poly = mysql_fetch_assoc($get_poly);*/
?>

<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>JASPEL </h3></div>
	<div align="left">
    	<form name="formsearch" method="get" >
     <table width="296" border="0" cellspacing="0" class="tb">
 

  <tr>
    <td width="100">Tanggal</td>
    <td colspan="2"><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan!=""){
			  echo $tgl_kunjungan;}?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
   <tr>
    <td>Sd</td>
    <td colspan="2"><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan2!=""){
			  echo $tgl_kunjungan2;}?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
              
  </tr>
   <tr>
     <td>Cara Bayar</td>
     <td colspan="2"><select name="carabayar" id="carabayar" class="text" >
       <?
                                $qrybayar = mysql_query("SELECT kode,nama FROM m_carabayar ORDER BY kode ASC")or die (mysql_error());
                                while ($listbayar = mysql_fetch_array($qrybayar)) {
                                    ?>
       <option value="<? echo $listbayar['kode'];?>" <? if($listbayar['kode']==$bayar) echo "selected=selected"; ?>><? echo $listbayar['nama'];?></option>
       <? } ?>
     </select></td>
   </tr>
   <tr>
<td>Poly</td>
    <td colspan="2"><select name="poly" id="poly" class="text" >
                                <?
                                $qrypoly = mysql_query("SELECT * FROM m_poly ORDER BY kode ASC")or die (mysql_error());
                                while ($listpoly = mysql_fetch_array($qrypoly)) {
                                    ?>
                                <option value="<? echo $listpoly['kode'];?>" <? if($listpoly['kode']==$poly) echo "selected=selected"; ?>><? echo $listpoly['nama'];?></option>
                                    <? } ?>
                            </select></td>  
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="95"><input type="submit" value="C a r i" class="text"/>
    <input type="hidden" name="link" value="jas1" /></td>
    
  </tr>
</table>

    </form> 
  </div>   

<fieldset>
<legend >Pasien Umum dan Lain Lain</legend>
<?php				
$mysqli = new mysqli($hostname,$username,$password,$database);
$sql="CALL pr_jaspel_pemeriksaan_rajal('".$tgl_kunjungan."','".$tgl_kunjungan2."',".$poly.",".$bayar.")";
//$qry = mysql_query($sql) or die (mysql_error());
$qry = $mysqli->query($sql);

?>
<p><form action="jaspel/jaspel_rj_xls.php" method="get">
				 <input type="hidden" name="tgl_kunjungan" id="tgl_kunjungan" value="<?=$tgl_kunjungan?>" />
                <input type="hidden" name="tgl_kunjungan2" id="tgl_kunjungan2" value="<?=$tgl_kunjungan2?>" />                
                <input type="hidden" name="poly" id="poly" value="<?=$poly?>" />    
                <input type="hidden" name="carabayar" id="carabayar" value="<?=$carabayar?>" />                                
                   <input type="submit" value="export xls"  />
                </form></p>
 <table width="766" border="0" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <th colspan="6">Pemeriksaan Dokter Spesialis/Umum</th>
  </tr>
  <tr>
    <th width="105"><div align="center">Poly</div></th>
    <th width="147"><div align="center">Nama Dokter</div></th>
    <th width="70"><div align="center">Jml Pasien</div></th>    
    <th width="83"><div align="center">Jasa Dokter</div></th>    
    <th width="71"><div align="center">Manajemen</div></th>
    <th width="92"><div align="center">Pendukung</div></th>
  </tr>
<? $count=0; while ($list = mysqli_fetch_array($qry)){  ?>
  <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
    <td><?=$list['poly'];?></td>
   <td><?=$list['namadokter'];?></td>
   <td><div align="right">
     <?= number_format($list['jmlpasien'],0);?>
   </div></td>    
    <td><div align="right">
      <?= number_format($list['jsdr'],0);?>
    </div></td>
    <td><div align="right">
      <?= number_format($list['manajemen'],0);?>
    </div></td>
    <td><div align="right">
      <?= number_format($list['pendukung'],0);?>
    </div></td>
  </tr>
 <? } ?> 
</table>
<p><p>
<?php				
mysqli_free_result($qry);
mysqli_close($mysqli);
$sql="CALL pr_jaspel_tindakan_rajal('".$tgl_kunjungan."','".$tgl_kunjungan2."',".$poly.",".$bayar.")";
$qry = mysql_query($sql) or die (mysql_error());
?>                
<table width="900" border="0" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <th colspan="8">Tindakan Medis</th>
  </tr>
  <tr>
    <th width="103"><div align="center">Poly</div></th>
    <th width="105"><div align="center">Nama Dokter</div></th>
    <th width="82"><div align="center">Nama Tindakan</div></th>
    <th width="80"><div align="center">Jml Tindakan</div></th>

    <th width="71"><div align="center">Jasa Dr.</div></th>
    <th width="71"><div align="center">Manajemen</div></th>
    <th width="82"><div align="center">Pendukung</div></th>
    <th width="82"><div align="center">Asisten</div></th>
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
    <td><div align="right">
      <?= number_format($list['qty'],0);?>
    </div></td>
    <td><div align="right">
      <?= number_format($list['jsdr'],0);?>
    </div></td>
    <td><div align="right">
      <?= number_format($list['manajemen'],0);?>
    </div></td>
    <td><div align="right">
      <?= number_format($list['pendukung'],0);?>
    </div></td>
    <td><div align="right">
      <?= number_format($list['asisten'],0);?>
    </div></td>
  </tr>
 <? } ?>  
</table>

</fieldset>
