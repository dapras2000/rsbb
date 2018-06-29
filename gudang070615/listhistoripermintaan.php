<?php 
session_start();

$tgl_pesan = "";
if(!empty($_GET['tgl_pesan'])){
	$tgl_pesan =$_GET['tgl_pesan']; 
} 
if(!empty($_POST['tgl_pesan'])){
	$tgl_pesan =$_POST['tgl_pesan']; 
}

if($tgl_pesan !=""){
	$search = " AND t_permintaan_barang.tglpesan = '".$tgl_pesan."' ";
}else{
	$search = " AND t_permintaan_barang.tglpesan = CURDATE() ";
}

$farmasi ="x";
if($_SESSION['KDUNIT']=="12"){
	 $farmasi ="1";
}else if($_SESSION['KDUNIT']=="13"){
	 $farmasi ="0";
}
include("include/connect.php");
require_once('gudang/ps_pagination.php');

			$sql = "SELECT DISTINCT
						  t_permintaan_barang.`NO`,
						  t_permintaan_barang.NIP,
						  t_permintaan_barang.KDUNIT,
						  DATE_FORMAT(t_permintaan_barang.tglpesan, '%d -%m -%Y') as tglpesan,
						  t_permintaan_barang.status_save,
						  m_login.DEPARTEMEN
						FROM
						  t_permintaan_barang
						  INNER JOIN m_login ON (t_permintaan_barang.NIP = m_login.NIP)
						  AND (t_permintaan_barang.KDUNIT = m_login.KDUNIT)
						  INNER JOIN m_barang ON (t_permintaan_barang.kodebarang = m_barang.kode_barang)
						  WHERE  m_barang.farmasi = '".$farmasi."' AND status_save = '1' ".$search ;

$qry_order = mysql_query($sql);

?>
<div align="center">
    <div id="frame" style="width: 100%;">
    <div id="frame_title"><h3>HISTORI PERMINTAAN BARANG</h3></div>
    <div align="right" style="margin:5px;">
    <form name="formsearch" method="post" >
     <table class="tb">
       <tr>
           <td align="right">Tanggal Pesan&nbsp;<input type="text" name="tgl_pesan" id="tgl_pesan" readonly="readonly" class="text" style="width:100px;"
              value="<? if($_REQUEST['tgl_pesan'] !=""): echo $_REQUEST['tgl_pesan']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a>
              <input type="submit" value="Cari" class="text"/></td>
          </tr>
     </table>
    </form> 
        <div id="table_search">
        <table width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" class="tb">
          <tr align="center">
            <th>NIP</th>
            <th width="30%">NAMA</th>
            <th>UNIT</th>
            <th width="15%">TGL PESAN</th>
            <th width="5%">&nbsp;</th>
            </tr>
          <?
	$pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_pesan=".$tgl_pesan, "index.php?link=85&");
	
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	while($data = mysql_fetch_array($rs)) {?>
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
            <td><? echo $data['NIP']; ?></td>
            <td><? echo $data['NIP']; ?></td>
            <td><? echo $data['DEPARTEMEN']; ?></td>
            <td><? echo $data['tglpesan']; ?></td>
            <td><a href="index.php?link=86&nobatch=<? echo $data['NO']; ?>"><input type="button" value="DETAIL" class="text" /></a></td>
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
