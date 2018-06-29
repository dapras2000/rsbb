<?php
include("../include/connect.php");
include("inc/function.php");

$ip = getRealIpAddr();
$nip = $_SESSION['NIP'];

$sql = "SELECT 
		  m_barang_group.nama_group,
		  m_barang_group.nama_farmasi,
		  m_barang.kode_barang,
		  m_barang.no_batch,
		  DATE_FORMAT(m_barang.expiry, '%d -%m -%Y') AS expiry,
		  m_barang.nama_barang,
		  m_barang.satuan,
		  m_barang.harga,
		  temp_cartapotek_permintaan.QTY,
		  temp_cartapotek_permintaan.ATURAN,
		  temp_cartapotek_permintaan.KDUNIT,
		  temp_cartapotek_permintaan.NIP,
		  temp_cartapotek_permintaan.IP,
		  temp_cartapotek_permintaan.IDXBARANG,
		  temp_cartapotek_permintaan.non_generik,
		  temp_cartapotek_permintaan.nama_generik
		FROM
		  temp_cartapotek_permintaan
		  LEFT JOIN m_barang ON (m_barang.kode_barang = temp_cartapotek_permintaan.KDBARANG)
		  LEFT JOIN m_barang_group ON (m_barang.group_barang = m_barang_group.group_barang)
		  AND (m_barang.farmasi = m_barang_group.farmasi)	  
		WHERE temp_cartapotek_permintaan.IP = '$ip'";

if(!empty($_POST['non_generik'])){
 $kd_barang = "-";
 $non_generik = "1";
 $nama_generik = $_POST['nm_barang'];
}else{
 $kd_barang = $_POST['kd_barang'];
 $non_generik = "";
 $nama_generik = "";
}

if(!empty($_POST['obat_luar'])){
	$obat_luar = "1";
}else{
	$obat_luar = "0";
}


if(empty($_GET['optbarang'])){
	if(empty($_POST['IDXRESEP']) || empty($_POST['tgl'])
		|| empty($_POST['nm_barang']) || empty($_POST['jml_permintaan']) 
		|| empty($kd_barang) || empty($_POST['aturan'])){
		
		echo "<fieldset class='fieldset'>";
        echo "<legend>Error</legend>";
		echo "Isian Belum Lengkap"; 
		echo "</fieldset>";
	
	}else{
			
		$idxresep = $_POST['IDXRESEP'];
		$tgl = $_POST['tgl'];
		$jml_permintaan = $_POST['jml_permintaan'];
		$tgl_pesan = $_POST['tglpesan'];
		$aturan = $_POST['aturan'];
		$nip = $_POST['NIP'];
		$kdunit = $_POST['KDUNIT'];
		
		@mysql_query("INSERT INTO temp_cartapotek_permintaan (IDXRESEP,
					  KDBARANG, QTY, IP, NIP, KDUNIT, ATURAN, tgl_keluar, non_generik, nama_generik, obat_luar) 
					  VALUES ('$idxresep', '$kd_barang', $jml_permintaan, '$ip', '$nip', '$kdunit', '$aturan', '$tgl',
							  '$non_generik', '$nama_generik', '$obat_luar')");
		}
}else{
	$idxbarang = $_GET['optbarang'];
	@mysql_query("DELETE FROM temp_cartapotek_permintaan WHERE IDXBARANG = $idxbarang");
}
$row = mysql_query($sql)or die(mysql_error());
if(mysql_num_rows($row) > 0){
?>
<fieldset class="fieldset">
      <legend>Daftar Obat</legend>
   <table class="tb">
      <tr>
         <th>No</th>
         <th>Kode Obat</th>
         <th>Nama Obat</th>
         <th>No Batch</th>
         <th>Tgl Kadaluarsa</th>
          <th>Jumlah</th>
         <th>Satuan</th>
         <th>Aturan Minum</th>
         <th>Pilihan</th>
      </tr>
<?php
	  $i = 1;
	  while($data = mysql_fetch_array($row)){
?>
       <tr>
         <td><?=$i?></td>
<? 
if($data['non_generik']!="1"){
	$kode_barang = $data['kode_barang'];
	$nama_barang = $data['nama_barang'];
}else{
    $kode_barang = "Non Generik";
	$nama_barang = $data['nama_generik'];
}
?>         
         
         <td><?=$kode_barang?></td>
         <td><?=$nama_barang?></td>
         <td><?=$data['no_batch']?></td>
         <td><?=$data['expiry']?></td>
         <td align="right"><?=$data['QTY']?></td>
         <td><?=$data['satuan']?></td>
         <td><?=$data['ATURAN']?></td>
         <td><a href="#" onclick="javascript: MyAjaxRequest('validbarang','apotek/addobatresep.php?optbarang=<?=$data['IDXBARANG']?>'); return false;" >Hapus</a></td>
      </tr>
<?php $i++; } ?>      
   </table>
   <form name="savebarang" id="savebarang" action="apotek/saveobatresep.php" method="post" >
   <input type="hidden" name="IDXRESEP" value="<?=$idxresep?>" />
   <input class="text" type="submit" value="S i m p a n" onclick="submitform (document.getElementById('savebarang'),'apotek/saveobatresep.php','validbarang',validatetask); 
   window.location='<?php echo _BASE_;?>index.php?link=10';
   return false;"/>
   </form>
</fieldset>   
 <? } ?>
