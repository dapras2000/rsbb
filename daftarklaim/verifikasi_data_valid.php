<? 
$QUERY = mysql_query("SELECT NOMR FROM t_data_verifikasi WHERE IDXDAFTAR='".$_POST['IDXDAFTAR']."'");
$DATA  = mysql_fetch_assoc($QUERY);

if($DATA['NOMR'] == $_POST['NOMR']){
	if($_POST['CARABAYAR']=='JMKS' || $_POST['CARABAYAR']=='JMKSD BGR' ){
		mysql_query("UPDATE t_data_verifikasi SET KTP='$_POST[KTP]', KARTU='$_POST[KPJ]', RUJUKAN='$_POST[RP]', KK='$_POST[KK]', LAINLAIN='$_POST[LAINLAIN]', DINAS_SOSIAL='$_POST[REC]', KET='$_POST[KET]' WHERE IDXDAFTAR='$_GET[idx]'")or die(mysql_error());
	}else{
		mysql_query("UPDATE t_data_verifikasi SET KTP='$_POST[KTP]', KARTU='$_POST[SKTM]', RUJUKAN='$_POST[RP]', KK='$_POST[KK]', LAINLAIN='$_POST[LAINLAIN]', DINAS_SOSIAL='$_POST[REC]', KET='$_POST[KET]' WHERE IDXDAFTAR='$_GET[idx]'")or die(mysql_error());
	}
	echo"<div style='border:1px solid #CCC; padding:5px; color:#F00;'><strong>UPDATE DATA TELAH DI VERIFIKASI</strong></div>";
	
}else{
	if($_POST['CARABAYAR']=='JMKS' || $_POST['CARABAYAR']=='JMKSD BGR' ){
		$SQL    = "INSERT INTO t_data_verifikasi (IDXDAFTAR, NOMR, VERIFIKASI, KTP, KARTU, RUJUKAN, KK, LAINLAIN, DINAS_SOSIAL, KET)
				   VALUES ('$_POST[IDXDAFTAR]', '$_POST[NOMR]', '$_POST[CARABAYAR]', '$_POST[KTP]', '$_POST[KPJ]', '$_POST[RP]', 
						   '$_POST[KK]', '$_POST[LAINLAIN]', '$_POST[REC]', '$_POST[KET]')";
		$MQUERY = mysql_query($SQL)or die(mysql_error());
			
	}else{
		$SQL    = "INSERT INTO t_data_verifikasi (IDXDAFTAR, NOMR, VERIFIKASI, KTP, KARTU, RUJUKAN, KK, LAINLAIN, DINAS_SOSIAL, KET)
				   VALUES ('$_POST[IDXDAFTAR]', '$_POST[NOMR]', '$_POST[CARABAYAR]', '$_POST[KTP]', '$_POST[SKTM]', '$_POST[RP]', 
						   '$_POST[KK]', '$_POST[LAINLAIN]', '$_POST[REC]', '$_POST[KET]')";
		$MQUERY = mysql_query($SQL)or die(mysql_error());
	}
	echo "<div style='border:1px solid #CCC; padding:5px; color:#090;'><strong>VERIFIKASI DATA SUKSES!</strong></div>";
}
?>
