<div align="center">
<div id="frame" style="width:100%">
	<div id="frame_title"><h3>Rekap Gizi Per Carabayar</h3></div>
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
      <input type="hidden" name="link" value="privategizi1" /></td>
  </tr>
</table>

    </form>     
<br />
<!--<div style="overflow:scroll;width:98%;height:auto;">-->
<!--<table width="148%" style="font-size:9px;" border="0" align="center" class="tb" cellpadding="1" cellspacing="1">-->
<table  style="font-size:12px;" border="1" align="center" class="tb" cellpadding="1" cellspacing="1">
 <tr align="center">
    <th width="70" rowspan="3">Tanggal</th>
    <th colspan="5">Pendapatan Gizi (Rawat Jalan)</th>
  
    <th colspan="5">Pendapatan Gizi (Rawat Inap)</th>
        
    <th width="25" rowspan="3">Total</th>
  </tr>
  <tr align="center">
  
  <th colspan="4" >Cara Bayar </th>
    <th width="25" rowspan="2" >Total</th>   
    <th colspan="4">Cara Bayar </th>
<th width="25" rowspan="2" >Total</th>
    </tr>
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

		
       $sql="CALL pr_eksekutif_gizi_carabayar_rajal('".$tgl_kunjungan."','".$tgl_kunjungan2."')";
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
    <td align="right"><?=number_format($data['poli1_rj1']+$data['poli2_rj1']+$data['poli3_rj1']+$data['poli4_rj1'],0);?></td>
    <td align="right"><?=number_format($data['poli1_ri1'],0);?></td>
    <td align="right"><?=number_format($data['poli2_ri1'],0);?></td>
    <td align="right"><?=number_format($data['poli3_ri1'],0);?></td>
    <td align="right"><?=number_format($data['poli4_ri1'],0);?></td>
    <td align="right"><?=number_format($data['poli1_ri1']+$data['poli_ri1']+$data['poli3_ri1']+$data['poli4_ri1'],0);?></td>
    <td align="right"><?=number_format($data['poli1_rj1']+$data['poli2_rj1']+$data['poli3_rj1']+$data['poli4_rj1']+$data['poli1_ri1']+$data['poli2_ri1']+$data['poli3_ri1']+$data['poli4_ri1'],0);?></td>
  </tr>
  <?php } ?>
  <tr style='background:black;color:#fff'>
    <td>TOTAL</td>
    <td align="right"><?=number_format($tot_poli1_rj1,0); ?></td>
    <td align="right"><?=number_format($tot_poli2_rj1,0); ?></td>
    <td align="right"><?=number_format($tot_poli3_rj1,0); ?></td>
    <td align="right"><?=number_format($tot_poli4_rj1,0); ?></td>    
    <td align="right"><?=number_format($tot_poli1_rj1+$tot_poli2_rj1+$tot_poli3_rj1+$tot_poli4_rj1,0); ?></td>
    <td align="right"><?=number_format($tot_poli1_ri1,0); ?></td>
    <td align="right"><?=number_format($tot_poli1_ri1,0); ?></td>
    <td align="right"><?=number_format($tot_poli3_ri1,0); ?></td>
    <td align="right"><?=number_format($tot_poli4_ri1,0); ?></td>
    <td align="right"><?=number_format($tot_poli1_ri1+$tot_poli2_ri1+$tot_poli3_ri1+$tot_poli4_ri1,0); ?></td>
   <td align="right"><?=number_format($tot_poli1_rj1+$tot_poli2_rj1+$tot_poli3_rj1+$tot_poli4_rj1+$tot_poli1_ri1+$tot_poli2_ri1+$tot_poli3_ri1+$tot_poli4_ri1,0); ?></td>
  </tr>
</table>
<p><form action="adm/eksekutif/slide/gizi_carabayar_xls.php" method="get">
				 <input type="hidden" name="tgl_kunjungan" id="tgl_kunjungan" value=<?=$tgl_kunjungan?> />
                <input type="hidden" name="tgl_kunjungan2" id="tgl_kunjungan2" value=<?=$tgl_kunjungan2?> />                
                
                   <input type="submit" value="export xls"  />
                </form></p>
</div>
</div></div>
