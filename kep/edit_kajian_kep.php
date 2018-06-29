<?php 
	session_start();
	include("../include/connect.php");
	include("../include/function.php");
	$_SESSION['hal']="2"; 
	$NOMR=$_POST['NOMR'];
	$tampungALERGI = "";
	foreach($_POST['ALERGI_OBAT'] as $ALERGI_OBAT) 
	{
		if($ALERGI_OBAT == "_M_"){
			$tampungALERGI = $tampungALERGI.$ALERGI_OBAT.$_POST['ALERGI_MAKAN'].",";
		}else if($ALERGI_OBAT == "_L_"){
			$tampungALERGI = $tampungALERGI.$ALERGI_OBAT.$_POST['lainALERGI'].",";
		}else{
			$tampungALERGI = $tampungALERGI.$ALERGI_OBAT.",";
		}
	}
	$tampungALERGI = substr_replace($tampungALERGI ,"",-1);
	
	$REAKSI = "";
	foreach($_POST['REAKSI_ALERGI'] as $REAKSI_ALERGI) 
	{
		if($REAKSI_ALERGI == "_L_"){
			$REAKSI = $REAKSI.$REAKSI_ALERGI.$_POST['lainREAKSI'].",";
		}else{
			$REAKSI = $REAKSI.$REAKSI_ALERGI.",";
		}
	}
	$REAKSI = substr_replace($REAKSI ,"",-1);
	
	$RIWAYAT = "";
	foreach($_POST['RIWAYAT_KES'] as $RIWAYAT_KES) 
	{
		if($RIWAYAT_KES == "_L_"){
			$RIWAYAT = $RIWAYAT.$RIWAYAT_KES.$_POST['lainRIWAYAT'].",";
		}else{
			$RIWAYAT = $RIWAYAT.$RIWAYAT_KES.",";
		}
	}
	$RIWAYAT = substr_replace($RIWAYAT ,"",-1);
	
	$FISIK = "";
	foreach($_POST['PEMERIKSAAN_FISIK'] as $PEMERIKSAAN_FISIK) 
	{
		if($PEMERIKSAAN_FISIK == "_F_"){
			$FISIK = $FISIK.$PEMERIKSAAN_FISIK.$_POST['lainFISIK'].",";
		}else{
			$FISIK = $FISIK.$PEMERIKSAAN_FISIK.",";
		}
	}
	$FISIK = substr_replace($FISIK ,"",-1);
	
	$kes_diri = "";
	foreach($_POST['KES_DIRI'] as $KES_DIRI) {
		$kes_diri = $kes_diri.$KES_DIRI.",";
	}
	$kes_diri = substr_replace($kes_diri ,"",-1);

	$suport = "";
	foreach($_POST['SOS_SUPORT'] as $SOS_SUPORT) 
	{
		if($SOS_SUPORT == "_L_"){
			$suport = $suport.$SOS_SUPORT.$_POST['lainKEL'].",";
		}else{
			$suport = $suport.$SOS_SUPORT.",";
		}
	}
	$suport = substr_replace($suport ,"",-1);
	
	$hilang = "";
	foreach($_POST['KEHILANGAN'] as $KEHILANGAN) 
	{
		if($KEHILANGAN == "_L_"){
			$hilang = $hilang.$KEHILANGAN.$_POST['lainHILANG'].",";
		}else{
			$hilang = $hilang.$KEHILANGAN.",";
		}
	}
	$hilang = substr_replace($hilang ,"",-1);
	
	$emosi = "";
	foreach($_POST['STATUS_EMOSI'] as $STATUS_EMOSI) {
		$emosi = $emosi.$STATUS_EMOSI.",";
	}
	$emosi = substr_replace($emosi ,"",-1);
	
	$konsep = "";
	foreach($_POST['KONSEP_DIRI'] as $KONSEP_DIRI) 
	{
		if($KONSEP_DIRI == "_I_"){
			$konsep = $konsep.$KONSEP_DIRI.$_POST['identitas'].",";
		}else if($KONSEP_DIRI == "_H_"){
			$konsep = $konsep.$KONSEP_DIRI.$_POST['harga_diri'].",";
		}else{
			$konsep = $konsep.$KONSEP_DIRI.",";
		}
	}
	$konsep = substr_replace($konsep ,"",-1);
	
	$respon = "";
	foreach($_POST['RESPON_HILANG'] as $RESPON_HILANG) {
		$respon = $respon.$RESPON_HILANG.",";
	}
	$respon = substr_replace($respon ,"",-1);
	
	$stress = "";
	foreach($_POST['SUMBER_STRESS'] as $SUMBER_STRESS) {
		$stress = $stress.$SUMBER_STRESS.",";
	}
	$stress = substr_replace($stress ,"",-1);
	
	
	
	
	
	$sadar = "";
	foreach($_POST['KESADARAN'] as $KESADARAN) {
		$sadar = $sadar.$KESADARAN.",";
	}
	$sadar = substr_replace($sadar ,"",-1);
	
	$kepala = "";
	foreach($_POST['KEPALA'] as $KEPALA) 
	{
		if($KEPALA == "_L_"){
			$kepala = $kepala.$KEPALA.$_POST['lainKEPALA'].",";
		}else{
			$kepala = $kepala.$KEPALA.",";
		}
	}
	$kepala = substr_replace($kepala ,"",-1);
	
	$rambut = "";
	foreach($_POST['RAMBUT'] as $RAMBUT) 
	{
		if($RAMBUT == "_L_"){
			$rambut = $rambut.$RAMBUT.$_POST['lainRAMBUT'].",";
		}else{
			$rambut = $rambut.$RAMBUT.",";
		}
	}
	$rambut = substr_replace($rambut ,"",-1);
	
	$muka = "";
	foreach($_POST['MUKA'] as $MUKA) 
	{
		if($MUKA == "_L_"){
			$muka = $muka.$MUKA.$_POST['lainMUKA'].",";
		}else{
			$muka = $muka.$MUKA.",";
		}
	}
	$muka = substr_replace($muka ,"",-1);
	
	$mata = "";
	foreach($_POST['MATA'] as $MATA) 
	{
		if($MATA == "_L_"){
			$mata = $mata.$MATA.$_POST['lainMATA'].",";
		}else{
			$mata = $mata.$MATA.",";
		}
	}
	$mata = substr_replace($mata ,"",-1);
	
	$lihatGANG = "";
	foreach($_POST['GANG_LIHAT'] as $GANG_LIHAT) 
	{
		if($GANG_LIHAT == "_L_"){
			$lihatGANG = $lihatGANG.$GANG_LIHAT.$_POST['lainGANG'].",";
		}else{
			$lihatGANG = $lihatGANG.$GANG_LIHAT.",";
		}
	}
	$lihatGANG = substr_replace($lihatGANG ,"",-1);
	
	$alatBANTU = "";
	foreach($_POST['ALATBANTU_LIHAT'] as $ALATBANTU_LIHAT) 
	{
			$alatBANTU = $alatBANTU.$ALATBANTU_LIHAT.",";
		}
	
	$lihatBANTU = substr_replace($lihatBANTU ,"",-1);
	
	$bentuk = "";
	foreach($_POST['BENTUK'] as $BENTUK) 
	{
			$bentuk = $bentuk.$BENTUK.",";
		}
	
	$bentuk = substr_replace($bentuk ,"",-1);
	
	$dengar = "";
	foreach($_POST['PENDENGARAN'] as $PENDENGARAN) 
	{
			$dengar = $dengar.$PENDENGARAN.",";
		}
	
	$dengar = substr_replace($dengar ,"",-1);
	
	$telinga = "";
	foreach($_POST['LUB_TELINGA'] as $LUB_TELINGA) 
	{
		if($LUB_TELINGA == "_L_") {
			$telinga = $telinga.$LUB_TELINGA.$_POST['warnaTELINGA'].",";
		}else{
			$telinga = $telinga.$LUB_TELINGA.",";
		}
	}
	$telinga = substr_replace($telinga ,"",-1);
	
	$hidung = "";
	foreach($_POST['BENTUK_HIDUNG'] as $BENTUK_HIDUNG) 
	{
		$hidung = $hidung.$BENTUK_HIDUNG.",";
		}
	$hidung = substr_replace($hidung ,"",-1);
	
	$membran = "";
	foreach($_POST['MEMBRAN_MUK'] as $MEMBRAN_MUK) 
	{
		$membran = $membran.$MEMBRAN_MUK.",";
		}
	$membran = substr_replace($membran ,"",-1);
	
	$gigi = "";
	foreach($_POST['GIGI'] as $GIGI) 
	{
	if($GIGI == "_L_"){
		$gigi = $gigi.$GIGI.$_POST['jumlahGIGI'].",";
	}else{
		$gigi = $gigi.$GIGI.",";
		}
	}
	$gigi = substr_replace($gigi ,"",-1);
	
	$tonsil = "";
	foreach($_POST['TONSIL'] as $TONSIL) 
	{
		$tonsil = $tonsil.$TONSIL.",";
		}
	$tonsil = substr_replace($tonsil ,"",-1);
	
	$kelainan = "";
	foreach($_POST['KELAINAN'] as $KELAINAN) 
	{
	if($KELAINAN == "_L_"){
		$kelainan = $kelainan.$KELAINAN.$_POST['lainGANGGUAN'].",";
	}else{
		$kelainan = $kelainan.$KELAINAN.",";
		}
	}
	$kelainan = substr_replace($kelainan ,"",-1);
	
	$gerakan = "";
	foreach($_POST['PERGERAKAN'] as $PERGERAKAN) 
	{
		$gerakan = $gerakan.$PERGERAKAN.",";
	}
	$gerakan = substr_replace($gerakan ,"",-1);
	
	$bentuk_dada = "";
	foreach($_POST['BENTUK_DADA'] as $BENTUK_DADA) 
	{
		$bentuk_dada = $bentuk_dada.$BENTUK_DADA.",";
	}
	$bentuk_dada = substr_replace($bentuk_dada,"",-1);
	
	$pola_napas = "";
	foreach($_POST['POLA_NAPAS'] as $POLA_NAPAS) 
	{
	if($POLA_NAPAS == "_L_") {
		$pola_napas = $pola_napas.$POLA_NAPAS.$_POST['polaLAIN'].",";
	}else{
		$pola_napas = $pola_napas.$POLA_NAPAS.",";
		}
	}
	$pola_napas = substr_replace($pola_napas,"",-1);
	
	$thoraks = "";
	foreach($_POST['BENTUK_THORAKS'] as $BENTUK_THORAKS) 
	{
		$thoraks = $thoraks.$BENTUK_THORAKS.",";
	}
	$thoraks = substr_replace($thoraks,"",-1);
	
	$krepitasi = "";
	foreach($_POST['PAL_KREP'] as $PAL_KREP) 
	{
	if($PAL_KREP == "_1_") {
		$krepitasi = $krepitasi.$PAL_KREP.$_POST['krepitasi_ada'].",";
	}else{
		$krepitasi = $krepitasi.$PAL_KREP.",";
		}
	}
	$krepitasi = substr_replace($krepitasi,"",-1);
	
	$benjol = "";
	foreach($_POST['BENJOLAN'] as $BENJOLAN) 
	{
	if($BENJOLAN == "_1_") {
		$benjol = $benjol.$BENJOLAN.$_POST['benjolan_ada'].",";
	}else{
		$benjol = $benjol.$BENJOLAN.",";
		}
	}
	$benjol = substr_replace($benjol,"",-1);
	
	$nyeri = "";
	foreach($_POST['PAL_NYERI'] as $PAL_NYERI) 
	{
	if($PAL_NYERI == "_1_") {
		$nyeri = $nyeri.$PAL_NYERI.$_POST['nyeri_ada'].",";
	}else{
		$nyeri = $nyeri.$PAL_NYERI.",";
		}
	}
	$nyeri = substr_replace($nyeri,"",-1);
	
	$perkusi = "";
	foreach($_POST['PERKUSI'] as $PERKUSI) 
	{
		$perkusi = $perkusi.$PERKUSI.",";
	}
	$perkusi = substr_replace($perkusi,"",-1);
	
	$paru = "";
	foreach($_POST['PARU'] as $PARU) 
	{
		$paru = $paru.$PARU.",";
	}
	$paru = substr_replace($paru,"",-1);
	
	$suara = "";
	foreach($_POST['SUARA_JANTUNG'] as $SUARA_JANTUNG) 
	{
		$suara = $suara.$SUARA_JANTUNG.",";
	}
	$suara = substr_replace($suara,"",-1);
	
	$jantung = "";
	foreach($_POST['JANTUNG'] as $JANTUNG) 
	{
	if($JANTUNG == "_T_") {
		$jantung = $jantung.$JANTUNG.$_POST['tacJANTUNG'].",";
	}else if($JANTUNG == "_B_") {
		$jantung = $jantung.$JANTUNG.$_POST['braJANTUNG'].",";
	}else if($JANTUNG == "_L_") {
		$jantung = $jantung.$JANTUNG.$_POST['JANTUNGlain'].",";
	}else{
		$jantung = $jantung.$JANTUNG.",";
		}
	}
	$jantung = substr_replace($jantung,"",-1);
	
	$alatBANTU = "";
	foreach($_POST['ALATBANTU_JAN'] as $ALATBANTU_JAN) 
	{
	if($ALATBANTU_JAN == "_L_") {
		$alatBANTU = 	$alatBANTU.$ALATBANTU_JAN.$_POST['lainALAT'].",";
	}else{
		$alatBANTU = $alatBANTU.$ALATBANTU_JAN.",";
		}
	}
	$alatBANTU = substr_replace($alatBANTU,"",-1);
	
	$abdomen = "";
	foreach($_POST['BENTUK_ABDOMEN'] as $BENTUK_ABDOMEN) 
	{
	if($BENTUK_ABDOMEN == "_L_") {
		$abdomen = 	$abdomen.$BENTUK_ABDOMEN.$_POST['lingkar'].",";
	}else{
		$abdomen = $abdomen.$BENTUK_ABDOMEN.",";
		}
	}
	$abdomen = substr_replace($abdomen,"",-1);
	
	$auskultasi = "";
	foreach($_POST['AUSKULTASI'] as $AUSKULTASI) 
	{
	if($AUSKULTASI == "_1_") {
		$auskultasi = $auskultasi.$AUSKULTASI.$_POST['auskultasiSATU'].",";
	}else if($AUSKULTASI == "_2_") {
		$auskultasi = $auskultasi.$AUSKULTASI.$_POST['auskultasiDUA'].",";
	}else if($AUSKULTASI == "_3_") {
		$auskultasi = $auskultasi.$AUSKULTASI.$_POST['auskultasiTIGA'].",";
	}else if($AUSKULTASI == "_4_") {
		$auskultasi = $auskultasi.$AUSKULTASI.$_POST['auskultasiEMPAT'].",";
	}else if($AUSKULTASI == "_5_") {
		$auskultasi = $auskultasi.$AUSKULTASI.$_POST['auskultasiLIMA'].",";
	}else{
		$auskultasi = $auskultasi.$AUSKULTASI.",";
		}
	}
	$auskultasi = substr_replace($auskultasi,"",-1);
	
	$pasi_nyeri = "";
	foreach($_POST['NYERI_PASI'] as $NYERI_PASI) 
	{
		$pasi_nyeri = $pasi_nyeri.$NYERI_PASI.",";
		}
	$pasi_nyeri = substr_replace($pasi_nyeri,"",-1);
	
	$kelenjar = "";
	foreach($_POST['PEM_KELENJAR'] as $PEM_KELENJAR) 
	{
		$kelenjar = $kelenjar.$PEM_KELENJAR.",";
		}
	$kelenjar = substr_replace($kelenjar,"",-1);
	
	$perkusiAUS = "";
	foreach($_POST['PERKUSI_AUS'] as $PERKUSI_AUS) 
	{
		$perkusiAUS = $perkusiAUS.$PERKUSI_AUS.",";
		}
	$perkusiAUS = substr_replace($perkusiAUS,"",-1);
	
	$hamil = "";
	foreach($_POST['HAMIL'] as $HAMIL) 
	{
	if($HAMIL == "_Y_") {
		$hamil = $hamil.$HAMIL.$_POST['G'].",";
		$hamil = $hamil.$HAMIL.$_POST['P'].",";
		$hamil = $hamil.$HAMIL.$_POST['A'].",";
	}else{
		$hamil = $hamil.$HAMIL.",";
		}
	}
	$hamil = substr_replace($hamil,"",-1);
	
	$payudara = "";
	foreach($_POST['BENTUK_PAYUDARA'] as $BENTUK_PAYUDARA) 
	{
		$payudara = $payudara.$BENTUK_PAYUDARA.",";
		}
	$payudara = substr_replace($payudara,"",-1);
	
	$massa = "";
	foreach($_POST['MASSA'] as $MASSA) 
	{
	if($MASSA == "_1_") {
		$massa = $massa.$MASSA.$_POST['ADAbenjolan'].",";
	}else{
		$massa = $massa.$MASSA.",";
		}
	}
	$massa = substr_replace($massa,"",-1);
	
	$nyeriRABA = "";
	foreach($_POST['NYERI_RABA'] as $NYERI_RABA) 
	{
	if($NYERI_RABA == "_1_") {
		$nyeriRABA = $nyeriRABA.$NYERI_RABA.$_POST['nyeri'].",";
	}else{
		$nyeriRABA = $nyeriRABA.$NYERI_RABA.",";
		}
	}
	$nyeriRABA = substr_replace($nyeriRABA,"",-1);
	
	$preputium = "";
	foreach($_POST['PREPUTIUM'] as $PREPUTIUM) 
	{
		$preputium = $preputium.$PREPUTIUM.",";
		}
	$preputium = substr_replace($preputium,"",-1);
	
	$bentukSKROTUM = "";
	foreach($_POST['BENTUK_SKROTUM'] as $BENTUK_SKROTUM) 
	{
		$bentukSKROTUM = $bentukSKROTUM.$BENTUK_SKROTUM.",";
		}
	$bentukSKROTUM = substr_replace($bentukSKROTUM,"",-1);
	
	$testis = "";
	foreach($_POST['TESTIS'] as $TESTIS) 
	{
		$testis = $testis.$TESTIS.",";
		}
	$testis = substr_replace($testis,"",-1);
	
	$benMASSA = "";
	foreach($_POST['MASSA_BEN'] as $MASSA_BEN) 
	{
	if ($MASSA_BEN == "_1_") {
		$benMASSA = $benMASSA.$MASSA_BEN.$_POST['ADAmassa'].",";
	}else{
		$benMASSA = $benMASSA.$MASSA_BEN.",";
		}
	}
	$benMASSA = substr_replace($benMASSA,"",-1);
	
	$herniasi = "";
	foreach($_POST['HERNIASI'] as $HERNIASI) 
	{
	if ($HERNIASI == "_1_") {
		$herniasi = $herniasi.$HERNIASI.$_POST['ada_hernia'].",";
	}else{
		$herniasi = $herniasi.$HERNIASI.",";
		}
	}
	$herniasi = substr_replace($herniasi,"",-1);
	
	$ekstremATAS = "";
	foreach($_POST['EKSTREMITAS_ATAS'] as $EKSTREMITAS_ATAS) 
	{
	if($EKSTREMITAS_ATAS == "_1_") {
		$ekstremATAS = $ekstremATAS.$EKSTREMITAS_ATAS.$_POST['ekstrem_atas'].",";
	}else if($EKSTREMITAS_ATAS == "_6_") {
		$ekstremATAS = $ekstremATAS.$EKSTREMITAS_ATAS.$_POST['ada_patah'].",";
	}else if($EKSTREMITAS_ATAS == "_9_") {
		$ekstremATAS = $ekstremATAS.$EKSTREMITAS_ATAS.$_POST['herni'].",";
	}else if($EKSTREMITAS_ATAS == "_P_") {
		$ekstremATAS = $ekstremATAS.$EKSTREMITAS_ATAS.$_POST['parese'].",";
	}else if($EKSTREMITAS_ATAS == "_K_") {
		$ekstremATAS = $ekstremATAS.$EKSTREMITAS_ATAS.$_POST['kelainan_ekstrem'].",";
	}else if($EKSTREMITAS_ATAS == "_L_") {
		$ekstremATAS = $ekstremATAS.$EKSTREMITAS_ATAS.$_POST['kelainan'].",";
	}else{
		$ekstremATAS = $ekstremATAS.$EKSTREMITAS_ATAS.",";
		}
	}
	$ekstremATAS = substr_replace($ekstremATAS,"",-1);
	
	$ekstremBAWAH = "";
	foreach($_POST['EKSTREMITAS_BAWAH'] as $EKSTREMITAS_BAWAH) 
	{
	if($EKSTREMITAS_BAWAH == "_1_") {
		$ekstremBAWAH = $ekstremBAWAH.$EKSTREMITAS_BAWAH.$_POST['otot_kuat'].",";
	}else if($EKSTREMITAS_BAWAH == "_4_") {
		$ekstremBAWAH = $ekstremBAWAH.$EKSTREMITAS_BAWAH.$_POST['plegi'].",";
	}else if($EKSTREMITAS_BAWAH == "_5_") {
		$ekstremBAWAH = $ekstremBAWAH.$EKSTREMITAS_BAWAH.$_POST['parese_x'].",";
	}else if($EKSTREMITAS_BAWAH == "_6_") {
		$ekstremBAWAH = $ekstremBAWAH.$EKSTREMITAS_BAWAH.$_POST['kelainan_kongenital'].",";
	}else if($EKSTREMITAS_BAWAH == "_L_") {
		$ekstremBAWAH = $ekstremBAWAH.$EKSTREMITAS_BAWAH.$_POST['LAINkelainan'].",";
	}else{
		$ekstremBAWAH = $ekstremBAWAH.$EKSTREMITAS_BAWAH.",";
		}
	}
	$ekstremBAWAH = substr_replace($ekstremBAWAH,"",-1);
	
	$aktivitas = "";
	foreach($_POST['AKTIVITAS'] as $AKTIVITAS) 
	{
		$aktivitas = $aktivitas.$AKTIVITAS.",";
		}
	$aktivitas = substr_replace($aktivitas,"",-1);
	
	$jalan = "";
	foreach($_POST['BERJALAN'] as $BERJALAN) 
	{
		$jalan = $jalan.$BERJALAN.",";
		}
	$jalan = substr_replace($jalan,"",-1);
	
	$inteSISTEM = "";
	foreach($_POST['SISTEM_INTE'] as $SISTEM_INTE) 
	{
	if($SISTEM_INTE == "_W_") {
		$inteSISTEM = $inteSISTEM.$SISTEM_INTE.$_POST['SISTEMwarna'].",";
	}else if($SISTEM_INTE == "_L_") {
		$inteSISTEM = $inteSISTEM.$SISTEM_INTE.$_POST['lain-lain'].",";
	}else{
		$inteSISTEM = $inteSISTEM.$SISTEM_INTE.",";
		}
	}
	$inteSISTEM = substr_replace($inteSISTEM,"",-1);
	
	$nyaman = "";
	foreach($_POST['KENYAMANAN'] as $KENYAMANAN) 
	{
	if($KENYAMANAN == "_1_") {
		$nyaman = $nyaman.$KENYAMANAN.$_POST['lokasi'].",";
	}else if($KENYAMANAN == "_2_") {
		$nyaman = $nyaman.$KENYAMANAN.$_POST['lama_nyeri'].",";
	}else if($KENYAMANAN == "_3_"){
		$nyaman = $nyaman.$KENYAMANAN.$_POST['faktor_pencetus'].",";
	}else if($KENYAMANAN == "_4_") {
		$nyaman = $nyaman.$KENYAMANAN.$_POST['kualitas_nyeri'].",";
	}else if($KENYAMANAN == "_5_") {
		$nyaman = $nyaman.$KENYAMANAN.$_POST['pola_serangan'].",";
	}else if($KENYAMANAN == "_6_") {
		$nyaman = $nyaman.$KENYAMANAN.$_POST['hal_hal'].",";
	}else{
		$nyaman = $nyaman.$KENYAMANAN.",";
		}
	}
	$nyaman = substr_replace($nyaman,"",-1);
	$tampungBERARTI = "";
	foreach($_POST['BERARTI'] as $BERARTI) 
	{
		if($BERARTI == "_L_"){
			$tampungBERARTI = $tampungBERARTI.$BERARTI.$_POST['lainBERARTI'].",";
		}else{
			$tampungBERARTI = $tampungBERARTI.$BERARTI.",";
		}
	}
	$tampungBERARTI = substr_replace($tampungBERARTI ,"",-1);
	$tampungKOMUNIKASI = "";
	foreach($_POST['KOMUNIKASI'] as $KOMUNIKASI) 
	{
		if($KOMUNIKASI == "_9_"){
			$tampungKOMUNIKASI = $tampungKOMUNIKASI.$KOMUNIKASI.$_POST['komunikasi_kel'].",";
		}else if($KOMUNIKASI == "_10_"){
			$tampungKOMUNIKASI = $tampungKOMUNIKASI.$KOMUNIKASI.$_POST['komunikasi_mas'].",";
		}else if($KOMUNIKASI == "_11_"){
			$tampungKOMUNIKASI = $tampungKOMUNIKASI.$KOMUNIKASI.$_POST['bahasaKOMUNIKASI'].",";
		}else if($KOMUNIKASI == "_14_"){
			$tampungKOMUNIKASI = $tampungKOMUNIKASI.$KOMUNIKASI.$_POST['lainKOMUNIKASI'].",";
		}else{
			$tampungKOMUNIKASI = $tampungKOMUNIKASI.$KOMUNIKASI.",";
		}
	}
	$tampungKOMUNIKASI = substr_replace($tampungKOMUNIKASI ,"",-1);
	$tampungKEPUTUSAN = "";
	foreach($_POST['KEPUTUSAN'] as $KEPUTUSAN) 
	{
		if($KEPUTUSAN == "_6_"){
			$tampungKEPUTUSAN = $tampungKEPUTUSAN.$KEPUTUSAN.$_POST['lainKEPUTUSAN'].",";
		}else{
			$tampungKEPUTUSAN = $tampungKEPUTUSAN.$KEPUTUSAN.",";
		}
	}
	$tampungKEPUTUSAN = substr_replace($tampungKEPUTUSAN ,"",-1);
	$tampungMENGASUH = "";
	foreach($_POST['MENGASUH'] as $MENGASUH) 
	{
		if($MENGASUH == "_5_"){
			$tampungMENGASUH = $tampungMENGASUH.$MENGASUH.$_POST['lainMENGASUH'].",";
		}else{
			$tampungMENGASUH = $tampungMENGASUH.$MENGASUH.",";
		}
	}
	$tampungMENGASUH = substr_replace($tampungMENGASUH ,"",-1);
	$tampungDUKUNGAN = "";
	foreach($_POST['DUKUNGAN'] as $DUKUNGAN) 
	{
		$tampungDUKUNGAN = $tampungDUKUNGAN.$DUKUNGAN.",";
	}
	$tampungDUKUNGAN = substr_replace($tampungDUKUNGAN ,"",-1);
	$tampungREAKSI = "";
	foreach($_POST['REAKSI'] as $REAKSIlagi) 
	{
		$tampungREAKSI = $tampungREAKSI.$REAKSIlagi.",";
	}
	$tampungREAKSI = substr_replace($tampungREAKSI ,"",-1);
	$tampungBUDAYA = "";
	foreach($_POST['BUDAYA'] as $BUDAYA) 
	{
		if($BUDAYA == "_5_"){
			$tampungBUDAYA = $tampungBUDAYA.$BUDAYA.$_POST['lainBUDAYA'].",";
		}else{
			$tampungBUDAYA = $tampungBUDAYA.$BUDAYA.",";
		}
	}
	$tampungBUDAYA = substr_replace($tampungBUDAYA ,"",-1);
	$tampungPOLA_MAKAN = "";
	foreach($_POST['POLA_MAKAN'] as $POLA_MAKAN) 
	{
		if($POLA_MAKAN == "_2_"){
			$tampungPOLA_MAKAN = $tampungPOLA_MAKAN.$POLA_MAKAN.$_POST['lainPOLA_MAKAN'].",";
		}else{
			$tampungPOLA_MAKAN = $tampungPOLA_MAKAN.$POLA_MAKAN.",";
		}
	}
	$tampungPOLA_MAKAN = substr_replace($tampungPOLA_MAKAN ,"",-1);
	$tampungKEPERCAYAAN = "";
	if($_POST['KEPERCAYAAN'] == "_1_"){
		$tampungKEPERCAYAAN = $_POST['KEPERCAYAAN'].$_POST['PERCAYA'];
	}else{
		$tampungKEPERCAYAAN = $_POST['KEPERCAYAAN'];
	}
	$tampungPANTANGAN_HARI = "";
	if($_POST['PANTANGAN_HARI'] == "_1_"){
		$tampungPANTANGAN_HARI = $_POST['PANTANGAN_HARI'].$_POST['HARI_PANTANGAN'];
	}else{
		$tampungPANTANGAN_HARI = $_POST['PANTANGAN_HARI'];
	}
	$tampungPENG_AGAMA = "";
	if($_POST['PENG_AGAMA'] == "_1_"){
		$tampungPENG_AGAMA = $_POST['PENG_AGAMA'].$_POST['PENGARUH_AGAMA'];
	}else{
		$tampungPENG_AGAMA = $_POST['PENG_AGAMA'];
	}
	$tampungSPIRIT = "";
	if($_POST['SPIRIT'] == "_1_"){
		$tampungSPIRIT = $_POST['SPIRIT'].$_POST['SPIRIT_SEMBUH'];
	}else{
		$tampungSPIRIT = $_POST['SPIRIT'];
	}
	$tampungBANTUAN = "";
	if($_POST['BANTUAN'] == "_1_"){
		$tampungBANTUAN = $_POST['BANTUAN'].$_POST['BANTUAN_SPIRITUAL'];
	}else{
		$tampungBANTUAN = $_POST['BANTUAN'];
	}
	$tampungPAHAM_RAWAT = "";
	foreach($_POST['PAHAM_RAWAT'] as $PAHAM_RAWAT) 
	{
		$tampungPAHAM_RAWAT = $tampungPAHAM_RAWAT.$PAHAM_RAWAT.",";
	}
	$tampungPAHAM_RAWAT = substr_replace($tampungPAHAM_RAWAT ,"",-1);
	$tampungHAMBATAN_EDUKASI = "";
	foreach($_POST['HAMBATAN_EDUKASI'] as $HAMBATAN_EDUKASI) 
	{
		if($HAMBATAN_EDUKASI == "03"){
			$tampungHAMBATAN_EDUKASI = $tampungHAMBATAN_EDUKASI.$HAMBATAN_EDUKASI.",";
			foreach($_POST['TIDAK_MAMPU'] as $TIDAK_MAMPU) 
			{
				$tampungHAMBATAN_EDUKASI = $tampungHAMBATAN_EDUKASI.$TIDAK_MAMPU.",";
			}
		}else{
			$tampungHAMBATAN_EDUKASI = $tampungHAMBATAN_EDUKASI.$HAMBATAN_EDUKASI.",";
		}
	}
	$tampungHAMBATAN_EDUKASI = substr_replace($tampungHAMBATAN_EDUKASI ,"",-1);
	$tampungFREK_MAKAN = "";
	foreach($_POST['FREK_MAKAN'] as $FREK_MAKAN) 
	{
		$tampungFREK_MAKAN = $tampungFREK_MAKAN.$FREK_MAKAN.",";
	}
	$tampungFREK_MAKAN = substr_replace($tampungFREK_MAKAN ,"",-1);
	$tampungJUM_MAKAN = "";
	foreach($_POST['JUM_MAKAN'] as $JUM_MAKAN) 
	{
		$tampungJUM_MAKAN = $tampungJUM_MAKAN.$JUM_MAKAN.",";
	}
	$tampungJUM_MAKAN = substr_replace($tampungJUM_MAKAN ,"",-1);
	$tampungJEN_MAKAN = "";
	foreach($_POST['JEN_MAKAN'] as $JEN_MAKAN) 
	{
		$tampungJEN_MAKAN = $tampungJEN_MAKAN.$JEN_MAKAN.",";
	}
	$tampungJEN_MAKAN = substr_replace($tampungJEN_MAKAN ,"",-1);
	$tampungKOM_MAKAN = "";
	foreach($_POST['KOM_MAKAN'] as $KOM_MAKAN) 
	{
		$tampungKOM_MAKAN = $tampungKOM_MAKAN.$KOM_MAKAN.",";
	}
	$tampungKOM_MAKAN = substr_replace($tampungKOM_MAKAN ,"",-1);
	$tampungDIET = "";
	foreach($_POST['DIET'] as $DIET) 
	{
		if($DIET == "_10_"){
			$tampungDIET = $tampungDIET.$DIET.$_POST['lainDIET'].",";
		}else{
			$tampungDIET = $tampungDIET.$DIET.",";
		}
	}
	$tampungDIET = substr_replace($tampungDIET ,"",-1);
	$tampungCARA_MAKAN = "";
	foreach($_POST['CARA_MAKAN'] as $CARA_MAKAN) 
	{
		if($CARA_MAKAN == "_3_"){
			$tampungCARA_MAKAN = $tampungCARA_MAKAN.$CARA_MAKAN.$_POST['lainCARA_MAKAN'].",";
		}else{
			$tampungCARA_MAKAN = $tampungCARA_MAKAN.$CARA_MAKAN.",";
		}
	}
	$tampungCARA_MAKAN = substr_replace($tampungCARA_MAKAN ,"",-1);
	$tampungGANGGUAN = "";
	foreach($_POST['GANGGUAN'] as $GANGGUAN) 
	{
		$tampungGANGGUAN = $tampungGANGGUAN.$GANGGUAN.",";
	}
	$tampungGANGGUAN = substr_replace($tampungGANGGUAN ,"",-1);
	$tampungJEN_MINUM = "";
	foreach($_POST['JEN_MINUM'] as $JEN_MINUM) 
	{
		if($JEN_MINUM == "_6_"){
			$tampungJEN_MINUM = $tampungJEN_MINUM.$JEN_MINUM.$_POST['lainJEN_MINUM'].",";
		}else{
			$tampungJEN_MINUM = $tampungJEN_MINUM.$JEN_MINUM.",";
		}
	}
	$tampungJEN_MINUM = substr_replace($tampungJEN_MINUM ,"",-1);
	$tampungGANG_MINUM = "";
	foreach($_POST['GANG_MINUM'] as $GANG_MINUM) 
	{
		$tampungGANG_MINUM = $tampungGANG_MINUM.$GANG_MINUM.",";
	}
	$tampungGANG_MINUM = substr_replace($tampungGANG_MINUM ,"",-1);
	$tampungWARNA_BAK = "";
	foreach($_POST['WARNA_BAK'] as $WARNA_BAK) 
	{
		if($WARNA_BAK == "_2_"){
			$tampungWARNA_BAK = $tampungWARNA_BAK.$WARNA_BAK.$_POST['lainWARNA_BAK'].",";
		}else{
			$tampungWARNA_BAK = $tampungWARNA_BAK.$WARNA_BAK.",";
		}
	}
	$tampungWARNA_BAK = substr_replace($tampungWARNA_BAK ,"",-1);
	$tampungDIURESIS_BAK = "";
	foreach($_POST['DIURESIS_BAK'] as $DIURESIS_BAK) 
	{
		$tampungDIURESIS_BAK = $tampungDIURESIS_BAK.$DIURESIS_BAK.",";
	}
	$tampungDIURESIS_BAK = substr_replace($tampungDIURESIS_BAK ,"",-1);
	$tampungKONSIST_BAB = "";
	foreach($_POST['KONSIST_BAB'] as $KONSIST_BAB) 
	{
		$tampungKONSIST_BAB = $tampungKONSIST_BAB.$KONSIST_BAB.",";
	}
	$tampungKONSIST_BAB = substr_replace($tampungKONSIST_BAB ,"",-1);
	$tampungGANG_BAB = "";
	foreach($_POST['GANG_BAB'] as $GANG_BAB) 
	{
		$tampungGANG_BAB = $tampungGANG_BAB.$GANG_BAB.",";
	}
	$tampungGANG_BAB = substr_replace($tampungGANG_BAB ,"",-1);
	$tampungSTOMA_BAB = "";
	foreach($_POST['STOMA_BAB'] as $STOMA_BAB) 
	{
		if($STOMA_BAB == "_2_"){
			$tampungSTOMA_BAB = $tampungSTOMA_BAB.$STOMA_BAB.$_POST['lainSTOMA_BAB'].",";
		}else{
			$tampungSTOMA_BAB = $tampungSTOMA_BAB.$STOMA_BAB.",";
		}
	}
	$tampungSTOMA_BAB = substr_replace($tampungSTOMA_BAB ,"",-1);
	$tampungIST_GANG_TIDUR = "";
	foreach($_POST['IST_GANG_TIDUR'] as $IST_GANG_TIDUR) 
	{
		$tampungIST_GANG_TIDUR = $tampungIST_GANG_TIDUR.$IST_GANG_TIDUR.",";
	}
	$tampungIST_GANG_TIDUR = substr_replace($tampungIST_GANG_TIDUR ,"",-1);
	$tampungALT_BANT = "";
	foreach($_POST['ALT_BANT'] as $ALT_BANT) 
	{
		$tampungALT_BANT = $tampungALT_BANT.$ALT_BANT.",";
	}
	$tampungALT_BANT = substr_replace($tampungALT_BANT ,"",-1);
	$tampungKEMP_MUND = "";
	foreach($_POST['KEMP_MUND'] as $KEMP_MUND) 
	{
		$tampungKEMP_MUND = $tampungKEMP_MUND.$KEMP_MUND.",";
	}
	$tampungKEMP_MUND = substr_replace($tampungKEMP_MUND ,"",-1);
	$tampungBIL_PUT = "";
	foreach($_POST['BIL_PUT'] as $BIL_PUT) 
	{
		$tampungBIL_PUT = $tampungBIL_PUT.$BIL_PUT.",";
	}
	$tampungBIL_PUT = substr_replace($tampungBIL_PUT ,"",-1);
	if($_POST[JK]=="Laki-Laki"){
	$JK=1;}
	else if($_POST[JK]=="Perempuan"){
	$JK=2;};
	if($_POST[UMUR]>=14&&$_POST[UMUR]<50){
	$UMUR=1;}
	else if($_POST[UMUR]>=50&&$_POST[UMUR]<65){
	$UMUR=2;}
	else if($_POST[UMUR]>=65&&$_POST[UMUR]<75){
	$UMUR=3;}
	else if($_POST[UMUR]>=75&&$_POST[UMUR]<80){
	$UMUR=4;}
	else if($_POST[UMUR]>=80){
	$UMUR=5;};
	
	$sqlupdate_pasien = "UPDATE m_pasien SET
				  NAMA_OBAT = '".trim($_POST['NAMA_OBAT'])."',
				  DOSIS   = '".trim($_POST['DOSIS'])."',
				  CARA_PEMBERIAN = '".trim($_POST['ATURAN'])."',
				  FREKUENSI = '".trim($_POST['FREKUENSI'])."',
				  WAKTU_TGL = '".trim($_POST['WAKTU_TGL'])."',
				  LAMA_WAKTU = '".trim($_POST['LAMA_WAKTU'])."',
				  ALERGI_OBAT = '".$tampungALERGI."',
				  REAKSI_ALERGI = '".$REAKSI."',
				  RIWAYAT_KES = '".$RIWAYAT."',
  				  BB_LAHIR = '".trim($_POST['BB_LAHIR'])."',
				  BB_SEKARANG = '".trim($_POST['BB_SEKARANG'])."',
				  FISIK_FONTANEL = '".trim($_POST['FISIK_FONTANEL'])."',
				  FISIK_REFLEKS = '".trim($_POST['FISIK_REFLEKS'])."',
				  FISIK_SENSASI = '".trim($_POST['FISIK_SENSASI'])."',
				  MOTORIK_KASAR = '".trim($_POST['MOTORIK_KASAR'])."',
				  MOTORIK_HALUS = '".trim($_POST['MOTORIK_HALUS'])."',
				  MAMPU_BICARA = '".trim($_POST['MAMPU_BICARA'])."',
				  MAMPU_SOSIALISASI = '".trim($_POST['MAMPU_SOSIALISASI'])."',
				  BCG = '".trim($_POST['BCG'])."',
				  POLIO = '".trim($_POST['POLIO'])."',
				  DPT = '".trim($_POST['DPT'])."',
				  CAMPAK = '".trim($_POST['CAMPAK'])."',
				  HEPATITIS_B = '".trim($_POST['HEPATITIS'])."',
				  TD = '".trim($_POST['TD'])."',
				  SUHU = '".trim($_POST['SUHU'])."',
				  RR = '".trim($_POST['RR'])."',
				  NADI = '".trim($_POST['NADI'])."',
				  BB = '".trim($_POST['BB'])."',
				  TB = '".trim($_POST['TB'])."',
				  EYE = '".trim($_POST['eye'])."',
				  MOTORIK = '".trim($_POST['motorik'])."',
				  VERBAL = '".trim($_POST['verbal'])."',
				  TOTAL_GCS = '".trim($_POST['total'])."',
				  
				  REAKSI_PUPIL = '".trim($_POST['REAKSI_PUPIL'])."',
				  KESADARAN = '".$sadar."',
				  KEPALA = '".$kepala."',
				  RAMBUT = '".$rambut."',
				  MUKA = '".$muka."',
				  MATA = '".$mata."',
				  GANG_LIHAT = '".$lihatGANG."',
				  ALATBANTU_LIHAT = '".$alatBANTU."',
				  BENTUK = '".$bentuk."',
				  PENDENGARAN = '".$dengar."',
				  LUB_TELINGA = '".$telinga."',
				  BENTUK_HIDUNG = '".$hidung."',
				  MEMBRAN_MUK = '".$membran."',
				  MAMPU_HIDU = '".trim($_POST['MAMPU_HIDU'])."',
				  ALAT_HIDUNG = '".trim($_POST['ALAT_HIDUNG'])."',
				  RONGGA_MULUT = '".trim($_POST['RONGGA_MULUT'])."',
				  WARNA_MEMBRAN = '".trim($_POST['WARNA_MEMBRAN'])."',
				  LEMBAB = '".trim($_POST['LEMBAB'])."',
				  STOMATITIS = '".trim($_POST['STOMATITIS'])."',
				  LIDAH = '".trim($_POST['LIDAH'])."',
				  GIGI = '".$gigi."',
				  TONSIL = '".$tonsil."',
				  KELAINAN = '".$kelainan."',
				  PERGERAKAN = '".$gerakan."',
				  KEL_TIROID = '".trim($_POST['KEL_TIROID'])."',
				  KEL_GETAH = '".trim($_POST['KEL_GETAH'])."',
				  TEKANAN_VENA = '".trim($_POST['TEKANAN_VENA'])."',
				  REF_MENELAN = '".trim($_POST['REF_MENELAN'])."',
				  NYERI = '".trim($_POST['NYERI'])."',
				  KREPITASI = '".trim($_POST['KREPITASI'])."',
				  KEL_LAIN = '".trim($_POST['KEL_LAIN'])."',
				  BENTUK_DADA = '".$bentuk_dada."',
				  POLA_NAPAS = '".$pola_napas."',
				  BENTUK_THORAKS = '".$thoraks."',
				  PAL_KREP = '".$krepitasi."',
				  BENJOLAN = '".$benjol."',
				  PAL_NYERI = '".$nyeri."',
				  PERKUSI = '".$perkusi."',
				  PARU = '".$paru."',
				  SUARA_JANTUNG = '".$suara."',
				  JANTUNG = '".$jantung."',
				  ALATBANTU_JAN = '".$alatBANTU."',
				  BENTUK_ABDOMEN = '".$abdomen."',
				  AUSKULTASI = '".$auskultasi."',
				  NYERI_PASI = '".$pasi_nyeri."',
				  PEM_KELENJAR = '".$kelenjar."',
				  PERKUSI_AUS = '".$perkusiAUS."',
	              VAGINA  = '".trim($_POST['VAGINA'])."',
				  MENSTRUASI  = '".trim($_POST['MENSTRUASI'])."',
				  KATETER  = '".trim($_POST['KATETER'])."',
				  LABIA_PROM  = '".trim($_POST['LABIA_PROM'])."',
				  HAMIL = '".$hamil."',
				  TGL_HAID = '".trim($_POST['TGL_HAID'])."',
				  PERIKSA_CERVIX = '".trim($_POST['PERIKSA_CERVIX'])."',
				  BENTUK_PAYUDARA = '".$payudara."',
				  KENYAL = '".trim($_POST['KENYAL'])."',
				  MASSA = '".$massa."',
				  NYERI_RABA = '".$nyeriRABA."',
				  BENTUK_PUTING = '".trim($_POST['BENTUK_PUTING'])."',
				  MAMMO = '".trim($_POST['MAMMO'])."',
				  ALAT_KONTRASEPSI = '".trim($_POST['ALAT_KONTRASEPSI'])."',
				  MASALAH_SEKS = '".trim($_POST['masalah_seks'])."',
				  PREPUTIUM = '".$preputium."',
				  MASALAH_PROSTAT = '".trim($_POST['masalah_prostat'])."',
				  BENTUK_SKROTUM = '".$bentukSKROTUM."',
				  TESTIS = '".$testis."',
				  MASSA_BEN = '".$benMASSA."',
				  HERNIASI = '".$herniasi."',
				  LAIN2 = '".trim($_POST['LAIN2'])."',
				  ALAT_KONTRA = '".trim($_POST['ALAT_KONTRA'])."',
				  MASALAH_REPRO = '".trim($_POST['masalah_reproduksi'])."',
				  EKSTREMITAS_ATAS = '".$ekstremATAS."',
				  EKSTREMITAS_BAWAH = '".$ekstremBAWAH."',
				  AKTIVITAS = '".$aktivitas."',
				  BERJALAN = '".$jalan."',
				  SISTEM_INTE = '".$inteSISTEM."',
				  KENYAMANAN = '".$nyaman."',
				  
				  KES_DIRI = '".$kes_diri."',
				  SOS_SUPORT = '".$suport."',
				  ANSIETAS = '".trim($_POST['ANSIETAS'])."',
				  KEHILANGAN = '".$hilang."',
				  STATUS_EMOSI = '".$emosi."',
				  KONSEP_DIRI = '".$konsep."',
				  RESPON_HILANG = '".$respon."',
				  SUMBER_STRESS = '".$stress."',
				  
				  BERARTI = '".$tampungBERARTI."',
				  TERLIBAT  = '".trim($_POST['TERLIBAT'])."',
				  HUBUNGAN  = '".trim($_POST['HUBUNGAN'])."',
				  KOMUNIKASI = '".$tampungKOMUNIKASI."',
				  KEPUTUSAN = '".$tampungKEPUTUSAN."',
				  MENGASUH = '".$tampungMENGASUH."',
				  DUKUNGAN = '".$tampungDUKUNGAN."',
				  REAKSI = '".$tampungREAKSI."',
				  BUDAYA = '".$tampungBUDAYA."',
				  POLA_AKTIVITAS  = '".trim($_POST['POLA_AKTIVITAS'])."',
				  POLA_ISTIRAHAT  = '".trim($_POST['POLA_ISTIRAHAT'])."',
				  POLA_MAKAN = '".$tampungPOLA_MAKAN."',
				  PANTANGAN  = '".trim($_POST['PANTANGAN'])."',
				  KEPERCAYAAN = '".$tampungKEPERCAYAAN."',
				  PANTANGAN_HARI = '".$tampungPANTANGAN_HARI."',
				  PANTANGAN_LAIN  = '".trim($_POST['PANTANGAN_LAIN'])."',
				  ANJURAN  = '".trim($_POST['ANJURAN'])."',
				  NILAI_KEYAKINAN  = '".trim($_POST['NILAI_KEYAKINAN'])."',
				  KEGIATAN_IBADAH  = '".trim($_POST['KEGIATAN_IBADAH'])."',
				  PENG_AGAMA = '".$tampungPENG_AGAMA."',
				  SPIRIT = '".$tampungSPIRIT."',
				  BANTUAN = '".$tampungBANTUAN."',
				  PAHAM_PENYAKIT  = '".trim($_POST['PAHAM_PENYAKIT'])."',
				  PAHAM_OBAT  = '".trim($_POST['PAHAM_OBAT'])."',
				  PAHAM_NUTRISI  = '".trim($_POST['PAHAM_NUTRISI'])."',
				  PAHAM_RAWAT = '".$tampungPAHAM_RAWAT."',
				  HAMBATAN_EDUKASI = '".$tampungHAMBATAN_EDUKASI."',
				  FREK_MAKAN = '".$tampungFREK_MAKAN."',
				  JUM_MAKAN = '".$tampungJUM_MAKAN."',
				  JEN_MAKAN = '".$tampungJEN_MAKAN."',
				  KOM_MAKAN = '".$tampungKOM_MAKAN."',
				  DIET = '".$tampungDIET."',
				  CARA_MAKAN = '".$tampungCARA_MAKAN."',
				  GANGGUAN = '".$tampungGANGGUAN."',
				  FREK_MINUM  = '".trim($_POST['FREK_MINUM'])."',
				  JUM_MINUM  = '".trim($_POST['JUM_MINUM'])."',
				  JEN_MINUM = '".$tampungJEN_MINUM."',
				  GANG_MINUM = '".$tampungGANG_MINUM."',
				  FREK_BAK  = '".trim($_POST['FREK_BAK'])."',
				  WARNA_BAK = '".$tampungWARNA_BAK."',
				  JMLH_BAK  = '".trim($_POST['JMLH_BAK'])."',
				  PENG_KAT_BAK  = '".trim($_POST['PENG_KAT_BAK'])."',
				  KEM_HAN_BAK  = '".trim($_POST['KEM_HAN_BAK'])."',
				  INKONT_BAK  = '".trim($_POST['INKONT_BAK'])."',
				  DIURESIS_BAK = '".$tampungDIURESIS_BAK."',
				  FREK_BAB  = '".trim($_POST['FREK_BAB'])."',
				  WARNA_BAB  = '".trim($_POST['WARNA_BAB'])."',
				  KONSIST_BAB = '".$tampungKONSIST_BAB."',
				  GANG_BAB = '".$tampungGANG_BAB."',
				  STOMA_BAB = '".$tampungSTOMA_BAB."',
				  PENG_OBAT_BAB  = '".trim($_POST['PENG_OBAT_BAB'])."',
				  IST_SIANG  = '".trim($_POST['IST_SIANG'])."',
				  IST_MALAM  = '".trim($_POST['IST_MALAM'])."',
				  IST_CAHAYA  = '".trim($_POST['IST_CAHAYA'])."',
				  IST_POSISI  = '".trim($_POST['IST_POSISI'])."',
				  IST_LING  = '".trim($_POST['IST_LING'])."',
				  IST_GANG_TIDUR = '".$tampungIST_GANG_TIDUR."',
				  PENG_OBAT_IST  = '".trim($_POST['PENG_OBAT_IST'])."',
				  FREK_MAND  = '".trim($_POST['FREK_MAND'])."',
				  CUC_RAMB_MAND  = '".trim($_POST['CUC_RAMB_MAND'])."',
				  SIH_GIGI_MAND  = '".trim($_POST['SIH_GIGI_MAND'])."',
				  BANT_MAND  = '".trim($_POST['BANT_MAND'])."',
				  GANT_PAKAI  = '".trim($_POST['GANT_PAKAI'])."',
				  PAK_CUCI  = '".trim($_POST['PAK_CUCI'])."',
				  PAK_BANT  = '".trim($_POST['PAK_BANT'])."',
				  ALT_BANT = '".$tampungALT_BANT."',
				  KEMP_MUND = '".$tampungKEMP_MUND."',
				  BIL_PUT = '".$tampungBIL_PUT."',
				  ADAPTIF  = '".trim($_POST['ADAPTIF'])."',
				  MALADAPTIF  = '".trim($_POST['MALADAPTIF'])."',
				  PERBANDINGAN_BB  = '".trim($_POST['PERBANDINGAN_BB'])."',
				  KONTINENSIA  = '".trim($_POST['KONTINENSIA'])."',
				  JENIS_KULIT1  = '".trim($_POST['JENIS_KULIT1'])."',
				  MOBILITAS  = '".trim($_POST['MOBILITAS'])."',
				  JK  = '$JK',
				  UMUR  = '$UMUR',
				  NAFSU_MAKAN  = '".trim($_POST['NAFSU_MAKAN'])."',
				  OBAT1  = '".trim($_POST['OBAT1'])."',
				  MALNUTRISI  = '".trim($_POST['MALNUTRISI'])."',
				  MOTORIK1  = '".trim($_POST['MOTORIK1'])."',
				  SPINAL  = '".trim($_POST['SPINAL'])."',
				  MEJA_OPERASI  = '".trim($_POST['MEJA_OPERASI'])."',
				  RIWAYAT_JATUH  = '".trim($_POST['RIWAYAT_JATUH'])."',
				  DIAGNOSIS_SEKUNDER  = '".trim($_POST['DIAGNOSIS_SEKUNDER'])."',
				  ALAT_BANTU  = '".trim($_POST['ALAT_BANTU'])."',
				  HEPARIN  = '".trim($_POST['HEPARIN'])."',
				  GAYA_BERJALAN  = '".trim($_POST['GAYA_BERJALAN'])."',
				  KESADARAN1  = '".trim($_POST['KESADARAN1'])."'
			WHERE NOMR = '".trim($_POST['NOMR'])."' ";
			mysql_query($sqlupdate_pasien)or die(mysql_error());
			$cek=mysql_query("select nomr, episode from data_vital where nomr='".trim($_POST['NOMR'])."'");
			$cek_data=mysql_num_rows($cek);
			$hasil_cek=mysql_fetch_array($cek);
			$episode=$hasil_cek[episode]+1;
			if($cek_data>=1){
			/*mysql_query("update data_vital set nomr= '".trim($_POST['NOMR'])."' where nomr= '".trim($_POST['NOMR'])."' ");*/
			$update_data=mysql_query("select data from data_vital where nomr='".trim($_POST['NOMR'])."'");
			while($hasil_update=mysql_fetch_array($update_data)){
			if($hasil_update['data']=='Sistole'){
			mysql_query("update data_vital set j1='".trim($_POST['st1'])."', j2='".trim($_POST['st2'])."', j3='".trim($_POST['st3'])."',
						j4='".trim($_POST['st4'])."',j5='".trim($_POST['st5'])."',j6='".trim($_POST['st6'])."',j7='".trim($_POST['st7'])."',j8='".trim($_POST['st8'])."',
						j9='".trim($_POST['st9'])."',j10='".trim($_POST['st10'])."',j11='".trim($_POST['st11'])."',j12='".trim($_POST['st12'])."',j13='".trim($_POST['st13'])."',
						j14='".trim($_POST['st14'])."',j15='".trim($_POST['st15'])."',j16='".trim($_POST['st16'])."',j17='".trim($_POST['st17'])."',j18='".trim($_POST['st18'])."',
						j19='".trim($_POST['st19'])."',j20='".trim($_POST['st20'])."',j21='".trim($_POST['st21'])."',j22='".trim($_POST['st22'])."',j23='".trim($_POST['st23'])."',j24='".trim($_POST['st24'])."' where nomr='".trim($_POST['NOMR'])."' and data='".$hasil_update['data']."'");
			}
			else if($hasil_update['data']=="Diastole"){
			mysql_query("update data_vital set j1='".trim($_POST['dt1'])."', j2='".trim($_POST['dt2'])."', j3='".trim($_POST['dt3'])."',
						j4='".trim($_POST['dt4'])."',j5='".trim($_POST['dt5'])."',j6='".trim($_POST['dt6'])."',j7='".trim($_POST['dt7'])."',j8='".trim($_POST['dt8'])."',
						j9='".trim($_POST['dt9'])."',j10='".trim($_POST['dt10'])."',j11='".trim($_POST['dt11'])."',j12='".trim($_POST['dt12'])."',j13='".trim($_POST['dt13'])."',
						j14='".trim($_POST['dt14'])."',j15='".trim($_POST['dt15'])."',j16='".trim($_POST['dt16'])."',j17='".trim($_POST['dt17'])."',j18='".trim($_POST['dt18'])."',
						j19='".trim($_POST['dt19'])."',j20='".trim($_POST['dt20'])."',j21='".trim($_POST['dt21'])."',j22='".trim($_POST['dt22'])."',j23='".trim($_POST['dt23'])."',j24='".trim($_POST['dt24'])."' where nomr='".trim($_POST['NOMR'])."' and data='".$hasil_update['data']."'");

			}
			else if($hasil_update['data']=="Nadi"){
			mysql_query("update data_vital set j1='".trim($_POST['nd1'])."', j2='".trim($_POST['nd2'])."', j3='".trim($_POST['nd3'])."',
						j4='".trim($_POST['nd4'])."',j5='".trim($_POST['nd5'])."',j6='".trim($_POST['nd6'])."',j7='".trim($_POST['nd7'])."',j8='".trim($_POST['nd8'])."',
						j9='".trim($_POST['nd9'])."',j10='".trim($_POST['nd10'])."',j11='".trim($_POST['nd11'])."',j12='".trim($_POST['nd12'])."',j13='".trim($_POST['nd13'])."',
						j14='".trim($_POST['nd14'])."',j15='".trim($_POST['nd15'])."',j16='".trim($_POST['nd16'])."',j17='".trim($_POST['nd17'])."',j18='".trim($_POST['nd18'])."',
						j19='".trim($_POST['nd19'])."',j20='".trim($_POST['nd20'])."',j21='".trim($_POST['nd21'])."',j22='".trim($_POST['nd22'])."',j23='".trim($_POST['nd23'])."',j24='".trim($_POST['nd24'])."' where nomr='".trim($_POST['NOMR'])."' and data='".$hasil_update['data']."'");

			}
			else if($hasil_update['data']=="Temperatur"){
			mysql_query("update data_vital set j1='".trim($_POST['tm1'])."', j2='".trim($_POST['tm2'])."', j3='".trim($_POST['tm3'])."',
						j4='".trim($_POST['tm4'])."',j5='".trim($_POST['tm5'])."',j6='".trim($_POST['tm6'])."',j7='".trim($_POST['tm7'])."',j8='".trim($_POST['tm8'])."',
						j9='".trim($_POST['tm9'])."',j10='".trim($_POST['tm10'])."',j11='".trim($_POST['tm11'])."',j12='".trim($_POST['tm12'])."',j13='".trim($_POST['tm13'])."',
						j14='".trim($_POST['tm14'])."',j15='".trim($_POST['tm15'])."',j16='".trim($_POST['tm16'])."',j17='".trim($_POST['tm17'])."',j18='".trim($_POST['tm18'])."',
						j19='".trim($_POST['tm19'])."',j20='".trim($_POST['tm20'])."',j21='".trim($_POST['tm21'])."',j22='".trim($_POST['tm22'])."',j23='".trim($_POST['tm23'])."',j24='".trim($_POST['tm24'])."' where nomr='".trim($_POST['NOMR'])."' and data='".$hasil_update['data']."'");
			};
			};
			}
			else{
			$dv=mysql_query("select * from data");
			while($hdv=mysql_fetch_array($dv)){
			mysql_query("Insert into data_vital (nomr, data, episode) values('".trim($_POST['NOMR'])."', '".$hdv['data']."','1')");
			$update_data=mysql_query("select data from data_vital where nomr='".trim($_POST['NOMR'])."'");
			while($hasil_update=mysql_fetch_array($update_data)){
			if($hasil_update['data']=='Sistole'){
			mysql_query("update data_vital set j1='".trim($_POST['st1'])."', j2='".trim($_POST['st2'])."', j3='".trim($_POST['st3'])."',
						j4='".trim($_POST['st4'])."',j5='".trim($_POST['st5'])."',j6='".trim($_POST['st6'])."',j7='".trim($_POST['st7'])."',j8='".trim($_POST['st8'])."',
						j9='".trim($_POST['st9'])."',j10='".trim($_POST['st10'])."',j11='".trim($_POST['st11'])."',j12='".trim($_POST['st12'])."',j13='".trim($_POST['st13'])."',
						j14='".trim($_POST['st14'])."',j15='".trim($_POST['st15'])."',j16='".trim($_POST['st16'])."',j17='".trim($_POST['st17'])."',j18='".trim($_POST['st18'])."',
						j19='".trim($_POST['st19'])."',j20='".trim($_POST['st20'])."',j21='".trim($_POST['st21'])."',j22='".trim($_POST['st22'])."',j23='".trim($_POST['st23'])."',j24='".trim($_POST['st24'])."' where nomr='".trim($_POST['NOMR'])."' and data='".$hasil_update['data']."'");
			}
			else if($hasil_update['data']=="Diastole"){
			mysql_query("update data_vital set j1='".trim($_POST['dt1'])."', j2='".trim($_POST['dt2'])."', j3='".trim($_POST['dt3'])."',
						j4='".trim($_POST['dt4'])."',j5='".trim($_POST['dt5'])."',j6='".trim($_POST['dt6'])."',j7='".trim($_POST['dt7'])."',j8='".trim($_POST['dt8'])."',
						j9='".trim($_POST['dt9'])."',j10='".trim($_POST['dt10'])."',j11='".trim($_POST['dt11'])."',j12='".trim($_POST['dt12'])."',j13='".trim($_POST['dt13'])."',
						j14='".trim($_POST['dt14'])."',j15='".trim($_POST['dt15'])."',j16='".trim($_POST['dt16'])."',j17='".trim($_POST['dt17'])."',j18='".trim($_POST['dt18'])."',
						j19='".trim($_POST['dt19'])."',j20='".trim($_POST['dt20'])."',j21='".trim($_POST['dt21'])."',j22='".trim($_POST['dt22'])."',j23='".trim($_POST['dt23'])."',j24='".trim($_POST['dt24'])."' where nomr='".trim($_POST['NOMR'])."' and data='".$hasil_update['data']."'");

			}
			else if($hasil_update['data']=="Nadi"){
			mysql_query("update data_vital set j1='".trim($_POST['nd1'])."', j2='".trim($_POST['nd2'])."', j3='".trim($_POST['nd3'])."',
						j4='".trim($_POST['nd4'])."',j5='".trim($_POST['nd5'])."',j6='".trim($_POST['nd6'])."',j7='".trim($_POST['nd7'])."',j8='".trim($_POST['nd8'])."',
						j9='".trim($_POST['nd9'])."',j10='".trim($_POST['nd10'])."',j11='".trim($_POST['nd11'])."',j12='".trim($_POST['nd12'])."',j13='".trim($_POST['nd13'])."',
						j14='".trim($_POST['nd14'])."',j15='".trim($_POST['nd15'])."',j16='".trim($_POST['nd16'])."',j17='".trim($_POST['nd17'])."',j18='".trim($_POST['nd18'])."',
						j19='".trim($_POST['nd19'])."',j20='".trim($_POST['nd20'])."',j21='".trim($_POST['nd21'])."',j22='".trim($_POST['nd22'])."',j23='".trim($_POST['nd23'])."',j24='".trim($_POST['nd24'])."' where nomr='".trim($_POST['NOMR'])."' and data='".$hasil_update['data']."'");

			}
			else if($hasil_update['data']=="Temperatur"){
			mysql_query("update data_vital set j1='".trim($_POST['tm1'])."', j2='".trim($_POST['tm2'])."', j3='".trim($_POST['tm3'])."',
						j4='".trim($_POST['tm4'])."',j5='".trim($_POST['tm5'])."',j6='".trim($_POST['tm6'])."',j7='".trim($_POST['tm7'])."',j8='".trim($_POST['tm8'])."',
						j9='".trim($_POST['tm9'])."',j10='".trim($_POST['tm10'])."',j11='".trim($_POST['tm11'])."',j12='".trim($_POST['tm12'])."',j13='".trim($_POST['tm13'])."',
						j14='".trim($_POST['tm14'])."',j15='".trim($_POST['tm15'])."',j16='".trim($_POST['tm16'])."',j17='".trim($_POST['tm17'])."',j18='".trim($_POST['tm18'])."',
						j19='".trim($_POST['tm19'])."',j20='".trim($_POST['tm20'])."',j21='".trim($_POST['tm21'])."',j22='".trim($_POST['tm22'])."',j23='".trim($_POST['tm23'])."',j24='".trim($_POST['tm24'])."' where nomr='".trim($_POST['NOMR'])."' and data='".$hasil_update['data']."'");
			};
			};
			};};
						
?>
  <script language="javascript">
	alert("Simpan Pengkajian Keperawatan Sukses");
	window.location="<?php echo _BASE_; ?>index.php?link=askep__";
 </script>