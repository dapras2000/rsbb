<script>
function popUp(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=1000,height=400,left=50,top=50');");
}
jQuery(document).ready(function(){
	jQuery('.loader').hide();
	jQuery('#akomodasi').change(function(){
		var kode = jQuery(this).val();
		var kelas= jQuery('#kelas_ruang').val();
		var dokter = jQuery('#kddokter').val();
		var nomr	= jQuery('#nomr').val();
		jQuery('#loader_akomodasi').show();
		if(kode == '03.01'){
			jQuery.post('<?php echo _BASE_;?>list_tarif_ranap.php',{kode:kode,kelas:kelas,nomr:nomr},function(data){
				jQuery('#list_tindakan').empty().append(data);
				jQuery('#loader_akomodasi').hide();
			});
		}else if(kode == '03.02'){
			jQuery.post('<?php echo _BASE_;?>list_tarif_ranap.php',{kode:kode,kelas:kelas,dokter:dokter},function(data){
				jQuery('#list_tindakan').empty().append(data);
				jQuery('#loader_akomodasi').hide();
			});
		}else if(kode == '03.03'){
			jQuery.post('<?php echo _BASE_;?>list_tarif_ranap.php',{kode:kode,kelas:kelas,dokter:dokter},function(data){
				jQuery('#list_tindakan').empty().append(data);
				jQuery('#loader_akomodasi').hide();
			});
		}else if(kode == '03.05'){
			jQuery.post('<?php echo _BASE_;?>list_tarif_ranap.php',{kode:kode,kelas:kelas,dokter:dokter},function(data){
				jQuery('#list_tindakan').empty().append(data);
				jQuery('#loader_akomodasi').hide();
			});
		}else if(kode == '06.03'){
			jQuery.post('<?php echo _BASE_;?>list_tarif_penunjang.php',{kode:kode,kelas:kelas,dokter:dokter},function(data){
				jQuery('#list_tindakan').empty().append(data);
				jQuery('#loader_akomodasi').hide();
			});
		}else if(kode == '07.01'){
			jQuery.post('<?php echo _BASE_;?>list_tarif_penunjang.php',{kode:kode,kelas:kelas,dokter:dokter},function(data){
				jQuery('#list_tindakan').empty().append(data);
				jQuery('#loader_akomodasi').hide();
			});
		}else if(kode == '05'){
			jQuery.post('<?php echo _BASE_;?>list_tarif_rajalx.php',{kode:kode,kelas:kelas,dokter:dokter},function(data){
				jQuery('#list_tindakan').empty().append(data);
				jQuery('#loader_akomodasi').hide();
			});

		}else{
			jQuery.post('<?php echo _BASE_;?>list_tarif_rajal.php',{kode:kode,kelas:kelas,dokter:dokter},function(data){
				jQuery('#list_tindakan').empty().append(data);
				jQuery('#loader_akomodasi').hide();
			});
		}
		
	});
	jQuery('#kelas').change(function(){
		var akomodasi 	= jQuery(this).val();
		var kode  		= jQuery('#akomodasi').val();
		var kelas	  	= jQuery('#kelas_ruang').val();
		var ruang 		= jQuery('#noruang').val();
		if(kelas != ''){
			jQuery.post('<?php echo _BASE_;?>tindakan_ranap.php',{kode:kode,akomodasi:akomodasi,kelas:kelas,ruang:ruang,loadtindakan_ranap:true},function(data){
				jQuery('#list_tindakan').empty().append(data);
			});
		}else{
			jQuery('#list_tindakan').empty();
		}
		
	});
	jQuery('.poly_lain').click(function(){
		var nomr		= jQuery('#nomr').val();
		var idxdaftar	= jQuery('#idxdaftar').val();
		var carabayar	= jQuery('#carabayar').val();
		var poly		= jQuery('#pilih_poly').val();
		if(poly != ''){
			popUp('daftar_tindakan_poly.php?nomr='+nomr+'&idx='+idxdaftar+'&carabayar='+carabayar+'&poly='+poly);
		}
	});
});
</script>
<style>
#loader_akomodasi{background: url("img/loading.gif") no-repeat scroll 0 0 transparent;
    float: right;
    height: 16px;
    margin-right: 175px;
    margin-top: 3px;
    width: 16px;
	position:absolute;
	margin-left:165px;}
