<? session_start();
require_once('../include/connect.php');
require_once('../include/function.php');
$rajal		= check_rajal_ranap_status_operasi('RAJAL',$_REQUEST['idorder']);
$orderadmission =	$_REQUEST['orderadmission'];
$nomr		=	$_POST['nomroperasi'];
$tgloperasi	=	$_POST['tgl_operasi'];
$jammulai	=	$_POST['jammulai'];
$diagnosa	= 	$_POST['diagnosa'];

$id_operasi	=	$_POST['idorder'];
$rujuk		=	$_POST['rujuk'];
$dokter		=	$_POST['kddokter'];
$poly		=	$_POST['kdunit'];
$idxdaftar	=	$_POST['idxdaftar'];

$jenisanastesi	=	$_POST['jenisanastesi'];
$metodeanastesi	=	$_POST['metodeanastesi'];
$dokteroperator	=	$_POST['dokteroperator'];
$dokteranastesi	=	$_POST['dokteranastesi'];
$dokteranak	=	$_POST['dokteranak'];
$asistenoperator	=	$_POST['asistenoperator'];
$asistenanastesi	=	$_POST['asistenanastesi'];
$asistenanak	=	$_POST['asistenanak'];
$perawatinstrumen	=	$_POST['perawatinstrumen'];
$perawatsirkuler	=	$_POST['perawatsirkuler'];
#$jenisoperasi 	=	$_REQUEST['cito'];
$nama_dokteroperator	= getNamaDokter($dokteroperator);
$nama_dokteranastesi	= getNamaDokter($dokteranastesi);
$nama_dokteranak		= getNamaDokter($dokteranak);
$n_doperator	= $nama_dokteroperator['NAMADOKTER'];
$n_danastesi	= $nama_dokteranastesi['NAMADOKTER'];
$n_danak		= $nama_dokteranak['NAMADOKTER'];

$ins_operasi="UPDATE t_operasi SET
			  t_operasi.jenisanastesi = '".$jenisanastesi."',
			  t_operasi.metodeanastesi = '".$metodeanastesi."',
			  t_operasi.kode_dokteroperator = '".$dokteroperator."',
			  t_operasi.dokteroperator = '".$n_doperator."',
			  t_operasi.kode_dokteranastesi = '".$dokteranastesi."',
			  t_operasi.dokteranastesi = '".$n_danastesi."',
			  t_operasi.kode_dokteranak = '".$dokteranak."',
			  t_operasi.dokteranak = '".$n_danak."',
			  t_operasi.asistenoperator = '".$asistenoperator."',
			  t_operasi.asistenanastesi = '".$asistenanastesi."',
			  t_operasi.asistenanak = '".$asistenanak."',
			  t_operasi.perawatinstrumen = '".$perawatinstrumen."',
			  t_operasi.perawatsirkuler = '".$perawatsirkuler."',
			  t_operasi.NIP_OK = '".$_SESSION['NIP']."'
			  WHERE t_operasi.id_operasi = ".$id_operasi;
mysql_query($ins_operasi);

if( ($orderadmission == 0) and ($orderadmission == '')){	
	if($rajal['RAJAL'] == 1){
		$mysql	= mysql_query('select * t_orderadmission where IDXDAFTAR = "'.$idxdaftar.'"');
		if(mysql_num_rows($mysql) == 0){
			$sql_order = 'INSERT INTO t_orderadmission (IDXDAFTAR,NOMR,POLYPENGIRIM,DRPENGIRIM,KDCARABAYAR,TGLORDER,KDRUJUK) VALUES("'.$idxdaftar.'","'.$nomr.'","'.$poly.'","'.$dokter.'","'.$kdcarabayar.'",curdate(),"'.$rujuk.'")';
			mysql_query($sql_order);					  
		}
	}
	header('Location:'._BASE_.'/index.php?link=201&idx='.$id_operasi.'&psn=sukses');
}else{
	if($rajal['RAJAL'] == 1){
		$mysql	= mysql_query('select * t_orderadmission where IDXDAFTAR = "'.$idxdaftar.'"');
		if(mysql_num_rows($mysql) == 0){
			$sql_order = 'INSERT INTO t_orderadmission (IDXDAFTAR,NOMR,POLYPENGIRIM,DRPENGIRIM,KDCARABAYAR,TGLORDER,KDRUJUK) VALUES("'.$idxdaftar.'","'.$nomr.'","'.$poly.'","'.$dokter.'","'.$kdcarabayar.'",curdate(),"'.$rujuk.'")';
			mysql_query($sql_order);					  
		}
	}
	header('Location:'._BASE_.'/index.php?link=209&idoperasi='.$id_operasi.'&tanggal=2011-12-22&psn=sukses');
}
?>