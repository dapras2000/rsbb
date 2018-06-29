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
	$search = " AND a.tgl_keluar = '".$tgl_pesan."' ";
}else{
	$search = "";
}

include("./include/connect.php");
include('./apotek/ps_pagination.php');

 $sql = 'Select b.NAMADOKTER as namadokter, c.nama as namapoli, DATE_FORMAT(a.tgl_pesan, "%d -%m -%Y") as tgl_pesan, a.norm as NOMR, d.NAMA as NAMA, 
		d.ALAMAT as ALAMAT, e.NAMA as carabayar, a.idxdaftar, a.no, f.noresep
		from t_permintaan_apotek_rajal a
		JOIN m_dokter b ON a.kddokter=b.KDDOKTER
		JOIN m_poly c ON a.kdpoli=c.kode
		JOIN m_pasien d ON a.norm=d.NOMR
		JOIN m_carabayar e ON a.kdcarabayar=e.KODE
		LEFT JOIN t_billobat_rajal f ON a.idxdaftar-f.idxdaftar
		WHERE a.status_save="1" '.$search.' group by a.tgl_pesan, a.no, a.idxdaftar order by a.idxpesanobat asc' ;

$qry_order = mysql_query($sql);

?>
<div align="center">
    <div id="frame" style="width:100%">
    <div id="frame_title"><h3>HISTORI PERMINTAAN RESEP</h3></div>
    <div align="right" style="margin:5px;">
    <form name="formsearch" method="post" >
     <table class="tb" >
       <tr>
          <td align="right">Tanggal Resep&nbsp;
              <input type="text" name="tgl_pesan" id="tgl_pesan" readonly="readonly" class="text" style="width:100px;"
              value="<? if($_REQUEST['tgl_pesan'] !=""): echo $_REQUEST['tgl_pesan']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a>
              <input type="submit" value="Cari" class="text"/></td>
          </tr>
     </table>
    </form> 
        <div id="table_search" align="center" style="width:99%">
        <table width="99%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" class="tb" align="center">
          <tr align="center">
            <th width="15%">DOKTER</th>
            <th>UNIT/RUANG</th>
            <th>TANGGAL</th>
            <th width="5%">NO MR</th>
            <th>NAMA</th>
            <th>ALAMAT</th>
			<th>CARABAYAR</th>
            <th width="120px">&nbsp;</th>
            </tr>
          <?
	$pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_pesan=".$tgl_pesan, "index.php?link=107&");
	
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
				<td><? echo $data['namadokter'];?></td>
                        <td><? echo $data['namapoli']; ?></td>
                        <td><? echo $data['tgl_pesan']; ?></td>
                        <td><? echo $data['NOMR']; ?></td>
                        <td><? echo $data['NAMA']; ?></td>
                        <td><? echo $data['ALAMAT']; ?></td>
                        <td><? echo $data['carabayar']; ?></td>
             <td><a href="apotek/printetiket.php?no=<? echo $data['no']; ?>" target="_blank">Print Etiket</a> | <a href="index.php?link=10histori_rajal&no=<? echo $data['no']; ?>"><input type="button" value="DETAIL" class="text" /></a></td>
              
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
