<?php 
session_start();
include("../include/connect.php");
require_once('ps_pagination.php');

$m = date('m');
$akhtahun = date('Y') - 20;
$c = date('Y');



$bulan = "";
if(!empty($_GET['bulan'])) {
    $bulan =$_GET['bulan'];
}else {
    $bulan =$m;
}

$bulan2 = "";
if(!empty($_GET['bulan2'])) {
    $bulan2 =$_GET['bulan2'];
}else {
    $bulan2 =$m;
}

$tahun = "";
if(!empty($_GET['tahun'])) {
    $tahun =$_GET['tahun'];
}else {
    $tahun =$c;
}

$search = "";
if($bulan==$bulan2) {
    $search = "WHERE MONTH(a.TANGGAL) = ".$bulan." AND YEAR(a.TANGGAL) =".$tahun." AND kode_obat NOT LIKE '07.%'";
}else {
    $search = "WHERE (MONTH(a.TANGGAL) BETWEEN ".$bulan." AND ".$bulan2.") AND YEAR(a.TANGGAL) =".$tahun." AND kode_obat NOT LIKE '07.%'";
}

$sql="SELECT dokter, b.NAMADOKTER,COUNT(DISTINCT noresep) AS jumlah_resep, COUNT(a.qty) AS jumlah_obat,
SUM(  IF (a.laplain = 'Generik' ,1,0)  ) AS generik,
SUM(  IF (a.laplain = 'Non Generik' ,1,0)  ) AS nongenerik
FROM t_billobat_ranap a
LEFT JOIN m_dokter b ON b.KDDOKTER = a.dokter
".$search."
GROUP BY a.dokter
ORDER BY a.dokter ASC";

