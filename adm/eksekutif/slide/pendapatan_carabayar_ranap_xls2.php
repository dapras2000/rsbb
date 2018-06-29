<div id="frame_title"><h3>Rekap Rawat Inap Per Carabayar</h3></div>
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
    <th width="26" rowspan="3">Tanggal</th>
	<?$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');?>
    <th colspan="<?=mysql_num_rows($ss);?>">Pendapatan Rawat Inap</th>
    <th width="25" rowspan="3">Total</th>
  </tr>
  <tr>
    <th colspan="<?=mysql_num_rows($ss);?>">Cara Bayar</th>
    </tr>
  <tr>
    <?$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
		while($ds = mysql_fetch_array($ss)){
		echo '<th>'.$ds['NAMA'].'</th>';
	}?>
    </tr>
  <?php  $tot_jkl=0;$tot_jkp=0;
        $ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
		$banyak_cara_bayar = 0;
		while($ds = mysql_fetch_array($ss)){
			$var = 'tot_'.$ds['KODE'];
			$$var = 0;
			$tampung[$banyak_cara_bayar] = $ds['KODE'];
			$tmp_nama[$banyak_cara_bayar] = $ds['NAMA'];
			$banyak_cara_bayar++;
		}
		
       $sql="CALL pr_eksekutif_carabayar_pendapatan_ranap('".$tgl_kunjungan."','".$tgl_kunjungan2."')";
       $rs=mysql_query($sql);
	  if(!$rs) die(mysql_error());
       while ($data = mysql_fetch_array($rs)) {
		   for($i=0;$i<$banyak_cara_bayar;$i++){
				${'tot_'.$tampung[$i]} = ${'tot_'.$tampung[$i]}+$data[$tmp_nama[$i]];
		   }
		   ?>
<tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>    
    <td width="33"><?=$data['tglbayar'];?></td>
    <? $tmp_jum = 0;
	for($i=0;$i<$banyak_cara_bayar;$i++){
		echo '<td width="33" align="right">'.number_format($data[$tmp_nama[$i]],0).'</td>';
		$tmp_jum = $tmp_jum + $data[$tmp_nama[$i]];
	}?>
    <td align="right"><?=number_format($tmp_jum,0);?></td>
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
  </tr>
  <tr>
    <td>&nbsp;</td>
    <? $tmp_jumlah = 0;
	for($i=0;$i<$banyak_cara_bayar;$i++){
		echo '<td align="right">'.number_format(${'tot_'.$tampung[$i]},0).'</td>';
		$tmp_jumlah = $tmp_jumlah + ${'tot_'.$tampung[$i]};
	}?>
    <td align="right"><?=number_format($tmp_jumlah,0); ?></td>
  </tr>
</table>
