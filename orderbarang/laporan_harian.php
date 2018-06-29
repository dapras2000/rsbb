<?php 
session_start();
include("farmasi.php"); 

$grpbarang = "";
if(!empty($_GET['grpbarang'])){
	$grpbarang =$_GET['grpbarang']; 
} 

$r_barang = "";
if(!empty($_GET['r_barang'])){
	$r_barang =$_GET['r_barang']; 
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

$search = "";
if(!empty($_GET['nm_barang'])){
	$nm_barang =$_GET['nm_barang'];
	$search = " AND nama_barang like '".$nm_barang."%'";
} 


$sql="SELECT 
	  m_barang.kode_barang,
	  m_barang.nama_barang,
	  m_barang.no_batch,
	  DATE_FORMAT(m_barang.expiry, '%d -%m -%Y') as expiry,
	  m_barang.satuan,
	  (SELECT '".$tahun."-".$bulan."-".$hari."' - INTERVAL 1 DAY) AS LASTDATE, 
	  (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = YEAR(LASTDATE) 		
			AND MONTH(tanggal) = MONTH(LASTDATE) AND DAYOFMONTH(tanggal) = DAYOFMONTH(LASTDATE)
			AND KDUNIT = ".$_SESSION['KDUNIT']."																																  			ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAWAL, 
	  view_lap_unit_harian.JMLTERIMA,
	  view_lap_unit_harian.JMLKELUAR,
  	  m_barang.harga,
  	  view_lap_unit_harian.TAHUN,
  	  view_lap_unit_harian.BULAN,
	  view_lap_unit_harian.TGL,
      (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' 	
			AND MONTH(tanggal) = '".$bl."' AND DAYOFMONTH(tanggal) = '".$hr."' 
			AND KDUNIT = ".$_SESSION['KDUNIT']."	
			ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR  
    FROM
      m_barang 
	  INNER JOIN m_barang_unit ON m_barang.kode_barang = m_barang_unit.kode_barang
	  AND m_barang_unit.KDUNIT = ".$_SESSION['KDUNIT']." 
	  INNER JOIN view_lap_unit_harian ON m_barang.kode_barang=view_lap_unit_harian.KODE AND TAHUN = '".$tahun."' AND BULAN = '".$bl."'  AND TGL = '".$hr."' AND UNIT = ".$_SESSION['KDUNIT']."
WHERE  m_barang.farmasi = '".$r_barang."' AND m_barang.group_barang = '".$grpbarang."' ".$search;

$qry_order = mysql_query($sql);
$order = mysql_fetch_assoc($qry_order);
?>
<div id="addbarang"></div>
<div align="center">
    <div id="frame" style="width:100%">
    <div id="frame_title">
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
    
      <h3>LAPORAN PENERIMAAN & PENGELUARAN BARANG TANGGAL <?=$hari." ".$bulan_name." ".$tahun?></h3></div>
    <div align="center" style="margin:5px;"> 
        <div id="table_search">
  <table border="0" cellspacing="1" cellpadding="1" bordercolor="#999999" class="tb" width="99%">
  <tr>
    <th><div align="center">NO</div></th>
    
    <th><div align="center">NAMA BARANG</div></th>
    <th><div align="center">NO BATCH</div></th>
    <th><div align="center">SATUAN</div></th>
    <th><div align="center">STOK AWAL</div></th>
    <th><div align="center">PENERIMAAN</div>
      <div align="center"></div></th>
    <th><div align="center">PENGELUARAN</div>      <div align="center"></div></th>
    <th><div align="center">STOK AKHIR</div></th>
    <th><div align="center">HARGA SATUAN (Rp)</div></th>
    <th><div align="center">JUMLAH (Rp)</div></th>
  </tr>
  <?
				
	$pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_pesan=".$tgl_pesan."&grpbarang=".$grpbarang."&r_barang=".$r_barang, "index.php?link=f12&");
	
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
            <td><?=$data['nama_barang']?></td>
            <td><?=$data['no_batch']?></td>
            <td><?=$data['satuan']?></td>
            <td align="right"><? if($data['STOKAWAL']==""){ echo "0";
			}else{ echo $data['STOKAWAL']; }?></td>
            <td align="right"><? if($data['JMLTERIMA']==""){ echo "0";
			}else{ echo $data['JMLTERIMA']; }?></td>
            <td align="right"><? if($data['JMLKELUAR']==""){ echo "0";
			}else{ echo $data['JMLKELUAR']; }?></td>
            <td align="right"><? if($data['STOKAKHIR']==""){ echo "0";
			}else{ echo $data['STOKAKHIR']; }?></td>
            <td align="right"><? if($data['harga']==""){ echo "0";
			}else{ echo $data['harga']; }?></td>
            <td align="right"><?=$data['STOKAKHIR'] *  $data['harga'];?></td>
            </tr>
	 <?	$x++;} ?>
     </table>
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

