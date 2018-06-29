<? 
session_start();
include("../include/connect.php"); 
include("../include/function.php"); 
?>

<div id="frame" style="width:95%;">
	<div id="frame_title"><h3><?php echo $_POST['f_ranap']; ?></h3></div>

<?php if($_POST['f_ranap'] == "Daftar Pemberian Obat"){ 
			if(isset($_GET['edit'])){ 
				$sql_rsm_pulang="SELECT * FROM t_pemberianobat WHERE IDXBERIOBAT = '".$_GET['idxberiobat']."'";
				$get_rsm_pulang =  mysql_query($sql_rsm_pulang);
				$dat_rp = mysql_fetch_assoc($get_rsm_pulang); 
				$_POST['id_admission'] = $dat_rp['IDXRANAP'];
				$_POST['nomr'] = $dat_rp['NOMR'];
				$_POST['kddokter'] = $dat_rp['DOKTER'];
				$_POST['kode_obat'] = $dat_rp['KODE_OBAT'];
?>
<form action="ranap/save_pemberian_obat.php" name="pemberian_obat" method="post" id="pemberian_obat">
			<? echo '<input type="hidden" name="idxberiobat" value="'.$dat_rp['IDXBERIOBAT'].'" />';
				echo '<input type="hidden" name="tanggal" value="'.$dat_rp['TANGGAL'].'" />';
			} else { ?>
<form action="ranap/save_pemberian_obat.php" name="pemberian_obat" method="post" id="pemberian_obat">
<? } ?>

<input type="hidden" name="id_admission" value="<?php echo $_POST['id_admission'];?>" />
<input type="hidden" name="nomr" value="<?php echo $_POST['nomr'];?>" />
<input type="hidden" name="noruang" value="<?php echo $_POST['noruang'];?>" />
<input type="hidden" name="kddokter" value="<?php echo $_POST['kddokter'];?>" />
<input type="hidden" name="kode_obat" id="kode_obat" value="<?php echo $_POST['kode_obat'];?>"/>

<table  border="0" class="tb" width="95%">
  <tr>
    <td width="26%">Kategori Jenis Obat</td>
    <td width="54%">
      <select name="jenis_obat" class="text">
      	<option value="-pilih-">-pilih-</option>
        <option value="1" <? if($dat_rp['JENIS']=="1") echo "selected=Selected";?>>Antibiotika (Oral)</option>
        <option value="2" <? if($dat_rp['JENIS']=="2") echo "selected=Selected";?>>Obat-Obatan (Oral) Lainnya</option>
        <option value="3" <? if($dat_rp['JENIS']=="3") echo "selected=Selected";?>>Obat - Obatan Suntik</option>
        <option value="4" <? if($dat_rp['JENIS']=="4") echo "selected=Selected";?>>Peralatan Medik</option>
        <option value="5" <? if($dat_rp['JENIS']=="5") echo "selected=Selected";?>>Syrup</option>
        </select>
    </td>
    </tr>
  <tr>
    <td>Nama Obat</td>
    <td><input type="text" name="nama_obat" id="obat" class="text" size="60" value="<?=$dat_rp['NAMA']?>"  onkeypress="autocomplete_obat(this.value, event)" onblur="document.getElementById('autocompletedivobat');" /></td>
	
    </tr>
  <tr>
    <td>Tanggal</td>
    <td><? if(isset($dat_rp['NAMA'])){ echo date('d/m/Y', strtotime($dat_rp['TANGGAL'])); }else{ echo date("d/m/Y"); } ?></td>
    </tr>
  <tr>
    <td>Waktu</td>
    <td><input type="radio" name="waktu" id="1" value="1" <? if($dat_rp['WAKTU']=="1")echo "Checked";?>/>
      Pagi
      <input type="radio" name="waktu" id="1" value="2" <? if($dat_rp['WAKTU']=="2")echo "Checked";?>/>
      Siang
      <input type="radio" name="waktu" id="1" value="3" <? if($dat_rp['WAKTU']=="3")echo "Checked";?>/>
      Sore
      <input type="radio" name="waktu" id="1" value="4" <? if($dat_rp['WAKTU']=="4")echo "Checked";?>/>
      Malam </td>
    </tr>
  <tr>
    <td valign="top">Keterangan</td>
    <td><textarea name="keterangan" id="keterangan" cols="45" rows="5" ><?=$dat_rp['KETERANGAN']?></textarea></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" size="50" name="simpan" value="Simpan" class="text" onclick="newsubmitform (document.getElementById('pemberian_obat'),'ranap/save_pemberian_obat.php','valid_pemberian_obat',validatetask); return false;"/></td>
    </tr>
    </table>
</form>    
<script>alert('test');</script>
<div id="valid_pemberian_obat">
<div id="autocompletedivobat" class="autocomp" align="left"></div>
<? include("save_pemberian_obat.php"); ?>
</div>    

<?php }elseif($_POST['f_ranap'] == "Diagnosa Dokter Terapi"){ ?>  




<!--============================================================START DIAGNOSA================================================-->

<?php
    require_once('../ps_pagination_x.php');
?>

  <div id="all">  
    <form name="myform" id="myform" action="./kep/add_save_diagnosa_ranap.php?edit=<?echo $edit;?>" method="post">
    <?if(isset($_GET['iddetdiagkep'])) {
    $sql  = mysql_query("SELECT * FROM t_diagnosakep a left join t_detail_diagnosakep b on a.id_diagnosakep = b.id_diagnosakep WHERE a.NOMR ='".$_POST['nomr']."' and a.idadmission = '".$_POST['id_admission']."' and a.id_diagnosakep = '".$_POST['iddiagkep']."' and b.id_detail_diagnosakep = '".$_GET['iddetdiagkep']."';"); 
    ?>
    <input class="text" value="<?=$_POST['iddiagkep']?>" type="hidden" name="id_diagkep" id="id_diagkep" >
    <input class="text" value="<?=$_GET['iddetdiagkep']?>" type="hidden" name="id_detail_diagkep" id="id_detail_diagkep" >
  <?} else if(isset($_POST['iddiagkep'])){
    $sql  = mysql_query("SELECT * FROM t_diagnosakep WHERE NOMR ='".$_POST['nomr']."' and idadmission = '".$_POST['id_admission']."' and id_diagnosakep = '".$_POST['iddiagkep']."';"); ?>
    <input class="text" value="<?=$_POST['iddiagkep']?>" type="hidden" name="id_diagkep" id="id_diagkep" >
  <?} $data = mysql_fetch_array($sql);?>
  <div id="list_data"></div>
  <br>
  
  <input class="text" value="<?=$_POST['id_admission']?>" type="hidden" name="idadmission" id="idadmission" >
  <input class="text" value="<?=$_POST['nomr']?>" type="hidden" name="nomr" id="nomr" >
  <input class="text" value="<?=$_POST['nama']?>" type="hidden" name="nama" id="nama" >
    <fieldset class="fieldset"><legend>Diagnosa Keperawatan</legend>
	   N I P :&nbsp;
        <select name="nip" class="text required" title="*" id="nip">
          <?php
          $ss = mysql_query('select NIP,NAMA from m_perawat order by NAMA ASC');
          while($ds = mysql_fetch_array($ss)){
          if($data['nip'] == $ds['NIP']): $sel = "selected=Selected"; else: $sel = ''; endif;
          echo '<option value="'.$ds['NIP'].'" '.$sel.' />'.$ds['NIP'].' - '.$ds['NAMA'].'</option>&nbsp;';
          }
          ?>
        </select>
      <table width="50%" border="0" cellpadding="3" cellspacing="0" align="left">
        <!--<tr>
          <td valign="top" colspan="2">Domain</td>
          <td colspan="2">
            <?php
              $ss = mysql_query('select * from m_domain_diagnosa_kep order by id_domain ASC');
              while($ds = mysql_fetch_array($ss)){
              if($data['id_domain'] == $ds['id_domain']): echo $ds['nama_domain']; endif;
              }
            ?>
            <input class="text" value="" type="hidden" name="ID_DIAGNOSISHIDDEN" id="ID_DIAGNOSISHIDDEN" >      
            <input class="text" value="" type="hidden" name="KECAMATANHIDDEN" id="KECAMATANHIDDEN" >
            <input class="text" value="" type="hidden" name="ID_SUB_VAR2HIDDEN" id="ID_SUB_VAR2HIDDEN" >
          </td>
        </tr>
        <tr>
          <td valign="top" colspan="2">Diagnosis Keperawatan</td>
          <td colspan="2">
      <?php
        $ss = mysql_query('select * from m_diagnosis_kep where id_domain = "'.$data['id_domain'].'" order by ID_DIAGNOSIS ASC');
        while($ds = mysql_fetch_array($ss)){
        if($data['id_diagnosis'] == $ds['id_diagnosis']): echo $ds['nama_diagnosis']. ' ('.$ds['kode_diagnosis'].')'; endif;
        }
      ?>
          </td>-->
        </tr>
        <tr>
          <td  valign="top" colspan="2">Daftar Implementasi</td>
          <td colspan="2"><textarea name="implementasi" cols="60" rows="5" class="text"><?=$data['implementasi']?></textarea></td>
        </tr>
    <tr>
          <td valign="top" rowspan="4">Daftar Evaluasi</td>
      <td valign="top">S</td>
          <td colspan="2"><textarea name="evaluasi_s" cols="60" rows="5" class="text"><?=$data['evaluasi_s']?></textarea></td>
        </tr>
        <tr>
          <td valign="top">O</td>
          <td colspan="2"><textarea name="evaluasi_o" cols="60" rows="5" class="text"><?=$data['evaluasi_o']?></textarea></td>
        </tr>
        <tr>
          <td valign="top">A</td>
          <td colspan="2"><textarea name="evaluasi_a" cols="60" rows="5" class="text"><?=$data['evaluasi_a']?></textarea></td>
        </tr>
        <tr>
          <td valign="top">P</td>
          <td colspan="2"><textarea name="evaluasi_p" cols="60" rows="5" class="text"><?=$data['evaluasi_p']?></textarea></td>
        </tr>
        <tr>
          <td colspan="5" align="right"><input type="submit" name="daftar" class="text" value="  S i m p a n  "/></td>
        </tr>
      </table>
    </form>



    </fieldset> 
    <?php
           $page=1;
        $pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=diagnosa_kep&");
        $rs = $pager->paginate();?>
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr align="center">
                        <th width="2%">NO</th>
                        <!--<th width="20%">Domain</th>
                        <th width="5%">Kode Diagnosis</th>-->
                        <th width="19%">Perawat</th>
                        <th width="19%">Tanggal Update</th>
                        <th width="19%">Daftar Implementasi</th>
                        <th width="19%">Daftar Evaluasi - S</th>
                        <th width="19%">Daftar Evaluasi - O</th>
                        <th width="19%">Daftar Evaluasi - A</th>
                        <th width="19%">Daftar Evaluasi - P</th>
                    </tr>
                <?   $sql = "SELECT a.* FROM t_detail_diagnosakep a WHERE a.id_diagnosakep = '".$_POST['iddiagkep']."'";
                $sqlcounter = "SELECT count(id_detail_diagnosakep) FROM t_detail_diagnosakep WHERE id_diagnosakep = '".$_POST['iddiagkep']."' ORDER BY id_detail_diagnosakep";

                    $pager->PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "","index.php?link=diagnosa_kep_detail&");
                    //The paginate() function returns a mysql result set
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
          $NO = 0;
                    while($data = mysql_fetch_array($rs)) {?>
                    <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
                        <td valign="top"><? $NO=($NO+1);
                                if (isset($_GET['page'])==0) {
                                    $hal=0;
                                }else {
                                    $hal=isset($_GET['page'])-1;
                                } echo
                  ($hal*15)+$NO;?></td>
                        <!--<td valign="top"><? echo $data['nama_domain']; ?></td>
                        <td align='center' valign="top"><? echo $data['kode_diagnosis']; ?></td>-->
            <td valign="top"><? 
            $sql  = mysql_query('select NAMA from m_perawat where NIP = "'.$data['perawat'].'"');
            while($ds = mysql_fetch_array($sql)){
            echo $ds['NAMA'];} ?></td>
            <td valign="top"><? echo $data['tgl']; ?></td>
                        <td valign="top"><? echo $data['implementasi']; ?></td>
                        <td valign="top"><? echo $data['evaluasi_s']; ?></td>
                        <td valign="top"><? echo $data['evaluasi_o']; ?></td>
                        <td valign="top"><? echo $data['evaluasi_a']; ?></td>
                        <td valign="top"><? echo $data['evaluasi_p']; ?></td>
                    </tr>
                        <?  }

                    //Display the full navigation in one go
                    //echo $pager->renderFullNav();

                    //Or you can display the inidividual links
                    echo "<div style='padding:5px;' align=\"center\"><br />";

                    //Display the link to first page: First
                    echo $pager->renderFirst()." | ";

                    //Display the link to previous page: <<
                    echo $pager->renderPrev()." | ";

                    //Display page links: 1 2 3
                    echo $pager->renderNav()." | ";

                    //Display the link to next page: >>
                    echo $pager->renderNext()." | ";

                    //Display the link to last page: Last
                    echo $pager->renderLast();

                    echo "</div>";
                    ?>

                </table>

                <?php

                //Display the full navigation in one go
                //echo $pager->renderFullNav();

                //Or you can display the inidividual links
                echo "<div style='padding:5px;' align=\"center\"><br />";

                //Display the link to first page: First
                echo $pager->renderFirst()." | ";

                //Display the link to previous page: <<
                echo $pager->renderPrev()." | ";

                //Display page links: 1 2 3
                echo $pager->renderNav()." | ";

                //Display the link to next page: >>
                echo $pager->renderNext()." | ";

                //Display the link to last page: Last
                echo $pager->renderLast();

                echo "</div>";
                ?>
   </div>
