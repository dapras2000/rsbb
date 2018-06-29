<script language="javascript" type="text/javascript" src="../rajal/functions.js"></script>
<script language="javascript" type="text/javascript" src="../rajal/xmlhttp.js"></script>
<?
// edit ----------------------------------------------------------------------------------------------
include("../include/connect.php");


if(!empty($_POST['NIP'])){
	$qry = mysql_query("SELECT * FROM m_login WHERE nip ='".$_POST['NIP']."'")or die(mysql_error());
	$set = mysql_fetch_assoc($qry);
?>

<div align="center">
    <div id="frame" style="width:50%">
    	<div id="frame_title">
    	  <h3>FORM EDIT USER</h3></div>
        <div style="margin:5px;">
		<div id="val_pro"></div>
        	<form name="input_user" id="input_user" action="adm/valid_process.php" method="post">
            	<table width="90%" style="padding:10px;" title="Form Input User Baru" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="28%">NIP</td>
    <td width="43%"><input type="text" class="text" id="nip" value="<?php echo $set['NIP']; ?>" name="nip" size="25"></td>
    </tr>
  <tr>
    <td>New Password</td>
    <td><input type="text" class="text" id="pwd" value="<?php echo $set['PWD']; ?>" name="pwd" size="35"></td>
    </tr>
  <tr>
    <td> Confirm Password</td>
    <td><input type="text" class="text" id="pwd2" value="-new-" name="pwd2" size="35"></td>
    </tr>
  <tr>
    <td>Roles</td>
    <td>
    	<select name="roles" id="roles" class="text">
        	<option selected >
				<?php if($set['ROLES']=="1"){ 
							echo"Pendaftaran";
					 }elseif($set['ROLES']=="2"){
							echo"Pembayaran";
					 }elseif($set['ROLES']=="3"){
							echo"SDM";
					 }elseif($set['ROLES']=="4"){
							echo"Rawat Jalan";
					 }else{
						 echo"master roles belum terdaftar";
					 } 
			    ?>
            </option>
        	<option value="1">Pendaftaran</option>
        	<option value="2">Pembayaran</option>
        	<option value="3">SDM</option>
        	<option value="4">Rawat Jalan</option>
        </select>
    </td>
    </tr>
  <tr>
    <td>Kode Unit</td>
    <td align="left"><select name="kdunit" id="kdunit" class="text">
        	<option selected ><?php echo $set['KDUNIT'] ?></option>
        	<option value="1">Poly DALAM</option>
        	<option value="2">Poly KB dan KD</option>
        	<option value="3">Poly ANAK</option>
        	<option value="4">Poly BEDAH</option>
        	<option value="5">Poly GIGI</option>
        	<option value="6">Poly PSIKIATRI</option>
        	<option value="7">Poly NEUROLOGI</option>
        	<option value="8">Poly ANESTESI</option>
        	<option value="9">Poly UGD</option>
        	<option value="10">Poly VK</option>
        	<option value="11">Poly RUJUKAN</option>
        </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">
    <input type="hidden" name="edit" value="edit" />
    <input onClick="submitform(document.getElementById('input_user'),'adm/valid_process.php','val_pro',validatetask); return false;" type="Submit" name="simpan" value=" Simpan " class="text">
    </td>
    </tr>
</table>
 </form>
        </div>
	</div>
</div>

<?	} ?>