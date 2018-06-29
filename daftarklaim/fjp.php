<div align="center">
<div id="frame">
	<div id="frame_title"><h3>Formulir Jaminan Pelayanan [FJP]</h3></div>
<?    
 $SQL = "SELECT A.NAMA, A.NOMR, A.NOTELP, A.NIP, A.TEMPAT, A.TGLLAHIR, 
		  CASE A.JENISKELAMIN 
			WHEN 'L' THEN 'LAKI-LAKI' 
			ELSE 'PEREMPUAN' 
		  END AS JENISKELAMIN, 
			   C.NAMADOKTER, 
		  (select nama from m_carabayar where kode = D.KDCARABAYAR) AS KDCARABAYAR, 
			   E.NAMA AS POLY 
		FROM t_pendaftaran D
		LEFT JOIN m_dokter C ON C.KDDOKTER=D.KDDOKTER
		INNER JOIN m_pasien A ON A.NOMR=D.NOMR  
		INNER JOIN m_poly E ON D.KDPOLY=E.kode
		WHERE D.IDXDAFTAR='".$_GET['idx']."' ";
		$QRY = mysql_query($SQL);
		$DATA = mysql_fetch_assoc($QRY);
?>
	<form action="index.php?link=14vfjp" method="post" name="form_fjp" id="form_fjp">
	<table cellspacing="1" cellpadding="1" border="0" class="tb">
	  <tr>
	    <td colspan="5"><img src="img/log.png" style="float:left">
      				<div style="letter-spacing:-1px; font-size:16px; font:bold;"><?=strtoupper($header1)?></div>
                    <div style="letter-spacing:-2px; font-size:24px; color:#666; font:bold;"><?=strtoupper($header2)?></div>
					<div><?=$header3?><br /><?=$header4?></div>
        </td>
      </tr>
	  <tr>
	    <td colspan="5"><hr style="margin:5px;" /></td>
      </tr>
	  <tr>
	    <td colspan="5"><h2>FORMULIR JAMINAN PELAYANAN (FJP)</h2></td>
      </tr>
	  <tr>
	    <td width="181">DATA PASIEN</td>
	    <td width="154"></td>
	    <td width="187"></td>
	    <td colspan="2">RINGKASAN PELAYANAN</td>
      </tr>
	  <tr>
	    <td>Nama Pasien</td>
	    <td><input type="text" class="text" name="NAMAPASIEN" <? if($DATA['NAMA']){ echo 'value="'.$DATA['NAMA'].'"'; }else{?>value="&lt;nama pasien&gt;"<? } ?> /></td>
	    <td></td>
	    <td width="101">Diagnosa Awal</td>
	    <td width="358"><input type="text" class="text" size="40" name="DIAGNOSAAWAL" <? if($DATA['DIAGNOSA']){ echo 'value="'.$DATA['DIAGNOSA'].'"'; }else{?>value="&lt;diagnosa utama&gt;"<? } ?> /></td>
      </tr>
	  <tr>
	    <td>Tempat Lahir</td>
	    <td colspan="2">
        <input type="text" class="text" name="TEMPATLAHIR"  <? if($DATA['TEMPAT']){ echo 'value="'.$DATA['TEMPAT'].'"'; }else{?>value="&lt;tempat lahir    pasien&gt;"<? } ?> /></td>
	    <td>Diagnosa Akhir</td>
	    <td>
        <input type="text" class="text"  size="40"  name="DIAGNOSAAKHIR" <? if($DATA['DIAGNOSA']){ echo 'value="'.$DATA['DIAGNOSA'].'"'; }else{?>value="&lt;diagnosa utama&gt;"<? } ?> /></td>
      </tr>
	  <tr>
	    <td>Tanggal Lahir</td>
	    <td><input type="text" class="text" name="TANGGALLAHIR" <? if($DATA['TGLLAHIR']){ echo 'value="'.$DATA['TGLLAHIR'].'"'; }else{?>value="&lt;DD/MM/YYYY&gt;"<? } ?> /></td>
	    <td></td>
	    <td></td>
	    <td>
        <input type="text" class="text" name="DSEKUNDER1" size="40" value=" &lt;diagnosa sekunder 1&gt; " /></td>
      </tr>
	  <tr>
	    <td>Usia</td>
	    <td colspan="2"><?php 
		  if ($DATA['TGLLAHIR']==""){
			  $a = datediff(date("Y/m/d"), date("Y/m/d"));
		  }
		  else {
		       $a = datediff($DATA['TGLLAHIR'], date("Y/m/d"));
		  }
		  ?>
          <input class="text" type="text" value="<?php echo 'umur '.$a[years].' tahun '.$a[months].' bulan '.$a[days].' hari'; ?>" name="umur" id="umur" size="45" /></td>
	    <td></td>
	    <td>
        <input type="text" class="text" name="DSEKUNDER2" size="40" value=" &lt;diagnosa sekunder 2&gt; " /></td>
      </tr>
	  <tr>
	    <td>Jenis kelamin</td>
	    <td colspan="2">
        <input type="text" class="text" name="JENISKELAMIN" <? if($DATA['JENISKELAMIN']){ echo 'value="'.$DATA['JENISKELAMIN'].'"'; }else{?>value="&lt;laki-laki/perempuan&gt;"<? } ?> /></td>
	    <td></td>
	    <td>
        <input type="text" class="text" name="DST" size="40" value=" &lt;dst&gt; " /></td>
      </tr>
	  <tr>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td>Tindakan Medis</td>
	    <td>
        <input type="text" class="text" name="TINDAKANMEDIS" size="40" value=" &lt;tindakan medis&gt; " /></td>
      </tr>
	  <tr>
	    <td colspan="2">DATA    KUNJUNGAN</td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td>No. Rekam Medis</td>
	    <td colspan="2">
        <input type="text" class="text" name="NOMR" <? if($DATA['NOMR']){ echo 'value="'.$DATA['NOMR'].'"'; }else{?>value="&lt;no rm; 6 digit&gt;"<? } ?> /></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td>Status Jaminan</td>
	    <td colspan="2">
        <input type="text" class="text" name="STATUSJAMINAN" <? if($DATA['KDCARABAYAR']){ echo 'value="'.$DATA['KDCARABAYAR'].'"'; }else{?> value="&lt;Jamkesmas/Jamkesda/SKTM/Lain-lain&gt;"<? } ?> /></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td colspan="2">DATA    PELAYANAN</td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td>Tanggal Pelayanan</td>
	    <td colspan="2">
        <input type="text" class="text" name="TGLPELAYANAN" value="<?=date("d-m-Y")?>" /></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td>Jenis Pelayanan</td>
	    <td colspan="2">
        <input type="text" class="text" name="JPELAYANAN" <? if($DATA['POLY']){ echo 'value="'.$DATA['POLY'].'"'; }else{?>value="&lt;IGD/Poliklinik/Ranap&gt;"<? } ?> /></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td colspan="2">Pasien/Keluarga    Pasien,</td>
	    <td>Petugas Verifikasi,</td>
	    <td></td>
	    <td>Dokter yg Memeriksa,</td>
      </tr>
	  <tr>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td></td>
	    <td>&nbsp;</td>
	    <td></td>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td></td>
	    <td>&nbsp;</td>
	    <td></td>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td><input type="text" class="text" name="NAMAPASIEN2" <? if($DATA['NAMA']){ echo 'value="'.$DATA['NAMA'].'"'; }else{?>value="&lt;nama pasien&gt;"<? } ?> /></td>
	    <td></td>
	    <td><u>
	      <input type="text" class="text" id="PETUGAS" name="PETUGAS" <? if($DATA['NIP']){ echo 'value="'.$DATA['NIP'].'"'; }else{?>value="&lt;nama petugas&gt;"<? } ?> />
	    </u></td>
	    <td></td>
	    <td><u>
	      <input type="text" class="text" name="NAMADOKTER"  <? if($DATA['NAMADOKTER']){ echo 'value="'.$DATA['NAMADOKTER'].'"'; }else{?>value="&lt;nama dokter poli/IGD&gt;"<? } ?> />
	    </u></td>
      </tr>
	  <tr>
	    <td colspan="2">No.    Tlp: 
        <input type="text" class="text" name="NOTELP" <? if($DATA['NOTELP']){ echo 'value="'.$DATA['NOTELP'].'"'; }else{?>value="&lt;no. tlp/hp&gt;" <? } ?>/></td>
	    <td></td>
	    <td></td>
	    <td>NIP.<u>
	      <input type="text" class="text" name="NIP" value="&lt;400 051 861&gt;" />
	    </u></td>
      </tr>
	  <tr>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td>Catatan:</td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td>dicetak oleh: 
        <input type="text" class="text" name="PETUGAS1" <? if($_SESSION['NIP']){ echo 'value="'.$_SESSION['NIP'].'"'; }else{ ?>value="&lt;id    input/petugas verifikasi&gt;"<? } ?> />	      
        <input type="text" class="text" name="JMLHCETAK" value="&lt;dicetak 4 kali&gt;" /></td>
      </tr>
	  <tr>
	    <td colspan="4">berkas    I; bagian verifikasi, berkas II; laboratorium, berkas III; radiologi, berkas    IV; farmasi</td>
	    <td>waktu cetak:    
<input type="text" class="text" name="WAKTU" value="<?=date("d-m-Y H:i")?>" />
WIB</td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td><input type="hidden" name="IDXDAFTAR" value="<?=$_GET['idx']?>" /></td>
	    <td>
        	<span id="v_fjp">
					<input class="text" type="submit" value="Simpan" />             
             <!--<input class="text" type="submit"onclick="newsubmitform (document.getElementById('form_fjp'),'daftarklaim/valid_fjp.php','v_fjp',validatetask); return false;" value="Simpan" />-->
            </span>
        </td>
      </tr>
    </table>
    </form>
</div>
</div>

