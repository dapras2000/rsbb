<?php 
session_start();

$tgl_pesan = "";
if(!empty($_GET['tgl_pesan'])) {
    $tgl_pesan =$_GET['tgl_pesan'];
} 
if(!empty($_POST['tgl_pesan'])) {
    $tgl_pesan =$_POST['tgl_pesan'];
}

if($tgl_pesan !="") {
    $search = " AND t_penerimaan_barang.tglterima = '".$tgl_pesan."' ";
}else {
    $search = " AND t_penerimaan_barang.tglterima = CURDATE() ";
}

$farmasi ="x";
if($_SESSION['KDUNIT']=="12") {
    $farmasi ="1";
}else if($_SESSION['KDUNIT']=="13") {
    $farmasi ="0";
}
include("include/connect.php");
require_once('gudang/ps_pagination.php');

$sql = "SELECT t_penerimaan_barang.IDXBARANG,
                t_penerimaan_barang.NIP,
                t_penerimaan_barang.KDUNIT,
                t_penerimaan_barang.kodebarang,
                t_penerimaan_barang.no_batch,
                t_penerimaan_barang.expire_date,
                t_penerimaan_barang.pengirim,
                t_penerimaan_barang.tglterima,
                t_penerimaan_barang.jmlterima,
                t_penerimaan_barang.jnsterima,
                t_penerimaan_barang.KET,
                m_barang.nama_barang,
                (SELECT nama_group FROM m_barang_group WHERE farmasi = '".$farmasi."' AND group_barang=m_barang.group_barang) AS GROUP_BARANG
        FROM t_penerimaan_barang
    INNER JOIN m_barang ON (t_penerimaan_barang.kodebarang=m_barang.kode_barang)
    WHERE t_penerimaan_barang.KDUNIT = ".$_SESSION['KDUNIT']." ".$search ;

$qry_order = mysql_query($sql);

?>
<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>LIST HISTORI DATA PENERIMAAN BARANG</h3></div>
        <div align="right" style="margin:5px;">
            <form name="formsearch" method="post" >
                <table class="tb">
                    <tr>
                        <td align="right">Tanggal &nbsp;<input type="text" name="tgl_pesan" id="tgl_pesan" readonly="readonly" class="text" style="width:100px;"
                                                               value="<? if($_REQUEST['tgl_pesan'] !=""): echo $_REQUEST['tgl_pesan']; else: echo date('Y/m/d'); endif;?>"/>
															   <a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a>
                            <input type="submit" value="Cari" class="text"/></td>
                    </tr>
                </table>
            </form>
            <div id="table_search">
                <table width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" class="tb">
                    <tr align="center">
                        <th>NO</th>
                        <th>TANGGAL</th>
                        <th>TERIMA DARI</th>
                        <th>JENIS</th>
                        <th>KODE</th>
                        <th>NAMA</th>
                        <th>GROUP</th>
                        <th>JUMLAH</th>
                        <?
                        $NO=0;
                        $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_pesan=".$tgl_pesan, "index.php?link=x83&");

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
                        <td><? echo $data['tglterima']; ?></td>
                        <td><? echo $data['pengirim']; ?></td>
                        <td><? switch($data['jnsterima']){
                            case '1' :
                                echo "APBN";
                            case '2' :
                                echo "APBD I";
                            case '3' :
                                echo "APBD II";
                            case '4' :
                                echo "Lain-lain";
                        }; ?></td>
                        <td><? echo $data['kodebarang']; ?></td>
                        <td><? echo $data['nama_barang']; ?></td>
                        <td><? echo $data['GROUP_BARANG']; ?></td>
                        <td align="right"><? echo $data['jmlterima']; ?></td>
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
</div>
<p></p>
