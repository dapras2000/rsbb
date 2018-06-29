<?
session_start();
//kondisi get no mr untuk pembayaran
header("Content-Type: text/html; charset=ISO-8859-15");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once('mysql.class.php');
// Include database connection
require_once('global.inc.php');
// Include functions
require_once('functions.inc.php');
require_once('function.php');

//kondisi cek no rm
if(!empty($_GET['cek_rm'])){
$sql = "SELECT a.NOMR,b.NAMA 
	FROM t_pendaftaran a, m_pasien b 
	where tglreg=current_date() and a.nomr=b.nomr and a.nomr='".htmlspecialchars($_GET['cek_rm'])."'";
$qry = mysql_query($sql);
$data = mysql_fetch_assoc($qry);

	if($_GET['cek_rm'] == $data['NOMR']){
		echo "<input type='text' class='text' name='NAMA' value='". $data['NAMA'] ."'> No Mr
			  <input type='text' class='text' name='NOMR' value='". $data['NOMR'] ."'> ";		  
		}else{
		  ?><input onblur="javascript: MyAjaxRequest('all','inc/process.php?cek_rm=','cek_rm'); Effect.appear('all'); return false;" type='text' class='text' name='NAMA'> No MR tidak Terdaftar
          <input type="hidden" name="IDXDAFTAR" value="<? echo $data['IDXDAFTAR']; ?>" />
		  <?
		}

}

?>