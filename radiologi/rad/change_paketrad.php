<?  require_once("../../include/connect.php");

$myquery = "select a.NOMR,a.KDPOLY,a.KDDOKTER,a.TGLREG,b.NAMA,b.ALAMAT,b.JENISKELAMIN,b.TGLLAHIR,c.NAMA as CARABAYAR, a.IDXDAFTAR
			  from t_pendaftaran_aps a, m_pasien_aps b, m_carabayar c 
			  where a.NOMR=b.NOMR AND a.KDCARABAYAR=c.KODE and a.IDXDAFTAR='".$_GET["idx"]."'";
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get); 		
		$nomr=$userdata['NOMR'];
		$idxdaftar=$userdata['IDXDAFTAR'];
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