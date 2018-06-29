<?php #session_start();
#include("./include/connect.php");
require_once('ps_pagination.php');
unset($_SESSION['apotekrajal']);
$start 	= date('Y/m/d');
$end 	= date('Y/m/d');
if($_REQUEST['tgl_kunjungan'] != ''){
	$start = $_REQUEST['tgl_kunjungan'];
}
if($_REQUEST['tgl_kunjungan2'] != ''){
	$end = $_REQUEST['tgl_kunjungan2'];
}

#$search = '';
$search = " and (a.tanggal BETWEEN '".$start."' and '".$end."')";

$norm = "";
if(!empty($_GET['norm'])) {
    $norm =$_GET['norm'];
} 

if($norm !="") {
    $search = $search." AND b.NOMR = '".$norm."' ";
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
        <div id="frame_title"><h3>LIST PEMBERIAN OBAT PASIEN RANAP</h3></div>
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
                            <input type="hidden" name="link" value="list_obat_ranap" /></td>
                    </tr>
                </table>

            </form>
            <div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
				<tr align="center"><th style="width:20px;">No</th><th style="width:80px;">TGL INPUT DEPO</th><th style="width:80px;">TGL BAYAR</th><th style="width:80px;">No RM</th><th>Nama Pasien</th><th style="width:100px;">Poli/ Ruang</th><th>Dokter</th><th width="70px">Cara Bayar</th><th width="70px">Status Pembayaran</th><th width="70px">Obat Keluar</th><th width="100px">&nbsp;</th></tr>
                    <?
                    $NO=0;
      $sql = "SELECT a.noresep, a.tanggal, b.nomr as NOMR,c.NAMA,f.nama as ruang,b.nott,d.NAMADOKTER AS dokter, e.NAMA AS carabayar, a.status as statusresep, g.status as status,g.TGLBAYAR
FROM t_billobat_ranap a
JOIN t_admission b ON b.id_admission = a.idxdaftar
JOIN m_pasien c ON c.NOMR = b.nomr
JOIN m_dokter d ON d.KDDOKTER = b.dokter_penanggungjawab
JOIN m_carabayar e ON e.KODE = b.statusbayar
JOIN m_ruang f on f.no = b.noruang
JOIN t_bayarranap g ON g.idxdaftar = a.idxdaftar
WHERE 1=1 ".$search."
GROUP BY noresep";
                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan."&nama=".$nama."&norm=".$norm,"index.php?link=list_obat_ranap&");
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
                        <td><? echo $data['tanggal'];?></td>
                        <td><? echo $data['TGLBAYAR'];?></td>
                        <td><? echo $data['NOMR'];?></td>
                        <td><? echo $data['NAMA']; ?></td>
                        <td><?php echo $data['ruang'];?> &nbsp;&nbsp; <?php echo $data['nott'];?></td>
                        <td><? echo $data['dokter']; ?></td>
                        <td><? echo $data['carabayar']; ?></td>
                        <td><? echo $data['status']; ?></td>
                        <td><? echo $data['statusresep']; ?></td>
                        <td>
						<?php
							echo '<a href="'._BASE_.'index.php?link=detail_resep&noresep='.$data['noresep'].'&rajal=0"><input type="button" value="Lihat" class="text"/></a>';
							if($data['status'] != 'LUNAS' && $data['statusresep'] != 'Batal'){
							echo '&nbsp;&nbsp;<a href="'._BASE_.'index.php?link=pengembalian_resep&noresep='.$data['noresep'].'&rajal=0"><input type="button" value="BATAL" class="text"/></a>';
							}
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
   
    <div align="left">
        <form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
            <input type="hidden" name="query" value="<?=$sql?>" />
            <input type="hidden" name="header" value="LIST ORDER LABORATORIUM" />
            <input type="hidden" name="filename" value="list_lab" />
            <input type="submit" value="Export To Ms Excel Document" class="text" />
        </form>
    </div>
</div>