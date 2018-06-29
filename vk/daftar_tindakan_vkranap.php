<script>
jQuery(document).ready(function(){
	jQuery('.add').click(function(){
		var id		= jQuery(this).attr('id');
		var kode 	= jQuery(this).attr('kode');
		var dokter	= jQuery('#dokter_'+id).val();
		var cc		= jQuery(this).attr('cc');
		var cito	= jQuery('#cito'+cc).is(':checked');
		if(cito){
			var faktor = 'c';
		}else{
			var fakrot = 'e';
		}
		var ruang	= jQuery(this).attr('ruang');
		jQuery.post('<?php echo _BASE_;?>vk/save_tmp_vkranap.php',{id:id,kode:kode,dokter:dokter,ruang:ruang,cito:faktor},function(data){
			jQuery('#list_tindakan').load('<?php echo _BASE_;?>vk/load_tmp_vkranap.php');
		});
	});
	jQuery('#list_tindakan').load('<?php echo _BASE_;?>vk/load_tmp_vkranap.php');
});
</script>
<style>
.add, .batal, .simpan{cursor:pointer; border:1px solid #000; padding:2px 3px; background:#FF6; font-size:10px;}
</style>
<div align="center">
    <div id="frame">
    <div id="frame_title">
    	<h3 align="left">TINDAKAN VK RAWAT INAP</h3>
    	<div id="page" align="left" style="padding:10px;">
        <?php
		mysql_query('delete from tmp_cartbayar where IP = "'.getRealIpAddr().'"');
		$myquery = "select a.nomr, a.kirimdari, a.dokterpengirim, a.masukrs, a.noruang, a.nott,b.NAMA, b.ALAMAT, b.JENISKELAMIN, b.TGLLAHIR, c.NAMA as CARABAYAR, c.KODE as kodebayar, a.id_admission, a.noruang, d.NAMA as POLY, e.NAMADOKTER, f.kelas, f.nama AS nm_ruang, DATE_FORMAT(TGLLAHIR,'%d/%m/%Y') as TGLLAHIR1
			  from t_admission a, m_pasien b, m_carabayar c, m_poly d, m_dokter e, m_ruang f
			  where a.nomr=b.NOMR AND a.statusbayar=c.KODE AND d.KODE=a.kirimdari AND f.no=a.noruang AND a.dokterpengirim=e.KDDOKTER AND a.id_admission='".$_GET["idx"]."'";
			$get = mysql_query ($myquery)or die(mysql_error());
			$userdata = mysql_fetch_assoc($get);
			$id_admission	= $userdata['id_admission'];
			$nomr			= $userdata['nomr'];
			$noruang		= $userdata['noruang'];
			$kdpoly			= $userdata['kirimdari'];
			$kddokter		= $userdata['dokterpengirim'];
			$tglreg			= $userdata['TGLREG'];
			$kelas			= $userdata['kelas'];
			$masukrs		= $userdata['masukrs'];
			$jk				= $userdata['JENISKELAMIN'];
			$kodebayar		= $userdata['kodebayar'];
			$nott			= $userdata['nott'];
			?>
            	<div style="width:350px; float:left;">
                <input type="hidden" name="nomr" id="nomr" value="<?php echo $userdata['nomr']; ?>" />
                <input type="hidden" name="idxdaftar" id="idxdaftar" value="<?php echo $userdata['id_admission']; ?>" />
                <input type="hidden" name="carabayar" id="carabayar" value="<?php echo $userdata['kodebayar']; ?>" />
                <input type="hidden" name="ruang" id="ruang" value="<?php echo $userdata['noruang']; ?>" />
                <input type="hidden" name="nott" id="nott" value="<?php echo $userdata['nott']; ?>" />
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr><td>No MR</td><td><?php echo $userdata['nomr'];?></td></tr>
                <tr><td width="150px">Nama Lengkap pasien</td><td><?php echo $userdata['NAMA'];?></td></tr>
                <tr><td valign="top">Alamat pasien</td><td><?php echo $userdata['ALAMAT'];?></td></tr>
                <tr><td valign="top">Jenis Kelamin</td><td colspan="2"><? if($userdata['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L"){echo"Laki-Laki";}elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P"){echo"Perempuan";} ?> <?php echo"( ". $userdata['JENISKELAMIN']." )";?></td></tr>
                <tr><td valign="top">Tanggal Lahir</td><td><?php echo $userdata['TGLLAHIR1'];?></td></tr>
                <tr><td valign="top">Umur</td><td><?php $a = datediff($userdata['TGLLAHIR'], date("Y-m-d")); echo "umur ".$a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td></tr>
                <tr><td valign="top">Cara Bayar</td><td><?php echo $userdata['CARABAYAR'];?></td></tr>
                <tr><td valign="top">Dokter Pengirim</td><td><?php echo $userdata['NAMADOKTER'];?></td></tr>
                <tr><td valign="top">Nama Ruang</td><td><?php echo $userdata['nm_ruang'];?></td></tr>
                </table>
                <div id="list_tindakan">
                </div>
                </div>
                <div id="list_tindakan" style="float:left; width:520px;">
                	<?php
					mysql_query('delete tmp_cartbayar where IP = "'.getRealIpAddr().'"');
					$sql = mysql_query('select * from m_tarif2012 where kode_unit = "10" and kode_profesi is null and kelas = "'.$kelas.'" and tarif > 0');
					if(mysql_num_rows($sql) > 0){
						$i = 1;
						echo '<table width="100%">';
						echo '<tr><th>Nama Jasa</th><th>Dokter</th><th>Cito</th><th>Tarif</th><th>Aksi</th></tr>';
						while($data = mysql_fetch_array($sql)){
							$sqld = mysql_query('select DISTINCT NAMADOKTER, KDDOKTER from m_dokter group by NAMADOKTER');			
							echo '<tr><td>'.$data['nama_tindakan'].'</td><td><select class="text" name="dokter[]" id="dokter_'.$i.'">';
							while($ddok = mysql_fetch_array($sqld)){
								echo '<option value="'.$ddok['KDDOKTER'].'">'.$ddok['NAMADOKTER'].'</option>';
							}
							echo '</select></td><td><input type="checkbox" class="cito" id="cito'.str_replace('.','_',$data['kode_tindakan']).'" name="tindakan_'.$data['kode_tindakan'].'" value="1"></td><td>'.curformat($data['tarif']).'</td><td><input type="button" value="add" id="'.$i.'" kode="'.$data['kode_tindakan'].'" ruang="'.$noruang.'" class="add" cc="'.str_replace('.','_',$data['kode_tindakan']).'"></td></tr>';
							$i++;
						}
						echo '</table>';
					}
					?>
                </div>
                <br clear="all" />
		</div>
        <br clear="all" />
    </div>
    </div>
</div>