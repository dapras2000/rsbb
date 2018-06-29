<?php
$sqlunit = "SELECT 
  			distinct m_login.DEPARTEMEN,
  			m_login.KDUNIT
			FROM m_login
			WHERE KDUNIT <> 0";
$qry_unit = mysql_query($sqlunit);			
?>
<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>LAPORAN STOK UNIT</h3></div>
        <div align="left" style="margin:5px;">
<fieldset >
<form name="filterlap" id="filterlap" method="get" >
<input type="hidden" name="link" value="g06" />
<table class="tb" align="left">
  </tr>
       <tr>
          <td>Unit&nbsp;</td>
          <td>
          <select name="unit" >
          <? while($unitx = mysql_fetch_array($qry_unit)) {?>
            <option value="<?=$unitx['KDUNIT']?>" 
            <? if($unitx['KDUNIT']==$unit){ echo "selected=selected"; }?>
            ><?=$unitx['DEPARTEMEN']?></option>
		  <? } ?>
          </select>
          </td>
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
   <td>Group Barang</td>
   <td><select name="group" id="group" class="text">
<? if($_SESSION['KDUNIT']=="12"){ ?>
   <option value="1" >Obat</option>
   <option value="2" >Alat Kesehatan Pakai Habis</option>
   <option value="3" >Bahan Radiologi</option>
   <option value="4" >Gas</option>
   <option value="5" >Reagensia</option>
<? }else if($_SESSION['KDUNIT']=="13"){ ?>
   <option value="1" >ATK</option>
   <option value="2" >Cetakan</option>
   <option value="3" >ART</option>
   <option value="4" >Alat Bersih dan Pembersih</option>
   <option value="5" >Lain - Lain</option>
<? } ?>
   
   </select></td>
 </tr>
 <tr>
   <td>Nama Barang</td>
   <td><input type="text" name="nm_barang" class="text" /></td>
 </tr>
  <tr>
   <td>&nbsp;</td>
   <td><input type="submit" value="Open" class="text" /></td>
 </tr>
</table>
</form>
</fieldset >
</div></div>
</div>