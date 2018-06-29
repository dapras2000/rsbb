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
<title>Master PROFIL</title>
    <link rel="stylesheet" type="text/css" href="../master.css" />
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<?php $xajax->printJavascript("include/") ?>
</head>
<body>

<div id="masthead"> <div id="bg_variation"> <div id="logo"></div></div></div>
	<ol id="navlinks">  	    
		<li> <a href="../m_icd/index.php">ICD</a></li>
		<li> <a href="../m_login/index.php">USER LOGIN</a></li>
		<li> <a href="../m_poly/index.php">POLY</a></li>
		<li> <a href="../m_tarif/index.php">TARIF</a></li>
		<li> <a href="../m_dokter/index.php">DOKTER</a></li>
		<li> <a href="../m_kamar/index.php">KAMAR DAN KELAS</a></li>
		<li> <a href="../m_profil/index.php">PROFIL</a></li>
		<li class="last">INFO</li>
		<li> <a href="../secure.php?logout">LOGOUT</a></li>
	</ol>
	<br>
	<center>
	<table width="90%" border="0" style="background: #F9F9F9; padding: 0px;">
		<tr>
			<td style="padding: 0px;">
				<fieldset>
					
					<?php
						include "../../include/connect.php";
						$data=mysql_fetch_array(mysql_query("SELECT * FROM info"));

						if(@$_POST['perbaharui'])
						{
						    //update data ke database
						    $myquery =  "UPDATE info SET
							    			isi_info='$_POST[isi_info]'
						    			 WHERE 
						    			 	id ='$data[id]'"; 
						    mysql_query($myquery) or die(mysql_error());
						    if ($myquery) {
						    	echo"<script>alert('Ifno Berhasl Diperbaharui !');</script>";
						    	echo"<meta http-equiv=refresh content=1;url=index.php";
						    }else{
						        echo"<script>alert('Error !');</script>";
						    }
						}
					?>
					<form name="form_perbaharui" method="POST">
					<table width="80%" border="0" align="center"  style="background: #F9F9F9; padding: 0px;">
						<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
						<tr>
							<td>Isi Info :</td>
						</tr>
						<tr>
							<td>
								<textarea name="isi_info" style="width:100%;height:50px;"><?php echo $data['isi_info']; ?></textarea>
							</td>
						</tr>
						<tr align="center">
							<td><input type="submit" name="perbaharui" value="Perbaharui"/></td>
						</tr>
					</table>
					</form>

				</fieldset>
			</td>
		</tr>
	</table>
	</center>
</body>
</html>
