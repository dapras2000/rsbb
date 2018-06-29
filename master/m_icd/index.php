<?

	session_start();
if(empty($_SESSION['u_name']))
	header("Location:index.php");	

if(isset($_GET['logout']))
{
	session_destroy();
	header("Location:index.php");
}	
	
	// If you have  the PEAR PHP package, you can comment the next line.
	ini_set('include_path',dirname($_SERVER["SCRIPT_FILENAME"])."/include");
	require_once ('common.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Master ICD</title>
    <link rel="stylesheet" type="text/css" href="../master.css" />
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<?php $xajax->printJavascript("include/") ?>
</head>
<body>

<div id="masthead"> <div id="bg_variation"> <div id="logo"></div></div></div>
	<ol id="navlinks">   	
		<li class="last">ICD</li>
		<li> <a href="../m_login/index.php">USER LOGIN</a></li>
		<li> <a href="../m_poly/index.php">POLY</a></li>
		<li> <a href="../m_tarif/index.php">TARIF</a></li>
		<li> <a href="../m_dokter/index.php">DOKTER</a></li>
		<li> <a href="../m_kamar/index.php">KAMAR DAN KELAS</a></li>
		<li> <a href="../m_profil/index.php">PROFIL</a></li>
		<li> <a href="../m_info/index.php">INFO</a></li>
		<li> <a href="../secure.php?logout">LOGOUT</a></li>
	</ol>
    <br>
	<center>
	<table width="90%" border="0"  style="background: #F9F9F9; padding: 0px;">
		<tr>
			<td style="padding: 0px;">
				<div id="formDiv" class="formDiv"></div>
				<div id="grid" align="center"> </div>
				 <script type="text/javascript">
					xajax_showGrid(0,<?=ROWSXPAGE?>,'','','icd_code');
				</script>
			</td>
		</tr>
	</table>
	</center>
</body>
</html>
