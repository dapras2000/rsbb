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
		<li class="last">PROFIL</li>
		<li> <a href="../m_info/index.php">INFO</a></li>
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
						$data=mysql_fetch_array(mysql_query("SELECT * FROM profil"));

						if(@$_POST['perbaharui'])
						{
						    //update data ke database
						    $myquery =  "UPDATE profil SET
							    			id='$_POST[id]',
							    			rstitle='$_POST[rstitle]',
							    			singrstitl='$_POST[singrstitl]',
							    			singhead1='$_POST[singhead1]',
							    			singsurat='$_POST[singsurat]',
							    			header1='$_POST[header1]',
							    			header2='$_POST[header2]',
							    			header3='$_POST[header3]',
							    			header4='$_POST[header4]',
							    			kdrs='$_POST[kdrs]',
							    			kelasrs='$_POST[kelasrs]',
							    			namars='$_POST[namars]',
							    			kdtarifnacbg='$_POST[kdtarifnacbg]'
						    			 WHERE 
						    			 	id ='$data[id]'"; 
						    mysql_query($myquery) or die(mysql_error());
						    if ($myquery) {
						    	echo"<script>alert('Profil Berhasil Diperbaharui !');</script>";
						    	echo"<meta http-equiv=refresh content=1;url=index.php";
						    }else{
						        echo"<script>alert('Error !');</script>";
						    }
						}
					?>
					<form name="form_perbaharui" method="POST">
					<table width="400px" border="0" align="center"  style="background: #F9F9F9; padding: 0px;">
						<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
						<tr>
							<td>RS Title</td>
							<td width="10px">:</td>
							<td><input type="text" name="rstitle" style="width:250px;" value="<?php echo $data['rstitle']; ?>" /></td>
						</tr>
						<tr>
							<td>Singkatan RS Title</td>
							<td>:</td>
							<td><input type="text" name="singrstitl"  style="width:250px;" value="<?php echo $data['singrstitl']; ?>" /></td>
						</tr>
						<tr>
							<td>Singkatan RS Tittle (header 1)</td>
							<td>:</td>
							<td><input type="text" name="singhead1"  style="width:250px;" value="<?php echo $data['singhead1']; ?>" /></td>
						</tr>
						<tr>
							<td>Singkatan RS (Surat)</td>
							<td>:</td>
							<td><input type="text" name="singsurat"  style="width:250px;" value="<?php echo $data['singsurat']; ?>" /></td>
						</tr>
						<tr>
							<td>Header 1 (Kwitansi)</td>
							<td>:</td>
							<td><input type="text" name="header1"  style="width:200px;" value="<?php echo $data['header1']; ?>" /></td>
						</tr>
						<tr>
							<td>Header 2 (Kwitansi)</td>
							<td>:</td>
							<td><input type="text" name="header2"  style="width:200px;" value="<?php echo $data['header2']; ?>" /></td>
						</tr>
						<tr>
							<td>Header 3 (Kwitansi)</td>
							<td>:</td>
							<td><input type="text" name="header3"  style="width:200px;" value="<?php echo $data['header3']; ?>" /></td>
						</tr>
						<tr>
							<td>Header 4 (Kwitansi)</td>
							<td>:</td>
							<td><input type="text" name="header4"  style="width:200px;" value="<?php echo $data['header4']; ?>" /></td>
						</tr>
						<tr>
							<td>Kode RS</td>
							<td>:</td>
							<td><input type="text" name="kdrs"  style="width:150px;" value="<?php echo $data['kdrs']; ?>" /></td>
						</tr>
						<tr>
							<td>Kelas RS</td>
							<td>:</td>
							<td><input type="text" name="kelasrs"  style="width:50px;" value="<?php echo $data['kelasrs']; ?>" /></td>
						</tr>
						<tr>
							<td>Nama RS</td>
							<td>:</td>
							<td><input type="text" name="namars"  style="width:250px;" value="<?php echo $data['namars']; ?>" /></td>
						</tr>
						<tr>
							<td>Kode Tarif INACBG</td>
							<td>:</td>
							<td><input type="text" name="kdtarifnacbg"  style="width:150px;" value="<?php echo $data['kdtarifnacbg']; ?>" /></td>
						</tr>
						<tr align="center">
							<td colspan="3"><input type="submit" name="perbaharui" value="Perbaharui"/></td>
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
