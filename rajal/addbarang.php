<?php
include("../include/connect.php");
include("inc/function.php");

$ip = getRealIpAddr();
$sql = "SELECT temp_cartbarang.IDXBARANG AS IDX,
						temp_cartbarang.KDBARANG AS KODE,
						temp_cartbarang.KATEGORI AS KATEGORI,
  					    m_obat.group_obat AS GROUPBARANG,
						m_obat.nama_obat AS NAMA,
						m_obat.satuan AS SATUAN,
						temp_cartbarang.QTY AS QTY
						FROM
						m_obat
						INNER JOIN temp_cartbarang ON (m_obat.kode_obat = temp_cartbarang.KDBARANG)
						WHERE temp_cartbarang.IP = '$ip' AND  temp_cartbarang.KATEGORI = 'G' 
UNION
SELECT temp_cartbarang.IDXBARANG AS IDX,
						temp_cartbarang.KDBARANG AS KODE,
						temp_cartbarang.KATEGORI AS KATEGORI,
						m_barang.group_barang AS GROUPBARANG,
						m_barang.nama_barang AS NAMA,
						m_barang.satuan AS SATUAN,
						temp_cartbarang.QTY AS QTY
						FROM
						m_barang
						INNER JOIN temp_cartbarang ON (m_barang.kode_barang = temp_cartbarang.KDBARANG)
						WHERE temp_cartbarang.IP = '$ip' AND temp_cartbarang.KATEGORI = 'L'";


if(empty($_GET['optbarang'])){
	if(empty($_POST['r_barang']) || empty($_POST['nm_barang']) || empty($_POST['kd_barang'])
		|| empty($_POST['jml_permintaan']) || empty($_POST['grpbarang'])){
		
		echo "<fieldset class='fieldset'>";
        echo "<legend>Error</legend>";
		echo "Isian Belum Lengkap"; 
		echo "</legend>";
	
	}else{
		
		$kategori = $_POST['r_barang'];
		$grp = $_POST['grpbarang'];
		$kd_barang = $_POST['kd_barang'];
		$jml_permintaan = $_POST['jml_permintaan'];
		$nip = $_POST['NIP'];
		$kdpoly = $_POST['KDPOLY'];
		
		@mysql_query("INSERT INTO temp_cartbarang(KATEGORI, KDBARANG, QTY, IP, NIP, KDPOLY, GROUPBARANG) 
					VALUES ('$kategori', $kd_barang, '$jml_permintaan', '$ip', '$nip', '$kdpoly', '$grp')");
		}
}else{
	$idxbarang = $_GET['optbarang'];
	@mysql_query("DELETE FROM temp_cartbarang WHERE IDXBARANG = $idxbarang");
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
         <th>Jumlah</th>
         <th>Satuan</th>
         <th>Tujuan</th>
		 <th>Group Barang</th>
         <th>Pilihan</th>
      </tr>
<?php
	  $i = 1;
	  while($data = mysql_fetch_array($row)){
?>
       <tr>
         <td><?=$i?></td>
         <td><?=$data['KODE']?></td>
         <td><?=$data['NAMA']?></td>
         <td><?=$data['QTY']?></td>
         <td><?=$data['SATUAN']?></td>
         <td><? if($data['KATEGORI']=="G"){ echo "Gudang"; }else{ echo "Logistik"; }?></td>
         <td><? if($data['KATEGORI']=="G"){
			 	switch($data['GROUPBARANG']){
					case "1" :
						echo "Obat";
						break;
					case "2" :
						echo "Alat Kesehatan Habis Pakai";
						break;
					case "3" :
						echo "Bahan Radiologi";
						break;
					case "4" :
						echo "Gas";
						break;
					case "5" :
						echo "Reagensia";
						break;	
				}
		 }else{
			 switch($data['GROUPBARANG']){
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
				}
		 }?></td>
         <td><a href="#" onclick="javascript: MyAjaxRequest('validbarang','rajal/addbarang.php?optbarang=<?=$data['IDX']?>'); return false;" >Hapus</a></td>
      </tr>
<?php $i++; } ?>      
   </table>

   <form name="savebarang" id="savebarang" action="rajal/saveorderbarang.php" method="post" >
   <input class="text" type="submit" value="S i m p a n" onclick="submitform (document.getElementById('savebarang'),'rajal/saveorderbarang.php','validbarang',validatetask); return false;"/>
   </form>
   </fieldset>   
 <? } ?>
