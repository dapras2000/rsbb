<?php 
session_start();
#REQUIRE_ONCE("class/object.inc");
#include("models/list_data_pasien.php"); 
include("include/connect.php");
require_once('ps_pagination.php');

$search = " AND a.TGLORDER = CURDATE()";

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
    $search = $search." AND b.NAMA LIKE '%".$nama."%' ";
}

$jenisperiksa = "";
if(!empty($_GET['jenisperiksa'])) {
    $jenisperiksa =$_GET['jenisperiksa'];
} 

if($jenisperiksa !="") {
    $search = $search." AND a.JENISPHOTO = '".$jenisperiksa."'";
}

$jenisfilm = "";
if(!empty($_GET['jenisfilm'])) {
    $jenisfilm =$_GET['jenisfilm'];
} 

if($jenisfilm !="") {
    $search = $search." AND a.jenisfilm = '".$jenisfilm."' ";
}

$jenisbayar = "";
if(!empty($_GET['jenisbayar'])) {
    $jenisbayar =$_GET['jenisbayar'];
} 

if($jenisbayar !="") {
    $jenisbayar = "and u.NAMA = '".$jenisbayar."' ";
}

?>

<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>REKAP PELAYANAN RADIOLOGI</h3>
        </div>
        <div align="right" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table border="0" cellspacing="0" class="tb">
                    <tr>
                        <td >No RM</td>
                        <td ><input type="text" name="norm" id="norm" value="<? if($norm!="") {
                                echo $norm;
                                               }?>" class="text" style="width:80px;"></td>
                        <td>Jns Pemeriksaan</td>
                        <td> <select class="text" name="jenisperiksa" id="jp">
                                <option value="" > -- </option>
                                <? 
								$q1="select * from m_tarif2012 where kode_gruptindakan like '06.02'";
                                $h1=mysql_query($q1);
                                while($b1=mysql_fetch_array($h1)) {
                                    ?>
                                	<option value="<?=$b1['kode_tindakan'];?>" <? if($b1['kode_tindakan']==$_GET['jenisperiksa']) echo "selected=selected"; ?> ><?=$b1['nama_tindakan'];?></option>
                                    <? }?>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td><input type="text" name="nama" id="nama" value="<? if($nama!="") {
                                echo $nama;
                                   }?>" class="text"></td>
                        <td>Jns Photo</td>
                        <td> <select name="jenisfilm" id="jenisfilm">
                                <option value="" > -- </option>
                                <option value="35x35" <? if($_GET['jenisfilm']=="35x35") echo "selected=selected"; ?> >35x35</option>
                                <option value="30x40" <? if($_GET['jenisfilm']=="30x40") echo "selected=selected"; ?> >30x40</option>
                                <option value="24x30" <? if($_GET['jenisfilm']=="24x30") echo "selected=selected"; ?> >24x30</option>
                                <option value="18x24" <? if($_GET['jenisfilm']=="18x24") echo "selected=selected"; ?> >18x24</option>
                                <option value="GIGI" <? if($_GET['jenisfilm']=="GIGI") echo "selected=selected"; ?> >GIGI</option>
                            </select> </td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" style="width:100px;"
                                   value="<? if($_REQUEST['tgl_kunjungan'] !=""): echo $_REQUEST['tgl_kunjungan']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                        <td>Jns Bayar</td>
                        <td><select class="text" name="jenisbayar" id="carab">
                                <option value="" > -- </option>
                                <? $q="select * from m_carabayar";
                                $h=mysql_query($q);

                                while($b=mysql_fetch_array($h)) {
                                    ?>
                                <option value="<?=$b['NAMA'];?>" <? if($b['NAMA']==$_GET['jenisbayar']) echo "selected=selected"; ?> ><?=$b['NAMA'];?></option>
                                    <? }?>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Sd</td>
                        <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" style="width:100px;"
                                   value="<?if($_REQUEST['tgl_kunjungan2'] !=""): echo $_REQUEST['tgl_kunjungan2']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
                        <td>&nbsp;</td>
                        <td align="right"><input type="submit" value="C A R I" class="text"/>
                            <input type="hidden" name="link" value="74" /></td>
                    </tr>
                </table>

            </form>
            <div id="table_search" style="overflow: auto;">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr align="center">
                        <th rowspan="2">No</th>
                        <th rowspan="2">Tanggal</th>
                        <th rowspan="2">NOMR</th>
                        <th rowspan="2">Nama Pasien</th>
                        <th rowspan="2">Jenis Kelamin</th>
                        <th rowspan="2">Unit Pengirim</th>
                        <th rowspan="2">Nama Dokter Pengirim</th>
                        <th rowspan="2">No Film</th>
                        <th rowspan="2">Permintaan Photo</th>
                        <th rowspan="2">Cara Pembayaran</th>
                        <th rowspan="2">Jenis Film</th>
                        <th colspan="2">Jumlah Film</th>
                        <th rowspan="2">Dokter Radiologi</th>
                        <th rowspan="2">Petugas</th>
                        <th rowspan="2">Hasil Resume</th>
                    </tr>
                    <tr>
                        <th> Baik</th>
                        <th>Rusak</th>
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
/*
                    $sql = "SELECT view_orderrad_dokter.IDXORDERRAD,
		  view_orderrad_dokter.NO_FILM,
		  view_orderrad_dokter.jenisfilm,
		  view_orderrad_dokter.IDXDAFTAR,
		  view_orderrad_dokter.TGLORDER,
		  view_orderrad_dokter.DIAGNOSA,
		  view_orderrad_dokter.DRPENGIRIM,
		  view_orderrad_dokter.NAMADOKTER,
		  view_orderrad_dokter.POLYPENGIRIM,
		  view_orderrad_dokter.NAMAPOLY,
		  view_orderrad_dokter.NOMR,
		  view_orderrad_dokter.NAMA,
		  view_orderrad_dokter.JENISKELAMIN,
		  view_orderrad_dokter.NAMABAYAR,
		  view_orderrad_dokter.USIA,
		  view_orderrad_dokter.nama_rad,
		  view_orderrad_dokter.HASILRESUME,
		  (SELECT t_radiologi_petugas.namapetugas FROM t_radiologi_petugas WHERE  t_radiologi_petugas.idxorderrad= 	
		   view_orderrad_dokter.IDXORDERRAD and t_radiologi_petugas.keterangan='PETUGAS' ORDER BY idxpetugas DESC LIMIT 1) AS RADPETUGAS,
		  (SELECT m_dokter.namadokter FROM t_radiologi_petugas
                    INNER JOIN m_dokter ON (t_radiologi_petugas.namapetugas=m_dokter.kddokter)
                    WHERE  t_radiologi_petugas.idxorderrad=
		   view_orderrad_dokter.IDXORDERRAD and t_radiologi_petugas.keterangan='DOKTER' ORDER BY idxpetugas DESC LIMIT 1) AS RADDOKTER,
		  t_radiologi.jumlahfilm_baik,
		  t_radiologi.jumlahfilm_rusak
		FROM
		  view_orderrad_dokter
		  INNER JOIN t_radiologi ON (view_orderrad_dokter.IDXORDERRAD = t_radiologi.IDXORDERRAD)
                  WHERE 1 ".$search;
*/
$sql = 'SELECT a.TGLORDER,a.NOMR,b.NAMA,b.JENISKELAMIN,c.nama_unit,d.NAMADOKTER,a.NO_FILM, e.nama_tindakan,
CASE a.rajal WHEN "1" THEN 
	(SELECT u.NAMA FROM t_pendaftaran r JOIN m_carabayar u ON u.KODE = r.KDCARABAYAR WHERE a.IDXDAFTAR = r.IDXDAFTAR)
