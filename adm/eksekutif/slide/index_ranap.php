<div align="center">
<div id="frame" style="width:100%">
	<div id="frame_title">
	  <h3>Rekap Pasien Rawat Inap</h3></div>
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
    <input type="hidden" name="link" value="private26" /></td>
  </tr>
</table>

    </form>     
<br />
<!--<div style="overflow:scroll;width:98%;height:auto;">-->
<!--<table width="148%" style="font-size:9px;" border="0" align="center" class="tb" cellpadding="1" cellspacing="1">-->
<table  style="font-size:12px;" border="1" align="center" class="tb" cellpadding="1" cellspacing="1">
  <tr align="center">
    <th width="70" rowspan="3">Tanggal</th>
    <th colspan="15" >Kunjungan Rawat Inap</th>
    <th width="25" rowspan="3">Total</th>
  </tr>
  <tr align="center">
<? $sql=mysql_query("select distinct NAMA from m_ruang");
$rc= mysql_num_rows($sql);

?>
    <th colspan="<? echo "$rc"; ?>" align='center'>Ruang</th>
    </tr>
  <tr align="center">
<? $sql=mysql_query("select distinct NAMA from m_ruang");
while($r=mysql_fetch_array($sql)){
extract($r);
echo"    <th>$NAMA</th>";

}
?>


<!--
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
    <th>VK</th>  -->  
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
		$tot_poli15_rj1=0; 		
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
		   $tot_poli9_rj1=$tot_poli9_rj1+$data['poli9_rj1'];
		   $tot_poli10_rj1=$tot_poli10_rj1+$data['poli10_rj1'];
		   $tot_poli11_rj1=$tot_poli11_rj1+$data['poli11_rj1'];
		   $tot_poli12_rj1=$tot_poli12_rj1+$data['poli12_rj1'];
		   $tot_poli13_rj1=$tot_poli13_rj1+$data['poli13_rj1'];
 		   $tot_poli14_rj1=$tot_poli14_rj1+$data['poli14_rj1'];
		   $tot_poli14_rj1=$tot_poli15_rj1+$data['poli15_rj1'];
		   $tot_poli16_rj1=$tot_poli16_rj1+$data['poli16_rj1'];
		   $tot_poli17_rj1=$tot_poli17_rj1+$data['poli17_rj1'];
		   $tot_poli18_rj1=$tot_poli18_rj1+$data['poli18_rj1'];
		   $tot_poli19_rj1=$tot_poli19_rj1+$data['poli19_rj1'];
		   $tot_poli20_rj1=$tot_poli20_rj1+$data['poli20_rj1'];
		   $tot_poli21_rj1=$tot_poli21_rj1+$data['poli21_rj1'];
		   $tot_poli22_rj1=$tot_poli22_rj1+$data['poli22_rj1'];
		   $tot_poli23_rj1=$tot_poli23_rj1+$data['poli23_rj1'];
		   $tot_poli24_rj1=$tot_poli24_rj1+$data['poli24_rj1'];
		   $tot_poli25_rj1=$tot_poli25_rj1+$data['poli25_rj1'];
		   $tot_poli26_rj1=$tot_poli26_rj1+$data['poli26_rj1'];
		   $tot_poli27_rj1=$tot_poli27_rj1+$data['poli27_rj1'];
		   $tot_poli28_rj1=$tot_poli28_rj1+$data['poli28_rj1'];
		   $tot_poli29_rj1=$tot_poli29_rj1+$data['poli29_rj1'];
		   $tot_poli30_rj1=$tot_poli30_rj1+$data['poli30_rj1'];
$total5=$data['poli5_rj1']+$data['poli6_rj1']+$data['poli7_rj1']; 		   		   
$total8=$data['poli8_rj1']+$data['poli9_rj1']+$data['poli10_rj1'];
$total11=$data['poli11_rj1']+$data['poli12_rj1']+$data['poli13_rj1']+$data['poli14_rj1'];
$total16=$data['poli16_rj1']+$data['poli17_rj1']+$data['poli18_rj1'];

$total27=$data['poli27_rj1']+$data['poli28_rj1'];

$gt5= $tot_poli5_rj1+$tot_poli6_rj1+$tot_poli7_rj1;
$gt8= $tot_poli8_rj1+$tot_poli9_rj1+$tot_poli10_rj1;
$gt11= $tot_poli11_rj1+$tot_poli12_rj1+$tot_poli13_rj1+$tot_poli14_rj1;
$gt16= $tot_poli16_rj1+$tot_poli17_rj1+$tot_poli18_rj1;
$gt22= $tot_poli22_rj1+$tot_poli23_rj1+$tot_poli24_rj1+$tot_poli25_rj1+$tot_poli26_rj1;
$gt27= $tot_poli27_rj1+$tot_poli28_rj1;

