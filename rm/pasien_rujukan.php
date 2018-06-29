<?php 
session_start();
include("include/connect.php");
require_once('ps_pagination.php');

//$search = " AND a.TGLREG = curdate() ";
$search = " curdate() and curdate() ";

$tgl_reg = "";
if(!empty($_GET['tgl_reg'])) {
    $tgl_reg =$_GET['tgl_reg'];
} 

/*if($tgl_reg !="") {
    $search = " AND E.TGLREG BETWEEN  '".$tgl_reg."' ";
}*/

$tgl_reg2 = "";
if(!empty($_GET['tgl_reg2'])) {
    $tgl_reg2 =$_GET['tgl_reg2'];
}
$nomr	= '';
if(!empty($_GET['nomr'])) {
    $nomr = ' AND t_pendaftaran.nomr = "'.$_GET['nomr'].'"';
}


if($tgl_reg !="") {
    if($tgl_reg2 !="") {
        //$search = $search." AND '".$tgl_reg2."' ";
		$search = "'".$tgl_reg."' AND '".$tgl_reg2."' ";
    }/*else {
        $search = $search." AND '".$tgl_reg."' ";
		$search = " AND '".$tgl_reg2."' ";
    }*/
}

?>

<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>ISO PENDAFTARAN</h3></div>
        <div align="right" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table width="358" border="0" cellspacing="0" class="tb">
                    <tr>
                        <td>Tanggal</td>
                        <td><input type="text" name="tgl_reg" id="tgl_pesan" readonly="readonly" class="text"
                                   value="<? if($_REQUEST['tgl_reg'] !=""): echo $_REQUEST['tgl_reg']; else: echo date('Y/m/d'); endif;?>" style="width:100px;"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>

                        <td>Sd</td>
                        <td><input type="text" name="tgl_reg2" id="tgl_pesan2" readonly="readonly" class="text"
                                   value="<? if($_REQUEST['tgl_reg2'] !=""): echo $_REQUEST['tgl_reg2']; else: echo date('Y/m/d'); endif;?>" style="width:100px;" /><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
                        <td width="52"><input type="hidden" name="link" value="pasienrujukan" /></td>
                        <td><input type="submit" value=" C a r i " class="text"/></td>
                    </tr>
                    <tr>
                    	<td>Nomr</td><td><input type="text" class="text" name="nomr" value="<?php echo $_REQUEST['nomr'];?>" /></td></tr>
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
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Cara Bayar</th>
                        <th>Poli</th>
                     </tr>
                    <?
$sql = "SELECT t_pendaftaran.TGLREG as tglreg, m_pasien.NOMR as nomr, m_pasien.JENISKELAMIN as jk,
m_pasien.NAMA as nama,m_pasien.ALAMAT as alamat , m_carabayar.NAMA as carabayar, m_poly.nama as poly
FROM t_pendaftaran
JOIN m_carabayar ON m_carabayar.KODE = t_pendaftaran.KDCARABAYAR
JOIN m_pasien ON m_pasien.NOMR = t_pendaftaran.NOMR
JOIN m_poly ON m_poly.kode = t_pendaftaran.KDPOLY
AND t_pendaftaran.MINTA_RUJUKAN=1  and tglreg BETWEEN ".$search.$nomr;


$sqlcounter = "SELECT count(m_pasien.NOMR)
FROM t_pendaftaran
JOIN m_carabayar ON m_carabayar.KODE = t_pendaftaran.KDCARABAYAR
JOIN m_pasien ON m_pasien.NOMR = t_pendaftaran.NOMR
JOIN m_poly ON m_poly.kode = t_pendaftaran.KDPOLY
AND t_pendaftaran.MINTA_RUJUKAN=1  and tglreg BETWEEN ".$search.$nomr;

                    $NO=0;
                    $pager = new PS_Pagination($connect, $sql,15, 5, "tgl_reg=".$tgl_reg."&tgl_reg2=".$tgl_reg2,"index.php?link=iso2&");
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
                        <td height="26"><? $NO=($NO+1);
                                if ($_GET['page']==0) {
                                    $hal=0;
                                }else {
                                    $hal=$_GET['page']-1;
                                } echo






    ($hal*15)+$NO;?></td>
                        <td align="center"><? echo $data['tglreg'];?></td>
                        <td><? echo $data['nomr'];?></td>
                        <td><? echo $data['nama']; ?></td>
                        <td><? echo $data['jk']; ?></td>
                        <td><? echo $data['alamat']; ?></td>                        
                         <td><? echo $data['carabayar']; ?></td>
						 <td><? echo $data['poly']; ?></td>
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
                    <form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
<input type="hidden" name="query" value="<?=$sql?>" />
<input type="hidden" name="header" value="ISO PENDAFTARAN" />
<input type="hidden" name="filename" value="iso_pendaftaran" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>