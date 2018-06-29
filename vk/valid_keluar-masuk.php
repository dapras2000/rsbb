<? session_start(); ?>
<div style="border:1px solid #DF7; padding:5px; margin:5px; color:#093; width:95%; background-color:#FFF;" align="left">
<?php 
include("../include/connect.php");

if($_POST['Masuk']){
	$_POST['NOMR'];
   	$_POST['IDXDAFTAR2'];
		$update_bill	= mysql_query('update t_billrajal set KDDOKTER = "'.$_REQUEST['dokter'].'", mulai = NOW() where IDXDAFTAR = "'.$_POST['IDXDAFTAR2'].'"');
		
		$qry_masuk = mysql_query("UPDATE t_pendaftaran SET MASUKPOLY ='".$_POST['Masuk']."', KDDOKTER = '".$_POST['dokter']."' WHERE NOMR = '".$_POST['NOMR']."' AND IDXDAFTAR='".$_POST['IDXDAFTAR2']."'")or die(mysql_error());
		
	$sql_rm = "select idxdaftar from t_rekammedik where idxdaftar =".$_POST['IDXDAFTAR2'];
	$get_rm = mysql_query($sql_rm);
	if(mysql_num_rows($get_rm)>0){
		$sql="UPDATE t_rekammedik SET penerima_poly = '".$_SESSION['NIP']."' WHERE idxdaftar = '".$_POST['IDXDAFTAR2']."'";
	}else{
		$sql= "insert into t_rekammedik (tgl_kirim ,idxdaftar , penerima_poly) values(curdate(),".$_POST['IDXDAFTAR2'].",'".$_SESSION['NIP']."')";
	}
	
	
	mysql_query($sql);

	if($qry_masuk){?><strong> Jam Masuk Pasien : <?php echo $_POST['Masuk'];?></strong><? }
	
	}
