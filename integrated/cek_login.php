<?
#include "db.php";


/*$login=mysql_query ("select `KODE RS` as koders,pwd,`NAMA RS` as profil,groupid,kodeprop from kode where `KODE RS`='$_POST[username]' and pwd=md5($_POST[password])");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);*/
$usr=$_POST[username];
$pas= $_POST[password];
$profil= 'Admin';
if ($usr=='cbgadmin' && $pas=='simtocbg'){
session_start();
session_register("namauser");
session_register("password");
session_register("jabatan");
$_SESSION[namauser]=$usr;
$_SESSION[password]=$pas;
$_SESSION[jabatan]=$profil;
header('location:user_home.php');
}
else{
header("Location:index.html");
exit();
}
?>
