<div align="center">
<div id="frame" style="width:100%">
	<div id="frame_title"><h3>Rekap Pendapatan Rawat Jalan Per Carabayar</h3></div>
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
    <td>Poly</td>
    <td><select name="poly" id="poly" class="text" >
                                <option value=""> Semua Poliklinik </option>
                                <?
                                $qrypoly = mysql_query("SELECT * FROM m_poly ORDER BY kode ASC")or die (mysql_error());
                                while ($listpoly = mysql_fetch_array($qrypoly)) {
                                    ?>
                                <option value="<? echo $listpoly['kode'];?>" <? if($listpoly['kode']==$poly) echo "selected=selected"; ?>><? echo $listpoly['nama'];?></option>
                                    <? } ?>
                            </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cari" class="text"/>
    <input type="hidden" name="link" value="private27" /></td>
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
<table  style="font-size:12px;" border="1" align="center" class="tb" cellpadding="1" cellspacing="1">
  <tr>
    <th width="26" rowspan="3">Tanggal</th>
	<?$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');?>
    <th colspan="<?=mysql_num_rows($ss);?>">Pendapatan  Rawat Jalan Poly, UGD, VK</th>
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
			$var = 'tot_poli'.$ds['KODE'].'_rj1';
			$$var = 0;
			$tampung[$banyak_cara_bayar] = $ds['KODE'];
			$banyak_cara_bayar++;
		}
        
       $sql="CALL pr_eksekutif_carabayar_pendapatan_rajal('".$tgl_kunjungan."','".$tgl_kunjungan2."',".$poly.")";
       $rs=mysql_query($sql);
	  if(!$rs) die(mysql_error());
       while ($data = mysql_fetch_array($rs)) {
		   for($i=0;$i<$banyak_cara_bayar;$i++){
				${'tot_poli'.$tampung[$i].'_rj1'} = ${'tot_poli'.$tampung[$i].'_rj1'}+$data['poli'.$tampung[$i].'_rj1'];
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
    <td width="70" ><?=$data['tglbayar'];?></td>
	<? $tmp_jum = 0;
	for($i=0;$i<$banyak_cara_bayar;$i++){
		if($i == $banyak_cara_bayar-1){
			echo '<td width="33" align="right">'.number_format($data['poli'.$tampung[$i].'_rj1'],0).' </td>';
		}else{
			echo '<td width="70" align="right">'.number_format($data['poli'.$tampung[$i].'_rj1'],0).'</td>';
		}
		$tmp_jum = $tmp_jum + $data['poli'.$tampung[$i].'_rj1'];
	}?>
    <td align="right"><?=number_format($tmp_jum,0);?></td>
  </tr>
  <?php } ?>
  <tr>
    <td>TOTAL</td>
	<? $tmp_jumlah = 0;
	for($i=0;$i<$banyak_cara_bayar;$i++){
		echo '<td align="right">'.number_format(${'tot_poli'.$tampung[$i].'_rj1'},0).'</td>';
		$tmp_jumlah = $tmp_jumlah + ${'tot_poli'.$tampung[$i].'_rj1'};
	}?>
    <td align="right"><?=number_format($tmp_jumlah,0); ?></td>
  </tr>
</table>
<p><form action="adm/eksekutif/slide/pendapatan_carabayar_rajal_xls.php" method="get">
				 <input type="hidden" name="tgl_kunjungan" id="tgl_kunjungan" value=<?=$tgl_kunjungan?> />
                <input type="hidden" name="tgl_kunjungan2" id="tgl_kunjungan2" value=<?=$tgl_kunjungan2?> />                
                <input type="hidden" name="poly" id="poly" value=<?=$poly?> />                
                   <input type="submit" value="export xls"  />
                </form></p>
</div>
</div></div>
