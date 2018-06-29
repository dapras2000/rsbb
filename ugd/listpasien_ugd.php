<?php 
session_start();
include("include/connect.php");
include '../include/function.php';
require_once('ps_pagination.php');

//page relink (kembali ke list terakhir)
$_SESSION['page']=$_GET['page'];
$_SESSION['tgl_reg']=$_GET['tgl_reg'];
$_SESSION['tgl_reg2']=$_GET['tgl_reg2'];
$_SESSION['nama']=$_GET['nama'];
$_SESSION['norm']=$_GET['norm'];


$qry_poly = mysql_query("SELECT * FROM m_poly WHERE kode='".$_SESSION['KDUNIT']."'");
$poly = mysql_fetch_assoc($qry_poly);

$search = " AND DATE(b.TGLREG) = curdate() ";

$tgl_reg = "";
if(!empty($_GET['tgl_reg'])) {
    $tgl_reg =$_GET['tgl_reg'];
}

if($tgl_reg !="") {
    $search = " AND DATE(b.TGLREG) BETWEEN  '".$tgl_reg."' ";
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
    $search = $search." AND a.NAMA LIKE '%".$nama."%' ";
}

?>
<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>LIST DATA PASIEN POLIKLINIK <?php echo $poly['nama']; ?></h3></div>
        <div align="right" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table width="248" border="0" cellspacing="0" class="tb">
                    <tr>
                        <td width="52">No RM</td>
                        <td width="192"><input type="text" name="norm" id="norm" class="text" value="<? if($norm!="") {
                                echo $norm;
                                               }?>" style="width:80px;"></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td><input type="text" name="nama" id="nama" class="text" value="<? if($nama!="") {
                                echo $nama;
                                   }?>"></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td><input type="text" name="tgl_reg" id="tgl_pesan" class="text" style="width:100px;"
                                   value="<? if($_REQUEST['tgl_reg'] !=""): echo $_REQUEST['tgl_reg']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td>S/d</td>
                        <td><input type="text" name="tgl_reg2" id="tgl_pesan2" class="text" style="width:100px;"
                                   value="<? if($_REQUEST['tgl_reg2'] !=""): echo $_REQUEST['tgl_reg2']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Cari" class="text"/>
                            <input type="hidden" name="link" value="5" /></td>
                    </tr>
                </table>
            </form>
            <div id="table_search">
                <table width="95%" style="margin:10px;" border="0" cellspacing="0" cellspading="0" class="tb">
                    <tr align="center">
                        <th width="10px">NO </th>
                        <th width="50px">NO RM</th>
                        <th width="100px">Nama Pasien</th>
                        <th width="150px">Alamat</th>
                        <th width="70px">Kecamatan</th>
                        <th width="30px">Jenis Kelamin</th>
                        <th width="30px">Tanggal</th>
                        <th width="30px">Masuk</th>
                        <th width="30px">Keluar</th>
                        <th width="50px">Status Keluar</th>
                        <th width="50px">Keterangan</th>
                        <th width="80px">&nbsp;</th>
                    </tr>
                    <?
                 $sql="SELECT a.NOMR,a.NAMA,ALAMAT,a.TGLLAHIR,a.JENISKELAMIN, b.MASUKPOLY, b.TGLREG, b.KELUARPOLY, b.STATUS AS STATKELUAR, b.IDXDAFTAR, k.keterangan, a.KDKECAMATAN,
