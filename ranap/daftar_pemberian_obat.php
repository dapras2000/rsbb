<? 
session_start();
include("../include/connect.php"); 
include("../include/function.php"); 
?> 
 
 <? if(isset($_GET['edit'])){ 
				$sql_rsm_pulang="SELECT * FROM t_pemberianobat WHERE IDXBERIOBAT = '".$_GET['idxberiobat']."'";
				$get_rsm_pulang =  mysql_query($sql_rsm_pulang);
				$dat_rp = mysql_fetch_assoc($get_rsm_pulang); 
				$_POST['id_admission'] = $dat_rp['IDXRANAP'];
				$_POST['nomr'] = $dat_rp['NOMR'];
				$_POST['kddokter'] = $dat_rp['DOKTER'];
				?>
<form action="ranap/save_pemberian_obat.php" name="pemberian_obat" method="post" id="pemberian_obat">
			<? echo '<input type="hidden" name="idxberiobat" value="'.$dat_rp['IDXBERIOBAT'].'" />';
				echo '<input type="hidden" name="tanggal" value="'.$dat_rp['TANGGAL'].'" />';
			} else { ?>
<form action="ranap/save_pemberian_obat.php" name="pemberian_obat" method="post" id="pemberian_obat">
<? } ?>
<!--<input type="text" name="id_admission" value="<?php echo $userdata['id_admission'];?>" />
<input type="text" name="nomr" value="<?php echo $userdata['nomr'];?>" />
<input type="text" name="noruang" value="<?php echo $userdata['noruang'];?>" />
<input type="text" name="kddokter" value="<?php echo $userdata['kddokter'];?>" />-->
<input type="hidden" name="id_admission" value="<?php echo $id_admission;?>" />
<input type="hidden" name="nomr" value="<?php echo $nomr;?>" />
<input type="hidden" name="noruang" value="<?php echo $noruang;?>" />
<input type="hidden" name="kelas" value="<?php echo $kelas;?>" />
<input type="hidden" name="kddokter" value="<?php echo $kddokter;?>" />
<input type="hidden" name="kdpoly" value="<?php echo $kdpoly;?>" />
<input type="hidden" name="masukrs" value="<?php echo $masukrs;?>" />
<input type="hidden" name="jk" value="<?php echo $jk;?>" />

<table  border="0" class="tb" width="95%">
  <tr>
    <td width="26%">Kategori Jenis Obat</td>
    <td width="54%">
      <select name="jenis_obat" class="text">
      	<option value="-pilih-">-pilih-</option>
        <option value="1" <? if($dat_rp['JENIS']=="1") echo "selected=Selected";?>>Antibiotika (Oral)</option>
        <option value="2" <? if($dat_rp['JENIS']=="2") echo "selected=Selected";?>>Obat-Obatan (Oral) Lainnya</option>
        <option value="3" <? if($dat_rp['JENIS']=="3") echo "selected=Selected";?>>Obat - Obatan Suntik</option>
        <option value="4" <? if($dat_rp['JENIS']=="4") echo "selected=Selected";?>>Peralatan Medik</option>
        <option value="5" <? if($dat_rp['JENIS']=="5") echo "selected=Selected";?>>Syrup</option>
        </select>
    </td>
    </tr>
  <tr>
    <td>Nama Obat</td>
    <td><input type="text" name="nama_obat" id="obat" class="text" size="60" value="<?=$dat_rp['NAMA']?>"  onkeypress="autocomplete_obat(this.value, event)" onblur="document.getElementById('autocompletedivobat');"  /></td>
    </tr>
  <tr>
    <td>Tanggal</td>
    <td><? if(isset($dat_rp['NAMA'])){ echo date('d/m/Y', strtotime($dat_rp['TANGGAL'])); }else{ echo date("d/m/Y"); } ?></td>
    </tr>
  <tr>
    <td>Waktu</td>
    <td><input type="radio" name="waktu" id="1" value="1" <? if($dat_rp['WAKTU']=="1")echo "Checked";?>/>
      Pagi
      <input type="radio" name="waktu" id="1" value="2" <? if($dat_rp['WAKTU']=="2")echo "Checked";?>/>
      Siang
      <input type="radio" name="waktu" id="1" value="3" <? if($dat_rp['WAKTU']=="3")echo "Checked";?>/>
      Sore
      <input type="radio" name="waktu" id="1" value="4" <? if($dat_rp['WAKTU']=="4")echo "Checked";?>/>
      Malam </td>
    </tr>
  <tr>
    <td valign="top">Keterangan</td>
    <td><textarea name="keterangan" id="keterangan" cols="45" rows="5" ><?=$dat_rp['KETERANGAN']?></textarea></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" size="50" name="simpan" value="Simpan" class="text" onclick="newsubmitform (document.getElementById('pemberian_obat'),'ranap/save_pemberian_obat.php','valid_pemberian_obat',validatetask); return false;"/></td>
    </tr>
    </table>
</form>    
<script>alert('test');</script>
<div id="valid_pemberian_obat">
<div id="autocompletedivobat" class="autocomp" align="left"></div>
<?php include("save_pemberian_obat.php"); ?>
</div>    
   