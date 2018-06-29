<!-- datetime -->
<link href="ranap/rfnet.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="ranap/datetimepicker_css.js"></script>
<!-- -->
<? if(!empty($_GET['psn'])){ ?>
<script type="text/javascript">
	alert('Order Ke Kamar Operasi Telah Disimpan.');
</script>
<? } ?>
<script language="javascript">
function printIt()
{
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
</script>
<script>
jQuery(document).ready(function(){
	
	jQuery('#nama_obat').autocomplete('<?php echo _BASE_; ?>apotek/autocomplete_obat.php',{
			width: 450,
			multiple: false,
			matchContains: true,
			extraParams: {
			   jenis: function() { return jQuery("#jenis_barang").val(); }
		   }
	}).result(function(event, data, formatted) {
		if(data){
			//jQuery('#kode_obat_nr').val(data[1]);	
			//jQuery('#harga_obat_nr').val(data[2]);	
		}else{
			//jQuery("#kode_obat_nr").val('');
			//jQuery('#harga_obat_nr').val(0);	
		}
	});
	
	jQuery('.konsultasi_gizi').click(function(){
		var nomr		= jQuery('#nomr').val();
		var idxdaftar	= jQuery('#idx').val();
		var dokter		= jQuery('#dokter').val();
		var carabayar	= jQuery('#carabayar').val();
		var ruang		= jQuery(this).attr('id');
		var nott		= jQuery('#nott').val();
		var rajal		= 0;

		jQuery.get('cartbill_save_bayar_gizi.php?nomr='+nomr+'&idx='+idxdaftar+'&carabayar='+carabayar+'&dokter='+dokter+'&poly='+ruang+'&nott='+nott+'&rajal='+rajal,function(data){
			if(!data){
				alert("Berhasil didaftarkan di Konsultasi Gizi");
			}
		});
	});
});
</script>
<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>Rawat Inap</h3></div>
<?php 
include("./include/connect.php");
$id_admission = $_GET["id_admission"];
?>

<fieldset class="fieldset">
      <legend>Identitas </legend>
<?php
  $myquery = "SELECT a.nomr, a.kirimdari, a.dokterpengirim AS dokter_penanggungjawab, a.masukrs, a.noruang, a.nott, b.NAMA, b.ALAMAT, b.JENISKELAMIN, b.TGLLAHIR, c.NAMA AS CARABAYAR, a.id_admission, a.noruang, d.NAMA AS POLY, e.NAMADOKTER, f.kelas, f.nama AS nm_ruang, DATE_FORMAT(TGLLAHIR,'%d/%m/%Y') AS TGLLAHIR1, a.statusbayar
FROM t_admission a
JOIN m_pasien b ON a.nomr=b.NOMR
JOIN m_carabayar c ON a.statusbayar=c.KODE 
JOIN m_poly d ON d.KODE=a.kirimdari 
JOIN m_ruang f ON f.no=a.noruang
JOIN m_dokter e ON a.dokterpengirim=e.KDDOKTER 
WHERE a.id_admission='".$_GET["id_admission"]."'";
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get);
		$id_admission	= $userdata['id_admission'];
		$nomr			= $userdata['nomr'];
		$noruang		= $userdata['noruang'];
		$kdpoly			= $userdata['kirimdari'];
		$kddokter		= $userdata['dokter_penanggungjawab'];
		$tglreg			= $userdata['TGLREG'];
		$kelas			= $userdata['kelas'];
		$masukrs		= $userdata['masukrs'];
		$jk				= $userdata['JENISKELAMIN'];

mysql_query("update t_billranap set NOMR='$nomr' where IDXDAFTAR='$_GET[id_admission]'");
mysql_query("update t_bayarranap set NOMR='$nomr' where IDXDAFTAR='$_GET[id_admission]'");
?>


      
<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>No MR</td>
          <td>
