<?php 
session_start();

include("../include/connect.php");
require_once('ps_pagination.php');


$search = " DATE(t_kunjungan_kamar.tanggal) = curdate() ";

$tgl_reg = "";
if(!empty($_GET['tgl_reg'])) {
    $tgl_reg =$_GET['tgl_reg'];
}

if($tgl_reg !="") {
    $search = " DATE(t_kunjungan_kamar.tanggal) BETWEEN  '".$tgl_reg."' ";
}

$tgl_reg2 = "";
if(!empty($_GET['tgl_reg2'])) {
    $tgl_reg2 =$_GET['tgl_reg2'];
}


if($tgl_reg !="") {
    if($tgl_reg2 !="") {
        $search = $search." AND '".$tgl_reg2."' ";
    }else {
        $search = $search." AND '".$tgl_reg."' ";
    }
}

$sql = "SELECT date(t_kunjungan_kamar.tanggal) as tanggal, t_reg_partus.tanggal as tgllahir, m_pasien.NAMA, m_pasien.TGLLAHIR, 
		m_pasien.ALAMAT, m_pasien.PENDIDIKAN, m_rujukan.NAMA AS rujukan, 
		t_reg_partus.jenis_kelamin, t_reg_partus.berat_badan, 
		t_reg_partus.panjang_badan, t_reg_partus.penolong, t_reg_partus.asisten, 
		t_reg_partus.nilai_apgar, t_reg_partus.nilai_apgar_2, m_carabayar.NAMA AS carabayar, 
		t_reg_partus.jns_persalinan, t_reg_partus.penyulit, t_pendaftaran.NOMR, 
		icd.jenis_penyakit, t_kunjungan_kamar.odc_rawat_rujuk, 
		(SELECT sum(QTY) FROM t_billrajal WHERE IDXDAFTAR = t_kunjungan_kamar.idxdaftar AND KODETARIF = '010325') AS MANPLACENTA, 
		(SELECT sum(QTY) FROM t_billrajal WHERE IDXDAFTAR = t_kunjungan_kamar.idxdaftar AND KODETARIF = '010324') AS KURTASE, 
		(SELECT sum(QTY) FROM t_billrajal WHERE IDXDAFTAR = t_kunjungan_kamar.idxdaftar AND KODETARIF = '01070305') AS CTG, 
		(SELECT sum(QTY) FROM t_billrajal WHERE IDXDAFTAR = t_kunjungan_kamar.idxdaftar AND KODETARIF = '01050203') AS DOPLER, 
		(SELECT sum(QTY) FROM t_billrajal WHERE IDXDAFTAR = t_kunjungan_kamar.idxdaftar AND KODETARIF = '01050202') AS USG,
		(SELECT sum(QTY) FROM t_billrajal WHERE IDXDAFTAR = t_kunjungan_kamar.idxdaftar AND KODETARIF = '01080101') AS PM3A,
		(SELECT sum(QTY) FROM t_billrajal WHERE IDXDAFTAR = t_kunjungan_kamar.idxdaftar AND KODETARIF = '01080201') AS P2RG
		FROM t_kunjungan_kamar 
		INNER JOIN t_pendaftaran ON (t_kunjungan_kamar.idxdaftar = t_pendaftaran.IDXDAFTAR) 
		INNER JOIN m_pasien ON (t_pendaftaran.NOMR = m_pasien.NOMR) 
		INNER JOIN m_rujukan ON (t_pendaftaran.KDRUJUK = m_rujukan.KODE) 
		INNER JOIN m_carabayar ON (t_pendaftaran.KDCARABAYAR = m_carabayar.KODE) 
		LEFT JOIN icd ON (trim(t_kunjungan_kamar.icd_code) = icd.icd_code) 
		LEFT JOIN t_reg_partus ON (t_kunjungan_kamar.idxdaftar = t_reg_partus.idxdaftar) WHERE ".$search;
$qry_order = mysql_query($sql);

