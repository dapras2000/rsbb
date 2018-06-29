<?
error_reporting("E_ALL");
#include "ip.php";
include "db.php";


// membaca data1, data2, dan data3 dari form

$nilai1= $_GET['id'];
$nilai2= $_GET['nomr'];
$sql=  "select b.NAMA,b.TGLLAHIR,b.JENISKELAMIN, c.NAMA as payplan, a.TGLREG,a.KDCARABAYAR,d.keluarrs,e.ICD_CODE, e.icd_code2, e.icd_code3, e.icd_code4, e.icd_code5, e.icd_code6, e.icd_code7, e.icd_code8, e.icd_code9, e.icd_code10,e.icd_code11,e.icd_code12,e.icd_code13,e.icd_code14,e.icd_code15,e.icd_code16,e.icd_code17,e.icd_code18,e.icd_code19,e.icd_code20,e.icd_code21,e.icd_code22,e.icd_code23,e.icd_code24,e.icd_code25,e.icd_code26,e.icd_code27,e.icd_code28,e.icd_code29,e.icd_code30,e.icd_9,e.icd_92,e.icd_93,e.icd_94,e.icd_95,e.icd_96,e.icd_97,e.icd_98,e.icd_99,e.icd_910,e.icd_911,e.icd_912,e.icd_913,e.icd_914,e.icd_915,e.icd_916,e.icd_917,e.icd_918,e.icd_919,e.icd_920,e.icd_921,e.icd_922,e.icd_923,e.icd_924,e.icd_925,e.icd_926,e.icd_927,e.icd_928,e.icd_929,e.icd_930,g.NAMADOKTER,a.NOKARTU as sep, b.NO_KARTU, sum(h.TARIFRS) as t_rajal, sum(i.TARIFRS) as t_ranap from t_pendaftaran a left JOIN "
	  ."m_pasien b on b.NOMR=a.NOMR LEFT JOIN m_carabayar c on c.KODE=a.KDCARABAYAR left join t_admission d on d.id_admission=a.IDXDAFTAR left join t_diagnosadanterapi e on e.IDXDAFTAR=a.IDXDAFTAR left join m_dokter g on g.KDDOKTER=a.KDDOKTER left JOIN t_billrajal h on h.IDXDAFTAR=a.IDXDAFTAR left join t_billranap i on i.IDXDAFTAR=a.IDXDAFTAR where a.IDXDAFTAR='$nilai1' and a.NOMR='$nilai2'"; 

$query= mysql_query($sql);
$data= mysql_fetch_array($query);
if($data['keluarrs']==''){
$cb= 2;
$tgl_keluar= $data['TGLREG'];}
else{
$cb= 1;
$tgl_keluar= $data['keluarrs'];}
if($data['JENISKELAMIN']=='L'){
$jk= 1;
}
else if($data['JENISKELAMIN']=='P'){
$jk= 2;
}
$nilai3 = $data['NAMA'];
$nilai4 = $data['TGLLAHIR'];
$nilai5 = $jk;
$nilai6 = $data['payplan'];
$nilai7 = $data['TGLREG'];
$nilai8 = 5;
$nilai9 = $tgl_keluar;
$nilai10 = $data['sep'];
$nilai11 = $data['NO_KARTU'];
$nilai12 = $data['NAMADOKTER'];
$nilai13 = $data['ICD_CODE'];
$nilai14 = $data['ICD_CODE2'];
$nilai15 = $data['ICD_CODE3'];
$nilai16 = $data['ICD_CODE4'];
$nilai17 = $data['ICD_CODE5'];
$nilai18 = $data['ICD_CODE6'];
$nilai19 = $data['ICD_CODE7'];
$nilai20 = $data['ICD_CODE8'];
$nilai21 = $data['ICD_CODE9'];
$nilai22 = $data['ICD_CODE10'];
$nilai23 = $data['ICD_CODE11'];
$nilai24 = $data['ICD_CODE12'];
$nilai25 = $data['ICD_CODE13'];
$nilai26 = $data['ICD_CODE14'];
$nilai27 = $data['ICD_CODE15'];
$nilai28 = $data['ICD_CODE16'];
$nilai29 = $data['ICD_CODE17'];
$nilai30 = $data['ICD_CODE18'];
$nilai31 = $data['ICD_CODE19'];
$nilai32 = $data['ICD_CODE20'];
$nilai33 = $data['ICD_CODE21'];
$nilai34 = $data['ICD_CODE22'];
$nilai35 = $data['ICD_CODE23'];
$nilai36 = $data['ICD_CODE24'];
$nilai37 = $data['ICD_CODE25'];
$nilai38 = $data['ICD_CODE26'];
$nilai39 = $data['ICD_CODE27'];
$nilai40 = $data['ICD_CODE28'];
$nilai41 = $data['ICD_CODE29'];
$nilai42 = $data['ICD_CODE30'];
$nilai43 = $data['ICD_91'];
$nilai44 = $data['ICD_92'];
$nilai45 = $data['ICD_93'];
$nilai46 = $data['ICD_94'];
$nilai47 = $data['ICD_95'];
$nilai48 = $data['ICD_96'];
$nilai49 = $data['ICD_97'];
$nilai50 = $data['ICD_98'];
$nilai51 = $data['ICD_99'];
$nilai52 = $data['ICD_910'];
$nilai53 = $data['ICD_911'];
$nilai54 = $data['ICD_912'];
$nilai55 = $data['ICD_913'];
$nilai56 = $data['ICD_914'];
$nilai57 = $data['ICD_915'];
$nilai58 = $data['ICD_916'];
$nilai59 = $data['ICD_917'];
$nilai60 = $data['ICD_918'];
$nilai61 = $data['ICD_919'];
$nilai62 = $data['ICD_920'];
$nilai63 = $data['ICD_921'];
$nilai64 = $data['ICD_922'];
$nilai65 = $data['ICD_923'];
$nilai66 = $data['ICD_924'];
$nilai67 = $data['ICD_925'];
$nilai68 = $data['ICD_926'];
$nilai69 = $data['ICD_927'];
$nilai70 = $data['ICD_928'];
$nilai71 = $data['ICD_929'];
$nilai72 = $data['ICD_930'];
$nilai73 = "NCC";
$nilai74 = "NCC";
$nilai75 = $cb;
$nilai76 = 3;
$nilai77 = 1;
$nilai78 = $data['NAMADOKTER'];
$nilai79 = 0;
$nilai80= $data['t_rajal']+$data['t_ranap'];
$nilai81 = 1;
$nilai82= "";
$nilai83= 0;
$nilai84= "";
$nilai85="";
/*
$stay_ind = $_SESSION["drgresult_stay_ind"];
$regional_txt = addslashes($_SESSION["drgresult_wj"]);*/
 
