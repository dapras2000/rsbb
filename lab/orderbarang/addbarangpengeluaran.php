<?php
include("../../include/connect.php");
include("../../rajal/inc/function.php");

$ip = getRealIpAddr();
$sql = "SELECT temp_cartbarang_pengeluaran.IDXBARANG AS IDX,
						 m_barang.kode_barang,
						 m_barang.nama_barang,
						 m_barang.no_batch,
		                 DATE_FORMAT(m_barang.expiry, '%d -%m -%Y') as expiry,
						 m_barang_group.nama_group,
						 m_barang_group.nama_farmasi,
						 m_barang.satuan,
						 temp_cartbarang_pengeluaran.QTY,
						 (SELECT nama from m_ruang where no = temp_cartbarang_pengeluaran.RUANG) AS RUANG
						FROM
						 m_barang
						  INNER JOIN m_barang_group ON (m_barang.group_barang = m_barang_group.group_barang)
						  AND (m_barang.farmasi = m_barang_group.farmasi)
						  INNER JOIN temp_cartbarang_pengeluaran ON (m_barang.kode_barang = temp_cartbarang_pengeluaran.KDBARANG)
						WHERE temp_cartbarang_pengeluaran.IP = '$ip'";

if(empty($_GET['optbarang'])){
	if(empty($_POST['kd_barang'])
		|| empty($_POST['jml_barang'])){
		
		echo "<fieldset class='fieldset'>";
        echo "<legend>Error</legend>";
		echo "Isian Belum Lengkap"; 
		echo "</legend>";
	
	}else{
		

		$kd_barang = $_POST['kd_barang'];
		$jml_permintaan = $_POST['jml_barang'];
		$nip = $_POST['NIP'];
		$kdunit = $_POST['KDUNIT'];
			
		if(!empty($_POST['ruang'])){
			$ruang = $_POST['ruang'];
		}else{
			$ruang = '0';
		}
		
		if(!empty($_POST['nomr'])){
			$nomr = $_POST['nomr'];
			$idxdaftar = $_POST['idxdaftar'];
		}else{
		    $nomr = "";
			$idxdaftar = 'NULL';
		}

mysql_query("INSERT INTO temp_cartbarang_pengeluaran (KDBARANG, QTY, IP, NIP, KDUNIT, tglkeluar, RUANG, NOMR, IDXDAFTAR) 
					VALUES ('$kd_barang', $jml_permintaan, '$ip', '$nip', '$kdunit', curdate(), $ruang, '$nomr', $idxdaftar)");
		}
}else{
	$idxbarang = $_GET['optbarang'];
	@mysql_query("DELETE FROM temp_cartbarang_pengeluaran WHERE IDXBARANG = $idxbarang");
}
$row = mysql_query($sql)or die(mysql_error());
if(mysql_num_rows($row) > 0){
?>
<fieldset class="fieldset">
      <legend>Daftar Permintaan</legend>
   <table class="tb">
      <tr>
         <th>No</th>
         <th>Kode Barang</th>
         <th>Nama Barang</th>
         <th>No Batch</th>
         <th>Jumlah</th>
         <th>Satuan</th>
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
         <td><?=$data['QTY']?></td>
         <td><?=$data['satuan']?></td>
           <td><a href="#" onclick="javascript: MyAjaxRequest('validbarang','radiologi/orderbarang/addbarangpengeluaran.php?optbarang=<?=$data['IDX']?>'); return false;" >Hapus</a></td>
      </tr>
<?php $i++; } ?>      
   </table>

   <form name="savebarang" id="savebarang" action="radiologi/orderbarang/savebarangpengeluaran.php" method="post" >
   <input type="hidden" name="idxorder" value="<?=$_POST['idxorder']?>" />
   <input class="text" type="submit" value="S i m p a n" onclick="submitform (document.getElementById('savebarang'),'radiologi/orderbarang/savebarangpengeluaran.php','validbarang',validatetask); return false;"/>
   </form>
   </fieldset>   
 <? } ?>
