      <div id="paketlab">
        <form id="form_orderlab" method="post" action="<?php echo _BASE_;?>ranap/lab/register_lab.php">
            <?php
            $sql_admission	= 'select * from t_admission where id_admission = "'.$_REQUEST['id_admission'].'"';
			$sql_admission	= mysql_query($sql_admission);
            $ddaftar	= mysql_fetch_array($sql_admission);
			$rajal		= getGroupUnit($_SESSION['KDUNIT']);
            ?>
            <input type="hidden" name="nomr" value="<?php echo $ddaftar['nomr']; ?>" />
            <input type="hidden" name="idxdaftar" value="<?php echo $ddaftar['id_admission']; ?>" />
            <input type="hidden" name="kddokter" value="<?php echo $ddaftar['dokterpengirim']; ?>" />
            <input type="hidden" name="carabayar" value="<?php echo $ddaftar['statusbayar']; ?>" />
            <input type="hidden" name="rajal" value="<?php echo $rajal; ?>" />
            <?php
            $sql_tmp = mysql_query('select * from tmp_cartorderlab where NOMR = "'.$ddaftar['nomr'].'" and IDXDAFTAR = "'.$ddaftar['id_admission'].'" and TGLDAFTAR = "'.date('Y-m-d').'"');
            $d	= mysql_num_rows($sql_tmp);
            if($d > 0){
                $dis = 'disabled="disabled"';
                $r	 = '<h1>Pasien Sudah di Daftarkan di Laboratorium</h1>';
            }else{
                $dis = '';
                $r	 = '';
            }
            ?>
            <input type="submit" class="text" name="daftarlab" value="DAFTAR LABORATORIUM" id="orderlab_ranap" <?php echo $dis; ?>  />
            <br />
            <?php echo $r; ?>
        </form>
      </div>