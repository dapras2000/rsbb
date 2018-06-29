<?
include "db.php";
error_reporting("E_ALL");
session_start();
if (empty($_SESSION[namauser]) AND
empty($_SESSION[password])) {
header("Location:login.php");
}

$session=mysql_query ("select koders from user_sirs where koders=$_SESSION[namauser]");
$cari=mysql_num_rows($session);
if ($cari > 0){
header('location:http://www.emonev.buk.depkes.go.id:8080/emonev_new');
}
else{
echo '<script language="Javascript">
alert ("Maaf Untuk Sementara Anda Tidak Bisa Mengakses Aplikasi Emonev, Silahkan Lakukan Update Data RS Anda Pada Aplikasi RS Online");

</script>';
if ($_SESSION[profil]==5){
echo"<a href=user_home.php>Back Home</a>";}
else if ($_SESSION[profil]==3){
echo"<a href=user_list.php>Back Home</a>";};
/*header("location:user_home.php");*/
};

?>
