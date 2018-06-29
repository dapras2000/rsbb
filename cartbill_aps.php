<script language="javascript" type="text/javascript" src="js/jquery.PrintArea.js"></script>
<script language="javascript">
function printIt()
{
content=document.getElementById('print_selection');
w=window.open('about:blank');
w.document.writeln("<? session_start(); ?>");
w.document.writeln("<link href='dq_sirs.css' type='text/css' rel='stylesheet' />");
w.document.write( content.innerHTML );
w.document.writeln("<? $var = $_SESSION['cetak']; ?>");
w.document.writeln("<script>");
w.document.writeln("window.print()");
w.document.writeln("</"+"script>");
}
</script>
<script language="javascript" type="text/javascript">
function jumpTo (link)
   {
   var new_url=link;
   if (  (new_url != "")  &&  (new_url != null)  )
      window.location=new_url;
}
function terbilangnya(bilangan) {
  bilangan    = String(bilangan);
  var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
  var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
  var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');

  var panjang_bilangan = bilangan.length;

  /* pengujian panjang bilangan */
  if (panjang_bilangan > 15) {
    kaLimat = "Diluar Batas";
    return kaLimat;
  }

  /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
  for (i = 1; i <= panjang_bilangan; i++) {
    angka[i] = bilangan.substr(-(i),1);
  }

  i = 1;
  j = 0;
  kaLimat = "";


  /* mulai proses iterasi terhadap array angka */
  while (i <= panjang_bilangan) {

    subkaLimat = "";
    kata1 = "";
    kata2 = "";
    kata3 = "";

    /* untuk Ratusan */
    if (angka[i+2] != "0") {
      if (angka[i+2] == "1") {
        kata1 = "Seratus";
      } else {
        kata1 = kata[angka[i+2]] + " Ratus";
      }
    }

    /* untuk Puluhan atau Belasan */
    if (angka[i+1] != "0") {
      if (angka[i+1] == "1") {
        if (angka[i] == "0") {
          kata2 = "Sepuluh";
        } else if (angka[i] == "1") {
          kata2 = "Sebelas";
        } else {
          kata2 = kata[angka[i]] + " Belas";
        }
      } else {
        kata2 = kata[angka[i+1]] + " Puluh";
      }
    }

    /* untuk Satuan */
    if (angka[i] != "0") {
      if (angka[i+1] != "1") {
        kata3 = kata[angka[i]];
      }
    }

    /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
    if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")) {
      subkaLimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
    }

    /* gabungkan variabe sub kaLimat (untuk Satu blok 3 angka) ke variabel kaLimat */
    kaLimat = subkaLimat + kaLimat;
    i = i + 3;
    j = j + 1;

  }

  /* mengganti Satu Ribu jadi Seribu jika diperlukan */
  if ((angka[5] == "0") && (angka[6] == "0")) {
    kaLimat = kaLimat.replace("Satu Ribu","Seribu");
  }

  return kaLimat + "Rupiah";
}
	
function isibayar(kondisi){
	if (kondisi) {
		document.getElementById("jumlah_dibayar").value=document.getElementById("tanda_terimah").value;				
		document.getElementById('terbilang').value=terbilangnya(document.getElementById("tanda_terimah").value);
	}
	else {
		document.getElementById("jumlah_dibayar").value="";
		document.getElementById('terbilang').value="";
	}
}
function isiterbilangnya(s){
	document.getElementById('terbilang').value=terbilangnya(s);
}
</script>