<!--============================================================END DIAGNOSA================================================-->







<?php }elseif($_POST['f_ranap'] == "Perjalanan Penyakit / Intruksi Dokter"){ ?>    
<form action="ranap/save_perjalanan_penyakit.php" name="perjalanan_penyakit" method="post" id="perjalanan_penyakit">
<input type="hidden" name="id_admission" value="<?php echo $_POST['id_admission'];?>" />
<input type="hidden" name="nomr" value="<?php echo $_POST['nomr'];?>" />
<input type="hidden" name="noruang" value="<?php echo $_POST['noruang'];?>" />
<table width="95%" class="tb" border="0">
  <tr>
    <td width="22%">Tanggal / Jam</td>
    <td width="78%"><strong><?php echo date("d/m/Y"); ?></strong></td>
  </tr>
  <tr>
    <td>Perjalanan Penyakit</td>
    <td><textarea name="perjalanan_penyakit" cols="65" rows="4" class="text" id="perjalanan_penyakit"></textarea></td>
  </tr>
  <tr>
    <td>Intruksi Dokter</td>
    <td><textarea name="intruksi_dokter" cols="65" rows="4" class="text" id="intruksi_dokter"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="submit" name="Submit" value="Simpan" class="text" onclick="newsubmitform (document.getElementById('perjalanan_penyakit'),'ranap/save_perjalanan_penyakit.php','valid_perjalanan_penyakit',validatetask); return false;"/>        
    </td>
  </tr>
</table>
</form>

<div id="valid_perjalanan_penyakit" >
<? include("save_perjalanan_penyakit.php"); ?>
</div>




<?php }elseif($_POST['f_ranap']== "Daftar Permintaan Makanan Pasien"){ ?>

<form action="ranap/save_dpmp.php" name="dpmp" method="post" id="dpmp">
<input type="hidden" name="IDXDAFTAR" value="<?php echo $_POST['id_admission'];?>" />
<input type="hidden" name="NOMR" value="<?php echo $_POST['nomr'];?>" />
<input type="hidden" name="RUANG" value="<?php echo $_POST['noruang'];?>" />
<table width="95%" class="tb" border="0">
  <tr valign="top">
    <td width="17%">DIIT :</td>
    <td colspan="2">
      Shift :
      <input type="radio" name="SHIFT" value="1"/> Pagi
      <input type="radio" name="SHIFT" value="2"/> Siang
      <input type="radio" name="SHIFT" value="3"/> Sore
      <span style="padding-left:100px;">Snack :
        <input type="radio" name="SNACK" value="1"/> Pagi
        <input type="radio" name="SNACK" value="2"/> Sore</span>    </td>
    </tr>
  <tr>
    <td>TYPE MAKANAN</td>
    <td width="30%">
      <select name="TYPEMAKANAN" class="text">
        <option selected="selected"> -Pilih- </option>
        <option value="1">MAKANAN BIASA</option>
        <option value="2">MAKANAN KHUSUS</option>
        </select>
    </td>
    <td width="53%">KETERANGAN TAMBAHAN</td>
    </tr>
  <tr>
    <td>KETERANGAN</td>
    <td>
    	<select name="KETERANGAN" class="text">
        	<option selected="selected"> -Pilih- </option>
            <option value="1">TKTP</option>
            <option value="2">RG</option>
            <option value="3">DL</option>
            <option value="4">DH</option>
            <option value="5">DM</option>
            <option value="6">DJ</option>
            <option value="7">TP</option>
            <option value="8">RP.r</option>
            <option value="9">RP</option>
            <option value="10">LAIN-LAIN</option>
        </select>
    </td>
    <td rowspan="5" valign="top"><textarea name="KETERANGANTAMBAHAN" class="text" cols="50" rows="6"></textarea></td>
  </tr>
  <tr>
    <td>JENIS MAKANAN</td>
    <td>
    	<select name="JENISMAKANAN" class="text">
        	<option selected="selected"> -Pilih- </option>
            <option value="1">Nasi</option>
            <option value="2">Lauk</option>
            <option value="3">Bubur Sonde</option>
            <option value="4">Cair</option>
            <option value="5">Sonde</option>
        </select>
    </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Simpan" class="text" onclick="newsubmitform (document.getElementById('dpmp'),'ranap/save_dpmp.php','valid_save_dpmp',validatetask); return false;"/></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
</form>
<div id="valid_save_dpmp">
<? include("save_dpmp.php"); ?>
</div>          


<?php }elseif($_POST['f_ranap'] == "Resume Medis"){ 
		$sql_rsm_pulang="SELECT * FROM t_resumemedis WHERE IDXRANAP = '".$_POST['id_admission']."'";
		$get_rsm_pulang =  mysql_query($sql_rsm_pulang);
		$dat_rp = mysql_fetch_assoc($get_rsm_pulang); 
		if(isset($dat_rp['IDX'])){ ?>
<form action="ranap/save_resume_medis.php" name="resume_medis" method="post" id="resume_medis">
	<? echo '<input type="hidden" name="idx" value="'.$dat_rp['IDX'].'" />';
		} else {	?>
<form action="ranap/save_resume_medis.php" name="resume_medis" method="post" id="resume_medis">
	<? } ?>
<input type="hidden" name="id_admission" value="<?php echo $_POST['id_admission'];?>" />
<input type="hidden" name="nomr" value="<?php echo $_POST['nomr'];?>" />
<input type="hidden" name="masukrs" value="<?php echo $_POST['masukrs'];?>" />
<table width="95%" border="0" class="tb">
  <!--<tr>
    <td width="11%">Tanggal Keluar</td>
    <td width="89%"><input onblur="calage(this.value,'umur');" type="text" class="text" name="tgl_keluar" id="tgl_keluar" size="20" />
      <a href="javascript:showCal('Calendar5')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>-->
  <tr>
    <td colspan="2">1. Keluhan utama dan riwayat penyakit</td>
  </tr>
  <tr>
    <td colspan="2"><textarea name="keluhan" cols="60" rows="5" class="text"><?=$dat_rp['KELUHANUTAMA']?></textarea></td>
    </tr>
  <tr>
    <td colspan="2">2. Pemeriksaan fisik</td>
    </tr>
  <tr>
    <td colspan="2"><textarea name="pemeriksaan_fisik" cols="60" rows="5" class="text"><?=$dat_rp['PEMERIKSAANFISIK']?></textarea></td>
    </tr>
  <tr>
    <td colspan="2">3. Pemeriksaan Penunjang (Lab, Ro, dll)</td>
    </tr>
  <tr>
    <td colspan="2"><textarea name="pemeriksaan_penunjuang" cols="60" rows="5" class="text"><?=$dat_rp['PEMERIKSAANPENUNJANG']?></textarea></td>
    </tr>
  <tr>
    <td colspan="2">4. Jalannya penyakit selama perawatan (konsultasi, pemeriksaan khusus)</td>
    </tr>
  <tr>
    <td colspan="2"><textarea name="konsultasi" cols="60" rows="5" class="text"><?=$dat_rp['JALANNYAPENYAKIT']?></textarea></td>
    </tr>
  <tr>
    <td colspan="2">5. Diagnosa ( Satu atau Lebih )</td>
    </tr>
  <tr>
    <td colspan="2"><textarea name="diagnosa_akhir" cols="60" rows="5" class="text"><?=$dat_rp['DIAGNOSAAKHIR']?></textarea></td>
    </tr>
  <tr>
    <td colspan="2">6. Tindakan ( Satu atau Lebih )</td>
    </tr>
  <tr>
    <td colspan="2"><textarea name="diagnosa" cols="60" rows="5" class="text"><?=$dat_rp['PROGNOSA']?></textarea></td>
    </tr>
  <tr>
    <td colspan="2">7. Keadaan pasien waktu dipulangkan dan obat-obatan yang diberikan</td>
    </tr>
  <tr>
    <td colspan="2"><textarea name="keadaan_pasien" cols="60" rows="5" class="text"><?=$dat_rp['PASIENWAKTUPULANG']?></textarea></td>
    </tr>
  <tr>
    <td colspan="2">8. Anjuran / Pemeriksaan lanjut</td>
    </tr>
  <tr>
    <td colspan="2"><textarea name="anjuran" cols="60" rows="5" class="text"><?=$dat_rp['ANJURAN']?></textarea></td>
    </tr>
  </table>
	<div><input type="submit" name="Submit" value="Simpan" class="text" onclick="newsubmitform (document.getElementById('resume_medis'),'ranap/save_resume_medis.php','valid_resume_medis',validatetask); return false;"/>
</form>    
<div id="valid_resume_medis"></div>        

 
 


<? }elseif($_POST['f_ranap']=="Pengkajian Dewasa"){ ?>

<div id="menu">
   <div id="menu_nama">
<a target="_blank" href="ranap/pdf/pengkajian_dewasa_form.pdf">Pengkajian Dewasa</a>  
<a target="_blank"  href="ranap/pdf/pengkajian_dewasa_form.pdf">Pengkajian Anak</a>  
<a target="_blank"  href="ranap/pdf/pengkajian_dewasa_form.pdf">Pengkajian Bayi</a>
	</div>
</div>
<? }elseif($_POST['f_ranap'] == "Resume Pulang"){?>

<form name="resume_pulang" method="post" id="resume_pulang" action="ranap/save_resume_pulang.php">
	<? 
	$sql_rsm_pulang="SELECT * FROM t_resumepulang WHERE IDADMISSION = '".$_REQUEST['id_admission']."'";
	$get_rsm_pulang =  mysql_query($sql_rsm_pulang);
	$dat_rp = mysql_fetch_assoc($get_rsm_pulang);
	
	$myquery = "select a.nomr, a.kirimdari, a.dokterpengirim, a.masukrs, a.noruang, b.NAMA, b.ALAMAT, b.JENISKELAMIN, b.TGLLAHIR, c.NAMA as CARABAYAR, a.id_admission, a.noruang, d.NAMA as POLY, e.NAMADOKTER, f.kelas, f.nama AS nm_ruang, DATE_FORMAT(TGLLAHIR,'%d/%m/%Y') as TGLLAHIR1
		  from t_admission a, m_pasien b, m_carabayar c, m_poly d, m_dokter e, m_ruang f
		  where a.nomr=b.NOMR AND a.statusbayar=c.KODE AND d.KODE=a.kirimdari AND f.no=a.noruang AND a.dokterpengirim=e.KDDOKTER AND a.id_admission='".$_REQUEST["id_admission"]."'";
	$get = mysql_query ($myquery)or die(mysql_error());
	$userdata = mysql_fetch_assoc($get);
	$id_admission	= $userdata['id_admission'];
	$nomr			= $userdata['nomr'];
	$noruang		= $userdata['noruang'];
	$kdpoly			= $userdata['kirimdari'];
	$kddokter		= $userdata['dokterpengirim'];
	$tglreg			= $userdata['TGLREG'];
	$kelas			= $userdata['kelas'];
	$masukrs		= $userdata['masukrs'];
	$jk				= $userdata['JENISKELAMIN'];
	?>
	<input type="hidden" name="IDADMISSION" value="<?php echo $id_admission;?>" />
    <input type="hidden" name="NOMR" value="<?php echo $nomr;?>" />
    <input type="hidden" name="KDRUANG" value="<?php echo $noruang;?>" />
    <input type="hidden" name="JK" value="<?php echo $jk;?>" />


<table width="90%" border="0" class="tb">
  <tr>
    <td width="26%">Dirawat Sejak</td>
    <td width="22%"><input type="text" name="TGLMASUK" class="text" size="30" value="<?php echo $masukrs; ?>" /></td>
    <td width="3%">s/d</td>
    <td colspan="3"><input type="text" class="text" name="TGLKELUAR" id="TGLKELUAR" size="30" value="<?php
    if( ($dat_rp['TGLKELUAR'] == '') or ($dat_rp['TGLKELUAR'] == '0000-00-00')): echo date('Y-m-d H:i:s'); else: echo $dat_rp['TGLKELUAR']; endif;?>" />
      <a href="javascript: NewCssCal('TGLKELUAR','yyyymmdd','arrow',true)">
                                                        <img src="ranap/images/cal.gif" width="16" height="16" alt="Pick a date"></a></td>
    </tr>
  <!--<tr>
  	<td valign="top">ICD keluar 1</td>
    <td colspan="5"><input type="text" name="ICDKELUARx" id="icd" class="text" size="60" value="<?=$dat_rp['ICDKELUAR']?>"  onkeypress="autocomplete_icd(this.value, event)" onblur="document.getElementById('autocompletediv');"  />
        <input type="text" name="ICDKELUAR" id="icd_code" value="<?=$dat_rp['ICDKELUAR']?>" class="text" style="width:45px;" />
    </td>
    </tr>
  <tr>
  <tr>
  	<td valign="top">ICD keluar 2</td>
    <td colspan="5"><input type="text" name="ICDKELUAR2" id="icd2" class="text" size="60" value="<?=$dat_rp['ICDKELUAR']?>"  onkeypress="autocomplete_icd2(this.value, event)" onblur="document.getElementById('autocompletediv2');"  />
        <input type="text" name="ICDKELUAR2" id="icd_code2" value="<?=$dat_rp['ICDKELUAR']?>" class="text" style="width:45px;" />
    </td>
    </tr>
  <tr>
  <tr>
  	<td valign="top">ICD keluar 3</td>
    <td colspan="5"><input type="text" name="ICDKELUAR3" id="icd3" class="text" size="60" value="<?=$dat_rp['ICDKELUAR']?>"  onkeypress="autocomplete_icd3(this.value, event)" onblur="document.getElementById('autocompletediv3');" />
        <input type="text" name="ICDKELUAR3" id="icd_code3" value="<?=$dat_rp['ICDKELUAR']?>" class="text" style="width:45px;" />
    </td>
    </tr>
  <tr>
  <tr>
  	<td valign="top">ICD keluar 4</td>
    <td colspan="5"><input type="text" name="ICDKELUAR4" id="icd4" class="text" size="60" value="<?=$dat_rp['ICDKELUAR']?>"  onkeypress="autocomplete_icd4(this.value, event)" onblur="document.getElementById('autocompletediv4');" />
        <input type="text" name="ICDKELUAR4" id="icd_code4" value="<?=$dat_rp['ICDKELUAR']?>" class="text" style="width:45px;" />
    </td>
    </tr>
  <tr>
    <td valign="top">Diagnosa medik Saat Pulang</td>
    <td colspan="5"><textarea name="DIAGNOSAPULANG"  cols="60" rows="4" class="text"><?=$dat_rp['DIAGNOSAPULANG']?></textarea></td>
  </tr>-->
  <tr>
    <td valign="top">Status Pulang</td>
    <td colspan="5">
    <select name="STATUSPULANG" class="text" onchange="javascript: MyAjaxRequest('rujuk','rujukan/alasan_rujuk.php?rujuk=' + this.value); return false;">
    	<option selected="selected">- Pilih Status -</option>
    	<?php 
		$sql = mysql_query('select * from m_statuskeluarranap order by kode');
		while($row = mysql_fetch_array($sql)){
			echo '<option value="'.$row['kode'].'">'.$row['nama'].'</option>';
		}
        ?>        
    </select><div id="rujuk" ></div>
    
    
                            <!--
      <input type="radio" name="STATUSPULANG" value="1" <? if($dat_rp['STATUSPULANG']=="1") echo "checked=checked"; ?>/> Atas Izin Dokter
      <input type="radio" name="STATUSPULANG" value="2" <? if($dat_rp['STATUSPULANG']=="2") echo "checked=checked"; ?>/> Meninggal Dunia
      <input type="radio" name="STATUSPULANG" value="3" <? if($dat_rp['STATUSPULANG']=="3") echo "checked=checked"; ?>/> Dirujuk <br />
      <input type="radio" name="STATUSPULANG" value="4" <? if($dat_rp['STATUSPULANG']=="4") echo "checked=checked"; ?>/> Melarikan Diri
      <input type="radio" name="STATUSPULANG" value="5" <? if($dat_rp['STATUSPULANG']=="5") echo "checked=checked"; ?>/> Atas Permintaan Sendiri
      -->
      </td>
  </tr>
  <!--
  <tr>
    <td>Pasien Dirujuk Ke</td>
    <td colspan="5">
    
    	<input type="radio" name="DIRUJUK" value="1" <? if($dat_rp['DIRUJUK']=="1") echo "checked=checked"; ?>/> Dokter Pribadi 
      <input type="radio" name="DIRUJUK" value="2" <? if($dat_rp['DIRUJUK']=="2") echo "checked=checked"; ?>/> Rumah Sakit
      <input type="radio" name="DIRUJUK" value="3" <? if($dat_rp['DIRUJUK']=="3") echo "checked=checked"; ?>/> Lain-lain
  </td>
  </tr>
  <tr>
    <td colspan="2">Alat Bantu Yang Masih Terpasang Saat Pulang</td>
    <td>&nbsp;</td>
    <td width="10%">&nbsp;</td>
    <td width="14%">&nbsp;</td>
    <td width="25%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5"><input type="radio" name="ALATBANTU" value="1"  <? if($dat_rp['ALATBANTU']=="1") echo "checked=checked"; ?>/> Tidak Ada
        <input type="radio" name="ALATBANTU" value="2" <? if($dat_rp['ALATBANTU']=="2") echo "checked=checked"; ?>/> Infus
        <input type="radio" name="ALATBANTU" value="3" <? if($dat_rp['ALATBANTU']=="3") echo "checked=checked"; ?>/> Kateter
        <input type="radio" name="ALATBANTU" value="4" <? if($dat_rp['ALATBANTU']=="4") echo "checked=checked"; ?>/> Oksigen
        <input type="radio" name="ALATBANTU" value="5" <? if($dat_rp['ALATBANTU']=="5") echo "checked=checked"; ?>/> NGT
        <input type="radio" name="ALATBANTU" value="6" <? if($dat_rp['ALATBANTU']=="6") echo "checked=checked"; ?>/> Lain-lain
    </td>
    </tr>
  <tr>
    <td>Mobilisasi Saat Pulang</td>
    <td colspan="5">
    	<input type="radio" name="MOBILISASI" value="1" <? if($dat_rp['MOBILISASI']=="1") echo "checked=checked"; ?>/> Jalan
        <input type="radio" name="MOBILISASI" value="2" <? if($dat_rp['MOBILISASI']=="2") echo "checked=checked"; ?>/> Tongkat
        <input type="radio" name="MOBILISASI" value="3" <? if($dat_rp['MOBILISASI']=="3") echo "checked=checked"; ?>/> Kursi Roda
        <input type="radio" name="MOBILISASI" value="4" <? if($dat_rp['MOBILISASI']=="4") echo "checked=checked"; ?>/> Brankard
        </td>
    </tr>
  <tr>
    <td colspan="2">Masalah Keperawatan Selama Dirawat</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td  colspan="5"><textarea name="MSLHKEP" cols="60" rows="4" class="text"><?=$dat_rp['MSLHKEP']?></textarea></td>
  </tr>
  <tr>
    <td colspan="6">Tindakan Keperawatan yang telah dilakukan selama dirawat</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5"><textarea name="TKSD" cols="60"  class="text" rows="4"><?=$dat_rp['TKSD']?></textarea></td>
    </tr>
  <tr>
    <td colspan="6">Masalah Keperawatan yang perlu ditindak lanjuti di rumah</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5"><textarea name="TKDR" cols="60"  class="text" rows="4"><?=$dat_rp['TKDR']?></textarea></td>
    </tr>
  <tr>
    <td colspan="2">Penyuluhan kesehatan yang diberikan</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
<? 
  $list_penykes = explode(",",$dat_rp['PENYKES']);
?>    
    <td colspan="3"><input type="checkbox" name="PENYKES_1" value="1" 
    <? if(in_array("1", $list_penykes)) echo "checked=checked"; ?>   
    />  cara pemberian makanan / minuman</td>
    <td colspan="2"><input type="checkbox" name="PENYKES_2" value="2" 
   	<? if(in_array("2", $list_penykes)) echo "checked=checked"; ?>    
    />  cara pemberian obat</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><input type="checkbox" name="PENYKES_3" value="3" 
    <? if(in_array("3", $list_penykes)) echo "checked=checked"; ?>   
    /> cara perawatan luka</td>
    <td colspan="2"><input type="checkbox" name="PENYKES_4" value="4" 
    <? if(in_array("4", $list_penykes)) echo "checked=checked"; ?>   
    /> cara melakukan teknik relaksasi</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><input type="checkbox" name="PENYKES_5" value="5" 
    <? if(in_array("5", $list_penykes)) echo "checked=checked"; ?>   
    /> cara batuk efektif</td>
    <td colspan="2"><input type="checkbox" name="PENYKES_6" value="6" 
   	<? if(in_array("6", $list_penykes)) echo "checked=checked"; ?>    
    /> cara melakukan fisioterapi</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><input type="checkbox" name="PENYKES_7" value="7" 
    <? if(in_array("7", $list_penykes)) echo "checked=checked"; ?>   
    /> cara pengaturan diet</td>
    <td colspan="2"><input type="checkbox" name="PENYKES_8" value="8" 
   	<? if(in_array("8", $list_penykes)) echo "checked=checked"; ?>    
    /> cara menjemur bayi kuning</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><input type="checkbox" name="PENYKES_9" value="9" 
   	<? if(in_array("9", $list_penykes)) echo "checked=checked"; ?>    
    /> cara pemberian / pencernaan susu</td>
    <td colspan="2"><input type="checkbox" name="PENYKES_10" value="10" 
    <? if(in_array("10", $list_penykes)) echo "checked=checked"; ?>   
    /> cara memandikan bayi</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><input type="checkbox" name="PENYKES_11" value="11" 
   	<? if(in_array("11", $list_penykes)) echo "checked=checked"; ?>    
    /> cara merawat bayi</td>
    <td colspan="2"><input type="checkbox" name="PENYKES_12" value="12" 
   	<? if(in_array("12", $list_penykes)) echo "checked=checked"; ?>    
    /> cara mengganti alat tenun</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><input type="checkbox" name="PENYKES_13" value="13" 
    <? if(in_array("13", $list_penykes)) echo "checked=checked"; ?>   
    /> cara perawatan tali pusat</td>
    <td colspan="2"><input type="checkbox" name="PENYKES_14" value="14" 
    <? if(in_array("14", $list_penykes)) echo "checked=checked"; ?>   
    /> lain lain</td>
  </tr>
  <tr>
    <td colspan="6">
    <div class="tb">
    <div id="frame_title"><h3>KHUSUS UNTUK RUANG RAWAT KEBIDANAN</h3></div>
    <table width="90%" align="center" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td colspan="2">Mencocokan Gelang Bayi Pada Ibu</td>
    <td width="43%" colspan="2"><input type="radio" name="MGBPI" value="1" <? if($dat_rp['MGBPI']=="1") echo "checked=checked"; ?>/>
      Ya
        <input type="radio" name="MGBPI" value="2" <? if($dat_rp['MGBPI']=="2") echo "checked=checked"; ?>/>
        Tidak</td>
  </tr>
  <tr>
    <td colspan="2">Disaksikan orang tua bayi pada saat mencocokan</td>
    <td colspan="2"><input type="radio" name="DOTB" value="1"  <? if($dat_rp['DOTB']=="1") echo "checked=checked"; ?>/>
      Ya
        <input type="radio" name="DOTB" value="2"  <? if($dat_rp['DOTB']=="2") echo "checked=checked"; ?>/>
        Tidak</td>
  </tr>
  </table>

    </div>
    </td>
    </tr>
  <tr>
    <td colspan="6">Obat yang dibawa pulang</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5"><textarea name="OYDP" cols="60"  class="text" rows="4"><?=$dat_rp['OYDP']?></textarea></td>
  </tr>
  <tr>
    <td colspan="6">Hasil pemeriksaan yang dibawa pulang</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5"><textarea name="HPYDP" cols="60"  class="text" rows="4"><?=$dat_rp['HPYDP']?></textarea></td>
    </tr>
  <tr>
    <td>Surat Kontrol</td>
    <td><input type="radio" name="SK" value="1" <? if($dat_rp['SK']=="1") echo "checked=checked"; ?>/>
      Ya
        <input type="radio" name="SK" value="2" <? if($dat_rp['SK']=="2") echo "checked=checked"; ?>/>
        Tidak</td>
    <td colspan="2">Surat Istirahat</td>
    <td colspan="2"><input type="radio" name="SI" value="1" <? if($dat_rp['SI']=="1") echo "checked=checked"; ?>/>
      Ya
        <input type="radio" name="SI" value="2" <? if($dat_rp['SI']=="2") echo "checked=checked"; ?>/>
        Tidak</td>
    </tr>
  <tr>
    <td>Surat Rujukan</td>
    <td><input type="radio" name="SR" value="1" <? if($dat_rp['SR']=="1") echo "checked=checked"; ?>/>
      Ya
        <input type="radio" name="SR" value="2" <? if($dat_rp['SR']=="2") echo "checked=checked"; ?>/>
        Tidak</td>
    <td colspan="2">Kartu Imunisasi</td>
    <td colspan="2"><input type="radio" name="KI" value="1" <? if($dat_rp['KI']=="1") echo "checked=checked"; ?> />
      Ya
        <input type="radio" name="KI" value="2" <? if($dat_rp['KI']=="2") echo "checked=checked"; ?>/>
        Tidak</td>
    </tr>
  <tr>
    <td>Surat Keterangan Kelahiran</td>
    <td><input type="radio" name="SKK" value="1" <? if($dat_rp['SKK']=="1") echo "checked=checked"; ?>/>
Ya
  <input type="radio" name="SKK" value="2" <? if($dat_rp['SKK']=="2") echo "checked=checked"; ?>/>
Tidak</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Surat Tanda Bukti selesai Administrasi</td>
    <td><input type="radio" name="STBA" value="1" <? if($dat_rp['STBA']=="1") echo "checked=checked"; ?>/>
Ya
  <input type="radio" name="STBA" value="2" <? if($dat_rp['STBA']=="2") echo "checked=checked"; ?>/>
Tidak</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Pulang ke alamat</td>
    <td colspan="5"><input type="text" name="PALAMAT" class="text" size="60" value="<?=$dat_rp['PALAMAT']?>" /></td>
    </tr>
  <tr>
    <td>Nama Penjemput</td>
    <td colspan="5"><input type="text" name="NPNJMPT" class="text" size="60" value="<?=$dat_rp['NPNJMPT']?>"/></td>
    </tr>
  <tr>
    <td>Hubungan dengan pasien</td>
    <td colspan="5"><input type="text" name="HUBPASIEN" class="text" size="60" value="<?=$dat_rp['HUBPASIEN']?>"/></td>
    </tr>
    -->
  <tr>
    <td colspan="6" align="center">
    <input type="hidden" name="idxpulang" value="<?=$dat_rp['IDXPULANG']?>"  />
    <input type="submit" name="Submit" value="Simpan" class="text" onclick="newsubmitform (document.getElementById('resume_pulang'),'ranap/save_resume_pulang.php','valid_resume_pulang',validatetask); return false;"/></td>
    </tr>
</table>
</form>
<div id="autocompleteicd" class="autocomp" align="left"></div>
<div id="autocompleteicd2" class="autocomp" align="left"></div>
<div id="autocompleteicd3" class="autocomp" align="left"></div>
<div id="autocompleteicd4" class="autocomp" align="left"></div>
<!--<div id="autocompletediv" class="autocomp" align="left"></div>
<div id="autocompletediv2" class="autocomp" align="left"></div>
<div id="autocompletediv3" class="autocomp" align="left"></div>
<div id="autocompletediv4" class="autocomp" align="left"></div>-->

<div id="validicd"></div>


<div id="valid_resume_pulang"></div>

<? }elseif($_POST['f_ranap'] == "Rencana Keperawatan"){?>
<form name="rencana_keperawatan" id="rencana_keperawatan" action="ranap/save_rencana_keperawatan.php">
<input type="hidden" name="IDADMISSION" value="<?php echo $id_admission;?>" />
<input type="hidden" name="NOMR" value="<?php echo $nomr;?>" />
<input type="hidden" name="KDRUANG" value="<?php echo $noruang;?>" />

<fieldset style="width:95%"><legend>Pilih Jenis Keperawatan</legend>
<div align="left">
<input type="radio" name="jenis" id="jenis" value="1" onclick="javascript: MyAjaxRequest('select_query','ranap/inc/process.php?jenis=','jenis');"/> Kebidanan 
<input type="radio" name="jenis" id="jenis2" value="2" onclick="javascript: MyAjaxRequest('select_query','ranap/inc/process.php?jenis=','jenis2');"/> Penyakit Dalam 
<input type="radio" name="jenis" id="jenis3" value="3" onclick="javascript: MyAjaxRequest('select_query','ranap/inc/process.php?jenis=','jenis3');"/> Penyakit Bedah 
<input type="radio" name="jenis" id="jenis4" value="4" onclick="javascript: MyAjaxRequest('select_query','ranap/inc/process.php?jenis=','jenis4');"/> Penyakit Anak 
</div>
</fieldset>
<div id="select_query"></div>

<p><input type="submit" name="Submit" value="Simpan" class="text" onclick="newsubmitform (document.getElementById('rencana_keperawatan'),'ranap/save_rencana_keperawatan.php','list_hasil',validatetask); return false;"/></p>
</form>

<div id="list_hasil">
<? include("save_rencana_keperawatan.php"); ?>
</div>

<? }elseif($_POST['f_ranap']=="Order Rad"){
	include("rad/order_rad.php");
	
   }elseif($_POST['f_ranap']=="Order Lab"){
	include("lab/order_lab.php");
	
 }elseif($_POST['f_ranap']=="Kamar Operasi"){
	include("operasi/form_daftar_operasi.php");	
  }elseif($_POST['f_ranap']=="Order Resep"){?>
<form name="order_resep" method="post" id="order_resep" action="ranap/save_order_resep.php">

<table width="95%" border="0" cellpadding="0" class="tb" cellspacing="0">
  <tr>
    <td width="20%">Keterangan Resep </td>
    <td width="80%" colspan="3" rowspan="4" valign="top">
    	<textarea name="resep" cols="80%" rows="6" ></textarea>
    </td>
    </tr>
  <tr>
    <td>
    <input type="hidden" name="id_admission" value="<?php echo $id_admission;?>" />
    <input type="hidden" name="nomr" value="<?php echo $nomr;?>" />
    <input type="hidden" name="noruang" value="<?php echo $noruang;?>" />
    <input type="hidden" name="kelas" value="<?php echo $kelas;?>" />
    <input type="hidden" name="kddokter" value="<?php echo $kddokter;?>" />
    <input type="hidden" name="kdpoly" value="<?php echo $kdpoly;?>" />
    <input type="hidden" name="masukrs" value="<?php echo $masukrs;?>" />
    </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
</table>

<p><input type="submit" name="Submit" value="Simpan" class="text" onclick="newsubmitform (document.getElementById('order_resep'),'ranap/save_order_resep.php','val_resep',validatetask); return false;"/></p>
</form>

<div id="val_resep">
<? include("save_order_resep.php"); ?>
</div>

<? }else{ }?>
</div>

<div id="autocompletediv" class="autocomp"></div>
<br />
<hr/>