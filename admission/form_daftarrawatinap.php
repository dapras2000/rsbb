<?
include("include/connect.php");
require_once('new_pagination.php');


$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])) {
    $tgl_kunjungan =$_GET['tgl_kunjungan'];
} 

if($tgl_kunjungan !="") {
    $search = " AND a.TGLORDER = '".$tgl_kunjungan."' ";
}else {
    $search = "";
}

$ruang = "";
if(!empty($_GET['ruang'])) {
    $ruang = $_GET['ruang'];

    if($ruang !="-Pilih Poly-") {
        $search = $search." AND a.POLYPENGIRIM ='".$ruang."' ";
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
?>
<div align="center">
    <div id="frame">
        <div id="frame_title">
            <h3>LIST DAFTAR RAWAT INAP</h3></div>
        <div align="right" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table class="tb">
                    <tr>
                        <td>NO MR</td>
                        <td><input type="text" name="norm" id="norm" value="<? if($norm!="") {
                                echo $norm;
                                   }?>" class="text" /></td>
                        <td>Tanggal</td>
                        <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text"
                                   value="<? if($_REQUEST['tgl_kunjungan'] !=""): echo $_REQUEST['tgl_kunjungan']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td>Nama Pasien</td>
                        <td><input type="text" name="nama" id="nama" value="<? if($nama!="") {
                                echo $nama;
                                   }?>" class="text" /></td>
                        <td >Poly</td>
                        <td>
                            <select name="ruang" class="text">
                                <option selected="selected">-Pilih Poly-</option>
                                <?	$QRY_RUANG = mysql_query("SELECT m_poly.kode, m_poly.nama FROM m_poly");
                                while($DATA_RUANG = mysql_fetch_array($QRY_RUANG)) {
                                    ?>
                                <option value="<?=$DATA_RUANG['kode']?>" <?
                                    if($DATA_RUANG['kode']==$_GET['ruang']) echo "selected=selected";
                                            ?>><?=$DATA_RUANG['nama']?></option>
                                            <? } ?>
                            </select></td>
                    </tr>
                    <tr><td colspan="4" >
                            <input type="hidden" name="link" value="17a" />
                            <input type="submit" value="Cari" class="text"/>
                        </td>
                    </tr>
                </table>
            </form>
            <div id="table_search">
                <table width="95%" class="tb" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr>
                        <th align="center">NO</th>
                        <th width="7%" align="center">NOMR</th>
                        <th width="11%">NAMA PASIEN</th>
                        <th width="9%">ALAMAT PASIEN</th>
                        <th width="13%">TEMPAT/ TGLLAHIR</th>
                        <th width="12%">JENIS KELAMIN</th>
                        <th width="9%">KIRIM DARI</th>
                        <th width="8%">STATUS</th>
                        <th width="9%">NAMA DOKTER</th>
                        <th width="11%">TANGGAL RUJUK</th>

                        <th width="11%">DAFTAR</th>
                    </tr>
                    <?
                    /*	$sql="SELECT DISTINCT
			  t_admission.id_admission,
			  t_admission.nomr,
			  t_admission.keluarrs,
			  m_pasien.NAMA,
			  m_pasien.ALAMAT,
			  m_poly.nama as poly,
			  m_carabayar.NAMA as carabayar,
			  m_rujukan.NAMA as rujukan
			FROM
			  m_poly
			  INNER JOIN t_admission ON (m_poly.kode = t_admission.kirimdari)
			  INNER JOIN m_pasien ON (t_admission.NOMR = m_pasien.NOMR)
			  INNER JOIN m_carabayar ON (t_admission.statusbayar = m_carabayar.KODE)
			  INNER JOIN m_rujukan ON (t_admission.kirimdari = m_rujukan.KODE) WHERE keluarrs IS NULL";*/

                    $sql = "SELECT a.NOMR, a.TGLORDER, b.NAMA, b.ALAMAT, b.TEMPAT, b.TGLLAHIR, b.JENISKELAMIN , c.NAMA AS POLY, d.NAMA AS RUJUKAN, e.NAMADOKTER, a.IDXORDER
FROM t_orderadmission a 
JOIN m_pasien b ON a.NOMR = b.NOMR
JOIN m_dokter e ON a.DRPENGIRIM = e.KDDOKTER
LEFT JOIN m_poly c ON c.kode = a.POLYPENGIRIM
LEFT JOIN m_rujukan d ON a.KDRUJUK=d.KODE  
WHERE a.NOMR=b.NOMR  AND a.DRPENGIRIM=e.KDDOKTER AND a.STATUS='0' AND a.IDXDAFTAR not in (select id_admission from t_admission where id_admission = a.IDXDAFTAR ORDER BY a.IDXDAFTAR DESC) 

		".$search."
		ORDER BY IDXORDER DESC";

                    $NO=0;
                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan."&ruang=".$ruang."&nama=".$nama."&nomr=".$nomr,"index.php?link=17a&");

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
                        <td ><? $NO=($NO+1);
                                if ($_GET['page']==0) {
                                    $hal=0;
                                }else {
                                    $hal=$_GET['page']-1;
                                } echo


    ($hal*15)+$NO;?></td>
                        <td><? echo $data['NOMR'];?></td>
                        <td><?php echo $data['NAMA']; ?></td>
                        <td><?php echo $data['ALAMAT']; ?></td>
                        <td><?php echo $data['TEMPAT']." / ".$data['TGLLAHIR']; ?></td>
                        <td><?php if($data['JENISKELAMIN']=="L") {
                                    echo"Laki-Laki";
                                }else {
                                    echo"Perempuan";
    }?></td>
                        <td><?php echo $data['POLY']; ?></td>
                        <td><?php echo $data['RUJUKAN']; ?></td>
                        <td><?php echo $data['NAMADOKTER']; ?></td>
                        <td><?php echo $data['TGLORDER']; ?></td>
                        <td align="center"><a href="index.php?link=17&no=<?php echo $data['IDXORDER'];?>" ><input type="button" class="text" value="Proses" /></a> <a href="admission/batal_daftar.php?no=<?php echo $data['IDXORDER'];?>" ><input type="button" class="text" value="Batal" /></a></td>
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
<br /><br />




