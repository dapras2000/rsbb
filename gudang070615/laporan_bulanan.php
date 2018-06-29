<?php 
session_start();
include("./include/connect.php");
require_once('./gudang/ps_pagination.php');

if($_SESSION['KDUNIT'] == "12" && $_GET['group'] == "4"){
        include("laporan_bulanan_gas.php");
}else {

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
	  (SELECT '".$tahun."-".$bl."-01' - INTERVAL 1 MONTH) AS LASTDATE, 
		(SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) < '".$bulan."' 
 AND KDUNIT =".$farmasi." ORDER BY kd_stok desc LIMIT 1 ) AS STOKAWAL, 
	  view_lap_gudang_bulanan2.APBN,
	  view_lap_gudang_bulanan2.APBD1,
	  view_lap_gudang_bulanan2.APBD2,
	  view_lap_gudang_bulanan2.LAINLAIN,
	  view_lap_gudang_bulanan.DEPO,
	  view_lap_gudang_bulanan.ANAK,
	  view_lap_gudang_bulanan.BEDAH,
	  view_lap_gudang_bulanan.KBKD,
	  view_lap_gudang_bulanan.THT,
	  view_lap_gudang_bulanan.MATA,
	  view_lap_gudang_bulanan.PARU,
	  view_lap_gudang_bulanan.FSIOTERAPI,
	  view_lap_gudang_bulanan.JANTUNG,
	  view_lap_gudang_bulanan.ORTHOPEDI,
	  view_lap_gudang_bulanan.UMUM,
	  view_lap_gudang_bulanan.NEUROLOGI,
	  view_lap_gudang_bulanan.ANESTESI,
	  view_lap_gudang_bulanan.PSIKIATRI,
	  view_lap_gudang_bulanan.DALAM,
	  view_lap_gudang_bulanan.GIGI,
	  view_lap_gudang_bulanan.SARAF,
	  view_lap_gudang_bulanan.UGD,
	  view_lap_gudang_bulanan.VK,
	  view_lap_gudang_bulanan.OK,
	  view_lap_gudang_bulanan.LAB,
	  view_lap_gudang_bulanan.RAD,
	  view_lap_gudang_bulanan.KULIT,
	  view_lap_gudang_bulanan.PGIZI,
	  view_lap_gudang_bulanan.GIZI,
	  view_lap_gudang_bulanan.RANAP,
	  view_lap_gudang_bulanan.PERIN,
	  view_lap_gudang_bulanan.TAHUN,
	  view_lap_gudang_bulanan.BULAN,
          (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) <= '".$bulan."' 
 AND KDUNIT = ".$farmasi."
 ORDER BY kd_stok DESC LIMIT 1 ) AS STOKAKHIR,
(SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) = '".$bulan."' 
 
 ORDER BY kd_stok DESC LIMIT 1 ) AS STOKAKHIRSEMUA 
FROM
  m_barang LEFT JOIN view_lap_gudang_bulanan ON m_barang.kode_barang=view_lap_gudang_bulanan.KODE AND TAHUN = '".$tahun."' AND BULAN = '".$bulan."'
  LEFT JOIN view_lap_gudang_bulanan2 ON m_barang.kode_barang=view_lap_gudang_bulanan2.KODE AND view_lap_gudang_bulanan2.TAHUN = '".$tahun."' AND view_lap_gudang_bulanan2.BULAN = '".$bulan."'
WHERE  m_barang.group_barang = '".$group."' 
AND m_barang.farmasi = '".$c."' 
".$search;

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
    
    <div id="frame_title"><h3>LAPORAN PENERIMAAN & PENGELUARAN BARANG BULAN <?=$bulan_name." ".$tahun?></h3></div>
    <div align="center" style="margin:5px;"> 
        <div id="table_search">
  
