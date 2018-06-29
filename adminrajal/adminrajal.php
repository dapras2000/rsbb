<?php 
include("../include/connect.php");
require_once('ps_pagebill.php');
unset($_SESSION['kdpoly']);
?>

<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>DAFTAR PASIEN RAWAT JALAN HARI INI</h3></div>
      <form name="cari" id="cari" method="get" action="<?php $_SERVER['PHP_SELF']; ?>">
        cari nama
        <input type="text" name="cnama" class="text"/>
        / No MR 
        <input type="text" name="cnomr" size="10" class="text"/> 
        Berdasarkan
        <select name="poly" id="poly" class="text" >
        <option value="0">-Pilih Poly-</option>
             <? 
			 	$qrypoly = mysql_query("SELECT * FROM m_poly where kode != 9 and kode != 10 ORDER BY kode ASC")or die (mysql_error());
				while ($listpoly = mysql_fetch_array($qrypoly)){
			 	?>
                <option value="<? echo $listpoly['kode'];?>" <?php if($listpoly['kode'] == $_REQUEST['poly']): echo 'selected="selected"'; endif;?>><? echo $listpoly['nama'];?></option>
			 <? } ?>
        </select>
       <select name="crbayar" id="crbayar" class="text" >
             <option value="0">-Pilih Cara Bayar-</option>
             <option value="1">UMUM</option>
             <option value="2">BPJS</option>
             <!--<option value="3">JAMKESMAS</option>
				 <option value="4">SKTM</option>-->
        </select>
      <input type="hidden" name="link" value="adminrajal" />
      
      <input type="text" size="10" class="text" id="start" name="start" value="<?php if($_REQUEST['start'] != ''): echo $_REQUEST['start']; else: echo date('Y/m/d'); endif;?>" /><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a> - 
      <input type="text" size="10" class="text" id="end" name="end" value="<?php if($_REQUEST['end'] != ''): echo $_REQUEST['end']; else: echo date('Y/m/d'); endif;?>" /><a href="javascript:showCal('Calendar12')"><img align="top" src="img/date.png" border="0" /></a>
      <input type="submit" class="text" value="Cari" />

    </form>     
        <div id="cari_poly">
          <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="0" cellspading="0" title="Tagihan Data Pasien Per Hari Ini">
			<tr align="center"><th width="20px">NO</th><th width="100px">NO RM</th><th style="text-align:left;">Nama Pasien</th><th width="100px">Poly</th><th width="100px">Cara Bayar</th><th width="50px">Keterangan</th><th width="160px">Aksi</th></tr>
            <?
$kondisi='';
if ($_GET['poly']!= 0){
	$kpoly=' and t_pendaftaran.KDPOLY = '.$_GET['poly'];
}
if ($_GET['crbayar']!= 0){
	$kbyr=' and t_pendaftaran.KDCARABAYAR = '.$_GET['crbayar'];
}
if ($_GET['cnama']!=""){
	$knama=" and m_pasien.NAMA like '%".$_GET['cnama']."%'";
}
if ($_GET['cnomr']!=""){
	$knomr=" and t_pendaftaran.NOMR = '".$_GET['cnomr']."'";
}
$start	= 'CURDATE()';
$end	= 'CURDATE()';
if ($_GET['start']!=""){
	$start 	= "'".$_REQUEST['start']."'";
}
if ($_GET['end']!=""){
	$end 	= "'".$_REQUEST['end']."'";
}
$waktu	= ' and (t_pendaftaran.TGLREG between '.$start.' and '.$end.')';
$kondisi=$knama.$knomr.$kpoly.$kbyr.$waktu;
	$sql	= 	'select DISTINCT t_pendaftaran.NOMR, t_pendaftaran.IDXDAFTAR, m_pasien.NAMA, 
				t_pendaftaran.KDPOLY, m_poly.nama as nama_poly, m_carabayar.NAMA as carabayar 
				from t_pendaftaran 
				join m_pasien ON t_pendaftaran.NOMR = m_pasien.NOMR 
				join m_poly ON m_poly.kode = t_pendaftaran.KDPOLY 
				join m_carabayar ON m_carabayar.KODE = t_pendaftaran.KDCARABAYAR
				join t_bayarrajal on t_bayarrajal.IDXDAFTAR = t_pendaftaran.IDXDAFTAR
				where (t_pendaftaran.KDPOLY != "9" and t_pendaftaran.KDPOLY != "10")'.$kondisi;
	$NO=0;
	$pager = new PS_Pagebill($connect, $sql, 15, 5, "start=".$_REQUEST['start']."&end=".$_REQUEST['end']."&poly=".$_GET['poly']."&cnama=".$_GET['cnama']."&cnomr=".$_GET['cnomr']."&crbayar=".$_GET['crbayar'],"index.php?link=adminrajal&");
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	while($data = mysql_fetch_array($rs)) {
		$sqll = 'SELECT STATUS FROM t_pendaftaran WHERE NOMR = "'.$data['NOMR'].'" AND IDXDAFTAR = "'.$data['IDXDAFTAR'].'"';
		$sqll = mysql_query($sqll);
		$qrtl = mysql_fetch_array($sqll);
		if($qrtl['STATUS'] > 0):	
			$status_plng = "Pulang";
		else:
			$status_plng = '';
		endif;
				#print_r($cex);
                $count++;
                if ($count % 2){
                	echo '<tr class="tr1">'; 
				}else {
                	echo '<tr class="tr2">';
                }
        ?>
              <td align="center"><? $NO=($NO+1);if ($_GET['page']==0){$hal=0;}else{$hal=$_GET['page']-1;} echo ($hal*15)+$NO;?></td>
              <td align="center"><? echo $data['NOMR'];?></td>
              <td align="left"><? echo $data['NAMA']; ?></td>
              <td align="center"><? echo $data['nama_poly']; ?></td>
              <td align="center"><? echo $data['carabayar'];?></td>
              <!--<td align="right"><?php echo curformat($cex['total'],2);?></td>-->
              <td align="center"><?php echo $status_plng;?></td>
              <td align="center">
              <!--<a href="index.php?link=34&nomr=<?php echo $data['NOMR']; ?>&poly=<?php echo $data['KDPOLY'];?>&idxdaftar=<?php echo $data['IDXDAFTAR']; ?>"> <input type="button" class="text" value="Prosess" /></a> -->
              <?php if ($status_plng<>'Pulang'){?>
              
              <input type="button" class="text" value="Batal" onclick="batal(<?php echo $data['IDXDAFTAR']; ?>);" />
              <?php }?>
              <a href="index.php?link=51&nomr=<?php echo $data['NOMR']; ?>&poly=<?php echo $data['KDPOLY'];?>&idx=<?php echo $data['IDXDAFTAR']; ?>"> <input type="button" class="text" value="Prosess" /></a>

              
              <!--<a href="index.php?link=adminrajal_diagnosis&idxdaftar=<? echo $data['IDXDAFTAR'];?>"><input type="button" class="text" value="Diagnosis" /></a>--></td>
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
<script type="text/javascript">
	function batal(x){
		
        //alert(x);
        //return false();
        //var m = $(this).attr("id");  
        //var w = window.open('../file/print/suratkeluar_print.php?id='+m,'_blank');
        //var w = window.open('index.php?cnama=&cnomr=&poly=0&crbayar=0&link=adminrajal&start=2018%2F03%2F04&end=2018%2F04%2F04');
        self.location.href='adminrajal/batal_rajal.php?idx='+x;
                              
	}
</script>
