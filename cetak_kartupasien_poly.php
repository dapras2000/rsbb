<?php
		include("include/connect.php");
		include("include/fungsi.php");
		$nomr = $_GET['NOMR'];
		$info = $_GET['info'];
	   $sql1="SELECT * FROM m_pasien WHERE nomr='$nomr'";
	   $rs= mysql_query($sql1);
       $data = mysql_fetch_array($rs);
       //$a = date_diff($data['TGLLAHIR'], date("Y-m-d"));
       	$start  = date_create($data['TGLLAHIR']);
		$end 	= date_create(); // Current time and date
		$diff  	= date_diff( $start, $end );
       	//echo 'The difference is ';
		//echo  $diff->y . ' years, ';
		//echo  $diff->m . ' months, ';
		//echo  $diff->d . ' days, ';
		//echo  $diff->h . ' hours, ';
		//echo  $diff->i . ' minutes, ';
		//echo  $diff->s . ' seconds';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body onload="javascript:window.print()">
<table border="0" cellpadding="0" cellspacing="0" width="400px">
	<!--<tr><td>
			<table align="center" style="font-size: 14px;">
				<tr><td><img src="img/log21.png"></td><td><span style="font-size: 20px;"> KARTU IDENTITAS BEROBAT</span> <br>
					<span style="font-size: 20px;"> RSUI BANYUBENING</span> <br>Jl. Raya Waduk Cengklik, Ngargorejo, Ngemplak <br> Boyolali, Jawa Tengah 57372<br>
			Telp. (0276) 320088 			
				</td></tr>

			</table>
	</td></tr>
	<tr><td align="center">___________________________________________________</td></tr>
	-->
	<tr><td>
			<table style="font-size: 14px; padding-left: 14px;" width="100%">
				<tr  style="font-size: 14px;"><td width="32%">Nomor RM	
				</td><td>:</td><td><? echo $data['NOMR'];?></td><td></td></tr>
				<tr style="font-size: 14px;"><td>Nama				
				</td  style="font-size: 14px;"><td>:</td><td style="font-size: 14px;"><? echo $data['NAMA']; ?></td</tr>
				<tr  style="font-size: 14px;"><td>Jenis Kelamin		
				</td  style="font-size: 14px;"><td>:</td><td style="font-size: 14px;"><? echo $data['JENISKELAMIN']; ?> / <?php echo $diff->y.' TAHUN '; ?></td</tr>
				<tr  style="font-size: 14px;"><td>Alamat
				</td><td>:</td><td style="font-size: 14px;"><? echo $data['ALAMAT']; ?></td></tr>
				<tr  style="font-size: 14px;"><td>Poly
				</td><td>:</td><td style="font-size: 14px;"><? echo $info; ?></td></tr>
				<tr><td>
				</td><td></td><td><img  alt="<? echo $data['NOMR']; ?>" src="include/barcode.php?codetype=Code39&size=20&text=<? echo $data['NOMR']; ?>&print=true" /></td></td></tr>
				<!--<tr><td colspan="3"><span style="font-size: 20px;"></span>
				Kartu Ini Harus Dibawa Setiap Kali Berobat</td><td>&nbsp;</td></tr>-->
			</table>
	</td></tr>
	
</table>
</body>
</html>