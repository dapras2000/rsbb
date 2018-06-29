<script src="include/date-functions.js" type="text/javascript"></script>
<script src="include/datechooser.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="include/datechooser.css"/>
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td width="24%" valign="top"></td><td width="46%">
          	<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
				<form  method="get" name="cariNama" >
                <input type="hidden" name="link" value="2f" />
			<tr>
      			<td colspan="3" background="img/frame_title.png" bgcolor="#FFFFFF">
                <div align="center"><strong><font color="#FFFFFF">Cari Berdasarkan Nama atau Nomor peserta</font></strong></div></td>
    		</tr>
    		<tr>
      			<td width="34%">&nbsp;</td>
      			<td width="3%">&nbsp;</td>
      			<td width="63%">&nbsp;</td>
    		</tr>
    		<tr>
      			<td width="34%">Asuransi</td>
      			<td width="3%">:</td>
      			<td width="63%">
					<select name="asuransi" id="asuransi"><option value="2">ASKES</option>
						<?php
							include"include/connect.php";
							$query="SELECT KODE, NAMA FROM m_carabayar";
                            $hasil=mysql_query($query);
                            while ($data=mysql_fetch_array($hasil)){
						?>
						<option value="<?php echo $data['KODE']; ?>" <?php if ($_GET['asuransi']==$data['KODE']) echo 'selected'?>><?php echo $data['NAMA']; ?></option>
						<?php } ?>
					</select>
				</td>
    		</tr>
    		<tr>
          		<td>Nama</td>
      			<td>:</td>
      			<td><input type="text" name="nama" id="nama" value="<?=$_GET['nama']?>"></td>
    		</tr>
    		<tr>
      			<td >Nomor Peserta</td>
      			<td>:</td>
      			<td><input id="nopeserta" name="nopeserta" type="text" value="<?=$_GET['nopeserta']?>"></td>
          	</tr>
    		<tr>
      			<td >Alamat</td>
      			<td>:</td>
      			<td><input id="alamat" name="alamat" type="text" value="<?=$_GET['alamat']?>"></td>
          	</tr>            
    		<tr>
      			<td>&nbsp;</td>
      			<td>&nbsp;</td>
      			<td><input type="submit" name="button" id="button" value="cari" /></td>
    		</tr>
    		<tr>
      			<td colspan="3" background="img/bg_menu_master.png" height="64"></td>
      		</tr>
				</form>   
		</table>
    
    </td>
    <td width="30%" valign="top">   
        </td>
  </tr>
</table>
<br /><br />
<?php 
 include("daftarCariAsuransi.php");
?>