<script language="javascript" type="text/javascript" src="include/functions.js"></script>
<script language="javascript" type="text/javascript">
function dopilih(){
	//submitform (document.getElementById('cari'),'include/process.php','cari_poly',validatetask); return false;
	var spoly;
	var kunj;
	var shif;
	if (document.getElementById('poly').value=="-Pilih Poly-") {
		//location="?link=27&poly="+"&TGLREG="+document.getElementById('TGLREG').value;		
		spoly="";
	}
	else {
	//location="?link=27&poly="+document.getElementById('poly').value+"&TGLREG="+document.getElementById('TGLREG').value;		
	   spoly=document.getElementById('poly').value;
	}
	if (document.getElementById('kunj').value=="-Pilih Kunjungan-") {		
		kunj="";
	}
	else {
	   kunj=document.getElementById('kunj').value;
	}
	if (document.getElementById('shift').value=="-Pilih Shift-") {		
		shif="";
	}
	else {
	   shif=document.getElementById('shift').value;
	}
   location="?link=27&poly="+spoly+"&TGLREG="+document.getElementById('TGLREG').value+"&kun="+kunj+"&shif="+shif;			
}
</script>
<?php 
include("include/connect.php");
include('ps_pagination3.php');

?>

<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>LIST KUNJUNGAN PASIEN / HARI INI</h3></div>
    <form name="cari" id="cari" method="post">  
    <div align="right" style="margin:5px;"> 
       		 Tanggal <input type="text" name="TGLREG"  id="TGLREG" readonly="readonly" class="text"/><a href="javascript:showCal('Calendar2')"><img align="top" src="img/date.png" border="0" /></a>
            <br />
             List Berdasarkan <select name="poly" id="poly" class="text" >
                <option value="9">UGD</option>
             </select>
             <select name="kunj" id="kunj" class="text" >
             <option>-Pilih Kunjungan-</option>
             <option value="1">LAMA</option>
             <option value="2">BARU</option>
             </select>
<select name="shift" id="shift" class="text" >
             <option>-Pilih Shift-</option>
             <option value="1">I</option>
             <option value="2">II</option>
             <option value="3">III</option>
      </select><br />
<input type="submit" class="text" value="Cari" onclick="dopilih(); return false;"  />

        </div>    
         </form>     
        <div id="cari_poly">
          <table width="95%" style="margin:10px;" border="0" cellspacing="0" cellspading="0" title="List Kunjungan Data Pasien Per Hari Ini">
            <tr align="center">
            <th>NO </th>
              <th>NO RM</th>
              <th>Nama Pasien</th>
              <th>Alamat</th>
              <th>Poly</th>
              <th>Cara Bayar</th>
              <th>Rujukan</th>
              <th>B/L</th>
              <th>Shift</th>
            </tr>
            <?
	$sql="SELECT A.NOMR,A.NAMA,A.ALAMAT,B.NAMA AS POLY1,C.NAMA AS CARABAYAR1,D.NAMA AS RUJUKAN1, E.TGLREG,SHIFT,
  	            case PASIENBARU when 1 then 'B' else 'L' end as B_L,E.IDXDAFTAR ,E.KDPOLY
	      FROM m_pasien A, m_poly B, m_carabayar C, m_rujukan D, t_pendaftaran E 
          WHERE A.NOMR=E.NOMR AND E.KDPOLY=B.KODE AND E.KDRUJUK=D.KODE AND E.KDCARABAYAR=C.KODE AND E.TGLREG=curdate()";
$NO=0;
	$pager = new PS_Pagination3($connect, $sql, 15, 5, "index.php?link=22&");
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
              <td><? $NO=($NO+1);if ($_GET['page']==0){$hal=0;}else{$hal=$_GET['page']-1;} echo ($hal*15)+$NO;?></td>
              <td><? echo $data['NOMR'];?></td>
              <td><? echo $data['NAMA']; ?></td>
              <td><? echo $data['ALAMAT']; ?></td>
              <td><? echo $data['POLY1']; ?></td>
              <td><? echo $data['CARABAYAR1'];?></td>
              <td><? echo $data['RUJUKAN1'];?></td>
              <td><? echo $data['B_L'];?></td>
              <td><? echo $data['SHIFT'];?></td>
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
