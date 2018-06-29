<?php
include("../include/connect.php");
include("../rajal/inc/function.php");

$ip = getRealIpAddr();
$sql = "SELECT 
		  m_barang_group.nama_group,
		  m_barang_group.nama_farmasi,
		  m_barang.kode_barang,
		  m_barang.nama_barang,
		  m_barang.satuan,
		  temp_cartbarang_penerimaan.IDXBARANG,
		  m_barang.no_batch,
		  DATE_FORMAT(m_barang.expiry, '%d -%m -%Y') as expiry,
  	      temp_cartbarang_penerimaan.jmlterima,
		  temp_cartbarang_penerimaan.IP
		FROM
		  m_barang
		  INNER JOIN m_barang_group ON (m_barang.group_barang = m_barang_group.group_barang)
		  AND (m_barang.farmasi = m_barang_group.farmasi)
		  INNER JOIN temp_cartbarang_penerimaan ON (m_barang.kode_barang = temp_cartbarang_penerimaan.kodebarang)
		WHERE temp_cartbarang_penerimaan.IP = '$ip'";

if(empty($_GET['optbarang'])){
	if(empty($_POST['tglterima'])
		|| empty($_POST['nm_barang']) || empty($_POST['kd_barang']) 
		|| empty($_POST['jml_barang'])){
		
		echo "<fieldset class='fieldset'>";
        echo "<legend>Error</legend>";
		echo "Isian Belum Lengkap"; 
		echo "</legend>";
	
	}else{
			
    	$tgl_terima = $_POST['tglterima'];
		$kd_barang = $_POST['kd_barang'];
		$jml_terima = $_POST['jml_barang'];
		$nip = $_POST['NIP'];
		$kdunit = $_POST['KDUNIT'];
		
		@mysql_query("INSERT INTO temp_cartbarang_penerimaan (kodebarang, tglterima, jmlterima,
						  NIP, KDUNIT, IP) 
					VALUES ('$kd_barang', '$tgl_terima', '$jml_terima', '$nip', $kdunit, '$ip')");
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
         <th>No Batch</th>
         <th>Tgl Kadaluarsa</th>
         <th>Jumlah</th>
         <th>Satuan</th>
         <th>Dari</th>
         <th>Group Barang</th>
         <th>Pilihan</th>
      </tr>
<?php
	  $i = 1;
	  while($data = mysql_fetch_array($row)){
?>
       <tr>
         <td><?=$i?></td>
         <td><?=$data['kode_barang']?></td>
         <td><?=$data['nama_barang']?></td>
         <td><?=$data['no_batch']?></td>
         <td><?=$data['expiry']?></td>
         <td align="right"><?=$data['jmlterima']?></td>
         <td><?=$data['satuan']?></td>
         <td><?=$data['nama_farmasi']?></td>
         <td><?=$data['nama_group']?></td>
         <td><a href="#" onclick="javascript: MyAjaxRequest('validbarang','orderbarang/addbarangpenerimaan.php?optbarang=<?=$data['IDXBARANG']?>'); return false;" >Hapus</a></td>
      </tr>
<?php } ?>      
   </table>
   <form name="savebarang" id="savebarang" action="orderbarang/savebarangpenerimaan.php" method="post" >
   <input class="text" type="submit" value="S i m p a n" onclick="submitform (document.getElementById('savebarang'),'orderbarang/savebarangpenerimaan.php','validbarang',validatetask); return false;"/>
   </form>
</fieldset>   
 <? } ?>
