<?
$idxdaftar = $_GET['idx'];
$sql="SELECT A.NOMR,A.NAMA,A.ALAMAT,A.TGLLAHIR,B.NAMA AS POLY1,C.NAMA AS CARABAYAR1,D.NAMA AS RUJUKAN1, E.TGLREG,SHIFT,DR.NAMADOKTER,
  	            case PASIENBARU when 1 then 'B' else 'L' end as B_L,E.IDXDAFTAR ,E.KDPOLY
	      FROM m_pasien A, m_poly B, m_carabayar C, m_rujukan D, t_pendaftaran E 
  		  LEFT JOIN m_dokter DR on DR.KDDOKTER=E.KDDOKTER
          WHERE A.NOMR=E.NOMR AND E.KDPOLY=B.KODE AND E.KDRUJUK=D.KODE AND E.KDCARABAYAR=C.KODE AND E.IDXDAFTAR = $idxdaftar";
$get_pasien = mysql_query($sql);
$dat_pasien = mysql_fetch_assoc($get_pasien);
?>
<div align="center">
  <table width="991" border="0" cellspacing="0" class="tb">
    <tr>
      <td colspan="3"><div align="center">SURAT RUJUKAN</div></td>
    </tr>
    <tr>
      <td width="208">&nbsp;</td>
      <td width="316">&nbsp;</td>
  <? $tgl = date("d M Y")?>    
      <td width="410">Jakarta, <?=$tgl?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Kepada </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Yth. TS &nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="text" name="kepada1" class="text" style="width:300px" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="text" name="kepada2" class="text" style="width:300px" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>di Tempat</td>
    </tr>
    <tr>
      <td>Dengan hormat,</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Bersama ini kami kirimkan</td>
      <td colspan="2"><input type="text" name="kirim" class="text" style="width:615px" /></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td colspan="2"><?=$dat_pasien['NAMA']?></td>
      
    </tr>
    
 <?php 
		  if ($dat_pasien['TGLLAHIR']==""){
			  $a = datediff(date("Y/m/d"), date("Y/m/d"));
		  }
		  else {
		       $a = datediff($dat_pasien['TGLLAHIR'], date("Y/m/d"));
		  }
		  ?>    
    
    <tr>
      <td>Umur</td>
      <td colspan="2"><?php echo $a[years].' tahun '.$a[months].' bulan '.$a[days].' hari'; ?></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td colspan="2"><?=$dat_pasien['ALAMAT']?></td>
    </tr>
    <tr>
      <td>Dengan gejala (suspek)</td>
      <td colspan="2"><input type="text" name="gejala" class="text" style="width:615px" /></td>
    </tr>
    <tr>
      <td>Telah kami lakukan tindakan</td>
      <td colspan="2" rowspan="3"><textarea name="tindakan" cols="75" rows="5"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Dan telah diberi terapi</td>
      <td colspan="2" rowspan="3"><textarea name="terapi" cols="75" rows="5"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">Demikian mohon consult dan perawatan selanjutnya.</td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">Terima kasih</div></td>
      <td>Salam sejawat</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Dokter yang mengirim.</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div align="right"><a href="rujukan/print_surat_rujukan.php?idx=<?=$_GET['idx']?>" >
        <input type="button" value="Print Surat Rujukan" class="text"/>
      </a></div></td>
    </tr>
  </table>
</div>
