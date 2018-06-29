<div align="center">
<div id="frame" style="width:100%">
	<div id="frame_title">
	  <h3>Laporan Rekap Pendapatan Unit Pasien Umum</h3></div>
<?php 
require_once("include/connect.php"); 
//echo $password;
//$connect = mysql_connect($hostname, $username, $password,true,65536) or die(mysql_error()); 
mysql_select_db($database,$connect)or die(mysql_error());

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
    <input type="hidden" name="link" value="36k1" /></td>
  </tr>
</table>

    </form>     

<!--<div style="overflow:scroll;width:98%;height:auto;">-->
<!--<table width="148%" style="font-size:9px;" border="0" align="center" class="tb" cellpadding="1" cellspacing="1">-->
<table  style="font-size:9px;" border="0" align="center" class="tb" cellpadding="1" cellspacing="1">
  <tr>
    <th width="33" rowspan="3">Tanggal</th>
    <th colspan="7">Rekap Pendapatan Pasien Umum</th>
    <th width="25" rowspan="3">Total</th>
  </tr>
  <tr>
    <th colspan="7">Unit</th>
    </tr>
  <tr>
    <th>Rawat Jalan</th>
    <th>UGD</th>
    <th>VK</th>
    <th>Rawat Inap</th>
    <th>Laboratorium</th>
    <th>Radiologi</th>
    <th>Kamar Operasi</th>
    </tr>
  <?php  $tot_rajal=0;
		 $tot_ranap=0;
        $tot_ugd=0; 
		$tot_vk=0; 
		$tot_lab=0; 
		$tot_rad=0; 
		$tot_ok=0; 
		
       $sql="call pr_keuangan_pendapatan('$tgl_kunjungan','$tgl_kunjungan2')";
       $rs=mysql_query($sql);
	   $count=0;
	  if(!$rs) die(mysql_error());
       while ($data = mysql_fetch_array($rs)) {
		   $tot_rajal=$tot_rajal+$data['rajal'];		   
		   $tot_ranap=$tot_ranap+$data['ranap'];
		   $tot_ugd=$tot_ugd+$data['ugd'];		   
		   $tot_vk=$tot_vk+$data['vk'];		   
		   $tot_lab=$tot_lab+$data['lab'];		   
		   $tot_rad=$tot_rad+$data['rad'];		   
		   $tot_ok=$tot_ok+$data['ok'];


		   ?>
<tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>    
    <td width="33"><?=$data['TGLBAYAR'];?></td>
    <td width="33" align="right"><?=number_format($data['rajal'],0);?></td>
    <td width="33" align="right"><?=number_format($data['ugd'],0);?></td>
    <td width="33" align="right"><?=number_format($data['vk'],0);?></td>
    <td width="33" align="right"><?=number_format($data['ranap'],0);?></td>
    <td width="33" align="right"><?=number_format($data['lab'],0);?></td>
    <td width="33" align="right"><?=number_format($data['rad'],0);?></td>
    <td width="33" align="right"><?=number_format($data['ok'],0);?></td>
    <td align="right"><?=number_format($data['rajal']+$data['ugd']+$data['vk']+$data['ranap']+$data['lab']+$data['rad']+$data['ok'],0);?></td>
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
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><?=number_format($tot_rajal,0); ?></td>
    <td align="right"><?=number_format($tot_ugd,0); ?></td>
    <td align="right"><?=number_format($tot_vk,0); ?></td>
    <td align="right"><?=number_format($tot_ranap,0); ?></td>    
    <td align="right"><?=number_format($tot_lab,0); ?></td>    
    <td align="right"><?=number_format($tot_rad,0); ?></td>    
    <td align="right"><?=number_format($tot_ok,0); ?></td>    
    <td align="right"><?=number_format($tot_rajal+$tot_ugd+$tot_vk+$tot_ranap+$tot_lab+$tot_rad+$tot_ok,0); ?></td>
  </tr>
</table>
</div>
</div></div>
