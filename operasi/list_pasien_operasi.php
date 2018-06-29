<?php session_start();
include("../include/connect.php");
require_once('ps_pagination.php');

$tgl_kunjungan 	= date('Y/m/1');
$tgl_kunjungan2 = date('Y/m/31');

if(!empty($_GET['tgl_kunjungan'])) {
    $tgl_kunjungan =$_GET['tgl_kunjungan'];
}
if(!empty($_GET['tgl_kunjungan2'])) {
    $tgl_kunjungan2 =$_GET['tgl_kunjungan2'];
}

$search = 'and (t_operasi.TGLORDER BETWEEN "'.$tgl_kunjungan.'" and "'.$tgl_kunjungan2.'")';

$norm = "";
if(!empty($_GET['norm'])) {
    $norm =$_GET['norm'];
} 

if($norm !="") {
    $search = $search." and m_pasien.nomr = '".$norm."' ";
}

$nama = "";
if(!empty($_GET['nama'])) {
    $nama =$_GET['nama'];
} 

if($nama !="") {
    $search = $search." AND m_pasien.nama LIKE '%".$nama."%' ";
}
?>

<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>List Daftar Operasi</h3>
        </div>
        <div align="right" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table width="248" border="0" cellspacing="0" class="tb">
                    <tr>
                        <td width="52">No RM</td>
                        <td width="192"><input type="text" name="norm" id="norm" style="width:80px;" value="<? if($norm!="") {
                                                   echo $norm;
}?>" class="text"></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td><input type="text" name="nama" id="nama" value="<? if($nama!="") {
    echo $nama;
}?>" class="text" ></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" style="width:100px;"
                                   value="<? if($tgl_kunjungan!="") {
    echo $tgl_kunjungan;
}?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td>Sd</td>
                        <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" style="width:100px;"
                                   value="<? if($tgl_kunjungan2!="") {
    echo $tgl_kunjungan2;
}?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Cari" class="text"/>
                            <input type="hidden" name="link" value="20" /></td>
                    </tr>
                </table>

            </form>
            <div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" >
                    <tr align="center">
                        <th>NO</th>
                        <th>NOMR</th>
                        <th>NAMA PASIEN</th>
                        <th>TANGGAL OPERASI</th>
                        <th>JAM MULAI</th>
                        <th>JAM SELESAI</th>
                        <th>DOKTER OPERATOR</th>
                        <th>DOKTER ANASTESI</th>
                        <th><div align="center">PEMBUATAN LAPORAN</div></th>
                        <th><div align="center">LIHAT LAPORAN</div></th>
                        <th><div align="center">PEMAKAIAN OBAT</div></th>
                        <th><div align="center">TINDAKAN MEDIS</div></th>
                        <!--<th>KET</th>-->
                        <th>&nbsp;</th>
                    </tr>
                    <?
                    $sql = "SELECT 
			  t_operasi.*,
			  m_pasien.NAMA AS namapasien,
			  m_carabayar.NAMA as carabayar				
			FROM
			  t_operasi
			  INNER JOIN m_pasien ON (t_operasi.nomr = m_pasien.NOMR)
			  LEFT JOIN t_pendaftaran ON (t_operasi.IDXDAFTAR = t_pendaftaran.IDXDAFTAR)
			  LEFT JOIN m_carabayar ON (t_pendaftaran.KDCARABAYAR = m_carabayar.KODE)
			where (t_operasi.status = 'selesai' or t_operasi.status is null)
			and t_operasi.tanggal is not null ".$search." order by t_operasi.tanggal asc";

                    $NO=0;
					$pager = new PS_Pagination($connect, $sql,20, 5, "tgl_kunjungan=".$tgl_kunjungan."&tgl_kunjungan2=".$tgl_kunjungan2."&nama=".$nama."&norm=".$norm,"index.php?link=20&");
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
    ($hal*20)+$NO;?></td>
                        <td><?php echo $data['nomr']; ?></td>
                        <td><?php echo $data['namapasien']; ?></td>
                        <td><?php echo $data['tanggal']; ?></td>
                        <td><?php echo $data['jammulai']; ?></td>
                        <td><?php echo $data['jamselesai']; ?></td>
                        <td><?php echo $data['dokteroperator']; ?></td>
                        <td><?php echo $data['dokteranastesi']; ?></td>
                        <td><div align="center">
    <? $js=$data['jamselesai'];
                                    if ($js=='') {
                                        ?>
                                <a class="text" href="index.php?link=202&idoperasi=<?php echo $data['id_operasi']; ?>&tanggal=<?php echo $data['tanggal']; ?>">LAPORAN_BARU</a>

        <?
                                        $pemakaianobat='0';
    }else { ?>
                                <a class="text" href="index.php?link=202&idoperasi=<?php echo $data['id_operasi']; ?>&tanggal=<?php echo $data['tanggal']; ?>">UBAH LAPORAN</a>

                                        <? }?>
                            </div></td>
                        <td>
                            <div align="center">
    <?
    if ($js != 'NULL') {
                                        ?>
                                <a class="text" href="index.php?link=203&idoperasi=<?php echo $data['id_operasi']; ?>&amp;tanggal=<?php echo $data['tanggal']; ?>">LAPORAN</a>

                                        <?
        $pemakaianobat='1';
    }
    ?>
                            </div></td>
                        <td>
                            <div align="center">
                                    <?
                                    if ($js != 'NULL' && $pemakaianobat=='1') {
        //echo "<a class='text' href='index.php?link=206&idoperasi=".$row_rs['id_operasi']."&tanggal=".$row_rs['tanggal'].">PEMAKAIAN_OBAT</a>";
                                        ?>
                                <a class='text' href='index.php?link=206&idoperasi=<?=$data['id_operasi']?>&tanggal=<?=$data['tanggal']?>'>PEMAKAIAN_OBAT</a>
                                        <?
                                        $tindakanmedis='1';
                                    }

    ?>
                            </div></td>

                        <td>
                                <?
                                if ($pemakaianobat=='1') {
        ?>
                            <a class="text" href="index.php?link=209&idoperasi=<?php echo $data['id_operasi']; ?>&amp;tanggal=<?php echo $data['tanggal']; ?>">TINDAKAN</a>
                                    <? }
    else {
        echo "";
    }?>

                        </td>
                        <!--<td><?php #if($data['JNSOPERASI']=="c") echo "Cito"; ?></td>-->
                        <td><a href="operasi/status_operasi.php?idxoperasi=<?=$data['id_operasi']?>&idxdaftar=<?php echo $data['IDXDAFTAR'];?>" ><input type="button" value="BATAL" class="text" /></a></td>
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

