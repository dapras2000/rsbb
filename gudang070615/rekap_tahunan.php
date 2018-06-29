<?php 
session_start();
include("./include/connect.php");
require_once('./gudang/ps_pagination.php');

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
	  (SELECT $tahun - 1) AS LASTYEAR, 
		(SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = LASTYEAR AND KDUNIT =".$farmasi."																																				 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAWAL, 
	  view_lap_gudang_tahunan.TRM01,
	  view_lap_gudang_tahunan.TRM02,
	  view_lap_gudang_tahunan.TRM03,
	  view_lap_gudang_tahunan.TRM04,
	  view_lap_gudang_tahunan.TRM05,
	  view_lap_gudang_tahunan.TRM06,
	  view_lap_gudang_tahunan.TRM07,
	  view_lap_gudang_tahunan.TRM08,
	  view_lap_gudang_tahunan.TRM09,
	  view_lap_gudang_tahunan.TRM10,
	  view_lap_gudang_tahunan.TRM11,
	  view_lap_gudang_tahunan.TRM12,
	  view_lap_gudang_tahunan.KLR01,
	  view_lap_gudang_tahunan.KLR02,
	  view_lap_gudang_tahunan.KLR03,
	  view_lap_gudang_tahunan.KLR04,
	  view_lap_gudang_tahunan.KLR05,
	  view_lap_gudang_tahunan.KLR06,
	  view_lap_gudang_tahunan.KLR07,
	  view_lap_gudang_tahunan.KLR08,
	  view_lap_gudang_tahunan.KLR09,
	  view_lap_gudang_tahunan.KLR10,
	  view_lap_gudang_tahunan.KLR11,
	  view_lap_gudang_tahunan.KLR12,
	  view_lap_gudang_tahunan.TAHUN,
	  (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' 
 AND KDUNIT = ".$farmasi."
 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR  
FROM
  m_barang LEFT JOIN view_lap_gudang_tahunan ON m_barang.kode_barang=view_lap_gudang_tahunan.KODE AND TAHUN = '".$tahun."' 
AND view_lap_gudang_tahunan.UNIT = ".$farmasi."
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
    <th><div align="center">KODE</div></th>

    <th width="20%"><div align="center">NAMA BARANG</div></th>
    <th><div align="center">SATUAN</div></th>
    <th><div align="center">SISA PADA 31 DESEMBER <?=$tahun-1?></div></th>
    <th><div align="center">PENERIMAAN JANUARI S/D DESEMBER <?=$tahun?></div></th>
    <th><div align="center">PENGELUARAN JANUARI S/D DESEMBER <?=$tahun?></div></th>
    <th><div align="center">SISA PADA 31 DESEMBER <?=$tahun?></div></th>
    <th><div align="center">HARGA SATUAN (Rp)</div></th>
    <th><div align="center">TOTAL NILAI (Rp)</div></th>
<!--    <th><div align="center">SISA PENGELUARAN <?=$tahun?></div></th> -->
  </tr>
  <?
				
	$pager = new PS_Pagination($connect, $sql, 15, 5, "bulan=".$bulan."&tahun=".$tahun."&group=".$group."&nm_barang=".$nm_barang, "index.php?link=g05&");
	
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
            
            <? $_penerimaan = $data['TRM01'] + $data['TRM02'] + $data['TRM03'] + $data['TRM04'] + $data['TRM05'] + $data['TRM06'] + $data['TRM07'] + $data['TRM08'] + $data['TRM09'] + $data['TRM10'] + $data['TRM11'] + $data['TRM12']?>
            <td align="right"><?=$_penerimaan?></td>
            
            <? $_pengeluaran = $data['KLR01'] + $data['KLR02'] + $data['KLR03'] + $data['KLR04'] + $data['KLR05'] + $data['KLR06'] + $data['KLR07'] + $data['KLR08'] + $data['KLR09'] + $data['KLR10'] + $data['KLR11'] + $data['KLR12']?>
            <td align="right"><?=$_pengeluaran?></td>
            
            <td align="right"><? if($data['STOKAKHIR']==""){ echo "0";
			}else{ echo $data['STOKAKHIR']; }?></td>
            <td align="right"><? if($data['harga']==""){ echo "0";
			}else{ echo $data['harga']; }?></td>
            <td align="right"><?=$data['STOKAKHIR'] *  $data['harga'];?></td>
<!--            <td align="right"><?=$data['STOKAWAL'] -  $_pengeluaran;?></td> -->
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
$sql_lastdate = "SELECT $tahun - 1 AS LASTYEAR";
$get_lastdate = mysql_query($sql_lastdate);
$dat_lastdate = mysql_fetch_assoc($get_lastdate);
$lastdate = $dat_lastdate['LASTYEAR'];

$sql_excel = "SELECT 
	  m_barang.kode_barang AS KODE,
	  m_barang.nama_barang AS NAMA_BARANG,
	  m_barang.satuan AS SATUAN,
	  (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = ".$lastdate." AND KDUNIT =".$farmasi."																																				 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1) AS SISA_DESEMBER_".$lastdate.", 
	  
	  view_lap_gudang_tahunan.TRM01 +
	  view_lap_gudang_tahunan.TRM02 +
	  view_lap_gudang_tahunan.TRM03 +
	  view_lap_gudang_tahunan.TRM04 +
	  view_lap_gudang_tahunan.TRM05 +
	  view_lap_gudang_tahunan.TRM06 +
	  view_lap_gudang_tahunan.TRM07 +
	  view_lap_gudang_tahunan.TRM08 +
	  view_lap_gudang_tahunan.TRM09 +
	  view_lap_gudang_tahunan.TRM10 +
	  view_lap_gudang_tahunan.TRM11 +
	  view_lap_gudang_tahunan.TRM12 AS PENERIMAAN_JAN_SD_DES_".$tahun.",
	  
	  view_lap_gudang_tahunan.KLR01 +
	  view_lap_gudang_tahunan.KLR02 +
	  view_lap_gudang_tahunan.KLR03 +
	  view_lap_gudang_tahunan.KLR04 +
	  view_lap_gudang_tahunan.KLR05 +
	  view_lap_gudang_tahunan.KLR06 +
	  view_lap_gudang_tahunan.KLR07 +
	  view_lap_gudang_tahunan.KLR08 +
	  view_lap_gudang_tahunan.KLR09 +
	  view_lap_gudang_tahunan.KLR10 +
	  view_lap_gudang_tahunan.KLR11 +
	  view_lap_gudang_tahunan.KLR12 AS PENGELUARAN_JAN_SD_DES_".$tahun.",
	  
	 (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' 
 AND KDUNIT = ".$farmasi."
 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1) AS SISA_DESEMBER_".$tahun.",
	 m_barang.harga AS HARGA_SATUAN,
	  
	 (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' 
 AND KDUNIT = ".$farmasi."
 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1) * m_barang.harga AS TOTAL_NILAI,
	  
	
	 (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = ".$lastdate." AND KDUNIT =".$farmasi."																																				 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1) - (view_lap_gudang_tahunan.KLR01 +
	  view_lap_gudang_tahunan.KLR02 +
	  view_lap_gudang_tahunan.KLR03 +
	  view_lap_gudang_tahunan.KLR04 +
	  view_lap_gudang_tahunan.KLR05 +
	  view_lap_gudang_tahunan.KLR06 +
	  view_lap_gudang_tahunan.KLR07 +
	  view_lap_gudang_tahunan.KLR08 +
	  view_lap_gudang_tahunan.KLR09 +
	  view_lap_gudang_tahunan.KLR10 +
	  view_lap_gudang_tahunan.KLR11 +
	  view_lap_gudang_tahunan.KLR12) AS SISA_PENGELUARAN_".$lastdate." 
	  
FROM
  m_barang LEFT JOIN view_lap_gudang_tahunan ON m_barang.kode_barang=view_lap_gudang_tahunan.KODE AND TAHUN = '".$tahun."' 
AND view_lap_gudang_tahunan.UNIT = ".$farmasi." 
WHERE m_barang.group_barang = '".$group."' 
AND m_barang.farmasi = '".$c."' AND m_barang.hide_when_print = '0' 
".$search;
?>
<form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
<input type="hidden" name="query" value="<?=$sql_excel?>" />
<input type="hidden" name="header" value="LAPORAN PENERIMAAN & PENGELUARAN BARANG TAHUN <?=$tahun?>" />
<input type="hidden" name="filename" value="laporan_tahunan" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
</div>
<p></p>

