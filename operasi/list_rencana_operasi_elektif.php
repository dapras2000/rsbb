<?php session_start();
include("../include/connect.php");
require_once('ps_pagination.php');

//$search = " AND MONTH(a.TGLORDER) = MONTH(CURDATE()) AND YEAR(a.TGLORDER) = YEAR(CURDATE()) ";

$tgl_kunjungan 	= date('Y/m/d');
$tgl_kunjungan2 = date('Y/m/d');

if(!empty($_GET['tgl_kunjungan'])) {
    $tgl_kunjungan =$_GET['tgl_kunjungan'];
}
if(!empty($_GET['tgl_kunjungan2'])) {
    $tgl_kunjungan2 =$_GET['tgl_kunjungan2'];
}

$search = 'and (a.TGLORDER BETWEEN "'.$tgl_kunjungan.'" and "'.$tgl_kunjungan2.'")';


$norm = "";
if(!empty($_GET['norm'])) {
    $norm =$_GET['norm'];
}

if($norm !="") {
    $search = $search." AND a.nomr = '".$norm."' ";
}

$nama = "";
if(!empty($_GET['nama'])) {
    $nama =$_GET['nama'];
}

if($nama !="") {
    $search = $search." AND b.NAMA LIKE '%".$nama."%' ";
}
?>

<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>LIST ORDER OPERASI ELEKTIF</h3></div>
        <div align="right" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table width="248" border="0" cellspacing="0" class="tb">
                    <tr>
                        <td width="52">No RM</td>
                        <td width="192"><input type="text" name="norm" id="norm" value="<? if($norm!="") {
                                echo $norm;
                                               }?>" class="text" style="width:80px;"></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td><input type="text" name="nama" id="nama" value="<? if($nama!="") {
                                echo $nama;
                                   }?>" class="text"></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" style="width:100px;"
                                   value="<? if($tgl_kunjungan!="") {
                                       echo $tgl_kunjungan;
                                   }?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td>Sd</td>
                        <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" style="width:100px;"
                                   value="<? if($tgl_kunjungan2!="") {
                                       echo $tgl_kunjungan2;
                                   }?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Cari" class="text"/>
                            <input type="hidden" name="link" value="205" /></td>
                    </tr>
                </table>

            </form>
            <div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr align="center">
                        <th>No</th>
                        <th>Tgl Rencana Operasi</th>
                        <th>NOMR</th>
                        <th>Nama Pasien</th>
                        <th>Diagnosa</th>
                        <th>Dokter Pengirim</th>
                        <th>Poly - Unit</th>
                        <!--<th>Cara Bayar Pasien</th>-->
                        <!--<th>Ket</th>-->
                        <th width="120">&nbsp;</th>
                    </tr>
                    <?
                    #$sql = "select * from view_order_operasi where status is null ".$search." order by id_operasi";
					$sql  = 'SELECT a.*,b.NAMA, c.NAMADOKTER,
CASE a.RAJAL WHEN "1" THEN ( SELECT nama_unit FROM m_unit WHERE m_unit.kode_unit = a.KDUNIT )
ELSE (SELECT CONCAT("Ruang ",m_ruang.nama) FROM m_ruang WHERE m_ruang.no = a.KDUNIT) END AS NAMAPOLY
FROM t_operasi a
JOIN m_pasien b ON b.NOMR = a.nomr 
LEFT JOIN m_dokter c ON c.KDDOKTER = a.DRPENGIRIM 
LEFT JOIN m_unit d ON d.kode_unit = a.KDUNIT
WHERE a.status IS NULL AND a.tanggal IS null '.$search;

                    $NO=0;
                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan."&tgl_kunjungan2=".$tgl_kunjungan2."&nama=".$nama."&norm=".$norm,_BASE_."index.php?link=205&");
                    //The paginate() function returns a mysql result set
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
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
                        <td><? $NO=($NO+1);
                                if ($_GET['page']==0) {
                                    $hal=0;
                                }else {
                                    $hal=$_GET['page']-1;
                                } echo





    ($hal*15)+$NO;?></td>
                        <td><? echo $data['TGLORDER'];?></td>
                        <td><? echo $data['nomr']; ?></td>
                        <td><? echo $data['NAMA']; ?></td>
                        <td><? echo $data['diagnosa']; ?></td>
                        <td><? echo $data['NAMADOKTER']; ?></td>
                        <td><? echo $data['NAMAPOLY']; ?></td>
                        <!--<td><? echo $data['CARABAYAR'];?></td>-->
                        <!--<td><?php if($data['JNSOPERASI']=="c") echo "Cito"; ?></td>-->
                        <td>
                            <a href="index.php?link=201&amp;nomr=<?php echo $data['nomr']?>&amp;idx=<?php echo $data['id_operasi']?>" >
                                <input type="button" value="PROSESS" class="text"/></a> |
                            <a href="operasi/status_operasi.php?idxoperasi=<?=$data['id_operasi']?>&link=<?=$_GET['link']?>&page=<?=$_GET['page']?>" ><input type="button" value="BATAL" class="text" /></a></td>

                    </tr>
                        <?	}

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

                </table>

                <?php

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
    <br />
    <?
    $qry_excel = "SELECT view_order_operasi.TANGGAL AS TGL_RENCANA_OPERASI,
					view_order_operasi.NOMR AS NO_RM,
					view_order_operasi.NAMAPASIEN AS NAMA_PASIEN,
					view_order_operasi.DIAGNOSA,
					view_order_operasi.NAMADOKTER AS DOKTER_PENGIRIM,
					view_order_operasi.NAMAPOLY AS POLY_UNIT_PENGIRIM,
					view_order_operasi.CARABAYAR AS STATUS_BAYAR,
  					view_order_operasi.JNSOPERASI AS KET
			FROM view_order_operasi
			WHERE view_order_operasi.STATUS IS NULL ".$search." order by view_order_operasi.id_operasi";
?>
    <div align="left">
        <form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
            <input type="hidden" name="query" value="<?=$qry_excel?>" />
            <input type="hidden" name="header" value="LIST ORDER OPERASI" />
            <input type="hidden" name="filename" value="list_order_operasi" />
            <input type="submit" value="Export To Ms Excel Document" class="text" />
        </form>
    </div>
</div>
