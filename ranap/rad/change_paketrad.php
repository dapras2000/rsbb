<?  require_once("../../include/connect.php");

$myquery = "SELECT t_admission.id_admission,
				  t_admission.nomr,
				  t_admission.dokterpengirim,
				  t_admission.statusbayar,
				  t_admission.kirimdari,
				  t_admission.keluargadekat,
				  t_admission.panggungjawab,
				  t_admission.masukrs,
				  t_admission.noruang,
				  t_admission.nott,
				  t_admission.deposit,
				  t_admission.keluarrs,
				  t_admission.icd_masuk,
				  t_admission.icd_keluar,
				  t_admission.NIP,
				  t_admission.noruang_asal,
				  t_admission.nott_asal,
				  t_admission.tgl_pindah,
				  t_admission.kd_rujuk,
				  t_admission.st_bayar
				FROM
				  t_admission
			    WHERE t_admission.id_admission = '".$_GET["idx"]."'";
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get); 		
		$nomr=$userdata['nomr'];
		$idxdaftar=$userdata['id_admission'];
		$kdpoly=$userdata['noruang'];
		$stbayar=$userdata['statusbayar'];
		
 if(!empty($_GET['paket'])){   
	$paket=$_GET['paket'];
	
	if($paket=="1"){
	  include("order_rad_1.php");
	
	}else if($paket=="2"){
	  include("order_rad_2.php");
	
	}
 }
?>