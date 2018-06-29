<?php
include("../include/connect.php");
include("inc/function.php");

$ip = getRealIpAddr();
$sql = "SELECT 
			  temp_cartbarang_penerimaan.IDXBARANG,
			  temp_cartbarang_penerimaan.kodebarang,
			  m_barang.nama_barang,
			  m_barang.satuan,
			  temp_cartbarang_penerimaan.jmlterima,
			  temp_cartbarang_penerimaan.GROUPBARANG
			FROM
			  temp_cartbarang_penerimaan
			  INNER JOIN m_barang ON (temp_cartbarang_penerimaan.kodebarang = m_barang.kode_barang)
			WHERE temp_cartbarang_penerimaan.IP = '$ip' AND  temp_cartbarang_penerimaan.KATEGORY = 'L'";

if(empty($_GET['optbarang'])){
	if(empty($_POST['nobatch']) || empty($_POST['nmsuplier'])
		|| empty($_POST['jns']) || empty($_POST['tglterima']) 
		|| empty($_POST['nm_barang'])
		|| empty($_POST['kd_barang']) || empty($_POST['jml_barang'])){
		
		echo "<fieldset class='fieldset'>";
        echo "<legend>Error</legend>";
		echo "Isian Belum Lengkap"; 
		echo "</legend>";
	
	}else{
			
		$no = $_POST['nobatch'];
		$suplier = $_POST['nmsuplier'];
		$jns = $_POST['jns'];
		$tgl_terima = $_POST['tglterima'];
		$kd_barang = $_POST['kd_barang'];
		$jml_terima = $_POST['jml_barang'];
		$kategori = 'L';
		$grp =  $_POST['grpbarang'];
		$nip = $_SESSION['NIP'];
		
		@mysql_query("INSERT INTO temp_cartbarang_penerimaan (NO, NIP, kodebarang,
						  pengirim, tglterima, jmlterima, terimadari, KATEGORY,
						  GROUPBARANG, IP) 
					VALUES ('$no', '$nip', '$kd_barang', '$suplier', '$tgl_terima', $jml_terima,
							'$jns', '$kategori', '$grp', '$ip')");
		}
}else{
	$idxbarang = $_GET['optbarang'];
	@mysql_query("DELETE FROM temp_cartbarang_penerimaan WHERE IDXBARANG = $idxbarang");
}
$row = mysql_query($sql)or die(mysql_error());
if(mysql_num_rows($row) > 0){
?>
<fieldset class="fieldset">
      <legend>Daftar Penerimaan</legend>
   <table class="tb">
      <tr>
         <th>No</th>
         <th>Kode Barang</th>
         <th>Nama Barang</th>
         <th>Jumlah</th>
         <th>Satuan</th>
         <th>Group</th>
         <th>Pilihan</th>
      </tr>
<?php
	  $i = 1;
	  while($data = mysql_fetch_array($row)){
?>
       <tr>
         <td><?=$i?></td>
         <td><?=$data['kodebarang']?></td>
         <td><?=$data['nama_barang']?></td>
         <td><?=$data['jmlterima']?></td>
         <td><?=$data['satuan']?></td>
         <td><? switch($data['GROUPBARANG']){
					case "1" :
						echo "ATK";
						break;
					case "2" :
						echo "Cetakan";
						break;
					case "3" :
						echo "ART";
						break;
					case "4" :
						echo "Alat Bersih dan Pembersih";
						break;
					case "5" :
						echo "Lain - Lain";
						break;	
				}?></td>
         <td><a href="#" onclick="javascript: MyAjaxRequest('validbarang','logistik/addbarangpenerimaan.php?optbarang=<?=$data['IDXBARANG']?>'); return false;" >Hapus</a></td>
      </tr>
<?php } ?>      
   </table>
   <form name="savebarang" id="savebarang" action="logistik/saveorderbarangpenerimaan.php" method="post" >
   <input class="text" type="submit" value="S i m p a n" onclick="submitform (document.getElementById('savebarang'),'logistik/saveorderbarangpenerimaan.php','validbarang',validatetask); return false;"/>
   </form>
</fieldset>   
 <? } ?>
