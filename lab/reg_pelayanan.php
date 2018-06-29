<?php 
session_start();
include("include/connect.php");
require_once('ps_pagination.php');

$search = " AND date(tglreg) = curdate() ";
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])) {
    $tgl_kunjungan =$_GET['tgl_kunjungan'];
} 

if($tgl_kunjungan !="") {
    $search = " AND date(tglreg) BETWEEN  '".$tgl_kunjungan."' ";
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

?>

<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title">
            <h3>REGISTER PELAYANAN INSTALASI LABORATORIUM</h3></div>
        <div align="right" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table border="0" cellspacing="0" class="tb">


                    <tr>
                        <td>Tanggal</td>
                        <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" style="width:100px;"
                                   value="<? if($_REQUEST['tgl_kunjungan'] !=""): echo $_REQUEST['tgl_kunjungan']; else: echo date('Y/m/d'); endif;?>"/>
								   <a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td>Sd</td>
                        <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" style="width:100px;"
                                   value="<? if($_REQUEST['tgl_kunjungan2'] !=""): echo $_REQUEST['tgl_kunjungan2']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Cari" class="text"/>
                            <input type="hidden" name="link" value="l05" /></td>
                    </tr>
                </table>

            </form>
            <div id="table_search">
                <div style="overflow:scroll;width:98%;height:auto;">
                    <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                        <tr align="center">
                            <th rowspan="2">NO</th>
                            <th rowspan="2">TANGGAL</th>
                            <th rowspan="2">SHIFT</th>
                            <th rowspan="2">NO REG</th>
                            <th rowspan="2">NAMA</th>
                            <th colspan="2">UMUR</th>
                            <th colspan="3">RUJUKAN</th>
                            <th rowspan="2">DOKTER PENGIRIM</th>
                            <th colspan="7">CARA BAYAR</th>
                            <th colspan="2" rowspan="2">JENIS PEMERIKSAAN</th>
                            <th colspan="2" rowspan="2">HASIL PERIKSA</th>

                        </tr>
                        <tr align="center">
                            <th >L</th>
                            <th >P</th>
                            <th >POLI</th>
                            <th >INAP</th>
                            <th >APS</th>
                            <th >TUNAI</th>
                            <th >ASKES</th>
                            <th >ASKESKIN</th>
                            <th >IKS</th>
                            <th >JAMSOSTEK</th>
                            <th >TDK MAMPU</th>
                            <th >PERS</th>
                        </tr>
                        <?

                        $sql = "select distinct b.tglreg,date(tgl_mulai) as tgl_mulai, shif, nolab,nama,jeniskelamin, tgllahir,
			case when rajal=1 then (select nama from m_poly where kode=a.kdpoly) end as poly,
			case when rajal=0 then (select nama from m_ruang where no=a.kdpoly) end  as inap,
			(select NAMADOKTER from m_dokter where KDDOKTER = drpengirim) as drpengirim,
			case when b.kdcarabayar=1 then 'X' end  as umum,
			case when b.kdcarabayar=2 then 'X' end  as askes,
			case when b.kdcarabayar=3 then 'X' end  as jmks,
			case when b.kdcarabayar=4 then 'X' end  as sktm,
			case when b.kdcarabayar=5 then 'X' end  as lainlain,
			b.idxdaftar
			from t_orderlab a
			inner join m_lab m on (m.kode_jasa=a.kode)
			inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar
			inner join m_pasien c on b.nomr=c.nomr 
			WHERE a.status = '1' ".$search;

                        $NO=0;
                        $pager = new PS_Pagination($connect, $sql, 10, 10, "tgl_kunjungan=".$tgl_kunjungan."&tgl_kunjungan2=".$tgl_kunjungan2,"index.php?link=l05&");
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
                            <td><? echo $data['tglreg'];?></td>
                            <td><? echo $data['shif'];?></td>
                            <td><? echo $data['nolab']; ?></td>
                            <td><? echo $data['nama']; ?></td>
    <?
    $a = datediff($data['tgllahir'],  $data['tglreg']);

    ?>
                            <td><?  if($data['jeniskelamin']=="L") echo  $a[years]." tahun "; ?></td>
                            <td><?  if($data['jeniskelamin']=="P") echo  $a[years]." tahun "; ?></td>
                            <td><? echo $data['poly']; ?></td>
                            <td><? echo $data['inap']; ?></td>
                            <td>&nbsp;</td>
                            <td><? echo $data['drpengirim']; ?></td>

                            <td><? echo $data['umum'];?></td>
                            <td><? echo $data['askes'];?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
    <?
    $k = $data['sktm'];
    $l = $data['jmks'];
    ?>

                            <td><? echo $k.$l;?></td>
                            <td><? echo $data['lainlain']?></td>
                            <td colspan="2">&nbsp;</td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                            <?
                            $qry_jnsperiksa = "select distinct m.ket,
   			(select nama_jasa from m_lab where kode_jasa=m.group_jasa and group_jasa='0101') as jns_periksa,
			m.group_jasa
			from t_orderlab a
			inner join m_lab m on (m.kode_jasa=a.kode)
			inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar
			where a.idxdaftar = ".$data['idxdaftar']." and a.status = '1' and  a.nolab = '".$data['nolab']."'";
    $get_jnsperiksa = mysql_query($qry_jnsperiksa);
    while($dat_jnsperiksa=mysql_fetch_array($get_jnsperiksa)) {
        ?>
                        <tr bgcolor="#F5F7B7">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><? echo $dat_jnsperiksa['jns_periksa']." ".$dat_jnsperiksa['ket'];?></td>
                            <td>&nbsp;</td>
                            <td colspan="2">&nbsp;</td>

                        </tr>
                                <?
                                $qryx_jnsperiksa = "select hasil_periksa, m.unit, m.nama_jasa
			from t_orderlab a
			inner join m_lab m on (m.kode_jasa=a.kode)
			inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar
			where a.idxdaftar = ".$data['idxdaftar']." and a.status = '1' and  a.nolab = '".$data['nolab']."'
			and m.group_jasa = '".$dat_jnsperiksa['group_jasa']."'";
        $getx_jnsperiksa = mysql_query($qryx_jnsperiksa);
        while($datx_jnsperiksa=mysql_fetch_array($getx_jnsperiksa)) {
            ?>
                        <tr bgcolor="#F5F7B7">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><?=$datx_jnsperiksa['nama_jasa']?></td>
                            <td><?=$datx_jnsperiksa['hasil_periksa']?></td>
                            <td><?=$datx_jnsperiksa['unit']?></td>

                        </tr>
                                    <? } ?>

                                <? } ?>

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
                </div>
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
    $qry_excel = "select b.idxdaftar AS INDEX_DAFTAR,
			b.tglreg AS TANGGAL,
			shif AS SHIFT, 
			nolab AS NO_REG,
			nama AS NAMA_PASIEN,
			jeniskelamin AS JNS_KELAMIN, 
			tgllahir AS TGL_LAHIR,
			case when rajal=1 then (select nama from m_poly where kode=a.kdpoly) end AS POLY,
			case when rajal=0 then (select nama from m_ruang where no=a.kdpoly) end  AS RANAP,
			(select NAMADOKTER from m_dokter where KDDOKTER = drpengirim) AS DR_PENGIRIM,
			case when b.kdcarabayar=1 then 'X' end AS CRBAYAR_UMUM,
			case when b.kdcarabayar=2 then 'X' end  AS CRBAYAR_ASKES,
			case when b.kdcarabayar=3 then 'X' end  AS CRBAYAR_JMKS,
			case when b.kdcarabayar=4 then 'X' end  AS CRBAYAR_SKTM,
			case when b.kdcarabayar=5 then 'X' end  AS CRBAYAR_LAIN,
			concat((select nama_jasa from m_lab where kode_jasa=m.group_jasa and group_jasa='0101'),m.ket) AS GRP_LAB,
			m.nama_jasa AS PRK_LAB,
			hasil_periksa AS HSL_LAB, 
			m.unit AS UNIT
			from t_orderlab a
			inner join m_lab m on (m.kode_jasa=a.kode)
			inner join t_pendaftaran b on a.idxdaftar=b.idxdaftar
			inner join m_pasien c on b.nomr=c.nomr 
			WHERE a.status = '1' ".$search;
?>
    <div align="left">
        <form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
            <input type="hidden" name="query" value="<?=$qry_excel?>" />
            <input type="hidden" name="header" value="REG PELAYANAN LAB" />
            <input type="hidden" name="filename" value="reg_plyn_lab" />
            <input type="submit" value="Export To Ms Excel Document" class="text" />
        </form>
    </div>
</div>