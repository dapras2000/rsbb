<?php 
function Terbilang($x)
{
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . "belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}

function nomr($p='0'){
	$sql="select LPAD(nomor,6,'0') as nomor from m_maxnomr";
	$query=mysql_query($sql);
	$data=mysql_fetch_assoc($query);
	$v = $data['nomor'] + $p;
	$vl=strlen($v);
	if($vl < 6){
		$x = 6 - $vl;
		$val	= '';
		for($i=1; $i<=$vl; $i++):
			$val = $val +0;
		endfor;
		echo "$val"."$v";
	}else{
		echo $v;
	}
}

function getLastNoM($p=0){
	$sql="select last2 as nomor from m_maxnomr where status=1";
	$query=mysql_query($sql);
	$data=mysql_fetch_assoc($query);
	$v = $data['nomor'];
	$vl=strlen($v);
	if($v < 10){ $value = '0'.$v;
	}else if($v < 100){ $value =$v;
	
	}
	return $value;
}

function getLastMR($p=0){
	$sql="select last1 as nomor from m_maxnomr where status=1";
	$query=mysql_query($sql);
	$data=mysql_fetch_assoc($query);
	$v = $data['nomor'];
	$vl=strlen($v);
	if($v < 10){ $value = '0'.$v;
	}else if($v < 100){ $value =$v;
	
	}
	return $value;
}


function datediff($d1, $d2){
	$diff 	= abs(strtotime($d2) - strtotime($d1));
	$a	= array();
	$a['years'] 	= floor($diff / (365*60*60*24));
	$a['months'] = floor(($diff - $a['years'] * 365*60*60*24) / (30*60*60*24));
	$a['days'] 	= floor(($diff - $a['years'] * 365*60*60*24 - $a['months']*30*60*60*24)/ (60*60*24));
	return $a;
	#printf("%d years, %d months, %d days\n", $years, $months, $days);
	/*
	$d1 = (is_string($d1) ? strtotime($d1) : $d1);
	$d2 = (is_string($d2) ? strtotime($d2) : $d2);
	$diff_secs = abs($d1 - $d2);
	$base_year = min(date("Y", $d1), date("Y", $d2));
	$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
	return array(
	"years" => date("Y", $diff) - $base_year,
	"months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
	"months" => date("n", $diff) - 1,
	"days_total" => floor($diff_secs / (3600 * 24)),
	"days" => date("j", $diff) - 1,
	"hours_total" => floor($diff_secs / 3600),
	"hours" => date("G", $diff),
	"minutes_total" => floor($diff_secs / 60),
	"minutes" => (int) date("i", $diff),
	"seconds_total" => $diff_secs,
	"seconds" => (int) date("s", $diff)
	
	);*/
}

function datediff2($d1,$d2){
	
}

function CurFormat($value,$dec=0){
	$res = number_format ($value,$dec,",",".");
	return $res;
}

function getRealIpAddr() {
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip=$_SERVER['HTTP_CLIENT_IP']; // share internet
    } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR']; // pass from proxy
    } else {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
  return $ip;
}
function jeniskelamin($P){
	if($P == 'P'){
		$v = "Perempuan (P)";
	}else{
		$v = "Laki - Laki (L)";
	}
	return $v;
}
function getDokterName($kddokter){
	include("connect.php");
	$sql = mysql_query('select NAMADOKTER from m_dokter where KDDOKTER = '.$kddokter);
	if(mysql_num_rows($sql) > 0){
		$data = mysql_fetch_array($sql);
		$val = $data['NAMADOKTER'];
	}else{
		$val = '';
	}
	return $val;
}
function getJenisPoly($kdpoly){
	include("connect.php");
	$sql = mysql_query('select * from m_poly where kode = '.$kdpoly);
	if(mysql_num_rows($sql) > 0){
		$data = mysql_fetch_array($sql);
		$val = $data['jenispoly'];
	}else{
		$val = '';
	}
	return $val;
}
function getProfesiDoktor($kddokter){
	include("connect.php");
	$sql = mysql_query('select * from m_dokter where KDDOKTER = '.$kddokter);
	if(mysql_num_rows($sql) > 0){
		$data = mysql_fetch_array($sql);
		$val = $data['KDPROFESI'];
	}else{
		$val = '';
	}
	return $val;
}
function getKodePendaftaran($jenispoly,$kdprofesi){
	include("connect.php");
	#$sql = mysql_query('select * from m_tarifpendaftaran where jenispoly = "'.$jenispoly.'" and kdprofesi = "'.$kdprofesi.'"');
	#echo 'select * from m_tarifpendaftaran where jenispoly = "'.$jenispoly.'" and kdprofesi = "'.$kdprofesi.'"';
	$sql = 'select * from m_tarif2012 where kode_unit = "'.$jenispoly.'" and kode_profesi = "'.$kdprofesi.'"';
	$sql = mysql_query($sql);
	if(mysql_num_rows($sql) > 0){
		$data = mysql_fetch_array($sql);
		$val = $data['kode_tindakan'];
	}else{
		$val = '';
	}
	return $val;
}
function getTarifPendaftaran($kodetarif){
	include("connect.php");
	$sql = 'select * from m_tarif2012 where kode_tindakan = "'.$kodetarif.'"';
	$sql = mysql_query($sql);
	if(mysql_num_rows($sql) > 0){
		$data = mysql_fetch_array($sql);
		$val[] = $data['jasa_sarana'];
		$val[] = $data['jasa_pelayanan'];
		$val[] = $data['tarif'];
	}else{
		$val[] = '';
	}
	return $val;
}