<script>
function popUp(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=1000,height=400,left=50,top=50');");
}
jQuery(document).ready(function(){
	jQuery('.bayar').click(function(){
		var idxdaftar	= jQuery(this).attr('rel');
		var idxbayar	= jQuery(this).attr('svn');
		var shif		= jQuery('#shift_'+idxdaftar).val();
		var tbp			= jQuery('#tbp_'+idxdaftar).val();
		var total		= jQuery('#total_bayar_'+idxdaftar).val();
		/*
		if(tbp == ''){
			alert('No TBP belum diisi');
			return false;
		}
		*/
		if(shif == ''){
			alert('Shift belum dipilih');
			return false;
		}
		jQuery.post('<?php echo _BASE_; ?>include/process.php?idxb='+idxbayar+'&idxdaftar='+idxdaftar,{SHIFT:shif,tbp:tbp,total:total},function(data){
			if(data == 'ok'){
				//var btn	= '<input type="button" name="Print" value="Print" class="text print" id="'+idxdaftar+'" svn="'+idxbayar+'"/>';
				jQuery('#bayar_'+idxdaftar).attr('disabled','disabled');
				jQuery('#print_'+idxdaftar).css({'display':'block','float':'right'});
				jQuery('#shift_'+idxdaftar).hide();
				jQuery('#tbp_'+idxdaftar).hide();
				jQuery('#text_shift_'+idxdaftar).empty().append(shif);
				jQuery('#text_tbp_'+idxdaftar).empty().append(tbp);
			}
			//jQuery('#callback_'+idxdaftar).empty().html(data);
		});
	});
	jQuery('.print').click(function(){
		var idxdaftar	= jQuery(this).attr('rel');
		var idxbayar	= jQuery(this).attr('svn');
		jQuery.get('<?php echo _BASE_; ?>print_pembayaran_aps.php?idxb='+idxbayar+'&nomr=<?php echo $_REQUEST['nomr']; ?>',function(data){
			jQuery('#tmp_print').empty().html(data);
			w=window.open();
			//w.document.write(jQuery('#show_print').html());
			w.document.write(jQuery('#tmp_print').html());
			w.print();
			w.close();
			//jQuery('#show_print').empty();
		});
	});
	jQuery('#retribusi').change(function(){
		if(jQuery(this).val() != ''){
			var nomr		= jQuery('#nomr').val();
			var idxdaftar	= jQuery('#idxdaftar').val();
			var carabayar	= jQuery('#carabayar').val();
			var poly		= jQuery('#poly').val();
			popUp('daftar_tindakan_poly.php?nomr='+nomr+'&idx='+idxdaftar+'&carabayar='+carabayar+'&poly='+poly+'&aps=1');
		}
	});
	jQuery('.tindakan').click(function(){
		var nomr		= jQuery('#nomr').val();
		var idxdaftar	= jQuery('#idxdaftar').val();
		var carabayar	= jQuery('#carabayar').val();
		var poly		= jQuery(this).attr('id');
		popUp('daftar_tindakan_poly_aps.php?nomr='+nomr+'&idx='+idxdaftar+'&carabayar='+carabayar+'&poly='+poly+'&aps=1');
	});
	jQuery('.poly_lain').click(function(){
		var nomr		= jQuery('#nomr').val();
		var idxdaftar	= jQuery('#idxdaftar').val();
		var carabayar	= jQuery('#carabayar').val();
		var poly		= jQuery('#pilih_poly').val();
		if(poly != ''){
			popUp('daftar_tindakan_poly.php?nomr='+nomr+'&idx='+idxdaftar+'&carabayar='+carabayar+'&poly='+poly+'&aps=1');
		}
	});
	jQuery('.cancel').click(function(){
		var nobill = jQuery(this).attr('svn');
		jQuery.post('<?php echo _BASE_;?>cartbill_pembayaran_batal.php',{nobill:nobill},function(data){
			location.reload();
		});
	});
	
	jQuery('.link_detail').click(function(){
		var bill = jQuery(this).attr('id');
		var active = jQuery('#d'+bill).attr('show');
		if(active == 'show'){
			jQuery('#d'+bill).empty().attr('show','hide');
		}else{
			jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{nobill:bill,view_detail_bill:true},function(data){
				jQuery('#d'+bill).empty().html(data).attr('show','show');
			});
		}
	});
});
</script>

<div align="center">
<div id="frame">
	<div id="frame_title"><h3>Cart Bayar Rawat Jalan</h3></div>
    <fieldset class="fieldset">
      <legend>Identitas</legend>
<?php
		#$myquery = "select a.NOMR,a.KDPOLY,a.KDDOKTER,a.TGLREG,b.NAMA,b.ALAMAT,b.JENISKELAMIN, b.TGLLAHIR,c.NAMA as CARABAYAR, a.IDXDAFTAR, d.NAMA as POLY, e.NAMADOKTER, g.NOBILL, g.IDXBILL from t_pendaftaran a, m_pasien b, m_carabayar c, m_poly d, m_dokter e, t_billrajal g where a.NOMR=b.NOMR AND a.KDCARABAYAR=c.KODE AND d.KODE=a.KDPOLY and a.KDDOKTER=e.KDDOKTER and a.IDXDAFTAR=g.IDXDAFTAR AND a.NOMR = '".$_REQUEST['nomr']."'";
		$q_pasien	= "select a.NOMR, b.NAMA, b.ALAMAT, b.JENISKELAMIN, b.TGLLAHIR, c.NAMA as CARABAYAR, a.KDCARABAYAR, a.IDXDAFTAR, a.KDPOLY from t_pendaftaran_aps a, m_pasien_aps b, m_carabayar c where a.NOMR = b.NOMR and a.KDCARABAYAR = c.KODE and a.NOMR = '".$_REQUEST['nomr']."' and a.IDXDAFTAR = '".$_REQUEST['idxdaftar']."'";
  		$get = mysql_query ($q_pasien)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get); 		
