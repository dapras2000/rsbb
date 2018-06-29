<?php
include 'include/connect.php';
include 'include/function.php';
?>
<html>
<head>
<title> FORM KERINGANAN BIAYA RAWAT JALAN </title>
</head>
<style type="text/css">
#popup-windows {font-size:12px; font-family:Verdana,Geneva,sans-serif;}
#popup-windows table{font-size:12px;}
.text{border:1px solid #000;}
</style>
<body>
<script src="js/jquery-1.7.min.js" language="JavaScript" type="text/javascript"></script>
<script src="js/jquery.validate.js" language="JavaScript" type="text/javascript"></script>
<script src="js/jquery.calculation.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript">
	jQuery.noConflict();
</script>
<script>
function formatCurrency(num) {
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
	cents = "0" + cents;
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3))+'.'+
	num.substring(num.length-(4*i+3));
	return (((sign)?'':'-') + '' + num);
}

jQuery(document).ready(function(){
	jQuery('.col').hide();
	jQuery('#keringanan').val(0);
	jQuery('#keringanan').keyup(function(){
		var val = jQuery(this).val();
		if(val > 0){
			jQuery('.col').show();
			jQuery('#alasan').addClass('required');
		}else{
			jQuery('.col').hide();
			jQuery('#alasan').removeClass('required');
		}
	});
	
	
	jQuery('#simpan').click(function(){	
		var nobill 		= jQuery('#nobill').val();
		var keringanan 	= jQuery('#keringanan').val();
		var alasan 		= jQuery('#alasan').val();
		var total_bayar	= jQuery('#total_bayar').val();
		var tbp		 	= jQuery('#tbp').val();
		var shif		= jQuery('#shift').val();
		var idxdaftar	= jQuery('#idxdaftar').val();
		var carabayar	= jQuery('#cara_bayar').val();
		if(keringanan > 0){
			if(alasan.length < 1){
				alert('Alasan keringanan permbayaran belum diisi');
				return false;
			}
		}
		/*
		if(tbp == ''){
			alert('No TBP belum diisi !');
			return false;
		}
		*/
		if(shif == ''){
			alert('Shift belum dipilih !');
			return false;
		}
		
		r = confirm("Yakin akan menyimpan data keringanan ini ??");
		if(r == true){
			jQuery.post('<?php echo _BASE_; ?>include/process.php?idxb='+nobill+'&idxdaftar='+idxdaftar,{SHIFT:shif,tbp:tbp,total:total_bayar,carabayar:carabayar,alasan:alasan,keringanan:keringanan},function(data){
				
				if(data == 'ok'){
			window.close();
			if (window.opener && !window.opener.closed) {
				window.opener.location.reload();
			}																																																				}
																																															});
			
		}else{
			return false;
		}
	});
	jQuery('#batal').click(function(){
									window.close();
									});
	jQuery('.calc').keyup(function(){
		counttotal();
	});
	function counttotal(){
		jQuery("#total_bayar").calc(
			"total - keringanan_biaya",{
				total : jQuery("#tottarif"),
				keringanan_biaya : jQuery("#keringanan")
			},
			function (s){
				return s.toFixed(0);
			},
			function ($this){
				var sums 		= $this.val();
				//alert(sums);
				jQuery('#text_total_bayar').text(formatCurrency(sums));
			}
		);
	}
});
</script>
<div id="popup-windows">
<form id="form-popup">
<h1>Form Keringanan Biaya Pasien Rawat Jalan</h1>
<?php
$sql = mysql_query('SELECT a.NOBILL, a.IDXDAFTAR, a.TOTTARIFRS, b.NAMA, b.ALAMAT,b.JENISKELAMIN,a.NOMR, 
c.KDCARABAYAR,c.KDPOLY, e.nama AS namapoly
FROM t_bayarrajal a 
JOIN m_pasien b ON b.nomr = a.nomr
JOIN t_pendaftaran c ON c.IDXDAFTAR = a.IDXDAFTAR
JOIN m_poly e ON e.kode = c.KDPOLY
where a.NOBILL = "'.$_REQUEST['nobill'].'"');
$qry = mysql_fetch_array($sql);
//JOIN m_carabayar d ON d.KODE = c.KDCARABAYAR
?>
<table width="100%" >
<tr><td style="width:200px;">NOMR</td><td><?php echo $qry['NOMR'];?></td></tr>
<tr><td>Nama Pasien</td><td><?php echo $qry['NAMA'];?></td></tr>
<tr><td>Alamat</td><td><?php echo $qry['ALAMAT'];?></td></tr>
<tr><td>Jenis Kelamin</td><td><?php echo jeniskelamin($qry['JENISKELAMIN']);?></td></tr>
<tr><td>Poly</td><td><?php echo $qry['namapoly'];?></td></tr>
<tr><td>Cara Bayar</td>
<td>
	<select name="cara_bayar" id="cara_bayar" class="cara_bayar">
		<?php
			$sql_carabayar = mysql_query("SELECT * FROM m_carabayar ");
			while($cb = mysql_fetch_array($sql_carabayar)){
			echo '<option value='.$cb['KODE'].'> '.$cb['NAMA'].'</option>';
			}
		?>
	</select>
</td>
</tr>
</table>
<hr>
<table width="100%" >
<tr><td style="width:200px;">No Billing</td><td><?php echo $qry['NOBILL'];?></td></tr>
<tr><td>Total Tagihan</td><td><?php echo curformat($qry['TOTTARIFRS']);?></td></tr>
<tr><td>Keringanan</td><td><input type="text" class="text calc" name="keringanan" id="keringanan" value="0" size="20">
	<span class="col">&nbsp;&nbsp;Alasan Keringanan &nbsp;&nbsp; <input type="text" class="text" id="alasan" name="alasan" value="" size="70" title="*"></span>
	</td></tr>
<tr><td>Total Yang Harus di Bayar</td><td><span id="text_total_bayar"><?php echo curformat($qry['TOTTARIFRS']);?></span></td></tr>
<!--<tr><td>TBP</td><td><input type="text" name="tbp" id="tbp" class="text" size="5"></td></tr>-->
<tr><td>Shift</td><td><select name="shift" id="shift" class="text">
							<option value=""> -- Pilih Shift --</option>
                            <option value="1"> Shift 1 </option>
                            <option value="2"> Shift 2 </option>
                            <option value="3"> Shift 3 </option>
						</select>
</td></tr>

</table>
<input type="hidden" name="carabayar" value="<?php echo $qry['KDCARABAYAR']; ?>" id="carabayar">
<input type="hidden" name="nobill" value="<?php echo $qry['NOBILL']; ?>" id="nobill">
<input type="hidden" name="idxdaftar" value="<?php echo $qry['IDXDAFTAR']; ?>" id="idxdaftar">
<input type="hidden" name="tottarif" value="<?php echo $qry['TOTTARIFRS']; ?>" id="tottarif">
<input type="hidden" name="total_bayar" value="<?php echo $qry['TOTTARIFRS']; ?>" id="total_bayar">
<input type="button" name="simpan" id="simpan" value="Simpan">&nbsp;&nbsp;<input type="button" name="batal" value="Batal" id="batal">
</form>
</div>
</body>
</html>