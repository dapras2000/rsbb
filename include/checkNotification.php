<?php
include("include/connect.php");
	if($_GET[checkNum]){ // if your load with ?checkNum=1 you just want to check if there is anything new (this is for optimization)
		$q = mysql_query("select count(*) as nb from notification where status = 9 and roles='".$_POST['ROLES']."'") or die(mysql_error());
		$r = mysql_fetch_array($q);
		echo $r[nb];
	} else { // otherwhise you want to load the info about the newest notification to display and set the status to 1 so it wont be displayed again
		$q = mysql_query("select * from notification where status = 9 and roles='".$_POST['ROLES']."' order by id limit 1") or die(mysql_error());
		$r = mysql_fetch_array($q);
		mysql_query("update notification set status = 1 where id = $r[id]");
		echo $r[info];
	}


$filename="include/ArielBubur.mp3";

print '
<script>
function EvalSound(soundobj) {
var thissound=document.getElementById(soundobj);
thissound.Play();
}
</script>

<div class=Section1>

<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" width=0
height=0>
<param name="src" value="'.$filename.'">
<param name="scale" value="tofit">
<param name="controller" value="true">
<param name="autoplay" value="true">
<param name="loop" value="false">
<embed src="'.$filename.'" id="s001" scale=tofit width=1 height=1 align=center controller=false autoplay=true
loop=false enablejavascript=true
pluginspage="http://www.apple.com/quicktime/download/" type="video/quicktime"></EMBED></OBJECT>

</div>

';
?>