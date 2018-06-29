<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form Upload</title>

</head>

<body>

<div align="center">
  <div id="frame">
  <div id="frame_title">
  <h3 align="left">Upload File Excel Anda</h3></div>
<? if($_GET['psn'] != '')
{
echo $_GET['psn'];
}
else
{
echo "";
}
?>
<BR><form name="form1" action="ins_jamkesda.php" method="post" enctype="multipart/form-data">

<table width="251">
<tr><td width="95">Mulai baris</td>
<td width="302"><input type="text" name="baris" id="baris"></td>
</tr>

<tr><td>Nama Kolom</td>
<td>Kolom Ke</td>
</tr>
<tr><td>DPSNOKA</td>
<td><input type="text" name="DPSNOKA" id="DPSNOKA"></td>
</tr>
<tr><td>NOKK</td>
<td><input type="text" name="NOKK" id="NOKK"></td>
</tr>
<tr><td>NOPEN</td>
<td><input type="text" name="NOPEN" id="NOPEN"></td>
</tr>
<tr><td>KDDESA</td>
<td><input type="text" name="KDDESA" id="KDDESA"></td>
</tr>
<tr><td>KDKC</td>
<td><input type="text" name="KDKC" id="KDKC"></td>
</tr>
<tr><td>DPSKDKEC</td>
<td><input type="text" name="DPSKDKEC" id="DPSKDKEC"></td>
</tr>
<tr><td>DPSNMCTK</td>
<td><input type="text" name="DPSNMCTK" id="DPSNMCTK"></td>
</tr>
<tr><td>DPSTGLLHR</td>
<td><input type="text" name="DPSTGLLHR" id="DPSTGLLHR"></td>
</tr>
<tr><td>DPSJK</td>
<td><input type="text" name="DPSJK" id="DPSJK"></td>
</tr>
<tr><td>DPSSTSKWN</td>
<td><input type="text" name="DPSSTSKWN" id="DPSSTSKWN"></td>
</tr>
<tr><td>DPSJLN</td>
<td><input type="text" name="DPSJLN" id="DPSJLN"></td>
</tr>
<tr><td>DPSRTRW</td>
<td><input type="text" name="DPSRTRW" id="DPSRTRW"></td>
</tr>
<tr><td>DPSTGLREG</td>
<td><input type="text" name="DPSTGLREG" id="DPSTGLREG"></td>
</tr>
</table>
  <br>
<input type="file" name="upload_file" id="upload_file" size="50"/>
<input type="submit" name="upload" value="Upload dan Konversi" class='submit' />
<br><br>
</form>


</div></div>
</body>
</html>