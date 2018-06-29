<?$sqlx = "SELECT t_resumepulang.IDADMISSION, t_resumepulang.NOMR, t_resumepulang.ICDKELUAR, t_resumepulang.ICDKELUAR2, t_resumepulang.*, icd.jenis_penyakit, trim(t_resumemedis.DIAGNOSAAKHIR) as DIAGNOSA, trim(t_resumemedis.PROGNOSA) as TERAPI
			FROM t_resumepulang left join t_resumemedis on t_resumepulang.IDADMISSION = t_resumemedis.IDXRANAP
  			LEFT JOIN icd ON (t_resumepulang.ICDKELUAR = icd.icd_code) where t_resumepulang.IDADMISSION = '".$_GET['idx']."'";
			
	$getx = mysql_query($sqlx);
	$datax = mysql_fetch_assoc($getx);
	$script_tampung = "";
	$script_icd9 = "";
	$diagnosa = 3;
	$icd9 = 3;
	while($diagnosa <= 30){
		if(!empty($datax['ICDKELUAR'.$diagnosa])){
			$script_tampung = $script_tampung."<script type=\"text/javascript\">jQuery().ready(function() {
	jQuery(\"#icd_code".$diagnosa."\").autocomplete(\"vk/autocomplete_vk2.php\", {
		width: 260,
		selectFirst: true
	});
});</script><tr>
      <td>Diagnosa Sekunder ".$diagnosa."</td>
      <td><input type=\"text\" name=\"icd_code".$diagnosa."\" id=\"icd_code".$diagnosa."\" class=\"text\" onKeyPress=\"if(enter_pressed(event))
          				{
                        var strs=document.getElementById('icd_code".$diagnosa."').value;
                        document.getElementById('icd_code".$diagnosa."').value=kodes[0];
                        document.getElementById('subjektif').focus();              
                        }\" value=\"".$datax['ICDKELUAR'.$diagnosa]."\" /></td>
     </tr>";
			$diagnosa++;
		}else{
			break;
		}
	}
	while($icd9 <= 30){
		if(!empty($datax['ICD_9'.$icd9])){
			$script_icd9 = $script_icd9."<script type=\"text/javascript\">jQuery().ready(function() {
	jQuery(\"#icd_9".$icd9."\").autocomplete(\"vk/autocomplete_vk2.php\", {
		width: 260,
		selectFirst: true
	});
});</script><tr>
      <td>Tindakan ".$icd9."</td>
      <td><input type=\"text\" name=\"icd_9".$icd9."\" id=\"icd_9".$icd9."\" class=\"text\" onKeyPress=\"if(enter_pressed(event))
          				{
                        var strs=document.getElementById('icd_9".$icd9."').value;
                        document.getElementById('icd_9".$icd9."').value=kodes[0];
                        document.getElementById('subjektif').focus();              
                        }\" value=\"".$datax['ICD_9'.$icd9]."\" /></td>
     </tr>";
			$icd9++;
		}else{
			break;
		}
	}
	?>
<script type="text/javascript">
jQuery().ready(function() {
	jQuery("#icdv").autocomplete("vk/autocomplete_vk.php", {
		width: 260,
		selectFirst: true
	});
	jQuery("#icd_code").autocomplete("vk/autocomplete_vk2.php", {
		width: 260,
		selectFirst: true
	});
	jQuery("#icd_code2").autocomplete("vk/autocomplete_vk2.php", {
		width: 260,
		selectFirst: true
	});
	jQuery("#icd_9").autocomplete("vk/autocomplete_vk3.php", {
		width: 260,
		selectFirst: true
	});
	jQuery("#icd_92").autocomplete("vk/autocomplete_vk3.php", {
		width: 260,
		selectFirst: true
	});
});

var diagnosa = <?=$diagnosa?>;
var icd9 = <?=$icd9?>; 
var inHTML = "";

function add(){
	if (diagnosa <= 30) {
		var table=document.getElementById("tabel_icdx");
		var row=table.insertRow(diagnosa+1);
		var cell1=row.insertCell(0);
		var cell2=row.insertCell(1);
		cell1.innerHTML="Diagnosa Sekunder "+diagnosa;
		cell2.innerHTML+="<input type=\"text\" name=\"icd_code"+diagnosa+"\" id=\"icd_code"+diagnosa+"\" class=\"text\" onKeyPress=\"if(enter_pressed(event)) { var strs=document.getElementById('icd_code"+diagnosa+"').value; document.getElementById('icd_code"+diagnosa+"').value=kodes[0]; document.getElementById('subjektif').focus(); }\" value=\"\" />";
		jQuery( "#icd_code"+diagnosa ).autocomplete("vk/autocomplete_vk2.php", {
			width: 260,
			selectFirst: true
		 });
		diagnosa = diagnosa + 1;
	}
}

