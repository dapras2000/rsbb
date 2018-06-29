<?
include "db.php";
$cek_kode=mysql_query("SELECT kd_satker2 from user_eplanning");
while($c_kode=mysql_fetch_array($cek_kode)){
$cek=mysql_query("SELECT kd_baru from tbl_kode where kd_lama='$c_kode[kd_satker2]'");
$ketemu=mysql_num_rows($cek);
$kode_baru=mysql_fetch_array($cek);
if ($ketemu>=1){
mysql_query("Update user_eplanning set kd_satker='$kode_baru[kd_baru]' where kd_satker2='$c_kode[kd_satker2]'");

}
else{
mysql_query("Update user_eplanning set kd_satker='$c_kode[kd_satker2]' where kd_satker2='$c_kode[kd_satker2]'");

}
};
?>