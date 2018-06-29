<?php
		include("include/connect.php");
		include("include/fungsi.php");
		$nomr = $_GET['NOMR'];
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
<table border="1" cellpadding="0" cellspacing="0" width="800px">
	<tr><td>
			<table align="center" style="font-size: 20px;">
				<tr><td><img src="img/log21.png"></td><td align="center">Rumah Sakit Umum Islam <br><span style="font-size: 50px;"> BANYUBENING</span> <br>Jl. Raya Waduk Cengklik, Ngargorejo, Ngemplak <br> Boyolali, Jawa Tengah 57372<br>
			Telp. (0276) 320088 
				</td></tr>
			</table>
	</td></tr>
	<tr><td>
			<table align="center">
				<tr><td><span style="font-size: 30px;text-decoration: underline;">KARTU IDENTITAS BEROBAT</span>				
				</td></tr>			
			</table>
			<table style="font-size: 25px; padding-left: 10px;">
				<tr><td><span style="font-size: 20px;">NOMOR RM</span>				
				</td><td>:</td><td><? echo $data['NOMR'];?></td></tr>
				<tr><td><span style="font-size: 20px;">NAMA</span>				
				</td><td>:</td><td><? echo $data['NAMA']; ?></td></tr>
				<tr><td><span style="font-size: 20px;">UMUR</span>				
				</td><td>:</td><td><?php echo 'UMUR '.$diff->y.' TAHUN '; ?></td></tr>
				<tr><td><span style="font-size: 20px;">ALAMAT</span>				
				</td><td>:</td><td><? echo $data['ALAMAT']; ?></td></tr>
				<tr><td><span style="font-size: 20px;">NAMA ORANG TUA</span>				
				</td><td>:</td><td><? echo $data['SUAMI_ORTU']; ?></td></tr>
			</table>
	</td></tr>

</table>
               