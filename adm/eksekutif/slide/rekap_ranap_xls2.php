<div id="frame_title"><h3>Rekap Pasien Rawat Inap</h3></div>
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

<br />
<!--<div style="overflow:scroll;width:98%;height:auto;">-->
<!--<table width="148%" style="font-size:9px;" border="0" align="center" class="tb" cellpadding="1" cellspacing="1">-->
<table  style="font-size:11px;" border="1" align="center"  cellpadding="1" cellspacing="1">
  <tr>
    <th width="33" rowspan="3">Tanggal</th>
    <th colspan="14">Kunjungan Rawat Inap</th>
    <th width="25" rowspan="3">Total</th>
  </tr>
  <tr>
    <th colspan="14">Ruang</th>
    </tr>
  <tr>
    <th>ELANG</th>
    <th>MALEO</th>
    <th>GARUDA</th>
    <th>KAKAKTUA</th>
    <th>PHOENIX</th>
    <th>MERAK</th>
    <th>NURI</th>
    <th>CENDRAWASIH</th>
    <th>KEPODANG</th>
    <th width="50">PIPIT</th>
    <th>SELASAR_KANAN</th>
    <th>RUANG_TUNGGU</th>
    <th>SELASAR_KIRI</th>
    <th>VK</th>    
    </tr>
  <?php  $tot_jkl=0;$tot_jkp=0;
        $tot_poli1_rj1=0; 
		$tot_poli2_rj1=0; 
		$tot_poli3_rj1=0; 
		$tot_poli4_rj1=0; 
		$tot_poli5_rj1=0; 
		$tot_poli6_rj1=0; 
		$tot_poli7_rj1=0; 
		$tot_poli8_rj1=0; 
		$tot_poli12_rj1=0; 
		$tot_poli13_rj1=0; 
		$tot_poli14_rj1=0; 
		
		$tot_poli9_rj1=0; 
		$tot_poli10_rj1=0; 
		$tot_poli11_rj1=0;
		
       $sql="CALL pr_eksekutif_kunjungan_ranap('".$tgl_kunjungan."','".$tgl_kunjungan2."')";
       $rs=mysql_query($sql);
	  if(!$rs) die(mysql_error());
       while ($data = mysql_fetch_array($rs)) {
		   $tot_poli1_rj1=$tot_poli1_rj1+$data['poli1_rj1'];
		   
		   $tot_poli2_rj1=$tot_poli2_rj1+$data['poli2_rj1'];

		   $tot_poli3_rj1=$tot_poli3_rj1+$data['poli3_rj1'];
		   
		   $tot_poli4_rj1=$tot_poli4_rj1+$data['poli4_rj1'];
		   
		   $tot_poli5_rj1=$tot_poli5_rj1+$data['poli5_rj1'];
		   
		   $tot_poli6_rj1=$tot_poli6_rj1+$data['poli6_rj1'];
		   
		   $tot_poli7_rj1=$tot_poli7_rj1+$data['poli7_rj1'];
		   
		   $tot_poli8_rj1=$tot_poli8_rj1+$data['poli8_rj1'];
		   
		   $tot_poli12_rj1=$tot_poli12_rj1+$data['poli12_rj1'];

		   $tot_poli13_rj1=$tot_poli13_rj1+$data['poli13_rj1'];
		   
		   $tot_poli14_rj1=$tot_poli14_rj1+$data['poli14_rj1'];
		   

		   $tot_poli9_rj1=$tot_poli9_rj1+$data['poli9_rj1'];
		   
		   $tot_poli10_rj1=$tot_poli10_rj1+$data['poli10_rj1'];
		   $tot_poli11_rj1=$tot_poli11_rj1+$data['poli11_rj1'];

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
    <td width="33"><?=$data['poli5_rj1'];?></td>
    <td width="33"><?=$data['poli6_rj1'];?></td>
    <td width="33"><?=$data['poli7_rj1'];?></td>
    <td width="33"><?=$data['poli8_rj1'];?></td>
    <td width="33"><?=$data['poli9_rj1'];?></td>
    <td width="50"><?=$data['poli10_rj1'];?></td>
    <td width="33"><?=$data['poli11_rj1'];?></td>
    <td width="33"><?=$data['poli12_rj1'];?></td>
    <td width="33"><?=$data['poli13_rj1'];?></td>
    <td width="33"><?=$data['poli14_rj1'];?></td>
    <td><?=$data['poli1_rj1']+$data['poli2_rj1']+$data['poli3_rj1']+$data['poli4_rj1']+$data['poli5_rj1']+$data['poli6_rj1']+$data['poli7_rj1']+$data['poli8_rj1']+$data['poli9_rj1']+$data['poli10_rj1']+$data['poli11_rj1']+$data['poli12_rj1']+$data['poli13_rj1']+$data['poli14_rj1'];?></td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
    <td><?php echo $tot_poli5_rj1; ?></td>    
    <td><?php echo $tot_poli6_rj1; ?></td>    
    <td><?php echo $tot_poli7_rj1; ?></td>    
    <td><?php echo $tot_poli8_rj1; ?></td>
    <td><?php echo $tot_poli9_rj1; ?></td>
    <td><?php echo $tot_poli10_rj1; ?></td>
    <td><?php echo $tot_poli11_rj1; ?></td>
    <td><?php echo $tot_poli12_rj1; ?></td>    
    <td><?php echo $tot_poli13_rj1; ?></td>  
    <td><?php echo $tot_poli14_rj1; ?></td>        
    <td><?php echo  $tot_poli1_rj1+$tot_poli2_rj1+$tot_poli3_rj1+$tot_poli4_rj1+$tot_poli5_rj1+$tot_poli6_rj1+$tot_poli7_rj1+$tot_poli8_rj1+$tot_poli9_rj1+$tot_poli10_rj1+$tot_poli11_rj1+$tot_poli12_rj1+$tot_poli13_rj1+$tot_poli14_rj1; ?></td>
  </tr>
</table>
