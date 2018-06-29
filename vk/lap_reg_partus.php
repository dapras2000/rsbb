<?php 
session_start();

include("../include/connect.php");
require_once('ps_pagination.php');

$search = " DATE(t_reg_partus.tanggal) = curdate() ";

$tgl_reg = "";
if(!empty($_GET['tgl_reg'])) {
    $tgl_reg =$_GET['tgl_reg'];
}

if($tgl_reg !="") {
    $search = " DATE(t_reg_partus.tanggal) BETWEEN  '".$tgl_reg."' ";
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


$sql = "SELECT m_pasien.NAMA, m_pasien.TGLLAHIR, m_pasien.ALAMAT, m_pasien.PENDIDIKAN,
  				m_rujukan.NAMA AS rujukan, m_carabayar.NAMA AS carabayar, t_pendaftaran.NOMR,
                m_dokter.NAMADOKTER AS penolong, m_dokter1.NAMADOKTER AS asisten,
  				t_reg_partus.lahir, t_reg_partus.tanggal, t_reg_partus.nama, t_reg_partus.no_surat_lahir,
  				t_reg_partus.no_surat_mati, t_reg_partus.paritas, t_reg_partus.anus, t_reg_partus.cacad,
  				t_reg_partus.jenis_kelamin, t_reg_partus.berat_badan, t_reg_partus.panjang_badan,
  				t_reg_partus.nilai_apgar, t_reg_partus.jns_persalinan, t_reg_partus.penyulit, t_reg_partus.KDUNIT,
  				t_reg_partus.NIP, t_reg_partus.kode_icd, t_reg_partus.diagnosa, t_reg_partus.nilai_apgar_2
		FROM t_pendaftaran
		  INNER JOIN m_rujukan ON (t_pendaftaran.KDRUJUK = m_rujukan.KODE)
		  INNER JOIN m_carabayar ON (t_pendaftaran.KDCARABAYAR = m_carabayar.KODE)
		  INNER JOIN t_reg_partus ON (t_reg_partus.idxdaftar = t_pendaftaran.IDXDAFTAR)
		  INNER JOIN m_dokter m_dokter1 ON (t_reg_partus.asisten = m_dokter1.KDDOKTER)
		  INNER JOIN m_pasien ON (t_reg_partus.nomr = m_pasien.NOMR)
		  INNER JOIN m_dokter ON (t_reg_partus.penolong = m_dokter.KDDOKTER) WHERE ".$search;
$qry_order = mysql_query($sql);
$order = mysql_fetch_assoc($qry_order);
?>
<div align="center">
    <div id="frame" style="width:100%">
        <div id="frame_title">
            <h3>LAPORAN REGISTRASI PARTUS</h3></div>
        <div align="right" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table class="tb">
                    <tr>
                        <td align="right">Tanggal &nbsp;<input type="text" name="tgl_reg" id="tgl_pesan" readonly="readonly" class="text"
                                                               value="<?if($_REQUEST['tgl_reg'] !=""): echo $_REQUEST['tgl_reg']; else: echo date('Y/m/d'); endif;?>" style="width:100px;"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                    <tr>
                        <td align="right">S/d &nbsp;<input type="text" name="tgl_reg2" id="tgl_pesan2" readonly="readonly" class="text"
                                                           value="<? if($_REQUEST['tgl_reg2'] !=""): echo $_REQUEST['tgl_reg2']; else: echo date('Y/m/d'); endif;?>" style="width:100px;" /><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td align="right"><input type="submit" value="C A R I" class="text"/></td>
                    </tr>           
                </table>
                <input type="hidden" name="link" value="v01" />
            </form>
            <div id="table_search" style="overflow: auto;">
                <table width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" class="tb">
                    <tr align="center">
                        <th width="5%" rowspan="2">NO</th>
                        <th width="5%" rowspan="2">NO RM</th>
                        <th width="30%" rowspan="2">TGL LAHIR/ JAM</th>
                        <th rowspan="2">LAHIR</th>
                        <th rowspan="2">NAMA</th>
                        <th rowspan="2">UMUR</th>
                        <th rowspan="2">PENDIDIKAN</th>
                        <th rowspan="2">ALAMAT</th>
                        <th rowspan="2">PENGIRIM</th>
                        <th colspan="2">PARITAS</th>
                        <th rowspan="2">JNS KELAMIN</th>
                        <th rowspan="2">BB (Kg)</th>
                        <th rowspan="2">PB (Cm)</th>
                        <th colspan="2">A/S</th>
                        <th rowspan="2">PENOLONG</th>
                        <th rowspan="2">ASISTEN</th>
                        <th rowspan="2">CARA BAYAR</th>
                        <th rowspan="2">JNS PERSALINAN</th>
                        <th rowspan="2">PARTUS PENYULIT</th>
                    </tr>
                    <tr align="center">
                        <th>ANUS</th>
                        <th>CACAD</th>
                        <th>1'</th>
                        <th>5'</th>
                    </tr>
                    <?
                    $NO=0;
                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_reg=".$tgl_reg."&tgl_reg2=".$tgl_reg2,"index.php?link=v01&");

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
                        <td><?
                                if($data['lahir']=="1") {
                                    echo "hidup";
                                }else {
                                    echo "mati";
                                }
    ?></td>
                        <td><? echo $data['NAMA']; ?></td>


                            <?php
                            if ($data['TGLLAHIR']=="") {
                                $a = datediff(date("Y/m/d"), date("Y/m/d"));
                            }
                            else {
                                $a = datediff($data['TGLLAHIR'], date("Y/m/d"));
                            }
    ?>

                        <td><?php echo $a[years].' tahun'; ?></td>
                        <td><?
                                if($data['PENDIDIKAN']=="1") {
                                    echo "SD";
                                }else if($data['PENDIDIKAN']=="2") {
                                    echo "SLTP";
                                }else if($data['PENDIDIKAN']=="3") {
                                    echo "SLTA";
                                }else if($data['PENDIDIKAN']=="4") {
                                    echo "D3/Akademik";
                                }else if($data['PENDIDIKAN']=="5") {
                                    echo "Universitas";
                                }
    ?></td>
                        <td><? echo $data['ALAMAT']; ?></td>
                        <td><? echo $data['rujukan']; ?></td>
                        <td><?
                                if($data['anus']=="1") echo "ya";
    ?></td>
                        <td><?
                                if($data['cacad']=="1") echo "ya";
    ?></td>
                        <td><? echo $data['jenis_kelamin']; ?></td>
                        <td><? echo $data['berat_badan']; ?></td>
                        <td><? echo $data['panjang_badan']; ?></td>
                        <td><? echo $data['nilai_apgar']; ?></td>
                        <td><? echo $data['nilai_apgar_2']; ?></td>
                        <td><? echo $data['penolong']; ?></td>
                        <td><? echo $data['asisten']; ?></td>
                        <td><? echo $data['carabayar']; ?></td>
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
                t_reg_partus.tanggal AS LAHIR_TGL_JAM,
                CASE t_reg_partus.lahir
                    WHEN 1 THEN 'Hidup'
                    WHEN 2 THEN 'Mati'
                END AS LAHIR,
                m_pasien.NAMA AS NAMA_PASIEN,
                m_pasien.TGLLAHIR AS TGL_LAHIR,
                CASE m_pasien.PENDIDIKAN
                    WHEN 1 THEN 'SD'
                    WHEN 2 THEN 'SLTP'
                    WHEN 3 THEN 'SLTA'
                    WHEN 4 THEN 'D3/Akademik'
                    WHEN 5 THEN 'Universitas'
                END AS PENDIDIKAN,
                m_pasien.ALAMAT AS ALAMAT,
  		m_rujukan.NAMA AS PENGIRIM,
                CASE t_reg_partus.anus
                    WHEN 1 THEN 'Ya'
                END AS PARITAS_ANUS,
                CASE t_reg_partus.cacad
                    WHEN 1 THEN 'Ya'
                END AS PARITAS_CACAD,
                t_reg_partus.jenis_kelamin AS JNS_KELAMIN,
                t_reg_partus.berat_badan AS BERAT_BADAN_KG,
                t_reg_partus.panjang_badan AS PANJANG_BADAN_CM,
                t_reg_partus.nilai_apgar AS APGAR_MNT_1,
                t_reg_partus.nilai_apgar_2 AS APGAR_MNT_5,
                m_dokter.NAMADOKTER AS PENOLONG,
                m_dokter1.NAMADOKTER AS ASISTEN,
                m_carabayar.NAMA AS CARA_BAYAR,
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
                END AS PENYULIT
		FROM t_pendaftaran
		  INNER JOIN m_rujukan ON (t_pendaftaran.KDRUJUK = m_rujukan.KODE)
		  INNER JOIN m_carabayar ON (t_pendaftaran.KDCARABAYAR = m_carabayar.KODE)
		  INNER JOIN t_reg_partus ON (t_reg_partus.idxdaftar = t_pendaftaran.IDXDAFTAR)
		  INNER JOIN m_dokter m_dokter1 ON (t_reg_partus.asisten = m_dokter1.KDDOKTER)
		  INNER JOIN m_pasien ON (t_reg_partus.nomr = m_pasien.NOMR)
		  INNER JOIN m_dokter ON (t_reg_partus.penolong = m_dokter.KDDOKTER) WHERE ".$search;
?>
<form name="formprint" method="post" action="vk/excelexport.php" target="_blank" >
    <input type="hidden" name="query" value="<?=$sql_excel?>" />
    <input type="hidden" name="header" value="LAPORAN REGISTRASI PARTUS" />
    <input type="hidden" name="filename" value="laporan_reg_partus" />
    <input type="submit" value="Export To Ms Excel Document" class="text" />
</form>
</p>
