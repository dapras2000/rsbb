<?php 

$farmasi = $_SESSION['KDUNIT']; 
if($farmasi=="12"){
	$c = "1";
}else if($farmasi=="13"){
	$c = "0";
}

$bulan = "";
if(!empty($_GET['bulan'])){
	$bulan =$_GET['bulan']; 
} 

$tahun = "";
if(!empty($_GET['tahun'])){
	$tahun =$_GET['tahun']; 
} 

$group = "";
if(!empty($_GET['group'])){
	$group =$_GET['group']; 
} 



$sql="SELECT 
	  view_lap_pemakaian_gas_unit.KDUNIT,
      view_lap_pemakaian_gas_unit.RUANG,
      m_ruang_gas.nama AS NAMARUANG, 
	      SUM(view_lap_pemakaian_gas_unit.GASK01) AS GASK01,
		  SUM(view_lap_pemakaian_gas_unit.GASK02) AS GASK02,
		  SUM(view_lap_pemakaian_gas_unit.GASK03) AS GASK03,
		  SUM(view_lap_pemakaian_gas_unit.GASK04) AS GASK04,
		  SUM(view_lap_pemakaian_gas_unit.GASK05) AS GASK05,
		  SUM(view_lap_pemakaian_gas_unit.GASK06) AS GASK06,
		  SUM(view_lap_pemakaian_gas_unit.GASK07) AS GASK07,
		  SUM(view_lap_pemakaian_gas_unit.GASK08) AS GASK08,
		  SUM(view_lap_pemakaian_gas_unit.GASK09) AS GASK09,
		  SUM(view_lap_pemakaian_gas_unit.GASK10) AS GASK10,
		  SUM(view_lap_pemakaian_gas_unit.GASK11) AS GASK11,
		  SUM(view_lap_pemakaian_gas_unit.GASK12) AS GASK12,
		  SUM(view_lap_pemakaian_gas_unit.GASK13) AS GASK13,
		  SUM(view_lap_pemakaian_gas_unit.GASK14) AS GASK14,
		  SUM(view_lap_pemakaian_gas_unit.GASK15) AS GASK15,
		  SUM(view_lap_pemakaian_gas_unit.GASK16) AS GASK16,
		  SUM(view_lap_pemakaian_gas_unit.GASK17) AS GASK17,
		  SUM(view_lap_pemakaian_gas_unit.GASK18) AS GASK18,
		  SUM(view_lap_pemakaian_gas_unit.GASK19) AS GASK19,
		  SUM(view_lap_pemakaian_gas_unit.GASK20) AS GASK20,
		  SUM(view_lap_pemakaian_gas_unit.GASK21) AS GASK21,
		  SUM(view_lap_pemakaian_gas_unit.GASK22) AS GASK22,
		  SUM(view_lap_pemakaian_gas_unit.GASK23) AS GASK23,
		  SUM(view_lap_pemakaian_gas_unit.GASK24) AS GASK24,
		  SUM(view_lap_pemakaian_gas_unit.GASK25) AS GASK25,
		  SUM(view_lap_pemakaian_gas_unit.GASK26) AS GASK26,
		  SUM(view_lap_pemakaian_gas_unit.GASK27) AS GASK27,
		  SUM(view_lap_pemakaian_gas_unit.GASK28) AS GASK28,
		  SUM(view_lap_pemakaian_gas_unit.GASK29) AS GASK29,
		  SUM(view_lap_pemakaian_gas_unit.GASK30) AS GASK30,
		  SUM(view_lap_pemakaian_gas_unit.GASK31) AS GASK31,
		  SUM(view_lap_pemakaian_gas_unit.GASB01) AS GASB01,
		  SUM(view_lap_pemakaian_gas_unit.GASB02) AS GASB02,
		  SUM(view_lap_pemakaian_gas_unit.GASB03) AS GASB03,
		  SUM(view_lap_pemakaian_gas_unit.GASB04) AS GASB04,
		  SUM(view_lap_pemakaian_gas_unit.GASB05) AS GASB05,
		  SUM(view_lap_pemakaian_gas_unit.GASB06) AS GASB06,
		  SUM(view_lap_pemakaian_gas_unit.GASB07) AS GASB07,
		  SUM(view_lap_pemakaian_gas_unit.GASB08) AS GASB08,
		  SUM(view_lap_pemakaian_gas_unit.GASB09) AS GASB09,
		  SUM(view_lap_pemakaian_gas_unit.GASB10) AS GASB10,
		  SUM(view_lap_pemakaian_gas_unit.GASB11) AS GASB11,
		  SUM(view_lap_pemakaian_gas_unit.GASB12) AS GASB12,
		  SUM(view_lap_pemakaian_gas_unit.GASB13) AS GASB13,
		  SUM(view_lap_pemakaian_gas_unit.GASB14) AS GASB14,
		  SUM(view_lap_pemakaian_gas_unit.GASB15) AS GASB15,
		  SUM(view_lap_pemakaian_gas_unit.GASB16) AS GASB16,
		  SUM(view_lap_pemakaian_gas_unit.GASB17) AS GASB17,
		  SUM(view_lap_pemakaian_gas_unit.GASB18) AS GASB18,
		  SUM(view_lap_pemakaian_gas_unit.GASB19) AS GASB19,
		  SUM(view_lap_pemakaian_gas_unit.GASB20) AS GASB20,
		  SUM(view_lap_pemakaian_gas_unit.GASB21) AS GASB21,
		  SUM(view_lap_pemakaian_gas_unit.GASB22) AS GASB22,
		  SUM(view_lap_pemakaian_gas_unit.GASB23) AS GASB23,
		  SUM(view_lap_pemakaian_gas_unit.GASB24) AS GASB24,
		  SUM(view_lap_pemakaian_gas_unit.GASB25) AS GASB25,
		  SUM(view_lap_pemakaian_gas_unit.GASB26) AS GASB26,
		  SUM(view_lap_pemakaian_gas_unit.GASB27) AS GASB27,
		  SUM(view_lap_pemakaian_gas_unit.GASB28) AS GASB28,
		  SUM(view_lap_pemakaian_gas_unit.GASB29) AS GASB29,
		  SUM(view_lap_pemakaian_gas_unit.GASB30) AS GASB30,
		  SUM(view_lap_pemakaian_gas_unit.GASB31) AS GASB31,
		  view_lap_pemakaian_gas_unit.TAHUN,
		  view_lap_pemakaian_gas_unit.BULAN
          
 
