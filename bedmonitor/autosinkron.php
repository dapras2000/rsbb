<?php 
	$detik = 300;
?>
<!DOCTYPE html>
<html>
<head>
	<meta content='<?php echo $detik; ?>' http-equiv='refresh'/>
	<title>Sinkronisasi Data Otomatis</title>

</head>
<body>
<?php
	echo 'Sinkronisasi data otomatis setiap : '.$detik.' detik';
	include_once 'sinkronisasi.php';
?>
</body>
</html>