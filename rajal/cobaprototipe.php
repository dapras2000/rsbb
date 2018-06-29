<script type="text/javascript" src="xmlhttp.js"></script>
<script type="text/javascript" src="functions.js"></script>

	<form action="hasilcoba.php" method="post" id="newtask" name="newtask">
		Your Name<br />
		<input name="yourname" id="yourname" /><br />
		Your Task<br />
		<textarea style="height: 80px;" name="yourtask" id="yourtask"></textarea><br />
		<input type="hidden" name="thedate" value="<?php echo $_GET['thedate']; ?>" />
		<input type="button" value="Submit" onclick="submitform (document.getElementById('newtask'),'hasilcoba.php','createtask',validatetask); return false;" />
		<div align="right"><a href="javascript:closetask()">close</a></div>
	</form>
<div id="createtask"></div>