function getLastNoBILL($p=0){
	include("connect.php");
	$sql = mysql_query('SELECT nomor FROM M_MAXNOBILL');
	if(mysql_num_rows($sql) > 0):
		$d	= mysql_fetch_array($sql);
		$no	= $d['nomor'] + $p;
	else:
		$no = 1;
	endif;
	return $no;
}
function getLastIDXDAFTAR($p=0){
	include("connect.php");
	$sql = mysql_query('select IDXDAFTAR from t_pendaftaran order by IDXDAFTAR desc limit 1');
	if(mysql_num_rows($sql) > 0):
		$d	= mysql_fetch_array($sql);
		$no	= $d['IDXDAFTAR'] + $p;
	else:
		$no = 1;
	endif;
	return $no;
}
function getLastIDXOBATtmp($p=0){
	include("connect.php");
	$sql = mysql_query('select IDXOBAT from tmp_cartresep order by IDXOBAT desc limit 1');
	if(mysql_num_rows($sql) > 0):
		$d	= mysql_fetch_array($sql);
		$no	= $d['IDXOBAT'] + $p;
	else:
		$no = 1;
	endif;
	return $no;
}

function getNamaPoly($kdpoly){
	include 'connect.php';
	$sql 	= mysql_query('select nama from m_poly where kode = '.$kdpoly);
	if(mysql_num_rows($sql)){
		$data	= mysql_fetch_array($sql);
		$v	= 'Daftar Tindakan Poliklinik '.$data['nama'];
	}else{
		$v	= 'Daftar Tindakan Lain Lain';
	}
	return $v;
}

function getGroupUnit($val){
	include 'connect.php';
	$sql	= mysql_query('select * from m_unit where kode_unit = '.$val);
	if(mysql_num_rows($sql) > 0):
		$data	= mysql_fetch_array($sql);
		$v	= $data['grup_unit'];
	else:
		$v	= 1;
	endif;
	return $v;
}

function CheckLastLevel($kode_tindakan,$kelas=''){
	include 'connect.php';
	$kelas_q = '';
	if($kelas != ''){
		$kelas_q 	= 'and kelas = "'.$kelas.'"';
	}
	$sql = mysql_query('select * from m_tarif2012 where kode_tindakan like "'.$kode_tindakan.'.%" '.$kelas_q);
	$val = mysql_num_rows($sql);
	return $val;
}

function getLastLevel($kode_tindakan){
	include 'connect.php';
	$sql = mysql_query('select * from m_tarif2012 where kode_tindakan like "'.$kode_tindakan.'.%"');
	return $sql;
}

function getGroupName($kode){
	include 'connect.php';
	$sql = mysql_query('select * from m_tarif2012 where kode_tindakan like "'.$kode.'%" order by kode_tindakan asc limit 1');
	$data= mysql_fetch_array($sql);
	return $data;
}

function check_t_admission($nomr,$idxdaftar,$kondisi=''){
	include 'connect.php';
	if($kondisi != ''){
		$kondisi = 'and '.$kondisi;
	}
	$sql	= 'select * from t_admission where id_admission = "'.$idxdaftar.'" and nomr = "'.$nomr.'"';
	$sql 	= mysql_query($sql);
	$data	= mysql_fetch_array($sql);
	return $data;
}

function check_t_bayarrajal($nomr,$idxdaftar){
	include 'connect.php';
	$sql	= 'select * from t_bayarrajal where IDXDAFTAR = "'.$idxdaftar.'" and NOMR = "'.$nomr.'" ORDER BY NOBILL DESC LIMIT 1';
	$sql 	= mysql_query($sql);
	$data	= mysql_fetch_array($sql);
	return $data;
}

function check_t_bayarranap($nomr,$idxdaftar){
	include 'connect.php';
	$sql	= 'select * from t_bayarranap where IDXDAFTAR = "'.$idxdaftar.'" and NOMR = "'.$nomr.'"';
	$sql 	= mysql_query($sql);
	$data	= mysql_fetch_array($sql);
	return $data;
}

function check_rajal_ranap_status_operasi($select="*",$id){
	include 'connect.php';
	$sql	= mysql_query('select '.$select.' from t_operasi where id_operasi = '.$id);
	$data	= mysql_fetch_array($sql);
	return $data;
}

function getNamaDokter($kddokter){
	include 'connect.php';
	$sql 	= mysql_query('select * from m_dokter where KDDOKTER = "'.$kddokter.'"');
	$data	= mysql_fetch_array($sql);
	return $data;
}

function getTarif($kode){
	include 'connect.php';
	$sql = mysql_query('select jasa_sarana, jasa_pelayanan, tarif from m_tarif2012 where kode_tindakan ="'.$kode.'"');
	$data	= mysql_fetch_array($sql);
	return $data;
}
function TrimArray($Input){ 
	if (!is_array($Input))
		return trim($Input);
	return array_map('TrimArray', $Input);
}
function getKecamatanName($id){
	include("connect.php");
	$sql = mysql_query('select * from m_kecamatan where idkecamatan = '.$id);
	if(mysql_num_rows($sql) > 0){
		$data = mysql_fetch_array($sql);
		$val = $data['namakecamatan'];
	}else{
		$val = '';
	}
	return $val;
}

function getdaftar($nomr){
	include 'connect.php';
	$sql 	= mysql_query('select IDXDAFTAR from t_pendaftaran where KDPOLY ="10" and NOMR = "'.$nomr.'" order by IDXDAFTAR desc limit 1');
	$data2	= mysql_fetch_array($sql);
	$data = $data2['IDXDAFTAR'];
	return $data;
}
