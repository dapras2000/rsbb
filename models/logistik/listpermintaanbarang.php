<?php 
session_start();
include("include/connect.php");
require_once('logistik/ps_pagination.php');

			$sql = "SELECT DISTINCT
					  t_permintaan_barang.`NO`,
					  t_permintaan_barang.NIP,
					  m_login.DEPARTEMEN,
					  t_permintaan_barang.tglpesan
					FROM
					  t_permintaan_barang
					  INNER JOIN m_login ON (t_permintaan_barang.NIP = m_login.NIP)
   				    WHERE t_permintaan_barang.KATEGORY = 'L' AND statusacc = '0'";

$qry_order = mysql_query($sql);
$order = mysql_fetch_assoc($qry_order);
?>
<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>LIST DATA PERMINTAAN BARANG</h3></div>
    <div align="right" style="margin:5px;"> 
        <div id="table_search">
        <table width="95%" style="margin:10px;" border="0" cellspacing="0" cellspading="0" class="tb">
          <tr align="center">
            <th width="15%">NO</th>
            <th>NIP</th>
            <th>NAMA</th>
            <th>POLY</th>
            <th>TGL PESAN</th>
          </tr>
          <?
	$pager = new PS_Pagination($connect, $sql, 15, 5, "param1=valu1&param2=value2");
	
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
            <td><a href="index.php?link=91&nobatch=<? echo $data['NO']; ?>"><? echo $data['NO'];?></a></td>
            <td><? echo $data['NIP']; ?></td>
            <td><? echo $data['NIP']; ?></td>
            <td><? echo $data['DEPARTEMEN']; ?></td>
            <td><? echo $data['tglpesan']; ?></td>
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
