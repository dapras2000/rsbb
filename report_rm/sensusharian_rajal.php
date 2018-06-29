<?php 
session_start();
include("include/connect.php");
include("report_rm/ps_pagination.php");

$tgl = "";
if(!empty($_GET['tgl'])){
	$tgl =$_GET['tgl']; 
} 

$search = "";
if($tgl !=""){
	$search = "";
}

$sql = "";
?>
<div align="center">
    <div id="frame" style="width:95%">
    <div id="frame_title">
      <h3>SENSUS HARIAN PASIEN RAWAT INAP</h3></div>
    <div align="right" style="margin:5px;">
    <form name="formsearch" method="get" >
     <table class="tb">
       <tr>
          <td align="right">Tanggal 
            <input type="text" name="tgl" id="tgl" readonly="readonly" class="text" 
              value="<? if($tgl!=""){
			  echo $tgl;}?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a>
              <input type="hidden" name="link" value="f02" />
            <input type="submit" value="O p e n" class="text"/></td>
          </tr>
     </table>
    </form> 
        <div id="table_search">
           <div style="overflow:scroll;width:98%;height:auto;" >    
          <table width="95%" style="margin:10px;" border="1" cellspacing="0" cellspading="0" class="tb">
            <tr align="center">
              <th width="2%" rowspan="4">NO </th>
              <th width="6%" rowspan="4">NOMOR RM</th>
              <th width="4%" rowspan="4">NAMA</th>
              <th height="45" colspan="2">UMUR</th>
              <th width="8%" rowspan="4">ASAL KECAMATAN</th>
              <th width="7%" rowspan="4">DIAGNOSA</th>
              <th width="7%" rowspan="4">TINDAKAN</th>
              <th width="5%" rowspan="4">CARA BAYAR</th>
              <th colspan="5">KEADAAN KELUAR</th>
              <th colspan="2" rowspan="3">PENGUNJUNG</th>
              <th colspan="2" rowspan="3">KUNJUNGAN</th>
              <th colspan="2" rowspan="3">KASUS PENYAKIT</th>
              <th colspan="2">DIISI OLEH PETUGAS RM</th>
            </tr>
            <tr align="center">
              <th width="1%" rowspan="3">L</th>
              <th width="4%" rowspan="3">P</th>
              <th width="5%" rowspan="3">PULANG</th>
              <th width="5%" rowspan="3">RAWAT</th>
              <th width="5%" rowspan="3">ODC/VK</th>
              <th colspan="2" rowspan="2">RUJUK KE</th>
              <th colspan="2">KODE</th>
            </tr>
            <tr align="center">
              <th rowspan="2">ICD-XL</th>
              <th rowspan="2">ICD IX CM</th>
            </tr>
            <tr align="center">
              <th width="3%">POLI LAIN</th>
              <th width="6%">LUAR RSUD</th>
              <th width="1%">B</th>
              <th width="6%">L</th>
              <th>B</th>
              <th>L</th>
              <th>B</th>
              <th>L</th>
            </tr>
            <?

    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl=".$tgl,"index.php?link=f02&");
	
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
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <?	} 
	
	
?>
          </table>
          </div>
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
