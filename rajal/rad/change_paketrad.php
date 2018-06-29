<?  require_once("../../include/connect.php");

$myquery = "select a.NOMR,a.KDPOLY,a.KDDOKTER,a.TGLREG,b.NAMA,b.ALAMAT,b.JENISKELAMIN,b.TGLLAHIR,c.NAMA as CARABAYAR, a.IDXDAFTAR, d.NAMA as POLY, e.NAMADOKTER
			  from t_pendaftaran a, m_pasien b, m_carabayar c, m_poly d, m_dokter e
			  where a.NOMR=b.NOMR AND a.KDCARABAYAR=c.KODE AND d.KODE=a.KDPOLY and a.KDDOKTER=e.KDDOKTER
			        and a.IDXDAFTAR='".$_GET["idx"]."'";
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get); 		
		$nomr=$userdata['NOMR'];
		$idxdaftar=$userdata['IDXDAFTAR'];
		$kdpoly=$userdata['KDPOLY'];
		$kddokter=$userdata['KDDOKTER'];
		$tglreg=$userdata['TGLREG'];


 if(!empty($_GET['paket'])){   
	$paket=$_GET['paket'];
	
	if($paket=="1"){
	  include("order_rad_1.php");
	
	}else if($paket=="2"){
	  include("order_rad_2.php");
	
	}
 }
?>