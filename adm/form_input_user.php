<div align="center">
    <div id="frame" style="width:50%">
    	<div id="frame_title">
    	  <h3>FORM INPUT USER BARU</h3></div>
        <div style="margin:5px;">
		<div id="val_pro"></div>
        	<form name="input_user" id="input_user" action="adm/valid_process.php" method="post">
            	<table width="90%" style="padding:10px;" title="Form Input User Baru" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="28%">NIP</td>
    <td width="43%"><input type="text" class="text" id="nip" value="" name="nip" size="25"></td>
    </tr>
  <tr>
    <td>New Password</td>
    <td><input type="password" class="text" id="pwd" value="" name="pwd" size="35"></td>
    </tr>
  <tr>
    <td> Confirm Password</td>
    <td><input type="password" class="text" id="pwd2" value="" name="pwd2" size="35"></td>
    </tr>
  <tr>
    <td>Roles</td>
    <td><input type="roles" class="text" id="roles" value="" name="roles" size="35" />
    </td>
    </tr>
  <tr>
    <td>Kode Unit</td>
    <td align="left"><input type="kd_unit" class="text" id="kd_unit" value="" name="kd_unit" size="35" /></td>
  </tr>
  <tr>
    <td>Departemen</td>
    <td align="right"><input type="departemen" class="text" id="departemen" value="" name="departemen" size="35" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><input onClick="submitform(document.getElementById('input_user'),'adm/valid_process.php','val_pro',validatetask); return false;" type="Submit" name="simpan" value=" Simpan " class="text"></td>
    </tr>
</table>
 </form>
        </div>
	</div>
</div>