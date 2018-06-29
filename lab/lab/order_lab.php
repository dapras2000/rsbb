<p>
 Pilih Paket Laboratorium &nbsp;
 <select name="s_paketlab" id="s_paketlab" onchange="javascript: MyAjaxRequest('paketlab','lab/lab/change_paketlab.php?paket='+this.value+'&idx='+<?=$_GET['idx']?>); return false;" >
   <option value="-"> -- </option>
   <option value="1" selected="selected">Non Kelas III </option>
   <option value="2">Diluar Paket</option>
   <option value="3">Paket Kelas III</option>
 </select>
</p>
<p>
  <div id="paketlab" >
  
  </div>
</p>
<script language="javascript" type="text/javascript" event="onload" >
    var vPaket = document.getElementById('s_paketlab');
    MyAjaxRequest('paketlab','lab/lab/change_paketlab.php?paket='+vPaket.value+'&idx='+<?=$_GET['idx']?>);
</script>
