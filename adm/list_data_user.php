<script language="javascript" type="text/javascript">
function dopilih(){
	document.cari.cari2.value=document.cari.s_by.value+'.'+document.cari.searc.value;
	MyAjaxRequest('table_search','adm/process.php?call=<?php echo $cari2; ?>&search=','cari2'); Effect.appear('search'); return false;
	}
</script>
<script language="javascript" type="text/javascript" src="../rajal/functions.js"></script>
<script language="javascript" type="text/javascript" src="../rajal/xmlhttp.js"></script>

<?php 
include("../include/connect.php");
require_once('adm/ps_pagination_adm.php');

?>
<div id="edit_user">
<div align="center">
    <div id="frame" style="width:50%">
    <div id="frame_title">
      <h3>LIST DATA USER <?=strtoupper($singhead1)?></h3></div>
    <div align="right" style="margin:5px;"> 
     <form name="cari">
    
     cari <input type="TEXT" name="searc" id="searc" size="25" class="text"  />
     berdasarkan <select name="s_by" id="s_by" class="text" onchange="dopilih()">
     	<option>-pilih-</option>
     	<option id="NIP">NIP</option>
     	<option id="ROLES">ROLES</option>
     </select>
    <input type="hidden" id="cari2" name="cari2"/>
    
 </form>
        <div id="table_search" align="center">
        <table width="90%" style="margin:10px;" border="0" cellspacing="0" cellspading="0" title="List Semua Data User.">
          <tr align="center">
            <th>NIP</th>
            <th>PASSWORD</th>
            <th>ROLES</th>
            <th>EDIT</th>
          </tr>
          <?
	$sql="SELECT * FROM m_login ORDER BY ROLES DESC";
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
            <td><? echo $data['NIP'];?></td>
            <td><? echo $data['PWD']; ?></td>
            <td><? 	if($data['ROLES']=="1"){
						echo"Bagian Pendaftaran";
						}elseif($data['ROLES']=="2"){
							echo"Bagian Pembayaran";
							}elseif($data['ROLES']=="3"){
								echo"Bagian SDM";
								}elseif($data['ROLES']=="4"){
									echo"Bagian Rawat Jalan";
									}else{
										echo"Super Administrator";
										}
			 ?></td>
            <td><input type="hidden" name="edit" id="edit" value="<?php echo $data['NIP']; ?>">
                <a href="javascript:edituser('<?php echo $data['NIP']; ?>');"> 
                    <div class="text" align="center">Edit User</div>
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
