<script language="javascript">
function printIt()
{
content=document.getElementById('print_data');
head=document.getElementById('head_report');
w=window.open('about:blank');
w.document.writeln("<link href='dq_sirs.css' type='text/css' rel='stylesheet' />");
w.document.write( head.innerHTML );
w.document.write( content.innerHTML );
w.document.writeln("<script>");
w.document.writeln("window.print()");
w.document.writeln("</"+"script>");
}
</script>
<script language="javascript" type="text/javascript">
function dopilih(){
	document.cari.cari2.value=document.cari.s_by.value+'.'+document.cari.searc.value;
	location="?link=26&search="+document.cari.cari2.value;
	//location=window.location.protocol + "//" + window.location.host + "/" + window.location.pathname;

	//MyAjaxRequest('table_search','include/process.php?call=<?php echo $cari2; ?>&search=','cari2'); Effect.appear('search'); 
	//return false;
	//processajax ("include/process.php", document.getElementById("table_search"), "post", "search="+<?php echo $cari2; ?>+"&");
	}
</script>
<?php 
session_start();
include("include/connect.php");
require_once('ps_pagination2.php');

?>
<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>LIST DATA PASIEN</h3></div>
    <div align="right" style="margin:5px;"> 
     <form name="cari">
    
     cari <input type="TEXT" name="searc" id="searc" size="25" class="text"  />
     berdasarkan <select name="s_by" id="s_by" class="text" onchange="dopilih()">
     	<option>-pilih-</option>
     	<option id="nomr">nomr</option>
     	<option id="nama">nama</option>
     	<option id="alamat">alamat</option>
     	<option id="telepon">telepon</option>
     	<option id="tgllahir">tgllahir</option>
     	<option id="noktp">noktp</option>
     </select>
    <input type="hidden" id="cari2" name="cari2"/> <input type="button" class="text" value="PRINT" onclick="printIt()" />
    
 </form>
          <?

