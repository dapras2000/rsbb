<? include("../include/connect.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="jquery.js" type="text/javascript" language="javascript"></script>
<script language="javascript">

$(document).ready(function()
{
	$("#login_form").submit(function()
	{
		$("#msgbox").removeClass().addClass('messagebox').text('Validasi user dan password....').fadeIn(1000);
		$.post("ajax_login.php",{ user_name:$('#username').val(),password:$('#password').val(),rand:Math.random() } ,function(data)
        {
		  if(data=='yes') 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  
			{ 
			  $(this).html('Logging in.....').addClass('messageboxok').fadeTo(900,1,
              function()
			  { 
				 document.location='secure.php';
			  });
			  
			});
		  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() 
			{ 
			  $(this).html('Login gagal. Periksa Kembali Username dan Password').addClass('messageboxerror').fadeTo(900,1);
			});		
          }
				
        });
 		return false; 
	});
	$("#password").blur(function()
	{
		$("#login_form").trigger('submit');
	});
});
</script>

<link href="master.css" type="text/css" rel="stylesheet" />
<div align="center">
<form method="post" action="" id="login_form">
<div style="width:500px; background-color:#FFF; border:1px solid #999; padding:5px; margin-top:80px;">	
	<div id="frame_title"><h3>LOGIN DATA MASTER </h3></div>
    <table width="100%" border="0">
  <tr>
    <td width="19%" rowspan="4" valign="top"><img src="img/log.png" /></td>
    <td width="19%">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div id="usr">USERNAME </div></td>
    <td><input class="text" type="text" id="username" size="35" name="username" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div id="pas">PASSWORD </div></td>
    <td width="39%"><input class="text" type="password" id="password" size="35" name="password" /></td>
    <td width="23%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td  align="right"><input name="Submit" type="submit" id="submit" value="Login"   /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="11" colspan="4" valign="top"><span id="msgbox" style="display:none"></span>     </td>
    </tr>
  <tr>
    <td colspan="4" align="center"><?=strtoupper($rstitle)?> OPENSOURCE <?=strtoupper($singhead1)?> &copy; <?php echo date('Y');?></td>
    </tr>
</table>
</div>
</form>
</div>
