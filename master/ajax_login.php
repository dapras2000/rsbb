<?php session_start();

include '../include/connect.php';

$user_name=htmlspecialchars($_POST['user_name'],ENT_QUOTES);
//$pass=md5($_POST['password']);
$pass=$_POST['password'];

$sql="SELECT nip as user_name, pwd as password FROM m_login WHERE nip='".$user_name."' and departemen = 'ADMIN'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

if(mysql_num_rows($result)>0)
{
	if(strcmp($row['password'],$pass)==0)
	{
		echo "yes";
		$_SESSION['u_name']=$user_name; 
	}
	else
		echo "no"; 
}
else
	echo "no"; 
?>