FROM
  m_ruang_gas
  LEFT JOIN view_lap_pemakaian_gas_unit ON view_lap_pemakaian_gas_unit.RUANG = m_ruang_gas.`no`
  AND view_lap_pemakaian_gas_unit.TAHUN ='".$tahun."' AND view_lap_pemakaian_gas_unit.BULAN = '".$bulan."'
  
 
GROUP BY view_lap_pemakaian_gas_unit.KDUNIT,
      view_lap_pemakaian_gas_unit.RUANG,
      m_ruang_gas.nama , 
      view_lap_pemakaian_gas_unit.TAHUN,
		  view_lap_pemakaian_gas_unit.BULAN";

$qry_order = mysql_query($sql);
$order = mysql_fetch_assoc($qry_order);

?>
<div id="addbarang"></div>
<div align="center">
    <div id="frame" style="width:100%">
<? switch ($bulan)
{
	case "1" :
	$bulan_name = "Januari";
	break;
	case "2" :
	$bulan_name = "Pebruari";
	break;
	case "3" :
	$bulan_name = "Maret";
	break;
	case "4" :
	$bulan_name = "April";
	break;
	case "5" :
	$bulan_name = "Mei";
	break;
	case "6" :
	$bulan_name = "Juni";
	break;
	case "7" :
	$bulan_name = "Juli";
	break;
	case "8" :
	$bulan_name = "Agustus";
	break;
	case "9" :
	$bulan_name = "September";
	break;
	case "10" :
	$bulan_name = "Oktober";
	break;
	case "11" :
	$bulan_name = "Nopember";
	break;
	case "12" :
	$bulan_name = "Desember";
	break;
}
?>    
    
    <div id="frame_title"><h3>LAPORAN PENERIMAAN & PENGELUARAN BARANG BULAN <?=$bulan_name?> TAHUN <?=$tahun?></h3></div>
    <div style="margin:5px;"> 
        <div id="table_search">
 <div style="overflow:scroll;width:98%;height:auto;" >     
 <table border="0" cellspacing="1" cellpadding="1" bordercolor="#999999" class="tb" width="95%" >
  <tr>
    <th rowspan="3" width="10%"><div align="center">NAMA RUANGAN</div></th>
    <th colspan="62"><div align="center">TANGGAL
      </div></th>
    <th colspan="2" rowspan="2"><div align="center">JUMLAH (Rp)</div></th>
  </tr>
  <tr>
    <th colspan="2"><div align="center">01</div></th>
    <th colspan="2"><div align="center">02</div></th>
    <th colspan="2"><div align="center">03</div></th>
    <th colspan="2"><div align="center">04</div></th>
    <th colspan="2"><div align="center">05</div></th>
    <th colspan="2"><div align="center">06</div></th>
    <th colspan="2" ><div align="center">07</div></th>
    <th colspan="2"><div align="center">08</div></th>
    <th colspan="2"><div align="center">09</div></th>
    <th colspan="2"><div align="center">10</div></th>
    <th colspan="2"><div align="center">11</div></th>
    <th colspan="2"><div align="center">12</div></th>
    <th colspan="2"><div align="center">13</div></th>
    <th colspan="2"><div align="center">14</div></th>
    <th colspan="2"><div align="center">15</div></th>
    <th colspan="2"><div align="center">16</div></th>
    <th colspan="2"><div align="center">17</div></th>
    <th colspan="2"><div align="center">18</div></th>
    <th colspan="2"><div align="center">19</div></th>
    <th colspan="2"><div align="center">20</div></th>
    <th colspan="2"><div align="center">21</div></th>
    <th colspan="2"><div align="center">22</div></th>
    <th colspan="2"><div align="center">23</div></th>
    <th colspan="2"><div align="center">24</div></th>
    <th colspan="2"><div align="center">25</div></th>
    <th colspan="2"><div align="center">26</div></th>
    <th colspan="2"><div align="center">27</div></th>
    <th colspan="2"><div align="center">28</div></th>
    <th colspan="2"><div align="center">29</div></th>
    <th colspan="2"><div align="center">30</div></th>
    <th colspan="2"><div align="center">31</div></th>
    </tr>
  <tr>
    <th>B</th>
    <th>K</th>
    <th>B</th>
    <th>K</th>
    <th>B</th>
    <th>K</th>
    <th>B</th>
    <th>K</th>
     <th>B</th>
     <th>K</th>
      <th>B</th>
      <th>K</th>
       <th>B</th>
      <th>K</th>
        <th>B</th>
      <th>K</th>
         <th>B</th>
      <th>K</th>
          <th>B</th>
      <th>K</th>
           <th>B</th>
      <th>K</th>
            <th>B</th>
      <th>K</th>
             <th>B</th>
      <th>K</th>
              <th>B</th>
      <th>K</th>
               <th>B</th>
      <th>K</th>
               <th>B</th>
      <th>K</th>
               <th>B</th>
      <th>K</th>
                 <th>B</th>
      <th>K</th>
                <th>B</th>
      <th>K</th>
                  <th>B</th>
      <th>K</th>
                   <th>B</th>
      <th>K</th>
                   <th>B</th>
      <th>K</th>
                      <th>B</th>
      <th>K</th>
                       <th>B</th>
      <th>K</th>
                       <th>B</th>
      <th>K</th>
                        <th>B</th>
      <th>K</th>
                        <th>B</th>
      <th>K</th>
                          <th>B</th>
      <th>K</th>
                         <th>B</th>
      <th>K</th><th>B</th>
      <th>K</th>
                           <th>B</th>
      <th>K</th>
      <th>B</th>
      <th>K</th>
  </tr>
