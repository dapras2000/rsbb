<?php 
session_start();
include("./include/connect.php");
require_once('./gudang/ps_pagination.php');

if($_SESSION['KDUNIT'] == "12" && $_GET['group'] == "4"){
        echo "<strong>Not Available.</strong>";
}else {

$farmasi = $_SESSION['KDUNIT']; 
if($farmasi=="12"){
	$c = "1";
}else if($farmasi=="13"){
	$c = "0";
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

$tgl_pesan = "";
if(!empty($_GET['tgl_pesan'])){
	$tgl_pesan =$_GET['tgl_pesan']; 
	$tahun = substr($tgl_pesan,0,4);
	$bulan = substr($tgl_pesan,5,2);
	$hari = substr($tgl_pesan,8,2);
	$bl = ($bulan + 1) - 1;
	$hr = ($hari + 1) - 1;
} 

$sql="SELECT 
	  m_barang.hide_when_print,
	  m_barang.kode_barang,
	  m_barang.nama_barang,
	  m_barang.satuan,
	  m_barang.harga,
	  (SELECT '".$tahun."-".$bulan."-".$hari."' - INTERVAL 1 DAY) AS LASTDATE, 
		(SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = YEAR(LASTDATE) AND MONTH(tanggal) = MONTH(LASTDATE) AND DAYOFMONTH(tanggal) = DAYOFMONTH(LASTDATE) 
 AND KDUNIT =".$farmasi."																																				 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAWAL, 
	  view_lap_gudang_harian.APBN,
	  view_lap_gudang_harian.APBD1,
	  view_lap_gudang_harian.APBD2,
	  view_lap_gudang_harian.LAINLAIN,
	  view_lap_gudang_harian.DEPO,
	  view_lap_gudang_harian.ANAK,
	  view_lap_gudang_harian.BEDAH,
	  view_lap_gudang_harian.KBKD,
	  view_lap_gudang_harian.JIWA,
	  view_lap_gudang_harian.DALAM,
	  view_lap_gudang_harian.GIGI,
	  view_lap_gudang_harian.SARAF,
	  view_lap_gudang_harian.UGD,
	  view_lap_gudang_harian.VK,
	  view_lap_gudang_harian.OK,
	  view_lap_gudang_harian.LAB,
	  view_lap_gudang_harian.RAD,
	  view_lap_gudang_harian.LAUND,
	  view_lap_gudang_harian.GIZI,
	  view_lap_gudang_harian.RANAP,
	  view_lap_gudang_harian.PERIN,
	  view_lap_gudang_harian.TAHUN,
	  view_lap_gudang_harian.BULAN,
          (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) = '".$bl."' AND DAYOFMONTH(tanggal) = '".$hr."'
 AND KDUNIT = ".$farmasi."
 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR  
FROM
  m_barang INNER JOIN view_lap_gudang_harian ON m_barang.kode_barang=view_lap_gudang_harian.KODE AND TAHUN = '".$tahun."' AND BULAN = '".$bl."' AND TANGGAL = '".$hr."'
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
    
    <div id="frame_title"><h3>LAPORAN PENERIMAAN & PENGELUARAN BARANG TANGGAL <?=$hari." ".$bulan_name." ".$tahun?></h3></div>
    <div align="center" style="margin:5px;"> 
        <div id="table_search">
  
<? if($c == "1" && $group == "5"){
        include("laporan_harian_reagen.php");
}else if($c == "1" && $group == "3"){
	    include("laporan_harian_radiologi.php");
		
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
    <th colspan="18"><div align="center">PENGELUARAN</div></th>
    <th rowspan="2"><div align="center">STOK AKHIR</div></th>
    <th rowspan="2"><div align="center">HARGA SATUAN (Rp)</div></th>
    <th rowspan="2"><div align="center">JUMLAH (Rp)</div></th>
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
    <th><div align="center">Jiwa</div></th>
    <th><div align="center">Dalam</div></th>
    <th><div align="center">Gigi</div></th>
    <th><div align="center">Saraf</div></th>
    <th><div align="center">UGD</div></th>
    
    <th><div align="center">VK</div></th>
    <th><div align="center">OK</div></th>
    <th><div align="center">LAB</div></th>
    <th><div align="center">Radiologi</div></th>
    <th><div align="center">Laundry</div></th>
    
    
    <th><div align="center">Gizi</div></th>
    <th><div align="center">Rawat Inap</div></th>
    <th><div align="center">Perina</div></th>
    <th><div align="center">Lain - lain</div></th>
  </tr>
<?
				
	$pager = new PS_Pagination($connect, $sql, 15, 5, "&group=".$group."&nm_barang=".$nm_barang."&tgl_pesan=".$tgl_pesan, "index.php?link=g01&");
	
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
            <td align="right"><? if($data['JIWA']==""){ echo "0";
			}else{ echo $data['JIWA']; } ?></td>
            
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
            <td align="right"><? if($data['GIZI']==""){ echo "0";
			}else{ echo $data['GIZI']; } ?></td>
            
            <td align="right"><? if($data['RANAP']==""){ echo "0";
			}else{ echo $data['RANAP']; } ?></td>
            <td align="right"><? if($data['PERIN']==""){ echo "0";
			}else{ echo $data['PERIN']; } ?></td>
            <td align="right">0</td>
            
            
            <td align="right"><? if($data['STOKAKHIR']==""){ echo "0";
			}else{ echo $data['STOKAKHIR']; }?></td>
            <td align="right"><? if($data['harga']==""){ echo "0";
			}else{ echo $data['harga']; }?></td>
            <td align="right"><?=$data['STOKAKHIR'] *  $data['harga'];?></td>
            </tr>
	 <?	$x++;} ?>
     </table>
     </div>
  <?  } 
	
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
$sql_lastdate = "SELECT '".$tahun."-".$bulan."-".$hari."' - INTERVAL 1 DAY AS LASTDATE";
$get_lastdate = mysql_query($sql_lastdate);
$dat_lastdate = mysql_fetch_assoc($get_lastdate);
$lastdate = $dat_lastdate['LASTDATE'];

if($c == "1" && $group == "5"){
	
$sql_excel = "SELECT 
	  m_barang.kode_barang AS KODE,
	  m_barang.no_batch AS NO_BATCH,
	  m_barang.nama_barang AS NAMA_BARANG,
	  m_barang.satuan AS SATUAN,
	(SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = YEAR(".$lastdate.") AND MONTH(tanggal) = MONTH(".$lastdate.") AND DAYOFMONTH(tanggal) = DAYOFMONTH(".$lastdate.") 
 AND KDUNIT =".$farmasi."																																				 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOK_AWAL, 
	  view_lap_gudang_harian.APBN,
	  view_lap_gudang_harian.APBD1 AS APBD_I,
	  view_lap_gudang_harian.APBD2 AS APBD_II,
	  view_lap_gudang_harian.LAINLAIN AS LAIN_LAIN,
	  view_lap_gudang_harian.APBN + view_lap_gudang_harian.APBD1 + view_lap_gudang_harian.APBD2 + view_lap_gudang_harian.LAINLAIN AS JUMLAH,   
	  view_lap_gudang_harian.LAB,
	  view_lap_gudang_harian.UGD,
	  view_lap_gudang_harian.OK,
	  view_lap_gudang_harian.VK,
	  view_lap_gudang_harian.RANAP AS RAWAT_INAP,
	  (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) = '".$bl."' AND DAYOFMONTH(tanggal) = '".$hr."'
 AND KDUNIT = ".$farmasi."
 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOK_AKHIR,
 m_barang.harga AS HARGA_SATUAN,
 m_barang.harga * (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) = '".$bl."' AND DAYOFMONTH(tanggal) = '".$hr."'
 AND KDUNIT = ".$farmasi."
 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS JUMLAH_
FROM
  m_barang INNER JOIN view_lap_gudang_harian ON m_barang.kode_barang=view_lap_gudang_harian.KODE AND TAHUN = '".$tahun."' AND BULAN = '".$bl."' AND TANGGAL = '".$hr."'
WHERE  m_barang.group_barang = '".$group."' 
AND m_barang.farmasi = '".$c."' AND m_barang.hide_when_print = '0' 
".$search;	
	
       
}else if($c == "1" && $group == "3"){

$sql_excel = "SELECT 
	  m_barang.kode_barang AS KODE,
	  m_barang.no_batch AS NO_BATCH,
	  m_barang.nama_barang AS NAMA_BARANG,
	  m_barang.satuan AS SATUAN,
	(SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = YEAR(".$lastdate.") AND MONTH(tanggal) = MONTH(".$lastdate.") AND DAYOFMONTH(tanggal) = DAYOFMONTH(".$lastdate.") 
 AND KDUNIT =".$farmasi."																																				 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOK_AWAL, 
	  view_lap_gudang_harian.APBN,
	  view_lap_gudang_harian.APBD1 AS APBD_I,
	  view_lap_gudang_harian.APBD2 AS APBD_II,
	  view_lap_gudang_harian.LAINLAIN AS LAIN_LAIN,
	  view_lap_gudang_harian.APBN + view_lap_gudang_harian.APBD1 + view_lap_gudang_harian.APBD2 + view_lap_gudang_harian.LAINLAIN AS JUMLAH,   
	  view_lap_gudang_harian.RAD AS RADIOLOGI,
	  (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) = '".$bl."' AND DAYOFMONTH(tanggal) = '".$hr."'
 AND KDUNIT = ".$farmasi."
 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOK_AKHIR,
 m_barang.harga AS HARGA_SATUAN,
 m_barang.harga * (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) = '".$bl."' AND DAYOFMONTH(tanggal) = '".$hr."'
 AND KDUNIT = ".$farmasi."
 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS JUMLAH_
FROM
  m_barang INNER JOIN view_lap_gudang_harian ON m_barang.kode_barang=view_lap_gudang_harian.KODE AND TAHUN = '".$tahun."' AND BULAN = '".$bl."' AND TANGGAL = '".$hr."'
WHERE  m_barang.group_barang = '".$group."' 
AND m_barang.farmasi = '".$c."' AND m_barang.hide_when_print = '0' 
".$search;


}else{

$sql_excel = "SELECT 
	  m_barang.kode_barang AS KODE,
	  m_barang.nama_barang AS NAMA_BARANG,
	  m_barang.satuan AS SATUAN,
	(SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = YEAR(".$lastdate.") AND MONTH(tanggal) = MONTH(".$lastdate.") AND DAYOFMONTH(tanggal) = DAYOFMONTH(".$lastdate.") 
 AND KDUNIT =".$farmasi."																																				 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOK_AWAL, 
	  view_lap_gudang_harian.APBN,
	  view_lap_gudang_harian.APBD1 AS APBD_I,
	  view_lap_gudang_harian.APBD2 AS APBD_II,
	  view_lap_gudang_harian.LAINLAIN AS LAIN_LAIN,
	  view_lap_gudang_harian.APBN + view_lap_gudang_harian.APBD1 + view_lap_gudang_harian.APBD2 + view_lap_gudang_harian.LAINLAIN AS JUMLAH,   
	  view_lap_gudang_harian.DEPO,
	  view_lap_gudang_harian.ANAK,
	  view_lap_gudang_harian.BEDAH,
	  view_lap_gudang_harian.KBKD AS KEBIDANAN,
	  view_lap_gudang_harian.JIWA,
	  view_lap_gudang_harian.DALAM,
	  view_lap_gudang_harian.GIGI,
	  view_lap_gudang_harian.SARAF,
	  view_lap_gudang_harian.UGD,
	  view_lap_gudang_harian.VK,
	  view_lap_gudang_harian.OK,
	  view_lap_gudang_harian.LAB,
	  view_lap_gudang_harian.RAD AS RADIOLOGI,
	  view_lap_gudang_harian.LAUND AS LAUNDRY,
	  view_lap_gudang_harian.GIZI,
	  view_lap_gudang_harian.RANAP AS RAWAT_INAP,
	  view_lap_gudang_harian.PERIN AS PERINA,
	  '' AS LAIN_LAIN_,
	 (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) = '".$bl."' AND DAYOFMONTH(tanggal) = '".$hr."'
 AND KDUNIT = ".$farmasi."
 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOK_AKHIR,
 m_barang.harga AS HARGA_SATUAN,
 m_barang.harga * (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) = '".$bl."' AND DAYOFMONTH(tanggal) = '".$hr."'
 AND KDUNIT = ".$farmasi."
 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS JUMLAH_
FROM
  m_barang INNER JOIN view_lap_gudang_harian ON m_barang.kode_barang=view_lap_gudang_harian.KODE AND TAHUN = '".$tahun."' AND BULAN = '".$bl."' AND TANGGAL = '".$hr."'
WHERE  m_barang.group_barang = '".$group."' 
AND m_barang.farmasi = '".$c."' AND m_barang.hide_when_print = '0' 
".$search;
}
?>

<form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
<input type="hidden" name="query" value="<?=$sql_excel?>" />
<input type="hidden" name="header" value="LAPORAN PENERIMAAN & PENGELUARAN BARANG TANGGAL <?=$hari." ".$bulan_name." ".$tahun?>" />
<input type="hidden" name="filename" value="laporan_harian" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
</div>
<p></p>

<? } ?>