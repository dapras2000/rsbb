<? 
session_start();
include("../include/connect.php"); 
include("../include/function.php"); 
?>

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
    
    
                            
      </td>
  </tr>
  
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

<div id="validicd"></div>


<div id="valid_resume_pulang"></div>