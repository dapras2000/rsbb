<?php
include("../include/connect.php");
include("inc/function.php");

if(!empty($_GET['idxbarang'])){
	$idxbarang = $_GET['idxbarang'];
	$nip = $_SESSION['NIP'];
	if($_GET['opt']=="2"){
	   @mysql_query("UPDATE t_permintaan_barang SET statusacc = '2',
					NIP_keluar = '".$nip."'
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
					jmlkeluar = $jml,
					tglkeluar = '$tgl',
					NIP_keluar = '".$nip."'
					WHERE IDXBARANG = '$idxbarang'")or die(mysql_error());
	   
	   $sqlobatdetail = "SELECT t_permintaan_barang.kodebarang,
				  t_permintaan_barang.jmlkeluar,
				  t_permintaan_barang.tglkeluar
				FROM
				  t_permintaan_barang
				WHERE t_permintaan_barang.IDXBARANG = '$idxbarang'";
	   
	   $getobatdetail = mysql_query ($sqlobatdetail)or die(mysql_error());
	   $datadetailobat = mysql_fetch_assoc($getobatdetail);
	   $qty_obat = $datadetailobat['jmlkeluar'];
	   $tgl_obat = $datadetailobat['tglkeluar'];
	   $kode_obat = $datadetailobat['kodebarang'];
	   
	   $sqlsaldo = "SELECT saldo FROM t_barang_stok 
					WHERE kode_barang = '$kode_obat' 
					ORDER BY tanggal DESC, kd_stok DESC LIMIT 1";
	   $get = mysql_query ($sqlsaldo)or die(mysql_error());
	   $saldodata = mysql_fetch_assoc($get);
	   if(mysql_num_rows($get) > 0){
	   		$saldo = $saldodata['saldo'] - $qty_obat;
	   }else{
		   $saldo = 0 - $qty_obat;
	   }
	   @mysql_query("INSERT INTO t_barang_stok (kode_barang, tanggal, keluar, saldo) 
						VALUES ('$kode_obat', '$tgl_obat', '$qty_obat', '$saldo')")or die(mysql_error());
	   echo "Sudah disetujui";
	}
}
?>