<?php 
session_start();
include("include/connect.php");
require_once('ps_pagination_x.php');
$search 	= " AND E.TGLREG = curdate()";
$tgl_reg 	= "";
if(!empty($_GET['tgl_reg'])) {
    $tgl_reg =$_GET['tgl_reg'];
}
if($tgl_reg !="") {
    $search = " AND E.TGLREG BETWEEN  '".$tgl_reg."' ";
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
    $search = $search." AND A.NOMR = '".$norm."' ";
}

$nama = "";
if(!empty($_GET['nama'])) {
    $nama =$_GET['nama'];
} 

if($nama !="") {
    $search = $search." AND A.NAMA LIKE '%".$nama."%' ";
}

$poly = "";
if(!empty($_GET['poly'])) {
    $poly =$_GET['poly'];
}

if($poly !="") {
    $search = $search." AND E.KDPOLY = '".$poly."' ";
}

$kunjungan = "";
if(!empty($_GET['kunjungan'])) {
    $kunjungan =$_GET['kunjungan'];
}

if($kunjungan !="") {
	if ($kunjungan==2) $kunjungan=0;
    $search = $search." AND E.PASIENBARU = '".$kunjungan."' ";
	if ($kunjungan==0) $kunjungan=2;
}

$shift = "";
if(!empty($_GET['shift'])) {
    $shift =$_GET['shift'];
}

if($shift !="") {
    $search = $search." AND E.SHIFT = '".$shift."' ";
}
$carabayar	= '';
if(!empty($_REQUEST['carabayar'])){
	$carabayar = $_REQUEST['carabayar'];
	$search = $search." AND c.KODE = '".$carabayar."' ";
}
?>

<div align="center">
    <div id="frame">
        <div id="frame_title"><h3>LIST KUNJUNGAN PASIEN</h3></div>
        <div align="right" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table width="450" border="0" cellspacing="0" class="tb">
                	<tr>
                        <td width="52">&nbsp;</td>
                        <td width="200">&nbsp;</td>
                        <td width="52">Carabayar</td><td>
                        	<select name="carabayar" id="carabayar" class="text" >
                            	<option value=""> -- </option>
                                <?
                                $qrypoly = mysql_query("SELECT * FROM m_carabayar ORDER BY orders ASC")or die (mysql_error());
                                while ($listpoly = mysql_fetch_array($qrypoly)) {
                                    ?>
                                <option value="<? echo $listpoly['KODE'];?>" <? if($listpoly['KODE']==$poly) echo "selected=selected"; ?>><? echo $listpoly['NAMA'];?></option>
                                    <? } ?>
                            </select></td>
					</tr>
                    <tr>
                        <td width="52">No RM</td>
                        <td width="200"><input type="text" name="norm" id="norm" value="<? if($norm!="") { echo $norm; }?>" class="text" style="width:80px;"></td>
                        <td width="52">Poly</td><td>
                        	<select name="poly" id="poly" class="text" >
                            	<option value=""> -- </option>
                                <?
                                $qrypoly = mysql_query("SELECT * FROM m_poly ORDER BY kode ASC")or die (mysql_error());
                                while ($listpoly = mysql_fetch_array($qrypoly)) {
                                    ?>
                                <option value="<? echo $listpoly['kode'];?>" <? if($listpoly['kode']==$poly) echo "selected=selected"; ?>><? echo $listpoly['nama'];?></option>
                                    <? } ?>
                            </select></td>
					</tr>
                    <tr>

                        <td>Nama</td>
                        <td><input type="text" name="nama" id="nama" value="<? if($nama!="") {
                                echo $nama;
                                   }?>" class="text"></td>
                        <td width="52">Kunjungan</td>
                        <td><select name="kunjungan" id="kunj" class="text" >
                                <option value=""> -- </option>
                                <option value="1" <? if($kunjungan=="1") echo "selected=selected"; ?>>BARU</option>
                                <option value="2" <? if($kunjungan=="2") echo "selected=selected"; ?>>LAMA</option>
                            </select></td>
                    </tr>
                    <tr>

                        <td>Tanggal</td>
                        <td><input type="text" name="tgl_reg" id="tgl_pesan" readonly="readonly" class="text"
                                   value="<? if($_REQUEST['tgl_reg'] !=""): echo $_REQUEST['tgl_reg']; else: echo date('Y/m/d'); endif;?>" 
								   style="width:100px;"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                        <td width="52">Shift</td>
                        <td><select name="shift" id="shift" class="text" >
                                <option value=""> -- </option>
                                <option value="1" <? if($shift=="1") echo "selected=selected"; ?>>I</option>
                                <option value="2" <? if($shift=="2") echo "selected=selected"; ?>>II</option>
                                <option value="3" <? if($shift=="3") echo "selected=selected"; ?>>III</option>
                            </select></td>
                    </tr>
                    <tr>

                        <td>Sd</td>
                        <td><input type="text" name="tgl_reg2" id="tgl_pesan2" readonly="readonly" class="text"
                                   value="<? if($_REQUEST['tgl_reg2'] !=""): echo $_REQUEST['tgl_reg2']; else: echo date('Y/m/d'); endif;