<? if($c == "1" && $group == "5"){
        include("laporan_bulanan_reagen.php");
}else if($c == "1" && $group == "3"){
	    include("laporan_bulanan_radiologi.php");
}else{
?>
  <div style="overflow:scroll;width:98%;height:auto;" >     
  <table border="0" cellspacing="1" cellpadding="1" bordercolor="#999999" class="tb" width="99%">
  <tr>
    <th rowspan="2"><div align="center">KODE</div></th>
    <th rowspan="2" width="20%"><div align="center">NAMA BARANG</div></th>
    <th rowspan="2"><div align="center">SATUAN</div></th>
    <th rowspan="2"><div align="center">STOK AWAL</div></th>
    <th colspan="5"><div align="center">PENERIMAAN</div></th>
    <th colspan="28"><div align="center">PENGELUARAN</div></th>
    <th rowspan="2"><div align="center">HARGA SATUAN (Rp)</div></th>
    <th rowspan="2"><div align="center">STOK AKHIR GUDANG</div></th>
    <th rowspan="2"><div align="center">JUMLAH GUDANG (Rp)</div></th>
    <th rowspan="2"><div align="center">STOK AKHIR UNIT</div></th>
    <th rowspan="2"><div align="center">STOK AKHIR SEMUA</div></th>
    <th rowspan="2"><div align="center">JUMLAH SEMUA (Rp)</div></th>
  </tr>
  <tr>
    <th><div align="center">APBN</div></th>
    <th><div align="center">APBD I</div></th>
    <th><div align="center">APBD II</div></th>
    <th><div align="center">LAIN-LAIN</div></th>
    <th><div align="center">JUMLAH</div></th>
    
    <th><div align="center">Depo</div></th>
    <th><div align="center">Anak</div></th>
    <th><div align="center">Bedah</div></th>
    <th><div align="center">Kebidanan</div></th>
	<th><div align="center">THT</div></th>
	<th><div align="center">Mata</div></th>
	<th><div align="center">Paru</div></th>
	<th><div align="center">Fsioterapi</div></th>
	<th><div align="center">Jantung</div></th>
	<th><div align="center">Orthopedi</div></th>
	<th><div align="center">Umum</div></th>
	<th><div align="center">Neurologi</div></th>
    <th><div align="center">Anestesi</div></th>
    <th><div align="center">Psikiatri</div></th>
    <th><div align="center">Dalam</div></th>
    <th><div align="center">Gigi</div></th>
    <th><div align="center">Saraf</div></th>
    <th><div align="center">UGD</div></th>
    
    <th><div align="center">VK</div></th>
    <th><div align="center">OK</div></th>
    <th><div align="center">LAB</div></th>
    <th><div align="center">Radiologi</div></th>
    <th><div align="center">Kulit</div></th>
    
    
    <th><div align="center">Poli Gizi</div></th>
	<th><div align="center">Gizi</div></th>
    <th><div align="center">Rawat Inap</div></th>
    <th><div align="center">Perina</div></th>
    <th><div align="center">Lain - lain</div></th>
  </tr>
<?
				
	$pager = new PS_Pagination($connect, $sql, 15, 5, "bulan=".$bulan."&tahun=".$tahun."&group=".$group."&nm_barang=".$nm_barang, "index.php?link=g02&");
	
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
            <td align="right"><? if($data['APBN']==""){ echo "0";
			}else{ echo $data['APBN']; } ?></td>
            <td align="right"><? if($data['APBD1']==""){ echo "0";
			}else{ echo $data['APBD1']; } ?></td>
            <td align="right"><? if($data['APBD2']==""){ echo "0";
			}else{ echo $data['APBD2']; } ?></td>
            <td align="right"><? if($data['LAINLAIN']==""){ echo "0";
			}else{ echo $data['LAINLAIN']; } ?></td>
            <td align="right"><?=$data['APBN'] + $data['APBD1'] + $data['APBD2'] +$data['LAINLAIN']; ?></td>
                         
            <td align="right"><? if($data['DEPO']==""){ echo "0";
			}else{ echo $data['DEPO']; } ?></td>
            <td align="right"><? if($data['ANAK']==""){ echo "0";
			}else{ echo $data['ANAK']; } ?></td>
            <td align="right"><? if($data['BEDAH']==""){ echo "0";
			}else{ echo $data['BEDAH']; } ?></td>
            <td align="right"><? if($data['KBKD']==""){ echo "0";
			}else{ echo $data['KBKD']; } ?></td>
            <td align="right"><? if($data['THT']==""){ echo "0";
			}else{ echo $data['THT']; } ?></td>
            <td align="right"><? if($data['MATA']==""){ echo "0";
			}else{ echo $data['MATA']; } ?></td>
            <td align="right"><? if($data['PARU']==""){ echo "0";
			}else{ echo $data['PARU']; } ?></td>
            <td align="right"><? if($data['FSIOTERAPI']==""){ echo "0";
			}else{ echo $data['FSIOTERAPI']; } ?></td>
            <td align="right"><? if($data['JANTUNG']==""){ echo "0";
			}else{ echo $data['JANTUNG']; } ?></td>
            <td align="right"><? if($data['ORTHOPEDI']==""){ echo "0";
			}else{ echo $data['ORTHOPEDI']; } ?></td>
            <td align="right"><? if($data['UMUM']==""){ echo "0";
			}else{ echo $data['UMUM']; } ?></td>
            <td align="right"><? if($data['NEUROLOGI']==""){ echo "0";
			}else{ echo $data['NEUROLOGI']; } ?></td>
            <td align="right"><? if($data['ANESTESI']==""){ echo "0";
			}else{ echo $data['ANESTESI']; } ?></td>
            <td align="right"><? if($data['PSIKIATRI']==""){ echo "0";
			}else{ echo $data['PSIKIATRI']; } ?></td>
            <td align="right"><? if($data['DALAM']==""){ echo "0";
			}else{ echo $data['DALAM']; } ?></td>
            <td align="right"><? if($data['GIGI']==""){ echo "0";
			}else{ echo $data['GIGI']; } ?></td>
            <td align="right"><? if($data['SARAF']==""){ echo "0";
			}else{ echo $data['SARAF']; } ?></td>
            <td align="right"><? if($data['UGD']==""){ echo "0";
			}else{ echo $data['UGD']; } ?></td>
            <td align="right"><? if($data['VK']==""){ echo "0";
			}else{ echo $data['VK']; } ?></td>
            <td align="right"><? if($data['OK']==""){ echo "0";
			}else{ echo $data['OK']; } ?></td>
            <td align="right"><? if($data['LAB']==""){ echo "0";
			}else{ echo $data['LAB']; } ?></td>
            <td align="right"><? if($data['RAD']==""){ echo "0";
			}else{ echo $data['RAD']; } ?></td>
            <td align="right"><? if($data['LAUND']==""){ echo "0";
			}else{ echo $data['LAUND']; } ?></td>
            <td align="right"><? if($data['PGIZI']==""){ echo "0";
			}else{ echo $data['PGIZI']; } ?></td>
            <td align="right"><? if($data['GIZI']==""){ echo "0";
			}else{ echo $data['GIZI']; } ?></td>
            
            <td align="right"><? if($data['RANAP']==""){ echo "0";
			}else{ echo $data['RANAP']; } ?></td>
            <td align="right"><? if($data['PERIN']==""){ echo "0";
			}else{ echo $data['PERIN']; } ?></td>
            <td align="right">0</td>
            
            <td align="right"><? if($data['harga']==""){ echo "0";
			}else{ echo $data['harga']; }?></td>
            <td align="right"><? if($data['STOKAKHIR']==""){ echo "0";
			}else{ echo $data['STOKAKHIR']; }?></td>
            <td align="right"><?=$data['STOKAKHIR'] *  $data['harga'];?></td>
            <td align="right"><? if($data['STOKAKHIRSEMUA']==""){ echo "0";
			}else{ echo $data['STOKAKHIRSEMUA']; }?></td>
			<td align="right"><?=$data['STOKAKHIR'] +  $data['STOKAKHIRSEMUA'];?></td>
            <td align="right"><?=($data['STOKAKHIR'] +  $data['STOKAKHIRSEMUA']) *  $data['harga'];?></td>
            </tr>
	 <?	$x++;} ?>
     </table>
     </div>
  <? }  
	
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
$sql_lastdate = "SELECT '".$tahun."-".$bl."-01' - INTERVAL 1 MONTH AS LASTDATE";
$get_lastdate = mysql_query($sql_lastdate);
$dat_lastdate = mysql_fetch_assoc($get_lastdate);
$lastdate = $dat_lastdate['LASTDATE'];

