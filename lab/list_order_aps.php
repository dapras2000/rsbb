<?php 
session_start();
include("include/connect.php");
require_once('ps_pagination.php');

$search = "";
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])) {
    $tgl_kunjungan =$_GET['tgl_kunjungan'];
} 

if($tgl_kunjungan !="") {
    $search = " AND DATE(t_pendaftaran_aps.TGLREG) = '".$tgl_kunjungan."' ";
}

$norm = "";
if(!empty($_GET['norm'])) {
    $norm =$_GET['norm'];
} 

if($norm !="") {
    $search = $search." AND t_pendaftaran_aps.NOMR = '".$norm."' ";
}

$nama = "";
if(!empty($_GET['nama'])) {
    $nama =$_GET['nama'];
} 

if($nama !="") {
    $search = $search." AND m_pasien_aps.NAMA LIKE '%".$nama."%' ";
}
?>

<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title">
            <h3>LIST ORDER APS</h3></div>
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
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Cari" class="text"/>
                            <input type="hidden" name="link" value="l03" /></td>
                    </tr>
                </table>

            </form>
            <div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr align="center">
                        <th>No</th>
                        <th>No RM APS</th>
                        <th>Tanggal</th>
                        <th>Nama Pasien</th>
                        <th>Alamat</th>
                        <th>Dokter Pengirim</th>
                        <th>Cara Bayar</th>
                        <th>Rujukan</th>
                        <th>&nbsp;</th>
                    </tr>
                    <?
                    $sql = "SELECT DISTINCT
			  t_pendaftaran_aps.NOMR,
			  t_pendaftaran_aps.TGLREG,
			  m_pasien_aps.NAMA,
			  m_pasien_aps.ALAMAT,
			  t_orderlab_aps.DOKTER,
			  m_carabayar.NAMA AS CARABAYAR,
			  m_rujukan.NAMA AS RUJUKAN,
			  t_pendaftaran_aps.IDXDAFTAR
			FROM
			  t_pendaftaran_aps
			  INNER JOIN m_pasien_aps ON (t_pendaftaran_aps.NOMR = m_pasien_aps.NOMR)
			  INNER JOIN m_carabayar ON (t_pendaftaran_aps.KDCARABAYAR = m_carabayar.KODE)
			  INNER JOIN t_orderlab_aps ON (t_pendaftaran_aps.IDXDAFTAR = t_orderlab_aps.IDXDAFTAR)
			  INNER JOIN m_rujukan ON (t_pendaftaran_aps.KDRUJUK = m_rujukan.KODE)
			WHERE t_orderlab_aps.STATUS = '0'
AND t_pendaftaran_aps.UNIT = 'l'
".$search;

                    $NO=0;
                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan."&nama=".$nama."&norm=".$norm,"index.php?link=r03&");
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
                        <td><? echo $data['NOMR'];?></td>
                        <td><? echo $data['TGLREG']; ?></td>
                        <td><? echo $data['NAMA']; ?></td>
                        <td><? echo $data['ALAMAT']; ?></td>
                        <td>&nbsp;</td>
                        <td><? echo $data['CARABAYAR'];?></td>
                        <td><? echo $data['RUJUKAN'];?></td>
                        <td><a href="index.php?link=l04&idx=<?php echo $data['IDXDAFTAR']?>" ><input type="button" value="PERIKSA" class="text"/></a></td>
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