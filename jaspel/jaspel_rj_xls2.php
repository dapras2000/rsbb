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


        <div id="frame_title"><h3>JASPEL RAWAT JALAN </h3></div>



<fieldset>
<legend >Pasien Umum dan Lain Lain</legend>
<?php				
$mysqli = new mysqli($hostname,$username,$password,$database);
$sql="CALL pr_jaspel_pemeriksaan_rajal('".$tgl_kunjungan."','".$tgl_kunjungan2."',".$poly.",".$bayar.")";
//$qry = mysql_query($sql) or die (mysql_error());
$qry = $mysqli->query($sql);

?>
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
     <?= $list['jmlpasien'];?>
   </div></td>    
    <td><div align="right">
      <?= $list['jsdr'];?>
    </div></td>
    <td><div align="right">
      <?= $list['manajemen'];?>
    </div></td>
    <td><div align="right">
      <?= $list['pendukung'];?>
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
      <?= $list['qty'];?>
    </div></td>
    <td><div align="right">
      <?= $list['jsdr'];?>
    </div></td>
    <td><div align="right">
      <?= $list['manajemen'];?>
    </div></td>
    <td><div align="right">
      <?= $list['pendukung'];?>
    </div></td>
    <td><div align="right">
      <?= $list['asisten'];?>
    </div></td>
  </tr>
 <? } ?>  
</table>

</fieldset>