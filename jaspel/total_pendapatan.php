<div align="center">
<div id="frame" style="width:100%">
	<div id="frame_title">
	  <h3>Total Rekap Pendapatan </h3></div>
<?php 
include("include/connect.php");
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
    <td>Cara Bayar</td>
    <td><select name="poly" id="poly" class="text" >
                                <option value=""> Semua Cara Bayar </option>
                                <?
                                $qrypoly = mysql_query("SELECT kode,nama FROM m_carabayar ORDER BY kode ASC")or die (mysql_error());
                                while ($listpoly = mysql_fetch_array($qrypoly)) {
                                    ?>
                                <option value="<? echo $listpoly['kode'];?>" <? if($listpoly['kode']==$poly) echo "selected=selected"; ?>><? echo $listpoly['nama'];?></option>
                                    <? } ?>
                            </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cari" class="text"/>
    <input type="hidden" name="link" value="private27All" /></td>
  </tr>
</table>

    </form>     
<br />
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
    <td width="51" align="right"><?=number_format($data['manajemen'],0);?></td>
    <td width="51" align="right"><?=number_format($data['rj'],0);?></td>
    <td width="70" align="right"><?=number_format($data['ugd'],0);?></td>
    <td width="64" align="right"><?=number_format($data['vk'],0);?></td>
    <td width="67" align="right"><?=number_format($data['lab'],0);?></td>
    <td width="84" align="right"><?=number_format($data['rad'],0);?></td>
    <td width="72" align="right"><?=number_format($data['gizi'],0);?></td>
    <td width="72" align="right"><?=number_format($data['apotek'],0);?></td>
    <td width="72" align="right"><?=number_format($data['manajemen']+$data['rj']+$data['ugd']+$data['vk']+$data['lab']+$data['rad']+$data['apotek']+$data['gizi'],0);?></td>
    <td width="72" align="right"><?=number_format($data['ok'],0);?></td>
    <td width="79" align="right"><?=number_format($data['ri'],0);?></td>
    <td width="70" align="right"><?=number_format($data['vk_ri'],0);?></td>
    <td width="70" align="right"><?=number_format($data['lab_ri'],0);?></td>
    <td width="70" align="right"><?=number_format($data['rad_ri'],0);?></td>
    <td width="70" align="right"><?=number_format($data['gizi_ri'],0);?></td>
    <td width="70" align="right"><?=number_format($data['apotek_ri'],0);?></td>
    <td width="70" align="right"><?=number_format($data['ok']+$data['ri']+$data['vk_ri']+$data['lab_ri']+$data['rad_ri']+$data['apotek_ri']+$data['gizi_ri'],0) ?></td>    
    <td align="right"><?=number_format($data['manajemen']+$data['rj']+$data['ugd']+$data['vk']+$data['lab']+$data['rad']+$data['gizi']+$data['apotek']+$data['ok']+$data['ri']+$data['vk_ri']+$data['lab_ri']+$data['rad_ri']+$data['gizi_ri']+$data['apotek_ri'],0)?></td>
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
    <td align="right"><?=number_format($tot_manajemen,0); ?></td>
    <td align="right"><?=number_format($tot_rj,0); ?></td>
    <td align="right"><?=number_format($tot_ugd,0); ?></td>
    <td align="right"><?=number_format($tot_vk,0); ?></td>
    <td align="right"><?=number_format($tot_lab,0); ?></td>    
    <td align="right"><?=number_format($tot_rad,0); ?></td>
    <td align="right"><?=number_format($tot_gizi,0); ?></td>
    <td align="right"><?=number_format($tot_apotek,0); ?></td>
    <td align="right"><?=number_format($tot_manajemen+$tot_rj+$tot_ugd+$tot_vk+$tot_lab+$tot_rad+$tot_gizi+$tot_apotek,0); ?></td>
    <td align="right"><?=number_format($tot_ok,0); ?></td>
    <td align="right"><?=number_format($tot_ri,0); ?></td>
    <td align="right"><?=number_format($tot_vk_ri,0); ?></td>
    <td align="right"><?=number_format($tot_lab_ri,0); ?></td>
    <td align="right"><?=number_format($tot_rad_ri,0); ?></td>
    <td align="right"><?=number_format($tot_gizi_ri,0); ?></td>
    <td align="right"><?=number_format($tot_apotek_ri,0); ?></td>
    <td align="right"><?=number_format($tot_ok+$tot_ri+$tot_vk_ri+$tot_lab_ri+ $tot_rad_ri+$tot_gizi_ri+$tot_apotek_ri,0) ?></td>    
    
    <td align="right"><?=number_format($tot_manajemen+$tot_rj+$tot_ugd+$tot_vk+$tot_lab+$tot_rad+$tot_apotek+$tot_ok+$tot_ri+$tot_vk_ri+$tot_lab_ri+ $tot_rad_ri+$tot_apotek_ri,0); ?></td>
  </tr>
</table><p><form action="adm/eksekutif/slide/total_pendapatan_xls.php" method="get">
				 <input type="hidden" name="tgl_kunjungan" id="tgl_kunjungan" value=<?=$tgl_kunjungan?> />
                <input type="hidden" name="tgl_kunjungan2" id="tgl_kunjungan2" value=<?=$tgl_kunjungan2?> />                
                <input type="hidden" name="poly" id="poly" value=<?=$poly?> />                
                   <input type="submit" value="export xls"  />
                </form></p>
</div>
</div></div>