?>
<tr align="center" <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>    
    <td width="33"><?=$data['tglreg'];?></td>

    <td width="33"><?=$data['poli2_rj1'];?></td>
    <td width="33"><?=$data['poli3_rj1'];?></td>
    <td width="33"><?=$data['poli4_rj1'];?></td>
    <td width="33"><?=$data['poli5_rj1']+$data['poli6_rj1']+$data['poli7_rj1'];?></td>
    <td width="33"><?=$data['poli8_rj1']+$data['poli9_rj1']+$data['poli10_rj1'];?></td>
    <td width="33"><?=$data['poli11_rj1']+$data['poli12_rj1']+$data['poli13_rj1']+$data['poli14_rj1'];?></td>
    <td width="33"><?=$data['poli8_rj1'];?></td>
    <td width="33"><?=$data['poli16_rj1']+$data['poli17_rj1']+$data['poli18_rj1'];?></td>
    <td width="50"><?=$data['poli10_rj1'];?></td>
    <td width="33"><?=$data['poli11_rj1'];?></td>
    <td width="33"><?=$data['poli12_rj1'];?></td>
    <td width="33"><?=$data['poli22_rj1']+$data['poli23_rj1']+$data['poli24_rj1']+$data['poli25_rj1']+$data['poli26_rj1'];?></td>
    <td width="33"><?=$data['poli27_rj1']+$data['poli28_rj1'];?></td>
   
    <td width="33"><?=$data['poli29_rj1'];?></td>
    <td width="33"><?=$data['poli30_rj1'];?></td>

    <td><?=$data['poli1_rj1']+$data['poli2_rj1']+$data['poli3_rj1']+$data['poli4_rj1']+$data['poli5_rj1']+$data['poli6_rj1']+$data['poli7_rj1']+$data['poli8_rj1']+$data['poli9_rj1']+$data['poli10_rj1']+$data['poli11_rj1']+$data['poli12_rj1']+$data['poli13_rj1']+$data['poli14_rj1']+$data['poli1_rj15']+$data['poli16_rj1']+$data['poli17_rj1']+$data['poli18_rj1']+$data['poli19_rj1']+$data['poli20_rj1']+$data['poli21_rj1']+$data['poli22_rj1']+$data['poli23_rj1']+$data['poli24_rj1']+$data['poli25_rj1']+$data['poli26_rj1']+$data['poli27_rj1']+$data['poli28_rj1']+$data['poli29_rj1']+$data['poli30_rj1'];?></td>
  </tr>
  <?php } ?>
  
  <tr align="center">
    <td><strong>TOTAL</td>

    <td><strong><?php echo $tot_poli2_rj1; ?></strong></td>
    <td><strong><?php echo $tot_poli3_rj1; ?></strong></td>
    <td><strong><?php echo $tot_poli4_rj1; ?></strong></td>    
    <td><strong><?php echo $gt5; ?></strong></td>    
    <td><strong><?php echo $gt8; ?></strong></td>    
    <td><strong><?php echo $gt11; ?></strong></td>    
    <td><strong><?php echo $tot_poli8_rj1; ?></strong></td>
    <td><strong><?php echo $gt16; ?></strong></td>
    <td><strong><?php echo $tot_poli10_rj1; ?></strong></td>
    <td><strong><?php echo $tot_poli11_rj1; ?></strong></td>
    <td><strong><?php echo $tot_poli12_rj1; ?></strong></td>    
    <td><strong><?php echo $gt22; ?></strong></td>  
    <td><strong><?php echo $gt27; ?></strong></td> 

    <td><strong><?php echo $tot_poli29_rj1; ?></strong></td>
    <td><strong><?php echo $tot_poli30_rj1; ?></strong></td>    
      
    <td><strong><?php echo  $$tot_poli1_rj1+$tot_poli2_rj1+$tot_poli3_rj1+$tot_poli4_rj1+$tot_poli5_rj1+$tot_poli6_rj1+$tot_poli7_rj1+$tot_poli8_rj1+$tot_poli9_rj1+$tot_poli10_rj1+$tot_poli11_rj1+$tot_poli12_rj1+$tot_poli13_rj1+$tot_poli14_rj1+tot_poli15_rj1+$tot_poli16_rj1+$tot_poli17_rj1+$tot_poli18_rj1+$tot_poli19_rj1+$tot_poli20_rj1+$tot_poli21_rj1+$tot_poli22_rj1+$tot_poli23_rj1+$tot_poli24_rj1+$tot_poli25_rj1+$tot_poli26_rj1+$tot_poli27_rj1+$tot_poli28_rj1+$tot_poli29_rj1+$tot_poli30_rj1; ?></td>
  
</tr>
</table><p><form action="adm/eksekutif/slide/rekap_ranap_xls.php" method="get">
				 <input type="hidden" name="tgl_kunjungan" id="tgl_kunjungan" value=<?=$tgl_kunjungan?> />
                <input type="hidden" name="tgl_kunjungan2" id="tgl_kunjungan2" value=<?=$tgl_kunjungan2?> />                
                   <input type="submit" value="export xls"  />
                </form></p>
</div>
</div></div>
