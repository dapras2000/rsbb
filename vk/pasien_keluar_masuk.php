      <p>
      <div align="left" id="pasien_keluarmasuk">
        <form name="pasien_masuk" id="pasien_masuk" action="vk/valid_keluar-masuk.php" method="post">
          <div class="tb">Data Pasien Masuk :
            <input type="text" class="text" name="Masuk" value="" id="Masuk" />
            <input type="hidden" name="NOMR" value="<? echo $nomr; ?>" />
            <input type="hidden" name="IDXDAFTAR2" value="<?php echo $userdata['IDXDAFTAR']; ?>"/>
            &nbsp;Dokter&nbsp;
            <select name="dokter" class="text">
			<?
            $sql_dokter = "SELECT 
					  m_dokter.KDDOKTER,
					  m_dokter.KDPOLY,
					  m_dokter.NAMADOKTER
					FROM
					  m_dokter";
					
			$get_dokter = mysql_query($sql_dokter);	
			while($dat_dokter = mysql_fetch_array($get_dokter)){
			?>
            <option value="<?=$dat_dokter['KDDOKTER']?>" 
			<? 
			if($dat_dokter['KDDOKTER']==$kddokter) echo "selected=selected";
			?> ><?=$dat_dokter['NAMADOKTER']?></option>            
            <? } ?>
            </select>
            <? 
			$SQL = "SELECT MASUKPOLY FROM t_pendaftaran WHERE IDXDAFTAR='".$_GET['idx']."'";
			$QUERY = mysql_query($SQL);
			$JAM = mysql_fetch_assoc($QUERY);
			if($JAM['MASUKPOLY']=="00:00:00"){
			?>
            <input type="submit" class="text" name="save2" onclick="submitform (document.getElementById('pasien_masuk'),'vk/valid_keluar-masuk.php','valid_masuk',validatetask); return false;" value=" Masuk " />
            <? }else{ 
            echo "<strong> Jam Masuk ".$JAM['MASUKPOLY']."</strong>";
			} ?>
            <span id="valid_masuk"></span> </div>
        </form>
        <form name="pasien_keluar" id="pasien_keluar" action="pasien_keluar.php" method="post">
          <div class="tb">Data Pasien Keluar :
            <input type="text" name="Keluar" class="text" value="" id="Keluar" />
            <input type="hidden" name="NOMR" value="<? echo $nomr; ?>" />
            <input type="hidden" name="IDXDAFTAR2" value="<?php echo $userdata['IDXDAFTAR']; ?>"/>
            Status Keluar :
            <select name="Status" class="text" onchange="javascript: MyAjaxRequest('rujuk','rujukan/alasan_rujuk.php?rujuk=' + this.value); return false;">
              <option selected="selected">- Pilih Status -</option>
              <? 
		  	$qey = mysql_query("SELECT * FROM m_statuskeluar");
			while ($show = mysql_fetch_array($qey)){
				echo"<option value='".$show['status']."'>".$show['keterangan']."</option>";
				}
		  ?>
            </select>
            <input type="submit" name="keluar" class="text" value=" keluar " onclick="submitform (document.getElementById('pasien_keluar'),'vk/valid_keluar-masuk.php','valid_keluar',validatetask); return false;"/>
<div id="rujuk">
  
</div>
            <span id="valid_keluar"></span> </div>
        </form>
      </div>
      </p>
