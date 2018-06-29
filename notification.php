<?php if($_SESSION['ROLES']=="15" || $_SESSION['ROLES']=="7"){ ?>
<div id="notification" style="background-color:#FFF;">
	<div id="notificationClose" style="background:url(img/bg_frame_title.png) repeat-x;">
    	<h3>Notification message<div style="float:right">X</div></h3>
	</div>
    <div style="border-bottom:1px dashed #999; padding:2px;">Request :</div>
<div id="notificationIn"></div>
</div>
<? }  ?>

<div id="chat1" style="background-color:#FFF;">
   			<div id="d3" style="display:none;">
            	<div style=" background:#CCC; width:200px;border:1px solid #666; padding:10px;">
        				<? #include("chat/chat.html"); ?>
                </div>
        	</div>
</div>