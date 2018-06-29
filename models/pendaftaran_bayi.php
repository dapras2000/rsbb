<?php 
session_start();
include("../include/connect.php");
include("../include/function.php");


if( (empty($_SESSION['register_nomr'])) && (empty($_SESSION['register_nama'])) ){
	
$_error_msg = "";
$nomranak 	= getLastNoM("1");
$nomribu	= $_REQUEST['parent_nomr'];
$ketemu	= "0";

$sqlrak		= "SELECT * from m_maxnomr where status='1'";
$rsqlrak	= mysql_query($sqlrak);
$rowsqlrak	= mysql_fetch_array($rsqlrak);
$nomor1	= $rowsqlrak['last2']+1;
if ($rowsqlrak['last2'] <= 10 ){
	$nomr1	= str_pad($nomor1,6,"0",STR_PAD_LEFT);
	$nomr 	= $nomr1;
} else if ($rowsqlrak['last2'] <= 100 ){ 
	$nomr1	= str_pad($nomor1,5,"0",STR_PAD_LEFT);
	$nomr 	= $nomr1;
} else if ($rowsqlrak['last2'] <= 1000 ){
	$nomr1	= str_pad($nomor1,4,"0",STR_PAD_LEFT);
	$nomr 	= $nomr1;
} else if ($rowsqlrak['last2'] <= 10000 ){
	$nomr1	= str_pad($nomor1,3,"0",STR_PAD_LEFT);
	$nomr 	= $nomr1;
} else if ($rowsqlrak['last2'] <= 100000 ){
	$nomr1	= str_pad($nomor1,2,"0",STR_PAD_LEFT);
	$nomr 	= $nomr1;
} else if ($rowsqlrak['last2'] <= 1000000 ){
	$nomr 	= $nomr1;
}

 //echo $nomribu;
 //echo "-Anak : ".$nomr;


if($_POST['parent_nomr']=="") $_error_msg = $_error_msg."NOMR Orang tua bayi belum diisi, ";
if($_POST['NAMA']=="") $_error_msg = $_error_msg."Nama Pasien Belum Diisi, ";
if($_POST['TEMPAT']=="") $_error_msg = $_error_msg."Tempat Lahir Belum Lengkap, ";
if($_POST['TGLLAHIR']=="") $_error_msg = $_error_msg."Tanggal Lahir Belum Lengkap, ";
if($_POST['JENISKELAMIN']=="") $_error_msg = $_error_msg."Jenis Kelamin Belum Dipilih, ";
if($_POST['ALAMAT']=="") $_error_msg = $_error_msg."Alamat Belum Lengkap, ";
if($_POST['KELURAHAN']=="") $_error_msg = $_error_msg."Kelurahan Belum Dipilih, ";
if($_POST['KDKECAMATAN']=="0") $_error_msg = $_error_msg."Kecamatan Belum Dipilih, ";
if($_POST['KOTA']=="") $_error_msg = $_error_msg."Kota Belum Lengkap,";
if($_POST['KDPROVINSI']=="0") $_error_msg = $_error_msg."Provinsi Belum Dipilih, ";
if($_POST['ruang']=="") $_error_msg = $_error_msg."Ruang tempat lahiran belum dipilih.";


if(strlen($_error_msg)>0) {
    $_error_msg = substr($_error_msg,0,strlen($_error_msg)-2).".";
    ?>

<SCRIPT language="JavaScript">
    alert("<?=$_error_msg?>");
    window.location="../index.php?link=2bayi&parent_nomr=<?=$_POST['parent_nomr']?>&NAMA=<?=$_POST['NAMA']?>&CALLER=<?=$_POST['CALLER']?>&JENISKELAMIN=<?=$_POST['JENISKELAMIN']?>&STATUS=<?=$_POST['STATUS']?>&PENDIDIKAN=<?=$_POST['PENDIDIKAN']?>&AGAMA=<?=$_POST['AGAMA']?>&TEMPAT=<?=$_POST['TEMPAT']?>&TGLLAHIR=<?=$_POST['TGLLAHIR']?>&ALAMAT=<?=$_POST['ALAMAT']?>&ALAMAT_KTP=<?=$_POST['ALAMAT_KTP']?>&KELURAHAN=<?=$_POST['KELURAHAN']?>&KDKECAMATAN=<?=$_POST['KDKECAMATAN']?>&KOTA=<?=$_POST['KOTA']?>&NOTELP=<?=$_POST['NOTELP']?>&NOKTP=<?=$_POST['NOKTP']?>&SUAMI_ORTU=<?=$_POST['SUAMI_ORTU']?>&PEKERJAAN=<?=$_POST['PEKERJAAN']?>&nama_penanggungjawab=<?=$_POST['nama_penanggungjawab']?>&hubungan_penanggungjawab=<?=$_POST['hubungan_penanggungjawab']?>&alamat_penanggungjawab=<?=$_POST['alamat_penanggungjawab']?>&phone_penanggungjawab=<?=$_POST['phone_penanggungjawab']?>&ruang=<?php echo $_REQUEST['ruang'];?>&KDCARABAYAR=<?php echo $_REQUEST['KDCARABAYAR'];?>";
</SCRIPT>
    <?
}else {
	
    if(!empty($_POST['KDDOKTER'])) {
        $dokter = trim($_POST['KDDOKTER']);
    }else {
        $dokter = "NULL";
    }
	#print_r($_REQUEST);
	
    if(empty($_POST['PENDIDIKAN'])) {
        $pendidikan = "NULL";
    }else {
        $pendidikan = $_POST['PENDIDIKAN'];
    }
    if(empty($_POST['AGAMA'])) {
        $agama = "NULL";
    }else {
        $agama = $_POST['AGAMA'];
    }
    if(empty($_POST['STATUSPASIEN'])) {
        $status = "0";
    }else {
        $status = $_POST['STATUSPASIEN'];
    }

    if(empty($_POST['minta_rujukan'])) {
        $minta_rujukan = "0";
    }else {
        $minta_rujukan = "1";
    }
	
	$tmpTGLLAHIR = date('Y-m-d', strtotime(str_replace('/','-',$_POST['TGLLAHIR'])));
    if($ketemu == "1") {
        $sqlupdate_pasien = "UPDATE m_pasien SET
				  TITLE = '".addslashes($_REQUEST['CALLER'])."',
				  NAMA  = '".addslashes(stripslashes($_REQUEST['NAMA']))."', 
				  TEMPAT  = '".addslashes($_POST['TEMPAT'])."',  
				  TGLLAHIR  = '".trim($tmpTGLLAHIR)."', 
				  JENISKELAMIN  = '".trim($_POST['JENISKELAMIN'])."', 
				  ALAMAT  = '".addslashes($_POST['ALAMAT'])."', 
				  KELURAHAN  = '".addslashes($_POST['KELURAHAN'])."', 
				  KDKECAMATAN  = ".addslashes($_POST['KDKECAMATAN']).", 
				  KOTA  = '".addslashes($_POST['KOTA'])."', 
				  KDPROVINSI  = ".addslashes($_POST['KDPROVINSI']).", 
				  NOTELP  = '".addslashes($_POST['NOTELP'])."', 
				  NOKTP  = '".addslashes($_POST['NOKTP'])."',  
				  SUAMI_ORTU  = '".str_replace("'","",$_REQUEST['SUAMI_ORTU'])."', 
				  PEKERJAAN  = '".addslashes($_POST['PEKERJAAN'])."',  
				  STATUS  = ".trim($status).", 
				  AGAMA  = ".trim($agama).",  
				  PENDIDIKAN  = ".trim($pendidikan).", 
				  KDCARABAYAR  = ".trim($_POST['KDCARABAYAR']).",  
				  NIP  = '".trim($_SESSION['NIP'])."',
				  ALAMAT_KTP = '".trim($_POST['ALAMAT_KTP'])."',
				  PARENT_NOMR = '".$_REQUEST['parent_nomr']."'
			WHERE NOMR = '".$nomr."' ";
        mysql_query($sqlupdate_pasien)or die(mysql_error());
    }else {	
		$sqlinsert_pasien = mysql_query("INSERT INTO m_pasien (NOMR, TITLE,NAMA, TEMPAT, TGLLAHIR, JENISKELAMIN, ALAMAT, KELURAHAN, KDKECAMATAN, KOTA, KDPROVINSI, NOTELP, NOKTP, SUAMI_ORTU, PEKERJAAN, STATUS, AGAMA, PENDIDIKAN, KDCARABAYAR, NIP,TGLDAFTAR, ALAMAT_KTP, PARENT_NOMR) 
							VALUES('".$nomr."','".$_REQUEST['CALLER']."','".addslashes($_REQUEST['NAMA'])."','".addslashes($_POST['TEMPAT'])."','".trim($tmpTGLLAHIR)."','".trim($_POST['JENISKELAMIN'])."','".addslashes($_POST['ALAMAT'])."','".addslashes($_POST['KELURAHAN'])."',
								'".addslashes($_POST['KDKECAMATAN'])."','".addslashes($_POST['KOTA'])."','".addslashes($_POST['KDPROVINSI'])."','".addslashes($_POST['NOTELP'])."','".addslashes($_POST['NOKTP'])."','".addslashes($_POST['SUAMI_ORTU'])."','".addslashes($_POST['PEKERJAAN'])."',
								'".trim($status)."','".trim($agama)."','".trim($pendidikan)."','".trim($_POST['KDCARABAYAR'])."','".trim($_SESSION['NIP'])."',CURDATE(), '".trim($_POST['ALAMAT_KTP'])."','".$_REQUEST['parent_nomr']."')");

		mysql_query('update m_maxnomr set nomor="'.$nomr.'"');
		$sqlrak="SELECT * from m_maxnomr where status='1'";
		$rsqlrak=mysql_query($sqlrak);
		$rowsqlrak=mysql_fetch_array($rsqlrak);
		$rak=$rowsqlrak['last2']+1;
		mysql_query('update m_maxnomr set last2="'.$rak.'"');
    }
	
	if($_REQUEST['ruang'] == "vk"){
		$kdpoly	= 10;
		$sqlinsert_pendaftaran = mysql_query("INSERT INTO t_pendaftaran (NOMR,TGLREG,KDDOKTER,KDPOLY,KDCARABAYAR,NOJAMINAN,JAMREG, MASUKPOLY,MINTA_RUJUKAN,SHIFT,PASIENBARU,NIP,PENANGGUNGJAWAB_NAMA,PENANGGUNGJAWAB_HUBUNGAN,PENANGGUNGJAWAB_ALAMAT,PENANGGUNGJAWAB_PHONE,status,KETBAYAR) 
					VALUES('".$nomr."',CURDATE(),'".$dokter."','".$kdpoly."','".trim($_POST['KDCARABAYAR'])."','".trim($_POST['NOJAMINAN'])."', now(), current_time(), '".$minta_rujukan."','".trim($_POST['SHIFT'])."','".$status."','".$_SESSION['NIP']."','".trim($_POST['nama_penanggungjawab'])."', '".trim($_POST['hubungan_penanggungjawab'])."', '".trim($_POST['alamat_penanggungjawab'])."', '".trim($_POST['phone_penanggungjawab'])."','0','".$_REQUEST['KETBAYAR']."')");
		
		
		
		$jenispoly		= $kdpoly;
		$kdprofesi		= getProfesiDoktor($_POST['KDDOKTER']);
		$kodetarif		= getKodePendaftaran($jenispoly,$kdprofesi);
		$tarif_daftar	= getTarifPendaftaran($kodetarif);
		$last_bill		= getLastNoBILL(1);
		$last_idxdaftar	= getLastIDXDAFTAR();
		$qty			= 1;
		$last_idxdaftar_fix	= getdaftar($_REQUEST['parent_nomr']);
		
		
		if($_POST['KDCARABAYAR'] > 1){
			$sql_bill	= 'insert into t_billrajal set KODETARIF = "'.$kodetarif.'", NOMR = "'.$nomr.'", KDPOLY = "'.$kdpoly.'", TANGGAL = CURDATE(), SHIFT = '.$_POST['SHIFT'].', NIP = "'.$_SESSION['NIP'].'", QTY = '.$qty.', IDXDAFTAR = '.$last_idxdaftar.', NOBILL = '.$last_bill.', ASKES = 0, COSTSHARING = 0, KETERANGAN = "-", KDDOKTER = '.$dokter.', STATUS = "SELESAI", CARABAYAR = '.$_POST['KDCARABAYAR'].', APS = 0, JASA_SARANA = '.$tarif_daftar[0].', JASA_PELAYANAN = '.$tarif_daftar[1].', TARIFRS = '.$tarif_daftar[2];
			mysql_query($sql_bill);
			$sql_bayar	= 'insert into t_bayarrajal set NOMR = "'.$nomr.'", IDXDAFTAR = "'.$last_idxdaftar.'", NOBILL = '.$last_bill.', TOTTARIFRS = '.$tarif_daftar[2]*$qty.', TOTJASA_SARANA = '.$tarif_daftar[0] * $qty.', TOTJASA_PELAYANAN = '.$tarif_daftar[1] * $qty.', APS = 0, CARABAYAR = '.$_REQUEST['KDCARABAYAR'].',TGLBAYAR=CURDATE(), JAMBAYAR=CURTIME(), JMBAYAR="'.$tarif_daftar[2]*$qty.'", NIP = "'.$_SESSION['NIP'].'", SHIFT="'.$_REQUEST['SHIFT'].'", TBP="0", LUNAS = 1, STATUS = "LUNAS"';
		mysql_query($sql_bayar);
		}else{
			$sql_bill	= mysql_query('insert into t_billrajal set KODETARIF = "'.$kodetarif.'", NOMR = "'.$nomr.'", KDPOLY = "'.$kdpoly.'", TANGGAL = CURDATE(), SHIFT = "'.$_POST['SHIFT'].'", NIP = "'.$_SESSION['NIP'].'", QTY = "'.$qty.'", IDXDAFTAR = "'.$last_idxdaftar.'", NOBILL = "'.$last_bill.'", ASKES = 0, COSTSHARING = 0, KETERANGAN = "-", KDDOKTER = "'.$dokter.'", STATUS = "SELESAI", CARABAYAR = "'.$_POST['KDCARABAYAR'].'", APS = 0, JASA_SARANA = "'.$tarif_daftar[0].'", JASA_PELAYANAN = "'.$tarif_daftar[1].'", TARIFRS = '.$tarif_daftar[2]);

			$sql_bayar	= mysql_query('insert into t_bayarrajal set NOMR = "'.$nomr.'", IDXDAFTAR = "'.$last_idxdaftar.'", NOBILL = "'.$last_bill.'", TOTTARIFRS = "'.$tarif_daftar[2]*$qty.'", TOTJASA_SARANA = "'.$tarif_daftar[0] * $qty.'", TOTJASA_PELAYANAN = "'.$tarif_daftar[1] * $qty.'", APS = 0, CARABAYAR = '.$_REQUEST['KDCARABAYAR']);
		}
		
		# update maxnobill 
		mysql_query('update m_maxnobill set nomor = '.$last_bill);
		# order admission
	}
	$last_idxdaftar	= getLastIDXDAFTAR();
	$last_idxdaftar_fix	= getdaftar($_REQUEST['parent_nomr']);
	$s	= 'insert into t_orderadmission set IDXDAFTAR = "'.$last_idxdaftar.'", NOMR = "'.$nomr.'", POLYPENGIRIM = "'.$kdpoly.'", DRPENGIRIM = "'.$_REQUEST['KDDOKTER'].'", KDCARABAYAR = "'.$_REQUEST['KDCARABAYAR'].'", KDRUJUK = "1", TGLORDER = CURDATE(), STATUS = "0"';
	mysql_query($s);
	$_SESSION['register_nomr'] = $nomr;
	$_SESSION['register_nama'] = $_REQUEST['NAMA'];
} 

}
?>
<div style="width:900px; margin-left:auto; margin-right:auto; text-align:center; margin-top:50px;">
	<div style="font-size:14px;">Data Telah di Simpan.</div>
    <div style="font-size:26px;">NOMR</div>
    <div style="font-size:74px;"><?php echo $_SESSION['register_nomr']; ?></div>
    <div style="font-size:26px;">NAMA PASIEN</div>
    <div style="font-size:74px;"><?php echo $_SESSION['register_nama']; ?></div>
    <input type="button" name="back" onclick="javascript:window.location='../index.php?link=2'" value="OK" />
</div>