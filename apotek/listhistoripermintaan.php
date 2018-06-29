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
	$search = " AND view_orderresep.TANGGAL = '".$tgl_pesan."' ";
}else{
	$search = "";
}

include("./include/connect.php");
include('./apotek/ps_pagination.php');

			 $sql = "SELECT DISTINCT
				  view_orderresep.CARABAYAR,
				  view_orderresep.NOMR,
				  view_orderresep.NAMA,
				  view_orderresep.ALAMAT,
				  view_orderresep.NAMADOKTER,
				  view_orderresep.KDPOLY,
				  view_orderresep.NAMAPOLY,
				  view_orderresep.NORESEP,
				  view_orderresep.TANGGAL,
				  view_orderresep.NAMAOBAT,
				  view_orderresep.NIP,
				  view_orderresep.IDXRESEP
				FROM
				  view_orderresep
					WHERE view_orderresep.STATUS = '1' ".$search;

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
              value="<? if($tgl_pesan!=""){
			  echo $tgl_pesan;}?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a>
              <input type="submit" value="Cari" class="text"/></td>
          </tr>
     </table>
    </form> 
        <div id="table_search" align="center" style="width:99%">
        <table width="99%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" class="tb" align="center">
          <tr align="center">
            <th>NO RESEP</th>
            <th width="15%">DOKTER</th>
            <th>UNIT/RUANG</th>
            <th>TANGGAL</th>
            <th width="5%">NO MR</th>
            <th>NAMA</th>
            <th>ALAMAT</th>
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
            <td><? echo $data['NORESEP']; ?></td>
            <td><? echo $data['NAMADOKTER']; ?></td>
            <td><? echo $data['NAMAPOLY']; ?></td>
            <td><? echo $data['TANGGAL']; ?></td>
            <td><? echo $data['NOMR']; ?></td>
             <td><? echo $data['NAMA']; ?></td>
              <td><? echo $data['ALAMAT']; ?></td>
             <td><a href="apotek/printetiket.php?noresep=<? echo $data['IDXRESEP']; ?>" target="_blank">Print Etiket</a> | <a href="index.php?link=108&noresep=<? echo $data['IDXRESEP']; ?>"><input type="button" value="DETAIL" class="text" /></a></td>
              
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
