<script language="javascript" type="text/javascript" src="include/functions.js"></script>


<script language="javascript">
function printIt(){
	content=document.getElementById('list_tracer');
	w=window.open('about:blank');
	w.document.write( content.innerHTML );
	w.document.writeln("<script>");
	w.document.writeln("window.print()");
	w.document.writeln("</"+"script>");
}
jQuery(document).ready(function(){
	jQuery('.printrm').click(function(){
		//jQuery('#show_print').printArea();
		//return false;
		var idx 	= jQuery(this).attr('id');
		var poly	= jQuery(this).attr('svn');

		jQuery.post('<?php echo _BASE_.'print_tracer.php';?>',{idx:idx,poly:poly},function(data){
			jQuery('#show_print').empty().html(data);
			w=window.open();
			w.document.write(jQuery('#show_print').html());
			w.print();
			w.close();
			jQuery('#show_print').empty();
		});
		
	});
});
</script>
<style type="text/css" media="print">
#show_print{display:block;}
</style>
<style type="text/css" media="screen">
#show_print{display:none;}
</style>
<?php 
include("include/connect.php");
require_once('new_paginationx.php');
if(!empty($_GET['TGLREG'])){
	$tgl_reg = $_GET['TGLREG'];
  }else{
	$tgl_reg =date('Y/m/d');
  }
  if(!empty($_GET['poly'])){
	  $sspoly=" and e.kdpoly=".$_GET['poly'];
  }
  else {
	  $sspoly=" ";
  }
  if(!empty($_GET['kunj'])){
	  $kunbaru=$_GET['kunj']-1;
	  $sskun=" and pasienbaru=".$kunbaru;
  }
  else {
	  $sskun=" ";
  }
  if(!empty($_GET['shift'])){
	  $ssshif=" and shift=".$_GET['shift'];
  }
  else {
	  $ssshif=" ";
  }
  if(!empty($_GET['norm'])){
	  $nomr=" and A.NOMR='".$_GET['norm']."'";
  }
  else {
	  $nomr=" ";
  }
  if(!empty($_GET['nama'])){
	  $nama=" and A.NAMA like '%".$_GET['nama']."%'";
  }
  else {
	  $nama=" ";
  }
  
$sql="SELECT E.IDXDAFTAR,A.NOMR,A.NAMA,A.ALAMAT,B.NAMA AS POLY1,C.NAMA AS CARABAYAR1,D.NAMA AS RUJUKAN1, E.TGLREG,E.SHIFT,A.JENISKELAMIN, DR.NAMADOKTER,
			case PASIENBARU when 1 then 'B' else 'L' end as B_L,E.IDXDAFTAR,E.KDPOLY, E.NIP, RM.PENGIRIM, RM.PENERIMA, RM.PENERIMA_POLY,  case RM.STATUSRM when 0 then 'Lengkap' when 1 then 'Sementara' end as STATUSRM, RM.jam_kirim_rm,
T.ICD_CODE	
	      FROM m_pasien A, m_poly B, m_carabayar C, m_rujukan D, t_pendaftaran E 
		  LEFT JOIN t_rekammedik RM on RM.IDXDAFTAR= E.IDXDAFTAR
		  LEFT JOIN m_dokter DR on DR.KDDOKTER=E.KDDOKTER
		  LEFT JOIN t_diagnosadanterapi T on (E.IDXDAFTAR = T.IDXDAFTAR)
          WHERE A.NOMR=E.NOMR AND E.KDRUJUK=D.KODE AND E.KDCARABAYAR=C.KODE AND E.KDPOLY=B.KODE AND E.TGLREG='$tgl_reg' ".$sspoly.$sskun.$ssshif.$nomr.$nama;

$sqlcounter="SELECT count(E.IDXDAFTAR)
	      FROM m_pasien A, m_poly B, m_carabayar C, m_rujukan D, t_pendaftaran E
		  LEFT JOIN t_rekammedik RM on RM.IDXDAFTAR= E.IDXDAFTAR
		  LEFT JOIN m_dokter DR on DR.KDDOKTER=E.KDDOKTER
		  LEFT JOIN t_diagnosadanterapi T on (E.IDXDAFTAR = T.IDXDAFTAR)
          WHERE A.NOMR=E.NOMR AND E.KDRUJUK=D.KODE AND E.KDCARABAYAR=C.KODE AND E.KDPOLY=B.KODE AND E.TGLREG='$tgl_reg' ".$sspoly.$sskun.$ssshif.$nomr.$nama;