<?
$sql_excel = "SELECT 
				  view_order_operasi.nomr AS NO_RM,
				  view_order_operasi.NAMAPASIEN AS NAMA_PASIEN,
				  view_order_operasi.JENISKELAMIN AS JNS_KELAMIN,
				  view_order_operasi.TGLLAHIR AS TGL_LAHIR,
				  view_order_operasi.ALAMAT,
				  view_order_operasi.CARABAYAR AS JNS_PEMBAYARAN,
				  view_order_operasi.tanggal AS TGL_OPERASI,
				  view_order_operasi.jammulai AS JAM_MULAI,
				  view_order_operasi.jamselesai AS JAM_SELESAI,
				  view_order_operasi.diagnosa AS DIAGNOSA_PRAOPERASI,
				  view_order_operasi.NAMADOKTER AS DOKTER_PENGIRIM,
				  view_order_operasi.dokteroperator AS DOKTER_OPERATOR,
				  view_order_operasi.dokteranastesi AS DOKTER_ANASTESI,
				  view_order_operasi.dokteranak AS DOKTER_ANAK,
				  view_order_operasi.asistenoperator AS ASISTEN_OPERATOR,
				  view_order_operasi.asistenanastesi AS ASISTEN_ANASTESI,
				  view_order_operasi.asistenanak AS ASISTEN_ANAK,
				  view_order_operasi.perawatinstrumen AS PERAWAT_INSTRUMENT,
				  view_order_operasi.perawatsirkuler AS PERAWAT_SIRKULER,
				  view_order_operasi.jenisanastesi AS JNS_ANASTESI,
				  view_order_operasi.metodeanastesi AS MTD_ANASTESI,
				  view_order_operasi.tindakan AS TINDAKAN,
				  view_order_operasi.pembedahan AS PEMBEDAHAN,
				  view_order_operasi.pemeriksaanPA AS PEMERIKSAAN_PA,
				  view_order_operasi.jaringan AS JARINGAN,
				  view_order_operasi.macamoperasi AS MACAM_OPERASI,
				  view_order_operasi.laporan AS LAPORAN,
				  view_order_operasi.keteranganpasien AS KETERANGAN
				FROM
				  view_order_operasi
				WHERE view_order_operasi.status = 'selesai' ".$search2 ;
?>
<p>

<form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
    <input type="hidden" name="query" value="<?=$sql_excel?>" />
    <input type="hidden" name="header" value="SENSUS KAMAR OPERASI TANGGAL <?=$tgl_kunjungan." SAMPAI ".$tgl_kunjungan?>" />
    <input type="hidden" name="filename" value="sensus_kamar_operasi" />
    <input type="submit" value="Export To Ms Excel Document" class="text" />
</form>
</p>