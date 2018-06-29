<?php 
session_start();
include("../include/connect.php");
include("../include/function.php");

$_error_msg = "";
$pasienbaru	= $_POST['PASIENBARU'];
$status		= $_POST['STATUS'];
$ketemu 	= "0";

if( (empty($_SESSION['register_nomr'])) && (empty($_SESSION['register_nama'])) ){

if(trim($_POST['NOMR']) != ''){
	if($_POST['PASIENBARU']=="1"){
		$sqlsearchpasien = "select NAMA from m_pasien WHERE NOMR = '".trim($_POST['NOMR'])."'";
		$rowpasien = mysql_query($sqlsearchpasien)or die(mysql_error());
		if(mysql_num_rows($rowpasien) > 0){
			#$_error_msg = $_error_msg."No MR Sudah Digunakan,";
			$nomr 	= getLastNoM("1");
		}else{
			$nomr	= trim($_POST['NOMR']);
		}
	}else{
		$sqlsearchpasien = "select NAMA from m_pasien WHERE NOMR = '".trim($_POST['NOMR'])."'";
		$rowpasien = mysql_query($sqlsearchpasien)or die(mysql_error());
		if(mysql_num_rows($rowpasien) > 0) {
			$ketemu = "1";
			$nomr	= trim($_POST['NOMR']);
		}else{
			$nomr 	= getLastNoM("1");
		}
	}
}else{
	$nomr 	= getLastNoM("1");
	$ketemu	= 0;
}
#echo $nomr;
#print_r($_REQUEST);
#exit;
#if(strlen($_POST['NOMR'])!=6) $_error_msg = $_error_msg."No MR Belum Lengkap, ";
if($_POST['KDRUJUK']=="") $_error_msg = $_error_msg."Asal Pasien Belum Dipilih, ";
if($_POST['KDCARABAYAR']=="") $_error_msg = $_error_msg."Cara Bayar Belum Dipilih, ";
if($_POST['SHIFT']=="") $_error_msg = $_error_msg."Shift Belum Dipilih, ";
if($_POST['NAMA']=="") $_error_msg = $_error_msg."Nama Pasien Belum Diisi, ";
if($_POST['TEMPAT']=="") $_error_msg = $_error_msg."Tempat Lahir Belum Lengkap, ";
if($_POST['TGLLAHIR']=="") $_error_msg = $_error_msg."Tanggal Lahir Belum Lengkap, ";
if($_POST['JENISKELAMIN']=="") $_error_msg = $_error_msg."Jenis Kelamin Belum Dipilih, ";
if($_POST['ALAMAT']=="") $_error_msg = $_error_msg."Alamat Belum Lengkap, ";
if($_POST['KELURAHAN']=="") $_error_msg = $_error_msg."Kelurahan Belum Dipilih, ";
if($_POST['KDKECAMATAN']=="0") $_error_msg = $_error_msg."Kecamatan Belum Dipilih, ";
if($_POST['KOTA']=="") $_error_msg = $_error_msg."Kota Belum Lengkap, ";
if($_POST['KDPROVINSI']=="") $_error_msg = $_error_msg."Provinsi Belum Lengkap, ";
if($_POST['KDPOLY']=="0") $_error_msg = $_error_msg."Poli Belum Dipilih, ";
if(!isset($_REQUEST['KDDOKTER'])) $_error_msg = $_error_msg."Dokter Jaga Belum Ada, ";
#echo $_error_msg;
#echo $status;


if(strlen($_error_msg)>0) {
    $_error_msg = substr($_error_msg,0,strlen($_error_msg)-2).".";
    ?>

<SCRIPT language="JavaScript">
    alert("<?=$_error_msg?>");
    window.location="../index.php?link=2&PASIENBARU=<?=$_POST['PASIENBARU']?>&xNOMR=<?=$_POST['NOMR']?>&KDPOLY=<?=$_POST['KDPOLY']?>&KDDOKTER=<?=$_POST['KDDOKTER']?>&SHIFT=<?=$_POST['SHIFT']?>&TGLREG=<?=$_POST['TGLREG']?>&KDCARABAYAR=<?=$_POST['KDCARABAYAR']?>&KDRUJUK=<?=$_POST['KDRUJUK']?>&KETRUJUK=<?=$_POST['KETRUJUK']?>&NAMA=<?=$_POST['NAMA']?>&CALLER=<?=$_POST['CALLER']?>&JENISKELAMIN=<?=$_POST['JENISKELAMIN']?>&STATUS=<?=$_POST['STATUS']?>&PENDIDIKAN=<?=$_POST['PENDIDIKAN']?>&AGAMA=<?=$_POST['AGAMA']?>&TEMPAT=<?=$_POST['TEMPAT']?>&TGLLAHIR=<?=$_POST['TGLLAHIR']?>&ALAMAT=<?=$_POST['ALAMAT']?>&ALAMAT_KTP=<?=$_POST['ALAMAT_KTP']?>&KELURAHAN=<?=$_POST['KELURAHAN']?>&KDKECAMATAN=<?=$_POST['KDKECAMATAN']?>&KOTA=<?=$_POST['KOTA']?>&NOTELP=<?=$_POST['NOTELP']?>&NOKTP=<?=$_POST['NOKTP']?>&SUAMI_ORTU=<?=$_POST['SUAMI_ORTU']?>&PEKERJAAN=<?=$_POST['PEKERJAAN']?>&nama_penanggungjawab=<?=$_POST['nama_penanggungjawab']?>&hubungan_penanggungjawab=<?=$_POST['hubungan_penanggungjawab']?>&alamat_penanggungjawab=<?=$_POST['alamat_penanggungjawab']?>&phone_penanggungjawab=<?=$_POST['phone_penanggungjawab']?>&KETBAYAR=<?=$_REQUEST['KETBAYAR'];?>";
</SCRIPT>
    <?
}else{
	
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
    if(empty($_POST['STATUS'])) {
        $status = "0";
    }else {
        $status = $_POST['STATUS'];
    }

    if(!empty($_POST['CALLER'])) {
        $NAMADATA=str_replace(',',' ',$_POST['NAMA']).', '.$_REQUEST['CALLER'];
    }else {
        $NAMADATA=str_replace(',',' ',$_POST['NAMA']);
    }

    if(empty($_POST['minta_rujukan'])) {
        $minta_rujukan = "0";
    }else {
        $minta_rujukan = "1";
    }
	$tanggal_waktu = split(" | ",trim($_POST['TGLREG']));
	
	$tmpTGLLAHIR = date('Y-m-d', strtotime(str_replace('/','-',$_POST['TGLLAHIR'])));
    if($ketemu == "1") {
        $sqlupdate_pasien = "UPDATE m_pasien SET
				  NAMA  = '".addslashes($NAMADATA)."', 
				  TEMPAT  = '".addslashes($_POST['TEMPAT'])."',  
				  TGLLAHIR  = '".trim($tmpTGLLAHIR)."', 
				  JENISKELAMIN  = '".trim($_POST['JENISKELAMIN'])."', 
				  ALAMAT  = '".trim($_POST['ALAMAT'])."', 
				  KELURAHAN  = '".addslashes($_POST['KELURAHAN'])."', 
				  KDKECAMATAN  = ".addslashes($_POST['KDKECAMATAN']).", 
				  KOTA  = '".addslashes($_POST['KOTA'])."', 
				  KDPROVINSI  = ".addslashes($_POST['KDPROVINSI']).", 
				  NOTELP  = '".trim($_POST['NOTELP'])."', 
				  NOKTP  = '".trim($_POST['NOKTP'])."',  
				  SUAMI_ORTU  = '".str_replace("'","",$_REQUEST['SUAMI_ORTU'])."', 
				  PEKERJAAN  = '".addslashes($_POST['PEKERJAAN'])."',  
				  STATUS  = ".trim($status).", 
				  AGAMA  = ".trim($agama).",  
				  PENDIDIKAN  = ".trim($pendidikan).", 
				  KDCARABAYAR  = ".trim($_POST['KDCARABAYAR']).",  
				  NIP  = '".trim($_SESSION['NIP'])."',
				  ALAMAT_KTP = '".addslashes($_POST['ALAMAT_KTP'])."',
				  TITLE = '".$_REQUEST['CALLER']."',
				  PENANGGUNGJAWAB_NAMA = '".trim($_POST['nama_penanggungjawab'])."',
				  PENANGGUNGJAWAB_HUBUNGAN = '".trim($_POST['hubungan_penanggungjawab'])."',
				  PENANGGUNGJAWAB_ALAMAT = '".trim($_POST['alamat_penanggungjawab'])."',
				  PENANGGUNGJAWAB_PHONE = '".trim($_POST['phone_penanggungjawab'])."'
			WHERE NOMR = '".$nomr."' ";
        mysql_query($sqlupdate_pasien)or die(mysql_error());
    }else {	
        $sqlinsert_pasien = "INSERT INTO m_pasien (NOMR, NAMA, TEMPAT, TGLLAHIR, JENISKELAMIN, ALAMAT, KELURAHAN, KDKECAMATAN, KOTA, KDPROVINSI, NOTELP, NOKTP, SUAMI_ORTU, PEKERJAAN, STATUS, AGAMA, PENDIDIKAN, KDCARABAYAR, NIP,TGLDAFTAR, ALAMAT_KTP,TITLE,PENANGGUNGJAWAB_NAMA, PENANGGUNGJAWAB_HUBUNGAN, PENANGGUNGJAWAB_ALAMAT, PENANGGUNGJAWAB_PHONE) VALUES('".$nomr."','".addslashes($NAMADATA)."','".addslashes($_POST['TEMPAT'])."','".trim($tmpTGLLAHIR)."','".trim($_POST['JENISKELAMIN'])."','".addslashes($_POST['ALAMAT'])."','".addslashes($_POST['KELURAHAN'])."','".trim($_POST['KDKECAMATAN'])."','".addslashes($_POST['KOTA'])."','".trim($_POST['KDPROVINSI'])."','".addslashes($_POST['NOTELP'])."','".addslashes($_POST['NOKTP'])."','".addslashes($_POST['SUAMI_ORTU'])."','".addslashes($_POST['PEKERJAAN'])."','".trim($status)."','".trim($agama)."','".trim($pendidikan)."','".trim($_POST['KDCARABAYAR'])."','".trim($_SESSION['NIP'])."','".$tanggal_waktu[0]."', '".trim($_POST['ALAMAT_KTP'])."', '".$_REQUEST['CALLER']."','".trim($_POST['nama_penanggungjawab'])."', '".trim($_POST['hubungan_penanggungjawab'])."', '".trim($_POST['alamat_penanggungjawab'])."', '".trim($_POST['phone_penanggungjawab'])."')";
		
        mysql_query($sqlinsert_pasien)or die(mysql_error());
		
		mysql_query('update m_maxnomr set nomor="'.$nomr.'"');
    }	
    if($_POST['KDPOLY']=="9" || $_POST['KDPOLY']=="10") {
		#print_r($_SESSION);
		
        $sqlinsert_pendaftaran = "INSERT INTO t_pendaftaran (NOMR,TGLREG,KDDOKTER,KDPOLY,KDRUJUK,KDCARABAYAR,NOJAMINAN,JAMREG, MASUKPOLY,MINTA_RUJUKAN,SHIFT,PASIENBARU,NIP,KETRUJUK,PENANGGUNGJAWAB_NAMA, PENANGGUNGJAWAB_HUBUNGAN, PENANGGUNGJAWAB_ALAMAT, PENANGGUNGJAWAB_PHONE,status,KETBAYAR) VALUES('".$nomr."','".$tanggal_waktu[0]."',".$dokter.",".trim($_POST['KDPOLY']).",".trim($_POST['KDRUJUK']).",".trim($_POST['KDCARABAYAR']).",'".trim($_POST['NOJAMINAN'])."', '".$tanggal_waktu[0]." ".$tanggal_waktu[1]."', '".$tanggal_waktu[0]."', '".$minta_rujukan."',".trim($_POST['SHIFT']).",".$status.",'".$_SESSION['NIP']."','".trim($_POST['KETRUJUK'])."','".trim($_POST['nama_penanggungjawab'])."', '".trim($_POST['hubungan_penanggungjawab'])."', '".trim($_POST['alamat_penanggungjawab'])."', '".trim($_POST['phone_penanggungjawab'])."',0,'".$_REQUEST['KETBAYAR']."')";
    }else{
        $sqlinsert_pendaftaran = "INSERT INTO t_pendaftaran (NOMR, TGLREG, KDDOKTER, KDPOLY, KDRUJUK, KDCARABAYAR, NOJAMINAN, SHIFT, STATUS, PASIENBARU, NIP, KETRUJUK, PENANGGUNGJAWAB_NAMA, PENANGGUNGJAWAB_HUBUNGAN, PENANGGUNGJAWAB_ALAMAT, PENANGGUNGJAWAB_PHONE, JAMREG, MINTA_RUJUKAN,KETBAYAR)
								VALUES('".$nomr."','".$tanggal_waktu[0]."',".$dokter.",".trim($_POST['KDPOLY']).",".trim($_POST['KDRUJUK']).",".trim($_POST['KDCARABAYAR']).",'".trim($_POST['NOJAMINAN'])."',".trim($_POST['SHIFT']).",0,".$status.",'".trim($_SESSION['NIP'])."','".trim($_POST['KETRUJUK'])."', '".trim($_POST['nama_penanggungjawab'])."', '".trim($_POST['hubungan_penanggungjawab'])."', '".trim($_POST['alamat_penanggungjawab'])."', '".trim($_POST['phone_penanggungjawab'])."', '".$tanggal_waktu[0]." ".$tanggal_waktu[1]."', '".$minta_rujukan."','".$_REQUEST['KETBAYAR']."')";						
    }
	mysql_query($sqlinsert_pendaftaran)or die(mysql_error());
    if($_POST['KDPOLY']=="51") {
        $sql_idx_daftar = "select IDXDAFTAR FROM t_pendaftaran WHERE NOMR = '".$nomr."' ORDER BY IDXDAFTAR DESC LIMIT 1";
        $query_idx_daftar=mysql_query($sql_idx_daftar);
        $data_idx_daftar=mysql_fetch_assoc($query_idx_daftar);
        $idx_daftar = $data_idx_daftar['IDXDAFTAR'];

        $ins_operasi="INSERT INTO t_operasi(nomr, KDUNIT, IDXDAFTAR, RAJAL, NIP, TGLORDER) VALUES('".$nomr."', ".$_SESSION['KDUNIT'].", ".$idx_daftar.", 2, '".$_SESSION['NIP']."', '".$tanggal_waktu[0]."')";
        mysql_query($ins_operasi);
    }
    if(!empty($_POST['start_daftar']) && !empty($_POST['stop_daftar'])){
        $sql_last_daftar = "select IDXDAFTAR, NOMR FROM t_pendaftaran ORDER BY IDXDAFTAR DESC LIMIT 1";
        $query_last_daftar=mysql_query($sql_last_daftar);
        $data_last_daftar=mysql_fetch_assoc($query_last_daftar);
        $idx_daftar = $data_last_daftar['IDXDAFTAR'];
        $nomr_last = $data_last_daftar['NOMR'];
        $start_daftar = $_POST['start_daftar'];
        $stop_daftar = $_POST['stop_daftar'];

        $sql_insert_time_daftar = "INSERT INTO t_pendaftaran_iso  (idxdaftar, NOMR, start_daftar, stop_daftar) VALUES ($idx_daftar, '$nomr_last', '$start_daftar', '$stop_daftar')";
        mysql_query($sql_insert_time_daftar) or die();
    }
	$jenispoly		= $_POST['KDPOLY'];
	$kdprofesi		= getProfesiDoktor($_POST['KDDOKTER']);
	$kodetarif		= getKodePendaftaran($jenispoly,$kdprofesi);
	$tarif_daftar	= getTarifPendaftaran($kodetarif);
	$last_bill		= getLastNoBILL(1);
	$last_idxdaftar	= getLastIDXDAFTAR();
	$qty			= 1;
	
	$_SESSION['poly'] = $_POST['KDPOLY'];
	$_SESSION['idx']  = $last_idxdaftar;
	$_SESSION['status']	= $status;
	
	$ip 	= getRealIpAddr();
	$tarif 	= getTarif($kodetarif);
	
	mysql_query('insert into tmp_cartbayar set KODETARIF = "'.$kodetarif.'", QTY = 1, IP = "'.$ip.'", ID = "'.$kodetarif.'", POLY = "'.$_REQUEST['KDPOLY'].'", KDDOKTER='.$_REQUEST['KDDOKTER'].',TARIF = "'.$tarif['tarif'].'", TOTTARIF = '.$tarif['tarif'].', JASA_PELAYANAN = '.$tarif['jasa_pelayanan'].', JASA_SARANA = '.$tarif['jasa_sarana'].', UNIT = '.$_REQUEST['KDPOLY']);
	
	$sql='CALL pr_savebill_tindakanrajal_dokter("'.$nomr.'",'.$_REQUEST['SHIFT'].',"'.$_SESSION['NIP'].'","'.$last_idxdaftar.'","'.$tanggal_waktu[0].'",0,0,"'.$ip.'",'.$_REQUEST['KDCARABAYAR'].','.$_REQUEST['KDPOLY'].',0,"'.$_REQUEST['KDDOKTER'].'","'.$_REQUEST['KDPOLY'].'")';
	mysql_query($sql);
	/*
	if($_POST['KDCARABAYAR'] > 1){
		$sql_bill	= 'insert into t_billrajal set KODETARIF = "'.$kodetarif.'", NOMR = "'.$nomr.'", KDPOLY = "'.$_POST['KDPOLY'].'", TANGGAL = CURDATE(), SHIFT = '.$_POST['SHIFT'].', NIP = "'.$_SESSION['NIP'].'", QTY = '.$qty.', IDXDAFTAR = '.$last_idxdaftar.', NOBILL = '.$last_bill.', ASKES = 0, COSTSHARING = 0, KETERANGAN = "-", KDDOKTER = '.$dokter.', STATUS = "SELESAI", CARABAYAR = '.$_POST['KDCARABAYAR'].', APS = 0, JASA_SARANA = '.$tarif_daftar[0].', JASA_PELAYANAN = '.$tarif_daftar[1].', UNIT='.$_POST['KDPOLY'].', TARIFRS = '.$tarif_daftar[2];
		mysql_query($sql_bill);
		$sql_bayar	= 'insert into t_bayarrajal set NOMR = "'.$nomr.'", IDXDAFTAR = '.$last_idxdaftar.', NOBILL = '.$last_bill.', TOTTARIFRS = '.$tarif_daftar[2]*$qty.', TOTJASA_SARANA = '.$tarif_daftar[0] * $qty.', TOTJASA_PELAYANAN = '.$tarif_daftar[1] * $qty.', APS = 0, CARABAYAR = '.$_REQUEST['KDCARABAYAR'].',TGLBAYAR=CURDATE(), JAMBAYAR=CURTIME(), JMBAYAR="'.$tarif_daftar[2]*$qty.'", NIP = "'.$_SESSION['NIP'].'", SHIFT="'.$_REQUEST['SHIFT'].'", TBP="0", UNIT='.$_POST['KDPOLY'].', LUNAS = 1, STATUS = "LUNAS"';
		mysql_query($sql_bayar);
	}else{
		$sql_bill	= mysql_query('insert into t_billrajal set KODETARIF = "'.$kodetarif.'", NOMR = "'.$nomr.'", KDPOLY = "'.$_POST['KDPOLY'].'", TANGGAL = CURDATE(), SHIFT = '.$_POST['SHIFT'].', NIP = "'.$_SESSION['NIP'].'", QTY = '.$qty.', IDXDAFTAR = '.$last_idxdaftar.', NOBILL = '.$last_bill.', ASKES = 0, COSTSHARING = 0, KETERANGAN = "-", KDDOKTER = '.$dokter.', STATUS = "SELESAI", CARABAYAR = '.$_POST['KDCARABAYAR'].', APS = 0, JASA_SARANA = '.$tarif_daftar[0].', JASA_PELAYANAN = '.$tarif_daftar[1].', UNIT='.$_POST['KDPOLY'].', TARIFRS = '.$tarif_daftar[2]);
		$sql_bayar	= mysql_query('insert into t_bayarrajal set NOMR = "'.$nomr.'", IDXDAFTAR = '.$last_idxdaftar.', NOBILL = '.$last_bill.', TOTTARIFRS = '.$tarif_daftar[2]*$qty.', UNIT='.$_POST['KDPOLY'].', TOTJASA_SARANA = '.$tarif_daftar[0] * $qty.', TOTJASA_PELAYANAN = '.$tarif_daftar[1] * $qty.', APS = 0, CARABAYAR = '.$_REQUEST['KDCARABAYAR']);
	}
	# update maxnobill 
	mysql_query('update m_maxnobill set nomor = '.$last_bill);
	*/
	
	
	$_SESSION['register_nomr'] = $nomr;
	$_SESSION['register_nama'] = $NAMADATA;
//} ?>


<!--
<SCRIPT language="JavaScript">
    alert("Data Telah Disimpan. \n NOMR <?php echo $NAMADATA; ?> adalah <?php echo $nomr; ?>");
    window.location="../index.php?link=2";
</SCRIPT>
-->

<? 
}
}
?>

