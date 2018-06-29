<?php 
include("include/connect.php");
require_once('ps_pagebill.php');

?>
<script>
jQuery(document).ready(function(){
	jQuery('.print').click(function(){
		var nomr	= jQuery(this).attr('svn');
		var idxbayar	= jQuery(this).attr('rel');
		jQuery.get('<?php echo _BASE_; ?>print_pembayaran_ranap.php?nobill='+idxbayar+'&nomr='+nomr,function(data){
			jQuery('#tmp_print').empty().html(data);
			w=window.open();
			//w.document.write(jQuery('#show_print').html());
			w.document.write(jQuery('#tmp_print').html());
			w.print();
			w.close();
			//jQuery('#show_print').empty();
		});
	});
});
</script>

<style type="text/css" media="screen">
#tmp_print{display:none;}
</style>
<style type="text/css" media="print">
#tmp_print{display:block;}
</style>

<div id="tmp_print"></div>
<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>TAGIHAN RAWAT INAP/ HARI INI</h3></div>
      <form name="cari" id="cari" method="get">
        cari nama
        <input type="text" name="cnama" class="text"/>
        / No MR
        <input type="text" name="cnomr" size="10" class="text"/>
        Berdasarkan
		<select name="cruang" id="cruang" class="text" >
   		<option value="0">-Pilih ruang-</option>
             <? 
			 	$qrypoly = mysql_query("SELECT * FROM m_ruang ORDER BY no ASC")or die (mysql_error());
				while ($ruang = mysql_fetch_array($qrypoly)){
			 ?>
                <option value="<? echo $ruang['no']; ?>"><? echo $ruang['nama']; ?></option>
			 <? } ?>
             </select> 
      <select name="crbayar" id="crbayar" class="text" >
             <option value="">-Pilih Cara Bayar-</option>
             <?$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
			  while($ds = mysql_fetch_array($ss)){
				echo '<option value="'.$ds['KODE'].'" > '.$ds['NAMA'].' </option>';
			  }?>
           </select>

		   <?php 
		   $tgl1 = date('Y/m/d');// pendefinisian tanggal awal
		   $tgl2 = date('Y/m/d', strtotime('+1 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
		   
		   ?>
      <input type="hidden" name="link" value="33a" />
      <input type="text" size="10" class="text" id="TGLREG" name="start" value="<?php if($_REQUEST['start'] != ''): echo $_REQUEST['start']; else: echo date('Y/m/d'); endif;?>" /><a href="javascript:showCal('Calendar2')"><img align="top" src="img/date.png" border="0" /></a> - 
      <input type="text" size="10" class="text" id="TGLREG2" name="end" value="<?php if($_REQUEST['end'] != ''): echo $_REQUEST['end']; else: echo $tgl2; endif;?>" /><a href="javascript:showCal('Calendar15')"><img align="top" src="img/date.png" border="0" /></a>
<input type="submit" class="text" value="Cari" />

    </form>     
        <div id="cari_poly">
          <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="Tagihan Data Pasien Per Hari Ini">
            <tr align="center">
            <th style="width:20px;">NO </th>
              <th style="width:60px;">NO RM</th>
              <th>Nama Pasien</th>
              <th style="width:100px;">Ruang</th>
              <th style="width:50px;">No Tempat Tidur</th>
              <th style="width:80px;">Tanggal Masuk</th>
              <th style="width:80px;">Tanggal Keluar</th>
              <th style="width:50px;">Cara Bayar</th>
              <th style="width:100px;">Aksi</th>
            </tr>
            <?
$kondisi='';
$kbyr	= ' ';
if ($_GET['cruang']!=0){
	$kruang=' and c.noruang = '.$_GET['cruang'];
}
if ($_GET['crbayar']!=''){
	$kbyr=' and e.KODE = '.$_GET['crbayar'];
}
if ($_GET['cnama']!=""){
	$knama=" and b.NAMA like '%".$_GET['cnama']."%'";
}
if ($_GET['cnomr']!=0){
	$knomr=" and a.NOMR = '".$_GET['cnomr']."'";
}
$start	= $tgl1;
$ende	= $tgl2;
$end = (int)$ende + 1;
if ($_GET['start']!=""){
	$start 	= "'".$_REQUEST['start']."'";
}
if ($_GET['end']!=""){
	$end 	= "'".$_REQUEST['end']."'";
}
$waktu	= ' and (c.masukrs between '.$start.' and '.$end.')';

$kondisi=$knama.$knomr.$kruang.$kbyr.$waktu;
// and (c.masukrs between CURDATE() and CURDATE())
#			AND TGLBAYAR is null
/*
$sql="SELECT a.NOMR, b.NAMA, d.nama AS RUANG, e.NAMA AS CARABAYAR1, SUM(a.TARIFRS) AS TOTTARIFRS,
c.id_admission,c.masukrs,c.keluarrs,c.noruang,c.nott,a.NOBILL
FROM t_billranap a
JOIN m_pasien b ON a.nomr = b.nomr 
JOIN t_admission c ON a.IDXDAFTAR = c.id_admission
JOIN m_ruang d ON c.noruang = d.no
JOIN m_carabayar e ON c.statusbayar = e.KODE
WHERE a.KODETARIF NOT LIKE '07%' AND c.keluarrs IS NULL 
".$kondisi." 
group by a.NOBILL, a.NOMR,d.NAMA,b.NAMA ,e.NAMA,c.id_admission";
*/
$sql = "SELECT a.NOMR, b.NAMA, d.nama AS RUANG, e.NAMA AS CARABAYAR1, SUM(a.TARIFRS * a.QTY) AS TOTTARIFRS,
c.id_admission,c.masukrs,c.keluarrs,c.noruang,c.nott,a.NOBILL, h.TGLBAYAR
FROM t_billranap a
JOIN t_bayarranap h on h.NOBILL = a.NOBILL
JOIN m_pasien b ON a.nomr = b.nomr 
JOIN t_admission c ON a.IDXDAFTAR = c.id_admission
JOIN m_ruang d ON c.noruang = d.no
JOIN m_carabayar e ON c.statusbayar = e.KODE
WHERE  a.KODETARIF NOT LIKE '07%' and c.keluarrs IS NULL and h.TOTTARIFRS != '0'

".$kondisi." 
GROUP BY a.NOMR,d.NAMA,b.NAMA,e.NAMA,c.id_admission";
$NO=0;
// echo $waktu;
// echo "</br>";
// echo $sql;
	$pager = new PS_Pagebill($connect, $sql, 15, 5, "&cruang=".$_GET['cruang']. "&cnama=".$_GET['nama']. "&cnomr=".$_GET['cnomr']."&crbayar=".$_GET['crbayar'],"index.php?link=33a");
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
              <td><? #print_r($data);
			  
			  $NO=($NO+1);if ($_GET['page']==0){$hal=0;}else{$hal=$_GET['page']-1;} echo ($hal*15)+$NO;?></td>
             

              <td><? echo $data['NOMR'];?></a></td>
              <td><? echo $data['NAMA']; ?></td>
            <td><? echo $data['RUANG']; ?></td>
            <td><? echo $data['nott']; ?></td>
            <td><? echo $data['masukrs']; ?></td>
            <td><? echo $data['keluarrs']; ?></td>
              <td><? echo $data['CARABAYAR1'];?></td>
              <td align="center">
          	  
              <a href="index.php?link=33a2&idxb=<? echo $data['id_admission'];?>&nomr=<? echo $data['NOMR'];?>"><input type="button" class="text" name="simpan" value="DETAIL" /></a>
			 <br><br> <a href="index.php?link=31s3&nomr=<?=$data['NOMR'];?>&idx=<?php echo $data['id_admission']; ?>"><input type="button" class="text" name="simpan" value="REKAP BILL" /></a>
			  
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