<?
				
	$pager = new PS_Pagination($connect, $sql, 50, 5, "bulan=".$bulan."&tahun=".$tahun."&group=".$group, "index.php?link=g02&");
	
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	$x= 1;
	while($data = mysql_fetch_array($rs)) {?>
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
            
            <td width="10%"><?=$data['NAMARUANG']?></td>
            <td align="right"><?=$data['GASB01']?></td>
            <td align="right"><?=$data['GASK01']?></td>
            <td align="right"><?=$data['GASB02']?></td>
            <td align="right"><?=$data['GASK02']?></td>
            <td align="right"><?=$data['GASB03']?></td>
            <td align="right"><?=$data['GASK03']?></td>
            <td align="right"><?=$data['GASB04']?></td>
            <td align="right"><?=$data['GASK04']?></td>
            <td align="right"><?=$data['GASB05']?></td>
            <td align="right"><?=$data['GASK05']?></td>
            <td align="right"><?=$data['GASB06']?></td>
            <td align="right"><?=$data['GASK06']?></td>
            <td align="right"><?=$data['GASB07']?></td>
            <td align="right"><?=$data['GASK07']?></td>
            <td align="right"><?=$data['GASB08']?></td>
            <td align="right"><?=$data['GASK08']?></td>
            <td align="right"><?=$data['GASB09']?></td>
            <td align="right"><?=$data['GASK09']?></td>
            <td align="right"><?=$data['GASB10']?></td>
            <td align="right"><?=$data['GASK10']?></td>
            <td align="right"><?=$data['GASB11']?></td>
            <td align="right"><?=$data['GASK11']?></td>
            <td align="right"><?=$data['GASB12']?></td>
            <td align="right"><?=$data['GASK12']?></td>
            <td align="right"><?=$data['GASB13']?></td>
            <td align="right"><?=$data['GASK13']?></td>
            <td align="right"><?=$data['GASB14']?></td>
            <td align="right"><?=$data['GASK14']?></td>
            <td align="right"><?=$data['GASB15']?></td>
            <td align="right"><?=$data['GASK15']?></td>
            <td align="right"><?=$data['GASB16']?></td>
            <td align="right"><?=$data['GASK16']?></td>
            <td align="right"><?=$data['GASB17']?></td>
            <td align="right"><?=$data['GASK17']?></td>
            <td align="right"><?=$data['GASB18']?></td>
            <td align="right"><?=$data['GASK18']?></td>
            <td align="right"><?=$data['GASB19']?></td>
            <td align="right"><?=$data['GASK19']?></td>
            <td align="right"><?=$data['GASB20']?></td>
            <td align="right"><?=$data['GASK20']?></td>
            <td align="right"><?=$data['GASB21']?></td>
            <td align="right"><?=$data['GASK21']?></td>
            <td align="right"><?=$data['GASB22']?></td>
            <td align="right"><?=$data['GASK22']?></td>
            <td align="right"><?=$data['GASB23']?></td>
            <td align="right"><?=$data['GASK23']?></td>
            <td align="right"><?=$data['GASB24']?></td>
            <td align="right"><?=$data['GASK24']?></td>
            <td align="right"><?=$data['GASB25']?></td>
            <td align="right"><?=$data['GASK25']?></td>
            <td align="right"><?=$data['GASB26']?></td>
            <td align="right"><?=$data['GASK26']?></td>
            <td align="right"><?=$data['GASB27']?></td>
            <td align="right"><?=$data['GASK27']?></td>
            <td align="right"><?=$data['GASB28']?></td>
            <td align="right"><?=$data['GASK28']?></td>
            <td align="right"><?=$data['GASB29']?></td>
            <td align="right"><?=$data['GASK29']?></td>
            <td align="right"><?=$data['GASB30']?></td>
            <td align="right"><?=$data['GASK30']?></td>
            <td align="right"><?=$data['GASB31']?></td>
            <td align="right"><?=$data['GASK31']?></td>
 
 <? $jml_gasbesar = $data['GASB01'] + $data['GASB02'] + $data['GASB03'] + $data['GASB04'] + $data['GASB05'] + $data['GASB06'] + $data['GASB07'] + $data['GASB08'] + $data['GASB09'] + $data['GASB10'] + $data['GASB11'] + $data['GASB12'] + $data['GASB13'] + $data['GASB14'] + $data['GASB15'] + $data['GASB16'] + $data['GASB17'] + $data['GASB18'] + $data['GASB19'] + $data['GASB20'] + $data['GASB21'] + $data['GASB22'] + $data['GASB23'] + $data['GASB24'] + $data['GASB25'] + $data['GASB26'] + $data['GASB27'] + $data['GASB28'] + $data['GASB29'] + $data['GASB30'] + $data['GASB31']?>
 
<? $jml_gaskecil = $data['GASK01'] + $data['GASK02'] + $data['GASK03'] + $data['GASK04'] + $data['GASK05'] + $data['GASK06'] + $data['GASK07'] + $data['GASK08'] + $data['GASK09'] + $data['GASK10'] + $data['GASK11'] + $data['GASK12'] + $data['GASK13'] + $data['GASK14'] + $data['GASK15'] + $data['GASK16'] + $data['GASK17'] + $data['GASK18'] + $data['GASK19'] + $data['GASK20'] + $data['GASK21'] + $data['GASK22'] + $data['GASK23'] + $data['GASK24'] + $data['GASK25'] + $data['GASK26'] + $data['GASK27'] + $data['GASK28'] + $data['GASK29'] + $data['GASK30'] + $data['GASK31']?>       
            
            <td align="right"><?=$jml_gasbesar?></td>
            <td align="right"><?=$jml_gaskecil?></td>
            </tr>
	 <?	$x++;} ?>
     </table>
     </div>
  <?   
	
	//Display the full navigation in one go
	//echo $pager->renderFullNav();
	
	//Or you can display the inidividual links
	echo "<div style='padding:5px;' align=\"center\"><br />";
	
	//Display the link to first page: First
	echo $pager->renderFirst()." | ";
	
	//Display the link to previous page: <<
	echo $pager->renderPrev()." | ";
	
	//Display page links: 1 2 3
	echo $pager->renderNav()." | ";
	
	//Display the link to next page: >>
	echo $pager->renderNext()." | ";
	
	//Display the link to last page: Last
	echo $pager->renderLast();
	
	echo "</div>";
