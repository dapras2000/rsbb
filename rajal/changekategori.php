<?php
if(!empty($_GET['gudang'])){
?>
<select class="text" name="grpbarang" id="grpbarang" >
   <option value="1" >Obat</option>
   <option value="2" >Alat Kesehatan Habis Pakai</option>
   <option value="3" >Bahan Radiologi</option>
   <option value="4" >Gas</option>
   <option value="5" >Reagensia</option>
</select>
<?php
}
?>
<?php
if(!empty($_GET['logistik'])){
?>
<select class="text" name="grpbarang" id="grpbarang" >
   <option value="1" >ATK</option>
   <option value="2" >Cetakan</option>
   <option value="3" >ART</option>
   <option value="4" >Alat Bersih dan Pembersih</option>
   <option value="5" >Lain - Lain</option>
</select>
<?php
}
?>