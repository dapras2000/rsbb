<?php
if(!empty($_GET['mulai'])){
?>	
	<input type="text" name="jamMulai" id="jamMulai" class="text" style="width:150px" value="<?=date("Y-m-d G:i:s")?>" />
	&nbsp;<input type="button" value="Skr" class="text" onclick="javascript: MyAjaxRequest('mulai','lab/getjam.php?mulai=1'); return false;" />
<?php
}
if(!empty($_GET['selesai'])){
?>
	<input type="text" name="jamSelesai" id="jamSelesai" class="text" style="width:150px" value="<?=date("Y-m-d G:i:s")?>" />
	&nbsp;<input type="button" value="Skr" class="text" onclick="javascript: MyAjaxRequest('selesai','lab/getjam.php?selesai=1'); return false;" />
<?
}
?>