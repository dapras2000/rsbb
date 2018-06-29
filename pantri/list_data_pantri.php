<script language="javascript" type="text/javascript">
function dopilih(){
	document.cari.cari2.value=document.cari.s_by.value+'.'+document.cari.searc.value;
	MyAjaxRequest('table_search','pantri/process.php?call=<?php echo $cari2; ?>&search=','cari2'); Effect.appear('search'); return false;
	}
</script>
<script language="javascript" type="text/javascript" src="../rajal/functions.js"></script>
<script language="javascript" type="text/javascript" src="../rajal/xmlhttp.js"></script>

<?php 
include("../include/connect.php");
require_once('pantri/ps_pagination_pantri.php');

?>
<div id="edit_makanan">
<div align="center">
    <div id="frame" style="width:50%">
    <div id="frame_title">
      <h3>LIST DATA MAKANAN <?=strtoupper($singhead1)?></h3></div>
    <div align="right" style="margin:5px;"> 
     <form name="cari">
    
     cari <input type="TEXT" name="searc" id="searc" size="25" class="text"  />
     berdasarkan <select name="s_by" id="s_by" class="text" onchange="dopilih()">
     	<option>-pilih-</option>
     	<option id="nama_makanan">Nama Makanan</option>
     	<option id="merk">Merk</option>
     </select>
    <input type="hidden" id="cari2" name="cari2"/>
    
 </form>
        <div id="table_search" align="center">
        <table width="90%" style="margin:10px;" border="0" cellspacing="0" cellspading="0" title="List Semua Data User.">
          <tr>
            <th>Nama Makanan</th>
            <th>Merk</th>
            <th>Satuan</th>
			<th>Aksi</th>
          </tr>
          <?
	$sql="SELECT * FROM m_pantri ORDER BY nama_makanan DESC";
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
            <td><? echo $data['nama_makanan'];?></td>
            <td><? echo $data['merk']; ?></td>
            <td><? echo $data['satuan']; ?></td>
            <td><input type="hidden" name="edit" id="edit" value="<?php echo $data['id']; ?>">
                <a href="javascript:editmakanan('<?php echo $data['id']; ?>');"> 
                    <div class="text" align="center">Edit Makanan</div>
                </a>
            </td>
        
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
</div>
