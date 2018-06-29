<?php
/*
function setting( )
{
    global $sett;
    koneksi( );
    $sql = "select * from setting where id= '1'";
    $result = mysql_query( $sql );
    $sett = mysql_fetch_array( $result );
}
*/
		
//untuk mencegah si jahil
function cegah($str) {
    $str = trim(htmlentities($str));
	$str = ereg_replace("%", "persen", $str);
	$str = ereg_replace("1=1", "1smdgan1", $str);
	$str = ereg_replace("-", "stri", $str);
	//$str = ereg_replace("_", "stripbwh", $str);
	$str = ereg_replace("/", "gmring", $str);
	$str = ereg_replace("!", "pentung", $str);
	$str = ereg_replace("'", "psiji", $str);
	$str = ereg_replace("select", "NOSQL", $str);
	$str = ereg_replace("delete", "NOSQL", $str);
	$str = ereg_replace("update", "NOSQL", $str);
	$str = ereg_replace("alter", "NOSQL", $str);
	$str = ereg_replace("insert", "NOSQL", $str);
	$str = ereg_replace("from", "NOSQL", $str);
	return $str;
  }

//untuk anti-sql
function nosql($str) {
    $str = trim(mysql_real_escape_string(htmlentities(addslashes(htmlspecialchars($str)))));
	$str = ereg_replace("%", "persen", $str);
	$str = ereg_replace("1=1", "1smdgan1", $str);
	$str = ereg_replace("-", "stri", $str);
	$str = ereg_replace("_", "stripbwh", $str);
	$str = ereg_replace("/", "gmring", $str);
	$str = ereg_replace("!", "pentung", $str);
	$str = ereg_replace("'", "psiji", $str);
	$str = ereg_replace("select", "NOSQL", $str);
	$str = ereg_replace("delete", "NOSQL", $str);
	$str = ereg_replace("update", "NOSQL", $str);
	$str = ereg_replace("alter", "NOSQL", $str);
	$str = ereg_replace("insert", "NOSQL", $str);
	$str = ereg_replace("grant", "NOSQL", $str);
	return $str;
  }
 
//balikino. . o . . .. o. . .. . balikin
function balikin($str) {
	$str = ereg_replace("persen", "%", $str);
	$str = ereg_replace("1smdgan1", "1=1", $str);
	$str = ereg_replace("stri", "-", $str);
	$str = ereg_replace("stripbwh", "_", $str);
	$str = ereg_replace("gmring", "/", $str);
	$str = ereg_replace("pentung", "!", $str);
	$str = ereg_replace("&amp;", "&", $str);
	$str = ereg_replace("-pbwh", "_", $str);
	$str = ereg_replace("psiji", "'", $str);
	return $str;
  }
/*
function config( )
{
    global $alamatadmin;
    global $teleponadmin;
    global $emailautosub;
    global $emailautocalon;
    global $emailautomember;
    global $komisi;
    global $sett;
    global $host;
    global $passs;
    global $user;
    global $db;
    global $bankadmin;
    global $namaadmin;
    global $emailadmin;
    global $harga;
    global $defaultsp;
    global $domain;
    global $norekadmin;
    global $batasbonus;
    setting( );
    $domain = $sett[domain];
    $namaadmin = $sett[nama];
    $phoneadmin = $sett[hp];
    $norekadmin = $sett[norek];
    $emailadmin = $sett[email];
    $harga = $sett[harga];
    $komisi = $sett[komisi];
    $bankadmin = $sett[bank];
    $emailautosub = $sett[emailautosub];
    $emailautocalon = $sett[emailautocalon];
    $emailautomember = $sett[emailautomember];
    $defaultsp = $sett[defaultsp];
    $alamatadmin = $sett[alamat];
    $batasbonus = $sett[batasbonus];
}
function koneksi( )
{
    global $db;
    global $passs;
    global $host;
    global $user;
    global $domainmu;
    $objConn = mysql_connect( "{$host}", "{$user}", "{$passs}" );
    mysql_select_db( "{$db}", $objConn );
}
*/
function rupiah( $nilai )
{
    $nilai1 = number_format( $nilai, 0, ",", "." );
    $nilai2 = "Rp ".$nilai1." ,-";
    return $nilai2;
}

//pesan kmdian kembali keurl tujuan
function url_back($url) {
    echo "<SCRIPT>self.location.href='$url'</SCRIPT>";
    exit;
}

//pesan kmdian kembali keurl sebelumnya
function message_back($msg) {
    echo "<SCRIPT>alert(\"$msg\");history.go(-1)</SCRIPT>";
    exit;
}

//Sama dengan fungsi diatas hanya saja setelah pesan ditampilakan langsung di redrect ke url tertentu
function message_url($msg,$url) {
    echo "<SCRIPT>alert(\"$msg\");self.location.href='$url'</SCRIPT>";
    exit;
}

function sekarang( )
{
    $bulan = date( "m" );
    $hari = date( "d" );
    $tahun = date( "Y" );
    $date = mktime( 0, 0, 0, $bulan, $hari, $tahun );
    return $date;
}

