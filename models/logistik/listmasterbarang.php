<?php 
session_start();
include("include/connect.php");
require_once('logistik/ps_pagination2.php');

$sql="SELECT 
					  kode_barang,
					  nama_barang,
					  group_barang,
					  (SELECT saldo FROM t_barang_stok
					  WHERE kode_barang = m_barang.kode_barang
					  ORDER BY tanggal, kode_barang DESC LIMIT 1) as stok,
					  satuan,
					  harga
					  FROM m_barang
					  ORDER BY nama_barang";

$qry_order = mysql_query($sql);
$order = mysql_fetch_assoc($qry_order);
?>
<div id="addbarang"></div>
<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>LIST MASTER DATA BARANG</h3></div>
    <div align="right" style="margin:5px;"> 
        <div id="table_search">
        <table width="95%" style="margin:10px;" border="0" cellspacing="0" cellspading="0" class="tb">
          <tr align="center">
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Group</th>
            <th>Stok</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th width="10%">Option</th>
           </tr>
          <?
				
	$pager = new PS_Pagination($connect, $sql, 15, 5, "param1=valu1&param2=value2");
	
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	$x= 1;
	while($data = mysql_fetch_array($rs)) {?>
          <div id="del<?=$data['kode_barang'];?>" >
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
            <td><a href="#" onclick="document.getElementById('idobat').value = '<? echo $data['kode_barang'];?>';" ><? echo $data['kode_barang']; ?></a></td>
            <td><? echo $data['nama_barang']; ?></td>
            <td><? switch($data['group_barang']){
					case "1" :
						echo "ATK";
						break;
					case "2" :
						echo "Cetakan";
						break;
					case "3" :
						echo "ART";
						break;
					case "4" :
						echo "Alat Bersih dan Pembersih";
						break;
					case "5" :
						echo "Lain - Lain";
						break;	
				}?></td>
            <td><? if(empty($data['stok'])){echo"0";}else{ echo $data['stok']; } ?></td>
            <td><? echo $data['satuan']; ?></td>
            <td><? echo $data['harga']; ?></td>
            <td><a href="#" onclick="javascript: MyAjaxRequest('addbarang','logistik/prosesbarang.php?opt=1');" >Add</a> | <a href="#" onclick="javascript: MyAjaxRequest('addbarang','logistik/prosesbarang.php?opt=2&amp;idxbarang=<?=$data['kode_barang']?>');" >Edit</a> | <a href="#" onclick="javascript: if(confirm('Yakin Dihapus.')){
  	MyAjaxRequest('del<?=$data['kode_barang']?>','logistik/prosesbarang.php?opt=3&amp;idxbarang=<?=$data['kode_barang']?>'); window.location='<?php echo _BASE_;?>index.php?link=92'; return false; }else{ return false;}" >Del</a></td>
            </tr></div>
	 <?	$x++;} 
	
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
<div id="msg" ></div>
<p></p>