</style>
<div align="center">
    <div id="frame">
    <div id="frame_title">
    	<h3 align="left">Menu Pembayaran</h3>
    	<div id="page" align="left" style="padding:10px;">
        <?php
		mysql_query('delete from tmp_cartbayar where IP = "'.getRealIpAddr().'"');
		$myquery = "select a.nomr, a.nott, a.kirimdari, a.dokterpengirim, a.masukrs, a.noruang, b.NAMA, b.ALAMAT, b.JENISKELAMIN, b.TGLLAHIR, c.NAMA as CARABAYAR, c.KODE as kodebayar, a.id_admission, a.noruang, d.NAMA as POLY, e.NAMADOKTER, f.kelas, f.nama AS nm_ruang, f.idx_ruang, DATE_FORMAT(TGLLAHIR,'%d/%m/%Y') as TGLLAHIR1, a.dokter_penanggungjawab
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
			$kelas2			= $userdata['idx_ruang'];
			$masukrs		= $userdata['masukrs'];
			$jk				= $userdata['JENISKELAMIN'];
			$kodebayar		= $userdata['kodebayar'];
			$penanggung_jawab		= $userdata['dokter_penanggungjawab'];
			$nm_jawab		= getDokterName($penanggung_jawab);
			$nott			= $userdata['nott'];
			?>
            	<div style="width:350px; float:left;">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr><td>No MR</td><td><?php echo $userdata['nomr'];?></td></tr>
                <tr><td width="150px">Nama Lengkap pasien</td><td><?php echo $userdata['NAMA'];?></td></tr>
                <tr><td valign="top">Alamat pasien</td><td><?php echo $userdata['ALAMAT'];?></td></tr>
                <tr><td valign="top">Jenis Kelamin</td><td colspan="2"><? if($userdata['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L"){echo"Laki-Laki";}elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P"){echo"Perempuan";} ?> <?php echo"( ". $userdata['JENISKELAMIN']." )";?></td></tr>
                <tr><td valign="top">Tanggal Lahir</td><td><?php echo $userdata['TGLLAHIR1'];?></td></tr>
                <tr><td valign="top">Umur</td><td><?php $a = datediff($userdata['TGLLAHIR'], date("Y-m-d")); echo "umur ".$a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td></tr>
                <tr><td valign="top">Cara Bayar</td><td><?php echo $userdata['CARABAYAR'];?></td></tr>
                <tr><td valign="top">Dokter Pengirim</td><td><?php echo $userdata['NAMADOKTER'];?></td></tr>
                <tr><td valign="top">Dokter Penanggung Jawab</td><td><?php echo $nm_jawab;?></td></tr>
                <tr><td valign="top">Nama Ruang</td><td><?php echo $userdata['nm_ruang'];?></td></tr>
                <tr><td colspan="2"><select name="akomodasi" id="akomodasi" style="float:left;">
                        
                        <option value=""> Pilih Pembayaran </option>
                        <?php
                        $sql_akomodasi = mysql_query('select * from m_tarif2012 where kode_gruptindakan = "03"');
                        while($d_akomodasi = mysql_fetch_array($sql_akomodasi)){
                            echo '<option value="'.$d_akomodasi['kode_tindakan'].'">'.$d_akomodasi['nama_tindakan'].'</option>';
						}
						// 	echo '<option value="05.02"> Persalinan </option>';
							echo '<option value="05"> Tindakan VK </option>';
							echo '<option value="06.03"> Elektromedis </option>';
							echo '<option value="07.01"> Perbekalan Kesehatan </option>';
                        ?>
                    </select> <div id="loader_akomodasi" class="loader"></div>
                    <input type="hidden" name="kelas_ruang" id="kelas_ruang" value="<?php echo $kelas2; ?>" />
                    <input type="hidden" name="no_ruang" id="no_ruang" value="<?php echo $noruang; ?>" />
                    <input type="hidden" name="nott" id="nott" value="<?php echo $nott; ?>" />
                    <input type="hidden" name="nomr" id="nomr" value="<?php echo $nomr; ?>" />
                    <input type="hidden" id="kddokter" value="<?php echo $penanggung_jawab; ?>" />
                    <input type="hidden" id="noruang" value="<?php echo $noruang; ?>" />
                <input type="hidden" id="nomr" value="<?php echo $nomr; ?>" />
                	<input type="hidden" id="idxdaftar" value="<?php echo $id_admission; ?>" />
                    <input type="hidden" id="carabayar" value="<?php echo $kodebayar; ?>" /><br clear="all" />
                    </td></tr>
                </table>
                <div id="cart_tindakan"></div>                
                </div>
				<!-- INI TAMBAHAN FILTER TINDAKAN -->
				<input style="margin-left:150px;height:27px;padding-left:15px;" placeholder="nama tindakan..." type="text" id="myInput" onkeyup="myFunction()">
                <div id="list_tindakan" style="float:right; width:610px;"></div>
                <br clear="all" />
                
                <br clear="all" />
		</div>
        <br clear="all" />
    </div>
    </div>
</div>


<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("filterTab");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

