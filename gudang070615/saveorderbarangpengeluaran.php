<?php
session_start();
include("../include/connect.php");
include("inc/function.php");
$nip = $_SESSION['NIP'];
$kdunit = $_SESSION['KDUNIT'];
if(!empty($_GET['idxbarang'])){
	$idxbarang = $_GET['idxbarang'];
	if($_GET['opt']=="2"){
	   @mysql_query("UPDATE t_permintaan_barang SET statusacc = '2',
					NIP_keluar = '".$nip."',
					jmlkeluar_temp = NULL,
					tglkeluar = NULL
					WHERE IDXBARANG = '$idxbarang'")or die(mysql_error());
	   echo "Tidak disetujui";
	}else if($_GET['opt']=="1"){
   	   if(!empty($_GET['jml'])){
	   		$jml = $_GET['jml'];
		}else{
			$sqlobatjml = "SELECT t_permintaan_barang.jumlahpesan
				 		  FROM
				          		t_permintaan_barang
				          WHERE t_permintaan_barang.IDXBARANG = '$idxbarang'";
		    $getobatjml = mysql_query ($sqlobatjml)or die(mysql_error());
	        $datajmlobat = mysql_fetch_assoc($getobatjml);
			$jml = $datajmlobat['jumlahpesan'];
		}
	   
	   $tgl = date("Y-m-d");
	   @mysql_query("UPDATE t_permintaan_barang SET statusacc = '1',
					jmlkeluar_temp = $jml,
					tglkeluar = '$tgl',
					NIP_keluar = '".$nip."'
					WHERE IDXBARANG = '$idxbarang'")or die(mysql_error());	   
	
	   echo "Sudah disetujui";
	}
}

if(!empty($_GET['nobatch'])){
	   
	  $sqlbarangitem = "SELECT t_permintaan_barang.IDXBARANG, 
	   			  t_permintaan_barang.kodebarang,
				  t_permintaan_barang.jmlkeluar_temp,
				  t_permintaan_barang.tglkeluar,
				  t_permintaan_barang.KDUNIT, 
				  t_permintaan_barang.RUANG,
				  t_permintaan_barang.NIP
				FROM
				  t_permintaan_barang
				WHERE t_permintaan_barang.NO = '".$_GET['nobatch']."'
				AND t_permintaan_barang.status_save='0'";
	   
	   $getbarangitem = mysql_query ($sqlbarangitem)or die(mysql_error());
	   
	   $x = 1;
	   while ($databarangitem = mysql_fetch_array($getbarangitem)){
	   		$qty_obat = $databarangitem['jmlkeluar_temp'];
	   		$tgl_obat = $databarangitem['tglkeluar'];
	   		$kode_obat = $databarangitem['kodebarang'];
	   		$idx_barang = $databarangitem['IDXBARANG'];
			$unit_tujuan = $databarangitem['KDUNIT'];
			$ruang = $databarangitem['RUANG'];
			$nip_tujuan = $databarangitem['NIP'];
	   
	   		if($qty_obat !=""){
			$sqlsaldo = "SELECT saldo FROM t_barang_stok  
					WHERE kode_barang = '$kode_obat'  AND KDUNIT = ".$kdunit."
					ORDER BY  kd_stok DESC LIMIT 1";
	   			
				$get = mysql_query ($sqlsaldo)or die(mysql_error());
	   			$saldodata = mysql_fetch_assoc($get);
	   			if(mysql_num_rows($get) > 0){
	   						$saldo = $saldodata['saldo'] - $qty_obat;
	   					}else{
		   					$saldo = 0 - $qty_obat;
	   			}
				
			$sqlsaldo_unit = "SELECT saldo FROM t_barang_stok  
					WHERE kode_barang = '$kode_obat'  AND KDUNIT = ".$unit_tujuan."
					ORDER BY  kd_stok DESC LIMIT 1";
	   			
				$get_unit = mysql_query ($sqlsaldo_unit)or die(mysql_error());
	   			$saldodata_unit = mysql_fetch_assoc($get_unit);
	   			if(mysql_num_rows($get_unit) > 0){
	   						$saldo_unit = $saldodata_unit['saldo'] + $qty_obat;
	   					}else{
		   					$saldo_unit = 0 + $qty_obat;
	   			}
	
	   
	   		mysql_query("INSERT INTO t_barang_stok (kode_barang, tanggal, keluar, saldo, KDUNIT) 
						VALUES ('$kode_obat', '$tgl_obat', '$qty_obat', '$saldo', ".$kdunit.")")or die(mysql_error());
			
			mysql_query("INSERT INTO t_barang_stok (kode_barang, tanggal, masuk, saldo, KDUNIT) 
						VALUES ('$kode_obat', '$tgl_obat', '$qty_obat', '$saldo_unit', ".$unit_tujuan.")")or die(mysql_error());
			
			mysql_query("INSERT INTO t_pengeluaran_barang (NIP, KDUNIT, kodebarang, tglkeluar, jmlkeluar, UNIT_TUJUAN, RUANG) 
						VALUES ('$nip', '$kdunit', '$kode_obat', '$tgl_obat', $qty_obat, $unit_tujuan, $ruang)")or die(mysql_error());
			
			mysql_query("INSERT INTO t_penerimaan_barang (NIP, KDUNIT, kodebarang, tglterima, jmlterima) 
						VALUES ('$nip_tujuan', '$unit_tujuan', '$kode_obat', '$tgl_obat', $qty_obat)")or die(mysql_error());
			
			@mysql_query("UPDATE t_permintaan_barang SET status_save = '1',
					jmlkeluar = $qty_obat
					WHERE IDXBARANG = '$idx_barang'")or die(mysql_error());
			}
	   $x++;
	   }
	   
?>
<script language="javascript" type="text/javascript" >
	alert("Simpan Data Permintaan Berhasil.");
	window.location="../index.php?link=8";
</script>
<?	
}

if(!empty($_GET['cekbarang'])){
	$kdbarang = $_GET['cekbarang'];
	$sqlcek = "select hide_when_print from m_barang 
	          where kode_barang = ".$kdbarang;
	$getcek = mysql_query ($sqlcek)or die(mysql_error());
	$cek = mysql_fetch_assoc($getcek);
	if(mysql_num_rows($getcek) > 0){
		$cekdata = $cek['hide_when_print'];
	}
	
	if($cekdata == "1"){
		@mysql_query("UPDATE m_barang SET hide_when_print = '0'
					WHERE kode_barang =".$kdbarang)or die(mysql_error());	
?>
   <input type="checkbox" name="<?=$kdbarang?>" value="1" onclick="javascript: MyAjaxRequest('cek<?=$kdbarang?>','gudang/saveorderbarangpengeluaran.php?cekbarang=<?=$kdbarang?>'); return false;" />
<?		
	}else{
		@mysql_query("UPDATE m_barang SET hide_when_print = '1'
					WHERE kode_barang =".$kdbarang)or die(mysql_error());	
?>
   <input type="checkbox" name="<?=$kdbarang?>" value="1" checked=checked onclick="javascript: MyAjaxRequest('cek<?=$kdbarang?>','gudang/saveorderbarangpengeluaran.php?cekbarang=<?=$kdbarang?>'); return false;" />	
<?		
	}
	   
}
?>