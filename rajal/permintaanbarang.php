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
<form name="addbarang" id="addbarang" method="post" action="rajal/addbarang.php" >
<table>
  <tr>
  <td>Tgl Permintaan</td>
  <td><input type="text" class="text" name="tgl" id="tgl" value="<?
  echo date('Y-m-d');
  ?>" /></td>
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
  <td><input type="text" class="text" name="jml_permintaan" id="jml_permintaan" value="1" /></td>
  </tr>
  
  <tr>
   <td colspan="2" ><input type="submit" class="text" value="A d d" onclick="newsubmitform (document.getElementById('addbarang'),'rajal/addbarang.php','validbarang',validatetask); document.getElementById('nm_barang').value = ''; document.getElementById('kd_barang').value = '';  document.getElementById('jml_permintaan').value = '1'; return false;" /></td> 
  </tr>
 </table>
<input type="hidden" name="NIP" value="<?php echo $nip;?>" />
<input type="hidden" name="KDPOLY" value="<?php echo $kdpoly;?>" />

</form>
</fieldset>
<div id="autocompletediv" class="autocomp"></div>
<div id="validbarang" ></div>
