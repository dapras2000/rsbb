<?php 
include("include/connect.php");
require_once('ps_pagination.php');

$myquery = "SELECT 
  m_login.NIP,
  m_login.DEPARTEMEN,
  m_login.KDUNIT
FROM
  m_login
WHERE  m_login.NIP='".$_SESSION['NIP']."'";

$get = mysql_query ($myquery)or die(mysql_error());
$userdata = mysql_fetch_assoc($get); 		
$nip=$userdata['NIP'];
$kdpoly=$userdata['KDUNIT'];
$bagian=$userdata['DEPARTEMEN'];

$search = " AND a.tanggal = curdate() ";

$tgl_reg = "";
if(!empty($_GET['tgl_reg'])) {
    $tgl_reg =$_GET['tgl_reg'];
}

if($tgl_reg !="") {
    $search = " AND a.tanggal BETWEEN  '".$tgl_reg."' ";
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


?>

<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title">
            <h3>SENSUS HARIAN RAWAT JALAN</h3></div>
        <div align="right" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table class="tb">
                    <tr>
                        <td align="right">Tanggal &nbsp;<input type="text" name="tgl_reg" id="tgl_pesan" readonly="readonly" class="text"
                                                               value="<? if($_REQUEST['tgl_reg'] !=""): echo $_REQUEST['tgl_reg']; else: echo date('Y/m/d'); endif;?>" style="width:100px;"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td align="right">S/d &nbsp;<input type="text" name="tgl_reg2" id="tgl_pesan2" readonly="readonly" class="text"
                                                           value="<? if($_REQUEST['tgl_reg2'] !=""): echo $_REQUEST['tgl_reg2']; else: echo date('Y/m/d'); endif;?>" style="width:100px;" /><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td align="right"><input type="submit" value="C A R I" class="text"/></td>
                    </tr>



                </table>
                <input type="hidden" name="link" value="54" />
            </form>
            <div id="table_search">
                <table width="100%" border="0" cellspacing="0" cellspading="0" class="tb">
                    <tr align="center">
                        <th width="5%">NO</th>
                        <th width="5%">TANGGAL</th>
                        <th width="5%">NOMR</th>
                        <th width="8%">NAMA</th>
                        <th width="2%">L/P</th>
                        <th width="5%">UMUR</th>
                        <th width="11%">KECAMATAN</th>
                        <th width="7%">KOTA</th>
                        <th width="10%">DIAGNOSA</th>
                        <th width="9%">TINDAKAN </th>
                        <th width="8%">CARABAYAR</th>
                        <th width="5%">DOKTER</th>                        
                        <th width="5%">KELUAR</th>
                        <th width="8%">PE<br />NGUN<br />JUNG</th>
                        <th width="6%">KUN<br />JU<br />NGAN</th>
                        <th width="8%">KA<br />SUS</th>
                        <th width="8%">RUJUKAN</th>
                        <th width="8%">KET RUJUKAN</th>
                        <th width="8%">ICD X</th>
                    </tr>
                    <?
                    $sql = "SELECT a.nomr,b.nama,b.TGLLAHIR, b.jeniskelamin,a.tanggal, 
(select namakota from m_kota where b.kota = idkota) AS kota, 
(select namakecamatan from m_kecamatan where b.kdkecamatan = idkecamatan) AS kdkecamatan, 
a.diagnosa,a.terapi, 
(select nama from m_carabayar where kode = c.kdcarabayar) AS kdcarabayar, 
CASE c.pasienbaru 
WHEN 0 THEN 'L' ELSE 'B' END AS pasienbaru, 
d.keterangan AS kdtujuanrujuk, dr.namadokter, 
CASE c.pasienbaru 
WHEN 0 THEN 'L' ELSE 'B' END AS pasienbaru, 
CASE a.kunjungan_bl 
WHEN 0 THEN 'L' ELSE 'B' END AS kunjungan_bl, 
CASE a.kasus_bl 
WHEN 0 THEN 'L' ELSE 'B' END AS kasus_bl, 
a.icd_code, k.NAMA AS RUJUKAN, c.KETRUJUK
FROM t_diagnosadanterapi a 
INNER JOIN m_dokter dr ON dr.kddokter=a.kddokter 
INNER JOIN m_pasien b ON a.nomr=b.nomr 
INNER JOIN t_pendaftaran c ON a.idxdaftar=c.idxdaftar 
LEFT JOIN m_statuskeluar d ON c.status=d.status
LEFT JOIN m_rujukan k ON k.KODE = c.KDRUJUK
where a.kdpoly='".$kdpoly."' ".$search;

  $sqlcounter = "select count(a.nomr) from t_diagnosadanterapi a
inner join m_dokter dr on dr.kddokter=a.kddokter
inner join m_pasien b on a.nomr=b.nomr
inner join t_pendaftaran c on a.idxdaftar=c.idxdaftar
left join m_statuskeluar d on c.status=d.status
where a.kdpoly='$kdpoly' ".$search;

                    $NO=0;
                    $pager = new PS_Pagination($connect, $sql,15, 5, "tgl_reg=".$tgl_reg."&tgl_reg2=".$tgl_reg2,"index.php?link=54&");

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
                        <td><? echo $data['tanggal'];?></td>
                        <td><strong><? echo $data['nomr'];?></strong></td>
                        <td align="center"><? echo $data['nama'];?> </td>
                        <td align="center"><? echo $data['jeniskelamin']; ?> </td>
                            <?php
                            if ($data['tanggal']=="") {
                                $a = datediff(date("Y/m/d"), date("Y/m/d"));
                            }
                            else {
                                $a = datediff($data['tanggal'], $data['TGLLAHIR']);
                            }
    ?>
                        <td align="center"><?php echo 'umur '.$a[years].' tahun '.$a[months].' bulan '.$a[days].' hari'; ?></td>
                        <td align="center"><? echo $data['kdkecamatan']; ?> </td>
                        <td align="center"><? echo $data['kota']; ?> </td>
                        <td align="center"><? echo $data['diagnosa'];?> </td>
                        <td align="center"><? echo $data['terapi'];?> </td>
                        <td align="center"><? echo $data['kdcarabayar'];?> </td>
                        <td width="8%" align="center"><? echo $data['namadokter'];?> </td>                        
                        <td width="5%" align="center"><? echo $data['kdtujuanrujuk'];?> </td>
                        <td width="8%" align="center"><? echo $data['pasienbaru'];?> </td>
                        <td width="6%" align="center"><? echo $data['kunjungan_bl'];?> </td>
                        <td width="8%" align="center"><? echo $data['kasus_bl'];?> </td>
                        <td width="8%" align="left"><? echo $data['RUJUKAN'];?> </td>
                        <td width="8%" align="left"><? echo $data['KETRUJUKAN'];?> </td>
                        <td align="center"><? echo $data['icd_code'];?> </td>
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
    <br />
    <?
    $qry_excel = "select a.tanggal AS TGL_DAFTAR,
    a.nomr AS NORM,
					b.nama AS NAMA_PASIEN,
					b.TGLLAHIR AS TGL_LAHIR, 
					b.jeniskelamin AS JNS_KELAMIN,
					(select namakecamatan from m_kecamatan where b.kdkecamatan = idkecamatan) AS ALAMAT_KECAMATAN,
					(select namakota from m_kota where b.kota= idkota) AS KOTA,
       				a.diagnosa AS DIAGNOSA,
					a.terapi AS TERAPI,
       				(select nama from m_carabayar where kode = c.kdcarabayar) AS STATUS_BAYAR,
					d.keterangan AS KET_KELUAR,
					dr.namadokter,
					case a.kunjungan_bl when 0 then 'L' else 'B' end AS PENGUNJUNG,
       				case c.pasienbaru when 0 then 'L' else 'B' end AS PASIEN_BARU_LAMA,
              		case a.kasus_bl when 0 then  'L' else 'B' end as KASUS_BARU_LAMA, 
					a.icd_code AS ICD_X 
				from t_diagnosadanterapi a
				inner join m_dokter dr on dr.kddokter=a.kddokter
				inner join m_pasien b on a.nomr=b.nomr 
				inner join t_pendaftaran c on a.idxdaftar=c.idxdaftar  
				left join m_statuskeluar d on c.status=d.status
				where a.kdpoly='$kdpoly' ".$search;
?>
    <div align="left">
        <form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
            <input type="hidden" name="query" value="<?=$sql?>" />
            <input type="hidden" name="header" value="SENSUS RAWAT JALAN" />
            <input type="hidden" name="filename" value="sensus_rawat_jalan" />
            <input type="submit" value="Export To Ms Excel Document" class="text" />
        </form>
    </div>
</div>