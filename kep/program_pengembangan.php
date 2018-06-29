<?php
$sql	= mysql_query('select * from m_perawat where NIP = "'.$_REQUEST['NIP'].'" and IDPERAWAT = "'.$_REQUEST['PERID'].'"');
$data	= mysql_fetch_array($sql);
?>
<div align="center">
  <div id="frame">
  <div id="frame_title"><h3 align="left">PROGRAM PENGEMBANGAN</h3></div>
	<div id="all">
    <form name="myform" id="myform" action="./kep/edit_pengembangan.php" method="post">
    
	<div id="list_data"></div>
    <fieldset class="fieldset"><legend>Program Pengembangan Tenaga Perawat Formal dan Informal</legend>
      <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td>No Induk Pegawai</td>
              <td colspan="3"><?=$data['NIP']?><input class="text" value="<?=$data['NIP']?>" type="hidden" name="NIP" id="NIP" size="25" >
              <input class="text" value="<?=$data['IDPERAWAT']?>" type="hidden" name="IDPERAWAT" id="IDPERAWAT" >
              </td>              
            </tr>
            <tr>
          <td width="10%">Nama Lengkap</td>
          <td width="5%"><?=$data['NAMA']?></td>
          <td width="22%" colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top">Pendidikan Terakhir</td>
          <td colspan="4">
			<? if($data['PENDIDIKAN']=="1")echo "SPK";
				else if($data['PENDIDIKAN']=="2")echo "D III Keperawatan";
				else if($data['PENDIDIKAN']=="3")echo "Ners (S.Kp dan Ns.)";
				else if($data['PENDIDIKAN']=="4")echo "S2 Magister Keperawatan (Manajemen & Kepemimpinan)";
				else if($data['PENDIDIKAN']=="5")echo "Ners Spesialis";
				else if($data['PENDIDIKAN']=="6")echo "S3 Keperawatan";?>
		  </td>
        </tr>
        <tr>
          <td valign="top">Program peningkatan pendidikan formal keperawatan</td>
          <td colspan="4"><select name="PROGPENDIDIKAN" class="text">
            <option value="0"> --pilih-- </option>
			<? if($data['PENDIDIKAN']=="1"){ ?>
            <option value="1" <? if($data['PROGPENDIDIKAN']=="1")echo "selected=Selected";?> >DIII Keperawatan</option>
			<?} if($data['PENDIDIKAN']=="1" || $data['PENDIDIKAN']=="2"){ ?>
            <option value="2" <? if($data['PROGPENDIDIKAN']=="2")echo "selected=Selected";?> >S1 Keperawatan + Ners</option>
			<?} if($data['PENDIDIKAN']=="1" || $data['PENDIDIKAN']=="2" || $data['PENDIDIKAN']=="3"){ ?>
            <option value="3" <? if($data['PROGPENDIDIKAN']=="3")echo "selected=Selected";?> >S2 Keperawatan</option>
			<?} if($data['PENDIDIKAN']=="1" || $data['PENDIDIKAN']=="2" || $data['PENDIDIKAN']=="3" || $data['PENDIDIKAN']=="4"){ ?>
            <option value="4" <? if($data['PROGPENDIDIKAN']=="4")echo "selected=Selected";?> >Spesialis Keperawatan</option>
			<?} if($data['PENDIDIKAN']=="1" || $data['PENDIDIKAN']=="2" || $data['PENDIDIKAN']=="3" || $data['PENDIDIKAN']=="4" || $data['PENDIDIKAN']=="5"){ ?>
            <option value="5" <? if($data['PROGPENDIDIKAN']=="5")echo "selected=Selected";?> >S3 Keperawatan</option>
			<?}?>
		</select></td>
        </tr>
        <tr>
          <td valign="top">Program pengembangan tenaga perawat informal</td>
		  <?$valPROGPENG = split(",",$data['PROGPENG']); $iPROGPENG = 0;?>
          <td colspan="4"><input type="checkbox" name="PROGPENG[]" value="1" <? if($valPROGPENG[$iPROGPENG]=="1"){echo "Checked"; $iPROGPENG++;}?> />
            Pelatihan<br>
            <input type="checkbox" name="PROGPENG[]" value="2" <? if($valPROGPENG[$iPROGPENG]=="2"){echo "Checked"; $iPROGPENG++;}?> />
            Seminar / Workshop / Lokakarya<br>
            <input type="checkbox" name="PROGPENG[]" value="3" <? if($valPROGPENG[$iPROGPENG]=="3"){echo "Checked"; $iPROGPENG++;}?> />
            Inhouse training<br>
            <input type="checkbox" name="PROGPENG[]" value="4" <? if($valPROGPENG[$iPROGPENG]=="4"){echo "Checked"; $iPROGPENG++;}?> />
            Sosialisasi</td>
        </tr>
        <tr>
          <td colspan="5" align="right"><input type="submit" name="daftar" class="text" value="  S a v e  "/></td>
        </tr>
      </table>
    </fieldset>
  </form>
   </div>
  </div>
  </div>