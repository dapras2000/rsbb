<script language="javascript" type="text/javascript" src="include/functions.js"></script>
<script language="javascript">
function printIt()
{
content=document.getElementById('cari_poly');
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
	//submitform (document.getElementById('cari'),'include/process.php','cari_poly',validatetask); return false;
	var nam4=document.getElementById('nam4').value;
	var spoly;
	var kunj;
	var shif;
	if (document.getElementById('nam4').value=="") {
		//location="?link=27&poly="+"&TGLREG="+document.getElementById('TGLREG').value;		
		nam4="";
	}
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
    location="?link=27&nam4="+nam4+"&poly="+spoly+"&TGLREG="+document.getElementById('TGLREG').value+"&kun="+kunj+"&shif="+shif;			
}
</script>
<?php 
session_start();
include("include/connect.php");
require_once('ps_pagination3.php');

//cari_poly----------------------------------------------------------------------------------
//if(!empty($_GET['poly'])){
  if(!empty($_GET['TGLREG'])){
	$tgl_reg = $_GET['TGLREG'];
  }else{
	$tgl_reg =date('Y/m/d');
  }
  if(!empty($_GET['nam4'])){
	  $snam4=" and A.NAMA LIKE '%".$_GET['nam4']."%'";
  }
  else{
	$snam4=" ";
  }
  if(!empty($_GET['poly'])){
	  $sspoly=" and e.kdpoly=".$_GET['poly'];
  }
  else {
	  $sspoly=" ";
  }
  if(!empty($_GET['kun'])){
	  $kunbaru=$_GET['kun']-1;
	  $sskun=" and pasienbaru=".$kunbaru;
  }
  else {
	  $sskun=" ";
  }
  if(!empty($_GET['shif'])){
	  $ssshif=" and shift=".$_GET['shif'];
  }
  else {
	  $ssshif=" ";
  }
  
if(!empty($_GET['TGLREG'])){
	$tglreg = $_GET['TGLREG'];
	$today = "Tanggal ".$_GET['TGLREG'];
}else{
	$tglreg = $_GET['TGLREG'];
	$today = "Hari Ini";
}
?>
<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>LIST KUNJUNGAN PASIEN / <?=$today?></h3></div>
    <div align="right" style="margin:5px; margin-right:10px;"> 
	<?
      echo $pmb -> begin_round("600px","FFF","CCC","CCC"); //  (width, fillcolor, edgecolor, shadowcolor)
    ?>
    <form name="cari" id="cari" method="post">  
    <div align="right" style="margin:5px;"> 
       		 Tanggal <input type="text" name="TGLREG"  id="TGLREG" value="<?=$_GET['TGLREG']?>" readonly="readonly" class="text"/><a href="javascript:showCal('Calendar2')"><img align="top" src="img/date.png" border="0" /></a>
            <br /><br />
            Cari Nama :
<input type="text" name="nam4" id="nam4" class="text" value="<?=$_GET['nam4']?>"/>
            <select name="poly" id="poly" class="text" >
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
            </select>
<br /><br />
                  <input type="submit" class="text" value="Cari" onclick="dopilih(); return false;"  />
<input type="button" class="text" value="PRINT" onclick="printIt()" />
</div>            
         </form>     
	<? 
      echo $pmb -> end_round();
    ?>    
    </div>
        <div id="cari_poly">
            <div id="head_report" style="display:none" >
                <div align="left" style="clear:both; padding:20px">
                    <div style="letter-spacing:-1px; font-size:16px; font:bold;"><?=strtoupper($header1)?></div>
                    <div style="letter-spacing:-2px; font-size:24px; color:#666; font:bold;"><?=strtoupper($header2)?></div>
					<div><?=$header3?><br /><?=$header4?></div>
                    <hr style="margin:5px;" />
                    <h1>LIST KUNJUNGAN PASIEN</h1>
                </div>            
            </div>
        <table  class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
          <tr align="center">
           <th>NO </th>
           <th>Tanggal</th>
            <th>NO RM</th>
            <th>Nama Pasien</th>
            <th>L/P</th>
            <th>Alamat</th>
            <th>Poly</th>
            <th>Nama Dokter</th>
            <th>Cara Bayar</th>
            <th>Rujukan</th>
            <th>Ket.Rujukan</th>
            <th>B/L</th>
            <th>Shift</th>
            <th>Update</th>
          </tr>
          <?
   $sql="SELECT A.NOMR,A.NAMA,A.JENISKELAMIN,A.ALAMAT,B.NAMA AS POLY1,C.NAMA AS CARABAYAR1,D.NAMA AS RUJUKAN1, E.TGLREG,E.SHIFT,DR.NAMADOKTER, E.KETRUJUK, DATE_FORMAT(TGLREG,'%d/%m/%Y') TGLREG,
		  case PASIENBARU when 1 then 'B' else 'L' end as B_L,E.IDXDAFTAR,E.KDPOLY 
	      FROM m_pasien A, m_poly B, m_carabayar C, m_rujukan D, t_pendaftaran E 
  		  LEFT JOIN m_dokter DR on DR.KDDOKTER=E.KDDOKTER
          WHERE A.NOMR=E.NOMR AND E.KDRUJUK=D.KODE AND E.KDCARABAYAR=C.KODE AND E.KDPOLY=B.KODE AND E.TGLREG='$tgl_reg' ".$snam4.$sspoly.$sskun.$ssshif." ORDER BY E.IDXDAFTAR";
