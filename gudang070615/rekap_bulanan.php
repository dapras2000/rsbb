<?php 
session_start();
include("./include/connect.php");
include('./gudang/ps_pagination.php');

$farmasi = $_SESSION['KDUNIT']; 
if($farmasi=="12"){
	$c = "1";
}else if($farmasi=="13"){
	$c = "0";
}
	
$tahun = "";
if(!empty($_GET['tahun'])){
	$tahun =$_GET['tahun']; 
} 


$group = "";
if(!empty($_GET['group'])){
	$group =$_GET['group']; 
} 

$nm_barang = "";
if(!empty($_GET['nm_barang'])){
	$nm_barang =$_GET['nm_barang'];
} 

if(!empty($nm_barang)){
	$search = " AND m_barang.nama_barang like '".$nm_barang."%'";
}

if(strlen($bulan)==1){
 $bl = "0".$bulan;
}else{
 $bl = $bulan;
}

$sql="SELECT 
	  m_barang.hide_when_print,
	  m_barang.kode_barang,
	  m_barang.nama_barang,
	  m_barang.satuan,
	  m_barang.harga,
	  (SELECT '".$tahun."-01-01' - INTERVAL 1 YEAR) AS LASTDATE,  
		(SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = YEAR(LASTDATE)																																				 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAWAL, 
	      vew_lap_gudang_bulanan_2.APBD101,
		  vew_lap_gudang_bulanan_2.APBD102,
		  vew_lap_gudang_bulanan_2.APBD103,
		  vew_lap_gudang_bulanan_2.APBD104,
		  vew_lap_gudang_bulanan_2.APBD105,
		  vew_lap_gudang_bulanan_2.APBD106,
		  vew_lap_gudang_bulanan_2.APBD107,
		  vew_lap_gudang_bulanan_2.APBD108,
		  vew_lap_gudang_bulanan_2.APBD109,
		  vew_lap_gudang_bulanan_2.APBD110,
		  vew_lap_gudang_bulanan_2.APBD111,
		  vew_lap_gudang_bulanan_2.APBD112,
		  vew_lap_gudang_bulanan_2.APBD201,
		  vew_lap_gudang_bulanan_2.APBD202,
		  vew_lap_gudang_bulanan_2.APBD203,
		  vew_lap_gudang_bulanan_2.APBD204,
		  vew_lap_gudang_bulanan_2.APBD205,
		  vew_lap_gudang_bulanan_2.APBD206,
		  vew_lap_gudang_bulanan_2.APBD207,
		  vew_lap_gudang_bulanan_2.APBD208,
		  vew_lap_gudang_bulanan_2.APBD209,
		  vew_lap_gudang_bulanan_2.APBD210,
		  vew_lap_gudang_bulanan_2.APBD211,
		  vew_lap_gudang_bulanan_2.APBD212,
		  vew_lap_gudang_bulanan_2.APBN01,
		  vew_lap_gudang_bulanan_2.APBN02,
		  vew_lap_gudang_bulanan_2.APBN03,
		  vew_lap_gudang_bulanan_2.APBN04,
		  vew_lap_gudang_bulanan_2.APBN05,
		  vew_lap_gudang_bulanan_2.APBN06,
		  vew_lap_gudang_bulanan_2.APBN07,
		  vew_lap_gudang_bulanan_2.APBN08,
		  vew_lap_gudang_bulanan_2.APBN09,
		  vew_lap_gudang_bulanan_2.APBN10,
		  vew_lap_gudang_bulanan_2.APBN11,
		  vew_lap_gudang_bulanan_2.APBN12,
		  vew_lap_gudang_bulanan_2.LAINLAIN01,
		  vew_lap_gudang_bulanan_2.LAINLAIN02,
		  vew_lap_gudang_bulanan_2.LAINLAIN03,
		  vew_lap_gudang_bulanan_2.LAINLAIN04,
		  vew_lap_gudang_bulanan_2.LAINLAIN05,
		  vew_lap_gudang_bulanan_2.LAINLAIN06,
		  vew_lap_gudang_bulanan_2.LAINLAIN07,
		  vew_lap_gudang_bulanan_2.LAINLAIN08,
		  vew_lap_gudang_bulanan_2.LAINLAIN09,
		  vew_lap_gudang_bulanan_2.LAINLAIN10,
		  vew_lap_gudang_bulanan_2.LAINLAIN11,
		  vew_lap_gudang_bulanan_2.LAINLAIN12,
		  vew_lap_gudang_bulanan_2.JAN,
		  vew_lap_gudang_bulanan_2.PEB,
		  vew_lap_gudang_bulanan_2.MAR,
		  vew_lap_gudang_bulanan_2.APR,
		  vew_lap_gudang_bulanan_2.MEI,
		  vew_lap_gudang_bulanan_2.JUN,
		  vew_lap_gudang_bulanan_2.JUL,
		  vew_lap_gudang_bulanan_2.AGU,
		  vew_lap_gudang_bulanan_2.SEP,
		  vew_lap_gudang_bulanan_2.OKT,
		  vew_lap_gudang_bulanan_2.NOP,
		  vew_lap_gudang_bulanan_2.DES,
	  	  vew_lap_gudang_bulanan_2.TAHUN,
	  (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' 
 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR  
FROM
  m_barang LEFT JOIN vew_lap_gudang_bulanan_2 ON m_barang.kode_barang=vew_lap_gudang_bulanan_2.KODE AND TAHUN = '".$tahun."' 
WHERE  m_barang.group_barang = '".$group."' 
AND m_barang.farmasi = '".$c."'
".$search;

$qry_order = mysql_query($sql);
$order = mysql_fetch_assoc($qry_order);
?>
<div id="addbarang"></div>
<div align="center">
    <div id="frame" style="width:100%">
    <div id="frame_title"><h3>LAPORAN PENERIMAAN & PENGELUARAN BARANG TAHUN <?=$tahun?></h3></div>
    <div align="center" style="margin:5px;"> 
        <div id="table_search">
  <div style="overflow:scroll;width:98%;height:auto;" >     
  <table border="0" cellspacing="1" cellpadding="1" bordercolor="#999999" class="tb" width="99%">
  <tr>
    <th rowspan="3"><div align="center">KODE</div></th>
 
    <th rowspan="3" width="20%"><div align="center">NAMA BARANG</div></th>
    <th rowspan="3"><div align="center">SATUAN</div></th>
    <th rowspan="3"><div align="center">STOK TAHUN LALU</div></th>
    <th colspan="15"><div align="center">PENERIMAAN</div></th>
    <th colspan="13" rowspan="2"><div align="center">PENGELUARAN</div></th>
  </tr>
  <tr>
    <th colspan="12">APBD II</th>
    <th rowspan="2">APBN</th>
    <th rowspan="2">LAIN - LAIN</th>
    <th rowspan="2">JUMLAH</th>
  </tr>
  <tr>
    <th>JAN</th>
    <th>PEB</th>
    <th>MAR</th>
    <th>APR</th>
    <th>MEI</th>
    <th>JUN</th>
    <th>JUL</th>
    <th>AGU</th>
    <th>SEP</th>
    <th>OKT</th>
    <th>NOP</th>
    <th>DES</th>
    <th>JAN</th>
    <th>PEB</th>
    <th>MAR</th>
    <th>APR</th>
    <th>MEI</th>
    <th>JUN</th>
    <th>JUL</th>
    <th>AGU</th>
    <th>SEP</th>
    <th>OKT</th>
    <th>NOP</th>
    <th>DES</th>
    <th>JUMLAH</th>
  </tr>
<?
				
	$pager = new PS_Pagination($connect, $sql, 15, 5, "bulan=".$bulan."&tahun=".$tahun."&group=".$group."&nm_barang=".$nm_barang, "index.php?link=g03&");
	
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
            
            
            <td><?=$data['kode_barang']?></td>
  
            <td width="20%"><?=$data['nama_barang']?></td>
            <td><?=$data['satuan']?></td>
            <td align="right"><? if($data['STOKAWAL']==""){ echo "0";
			}else{ echo $data['STOKAWAL']; }?></td>
            
            <td align="right"><?=$data['APBD201']?></td>
            <td align="right"><?=$data['APBD202']?></td>
            <td align="right"><?=$data['APBD203']?></td>
            <td align="right"><?=$data['APBD204']?></td>
            <td align="right"><?=$data['APBD205']?></td>
            <td align="right"><?=$data['APBD206']?></td>
            <td align="right"><?=$data['APBD207']?></td>
            <td align="right"><?=$data['APBD208']?></td>
            <td align="right"><?=$data['APBD209']?></td>
            <td align="right"><?=$data['APBD210']?></td>
            <td align="right"><?=$data['APBD211']?></td>
            <td align="right"><?=$data['APBD212']?></td>
            
<? $_apbd2 = $data['APBD201'] + $data['APBD202'] + $data['APBD203'] + $data['APBD204'] + $data['APBD205'] + $data['APBD206'] + $data['APBD207'] + $data['APBD208'] + $data['APBD209'] + $data['APBD210'] + $data['APBD211'] + $data['APBD212']?>            
            
<? $_apbn =  $data['APBN01'] + $data['APBN02'] + $data['APBN03'] + $data['APBN04'] + $data['APBN05'] + $data['APBN06'] + $data['APBN07'] + $data['APBN08'] + $data['APBN09'] + $data['APBN10'] + $data['APBN11'] + $data['APBN12']?>            
            <td align="right"><?=$_apbn?></td>
            
<? $_lainlain = $data['LAINLAIN01'] + $data['LAINLAIN02'] + $data['LAINLAIN03'] + $data['LAINLAIN04'] + $data['LAINLAIN05'] + $data['LAINLAIN06'] + $data['LAINLAIN07'] + $data['LAINLAIN08'] + $data['LAINLAIN09'] + $data['LAINLAIN10'] + $data['LAINLAIN11'] + $data['LAINLAIN12']?>            
            <td align="right"><?=$_lainlain?></td>
            <td align="right"><?=$_apbd2 + $_apbn + $_lainlain?></td>
            <td align="right"><?=$data['JAN']?></td>
            <td align="right"><?=$data['PEB']?></td>
            <td align="right"><?=$data['MAR']?></td>
            <td align="right"><?=$data['APR']?></td>
            <td align="right"><?=$data['MEI']?></td>
            <td align="right"><?=$data['JUN']?></td>
            <td align="right"><?=$data['JUL']?></td>
            <td align="right"><?=$data['AGU']?></td>
            <td align="right"><?=$data['SEP']?></td>
            <td align="right"><?=$data['OKT']?></td>
            <td align="right"><?=$data['NOP']?></td>
            <td align="right"><?=$data['DES']?></td>
<? $pengeluaran = $data['JAN'] + $data['PEB'] + $data['MAR'] + $data['APR'] + $data['MEI'] + $data['JUN'] + $data['JUL'] + $data['AGU'] + $data['SEP'] + $data['OKT'] + $data['NOP'] + $data['DES']?>             
            
            <td align="right"><?=$pengeluaran?></td>
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
<div id="msg" >
<?
$sql_lastdate = "SELECT '".$tahun."-01-01' - INTERVAL 1 YEAR AS LASTDATE";
$get_lastdate = mysql_query($sql_lastdate);
$dat_lastdate = mysql_fetch_assoc($get_lastdate);
$lastdate = $dat_lastdate['LASTDATE'];

$sql_excel="SELECT 
	  m_barang.kode_barang AS KODE,
	  m_barang.nama_barang AS NAMA_BARANG,
	  m_barang.satuan AS SATUAN,
	(SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = YEAR(".$lastdate.")																																				 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS SALDO_TAHUN_LALU, 
	      vew_lap_gudang_bulanan_2.APBD201 AS APBD_II_JAN,
		  vew_lap_gudang_bulanan_2.APBD202 AS APBD_II_PEB,
		  vew_lap_gudang_bulanan_2.APBD203 AS APBD_II_MAR,
		  vew_lap_gudang_bulanan_2.APBD204 AS APBD_II_APR,
		  vew_lap_gudang_bulanan_2.APBD205 AS APBD_II_MEI,
		  vew_lap_gudang_bulanan_2.APBD206 AS APBD_II_JUN,
		  vew_lap_gudang_bulanan_2.APBD207 AS APBD_II_JUL,
		  vew_lap_gudang_bulanan_2.APBD208 AS APBD_II_AGU,
		  vew_lap_gudang_bulanan_2.APBD209 AS APBD_II_SEP,
		  vew_lap_gudang_bulanan_2.APBD210 AS APBD_II_OKT,
		  vew_lap_gudang_bulanan_2.APBD211 AS APBD_II_NOP,
		  vew_lap_gudang_bulanan_2.APBD212 AS APBD_II_DES,
		  
		  vew_lap_gudang_bulanan_2.APBN01 +
		  vew_lap_gudang_bulanan_2.APBN02 +
		  vew_lap_gudang_bulanan_2.APBN03 +
		  vew_lap_gudang_bulanan_2.APBN04 +
		  vew_lap_gudang_bulanan_2.APBN05 +
		  vew_lap_gudang_bulanan_2.APBN06 +
		  vew_lap_gudang_bulanan_2.APBN07 +
		  vew_lap_gudang_bulanan_2.APBN08 +
		  vew_lap_gudang_bulanan_2.APBN09 +
		  vew_lap_gudang_bulanan_2.APBN10 +
		  vew_lap_gudang_bulanan_2.APBN11 +
		  vew_lap_gudang_bulanan_2.APBN12 AS APBN,
		  
		  vew_lap_gudang_bulanan_2.LAINLAIN01 +
		  vew_lap_gudang_bulanan_2.LAINLAIN02 +
		  vew_lap_gudang_bulanan_2.LAINLAIN03 +
		  vew_lap_gudang_bulanan_2.LAINLAIN04 +
		  vew_lap_gudang_bulanan_2.LAINLAIN05 +
		  vew_lap_gudang_bulanan_2.LAINLAIN06 +
		  vew_lap_gudang_bulanan_2.LAINLAIN07 +
		  vew_lap_gudang_bulanan_2.LAINLAIN08 +
		  vew_lap_gudang_bulanan_2.LAINLAIN09 +
		  vew_lap_gudang_bulanan_2.LAINLAIN10 +
		  vew_lap_gudang_bulanan_2.LAINLAIN11 +
		  vew_lap_gudang_bulanan_2.LAINLAIN12 AS LAIN_LAIN,
		  
		  vew_lap_gudang_bulanan_2.APBD201 +
		  vew_lap_gudang_bulanan_2.APBD202 +
		  vew_lap_gudang_bulanan_2.APBD203 +
		  vew_lap_gudang_bulanan_2.APBD204 +
		  vew_lap_gudang_bulanan_2.APBD205 +
		  vew_lap_gudang_bulanan_2.APBD206 +
		  vew_lap_gudang_bulanan_2.APBD207 +
		  vew_lap_gudang_bulanan_2.APBD208 +
		  vew_lap_gudang_bulanan_2.APBD209 +
		  vew_lap_gudang_bulanan_2.APBD210 +
		  vew_lap_gudang_bulanan_2.APBD211 +
		  vew_lap_gudang_bulanan_2.APBD212 +
		  vew_lap_gudang_bulanan_2.APBN01 +
		  vew_lap_gudang_bulanan_2.APBN02 +
		  vew_lap_gudang_bulanan_2.APBN03 +
		  vew_lap_gudang_bulanan_2.APBN04 +
		  vew_lap_gudang_bulanan_2.APBN05 +
		  vew_lap_gudang_bulanan_2.APBN06 +
		  vew_lap_gudang_bulanan_2.APBN07 +
		  vew_lap_gudang_bulanan_2.APBN08 +
		  vew_lap_gudang_bulanan_2.APBN09 +
		  vew_lap_gudang_bulanan_2.APBN10 +
		  vew_lap_gudang_bulanan_2.APBN11 +
		  vew_lap_gudang_bulanan_2.APBN12 +
		  vew_lap_gudang_bulanan_2.LAINLAIN01 +
		  vew_lap_gudang_bulanan_2.LAINLAIN02 +
		  vew_lap_gudang_bulanan_2.LAINLAIN03 +
		  vew_lap_gudang_bulanan_2.LAINLAIN04 +
		  vew_lap_gudang_bulanan_2.LAINLAIN05 +
		  vew_lap_gudang_bulanan_2.LAINLAIN06 +
		  vew_lap_gudang_bulanan_2.LAINLAIN07 +
		  vew_lap_gudang_bulanan_2.LAINLAIN08 +
		  vew_lap_gudang_bulanan_2.LAINLAIN09 +
		  vew_lap_gudang_bulanan_2.LAINLAIN10 +
		  vew_lap_gudang_bulanan_2.LAINLAIN11 +
		  vew_lap_gudang_bulanan_2.LAINLAIN12 AS JUMLAH_TERIMA,
		  
		  vew_lap_gudang_bulanan_2.JAN,
		  vew_lap_gudang_bulanan_2.PEB,
		  vew_lap_gudang_bulanan_2.MAR,
		  vew_lap_gudang_bulanan_2.APR,
		  vew_lap_gudang_bulanan_2.MEI,
		  vew_lap_gudang_bulanan_2.JUN,
		  vew_lap_gudang_bulanan_2.JUL,
		  vew_lap_gudang_bulanan_2.AGU,
		  vew_lap_gudang_bulanan_2.SEP,
		  vew_lap_gudang_bulanan_2.OKT,
		  vew_lap_gudang_bulanan_2.NOP,
		  vew_lap_gudang_bulanan_2.DES,
		  
		  vew_lap_gudang_bulanan_2.JAN +
		  vew_lap_gudang_bulanan_2.PEB +
		  vew_lap_gudang_bulanan_2.MAR +
		  vew_lap_gudang_bulanan_2.APR +
		  vew_lap_gudang_bulanan_2.MEI +
		  vew_lap_gudang_bulanan_2.JUN +
		  vew_lap_gudang_bulanan_2.JUL +
		  vew_lap_gudang_bulanan_2.AGU +
		  vew_lap_gudang_bulanan_2.SEP +
		  vew_lap_gudang_bulanan_2.OKT +
		  vew_lap_gudang_bulanan_2.NOP +
		  vew_lap_gudang_bulanan_2.DES AS JUMLAH_KELUAR  
FROM
  m_barang LEFT JOIN vew_lap_gudang_bulanan_2 ON m_barang.kode_barang=vew_lap_gudang_bulanan_2.KODE AND TAHUN = '".$tahun."' 
WHERE  m_barang.group_barang = '".$group."' 
AND m_barang.farmasi = '".$c."' AND m_barang.hide_when_print = '0' 
".$search;

?>

<form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
<input type="hidden" name="query" value="<?=$sql_excel?>" />
<input type="hidden" name="header" value="LAPORAN PENERIMAAN & PENGELUARAN BARANG TAHUN <?=$tahun?>" />
<input type="hidden" name="filename" value="laporan_bulanan" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
</div>
<p></p>