if(!empty($_GET['search'])){
	if($_GET['search']){
		
		 $pos = strpos($_GET['search'],'.');
		?>
			<div id="head_report" style="display:none" >
                <div align="left" style="clear:both; padding:20px">
                    <div style="letter-spacing:-1px; font-size:16px; font:bold;"><?=strtoupper($header1)?></div>
                    <div style="letter-spacing:-2px; font-size:24px; color:#666; font:bold;"><?=strtoupper($header2)?></div>
					<div><?=$header3?><br /><?=$header4?></div>
                    <hr style="margin:5px;" />
                    <h2>LIST DATA PASIEN</h2>
                </div>            
            </div>
        <div id="print_data">
		<table width="95%" style="margin:10px;" border="0" cellspacing="0" cellspading="0" class="tb">
          <tr align="center">
            <th width="3%">NoRM</th>
            <th width="14%">Nama Pasien</th>
            <th width="6%"> TanggalLahir</th>
            <th width="18%">Alamat</th>
            <th width="18%">NO KTP</th>
            <th width="13%">Jenis Kelamin</th>
            <th width="11%">No telepon</th>
            <th width="10%">AwalDaftar</th>
            <th width="7%">EDIT</th>
          </tr>
          
          <? 
		  //SELECT a.*, DATE_FORMAT(TGLLAHIR,'%d/%m/%Y') as TGLLAHIR1,(select DATE_FORMAT(tglreg,'%d/%m/%Y') from t_pendaftaran where nomr=a.nomr order by idxdaftar desc limit 0,1) as tgldaftar FROM m_pasien a ORDER BY a.NOMR DESC 
  		  if (substr($_GET['search'],0,$pos)=='nomr' ){
			  $filter='nomr'; //add dadang
			$sql="SELECT a.* , DATE_FORMAT(TGLLAHIR,'%d/%m/%Y') as TGLLAHIR1,(select DATE_FORMAT(tglreg,'%d/%m/%Y') from t_pendaftaran where nomr=a.nomr order by idxdaftar desc limit 1) as tgldaftar 
		  		FROM m_pasien a
				WHERE NOMR like '%".ltrim(substr($_GET['search'],$pos+1,strlen($_GET['search'])-$pos))."%' order by a.NOMR DESC";  
		  }
  		  if (substr($_GET['search'],0,$pos)=='nama' ){
			  $filter='nama';
			$sql="SELECT a.* , DATE_FORMAT(TGLLAHIR,'%d/%m/%Y') as TGLLAHIR1,(select DATE_FORMAT(tglreg,'%d/%m/%Y') from t_pendaftaran where nomr=a.nomr order by idxdaftar desc limit 1) as tgldaftar 
		  		FROM m_pasien a
				WHERE NAMA like '".ltrim(substr($_GET['search'],$pos+1,strlen($_GET['search'])-$pos))."%' order by NAMA ASC";  
		  }
  		  if (substr($_GET['search'],0,$pos)=='alamat' ){
			  $filter='alamat';
			$sql="SELECT a.* , DATE_FORMAT(TGLLAHIR,'%d/%m/%Y') as TGLLAHIR1,(select DATE_FORMAT(tglreg,'%d/%m/%Y') from t_pendaftaran where nomr=a.nomr order by idxdaftar desc limit 1) as tgldaftar 
		  		FROM m_pasien a 
				WHERE ALAMAT like '".ltrim(substr($_GET['search'],$pos+1,strlen($_GET['search'])-$pos))."%' order by ALAMAT";  
		  }
  		  if (substr($_GET['search'],0,$pos)=='telepon' ){
			  $filter='telepon';
			$sql="SELECT a.* , DATE_FORMAT(TGLLAHIR,'%d/%m/%Y') as TGLLAHIR1,(select DATE_FORMAT(tglreg,'%d/%m/%Y') from t_pendaftaran where nomr=a.nomr order by idxdaftar desc limit 1) as tgldaftar 
		  		FROM m_pasien a 
				WHERE NOTELP like '%".ltrim(substr($_GET['search'],$pos+1,strlen($_GET['search'])-$pos))."%' order by NOTELP";  
		  }
  		  if (substr($_GET['search'],0,$pos)=='tgllahir' ){
			  $filter='tgllahir';
			$sql="SELECT a.* , DATE_FORMAT(TGLLAHIR,'%d/%m/%Y') as TGLLAHIR1,(select DATE_FORMAT(tglreg,'%d/%m/%Y') from t_pendaftaran where nomr=a.nomr order by idxdaftar desc limit 1) as tgldaftar 
		  		FROM m_pasien a 
				WHERE TGLLAHIR like '%".ltrim(substr($_GET['search'],$pos+1,strlen($_GET['search'])-$pos))."%' order by TGLLAHIR";  
		  }
  		  if (substr($_GET['search'],0,$pos)=='noktp' ){
			  $filter='noktp';
			$sql="SELECT a.* , DATE_FORMAT(TGLLAHIR,'%d/%m/%Y') as TGLLAHIR1,(select DATE_FORMAT(tglreg,'%d/%m/%Y') from t_pendaftaran where nomr=a.nomr order by idxdaftar desc limit 1) as tgldaftar 
		  		FROM m_pasien a  
				WHERE NOKTP like '%".ltrim(substr($_GET['search'],$pos+1,strlen($_GET['search'])-$pos))."%' order by NOKTP";  
		  }
     //echo $filter;
	$pager1 = new PS_Pagination2($connect, $sql, 15, 5, "param1=valu1&param2=value2");
	
	//The paginate() function returns a mysql result set 
	$rs = $pager1->paginate();
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
            <td><? echo $data['NOMR'];?></td>
            <td><? echo $data['NAMA']; ?></td>
            <td><? echo $data['TGLLAHIR1']; ?></td>
            <td><? echo $data['ALAMAT']; ?></td>
            <td><? echo $data['NOKTP']; ?></td>
            <td><? if($data['JENISKELAMIN']=="l" || $data['JENISKELAMIN']=="L"){echo"Laki-Laki";}else{echo"Perempuan";} ?></td>
            <td><? echo $data['NOTELP'] ?></td>
            <td><? echo $data['tgldaftar']; ?></td>
            <td><a href="?link=24&NOMR=<?=$data['NOMR'];?>"><input type="button" value="edit pasien" class="text" /></a></td>
        
          </tr>
	 <?	} ?>
  
</table>
</div>
	<?php
	
	//Display the full navigation in one go
	//echo $pager->renderFullNav();
	
	//Or you can display the inidividual links
	echo "<div style='padding:5px;' align=\"center\"><br />";
	
	//Display the link to first page: First
	echo $pager1->renderFirst()." | ";
	
	//Display the link to previous page: <<
	echo $pager1->renderPrev()." | ";
	
	//Display page links: 1 2 3
	echo $pager1->renderNav()." | ";
	
	//Display the link to next page: >>
	echo $pager1->renderNext()." | ";
	
	//Display the link to last page: Last
	echo $pager1->renderLast();
	
	echo "</div>";
	}
}?>
        </div>
    </div>
</div>
</div>

