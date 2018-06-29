<?php include("farmasi.php"); ?>
<div id="lapbarang" >
<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>Laporan Bulanan</h3></div>
<fieldset >
<legend>Filter Laporan Bulanan</legend>
<form name="filterlap" id="filterlap" method="get" >
<input type="hidden" name="link" value="f10" />
<table class="tb">
<tr>
     <td colspan="2" width="225">
       <input type="radio" class="text" name="r_barang" id="gudang" value="1" 
       onclick="javascript: MyAjaxRequest('grpbarangx','orderbarang/changegroup.php?gudang=gudang'); document.getElementById('gudang').checked(); return false;" />
       Farmasi
       <input type="radio" class="text" name="r_barang" id="logistik"  value="0" onclick="javascript: MyAjaxRequest('grpbarangx','orderbarang/changegroup.php?logistik=logistik'); document.getElementById('logistik').checked(); return false;"/>
       Umum
     </td>
  </tr>
   <tr>
     <td>Group Barang</td>
     <td><div id="grpbarangx"><select name="grpbarang" class="text">
     <option > -- </option>
     </select></div></td>
  </tr>
  
   <tr>
<?php
 $m = date('m');
?>
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
  $akhtahun = date('Y') - 20;
  $c = date('Y');
 ?>
   <td>Tahun</td>
   <td><select name="tahun" id="tahun" class="text" >
 <? while($akhtahun <= $c){ ?>  
   <option value="<?=$akhtahun?>" <? if($akhtahun == $c){ echo "selected=selected"; } ?>><?=$akhtahun?></option>
 <? $akhtahun++; } ?>  
   </select></td>
 </tr>
 <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
 </tr>
 <tr>
    <td>Nama Barang</td>
    <td><input type="text" name="nm_barang" /></td>
 </tr>

  <tr>
   <td><input type="submit" value="Open" class="text" /></td>
   <td></td>
 </tr>
</table>
</form>
</fieldset >
</div>
</div></div>