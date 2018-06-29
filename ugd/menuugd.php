<link rel="stylesheet" type="text/css" href="style.css" />
<!--autocomplete-->
<script type="text/javascript">
function enter_pressed(e){
var keycode;
if (window.event) keycode = window.event.keyCode;
else if (e) keycode = e.which;
else return false;
return (keycode == 13);
return false;
}

function printIt(){
	content=document.getElementById('askep');
	w=window.open('about:blank');
	w.document.write( content.innerHTML );
	w.document.writeln("<script>");
	w.document.writeln("window.print()");
	w.document.writeln("</"+"script>");
}
function printIt(){
	content=document.getElementById('valid');
	head=document.getElementById('head_report');
	w=window.open('about:blank');
	w.document.writeln("<link href='dq_sirs.css' type='text/css' rel='stylesheet' />");
	w.document.write( head.innerHTML );
	w.document.write( content.innerHTML );
	w.document.writeln("<script>");
	w.document.writeln("window.print()");
	w.document.writeln("</"+"script>");
}

function popUp(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=1000,height=400,left=50,top=50');");
}

jQuery(document).ready(function(){
	jQuery('.tindakan').click(function(){
		var nomr		= jQuery('#nomr').val();
		var idxdaftar	= jQuery('#idxdaftar').val();
		var carabayar	= jQuery('#carabayar').val();
		var poly		= jQuery(this).attr('id');
		var group		= jQuery(this).attr('group');
		popUp('daftar_tindakan_poly.php?nomr='+nomr+'&idx='+idxdaftar+'&carabayar='+carabayar+'&poly='+poly+'&group='+group);
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
<div align="center">
  <div id="frame">
  <div id="frame_title">
  <h3 align="left">IDENTITAS PASIEN</h3>
</div>

	<div id="all">
    
    <fieldset class="fieldset">
      <legend>Identitas </legend>
<?php
  $myquery = "select a.NOMR,a.KDPOLY,a.KDDOKTER,a.TGLREG,b.NAMA,b.ALAMAT,b.JENISKELAMIN,b.TGLLAHIR,c.NAMA as CARABAYAR, a.IDXDAFTAR, d.NAMA as POLY, e.NAMADOKTER, c.kode as kodebayar
			  from t_pendaftaran a, m_pasien b, m_carabayar c, m_poly d, m_dokter e
			  where a.NOMR=b.NOMR AND a.KDCARABAYAR=c.KODE AND d.KODE=a.KDPOLY and a.KDDOKTER=e.KDDOKTER
			        and a.IDXDAFTAR='".$_GET["idx"]."'";
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get); 		
		$nomr=$userdata['NOMR'];
		$idxdaftar=$userdata['IDXDAFTAR'];
		$kdpoly=$userdata['KDPOLY'];
		$kddokter=$userdata['KDDOKTER'];
		$tglreg=$userdata['TGLREG'];
		$_SESSION['nomrx123'] = $nomr;
?>

<table width="95%" border="0">
  <tr>
    <td width="59%">
<table width="100%" border="0" class="tb" align="left" cellpadding="0" cellspacing="0">
        <tr>
          <td><strong>No MR</strong></td>
          <td>: <?php echo $userdata['NOMR'];?>
                    
          </td>
        </tr>
        <tr>
          <td width="25%"><strong>Nama Lengkap Pasien</strong></td>
          <td width="75%">: <?php echo $userdata['NAMA'];?></td>
        </tr>
        <tr>
          <td valign="top"><strong>Alamat Pasien</strong></td>
          <td>: <?php echo $userdata['ALAMAT'];?></td>
        </tr>
        <tr>
          <td valign="top"><strong>Jenis Kelamin</strong></td>
          <td colspan="2">: <? if($userdata['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L"){echo"Laki-Laki";}elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P"){echo"Perempuan";} ?>            <?php echo"( ". $userdata['JENISKELAMIN']." )";?></td>
        </tr>
        <tr>
          <td valign="top"><strong>Tanggal Lahir</strong></td>
          <td>: <?php echo date('d/m/Y', strtotime($userdata['TGLLAHIR']));?>          </td>
        </tr>
        <tr>
          <td valign="top"><strong>Umur</strong></td>
          <td>: <?php
		  $a = datediff($userdata['TGLLAHIR'], date("Y-m-d"));
		  echo "umur ".$a['years']." tahun ".$a['months']." bulan ".$a['days']." hari"; ?></td>
        </tr>
        <tr>
          <td valign="top"><strong>Cara Bayar</strong></td>
          <td>: <?php echo $userdata['CARABAYAR'];?></td>
        </tr>
        </table>    
    </td>
    <td width="41%" valign="top" align="right">
    	<?php
		$sqll = ('SELECT STATUS FROM t_pendaftaran WHERE NOMR = "'.$_REQUEST['nomr'].'" AND IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"');
		$sqll = mysql_query($sqll);
		$qrtl = mysql_fetch_array($sqll);
		#print_r($qrtl);
		if($qrtl['STATUS'] == 0){
			?>
        <table width="100%" style="float:right;">
		<tr><th colspan="3">Riwayat Pasien</th></tr>
		<tr><td colspan="3">
		
    	<input type="hidden" name="nomr" id="nomr" value="<?php echo $userdata['NOMR']; ?>" />
        <input type="hidden" name="idxdaftar" id="idxdaftar" value="<?php echo $userdata['IDXDAFTAR']; ?>" />
        <input type="hidden" name="carabayar" id="carabayar" value="<?php echo $userdata['kodebayar']; ?>" />
        
        <a href="<?php echo _BASE_;?>index.php?link=detail_billing&nomr=<?php echo $userdata['NOMR']; ?>&idxdaftar=<?php echo $userdata['IDXDAFTAR']; ?>"><input style="margin:3px;" type="button" name="riwayat_pasien" class="riwayat text" id="<?php echo $_SESSION['KDUNIT'];?>" value="Status Pembayaran" /></a>
		<a href="?link=rm6&nomr=<?=$_GET['nomr']?>&nama=<?=$userdata['NAMA']?>"><input type="button" class="text" name="Riwayat Pasien" value="Riwayat Pasien" /></a>
        <tr><th colspan="3">Jasa Tindakan</th></tr>
        </td></tr>
        <tr><td colspan="3">
        	<?php
			$mysql	= mysql_query('select * from m_tarif2012 where kode_gruptindakan = "02"');
			if(mysql_num_rows($mysql) > 0){
				while($mydata = mysql_fetch_array($mysql)){
					echo '<input type="button" style="margin:3px;" name="'.$mydata['nama_tindakan'].'" class="tindakan text" id="'.$_SESSION['KDUNIT'].'" value="'.$mydata['nama_tindakan'].'" group="'.$mydata['kode_tindakan'].'"/>';
				}
			}
			?>
        </td></tr>
		</table>
			<?php
		}else{
			?>
            <a href="<?php echo _BASE_;?>index.php?link=detail_billing&nomr=<?php echo $userdata['NOMR']; ?>&idxdaftar=<?php echo $userdata['IDXDAFTAR']; ?>"><input type="button" name="riwayat_pasien" class="riwayat text" id="<?php echo $_SESSION['KDUNIT'];?>" value="Status Pembayaran" /></a>
			<a href="?link=rm6&nomr=<?=$_GET['nomr']?>&nama=<?=$userdata['NAMA']?>"><input type="button" class="text" name="Riwayat Pasien" value="Riwayat Pasien" /></a>
            <?php
		}
		?>
    </td>
  </tr>
</table>
    </fieldset>
	<div id="list_data"></div>
    <fieldset class="fieldset">
      <legend>Data Rekam Medik</legend>
      <div id="tabmenu">
	  
	  
      <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=5&idx=<?=$idxdaftar?>">PASIEN KELUAR/MASUK</a>
	  <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=10&idx=<?=$idxdaftar?>">ANAMNESA DENGAN POLA</a>	
	  <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=1&idx=<?=$idxdaftar?>">ADD ITEM OBAT</a>
      <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=2&idx=<?=$idxdaftar?>">DIAGNOSA DAN TERAPI</a>
	 <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=3&idx=<?=$idxdaftar?>">ORDER RADIOLOGI</a> 
      <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=4&idx=<?=$idxdaftar?>">ORDER LAB</a>
      <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=6&idx=<?=$idxdaftar?>">ORDER KAMAR OPERASI</a>
      <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=7&idx=<?=$idxdaftar?>">DPMP</a>
     
      
      </div>
      
      <div id="wrapper">
           
	<div class="boxholder">	
    <div id="cart_resep">
    <?
    //die();
    if(!empty($pesan)){ ?>
		<div style="border:1px solid #DF7; padding:5px; margin:5px; color:#093; width:95%; background-color:#FFF;" align="left">
			<?=$pesan;?>
        </div>
    <? } ?>
    </div>
    	

 <?
if ($_GET['menu']=='2')
 {
 ?>  
   
  <div class="box">
<div id="frame">
    <div id="frame_title">
  <h3>Diagnosa & Terapi</h3>
    </div>
    <? include("diagnosa_terapi.php"); ?>
        </div>
</div>

	 <? }else if ($_GET['menu']=='1') { ?> 
    <div class="box">
      <div id="frame">
        <div id="frame_title">
          <h3>Add Item Obat</h3>
        </div>
          <? include("apotek/additemobat.php"); ?>
      </div>
    </div>
    
<? } 
 
 elseif ($_GET['menu']=='5' || $_GET['menu']=='')
 {?>   
    
    <div class="box">
      <div id="frame"><div id="frame_title"><h3>Pasien Keluar Masuk</h3></div>
         <? include("masuk_keluar.php"); ?>
	 </div>		
  </div>

  <? } 
 
 elseif ($_GET['menu']=='7')
 {?>   
    <div class="box">
    <div id="frame"><div id="frame_title"><h3>Order DPMP</h3></div>
<form action="ugd/save_dpmp.php" name="dpmp" method="post" id="dpmp">
      <input name="NOMR" id="NOMR" type="hidden" value=<?php echo $nomr; ?> >
      <input name="IDXDAFTAR" id="IDXDAFTAR" type="hidden" value=<?php echo $idxdaftar; ?> >
		<input type="hidden" name="POLY" value="<?php echo $kdpoly;?>" />
        <table width="95%" class="tb" border="0">
          <tr valign="top">
            <td width="17%">DIIT :</td>
            <td colspan="2">
              Shift :
              <input type="radio" name="SHIFT" value="1"/> Pagi
              <input type="radio" name="SHIFT" value="2"/> Siang
              <input type="radio" name="SHIFT" value="3"/> Sore
              <span style="padding-left:100px;">Snack :
                <input type="radio" name="SHIFT" value="4"/> Pagi
                <input type="radio" name="SHIFT" value="5"/> Sore</span>    </td>
            </tr>
          <tr>
            <td>TYPE MAKANAN</td>
            <td width="30%">
              <select name="TYPEMAKANAN" class="text">
                <option selected="selected"> -Pilih- </option>
                <option value="1">PASIEN YANG MENDAPAT MAKANAN BIASA</option>
                <option value="2">PASIEN YANG MENDAPAT MAKANAN KHUSUS</option>
                </select>
            </td>
            <td width="53%" rowspan="6">&nbsp;</td>
          </tr>
          <tr>
            <td>KETERANGAN</td>
            <td>
              <select name="KETERANGAN" class="text">
                <option selected="selected"> -Pilih- </option>
                <option value="1">TKTP</option>
                <option value="2">RG</option>
                <option value="3">DL</option>
                <option value="4">DH</option>
                <option value="5">DM</option>
                <option value="6">DJ</option>
                <option value="7">TP</option>
                <option value="8">RP.r</option>
                <option value="9">RP</option>
                <option value="10">LAIN-LAIN</option>
                </select>
            </td>
          </tr>
          <tr>
            <td>JENIS MAKANAN</td>
            <td>
                <select name="JENISMAKANAN" class="text">
                    <option selected="selected"> -Pilih- </option>
                    <option value="1">Nasi</option>
                    <option value="2">Lauk</option>
                    <option value="3">Bubur Sonde</option>
                    <option value="4">Cair</option>
                    <option value="5">Sonde</option>
                </select>
            </td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value="Simpan" class="text" onclick="newsubmitform (document.getElementById('dpmp'),'ugd/save_dpmp.php','valid_save_dpmp',validatetask); return false;"/></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
        </table>
</form>
        <div id="valid_save_dpmp">
        	<? include("save_dpmp.php"); ?>
        </div>
    </div>          
	</div>
<? }elseif($_GET['menu']=='8'){ ?>
  <div class="box">
	<? include("ekg/form_ekg.php"); ?>
  </div>
<? } elseif ($_GET['menu']=='10')
 {?> 
 

         <? include("./rajal/anamnesa.php"); ?>
<? } 
 elseif ($_GET['menu']=='3')
 {?>   
    <div class="box">
    		
				<? include("./rajal/rad/order_rad.php");?>  
    </div>

 <? } 
 elseif ($_GET['menu']=='4')
 {?>    
    <div class="box">
       
            <? include("./rajal/lab/order_lab.php"); ?>
       
    </div>
<? }  
 elseif ($_GET['menu']=='6')
 {?>    
    <div class="box">
       
            <? include("./rajal/operasi/form_daftar_operasi.php"); ?>
      
    </div>
<? } ?>

</div></div>
<script>

function show(){
var Digital=new Date()
var hours=Digital.getHours()
var minutes=Digital.getMinutes()
var seconds=Digital.getSeconds()
var curTime = 
    ((hours < 10) ? "0" : "") + hours + ":" 
    + ((minutes < 10) ? "0" : "") + minutes + ":" 
    + ((seconds < 10) ? "0" : "") + seconds 
var dn="AM"

if (hours>12){
dn="PM"
hours=hours-12
}
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
document.pasien_masuk.Masuk.value=curTime
document.pasien_keluar.Keluar.value=curTime
setTimeout("show()",1000)
}
show()
//-->
<!-- hide from old browsers
  var curDateTime = new Date()
  var curHour = curDateTime.getHours()
  var curMin = curDateTime.getMinutes()
  var curSec = curDateTime.getSeconds()
  var curTime = 
    ((curHour < 10) ? "0" : "") + curHour + ":" 
    + ((curMin < 10) ? "0" : "") + curMin + ":" 
    + ((curSec < 10) ? "0" : "") + curSec 
//-->
</script>  
<script type="text/javascript">
	Element.cleanWhitespace('content');
	init();
</script>
