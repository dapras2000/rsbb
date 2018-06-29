<h3>SENSUS PENDAFTARAN RAWAT JALAN</h3>
<?php 
include '../include/connect.php';
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
<table style="font-size:11px;" border="1" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <th width="26" rowspan="6">Jenis Pasien</th>
    <th colspan="2" rowspan="2">JK</th>
    <th colspan="53">Kunjungan Rawat Jalan</th>
	<?$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');?>
    <th colspan="<?=mysql_num_rows($ss);?>">Cara Bayar</th>
    <th width="25" rowspan="6">Total</th>
  </tr>
  <tr>
    <th colspan="44">Spesialis</th>
    <th colspan="9">Non Spesialis</th>
	<?$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
		while($ds = mysql_fetch_array($ss)){
		echo '<th width="28" rowspan="5">'.$ds['NAMA'].'</th>';
	}?>
  </tr>
  <tr>
    <th width="17" rowspan="4">L</th>
    <th width="17" rowspan="4">P</th>
    <th colspan="4">Dalam</th>
    <th colspan="4">KB KD</th>
    <th colspan="4">Anak</th>
    <th colspan="4">Bedah</th>
    <th colspan="4">Gigi</th>
    <th colspan="4">Psikiatri</th>
    <th colspan="4">Neurologi</th>
    <th colspan="4">Anastesi</th>
    <th colspan="4">THT</th>
    <th width="50" colspan="4">MATA</th>
    <th colspan="4">PARU</th>
    <th colspan="4">UGD</th>
    <th colspan="4">VK</th>
    <th width="35" rowspan="4">Rujukan</th>
  </tr>
  <tr>
    <th colspan="4">Asal Pasien</th>
    <th colspan="4">Asal Pasien</th>
    <th colspan="4">Asal Pasien</th>
    <th colspan="4">Asal Pasien</th>
    <th colspan="4">Asal Pasien</th>
    <th colspan="4">Asal Pasien</th>
    <th colspan="4">Asal Pasien</th>
    <th colspan="4">Asal Pasien</th>
    <th colspan="4">Asal Pasien</th>
    <th colspan="4">Asal Pasien</th>
    <th colspan="4">Asal Pasien</th>
    <th colspan="4">Asal Pasien</th>
    <th colspan="4">Asal Pasien</th>
  </tr>
  <tr>
    <th width="17" rowspan="2">DS</th>
    <th colspan="3">Rujukan</th>
    <th width="17" rowspan="2">DS</th>
    <th colspan="3">Rujukan</th>
    <th width="17" rowspan="2">DS</th>
    <th colspan="3">Rujukan</th>
    <th width="17" rowspan="2">DS</th>
    <th colspan="3">Rujukan</th>
    <th width="17" rowspan="2">DS</th>
    <th colspan="3">Rujukan</th>
    <th width="17" rowspan="2">DS</th>
    <th colspan="3">Rujukan</th>
    <th width="17" rowspan="2">DS</th>
    <th colspan="3">Rujukan</th>
    <th width="17" rowspan="2">DS</th>
    <th colspan="3">Rujukan</th>
    <th width="17" rowspan="2">DS</th>
    <th colspan="3">Rujukan</th>
    <th rowspan="2">DS</th>
    <th colspan="3">Rujukan</th>
    <th width="5" rowspan="2">DS</th>
    <th colspan="3">Rujukan</th>
    <th width="17" rowspan="2">DS</th>
    <th colspan="3">Rujukan</th>
    <th width="17" rowspan="2">DS</th>
    <th colspan="3">Rujukan</th>
  </tr>
  <tr>
    <th width="20">PKM</th>
    <th width="17">RS</th>
    <th width="33">Lainnya</th>
    <th width="20">PKM</th>
    <th width="17">RS</th>
    <th width="33">Lainnya</th>
    <th width="20">PKM</th>
    <th width="17">RS</th>
    <th width="33">Lainnya</th>
    <th width="20">PKM</th>
    <th width="17">RS</th>
    <th width="33">Lainnya</th>
    <th width="20">PKM</th>
    <th width="17">RS</th>
    <th width="33">Lainnya</th>
    <th width="20">PKM</th>
    <th width="17">RS</th>
    <th width="33">Lainnya</th>
    <th width="20">PKM</th>
    <th width="17">RS</th>
    <th width="33">Lainnya</th>
    <th width="20">PKM</th>
    <th width="17">RS</th>
    <th width="33">Lainnya</th>
    <th width="20">PKM</th>
    <th width="17">RS</th>
    <th width="33">Lainnya</th>
    <th>PKM</th>
    <th>RS</th>
    <th>Lainnya</th>
    <th width="6">PKM</th>
    <th width="13">RS</th>
    <th width="27">Lainnya</th>
    <th width="20">PKM</th>
    <th width="17">RS</th>
    <th width="33">Lainnya</th>
    <th width="20">PKM</th>
    <th width="17">RS</th>
    <th width="33">Lainnya</th>
  </tr>
