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
      <h3>LAPORAN HARIAN PASIEN KELUAR RUMAH SAKIT (HIDUP & MENINGGAL)</h3></div>
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
            <th width="3%" rowspan="2">NO</th>
            <th width="9%" rowspan="2">NOMOR RM</th>
            <th width="13%" rowspan="2">NAMA PASIEN</th>
            <th colspan="2">UMUR</th>
            <th width="3%" rowspan="2">TGL MASUK</th>
            <th width="4%" rowspan="2">TGL KELUAR</th>
            <th width="8%" rowspan="2">LAMA DIRAWAT</th>
            <th width="11%" colspan="4">ASAL PASIEN</th>
            <th width="12%" rowspan="2">RUANG</th>
            <th width="12%" rowspan="2">KELAS</th>
            <th width="12%" rowspan="2">CARA BAYAR</th>
            <th width="7%" rowspan="2">DIAGNOSA AKHIR</th>
            <th width="9%" rowspan="2">ICD-X</th>
            <th width="4%" rowspan="2">TINDAKAN</th>
            <th width="2%" rowspan="2">ICD-9 CM</th>
            <th width="0%" rowspan="2">DOKTER</th>
            <th width="0%" rowspan="2">ASAL WILAYAH</th>
            <th width="0%" rowspan="2">MASUK DARI</th>
            <th width="0%" colspan="4">KEADAAN KELUAR</th>
            <th width="1%" rowspan="2">KET</th>
          </tr>
          <tr align="center">
            <th width="6%">L</th>
            <th width="6%">P</th>
            <th width="11%">DS</th>
            <th width="6%">PKM</th>
            <th width="11%">RS LAIN</th>
            <th width="11%">INSTANSI LAIN</th>
            <th width="0%">H</th>
            <th width="0%">R</th>
            <th width="0%">K</th>
            <th width="0%">M</th>
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
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>
            <td>9</td>
            <td>10</td>
            <td>11</td>
            <td>12</td>
            <td>13</td>
            <td>14</td>
            <td>15</td>
            <td>16</td>
            <td>17</td>
            <td>18</td>
            <td>19</td>
            <td>20</td>
            <td>21</td>
            <td>22</td>
            <td>23</td>
            <td>24</td>
            <td>25</td>
            <td>26</td>
            <td>27</td>
          </tr>
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
            <td colspan="4">&nbsp;</td>
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
