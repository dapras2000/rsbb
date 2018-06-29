<?php //sample5_1.html ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Sample 5_1</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="xmlhttp.js"></script>
<script type="text/javascript" src="functions.js"></script>
</head>
<?php 
	//theform.php
?>
<div style="padding: 10px;">
	<div id="themessage">
		<?php
			if (isset ($_GET['message'])){
				echo $_GET['message'];
			}
		?>
	</div>
	<form class="cart_form" action="cart_action.php" method="get">
		Nama Obat<br />		
		<input name="namabarang" id="namabarang" style="width: 300px; height: 16px;" type="text" value="" onkeypress="autocomplete(this.value, event)" /><br />
		kode Obat<br />
        <input name="order_code" id="order_code" style="width: 300px; height: 16px;" type="text" value="" " /><br />		
        Jumlah<br />
        <input name="quantity" id="quantity" style="width: 300px; height: 16px;" type="text" value="" " /><br />		
        Aturan Pakai<br />
        <input name="dosis" id="dosis" style="width: 300px; height: 16px;" type="text" value="" " /><br />		
        Racikan<br />
        <input name="racikan" id="racikan" style="width: 300px; height: 16px;" type="text" value="" " /><br />		
        
<input type="submit" name="submit" value="Add Resep" />	</form>
</div>
    
	<!--<div id="autocompletediv" class="autocomp"></div>-->
	<div id="autocompletediv" class="autocomp"></div>
</body>
</html>	