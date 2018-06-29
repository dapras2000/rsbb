<?php session_start();
include("include/connect.php");
require_once('ps_pagination.php');

$_SESSION['page']=$_GET['page'];
$_SESSION['tgl_reg']=$_GET['tgl_reg'];
$_SESSION['tgl_reg2']=$_GET['tgl_reg2'];
$_SESSION['nama']=$_GET['nama'];
$_SESSION['norm']=$_GET['norm'];

$qry_poly = mysql_query("SELECT * FROM m_poly WHERE kode='".$_SESSION['KDUNIT']."'");
$poly = mysql_fetch_assoc($qry_poly);

//$start	= date('Y-m-d');
//$end	= date('Y-m-d');
$start="";
$end="";
if($_REQUEST['tgl_reg'] != ''){
	$start	= $_REQUEST['tgl_reg'];
}

if($_REQUEST['tgl_reg2'] != ''){
	$end	= $_REQUEST['tgl_reg2'];
}

 if( ($start !="") and ($end != "") ){
	$search	= 'and a.masukrs between "'.$start.'" and "'.$end.'"';
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
    $search = $search." AND b.NAMA LIKE '%".$nama."%' ";
}
?>
<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title">
            <h3>LIST DATA PASIEN KAMAR RAWAT INAP BERSALIN</h3></div>
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
                            <input type="hidden" name="link" value="5ranap" /></td>
                    </tr>
                </table>

            </form>
            <div id="table_search">
                <table width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" class="tb">
                    <tr align="center">
                        <th style="width:25px;">NO </th>
                        <th style="width:50px;">NO RM</th>
                        <th>Nama Pasien</th>
                        <th>Alamat</th>
                        <th style="width:65px;">Cara Bayar</th>
                        <th style="width:70px;">Masuk RS</th>
                        <th style="width:25px;">No Bed</th>
                        <th style="width:100px;">Admin</th>
                        <th>&nbsp;</th>
                    </tr>
                    <?
#					INNER JOIN t_bayarrajal r ON r.IDXDAFTAR = b.IDXDAFTAR
					/*
                    $sql="SELECT a.*, b.TGLREG, b.MASUKPOLY, b.KELUARPOLY, b.STATUS as STATKELUAR, b.IDXDAFTAR, k.keterangan, d.nama as namapoly
	      FROM m_pasien a, t_pendaftaran b 
		  LEFT JOIN m_statuskeluar k on b.status=k.status
		  LEFT JOIN t_alasan_rujuk c on b.idxdaftar=c.idxdaftar
		  LEFT JOIN m_poly d on d.kode=c.poly
		  
		  WHERE a.nomr=b.nomr ".$search." and b.kdpoly='".$_SESSION['KDUNIT']."' ".$search."
		  ORDER BY b.IDXDAFTAR ASC";
		  			*/
					$sql	= 'select a.nomr, a.NIP, b.NAMA, b.ALAMAT, c.NAMA as CARABAYAR, a.masukrs, a.nott,a.id_admission from t_admission a join m_pasien b on b.nomr = a.nomr join m_carabayar c on c.KODE = a.statusbayar where (a.keluarrs IS NULL OR a.keluarrs="NULL") AND  a.noruang = 14 '.$search.' order by a.masukrs asc';
                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_reg=".$tgl_reg."&tgl_reg2=".$tgl_reg2."&nama=".$nama."&norm=".$norm,"index.php?link=5ranap&");

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
                        <td><? echo $data['nomr'];?></td>
                        <td><? echo $data['NAMA']; ?></td>
                        <td><? echo $data['ALAMAT']; ?></td>
                        <td><?php echo $data['CARABAYAR'];?></td>
                        <td><? echo $data['masukrs']; ?></td>
                        <td><? echo $data['nott']; ?></td>
                        <td><? echo $data['NIP']; ?></td>
                        <td><a href="index.php?link=5vkranap&nomr=<?=$data['nomr'];?>&idx=<? echo $data['id_admission']; ?>"><input type="button" value="PROSES" class="text"/></a>
    					
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
            <input type="hidden" name="header" value="DATA KUNJUNGAN PASIEN VK" />
            <input type="hidden" name="filename" value="data_kunjungan_pasien_vk" />
            <input type="submit" value="Export To Ms Excel Document" class="text" />
        </form>
    </div>
</div>
<p></p>