function tampilTanggal($tgl){
	//pecah
	$pecah=explode('-',$tgl);
	$tahun=$pecah[0];
	switch($pecah[1]){
		default : $bulan='SALAH BULAN'; break;
		case '01': $bulan='Januari'; break;
		case '02': $bulan='Februari'; break;
		case '03': $bulan='Maret'; break;
		case '04': $bulan='April'; break;
		case '05': $bulan='Mei'; break;
		case '06': $bulan='Juni'; break;
		case '07': $bulan='Juli'; break;
		case '08': $bulan='Agustus'; break;
		case '09': $bulan='September'; break;
		case '10': $bulan='Oktober'; break;
		case '11': $bulan='November'; break;
		case '12': $bulan='Desember'; break;
	}
	$tanggal=$pecah[2];
	$tampilan=$tanggal.' '.$bulan.' '.$tahun;
	return $tampilan;
}
function tampilTanggal_singkat($tgl){
	//pecah
	$pecah=explode('-',$tgl);
	$tahun=$pecah[0];
	switch($pecah[1]){
		default : $bulan='SALAH BULAN'; break;
		case '01': $bulan='Jan'; break;
		case '02': $bulan='Feb'; break;
		case '03': $bulan='Mar'; break;
		case '04': $bulan='Apr'; break;
		case '05': $bulan='Mei'; break;
		case '06': $bulan='Jun'; break;
		case '07': $bulan='Jul'; break;
		case '08': $bulan='Ags'; break;
		case '09': $bulan='Sept'; break;
		case '10': $bulan='Okt'; break;
		case '11': $bulan='Nov'; break;
		case '12': $bulan='Des'; break;
	}
	$tanggal=$pecah[2];
	$tampilan=$tanggal.'-'.$bulan.'-'.$tahun;
	return $tampilan;
}

function ambilTanggal($tgl){
	//pecah
	$pecah=explode('-',$tgl);
	$tanggal=$pecah[2];
	if($tanggal[0]=='0'){
		$tampilan=substr($tanggal, -1, 1); 
	}else{ 
		$tampilan=$tanggal; 
	}
	return $tampilan;
}

function ambilBulan($tgl){
	//pecah
	$pecah=explode('-',$tgl);
	switch($pecah[1]){
		default : $bulan='SALAH BULAN'; break;
		case '01': $bulan='Januari'; break;
		case '02': $bulan='Februari'; break;
		case '03': $bulan='Maret'; break;
		case '04': $bulan='April'; break;
		case '05': $bulan='Mei'; break;
		case '06': $bulan='Juni'; break;
		case '07': $bulan='Juli'; break;
		case '08': $bulan='Agustus'; break;
		case '09': $bulan='September'; break;
		case '10': $bulan='Oktober'; break;
		case '11': $bulan='November'; break;
		case '12': $bulan='Desember'; break;
	}	
	$tampilan=$bulan;
	return $tampilan;
}

function ambilTahun($tgl){
	//pecah
	$pecah=explode('-',$tgl);
	$tahun=$pecah[0];	
	$tampilan=$tahun;
	return $tampilan;
}
function usia($tgl)
{
        //pecah
	$hrini=date("Y-m-d");
	$th=explode('-',$hrini);
	$thini=$th[0];
	$pecah=explode('-',$tgl);
	$tahun=$pecah[0];	
	$tampilan=$thini-$tahun;
	return $tampilan;    
}

function hitung_umur($tanggale){

$tgl1 = $tanggale;  
// 1 Oktober 2009 
$tgl2 = date("Y-m-d");  // 10 Oktober 2009 

// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun 
// dari tanggal pertama 
$pecah1 = explode("-", $tgl1); 
$date1 = $pecah1[2]; 
$month1 = $pecah1[1]; 
$year1 = $pecah1[0]; 

// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun 
// dari tanggal kedua 
$pecah2 = explode("-", $tgl2); $date2 = $pecah2[2]; 
$month2 = $pecah2[1]; $year2 =  $pecah2[0]; 

// menghitung JDN dari masing-masing tanggal 
$jd1 = GregorianToJD($month1, $date1, $year1); 
$jd2 = GregorianToJD($month2, $date2, $year2); 

// hitung selisih hari kedua tanggal 
$selisih = $jd2 - $jd1; 
$tahun = $selisih / 365;
$sisa = $selisih % 365;
$bulan = $sisa / 30;
$hari = $sisa % 30;
//echo "Selisih kedua tanggal adalah ".$selisih." hari <br />"; 
//echo "Selisih kedua tanggal adalah ".round($tahun)." tahun ".round($bulan)." bulan ".$hari." hari"; 
//echo floor($tahun)." TAHUN ".floor($bulan)." BULAN ".floor($hari)." HARI";
$hasil = floor($tahun)." TAHUN ".floor($bulan)." BULAN ".floor($hari)." HARI";

return $hasil;
}

function hitung_umur_tahun($tanggale){

$tgl1 = $tanggale;  
// 1 Oktober 2009 
$tgl2 = date("Y-m-d");  // 10 Oktober 2009 

// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun 
// dari tanggal pertama 
$pecah1 = explode("-", $tgl1); 
$date1 = $pecah1[2]; 
$month1 = $pecah1[1]; 
$year1 = $pecah1[0]; 

// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun 
// dari tanggal kedua 
$pecah2 = explode("-", $tgl2); $date2 = $pecah2[2]; 
$month2 = $pecah2[1]; $year2 =  $pecah2[0]; 

// menghitung JDN dari masing-masing tanggal 
$jd1 = GregorianToJD($month1, $date1, $year1); 
$jd2 = GregorianToJD($month2, $date2, $year2); 

// hitung selisih hari kedua tanggal 
$selisih = $jd2 - $jd1; 
$tahun = $selisih / 365;
$sisa = $selisih % 365;
$bulan = $sisa / 30;
$hari = $sisa % 30;
//echo "Selisih kedua tanggal adalah ".$selisih." hari <br />"; 
//echo "Selisih kedua tanggal adalah ".round($tahun)." tahun ".round($bulan)." bulan ".$hari." hari"; 

// echo floor($tahun)." Thn ";
$hasil = floor($tahun)." Thn ";
return $hasil;
}

function format_uang($nominal){
	$nilai=number_format($nominal,0,",",".");
	return $nilai;
}

