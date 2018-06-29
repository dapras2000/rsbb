<?php 
session_start();
include("farmasi_new.php");

$tahun = "";
if(!empty($_GET['tahun'])){
	$tahun =$_GET['tahun']; 
} 

if($tahun !=""){
	$search = " AND t_pengadaan_barang.tahun = '".$tahun."' ";
}else{
	$search = "";
}


$sql = "SELECT 
		  m_barang_group.nama_group,
		  m_barang_group.nama_farmasi,
		  m_barang.kode_barang,
		  m_barang.nama_barang,
		  m_barang.satuan,
	      DATE_FORMAT(t_pengadaan_barang.tglpesan, '%d -%m -%Y') as tglpesan,
		  t_pengadaan_barang.jumlahpesan,
		  t_pengadaan_barang.tahun
		FROM
		  m_barang
		  INNER JOIN m_barang_group ON (m_barang.group_barang = m_barang_group.group_barang)
		  AND (m_barang.farmasi = m_barang_group.farmasi)
		  INNER JOIN t_pengadaan_barang ON (m_barang.kode_barang = t_pengadaan_barang.kodebarang)
		WHERE t_pengadaan_barang.KDUNIT ='".$_SESSION['KDUNIT']."' ".$search;
		
		
		$sqlcounter = "SELECT
		  count(m_barang_group.nama_group)
		FROM
		  m_barang
		  INNER JOIN m_barang_group ON (m_barang.group_barang = m_barang_group.group_barang)
		  AND (m_barang.farmasi = m_barang_group.farmasi)
		  INNER JOIN t_pengadaan_barang ON (m_barang.kode_barang = t_pengadaan_barang.kodebarang)
		WHERE t_pengadaan_barang.KDUNIT ='".$_SESSION['KDUNIT']."' ".$search;
$qry_order = mysql_query($sql);

$order = mysql_fetch_assoc($qry_order);
?>
<div align="center">
    <div id="frame" style="width:100%;">
    <div id="frame_title"><h3>LIST PERENCANAAN PENGADAAN</h3></div>
    <div align="right" style="margin:5px;">
    <form name="formsearch" method="get" >
     <table class="tb">
  <tr>
<?php
  $akhtahun = date('Y') + 5;
  $c = date('Y');
?>
   <td>Tahun</td>
   <td><select name="tahun" id="tahun" class="text" >
   <option value="" > -- </option>
 <? while($c <= $akhtahun){ ?>  
   <option value="<?=$c?>" <? if($c==$tahun){ echo "selected=selected"; } ?>><?=$c?></option>
 <? $c++; } ?>  
   </select>
              <input type="hidden" name="link" value="f08" />
              <input type="submit" value="Cari" class="text"/></td>
          </tr>
     </table>
    </form> 
        <div id="table_search">
        <table width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" class="tb">
          <tr align="center">
            <th width="5%">KODE</th>
            <th width="30%">NAMA BARANG</th>
            <th>JML</th>
            <th>SATUAN</th>
            <th>PERIODE</th>
            <th>TGL PESAN</th>
          </tr>
          <?

    $pager = new PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "tahun=".$tahun,"index.php?link=f08&");
	
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
            <td align="right"><? echo $data['jumlahpesan']; ?></td>
            <td><? echo $data['satuan']; ?></td>
            <td><? echo $data['tahun']; ?></td>
            <td><? echo $data['tglpesan']; ?></td>
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
