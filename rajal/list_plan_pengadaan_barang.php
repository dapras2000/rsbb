<?php 
session_start();
include("include/connect.php");
require_once('apotek/ps_pagination.php');

$sql = "SELECT 
						  t_permintaan_barang.IDXBARANG AS IDX,
						  t_permintaan_barang.`NO` AS NOBATCH,
						  t_permintaan_barang.NIP AS NIP,
						  t_permintaan_barang.kodebarang AS KODEBARANG,
						  DATE_FORMAT(t_permintaan_barang.tglpesan, '%M %Y') AS TGLPESAN,
						  t_permintaan_barang.jumlahpesan AS JUMLAH,
						  t_permintaan_barang.statusacc AS STATUS,
						  DATE_FORMAT(t_permintaan_barang.tglkeluar, '%d -%m -%Y') AS TGLKELUAR,
						  t_permintaan_barang.jmlkeluar AS JMLKELUAR,
						  m_obat.nama_obat AS NAMABARANG,
						  m_obat.group_obat AS GROUPBARANG,
						  m_obat.satuan AS SATUAN
						FROM
						  t_permintaan_barang
						  INNER JOIN m_obat ON (t_permintaan_barang.kodebarang = m_obat.kode_obat)
						WHERE NIP = '".$_SESSION['NIP']."'
						UNION
						SELECT 
						  t_permintaan_barang.IDXBARANG AS IDX,
						  t_permintaan_barang.`NO` AS NOBATCH,
						  t_permintaan_barang.NIP AS NIP,
						  t_permintaan_barang.kodebarang AS KODEBARANG,
						  DATE_FORMAT(t_permintaan_barang.tglpesan, '%M %Y') AS TGLPESAN,
						  t_permintaan_barang.jumlahpesan AS JUMLAH,
						  t_permintaan_barang.statusacc AS STATUS,
						  DATE_FORMAT(t_permintaan_barang.tglkeluar, '%d -%m -%Y') AS TGLKELUAR,
						  t_permintaan_barang.jmlkeluar AS JMLKELUAR,
						  m_barang.nama_barang AS NAMABARANG,
						  m_barang.group_barang AS GROUPBARANG,
						  m_barang.satuan AS SATUAN
						FROM
						  t_permintaan_barang
						  INNER JOIN m_barang ON (t_permintaan_barang.kodebarang = m_barang.kode_barang)
						WHERE NIP = '".$_SESSION['NIP']."'";
$qry_order = mysql_query($sql);

$order = mysql_fetch_assoc($qry_order);
?>
<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>LIST DATA RENCANA PENGADAAN BARANG</h3></div>
    <div align="right" style="margin:5px;"> 
        <div id="table_search">
        <table width="95%" style="margin:10px;" border="0" cellspacing="0" cellspading="0" class="tb">
          <tr align="center">
            <th width="10%">KODE BARANG</th>
            <th>NAMA</th>
            <th>JML PERMINTAAN</th>
            <th>SATUAN</th>
            <th>PERIODE</th>
          </tr>
          <?

    $pager = new PS_Pagination($connect, $sql, 15, 5, "param1=valu1&param2=value2", "index.php?link=59&");
	
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
            <td width="5%"><? echo $data['KODEBARANG']; ?></td>
            <td><? echo $data['NAMABARANG']; ?></td>
            <td align="right" width="15%"><? echo $data['JUMLAH']; ?></td>
            <td width="15%"><? echo $data['SATUAN']; ?></td>
            <td width="15%"><? echo $data['TGLPESAN']; ?></td>
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
