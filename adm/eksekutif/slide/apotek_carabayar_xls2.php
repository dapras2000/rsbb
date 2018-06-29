<div align="center">
<div id="frame" style="width:100%">
	<div id="frame_title"><h3>Rekap Apotek Per Carabayar</h3></div>
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

 

?>

<table  style="font-size:12px;" border="1" align="center" class="tb" cellpadding="1" cellspacing="1">
  <tr>
    <th width="70" rowspan="3">Tanggal</th>
    <th colspan="4">Pendapatan Apotek (Rawat Jalan)</th>
      <th width="25" rowspan="3" >Total</th>
    <th colspan="4">Pendapatan Apotek (Rawat Inap)</th>
        <th width="25" rowspan="3" >Total</th>
    <th width="25" rowspan="3">Total</th>
  </tr>
  <tr>
    <th colspan="4">Cara Bayar </th>
   
    <th colspan="4">Cara Bayar </th>

    </tr>
  <tr>
<? $sql=mysql_query("select NAMA from m_carabayar");
while($r=mysql_fetch_array($sql)){
extract($r);
echo"    <th>$NAMA</th>";

}
?>
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

        $tot_poli1_ri1=0; 
		$tot_poli2_ri1=0; 
		$tot_poli3_ri1=0; 
		$tot_poli4_ri1=0; 
		$tot_poli5_ri1=0; 
		$tot_poli6_ri1=0; 

		
       $sql="CALL pr_eksekutif_apotek_carabayar_rajal('".$tgl_kunjungan."','".$tgl_kunjungan2."')";
       $rs=mysql_query($sql);
	  if(!$rs) die(mysql_error());
       while ($data = mysql_fetch_array($rs)) {
		   $tot_poli1_rj1=$tot_poli1_rj1+$data['poli1_rj1'];		   
		   $tot_poli2_rj1=$tot_poli2_rj1+$data['poli2_rj1'];
		   $tot_poli3_rj1=$tot_poli3_rj1+$data['poli3_rj1'];		   
		   $tot_poli4_rj1=$tot_poli4_rj1+$data['poli4_rj1'];
		   $tot_poli5_rj1=$tot_poli5_rj1+$data['poli5_rj1'];
	       $tot_poli6_rj1=$tot_poli6_rj1+$data['poli6_rj1'];

		   $tot_poli1_ri1=$tot_poli1_ri1+$data['poli1_ri1'];		   
		   $tot_poli2_ri1=$tot_poli2_ri1+$data['poli2_ri1'];
		   $tot_poli3_ri1=$tot_poli3_ri1+$data['poli3_ri1'];		   
		   $tot_poli4_ri1=$tot_poli4_ri1+$data['poli4_ri1'];
		   $tot_poli5_ri1=$tot_poli5_ri1+$data['poli5_ri1'];
	       $tot_poli6_ri1=$tot_poli6_ri1+$data['poli6_ri1'];

		   ?>
<tr <?   echo 
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

    <td align="right"><?=number_format($data['poli1_rj1']+$data['poli2_rj1']+$data['poli3_rj1']+$data['poli4_rj1']+$data['poli5_rj1']+$data['poli6_rj1'],0);?></td>
    <td align="right"><?=number_format($data['poli1_ri1'],0);?></td>
    <td align="right"><?=number_format($data['poli2_ri1'],0);?></td>
    <td align="right"><?=number_format($data['poli3_ri1'],0);?></td>
    <td align="right"><?=number_format($data['poli4_ri1'],0);?></td>
    <td align="right"><?=number_format($data['poli1_ri1']+$data['poli_ri1']+$data['poli3_ri1']+$data['poli4_ri1']+$data['poli5_ri1']+$data['poli6_ri1'],0);?></td>
    <td align="right"><?=number_format($data['poli1_rj1']+$data['poli2_rj1']+$data['poli3_rj1']+$data['poli4_rj1']+$data['poli5_rj1']+$data['poli6_rj1']+$data['poli1_ri1']+$data['poli2_ri1']+$data['poli3_ri1']+$data['poli4_ri1']+$data['poli5_ri1']+$data['poli6_ri1'],0);?></td>
  </tr>
  <?php } ?>
  <tr style='background:black;color:#fff'>
    <td >TOTAL</td>
    <td align="right"><?=number_format($tot_poli1_rj1,0); ?></td>
    <td align="right"><?=number_format($tot_poli2_rj1,0); ?></td>
    <td align="right"><?=number_format($tot_poli3_rj1,0); ?></td>
    <td align="right"><?=number_format($tot_poli4_rj1,0); ?></td>    
    <td align="right"><?=number_format($tot_poli1_rj1+$tot_poli2_rj1+$tot_poli3_rj1+$tot_poli4_rj1+$tot_poli5_rj1+$tot_poli6_rj1,0); ?></td>
    <td align="right"><?=number_format($tot_poli1_ri1,0); ?></td>
    <td align="right"><?=number_format($tot_poli1_ri1,0); ?></td>
    <td align="right"><?=number_format($tot_poli3_ri1,0); ?></td>
    <td align="right"><?=number_format($tot_poli4_ri1,0); ?></td>
    <td align="right"><?=number_format($tot_poli1_ri1+$tot_poli2_ri1+$tot_poli3_ri1+$tot_poli4_ri1+$tot_poli5_ri1+$tot_poli6_ri1,0); ?></td>
    <td align="right"><?=number_format($tot_poli1_rj1+$tot_poli2_rj1+$tot_poli3_rj1+$tot_poli4_rj1+$tot_poli5_rj1+$tot_poli6_rj1+$tot_poli1_ri1+$tot_poli2_ri1+$tot_poli3_ri1+$tot_poli4_ri1+$tot_poli5_ri1+$tot_poli6_ri1,0); ?></td>

</tr>
</table>
</div>
</div></div>
