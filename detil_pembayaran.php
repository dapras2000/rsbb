<?php 
include("include/connect.php");
require_once('ps_pagination.php');

?>

<div align="center">
    <div id="frame" style="width:80%;">
    <div id="frame_title">
      <h3>DETIL PENDAPATAN</h3></div>
    <div align="right" style="margin:5px;"> 
     
        <div id="table_search">
        <table width="95%" border="0" class="tb" cellspacing="0" cellspading="0">
          <tr align="center">
            <th width="8%">NOMR</th>
            <th width="23%">NAMA</th>
            <th width="15%">BESAR UANG</th>
            <!--<th width="10%">TBP</th>-->
            <th width="14%">POLY</th>
            <th width="30%">KET</th>
          </tr>
          <?
	$sql = "SELECT d.NOMR, c.NAMA, a.kodetarif,b.NAMA_JASA, d.TBP, a.TARIFRS * a.QTY AS TARIFRS, e.nama AS POLY
FROM t_billrajal a
inner join t_bayarrajal d on d.idxdaftar=a.idxdaftar  and a.nobill=d.nobill and d.tglbayar='$tglbayar' and d.shift='$shift'
inner join m_tarif b on a.kodetarif=b.kode 
inner join m_pasien c on a.nomr=c.nomr
inner join t_pendaftaran f on a.idxdaftar=f.idxdaftar   
inner join m_poly e on e.kode=f.kdpoly ";
	
	$pager = new PS_Pagination($connect, $sql, 15, 5, "param1=valu1&param2=value2");
	
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	while($data = mysql_fetch_array($rs)) {?>
          <tr align="center" <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
            <td><strong><? echo $data['NOMR'];?></strong></td>
            <td><? echo $data['NAMA'];?> </td>
            <td align="right"><? echo number_format($data['TARIFRS'], 0);?> </td>
            <!--<td><? echo $data['TBP']; ?></td>-->
            <td><? echo $data['POLY']; ?></td>
            <td><? echo $data['NAMA_JASA'];?> </td>
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
	
	$sql_export = "SELECT d.NOMR, c.NAMA, a.kodetarif,b.NAMA_JASA, d.TBP, a.TARIFRS * a.QTY AS TARIFRS, e.nama AS POLY
FROM t_billrajal a
inner join t_bayarrajal d on d.idxdaftar=a.idxdaftar  and a.nobill=d.nobill and d.tglbayar='$tglbayar' and d.shift='$shift'
inner join m_tarif b on a.kodetarif=b.kode 
inner join m_pasien c on a.nomr=c.nomr
inner join t_pendaftaran f on a.idxdaftar=f.idxdaftar   
inner join m_poly e on e.kode=f.kdpoly ";
		
	
			?>
    <form action="gudang/excelexport.php" enctype="multipart/form-data" method="post">
    <input type="hidden" value="<? echo $sql_export; ?>" name="query" />
    <input type="hidden" value="<? echo "DetilPendapatan"; ?>" name="header" />
    <input type="hidden" value="<? echo "DetilPendapatan"; ?>" name="filename" />
    <input type="submit" value="Export To Excel" class="text"/>
    </form>        
        </div>
    </div>
</div>
</div>
