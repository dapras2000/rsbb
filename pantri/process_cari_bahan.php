<?php
session_start();
header("Content-Type: text/html; charset=ISO-8859-15");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include("../include/connect.php");
require_once('../pantri/ps_pagination_pantri.php');
//login validasi
//searching pasien

if(!empty($_GET['search'])){
	if($_GET['search']){
		$pos = strpos($_GET['search'],'.');
		?>
		<table width="95%" style="margin:10px;" border="0" cellspacing="0" cellspading="0">
          <tr>
            <th>Jenis Barang</th>
            <th>Satuan</th>
			<th>Jumlah</th>
            <th>Harga Satuan</th>
			<th>Jmlah Harga</th>
			<th>Aksi</th>
          </tr>
          
          <?
  		  if (substr($_GET['search'],0,$pos) == 'Jenis Barang' ){
			$sql="SELECT * 
		  		FROM m_bahan_makanan 
				WHERE jenis_barang like '".substr($_GET['search'],$pos+1,strlen($_GET['search'])-$pos)."%'";  
		  }
  		  if (substr($_GET['search'],0,$pos) == 'Satuan' ){
			$sql="SELECT * 
		  		FROM m_bahan_makanan
				WHERE satuan like '".substr($_GET['search'],$pos+1,strlen($_GET['search'])-$pos)."%'";  
		  }
		  if (substr($_GET['search'],0,$pos) != 'Jenis Barang' AND substr($_GET['search'],0,$pos) != 'Satuan'){
			$sql="SELECT * FROM m_bahan_makanan";  
		  }

	$pager = new PS_Pagination($connect, $sql, 15, 5, "param1=valu1&param2=value2");
	
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
            <td><? echo $data['jenis_barang'];?></td>
            <td><? echo $data['satuan']; ?></td>
            <td><? echo $data['jumlah']; ?></td>
			<td><? echo $data['harga_satuan']; ?></td>
            <td><? echo $data['jumlah_harga']; ?></td>
            <td><input type="hidden" name="edit" id="edit" value="<?php echo $data['id']; ?>">
                <a href="javascript:editbahanmakanan('<?php echo $data['id']; ?>');"> 
                    <div class="text" align="center">Edit</div>
                </a></td>
        
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
        </table>		
		<?
} }
?>
