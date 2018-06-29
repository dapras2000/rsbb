
<?php 
session_start();
$farmasi ="x";
if($_SESSION['KDUNIT']=="12"){
	 $farmasi ="1";
}else if($_SESSION['KDUNIT']=="13"){
	 $farmasi ="0";
}
include("../include/connect.php");
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
						  INNER JOIN m_login ON (t_permintaan_barang.KDUNIT = m_login.KDUNIT)
						  INNER JOIN m_barang ON (t_permintaan_barang.kodebarang = m_barang.kode_barang)
						  WHERE  m_barang.farmasi = '".$farmasi."' AND status_save = '0'";
									
$qry_order = mysql_query($sql);
$order = mysql_fetch_assoc($qry_order);
?>
<div align="center">
    <div id="frame" style="width:100%;">
    <div id="frame_title"><h3>LIST PERMINTAAN BARANG</h3></div>
    <div align="right" style="margin:5px;"> 
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
	$pager = new PS_Pagination($connect, $sql, 15, 5, "param1=valu1&param2=value2", "index.php?link=8&");
	
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
            <td><a href="index.php?link=81&nobatch=<? echo $data['NO']; ?>"><input type="button" value="PROSES" class="text" /></a></td>
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
