<?php 
if(!empty($_POST['bulan']) && !empty($_POST['tahun']) && !empty($_POST['group'])){
session_start();
include("../include/connect.php");
require_once('../logistik/ps_pagination3.php');


if(strlen($_POST['bulan'])==1){
 $bln = "0".$_POST['bulan'];
}else{
 $bln = $_POST['bulan'];	
}

$sql="SELECT 
	  view_penerimaan_barang.KODE,
	  view_penerimaan_barang.NAMA,
	  view_penerimaan_barang.SATUAN,
	  (SELECT '".$_POST['tahun']."-".$bln."-01' - INTERVAL 1 MONTH) AS LASTDATE, 
		(SELECT saldo FROM t_barang_stok WHERE kode_barang = view_penerimaan_barang.KODE AND YEAR(tanggal) = YEAR(LASTDATE) AND 	MONTH(tanggal) = MONTH(LASTDATE) ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAWAL, 
		  view_penerimaan_barang.APBN,
		  view_penerimaan_barang.APBD1,
		  view_penerimaan_barang.APBD2,
		  view_penerimaan_barang.LAINLAIN,
		  0 AS DALAM,
		  0 AS KBKD,
		  0 AS UGD,
		  0 AS VK,
		  0 AS LAB,
		  0 AS OK,
		  0 AS RANAP,	
  		  view_penerimaan_barang.HARGA,
  		  view_penerimaan_barang.THNMASUK AS TAHUN,
  		  view_penerimaan_barang.BLNMASUK AS BULAN,
          (SELECT saldo FROM t_obat_stok WHERE kode_obat = view_penerimaan_barang.KODE AND YEAR(tanggal) = '".$_POST['tahun']."' AND MONTH(tanggal) = '".$_POST['bulan']."' ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR  
FROM
  view_penerimaan_barang
WHERE  view_penerimaan_barang.KATEGORI = 'L' AND view_penerimaan_barang.GROUPBARANG = '".$_POST['group']."'
    AND view_penerimaan_barang.THNMASUK = '".$_POST['tahun']."' AND view_penerimaan_barang.BLNMASUK = '".$_POST['bulan']."'

UNION 

SELECT 
  view_pengeluaran_barang.KODE,
  view_pengeluaran_barang.NAMA,
  view_pengeluaran_barang.SATUAN,
(SELECT '".$_POST['tahun']."-".$bln."-01' - INTERVAL 1 MONTH) AS LASTDATE, 
    (SELECT saldo FROM t_barang_stok WHERE kode_barang = view_pengeluaran_barang.KODE AND YEAR(tanggal) = YEAR(LASTDATE) AND MONTH(tanggal) = MONTH(LASTDATE) ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAWAL, 
  0 AS APBN,
  0 AS APBD1,
  0 AS APBD2,
  0 AS LAINLAIN,
  view_pengeluaran_barang.DALAM,
  view_pengeluaran_barang.KBKD,
  view_pengeluaran_barang.UGD,
  view_pengeluaran_barang.VK,
  view_pengeluaran_barang.LAB,
  view_pengeluaran_barang.OK,
  view_pengeluaran_barang.RANAP,
  view_pengeluaran_barang.HARGA,
  view_pengeluaran_barang.THNKELUAR AS TAHUN,
  view_pengeluaran_barang.BLNKELUAR AS BULAN,
(SELECT saldo FROM t_barang_stok WHERE kode_barang = view_pengeluaran_barang.KODE AND YEAR(tanggal) = '".$_POST['tahun']."' AND MONTH(tanggal) = '".$_POST['bulan']."' ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR  
FROM
  view_pengeluaran_barang
WHERE  view_pengeluaran_barang.KATEGORI = 'L' AND view_pengeluaran_barang.GROUPBARANG = '".$_POST['group']."'
    AND view_pengeluaran_barang.THNKELUAR = '".$_POST['tahun']."' AND view_pengeluaran_barang.BLNKELUAR = '".$_POST['bulan']."'";

$qry_order = mysql_query($sql);
$order = mysql_fetch_assoc($qry_order);
?>
<div id="addbarang"></div>
<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>LAPORAN PENERIMAAN & PENGELUARAN BARANG</h3></div>
    <div align="right" style="margin:5px;"> 
        <div id="table_search">
        <table width="100%" style="margin:10px;" border="0" cellspacing="0" cellspading="0" class="tb">
          <tr align="center">
            <th>KODE</th>
            <th>NAMA BARANG</th>
            <th>SATUAN</th>
            <th>STOK AWAL</th>
            <th>APBN</th>
            <th>APBD I</th>
            <th>APBD II</th>
            <th>LAIN-LAIN</th>
            <th>KETERANGAN</th>
            <th>JUMLAH</th>
            <th>LAB</th>
            <th>UGD</th>
            <th>OK</th>
            <th>VK</th>
            <th>RANAP</th>
             <th>DALAM</th>
            <th>STOK AKHIR</th>
            <th>HARGA SATUAN</th>
            <th>JUMLAH</th>
           </tr>
          <?
				
	$pager = new PS_Pagination($connect, $sql, 15, 5, "param1=valu1&param2=value2");
	
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
            
            <td><? if($data['KODE']==""){ echo $data['KODE2'];
			}else{ echo $data['KODE']; }?></td>
            <td><? if($data['NAMA']==""){ echo $data['NAMA2'];
			}else{ echo $data['NAMA']; }?></td>
            <td><? if($data['SATUAN']==""){ echo $data['SATUAN2'];
			}else{ echo $data['SATUAN']; }?></td>
            <td><? if($data['STOKAWAL']==""){ echo "0";
			}else{ echo $data['STOKAWAL']; }?></td>
            <td><? if($data['APBN']==""){ echo "0";
			}else{ echo $data['APBN']; } ?></td>
            <td><? if($data['APBD1']==""){ echo "0";
			}else{ echo $data['APBD1']; } ?></td>
            <td><? if($data['APBD2']==""){ echo "0";
			}else{ echo $data['APBD2']; } ?></td>
            <td><? if($data['LAINLAIN']==""){ echo "0";
			}else{ echo $data['LAINLAIN']; } ?></td>
            <td></td>
            <td><?=$data['APBN'] + $data['APBD1'] + $data['APBD2'] +$data['LAINLAIN']; ?></td>
            <td><? if($data['LAB']==""){ echo "0";
			}else{ echo $data['LAB']; } ?></td>
            <td><? if($data['UGD']==""){ echo "0";
			}else{ echo $data['UGD']; } ?></td>
            <td><? if($data['OK']==""){ echo "0";
			}else{ echo $data['OK']; } ?></td>
            <td><? if($data['VK']==""){ echo "0";
			}else{ echo $data['VK']; } ?></td>
            <td><? if($data['RANAP']==""){ echo "0";
			}else{ echo $data['RANAP']; } ?></td>
             <td><? if($data['DALAM']==""){ echo "0";
			}else{ echo $data['DALAM']; } ?></td>
            <td><? if($data['STOKAKHIR']==""){ echo "0";
			}else{ echo $data['STOKAKHIR']; }?></td>
            <td><? if($data['HARGA']==""){ echo $data['HARGA2'];
			}else{ echo $data['HARGA']; }?></td>
            <td><?=$data['LAB'] + $data['UGD'] + $data['OK'] +$data['VK'] + $data['RANAP'];?></td>
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
<div id="msg" ></div>
<p></p>
<? } ?>
