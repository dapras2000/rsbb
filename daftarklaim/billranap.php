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
             <option value="0">-Pilih Cara Bayar-</option>
             <?php
			 $s	= mysql_query('select * from m_carabayar where kode > 1 order by orders');
			 while($ds	= mysql_fetch_array($s)){
				 if($_GET['crbayar'] == $ds['KODE']): $sel = 'selected="selected"'; else: $sel = '';endif;
				 echo '<option value="'.$ds['KODE'].'" '.$sel.'>'.$ds['NAMA'].'</option>';
			 }
			 ?>
           </select>
      <input type="hidden" name="link" value="33a_asuransi" />
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
              <th style="width:80px;">Tarif</th>
              <th style="width:100px;">Aksi</th>
            </tr>
            <?
$kondisi='';			
if ($_GET['cruang']!=0){
	$kruang=' and c.noruang = '.$_GET['cruang'];
}
if ($_GET['crbayar']!=0){
	$kbyr=' and a.CARABAYAR = '.$_GET['crbayar'];
}
if ($_GET['cnama']!=""){
	$knama=" and b.NAMA like '%".$_GET['cnama']."%'";
}
if ($_GET['cnomr']!=0){
	$knomr=" and b.NOMR = '".$_GET['cnomr']."'";
}
$start	= 'CURDATE()';
$end	= 'CURDATE()';
if ($_GET['start']!=""){
	$start 	= "'".$_REQUEST['start']."'";
}
if ($_GET['end']!=""){
	$end 	= "'".$_REQUEST['end']."'";
}
$waktu	= ' and (r.tanggal between '.$start.' and '.$end.')';

$kondisi=$knama.$knomr.$kruang.$kbyr;
#			AND TGLBAYAR is null
	/*
	$sql="SELECT A.NOMR,A.NAMA,B.NAMA AS RUANG,C.NAMA AS CARABAYAR1,sum(R.TOTTARIFRS) as TOTTARIFRS, E.id_admission, E.masukrs, E.keluarrs, E.noruang, E.nott, R.NOBILL, R.TGLBAYAR,R.NOBILL
	      FROM t_bayarranap R, m_pasien A, m_ruang B, m_carabayar C, t_admission E
          WHERE r.IDXDAFTAR=E.id_admission AND A.NOMR=R.NOMR AND E.noruang=B.no AND R.CARABAYAR=C.KODE and (E.keluarrs IS NULL ) 
                 ".$kondisi." 
group by R.NOBILL, A.NOMR,A.NAMA,B.NAMA ,C.NAMA,E.id_admission";
	*/
$sql = 'SELECT a.NOMR, b.NAMA, c.noruang, d.nama AS RUANG, SUM(a.TARIFRS * a.QTY) AS TOTTARIFRS, c.id_admission, c.masukrs, c.nott, a.NOBILL, e.NAMA AS CARABAYAR1, f.TGLBAYAR
FROM t_billranap a
JOIN m_pasien b ON a.NOMR = b.NOMR
JOIN t_admission c ON a.IDXDAFTAR = c.id_admission
JOIN m_ruang d ON d.no = c.noruang
JOIN m_carabayar e ON e.KODE = c.statusbayar
JOIN t_bayarranap f ON f.NOBILL = a.NOBILL
WHERE c.keluarrs IS NULL and a.CARABAYAR > 1 '.$kondisi.'
GROUP BY a.NOBILL';
$NO=0;

	$pager = new PS_Pagebill($connect, $sql, 15, 5, "&cruang=".$_GET['cruang']. "&cnama=".$_GET['nama']. "&cnomr=".$_GET['cnomr']."&crbayar=".$_GET['crbayar'],"index.php?link=33a_asuransi");
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
              <td style="text-align:right;"><? echo curformat($data['TOTTARIFRS']);?></td>
              <td>
              <?php if( ($data['TGLBAYAR'] == '0000-00-00') or ($data['TGLBAYAR'] == '') ): ?>
              <a href="index.php?link=34a&idxb=<? echo $data['id_admission'];?>&nobill=<?php echo $data['NOBILL'];?>&t=<? echo $data['TOTTARIFRS']; ?>"><input type="button" class="text" name="simpan" value="Proses" /></a>
              <?php else: ?>
              <input type="button" class="text print" name="simpan" value="PRINT" svn="<?php echo $data['NOMR'];?>" rel="<? echo $data['NOBILL'];?>" />
              <?php endif;?>
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