CASE b.minta_rujukan WHEN '1' THEN 'Minta Rujukan' END AS minta_rujukan,
CASE b.STATUS WHEN '6' THEN (SELECT f.nama FROM m_dasarrujuk f WHERE f.kode = c.alasan_rujuk) 
WHEN '5' THEN (SELECT f.nama FROM m_poly f WHERE f.kode = c.poly) 
ELSE NULL END AS namapoly
FROM m_pasien a, t_pendaftaran b 
LEFT JOIN m_statuskeluar k ON b.status=k.status
LEFT JOIN t_alasan_rujuk c ON b.idxdaftar=c.idxdaftar
		  WHERE a.nomr=b.nomr ".$search." and b.kdpoly='".$_SESSION['KDUNIT']."'
		  group by b.IDXDAFTAR
		  ORDER BY b.IDXDAFTAR ASC";
		  /*
		  $sqlcounter="SELECT count(*)
	      FROM m_pasien a, t_pendaftaran b 
		  LEFT JOIN m_statuskeluar k on b.status=k.status
		  LEFT JOIN t_alasan_rujuk c on b.idxdaftar=c.idxdaftar
		  LEFT JOIN m_poly d on d.kode=c.poly
		  WHERE a.nomr=b.nomr ".$search." and b.kdpoly='".$_SESSION['KDUNIT']."' and TGLREG = '".date('Y-m-d')."'
		  group by b.IDXDAFTAR
		  ORDER BY b.IDXDAFTAR ASC";
		  */
                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_reg=".$tgl_reg."&tgl_reg2=".$tgl_reg2."&norm=".$norm."&nama=".$nama,"index.php?link=5&");

                    //The paginate() function returns a mysql result set
                    $NO=0;
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
                        <td><? echo $data['NOMR'];//echo $sql;?></td>
                        <td><? echo $data['NAMA']; ?></td>
                        <td><? echo $data['ALAMAT']; ?></td>
                        <td><? echo getKecamatanName($data['KDKECAMATAN']); ?></td>
                        <td><? if($data['JENISKELAMIN']=="l" || $data['JENISKELAMIN']=="L") {
                                    echo"Laki-Laki";
                                }elseif($data['JENISKELAMIN']=="p" || $data['JENISKELAMIN']=="P") {
                                    echo"Perempuan";
    } ?></td>
                        <td><? echo $data['TGLREG']; ?></td>
                        <td><? echo $data['MASUKPOLY']; ?></td>
                        <td><? echo $data['KELUARPOLY']; ?></td>
                        <!--<td><? //echo $data['keterangan']." (".$data['namapoly'].")"; ?></td>-->
                        <td><? if($data['STATKELUAR']==0){echo 'belum pulang';}else{echo 'pulang';} ?></td>
                        <td><? echo $data['minta_rujukan']; ?></td>

                        <td><a href="index.php?link=51&nomr=<?=$data['NOMR'];?>&idx=<? echo $data['IDXDAFTAR']; ?>"><input type="button" class="text" value="Prosess" /></a>
    <? if($data['keterangan']=="") { ?>
                            | <a href="#" onclick="javascript : if(confirm('Yakin Batal?')){
                                window.location='./index.php?link=batal_r&idx=<?=$data['IDXDAFTAR']?>&page=<?=$_GET['page']?>&tgl_reg=<?=$_GET['tgl_reg']?>&tgl_reg2=<?=$_GET['tgl_reg2']?>&nama=<?=$_GET['nama']?>&norm=<?=$_GET['norm']?>';
                            }else{
                                return false;
                            };"><input type="button" class="text" value="Batal" /></a>
        <? } ?>
                        </td>
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
    $qry_excel = "SELECT  b.IDXDAFTAR AS INDEX_DAFTAR,
					a.nomr AS NORM, 
					a.NAMA AS NAMA_PASIEN,
					a.ALAMAT,
					a.JENISKELAMIN AS JNS_KELAMIN,
					b.MASUKPOLY AS TGL_MASUK, 
					b.KELUARPOLY AS TGL_KELUAR, 
					b.STATUS as STATKELUAR					 
	      	FROM m_pasien a, t_pendaftaran b 
		  	LEFT JOIN m_statuskeluar k on b.status=k.status
		  	LEFT JOIN t_alasan_rujuk c on b.idxdaftar=c.idxdaftar
		  	LEFT JOIN m_poly d on d.kode=c.poly
		  	WHERE a.nomr=b.nomr ".$search." and b.kdpoly='".$_SESSION['KDUNIT']."' 
		  	ORDER BY b.IDXDAFTAR ASC";
?>
    <div align="left">
        <form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
            <input type="hidden" name="query" value="<?=$qry_excel?>" />
            <input type="hidden" name="header" value="DATA KUNJUNGAN PASIEN POLIKLINIK <?php echo $poly['nama'];?>" />
            <input type="hidden" name="filename" value="data_kunjungan_pasien" />
            <input type="submit" value="Export To Ms Excel Document" class="text" />
        </form>
    </div>
</div>
<p></p>