?>
  
        
        </div>
    </div>
</div>
</div>
<br />
<? 
$sql_stok_ob = "SELECT (SELECT '".$tahun."-".$bl."-01' - INTERVAL 1 MONTH) AS LASTDATE, 
		(SELECT saldo FROM t_barang_stok WHERE kode_barang = 1097 AND YEAR(tanggal) = YEAR(LASTDATE) AND MONTH(tanggal) = MONTH(LASTDATE) AND KDUNIT =".$farmasi."																																				 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAWAL,
		(SELECT saldo FROM t_barang_stok WHERE kode_barang = 1097 AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) = '".$bulan."' 
 AND KDUNIT =".$farmasi."																																				 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1) AS STOKAKHIR";
$get_stok_ob = mysql_query($sql_stok_ob);
$dat_stok_ob = mysql_fetch_assoc($get_stok_ob);


$sql_stok_ok = "SELECT (SELECT '".$tahun."-".$bl."-01' - INTERVAL 1 MONTH) AS LASTDATE, 
		(SELECT saldo FROM t_barang_stok WHERE kode_barang = 1097 AND YEAR(tanggal) = YEAR(LASTDATE) AND MONTH(tanggal) = MONTH(LASTDATE) AND KDUNIT =".$farmasi."																																				 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAWAL,
		(SELECT saldo FROM t_barang_stok WHERE kode_barang = 1097 AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) = '".$bulan."' 
 AND KDUNIT =".$farmasi."																																				 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1) AS STOKAKHIR";
