<?php session_start();

if(empty($_SESSION['u_name']))
	header("Location:index.php");	

if(isset($_GET['logout']))
{
	session_destroy();
	header("Location:index.php");
}	

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> Master Menu</title>
<link rel="stylesheet" type="text/css" href="master.css" />
</head>
<body>
<div id="masthead"> <div id="bg_variation"> <div id="logo"></div></div></div>
	<ol id="navlinks">
		<li> <a href="m_icd/index.php">ICD</a></li>
		<li> <a href="m_login/index.php">USER LOGIN</a></li>
		<li> <a href="m_poly/index.php">POLY</a></li>
		<li> <a href="m_tarif/index.php">TARIF</a></li>
		<li> <a href="m_dokter/index.php">DOKTER</a></li>
		<li> <a href="m_kamar/index.php">KAMAR DAN KELAS</a></li>
		<li> <a href="m_profil/index.php">PROFIL</a></li>
		<li> <a href="m_info/index.php">INFO</a></li>
		<li> <a href="secure.php?logout">LOGOUT</a></li>
	</ol>

</body>
</html>