?>" style="width:100px;" /><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
                        <td width="52"><input type="hidden" name="link" value="22" /></td>
                        <td><input type="submit" value=" C a r i " class="text"/></td>
                    </tr>
					
                </table>

            </form>
            <div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellpadding="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr align="center">
                        <th>NO </th>
                        <th>Tanggal</th>
                        <th>NO RM</th>
                        <th>Nama Pasien</th>
                        <th>L/P</th>
                        <th>Alamat</th>
                        <th>Poly</th>
                        <th>Nama Dokter</th>
                        <th>Cara Bayar</th>
                        <th>Rujukan</th>
                        <th>Ket.Rujukan</th>
                        <th>B/L</th>
                        <th>Shift</th>
                        <th>Update</th>
                    </tr>
                    <?
                     $sql = "SELECT E.IDXDAFTAR,A.NOMR,A.NAMA,A.JENISKELAMIN,A.ALAMAT,B.NAMA AS POLY1,C.NAMA AS CARABAYAR1,D.NAMA AS RUJUKAN1, E.TGLREG,SHIFT,DR.NAMADOKTER, E.KETRUJUK, DATE_FORMAT(TGLREG,'%d/%m/%Y') TGLREG,
  	            case PASIENBARU when 1 then 'B' else 'L' end as B_L,E.IDXDAFTAR ,E.KDPOLY
	      FROM m_pasien A, m_poly B, m_carabayar C, m_rujukan D, t_pendaftaran E
  		  LEFT JOIN m_dokter DR on DR.KDDOKTER=E.KDDOKTER
          WHERE A.NOMR=E.NOMR AND E.KDPOLY=B.KODE AND E.KDRUJUK=D.KODE AND E.KDCARABAYAR=C.KODE ".$search." ORDER BY E.IDXDAFTAR DESC";

                 $sqlcounter = "SELECT COUNT(A.NOMR),E.IDXDAFTAR FROM m_pasien A, m_poly B, m_carabayar C, m_rujukan D, t_pendaftaran E
  		  LEFT JOIN m_dokter DR on DR.KDDOKTER=E.KDDOKTER
          WHERE A.NOMR=E.NOMR AND E.KDPOLY=B.KODE AND E.KDRUJUK=D.KODE AND E.KDCARABAYAR=C.KODE ".$search." ORDER BY E.IDXDAFTAR DESC";
                    $NO=0;
                    $pager = new PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "tgl_reg=".$tgl_reg."&tgl_reg2=".$tgl_reg2."&nama=".$nama."&norm=".$norm."&poly=".$poly."&kunjungan=".$kunjungan."&shift=".$shift,"index.php?link=22&");
//The paginate() function returns a mysql result set 
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
                    while($data = mysql_fetch_array($rs)) {?>
                    <? 
                        $count++;
                        if ($count % 2) {
                            echo '<tr class="tr1">';
                        }
                        else {
                            echo '<tr class="tr1">';
                        }
                            ?>
                        <td height="26"><? $NO=($NO+1);
                                if ($_GET['page']==0) {
                                    $hal=0;
                                }else {
                                    $hal=$_GET['page']-1;
                                } echo





    ($hal*15)+$NO;?></td>
                        <td align="center"><? echo $data['TGLREG']; ?></td>
                        <td><? echo $data['NOMR'];?></td>
                        <td><? echo $data['NAMA']; ?></td>
                        <td><? echo $data['JENISKELAMIN']; ?></td>
                        <td><? echo $data['ALAMAT']; ?></td>
                        <td><? echo $data['POLY1']; ?></td>
                        <td><? echo $data['NAMADOKTER']; ?></td>
                        <td><? echo $data['CARABAYAR1'];?></td>
                        <td align="center"><? echo $data['RUJUKAN1'];?></td>
                        <td><? echo $data['KETRUJUK'];?></td>
                        <td><? echo $data['B_L'];?></td>
                        <td><? echo $data['SHIFT'];?></td>
                        <td align="center"><a href="?link=28&idx=<?=$data['IDXDAFTAR'];?>"><input type="button" value="Edit" class="text"/></a>
                        <a href="cetak_kartupasien_poly.php?NOMR=<?=$data['NOMR'];?>&info=<?=$data['POLY1'];?>" target="_blank"><input type="button" value="Cetak Label Pasien" class="text" /></a>
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
    $qry_excel = "SELECT E.IDXDAFTAR AS IDX_DAFTAR,
        DATE_FORMAT(TGLREG,'%d/%m/%Y') AS TGL_DAFTAR,
        A.NOMR AS NO_RM,
        A.NAMA AS NAMA_PASIEN,
        A.JENISKELAMIN AS JNS_KELAMIN,
        A.ALAMAT AS ALAMAT,
        B.NAMA AS POLY_TUJUAN,
        DR.NAMADOKTER AS DOKTER,
        C.NAMA AS CARA_BAYAR,
        D.NAMA AS RUJUKAN,
        E.KETRUJUK AS KET_RUJUKAN,
#16-12-2010
	 A. TGLLAHIR AS TANGGAL_LAHIR,
	 A. KDKECAMATAN AS KECAMATAN,
	 (select namakecamatan from m_kecamatan where A.kdkecamatan = idkecamatan) AS KECAMATAN,

       case PASIENBARU when 1 then 'B' else 'L' end AS BARU_LAMA,
       SHIFT AS SHIFT
	FROM m_pasien A, m_poly B, m_carabayar C, m_rujukan D, t_pendaftaran E
  	LEFT JOIN m_dokter DR on DR.KDDOKTER=E.KDDOKTER
        WHERE A.NOMR=E.NOMR AND E.KDPOLY=B.KODE AND E.KDRUJUK=D.KODE AND E.KDCARABAYAR=C.KODE ".$search."ORDER BY E.IDXDAFTAR";
?>
    <div align="left">
        <form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
            <input type="hidden" name="query" value="<?=$qry_excel?>" />
            <input type="hidden" name="header" value="LIST KUNJUNGAN PASIEN" />
            <input type="hidden" name="filename" value="list_kunjungan_pasien" />
            <input type="submit" value="Export To Ms Excel Document" class="text" />
        </form>
    </div>
</div>