?>
<div id="show_print"></div>
<div align="center">
    <div id="frame" style="width:100%">
    <div id="frame_title">
      <h3>T R A C E R</h3></div>
    <div align="right" style="margin:5px;">
    <form name="cari" id="cari" method="get">  

    <table class="tb">
      <tr>
      <td align="right">Tanggal <input type="text" name="TGLREG"  id="TGLREG" readonly="readonly" class="text" style="width:95px;" 
		value="<?if($_REQUEST['TGLREG'] !=""): echo $_REQUEST['TGLREG']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar2')"><img align="top" src="img/date.png" border="0" /></a></td>
      <td align="right">Poly <select name="poly" id="poly" class="text" >
                <option></option>
             <? 
			 	$qrypoly = mysql_query("SELECT * FROM m_poly ORDER BY kode ASC")or die (mysql_error());
				while ($listpoly = mysql_fetch_array($qrypoly)){
			 ?>
                <option value="<? echo $listpoly['kode'];?>" <? if($_GET['poly']==$listpoly['kode']) echo "selected=selected";?>><? echo $listpoly['nama'];?></option>
			 <? }  ?>
             </select></td>
      </tr>
      <tr>
      <td align="right">Kunjungan <select name="kunj" id="kunj" class="text" >
             <option></option>
             <option value="1" <? if($_GET['kunj']=="1") echo "selected=selected";?>>LAMA</option>
             <option value="2" <? if($_GET['kunj']=="2") echo "selected=selected";?>>BARU</option>
             </select></td>
      <td align="right">Shift <select name="shift" id="shift" class="text" >
             <option></option>
             <option value="1" <? if($_GET['shift']=="1") echo "selected=selected";?>>I</option>
             <option value="2" <? if($_GET['shift']=="2") echo "selected=selected";?>>II</option>
             <option value="3" <? if($_GET['shift']=="3") echo "selected=selected";?>>III</option>
      </select></td>
      </tr>
      <tr>
      <td align="right">No RM <input type="text" name="norm" value="<?=$_GET['norm']?>" class="text" style="width:100px;"  /></td>
      <td align="right">Nama <input type="text" name="nama" value="<?=$_GET['nama']?>" class="text" style="width:100px;"/></td>
      </tr>
      <tr>
      <td align="right"></td>
      <td align="right"><input type="submit" value="C A R I" class="text"  />&nbsp;<a href="#" onClick="printIt()"><input type="button" class="text" value=" P R I N T "/></a>  </td>
      </tr>
    </table> 
        <input type="hidden" name="link" value="13"  />
         </form>
        
        <div id="change_icd"></div>
        
        <div id="list_tracer" align="left" style="display:none;" >
         </table>
   		<br />
        </div>
        
        <div id="cari_poly" align="center">
          <table width="99%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" class="tb" title="List Kunjungan Data Pasien Per Hari Ini">
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
              <th>Jam Kirim RM </th>
              <th>Pengirim</th>
              <th>Penerima di Poly</th>
              <th>Penerima</th>
              <th>Status</th>
              <th class="notprint">Print</th>
            </tr>
            <?

	           //die();
	           /*
	           $sql="SELECT E.IDXDAFTAR,A.NOMR,A.NAMA,A.ALAMAT,B.NAMA AS POLY1,C.NAMA AS CARABAYAR1,D.NAMA AS RUJUKAN1, E.TGLREG,E.SHIFT,A.JENISKELAMIN,
			case E.PASIENBARU when 1 then 'B' else 'L' end as B_L,E.IDXDAFTAR,E.KDPOLY, E.NIP,T.ICD_CODE, E.KETRUJUK, F.jam_kirim_rm
	      FROM m_pasien A, m_poly B, m_carabayar C, m_rujukan D, t_pendaftaran E

		  LEFT JOIN t_rekammedik RM on RM.IDXDAFTAR= E.IDXDAFTAR
		  LEFT JOIN m_dokter DR on DR.KDDOKTER=E.KDDOKTER
		  LEFT JOIN t_diagnosadanterapi T on (E.IDXDAFTAR = T.IDXDAFTAR)
          WHERE A.NOMR=E.NOMR AND E.KDRUJUK=D.KODE AND E.KDCARABAYAR=C.KODE AND E.KDPOLY=B.KODE AND E.TGLREG='$tgl_reg' ".$sspoly.$sskun.$ssshif.$nomr.$nama;
          */
          $sql="SELECT E.IDXDAFTAR,A.NOMR,A.NAMA,A.ALAMAT,B.NAMA AS POLY1,C.NAMA AS CARABAYAR1,D.NAMA AS RUJUKAN1,E.TGLREG,E.SHIFT,A.JENISKELAMIN, 
