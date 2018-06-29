<html>
    <head>
        <link rel="stylesheet" href="adm/eksekutif/slide/style.css" />
    </head>
    <body>
        <div align="center">
            <div id="frame" style="width:100%;">
                <div id="frame_title"><h3 align="left">REKAP PASIEN KAMAR OPERASI</h3></div>
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
                                    <input type="hidden" name="link" value="privatekam2" /></td>
                            </tr>
                        </table>

                    </form>
                    <?
//$antara=gmdate('Y-m');
                    $search = "";
                    $tgl1 = "";
                    if(!empty($_GET['tgl_kunjungan'])) {
                        $tgl1 =$_GET['tgl_kunjungan'];
                    }

                    if($tgl1 !="") {
                        $search = " and a.tglreg BETWEEN '".$tgl1."'";
                    }

                    $tgl2 = "";
                    if(!empty($_GET['tgl_kunjungan2'])) {
                        $tgl2 =$_GET['tgl_kunjungan2'];
                    }


                    if($tgl1 !="") {
                        if($tgl2 !="") {
                            $search = $search." AND '".$tgl2."'";
                        }else {
                            $search = $search." AND '".$tgl1."'";
                        }
                    }

                    if($search == "") {
                        $search = " and concat(month(a.tglreg),year(a.tglreg)) = concat(month(CURRENT_DATE()),year(CURRENT_DATE())) ";

                    }

                    include("../../../include/connect.php");
                    $sql1="select date_format(a.tglreg,'%d-%m-%Y') as tglreg,a.kdpoly,
			cast(sum(a.kdcarabayar*(1-abs(sign(a.kdcarabayar-1)))) as UNSIGNED ) as carabayar_kd1,
			cast(sum(a.kdcarabayar/2*(1-abs(sign(a.kdcarabayar-2)))) as UNSIGNED ) as carabayar_kd2,
			cast(sum(a.kdcarabayar/3*(1-abs(sign(a.kdcarabayar-3)))) as UNSIGNED ) as carabayar_kd3,
			cast(sum(a.kdcarabayar/4*(1-abs(sign(a.kdcarabayar-4)))) as UNSIGNED ) as carabayar_kd4,
			cast(sum(a.kdcarabayar/5*(1-abs(sign(a.kdcarabayar-5)))) as UNSIGNED ) as carabayar_kd5,
                        cast(sum(a.kdcarabayar/6*(1-abs(sign(a.kdcarabayar-6)))) as UNSIGNED ) as carabayar_kd6
FROM t_pendaftaran a
inner join m_pembedahan m on (a.kdcarabayar=m.kode)
inner join t_operasi o on (o.idxdaftar=a.idxdaftar)
WHERE o.`status` = 'selesai'
".$search." GROUP BY a.tglreg";
                    $qry1=mysql_query($sql1);
                    while($baris=mysql_fetch_assoc($qry1)) {
                        $tgl=$baris['tglreg'];

                        $data1=$baris['carabayar_kd1'];
                        $data2=$baris['carabayar_kd2'];
                        $data3=$baris['carabayar_kd3'];
                        $data4=$baris['carabayar_kd4'];
                        $data5=$baris['carabayar_kd5'];
                        $data6=$baris['carabayar_kd6'];

                        $d1[$tgl]=$data1;
                        $d2[$tgl]=$data2;
                        $d3[$tgl]=$data3;
                        $d4[$tgl]=$data4;
                        $d5[$tgl]=$data5;
                        $d6[$tgl]=$data6;
                    }
                    ?>

                    <table border="0" width="100%">
                        <tr>
                            <td align="center">
                                <img src="adm/eksekutif/kam_pie_pembedahan.php?tgl1=<?=$_GET['tgl_kunjungan']?>&tgl2=<?=$_GET['tgl_kunjungan2']?>" width="500" height="400"/>
                            </td>

                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <div align="left">
            <form name="formexport" method="post" action="adm/eksekutif/rekap_kam_pembedahan_excel.php" target="_blank" >
                <input type="hidden" name="tgl_1" value="<?=$_GET['tgl_kunjungan']?>" />
                <input type="hidden" name="tgl_2" value="<?=$_GET['tgl_kunjungan2']?>" />
                <input type="submit" value="Export To Ms Excel Document" class="text" />
            </form>
        </div>
    </body>
</html>