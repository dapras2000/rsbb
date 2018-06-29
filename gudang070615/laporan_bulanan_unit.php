<?php 
session_start();
include("ps_pagination.php");


$farmasi = $_SESSION['KDUNIT']; 

if($farmasi=="12") {
    $c = "1";
}else if($farmasi=="13") {
    $c = "0";
}

$unit = "";
if(!empty($_GET['unit'])) {
    $unit =$_GET['unit'];
} 

$bulan = "";
if(!empty($_GET['bulan'])) {
    $bulan =$_GET['bulan'];
} 

$tahun = "";
if(!empty($_GET['tahun'])) {
    $tahun =$_GET['tahun'];
} 


$group = "";
if(!empty($_GET['group'])) {
    $group =$_GET['group'];
} 



if(strlen($bulan)==1) {
    $bl = "0".$bulan;
}else {
    $bl = $bulan;
}

$search = "";
if(!empty($_GET['nm_barang'])) {
    $nm_barang =$_GET['nm_barang'];
    $search = " AND nama_barang like '".$nm_barang."%'";
} 


$sql="SELECT 
	  m_barang.kode_barang,
	  m_barang.nama_barang,
	  DATE_FORMAT(m_barang.expiry, '%d -%m -%Y') as expiry,
	  m_barang.satuan,
	  (SELECT '".$tahun."-".$bl."-01' - INTERVAL 1 MONTH) AS LASTDATE, 
	  (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' 	
			AND MONTH(tanggal) = '".$bulan."'
			AND KDUNIT = ".$unit."	ORDER BY tanggal ASC, kd_stok ASC LIMIT 1 ) AS STOKAWAL, 
	  view_lap_unit_bulanan.TRM01,
	  view_lap_unit_bulanan.TRM02,
	  view_lap_unit_bulanan.TRM03,
	  view_lap_unit_bulanan.TRM04,
	  view_lap_unit_bulanan.TRM05,
	  view_lap_unit_bulanan.TRM06,
	  view_lap_unit_bulanan.TRM07,
	  view_lap_unit_bulanan.TRM08,
	  view_lap_unit_bulanan.TRM09,
	  view_lap_unit_bulanan.TRM10,
	  view_lap_unit_bulanan.TRM11,
	  view_lap_unit_bulanan.TRM12,
	  view_lap_unit_bulanan.TRM13,
	  view_lap_unit_bulanan.TRM14,
	  view_lap_unit_bulanan.TRM15,
	  view_lap_unit_bulanan.TRM16,
	  view_lap_unit_bulanan.TRM17,
	  view_lap_unit_bulanan.TRM18,
	  view_lap_unit_bulanan.TRM19,
	  view_lap_unit_bulanan.TRM20,
	  view_lap_unit_bulanan.TRM21,
	  view_lap_unit_bulanan.TRM22,
	  view_lap_unit_bulanan.TRM23,
	  view_lap_unit_bulanan.TRM24,
	  view_lap_unit_bulanan.TRM25,
	  view_lap_unit_bulanan.TRM26,
	  view_lap_unit_bulanan.TRM27,
	  view_lap_unit_bulanan.TRM28,
	  view_lap_unit_bulanan.TRM29,
	  view_lap_unit_bulanan.TRM30,
	  view_lap_unit_bulanan.TRM31,
	  view_lap_unit_bulanan.KLR01,
	  view_lap_unit_bulanan.KLR02,
	  view_lap_unit_bulanan.KLR03,
	  view_lap_unit_bulanan.KLR04,
	  view_lap_unit_bulanan.KLR05,
	  view_lap_unit_bulanan.KLR06,
	  view_lap_unit_bulanan.KLR07,
	  view_lap_unit_bulanan.KLR08,
	  view_lap_unit_bulanan.KLR09,
	  view_lap_unit_bulanan.KLR10,
	  view_lap_unit_bulanan.KLR11,
	  view_lap_unit_bulanan.KLR12,
	  view_lap_unit_bulanan.KLR13,
	  view_lap_unit_bulanan.KLR14,
	  view_lap_unit_bulanan.KLR15,
	  view_lap_unit_bulanan.KLR16,
	  view_lap_unit_bulanan.KLR17,
	  view_lap_unit_bulanan.KLR18,
	  view_lap_unit_bulanan.KLR19,
	  view_lap_unit_bulanan.KLR20,
	  view_lap_unit_bulanan.KLR21,
	  view_lap_unit_bulanan.KLR22,
	  view_lap_unit_bulanan.KLR23,
	  view_lap_unit_bulanan.KLR24,
	  view_lap_unit_bulanan.KLR25,
	  view_lap_unit_bulanan.KLR26,
	  view_lap_unit_bulanan.KLR27,
	  view_lap_unit_bulanan.KLR28,
	  view_lap_unit_bulanan.KLR29,
	  view_lap_unit_bulanan.KLR30,
	  view_lap_unit_bulanan.KLR31,
  	  m_barang.harga,
  	  view_lap_unit_bulanan.TAHUN,
  	  view_lap_unit_bulanan.BULAN,
      (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' 	
			AND MONTH(tanggal) = '".$bulan."' 
			AND KDUNIT = ".$unit."	
			ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR  
    FROM
      m_barang 
	  INNER JOIN m_barang_unit ON m_barang.kode_barang = m_barang_unit.kode_barang
	  AND m_barang_unit.KDUNIT = ".$unit." 
	  LEFT JOIN view_lap_unit_bulanan ON m_barang.kode_barang=view_lap_unit_bulanan.KODE AND TAHUN = '".$tahun."' AND BULAN = '".$bulan."' AND UNIT = ".$unit."
WHERE  m_barang.farmasi = '".$c."' AND m_barang.group_barang = '".$group."' ".$search;

$qry_order = mysql_query($sql);
$order = mysql_fetch_assoc($qry_order);
?>
<div id="addbarang"></div>
<div align="center">
    <div id="frame" style="width:100%">
        <? switch ($bulan) {
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

        $sql_unit = "SELECT nama from m_unit where kdunit = ".$unit;
        $get_unit = mysql_query($sql_unit);
        $dat_unit = mysql_fetch_assoc($get_unit);
        ?>

        <div id="frame_title"><h3>LAPORAN PENERIMAAN & PENGELUARAN BARANG BULAN <?=$bulan_name." ".$tahun?> UNIT <?=$dat_unit['DEPARTEMEN']?></h3></div>
        <div align="center" style="margin:5px;">
            <div id="table_search">
                <div style="overflow:scroll;width:98%;height:auto;" >
                    <table border="0" cellspacing="1" cellpadding="1" bordercolor="#999999" class="tb" width="99%">
                        <tr>
                            <th rowspan="2"><div align="center">KODE</div></th>

                            <th rowspan="2"><div align="center">NAMA BARANG</div></th>

                            <th rowspan="2"><div align="center">SATUAN</div></th>
                            <th rowspan="2"><div align="center">STOK BULAN</div></th>
                            <th colspan="6"><div align="center">PENERIMAAN</div>
                                <div align="center"></div></th>
                            <th colspan="32"><div align="center">PENGELUARAN</div>      <div align="center"></div></th>
                            <th rowspan="2"><div align="center">STOK AKHIR</div></th>
                            <th rowspan="2"><div align="center">HARGA SATUAN (Rp)</div></th>
                            <th rowspan="2"><div align="center">JUMLAH (Rp)</div></th>
                        </tr>
                        <tr>
                            <th>MINGGU I</th>
                            <th>MINGGU II</th>
                            <th>MINGGU III</th>
                            <th>MINGGU IV</th>
                            <th>MINGGU V</th>
                            <th>JUMLAH</th>
                            <th>01</th>
                            <th>02</th>
                            <th>03</th>
                            <th>04</th>
                            <th>05</th>
                            <th>06</th>
                            <th>07</th>
                            <th>08</th>
                            <th>09</th>
                            <th>10</th>
                            <th>11</th>
                            <th>12</th>
                            <th>13</th>
                            <th>14</th>
                            <th>15</th>
                            <th>16</th>
                            <th>17</th>
                            <th>18</th>
                            <th>19</th>
                            <th>20</th>
                            <th>21</th>
                            <th>22</th>
                            <th>23</th>
                            <th>24</th>
                            <th>25</th>
                            <th>26</th>
                            <th>27</th>
                            <th>28</th>
                            <th>29</th>
                            <th>30</th>
                            <th>31</th>
                            <th>JUMLAH</th>
                        </tr>
                        <?

                        $pager = new PS_Pagination($connect, $sql, 15, 5, "bulan=".$bulan."&tahun=".$tahun."&group=".$group."&nm_barang=".$nm_barang."&unit=".$unit, "index.php?link=g06&");

                        //The paginate() function returns a mysql result set
                        $rs = $pager->paginate();
                        if(!$rs) die(mysql_error());
                        $x= 1;
                        while($data = mysql_fetch_array($rs)) {?>
                        <tr <?   echo "class =";
                            $count++;
                            if ($count % 2) {
                                echo "tr1";
                            }
                            else {
                                echo "tr2";
                            }
                                ?>>

                            <td><?=$data['kode_barang']?></td>
                            <td><a href="index.php?link=g06x&kode=<?=$data['kode_barang']?>&nama=<?=$data['nama_barang']?>&unit=<?=$_GET['unit']?>&bulan=<?=$_GET['bulan']?>&tahun=<?=$_GET['tahun']?>" ><?=$data['nama_barang']?></a></td>
                            <td><?=$data['satuan']?></td>
                            <td align="right"><? if($data['STOKAWAL']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['STOKAWAL'];
                                    }?></td>
                                <? $minggu_1 = $data['TRM01']+$data['TRM02']+$data['TRM03']+$data['TRM04']+$data['TRM05']+$data['TRM06']+$data['TRM07']; ?>

                            <td align="right"><?=$minggu_1?></td>
                                <? $minggu_2 = $data['TRM08']+$data['TRM09']+$data['TRM10']+$data['TRM11']+$data['TRM12']+$data['TRM13']+$data['TRM14']; ?>

                            <td align="right"><?=$minggu_2?></td>
                                <? $minggu_3 = $data['TRM15']+$data['TRM16']+$data['TRM17']+$data['TRM18']+$data['TRM19']+$data['TRM20']+$data['TRM21']; ?>

                            <td align="right"><?=$minggu_3?></td>
                                <? $minggu_4 = $data['TRM22']+$data['TRM23']+$data['TRM24']+$data['TRM25']+$data['TRM26']+$data['TRM27']+$data['TRM28']; ?>

                            <td align="right"><?=$minggu_4?></td>
                                <? $minggu_5 = $data['TRM29']+$data['TRM30']+$data['TRM31']; ?>

                            <td align="right"><?=$minggu_5?></td>
                                <? $bulan_trm = $minggu_1 + $minggu_2 + $minggu_3 + $minggu_4 + $minggu_5;?>

                            <td align="right"><?=$bulan_trm?></td>
                            <td align="right"><? if($data['KLR01']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR01'];
                                    }?></td>
                            <td align="right"><? if($data['KLR02']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR02'];
                                    }?></td>
                            <td align="right"><? if($data['KLR03']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR03'];
                                    }?></td>
                            <td align="right"><? if($data['KLR04']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR04'];
                                    }?></td>
                            <td align="right"><? if($data['KLR05']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR05'];
                                    }?></td>
                            <td align="right"><? if($data['KLR06']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR06'];
                                    }?></td>
                            <td align="right"><? if($data['KLR07']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR07'];
                                    }?></td>
                            <td align="right"><? if($data['KLR08']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR08'];
                                    }?></td>
                            <td align="right"><? if($data['KLR09']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR09'];
                                    }?></td>
                            <td align="right"><? if($data['KLR10']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR10'];
                                    }?></td>
                            <td align="right"><? if($data['KLR11']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR11'];
                                    }?></td>
                            <td align="right"><? if($data['KLR12']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR12'];
                                    }?></td>
                            <td align="right"><? if($data['KLR13']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR13'];
                                    }?></td>
                            <td align="right"><? if($data['KLR14']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR14'];
                                    }?></td>
                            <td align="right"><? if($data['KLR15']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR15'];
                                    }?></td>
                            <td align="right"><? if($data['KLR16']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR16'];
                                    }?></td>
                            <td align="right"><? if($data['KLR17']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR17'];
                                    }?></td>
                            <td align="right"><? if($data['KLR18']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR18'];
                                    }?></td>
                            <td align="right"><? if($data['KLR19']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR19'];
                                    }?></td>
                            <td align="right"><? if($data['KLR20']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR20'];
                                    }?></td>
                            <td align="right"><? if($data['KLR21']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR21'];
                                    }?></td>
                            <td align="right"><? if($data['KLR22']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR22'];
                                    }?></td>
                            <td align="right"><? if($data['KLR23']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR23'];
                                    }?></td>
                            <td align="right"><? if($data['KLR24']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR24'];
                                    }?></td>
                            <td align="right"><? if($data['KLR25']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR25'];
                                    }?></td>
                            <td align="right"><? if($data['KLR26']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR26'];
                                    }?></td>
                            <td align="right"><? if($data['KLR27']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR27'];
                                    }?></td>
                            <td align="right"><? if($data['KLR28']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR28'];
                                    }?></td>
                            <td align="right"><? if($data['KLR29']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR29'];
                                    }?></td>
                            <td align="right"><? if($data['KLR30']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR30'];
                                    }?></td>
                            <td align="right"><? if($data['KLR31']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['KLR31'];
                                    }?></td>

                                <? $bulan_klr = $data['KLR01']+ $data['KLR02']+
                                        $data['KLR03']+ $data['KLR04']+
                                        $data['KLR05']+ $data['KLR06']+
                                        $data['KLR07']+ $data['KLR08']+
                                        $data['KLR09']+ $data['KLR10']+
                                        $data['KLR11']+ $data['KLR12']+
                                        $data['KLR13']+ $data['KLR14']+
                                        $data['KLR15']+ $data['KLR16']+
                                        $data['KLR17']+ $data['KLR18']+
                                        $data['KLR19']+ $data['KLR20']+
                                        $data['KLR21']+ $data['KLR22']+
                                        $data['KLR23']+ $data['KLR24']+
                                        $data['KLR25']+ $data['KLR26']+
                                        $data['KLR27']+ $data['KLR28']+
                                        $data['KLR29']+ $data['KLR30']+
                                        $data['KLR31'];?>

                            <td align="right"><?=$bulan_klr?></td>
                            <td align="right"><? if($data['STOKAKHIR']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['STOKAKHIR'];
                                    }?></td>
                            <td align="right"><? if($data['harga']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['harga'];
                                    }?></td>
                            <td align="right"><?=$data['STOKAKHIR'] *  $data['harga'];?></td>
                        </tr>
                            <?	$x++;
                        } ?>
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
    $sql_lastdate = "SELECT '".$tahun."-".$bl."-01' - INTERVAL 1 MONTH AS LASTDATE";
    $get_lastdate = mysql_query($sql_lastdate);
    $dat_lastdate = mysql_fetch_assoc($get_lastdate);
    $lastdate = $dat_lastdate['LASTDATE'];

    $sql_excel="SELECT
	  m_barang.kode_barang AS KODE,
	  m_barang.nama_barang AS NAMA_BARANG,
	  m_barang.satuan AS SATUAN,
	  (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = YEAR(".$lastdate.") 		
			AND MONTH(tanggal) = MONTH(".$lastdate.") 
			AND KDUNIT = ".$unit."																																  			ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS SALDO_BULAN_LALU, 
	  view_lap_unit_bulanan.TRM01 +
	  view_lap_unit_bulanan.TRM02 +
	  view_lap_unit_bulanan.TRM03 +
	  view_lap_unit_bulanan.TRM04 +
	  view_lap_unit_bulanan.TRM05 +
	  view_lap_unit_bulanan.TRM06 +
	  view_lap_unit_bulanan.TRM07 AS PEN_MINGGU_I,
	  
	  view_lap_unit_bulanan.TRM08 +
	  view_lap_unit_bulanan.TRM09 +
	  view_lap_unit_bulanan.TRM10 +
	  view_lap_unit_bulanan.TRM11 +
	  view_lap_unit_bulanan.TRM12 +
	  view_lap_unit_bulanan.TRM13 +
	  view_lap_unit_bulanan.TRM14 AS PEN_MINGGU_II,
	  
	  view_lap_unit_bulanan.TRM15 +
	  view_lap_unit_bulanan.TRM16 +
	  view_lap_unit_bulanan.TRM17 +
	  view_lap_unit_bulanan.TRM18 +
	  view_lap_unit_bulanan.TRM19 +
	  view_lap_unit_bulanan.TRM20 +
	  view_lap_unit_bulanan.TRM21 AS PEN_MINGGU_III,
	  
	  view_lap_unit_bulanan.TRM22 +
	  view_lap_unit_bulanan.TRM23 +
	  view_lap_unit_bulanan.TRM24 +
	  view_lap_unit_bulanan.TRM25 +
	  view_lap_unit_bulanan.TRM26 +
	  view_lap_unit_bulanan.TRM27 +
	  view_lap_unit_bulanan.TRM28 AS PEN_MINGGU_IV,
	  
	  view_lap_unit_bulanan.TRM29 +
	  view_lap_unit_bulanan.TRM30 +
	  view_lap_unit_bulanan.TRM31 AS PEN_MINGGU_V,
	  
	  
	  view_lap_unit_bulanan.TRM01 +
	  view_lap_unit_bulanan.TRM02 +
	  view_lap_unit_bulanan.TRM03 +
	  view_lap_unit_bulanan.TRM04 +
	  view_lap_unit_bulanan.TRM05 +
	  view_lap_unit_bulanan.TRM06 +
	  view_lap_unit_bulanan.TRM07 +
	  view_lap_unit_bulanan.TRM08 +
	  view_lap_unit_bulanan.TRM09 +
	  view_lap_unit_bulanan.TRM10 +
	  view_lap_unit_bulanan.TRM11 +
	  view_lap_unit_bulanan.TRM12 +
	  view_lap_unit_bulanan.TRM13 +
	  view_lap_unit_bulanan.TRM14 +
	  view_lap_unit_bulanan.TRM15 +
	  view_lap_unit_bulanan.TRM16 +
	  view_lap_unit_bulanan.TRM17 +
	  view_lap_unit_bulanan.TRM18 +
	  view_lap_unit_bulanan.TRM19 +
	  view_lap_unit_bulanan.TRM20 +
	  view_lap_unit_bulanan.TRM21 +
	  view_lap_unit_bulanan.TRM22 +
	  view_lap_unit_bulanan.TRM23 +
	  view_lap_unit_bulanan.TRM24 +
	  view_lap_unit_bulanan.TRM25 +
	  view_lap_unit_bulanan.TRM26 +
	  view_lap_unit_bulanan.TRM27 +
	  view_lap_unit_bulanan.TRM28 +
	  view_lap_unit_bulanan.TRM29 +
	  view_lap_unit_bulanan.TRM30 +
	  view_lap_unit_bulanan.TRM31 AS TERIMA_JUMLAH,

	  view_lap_unit_bulanan.KLR01 AS K_01,
	  view_lap_unit_bulanan.KLR02 AS K_02,
	  view_lap_unit_bulanan.KLR03 AS K_03,
	  view_lap_unit_bulanan.KLR04 AS K_04,
	  view_lap_unit_bulanan.KLR05 AS K_05,
	  view_lap_unit_bulanan.KLR06 AS K_06,
	  view_lap_unit_bulanan.KLR07 AS K_07,
	  view_lap_unit_bulanan.KLR08 AS K_08,
	  view_lap_unit_bulanan.KLR09 AS K_09,
	  view_lap_unit_bulanan.KLR10 AS K_10,
	  view_lap_unit_bulanan.KLR11 AS K_11,
	  view_lap_unit_bulanan.KLR12 AS K_12,
	  view_lap_unit_bulanan.KLR13 AS K_13,
	  view_lap_unit_bulanan.KLR14 AS K_14,
	  view_lap_unit_bulanan.KLR15 AS K_15,
	  view_lap_unit_bulanan.KLR16 AS K_16,
	  view_lap_unit_bulanan.KLR17 AS K_17,
	  view_lap_unit_bulanan.KLR18 AS K_18,
	  view_lap_unit_bulanan.KLR19 AS K_19,
	  view_lap_unit_bulanan.KLR20 AS K_20,
	  view_lap_unit_bulanan.KLR21 AS K_21,
	  view_lap_unit_bulanan.KLR22 AS K_22,
	  view_lap_unit_bulanan.KLR23 AS K_23,
	  view_lap_unit_bulanan.KLR24 AS K_24,
	  view_lap_unit_bulanan.KLR25 AS K_25,
	  view_lap_unit_bulanan.KLR26 AS K_26,
	  view_lap_unit_bulanan.KLR27 AS K_27,
	  view_lap_unit_bulanan.KLR28 AS K_28,
	  view_lap_unit_bulanan.KLR29 AS K_29,
	  view_lap_unit_bulanan.KLR30 AS K_30,
	  view_lap_unit_bulanan.KLR31 AS K_31,
	  
	  view_lap_unit_bulanan.KLR01 +
	  view_lap_unit_bulanan.KLR02 + 
	  view_lap_unit_bulanan.KLR03 +
	  view_lap_unit_bulanan.KLR04 +
	  view_lap_unit_bulanan.KLR05 +
	  view_lap_unit_bulanan.KLR06 +
	  view_lap_unit_bulanan.KLR07 +
	  view_lap_unit_bulanan.KLR08 +
	  view_lap_unit_bulanan.KLR09 +
	  view_lap_unit_bulanan.KLR10 +
	  view_lap_unit_bulanan.KLR11 +
	  view_lap_unit_bulanan.KLR12 +
	  view_lap_unit_bulanan.KLR13 +
	  view_lap_unit_bulanan.KLR14 +
	  view_lap_unit_bulanan.KLR15 +
	  view_lap_unit_bulanan.KLR16 +
	  view_lap_unit_bulanan.KLR17 +
	  view_lap_unit_bulanan.KLR18 +
	  view_lap_unit_bulanan.KLR19 +
	  view_lap_unit_bulanan.KLR20 +
	  view_lap_unit_bulanan.KLR21 +
	  view_lap_unit_bulanan.KLR22 +
	  view_lap_unit_bulanan.KLR23 +
	  view_lap_unit_bulanan.KLR24 +
	  view_lap_unit_bulanan.KLR25 +
	  view_lap_unit_bulanan.KLR26 +
	  view_lap_unit_bulanan.KLR27 +
	  view_lap_unit_bulanan.KLR28 +
	  view_lap_unit_bulanan.KLR29 +
	  view_lap_unit_bulanan.KLR30 +
	  view_lap_unit_bulanan.KLR31 AS KELUAR_JUMLAH,
      (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' 	
			AND MONTH(tanggal) = '".$bulan."' 
			AND KDUNIT = ".$unit."	
			ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOK_AKHIR,
	  m_barang.harga AS HARGA_SATUAN,
	  m_barang.harga * (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' 	
			AND MONTH(tanggal) = '".$bulan."' 
			AND KDUNIT = ".$unit."	
			ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS JUMLAH_RP
    FROM
      m_barang LEFT JOIN view_lap_unit_bulanan ON m_barang.kode_barang=view_lap_unit_bulanan.KODE AND TAHUN = '".$tahun."' AND BULAN = '".$bulan."' AND UNIT = ".$unit."
WHERE  m_barang.farmasi = '".$c."' AND m_barang.group_barang = '".$group."' AND m_barang.hide_when_print = '0' 
".$search;
    ?>

    <form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
        <input type="hidden" name="query" value="<?=$sql_excel?>" />
        <input type="hidden" name="header" value="LAPORAN PENERIMAAN & PENGELUARAN BARANG BULAN <?=$bulan_name." ".$tahun?>" />
        <input type="hidden" name="filename" value="laporan_bulanan" />
        <input type="submit" value="Export To Ms Excel Document" class="text" />
    </form>
</div>
<p></p>

