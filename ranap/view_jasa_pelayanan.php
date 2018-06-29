<? include("../include/connect.php");
$sql = "SELECT * FROM `m_jaspel` WHERE kode like '".$_POST['jaspel']."%'";
$qry = mysql_query($sql)or die(mysql_error());
?>
<select class="text" name="subname" id="subname"/>
    	<option selected="selected">-Sub Nama Jasa-</option>
		<?php 
			while($ja=mysql_fetch_array($qry)){				
				if($ja['kode'] != $_POST['jaspel']){
				?>
				<option value="<? echo $ja['kode']; ?>"> <?php echo $ja['nama']; ?> </option>
			<? } 
				$kode 			= $ja['kode'];
				$kodegroup 		= $ja['kodegroup'];
				$nama 			= $ja['nama'];
				$tarif		 	= $ja['tarif'];
				$jasa_sarana 	= $ja['jasa_sarana'];
				$jasa_layanan 	= $ja['jasa_layanan'];
				$jasa_dokter 	= $ja['jasa_dokter'];
				$jasa_rs 		= $ja['jasa_rs'];
			} ?>
</select>

<input type="hidden" name="kode" value="<?php echo $kode; ?>" />
<input type="hidden" name="kodegroup" value="<?php echo $kodegroup; ?>" />
<input type="hidden" name="nama" value="<?php echo $nama; ?>" />
<input type="hidden" name="tarif" value="<?php echo $tarif; ?>" />
<input type="hidden" name="jasa_sarana" value="<?php echo $jasa_sarana; ?>" />
<input type="hidden" name="jasa_layanan" value="<?php echo $jasa_layanan; ?>" />
<input type="hidden" name="jasa_dokter" value="<?php echo $jasa_dokter; ?>" />
<input type="hidden" name="jasa_rs" value="<?php echo $jasa_rs; ?>" />