<?php 
session_start();
include("include/connect.php");
include("farmasi_new.php");

$tgl_pesan = "";
if(!empty($_GET['tgl_pesan'])){
	$tgl_pesan =$_GET['tgl_pesan']; 
} 

if($tgl_pesan !=""){
	$search = " AND t_pengeluaran_barang.tglkeluar = '".$tgl_pesan."' ";
}else{
	$search = "";
}


$sql = "SELECT 
		  m_barang_group.nama_group,
		  m_barang_group.nama_farmasi,
		  m_barang.kode_barang,
		  m_barang.nama_barang,
		  m_barang.satuan,
		  m_barang.no_batch,
		  DATE_FORMAT(m_barang.expiry, '%d -%m -%Y') as expiry,
		  t_pengeluaran_barang.jmlkeluar,
		  m_barang.satuan,
		  DATE_FORMAT(t_pengeluaran_barang.tglkeluar, '%d -%m -%Y') as tglkeluar,
		  t_pengeluaran_barang.NOMR
		FROM
		  m_barang
		  INNER JOIN m_barang_group ON (m_barang.group_barang = m_barang_group.group_barang)
		  AND (m_barang.farmasi = m_barang_group.farmasi)
		  INNER JOIN t_pengeluaran_barang ON (m_barang.kode_barang = t_pengeluaran_barang.kodebarang)
		WHERE t_pengeluaran_barang.KDUNIT ='".$_SESSION['KDUNIT']."' ".$search;
		
		$sqlcounter = "SELECT
		  count(m_barang_group.nama_group)
		FROM
		  m_barang
		  INNER JOIN m_barang_group ON (m_barang.group_barang = m_barang_group.group_barang)
		  AND (m_barang.farmasi = m_barang_group.farmasi)
		  INNER JOIN t_pengeluaran_barang ON (m_barang.kode_barang = t_pengeluaran_barang.kodebarang)
		WHERE t_pengeluaran_barang.KDUNIT ='".$_SESSION['KDUNIT']."' ".$search;
$qry_order = mysql_query($sql);

$order = mysql_fetch_assoc($qry_order);
?>
<div align="center">
    <div id="frame" style="width:100%;">
    <div id="frame_title"><h3>LIST PENGELUARAN BARANG</h3></div>
    <div align="right" style="margin:5px;">
    <form name="formsearch" method="get" >
     <table class="tb">
       <tr>
           <td align="right">Tanggal Pesan&nbsp;<input type="text" name="tgl_pesan" id="tgl_pesan" readonly="readonly" class="text" style="width:100px;"
              value="<? if($_REQUEST['tgl_pesan'] !=""): echo $_REQUEST['tgl_pesan']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a>
              <input type="hidden" name="link" value="f06" />
              <input type="submit" value="Cari" class="text"/></td>
          </tr>
     </table>
    </form> 
        <div id="table_search">
        <table width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" class="tb">
          <tr align="center">
            <th width="5%">KODE</th>
            <th width="30%">NAMA BARANG</th>
            <th>NO BATCH</th>
            <th>TGL KADALUARSA</th>
            <th>JML KELUAR</th>
            <th>SATUAN</th>
            <th>JNS BARANG</th>
            <th>TGL KELUAR</th>
            <th>NO RM</th>
          </tr>
          <?

    $pager = new PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "tgl_pesan=".$tgl_pesan,"index.php?link=f06&");
	
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
            <td><? echo $data['kode_barang']; ?></td>
            <td><? echo $data['nama_barang']; ?></td>
            <td><? echo $data['no_batch']; ?></td>
            <td><? echo $data['expiry']; ?></td>
            <td align="right"><? echo $data['jmlkeluar']; ?></td>
            <td><? echo $data['satuan']; ?></td>
            <td><? echo $data['nama_farmasi']; ?></td> 
            <td><? echo $data['tglkeluar']; ?></td>
             <td><? echo $data['NOMR']; ?></td>
         </tr>
	 <?	} 
	
	
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
