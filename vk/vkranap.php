<div align="center">
    <div id="frame">
        <div id="frame_title"><h3>Pelayanan VK Rawat Inap</h3></div>
      	<fieldset class="fieldset">
      <legend>Identitas </legend>
<?php
  $myquery = "select a.nomr, a.kirimdari, a.dokterpengirim, a.masukrs, a.noruang, b.NAMA, b.ALAMAT, b.JENISKELAMIN, b.TGLLAHIR, c.NAMA as CARABAYAR, a.id_admission, a.noruang, d.NAMA as POLY, e.NAMADOKTER, f.kelas, f.nama AS nm_ruang, DATE_FORMAT(TGLLAHIR,'%d/%m/%Y') as TGLLAHIR1
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
?>


      
<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>No MR</td>
          <td>
<span style="float:right; position:relatif; left: 940px; top: 117px;">
    <a href="index.php?link=31s&amp;nomr=<?=$nomr?>&amp;idx=<?php echo $_GET['idx']; ?>"><input type="button" class="text" name="bayar" value="List Pembayaran" /></a>
    <!--<a href="index.php?link=31r&nomr=<?=$nomr?>&idx=<?php echo $_GET['id_admission']; ?>"><input type="button" class="text" name="bayar" value="Beban Jasa Rumah Sakit" /></a>-->
    <a href="index.php?link=5tindakanranap&amp;nomr=<?=$nomr?>&amp;idx=<?php echo $_GET['idx']; ?>"><input type="button" class="text" name="bayar" value="Jasa dan Tindakan Rumah Sakit" /></a>
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
      
</legend><div id="loadform">
    <?php if(!empty($_GET['makan'])){
     include("../ranap/form_perm_makan.php");
    } ?>
</div>

<form id="ranap" name="ranap" method="post" action="../ranap/ranap/form_ranap.php">
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
    <td width="39%"><input type="radio" name="f_ranap" value="Perjalanan Penyakit / Intruksi Dokter"/>
Perjalanan Penyakit / Intruksi Dokter</td>
    <td width="35%"><input type="radio" name="f_ranap" value="Daftar Pemberian Obat"/>
Daftar Pemberian Obat</td>
    <td width="26%"><input type="radio" name="f_ranap" value="Order Resep"/>
Order Resep </td>
  </tr>
  <tr>
    <td><input type="radio" name="f_ranap" value="Daftar Permintaan Makanan Pasien"/>
      Daftar Permintaan Makanan Pasien</td>
    <td><input type="radio" name="f_ranap" value="Resume Medis"/>
Resume Medis</td>
    <td><input type="radio" name="f_ranap" value="Order Rad"/>
Order Radiologi</td>
  </tr>
  <tr>
    <td><input type="radio" name="f_ranap" value="Rencana Keperawatan"/>
Rencana Keperawatan </td>
    <td><input type="radio" name="f_ranap" value="Resume Pulang"/>
Resume Pulang </td>
    <td><input type="radio" name="f_ranap" value="Order Lab"/>
Order Laboratorium</td>
  </tr>
  <tr>
    <td><input type="radio" name="f_ranap" value="Kamar Operasi"/>
Order Kamar Operasi </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<input type="submit" value=" P i l i h " class="text" onclick="newsubmitform (document.getElementById('ranap'),'ranap/form_ranap.php','loadform',validatetask); return false;"/>
</form>
     </fieldset>
  
	</div>
</div>