function addicd9(){
	if (icd9 <= 30) {
		var table=document.getElementById("tabel_icdx");
		var row=table.insertRow(diagnosa+icd9+2);
		var cell1=row.insertCell(0);
		var cell2=row.insertCell(1);
		cell1.innerHTML="Tindakan "+icd9;
		cell2.innerHTML+="<input type=\"text\" name=\"icd_9"+icd9+"\" id=\"icd_9"+icd9+"\" class=\"text\" onKeyPress=\"if(enter_pressed(event)) { var strs=document.getElementById('icd_9"+icd9+"').value; document.getElementById('icd_9"+icd9+"').value=kodes[0]; document.getElementById('subjektif').focus(); }\" value=\"\" />";
		jQuery( "#icd_9"+icd9 ).autocomplete("vk/autocomplete_vk3.php", {
			width: 260,
			selectFirst: true
		 });
		icd9 = icd9 + 1;
	}
}
</script>
<?php 
require_once('ps_pagination.php');
$myquery 	= "SELECT m_login.NIP, m_login.DEPARTEMEN, m_login.KDUNIT FROM m_login WHERE  m_login.NIP='".$_SESSION['NIP']."'";
$get 		= mysql_query ($myquery)or die(mysql_error());
$userdata 	= mysql_fetch_assoc($get); 		
$nip		= $userdata['NIP'];
$kdpoly		= $userdata['KDUNIT'];
$bagian		= $userdata['DEPARTEMEN'];
$search 	= "";
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
} 
if(!empty($_GET['tgl_kunjungan2'])){
	$tgl_kunjungan2 =$_GET['tgl_kunjungan2']; 
} 

if($tgl_kunjungan !=""){
	$search = " where a.TGLMASUK between '".$tgl_kunjungan."' and '".$tgl_kunjungan2."'";
}else{
	$search = " where a.TGLMASUK = curdate()";
}

$nama = "";
if(!empty($_REQUEST['nama'])){
	$nama =$_REQUEST['nama']; 
	$search = $search." AND b.NAMA like '%".$nama."%'";
} 
$nomr = "";
if(!empty($_REQUEST['nomr'])){
	$nomr =$_REQUEST['nomr']; 
	$search = $search." AND a.nomr = '".$nomr."'";
} 
?>

<div align="center">
    <div id="frame" style="width:100%;">
    <div id="frame_title">
      <h3>LIST PASIEN RAWAT INAP</h3></div>
    <div align="right" style="margin:5px;"> 
 <form name="formsearch" method="get" >
 <table width="248" border="0" cellspacing="0" class="tb">
  <tr>
    <td>NOMR</td>
    <td><input name="nomr" id="nomr" value="" class="text" /></td>
  </tr>
  <tr>
    <td>Nama</td>
    <td><input name="nama" id="nama" value="" class="text" /></td>
  </tr>
  <tr>
    <td>Tanggal</td>
    <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan!=""){
			  echo $tgl_kunjungan;} else echo DATE('Y-m-d')?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
  <tr>
    <td>sd Tanggal</td>
    <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan2!=""){
			  echo $tgl_kunjungan2;} else echo DATE('Y-m-d')?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cari" class="text"/>
    <input type="hidden" name="link" value="135" /></td>
  </tr>
</table>

    </form>
         
    <div id="change_icd" <? 
	if(empty($_GET['opt'])) echo "style='display:none;'"; 
	$j = preg_replace("/&#?[a-z0-9]+;/i","",$datax['DIAGNOSA']);
	$k = preg_replace("/&#?[a-z0-9]+;/i","",$datax['TERAPI']);
	?> >
    <br />
    <form name="form_1" action="rm/save_icdkeluar.php" method="post" >