$rs = mysql_query($sql);
?>
<div align="center">
    <div id="frame" style="width:100%">
        <? switch ($bulan) {
            case "1" :
                $bulan_name = "Januari";
                break;
            case "2" :
                $bulan_name = "Pebruari";
                break;
            case "3" :
                $bulan_name = "Maret";
                break;
            case "4" :
                $bulan_name = "April";
                break;
            case "5" :
                $bulan_name = "Mei";
                break;
            case "6" :
                $bulan_name = "Juni";
                break;
            case "7" :
                $bulan_name = "Juli";
                break;
            case "8" :
                $bulan_name = "Agustus";
                break;
            case "9" :
                $bulan_name = "September";
                break;
            case "10" :
                $bulan_name = "Oktober";
                break;
            case "11" :
                $bulan_name = "Nopember";
                break;
            case "12" :
                $bulan_name = "Desember";
                break;
        }

        switch ($bulan2) {
            case "1" :
                $bulan_name2 = "Januari";
                break;
            case "2" :
                $bulan_name2 = "Pebruari";
                break;
            case "3" :
                $bulan_name2 = "Maret";
                break;
            case "4" :
                $bulan_name2 = "April";
                break;
            case "5" :
                $bulan_name2 = "Mei";
                break;
            case "6" :
                $bulan_name2 = "Juni";
                break;
            case "7" :
                $bulan_name2 = "Juli";
                break;
            case "8" :
                $bulan_name2 = "Agustus";
                break;
            case "9" :
                $bulan_name2 = "September";
                break;
            case "10" :
                $bulan_name2 = "Oktober";
                break;
            case "11" :
                $bulan_name2 = "Nopember";
                break;
            case "12" :
                $bulan_name2 = "Desember";
                break;
        }
        ?>

        <div id="frame_title"><h3>
                <? if($bulan!=$bulan2) { ?>
                LAPORAN PEMANTAUAN PENULISAN RESEP OBAT GENERIK RAWAT INAP Periode <?=$bulan_name?> sd. <?=$bulan_name2?> Tahun <?=$tahun?>
                <? }else { ?>
                LAPORAN PEMANAUAN PENULISAN RESEP OBAT GENERIK RAWAT INAP Periode <?=$bulan_name?> Tahun <?=$tahun?>
                <? } ?>
            </h3></div>
        <div align="right" style="margin:5px;">
            <div id="table_search">
                <form name="filterlap" id="filterlap" method="get" >
                    <input type="hidden" name="link" value="110xt" />
                    <table class="tb" style="width:20%">
                        <tr>

                            <td>Bulan</td>
                            <td><select name="bulan" id="bulan" class="text">
                                    <option value="1" <? if($bulan == "1") { echo "selected=selected"; } ?> >Januari</option>
                                    <option value="2" <? if($bulan == "2") { echo "selected=selected"; } ?> >Pebruari</option>
                                    <option value="3" <? if($bulan == "3") { echo "selected=selected"; } ?> >Maret</option>
                                    <option value="4" <? if($bulan == "4") { echo "selected=selected"; } ?> >April</option>
                                    <option value="5" <? if($bulan == "5") { echo "selected=selected"; } ?> >Mei</option>
                                    <option value="6" <? if($bulan == "6") { echo "selected=selected"; } ?> >Juni</option>
                                    <option value="7" <? if($bulan == "7") { echo "selected=selected"; } ?> >Juli</option>
                                    <option value="8" <? if($bulan == "8") { echo "selected=selected"; } ?> >Agustus</option>
                                    <option value="9" <? if($bulan == "9") { echo "selected=selected"; } ?> >September</option>
                                    <option value="10" <? if($bulan == "10") { echo "selected=selected"; } ?> >Oktober</option>
                                    <option value="11" <? if($bulan == "11") { echo "selected=selected"; } ?> >Nopember</option>
                                    <option value="12" <? if($bulan == "12") { echo "selected=selected"; } ?> >Desember</option>
                                </select></td>
                        </tr>
                        <tr>

                            <td>Sd Bulan</td>
                            <td><select name="bulan2" id="bulan" class="text">
                                    <option value="1" <? if($bulan2 == "1") { echo "selected=selected"; } ?> >Januari</option>
                                    <option value="2" <? if($bulan2 == "2") { echo "selected=selected"; } ?> >Pebruari</option>
                                    <option value="3" <? if($bulan2 == "3") { echo "selected=selected"; } ?> >Maret</option>
                                    <option value="4" <? if($bulan2 == "4") { echo "selected=selected"; } ?> >April</option>
                                    <option value="5" <? if($bulan2 == "5") { echo "selected=selected"; } ?> >Mei</option>
                                    <option value="6" <? if($bulan2 == "6") { echo "selected=selected"; } ?> >Juni</option>
                                    <option value="7" <? if($bulan2 == "7") { echo "selected=selected"; } ?> >Juli</option>
                                    <option value="8" <? if($bulan2 == "8") { echo "selected=selected"; } ?> >Agustus</option>
                                    <option value="9" <? if($bulan2 == "9") { echo "selected=selected"; } ?> >September</option>
                                    <option value="10" <? if($bulan2 == "10") { echo "selected=selected"; } ?> >Oktober</option>
                                    <option value="11" <? if($bulan2 == "11") { echo "selected=selected"; } ?> >Nopember</option>
                                    <option value="12" <? if($bulan2 == "12") { echo "selected=selected"; } ?> >Desember</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Tahun</td>
                            <td><select name="tahun" id="tahun" class="text" >
                                    <? while($akhtahun <= $c) { ?>
                                    <option value="<?=$akhtahun?>" <? if($akhtahun == $c) { echo "selected=selected"; } ?>><?=$akhtahun?></option>
                                        <? $akhtahun++; } ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Open" class="text" /></td>
                            <td></td>
                        </tr>
                    </table>
                </form>


                <table width="99%" border="0" cellspacing="1" cellpadding="1" class="tb">
                    <tr>
                        <th width="20"><div align="center">NO</div></th>
                        <th width="100"><div align="center">DOKTER</div></th>
                        <th width="50"><div align="center">JUMLAH LMB RESEP</div></th>
                        <th width="50"><div align="center">TOTAL /R</div></th>
                        <th width="50"><div align="center">TOTAL R/
                                OBAT GENERIK</div></th>
                        <th width="50"><div align="center">% R/ GENERIK  thd TOTAL R/</div></th>

                    </tr>
                    <?
                    $NO=0;
                    $pager = new PS_Pagination($connect, $sql,25,5, "bulan=".$bulan."&bulan2=".$bulan2."&tahun=".$tahun, "index.php?link=110xt&");

                    //The paginate() function returns a mysql result set
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
                    $x= 1;
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
                        <td><?=$data['NAMADOKTER']?></td>
                        <td align="right"><?=$data['jumlah_resep']?></td>
                        <td align="right"><?=$data['jumlah_obat']?></td>
                        <td align="right"><?=$data['generik']?></td>
                        <td align="right"><?
											  if($data['jumlah_obat']>0){
											  	echo curformat(($data['generik'] /$data['jumlah_obat'])*100,1);
											  }else{
											  echo "0";
											  }?> % </td>

                    </tr>
                    <? } ?>
                </table>
                <?

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
<br />
<? $sql_excel="SELECT m_dokter.namadokter AS DOKTER,
count(t_resep.idxresep) AS JML_RESEP,
count(`t_permintaan_apotek`.idxbarang) AS JML_R,
count(
case when non_generik = ''
then `t_permintaan_apotek`.idxbarang
else NULL
end
) AS JML_R_GENERIK,
(count(
case when non_generik = ''
then `t_permintaan_apotek`.idxbarang
else NULL
end
)/count(`t_permintaan_apotek`.idxbarang))*100 AS PERCENT_R_GENERIK
FROM t_resep
left join `t_permintaan_apotek`  on (`t_permintaan_apotek`.idxresep=t_resep.idxresep)
inner join m_dokter on (`t_resep`.kddokter=m_dokter.kddokter) ".$search."
group by m_dokter.namadokter ";?>
<div id="msg" >
    <form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
        <input type="hidden" name="query" value="<?=$sql?>" />
        <input type="hidden" name="header" value="
        <? if($bulan!=$bulan2) { ?>
               LAPORAN PEMANTAUAN PENULISAN RESEP OBAT GENERIK Periode <?=$bulan_name?> sd. <?=$bulan_name2?> Tahun <?=$tahun?>
               <? }else { ?>
               LAPORAN PEMANAUAN PENULISAN RESEP OBAT GENERIK Periode <?=$bulan_name?> Tahun <?=$tahun?>
               <? } ?>" />
        <input type="hidden" name="filename" value="pemantauan_resep" />
        <input type="submit" value="Export To Ms Excel Document" class="text" />
    </form>
</div>
<p></p>



