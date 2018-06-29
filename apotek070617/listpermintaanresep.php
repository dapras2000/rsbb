<?php 
session_start();
include("./include/connect.php");
include('apotek/ps_pagination.php');

$search = "";
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])) {
    $tgl_kunjungan =$_GET['tgl_kunjungan'];
} 

if($tgl_kunjungan !="") {
    $search = " AND view_orderresep2.TANGGAL BETWEEN  '".$tgl_kunjungan."' ";
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
    $search = $search." AND view_orderresep2.NOMR = '".$norm."' ";
}

$nama = "";
if(!empty($_GET['nama'])) {
    $nama =$_GET['nama'];
} 

if($nama !="") {
    $search = $search." AND view_orderresep.NAMA LIKE '%".$nama."%' ";
}

$sql = "SELECT DISTINCT
                  view_orderresep.CARABAYAR,
                  view_orderresep.NOMR,
                  view_orderresep.NAMA,
                  view_orderresep.ALAMAT,
                  view_orderresep.NAMADOKTER,
                  view_orderresep.KDPOLY,
                  view_orderresep.NAMAPOLY,
                  view_orderresep.NORESEP,
                  view_orderresep.TANGGAL,
                  CONCAT(view_orderresep.NORESEP, MONTH(view_orderresep.TANGGAL), YEAR(view_orderresep.TANGGAL)) AS XNORESEP,
                  view_orderresep.NAMAOBAT,
                  view_orderresep.NIP,
                  view_orderresep.IDXRESEP
                FROM
                  view_orderresep
				WHERE view_orderresep.STATUS = '0' ".$search;

/*
NAMPILAN RAJAL
$sql = "SELECT DISTINCT
            t_billrajal.IDXBILL,
            t_billrajal.TANGGAL,
            t_billrajal.NOMR,
            t_billrajal.CARABAYAR,
            m_dokter.NAMADOKTER,
            m_unit.nama_unit,
            m_pasien.NAMA,
            m_pasien.ALAMAT
        FROM t_billrajal
            INNER JOIN m_dokter ON (t_billrajal.KDDOKTER = m_dokter.KDDOKTER)
            INNER JOIN m_unit   ON (t_billrajal.UNIT = m_unit.kode_unit)
            INNER JOIN m_pasien ON (t_billrajal.NOMR = m_pasien.NOMR)
        ORDER BY t_billrajal.TANGGAL DESC
        ";*/

/*
NAMPILAN RANAP
$sql = "SELECT DISTINCT
            t_billranap.IDXBILL,
            t_billranap.TANGGAL,
            t_billranap.NOMR,
            t_billranap.CARABAYAR,
            m_dokter.NAMADOKTER,
            m_unit.nama_unit,
            m_pasien.NAMA,
            m_pasien.ALAMAT
        FROM t_billranap
            INNER JOIN m_dokter ON (t_billranap.KDDOKTER = m_dokter.KDDOKTER)
            INNER JOIN m_unit   ON (t_billranap.UNIT = m_unit.kode_unit)
            INNER JOIN m_pasien ON (t_billranap.NOMR = m_pasien.NOMR)
        ORDER BY t_billranap.TANGGAL DESC
        ";*/

$qry_order = mysql_query($sql);
$order = mysql_fetch_assoc($qry_order);
?>
<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>LIST DATA PERMINTAAN RESEP</h3></div>
        <div align="right" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table width="248" border="0" cellspacing="0" class="tb">
                    <tr>
                        <td width="52">No RM</td>
                        <td width="192"><input type="text" name="norm" id="norm" value="<? if($norm!="") {
                                                   echo $norm;
}?>" class="text"></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td><input type="text" name="nama" id="nama" value="<? if($nama!="") {
    echo $nama;
}?>" class="text"></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text"
                                   value="<? if($tgl_kunjungan!="") {
    echo $tgl_kunjungan;
}?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Sd</td>
                        <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text"
                                   value="<? if($tgl_kunjungan2!="") {
    echo $tgl_kunjungan2;
}?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Cari" class="text"/>
                            <input type="hidden" name="link" value="10" /></td>
                    </tr>
                </table>

            </form>

            <div id="table_search">
                <table width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" class="tb">
                    <tr align="center">
                        <th>DOKTER</th>
                        <th>UNIT/RUANG</th>
                        <th>TANGGAL</th>
                        <th>NO RM</th>
                        <th>NAMA PASIEN</th>
                        <th>ALAMAT</th>
                        <th>CARA BAYAR</th>
                        <th>&nbsp;</th>
                    </tr>
                    <?
                    $pager = new PS_Pagination($connect, $sql, 15, 5, "param1=valu1&param2=value2", "index.php?link=10&");

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
                        <td><? echo $data['NAMADOKTER'];?></td>
                        <td><? echo $data['NAMAPOLY']; ?></td>
                        <td><? echo $data['TANGGAL']; ?></td>
                        <td><? echo $data['NOMR']; ?></td>
                        <td><? echo $data['NAMA']; ?></td>
                        <td><? echo $data['ALAMAT']; ?></td>
                        <td><? echo $data['CARABAYAR']; ?></td>
                        <td><a href="index.php?link=101&noresep=<? echo $data['XNORESEP']; ?>"><input type="button" value="PROSES" class="text" /></a></td>
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
</div>
<p></p>
