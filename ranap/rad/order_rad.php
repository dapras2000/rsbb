  <div id="paketlab">
  	<form id="form_orderlab" method="post" action="<?php echo _BASE_;?>ranap/rad/register_rad.php">
    	<?php
		$sql_admission	= 'select * from t_admission where id_admission = "'.$_REQUEST['id_admission'].'"';
		$sql_admission	= mysql_query($sql_admission);
		$ddaftar	= mysql_fetch_array($sql_admission);
		$rajal		= getGroupUnit($_SESSION['KDUNIT']);
		?>
        <br />
    	<input type="hidden" name="nomr" value="<?php echo $ddaftar['nomr']; ?>" />
        <input type="hidden" name="idxdaftar" value="<?php echo $ddaftar['id_admission']; ?>" />
        <input type="hidden" name="kddokter" value="<?php echo $ddaftar['dokterpengirim']; ?>" />
        <input type="hidden" name="carabayar" value="<?php echo $ddaftar['statusbayar']; ?>" />
        <input type="hidden" name="rajal" value="<?php echo $rajal; ?>" />
        
		Diagnosa Klinik : <input type="text" name="diagnosa" id="diagnosa" size="100" style="height:30px;" />
        <?php
		$sql_tmp = mysql_query('select * from tmp_cartorderrad where NOMR = "'.$ddaftar['nomr'].'" and IDXDAFTAR = "'.$ddaftar['id_admission'].'" and TGLDAFTAR = "'.date('Y-m-d').'"');
		$d	= mysql_num_rows($sql_tmp);
		if($d > 0){
			$dis = 'disabled="disabled"';
			$r	 = '<h1>Pasien Sudah di Daftarkan di Radiologi</h1>';
		}else{
			$dis = '';
			$r	 = '';
		}
		?><br />
  		<input type="submit" name="daftarlab" value="DAFTAR RADIOLOGI" id="orderlab" <?php echo $dis; ?>  />
        <br />
        <?php echo $r; ?>
    </form>
  </div>
