<div id="frame_title"><h3>Total Rekap Pendapatan </h3></div>
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

<script>
function popUp(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=400,height=400,left=50,top=50');");
}
jQuery(document).ready(function(){
	jQuery('.detail_lainlain').click(function(){
		var tgl	= jQuery(this).attr('id');
		popUp('<?php echo _BASE_;?>adm/eksekutif/slide/detail_carabayar_lainlain_rajal.php?tgl='+tgl);
		//jQuery.post('<?php echo _BASE_;?>adm/eksekutif/slide/detail_carabayar_lainlain_rajal.php',{tgl:tgl},function(data){
			
		//});
	});
});
</script>
<!--<div style="overflow:scroll;width:98%;height:auto;">-->
<!--<table width="148%" style="font-size:9px;" border="0" align="center" class="tb" cellpadding="1" cellspacing="1">-->
<table  style="font-size:9px;" border="0" align="center" class="tb" cellpadding="1" cellspacing="1">
  <tr>
    <th width="34" rowspan="4">Tanggal</th>
    <th colspan="17">Pendapatan  </th>
    <th width="100" rowspan="4">Total</th>
  </tr>
  <tr>
    <th colspan="17">Unit</th>
    </tr>
  <tr>
    <th>&nbsp;</th>
    <th colspan="7">Pasien Rawat Jalan</th>
    <th rowspan="2">Total Pasien Rajal</th>
    <th colspan="7">Pasien Rawat Inap</th>
    <th rowspan="2">Total Pasien Ranap</th>
    </tr>
  <tr>
    <th>Manajemen</th>
    <th>Poly</th>
    <th>UGD</th>
    <th>VK</th>
    <th>Laboratorium</th>
	<th>Radiologi</th>
	<th>Gizi</th>
	<th>Apotek</th>
	<th>Kamar Operasi</th>
	<th>Rawat Inap</th>
	<th>VK</th>
	<th>Laboratorium</th>
	<th>Radiologi</th>
	<th>Gizi</th>
	<th>Apotek</th>
    </tr>
    
  <?php  $tot_jkl=0;$tot_jkp=0;
        $tot_rj=0; 
		$tot_ugd=0; 
		$tot_vk=0; 
		$tot_lab=0; 
		$tot_rad=0; 
		$tot_ok=0; 
		$tot_ri=0; 
		$tot_apotek=0; 	
		$tot_manajemen=0;
		$tot_vk_ri=0; 
		$tot_lab_ri=0; 
		$tot_rad_ri=0; 
		$tot_apotek_ri=0; 			
       $sql="CALL pr_eksekutif_total_pendapatan('".$tgl_kunjungan."','".$tgl_kunjungan2."',".$poly.")";
       $rs=mysql_query($sql);
	  if(!$rs) die(mysql_error());
       while ($data = mysql_fetch_array($rs)) {
		   $tot_rj=$tot_rj+$data['rj'];
		   
		   $tot_ugd=$tot_ugd+$data['ugd'];

		   $tot_vk=$tot_vk+$data['vk'];
		   
		   $tot_lab=$tot_lab+$data['lab'];
		   $tot_rad=$tot_rad+$data['rad'];
		   $tot_ok=$tot_ok+$data['ok'];		   
		   $tot_ri=$tot_ri+$data['ri'];		   
		   $tot_apotek=$tot_apotek+$data['apotek'];	
		   $tot_gizi=$tot_gizi+$data['gizi'];	
		   $tot_manajemen=$tot_manajemen+$data['manajemen'];	
		   $tot_vk_ri=$tot_vk_ri+$data['vk_ri']; 
		   $tot_lab_ri=$tot_lab_ri+$data['lab_ri']; 
		   $tot_rad_ri=$tot_rad_ri+$data['rad_ri']; 
		   $tot_apotek_ri=$tot_apotek_ri+$data['apotek_ri']; 	
		   $tot_gizi_ri=$tot_gizi_ri+$data['gizi_ri'];			   
		   ?>
<tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>    
    <td width="34" ><?=$data['tanggal'];?></td>
    <td width="51" align="right"><?=$data['manajemen'],0);?></td>
    <td width="51" align="right"><?=$data['rj'],0);?></td>
    <td width="70" align="right"><?=$data['ugd'],0);?></td>
    <td width="64" align="right"><?=$data['vk'],0);?></td>
    <td width="67" align="right"><?=$data['lab'],0);?></td>
    <td width="84" align="right"><?=$data['rad'],0);?></td>
    <td width="72" align="right"><?=$data['gizi'],0);?></td>
    <td width="72" align="right"><?=$data['apotek'],0);?></td>
    <td width="72" align="right"><?=$data['manajemen']+$data['rj']+$data['ugd']+$data['vk']+$data['lab']+$data['rad']+$data['apotek']+$data['gizi'],0);?></td>
    <td width="72" align="right"><?=$data['ok'],0);?></td>
    <td width="79" align="right"><?=$data['ri'],0);?></td>
    <td width="70" align="right"><?=$data['vk_ri'],0);?></td>
    <td width="70" align="right"><?=$data['lab_ri'],0);?></td>
    <td width="70" align="right"><?=$data['rad_ri'],0);?></td>
    <td width="70" align="right"><?=$data['gizi_ri'],0);?></td>
    <td width="70" align="right"><?=$data['apotek_ri'],0);?></td>
    <td width="70" align="right"><?=$data['ok']+$data['ri']+$data['vk_ri']+$data['lab_ri']+$data['rad_ri']+$data['apotek_ri']+$data['gizi_ri'],0) ?></td>    
    <td align="right"><?=$data['manajemen']+$data['rj']+$data['ugd']+$data['vk']+$data['lab']+$data['rad']+$data['gizi']+$data['apotek']+$data['ok']+$data['ri']+$data['vk_ri']+$data['lab_ri']+$data['rad_ri']+$data['gizi_ri']+$data['apotek_ri'],0)?></td>
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
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><?=$tot_manajemen,0); ?></td>
    <td align="right"><?=$tot_rj,0); ?></td>
    <td align="right"><?=$tot_ugd,0); ?></td>
    <td align="right"><?=$tot_vk,0); ?></td>
    <td align="right"><?=$tot_lab,0); ?></td>    
    <td align="right"><?=$tot_rad,0); ?></td>
    <td align="right"><?=$tot_gizi,0); ?></td>
    <td align="right"><?=$tot_apotek,0); ?></td>
    <td align="right"><?=$tot_manajemen+$tot_rj+$tot_ugd+$tot_vk+$tot_lab+$tot_rad+$tot_gizi+$tot_apotek,0); ?></td>
    <td align="right"><?=$tot_ok,0); ?></td>
    <td align="right"><?=$tot_ri,0); ?></td>
    <td align="right"><?=$tot_vk_ri,0); ?></td>
    <td align="right"><?=$tot_lab_ri,0); ?></td>
    <td align="right"><?=$tot_rad_ri,0); ?></td>
    <td align="right"><?=$tot_gizi_ri,0); ?></td>
    <td align="right"><?=$tot_apotek_ri,0); ?></td>
    <td align="right"><?=$tot_ok+$tot_ri+$tot_vk_ri+$tot_lab_ri+ $tot_rad_ri+$tot_gizi_ri+$tot_apotek_ri,0) ?></td>    
    
    <td align="right"><?=$tot_manajemen+$tot_rj+$tot_ugd+$tot_vk+$tot_lab+$tot_rad+$tot_apotek+$tot_ok+$tot_ri+$tot_vk_ri+$tot_lab_ri+ $tot_rad_ri+$tot_apotek_ri,0); ?></td>
  </tr>
</table>