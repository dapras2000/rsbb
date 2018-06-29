<div id="idpasien" style="display:none">
   <fieldset class="fieldset">
      <legend>Identitas Pegawai</legend>
<?php
$myquery = "SELECT 
  m_login.NIP,
  m_login.DEPARTEMEN,
  m_login.KDUNIT
FROM
  m_login
WHERE  m_login.NIP='".$_SESSION['NIP']."'";
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get); 		
		$nip=$userdata['NIP'];
		$kdpoly=$userdata['KDUNIT'];
		$bagian=$userdata['DEPARTEMEN'];
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>User Id</td>
          <td><?php echo $nip;?></td>
        </tr>
        <tr>
          <td width="21%">Nama </td>
          <td width="79%"></td>
        </tr>
        <tr>
          <td valign="top">Bagian</td>
          <td><?php echo $bagian;?></td>
        </tr>
      </table>
    </fieldset>
</div>    
<fieldset class="fieldset">
      <legend>Permintaan Barang Baru </legend>
<form name="addbarang" id="addbarang" method="post" action="rajal/add_plan_pengadaan_barang.php" >
<?php
 $m = date('m') + 1;
?>
<table>
  <tr>
  <td>Bulan</td>
  <td><select name="bulan" id="bulan" class="text">
   <option value="1" <? if($m == "1"){ echo "selected=selected"; } ?> >Januari</option>
   <option value="2" <? if($m == "2"){ echo "selected=selected"; } ?> >Pebruari</option>
   <option value="3" <? if($m == "3"){ echo "selected=selected"; } ?> >Maret</option>
   <option value="4" <? if($m == "4"){ echo "selected=selected"; } ?> >April</option>
   <option value="5" <? if($m == "5"){ echo "selected=selected"; } ?> >Mei</option>
   <option value="6" <? if($m == "6"){ echo "selected=selected"; } ?> >Juni</option>
   <option value="7" <? if($m == "7"){ echo "selected=selected"; } ?> >Juli</option>
   <option value="8" <? if($m == "8"){ echo "selected=selected"; } ?> >Agustus</option>
   <option value="9" <? if($m == "9"){ echo "selected=selected"; } ?> >September</option>
   <option value="10" <? if($m == "10"){ echo "selected=selected"; } ?> >Oktober</option>
   <option value="11" <? if($m == "11"){ echo "selected=selected"; } ?> >Nopember</option>
   <option value="12" <? if($m == "12"){ echo "selected=selected"; } ?> >Desember</option>
   </select></td>
  </tr>
  <tr>
<?php
  $akhtahun = date('Y') + 5;
  $c = date('Y');
?>
   <td>Tahun</td>
   <td><select name="tahun" id="tahun" class="text" >
 <? while($c <= $akhtahun){ ?>  
   <option value="<?=$c?>" ><?=$c?></option>
 <? $c++; } ?>  
   </select></td>
 </tr>
  <tr>
     <td colspan="2" width="225">
       <input type="radio" class="text" name="r_barang" id="gudang" value="G" 
       onclick="javascript: MyAjaxRequest('grpbarangx','rajal/changekategori.php?gudang=gudang'); document.getElementById('gudang').checked(); return false;" />
       Gudang
       <input type="radio" class="text" name="r_barang" id="logistik"  value="L" onclick="javascript: MyAjaxRequest('grpbarangx','rajal/changekategori.php?logistik=logistik'); document.getElementById('logistik').checked(); return false;"/>
       Logistik
     </td>
  </tr>
   <tr>
     <td>Group Barang</td>
     <td><div id="grpbarangx"><select name="grpbarang" class="text">
     <option > -- </option>
     </select></div></td>
  </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
  </tr>
  <tr>
  <td>Nama Barang</td>
  <td><input type="text" class="text" name="nm_barang"  id="nm_barang" style="width:200px" onkeypress="autocomplete_permbarang(this.value, event)"  onblur="document.getElementById('autocompletediv'); Efect.appear('autocompletediv'); "/></td>
  </tr>
  <tr>
  <td>Kode Barang</td>
  <td><input type="text" class="text" name="kd_barang" id="kd_barang" readonly="readonly"/></td>
  </tr>
  <tr>
  <td>Jumlah Permintaan</td>
  <td><input type="text" class="text" name="jml_permintaan" id="jml_permintaan" /></td>
  </tr>
  
  <tr>
   <td colspan="2" ><input type="submit" class="text" value="A d d" onclick="newsubmitform (document.getElementById('addbarang'),'rajal/add_plan_pengadaan_barang.php','validbarang',validatetask); document.getElementById('nm_barang').value = ''; document.getElementById('kd_barang').value = '';  document.getElementById('jml_permintaan').value = ''; return false;" /></td> 
  </tr>
 </table>
<input type="hidden" name="NIP" value="<?php echo $nip;?>" />
<input type="hidden" name="KDPOLY" value="<?php echo $kdpoly;?>" />

</form>
</fieldset>
<div id="autocompletediv" class="autocomp"></div>
<div id="validbarang" ></div>
