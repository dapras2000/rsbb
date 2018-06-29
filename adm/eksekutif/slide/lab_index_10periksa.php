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
                                    <input type="hidden" name="link" value="privatelab2" /></td>
                            </tr>
                        </table>

                    </form>     
                    <table border="0" width="100%">

                        <tr>
                            <td align="center">
                                <img src="adm/eksekutif/lab_pie_10periksa.php?tgl1=<?=$_GET['tgl_kunjungan']?>&tgl2=<?=$_GET['tgl_kunjungan2']?>" width="500" height="400"/>
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
                                    $search = " AND t_orderlab.TANGGAL BETWEEN  '".$tgl_reg."' ";
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
                                    $search = " AND concat(month(t_orderlab.TANGGAL),year(t_orderlab.TANGGAL)) = concat(month(CURRENT_DATE()),year(CURRENT_DATE())) ";
                                }
                                ?>


                                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellpadding="1" >
                                    <tr align="center">
                                        <th width="50px">NO Urut</th>
                                        <th>Jenis Periksa</th>
                                        <th width="50px">Jumlah</th>
                                    </tr>
                                    <?
                                    $sql = "SELECT count(m_lab.kode_jasa) as jml, m_lab.kode_jasa, m_lab.nama_jasa
            FROM m_lab
        INNER JOIN (
          SELECT DISTINCT t_orderlab.IDXDAFTAR, m_lab.group_jasa
          FROM t_orderlab
          INNER JOIN m_lab ON (t_orderlab.KODE = m_lab.kode_jasa)
          INNER JOIN m_lab m_lab1 ON (m_lab.group_jasa = m_lab1.kode_jasa)
          WHERE t_orderlab.`STATUS` = 1 ".$search."
        ) lb ON (m_lab.kode_jasa = lb.group_jasa)
        GROUP BY m_lab.kode_jasa ORDER BY jml DESC";

                                    $NO=0;
                                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_reg."&tgl_kunjungan2=".$tgl_reg2,"index.php?link=privatelab2&");
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
                                           <td><? echo $data['nama_jasa'];?></td>
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
            <form name="formexport" method="post" action="adm/eksekutif/lab_rekap_10periksa_excel.php" target="_blank" >
                <input type="hidden" name="tgl_1" value="<?=$_GET['tgl_kunjungan']?>" />
                <input type="hidden" name="tgl_2" value="<?=$_GET['tgl_kunjungan2']?>" />
                <input type="submit" value="Export To Ms Excel Document" class="text" />
            </form>
        </div>
    </body>
</html>