?>

<table width="60%" border="0" cellpadding="0" cellspacing="0" style="float:left;">
        <tr><td>No MR</td><td><?php echo $userdata['NOMR'];?> </td></tr>
        <tr><td width="21%">Nama Lengkap Pasien</td><td width="79%"><?php echo $userdata['NAMA'];?></td></tr>
        <tr><td valign="top">Alamat Pasien</td><td><?php echo $userdata['ALAMAT'];?></td></tr>
        <tr><td valign="top">Jenis Kelamin</td><td colspan="2"><? if($userdata['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L"){echo"Laki-Laki";}elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P"){echo"Perempuan";} ?> <?php echo"( ". $userdata['JENISKELAMIN']." )";?></td></tr>
        <tr><td valign="top">Tanggal Lahir</td><td><?php echo $userdata['TGLLAHIR'];?>          </td></tr>
        <tr><td valign="top">Umur</td><td><?php $a = datediff($userdata['TGLLAHIR'], date("Y-m-d")); echo $a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td></tr>
        <tr><td valign="top">Cara Bayar</td><td><?php echo $userdata['CARABAYAR'];?></td></tr>
</table>
<table width="35%" style="float:right;">
<tr><th colspan="2">Jasa Tindakan</th></tr>
<tr><td>
		<?php if($_SESSION['ROLES'] != '2'):?>
			<!--<input type="button" name="tindakan_poly" class="tindakan text" id="<?php echo $_REQUEST['poly'];?>" value="Jasa Tindakan Poly" />-->
            Pilih Tindakan Poliklinik Lain 
            	<select id="pilih_poly" class="text">
                <option value=""> -- Pilih Poliklinik Lain -- </option>
                    <?php
                    $s	= mysql_query('select * from m_poly');
                    while($d	= mysql_fetch_array($s)){
                        echo '<option value="'.$d['kode'].'">'.$d['nama'].'</option>';
                    }
                    ?>
                    <option value="18">Gizi</option>
                    <option value="0">Lain lain</option>
				</select>&nbsp;&nbsp;
                <input type="button" name="tindakan_poly" class="poly_lain text" value="Tampilkan" />
        <?php endif; ?>
        
        </td>
		<td>
    	<!--<input type="button" name="tindakan_poly" class="tindakan text" id="0" value="Jasa Tindakan Lain Lain" />-->
    	<input type="hidden" name="nomr" id="nomr" value="<?php echo $userdata['NOMR']; ?>" />
        <input type="hidden" name="idxdaftar" id="idxdaftar" value="<?php echo $userdata['IDXDAFTAR']; ?>" />
        <input type="hidden" name="carabayar" id="carabayar" value="<?php echo $userdata['KDCARABAYAR']; ?>" /></td></td></tr>
</table>
<br clear="all" />
    </fieldset>
    
</div>



<style type="text/css" media="screen">
#tmp_print{display:none;}
.detail_billing ul{list-style:none; padding-left:10px;}
.detail_billing li{padding:3px;}
.link_detail{ color:#000; font-weight:bold; cursor:pointer;}
</style>
<style type="text/css" media="print">
#tmp_print{display:block;}

</style>

<div id="tmp_print"></div>

<div id="frame">
<div id="frame_title"><h3>List Pembayaran</h3></div>
<form name="byr1" action="include/process.php" method="post" id="byr1">
<fieldset>
<legend>Cart List Bayar</legend>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb">
  <tr>
  	<!--<th style="width:150px;">Jenis Retribusi</th>-->
    <th>Nama Jasa</th>
    <th style="width:100px;">Tarif</th>
    <!--<th style="width:50px;">TBP</th>-->
    <th style="width:50px;">Shift</th>
    <th style="width:150px; text-align:center;">Aksi</th>
    </tr>
    <tbody class="list_billrajal">
	<?php
$sql = 'SELECT a.NOMR, b.NOBILL, c.nama_tindakan AS nama_jasa, SUM(b.tarifrs) AS harga, b.QTY,a.TBP,a.SHIFT, SUM(c.tarif * b.QTY) AS subtotal, a.TGLBAYAR , b.IDXDAFTAR, c.kode_tindakan
FROM t_bayarrajal a
JOIN t_billrajal b ON a.NOBILL = b.NOBILL 
JOIN m_tarif2012 c ON c.kode_tindakan = b.KODETARIF
WHERE a.NOMR = "'.$_REQUEST['nomr'].'" AND a.STATUS !="BATAL" AND b.IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'" GROUP BY a.NOBILL';

$qry = mysql_query($sql)or die(mysql_error());
if(mysql_num_rows($qry) > 0):
while($data = mysql_fetch_array($qry)){
	$j 		= substr($data['kode_tindakan'],0,5);
	$js		= getGroupName($j);
	$jasa = $js['nama_tindakan'];
	if(($data['TGLBAYAR'] == '') or ($data['TGLBAYAR'] == '0000-00-00')){
	  	?>
  	<tr>
    	<td><span class="link_detail" id="<?php echo $data['NOBILL']?>"><?php echo $jasa;?> </span><div class="detail_billing" id="d<?php echo $data['NOBILL']; ?>"></div></td>
        <td align="right" valign="top"><? echo "Rp. ".curformat($data['harga']); ?></td>
        <!--
        <td valign="top">
        	<?php if($_SESSION['ROLES'] == 2): ?>
        	<input type="text" name="tbp" class="text" size="6" id="tbp_<?php echo $data['NOBILL']; ?>" /><span id="text_tbp_<?php echo $data['NOBILL'];?>"></span>
            <?php endif;?>
            </td>-->
        <td valign="top">
        	<?php if($_SESSION['ROLES'] == 2): ?>
        	<select name="shift" id="shift_<?php echo $data['NOBILL']; ?>">
                <option value=""> Pilih Shift </option><option value="1"> 1 </option><option value="2"> 2 </option><option value="3"> 3 </option>
            </select>
            <input type="hidden" name="total" id="total_bayar_<?php echo $data['NOBILL']; ?>" value="<?php echo $data['subtotal']; ?>" />
            <span id="text_shift_<?php echo $data['NOBILL'];?>"></span>
            <?php endif;?>
        </td>
        <td valign="top">
        <?php if($_SESSION['ROLES'] == 2): ?>
        <input type="button" name="Submit" value="Bayar" class="text bayar" id="bayar_<?php echo $data['NOBILL']; ?>" rel="<?php echo $data['NOBILL']; ?>" svn="<?php echo $data['NOBILL']; ?>" />
        
        
    	<input type="button" name="Cancel" value="Batal" class="text cancel" id="cancel_<?php echo $data['NOBILL']; ?>" rel="<?php echo $data['NOBILL']; ?>" svn="<?php echo $data['NOBILL']; ?>" />
        <?php endif; ?>
    	<input type="button" name="print" value="Print" class="text print" id="print_<?php echo $data['NOBILL']; ?>" rel="<?php echo $data['NOBILL']; ?>" svn="<?php echo $data['NOBILL']; ?>" style="display:none;"/><div id="callback_<?php echo $data['NOBILL']; ?>" style="float:right;"></div></td>
    </tr>
    <?php 
	}else{
	?>
    <tr>
        <td><span class="link_detail" id="<?php echo $data['NOBILL']?>"><?php echo $jasa;?></span><div class="detail_billing" show="hide" id="d<?php echo $data['NOBILL']; ?>"></div></td>
        <td align="right" valign="top"><? echo "Rp. ".curformat($data['subtotal']); ?></td>
        <!--<td valign="top"><?php echo $data['TBP']; ?></td>-->
        <td valign="top"><?php echo $data['SHIFT'];?></td>
        <td valign="top">
        	<?php if( ($_SESSION['ROLES'] == 26) and ($data['STATUS'] == 'TRX') ): ?>
            <input type="button" name="Cancel" value="Batal" class="text cancel" id="cancel_<?php echo $data['NOBILL']; ?>" rel="<?php echo $data['NOBILL']; ?>" svn="<?php echo $data['NOBILL']; ?>" />
            <?php endif; ?>
            <input type="button" name="print" value="Print" class="text print" id="print_<?php echo $data['NOBILL']; ?>" rel="<?php echo $data['NOBILL']; ?>" svn="<?php echo $data['NOBILL']; ?>" style="display:block; float:right;"/><div id="callback_<?php echo $data['NOBILL']; ?>" style="float:right;"></div></td>
    </tr>
	<?php
	}
}
endif;
?>
	
  </table>
</fieldset>
</form>
</div>
</div>