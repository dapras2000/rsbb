<html>
    <head>
        <link rel="stylesheet" href="adm/eksekutif/slide/style.css" />
    </head>
    <body>
        <div align="center">
            <div id="frame" style="width:100%;">
                <div id="frame_title"><h3 align="left">REKAP 10 PEMERIKSAAN TERBANYAK</h3></div>
                <div align="left" >
                    <form name="formsearch" method="get" >
                        <table width="248" border="0" cellspacing="0" class="tb">
                            <tr>
                                <td>Tanggal</td>
                                <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text"
                                           value="<? if($_GET['tgl_kunjungan']!="") {
                                               echo $_GET['tgl_kunjungan'];
                                           }?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                            </tr>
                            <tr>
                                <td>Sd</td>
                                <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text"
                                           value="<? if($_GET['tgl_kunjungan2']!="") {
                                               echo $_GET['tgl_kunjungan2'];
                                           }?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit" value="Cari" class="text"/>
                                    <input type="hidden" name="link" value="privaterad2" /></td>
                            </tr>
                        </table>

                    </form>     
                    <table border="0" width="100%">

                        <tr>
                            <td align="center">
                                <img src="adm/eksekutif/rad_pie_10periksa.php?tgl1=<?=$_GET['tgl_kunjungan']?>&tgl2=<?=$_GET['tgl_kunjungan2']?>" width="500" height="400"/>
                            </td>
                            <td>

                                <!-- -->
                                <?
                                include("../../../include/connect.php");
                                require_once('new_pagination.php');

                                $tgl_reg = "";
                                if(!empty($_GET['tgl_kunjungan'])) {
                                    $tgl_reg =$_GET['tgl_kunjungan'];
                                }

                                if($tgl_reg !="") {
                                    $search = " AND t_radiologi.TGLORDER BETWEEN  '".$tgl_reg."' ";
                                }

                                $tgl_reg2 = "";
                                if(!empty($_GET['tgl_kunjungan2'])) {
                                    $tgl_reg2 =$_GET['tgl_kunjungan2'];
                                }


                                if($tgl_reg !="") {
                                    if($tgl_reg2 !="") {
                                        $search = $search." AND '".$tgl_reg2."' ";
                                    }else {
                                        $search = $search." AND '".$tgl_reg."' ";
                                    }
                                }

                                if($search == "") {
                                    $search = " AND concat(month(t_radiologi.TGLORDER),year(t_radiologi.TGLORDER)) = concat(month(CURRENT_DATE()),year(CURRENT_DATE())) ";
                                }
                                ?>


                                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellpadding="1" >
                                    <tr align="center">
                                        <th width="50px">NO Urut</th>
                                        <th>Jenis Photo</th>
                                        <th width="50px">Jumlah</th>
                                    </tr>
                                    <?
                                    $sql = "SELECT count(m_radiologi.kd_rad) as jml, m_radiologi.kd_rad, m_radiologi.nama_rad
            FROM m_radiologi
        INNER JOIN (
          SELECT DISTINCT t_radiologi.IDXDAFTAR, m_radiologi.gr_rad
          FROM t_radiologi
          INNER JOIN m_radiologi ON (t_radiologi.JENISPHOTO = m_radiologi.kd_rad)
          INNER JOIN m_radiologi m_rad1 ON (m_radiologi.gr_rad = m_rad1.kd_rad)
          where NO_FILM is not null ".$search."
        ) rd ON (m_radiologi.kd_rad = rd.gr_rad)
        GROUP BY m_radiologi.kd_rad ORDER BY jml DESC";

                                    $NO=0;
                                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_reg."&tgl_kunjungan2=".$tgl_reg2,"index.php?link=privaterad2&");
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
                                        <td align="center"><? $NO=($NO+1);
                                                if ($_GET['page']==0) {
                                                    $hal=0;
                                                }else {
                                                    $hal=$_GET['page']-1;
                                                } echo
   
    ($hal*15)+$NO;?></td>
                                           <td><? echo $data['nama_rad'];?></td>
                                        <td align="right"><? echo $data['jml']; ?></td>

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
                                <!-- -->
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <div align="left">
            <form name="formexport" method="post" action="adm/eksekutif/rad_rekap_10periksa_excel.php" target="_blank" >
                <input type="hidden" name="tgl_1" value="<?=$_GET['tgl_kunjungan']?>" />
                <input type="hidden" name="tgl_2" value="<?=$_GET['tgl_kunjungan2']?>" />
                <input type="submit" value="Export To Ms Excel Document" class="text" />
            </form>
        </div>
    </body>
</html>