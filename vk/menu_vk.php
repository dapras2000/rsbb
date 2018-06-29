<link rel="stylesheet" type="text/css" href="style.css" />
<!--autocomplete-->
<script type='text/javascript' src='rajal/jscripts/jquery.autocomplete.pack.js'></script>
<link rel="stylesheet" type="text/css" href="rajal/jscripts/jquery.autocomplete.css" />

<script>
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
		var kddokter	= jQuery('#kddokter').val();
		popUp('daftar_tindakan_ranap.php?nomr='+nomr+'&idx='+idxdaftar+'&carabayar='+carabayar+'&poly='+poly+'&kddokter='+kddokter);
	});
	jQuery("#icdv").autocomplete("vk/autocomplete_vk.php", {
		width: 260,
		selectFirst: true
	});
	jQuery("#icd_code").autocomplete("vk/autocomplete_vk2.php", {
		width: 260,
		selectFirst: true
	});
});
</script>

<script type="text/javascript">
function enter_pressed(e){
var keycode;
if (window.event) keycode = window.event.keyCode;
else if (e) keycode = e.which;
else return false;
return (keycode == 13);
}

</script>

<script language="javascript">
function printIt()
{
content=document.getElementById('askep');
w=window.open('about:blank');
w.document.write( content.innerHTML );
w.document.writeln("<script>");
w.document.writeln("window.print()");
w.document.writeln("</"+"script>");
}
</script>

<?php 
include("../include/connect.php");
require_once('ps_pagination.php');

?>
<div align="center">
  <div id="frame" style="width:100%;">
  <div id="frame_title">
  <h3 align="left">IDENTITAS PASIEN</h3>
</div>

	<div id="all">
    
    <fieldset class="fieldset">
      <legend>Identitas </legend>
<?php
 $myquery = "select a.NOMR,a.KDPOLY,a.KDDOKTER,a.TGLREG,b.NAMA,b.ALAMAT,b.JENISKELAMIN,b.TGLLAHIR,c.NAMA as CARABAYAR, c.KODE as KDCARABAYAR, a.IDXDAFTAR, d.NAMA as POLY, (select NAMADOKTER from m_dokter where KDDOKTER = a.KDDOKTER) AS NAMADOKTER, a.KDCARABAYAR, a.KDDOKTER
			  from t_pendaftaran a, m_pasien b, m_carabayar c, m_poly d
			  where a.NOMR=b.NOMR AND a.KDCARABAYAR=c.KODE AND d.KODE=a.KDPOLY and a.IDXDAFTAR='".$_GET["idx"]."'";
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get); 		
		$nomr=$userdata['NOMR'];
		$idxdaftar=$userdata['IDXDAFTAR'];
		$kdpoly=$userdata['KDPOLY'];
		$kddokter=$userdata['KDDOKTER'];
		$tglreg=$userdata['TGLREG'];
		$_SESSION['nomrx123'] = $nomr;
		$_SESSION['idxdaftar123'] = $userdata['IDXDAFTAR'];
		
?>

