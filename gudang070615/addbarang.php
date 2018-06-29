<? session_start();?>
<fieldset class='fieldset' style="width:35%">
<legend><?=$title?></legend>
<table width="559">
<tr><td width="331">
<form name="myform" id="myform" action="gudang/savebarang.php" method="post" >
<table class="tb" height="200px">
 <tr>
   <td width="109">Kode Barang</td>
   <td width="210"><input type="text" name="kdbarang" value="<?=$kdbarang?>" readonly="readonly" class="text" /></td>
 </tr>
  <tr>
   <td>No Batch</td>
   <td><input type="text" name="no_batch" value="<?=$no_batch?>" class="text" /></td>
 </tr>
 <tr>
   <td>Nama</td>
   <td><input type="text" name="nmbarang" value="<?=$nmbarang?>" class="text" style="width:200px"/></td>
 </tr>
<tr>
         <td>Tgl Kadaluarsa</td>
          <td><input type="text" name="TGLLAHIR" id="TGLLAHIR" readonly="readonly" class="text" value="<?=$expiry?>" /><a href="javascript:showCal('Calendar1')"><img align="top" src="img/date.png" border="0" /></a></td>
</tr>

 <tr>
   <td>Group</td>
   <td><select name="grpbarang" id="grpbarang" class="text">
   <? if($_SESSION['KDUNIT']=="12"){ ?>
   <option value="1" <? if($group == "1") echo "selected=selected" ?> >Obat</option>
   <option value="2" <? if($group == "2") echo "selected=selected" ?> >Alat Kesehatan Pakai Habis</option>
   <option value="3" <? if($group == "3") echo "selected=selected" ?> >Bahan Radiologi</option>
   <option value="4" <? if($group == "4") echo "selected=selected" ?> >Gas</option>
   <option value="5" <? if($group == "5") echo "selected=selected" ?> >Reagensia</option>
   <? } else if($_SESSION['KDUNIT']=="13"){ ?>
   <option value="1" <? if($group == "1") echo "selected=selected" ?> >ATK</option>
   <option value="2" <? if($group == "2") echo "selected=selected" ?> >Cetakan</option>
   <option value="3" <? if($group == "3") echo "selected=selected" ?> >ART</option>
   <option value="4" <? if($group == "4") echo "selected=selected" ?> >Alat Bersih dan Pembersih</option>
   <option value="5" <? if($group == "5") echo "selected=selected" ?> >Lain - lain</option>
   <? } ?>
   </select></td>
 </tr>
 <tr>
   <td>Satuan</td>
   <td><input type="text" name="stbarang" value="<?=$satuan?>" class="text"/></td>
 </tr>
  <tr>
   <td>Harga</td>
   <td><input type="text" name="hrgbarang" value="<?=$harga?>" class="text"/></td>
 </tr>
 <tr>
  <td></td>
  <td><input type="submit" class="text" value="Simpan" onclick="	submitform(document.getElementById('myform'),'gudang/savebarang.php','addbarang',validatetask); return false;
  " /></td>
 </tr>
