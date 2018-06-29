<div align="center">
    <div id="frame" style="width:100%;">
    <div id="frame_title"><h3>ORDER LABORATORIUM</h3></div>
<?php 
include("../include/connect.php");
$sql = mysql_query('SELECT DISTINCT a.nomr,a.idxdaftar,a.tanggal,a.KDPOLY, a.DRPENGIRIM, a.NOLAB as nourut, 
CASE aps WHEN 1 THEN 
(SELECT nama FROM m_pasien_aps b WHERE b.NOMR=a.NOMR) 
ELSE 
(SELECT nama FROM m_pasien b WHERE b.NOMR=a.NOMR) END AS nama,
CASE aps WHEN 1 THEN
(SELECT alamat FROM m_pasien_aps b WHERE b.NOMR=a.NOMR) 
ELSE 
(SELECT alamat FROM m_pasien b WHERE b.NOMR=a.NOMR) END AS alamat,
CASE aps WHEN 1 THEN
(SELECT kdcarabayar FROM m_pasien_aps b WHERE b.NOMR=a.NOMR) 
ELSE 
(SELECT kdcarabayar FROM m_pasien b WHERE b.NOMR=a.NOMR) END AS KDCARABAYR,
CASE aps WHEN 1 THEN
(SELECT tgllahir FROM m_pasien_aps b WHERE b.NOMR=a.NOMR) 
ELSE 
(SELECT tgllahir FROM m_pasien b WHERE b.NOMR=a.NOMR) END AS TGLLAHIR,
CASE aps WHEN 1 THEN
(SELECT jeniskelamin FROM m_pasien_aps b WHERE b.NOMR=a.NOMR) 
ELSE 
(SELECT jeniskelamin FROM m_pasien b WHERE b.NOMR=a.NOMR) END AS JENISKELAMIN,
CASE aps WHEN 1 THEN
(SELECT c.nama FROM m_carabayar c , m_pasien_aps p WHERE c.kode=p.kdcarabayar AND a.nomr=p.nomr) 
ELSE 
(SELECT c.nama FROM m_carabayar c , m_pasien p WHERE c.kode=p.kdcarabayar AND a.nomr=p.nomr)  END AS CARABAYAR,
CASE rajal WHEN 1 THEN
(SELECT m_unit.nama_unit FROM m_unit WHERE m_unit.kode_unit = a.KDPOLY) 
ELSE 
(SELECT m_ruang.nama FROM m_ruang WHERE m_ruang.no = a.KDPOLY) 
  END AS poly_kelas,

 m_dokter.NAMADOKTER
FROM t_orderlab a
LEFT JOIN m_dokter ON m_dokter.KDDOKTER = a.DRPENGIRIM
where a.NOLAB = "'.$_REQUEST['nolab'].'"');

//where a.NOMR = "'.$_REQUEST['nomr'].'" and a.IDXDAFTAR = "'.$_REQUEST['idx'].'" and a.DRPENGIRIM = "'.$_REQUEST['drkirim'].'"');
$userdata	= mysql_fetch_array($sql);

?>
<fieldset class="fieldset">
      <legend>Identitas </legend>
<?php
?>    		

      
<table class="tb" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>No MR</td>
          <td width="80%"><?php echo $userdata['nomr'];?></td>
        </tr>
        <tr>
          <td width="21%">Nama Pasien</td>
          <td width="79%"><?php echo $userdata['nama'];?></td>
        </tr>
        <tr>
          <td valign="top">Alamat </td>
          <td><?php echo $userdata['alamat'];?></td>
        </tr>
        <tr>
          <td valign="top">Jenis Kelamin</td>
          <td colspan="2"><? if($userdata['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L"){echo"Laki-Laki";}elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P"){echo"Perempuan";} ?> <?php echo"( ". $userdata['JENISKELAMIN']." )";?></td>
          </tr>
        <tr>
          <td valign="top">Tanggal Lahir</td>
          <td>
            <?php echo $userdata['TGLLAHIR'];?>
          </td>
        </tr>
        <tr>
          <td valign="top">Umur</td>
          <td><?php
		  $a = datediff($userdata['TGLLAHIR'],date('Y-m-d'));
		  echo $a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; 
		  ?></td>
        </tr>
        <tr>
          <td valign="top">Cara Bayar</td>
          <td><?php echo $userdata['CARABAYAR'];?></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>

      </table>
    </fieldset>
    
<div id="addlab"></div>

<fieldset class="fieldset">
      <legend>Hasil Periksa</legend>
      
<div id="savelaborder" ></div>
<form id="inpLab" name="inpLab" method="post" action="lab/savelab.php">
    <table class="tb" width="100%">    
       <tr>
          <td>Dokter Pengirim</td>
          <td colspan="2" width="80%"><?php echo $userdata['NAMADOKTER']?></td>
       </tr>
        <tr>
          <td>Poly/Ruang Pengirim</td>
          <td colspan="2"><?php echo $userdata['poly_kelas']?></td>
       </tr>
       
        <tr>
          <td>Tanggal Registrasi</td>
          <td colspan="2"><?php echo $userdata['tanggal']?></td>
       </tr>
         <tr>
          <td>Jam Mulai</td>
          <td colspan="2"><div id="mulai" ><input type="text" name="jamMulai" id="jamMulai" class="text" style="width:150px" readonly="readonly" value="<?=$dat_jam['TANGGAL'];?>" />&nbsp;<input type="button" value="Skr" class="text" onclick="javascript: MyAjaxRequest('mulai','lab/getjam.php?mulai=1'); return false;" /></div></td>
       </tr>
         <tr>
          <td>Jam Selesai</td>
          <td colspan="2"><div id="selesai" ><input type="text" name="jamSelesai" id="jamSelesai" class="text" style="width:150px" readonly="readonly" />&nbsp;<input type="button" value="Skr"class="text" onclick="javascript: MyAjaxRequest('selesai','lab/getjam.php?selesai=1'); return false;"/></div></td>
       </tr>
         <tr>
           <td>Shift</td>
           <td colspan="2"><input type="radio" name="SHIF" value="1"  checked="checked"/> 1 <input type="radio" name="SHIF" value="2" /> 2 <input type="radio" name="SHIF" value="3" /> 3</td>
         </tr>
         <tr>
           <td>Petugas Laboratorium</td>
           <td colspan="2"><input type="text" name="petugas" id="petugas" class="text" style="width:200px"/></td>
         </tr>
          <tr>
           <td>No Lab</td>
           <td colspan="2"><input type="text" name="nolab" id="nolab" value="<?=$userdata['nourut']?>" class="text" style="width:200px" readonly="readonly"/></td>
         </tr>
        <tr>
           <td>Catatan</td>
           <td colspan="2"><textarea name="keterangan" cols="75" rows="5" ></textarea></td>
         </tr>
    </table>
    <br />
    
    <div id="orderlab" >
    <table class="tb" width="100%">
    <tr><th width="20px">No</th><th>Jenis Pemeriksaan</th><th width="150px">Hasil</th><th>Nilai Normal</th><th width="20px" >Unit</th><th>&nbsp;</th></tr>
    <?php
    $sql_d = mysql_query('SELECT a.IDXORDERLAB, a.KODE, a.IDXDAFTAR, a.HASIL_PERIKSA, a.KETERANGAN,a.TGL_MULAI, a.TGL_SELESAI, a.STATUS, a.KET, b.nama_tindakan, 
    a.TANGGAL 
    FROM t_orderlab a
    JOIN m_tarif2012 b ON (a.KODE = b.kode_tindakan)
    WHERE a.NOLAB = "'.$_REQUEST['nolab'].'"');
    if(mysql_num_rows($sql_d) > 0):
      //WHERE a.IDXDAFTAR = "'.$userdata['idxdaftar'].'" AND a.STATUS = 0 AND a.DRPENGIRIM = "'.$_REQUEST['drkirim'].'"');
		$i = 1;
		while($dlab	= mysql_fetch_array($sql_d)){
			echo '<tr>';
				echo '<td>'.$i.'</td>';
				echo '<td>'.$dlab['nama_tindakan'].'</td>';
				echo '<td><input type="text" name="hasil[]" class="text" style="width:100px" /></td>';
				$myquery1 = 'SELECT * from m_lab where nama_jasa = "'.trim($dlab['nama_tindakan']).'"';
				$get1 = mysql_query ($myquery1)or die(mysql_error());
				$data = mysql_fetch_assoc($get1);
				$tampungdata = "";
				if($userdata['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L"){
					if($a[years]<1){ $tampungdata = $data['nilai_normal_lk_bayi']; }
					else if($a[years]<5){ $tampungdata = $data['nilai_normal_lk_balita']; }
					else if($a[years]<18){ $tampungdata = $data['nilai_normal_lk_anak']; }
					else if($a[years]>=18){ $tampungdata = $data['nilai_normal_lk_dewasa']; }
				}elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P"){
					
					if($a[years]<1){ $tampungdata = $data['nilai_normal_pr_bayi']; }
					else if($a[years]<5){ $tampungdata = $data['nilai_normal_pr_balita']; }
					else if($a[years]<18){ $tampungdata = $data['nilai_normal_pr_anak']; }
					else if($a[years]>=18){ $tampungdata = $data['nilai_normal_pr_dewasa']; }
				}
				echo '<td><input type="text" name="nilainormal[]" value="'.$tampungdata.'" class="text" style="width:100px" /></td>';
				echo '<td><input type="text" name="unit[]" value="'.$data['unit'].'" class="text" style="width:100px" /></td>';
				echo '<td><input type="hidden" name="id[]" value="'.$dlab['IDXORDERLAB'].'"></td>';
			echo '</tr>';
			$i++;
		}
	endif;
    ?>
    </table>
    <input type="submit" value="S i m p a n"  class="text" />
    </form>
     </fieldset>
</div>
</div>
<script language="javascript" type="text/javascript" >
</script>