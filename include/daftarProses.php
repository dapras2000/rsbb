<SCRIPT LANGUAGE="JavaScript">
    function stopjam(){
var d = new Date();
var curr_hour = d.getHours();
var curr_min = d.getMinutes();
var curr_sec = d.getSeconds();
document.getElementById('stop_daftar').value=(curr_hour + ":" + curr_min+ ":" + curr_sec);
	}
</SCRIPT>


<?php  /*
function datediff($d1, $d2){  
$d1 = (is_string($d1) ? strtotime($d1) : $d1);  
$d2 = (is_string($d2) ? strtotime($d2) : $d2);  
$diff_secs = abs($d1 - $d2);  
$base_year = min(date("Y", $d1), date("Y", $d2));  
$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);  
return array( "years" => date("Y", $diff) - $base_year,  "months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,  "months" => date("n", $diff) - 1,  "days_total" => floor($diff_secs / (3600 * 24)),  "days" => date("j", $diff) - 1,  "hours_total" => floor($diff_secs / 3600),  "hours" => date("G", $diff),  "minutes_total" => floor($diff_secs / 60),  "minutes" => (int) date("i", $diff),  "seconds_total" => $diff_secs,  "seconds" => (int) date("s", $diff)  );  
 }  //$a = datediff("1979-02-07", "2009-08-24");  
//echo 'umur '.$a[years].' tahun '.$a[months].' bulan';             */
?>  




      <div id='msg'></div>
	<div id="list_data"></div>
    <fieldset class="fieldset"><legend>Identitas Pasien</legend>
      <table width="100%" border="0" cellpadding="0" cellspacing="0" title=" From Ini Berfungsi Sebagai Form Entry Data Pasien Baru.">
        <tr>
          <td width="20%">Nama Lengkap Pasien</td>
          <td width="56%"><input title="NAMA" class="text" type="text" <?php if($_POST['nama_lgkp']){ echo"value='".$_POST['nama_lgkp']."'";} ?> name="NAMA" size="30" value="<?=$m_pasien->NAMA?>" id="AWAL" /></td>
          <td width="24%" rowspan="11" valign="top"> Jenis Kelamin :<br />
            <input type="radio" name="JENISKELAMIN" value="L" <? if($m_pasien->JENISKELAMIN=="L" || $m_pasien->JENISKELAMIN=="l" || $_POST['JENISKELAMIN'] =="1")echo "Checked";?>/>
            Laki-laki<br />
            <input type="radio" name="JENISKELAMIN" value="P" <? if($m_pasien->JENISKELAMIN=="P" || $_POST['JENISKELAMIN'] =="2")echo "Checked";?>/>
            Perempuan<br />
            <br />
            Status Perkawinan :<br />
            
            <input type="radio" name="STATUS" value="1" <? if($m_pasien->STATUS=="1" || $_POST['KAWIN']=="1")echo "Checked";?>/>
            Belum Kawin<br />
            <input type="radio" name="STATUS" value="2" <? if($m_pasien->STATUS=="2" || $_POST['KAWIN']=="2")echo "Checked";?> />
            Kawin<br />
            <input type="radio" name="STATUS" value="3" <? if($m_pasien->STATUS=="3" || $_POST['KAWIN']=="3")echo "Checked";?>/>
            Janda / Duda<br /><br />
            
            Pendidikan Terakhir :<br />
            <input type="radio" name="PENDIDIKAN" value="1" <? if($m_pasien->PENDIDIKAN=="1" || $_POST['PENDIDIKAN']=="1" )echo "Checked";?> />
            SD<br />
            <input type="radio" name="PENDIDIKAN" value="2" <? if($m_pasien->PENDIDIKAN=="2" || $_POST['PENDIDIKAN']=="2" )echo "Checked";?> />
            SLTP<br />
            <input type="radio" name="PENDIDIKAN" value="3" <? if($m_pasien->PENDIDIKAN=="3" || $_POST['PENDIDIKAN']=="3" )echo "Checked";?> />
            SMU<br />
            <input type="radio" name="PENDIDIKAN" value="4" <? if($m_pasien->PENDIDIKAN=="4" || $_POST['PENDIDIKAN']=="4" )echo "Checked";?> />
            D3/Akademik<br />
            <input type="radio" name="PENDIDIKAN" value="5" <? if($m_pasien->PENDIDIKAN=="5" || $_POST['PENDIDIKAN']=="5" )echo "Checked";?> />
            Universitas<br /><br />
           
            Agama :<br />
             <input type="radio" name="AGAMA" value="1" <? if($m_pasien->AGAMA=="1" || $_POST['AGAMA']=="1" )echo "Checked";?> />
Islam<br />

<input type="radio" name="AGAMA" value="2" <? if($m_pasien->AGAMA=="2" || $_POST['AGAMA']=="2" )echo "Checked";?>/>
Kristen Protestan<br />

<input type="radio" name="AGAMA" value="3" <? if($m_pasien->AGAMA=="3" || $_POST['AGAMA']=="3" )echo "Checked";?>/>
Katholik<br />

<input type="radio" name="AGAMA" value="4" <? if($m_pasien->AGAMA=="4" || $_POST['AGAMA']=="4" )echo "Checked";?>/>
Hindu<br />