$get_stok_ok = mysql_query($sql_stok_ok);
$dat_stok_ok = mysql_fetch_assoc($get_stok_ok);

$sql_terima_ob = "SELECT sum(jmlterima) AS JMLTERIMA from view_lap_penerimaan_gas where kode_barang = 1097
 AND KDUNIT = ".$farmasi." AND TAHUN='".$tahun."' AND BULAN ='".$bulan."'";
$get_terima_ob = mysql_query($sql_terima_ob);
$dat_terima_ob = mysql_fetch_assoc($get_terima_ob);

$sql_terima_ok = "SELECT sum(jmlterima) AS JMLTERIMA  from view_lap_penerimaan_gas where kode_barang = 1101
 AND KDUNIT = ".$farmasi." AND TAHUN='".$tahun."' AND BULAN ='".$bulan."'";
$get_terima_ok = mysql_query($sql_terima_ok);
$dat_terima_ok = mysql_fetch_assoc($get_terima_ok);
?>
<table class="tb" align="center"> 
<tr>
 <th>Nama Barang</th>
  <th>Stok Awal</th>
  <th>Penerimaan</th>
   <th>Jumlah</th>
    <th>Pengeluaran</th>
     <th>Stok Akhir</th>
</tr>
<tr class="tr1">
 <td>O2 Besar</td>
 <td align="right"><?=$dat_stok_ob['STOKAWAL']?> </td>
 <td align="right"><?=$dat_terima_ob['JMLTERIMA']?> </td>
 <td align="right"><?=$dat_stok_ob['STOKAWAL'] + $dat_terima_ob['JMLTERIMA']?></td>
 <td align="right"><?=$jml_gasbesar?></td>
 <td align="right"><?=$dat_stok_ob['STOKAKHIR']?> </td>
