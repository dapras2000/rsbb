<div align="center">
<div id="frame" style="width:100%">
	<div id="frame_title"><h3>Rekap pendapatan</h3></div>
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
<form name="formsearch" method="get" >
     <table width="286" border="0" cellspacing="0" class="tb">
  <tr>
    <td width="78">Dari Tanggal</td>
    <td width="204"><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan!=""){
			  echo $tgl_kunjungan;}?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
  <tr>
    <td>Sampai Tanggal</td>
    <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan2!=""){
			  echo $tgl_kunjungan2;}?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cari" class="text"/>
    <input type="hidden" name="link" value="private25" /></td>
  </tr>
</table>

    </form>     

<!--<div style="overflow:scroll;width:98%;height:auto;">-->
<!--<table width="148%" style="font-size:9px;" border="0" align="center" class="tb" cellpadding="1" cellspacing="1">-->
<table  style="font-size:9px;" border="0" align="center" class="tb" cellpadding="1" cellspacing="1">
  <tr>
    <th width="33" rowspan="3">Tanggal</th>
    <th colspan="16">Pendapatan  Rawat Jalan Pasien UMUM</th>
    <th width="33" rowspan="3">Total</th>
  </tr>
  <tr>
    <th colspan="11">Spesialis</th>
    <th rowspan="2">Total
      Spesialis</th>
    <th colspan="3">Non Spesialis</th>
    <th rowspan="2">Total Non Spesialis</th>
    </tr>
  <tr>
    <th>Dalam</th>
    <th>KB KD</th>
    <th>Anak</th>
    <th>Bedah</th>
    <th>Gigi</th>
    <th>Psikiatri</th>
    <th>Neurologi</th>
    <th>Anastesi</th>
    <th>THT</th>
    <th width="50">MATA</th>
    <th>PARU</th>
    <th>UGD</th>
    <th>VK (RJ)</th>
    <th>VK(RI)</th>
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
		$tot_poli28_rj1=0; 
		$tot_poli29_rj1=0; 
		$tot_poli30_rj1=0; 
		
		$tot_poli9_rj1=0; 
		$tot_poli10_rj1=0; 
		$tot_polivk_ri=0;
		
       $sql="CALL pr_eksekutif_pendapatan_rajal('".$tgl_kunjungan."','".$tgl_kunjungan2."')";
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
		   
		   $tot_poli28_rj1=$tot_poli28_rj1+$data['poli28_rj1'];

		   $tot_poli29_rj1=$tot_poli29_rj1+$data['poli29_rj1'];
		   
		   $tot_poli30_rj1=$tot_poli30_rj1+$data['poli30_rj1'];
		   $tot_polivk_ri=$tot_polivk_ri+$data['polivk_ri'];

		   $tot_poli9_rj1=$tot_poli9_rj1+$data['poli9_rj1'];
		   
		   $tot_poli10_rj1=$tot_poli10_rj1+$data['poli10_rj1'];
		   

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
    <td width="33" align="right"><?=number_format($data['poli1_rj1'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli2_rj1'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli3_rj1'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli4_rj1'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli5_rj1'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli6_rj1'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli7_rj1'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli8_rj1'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli28_rj1'],0);?></td>
    <td width="50" align="right"><?=number_format($data['poli29_rj1'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli30_rj1'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli1_rj1']+$data['poli2_rj1']+$data['poli3_rj1']+$data['poli4_rj1']+$data['poli5_rj1']+$data['poli6_rj1']+$data['poli7_rj1']+$data['poli8_rj1'] +$data['poli28_rj1']+$data['poli29_rj1']+$data['poli30_rj1'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli9_rj1'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli10_rj1'],0);?></td>
    <td width="33" align="right"><?=number_format($data['polivk_ri'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli9_rj1']+$data['poli10_rj1']+$data['polivk_ri'],0);?></td>
    <td width="33" align="right"><?=number_format($data['poli1_rj1']+$data['poli2_rj1']+$data['poli3_rj1']+$data['poli4_rj1']+$data['poli5_rj1']+$data['poli6_rj1']+$data['poli7_rj1']+$data['poli8_rj1']+$data['poli9_rj1']+$data['poli10_rj1']+$data['poli28_rj1']+$data['poli29_rj1']+$data['poli30_rj1']+$data['polivk_ri'],0);?></td>
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
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="33" align="right"><?=number_format($tot_poli1_rj1,0); ?></td>
    <td width="33" align="right"><?=number_format($tot_poli2_rj1,0); ?></td>
    <td width="33" align="right"><?=number_format($tot_poli3_rj1,0); ?></td>
    <td width="33" align="right"><?=number_format($tot_poli4_rj1,0); ?></td>    
    <td width="33" align="right"><?=number_format($tot_poli5_rj1,0); ?></td>    
    <td width="33" align="right"><?=number_format($tot_poli6_rj1,0); ?></td>    
    <td width="33" align="right"><?=number_format($tot_poli7_rj1,0); ?></td>    
    <td width="33" align="right"><?=number_format($tot_poli8_rj1,0); ?></td>
    <td width="33" align="right"><?=number_format($tot_poli28_rj1,0); ?></td>
    <td width="50" align="right"><?=number_format($tot_poli29_rj1,0); ?></td>
    <td width="33" align="right"><?=number_format($tot_poli30_rj1,0); ?></td>
    <td width="33" align="right"><?=number_format($tot_poli1_rj1+$tot_poli2_rj1+$tot_poli3_rj1+$tot_poli4_rj1+$tot_poli5_rj1+$tot_poli6_rj1+$tot_poli7_rj1+$tot_poli8_rj1+ $tot_poli28_rj1+$tot_poli29_rj1+$tot_poli30_rj1,0); ?></td>
    <td width="33" align="right"><?=number_format($tot_poli9_rj1,0); ?></td>
    <td width="33" align="right"><?=number_format($tot_poli10_rj1,0); ?></td>
    <td width="33" align="right"><?=number_format($tot_polivk_ri,0); ?></td>
    <td width="33" align="right"><?=number_format($tot_poli9_rj1+$tot_poli10_rj1+$tot_polivk_ri ,0); ?></td>    
    <td width="33" align="right"><?=number_format($tot_poli1_rj1+$tot_poli2_rj1+$tot_poli3_rj1+$tot_poli4_rj1+$tot_poli5_rj1+$tot_poli6_rj1+$tot_poli7_rj1+$tot_poli8_rj1+$tot_poli9_rj1+$tot_poli10_rj1+$tot_poli28_rj1+$tot_poli29_rj1+$tot_poli30_rj1+$tot_polivk_ri,0); ?></td>
  </tr>
</table>
<p><form action="adm/eksekutif/slide/pendapatan_rajal_xls.php" method="get">
				 <input type="hidden" name="tgl_kunjungan" id="tgl_kunjungan" value=<?=$tgl_kunjungan?> />
	               <input type="hidden" name="tgl_kunjungan2" id="tgl_kunjungan2" value=<?=$tgl_kunjungan2?> /> 
                   <input type="submit" value="export xls"  />
                </form></p>
</div>
</div></div>