<input type="radio" name="AGAMA" value="5" <? if($m_pasien->AGAMA=="5" || $_POST['AGAMA']=="5" )echo "Checked";?>/>
Budha<br />

<input type="radio" name="AGAMA" value="6" <? if($m_pasien->AGAMA=="6" || $_POST['AGAMA']=="6"  || $_POST['AGAMA']=="7" )echo "Checked";?>/>
Lain - lain </td>
        </tr>
        <tr>
          <td>Tempat Tanggal Lahir</td>
          <td>Tempat
            <input type="text" value="<? if($m_pasien->TEMPAT || $_POST['tmpt_lhr']){ echo $_POST['tmpt_lhr'].$m_pasien->TEMPAT; }?>"  class="text" name="TEMPAT" size="15" />
            <input onblur="calage(this.value,'umur');" type="text" class="text" value="<? if($m_pasien->TGLLAHIR || $_POST['tgl_lhr']){ echo $_POST['tgl_lhr'].$m_pasien->TGLLAHIR; }?>" name="TGLLAHIR" id="TGLLAHIR" size="20" />            ex : 1999/09/29</td>
        </tr>
        <tr>
          <td>Umur Pasien</td>
          <td> 
          <?
		       $a = datediff($_POST['tgl_lhr'], date("Y/m/d"));
		  ?><span id="umurc">
          <input class="text" type="text" value="<?php echo $a[years].' tahun '.$a[months].' bulan '.$a[days].' hari'; ?>" name="umur" id="umur" size="45" />
          </span></td>
        </tr>
        <tr>
          <td valign="top">Alamat Pasien</td>
          <td colspan="1"><input name="ALAMAT" class="text" type="text" value="<? if($m_pasien->ALAMAT || $_POST['ALAMAT']){echo $_POST['ALAMAT'].$m_pasien->ALAMAT;} ?>" size="45" /></td>
        </tr>
        <tr>
          <td>Kelurahan</td>
          <td><input class="text" type="text" value="<? if($m_pasien->KELURAHAN || $_POST['KELURAHAN']){ echo $_POST['KELURAHAN'].$m_pasien->KELURAHAN;}?>" name="KELURAHAN" size="25" /></td>
        </tr>
        <tr>
          <td>Kecamatan</td>
          <td><input class="text" type="text" value="<? if($m_pasien->KECAMATAN || $_POST['KECAMATAN']){ echo $_POST['KECAMATAN'].$m_pasien->KECAMATAN;}?>" name="KECAMATAN" size="25" /><input type="hidden" value="<?=$_POST['KDKECAMATAN']?>" name="KDKECAMATAN" /></td>
        </tr>
        <tr>
          <td>Kota</td>
          <td><input class="text" value="<? if($m_pasien->KOTA || $_POST['KOTA']){echo $_POST['KOTA'].$m_pasien->KOTA;}?>" type="text" name="KOTA" size="25" /></td>
        </tr>
        <tr>
          <td>No Telepon / HP Pasien</td>
          <td><input  class="text" value="<? if($m_pasien->NOTELP || $_POST['NOTELP']){echo $_POST['NOTELP'].$m_pasien->NOTELP;}?>" type="text" name="NOTELP" size="25" /></td>
        </tr>
        <tr>
          <td>No KTP </td>
          <td><input  class="text" value="<? if($m_pasien->NOKTP || $_POST['nik']){echo $_POST['nik'].$m_pasien->NOKTP;}?>" type="text" name="NOKTP" size="25" /></td>
        </tr>
        <tr>
          <td>Nama Suami / Orang Tua Pasien</td>
          <td><input class="text" type="text" value="<? if($m_pasien->SUAMI_ORTU || $_POST['SUAMI_ORTU']){echo $_POST['SUAMI_ORTU'].$m_pasien->SUAMI_ORTU;}?>" name="SUAMI_ORTU" id="SUAMI_ORTU" size="25" /></td>
        </tr>
        <tr valign="top">
          <td valign="top">Pekerjaan Pasien / Orang Tua</td>
          <td><input class="text" type="text" value="<? if($m_pasien->PEKERJAAN || $_POST['pkrjn']){echo $_POST['pkrjn'].$m_pasien->SUAMI_ORTU;}?>" name="PEKERJAAN" size="25" /></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td colspan="2"><input type='hidden' name='stop_daftar' id='stop_daftar' /></td>
        </tr>
        <tr>
          <td colspan="3" align="right"><input type="submit" name="daftar" class="text" value="  S a v e  "
          onclick="stopjam();submitformpendaftaran(document.getElementById('myform'),'models/pendaftaran.php','msg',validatetask);
          document.getElementById('msgid').value=document.getElementById('msg').innerHTML;         
          if (document.getElementById('msgid').value=='.'){alert('Simpan Data Sukses');window.location='<?php echo _BASE_;?>index.php?link=2';return false;} else {return false;}"/></td>
        </tr>
      </table>
      <input type="text" id="msgid" name="msgid" style="border:1px #FFF solid; width:0px; height:0px;">
      <br>
    </fieldset>
    
   
  