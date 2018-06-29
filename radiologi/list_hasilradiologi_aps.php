<?php 
session_start();
#REQUIRE_ONCE("class/object.inc");
#include("models/list_data_pasien.php"); 
include("include/connect.php");
require_once('ps_pagination.php');

$search = " AND TGLORDER = curdate() ";
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])) {
    $tgl_kunjungan =$_GET['tgl_kunjungan'];
}

if($tgl_kunjungan !="") {
    $search = " AND a.TGLORDER BETWEEN  '".$tgl_kunjungan."' ";
}

$tgl_kunjungan2 = "";
if(!empty($_GET['tgl_kunjungan2'])) {
    $tgl_kunjungan2 =$_GET['tgl_kunjungan2'];
}


if($tgl_kunjungan !="") {
    if($tgl_kunjungan2 !="") {
        $search = $search." AND '".$tgl_kunjungan2."' ";
    }else {
        $search = $search." AND '".$tgl_kunjungan."' ";
    }
}
$norm = "";
if(!empty($_GET['norm'])) {
    $norm =$_GET['norm'];
}

if($norm !="") {
    $search = $search." AND a.NOMR = '".$norm."' ";
}

$nama = "";
if(!empty($_GET['nama'])) {
    $nama =$_GET['nama'];
}

if($nama !="") {
    $search = $search." AND e.NAMA LIKE '%".$nama."%' ";
}
?>

<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>LIST HASIL RADIOLOGI APS</h3>
        </div>
        <div align="right" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table border="0" cellspacing="0" class="tb">
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
                            <input type="hidden" name="link" value="r05" /></td>
                    </tr>
                </table>
            </form>
            <div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr align="center">
                        <th>No</th>
                        <th>No Foto</th>
                        <th>NOMR</th>
                        <th>Nama Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Nama Poliklinik Pengirim</th>
                        <th>Nama Dokter Pengirim</th>
                        <th>Permintaan Photo</th>
                        <th>Cara Pembayaran</th>
                        <th>Jenis Film</th>
                        <th>&nbsp;</th>
                    </tr>
                    <?
                    /* $sql="SELECT DISTINCT
			  t_orderlab.NOMR,
			  t_orderlab.IDXDAFTAR,
			  t_orderlab.TANGGAL,
			  m_pasien.NAMA,
			  m_pasien.ALAMAT,
			  m_poly.nama AS POLY,
			  m_dokter.NAMADOKTER,
			  m_carabayar.NAMA AS CARABAYAR,
			  m_rujukan.NAMA AS RUJUKAN
			FROM
			  t_orderlab
			  INNER JOIN m_pasien ON (t_orderlab.NOMR = m_pasien.NOMR)
			  INNER JOIN m_poly ON (t_orderlab.KDPOLY = m_poly.kode)
			  INNER JOIN t_pendaftaran ON (t_orderlab.IDXDAFTAR = t_pendaftaran.IDXDAFTAR)
			  INNER JOIN m_carabayar ON (t_pendaftaran.KDCARABAYAR = m_carabayar.KODE)
			  INNER JOIN m_rujukan ON (t_pendaftaran.KDRUJUK = m_rujukan.KODE)
			  INNER JOIN m_dokter ON (t_orderlab.DRPENGIRIM = m_dokter.KDDOKTER)
			WHERE  t_orderlab.STATUS = '0' ".$search;
                    */

                    $sql = "select a.IDXORDERRAD, f.IDXDAFTAR, a.TGLORDER,
                                    a.NOMR, e.NAMA, g.NAMA AS NAMABAYAR, a.NO_FILM, e.JENISKELAMIN,
                                    (year(now()) - year(e.TGLLAHIR)) AS USIA,
                                    m.nama_rad, a.jenisfilm
                                    from t_radiologi_aps a
                                    join m_pasien_aps e
                                    join t_pendaftaran_aps f
                                    join m_carabayar g
                                    join m_radiologi m
                            where a.IDXDAFTAR = f.IDXDAFTAR
                                    and f.KDCARABAYAR = g.KODE
                                    and a.NOMR = e.NOMR
                                    and m.kd_rad = a.JENISPHOTO
                                    and (a.jenisfilm <> '' and a.jenisfilm is not null) ".$search;
                    $NO=0;
                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan."&tgl_kunjungan2=".$tgl_kunjungan2."&nama=".$nama."&norm=".$norm,"index.php?link=r05&");
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
                        <td><?php echo $data['NO_FILM']; ?></td>
                        <td><?php echo $data['NOMR']; ?></td>
                        <td><?php echo $data['NAMA']; ?></td>
                        <td><?php echo $data['JENISKELAMIN']; ?></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><?php echo $data['nama_rad']; ?></td>
                        <td><?php echo $data['NAMABAYAR']; ?></td>
                        <td><?php echo $data['jenisfilm']; ?></td>
                        <td> <? if($data['HASILRESUME']=="") {?>
                            <a href="index.php?link=r06&amp;idxorder=<?php echo $data['IDXORDERRAD']; ?>&amp;nofilm=<?php echo $data['NO_FILM']; ?>"><input type="button" class="text" value="Periksa"/></a>
        <? }else { ?>
                            <!--<input name="cetakhasil" type="button" value="Cetak Hasil Periksa" class="text" onclick="window.open('radiologi/cetakhasil.php?idorder=<?php echo $data['IDXORDERRAD']; ?>','Window1','menubar=no,width=750,height=600,toolbar=no');"/> -->
                            <a href="radiologi/cetakhasilpdf.php?idorder=<?php echo $data['IDXORDERRAD']; ?>" target="_blank">
                                <img src="radiologi/print.png" border="0" style="cursor: pointer" width="32" height="16" title="Cetak" class="text"/>
                            </a>
        <? } ?></td>
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
        <br />
        <?
        $qry_excel = "SELECT NO_FILM AS NO_FOTO,
            NOMR AS NO_RM,
            NAMA AS NAMA_PASIEN,
            JENISKELAMIN AS JNS_KELAMIN,
            NAMAPOLY AS POLY_PENGIRIM,
            NAMADOKTER AS DOKTER_PENGIRIM,
            nama_rad AS JENIS_PHOTO,
            NAMABAYAR AS CARA_BAYAR
            FROM view_orderrad_dokter WHERE 1 ".$search;
?>

    </div>

</div>
<br>
<div align="left">
    <form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
        <input type="hidden" name="query" value="<?=$qry_excel?>" />
        <input type="hidden" name="header" value="LIST HASIL RADIOLOGI" />
        <input type="hidden" name="filename" value="list_hasil_rad" />
        <input type="submit" value="Export To Ms Excel Document" class="text" />
    </form>
</div>