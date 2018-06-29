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
	<a href="index.php?link=31s2&nomr=<?=$nomr?>&idx=<?php echo $_GET['id_admission']; ?>"><input type="button" class="text" name="simpan" value="Print Diagnosa" /></a>
	<a href="index.php?link=31s3&nomr=<?=$nomr?>&idx=<?php echo $_GET['id_admission']; ?>"><input type="button" class="text" name="simpan" value="Rekap Bill" /></a>
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
	  <a href="index.php?link=72formorderrad_ranap&nomr=<?=$nomr?>&idx=<?php echo $_GET['id_admission']; ?>"><input type="button" value="ORDER RAD" class="text"/></a>
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
    </fieldset>
    
<fieldset class="fieldset">
      <legend>Pilih Form Rawat Inap
</legend>

<!--
<form id="ranap" name="ranap" method="post" action="ranap/form_ranap.php">
<input type="hidden" name="id_admission" value="<?php echo $id_admission;?>" />
<input type="hidden" name="nomr" value="<?php echo $nomr;?>" />
<input type="hidden" name="noruang" value="<?php echo $noruang;?>" />
<input type="hidden" name="kelas" value="<?php echo $kelas;?>" />
<input type="hidden" name="kddokter" value="<?php echo $kddokter;?>" />
<input type="hidden" name="kdpoly" value="<?php echo $kdpoly;?>" />
<input type="hidden" name="masukrs" value="<?php echo $masukrs;?>" />
<input type="hidden" name="jk" value="<?php echo $jk;?>" />
<table border="0" class="tb" width="95%">
<tr>
    <td width="39%"><input type="radio" name="f_ranap" value="Perjalanan Penyakit / Intruksi Dokter"/> Perjalanan Penyakit / Intruksi Dokter</td>
    <td width="35%"><input type="radio" name="f_ranap" value="Daftar Pemberian Obat"/> Daftar Pemberian Obat</td>
</tr>
<tr>
    <td><input type="radio" name="f_ranap" value="Daftar Permintaan Makanan Pasien"/> Daftar Permintaan Makanan Pasien</td>
    <td><input type="radio" name="f_ranap" value="Resume Medis"/> Resume Medis</td>
</tr>
<tr>
    <td><input type="radio" name="f_ranap" value="Resume Pulang"/> Resume Pulang </td>
    <td><input type="radio" name="f_ranap" value="Kamar Operasi"/> Order Kamar Operasi </td>
</tr>
</table>
<input type="submit" value=" P i l i h " class="text" onclick="newsubmitform (document.getElementById('ranap'),'ranap/form_ranap.php','loadform',validatetask); return false;"/>
</form>
-->

