<?php
include '../include/connect.php';
?>

<script type='text/javascript' src='<?php echo _BASE_;?>js/facebox.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo _BASE_;?>css/facebox.css" />
<script>
jQuery(document).ready(function(){
	jQuery('.footer').empty().append('<input type="button" name="close" id="close" class="button text" value="Close" />');
	jQuery('#close').click(function(){
		jQuery(this).trigger('close.facebox');
	});
});
</script>


<h1> Form Input Kode Lampiran</h1>
<br />
<hr />
<br />

<table width="700px">
	<tr>
        <th width="80px" align="center">Kode Lampiran</th>
        <th width="300px">Nama Lampiran</th>
		<th width="80px" align="center">Action</th>
	</tr>
	<?php
        $sqlr = "SELECT distinct kode_lampiran
					FROM m_tarif2012
					where kode_lampiran != 'B' and kode_lampiran != 'B0' and kode_lampiran != 'B1'
					and kode_lampiran != '-1' and kode_lampiran != '0'
					 ";
        $rowor = mysql_query($sqlr)or die(mysql_error());
        $urutan = 1;
        $urutan2 = 1;
        $urutan3 = 1;
        $urutan4 = 1;
        while ( $datar = mysql_fetch_array($rowor)) {
    ?>
	<tr>
		<td align="center" width="80px"><?= $datar['kode_lampiran'];?></td>
		<?php 
			if ($datar['kode_lampiran']== "01"){
					$nama = "Pelayanan Rawat Jalan";
				}else if ($datar['kode_lampiran']== "02"){
					$nama = "Pelayanan Gawat Darurat";
				}else if ($datar['kode_lampiran']== "03"){
					$nama = "Pelayanan Rawat Inap";
				}else if ($datar['kode_lampiran']== "04"){
					$nama = "Pelayanan Kamar Operasi";
				}else if ($datar['kode_lampiran']== "05"){
					$nama = "Pelayanan Kamar Bersalin";
				}else if ($datar['kode_lampiran']== "06"){
					$nama = "Pelayanan Penunjang Medis";
				}else if ($datar['kode_lampiran']== "07"){
					$nama = "Pelayanan Farmasi";
				}else if ($datar['kode_lampiran']== "08"){
					$nama = "Pelayanan Ruang Khusus";
				}else if ($datar['kode_lampiran']== "09"){
					$nama = "Pelayanan Pemulasaran Jenazah";
				}else {
					$nama = "-";
			}?>
		<td><?=$nama;?></td>
		<td align="center">
			<!--<script>
                    jQuery(document).ready(function(){
                        jQuery('#kode_lampiran'+<?php echo $urutan3++; ?>).click(function(){ 
                            var kode_lampirann     = jQuery('#kode_lampirann'+<?php echo $urutan4++; ?>).val();
                            alert(kode_lampirann);
                            jQuery.post('<?php echo _BASE_;?>jaspel/test.php?kode_lampirann='+kode_lampirann,jQuery().serialize(),function(data) {   
                           		
                            })
                            	jQuery(this).trigger('close.facebox');
                        });

                   	});
            </script>-->
            <script type="text/javascript">
	var base_url = '<?php echo _BASE_;?>';
	function kirim_data(){
		//alert (kode_lampirann);
		$.ajax({
			'url' : base_url + 'jaspel/test.php',
			'type' : 'POST',
			'data' : $('#kode_lampirann').serialize(),
			'success' : function (data){
				var container = $('.kode');
				container.html(data);
			}
		})
	}
</script>
			<input type="text" value="<?php echo $datar['kode_lampiran'];?>" id="kode_lampirann<?php echo $urutan++;?>" />
			
			<input type="button" class="text" value="P I L I H" onClick="kirim_data()" style="width:50px"/><br>
		</td>
	</tr>
	<?php } ?>
</table>

<!--</form>-->
<br />
<hr />
<br />
<div id="table_list_racikan"></div>