<?php  $tot_jkl=0;$tot_jkp=0;
        $tot_poli1_rj1=0;$tot_poli1_rj2=0;$tot_poli1_rj3=0;$tot_poli1_rj4=0;
		$tot_poli2_rj1=0;$tot_poli2_rj2=0;$tot_poli2_rj3=0;$tot_poli2_rj4=0;
		$tot_poli3_rj1=0;$tot_poli3_rj2=0;$tot_poli3_rj3=0;$tot_poli3_rj4=0;
		$tot_poli4_rj1=0;$tot_poli4_rj2=0;$tot_poli4_rj3=0;$tot_poli4_rj4=0;
		$tot_poli5_rj1=0;$tot_poli5_rj2=0;$tot_poli5_rj3=0;$tot_poli5_rj4=0;
		$tot_poli6_rj1=0;$tot_poli6_rj2=0;$tot_poli6_rj3=0;$tot_poli6_rj4=0;
		$tot_poli7_rj1=0;$tot_poli7_rj2=0;$tot_poli7_rj3=0;$tot_poli7_rj4=0;
		$tot_poli8_rj1=0;$tot_poli8_rj2=0;$tot_poli8_rj3=0;$tot_poli8_rj4=0;
		$tot_poli28_rj1=0;$tot_poli28_rj2=0;$tot_poli28_rj3=0;$tot_poli28_rj4=0;
		$tot_poli29_rj1=0;$tot_poli29_rj2=0;$tot_poli29_rj3=0;$tot_poli29_rj4=0;
		$tot_poli30_rj1=0;$tot_poli30_rj2=0;$tot_poli30_rj3=0;$tot_poli30_rj4=0;
		
		$tot_poli9_rj1=0;$tot_poli9_rj2=0;$tot_poli9_rj3=0;$tot_poli9_rj4=0;
		$tot_poli10_rj1=0;$tot_poli10_rj2=0;$tot_poli10_rj3=0;$tot_poli10_rj4=0;
		
		$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
		$banyak_cara_bayar = 0;
		while($ds = mysql_fetch_array($ss)){
			$var = 'tot_crbyr'.$ds['KODE'];
			$$var = 0;
			$tampung[$banyak_cara_bayar] = $ds['KODE'];
			$banyak_cara_bayar++;
		}

		$sql="CALL pr_sensus_pendaftaran_rajal('".$tgl_kunjungan."','".$tgl_kunjungan2."')";
       $rs=mysql_query($sql);
	  if(!$rs) die(mysql_error());
       while ($data = mysql_fetch_array($rs)) {
		   $tot_jkl=$tot_jkl+$data['L'];
		   $tot_jkp=$tot_jkp+$data['P'];
		   $tot_poli1_rj1=$tot_poli1_rj1+$data['poli1_rj1'];
		   $tot_poli1_rj2=$tot_poli1_rj2+$data['poli1_rj2'];
		   $tot_poli1_rj3=$tot_poli1_rj3+$data['poli1_rj3'];
		   $tot_poli1_rj4=$tot_poli1_rj4+$data['poli1_rj4'];
		   
		   $tot_poli2_rj1=$tot_poli2_rj1+$data['poli2_rj1'];
		   $tot_poli2_rj2=$tot_poli2_rj2+$data['poli2_rj2'];
		   $tot_poli2_rj3=$tot_poli2_rj3+$data['poli2_rj3'];
		   $tot_poli2_rj4=$tot_poli2_rj4+$data['poli2_rj4'];

		   $tot_poli3_rj1=$tot_poli3_rj1+$data['poli3_rj1'];
		   $tot_poli3_rj2=$tot_poli3_rj2+$data['poli3_rj2'];
		   $tot_poli3_rj3=$tot_poli3_rj3+$data['poli3_rj3'];
		   $tot_poli3_rj4=$tot_poli3_rj4+$data['poli3_rj4'];
		   
		   $tot_poli4_rj1=$tot_poli4_rj1+$data['poli4_rj1'];
		   $tot_poli4_rj2=$tot_poli4_rj2+$data['poli4_rj2'];
		   $tot_poli4_rj3=$tot_poli4_rj3+$data['poli4_rj3'];
		   $tot_poli4_rj4=$tot_poli4_rj4+$data['poli4_rj4'];		   
		   
		   $tot_poli5_rj1=$tot_poli5_rj1+$data['poli5_rj1'];
		   $tot_poli5_rj2=$tot_poli5_rj2+$data['poli5_rj2'];
		   $tot_poli5_rj3=$tot_poli5_rj3+$data['poli5_rj3'];
		   $tot_poli5_rj4=$tot_poli5_rj4+$data['poli5_rj4'];
		   
		   $tot_poli6_rj1=$tot_poli6_rj1+$data['poli6_rj1'];
		   $tot_poli6_rj2=$tot_poli6_rj2+$data['poli6_rj2'];
		   $tot_poli6_rj3=$tot_poli6_rj3+$data['poli6_rj3'];
		   $tot_poli6_rj4=$tot_poli6_rj4+$data['poli6_rj4'];		   
		   
		   $tot_poli7_rj1=$tot_poli7_rj1+$data['poli7_rj1'];
		   $tot_poli7_rj2=$tot_poli7_rj2+$data['poli7_rj2'];
		   $tot_poli7_rj3=$tot_poli7_rj3+$data['poli7_rj3'];
		   $tot_poli7_rj4=$tot_poli7_rj4+$data['poli7_rj4'];		   
		   
		   $tot_poli8_rj1=$tot_poli8_rj1+$data['poli8_rj1'];
		   $tot_poli8_rj2=$tot_poli8_rj2+$data['poli8_rj2'];
		   $tot_poli8_rj3=$tot_poli8_rj3+$data['poli8_rj3'];
		   $tot_poli8_rj4=$tot_poli8_rj4+$data['poli8_rj4'];
		   
		   $tot_poli28_rj1=$tot_poli28_rj1+$data['poli28_rj1'];
		   $tot_poli28_rj2=$tot_poli28_rj2+$data['poli28_rj2'];
		   $tot_poli28_rj3=$tot_poli28_rj3+$data['poli28_rj3'];
		   $tot_poli28_rj4=$tot_poli28_rj4+$data['poli28_rj4'];

		   $tot_poli29_rj1=$tot_poli29_rj1+$data['poli29_rj1'];
		   $tot_poli29_rj2=$tot_poli29_rj2+$data['poli29_rj2'];
		   $tot_poli29_rj3=$tot_poli29_rj3+$data['poli29_rj3'];
		   $tot_poli29_rj4=$tot_poli29_rj4+$data['poli29_rj4'];
		   
		   $tot_poli30_rj1=$tot_poli30_rj1+$data['poli30_rj1'];
		   $tot_poli30_rj2=$tot_poli30_rj2+$data['poli30_rj2'];
		   $tot_poli30_rj3=$tot_poli30_rj3+$data['poli30_rj3'];
		   $tot_poli30_rj4=$tot_poli30_rj4+$data['poli30_rj4'];
		   

		   $tot_poli9_rj1=$tot_poli9_rj1+$data['poli9_rj1'];
		   $tot_poli9_rj2=$tot_poli9_rj2+$data['poli9_rj2'];
		   $tot_poli9_rj3=$tot_poli9_rj3+$data['poli9_rj3'];
		   $tot_poli9_rj4=$tot_poli9_rj4+$data['poli9_rj4'];
		   
		   $tot_poli10_rj1=$tot_poli10_rj1+$data['poli10_rj1'];
		   $tot_poli10_rj2=$tot_poli10_rj2+$data['poli10_rj2'];
		   $tot_poli10_rj3=$tot_poli10_rj3+$data['poli10_rj3'];
		   $tot_poli10_rj4=$tot_poli10_rj4+$data['poli10_rj4'];		   
		   
		   $tot_rujukan=$tot_rujukan+$data['tot_rujukan'];
		   
		   for($i=0;$i<$banyak_cara_bayar;$i++){
				${'tot_crbyr'.$tampung[$i]} = ${'tot_crbyr'.$tampung[$i]}+$data['crbyr'.$tampung[$i]];
		   }
		   $tot_total=$tot_total+$data['total'];
		   ?>
<tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>> 
    <td><? echo $data['pasienbaru'];?></td>
    <td><?=$data['L'];?></td>
    <td><?=$data['P'];?></td>
    <td><?=$data['poli1_rj1'];?></td>
    <td><?=$data['poli1_rj2'];?></td>
    <td><?=$data['poli1_rj3'];?></td>
    <td><?=$data['poli1_rj4'];?></td>
    <td><?=$data['poli2_rj1'];?></td>
    <td><?=$data['poli2_rj2'];?></td>
    <td><?=$data['poli2_rj3'];?></td>
    <td><?=$data['poli2_rj4'];?></td>
    <td><?=$data['poli3_rj1'];?></td>
    <td><?=$data['poli3_rj2'];?></td>
    <td><?=$data['poli3_rj3'];?></td>
    <td><?=$data['poli3_rj4'];?></td>
    <td><?=$data['poli4_rj1'];?></td>
    <td><?=$data['poli4_rj2'];?></td>
    <td><?=$data['poli4_rj3'];?></td>
    <td><?=$data['poli4_rj4'];?></td>
    <td><?=$data['poli5_rj1'];?></td>
    <td><?=$data['poli5_rj2'];?></td>
    <td><?=$data['poli5_rj3'];?></td>
    <td><?=$data['poli5_rj4'];?></td>
    <td><?=$data['poli6_rj1'];?></td>
    <td><?=$data['poli6_rj2'];?></td>
    <td><?=$data['poli6_rj3'];?></td>
    <td><?=$data['poli6_rj4'];?></td>
    <td><?=$data['poli7_rj1'];?></td>
    <td><?=$data['poli7_rj2'];?></td>
    <td><?=$data['poli7_rj3'];?></td>
    <td><?=$data['poli7_rj4'];?></td>
    <td><?=$data['poli8_rj1'];?></td>
    <td><?=$data['poli8_rj2'];?></td>
    <td><?=$data['poli8_rj3'];?></td>
    <td><?=$data['poli8_rj4'];?></td>
    <td><?=$data['poli28_rj1'];?></td>
    <td><?=$data['poli28_rj2'];?></td>
    <td><?=$data['poli28_rj3'];?></td>
    <td><?=$data['poli28_rj4'];?></td>
    <td><?=$data['poli29_rj1'];?></td>
    <td><?=$data['poli29_rj2'];?></td>
    <td><?=$data['poli29_rj3'];?></td>
    <td><?=$data['poli29_rj4'];?></td>
    <td><?=$data['poli30_rj1'];?></td>
    <td><?=$data['poli30_rj2'];?></td>
    <td><?=$data['poli30_rj3'];?></td>
    <td><?=$data['poli30_rj4'];?></td>
    <td><?=$data['poli9_rj1'];?></td>
    <td><?=$data['poli9_rj2'];?></td>
    <td><?=$data['poli9_rj3'];?></td>
    <td><?=$data['poli9_rj4'];?></td>
    <td><?=$data['poli10_rj1'];?></td>
    <td><?=$data['poli10_rj2'];?></td>
    <td><?=$data['poli10_rj3'];?></td>
    <td><?=$data['poli10_rj4'];?></td>
    <td><?=$data['rujukan'];?></td>
    <?for($i=0;$i<$banyak_cara_bayar;$i++){
		echo "<td>".$data['crbyr'.$tampung[$i]]."</td>";
	}?>
	<td><?=$data['total'];?></td>
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
    <td>Total</td>
    <td><?php echo $tot_jkl; ?></td>
    <td><?php echo $tot_jkp; ?></td>
    <td><?php echo $tot_poli1_rj1; ?></td>
    <td><?php echo $tot_poli1_rj2; ?></td>
    <td><?php echo $tot_poli1_rj3; ?></td>
    <td><?php echo $tot_poli1_rj4; ?></td>
    <td><?php echo $tot_poli2_rj1; ?></td>
    <td><?php echo $tot_poli2_rj2; ?></td>
    <td><?php echo $tot_poli2_rj3; ?></td>
    <td><?php echo $tot_poli2_rj4; ?></td>
    <td><?php echo $tot_poli3_rj1; ?></td>
    <td><?php echo $tot_poli3_rj2; ?></td>
    <td><?php echo $tot_poli3_rj3; ?></td>
    <td><?php echo $tot_poli3_rj4; ?></td>
    <td><?php echo $tot_poli4_rj1; ?></td>
    <td><?php echo $tot_poli4_rj2; ?></td>
    <td><?php echo $tot_poli4_rj3; ?></td>
    <td><?php echo $tot_poli4_rj4; ?></td>    
    <td><?php echo $tot_poli5_rj1; ?></td>
    <td><?php echo $tot_poli5_rj2; ?></td>
    <td><?php echo $tot_poli5_rj3; ?></td>
    <td><?php echo $tot_poli5_rj4; ?></td>    
    <td><?php echo $tot_poli6_rj1; ?></td>
    <td><?php echo $tot_poli6_rj2; ?></td>
    <td><?php echo $tot_poli6_rj3; ?></td>
    <td><?php echo $tot_poli6_rj4; ?></td>    
    <td><?php echo $tot_poli7_rj1; ?></td>
    <td><?php echo $tot_poli7_rj2; ?></td>
    <td><?php echo $tot_poli7_rj3; ?></td>
    <td><?php echo $tot_poli7_rj4; ?></td>    
    <td><?php echo $tot_poli8_rj1; ?></td>
    <td><?php echo $tot_poli8_rj2; ?></td>
    <td><?php echo $tot_poli8_rj3; ?></td>
    <td><?php echo $tot_poli8_rj4; ?></td>
    <td><?php echo $tot_poli28_rj1; ?></td>
    <td><?php echo $tot_poli28_rj2; ?></td>
    <td><?php echo $tot_poli28_rj3; ?></td>
    <td><?php echo $tot_poli28_rj4; ?></td>
    <td><?php echo $tot_poli29_rj1; ?></td>
    <td><?php echo $tot_poli29_rj2; ?></td>
    <td><?php echo $tot_poli29_rj3; ?></td>
    <td><?php echo $tot_poli29_rj4; ?></td>
    <td><?php echo $tot_poli30_rj1; ?></td>
    <td><?php echo $tot_poli30_rj2; ?></td>
    <td><?php echo $tot_poli30_rj3; ?></td>
    <td><?php echo $tot_poli30_rj4; ?></td>
    <td><?php echo $tot_poli9_rj1; ?></td>
    <td><?php echo $tot_poli9_rj2; ?></td>
    <td><?php echo $tot_poli9_rj3; ?></td>
    <td><?php echo $tot_poli9_rj4; ?></td>    
    <td><?php echo $tot_poli10_rj1; ?></td>
    <td><?php echo $tot_poli10_rj2; ?></td>
    <td><?php echo $tot_poli10_rj3; ?></td>
    <td><?php echo $tot_poli10_rj4; ?></td>    
    <td><?php echo $tot_rujukan; ?></td>
    <?for($i=0;$i<$banyak_cara_bayar;$i++){
		echo "<td>".${'tot_crbyr'.$tampung[$i]}."</td>";
	}?>
	<td><?php echo $tot_total; ?></td>
  </tr>
</table>