function sisipkan($kata, $urutan, $sisipan){
	$kataawal = substr($kata,0,$urutan);
	$kataakhir = substr($kata, $urutan);
	$kata = $kataawal.$sisipan.$kataakhir;
	return $kata;
}

function tampilRM($nomor){
	$panjRM = strlen($nomor);
	switch($panjRM){
		default : $hasilrm=$nomor; break;
		case '1' : $hasilrm = '0000000'.$nomor; break;
		case '2' : $hasilrm = '000000'.$nomor; break;
		case '3' : $hasilrm = '00000'.$nomor; break;
		case '4' : $hasilrm = '0000'.$nomor; break;
		case '5' : $hasilrm = '000'.$nomor; break;
		case '6' : $hasilrm = '00'.$nomor; break;
		case '7' : $hasilrm = '0'.$nomor; break;
		case '8' : $hasilrm = $nomor; break;
	}
	# UBAH FORMAT
	$keluaran = sisipkan($hasilrm,6,"-");
	$keluaran = sisipkan($keluaran,4,"-");
	$keluaran = sisipkan($keluaran,2,"-");
	return $keluaran;
}
function bacaRM($nomor){
	$nomor = str_replace("-", "", $nomor);
	$nomorasli = $nomor + 1 - 1;
	return $nomorasli;
}

function bacaBarcodeRM($nomor){
	$nomor = str_replace("*", "", $nomor);
	$nomor = str_replace("-", "", $nomor);
	$nomorasli = $nomor + 1 - 1;
	return $nomorasli;
}

function tandaBintang($kode,$kelamin,$hasil){
	$tanda = 0;
	switch($kode){
		default : break;
		case'1' : 
			if($kelamin=='L'){
				if($hasil<14||$hasil>18){ $tanda=1;}
			}else{
				if($hasil<12||$hasil>16){ $tanda=1;}
			}
			break;
		case'2' : 
			if($hasil<3500||$hasil>10000){ $tanda=1;}
			break;
		case'3' : 
			if($kelamin=='L'){
				if($hasil<4500000||$hasil>5500000){ $tanda=1;}
			}else{
				if($hasil<4200000||$hasil>5000000){ $tanda=1;}
			}
			break;
		case'4' : 
			if($hasil<100000||$hasil>400000){ $tanda=1;}
			break;
		case'5' : 
			if($hasil<150000||$hasil>400000){ $tanda=1;}
			break;
		case'6' : 
			if($hasil<35||$hasil>55){ $tanda=1;}
			break;
		case'7' : 
			if($kelamin=='L'){
				if($hasil<10){ $tanda=1;}
			}
			break;
		case'8' : 
			if($hasil<16||$hasil>45){ $tanda=1;}
			break;
		case'9' : 
			if($hasil<45||$hasil>74){ $tanda=1;}
			break;
		case'11' : 
			if($hasil<25||$hasil>35){ $tanda=1;}
			break;
		case'12' : 
			if($hasil<31||$hasil>38){ $tanda=1;}
			break;
		case'13' : 
			if($hasil<75||$hasil>100){ $tanda=1;}
			break;
		case'14' : 
			if($hasil<0||$hasil>1){ $tanda=1;}
			break;
		case'15' : 
			if($hasil<1||$hasil>3){ $tanda=1;}
			break;
		case'16' : 
			if($hasil<2||$hasil>6){ $tanda=1;}
			break;
		case'17' : 
			if($hasil<50||$hasil>70){ $tanda=1;}
			break;
		case'18' : 
			if($hasil<20||$hasil>40){ $tanda=1;}
			break;
		case'19' : 
			if($hasil<2||$hasil>8){ $tanda=1;}
			break;
		case'20' : 
			if($hasil<1||$hasil>3){ $tanda=1;}
			break;
		case'21' : 
			if($hasil<2||$hasil>6){ $tanda=1;}
			break;
		case'23' : 
			if($hasil<70||$hasil>110){ $tanda=1;}
			break;
		case'24' : 
			if($hasil<70||$hasil>130){ $tanda=1;}
			break;
		case'25' : 
			if($hasil<70||$hasil>140){ $tanda=1;}
			break;
		case'26' : 
			if($hasil>200){ $tanda=1;}
			break;
		case'27' : 
			if($hasil>150){ $tanda=1;}
			break;
		case'28' : 
			if($hasil<50){ $tanda=1;}
			break;
		case'29' : 
			if($hasil>150){ $tanda=1;}
			break;
		case'30' : 
			if($kelamin=='L'){
				if($hasil<3.5||$hasil>7.2){ $tanda=1;}
			}else{
				if($hasil<2.6||$hasil>6){ $tanda=1;}
			}
			break;
		case'31' : 
			if($hasil<10||$hasil>50){ $tanda=1;}
			break;
		case'32' : 
			if($kelamin=='L'){
				if($hasil<0.5||$hasil>1.5){ $tanda=1;}
			}else{
				if($hasil<0.5||$hasil>1){ $tanda=1;}
			}
			break;
		case'34' : 
			if($hasil<3.8||$hasil>5.5){ $tanda=1;}
			break;
		case'35' : 
			if($hasil<6.4||$hasil>8.4){ $tanda=1;}
			break;
		case'36' : 
			if($hasil>40){ $tanda=1;}
			break;
		case'37' : 
			if($hasil>40){ $tanda=1;}
			break;
		case'38' : 
			if($hasil>1.2){ $tanda=1;}
			break;
		case'39' : 
			if($hasil>0.2){ $tanda=1;}
			break;
		case'40' : 
			if($kelamin=='L'){
				if($hasil<6||$hasil>42){ $tanda=1;}
			}else{
				if($hasil<3||$hasil>30){ $tanda=1;}
			}
			break;
		case'41' : 
			if($hasil<136||$hasil>146){ $tanda=1;}
			break;
		case'42' : 
			if($hasil<3.5||$hasil>5){ $tanda=1;}
			break;
		case'43' : 
			if($hasil<98||$hasil>106){ $tanda=1;}
			break;
		case'68' : 
			if($hasil<4.6||$hasil>8.5){ $tanda=1;}
			break;
		case'69' : 
			if($hasil<1003||$hasil>1030){ $tanda=1;}
			break;
		case'70' : 
			if($hasil<0||$hasil>1){ $tanda=1;}
			break;
		case'71' : 
			if($hasil<0||$hasil>5){ $tanda=1;}
			break;
	}//end switch
	
	return $tanda;
}