<script src="../js/jquery-1.7.min.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript">
	jQuery.noConflict();
</script>
<script>
function cetakkartu(){
window.open("../pdfb/kartupasien.php?NOMR=<?php echo $_SESSION['register_nomr']; ?>&NAMA=<?php echo $_SESSION['register_nama'] ?>&ALAMAT=<?php echo $_REQUEST['ALAMAT'];?>");
}
jQuery(document).ready(function(){
	jQuery('.printrm').click(function(){
		//jQuery('#show_print').printArea();
		//return false;
		//alert('asda');
		var idx 	= jQuery('#idx').val();
		var poly	= jQuery('#poly').val();
		var status	= jQuery('#status').val();
		jQuery.post('<?php echo _BASE_.'print_tracer.php';?>',{idx:<?php echo $_SESSION['idx'];?>,poly:<?php echo $_SESSION['poly'];?>,status:<?php echo $_SESSION['status'];?>},function(data){
			jQuery('#show_print').empty().html(data);
			w=window.open();
			w.document.write(jQuery('#show_print').html());
			w.print();
			w.close();
			jQuery('#show_print').empty();
		});
		
	});
});
</script>
<style type="text/css" media="print">
#show_print{display:block;}
</style>
<style type="text/css" media="screen">
#show_print{display:none;}
</style>
<div id="show_print"></div>
<div style="width:900px; margin-left:auto; margin-right:auto; text-align:center; margin-top:50px;">
	<div style="font-size:14px;">Data Telah di Simpan.</div>
    <div style="font-size:26px;">NO.MR</div>
    <div style="font-size:74px;"><?php echo $_SESSION['register_nomr']; ?></div>
    <div style="font-size:26px;">NAMA PASIEN</div>
    <div style="font-size:74px;"><?php echo $_SESSION['register_nama']; ?></div>
    <input type="button" name="back" onclick="javascript:window.location='../index.php?link=2'" value="OK" />
    &nbsp;&nbsp;
    <input type="button" name="back" onclick="javascript:cetakkartu()" value="Cetak Kartu" />
    &nbsp;&nbsp;
    <input type="button" name="back"  class="printrm" value="Print Tracer" />
</div>
