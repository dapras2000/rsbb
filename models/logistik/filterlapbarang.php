<div id="lapbarang" >
<fieldset >
<legend>Filter</legend>
<form name="filterlap" id="filterlap" method="post" action="logistik/lapbarang.php" >
<table class="tb">
 <tr>
<?php
 $m = date('m');
?>
  
   <td>Bulan</td>
   <td><select name="bulan" id="bulan" class="text">
   <option value="1" <? if($m == "01"){ echo "selected=selected"; } ?> >Januari</option>
   <option value="2" <? if($m == "02"){ echo "selected=selected"; } ?> >Pebruari</option>
   <option value="3" <? if($m == "03"){ echo "selected=selected"; } ?> >Maret</option>
   <option value="4" <? if($m == "04"){ echo "selected=selected"; } ?> >April</option>
   <option value="5" <? if($m == "05"){ echo "selected=selected"; } ?> >Mei</option>
   <option value="6" <? if($m == "06"){ echo "selected=selected"; } ?> >Juni</option>
   <option value="7" <? if($m == "07"){ echo "selected=selected"; } ?> >Juli</option>
   <option value="8" <? if($m == "08"){ echo "selected=selected"; } ?> >Agustus</option>
   <option value="9" <? if($m == "09"){ echo "selected=selected"; } ?> >September</option>
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
   <td>Group Barang</td>
   <td><select name="group" id="group" class="text">
   <option value="1" >ATK</option>
   <option value="2" >Cetakan</option>
   <option value="3" >ART</option>
   <option value="4" >Alat Bersih dan Pembersih</option>
   <option value="5" >Lain - Lain</option>
   </select></td>
 </tr>
  <tr>
   <td>&nbsp;</td>
   <td><input type="submit" value="Open" class="text" onclick="newsubmitform (document.getElementById('filterlap'),'logistik/lapbarang.php','lapbarang',validatetask); return false"/></td>
 </tr>
</table>
</form>
</fieldset >
</div>
