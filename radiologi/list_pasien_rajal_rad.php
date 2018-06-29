<?php #session_start();
#include("./include/connect.php");
require_once('ps_pagination.php');

$start 	= date('Y-m-d');
$end 	= date('Y-m-d');
if($_REQUEST['tgl_kunjungan'] != ''){
	$start = $_REQUEST['tgl_kunjungan'];
}
if($_REQUEST['tgl_kunjungan2'] != ''){
	$end = $_REQUEST['tgl_kunjungan2'];
}

#$search = '';
$search = ' and (a.TGLREG BETWEEN "'.$start.'" and "'.$end.'")';

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
    $search = $search." AND b.NAMA LIKE '%".$nama."%' ";
}
?>

<div align="center">
    <div id="frame" style="width: 100%;">
        <div id="frame_title"><h3>LIST PASIEN RAWAT JALAN</h3></div>
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
                            <input type="hidden" name="link" value="list_pasien_rajal_rad" /></td>
                    </tr>
                </table>

            </form>
            <div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
				<tr align="center"><th>No</th><th>TGL Daftar</th><th>No RM</th><th>Nama Pasien</th><th>Poli/ Ruang</th><th>Dokter</th><th width="70px">Cara Bayar</th><th width="200px">&nbsp;</th></tr>
                    <?
                    $NO=0;
                    $sql = 'SELECT a.IDXDAFTAR, a.TGLREG, a.NOMR, a.KDPOLY, a.KDDOKTER, a.KDCARABAYAR, b.NAMA, c.nama AS poly, d.NAMADOKTER AS dokter, e.NAMA AS carabayar
FROM t_pendaftaran a
JOIN m_pasien b ON b.NOMR = a.NOMR
JOIN m_poly c ON c.kode = a.KDPOLY
JOIN m_dokter d ON d.KDDOKTER = a.KDDOKTER
JOIN m_carabayar e ON e.KODE = a.KDCARABAYAR
					where a.KDPOLY != 0 '.$search.' order by a.TGLREG asc';
                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan."&nama=".$nama."&norm=".$norm,"index.php?link=6&");
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
					$i = 1;
					$count = 1;
                    while($data = mysql_fetch_array($rs)) {?>
                    <?php
                        $count++;
                        if ($count % 2) {
                                echo '<tr class="tr1">';
    					}else{
								echo '<tr class="tr1">';
                        }
                         ?>
                        <td>
						<?php
						if( (!isset($_REQUEST['page'])) or ($_REQUEST['page'] == 1) ){
							echo $i;
						}else{
							echo ($_REQUEST['page'] - 1) * 15 + $i;
						}
						?></td>
                        <td><? echo $data['TGLREG'];?></td>
                        <td><? echo $data['NOMR'];?></td>
                        <td><? echo $data['NAMA']; ?></td>
                        <td><?php echo $data['poly'];?></td>
                        <td><? echo $data['dokter']; ?></td>
                        <td><? echo $data['carabayar']; ?></td>
                        <td>
						<?php
							echo '<a href="'._BASE_.'index.php?link=72formorderrad_rajal&nomr='.$data['NOMR'].'&idx='.$data['IDXDAFTAR'].'"><input type="button" value="TAMBAH PEMERIKSAAN" class="text"/></a>';
						?>
                        </td>
                    </tr>
                        <?	$i++;
						}

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