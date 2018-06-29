<?  include("include/connect.php"); ?>
<p>
    Paket Radiodiagnostik &nbsp;
    <select name="s_paketrad" id="s_paketrad" onchange="javascript: MyAjaxRequest('paketrad','radiologi/rad/change_paketrad.php?paket='+this.value+'&idx='+<?=$_GET['idx']?>); return false;" >
        <option value="-"> -- </option>
        <option value="1" selected="selected">Non Kelas III </option>
        <option value="2">Diluar Paket</option>
    </select>
</p>
<p>
<div id="paketrad" >

</div>
</p>
<script language="javascript" type="text/javascript" event="onload" >
    var vPaket = document.getElementById('s_paketrad');
    MyAjaxRequest('paketrad','radiologi/rad/change_paketrad.php?paket='+vPaket.value+'&idx='+<?=$_GET['idx']?>);
</script>