<?
include "db.php";
$cek_kode=mysql_query("SELECT koders2 from user_emonev_tw2");
while($c_kode=mysql_fetch_array($cek_kode)){
$cek=mysql_query("SELECT kd_baru from tbl_kode where kd_lama='$c_kode[koders2]'");
$ketemu=mysql_num_rows($cek);
$kode_baru=mysql_fetch_array($cek);
if ($ketemu>=1){
mysql_query("Update user_emonev_tw2 set koders='$kode_baru[kd_baru]' where koders2='$c_kode[koders2]'");
mysql_query("update user_emonev_tw2 set kodeprop=left(koders,2) where CHAR_LENGTH(koders)>=7");
}
else{
mysql_query("Update user_emonev_tw2 set koders='$c_kode[koders2]' where koders2='$c_kode[koders2]'");
mysql_query("update user_emonev_tw2 set kodeprop=left(koders,2) where CHAR_LENGTH(koders)>=7");
}
};
?>