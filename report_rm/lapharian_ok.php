<?php 
session_start();
include("include/connect.php");
include("ps_pagination_x.php");

$search = "";
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
} 

if($tgl_kunjungan !=""){
	$search = " where a.tanggal = '".$tgl_kunjungan."' ";
}else{
	$search = " where a.tanggal = curdate()";
}

$sql = "select a.tanggal,b.nama,b.jeniskelamin,b.alamat,a.dokteroperator,a.dokteranastesi,a.dokteranak,a.diagnosa,jenisanastesi,a.tindakan, a.nomr
from t_operasi a
inner join m_pasien b on a.nomr=b.nomr ".$search;


$sqlcounter = "select count(a.tanggal) from t_operasi a
inner join m_pasien b on a.nomr=b.nomr ".$search;
?>
<div align="center">
    <div id="frame" style="width:95%">
    <div id="frame_title"><h3>LAPORAN HARIAN KEGIATAN OPERASI</h3></div>
    <div align="right" style="margin:5px;">
   <form name="formsearch" method="get" >
     <table width="248" border="0" cellspacing="0" class="tb">
  <tr>
    <td>Tanggal</td>
    <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan!=""){
			  echo $tgl_kunjungan;}?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cari" class="text"/>
    <input type="hidden" name="link" value="136" /></td>
  </tr>
</table>

    </form>     
    

        <div id="table_search">
         <!-- <div style="overflow:scroll;width:98%;height:auto;" > -->    
        <table width="95%" style="margin:10px;" border="1" cellspacing="0" cellspading="0" class="tb">
          <tr align="center">
            <th width="2%" rowspan="2">NO</th>
            <th width="7%" rowspan="2">TANGGAL</th>
            <th width="5%" rowspan="2">NAMA PASIEN</th>
            <th rowspan="2">LP</th>
            <th width="6%" rowspan="2">NOMOR RM</th>
            <th width="6%" rowspan="2">ALAMAT</th>
            <th colspan="4">NAMA DOKTER</th>
            <th width="8%" rowspan="2">DIAGNOSA</th>
            <th width="3%" rowspan="2">ICD-X</th>
            <th width="3%" rowspan="2">JENIS</th>
            <th width="4%" rowspan="2">TINDAKAN</th>
            <th width="3%" rowspan="2">ICD-9 CM</th>
          </tr>
          <tr align="center">
            <th colspan="2">OPERATOR</th>
            <th width="2%">ANESTESI</th>
            <th width="2%">ANAK</th>
          </tr>
          <?

   $pager = new PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "tgl_kunjungan=".$tgl_kunjungan,"index.php?link=136&");
	
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
            <td><?=$data['tanggal']?></td>
            <td><?=$data['nama']?></td>
            <td><?=$data['jeniskelamin']?></td>
            <td><?=$data['nomr']?></td>
            <td><?=$data['alamat']?></td>
            <td colspan="2"><?=$data['dokteroperator']?></td>
            <td><?=$data['dokteranastesi']?></td>
            <td><?=$data['dokteranak']?></td>
            <td><?=$data['diagnosa']?></td>
            <td><?=$data['']?></td>
            <td><?=$data['jenisanastesi']?></td>
            <td><?=$data['tindakan']?></td>
            <td><?=$data['']?></td>
          </tr>
       <? } ?>   
          </table>
<!-- </div>	--><?php
	
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
