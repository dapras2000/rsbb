<?php 
session_start();
include("ps_pagination.php");

$sql="SELECT t_barang_stok.kd_stok,
t_barang_stok.kode_barang, t_barang_stok.tanggal,
t_barang_stok.masuk, t_barang_stok.keluar,
t_barang_stok.saldo, t_barang_stok.KDUNIT,
m_barang.no_batch
FROM t_barang_stok
INNER JOIN m_barang ON (t_barang_stok.kode_barang = m_barang.kode_barang)
WHERE t_barang_stok.kode_barang = ".$_GET['kode']." AND t_barang_stok.KDUNIT = '".$_GET['unit']."'
AND MONTH(t_barang_stok.tanggal) = ".$_GET['bulan']." AND YEAR(t_barang_stok.tanggal) = ".$_GET['tahun'];

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

        $sql_unit = "SELECT DEPARTEMEN FROM m_login where KDUNIT = ".$unit;
        $get_unit = mysql_query($sql_unit);
        $dat_unit = mysql_fetch_assoc($get_unit);
        ?>

        <div id="frame_title"><h3>KARTU STOCK</h3></div>
        <div align="center" style="margin:5px;">
            <div id="table_search">
                <div align="left">


                    <table class="tb" >
                        <tr>
                            <td>Kode</td>
                            <td>: <?=$_GET['kode']?></td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td>: <?=$_GET['nama']?></td>
                        </tr>
                        <tr>
                            <td>Unit</td>
                            <td>: <?=$dat_unit['DEPARTEMEN']?></td>
                        </tr>
                        <tr>
                            <td>Periode</td>
                            <td>: <?=$bulan_name." ".$_GET['tahun']?></td>
                        </tr>
                    </table>
                    <table border="0" cellspacing="1" cellpadding="1" bordercolor="#999999" class="tb" width="50%">
                        <tr>
                            <th rowspan="2" width="20%" align="center">Tanggal</th>
                            <th colspan="3" align="center">Banyaknya</th>
                            <th rowspan="2" width="20%" align="center">No Batch</th>
                        </tr>
                        <tr>
                            <th align="center">Masuk</th>
                            <th align="center">Keluar</th>
                            <th align="center">Sisa</th>
                        </tr>
                        <?

                        $pager = new PS_Pagination($connect, $sql, 15, 5, "bulan=".$_GET['bulan']."&tahun=".$_GET['tahun']."&kode=".$_GET['kode']."&nama=".$_GET['nama']."&unit=".$_GET['unit'], "index.php?link=g06x&");

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
                            <td><?=$data['tanggal']?></td>
                            <td><?=$data['masuk']?></td>
                            <td><?=$data['keluar']?></td>
                            <td><?=$data['saldo']?></td>
                            <td><?=$data['no_batch']?></td>
                        </tr>
                            <?	$x++;
                        } ?>
                    </table>
                </div>
                <?

                //Display the full navigation in one go
                //echo $pager->renderFullNav();

                //Or you can display the inidividual links
                echo "<div style='padding:5px;' align=\"left\"><br />";

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



