<?php 
session_start();
include("./include/connect.php");
include('apotek/ps_pagination.php');

$search 	= " AND tgl_pesan = curdate()";
$tgl_kunjungan 	= "";
if(!empty($_GET['tgl_kunjungan'])) {
    $tgl_kunjungan =$_GET['tgl_kunjungan'];
}
if($tgl_kunjungan !="") {
    $search = "  and tgl_pesan BETWEEN  '".$tgl_kunjungan."' ";
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
    $search = $search." AND a.norm = '".$norm."' ";
}

$nama = "";
if(!empty($_GET['nama'])) {
    $nama =$_GET['nama'];
} 

if($nama !="") {
    $search = $search." AND d.NAMA LIKE '%".$nama."%' ";
}

$sql = 'Select b.NAMADOKTER as namadokter, c.nama as namapoli, DATE_FORMAT(a.tgl_pesan, "%d -%m -%Y") as tgl_pesan, a.norm as NOMR, d.NAMA as NAMA, 
		d.ALAMAT as ALAMAT, e.NAMA as carabayar, a.idxdaftar, a.no
		from t_permintaan_apotek_rajal a
		JOIN m_dokter b ON a.kddokter=b.KDDOKTER
		JOIN m_poly c ON a.kdpoli=c.kode
		JOIN m_pasien d ON a.norm=d.NOMR
		JOIN m_carabayar e ON a.kdcarabayar=e.KODE
		WHERE a.status_save="0" '.$search.' group by a.tgl_pesan, a.no, a.idxdaftar order by a.idxpesanobat asc' ;





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
                                   value="<? if($_REQUEST['tgl_kunjungan'] !=""): echo $_REQUEST['tgl_kunjungan']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Sd</td>
                        <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text"
                                   value="<? if($_REQUEST['tgl_kunjungan2'] !=""): echo $_REQUEST['tgl_kunjungan2']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Cari" class="text"/>
                            <input type="hidden" name="link" value="10permintaan" /></td>
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
                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan."&tgl_kunjungan2=".$tgl_kunjungan2, "index.php?link=10permintaan&");

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
                        <td><? echo $data['namadokter'];?></td>
                        <td><? echo $data['namapoli']; ?></td>
                        <td><? echo $data['tgl_pesan']; ?></td>
                        <td><? echo $data['NOMR']; ?></td>
                        <td><? echo $data['NAMA']; ?></td>
                        <td><? echo $data['ALAMAT']; ?></td>
                        <td><? echo $data['carabayar']; ?></td>
                       <td><a href="index.php?link=10proses&no=<?=$data['no']?>"><input type="button" value="PROSES" class="text" /></a></td>
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