$order = mysql_fetch_assoc($qry_order);
?>
<div align="center">
    <div id="frame" style="width:100%">
        <div id="frame_title">
            <h3>SENSUS HARIAN VK</h3></div>
        <div align="right" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table class="tb">
                    <tr>
                        <td align="right">Tanggal &nbsp;<input type="text" name="tgl_reg" id="tgl_pesan" readonly="readonly" class="text"
                                                               value="<? if($tgl_reg!="") {
                                                                   echo $tgl_reg;
                                                               }?>" style="width:100px;"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                    <tr>
                        <td align="right">S/d &nbsp;<input type="text" name="tgl_reg2" id="tgl_pesan2" readonly="readonly" class="text"
                                                           value="<? if($tgl_reg2!="") {
                                                               echo $tgl_reg2;
                                                           }?>" style="width:100px;" /><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td align="right"><input type="submit" value="C A R I" class="text"/></td>
                    </tr>
                </table>
                <input type="hidden" name="link" value="v02" />
            </form>
            <div id="table_search" style="overflow: auto;">
                <table width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" class="tb">
                    <tr align="center">
                        <th width="5%">NO</th>
                        <th width="5%">NO RM</th>
                        <th width="30%">TGL MASUK</th>
                        <th width="30%">TGL LAHIR/ JAM</th>
                        <th>NAMA</th>
                        <th>DIAGNOSA</th>
                        <th>STATUS</th>
                        <th>ODC</th>
                        <th>RAWAT DI VK</th>
                        <th>JNS PERSALINAN</th>
                        <th>PARTUS PENYULIT</th>
                        <th>MANUAL PLASENTA</th>
                        <th>KURTASE</th>
                        <th>PAKET MEDIK 3A</th>
                        <th>PAKET 2 RINGAN</th>
                        <th>CTG</th>
                        <th>DOPLER</th>
                        <th>USG</th>
                        <th>RETRIBUSI</th>
                    </tr>
                    <?
                    $NO=0;
                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_reg=".$tgl_reg."&tgl_reg2=".$tgl_reg2,"index.php?link=v02&");

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
                        <td><? echo $data['NOMR']; ?></td>
                        <td><? echo $data['tanggal']; ?></td>
                        <td><? echo $data['tgllahir']; ?></td>
                        <td><? echo $data['NAMA']; ?></td>
                        <td><? echo $data['jenis_penyakit']; ?></td>
                        <td><? echo $data['carabayar']; ?></td>
                        <td><? if($data['odc_rawat_rujuk']=="1") echo "ya"; ?></td>
                        <td><? if($data['odc_rawat_rujuk']=="2") echo "ya"; ?></td>
                        <td><?
                                if($data['jns_persalinan']=="1") {
                                    echo "Partus Normal";
                                }else if($data['jns_persalinan']=="2") {
                                    echo "Partus SC";
                                }else if($data['jns_persalinan']=="3") {
                                    echo "Partus Penyulit";
    }?></td>
                        <td><?
                                if($data['penyulit']=="1") {
                                    echo "Pre Eclamsia Berat";
                                }else if($data['penyulit']=="2") {
                                    echo "Pre Eclamsia Ringan";
                                }else if($data['penyulit']=="3") {
                                    echo "Eclamsia";
                                }else if($data['penyulit']=="4") {
                                    echo "Pendarahan Sebelum Persalinan";
                                }else if($data['penyulit']=="5") {
                                    echo "Pendarahan Sesudah Persalinan";
                                }else if($data['penyulit']=="6") {
                                    echo "Infeksi";
                                }else if($data['penyulit']=="7") {
                                    echo "Sungsang";
                                }else if($data['penyulit']=="8") {
                                    echo "Vacum";
                                }else if($data['penyulit']=="9") {
                                    echo "Restosia Bahu";
                                }else if($data['penyulit']=="10") {
                                    echo "KPD";
                                }else if($data['penyulit']=="11") {
                                    echo "Induksi";
    }?></td>
                        <td align="right"><? echo $data['MANPLACENTA']; ?></td>
                        <td align="right"><? echo $data['KURTASE']; ?></td>
                        <td align="right"><? echo $data['PM3A']; ?></td>
                        <td align="right"><? echo $data['P2RG']; ?></td>
                        <td align="right"><? echo $data['CTG']; ?></td>
                        <td align="right"><? echo $data['DOPLER']; ?></td>
                        <td align="right"><? echo $data['USG']; ?></td>
                        <td>&nbsp;</td>
                    </tr>
                        <?	}


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
<p>
    <?
    $sql_excel = "SELECT t_pendaftaran.NOMR AS NO_RM,
                date(t_kunjungan_kamar.tanggal) AS TGL_MASUK,
                t_reg_partus.tanggal AS LAHIR_TGL_JAM,
                m_pasien.NAMA AS NAMA_PASIEN,
                icd.jenis_penyakit AS DIAGNOSA,
                m_carabayar.NAMA AS STATUS_BAYAR,
                CASE t_kunjungan_kamar.odc_rawat_rujuk
                  WHEN 1 THEN 'Ya'
                END AS ODC,
                CASE t_kunjungan_kamar.odc_rawat_rujuk
                  WHEN 2 THEN 'Ya'
                END AS RAWAT_DI_VK,
                CASE t_reg_partus.jns_persalinan
                    WHEN 1 THEN 'Normal'
                    WHEN 2 THEN 'SC'
                    WHEN 3 THEN 'Penyulit'
                END AS JNS_PERSALINAN,
                CASE t_reg_partus.penyulit
                    WHEN 1 THEN 'Pre Eclamsia Berat'
                    WHEN 2 THEN 'Pre Eclamsia Ringan'
                    WHEN 3 THEN 'Eclamsia'
                    WHEN 4 THEN 'Pendarahan Sebelum Persalinan'
                    WHEN 5 THEN 'Pendarahan Sesudah Persalinan'
                    WHEN 6 THEN 'Infeksi'
                    WHEN 7 THEN 'Sungsang'
                    WHEN 8 THEN 'Vacum'
                    WHEN 9 THEN 'Restosia Bahu'
                    WHEN 10 THEN 'KPD'
                    WHEN 11 THEN 'Induksi'
                END AS PENYULIT,
                (SELECT sum(QTY) FROM t_billrajal WHERE IDXDAFTAR = t_kunjungan_kamar.idxdaftar AND KODETARIF = '010325') AS MANUAL_PLACENTA,
                (SELECT sum(QTY) FROM t_billrajal WHERE IDXDAFTAR = t_kunjungan_kamar.idxdaftar AND KODETARIF = '010324') AS KURTASE,
                (SELECT sum(QTY) FROM t_billrajal WHERE IDXDAFTAR = t_kunjungan_kamar.idxdaftar AND KODETARIF = '01080101') AS PAKET_MEDIK_3A,
                (SELECT sum(QTY) FROM t_billrajal WHERE IDXDAFTAR = t_kunjungan_kamar.idxdaftar AND KODETARIF = '01080201') AS PAKET_MEDIK_2RINGAN,
                (SELECT sum(QTY) FROM t_billrajal WHERE IDXDAFTAR = t_kunjungan_kamar.idxdaftar AND KODETARIF = '01070305') AS CTG,
		(SELECT sum(QTY) FROM t_billrajal WHERE IDXDAFTAR = t_kunjungan_kamar.idxdaftar AND KODETARIF = '01050203') AS DOPLER,
		(SELECT sum(QTY) FROM t_billrajal WHERE IDXDAFTAR = t_kunjungan_kamar.idxdaftar AND KODETARIF = '01050202') AS USG,
                '' AS RETRIBUSI
                FROM t_kunjungan_kamar
		INNER JOIN t_pendaftaran ON (t_kunjungan_kamar.idxdaftar = t_pendaftaran.IDXDAFTAR)
		INNER JOIN m_pasien ON (t_pendaftaran.NOMR = m_pasien.NOMR)
		INNER JOIN m_rujukan ON (t_pendaftaran.KDRUJUK = m_rujukan.KODE)
		INNER JOIN m_carabayar ON (t_pendaftaran.KDCARABAYAR = m_carabayar.KODE)
		LEFT JOIN icd ON (trim(t_kunjungan_kamar.icd_code) = icd.icd_code)
		LEFT JOIN t_reg_partus ON (t_kunjungan_kamar.idxdaftar = t_reg_partus.idxdaftar) WHERE ".$search;
?>
<form name="formprint" method="post" action="vk/excelexport.php" target="_blank" >
    <input type="hidden" name="query" value="<?=$sql_excel?>" />
    <input type="hidden" name="header" value="SENSUS HARIAN VK" />
    <input type="hidden" name="filename" value="sensus_harian_vk" />
    <input type="submit" value="Export To Ms Excel Document" class="text" />
</form>
</p>
