<?php
include("farmasi.php");
$myquery = "SELECT 
  m_login.NIP,
  m_login.DEPARTEMEN,
  m_login.KDUNIT
FROM
  m_login
WHERE  m_login.NIP='".$_SESSION['NIP']."'";
$get = mysql_query ($myquery)or die(mysql_error());
$userdata = mysql_fetch_assoc($get); 		
$nip=$userdata['NIP'];
$kdunit=$userdata['KDUNIT'];
$bagian=$userdata['DEPARTEMEN'];
?>
<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>PERENCANAAN PENGADAAN BARANG</h3></div>
        <div align="left" style="margin:5px;">

			<form name="addbarang" id="addbarang" method="post" action="orderbarang/addbarangpengadaan.php" >
				<fieldset class="fieldset">
                
                    <table class="tb" align="left">
                        <tr>
                            <?php
                            $akhtahun = date('Y') + 5;
                            $c = date('Y');
                            ?>
                            <td>Tahun</td>
                            <td><select name="tahun" id="tahun" class="text" >
                                    <? while($c <= $akhtahun) { ?>
                                    <option value="<?=$c?>" ><?=$c?></option>
                                        <? $c++;
} ?>  
                                </select></td>
                        </tr>
                        <tr>
                            <td colspan="2" width="225">Ke &nbsp;
                                <input type="radio" class="text" name="r_barang" id="gudang" value="G"
                                       onclick="javascript: MyAjaxRequest('grpbarangx','orderbarang/changegroup.php?gudang=gudang'); document.getElementById('gudang').checked(); return false;" />
                                Gudang Farmasi
                                <input type="radio" class="text" name="r_barang" id="logistik"  value="L" onclick="javascript: MyAjaxRequest('grpbarangx','orderbarang/changegroup.php?logistik=logistik'); document.getElementById('logistik').checked(); return false;"/>
                                Gudang Umum
                            </td>
                        </tr>
                        <tr>
                            <td>Group Barang</td>
                            <td><div id="grpbarangx"><select name="grpbarang" class="text">
                                        <option > -- </option>
                                    </select></div></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td><input type="text" class="text" name="nm_barang"  id="nm_barang" style="width:200px" onkeypress="autocomplete_barang(this.value, event)"  onblur="document.getElementById('autocompletediv'); Efect.appear('autocompletediv'); "/></td>
                        </tr>
                        <tr>
                            <td>Kode Barang</td>
                            <td><input type="text" class="text" name="kd_barang" id="kd_barang" readonly="readonly"/></td>
                        </tr>
                        <tr>
                            <td>Jumlah Permintaan</td>
                            <td><input type="text" class="text" name="jml_permintaan" id="jml_permintaan" /></td>
                        </tr>

                        <tr>
                            <td colspan="2" ><input type="submit" class="text" value="A d d" 
							onclick="newsubmitform (document.getElementById('addbarang'),'orderbarang/addbarangpengadaan.php','validbarang',validatetask); 
							document.getElementById('tahun').value = '';
							document.getElementById('nm_barang').value = '';							
							document.getElementById('kd_barang').value = '';  
							document.getElementById('jml_permintaan').value = ''; return false;" /></td>
                        </tr>
                    </table>
					</fieldset>
                    <input type="hidden" name="NIP" value="<?php echo $nip;?>" />
                    <input type="hidden" name="KDUNIT" value="<?php echo $kdunit;?>" />

                </form>
            

            <div id="autocompletediv" class="autocomp"></div>
            <div id="validbarang" ></div>
        </div>
    </div>
</div>