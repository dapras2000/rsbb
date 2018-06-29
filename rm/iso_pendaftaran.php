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
    $nomr = ' AND a.nomr = "'.$_GET['nomr'].'"';
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
                        <td width="52"><input type="hidden" name="link" value="iso2" /></td>
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
                        <th>Jam Bayar</th>
                        <th>Jam Kirim Status</th>
                        <th>lama tunggu</th>
                        <th>Pengirim</th>
                        <th>Cara Bayar</th>
                        <th>Pasien Baru/Lama</th>
                        <th>NIP</th>
                     </tr>
                    <?
/*                    $sql = "select a.nomr,b.nama,DATE_FORMAT(tglreg,'%d/%m/%Y') as tglreg, c.start_daftar,c.stop_daftar,d.nama as carabayar,
case a.pasienbaru when 1 then 'Lama' else 'Baru' end as pasienbl, a.nip 
from t_pendaftaran a 
inner join m_pasien b on a.nomr=b.nomr
inner join t_pendaftaran_iso c on a.idxdaftar=c.idxdaftar
inner join m_carabayar d on d.kode=a.kdcarabayar
where tglreg BETWEEN ".$search." ORDER BY a.idxdaftar";

$sqlcounter = "select count(a.nomr)
from t_pendaftaran a
inner join m_pasien b on a.nomr=b.nomr
inner join t_pendaftaran_iso c on a.idxdaftar=c.idxdaftar
inner join m_carabayar d on d.kode=a.kdcarabayar
where tglreg BETWEEN ".$search." ORDER BY a.idxdaftar";
*/
 $sql = "select a.nomr,b.nama,DATE_FORMAT(tglreg,'%d/%m/%Y') as tglreg, c.jambayar as start_daftar,jam_kirim_rm as stop_daftar,timediff(jam_kirim_rm,c.jambayar) as tunggu, d.nama as carabayar,
case a.pasienbaru when 1 then 'Lama' else 'Baru' end as pasienbl, a.nip, r.pengirim
from t_pendaftaran a 
INNER JOIN t_billrajal e ON a.idxdaftar=e.idxdaftar AND (e.kodetarif LIKE '01.01%' OR e.kodetarif LIKE '02.01%' OR e.kodetarif LIKE '05.01%')
INNER JOIN t_bayarrajal c ON e.idxdaftar=c.idxdaftar AND c.nobill=e.nobill AND c.status='LUNAS'
INNER JOIN m_pasien b ON a.nomr=b.nomr
INNER JOIN m_carabayar d ON d.kode=a.kdcarabayar
LEFT JOIN t_rekammedik r ON   a.IDXDAFTAR=r.idxdaftar
where tglreg BETWEEN ".$search.$nomr."group BY a.nomr";

$sqlcounter = "select count(a.nomr)
from t_pendaftaran a
INNER JOIN t_billrajal e ON a.idxdaftar=e.idxdaftar AND (e.kodetarif LIKE '01.01%' OR e.kodetarif LIKE '02.01%' OR e.kodetarif LIKE '05.01%')
INNER JOIN t_bayarrajal c ON e.idxdaftar=c.idxdaftar AND c.nobill=e.nobill AND c.status='LUNAS'
INNER JOIN m_pasien b ON a.nomr=b.nomr
INNER JOIN m_carabayar d ON d.kode=a.kdcarabayar
LEFT JOIN t_rekammedik r ON   a.IDXDAFTAR=r.idxdaftar
where tglreg BETWEEN ".$search." group BY a.nomr";

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
                        <td><? echo $data['start_daftar']; ?></td>
                        <td><? echo $data['stop_daftar']; ?></td>
                        
                         <td><? echo $data['tunggu']; ?></td>
						 <td><? echo $data['pengirim']; ?></td>
                        <td><? echo $data['carabayar']; ?></td>
                        <td><? echo $data['pasienbl']; ?></td>
                        <td><? echo $data['nip'];?></td>
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