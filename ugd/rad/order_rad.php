<p>
 Paket Radiodiagnostik &nbsp;
 <select name="s_paketrad" id="s_paketrad" onchange="javascript: MyAjaxRequest('paketrad','ugd/rad/change_paketrad.php?paket='+this.value+'&idx='+<?=$_GET['idx']?>); return false;" >
   <option value="-"> -- </option>
   <option value="1">Non Kelas III </option>
   <option value="2">Diluar Paket</option>
 </select>
</p>
<p>
  <div id="paketrad" >
  
  </div>
</p>