// pengiriman ke situsku.com via CURL

$url = "http://localhost/inacbg/get_cbg_t_simrs_3.php";


$curlHandle = curl_init();

curl_setopt($curlHandle, CURLOPT_URL, $url);

curl_setopt($curlHandle, CURLOPT_POSTFIELDS, "user_nm=".$nilai73."&user_pw=".$nilai74."&norm=".$nilai2."&nm_pasien=".$nilai3."&tgl_lahir=".$nilai4."&jns_kelamin=".$nilai5."&jns_pbyrn=".$nilai8."&no_peserta=".$nilai11."&no_sep=".$nilai10."&jns_perawatan=".$nilai75."&kls_perawatan=".$nilai76."&tgl_masuk=".$nilai7."&tgl_keluar=".$nilai9."&jns_perawatan=".$nilai75."&kls_perawatan=".$nilai76."&cara_keluar=".$nilai77."&dpjp=".$nilai78."&berat_lahir=".$nilai79."&tarif_rs=".$nilai80."&srt_rujukan=".$nilai81."&bhp=".$nilai82."&severity3=".$nilai83."&adl=".$nilai84."&spec_proc=".$nilai85."&spec_inv=".$nilai85."&spec_prosth=".$nilai85."&spec_dr=".$nilai85."&diag1=".$nilai13."&diag2=".$nilai14."&diag3=".$nilai15."&diag4=".$nilai16."&diag5=".$nilai17."&diag6=".$nilai18."&diag7=".$nilai19."&diag8=".$nilai20."&diag9=".$nilai21."&diag10=".$nilai122."&diag11=".$nilai23."&diag12=".$nilai24."&diag13=".$nilai25."&diag14=".$nilai26."&diag15=".$nilai27."&diag16=".$nilai28."&diag17=".$nilai29."&diag18=".$nilai30."&diag19=".$nilai31."&diag20=".$nilai32."&diag21=".$nilai33."&diag22=".$nilai34."&diag23=".$nilai35."&diag24=".$nilai36."&diag25=".$nilai37."&diag26=".$nilai38."&diag27=".$nilai39."&diag28=".$nilai40."&diag29=".$nilai41."&diag30=".$nilai42."&proc1=".$nilai43."&proc2=".$nilai44."&proc3=".$nilai45."&proc4=".$nilai46."&proc5=".$nilai47."&proc6=".$nilai48."&proc7=".$nilai49."&proc8=".$nilai50."&proc9=".$nilai51."&proc10=".$nilai152."&proc11=".$nilai53."&proc12=".$nilai54."&proc13=".$nilai55."&proc14=".$nilai56."&proc15=".$nilai57."&proc16=".$nilai58."&proc17=".$nilai59."&proc18=".$nilai60."&proc19=".$nilai61."&proc20=".$nilai62."&proc21=".$nilai63."&proc22=".$nilai64."&proc23=".$nilai65."&proc24=".$nilai66."&proc25=".$nilai67."&proc26=".$nilai68."&proc27=".$nilai69."&proc28=".$nilai70."&proc29=".$nilai71."&proc30=".$nilai72);

curl_setopt($curlHandle, CURLOPT_HEADER, 0);

curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);

curl_setopt($curlHandle, CURLOPT_POST, 1);

$response= curl_exec($curlHandle);

curl_close($curlHandle);
$data= json_decode($response,true);

foreach ($data as $key=>$value) {
$key = strtolower(trim($key));
$object->$key = $value;
}
// cetak object
#print_r($response);
if($data['status']!=0){
print '<a href=user_home.php?idxdaftar='.$nilai1.'>'.$data['status_msg'].'<a>';
}
else{
#$data= json_decode(file_get_contents($response), true);
//echo"$k";
//print_r($data);
//$varian=serialize($data);
/* print array object */
//echo $data[0]['kd_satker'];
 $query=mysql_query("select IDXDAFTAR from res_cbg where IDXDAFTAR='" .$nilai1. "' ");
 $row=mysql_num_rows($query);
 if ($row < 1){
 $sql = mysql_query("insert res_cbg(IDXDAFTAR,NOMR,KODE_CBG,TARIF) values('" .$nilai1. "','" .$nilai2. "','" .$data['cbg_code']. "','" .$data['tariff']. "')");
 print '<a href=user_home.php?idxdaftar='.$nilai1.'>'.$data['status_msg'].'<a>';
}
}

?>