<table width="60%" border="0" cellpadding="0" cellspacing="0" style="float:left;">
<tr><td>No MR</td><td width="33%"><?php echo $userdata['NOMR'];?></td><td width="46%" align="right">
            <!--
            <a href="index.php?link=3r&nomr=<?=$userdata['NOMR']?>&idx=<?=$userdata['IDXDAFTAR'];?>" class="text">Tindakan Medis</a> |
            <a href="index.php?link=34x&nomr=<?=$nomr?>&idxdaftar=<?=$userdata['IDXDAFTAR'];?>" class="text">List Pembayaran</a>
            -->
          </td>
        </tr>
        <tr>
          <td width="21%">Nama Pasien</td>
          <td colspan="2"><?php echo $userdata['NAMA'];?></td>
        </tr>
        <tr>
          <td valign="top">Alamat</td>
          <td colspan="2"><?php echo $userdata['ALAMAT'];?></td>
        </tr>
        <tr>
          <td valign="top">Jenis Kelamin</td>
          <td colspan="3"><? if($userdata['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L"){echo"Laki-Laki";}elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P"){echo"Perempuan";} ?>            <?php echo"( ". $userdata['JENISKELAMIN']." )";?></td>
        </tr>
        <tr>
          <td valign="top">Tanggal Lahir</td>
          <td colspan="2">
            <?php echo date('d/m/Y', strtotime($userdata['TGLLAHIR']));?>          </td>
        </tr>
        <tr>
          <td valign="top">Umur</td>
          <td colspan="2"><?php
		  $a = datediff($userdata['TGLLAHIR'], date("Y-m-d"));
		  echo "umur ".$a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td>
        </tr>
        <tr>
          <td valign="top">Cara Bayar</td>
          <td colspan="2"><?php echo $userdata['CARABAYAR'];?></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
      </table>
      <table width="30%" style="float:right;">
      	<?php
		$sqll = ('SELECT STATUS FROM t_pendaftaran WHERE NOMR = "'.$_REQUEST['nomr'].'" AND IDXDAFTAR = "'.$_REQUEST['idx'].'"');
		$sqll = mysql_query($sqll);
		$qrtl = mysql_fetch_array($sqll);
		if($qrtl['STATUS'] == 0){
			?>
        <tr><th colspan="3">Jasa Tindakan</th></tr>
        <tr><td><input type="button" name="tindakan_poly" class="tindakan text" id="<?php echo $_SESSION['KDUNIT'];?>" value="Jasa Tindakan Poly" />
        </td><td><input type="button" name="tindakan_poly" class="tindakan text" id="0" value="Jasa Tindakan Lain Lain" /></td></tr>
        <tr><td colspan="2"><a href="?link=detail_billing&nomr=<?=$_GET['nomr']?>&idxdaftar=<?php echo $_REQUEST['idx'];?>"><input type="button" class="text" name="Riwayat Pasien" value="Status Pembayaran" /></a>
		<a href="?link=rm6&nomr=<?=$_GET['nomr']?>&nama=<?=$userdata['NAMA']?>"><input type="button" class="text" name="Riwayat Pasien" value="Riwayat Pasien" /></a></td>
           <!-- <td><a href="?link=f04&nomr=<?=$_GET['nomr']?>&idx=<?=$_GET['idx']?>&opt=2" class="text">Pengeluaran Barang Pasien</a></td>-->
		</tr>

			<input type="hidden" name="nomr" id="nomr" value="<?php echo $userdata['NOMR']; ?>" />
            <input type="hidden" name="kddokter" id="kddokter" value="<?php echo $userdata['KDDOKTER']; ?>" />
            <input type="hidden" name="idxdaftar" id="idxdaftar" value="<?php echo $userdata['IDXDAFTAR']; ?>" />
            <input type="hidden" name="carabayar" id="carabayar" value="<?php echo $userdata['KDCARABAYAR']; ?>" />
	<?php
		}else{
			?><tr><td><a href="?link=detail_billing&nomr=<?=$_GET['nomr']?>&idxdaftar=<?php echo $_REQUEST['idx'];?>"><input type="button" class="text" name="Riwayat Pasien" value="Status Pembayaran" /></a>
			<a href="?link=rm6&nomr=<?=$_GET['nomr']?>&nama=<?=$userdata['NAMA']?>"><input type="button" class="text" name="Riwayat Pasien" value="Riwayat Pasien" /></a></td></tr><?php
		}
		?>
        </table>
	<br clear="all" />
    </fieldset>
    
	<div id="list_data"></div>
    <fieldset class="fieldset">
      <legend>Data Rekam Medik</legend>
      <div id="tabmenu">
		  
          <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=9&idx=<?=$idxdaftar?>">MASUK/KELUAR</a>
		  <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=13&idx=<?=$idxdaftar?>">ANAMNESA DENGAN POLA</a>
		  <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=1&idx=<?=$idxdaftar?>">ADD ITEM OBAT</a>
          <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=2&idx=<?=$idxdaftar?>">REG PARTUS</a>
          <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=12&idx=<?=$idxdaftar?>">DIAGNOSA DAN TERAPI</a> 
		  
          <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=6&idx=<?=$idxdaftar?>">DPMP</a>
          <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=7&idx=<?=$idxdaftar?>">ORDER OPERASI</a>
      </div>
      <div id="wrapper">
   		<div class="boxholder">
        	<? if(!empty($pesan)){ ?>	
    		<div id="cart_resep">
				<div style="border:1px solid #DF7; padding:5px; margin:5px; color:#093; width:95%; background-color:#FFF;" align="left">
					<strong><?=$pesan;?></strong>
        		</div>
            </div>
    	
		<? } 
		if ($_GET['menu']=='2'){?>    
   			<div class="box">
   				<div id="frame"><div id="frame_title"><h3>Reg Partus</h3></div>
				<? include("reg_partus.php"); ?> 
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
				
	 	<? } elseif ($_GET['menu']=='6') {?>    
            <div class="box">
                <div id="frame"><div id="frame_title"><h3>Order DPMP</h3></div>
                     <? include("order_makan.php"); ?> 
                    <div id="valid_save_dpmp">
                        <? include("save_dpmp.php"); ?>
                    </div>     
                </div>     
            </div>

		<? } elseif ($_GET['menu']=='7') {?>    
   			<div class="box">
		 		<? include("vk/operasi/form_daftar_operasi.php"); ?> 
			</div>
		<? }elseif ($_GET['menu']=='9' || $_GET['menu']=='') {?>    
   			<div class="box">
		   		<div id="frame"><div id="frame_title"><h3>Pasien Keluar Masuk</h3></div>
				 <? include("masuk_keluar.php"); ?> 
				</div>
    		</div>
		<? } elseif ($_GET['menu']=='12'){ ?>  
			<div class="box">
				<div id="frame">
					<div id="frame_title"><h3>Diagnosa & Terapi</h3></div>
    				<? include("diagnosa_terapi.php"); ?>
        		</div>
			</div>
		<? } elseif ($_GET['menu']=='13')
 {?> 
 

         <? include("./rajal/anamnesa.php"); ?>

<? } ?>
        </div>
      </div>
     </fieldset>
</div>