//pager = new PS_Pagination3($connect, $sql, 15, 5,"index.php?link=27&poly=".$sspoly."&TGLREG=".$tgl_reg."&kun=".$sskun."&shif=".$ssshif."&");		  
	$pager = new PS_Pagination3($connect, $sql, 15, 5, "index.php?link=27&nam4=".$_GET['nam4']."&poly=".$_GET['poly']."&TGLREG=".$tgl_reg."&kun=".$_GET['kun']."&shif=".$_GET['shif']."&");


	//The paginate() function returns a mysql result set 
	$NO=0;	
	$rs = $pager->paginate();
	if(!$rs){ echo"<div class='tb'>anda belum memilih poly</div>"; 
	}else{
	
	while($data = mysql_fetch_array($rs)) {?>
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
        <td><?      $NO=($NO+1);if ($_GET['page']==0){$hal=0;}else{$hal=$_GET['page']-1;} echo ($hal*15)+$NO;?></td>
        <td><? echo $data['TGLREG'];?></td>
            <td><? echo $data['NOMR'];?></td>
            <td><? echo $data['NAMA']; ?></td>
            <td><? echo $data['JENISKELAMIN']; ?></td>
            <td><? echo $data['ALAMAT']; ?></td>
            <td><? echo $data['POLY1']; ?></td>
            <td><? echo $data['NAMADOKTER']; ?></td>
            <td><? echo $data['CARABAYAR1'];?></td>
            <td><? echo $data['RUJUKAN1'];?></td>
            <td><? echo $data['KETRUJUK'];?></td>
            <td><? echo $data['B_L'];?></td>
            <td><? echo $data['SHIFT'];?></td>
			<td align="center"><a href="?link=28&idx=<?=$data['IDXDAFTAR'];?>"><input type="button" value="Edit" class="text"/></a></td>
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
<? 

	}

?>

        </div>
    </div>
<br />
<? 
$qry_excel = "SELECT E.IDXDAFTAR AS INDEX_DAFTAR,
					A.NOMR,
					A.NAMA AS NAMA_PASIEN,
					A.JENISKELAMIN AS JNS_KELAMIN,
					A.ALAMAT,
					B.NAMA AS POLY_TUJUAN,
					C.NAMA AS STATUS_BAYAR,
					D.NAMA AS RUJUKAN, 
					E.KETRUJUK AS KET_RUJUKAN,
					SHIFT,
					DR.NAMADOKTER AS DOKTER, 		 
					DATE_FORMAT(TGLREG,'%d/%m/%Y') TGL_REGISTRASI,
  	            	case PASIENBARU when 1 then 'B' else 'L' end AS PASIEN_BARU_LAMA
				FROM m_pasien A, m_poly B, m_carabayar C, m_rujukan D, t_pendaftaran E 
  		  		LEFT JOIN m_dokter DR on DR.KDDOKTER=E.KDDOKTER
          		WHERE A.NOMR=E.NOMR AND E.KDPOLY=B.KODE AND E.KDRUJUK=D.KODE AND E.KDCARABAYAR=C.KODE AND E.TGLREG='$tgl_reg' ".$snam4.$sspoly.$sskun.$ssshif;
?>
<div align="left">
<form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
<input type="hidden" name="query" value="<?=$qry_excel?>" />
<input type="hidden" name="header" value="LIST KUNJUNGAN PASIEN" />
<input type="hidden" name="filename" value="list_kunjungan_pasien" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
</div>
   
</div>