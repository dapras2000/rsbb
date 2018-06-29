<div align="center">
<div align="center" id="frame">
  <div id="frame_title"><h3>Form Surat Rujukan</h3></div>
  <? 
   // $SQL = "SELECT A.NAMA, A.NOMR, A.TGLLAHIR, CASE A.JENISKELAMIN WHEN 'L' THEN 'LAKI-LAKI' ELSE 'PEREMPUAN' END AS JENISKELAMIN, D.KDDOKTER,D.TGLREG, C.NAMADOKTER, E.NAMA AS POLY FROM m_pasien A, m_dokter C, t_pendaftaran D, m_poly E    WHERE A.NOMR=D.NOMR AND D.IDXDAFTAR='".$_GET['idx']."' AND C.KDDOKTER=D.KDDOKTER AND D.KDPOLY=E.kode";
 $SQL = "   SELECT A.NAMA, A.NOMR, A.TGLLAHIR, CASE A.JENISKELAMIN WHEN 'L' THEN 'LAKI-LAKI' ELSE 'PEREMPUAN' END AS JENISKELAMIN, 
       D.KDDOKTER,DATE_FORMAT(D.TGLREG,'%d/%m/%Y') AS TGLREG,  C.NAMADOKTER, E.NAMA AS POLY 
FROM t_pendaftaran D 
LEFT JOIN m_dokter C on D.KDDOKTER=C.KDDOKTER
INNER JOIN m_pasien A ON A.NOMR=D.NOMR 
INNER JOIN m_poly E ON D.KDPOLY=E.kode
WHERE D.IDXDAFTAR=".$_GET['idx'];

		$QRY = mysql_query($SQL);
		$DATA = mysql_fetch_assoc($QRY);

  ?>
<!--  <form name="rujukan" id="form_rujukan" action="index.php?link=14vrujukan" method="post">-->
 <form name="rujukan" id="form_rujukan" target='_blank' action="daftarklaim/valid_rujukan.php" method="post">
  <input type="hidden" value="<?=$_GET['idx']?>" name="IDXDAFTAR" />
  <input type="hidden" value="<?=$DATA['NOMR']?>" name="NOMR" />
  
  <table width="800" cellpadding="1" cellspacing="1" class="tb">
    <tr>
      <td width="137" rowspan="8"><img src="img/log.png"></td>
      <td colspan="2" rowspan="8">                    
      				<div style="letter-spacing:-1px; font-size:16px; font:bold;"><?=strtoupper($header1)?></div>
                    <div style="letter-spacing:-2px; font-size:24px; color:#666; font:bold;"><?=strtoupper($header2)?></div>
					<div><?=$header3?><br /><?=$header4?></div>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td colspan="5" align="left" valign="top"></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td colspan="5"><hr style="margin:5px;" /></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>Nomor</td>
      <td colspan="2">
      <input type="text" name="KODERS" class="text" size="10" value="445.1"> 
      <input type="text" name="NOSURAT" class="text" size="15">      
      <input type="text" name="BLN" class="text" size="7" <?php echo "value=".DATE('m') ?>>      
      <input type="text" name="THN" class="text" size="7" <?php echo "value=".DATE('Y') ?>>          
      <input type="text" name="RS" class="text" size="7" value="RSUD">
      </td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td>Yth. Teman Sejawat</td>
      <td colspan="2"><input type="text" value="" name="DOKTERRUJUK" size="20" class="text"></td>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td>Rumah Sakit</td>
      <td colspan="2"><input type="text" value="" name="RSRUJUK" size="20" class="text"></td>
      <td>&nbsp;</td>
      <td></td>
    </tr>
    <tr>
      <td>Di</td>
      <td colspan="2"><input type="text" value="" name="KOTARS" size="20" class="text"></td>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
    </tr> <td colspan="5">&nbsp;</td>
    <tr>
      <td colspan="5">Mohon pemeriksaan / pengobatan lebih lanjut untuk penderita</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td colspan="2">No. RM</td>
      <td colspan="3"><input type="text"  <? if(!empty($DATA['NOMR'])){ echo "value='".$DATA['NOMR']."'"; }else{ ?>value="<no rm>"<? } ?>  name="NOMR" size="20" class="text"></td>
      </tr>
    <tr>
      <td colspan="2">Nama Pasien</td>
      <td colspan="3"><input type="text"  <? if(!empty($DATA['NAMA'])){ echo "value='".$DATA['NAMA']."'"; }else{ ?>value="<nama pasien>"<? } ?> name="NAMA" size="20" class="text"></td>
      </tr>
      
    <tr>
      <td colspan="2">Umur </td>
      <td colspan="3">
	  <input type="hidden" value="<?=$DATA['TGLLAHIR']?>"? />
	  <?php
	  	
		  if ($DATA['TGLLAHIR']==""){
			  $a = datediff(date("Y/m/d"), date("Y/m/d"));
		  }
		  else {
		       $a = datediff($DATA['TGLLAHIR'], date("Y/m/d"));
		  }
		  ?>
          <input class="text" type="text" value="<?php echo 'umur '.$a[years].' tahun '.$a[months].' bulan '.$a[days].' hari'; ?>" name="umur" id="umur" size="45" /></td>
      </tr>
      <tr>
      <td colspan="2">Status Jaminan</td>
      <td colspan="3">
      <select name="crbayar" id="crbayar" class="text" >
             <option selected="selected" >-Pilih Jaminan-</option>
             <option >BPJS</option>
            <!-- <option >JAMKESDA DPK</option>
             <option >JAMKESDA BGR</option>
             <option >JAMKESMAS</option>-->
             </select>
        <label>No. Peserta :   </label>
        <input type="text"   name="PESERTA" size="20" class="text" /></td>
     </tr>
    <tr>
      <td colspan="2">Nama Kepala Keluarga </td>
      <td colspan="3"><input type="text"  name="KK" size="20" class="text"></td>
      </tr>
    <tr>
      <td colspan="2">Diagnosa Sementara</td>
      <td colspan="3"><input name="DIAGNOSA" type="text" class="text" size="60" />        
         </td>
      </tr>
    <tr>
      <td colspan="2">Keterangan</td>
      <td colspan="3"><input name="TERAPI" type="text" class="text" size="70" /></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td colspan="5">Atas bantuan sejawat kami ucapkan terimakasih</td>
    </tr>
    <tr>
      <td></td>
      <td width="29"></td>
      <td width="395"></td>
      <td width="52"></td>
      <td width="169"></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td>Jakarta</td>
      <td><u>
        <input type="text" name="tglreg" size="15" class="text"  <? if(!empty($DATA['TGLREG'])){ echo "value='".$DATA['TGLREG']."'"; }else{ ?>value=<?=date('d/m/Y');} ?> >
      </u></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td colspan="2"><?=strtoupper($singhead1)?></td>
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
      <td></td>
      <td></td>
      <td></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td colspan="2"><u>
        dr 
        <input type="text" name="DOKTER2" size="15" class="text" />
      </u></td>
    </tr>
    <tr>
      <td colspan="2"><span id="v_rujukan">
      <input class="text" type="submit" value="Simpan" /></span>  
      </td>
      <td></td>
      <td colspan="2">NIP. 
        <input type="text"   name="NIP2" size="20" class="text"></td>
    </tr>
  </table>
</form>  
</div>
</div>

