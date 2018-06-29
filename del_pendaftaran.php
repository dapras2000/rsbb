<?php
session_start();
if(isset($_POST['userspv']) && isset($_POST['pwdspv'])){
	include("include/connect.php");
	include("include/function.php");
	$sql	= "select * from m_login where NIP = '".$_POST['userspv']."' and PWD='".$_POST['pwdspv']."' and ROLES=99";
	$row 	= mysql_query($sql)or die(mysql_error());	
	if(mysql_num_rows($row) == 0){
		?>
		<script language="javascript" type="text/javascript">
		 alert("User dan Password SPV Salah");
		 history.back();
		</script>
		<?php 
	}else{
		if (empty($_POST["KDDOKTER"])){
			if ($_POST["KDPOLY"] !=11){
				?>
				<script language="javascript" type="text/javascript">
				 alert("Pilih kode dokter");
				 history.back();
				</script>
				<?php 
			}
		}
		
		if ($_POST['daftar'] ==" S i m p a n ") {
			if ($_POST["KDRUJUK"]==1){ 
				$ketrujuk="";
			}else {
				$ketrujuk=",KETRUJUK='".trim($_POST['KETRUJUK'])."'";
			}
			
			if($_POST["KDCARABAYAR"] == 5){
				$cb = trim($_POST['KETBAYAR']);
			}else{
				$cb = '';
			}
			$nobill = '';
			if($_REQUEST['nobill'] != ''){
				$nobill = ' and NOBILL = "'.$_REQUEST['nobill'].'"';
				$ss = mysql_query('select * from t_bayarrajal where nobill = "'.$_REQUEST['nobill'].'"');
				if(mysql_num_rows($ss) > 0){
					$val	 = mysql_fetch_array($ss);
					$status	 = $val['status'];
				}else{
					?>
                    <script language="javascript" type="text/javascript">
					 alert("No BILLING Tidak Terdaftar");
					 history.back();
					</script>
                    <?php
				}
				
			}
			$jenispoly		= $_REQUEST['KDPOLY'];
			$kdprofesi		= getProfesiDoktor($_REQUEST['KDDOKTER']);
			$kodetarif		= getKodePendaftaran($jenispoly,$kdprofesi);
			$tarif 			= getTarif($kodetarif);
			
			if ($_POST["KDPOLY"] != 11){
				$sql= "update t_pendaftaran set MINTA_RUJUKAN = '".$_REQUEST['minta_rujukan']."', NOMR='".$_POST["nomr"]."', SHIFT=".$_POST["SHIFT"]. ", KDPOLY=".$_POST["KDPOLY"].",KDDOKTER=". $_POST["KDDOKTER"]. ", TGLREG='".$_POST["TGLREG"] ."', KDCARABAYAR=".$_POST["KDCARABAYAR"]. ", KDRUJUK=".$_POST["KDRUJUK"].$ketrujuk." , KETBAYAR = '".$cb."',PASIENBARU = '".$_REQUEST['pasienbaru']."' WHERE IDXDAFTAR = ".$_POST['idxdaftar'];
				mysql_query('update m_pasien set KDCARABAYAR = "'.$_REQUEST['KDCARABAYAR'].'"');
			}else{
				$sql= "update t_pendaftaran set MINTA_RUJUKAN = '".$_REQUEST['minta_rujukan']."', NOMR='".$_POST["nomr"]."', SHIFT=".$_POST["SHIFT"]. ", KDPOLY=".$_POST["KDPOLY"].",KDDOKTER=NULL, TGLREG='".$_POST["TGLREG"] ."', KDCARABAYAR=".$_POST["KDCARABAYAR"]. ", KDRUJUK=".$_POST["KDRUJUK"].$ketrujuk.", KETBAYAR = '".$cb."',PASIENBARU = '".$_REQUEST['pasienbaru']."' WHERE IDXDAFTAR = ".$_POST['idxdaftar'];
				mysql_query('update m_pasien set KDCARABAYAR = "'.$_REQUEST['KDCARABAYAR'].'"');
			}
			mysql_query($sql);
			
			mysql_query('update t_bayarrajal set unit = "'.$_REQUEST['KDPOLY'].'" where IDXDAFTAR ="'.$_REQUEST['idxdaftar'].'"'.$nobill);
			
			mysql_query('update t_billrajal set KDPOLY = "'.$_REQUEST['KDPOLY'].'", UNIT = "'.$_REQUEST['KDPOLY'].'",KDDOKTER = "'.$_REQUEST['KDDOKTER'].'",CARABAYAR = "'.$_REQUEST['KDCARABAYAR'].'", TARIFRS="'.$tarif['tarif'].'", JASA_SARANA = "'.$tarif['jasa_sarana'].'", JASA_PELAYANAN = "'.$tarif['jasa_pelayanan'].'" where IDXDAFTAR ="'.$_REQUEST['idxdaftar'].'"'.$nobill);
			
			if($_REQUEST['KDCARABAYAR'] > 1){
				mysql_query('update t_bayarrajal set CARABAYAR = "'.$_REQUEST['KDCARABAYAR'].'", UNIT = "'.$_REQUEST['KDPOLY'].'", JMBAYAR = 0, TGLBAYAR = CURDATE(), JAMBAYAR = CURTIME(), SHIFT = "'.$_POST["SHIFT"].'", LUNAS = 1, STATUS = "LUNAS" where IDXDAFTAR ="'.$_REQUEST['idxdaftar'].'"');
			}else{
				if($_REQUEST['old_carabayar'] > 1):
					mysql_query('update t_bayarrajal set UNIT = "'.$_REQUEST['KDPOLY'].'", CARABAYAR = "'.$_REQUEST['KDCARABAYAR'].'", JMBAYAR = 0, TGLBAYAR = "0000-00-00", JAMBAYAR = "00:00:00", SHIFT = "'.$_POST["SHIFT"].'", LUNAS = 0, STATUS = "TRX", TARIFRS="'.$tarif['tarif'].'", JASA_SARANA = "'.$tarif['jasa_sarana'].'", JASA_PELAYANAN = "'.$tarif['jasa_pelayanan'].'" where IDXDAFTAR ="'.$_REQUEST['idxdaftar'].'"'.$nobill);
				else:
					if($status == 'LUNAS'){
						mysql_query('update t_bayarrajal set UNIT = "'.$_REQUEST['KDPOLY'].'", CARABAYAR = "'.$_REQUEST['KDCARABAYAR'].'", JMBAYAR = "'.$tarif['tarif'].'", TARIFRS="'.$tarif['tarif'].'", JASA_SARANA = "'.$tarif['jasa_sarana'].'", JASA_PELAYANAN = "'.$tarif['jasa_pelayanan'].'" where IDXDAFTAR ="'.$_REQUEST['idxdaftar'].'"'.$nobill);
					}else{
						mysql_query('update t_bayarrajal set UNIT = "'.$_REQUEST['KDPOLY'].'", CARABAYAR = "'.$_REQUEST['KDCARABAYAR'].'", JMBAYAR = 0, TARIFRS="'.$tarif['tarif'].'", JASA_SARANA = "'.$tarif['jasa_sarana'].'", JASA_PELAYANAN = "'.$tarif['jasa_pelayanan'].'" where IDXDAFTAR ="'.$_REQUEST['idxdaftar'].'"'.$nobill);
					}
				endif;
			}
			
		}else if ($_POST['daftar'] =="  H a p u s  "){
			$sqlp	= mysql_query('delete from m_pasien where NOMR = "'.$_POST['NOMR'].'"');
			
			
			$sql= "delete from t_pendaftaran WHERE IDXDAFTAR = ".trim($_POST['idxdaftar']);
			$row = mysql_query($sql)or die(mysql_error());	
			mysql_query($sql);
			
			$sql= "delete from t_billrajal WHERE IDXDAFTAR = ".trim($_POST['idxdaftar']);
			$row = mysql_query($sql)or die(mysql_error());	
			mysql_query($sql);
		
			$sql= "delete from t_bayarrajal WHERE IDXDAFTAR = ".trim($_POST['idxdaftar']);
			$row = mysql_query($sql)or die(mysql_error());	
			mysql_query($sql);
		}
	?>
	<script language="javascript" type="text/javascript">
	 alert("update Sukses");
	 //history.back();
	 window.location="index.php?link=22";
	</script>
	<?php 
	} 
}
?>