if($c == "1" && $group == "5"){
	
$sql_excel = "SELECT 
	  m_barang.kode_barang AS KODE,
	  m_barang.nama_barang AS NAMA_BARANG,
	  m_barang.satuan AS SATUAN,
	(SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = YEAR(".$lastdate.") AND MONTH(tanggal) = MONTH(".$lastdate.") 
 AND KDUNIT =".$farmasi."																																				 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOK_AWAL, 
	  view_lap_gudang_bulanan.APBN,
	  view_lap_gudang_bulanan.APBD1 AS APBD_I,
	  view_lap_gudang_bulanan.APBD2 AS APBD_II,
	  view_lap_gudang_bulanan.LAINLAIN AS LAIN_LAIN,
	   view_lap_gudang_bulanan.APBN + view_lap_gudang_bulanan.APBD1 + view_lap_gudang_bulanan.APBD2 + view_lap_gudang_bulanan.LAINLAIN AS JUMLAH,  
	  view_lap_gudang_bulanan.LAB,
	  view_lap_gudang_bulanan.UGD,
	  view_lap_gudang_bulanan.OK,
	  view_lap_gudang_bulanan.VK,
	  view_lap_gudang_bulanan.RANAP AS RAWAT_INAP,
	  (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) = '".$bulan."' 
 AND KDUNIT = ".$farmasi."
 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOK_AKHIR,
	  m_barang.harga * (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) = '".$bulan."' 
 AND KDUNIT = ".$farmasi."
 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS JUMLAH_	  
FROM
  m_barang LEFT JOIN view_lap_gudang_bulanan ON m_barang.kode_barang=view_lap_gudang_bulanan.KODE AND TAHUN = '".$tahun."' AND BULAN = '".$bulan."'
WHERE  m_barang.group_barang = '".$group."' 
AND m_barang.farmasi = '".$c."' AND m_barang.hide_when_print = '0' 
".$search;	
	
       
}else if($c == "1" && $group == "3"){

$sql_excel = "SELECT 
	  m_barang.kode_barang AS KODE,
	  m_barang.no_batch AS NO_BATCH,
	  m_barang.nama_barang AS NAMA_BARANG,
	  m_barang.satuan AS SATUAN,
	(SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = YEAR(".$lastdate.") AND MONTH(tanggal) = MONTH(".$lastdate.") 
 AND KDUNIT =".$farmasi."																																				 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOK_AWAL, 
	  view_lap_gudang_bulanan.APBN,
	  view_lap_gudang_bulanan.APBD1 AS APBD_I,
	  view_lap_gudang_bulanan.APBD2 AS APBD_II,
	  view_lap_gudang_bulanan.LAINLAIN AS LAIN_LAIN,
	   view_lap_gudang_bulanan.APBN + view_lap_gudang_bulanan.APBD1 + view_lap_gudang_bulanan.APBD2 + view_lap_gudang_bulanan.LAINLAIN AS JUMLAH,  
	  view_lap_gudang_bulanan.RAD AS RADIOLOGI,
	  (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) = '".$bulan."' 
 AND KDUNIT = ".$farmasi."
 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOK_AKHIR,
	  m_barang.harga * (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) = '".$bulan."' 
 AND KDUNIT = ".$farmasi."
 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS JUMLAH_	  
FROM
  m_barang LEFT JOIN view_lap_gudang_bulanan ON m_barang.kode_barang=view_lap_gudang_bulanan.KODE AND TAHUN = '".$tahun."' AND BULAN = '".$bulan."'
WHERE  m_barang.group_barang = '".$group."' 
AND m_barang.farmasi = '".$c."' AND m_barang.hide_when_print = '0' 
".$search;


}else{

$sql_excel = "SELECT 
	  m_barang.hide_when_print,
	  m_barang.kode_barang,
	  m_barang.nama_barang,
	  m_barang.satuan,
	  m_barang.harga,
	  (SELECT '".$tahun."-".$bl."-01' - INTERVAL 1 MONTH) AS LASTDATE, 
		(SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) < '".$bulan."' 
 AND KDUNIT =".$farmasi." ORDER BY kd_stok desc LIMIT 1 ) AS STOKAWAL, 
	  view_lap_gudang_bulanan2.APBN,
	  view_lap_gudang_bulanan2.APBD1,
	  view_lap_gudang_bulanan2.APBD2,
	  view_lap_gudang_bulanan2.LAINLAIN,
	  view_lap_gudang_bulanan.DEPO,
	  view_lap_gudang_bulanan.ANAK,
	  view_lap_gudang_bulanan.BEDAH,
	  view_lap_gudang_bulanan.KBKD,
	  view_lap_gudang_bulanan.THT,
	  view_lap_gudang_bulanan.MATA,
	  view_lap_gudang_bulanan.PARU,
	  view_lap_gudang_bulanan.FSIOTERAPI,
	  view_lap_gudang_bulanan.JANTUNG,
	  view_lap_gudang_bulanan.ORTHOPEDI,
	  view_lap_gudang_bulanan.UMUM,
	  view_lap_gudang_bulanan.NEUROLOGI,
	  view_lap_gudang_bulanan.ANESTESI,
	  view_lap_gudang_bulanan.PSIKIATRI,
	  view_lap_gudang_bulanan.DALAM,
	  view_lap_gudang_bulanan.GIGI,
	  view_lap_gudang_bulanan.SARAF,
	  view_lap_gudang_bulanan.UGD,
	  view_lap_gudang_bulanan.VK,
	  view_lap_gudang_bulanan.OK,
	  view_lap_gudang_bulanan.LAB,
	  view_lap_gudang_bulanan.RAD,
	  view_lap_gudang_bulanan.KULIT,
	  view_lap_gudang_bulanan.PGIZI,
	  view_lap_gudang_bulanan.GIZI,
	  view_lap_gudang_bulanan.RANAP,
	  view_lap_gudang_bulanan.PERIN,
	  view_lap_gudang_bulanan.TAHUN,
	  view_lap_gudang_bulanan.BULAN,
          (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) <= '".$bulan."' 
 AND KDUNIT = ".$farmasi."
 ORDER BY kd_stok DESC LIMIT 1 ) AS STOKAKHIR,
(SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) = '".$bulan."' 
 
 ORDER BY kd_stok DESC LIMIT 1 ) AS STOKAKHIRSEMUA 
FROM
  m_barang LEFT JOIN view_lap_gudang_bulanan ON m_barang.kode_barang=view_lap_gudang_bulanan.KODE AND TAHUN = '".$tahun."' AND BULAN = '".$bulan."'
  LEFT JOIN view_lap_gudang_bulanan2 ON m_barang.kode_barang=view_lap_gudang_bulanan2.KODE AND view_lap_gudang_bulanan2.TAHUN = '".$tahun."' AND view_lap_gudang_bulanan2.BULAN = '".$bulan."'
WHERE  m_barang.group_barang = '".$group."' 
AND m_barang.farmasi = '".$c."' 
".$search;
}
?>

<form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
<input type="hidden" name="query" value="<?=$sql_excel?>" />
<input type="hidden" name="header" value="LAPORAN PENERIMAAN & PENGELUARAN BARANG BULAN <?=$bulan_name." ".$tahun?>" />
<input type="hidden" name="filename" value="laporan_bulanan" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
</div>
<p></p>

<? } ?>