<span style="float:right; position:relatif; left: 940px; top: 117px;">
    <a href="index.php?link=31s&nomr=<?=$nomr?>&idx=<?php echo $_GET['id_admission']; ?>"><input type="button" class="text" name="bayar" value="List Pembayaran" /></a>
    <!--<a href="index.php?link=31r&nomr=<?=$nomr?>&idx=<?php echo $_GET['id_admission']; ?>"><input type="button" class="text" name="bayar" value="Beban Jasa Rumah Sakit" /></a>-->
    <a href="index.php?link=31r&nomr=<?=$nomr?>&idx=<?php echo $_GET['id_admission']; ?>"><input type="button" class="text" name="bayar" value="Jasa dan Tindakan Rumah Sakit" /></a>
    <input type="hidden" name="nomr" id="nomr" value="<?php echo $userdata['nomr'];?>" />
    <input type="hidden" name="idx" id="idx" value="<?php echo $userdata['id_admission'];?>" />
    <input type="hidden" name="carabayar" id="carabayar" value="<?php echo $userdata['statusbayar'];?>" />
    <input type="hidden" name="dokter" id="dokter" value="<?php echo $kddokter;?>" />
    <input type="hidden" name="nott" id="nott" value="<?php echo $userdata['nott'];?>" />
	<a href="?link=rm6&nomr=<?=$nomr?>&nama=<?=$userdata['NAMA']?>"><input type="button" class="text" name="Riwayat Pasien" value="Riwayat Pasien" /></a>
	  <a href="index.php?link=62formorderlab_order&nomr=<?=$nomr?>&idx=<?php echo $_GET['id_admission']; ?>"><input type="button" value="ORDER PEMERIKSAAN LAB" class="text"/></a>
    <input type="button" name="konsultasi_gizi" class="konsultasi_gizi text" id="<?php echo $noruang;?>" value="Konsultasi Gizi" />
    </span> <?php echo $userdata['nomr'];?></td>
        </tr>
        <tr>
          <td width="21%">Nama Lengkap pasien</td>
          <td width="79%"><?php echo $userdata['NAMA'];?></td>
        </tr>
        <tr>
          <td valign="top">Alamat pasien</td>
          <td><?php echo $userdata['ALAMAT'];?></td>
        </tr>
        <tr>
          <td valign="top">Jenis Kelamin</td>
          <td colspan="2"><? if($userdata['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L"){echo"Laki-Laki";}elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P"){echo"Perempuan";} ?> <?php echo"( ". $userdata['JENISKELAMIN']." )";?></td>
          </tr>
        <tr>
          <td valign="top">Tanggal Lahir</td>
          <td>
            <?php echo $userdata['TGLLAHIR1'];?>
          </td>
        </tr>
        <tr>
          <td valign="top">Umur</td>
          <td><?php
		  $a = datediff($userdata['TGLLAHIR'], date("Y-m-d"));
		  echo "umur ".$a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td>
        </tr>
        <tr>
          <td valign="top">Cara Bayar</td>
          <td><?php echo $userdata['CARABAYAR'];?></td>
        </tr>
        <tr>
          <td valign="top">Dokter Pengirim</td>
          <td><?php echo $userdata['NAMADOKTER'];?></td>
        </tr>
        <tr>
          <td valign="top">Nama Ruang</td>
          <td><?php echo $userdata['nm_ruang'];?></td>
        </tr>

      </table>
	  
	  <div id="loadform">
    <?php if(!empty($_GET['makan'])){
     include("form_perm_makan.php");
    } ?>
</div>


    </fieldset>
    <div id="list_data"></div>
<fieldset class="fieldset">
      <legend>Pilih Form Rawat Inap
</legend>

<div id="tabmenu">

	  <a href="?link=121&nomr=<?= $nomr;?>&menu=1&admission=<?=$id_admission?>">Perjalanan Penyakit / Intruksi Dokter</a>
      <a href="?link=121&nomr=<?= $nomr;?>&menu=2&admission=<?=$id_admission?>">Daftar Pemberian Obat</a> 
	  <a href="?link=121&nomr=<?= $nomr;?>&menu=3&admission=<?=$id_admission?>">Daftar Permintaan Makanan Pasien</a>
	  <a href="?link=121&nomr=<?= $nomr;?>&menu=4&admission=<?=$id_admission?>">Resume Medis</a> 
      <a href="?link=121&nomr=<?= $nomr;?>&menu=5&admission=<?=$id_admission?>">Resume Pulang</a>
      <a href="?link=121&nomr=<?= $nomr;?>&menu=6&admission=<?=$id_admission?>">Order Kamar Operasi</a>
</div>

<div id="wrapper">
           
	<div class="boxholder">	
<?
if ($_GET['menu']=='1' || $_GET['menu']=='')
 {
 ?>  
<div class="box">
<div id="frame">
    <div id="frame_title">
	
  <h3>Perjalanan Penyakit / Intruksi Dokter</h3>
   <? include("ranap/instruksi_dokter.php"); ?>
</div>
        </div>
</div>

   
   
<? } 
 elseif ($_GET['menu']=='2')
 {?>   
    <div class="box">
    		<div id="frame">
            	<div id="frame_title"><h3>Daftar Pemberian Obat</h3></div>
				<? include("ranap/daftar_pemberian_obat.php"); ?>
            </div>      
    </div>

 <? } 
 elseif ($_GET['menu']=='3')
 {?>    
    <div class="box">
            <div id="frame">
            	<div id="frame_title"><h3>Daftar Permintaan Makanan Pasien</h3></div>
				<? include("ranap/daftar_permintaan_makanan.php"); ?>
            </div>  
    </div>    
  <? } 
   elseif ($_GET['menu']=='4')
 {?>    
    <div class="box">
            <div id="frame">
            	<div id="frame_title"><h3>Resume Medis</h3></div>
				 <? include("ranap/resume_medis.php"); ?> 
            </div>  
    </div>    
  <? } 
  elseif ($_GET['menu']=='5')
 {?>    
    <div class="box">
            <div id="frame">
            	<div id="frame_title"><h3>Resume Pulang</h3></div>
				<? include("ranap/resume_pulang.php"); ?> 
            </div>  
    </div>    
  <? } 
 elseif ($_GET['menu']=='6' )
 {?>   
    
  <? include("operasi/form_daftar_operasi.php");	
  ?>
</fieldset>
</div>
</div></div>
<? }   ?>  
     </fieldset>
</div>
</div>