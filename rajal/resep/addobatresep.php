<?php session_start();
include("../../include/connect.php");
include("../../include/function.php");

#print_r($_REQUEST);
#exit;
$ip = getRealIpAddr();
$nip = $_SESSION['NIP'];
if(!empty($_POST['txtIdxDaftar'])){
	$idxdaftar = $_POST['txtIdxDaftar'];

	}else{
	$idxdaftar = $_GET['idx'];
	
}

$sql = "SELECT tmp_cartresep.IDXOBAT, tmp_cartresep.NAMA_OBAT, tmp_cartresep.SEDIAAN, tmp_cartresep.ATURAN_PAKAI, tmp_cartresep.JUMLAH FROM tmp_cartresep WHERE tmp_cartresep.IP = '$ip'";

if(empty($_GET['optbarang'])){
	if(empty($_POST['nm_barang']) || empty($_POST['jml_permintaan'])){
		
		echo "<fieldset class='fieldset'>";
        echo "<legend>Error</legend>";
		echo "Isian Belum Lengkap"; 
		echo "</legend>";
	
	}else{
			
		$nama_obat 	= $_POST['nm_barang'];
		$sediaan 	= $_POST['sediaan'];
		$aturan 	= $_POST['aturan'];
		$jumlah 	= $_POST['jml_permintaan'];
		
		@mysql_query("INSERT INTO tmp_cartresep(NAMA_OBAT, SEDIAAN, ATURAN_PAKAI, JUMLAH, IP) VALUES('".$nama_obat."', '".$sediaan."', '".$aturan."', '".$jumlah."', '".$ip."')");
		}
}else{
	$idxbarang = $_GET['optbarang'];
	@mysql_query("DELETE FROM tmp_cartresep WHERE IDXOBAT = $idxbarang");
}
$row = mysql_query($sql)or die(mysql_error());
if(mysql_num_rows($row) > 0){
?>
<fieldset class="fieldset">
      <legend>Daftar Obat</legend>
   <table class="tb">
      <tr>
         <th>No</th>
         <th>Nama Obat</th>
         <th>Sediaan</th>
         <th>Aturan Minum</th>
         <th>Jumlah</th>
         <th>&nbsp;</th>
      </tr>
<?php
	  $i = 1;
	  while($data = mysql_fetch_array($row)){
?>
       <tr>
         <td><?=$i?></td>
         <td><?=$data['NAMA_OBAT']?></td>
         <td><?=$data['SEDIAAN']?></td>
         <td><?=$data['ATURAN_PAKAI']?></td>
         <td><?=$data['JUMLAH']?></td>
         <td><a href="#" onclick="javascript: MyAjaxRequest('validbarang','rajal/resep/addobatresep.php?optbarang=<?=$data['IDXOBAT']?>&idx=<?=$idxdaftar?>'); return false;" >Batal</a></td>
      </tr>
<?php $i++; } ?>      
   </table>
<? 
$sql_daftar = "SELECT t_pendaftaran.NOMR, t_pendaftaran.KDDOKTER, t_pendaftaran.KDPOLY
				FROM t_pendaftaran WHERE   t_pendaftaran.IDXDAFTAR = ".$idxdaftar;
$get_daftar = mysql_query($sql_daftar);				
$dat_daftar = mysql_fetch_assoc($get_daftar); 
?>   
   

   <form name="savebarang" id="savebarang" action="rajal/resep/saveobatresep.php" method="post" >
   <input name="txtNoMR" id="txtNoMR" type="hidden" value=<?php echo $dat_daftar['NOMR']?> >
   <input name="txtIdxDaftar" id="txtIdxDaftar" type="hidden" value=<?php echo $idxdaftar; ?> >
   <input name="txtKdPoly" id="txtKdPoly" type="hidden" value=<?php echo $dat_daftar['KDPOLY']?> >
   <input name="txtKdDokter" id="txtKdDokter" type="hidden" value=<?php echo $dat_daftar['KDDOKTER']?> >
   <input name="txtNip" id="txtNip" type="hidden" value=<?php echo $_SESSION['NIP'];?> >
   <input class="text" type="submit" value="S i m p a n" />
   </form>
</fieldset>   
 <? } ?>
