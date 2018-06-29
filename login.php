<? include("include/connect.php"); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?= ucwords($rstitle)?></title>
<link href="dq_sirs.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="include/ajaxrequest.js"></script>
<script src="js/jquery-1.7.min.js" language="JavaScript" type="text/javascript"></script>
<SCRIPT>
function jumpTo (link){
   var new_url=link;
   if ((new_url != "")  &&  (new_url != null))
   window.location=new_url;
}

jQuery(document).ready(function(){
	jQuery("#NIP").keyup(function(event){
		if(event.keyCode == 13){
			MyAjaxRequest('valid_nip','include/process.php?NIP=','NIP');
			jQuery("#PWD").focus();
		}
	});
	
	jQuery("#PWD").keyup(function(event){		
		if(event.keyCode == 13){			
			//MyAjaxRequest('valid_pwd','include/process.php?PWD=','PWD');
			jQuery('#frm').submit();
		}
	});
});
</script>
</head>

<body>
<div id="header">
    <div id="bg_variation">
	<div id="logo">
    </div>
        <div id="info_header">
        	<div id="info_isi">
            <div><?=strtoupper($singrstitl)?> <?=strtoupper($singhead1)?></div>
             <div>
                <?php 
                if(isset($_SESSION['SES_REG'])){
                    echo '<a href="log_out.php">Sign Out</a> | User : '.$_SESSION['NIP'];  
                }else{
                    echo '<a href="login.php">Sign In</a> | guest';
                }
                ?>
            </div>
            <div class="date"><?php echo date("l, F Y"); ?></div>
			<div class="date">
				<?php
					if(isset($_SESSION['KDUNIT']) != ''):
						$dep  = "SELECT * FROM m_login WHERE KDUNIT = '".$_SESSION['KDUNIT']."' AND ROLES = '".$_SESSION['ROLES']."'"; 
						$qe   = mysql_query($dep);
						if($qe){
							$deps = mysql_fetch_assoc($qe);
							echo "<div><b>".$deps['DEPARTEMEN']."</b></div>";
						}
					endif;
				?>
             </div>
             </div>                        
        </div>
    </div>
</div>

<div id="container_master_bg">
<div id="container" style="height:300px">
<form name="frm" id="frm" action="user_level.php" method="post">
<?php
		
	if(isset($_POST['signin'])){
		require_once("login.php");
	} 
?>
<div align="center">
<div style="width:500px; background-color:#FFF; border:5px solid #39b54a; padding:5px; margin-top:80px;">	
	<div id="frame_title2"><h3>LOGIN FORM</h3></div>
    <table width="100%" border="0">


  <tr>
    <td width="19%" rowspan="6" valign="top"><img src="img/log.png" /></td>
    <td width="19%"><div id="usr">USERNAME </div></td>
    <td width="62%"><input class="text" id="NIP" type="text" size="25" name="USERNAME" onBlur="javascript: MyAjaxRequest('valid_nip','include/process.php?NIP=','NIP');return false;" /><span id="valid_nip"></span></td>
  </tr>
  <tr>
    <td><div id="pas">PASSWORD </div></td>
    <td><input class="text" type="password" id="PWD" size="25" name="PWD" /> <input type="button" value=" LOGIN " class=" text "  name="LOGIN" id="LOGIN" onclick="document.getElementById('frm').submit();"/><span id="valid_pwd"></span></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>


  <tr>
    <td colspan="2"><?=strtoupper($rstitle)?> OPEN SOURCE <?=strtoupper($singhead1)?> &copy; <?php echo date("Y"); ?></td>
    </tr>
</table>
</div>
</div>
</form>
</div>
</div>
<div id="fixed-footer">
    <div id="footer-inner">
      <ul class="footer-navigation">
            <li><a href=""><?= ucwords($rstitle)?> &copy; <?php echo date("Y"); ?></a></li>
      </ul>
    </div>
</div>
</body>
</html><div>
</div>