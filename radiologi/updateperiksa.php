<? session_start();
include_once("../include/connect.php");
$larikpetugas=$_POST['petugas'];
$xnomr = "";


if ($larikpetugas==''){
	header("Location:../index.php?link=73&idxorder=".$_POST['idxorder']."&psn=Data Petugas dan Dokter Harus diisi!");
}else{
	for($i=0;$i<=count($larikdokter);$i++){
		if($larikdokter[$i] != ''){
			$insertdokter="INSERT INTO t_radiologi_petugas VALUES('','".$_POST['idxorder']."','".$larikdokter[$i]."','DOKTER')";
			mysql_query($insertdokter);	
		}
	}	
	for($i2=0;$i2<=count($larikpetugas);$i2++){
		if($larikpetugas[$i2] != ''){
			$insertpetugas="INSERT INTO t_radiologi_petugas VALUES('','".$_POST['idxorder']."','".$larikpetugas[$i2]."','PETUGAS')";
			mysql_query($insertpetugas);	
			
		}
	}
}

$idx_order = $_POST['idxorder']; 
$jns_film = $_POST['jenisfilm'];
$jml_film_baik = $_POST['jmlfilm_baik'];
$jml_film_rusak = $_POST['jmlfilm_rusak'];
$no_foto = $_POST['no_foto'];
	   
$edit1="update t_radiologi set TGLPERIKSA=curdate(),jenisfilm='".$jns_film."',jumlahfilm_baik='".$jml_film_baik."',jumlahfilm_rusak='".$jml_film_rusak."', NIPRAD='".$_SESSION['NIP']."', NO_FILM = '".$no_foto."' where idxorderrad='".$idx_order."'";
mysql_query($edit1);

?>

<script language="javascript">
  alert("Update Sukess");
  window.location="../index.php?link=7";
  </script>