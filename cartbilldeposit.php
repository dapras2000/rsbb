<?php 
include("include/connect.php");
require_once('ps_pagebill.php');

?>
<script>
jQuery(document).ready(function(){
	jQuery('.print').click(function(){
		var idadmission	= jQuery(this).attr('id');
		jQuery.get('<?php echo _BASE_; ?>print_deposit.php?id_admission='+idadmission,function(data){
			jQuery('#tmp_print').empty().html(data);
			w=window.open();
			//w.document.write(jQuery('#show_print').html());
			w.document.write(jQuery('#tmp_print').html());
			w.print();
			jQuery('#tmp_print').empty();
			w.close();
			//jQuery('#show_print').empty();
		});
	});
});
</script>
<div id="tmp_print" style="display:none;"></div>
<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>TAGIHAN DEPOSIT RAWAT INAP</h3></div>
      <form name="cari" id="cari" method="get">  
             List Berdasarkan <select name="poly" id="poly" class="text" >
               <option value="0">-Pilih ruang-</option>
             <? 
			 	
			 	$qrypoly = mysql_query("SELECT * FROM m_ruang ORDER BY no ASC")or die (mysql_error());
				while ($ruang = mysql_fetch_array($qrypoly)){
					if($_GET['poly'] == $ruang['no']): $sel = 'selected="selected"'; else: $sel=''; endif;
			 ?>
                <option value="<? echo $ruang['no']; ?>" <?php echo $sel;?> ><? echo $ruang['nama']; ?></option>
			 <? } ?>
             </select>
      <select name="crbayar" id="crbayar" class="text" >
             <option value="0">-Pilih Cara Bayar-</option>
             <option value="1">UMUM</option>
             <option value="2">BPJS</option>
            <!-- <option value="3">JAMKESMAS</option>
             <option value="4">SKTM</option>-->
        </select>
      <input type="hidden" name="link" value="37" />
<input type="submit" class="text" value="Cari" />

    </form>     
        <div id="cari_poly">
          <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="Tagihan Data Pasien Per Hari Ini">
            <tr align="center">
            <th width="3%">NO </th>
              <th width="10%">NO RM</th>
              <th width="13%">Tanggal Masuk</th>
              <th width="13%">Nama Pasien</th>
              <th width="8%">Ruang</th>
              <th width="12%">No Tempat Tidur</th>
              <th width="12%">Cara Bayar</th>
              <th width="14%">Deposit</th>
              <th width="14%">Aksi</th>
            </tr>
            <?
$kondisi='';			
if ($_GET['poly']!=0){
	$kpoly=' and E.noruang = '.$_GET['poly'];
}
if ($_GET['crbayar']!=0){
	$kbyr=' and E.statusbayar = '.$_GET['crbayar'];
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

$kondisi=$kpoly.$kbyr;
  $sql="SELECT A.NOMR,A.NAMA,B.NAMA AS RUANG,C.NAMA AS CARABAYAR1,SUM(r.TOTTARIFRS) AS TOTTARIFRS, E.id_admission, E.deposit, E.nott, E.masukrs,r.NOBILL
	      FROM t_admission E
	      INNER JOIN m_pasien A ON E.nomr=A.nomr 
	      INNER JOIN t_bayarranap r ON r.IDXDAFTAR=E.id_admission 
	      INNER JOIN m_ruang B ON E.noruang=B.no 
	      INNER JOIN m_carabayar C ON E.statusbayar=C.KODE 
WHERE (E.keluarrs IS NULL ) AND E.deposit > 0 ".$kondisi."      
GROUP BY E.id_admission";	
$NO=0;

	$pager = new PS_Pagebill($connect, $sql, 15, 5, "poly=".$_GET['poly']."&crbayar=".$_GET['crbayar'],"index.php?link=37&");
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
              <td><? echo $data['masukrs']; ?></td>
              <td><? echo $data['NAMA']; ?></td>
            <td><? echo $data['RUANG']; ?></td>
            <td><? echo $data['nott']; ?></td>
              <td><? echo $data['CARABAYAR1'];?></td>
              <td><? echo curformat($data['deposit']);?></td>
              <td><input type="button" name="print" value="Print" id="<?php echo $data['id_admission'];?>" class="print text" /></td>
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