function tampilAngkaNormal($jkel, $paatas, $pabawah, $piatas, $pibawah, $angka){
	//echo 'Pb : '.$pibawah.' -- ';
	if($angka=='0'){
		return $paatas;
	}else if($angka=='1'){
		if($jkel=='L'){
			if($pabawah==0){
				$hasil = ' < '.format_uang($paatas);
			}else if($paatas==0){
				$hasil = ' > '.format_uang($pabawah);
			}else{
				$hasil = format_uang($pabawah).' - '.format_uang($paatas);
			}
			//$hasil = $pabawah.' - '.$paatas;
			return $hasil;
		}else{
			if($pibawah==0){
				$hasil = ' < '.format_uang($piatas);
			}else if($piatas==0){
				$hasil = ' > '.format_uang($pibawah);
			}else{
				$hasil = format_uang($pibawah).' - '.format_uang($piatas);
			}
			//$hasil = $pibawah.' - '.$piatas;
			return $hasil;
		}
	}else{
		if($jkel=='L'){
			//$hasil = format_uang($pabawah).' - '.format_uang($paatas);
			//echo $pabawah;
			if($pabawah==0){
				$hasil = ' < '.$paatas;
			}else if($paatas==0){
				$hasil = ' > '.$pabawah;
			}else{
				$hasil = $pabawah.' - '.$paatas;
			}
			return $hasil;
		}else{
			//$hasil = format_uang($pibawah).' - '.format_uang($piatas);
			//echo $pibawah;
			if($pibawah==0){
				$hasil = ' < '.$piatas;
			}else if($piatas==0){
				$hasil = ' > '.$pibawah;
			}else{
				$hasil = $pibawah.' - '.$piatas;
			}
			return $hasil;
		}
	}
}
function tampilBintang($nilai, $jkel, $paatas, $pabawah, $piatas, $pibawah, $angka){
	$tanda = 0;
	// JIKA TIDAK DI SET
	if((empty($paatas))&&(empty($pabawah))&&(empty($piatas))&&(empty($pibawah))){
		$tanda = 0;
	}else if($angka=='0'){
		if((strtoupper($nilai)!=$paatas)&&(isset($nilai))){
			$tanda = 1;
		}
	}else{
		if(empty($nilai)||empty($paatas)){
			$tanda = 0;
		}else{
		if($jkel=='L'){
				if(($nilai<$pabawah)||($nilai>$paatas)){
					$tanda = 1;
				}
			}else{
				if(($nilai<$pibawah)||($nilai>$piatas)){
					$tanda = 1;
				}
			}
		}
	}
	return $tanda;
}
/*
function login( $id, $pass )
{
    global $password_session;
    global $id_ses;
    koneksi( );
    $sql = "Select * from member where  id='{$id}' and pass='{$pass}' and status='yes'";
    $res = mysql_query( $sql );
    if ( !( $rs = mysql_fetch_object( $res ) ) )
    {
        return false;
    }
    else
    {
        session_register( "password_session" );
        session_register( "id_ses" );
        $password_session = "sip911";
        $id_ses = $rs->id;
        return true;
    }
}

function sesi( )
{
    global $password_session;
    session_start( );
    if ( $password_session != "sip911" )
    {
        header( "Location:../member.php" );
        exit( );
    }
}

function cekidmember( $id )
{
    global $salah;
    koneksi( );
    $sql = "select * from member where id='{$id}'";
    $res = mysql_query( $sql );
    $jum = mysql_num_rows( $res );
    if ( $jum == 0 )
    {
        return true;
    }
    else
    {
        $salah = "<br><br><center><font size=2 color=black face=Courier><b>MAAF, USER ID TELAH TERPAKAI</b></font><br><br><font size=2 color=red face=verdana>\r\nUser ID yang anda masukkan telah digunakan member lain<br>Silahkan tekan BACK untuk mengganti dengan yang lain</font></center><br><br>";
        return false;
    }
}

function pesanan( )
{
    global $nama;
    global $alamat;
    global $email;
    global $telepon;
    global $lostnumber;
    global $password;
    global $komisi;
    global $harga;
    global $username;
    global $transaksisp;
    global $transaksiown;
    global $id_sesi;
    global $kota;
    global $hp;
    global $no2;
    config( );
    koneksi( );
    $tanggaldaftar = sekarang( );
    $transaksisp = $komisi;
    $transaksiown = $harga - $transaksisp;
    $sql = "INSERT INTO member (no, id, tanggaldaftar,nama, alamat, email, telepon, hp, bank, kota, sponsor, status,lostnumber,pass,traffic,transaksisp,transaksiown)\r\nVALUES('', '{$username}', '{$tanggaldaftar}','{$nama}', '{$alamat}','{$email}', '{$telepon}', '{$hp}', 'SEGERA DI UPDATE !!!', '{$kota}', '{$id_sesi}', 'no','{$lostnumber}','{$password}','0','{$transaksisp}','{$transaksiown}')";
    mysql_query( $sql );
    $swl = "select * from member where lostnumber='{$lostnumber}'";
    $result = mysql_query( $swl );
    $yes = mysql_fetch_array( $result );
    $no1 = 100000 + $yes[no];
    $no2 = substr( $no1, -3 );
    $transaksisp = $transaksisp + $no2;
    $transaksiown = $transaksiown + $no2;
    $stl = "update  member set transaksisp='{$transaksisp}',transaksiown='{$transaksiown}' where lostnumber ='{$lostnumber}'";
    mysql_query( $stl );
}

function caridata( $id )
{
    global $data;
    koneksi( );
    $sql = "select * from member where id= '{$id}'";
    $result = mysql_query( $sql );
    $data = mysql_fetch_array( $result );
}

function caridata1( $id )
{
    global $data1;
    koneksi( );
    $sql = "select * from member where id= '{$id}'";
    $result = mysql_query( $sql );
    $data1 = mysql_fetch_array( $result );
}

function caridata2( $id )
{
    global $data2;
    koneksi( );
    $sql = "select * from member where id= '{$id}'";
    $result = mysql_query( $sql );
    $data2 = mysql_fetch_array( $result );
}

function tes( $id )
{
    global $wrong;
    if ( !status( $id ) )
    {
        echo "{$wrong}";
        exit( );
    }
}

function status( $id )
{
    global $defaultsp;
    global $wrong;
    global $id_sesi;
    global $nama_sesi;
    global $email_sesi;
    global $noid_sesi;
    global $kota_sesi;
    global $bank_sesi;
    global $telepon_sesi;
    global $hp_sesi;
    global $emailadmin;
    koneksi( );
    if ( $id == "" )
    {
        $sol = "select * from member where no='{$defaultsp}' and status='yes'";
        $res = mysql_query( $sol );
        $has = mysql_fetch_array( $res );
        $id = $has[id];
    }
    $sql = "select * from member where id='{$id}'";
    $result = mysql_query( $sql );
    if ( $dat = mysql_fetch_array( $result ) )
    {
        if ( $dat[status] == "yes" )
        {
            session_register( "id_sesi" );
            session_register( "email_sesi" );
            session_register( "nama_sesi" );
            session_register( "kota_sesi" );
            session_register( "bank_sesi" );
            session_register( "telepon_sesi" );
            session_register( "hp_sesi" );
            $nama_sesi = $dat[nama];
            $email_sesi = $dat[email];
            $level_sesi = $dat[level];
            $kota_sesi = $dat[kota];
            $bank_sesi = $dat[bank];
            $telepon_sesi = $dat[telepon];
            $hp_sesi = $dat[hp];
            $id_sesi = $id;
            return true;
        }
        else
        {
            $wrong = "\r\n<html>\r\n<head>\r\n<title>Website anda terblokir...</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">\r\n</head>\r\n<body>\r\n<p>&nbsp;</p>\r\n<table width=\"75%\" border=\"0\" align=\"center\" bgcolor=\"#0000FF\">\r\n  <tr>\r\n    <td width=\"3%\">&nbsp;</td>\r\n    <td width=\"94%\">&nbsp;</td>\r\n    <td width=\"3%\">&nbsp;</td>\r\n  </tr>\r\n  <tr>\r\n    <td>&nbsp;</td>\r\n    <td bgcolor=\"#FFFFFF\"><div align=\"center\"><font color=\"#FF0000\" size=\"3\" face=\"Arial, Helvetica, sans-serif\"><br><br><strong>Maaf\r\n        ... website anda belum teraktivasi<br>\r\n        <font color=\"#000066\">segera hubungi webmaster ...!</font></strong></font></div>\r\n      <p align=\"center\"><font face=\"Arial, Helvetica, sans-serif\">Pengelola</font><font face=\"Arial, Helvetica, sans-serif\"><br>\r\n        <strong>{$emailadmin} </strong></font></p><br></td>\r\n    <td>&nbsp;</td>\r\n  </tr>\r\n  <tr>\r\n    <td>&nbsp;</td>\r\n    <td>&nbsp;</td>\r\n    <td>&nbsp;</td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>";
            return false;
        }
    }
    else
    {
        $wrong = "<html>\r\n    <head>\r\n    <title>URL ini tidak ditemukan...</title>\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">\r\n    </head>\r\n    <body>\r\n    <p>&nbsp;</p>\r\n    <table width=\"75%\" border=\"0\" align=\"center\" bgcolor=\"#0000FF\">\r\n    <tr>\r\n    <td width=\"3%\">&nbsp;</td>\r\n    <td width=\"94%\">&nbsp;</td>\r\n    <td width=\"3%\">&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n    <td>&nbsp;</td>\r\n    <td bgcolor=\"#FFFFFF\"><div align=\"center\"><font color=\"#FF0000\" size=\"3\" face=\"Arial, Helvetica, sans-serif\"><br><br><strong>Maaf...<br>\r\n        URL yang anda tuliskan tidak kami temukan pada database<br>mungkin ada kesalahan penulisan URL<br>\r\n        <font color=\"#000066\">segera hubungi webmaster ...!</font></strong></font></div>\r\n      <p align=\"center\"><font face=\"Arial, Helvetica, sans-serif\">Pengelola</font><font face=\"Arial, Helvetica, sans-serif\"><br>\r\n        <strong>{$emailadmin}</strong></font></p><br></td>\r\n    <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n    <td>&nbsp;</td>\r\n    <td>&nbsp;</td>\r\n    <td>&nbsp;</td>\r\n    </tr>\r\n    </table>\r\n    </body>\r\n    </html>";
        return false;
    }
}

function lostnumber( )
{
    $the_char = array( "a", "A", "b", "B", "c", "C", "d", "D", "e", "E", "f", "F", "g", "G", "h", "H", "i", "I", "j", "J", "k", "K", "l", "L", "m", "M", "n", "N", "o", "O", "p", "P", "q", "Q", "r", "R", "s", "S", "t", "T", "u", "U", "v", "V", "w", "W", "x", "X", "y", "Y", "z", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0" );
    $max_elements = count( $the_char ) - 1;
    srand( ( $double ) * 1000000 );
    $c1 = $the_char[rand( 0, $max_elements )];
    $c2 = $the_char[rand( 0, $max_elements )];
    $c3 = $the_char[rand( 0, $max_elements )];
    $c4 = $the_char[rand( 0, $max_elements )];
    $c5 = $the_char[rand( 0, $max_elements )];
    $c6 = $the_char[rand( 0, $max_elements )];
    $c7 = $the_char[rand( 0, $max_elements )];
    $c8 = $the_char[rand( 0, $max_elements )];
    $c9 = $the_char[rand( 0, $max_elements )];
    $c10 = $the_char[rand( 0, $max_elements )];
    $c11 = $the_char[rand( 0, $max_elements )];
    $c12 = $the_char[rand( 0, $max_elements )];
    $c13 = $the_char[rand( 0, $max_elements )];
    $c14 = $the_char[rand( 0, $max_elements )];
    $c15 = $the_char[rand( 0, $max_elements )];
    $c16 = $the_char[rand( 0, $max_elements )];
    $c17 = $the_char[rand( 0, $max_elements )];
    $c18 = $the_char[rand( 0, $max_elements )];
    $c19 = $the_char[rand( 0, $max_elements )];
    $c20 = $the_char[rand( 0, $max_elements )];
    $c21 = $the_char[rand( 0, $max_elements )];
    $c22 = $the_char[rand( 0, $max_elements )];
    $c23 = $the_char[rand( 0, $max_elements )];
    $c24 = $the_char[rand( 0, $max_elements )];
    $c25 = $the_char[rand( 0, $max_elements )];
    $c26 = $the_char[rand( 0, $max_elements )];
    $c27 = $the_char[rand( 0, $max_elements )];
    $c28 = $the_char[rand( 0, $max_elements )];
    $c29 = $the_char[rand( 0, $max_elements )];
    $c30 = $the_char[rand( 0, $max_elements )];
    $ranc = "{$c1}{$c2}{$c3}{$c4}{$c5}{$c6}{$c7}{$c8}{$c9}{$c10}{$c11}{$c12}{$c13}{$c14}{$c15}{$c16}{$c17}{$c18}{$c19}{$c20}{$c21}{$c22}{$c23}{$c24}{$c25}{$c26}{$c27}{$c28}{$c29}{$c30}";
    return $ranc;
}

function tanggal( $waktu )
{
    $tanggal = strftime( "%d-%b-%Y", $waktu );
    return $tanggal;
}

function ubahbulanketext( $month )
{
    switch ( $month )
    {
        case "01" :
            $minth = "Januari";
            break;
        case "02" :
            $minth = "Februari";
            break;
        case "03" :
            $minth = "Maret";
            break;
        case "04" :
            $minth = "April";
            break;
        case "05" :
            $minth = "Mei";
            break;
        case "06" :
            $minth = "Juni";
            break;
        case "07" :
            $minth = "Juli";
            break;
        case "08" :
            $minth = "Agustus";
            break;
        case "09" :
            $minth = "September";
            break;
        case "10" :
            $minth = "Oktober";
            break;
        case "11" :
            $minth = "November";
            break;
        case "12" :
            $minth = "Desember";
    }
    return $minth;
}

function hariindo( $hariinggris )
{
    switch ( $hariinggris )
    {
        case "Sunday" :
            $hari = "Minggu";
            break;
        case "Monday" :
            $hari = "Senin";
            break;
        case "Tuesday" :
            $hari = "Selasa";
            break;
        case "Wednesday" :
            $hari = "Rabu";
            break;
        case "Thursday" :
            $hari = "Kamis";
            break;
        case "Friday" :
            $hari = "Jum'at";
            break;
        case "Saturday" :
            $hari = "Sabtu";
    }
    return $hari;
}

function tambahwaktu( $satuanwaktu, $tambahanwaktu )
{
    global $akandatang;
    global $tanggalditambah;
    global $next;
    global $REMOTE_ADDR;
    global $sudah;
    $bulan1 = date( "m" );
    $hari1 = date( "d" );
    $tahun1 = date( "Y" );
    $date = mktime( 0, 0, 0, $bulan1, $hari1, $tahun1 );
    $date_time_array = getdate( $date );
    $month = $date_time_array['mon'];
    $day = $date_time_array['mday'];
    $year = $date_time_array['year'];
    switch ( $satuanwaktu )
    {
        case "yyyy" :
            $year += $tambahanwaktu;
            break;
        case "q" :
            $year += $tambahanwaktu * 3;
            break;
        case "m" :
            $month += $tambahanwaktu;
            break;
        case "y" :
        case "d" :
        case "w" :
            $day += $tambahanwaktu;
            break;
        case "ww" :
            $day += $tambahanwaktu * 7;
            break;
        case "h" :
            $hours += $tambahanwaktu;
            break;
        case "n" :
            $minutes += $tambahanwaktu;
            break;
        case "s" :
            $seconds += $tambahanwaktu;
    }
    $next = mktime( 0, 0, 0, $month, $day, $year );
    $hari2 = strftime( "%d", $next );
    $harin2 = strftime( "%A", $next );
    $bulan2 = strftime( "%m", $next );
    $tahun2 = strftime( "%Y", $next );
    $monn2 = ubahbulanketext( $bulan2 );
    $dayn2 = hariindo( $harin2 );
    $tanggalditambah = strftime( "%Y-%m-%d", $next );
    $akandatang = $dayn2.", ".$hari2." ".$monn2." ".$tahun2;
}

function waktuenak( $next1 )
{
    $hari1 = strftime( "%d", $next1 );
    $harin1 = strftime( "%A", $next1 );
    $bulan1 = strftime( "%m", $next1 );
    $tahun1 = strftime( "%Y", $next1 );
    $monn1 = ubahbulanketext( $bulan1 );
    $akandatang1 = $hari1." ".$monn1." ".$tahun1;
    return $akandatang1;
}

function statistik( )
{
    global $set;
    global $id_ses;
    global $total;
    global $harga;
    koneksi( );
    if ( empty( $set ) )
    {
        $set = 0;
    }
    $sql = "select * from member where sponsor='{$id_ses}' and status='yes'";
    $result = mysql_query( $sql );
    $total = mysql_num_rows( $result );
    $sql1 = "select * from member where sponsor='{$id_ses}' and status='yes' order by tanggaldaftar desc limit {$set},10";
    $result1 = mysql_query( $sql1 );
    if ( $total == 0 )
    {
        echo "<hr align=center color=#000099 width=300 size=10>";
    }
    else
    {
        echo "<table border=\"1\" bordercolor=\"#003366\" cellpadding=\"1\" cellspacing=\"1\" width=\"90%\">\r\n                      <tr bordercolor=\"#003366\" cellpadding=\"1\" cellspacing=\"1\" bgcolor=\"#CCCCFF\"> \r\n                        <td> <div align=\"center\"><strong><font face=arial size=2>No</font></strong></div></td>\r\n                        <td> <div align=\"center\"><strong><font face=arial size=2>Nama</font></strong></div></td>\r\n                        <td><div align=\"center\"><strong><font face=arial size=2>Email</font></strong></div></TD>\r\n                        <td><div align=\"center\"><strong><font face=arial size=2>Transfer</font></strong></div></TD>\r\n                        <td><div align=\"center\"><strong><font face=arial size=2>BLOKIR</font></strong></div></TD>\r\n                      </tr>";
        $j = 1;
        $color = "#C6C6FF";
        while ( $yap = mysql_fetch_array( $result1 ) )
        {
            if ( $color == "#C6C6FF" )
            {
                $color = "white";
            }
            else
            {
                $color = "#C6C6FF";
            }
            echo "<tr bgcolor={$color}><td><div align=\"center\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=1>{$j}</font></div></td>\r\n                      <td><div align=\"left\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=1>{$yap['nama']}</font></div></td>\r\n                      <td><div align=\"left\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=1>{$yap['email']}</font></div></td>\r\n                      <td><div align=\"center\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=1>".rupiah( $yap[transaksisp] )."</font></div></td>\r\n                      <td><div align=\"center\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=1><a href=\"blokir.php?id={$yap['id']}&set={$set}\">BLOKIR</a></font></div></td>\r\n</tr>";
            ++$j;
        }
        echo "</table><br>";
    }
    $limitmember = 10;
    halaman( $total, $set, $limitmember );
}

function aktivasi( )
{
    global $set;
    global $id_ses;
    global $total;
    koneksi( );
    if ( empty( $set ) )
    {
        $set = 0;
    }
    $sql = "select * from member where sponsor='{$id_ses}' and status='no'";
    $result = mysql_query( $sql );
    $total = mysql_num_rows( $result );
    $sql1 = "select * from member where sponsor='{$id_ses}' and status='no' order by tanggaldaftar desc limit {$set},10";
    $result1 = mysql_query( $sql1 );
    if ( $total == 0 )
    {
        echo "<hr align=center color=#000099 width=300 size=10>";
    }
    else
    {
        echo "<table border=\"1\" bordercolor=\"#003366\" cellpadding=\"1\" cellspacing=\"1\" width=\"90%\">\r\n                      <tr bordercolor=\"#003366\" cellpadding=\"1\" cellspacing=\"1\" bgcolor=\"#CCCCFF\"> \r\n                        <td> <div align=\"center\"><strong><font face=arial size=2>No</font> </strong></div></td>\r\n                        <td> <div align=\"center\"><strong><font face=arial size=2>Nama</font> </strong></div></td>\r\n                        <td><div align=\"center\"><strong><font face=arial size=2>Email</font></strong></div></TD>\r\n                        <td><div align=\"center\"><strong><font face=arial size=2>HP</font></strong></div></TD>\r\n                        <td><div align=\"center\"><strong><font face=arial size=2>Transfer</font></strong></div></TD>\r\n                        <td><div align=\"center\"><strong><font face=arial size=2>Kota</font></strong></div></TD>\r\n                      </tr>";
        $j = 1;
        $color = "#C6C6FF";
        while ( $yap = mysql_fetch_array( $result1 ) )
        {
            if ( $color == "#C6C6FF" )
            {
                $color = "white";
            }
            else
            {
                $color = "#C6C6FF";
            }
            echo "<tr bgcolor={$color}><td><div align=\"center\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=1>{$j}</font></div></td>\r\n                      <td><div align=\"left\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=1>{$yap['nama']}</font></div></td>\r\n                      <td><div align=\"left\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=1>{$yap['email']}</font></div></td>\r\n                      <td><div align=\"left\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=1>{$yap['hp']}</font></div></td>\r\n                      <td><div align=\"center\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=1>".rupiah( $yap[transaksisp] )."</font></div></td>\r\n                      <td><div align=\"center\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=1>{$yap['kota']}</font></div></td>\r\n</tr>";
            ++$j;
        }
        echo "</table><br>";
    }
    $limitmember = 10;
    halaman( $total, $set, $limitmember );
}

function halaman( $numrows, $set, $limit )
{
    if ( $set != 0 )
    {
        $prevoffset = $set - $limit;
        print "<a href=\"{$PHP_SELF}?set={$prevoffset}\"><font face=arial size=-1>Prev</font></a> &nbsp; \n";
    }
    $pages = intval( $numrows / $limit );
    if ( $numrows % $limit )
    {
        ++$pages;
    }
    $i = 1;
    for ( ; $i <= $pages; ++$i )
    {
        $newoffset = $limit * ( $i - 1 );
        print "<a href=\"{$PHP_SELF}?set={$newoffset}\"><font size=-1 color=black face=arial>{$i}</font></a>&nbsp;\n";
    }
    if ( $set / $limit < $pages - 1 )
    {
        $newoffset = $set + $limit;
        print "<a href=\"{$PHP_SELF}?set={$newoffset}\"><font face=arial size=-1>Next</font></a><p>\n";
    }
}



function halamanmember( $numrows, $set, $limit, $urut )
{
    global $urut;
    if ( $set != 0 )
    {
        $prevoffset = $set - $limit;
        print "<a href=\"{$PHP_SELF}?set={$prevoffset}&urut={$urut}\"><font face=arial size=-1>Prev</font></a> &nbsp; \n";
    }
    $pages = intval( $numrows / $limit );
    if ( $numrows % $limit )
    {
        ++$pages;
    }
    $i = 1;
    for ( ; $i <= $pages; ++$i )
    {
        $newoffset = $limit * ( $i - 1 );
        print "<a href=\"{$PHP_SELF}?set={$newoffset}&urut={$urut}\"><font size=-1 color=black face=arial>{$i}</font></a>&nbsp;\n";
    }
    if ( $set / $limit < $pages - 1 )
    {
        $newoffset = $set + $limit;
        print "<a href=\"{$PHP_SELF}?set={$newoffset}&urut={$urut}\"><font face=arial size=-1>Next</font></a><p>\n";
    }
}
*/