(select DR.NAMADOKTER from m_dokter DR where DR.KDDOKTER=E.KDDOKTER) as NAMADOKTER, case E.PASIENBARU when 1 then 'B' else 'L' end as B_L ,E.IDXDAFTAR,E.KDPOLY, 
E.NIP, (select distinct T.ICD_CODE	from t_diagnosadanterapi T where E.IDXDAFTAR = T.IDXDAFTAR) as ICD_CODE,E.KETRUJUK, F.jam_kirim_rm
 FROM m_pasien A, m_poly B, m_carabayar C, m_rujukan D, t_pendaftaran E
		  LEFT JOIN t_rekammedik F on E.IDXDAFTAR = F.idxdaftar
		  WHERE A.NOMR=E.NOMR AND E.KDRUJUK=D.KODE AND E.KDCARABAYAR=C.KODE and E.KDPOLY=B.KODE  AND E.TGLREG='$tgl_reg' ".$sspoly.$sskun.$ssshif.$nomr.$nama;
		$sqlcounter="SELECT COUNT(E.IDXDAFTAR) FROM m_pasien A, m_poly B, m_carabayar C, m_rujukan D, t_pendaftaran E WHERE A.NOMR=E.NOMR AND E.KDRUJUK=D.KODE AND E.KDCARABAYAR=C.KODE and E.KDPOLY=B.KODE AND E.TGLREG='$tgl_reg' ".$sspoly.$sskun.$ssshif.$nomr.$nama;  //echo $sql;
	$NO=0;
	$pager = new PS_Pagination($connect, $sql, $sqlcounter, 15, 10, "TGLREG=".$_GET['TGLREG']."&poly=".$_GET['poly']."&kunj=".$_GET['kunj']."&shift=".$_GET['shift']."&norm=".$_GET['norm']."&nama=".$_GET['nama'], "index.php?link=13&");
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	while($data = mysql_fetch_array($rs)) {
                $count++;
                if ($count % 2) {
                echo '<tr class="tr1">'; }
                else {
                echo '<tr class="tr2">';
              }
				$pengirim = "";
				$penerima = "";
				$penerima_poly = "";
				$statusrm = "";
				$lainlain	= '';
				$sql1 = "SELECT PENGIRIM, PENERIMA, PENERIMA_POLY, STATUSRM from t_rekammedik where idxdaftar='".$data['IDXDAFTAR']."'";
				$getresult = mysql_query($sql1)or die($sql1);
				while ($result = mysql_fetch_row($getresult)){
                   $pengirim = $result[0];
                   $penerima = $result[1];
                   $penerima_poly = $result[2];
                   $statusrm = $result[3];
                }
				#print_r($data);
				if($data['KETRUJUK'] != ''){
					$lainlain	= '( '.$data['KETRUJUK'].' )';
				}
        		?>
                <td><? $NO=($NO+1);if ($_GET['page']==0){$hal=0;}else{$hal=$_GET['page']-1;} echo ($hal*15)+$NO;?></td>
                <td><a href="index.php?link=132&idx=<? echo $data['IDXDAFTAR']; ?>"><? echo $data['NOMR'];?></a></td>
                <td><? echo $data['NAMA']; ?></td>
                <td><? echo $data['JENISKELAMIN']; ?></td>
                <td><? echo $data['ALAMAT']; ?></td>
                <td><? echo $data['POLY1']; ?></td>
                <td><? echo $data['NAMADOKTER']; ?></td>
                <td><? echo $data['CARABAYAR1'];?></td>
                <td><? echo $data['RUJUKAN1'].' '.$lainlain;?></td>
                <td><? echo $data['B_L'];?></td>
                <td><? echo $data['SHIFT'];?></td>
                <td><?php echo $data['jam_kirim_rm']; ?></td>
                <td><? echo $pengirim;?></td>
                <td><? echo $penerima_poly;?></td>
                <td><? echo $penerima;?></td>
                <td><? echo $statusrm;   //echo $sql1;?></td>
				<td><input type="button" name="print" value="Print" id="<?php echo $data['IDXDAFTAR']; ?>" svn="<?php echo $data['KDPOLY']; ?>" class="printrm text" /></td>
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
	# update version 1.2
			?>
        </div>
</div>
</div>
