<?php
include("../include/connect.php");
include("../include/function.php");

if(empty($_POST['tgl_kunjungan']) || empty($_POST['jam_kunjungan']) || empty($_POST['icd_code'])){
	?>		
		<script language="javascript" type="text/javascript" >
	      alert("Isian Tidak Lengkap.");
	      window.location="<?php echo _BASE_;?>index.php?link=<?=$_POST['link']?>&nomr=<?=$_POST['nomr']?>&menu=<?=$_POST['menu']?>";
        </script>
	<?	
	}else{
		
    	$idxdaftar = $_POST['idxdaftar'];
		$nomr = $_POST['nomr'];
		$nip = $_POST['NIP'];
		$kdunit = $_POST['KDUNIT'];
		$icd_code = trim($_POST['icd_code']);
        $subjektif = $_POST["subjektif"]; 
		$objektif = $_POST["objektif"];
		$assasement = $_POST["assasement"];
		$planning = $_POST["planning"];
		
		if(empty($_POST['idxkunjungan_kamar'])){
			@mysql_query("INSERT INTO t_kunjungan_kamar (idxdaftar, nomr, tanggal, icd_code, KDUNIT, NIP, subjektif, objektif, assasement, planning) 
					VALUES ('$idxdaftar', $nomr, now(), '$icd_code', $kdunit, '$nip', '$subjektif', '$objektif', '$assasement',	'$planning')");
		}else{
			@mysql_query("UPDATE t_kunjungan_kamar
					SET icd_code = '".$icd_code."', 
  						subjektif = '".$subjektif."',
  						objektif = '".$objektif."',
  						assasement = '".$assasement."',
  						planning = '".$planning."'
					WHERE idxkunjungan_kamar = ".$_POST['idxkunjungan_kamar']);
		
		}
		
		$sql_diag = "select ICD_CODE from t_diagnosadanterapi WHERE IDXDAFTAR = ".$idxdaftar;
		$get_diag = mysql_query($sql_diag);	
		
		if(mysql_num_rows($get_diag)>0){
		   @mysql_query("UPDATE t_diagnosadanterapi SET ICD_CODE = '".$icd_code."' WHERE IDXDAFTAR = ".$idxdaftar);
		   
		}else{
			@mysql_query("INSERT INTO t_diagnosadanterapi (IDXDAFTAR, NOMR, TANGGAL, ICD_CODE, KDPOLY, NIP) VALUES ('$idxdaftar', $nomr, curdate(), '$icd_code', $kdpoly, '$nip')");
		}
?>
<script language="javascript" type="text/javascript" >
window.location="<?php echo _BASE_;?>index.php?link=<?=$_POST['link']?>&nomr=<?=$_POST['nomr']?>&menu=<?=$_POST['menu']?>&idx=<?=$idxdaftar?>";
 </script>
<? } ?>
