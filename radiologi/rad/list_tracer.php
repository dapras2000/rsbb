<script language="javascript" type="text/javascript" src="include/functions.js"></script>
<script language="javascript">
function printIt()
{
content=document.getElementById('list_tracer');
w=window.open('about:blank');
w.document.write( content.innerHTML );
w.document.writeln("<script>");
w.document.writeln("window.print()");
w.document.writeln("</"+"script>");
}
</script>
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
   location="?link=131&poly="+spoly+"&TGLREG="+document.getElementById('TGLREG').value+"&kun="+kunj+"&shif="+shif;			
}
</script>
<?php 
REQUIRE_ONCE("class/object.inc");
include("models/list_data_pasien.php"); 
include("include/connect.php");
require_once('ps_pagination3.php');

?>

<div align="center">
    <div id="frame" style="width:100%">
    <div id="frame_title">
      <h3>T R A C E R</h3></div>
    <form name="cari" id="cari" method="post">  
    <div align="right" style="margin:5px;"> 
       		 Tanggal <input type="text" name="TGLREG"  id="TGLREG" readonly="readonly" class="text"/><a href="javascript:showCal('Calendar2')"><img align="top" src="img/date.png" border="0" /></a>
            <br />
             List Berdasarkan <select name="poly" id="poly" class="text" >
                <option>-Pilih Poly-</option>
             <? 
			 	$qrypoly = mysql_query("SELECT * FROM m_poly ORDER BY kode ASC")or die (mysql_error());
				while ($listpoly = mysql_fetch_array($qrypoly)){
			 ?>
                <option value="<? echo $listpoly['kode'];?>"><? echo $listpoly['nama'];?></option>
			 <? } ?>
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

            
         </form>
        
        <div id="change_icd"></div>
        
        <div id="list_tracer" align="left" style="display:none;">
<?php 
	$sql1="SELECT E.IDXDAFTAR,A.NOMR,A.NAMA,A.ALAMAT,B.NAMA AS POLY1,C.NAMA AS CARABAYAR1,D.NAMA AS RUJUKAN1, E.TGLREG,SHIFT, A.JENISKELAMIN, DR.NAMADOKTER,
  	            case PASIENBARU when 1 then 'B' else 'L' end as B_L,E.IDXDAFTAR ,E.KDPOLY, E.NIP, RM.PENGIRIM, RM.PENERIMA,RM.PENERIMA_POLY,  case RM.STATUSRM when 0 then 'Lengkap' when 1 then 'Sementara' end as STATUSRM,
