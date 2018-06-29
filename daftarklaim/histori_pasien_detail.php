<?php 
session_start();
include("include/connect.php");
require_once('ps_pagination.php');
?>

<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>RINGKASAN RIWAYAT RAWAT JALAN</h3></div>
    <div align="left" style="margin:5px;"> 
	<table width="317" border="0" cellspacing="0" class="tb">
  <tr>
    <td width="80">No RM :</td>
    <td width="233"><?=$_GET['nomr']?></td>
  </tr>
  <tr>
    <td>Nama :</td>
    <td><?=$_GET['nama']?></td>
  </tr>
</table>


      <div id="table_search">
        <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
          <tr align="center">
            <th width="9%">NO</th>
            <th width="15%">Tanggal</th>
            <th width="20%">Poli / UGD</th>
            <th width="22%">Diagnosa</th>
            <th width="21%">Tindakan</th>
            
            <th width="13%">Dokter</th>
          </tr>
          <?
	$sql = "SELECT 
			  t_diagnosadanterapi.IDXTERAPI,
			  t_diagnosadanterapi.IDXDAFTAR,
			  t_diagnosadanterapi.NOMR,
			  t_diagnosadanterapi.TANGGAL,
			  t_diagnosadanterapi.DIAGNOSA,
			  t_diagnosadanterapi.TERAPI,
			  t_diagnosadanterapi.KDPOLY,
			  t_diagnosadanterapi.KDDOKTER,
			  m_poly.nama AS NAMAPOLY,
			  m_dokter.NAMADOKTER
			FROM
			  t_diagnosadanterapi
			  INNER JOIN m_poly ON (t_diagnosadanterapi.KDPOLY = m_poly.kode)
			  INNER JOIN m_dokter ON (t_diagnosadanterapi.KDDOKTER = m_dokter.KDDOKTER)
			WHERE t_diagnosadanterapi.NOMR ='".$_GET['nomr']."'";
	
	$pager = new PS_Pagination($connect, $sql, 15, 5, "","index.php?link=rm6&");
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
            <td>&nbsp;</td>
            <td><? echo $data['TANGGAL']; ?></td>
            <td><? echo $data['NAMAPOLY']; ?></td>
            <td><? echo $data['DIAGNOSA']; ?></td>
            <td><? echo $data['TERAPI']; ?></td>
            
            <td><? echo $data['NAMADOKTER']; ?></td>
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