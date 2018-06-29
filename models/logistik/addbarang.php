<fieldset class='fieldset'>
<legend><?=$title?></legend>

<form name="frmbarang" id="frmbarang" action="logistik/savebarang.php" method="post" >
<table class="tb">
 <tr>
   <td>Kode Barang</td>
   <td><input type="text" name="kdbarang" value="<?=$kdbarang?>" readonly="readonly" class="text" /></td>
 </tr>
 <tr>
   <td>Nama</td>
   <td><input type="text" name="nmbarang" value="<?=$nmbarang?>" class="text" style="width:250px"/></td>
 </tr>
 <tr>
   <td>Group</td>
   <td><select name="grpbarang" id="grpbarang" class="text">
   <option value="1" <? if($group == "1") echo "selected=selected" ?> >ATK</option>
   <option value="2" <? if($group == "2") echo "selected=selected" ?> >Cetakan</option>
   <option value="3" <? if($group == "3") echo "selected=selected" ?> >ART</option>
   <option value="4" <? if($group == "4") echo "selected=selected" ?> >Alat Bersih dan Pembersih</option>
   <option value="5" <? if($group == "5") echo "selected=selected" ?> >Lain - Lain</option>
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
  <td><input type="submit" class="text" value="Simpan" onclick="	submitform(document.getElementById('frmbarang'),'logistik/savebarang.php','addbarang',validatetask); return false;
  " /></td>
 </tr>
</table>
</form>
</fieldset>