<table align="center">
  <tr>
    <td>
      <form id="ranapt" name="ranapt" method="post" action="ranap/form_ranap.php">
        <?php                       
        $sql = "SELECT a.*, (select nama_domain from m_domain_diagnosa_kep where id_domain = a.id_domain) nama_domain, (select kode_diagnosis from m_diagnosis_kep where id_diagnosis=a.id_diagnosis) kode_diagnosis, (select nama_diagnosis from m_diagnosis_kep where id_diagnosis=a.id_diagnosis) nama_diagnosis FROM t_diagnosakep a WHERE a.NOMR ='".$nomr."' and a.idadmission = '".$id_admission."' ORDER BY a.id_diagnosakep";
        $hasil=mysql_query($sql);
        $data=mysql_fetch_array($hasil);
        ?>
        <input type="hidden" name="iddiagkep" value="<?php echo $data['id_diagnosakep'];?>" />
        <input type="hidden" name="nama" value="<?php echo $userdata['NAMA'];?>" />
        <input type="hidden" name="id_admission" value="<?php echo $id_admission;?>" />
        <input type="hidden" name="nomr" value="<?php echo $nomr;?>" />
        <input type="hidden" name="noruang" value="<?php echo $noruang;?>" />
        <input type="hidden" name="kelas" value="<?php echo $kelas;?>" />
        <input type="hidden" name="kddokter" value="<?php echo $kddokter;?>" />
        <input type="hidden" name="kdpoly" value="<?php echo $kdpoly;?>" />
        <input type="hidden" name="masukrs" value="<?php echo $masukrs;?>" />
        <input type="hidden" name="jk" value="<?php echo $jk;?>" />
            <input type="submit" name="f_ranap" value="Diagnosa Dokter Terapi" class="text" onclick="newsubmitform (document.getElementById('ranapt'),'ranap/form_ranap.php','loadform',validatetask); return false;"/>
      </form>
    </td>
    <td>
      <form id="ranap" name="ranap" method="post" action="ranap/form_ranap.php">
        <input type="hidden" name="id_admission" value="<?php echo $id_admission;?>" />
        <input type="hidden" name="nomr" value="<?php echo $nomr;?>" />
        <input type="hidden" name="noruang" value="<?php echo $noruang;?>" />
        <input type="hidden" name="kelas" value="<?php echo $kelas;?>" />
        <input type="hidden" name="kddokter" value="<?php echo $kddokter;?>" />
        <input type="hidden" name="kdpoly" value="<?php echo $kdpoly;?>" />
        <input type="hidden" name="masukrs" value="<?php echo $masukrs;?>" />
        <input type="hidden" name="jk" value="<?php echo $jk;?>" />
            <input type="submit" name="f_ranap" value="Perjalanan Penyakit / Intruksi Dokter" class="text" onclick="newsubmitform (document.getElementById('ranap'),'ranap/form_ranap.php','loadform',validatetask); return false;"/>
      </form>
    </td>
    <td>
        <form id="ranap1" name="ranap1" method="post" action="ranap/form_ranap.php">
          <input type="hidden" name="id_admission" value="<?php echo $id_admission;?>" />
          <input type="hidden" name="nomr" value="<?php echo $nomr;?>" />
          <input type="hidden" name="noruang" value="<?php echo $noruang;?>" />
          <input type="hidden" name="kelas" value="<?php echo $kelas;?>" />
          <input type="hidden" name="kddokter" value="<?php echo $kddokter;?>" />
          <input type="hidden" name="kdpoly" value="<?php echo $kdpoly;?>" />
          <input type="hidden" name="masukrs" value="<?php echo $masukrs;?>" />
          <input type="hidden" name="jk" value="<?php echo $jk;?>" />
                <input type="submit"  name="f_ranap" value="Daftar Pemberian Obat" class="text" onclick="newsubmitform (document.getElementById('ranap1'),'ranap/form_ranap.php','loadform',validatetask); return false;"/>
        </form>
    </td>
    <td>
        <form id="ranap2" name="ranap2" method="post" action="ranap/form_ranap.php">
          <input type="hidden" name="id_admission" value="<?php echo $id_admission;?>" />
          <input type="hidden" name="nomr" value="<?php echo $nomr;?>" />
          <input type="hidden" name="noruang" value="<?php echo $noruang;?>" />
          <input type="hidden" name="kelas" value="<?php echo $kelas;?>" />
          <input type="hidden" name="kddokter" value="<?php echo $kddokter;?>" />
          <input type="hidden" name="kdpoly" value="<?php echo $kdpoly;?>" />
          <input type="hidden" name="masukrs" value="<?php echo $masukrs;?>" />
          <input type="hidden" name="jk" value="<?php echo $jk;?>" />
                <input type="submit"  name="f_ranap" value="Daftar Permintaan Makanan Pasien" class="text" onclick="newsubmitform (document.getElementById('ranap2'),'ranap/form_ranap.php','loadform',validatetask); return false;"/>
        </form>
    </td>
    <td>
        <form id="ranap3" name="ranap3" method="post" action="ranap/form_ranap.php">
          <input type="hidden" name="id_admission" value="<?php echo $id_admission;?>" />
          <input type="hidden" name="nomr" value="<?php echo $nomr;?>" />
          <input type="hidden" name="noruang" value="<?php echo $noruang;?>" />
          <input type="hidden" name="kelas" value="<?php echo $kelas;?>" />
          <input type="hidden" name="kddokter" value="<?php echo $kddokter;?>" />
          <input type="hidden" name="kdpoly" value="<?php echo $kdpoly;?>" />
          <input type="hidden" name="masukrs" value="<?php echo $masukrs;?>" />
          <input type="hidden" name="jk" value="<?php echo $jk;?>" />
                <input type="submit"  name="f_ranap" value="Resume Medis" class="text" onclick="newsubmitform (document.getElementById('ranap3'),'ranap/form_ranap.php','loadform',validatetask); return false;"/>
        </form>
    </td>
    <td>
        <form id="ranap4" name="ranap4" method="post" action="ranap/form_ranap.php">
          <input type="hidden" name="id_admission" value="<?php echo $id_admission;?>" />
          <input type="hidden" name="nomr" value="<?php echo $nomr;?>" />
          <input type="hidden" name="noruang" value="<?php echo $noruang;?>" />
          <input type="hidden" name="kelas" value="<?php echo $kelas;?>" />
          <input type="hidden" name="kddokter" value="<?php echo $kddokter;?>" />
          <input type="hidden" name="kdpoly" value="<?php echo $kdpoly;?>" />
          <input type="hidden" name="masukrs" value="<?php echo $masukrs;?>" />
          <input type="hidden" name="jk" value="<?php echo $jk;?>" />
                <input type="submit"  name="f_ranap" value="Resume Pulang" class="text" onclick="newsubmitform (document.getElementById('ranap4'),'ranap/form_ranap.php','loadform',validatetask); return false;"/>
        </form>
    </td>
    <td>
        <form id="ranap5" name="ranap5" method="post" action="ranap/form_ranap.php">
          <input type="hidden" name="id_admission" value="<?php echo $id_admission;?>" />
          <input type="hidden" name="nomr" value="<?php echo $nomr;?>" />
          <input type="hidden" name="noruang" value="<?php echo $noruang;?>" />
          <input type="hidden" name="kelas" value="<?php echo $kelas;?>" />
          <input type="hidden" name="kddokter" value="<?php echo $kddokter;?>" />
          <input type="hidden" name="kdpoly" value="<?php echo $kdpoly;?>" />
          <input type="hidden" name="masukrs" value="<?php echo $masukrs;?>" />
          <input type="hidden" name="jk" value="<?php echo $jk;?>" />
                <input type="submit"  name="f_ranap" value="Kamar Operasi" class="text" onclick="newsubmitform (document.getElementById('ranap5'),'ranap/form_ranap.php','loadform',validatetask); return false;"/>
        </form>
    </td>
  </tr>
</table>


<div id="loadform">
    <?php if(!empty($_GET['makan'])){
     include("form_perm_makan.php");
    } ?>
</div>


     </fieldset>
</div>
</div>