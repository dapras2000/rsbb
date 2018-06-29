<script src="js/jquery.validate.js" language="JavaScript" type="text/javascript"></script>
<script src="js/jquery.calculation.js" language="JavaScript" type="text/javascript"></script>
<script language="javascript">
function printIt()
{
content=document.getElementById('print_selection');
w=window.open('about:blank');
w.document.write( content.innerHTML );
w.document.writeln("<script>");
w.document.writeln("window.print()");
w.document.writeln("</"+"script>");
}
</script>
<script language="javascript" type="text/javascript">
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

jQuery(document).ready(function(){
	jQuery('#formbayar').validate({
		submitHandler: function(form){
			var no_medrek = jQuery('#no_medrek').val();
			jQuery.post('<?php echo _BASE_.'include/process.php'?>', jQuery("#formbayar").serialize(), function(data){
				jQuery('#simpan').hide();
				jQuery('#print').append(data);
				//jQuery('#check_medrek').val(data);
				//jQuery.unblockUI();
			})
		}
	});
	jQuery('#edit_carabayar').click(function(){
		var idxbill	= jQuery(this).attr('id');
		var oldval	= jQuery(this).attr('oldval');
		jQuery('.id_carabayar').css({'display':'none'});
		jQuery('.selectbox_carabayar').css({'display':'inline'});
		jQuery('#save_carabayar').css({'display':'inline'});
		jQuery(this).css({'display':'none'});
	});
	jQuery('#save_carabayar').click(function(){
		jQuery.post('<?php echo _BASE_;?>update_carabayar_billranap.php',jQuery('#form_update_carabayar').serialize(),function(data){
		if(!data){
			location.reload();
		}
});
	});
	jQuery('#keringanan_biaya').keyup(function(){
		var val = jQuery(this).val();
		if(val > 0){
			jQuery('#approval').css({'display':'inline'});
			jQuery('#approval_req').addClass('required');
		}else{
			jQuery('#approval').css({'display':'none'});
			jQuery('#approval_req').removeClass('required');
		}
	});
	jQuery('.calc').keyup(function(){
		counttotal();
	});
	function counttotal(){
		jQuery("#hide_grandtotal").calc(
			"total - asuransi - keringanan_biaya - deposit ",{
				total : jQuery("#hide_total"),
				keringanan_biaya : jQuery("#keringanan_biaya"),
				deposit : jQuery('#hide_deposit'),
				asuransi : jQuery('#hide_asuransi')
			},
			function (s){
				return s.toFixed(0);
			},
			function ($this){
				var sums 		= $this.val();
				//alert(sums);
				jQuery('#total_bayar').val(formatCurrency(sums));
			}
		);
	}
});
</script>
<style>
.buton_edit{cursor:pointer; color:#03C;}
input.error{ border:1px solid #F00;}
label.error{ color:#F00; font-weight:bold;}
</style>
<div align="center">
<div id="frame">
	<div id="frame_title">
	  <h3>Cart Bayar Rawat Inap</h3></div>
    <fieldset class="fieldset">
      <legend>Identitas </legend>
<?php
/*
SELECT a.nomr, c.NAMA, c.ALAMAT, c.JENISKELAMIN, c.TGLLAHIR, b.statusbayar, d.NAMA AS carabayar, 
b.noruang, e.nama as ruang, b.nott, a.TOTTARIFRS, b.deposit, c.PARENT_NOMR, a.DISCOUNT,a.NOBILL,a.STATUS,a.TOTCOSTSHARING, a.deposit as deposit_dibayarkan
FROM t_bayarranap a 
JOIN t_admission b ON a.IDXDAFTAR = b.id_admission
JOIN m_pasien c ON c.NOMR = a.NOMR
JOIN m_carabayar d ON d.KODE = b.statusbayar
JOIN m_ruang e ON e.no = b.noruang
join t_billranap f on a.nobill = f.nobill
*/
	$myquery	= '

SELECT a.nomr, b.NAMA, b.ALAMAT, b.JENISKELAMIN, b.TGLLAHIR, c.statusbayar, e.NAMA AS carabayar, c.noruang, d.nama AS ruang, c.nott,
SUM(a.TARIFRS * a.QTY) AS TOTTARIFRS, c.deposit, b.PARENT_NOMR, f.DISCOUNT, a.NOBILL, f.STATUS, SUM(a.COSTSHARING) AS TOTCOSTSHARING,
f.deposit AS deposit_dibayarkan
FROM t_billranap a
JOIN m_pasien b ON a.nomr = b.nomr 
JOIN t_admission c ON a.IDXDAFTAR = c.id_admission
JOIN m_ruang d ON c.noruang = d.no
JOIN m_carabayar e ON c.statusbayar = e.KODE
JOIN t_bayarranap f ON a.nobill = f.nobill
WHERE a.KODETARIF NOT LIKE "07%"
and a.IDXDAFTAR = '.$_REQUEST['idxb'].' and a.NOBILL = "'.$_REQUEST['nobill'].'" 
group by a.nobill, a.idxdaftar';
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get);
		
		$sql_asuransi = 'SELECT IDXDAFTAR,
						SUM( IF (carabayar = 1,QTY * TARIFRS,0))  AS total_tagihan,
						SUM( IF (carabayar > 1,QTY * TARIFRS,0))  AS total_asuransi
						FROM t_billranap WHERE IDXDAFTAR = "'.$_REQUEST['idxb'].'"
						GROUP BY IDXDAFTAR,NOBILL';
		$sql_asuransi 	= mysql_query($sql_asuransi);
		$d_asuransi		= mysql_fetch_assoc($sql_asuransi);
		
	

?>
<form name="bayar" action="include/process.php" id="formbayar" method="post">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td>No MR</td><td><?php echo $userdata['nomr'];?>
          	<span style="float:right"><a href="index.php?link=34tb&idxb=<?=$_GET['idxb']?>&t=<?=$_GET['t']?>"><input type="button" value="Tambah Deposit" class="text"/></a></span>
</td></tr>
<tr><td width="21%">Nama Lengkap Pasien</td><td width="79%"><?php echo $userdata['NAMA'];?></td></tr>
<tr><td valign="top">Alamat Pasien</td><td><?php echo $userdata['ALAMAT'];?></td></tr>
<tr><td valign="top">Jenis Kelamin</td><td colspan="2"><? if($userdata['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L"){echo"Laki-Laki";}elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P"){echo"Perempuan";} ?> <?php echo"( ". $userdata['JENISKELAMIN']." )";?></td></tr>
<tr><td valign="top">Tanggal Lahir</td><td><?php echo $userdata['TGLLAHIR'];?></td></tr>
<tr><td valign="top">Umur</td><td><?php $a = datediff($userdata['TGLLAHIR'], date("Y-m-d")); echo "umur ".$a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td></tr>
        <tr><td valign="top">Cara Bayar</td><td><?php echo $userdata['carabayar'];?></td></tr>
        <tr><td valign="top">Ruang</td><td><?php echo $userdata['ruang'];?></td></tr>
        <tr><td valign="top">No. Tempat Tidur</td><td><?php echo $userdata['nott'];?></td></tr>
        <!--<tr><td valign="top">TBP</td><td><input type="text" class="text" name="tbp" value="0"/></td></tr>-->
        <tr><td valign="top">Shift</td><td>
            <input type="radio" id="1" name="SHIFT" value="1" checked="checked"/> 1
		    <input type="radio" id="2" name="SHIFT" value="2"/> 2
			<input type="radio" id="3" name="SHIFT" value="3"/> 3
	      </td>
        </tr>
        <tr><td valign="top">Total Biaya  </td><td>Rp. &nbsp;<input type="text" id="total" readonly="readonly" style="text-align:right" name="total" class="text calc" size="10" value="<? echo curformat($userdata['TOTTARIFRS']); ?>"/></td>
        <tr><td valign="top">Di Bayar Asuransi  </td><td>Rp. &nbsp;<input type="text" id="asuransi" readonly="readonly" style="text-align:right" name="asuransi" class="text calc" size="10" value="<? echo curformat($d_asuransi['total_asuransi']); ?>"/></td>
        </tr>
        <tr><td valign="top">Keringanan Biaya  </td><td>Rp. &nbsp;<input type="text"  style="text-align:right" value="<?php echo $userdata['TOTCOSTSHARING'];?>" id="keringanan_biaya" name="keringanan_biaya" class="text calc" size="10"/><span id="approval" style="display:none;">&nbsp;&nbsp;Approval&nbsp;&nbsp;<input type="text" class="text" size="100" name="approval" id="approval_req" title="*" value="" /></span></td>
        </tr>	
         <?php 
		 if($userdata['STATUS'] != 'LUNAS'): 
		 	$deposit = $userdata['deposit'];
		 else:
		 	$deposit = $userdata['deposit_dibayarkan'];
		 endif; ?>
        <tr><td>Deposit</td><td>Rp. &nbsp;<input type="text"  style="text-align:right" readonly="readonly" name="deposit" id="deposit" class="text calc" size="10" value="<?php echo curformat($deposit);?>"/></td></tr>
       

		
        <tr><td>Jumlah yang harus dibayar</td><td>
          <div id="print">
          Rp. &nbsp;<input  type="text"  style="text-align:right" readonly="readonly" name="total_bayar1" id="total_bayar1" class="text calc" size="10" value="<?php echo curformat($userdata['TOTTARIFRS']-$d_asuransi['total_asuransi']-$userdata['TOTCOSTSHARING']-$deposit);?>" />
			<input type="hidden" name="total_bayar" id="total_bayar" value="<?php echo $userdata['TOTTARIFRS']-$d_asuransi['total_asuransi']-$userdata['TOTCOSTSHARING']-$deposit;?>" />
          	<input type="hidden" name="hide_total" id="hide_total" value="<?php echo $userdata['TOTTARIFRS'];?>" />
            <input type="hidden" name="hide_deposit" id="hide_deposit" value="<?php echo $userdata['deposit'];?>" />
            <input type="hidden" name="hide_grandtotal" id="hide_grandtotal" value="" />
            <input type="hidden" name="hide_asuransi" id="hide_asuransi" value="<?php echo $d_asuransi['total_asuransi'];?>" />
            
            <input type="hidden" name="idxranap" value="<?php echo $_REQUEST['idxb'];?>" />
            <input type="hidden" name="nobill" value="<?php echo $userdata['NOBILL'];?>" />
          	<input type="hidden" name="nomr" value="<?php echo $userdata['nomr'];?>" id="nomr" />
            <input type="hidden" name="id_admission" value="<?php echo $_REQUEST['idxb'];?>" id="id_admission" />
            <?php if($userdata['STATUS'] != 'LUNAS'): ?>
            <input type="submit" name="Submit" value="Simpan" id="simpan" class="text" />
            <?php endif; ?>
            </div>
            </td>
        </tr>
        
      </table>   
    </form>
    </fieldset>
</div>
<div id="print_selection" style="display:none;">
<div style="border:1px solid #999; padding:5px; margin:5px; width:760px; font:0.7em Arial; font-size:12px;">

<div align="left" style="clear:both;">
<div style="letter-spacing:-1px; font-size:16px; font:bold;"><?=strtoupper($header1)?></div>
<div style="letter-spacing:-2px; font-size:24px; color:#666; font:bold;"><?=strtoupper($header2)?></div>
<div><?=$header3?><br /><?=$header4?></div>
</div>
<br>
<div align="left"><strong>Pembayaran Rawat Inap</strong></div>
<hr style='border:1px solid #5AC54B;'>

<table width="100%" border="0" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
  <tr>
    <td width="28%">No MR</td>
    <td width="1%">:</td>
    <td width="71%"><?php echo $userdata['nomr'];?></td>
  </tr>
  <tr>
    <td>Nama Pasien</td>
    <td>:</td>
    <td><?php echo $userdata['NAMA'];?></td>
  </tr>
  <tr>
    <td>Petugas Pembayaran</td>
    <td>:</td>
    <td><?php echo $_SESSION["NIP"]; ?></td>
  </tr>
  <tr>
    <td>Tanggal Pembayaran</td>
    <td>:</td>
    <td><?php echo date("d/m/Y"); ?></td>
  </tr>
  <tr>
    <td>Total Yang Harus Dibayar</td>
    <td>:</td>
    <td><?php echo "Rp. ".number_format($_GET['t'], 0); ?></td>
  </tr>
  <tr>
    <td>Terbilang</td>
    <td>:</td>
    <td><?=terbilang($_GET['t'])?></td>
  </tr>
</table>
<br>
<hr style='border:1px solid #5AC54B;'>
<table width="95%" border="0" cellpadding="0" cellspacing="0" class="tb" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
  <tr>
    <th width="42%">Nama Jasa</th>
    <th width="24%">Tarif</th>
    <th width="34%" colspan="2">Quantity</th>
    </tr>
            <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
    <?php
  $sql = "SELECT a.kode, a.nama_jasa, b.qty, b.TARIFRS FROM m_tarif a, t_billranap b WHERE a.kode=b.KODETARIF AND b.NOBILL='".$_GET["idxb"]."'";
  $qry = mysql_query($sql)or die(mysql_error());
  while($data = mysql_fetch_array($qry)){
  ?>
    <td><? echo $data['nama_jasa']; ?></td>
    <td align="center"><? echo $data['TARIFRS']; ?></td>
    <td align="center"><? echo $data['qty']; ?></td>
    </tr>
    <?php } ?>
  </table>

</div>
</div>

<br>
<br>
<div id="frame">
<div id="frame_title"><h3>List Pembayaran</h3></div>
<fieldset>
	<legend>Cart List Bayar</legend>
    <form id="form_update_carabayar">
    <input type="hidden" name="nobill" value="<?php echo $_REQUEST['nobill'];?>" />
<table width="95%" border="0" cellpadding="0" cellspacing="0" class="tb">
  <tr>
    <th>Nama Jasa</th>
    <th style="width:100px; text-align:center;">Pelaksana</th>
    <th style="width:100px; text-align:center;">Tanggal </th>
    <th style="width:100px; text-align:center;">Tarif</th>
    <th style="width:100px; text-align:center;">Quantity</th>
    <th style="width:100px; text-align:center;">Subtotal</th>
    <th style="width:100px; text-align:center;">Cara Bayar</th>
    </tr>
    <?php
  $sql = "SELECT a.nama_tindakan AS nama_jasa, b.IDXBILL, b.CARABAYAR as kdcarabayar,
DATE_FORMAT(b.TANGGAL,'%d/%m/%Y') AS TGL1, b.qty, b.TARIFRS, c.NAMA as carabayar, d.NAMADOKTER
FROM t_billranap b 
join m_carabayar c on c.KODE = b.CARABAYAR
JOIN m_dokter d on b.KDDOKTER = d.KDDOKTER
JOIN m_tarif2012 a on a.kode_tindakan=b.KODETARIF
WHERE b.KODETARIF NOT LIKE '07%' and b.idxdaftar='".$_REQUEST['idxb']."' and b.NOBILL = '".$_REQUEST['nobill']."'";
  $qry = mysql_query($sql)or die(mysql_error());
  $total	= 0;
  while($data = mysql_fetch_array($qry)){
	  	$total = $total + ( $data['TARIFRS'] * $data['qty']);
  ?>
  	<tr>
    <td><? echo $data['nama_jasa']; ?></td>
    <td><? echo $data['NAMADOKTER']; ?></td>
    <td align="center"><? echo $data['TGL1']; ?></td>
    <td align="right"><? echo "Rp. ".curformat($data['TARIFRS']); ?></td>
    
    <td align="center"><? echo $data['qty']; ?></td>
    <td align="right"><? echo "Rp. ".curformat($data['TARIFRS']*$data['qty']); ?></td>
    <td align="center"><span id="idxbill_<?php echo $data['IDXBILL']; ?>" idx="<?php echo $_REQUEST['idxb'];?>" class="id_carabayar"><? echo $data['carabayar']; ?></span>
    <input type="hidden" name="idxbill[]" value="<?php echo $data['IDXBILL'];?>" />
    <input type="hidden" name="oldval[]" value="<?php echo $data['kdcarabayar'];?>" />
    <?php
	$sqls	= mysql_query('select * from m_carabayar order by ORDERS');
	echo '<select name="carabayar_update[]" style="display:none;" class="text selectbox_carabayar">';
	while($datas	= mysql_fetch_array($sqls)){
		if($datas['KODE'] == $data['kdcarabayar']): $sel = 'selected="selected"'; else: $sel = ''; endif;
		echo '<option value="'.$datas['KODE'].'" '.$sel.'>'.$datas['NAMA'].'</option>';
	}
	echo '</select>';
    ?>
    </td>
    </tr>
    <?php } ?>
    <tr>
                    <td colspan="4" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;">TOTAL</td>
                    <td align="right" style="background:#999; font-weight:bold;"></td>
                    <td align="right" style="background:#999; font-weight:bold;"><? echo "Rp. ".curformat($total); ?></td>
                    <td align="center" style="background:#999; font-weight:bold;">
                    <?php #if($userdata['STATUS'] != 'LUNAS'): ?>
                    <span id="edit_carabayar" svn="<?php echo $_REQUEST['idxb'];?>" class="buton_edit">Edit Carabayar</span>
                    <span id="save_carabayar" class="buton_edit" style="display:none;" svn="<?php echo $_REQUEST['idxb'];?>">Update</span>
                    <?php #endif; ?></td>
                </tr>
  </table>
  </form>
</fieldset>
</div>
</div>