<table class="tb" width="500" id="tabel_icdx">
  <tr>
      <td width="150">No RM</td>
      <td><input type="text" name="noRm" value="<?=$datax['NOMR']?>" readonly="readonly" class="text" /></td>
  </tr>
  <tr>
      <td>Diagnosa</td>
      <td><textarea name="DIAGNOSA" cols="60" rows="5" class="text"><?=trim($j)?></textarea></td>
  </tr>
    <tr>
      <td>Diagnosa Utama</td>
      <td><input type="text" name="icd_code" id="icd_code" class="text" onKeyPress="if(enter_pressed(event))
          				{
                        var str=document.getElementById('icd_code').value;
                        document.getElementById('icd_code').value=kode[0];
                        document.getElementById('subjektif').focus();                    
                        }" value="<? if(!empty($datax['ICDKELUAR'])){ echo $datax['ICDKELUAR']; 
	  }?>" /></td>
     </tr>  
 	<tr>
      <td>Diagnosa Sekunder 2</td>
      <td><input type="text" name="icd_code2" id="icd_code2" class="text" onKeyPress="if(enter_pressed(event))
          				{
                        var strs=document.getElementById('icd_code2').value;
                        document.getElementById('icd_code2').value=kodes[0];
                        document.getElementById('subjektif').focus();              
                        }" value="<? if(!empty($datax['ICDKELUAR2'])){ echo $datax['ICDKELUAR2']; 
	  }?>" /></td>
     </tr>
	 <? echo $script_tampung;?>
	 <tr><td colspan="2">
	<input type="button" id="addaa" name="addaa" onClick="add()" class="text" value="add"></td>
	</tr>
	<tr>
      <td>Tindakan</td>
      <td><textarea name="TINDAKAN" cols="60" rows="5" class="text"><?=trim($k)?></textarea></td>
  </tr>
  <tr>
      <td>Tindakan 1</td>
      <td><input type="text" name="icd_9" id="icd_9" class="text" onKeyPress="if(enter_pressed(event))
          				{
                        var str=document.getElementById('icd_9').value;
                        document.getElementById('icd_9').value=kode[0];
                        document.getElementById('subjektif').focus();                    
                        }" value="<? if(!empty($datax['ICD_9'])){ echo $datax['ICD_9']; 
	  }?>" /></td>
     </tr>  
 	<tr>
      <td>Tindakan 2</td>
      <td><input type="text" name="icd_92" id="icd_92" class="text" onKeyPress="if(enter_pressed(event))
          				{
                        var strs=document.getElementById('icd_92').value;
                        document.getElementById('icd_92').value=kodes[0];
                        document.getElementById('subjektif').focus();              
                        }" value="<? if(!empty($datax['ICD_92'])){ echo $datax['ICD_92']; 
	  }?>" /></td>
     </tr>
	 <? echo $script_icd9; ?>
	 <tr><td colspan="2">
	<input type="button" id="addaa9" name="addaa9" onClick="addicd9()" class="text" value="add"></td>
	</tr>
  <tr>
  	<td colspan="2" ><input type="hidden" name="idadmission" value="<?=$datax['IDADMISSION']?>" />
    <input type="hidden" name="page" value="<?=$_GET['page']?>" />
    <input type="hidden" name="tgl_kunjungan" value="<?=$_GET['tgl_kunjungan']?>" />
    <input type="hidden" name="tgl_kunjungan2" value="<?=$_GET['tgl_kunjungan2']?>" />    
    <!--<input type="hidden" name="poli" value="<?=$_GET['poli']?>" />
    <input type="submit" value="Simpan" class="text" />-->
	</td>
  </tr>
  <tr>
	<td></td>
	<td align="right"><input type="submit" value="Simpan" class="text" /></td> 
  </tr>