if($_POST['Keluar']){
   $_POST['NOMR'];
   $_POST['IDXDAFTAR2'];
   $status 		= $_POST['Status'];
   $cek_keluar 	= 1;
   if($status 	== "5"){
   		if(empty($_POST['poly'])){
	    	echo "<br> Poliklinik Tujuan Belum Dipilih.";   
			$cek_keluar = 0;
	   	}
   }
   
   if($status == "6"){		
   if(empty($_POST['alasan_rujuk'])){
	    	echo "<br> Alasan Rujuk Belum Dipilih.";   
			$cek_keluar = 0;
	   }
   }
   
   if($cek_keluar == 1){
	    if($status == 5){
			$ket_status	= $_REQUEST['poly'];
		}elseif($status == 6){
			$ket_status = $_REQUEST['alasan_rujuk'];
		}else{
			$ket_status	= '0';
		}
		$qry_keluar = mysql_query("UPDATE t_pendaftaran SET KELUARPOLY =CURTIME(), STATUS = '".$_POST['Status']."', KETERANGAN_STATUS = '".$ket_status."' WHERE NOMR = '".$_POST['NOMR']."' AND IDXDAFTAR='".$_POST['IDXDAFTAR2']."'")or die(mysql_error());
		#$qry_keluar = mysql_query("UPDATE t_pendaftaran SET KELUARPOLY ='".$_POST['Keluar']."', STATUS = '".$_POST['Status']."' WHERE NOMR = '".$_POST['NOMR']."' AND IDXDAFTAR='".$_POST['IDXDAFTAR2']."'")or die(mysql_error());
		if($qry_keluar){
    		echo "<strong>Jam Keluar Pasien : ".$_POST['Keluar']."</strong>";
		}
	    $sql_pendaftaran = "SELECT NOMR, TGLREG, KDDOKTER, KDPOLY, KDRUJUK, KDCARABAYAR, NOJAMINAN, SHIFT, `STATUS`, PASIENBARU, NIP, IDXDAFTAR,			MASUKPOLY, KELUARPOLY, KETRUJUK
							FROM t_pendaftaran
							WHERE IDXDAFTAR = ".$_POST['IDXDAFTAR2'];
		$get_pendaftaran = mysql_query($sql_pendaftaran);
		$dat_pendaftaran = mysql_fetch_assoc($get_pendaftaran);
		
		$nomr 		= $dat_pendaftaran['NOMR'];
		$idxdaftar 	= $_POST['IDXDAFTAR2'];
		$kdpoly 	= $dat_pendaftaran['KDPOLY'];
	    $kddokter 	= $dat_pendaftaran['KDDOKTER'];
		
		$kdrujuk 	= $dat_pendaftaran['KDRUJUK'];
		$kdcarabayar= $dat_pendaftaran['KDCARABAYAR'];
		$nojaminan 	= $dat_pendaftaran['NOJAMINAN'];
		$shift 		= $dat_pendaftaran['SHIFT'];
		$nip 		= $_SESSION['NIP'];		
		
		// insert ke t_orderadmission
		if($status == '2'){
			$sql_cek = "SELECT * FROM t_orderadmission WHERE IDXDAFTAR = '$_POST[IDXDAFTAR2]'";
			$qry_cek = mysql_query($sql_cek)or die(mysql_error());
			$data_cek = mysql_fetch_assoc($qry_cek);
			$idxpasien=$data_cek['IDXDAFTAR'];
			//validasi data pasien
			if($idxdaftar == $idxpasien){
				$sql_order = "UPDATE t_orderadmission SET NOMR='".$nomr."', POLYPENGIRIM='".$kdpoly."', DRPENGIRIM='".$kddokter."', KDCARABAYAR='".$kdcarabayar."', KDRUJUK='".$kdrujuk."', TGLORDER=curdate() WHERE IDXDAFTAR='".$idxdaftar."'";
			}else{
				$sql_order = "INSERT INTO t_orderadmission (IDXDAFTAR,NOMR,POLYPENGIRIM,DRPENGIRIM,KDCARABAYAR,KDRUJUK,TGLORDER) 
				VALUES('$idxdaftar','$nomr','$kdpoly','$kddokter','$kdcarabayar','$kdrujuk',curdate())";		  
			}
			//query untuk insert atau update idxpasien ke t_orderadmission 
			mysql_query($sql_order)or die(mysql_error());
		
	}

	if($status == "6"){
	    $qrl_rujuk = "INSERT INTO t_alasan_rujuk (idxdaftar, status_rujuk, alasan_rujuk) 
		VALUE (".$_POST['IDXDAFTAR2'].",".$status.",".$_POST['alasan_rujuk'].")";
		@mysql_query($qrl_rujuk);				
	}
	
	if($status == "5"){
				
	   	   $kdpoly = $_POST['poly'];
		   $kddokter = $_POST['dokter'];
		   
		   if(!empty($_POST['dokter'])){
				   $kddokter = $_POST['dokter'];
			   }else{
				   //edit deui tah ieu
			   		$kddokter = "1";
			}
		   
		   
		    $sqlsearchpendaftaran = "select NOMR, TGLREG, KDPOLY from t_pendaftaran WHERE NOMR = '".$nomr."'
AND TGLREG = curdate() AND KDPOLY = '".trim($_POST['poly'])."'";
			$rowpendaftaran = mysql_query($sqlsearchpendaftaran)or die(mysql_error());	
			
			if(mysql_num_rows($rowpendaftaran) > 0){
			echo "<br><strong>Pilihan Poliklinik Salah.</strong>";
			}else{

		   $sqlinsert_pendaftaran = "INSERT INTO t_pendaftaran (NOMR, TGLREG, KDDOKTER,
								  KDPOLY, KDRUJUK,
								  KDCARABAYAR, NOJAMINAN,
								  SHIFT, `STATUS`,
								  PASIENBARU, NIP) 
								  VALUES('".$nomr."',curdate(),".$kddokter.",".$kdpoly.",".$kdrujuk.",".$kdcarabayar.",'".$nojaminan."',".$shift.",0,0,'".$nip."')";
		   mysql_query($sqlinsert_pendaftaran)or die(mysql_error());
		   
		   $qrl_rujuk = "INSERT INTO t_alasan_rujuk (idxdaftar, status_rujuk, poly)	VALUE (".$_POST['IDXDAFTAR2'].",".$status.",".$_POST['poly'].")";
		   mysql_query($qrl_rujuk); 
			}
		}
   }

}
?>
</div>