function hitung_hari($tanggale){

$tgl1 = $tanggale;  
// 1 Oktober 2009 
$tgl2 = date("Y-m-d");  // 10 Oktober 2009 

// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun 
// dari tanggal pertama 
$pecah1 = explode("-", $tgl1); 
$date1 = $pecah1[2]; 
$month1 = $pecah1[1]; 
$year1 = $pecah1[0]; 

// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun 
// dari tanggal kedua 
$pecah2 = explode("-", $tgl2); $date2 = $pecah2[2]; 
$month2 = $pecah2[1]; $year2 =  $pecah2[0]; 

// menghitung JDN dari masing-masing tanggal 
$jd1 = gregoriantojd($month1, $date1, $year1); 
$jd2 = gregoriantojd($month2, $date2, $year2); 

// hitung selisih hari kedua tanggal 
$selisih = $jd2 - $jd1; 
$tahun = $selisih / 365;
$sisa = $selisih % 365;
$bulan = $sisa / 30;
$hari = $sisa % 30;
//echo "Selisih kedua tanggal adalah ".$selisih." hari <br />"; 
//echo "Selisih kedua tanggal adalah ".round($tahun)." tahun ".round($bulan)." bulan ".$hari." hari"; 
return $hari;
}

function hitung_selisih_hari($tglawalnya, $tglakhirnya){

$tgl1 = $tglawalnya;  
// 1 Oktober 2009 
$tgl2 = $tglakhirnya;  // 10 Oktober 2009 

// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun 
// dari tanggal pertama 
$pecah1 = explode("-", $tgl1); 
$date1 = $pecah1[2]; 
$month1 = $pecah1[1]; 
$year1 = $pecah1[0]; 

// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun 
// dari tanggal kedua 
$pecah2 = explode("-", $tgl2); $date2 = $pecah2[2]; 
$month2 = $pecah2[1]; $year2 =  $pecah2[0]; 

// menghitung JDN dari masing-masing tanggal 
$jd1 = gregoriantojd($month1, $date1, $year1); 
$jd2 = gregoriantojd($month2, $date2, $year2); 

// hitung selisih hari kedua tanggal 
$selisih = $jd2 - $jd1; 
$tahun = $selisih / 365;
$sisa = $selisih % 365;
$bulan = $sisa / 30;
$hari = $sisa % 30;
//echo "Selisih kedua tanggal adalah ".$selisih." hari <br />"; 
//echo "Selisih kedua tanggal adalah ".round($tahun)." tahun ".round($bulan)." bulan ".$hari." hari"; 
return $hari;
}

function format_uang_desimal($nominal){
	$pecah = explode(".",$nominal);
	
	$nilai=number_format($pecah[0],0,",",".");
	
	if($pecah[1]){
		$nilaiakhir = $nilai.",".$pecah[1];
	}else{
		$nilaiakhir = $nilai;
	}
	
	return $nilaiakhir;
}

function tampilBulan($nominal){
	
	switch($nominal){
		default : $bulan='SALAH BULAN'; break;
		case '01': $bulan='Januari'; break;
		case '02': $bulan='Februari'; break;
		case '03': $bulan='Maret'; break;
		case '04': $bulan='April'; break;
		case '05': $bulan='Mei'; break;
		case '06': $bulan='Juni'; break;
		case '07': $bulan='Juli'; break;
		case '08': $bulan='Agustus'; break;
		case '09': $bulan='September'; break;
		case '10': $bulan='Oktober'; break;
		case '11': $bulan='November'; break;
		case '12': $bulan='Desember'; break;
	}	
	$tampilan=strtoupper($bulan);
	return $tampilan;
}


?>