</table>
</form>
</td>
<td width="216">
<? if(!empty($kdbarang)){?>
<form name="uform" id="uform" action="gudang/savebarangunit.php" method="post" >
   <table width="220" class="tb" height="200px" >
   <tr><td width="109">
<?
$sql_c = "SELECT sum((kode_barang * (1 - abs(sign((KDUNIT - 14)))))) AS DEPO, 
		 sum((kode_barang * (1 - abs(sign((KDUNIT - 10)))))) AS VK, 
		 sum((kode_barang * (1 - abs(sign((KDUNIT - 3)))))) AS ANAK, 
		 sum((kode_barang * (1 - abs(sign((KDUNIT - 15)))))) AS OK, 
		 sum((kode_barang * (1 - abs(sign((KDUNIT - 4)))))) AS BEDAH,
		 sum((kode_barang * (1 - abs(sign((KDUNIT - 16)))))) AS LAB,
		 sum((kode_barang * (1 - abs(sign((KDUNIT - 2)))))) AS BIDAN,
		 sum((kode_barang * (1 - abs(sign((KDUNIT - 17)))))) AS RAD,
		 sum((kode_barang * (1 - abs(sign((KDUNIT - 20)))))) AS JIWA,
		 sum((kode_barang * (1 - abs(sign((KDUNIT - 22)))))) AS LAUNDRY,
		 sum((kode_barang * (1 - abs(sign((KDUNIT - 1)))))) AS DALAM,
		 sum((kode_barang * (1 - abs(sign((KDUNIT - 18)))))) AS GIZI,
		 sum((kode_barang * (1 - abs(sign((KDUNIT - 5)))))) AS GIGI,
		 sum((kode_barang * (1 - abs(sign((KDUNIT - 19)))))) AS RANAP,
		 sum((kode_barang * (1 - abs(sign((KDUNIT - 7)))))) AS SARAF,
		 sum((kode_barang * (1 - abs(sign((KDUNIT - 21)))))) AS PERINA, 
		 sum((kode_barang * (1 - abs(sign((KDUNIT - 9)))))) AS UGD
		 FROM m_barang_unit 
		 WHERE kode_barang = ".$kdbarang;
$get_c = mysql_query($sql_c);
$dat_c = mysql_fetch_assoc($get_c);
?>
   <input type="checkbox" name="brunit14" value="14" <? if(!empty($dat_c['DEPO'])) echo "checked=checked"; ?>/>&nbsp;Depo</td><td width="99">
   <input type="checkbox" name="brunit10" value="10" <? if($dat_c['VK']>0) echo "checked=checked"; ?>/>&nbsp;VK</td></tr><tr><td>
   <input type="checkbox" name="brunit3" value="3" <? if($dat_c['ANAK']>0) echo "checked=checked"; ?>/>&nbsp;Anak</td><td>
   <input type="checkbox" name="brunit15" value="15" <? if($dat_c['OK']>0) echo "checked=checked"; ?>/>&nbsp;OK</td></tr><tr><td>
   <input type="checkbox" name="brunit4" value="4" <? if($dat_c['BEDAH']>0) echo "checked=checked"; ?>/>&nbsp;Bedah</td><td>
    <input type="checkbox" name="brunit16" value="16" <? if($dat_c['LAB']>0) echo "checked=checked"; ?>/>&nbsp;Lab</td></tr><tr><td>
   <input type="checkbox" name="brunit2" value="2" <? if($dat_c['BIDAN']>0) echo "checked=checked"; ?>/>&nbsp;Kebidanan</td><td>   
   <input type="checkbox" name="brunit17" value="17" <? if($dat_c['RAD']>0) echo "checked=checked"; ?>/>&nbsp;Radiologi
  </td></tr><tr><td>
   <input type="checkbox" name="brunit20" value="20" <? if($dat_c['JIWA']>0) echo "checked=checked"; ?>/>&nbsp;Jiwa</td><td>
   <input type="checkbox" name="brunit22" value="22" <? if($dat_c['LAUNDRY']>0) echo "checked=checked"; ?>/>&nbsp;Laundry</td></tr><tr><td>
   <input type="checkbox" name="brunit1" value="1" <? if($dat_c['DALAM']>0) echo "checked=checked"; ?>/>&nbsp;Dalam</td><td>  
   <input type="checkbox" name="brunit18" value="18" <? if($dat_c['GIZI']>0) echo "checked=checked"; ?>/>&nbsp;Gizi</td></tr><tr><td>
   <input type="checkbox" name="brunit5" value="5" <? if($dat_c['GIGI']>0) echo "checked=checked"; ?>/>&nbsp;Gigi</td><td>
   <input type="checkbox" name="brunit19" value="19" <? if($dat_c['RANAP']>0) echo "checked=checked"; ?>/>&nbsp;Rawat Inap</td></tr><tr><td>
   <input type="checkbox" name="brunit7" value="7" <? if($dat_c['SARAF']>0) echo "checked=checked"; ?>/>&nbsp;Saraf</td><td>
   <input type="checkbox" name="brunit21" value="21" <? if($dat_c['PERINA']>0) echo "checked=checked"; ?>/>&nbsp;Perina</td></tr><tr><td>   
   <input type="checkbox" name="brunit9" value="9" <? if($dat_c['UGD']>0) echo "checked=checked"; ?>/>&nbsp;UGD</td><td>
   
   <input type="hidden" name="kdbarang" value="<?=$kdbarang?>" /> 
   <input type="submit" class="text" value="Simpan" onclick="	newsubmitform(document.getElementById('uform'),'gudang/savebarangunit.php','addbarang',validatetask); return false;
  " /></td>
   </tr>
  
   </table>
</form>
<? }else{ ?>
&nbsp;
<? } ?>
</td>
<td>
     <form name="xform" id="xform" action="gudang/savebarangstok.php" method="post" >
       <table class="tb" >
          <tr>
             <td>&nbsp;</td><td>&nbsp;</td>
          </tr>
          <tr>
             <td>Stok</td><td><input type="text" class="text" name="stok" /></td>
          </tr>
          <tr>
             <td>&nbsp;</td>
             <td>
              <input type="hidden" name="kdbarang" value="<?=$kdbarang?>" /> 
             <input type="submit" class="text" value="Simpan" onclick="	newsubmitform(document.getElementById('xform'),'gudang/savebarangstok.php','addbarang',validatetask); return false;
  " /></td>
          </tr>
           <tr>
      <td>&nbsp;</td><td>&nbsp;</td>
   </tr>
       </table>
     </form>
</td>
</tr>
</table>
</fieldset>
