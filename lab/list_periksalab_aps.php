<?php session_start();
include("../include/connect.php");
require_once('ps_pagination.php');

$start 	= date('Y-m-d');
$end 	= date('Y-m-d');
if($_REQUEST['tgl_kunjungan'] != ''){
	$start = $_REQUEST['tgl_kunjungan'];
}
if($_REQUEST['tgl_kunjungan2'] != ''){
	$end = $_REQUEST['tgl_kunjungan2'];
}
$search = 'and a.tanggal BETWEEN "'.$start.'" and "'.$end.'"';
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
    #$search = $search." AND b.NAMA LIKE '%".$nama."%' ";
	#$nama	= 'AND b.NAMA LIKE "%'.$nama.'%';
}

?>

<div align="center">
    <div id="frame" style="width: 100%;">
        <div id="frame_title"><h3>LIST ORDER LAB</h3></div>
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
                                   value="<? if($_REQUEST['tgl_kunjungan'] !=""): echo $_REQUEST['tgl_kunjungan']; else: echo date('Y/m/d'); endif; ?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Sd</td>
                        <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" style="width:100px;"
                                   value="<? if($_REQUEST['tgl_kunjungan2'] !=""): echo $_REQUEST['tgl_kunjungan2']; else: echo date('Y/m/d'); endif; ?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Cari" class="text"/>
                            <input type="hidden" name="link" value="6order" /></td>
                    </tr>
                </table>

            </form>
            <div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr align="center">
                        <th>No</th>
                        <th>No RM</th>
                        <th>Tanggal</th>
                        <th>Nama Pasien</th>
                        <th>Alamat</th>
                        <th>Poli/ Ruang</th>
                        <th>Dokter Pengirim</th>
                        <th>Cara Bayar</th>
                        <th>Rujukan</th>
                        <th>&nbsp;</th>
                    </tr>
                    <?
                    $NO		= 0;
					$sql	= 'SELECT DISTINCT a.nomr,a.idxdaftar,a.tanggal,a.KDPOLY, a.DRPENGIRIM, a.RAJAL,
CASE aps WHEN 1 THEN 
(SELECT nama FROM m_pasien_aps b WHERE b.NOMR=a.NOMR ) 
ELSE 
(SELECT nama FROM m_pasien b WHERE b.NOMR=a.NOMR) END AS nama,
CASE aps WHEN 1 THEN
(SELECT alamat FROM m_pasien_aps b WHERE b.NOMR=a.NOMR) 
ELSE 
(SELECT alamat FROM m_pasien b WHERE b.NOMR=a.NOMR) END AS alamat,
CASE aps WHEN 1 THEN
(SELECT kdcarabayar FROM m_pasien_aps b WHERE b.NOMR=a.NOMR) 
ELSE 
(SELECT kdcarabayar FROM m_pasien b WHERE b.NOMR=a.NOMR) END AS KDCARABAYR,
CASE aps WHEN 1 THEN
(SELECT c.nama FROM m_carabayar c , m_pasien_aps p WHERE c.kode=p.kdcarabayar AND a.nomr=p.nomr) 
ELSE 
(SELECT c.nama FROM m_carabayar c , m_pasien p WHERE c.kode=p.kdcarabayar AND a.nomr=p.nomr)  END AS carabayar,
CASE rajal WHEN 1 THEN
(SELECT m_unit.nama_unit FROM m_unit WHERE m_unit.kode_unit = a.KDPOLY) 
ELSE 
(SELECT m_ruang.nama FROM m_ruang WHERE m_ruang.no = a.KDPOLY) END AS poly_kelas,
m_dokter.NAMADOKTER
FROM t_orderlab a
LEFT JOIN m_dokter ON m_dokter.KDDOKTER = a.DRPENGIRIM 
INNER JOIN m_pasien_aps b ON a.nomr = b.nomr AND b.nama LIKE "%'.$nama.'%"
where a.STATUS = 0 
AND b.NAMA LIKE "%'.$nama.'%" '.$search; 
                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan."&nama=".$nama."&norm=".$norm,"index.php?link=6&");
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
                        <td><? echo $data['nomr'];?></td>
                        <td><? echo $data['tanggal']; ?></td>
                        <td><? echo $data['nama']; ?></td>
                        <td><? echo $data['alamat']; ?></td>
                        <td><? echo $data['poly_kelas']; ?></td>
                        <td><? echo $data['NAMADOKTER']; ?></td>
                        <td><? echo $data['carabayar'];?></td>
                        <td><? echo $data['RUJUKAN'];?></td>
                        <td><a href="index.php?link=62&amp;nomr=<?php echo $data['nomr']?>&idx=<?php echo $data['idxdaftar']?>&rajal=<?php echo $data['RAJAL']?>" ><input type="button" value="PERIKSA" class="text"/></a></td>
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
    $qry_excel = "SELECT DISTINCT view_orderlab.TANGGAL,
					view_orderlab.NOMR, 
					view_orderlab.NAMA AS NAMA_PASIEN,
					view_orderlab.ALAMAT, 
					view_orderlab.POLY, 
					view_orderlab.NAMADOKTER AS DOKTER_PENGIRIM, 
					view_orderlab.CARABAYAR AS STATUS_BAYAR,
  					view_orderlab.RUJUKAN
			FROM view_orderlab 
			WHERE view_orderlab.STATUS = '0' ".$search;
?>
    <div align="left">
        <form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
            <input type="hidden" name="query" value="<?=$qry_excel?>" />
            <input type="hidden" name="header" value="LIST ORDER LABORATORIUM" />
            <input type="hidden" name="filename" value="list_lab" />
            <input type="submit" value="Export To Ms Excel Document" class="text" />
        </form>
    </div>
</div>