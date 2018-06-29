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
$search = ' and (j.TANGGAL BETWEEN "'.$start.'" and "'.$end.'")';

$norm = "";
if(!empty($_GET['norm'])) {
    $norm =$_GET['norm'];
} 

if($norm !="") {
    $search = $search." AND j.NOMR = '".$norm."' ";
}

$nama = "";
if(!empty($_GET['nama'])) {
    $nama =$_GET['nama'];
} 

if($nama !="") {
    $search = $search." AND k.NAMA LIKE '%".$nama."%' ";
}
?>

<div align="center">
    <div id="frame" style="width: 100%;">
        <div id="frame_title"><h3>LIST BILLING PASIEN LAB YANG BELUM DI BAYAR</h3></div>
        <div align="right" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table width="248" border="0" cellspacing="0" class="tb">
                <tr><td width="52">No RM</td> <td width="192"><input type="text" name="norm" id="norm" value="<? if($norm!="") { echo $norm; }?>" class="text" style="width:80px;"></td></tr>
                <tr><td>Nama</td><td><input type="text" name="nama" id="nama" value="<? if($nama!="") { echo $nama; }?>" class="text"></td></tr>
                <tr><td>Tanggal</td><td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" style="width:100px;" value="<? if($_REQUEST['tgl_kunjungan'] !=""): echo $_REQUEST['tgl_kunjungan']; else: echo date('Y/m/d'); endif; ?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td></tr>
                <tr><td>Sd</td><td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" style="width:100px;" value="<? if($_REQUEST['tgl_kunjungan2'] !=""): echo $_REQUEST['tgl_kunjungan2']; else: echo date('Y/m/d'); endif; ?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td></tr>
                <tr><td>&nbsp;</td><td><input type="submit" value="Cari" class="text"/><input type="hidden" name="link" value="sisipan_lab" /></td></tr>
                </table>

            </form>
            <div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
				<tr align="center" style="width:20px;"><th>No</th><th style="width:80px;">TGL Daftar</th><th style="width:80px;">No RM</th><th>Nama Pasien</th><th>Poli/ Ruang</th><th>Dokter</th><th width="70px">Cara Bayar</th><th width="100px">&nbsp;</th></tr>
                    <?
                    $NO=0;
                    $sql = 'SELECT j.IDXDAFTAR, j.TANGGAL, j.DRPENGIRIM, m.NAMADOKTER, j.KDPOLY, n.NAMA AS POLY, j.NOMR, k.NAMA AS NAMA, l.carabayar, o.NAMA AS CARABAYAR, l.NOBILL
FROM t_orderlab j
JOIN m_pasien k ON k.nomr = j.nomr
JOIN t_bayarrajal l ON l.idxdaftar = j.idxdaftar
JOIN m_dokter m ON m.kddokter = j.drpengirim
JOIN m_poly n ON n.KODE = j.KDPOLY
JOIN m_carabayar o ON o.KODE = l.carabayar
WHERE l.STATUS != "LUNAS" '.$search.' group by j.IDXDAFTAR, j.TANGGAL, j.DRPENGIRIM, m.NAMADOKTER, j.KDPOLY';
                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan."&nama=".$nama."&norm=".$norm,"index.php?link=sisipan_lab&");
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
					$i = 1;
					$count = 1;
                    while($data = mysql_fetch_array($rs)) {?>
                    <?php
                        $count++;
                        if ($count % 2){
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
                        <td><? echo $data['TANGGAL'];?></td>
                        <td><? echo $data['NOMR'];?></td>
                        <td><? echo $data['NAMA']; ?></td>
                        <td><?php echo $data['POLY'];?></td>
                        <td><? echo $data['NAMADOKTER']; ?></td>
                        <td><? echo $data['CARABAYAR']; ?></td>
                        <td>
						<?php
							echo '<a href="'._BASE_.'index.php?link=detail_billing_lab&nomr='.$data['NOMR'].'&idx='.$data['IDXDAFTAR'].'&nobill='.$data['NOBILL'].'"><input type="button" value="PROSESS" class="text"/></a>';
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