</tr>
<tr class="tr2">
 <td>O2 Kecil</td>
 <td align="right"><?=$dat_stok_ok['STOKAWAL']?> </td>
 <td align="right"><?=$dat_terima_ok['JMLTERIMA']?> </td>
 <td align="right"><?=$dat_stok_ok['STOKAWAL'] + $dat_terima_ok['JMLTERIMA']?></td>
 <td align="right"><?=$jml_gaskecil?></td>
 <td align="right"><?=$dat_stok_ok['STOKAKHIR']?> </td>
</tr> 
</table>
<br />
<div id="msg" >
<?
$sql_excel = "SELECT m_ruang_gas.nama AS NAMARUANG, 
	      SUM(view_lap_pemakaian_gas_unit.GASK01) AS K_01,
		  SUM(view_lap_pemakaian_gas_unit.GASB01) AS B_01,
		  SUM(view_lap_pemakaian_gas_unit.GASK02) AS K_02,
		  SUM(view_lap_pemakaian_gas_unit.GASB02) AS B_02,
		  SUM(view_lap_pemakaian_gas_unit.GASK03) AS K_03,
		  SUM(view_lap_pemakaian_gas_unit.GASB03) AS B_03,
		  SUM(view_lap_pemakaian_gas_unit.GASK04) AS K_04,
		  SUM(view_lap_pemakaian_gas_unit.GASB04) AS B_04,
		  SUM(view_lap_pemakaian_gas_unit.GASK05) AS K_05,
		  SUM(view_lap_pemakaian_gas_unit.GASB05) AS B_05,
		  SUM(view_lap_pemakaian_gas_unit.GASK06) AS K_06,
		  SUM(view_lap_pemakaian_gas_unit.GASB06) AS B_06,
		  SUM(view_lap_pemakaian_gas_unit.GASK07) AS K_07,
		  SUM(view_lap_pemakaian_gas_unit.GASB07) AS B_07,
		  SUM(view_lap_pemakaian_gas_unit.GASK08) AS K_08,
		  SUM(view_lap_pemakaian_gas_unit.GASB08) AS K_08,
		  SUM(view_lap_pemakaian_gas_unit.GASK09) AS K_09,
		  SUM(view_lap_pemakaian_gas_unit.GASB09) AS B_09,
		  SUM(view_lap_pemakaian_gas_unit.GASK10) AS K_10,
		  SUM(view_lap_pemakaian_gas_unit.GASB10) AS B_10,
		  SUM(view_lap_pemakaian_gas_unit.GASK11) AS K_11,
		  SUM(view_lap_pemakaian_gas_unit.GASB11) AS B_11,
		  SUM(view_lap_pemakaian_gas_unit.GASK12) AS K_12,
		  SUM(view_lap_pemakaian_gas_unit.GASB12) AS B_12,
		  SUM(view_lap_pemakaian_gas_unit.GASK13) AS K_13,
		  SUM(view_lap_pemakaian_gas_unit.GASB13) AS B_13,
		  SUM(view_lap_pemakaian_gas_unit.GASK14) AS K_14,
		  SUM(view_lap_pemakaian_gas_unit.GASB14) AS B_14,
		  SUM(view_lap_pemakaian_gas_unit.GASK15) AS K_15,
		  SUM(view_lap_pemakaian_gas_unit.GASB15) AS B_15,
		  SUM(view_lap_pemakaian_gas_unit.GASK16) AS K_16,
		  SUM(view_lap_pemakaian_gas_unit.GASB16) AS B_16,
		  SUM(view_lap_pemakaian_gas_unit.GASK17) AS K_17,
		  SUM(view_lap_pemakaian_gas_unit.GASB17) AS B_17,
		  SUM(view_lap_pemakaian_gas_unit.GASK18) AS K_18,
		  SUM(view_lap_pemakaian_gas_unit.GASB18) AS B_18,
		  SUM(view_lap_pemakaian_gas_unit.GASK19) AS K_19,
		  SUM(view_lap_pemakaian_gas_unit.GASB19) AS B_19,
		  SUM(view_lap_pemakaian_gas_unit.GASK20) AS K_20,
		  SUM(view_lap_pemakaian_gas_unit.GASB20) AS B_20,
		  SUM(view_lap_pemakaian_gas_unit.GASK21) AS K_21,
		  SUM(view_lap_pemakaian_gas_unit.GASB21) AS B_21,
		  SUM(view_lap_pemakaian_gas_unit.GASK22) AS K_22,
		  SUM(view_lap_pemakaian_gas_unit.GASB22) AS B_22,
		  SUM(view_lap_pemakaian_gas_unit.GASK23) AS K_23,
		  SUM(view_lap_pemakaian_gas_unit.GASB23) AS B_23,
		  SUM(view_lap_pemakaian_gas_unit.GASK24) AS K_24,
		  SUM(view_lap_pemakaian_gas_unit.GASB24) AS B_24,
		  SUM(view_lap_pemakaian_gas_unit.GASK25) AS K_25,
		  SUM(view_lap_pemakaian_gas_unit.GASB25) AS B_25,
		  SUM(view_lap_pemakaian_gas_unit.GASK26) AS K_26,
		  SUM(view_lap_pemakaian_gas_unit.GASB26) AS B_26,
		  SUM(view_lap_pemakaian_gas_unit.GASK27) AS K_27,
		  SUM(view_lap_pemakaian_gas_unit.GASB27) AS B_27,
		  SUM(view_lap_pemakaian_gas_unit.GASK28) AS K_28,
		  SUM(view_lap_pemakaian_gas_unit.GASB28) AS B_28,
		  SUM(view_lap_pemakaian_gas_unit.GASK29) AS K_29,
		  SUM(view_lap_pemakaian_gas_unit.GASB29) AS B_29,
		  SUM(view_lap_pemakaian_gas_unit.GASK30) AS K_30,
		  SUM(view_lap_pemakaian_gas_unit.GASB30) AS B_30,
		  SUM(view_lap_pemakaian_gas_unit.GASK31) AS K_31,
		  SUM(view_lap_pemakaian_gas_unit.GASB31) AS B_31,
		  
		  SUM(view_lap_pemakaian_gas_unit.GASK01) +
		  SUM(view_lap_pemakaian_gas_unit.GASK02) +
		  SUM(view_lap_pemakaian_gas_unit.GASK03) +
		  SUM(view_lap_pemakaian_gas_unit.GASK04) +
		  SUM(view_lap_pemakaian_gas_unit.GASK05) +
		  SUM(view_lap_pemakaian_gas_unit.GASK06) +
		  SUM(view_lap_pemakaian_gas_unit.GASK07) +
		  SUM(view_lap_pemakaian_gas_unit.GASK08) +
		  SUM(view_lap_pemakaian_gas_unit.GASK09) +
		  SUM(view_lap_pemakaian_gas_unit.GASK10) +
		  SUM(view_lap_pemakaian_gas_unit.GASK11) +
		  SUM(view_lap_pemakaian_gas_unit.GASK12) +
		  SUM(view_lap_pemakaian_gas_unit.GASK13) +
		  SUM(view_lap_pemakaian_gas_unit.GASK14) +
		  SUM(view_lap_pemakaian_gas_unit.GASK15) +
		  SUM(view_lap_pemakaian_gas_unit.GASK16) +
		  SUM(view_lap_pemakaian_gas_unit.GASK17) +
		  SUM(view_lap_pemakaian_gas_unit.GASK18) +
		  SUM(view_lap_pemakaian_gas_unit.GASK19) +
		  SUM(view_lap_pemakaian_gas_unit.GASK20) +
		  SUM(view_lap_pemakaian_gas_unit.GASK21) +
		  SUM(view_lap_pemakaian_gas_unit.GASK22) +
		  SUM(view_lap_pemakaian_gas_unit.GASK23) +
		  SUM(view_lap_pemakaian_gas_unit.GASK24) +
		  SUM(view_lap_pemakaian_gas_unit.GASK25) +
		  SUM(view_lap_pemakaian_gas_unit.GASK26) +
		  SUM(view_lap_pemakaian_gas_unit.GASK27) +
		  SUM(view_lap_pemakaian_gas_unit.GASK28) +
		  SUM(view_lap_pemakaian_gas_unit.GASK29) +
		  SUM(view_lap_pemakaian_gas_unit.GASK30) +
		  SUM(view_lap_pemakaian_gas_unit.GASK31) AS K_JUMLAH,
		  
		  SUM(view_lap_pemakaian_gas_unit.GASB01) +
		  SUM(view_lap_pemakaian_gas_unit.GASB02) +
		  SUM(view_lap_pemakaian_gas_unit.GASB03) +
		  SUM(view_lap_pemakaian_gas_unit.GASB04) +
		  SUM(view_lap_pemakaian_gas_unit.GASB05) +
		  SUM(view_lap_pemakaian_gas_unit.GASB06) +
		  SUM(view_lap_pemakaian_gas_unit.GASB07) +
		  SUM(view_lap_pemakaian_gas_unit.GASB08) +
		  SUM(view_lap_pemakaian_gas_unit.GASB09) +
		  SUM(view_lap_pemakaian_gas_unit.GASB10) +
		  SUM(view_lap_pemakaian_gas_unit.GASB11) +
		  SUM(view_lap_pemakaian_gas_unit.GASB12) +
		  SUM(view_lap_pemakaian_gas_unit.GASB13) +
		  SUM(view_lap_pemakaian_gas_unit.GASB14) +
		  SUM(view_lap_pemakaian_gas_unit.GASB15) +
		  SUM(view_lap_pemakaian_gas_unit.GASB16) +
		  SUM(view_lap_pemakaian_gas_unit.GASB17) +
		  SUM(view_lap_pemakaian_gas_unit.GASB18) +
		  SUM(view_lap_pemakaian_gas_unit.GASB19) +
		  SUM(view_lap_pemakaian_gas_unit.GASB20) +
		  SUM(view_lap_pemakaian_gas_unit.GASB21) +
		  SUM(view_lap_pemakaian_gas_unit.GASB22) +
		  SUM(view_lap_pemakaian_gas_unit.GASB23) +
		  SUM(view_lap_pemakaian_gas_unit.GASB24) +
		  SUM(view_lap_pemakaian_gas_unit.GASB25) +
		  SUM(view_lap_pemakaian_gas_unit.GASB26) +
		  SUM(view_lap_pemakaian_gas_unit.GASB27) +
		  SUM(view_lap_pemakaian_gas_unit.GASB28) +
		  SUM(view_lap_pemakaian_gas_unit.GASB29) +
		  SUM(view_lap_pemakaian_gas_unit.GASB30) +
		  SUM(view_lap_pemakaian_gas_unit.GASB31) AS B_JUMLAH
FROM
  m_ruang_gas
  LEFT JOIN view_lap_pemakaian_gas_unit ON view_lap_pemakaian_gas_unit.RUANG = m_ruang_gas.`no`
  AND view_lap_pemakaian_gas_unit.TAHUN ='".$tahun."' AND view_lap_pemakaian_gas_unit.BULAN = '".$bulan."'
  
 
GROUP BY view_lap_pemakaian_gas_unit.KDUNIT,
      view_lap_pemakaian_gas_unit.RUANG,
      m_ruang_gas.nama , 
      view_lap_pemakaian_gas_unit.TAHUN,
		  view_lap_pemakaian_gas_unit.BULAN";
?>
<form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
<input type="hidden" name="query" value="<?=$sql_excel?>" />
<input type="hidden" name="header" value="LAPORAN PENERIMAAN & PENGELUARAN GAS BULAN <?=$bulan_name." ".$tahun?>" />
<input type="hidden" name="filename" value="laporan_bulanan" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
</div>
<p></p>