T.ICD_CODE		 		
	      FROM m_pasien A, m_poly B, m_carabayar C, m_rujukan D, t_pendaftaran E 
		  LEFT JOIN t_rekammedik RM on RM.IDXDAFTAR= E.IDXDAFTAR
		  LEFT JOIN m_dokter DR on DR.KDDOKTER=E.KDDOKTER
		  LEFT JOIN t_diagnosadanterapi T on (E.IDXDAFTAR = T.IDXDAFTAR)
          WHERE A.NOMR=E.NOMR AND E.KDPOLY=B.KODE AND E.KDRUJUK=D.KODE AND E.KDCARABAYAR=C.KODE AND E.TGLREG=curdate()";
	$NO=0;
	$columns = 2;
	$pager = new PS_Pagination3($connect, $sql1, 12, 5, "index.php?link=13&");
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
    $num_rows = mysql_num_rows($rs);
    $rows = ceil($num_rows / $columns);
	if(!$rs) die(mysql_error());
	while($row = mysql_fetch_array($rs)) {
        $data[] = $row['NAMA'];
        $data1[] = $row['NOMR'];
        $data2[] = $row['POLY1'];
		$data3[] = $row['TGLREG'];
		$data4[] = $row['CARABAYAR1'];
		$data5[] = $row['NIP'];
	}
      ?><table border='0' style="font-family:Arial, Helvetica, sans-serif; font-size:12px;"><?
      for($i = 0; $i < $rows; $i++) {
      	?><tr><?
          for($j = 0; $j < $columns; $j++) {
          if(isset($data[$i + ($j * $rows)])) {
	?>
        	<td valign='top'>
                <table width="300" border="1" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
                    <tr>
                      <td colspan="2" align="center"><strong>TRACER</strong></td>
                      </tr>
                    <tr>
                      <td width="111">NAMA</td>
                      <td width="177"><? echo $data[$i + ($j * $rows)]; ?></td>
                      </tr>
                    <tr>
                      <td>No MR</td>
                      <td><? echo $data1[$i + ($j * $rows)]; ?></td>
                      </tr>
                    <tr>
                      <td>TUJUAN</td>
                      <td><? echo $data2[$i + ($j * $rows)]; ?></td>
                      </tr>
                    <tr>
                      <td>TANGGAL</td>
                      <td><?php echo $data3[$i + ($j * $rows)]; ?></td>
                      </tr>
                    <tr>
                      <td>CARA BAYAR</td>
                      <td><? echo $data4[$i + ($j * $rows)]; ?></td>
                      </tr>
                    <tr>
                      <td>PETUGAS</td>
                      <td><? echo $data5[$i + ($j * $rows)]; ?></td>
                      </tr>
                    <tr>
                      <td colspan="2">F-<?=strtoupper($singhead1)?>-YANMED-10-12</td>
                      </tr>
                    </table>
            </td>
         <? } 
		  }
		 ?>
         </tr>
         <? } ?>
         </table>
   		<br />
        </div>
        <a href="#" onClick="printIt()"><input type="button" class="text" value=" PRINT "/></a>  
        <div id="cari_poly" align="center">
          <table width="99%" style="margin:10px;" border="0" cellspacing="0" cellspading="0" class="tb" title="List Kunjungan Data Pasien Per Hari Ini">
            <tr align="center">
            <th>NO </th>
              <th>NO RM</th>
              <th>Nama Pasien</th>
              <th>L/P</th>
              <th>Alamat</th>
              <th>Poly</th>
              <th>Dokter</th>
              <th>Cara Bayar</th>
              <th>Rujukan</th>
              <th>B/L</th>
              <th>Shift</th>
              <th>Pengirim</th>
              <th>Penerima di Poly</th>
              <th>Penerima</th>
               <th>ICD Code</th>
              <th>Status</th>
              <th>&nbsp;</th>
            </tr>
            <?
	$sql="SELECT E.IDXDAFTAR,A.NOMR,A.NAMA,A.ALAMAT,B.NAMA AS POLY1,C.NAMA AS CARABAYAR1,D.NAMA AS RUJUKAN1, E.TGLREG,SHIFT, A.JENISKELAMIN, DR.NAMADOKTER,
  	            case PASIENBARU when 1 then 'B' else 'L' end as B_L,E.IDXDAFTAR ,E.KDPOLY, E.NIP, RM.PENGIRIM, RM.PENERIMA,  RM.PENERIMA_POLY,  case RM.STATUSRM when 0 then 'Lengkap' when 1 then 'Sementara' end as STATUSRM,
					T.ICD_CODE	
             FROM m_pasien A, m_poly B, m_carabayar C, m_rujukan D, t_pendaftaran E 
		  LEFT JOIN t_rekammedik RM on RM.IDXDAFTAR= E.IDXDAFTAR
		  LEFT JOIN m_dokter DR on DR.KDDOKTER=E.KDDOKTER
		  LEFT JOIN t_diagnosadanterapi T on (E.IDXDAFTAR = T.IDXDAFTAR)
          WHERE A.NOMR=E.NOMR AND E.KDPOLY=B.KODE AND E.KDRUJUK=D.KODE AND E.KDCARABAYAR=C.KODE AND E.TGLREG=curdate()";
	$NO=0;
	$pager = new PS_Pagination3($connect, $sql, 12, 5, "index.php?link=13&");
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
              <td><a href="index.php?link=132&idx=<? echo $data['IDXDAFTAR']; ?>"><? echo $data['NOMR'];?></a></td>              
              <td><? echo $data['NAMA']; ?></td>
              <td><? echo $data['JENISKELAMIN']; ?></td>
              <td><? echo $data['ALAMAT']; ?></td>
              <td><? echo $data['POLY1']; ?></td>
              <td><? echo $data['NAMADOKTER']; ?></td>
              <td><? echo $data['CARABAYAR1'];?></td>
              <td><? echo $data['RUJUKAN1'];?></td>
              <td><? echo $data['B_L'];?></td>
              <td><? echo $data['SHIFT'];?></td>
              <td><? echo $data['PENGIRIM'];?></td>
		<td><? echo $data['PENERIMA_POLY'];?></td>
              <td><? echo $data['PENERIMA'];?></td>
             <td><? echo $data['ICD_CODE'];?></td>       
              <td><? echo $data['STATUSRM'];?></td> 
               <td><a href="#" class="text" onclick="javascript: MyAjaxRequest('change_icd','rm/change_icd.php?idx=<?=$data['IDXDAFTAR']?>'); return false;">ICD</a></td>                      
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