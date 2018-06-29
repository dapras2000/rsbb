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
        <div id="frame_title"><h3>JASPEL KAMAR OPERASI</h3></div>
<fieldset>
<legend >
<?php				
$sql="CALL pr_jaspel_ok('".$tgl_kunjungan."','".$tgl_kunjungan2."',".$bayar.")";
$qry = mysql_query($sql) or die (mysql_error());
?>
</legend>
<table width="1184" border="0" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <th colspan="12">Tindakan Kamar Operasi</th>
  </tr>
  <tr>
    <th  align="center" width="140">Tindakan</th>
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
    <td><?= $list['qty'],0);?></td>
    <td><?= $list['dokteroperator'];?> </td>
    <td><?= $list['jsdrOperator'],0);?></td>
    <td><?= $list['dokteranastesi'];?> </td>
    <td><?= $list['jsdranastesi'],0);?></td>
    <td><?= $list['dokteranak'];?></td>
    <td><?= $list['jsdranak'],0);?></td>
    <td><?= $list['asisten'],0);?></td>
    <td><?= $list['manajemen'],0);?></td>
    <td><?= $list['pendukung'],0);?></td>    
  </tr>
 <?php } ?>
</table>

</fieldset>