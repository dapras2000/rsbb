<div align="center">
    <div id="frame" style="width:100%;">
    <div id="frame_title"><h3>ORDER LABORATORIUM</h3></div>
<?php 
include("../include/connect.php");

$idx_daftar = $_GET["idx"];

$sql = 'SELECT distinct b.kode_gruptindakan, b.nama_gruptindakan FROM t_orderlab a JOIN m_tarif2012 b ON (a.KODE = b.kode_tindakan) WHERE a.IDXDAFTAR = "'.$idx_daftar.'" AND a.STATUS = 1 order by b.kode_gruptindakan';
			  
$row = mysql_query($sql)or die(mysql_error());
?>
<fieldset class="fieldset">
      <legend>Identitas </legend>
<?php
  $myquery = "SELECT view_orderlab.NOMR, view_orderlab.IDXDAFTAR, view_orderlab.TANGGAL, view_orderlab.NAMA,
  				view_orderlab.ALAMAT, view_orderlab.POLY, view_orderlab.NAMADOKTER,
  				view_orderlab.CARABAYAR, view_orderlab.RUJUKAN, view_orderlab.TGLLAHIR, view_orderlab.JENISKELAMIN,
				view_orderlab.NOLAB
			  FROM view_orderlab WHERE view_orderlab.IDXDAFTAR='".$_GET["idx"]."'";
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get); 		
		$nomr=$userdata['NOMR'];
		$idxdaftar=$userdata['IDXDAFTAR'];
		$kdpoly=$userdata['POLY'];
		$kddokter=$userdata['NAMADOKTER'];
		$tglreg=$userdata['TANGGAL'];
		$nolab=$userdata['NOLAB'];
		
$qry_lab = "SELECT t_orderlab.TGL_MULAI, t_orderlab.TGL_SELESAI, t_orderlab.SHIF, t_orderlab.PETUGAS,
  					t_orderlab.KETERANGAN
			FROM t_orderlab
			WHERE t_orderlab.`STATUS` = '1' AND t_orderlab.IDXDAFTAR = '".$_GET["idx"]."'";
$get_lab = mysql_query($qry_lab);	
$dat_lab = mysql_fetch_assoc($get_lab);
?>    		

      
<table class="tb" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>No MR</td>
          <td width="80%"><?php echo $userdata['NOMR'];?></td>
        </tr>
        <tr>
          <td width="21%">Nama Pasien</td>
          <td width="79%"><?php echo $userdata['NAMA'];?></td>
        </tr>
        <tr>
          <td valign="top">Alamat </td>
          <td><?php echo $userdata['ALAMAT'];?></td>
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
		  $a = datediff($userdata['TGLLAHIR'], $tglreg);
		  echo $a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td>
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
<form id="inpLab" name="inpLab" method="post" action="lab/change_savelab.php">
    <table class="tb" width="100%">    
       <tr>
          <td>Dokter Pengirim</td>
          <td colspan="2" width="80%"><?php echo $kddokter?></td>
       </tr>
        <tr>
          <td>Poly/Ruang Pengirim</td>
          <td colspan="2"><?php echo $kdpoly?></td>
       </tr>
       
        <tr>
          <td>Tanggal Registrasi</td>
          <td colspan="2"><?php echo $tglreg?></td>
       </tr>
         <tr>
          <td>Jam Mulai</td>
          <td colspan="2"><div id="mulai" ><input type="text" name="jamMulai" id="jamMulai" class="text" style="width:150px" readonly="readonly" value="<?=$dat_lab['TGL_MULAI']?>" />&nbsp;</div></td>
       </tr>
         <tr>
          <td>Jam Selesai</td>
          <td colspan="2"><div id="selesai" ><input type="text" name="jamSelesai" id="jamSelesai" class="text" style="width:150px" readonly="readonly" value="<?=$dat_lab['TGL_SELESAI']?>" />&nbsp;</div></td>
       </tr>
         <tr>
           <td>Shift</td>
           <td colspan="2"><?=$dat_lab['SHIF']?></td>
         </tr>
         <tr>
           <td>Petugas Laboratorium</td>
           <td colspan="2"><input type="text" name="petugas" id="petugas" class="text" style="width:200px" readonly="readonly" value="<?=$dat_lab['PETUGAS']?>" /></td>
         </tr>
          <tr>
           <td>No Lab</td>
           <td colspan="2"><input type="text" name="nolab" id="nolab" value="<?=$nolab?>" class="text" style="width:200px" readonly="readonly"/></td>
         </tr>
        <tr>
           <td>Catatan</td>
           <td colspan="2"><textarea name="keterangan" cols="75" rows="5" ><?=$dat_lab['KETERANGAN']?></textarea></td>
         </tr>
    </table>
    <br />
    
    <div id="orderlab" >
     <table class="tb" width="100%">
       <tr>
         <th>No</th>
         <th width="30%">Jenis Pemeriksaan</th>
         <th>Hasil</th>
         <th width="30%">Nilai Normal</th>
         <th >Unit</th>
       </tr>
 <?php $i=1; while ( $data = mysql_fetch_array($row)){  ?>
       <tr>
         <td colspan="2"><strong> - <?php echo $data['nama_gruptindakan']?></strong></td>
         <td></td>
         <td></td>
         <td></td>
       </tr>
<? 

	$sql_d = 'SELECT a.IDXORDERLAB, a.KET, a.nilai_normal, a.UNIT, a.KODE, a.IDXDAFTAR, a.HASIL_PERIKSA, a.KETERANGAN,a.TGL_MULAI, a.TGL_SELESAI, a.STATUS, a.KET, b.nama_tindakan, 
    a.TANGGAL 
    FROM t_orderlab a
    JOIN m_tarif2012 b ON (a.KODE = b.kode_tindakan)
    WHERE a.IDXDAFTAR = "'.$idx_daftar.'" AND a.STATUS = 1 and b.kode_gruptindakan = "'.$data['kode_gruptindakan'].'" AND a.NOLAB="'.$_REQUEST['nolab'].'"';
			
   $get_d = mysql_query($sql_d);
   while($row_d = mysql_fetch_array($get_d)){
$ket = "";
if($row_d['KET'] != "") $ket = " (".$row_d['KET'].")"; 
?>       
        <tr>
         <td align="right"><?=$i?>.</td>
         <td>&nbsp;<?=$row_d['nama_tindakan'].$ket?></td>
         <td>
<? if($row_d['kode_jasa'] == "01010401" || $row_d['kode_jasa'] == "01010402") {?>        
         <textarea name="hsl<?php echo $row_d['IDXORDERLAB']?>" cols="50" rows="5" class="text" ><?php echo $row_d['HASIL_PERIKSA']?></textarea> 
<? }else{ ?>         
         <input type="text" name="hsl<?php echo $row_d['IDXORDERLAB']?>" class="text" style="width:80px" value="<?php echo $row_d['HASIL_PERIKSA']?>" /></td>
<? } ?>         
         <td><?=$row_d['nilai_normal']?></td>
         <td><?=$row_d['UNIT']?></td>
       </tr>
 <?php $i++; } } ?>
    </table>
    </div>
    <input type="hidden" name="idxDaftar" value="<?php echo $idx_daftar ?>" />
 <!--   
    <input type="submit" value="A d d"  class="text" onclick="javascript: MyAjaxRequest('addlab','lab/addlab.php?idxDaftar=<?=$idx_daftar?>'); return false;" />
-->    
    <input type="submit" value="S i m p a n"  class="text" />
    </form>
     </fieldset>
</div>
</div>
<script language="javascript" type="text/javascript" >
</script>