<?

	session_start();
	// If you have  the PEAR PHP package, you can comment the next line.
	ini_set('include_path',dirname($_SERVER["SCRIPT_FILENAME"])."/icd/include");
	require_once ('common.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Master ICD Code</title>
	<link rel="stylesheet" href="icd/css/style.css" type="text/css" />
	<?php $xajax->printJavascript("icd/include/") ?>
</head>
<body>
	<br>
	<center>
	<table width="90%" border="0"  style="background: #F9F9F9; padding: 0px;">
		<tr>
			<td style="padding: 0px;">
				<div id="frame_title"> <h3 align="left">Master ICD</h3></div>
				<fieldset class="fieldset">
				
				<div id="formDiv" class="formDiv"></div>
				<div id="grid" align="center"> </div>
				 <script type="text/javascript">
					xajax_showGrid(0,<?=ROWSXPAGE?>,'','','icd_code');
				</script>
				
				</fieldset>
			</td>
		</tr>
	</table>
	</center>
</body>
</html>
