<?php session_start();
include("../include/connect.php");
require_once('ps_pagination.php');

#select a.UNIT, a.NOMR, a.IDXDAFTAR, a.TGLDAFTAR, a.NIP, a.IDXORDERRAD, b.NAMA, b.ALAMAT, d.NAMA as CARABAYAR,c.nama_unit, e.NAMADOKTER from tmp_cartorderrad a join m_pasien b on a.NOMR = b.NOMR join m_unit c on a.UNIT = c.kode_unit join m_carabayar d on b.KDCARABAYAR = d.KODE join m_dokter e on e.KDDOKTER = a.KDDOKTER group by a.NOMR, a.TGLDAFTAR

/*
$search = " AND a.TGLDAFTAR = curdate() ";
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])) {
    $tgl_kunjungan =$_GET['tgl_kunjungan'];
} 

if($tgl_kunjungan !="") {
    $search = " AND a.TGLDAFTAR BETWEEN  '".$tgl_kunjungan."' ";
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
*/
$start 	= date('Y-m-d');
$end 	= date('Y-m-d');
if($_REQUEST['tgl_kunjungan'] != ''){
	$start = $_REQUEST['tgl_kunjungan'];
}
if($_REQUEST['tgl_kunjungan2'] != ''){
	$end = $_REQUEST['tgl_kunjungan2'];
}

$search = 'where a.TGLDAFTAR BETWEEN "'.$start.'" and "'.$end.'"';

$norm = "";
if(!empty($_REQUEST['norm'])) {
    $norm = $_REQUEST['norm'];
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
        <div id="frame_title"><h3>LIST PASIEN RADIOLOGI</h3></div>
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
                                   value="<? if($_REQUEST['tgl_kunjungan'] != ''): echo $_REQUEST['tgl_kunjungan']; else: echo date('Y/m/d'); endif; ?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Sd</td>
                        <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" style="width:100px;"
                                   value="<? if($_REQUEST['tgl_kunjungan2'] != ''): echo $_REQUEST['tgl_kunjungan2']; else: echo date('Y/m/d'); endif; ?>"/>
								   <a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Cari" class="text"/>
                            <input type="hidden" name="link" value="7" /></td>
                    </tr>
                </table>

            </form>
            <div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
				<tr align="center"><th>No</th><th>No RM</th><th>Tanggal</th><th>Nama Pasien</th><th>Alamat</th><th>Poli/ Ruang</th><th>Dokter Pengirim</th><th>Cara Bayar</th><th>Rujukan</th><th>&nbsp;</th></tr>
                    <?
                    $NO=0;
                    $sql = "select a.UNIT, a.NOMR, a.IDXDAFTAR, a.TGLDAFTAR, a.NIP, a.IDXORDERRAD, b.NAMA, b.ALAMAT, d.NAMA as CARABAYAR,c.nama_unit, e.NAMADOKTER from tmp_cartorderrad a join m_pasien b on a.NOMR = b.NOMR join m_unit c on a.UNIT = c.kode_unit join m_carabayar d on a.CARABAYAR = d.KODE join m_dokter e on e.KDDOKTER = a.KDDOKTER ".$search." group by a.NOMR, a.TGLDAFTAR 
					union (select a.UNIT, a.NOMR, a.IDXDAFTAR, a.TGLDAFTAR, a.NIP, a.IDXORDERRAD, b.NAMA, b.ALAMAT, d.NAMA as CARABAYAR,c.nama_unit, e.NAMADOKTER from tmp_cartorderrad a join m_pasien_aps b on a.NOMR = b.NOMR join m_unit c on a.UNIT = c.kode_unit join m_carabayar d on a.CARABAYAR = d.KODE left join m_dokter e on e.KDDOKTER = a.KDDOKTER ".$search." group by a.NOMR, a.TGLDAFTAR)";
                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan."&nama=".$nama."&norm=".$norm,"index.php?link=6&");
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
                    while($data = mysql_fetch_array($rs)) {?>
                    <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                                echo "tr1";
    					}else{
								echo "tr2";
                        }
                                ?>>
                        <td><?
                        $NO=($NO+1);
						if ($_GET['page']==0) {
							$hal=0;
    					}else{
        					$hal=$_GET['page']-1;
    					} 
						echo ($hal*15)+$NO;
						?></td>
                        <td><? echo $data['NOMR'];?></td>
                        <td><? echo $data['TGLDAFTAR']; ?></td>
                        <td><? echo $data['NAMA']; ?></td>
                        <td><? echo $data['ALAMAT']; ?></td>
                        <td><? echo $data['nama_unit']; ?></td>
                        <td><? echo $data['NAMADOKTER']; ?></td>
                        <td><? echo $data['CARABAYAR'];?></td>
                        <td><? echo $data['RUJUKAN'];?></td>
                        <td>
						<?php
							echo '<a href="'._BASE_.'index.php?link=72formorderrad&nomr='.$data['NOMR'].'&idx='.$data['IDXDAFTAR'].'"><input type="button" value="TAMBAH PEMERIKSAAN" class="text"/></a>';
						?>
                        </td>
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