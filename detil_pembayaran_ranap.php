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
              <th width="11%">NOMR</th>
              <th width="26%">NAMA</th>
              <th width="18%">BESAR UANG</th>
              <!--<th width="17%">TBP</th>-->
              <th width="28%">RETRIBUSI</th>
            </tr>
            <?
				 
	$sql = "SELECT a.NOMR, c.NAMA, a.kodetarif,b.NAMA_JASA, a.IDXDAFTAR, d.TBP, a.TARIFRS * a.QTY AS TARIFRS, e.nama AS ruang
				 FROM t_billranap a, m_tarif b, m_pasien c, t_bayarranap d, m_ruang e, t_admission f
				 WHERE a.shift='$shift' AND d.TGLBAYAR='$tglbayar' and a.kodetarif=b.kode AND a.nomr=c.nomr and a.idxdaftar=d.idxdaftar AND d.nobill=a.nobill AND e.no=f.noruang AND d.idxdaftar=f.id_admission ";
	
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
              <td><a href="index.php?link=32rd&idxb=<?=$data['IDXDAFTAR']?>"><? echo $data['NAMA'];?></a></td>
              <td align="right"><? echo "Rp. ".number_format($data['TARIFRS'], 0).",00";?></td>
              <!--<td><? echo $data['TBP']; ?></td>-->
              <td align="left"><? echo $data['NAMA_JASA'];?></td>
            </tr>
            <?	} ?>
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
	<form action="gudang/excelexport.php" enctype="multipart/form-data" method="post">
    <input type="hidden" value="<? echo $sql; ?>" name="query" />
    <input type="hidden" value="<? echo "DetilPendapatanRanap"; ?>" name="header" />
    <input type="hidden" value="<? echo "DetilPendapatanRanap"; ?>" name="filename" />
    <input type="submit" value="Export To Excel" class="text"/>
    </form>        
    </div>
    </div>
</div>
</div>