ELSE 	
	(SELECT u.NAMA FROM t_admission r JOIN m_carabayar u ON u.KODE = r.statusbayar WHERE a.IDXDAFTAR = r.id_admission) END AS carabayar,
a.jenisfilm,a.jumlahfilm_baik,a.jumlahfilm_rusak,a.DRRADIOLOGI,a.NIPRAD,a.HASILRESUME
FROM t_radiologi a
JOIN m_pasien b ON a.NOMR = b.NOMR
JOIN m_unit c ON c.kode_unit = a.POLYPENGIRIM
JOIN m_dokter d ON d.KDDOKTER = a.DRPENGIRIM
JOIN m_tarif2012 e ON e.kode_tindakan = a.JENISPHOTO
'.$search;
                    $NO=0;
                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan."&nama=".$nama."&norm=".$norm."&jenisperiksa=".$jenisperiksa."&jenisfilm=".$jenisfilm."&jenisbayar=".$jenisbayar,"index.php?link=74&");
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
                        <td><?php echo $data['TGLORDER']; ?></td>
                        <td><?php echo $data['NOMR']; ?></td>
                        <td><?php echo $data['NAMA']; ?></td>
                        <td><?php echo $data['JENISKELAMIN']; ?></td>
                        <td><?php echo $data['nama_unit']; ?></td>
                        <td><?php echo $data['NAMADOKTER']; ?></td>
                        <td><?php echo $data['NO_FILM']; ?></td>
                        <td><?php echo $data['nama_tindakan']; ?></td>
                        <td><?php echo $data['carabayar']; ?></td>
                        <td><?php echo $data['jenisfilm']; ?></td>
                        <td><?php echo $data['jumlahfilm_baik']; ?></td>
                        <td><?php echo $data['jumlahfilm_rusak']; ?></td>
                        <td><?php echo $data['DRRADIOLOGI']; ?></td>
                        <td><?php echo $data['NIPRAD']; ?></td>
                        <td><?php echo substr($data['HASILRESUME'],0,30); ?></td>
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
        $qry_excel = "SELECT view_orderrad_dokter.TGLORDER AS TANGGAL,
              view_orderrad_dokter.NOMR AS NO_RM,
              view_orderrad_dokter.NAMA AS NAMA_PASIEN,
              view_orderrad_dokter.JENISKELAMIN AS JNS_KELAMIN,
              view_orderrad_dokter.NAMAPOLY AS POLY_PENGIRIM,
              view_orderrad_dokter.NAMADOKTER AS DOKTER_PENGIRIM,
              view_orderrad_dokter.NO_FILM,
              view_orderrad_dokter.nama_rad AS JNS_PEMERIKSAAN,
              view_orderrad_dokter.NAMABAYAR AS CARA_BAYAR,
              view_orderrad_dokter.jenisfilm AS JNS_FILM,
              t_radiologi.jumlahfilm_baik AS JNS_FILM_BAIK,
              t_radiologi.jumlahfilm_rusak AS JNS_FILM_RUSAK,
              (SELECT m_dokter.namadokter FROM t_radiologi_petugas
                    INNER JOIN m_dokter ON (t_radiologi_petugas.namapetugas=m_dokter.kddokter)
                    WHERE  t_radiologi_petugas.idxorderrad=
		   view_orderrad_dokter.IDXORDERRAD and t_radiologi_petugas.keterangan='DOKTER' ORDER BY idxpetugas DESC LIMIT 1) AS DOKTER_RADIOLOGI,
              (SELECT t_radiologi_petugas.namapetugas FROM t_radiologi_petugas WHERE  t_radiologi_petugas.idxorderrad=
		   view_orderrad_dokter.IDXORDERRAD and t_radiologi_petugas.keterangan='PETUGAS' ORDER BY idxpetugas DESC LIMIT 1) AS PETUGAS_RADIOLOGI,
		  view_orderrad_dokter.HASILRESUME AS HASIL_RESUME
              FROM
	      view_orderrad_dokter
	      INNER JOIN t_radiologi ON (view_orderrad_dokter.IDXORDERRAD = t_radiologi.IDXORDERRAD)
              WHERE 1 ".$search;
?>

    </div>

</div>
<br>
<div align="left">
    <form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
        <input type="hidden" name="query" value="<?=$qry_excel?>" />
        <input type="hidden" name="header" value="REKAP PEMERIKSAAN RADIOLOGI" />
        <input type="hidden" name="filename" value="rekap_radiologi" />
        <input type="submit" value="Export To Ms Excel Document" class="text" />
    </form>
</div>