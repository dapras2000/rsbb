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
        <div id="frame_title"><h3>PENGEMBALIAN BARANG</h3></div>
        <div align="left" style="margin:5px;">
            <form name="terimabarang" id="terimabarang" action="orderbarang/addbarangpengembalian.php" method="post" >
                <fieldset class="fieldset">

                    <table class="tb" align="left">
                        <tr>
                            <td>Tgl Pengembalian</td>
                            <?php $tgl =  date("Y-m-d");?>
                            <td><input type="text" name="tglterima" value="<?=$tgl?>" readonly="readonly" class="text"/></td>
                        </tr>
                        <tr>
                            <td colspan="2" width="225">Jns Barang &nbsp;
                                <input type="radio" class="text" name="r_barang" id="gudang" value="G"
                                       onclick="javascript: MyAjaxRequest('grpbarangx','orderbarang/changegroup.php?gudang=gudang');
                                           MyAjaxRequest('ruang_x','orderbarang/changegroup.php?ruang_x=x'); MyAjaxRequest('ruang_h','orderbarang/changegroup.php?ruang_h=h');
                                           document.getElementById('gudang').checked(); return false;" />
                                Farmasi
                                <input type="radio" class="text" name="r_barang" id="logistik"  value="L" onclick="javascript: MyAjaxRequest('grpbarangx','orderbarang/changegroup.php?logistik=logistik');
                                    MyAjaxRequest('ruang_x','orderbarang/changegroup.php?ruang_x=x'); MyAjaxRequest('ruang_h','orderbarang/changegroup.php?ruang_h=h');
                                    document.getElementById('logistik').checked(); return false;"/>
                                Umum
                            </td>
                        </tr>
                        <tr>
                            <td>Group Barang</td>
                            <td><div id="grpbarangx"><select name="grpbarang" class="text">
                                        <option > -- </option>
                                    </select></div></td>
                        </tr>
                        <tr>
                            <td><div id="ruang_h">&nbsp;</div></td>
                            <td><div id="ruang_x">&nbsp;</div></td>
                        </tr><tr>
                            <td>Nama Barang</td>
                            <td><input type="text" name="nm_barang" id="nm_barang" onkeypress="autocomplete_barang(this.value, event)"  onblur="document.getElementById('autocompletediv'); Efect.appear('autocompletediv'); " class="text" style="width:200px"/></td>
                        </tr>
                        <tr>
                            <td>Kode Barang</td>
                            <td><input type="text" name="kd_barang"  id="kd_barang" class="text" readonly="readonly"/></td>
                        </tr>
                        <tr>
                            <td>No Batch</td>
                            <td><input type="text" name="no_batch"  id="no_batch" class="text" readonly="readonly"/></td>
                        </tr>
                        <tr>
                            <td>Tgl Kadaluarsa</td>
                            <td><input type="text" name="tgl_kadaluarsa"  id="tgl_kadaluarsa" class="text" readonly="readonly"/></td>
                        </tr>

                        <tr>
                            <td>Jumlah Pengembalian</td>
                            <td><input type="text" name="jml_barang" id="jml_barang" class="text" /></td>
                        </tr>
                        <tr>

                            <td><input type="submit" class="text" value="A d d" onclick="submitform (document.getElementById('terimabarang'),'orderbarang/addbarangpengembalian.php','validbarang',validatetask);
                                document.getElementById('kd_barang').value = ''; document.getElementById('nm_barang').value = '';
                                document.getElementById('jml_barang').value = ''; document.getElementById('no_batch').value = '';document.getElementById('tgl_kadaluarsa').value = '';
                                return false;"/></td>
                            <td></td>
                        </tr>
                    </table>
                </fieldset>
                <input type="hidden" name="idxdaftar" value="<?=$_GET['idx']?>" />
                <input type="hidden" name="NIP" value="<?php echo $nip;?>" />
                <input type="hidden" name="KDUNIT" value="<?php echo $kdunit;?>" />
            </form>

            <div id="autocompletediv" class="autocomp"></div>
            <div id="validbarang"></div>
        </div>
    </div>
</div>
