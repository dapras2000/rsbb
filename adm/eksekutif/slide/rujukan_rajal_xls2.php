<div id="frame_title"><h3>Rekap Kunjungan Per Rujukan</h3></div>
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

?>

<!--<div style="overflow:scroll;width:98%;height:auto;">-->
<!--<table width="148%" style="font-size:9px;" border="0" align="center" class="tb" cellpadding="1" cellspacing="1">-->
<table  style="font-size:11px;" border="1" align="center"   cellpadding="1" cellspacing="1">
  <tr>
    <th width="26" rowspan="3">Tanggal</th>
    <th colspan="4">Kunjungan Rawat Jalan</th>
    <th width="25" rowspan="3">Total</th>
  </tr>
  <tr>
    <th colspan="4">Rujukan</th>
    </tr>
  <tr>
    <th>Datang Sendiri</th>
    <th>Puskesmas</th>
    <th>Rumah Sakit</th>
    <th>Lain2</th>
    </tr>
  <?php  $tot_jkl=0;$tot_jkp=0;
        $tot_poli1_rj1=0; 
		$tot_poli2_rj1=0; 
		$tot_poli3_rj1=0; 
		$tot_poli4_rj1=0; 
		
       $sql="CALL pr_eksekutif_rujukan_rajal('".$tgl_kunjungan."','".$tgl_kunjungan2."',".$poly.")";
       $rs=mysql_query($sql);
	  if(!$rs) die(mysql_error());
       while ($data = mysql_fetch_array($rs)) {
		   $tot_poli1_rj1=$tot_poli1_rj1+$data['poli1_rj1'];
		   
		   $tot_poli2_rj1=$tot_poli2_rj1+$data['poli2_rj1'];

		   $tot_poli3_rj1=$tot_poli3_rj1+$data['poli3_rj1'];
		   
		   $tot_poli4_rj1=$tot_poli4_rj1+$data['poli4_rj1'];
		   
		
		   ?>
<tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>    
    <td width="33"><?=$data['tglreg'];?></td>
    <td width="33"><?=$data['poli1_rj1'];?></td>
    <td width="33"><?=$data['poli2_rj1'];?></td>
    <td width="33"><?=$data['poli3_rj1'];?></td>
    <td width="33"><?=$data['poli4_rj1'];?></td>
    <td><?=$data['poli1_rj1']+$data['poli2_rj1']+$data['poli3_rj1']+$data['poli4_rj1'];?></td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo $tot_poli1_rj1; ?></td>
    <td><?php echo $tot_poli2_rj1; ?></td>
    <td><?php echo $tot_poli3_rj1; ?></td>
    <td><?php echo $tot_poli4_rj1; ?></td>    
    <td><?php echo  $tot_poli1_rj1+$tot_poli2_rj1+$tot_poli3_rj1+$tot_poli4_rj1; ?></td>
  </tr>
</table>

