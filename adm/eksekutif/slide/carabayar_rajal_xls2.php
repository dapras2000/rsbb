<div id="frame_title"><h3>Rekap Kunjungan Per Carabayar</h3></div>
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

<table  style="font-size:11px;" border="1" align="center"  cellpadding="1" cellspacing="1">
  <tr>
    <th width="26" rowspan="3">Tanggal</th>
    <th colspan="6">Kunjungan Rawat Jalan</th>
    <th width="25" rowspan="3">Total</th>
  </tr>
  <tr>
    <th colspan="6">Cara Bayar</th>
    </tr>
<tr>
<!-- menampilkan data di tabel carabayar--> 
<? $sql=mysql_query("select NAMA from m_carabayar");
while($r=mysql_fetch_array($sql)){
extract($r);
echo"    <th>$NAMA</th>";

}
?>
    
  </tr>
  <?php  $tot_jkl=0;$tot_jkp=0;
        $tot_poli1_rj1=0; 
		$tot_poli2_rj1=0; 
		$tot_poli3_rj1=0; 
		$tot_poli4_rj1=0; 
		$tot_poli5_rj1=0; 
		$tot_poli6_rj1=0; 
		
       $sql="CALL pr_eksekutif_carabayar_rajal('".$tgl_kunjungan."','".$tgl_kunjungan2."',".$poly.")";
       $rs=mysql_query($sql);
	  if(!$rs) die(mysql_error());
       while ($data = mysql_fetch_array($rs)) {
		   $tot_poli1_rj1=$tot_poli1_rj1+$data['poli1_rj1'];
		   
		   $tot_poli2_rj1=$tot_poli2_rj1+$data['poli2_rj1'];

		   $tot_poli3_rj1=$tot_poli3_rj1+$data['poli3_rj1'];
		   
		   $tot_poli4_rj1=$tot_poli4_rj1+$data['poli4_rj1'];
		   $tot_poli5_rj1=$tot_poli5_rj1+$data['poli5_rj1'];
	       $tot_poli6_rj1=$tot_poli6_rj1+$data['poli6_rj1'];
		 
		   ?>
<tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>    
    <td width="70"><?=$data['tglbayar'];?></td>
    <td width="33" align="right"><?=number_format($data['poli1_rj1'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli2_rj1'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli3_rj1'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli4_rj1'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli5_rj1'],0);?></td>
    <td align="right"><?=number_format($data['poli1_rj1']+$data['poli2_rj1']+$data['poli3_rj1']+$data['poli4_rj1']+$data['poli5_rj1']+$data['poli6_rj1'],0);?></td>
  </tr>
  <?php } ?>
  <tr>
    <td align="center">TOTAL</td>
    <td align="right"><?=number_format($tot_poli1_rj1,0); ?></td>
    <td align="right"><?=number_format($tot_poli2_rj1,0); ?></td>
    <td align="right"><?=number_format($tot_poli3_rj1,0); ?></td>
    <td align="right"><?=number_format($tot_poli4_rj1,0); ?></td>    
    
    <td align="right"><?=number_format($tot_poli1_rj1+$tot_poli2_rj1+$tot_poli3_rj1+$tot_poli4_rj1+$tot_poli5_rj1+$tot_poli6_rj1,0); ?></td>
  </tr>
</table>