</table>
 </form>
    
    </div>
    
        <div id="table_search">
        <table width="100%" border="0" cellspacing="0" cellspading="0" class="tb">
          <tr align="center">
            <th width="5%">NO</th>
            <th width="5%">Tanggal Masuk</th>
            <th width="5%">Tanggal Keluar</th>
            <th width="5%">NOMR</th>
            <th width="10%">NAMA</th>
            <th width="3%">L/P</th>
            <th width="5%">UMUR</th>
            <th width="10%">KECAMATAN</th>
            <th width="10%">KOTA</th>
            <th width="15%">DIAGNOSA</th>
            <th width="6%">NIP</th>
            <!--<th width="14%">TINDAKAN </th>-->
            <th width="6%">CARA BAYAR</th>
            <th width="10%">DOKTER</th>
            <th width="15%">TERAPI</th>
            <th width="7%">ICD X</th>
            <th width="15%">JNS PENYAKIT</th>
            <th>&nbsp;</th>
          </tr>
          <?
	$sql = "SELECT a.TGLMASUK, c.id_admission, a.nomr,b.nama,b.TGLLAHIR, b.jeniskelamin,a.TGLKELUAR, b.kota, ab.diagnosaakhir as diagnosa, ab.prognosa, (select namakecamatan from m_kecamatan where idkecamatan = b.kdkecamatan) AS kdkecamatan, (select nama from m_carabayar where kode = c.statusbayar) AS kdcarabayar, a.ICDKELUAR, a.ICDKELUAR2, (select jenis_penyakit from ICD where icd_code=a.icdkeluar) as jenis_penyakit, (select namadokter from m_dokter where c.dokter_penanggungjawab = kddokter) as namadokter, a.NIP FROM t_admission c LEFT JOIN t_resumepulang a ON a.IDADMISSION=c.id_admission LEFT JOIN t_resumemedis ab ON ab.IDXRANAP=c.id_admission LEFT JOIN m_pasien b ON c.nomr=b.nomr ".$search;

	$pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan."&tgl_kunjungan2=".$tgl_kunjungan2,"index.php?link=135&");
	
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	while($data = mysql_fetch_array($rs)) {?>
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
            <td><div align="left">
              <? $NO=($NO+1);if ($_GET['page']==0){$hal=0;}else{$hal=$_GET['page']-1;} echo ($hal*15)+$NO;?>
            </div></td>
            <td><div align="left"><? echo $data['TGLMASUK'];?> </div></td>
            <td><div align="left"><? echo $data['TGLKELUAR'];?> </div></td>
            <td><div align="left"><strong><? echo $data['nomr'];?></strong></div></td>
            <td align="center"><div align="left"><? echo $data['nama'];?> </div></td>
            <td align="center"><div align="left"><? echo $data['jeniskelamin']; ?> </div></td>
 <?php 
		  if ($data['TGLMASUK']==""){
			  $a = datediff(date("Y/m/d"), date("Y/m/d"));
		  }
		  else {
		       $a = datediff($data['TGLMASUK'], $data['TGLLAHIR']);
		  }            
   ?>         
            <td align="center"><div align="left"><?php echo $a[years].' thn '.$a[months].' bln '.$a[days].' hr'; ?></div></td>
            <td align="center"><div align="left"><? echo $data['kdkecamatan']; ?> </div></td>
            <td align="center"><div align="left"><? echo $data['kota']; ?> </div></td>
            <td align="center"><div align="left"><? echo $data['diagnosa'];?> </div></td>
            <td align="center"><div align="left"><? echo $data['NIP'];?> </div></td>
            <!--<td align="center"><div align="left"><? echo $data['terapi'];?> </div></td>-->
            <td align="center"><div align="left"><? echo $data['kdcarabayar'];?> </div></td>
            <td><div align="left"><? echo $data['namadokter'];?> </div></td>
            <td align="center"><? echo $data['prognosa'];?> </td>
            <td align="center"><? echo $data['ICDKELUAR'];?> </td>         
            <td><? echo $data['jenis_penyakit'];?> </td>            
            <td><a href="?link=135&page=<?=$_GET['page']?>&opt=1&idx=<?=$data['id_admission']?>&tgl_kunjungan=<?=$tgl_kunjungan?>&tgl_kunjungan2=<?=$tgl_kunjungan2?>" class="text" >ICD</a></td>
          </tr>
	 <?	} 
	
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
    </div>
</div>
</div>
<div align="left">
<? 
$qry_excel = "SELECT a.TGLMASUK, c.id_admission, a.nomr,b.nama,b.TGLLAHIR, b.jeniskelamin,a.TGLKELUAR, b.kota, ab.diagnosaakhir as diagnosa, ab.prognosa, (select namakecamatan from m_kecamatan where idkecamatan = b.kdkecamatan) AS kdkecamatan, (select nama from m_carabayar where kode = c.statusbayar) AS kdcarabayar, a.ICDKELUAR, a.ICDKELUAR2, (select jenis_penyakit from ICD where icd_code=a.icdkeluar) as jenis_penyakit, (select namadokter from m_dokter where c.dokter_penanggungjawab = kddokter) as namadokter, a.NIP FROM t_admission c LEFT JOIN t_resumepulang a ON a.IDADMISSION=c.id_admission LEFT JOIN t_resumemedis ab ON ab.IDXRANAP=c.id_admission LEFT JOIN m_pasien b ON c.nomr=b.nomr ".$search;
?>
<br />
<form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
<!--<input type="hidden" name="query" value="<?=$qry_excel?>" />-->
<input type="hidden" name="query" value="<?=$qry_excel?>" />
<input type="hidden" name="header" value="LIST PASIEN RAWAT INAP" />
<input type="hidden" name="filename" value="list_pasien_ranap" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
</div>
