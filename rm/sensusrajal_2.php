<?$sqlx = "SELECT t_diagnosadanterapi.IDXDAFTAR, t_diagnosadanterapi.NOMR, t_diagnosadanterapi.ICD_CODE, t_diagnosadanterapi.ICD_CODE2, t_diagnosadanterapi.*, icd.jenis_penyakit, trim(t_diagnosadanterapi.DIAGNOSA) as DIAGNOSA, trim(t_diagnosadanterapi.TERAPI) as TERAPI
			FROM t_diagnosadanterapi
  			LEFT JOIN icd ON (t_diagnosadanterapi.ICD_CODE = icd.icd_code) where idxdaftar = '".$_GET['idx']."'";

	$getx = mysql_query($sqlx);
	$datax = mysql_fetch_assoc($getx);
	$script_tampung = "";
	$script_icd9 = "";
	$diagnosa = 3;
	$icd9 = 3;
	while($diagnosa <= 30){
		if(!empty($datax['ICD_CODE'.$diagnosa])){
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
                        }\" value=\"".$datax['ICD_CODE'.$diagnosa]."\" /></td>
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
$KDCARABAYAR = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
} 
if(!empty($_GET['tgl_kunjungan2'])){
	$tgl_kunjungan2 =$_GET['tgl_kunjungan2']; 
} 

if($tgl_kunjungan !=""){
	$search = " where a.tanggal between '".$tgl_kunjungan."' and '".$tgl_kunjungan2."'";
}else{
	$search = " where a.tanggal = curdate()";
}
$poli = "";
if(!empty($_GET['poli'])){
	$poli =$_GET['poli']; 
} 

if($poli !=""){
	$search = $search." AND c.kdpoly = '".$poli."' ";
}
$KDCARABAYAR = "";
if(!empty($_GET['KDCARABAYAR'])){
	$KDCARABAYAR =$_GET['KDCARABAYAR']; 
} 

if($KDCARABAYAR !=""){
	$search = $search." AND c.KDCARABAYAR = '".$KDCARABAYAR."' ";
}
$nama = "";
if(!empty($_REQUEST['nama'])){
	$nama =$_REQUEST['nama']; 
	$search = $search." AND b.NAMA like '%".$nama."%'";
} 
$nomr = "";
if(!empty($_REQUEST['nomr'])){
	$nomr =$_REQUEST['nomr']; 
	$search = $search." or a.nomr = '".$nomr."'";
} 
?>

<div align="center">
    <div id="frame" style="width:100%;">
    <div id="frame_title">
      <h3>BRIDGING SIMRS DENGAN INACBG</h3></div>
    <div align="right" style="margin:5px;"> 
 <form name="formsearch" method="get" >
 <table width="248" border="0" cellspacing="0" class="tb">
  <tr>
    <td>Poli</td>
    <td><select name="poli" class="text" >
      <option value="" > -- </option>  
      <? 
	  $sql_poli = "select * from m_poly";
	  $get_poli = mysql_query($sql_poli);
	  while($dat_poli=mysql_fetch_array($get_poli)){
	  ?>
      <option value="<?=$dat_poli['kode']?>" <? if($poli==$dat_poli['kode']) echo "selected"; ?>><?=$dat_poli['nama']?></option>  
      <? } ?>
    </select>
    </td>
  </tr>
  <tr>
    <td>NOMR</td>
    <td><input name="nomr" id="nomr" value="" class="text" /></td>
  </tr>
  <tr>
    <td>Nama</td>
    <td><input name="nama" id="nama" value="" class="text" /></td>
  </tr>
<tr>
    <td>Cara Bayar</td>
    <td>	<select name="KDCARABAYAR" id="KDCARABAYAR" class="selectbox text required" title="*" style="float:left; margin-right:20px;">
            	<option value=""> - Pilih Carabayar - </option>
	       	<?php 
					$sql3	= mysql_query('select * from m_carabayar order by ORDERS asc');
					while($data3	= mysql_fetch_array($sql3)){
						if($_GET['KDCARABAYAR'] == $data3['KODE']): $zx = 'selected="selected"'; else: $zx = ''; endif;
						echo '<option value="'.$data3['KODE'].'" '.$zx.'>'.$data3['NAMA'].'</option>';
					}
				?>
            </select></td>
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
    <input type="hidden" name="link" value="133b" /></td>
  </tr>
</table>

    </form>
         
    <div id="change_icd" <? 
	if(empty($_GET['opt'])) echo "style='display:none;'"; 
	$j = preg_replace("/&#?[a-z0-9]+;/i","",$datax['DIAGNOSA']);
	$k = preg_replace("/&#?[a-z0-9]+;/i","",$datax['TERAPI']);
	?> >
    <br />
    <form name="form_1" action="rm/save_icd.php" method="post" >
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
                        }" value="<? if(!empty($datax['ICD_CODE'])){ echo $datax['ICD_CODE']; 
	  }?>" /></td>
     </tr>  
 	<tr>
      <td>Diagnosa Sekunder 2</td>
      <td><input type="text" name="icd_code2" id="icd_code2" class="text" onKeyPress="if(enter_pressed(event))
          				{
                        var strs=document.getElementById('icd_code2').value;
                        document.getElementById('icd_code2').value=kodes[0];
                        document.getElementById('subjektif').focus();              
                        }" value="<? if(!empty($datax['ICD_CODE2'])){ echo $datax['ICD_CODE2']; 
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
  	<td colspan="2" ><input type="hidden" name="idxdaftar" value="<?=$datax['IDXDAFTAR']?>" />
    <input type="hidden" name="page" value="<?=$_GET['page']?>" />
    <input type="hidden" name="tgl_kunjungan" value="<?=$_GET['tgl_kunjungan']?>" />
    <input type="hidden" name="tgl_kunjungan2" value="<?=$_GET['tgl_kunjungan2']?>" />    
    <input type="hidden" name="poli" value="<?=$_GET['poli']?>" />
	 <input type="hidden" name="kd_carabayar" value="<?=$_GET['KDCARABAYAR']?>" />
    <!--<input type="submit" value="Simpan" class="text" />-->
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
            <th width="5%">Tanggal</th>
            <th width="5%">Poly</th>
            <th width="5%">NOMR</th>
            <th width="10%">NAMA</th>
            <th width="3%">L/P</th>
            <th width="5%">UMUR</th>
            <!--<th width="14%">KECAMATAN</th>
            <th width="14%">KOTA</th>-->
            
            <!-- <th width="6%">NIP</th>
            <!--<th width="14%">TINDAKAN </th>-->
            <th width="6%">CARA BAYAR</th>
            <!--<th width="5%">CARA K<BR />LUAR</th>
            <th width="7%">PE<BR />NGUN<BR />JUNG</p></th>
            <th width="7%">KUN<BR />JU<BR />NGAN</th>            
            <th width="6%">KA<BR />SUS</th>-->
            <th width="10%">DOKTER</th>
            <th width="10%">RUJUKAN</th>
            <th width="10%">KET RUJUK</th>
            <th width="11%">DIAGNOSA</th>
            <th width="7%">TINDAKAN</th>
            <th width="7%">KODE CBG</th>
			<th width="7%">TARIFF</th>
          </tr>
          <?
	$sql = "SELECT a.tanggal, p.nama AS poly, c.idxdaftar, 
a.nomr,b.nama,b.TGLLAHIR, b.jeniskelamin,b.NO_KARTU,c.NOKARTU,a.tanggal, b.kota, 
a.diagnosa,a.terapi,(select NAMADOKTER from m_dokter where KDDOKTER = c.KDDOKTER) AS dokter, 
(select namakecamatan from m_kecamatan where idkecamatan = b.kdkecamatan) AS kdkecamatan, 
(select nama from m_carabayar where kode = c.kdcarabayar) AS kdcarabayar, 
CASE c.pasienbaru 
WHEN 0 THEN 'L' 
ELSE 'B' END AS pasienbaru, 
d.keterangan AS kdtujuanrujuk, 
CASE c.pasienbaru 
WHEN 0 THEN 'L' 
ELSE 'B' END AS pasienbaru, 
CASE a.kunjungan_bl 
WHEN 0 THEN 'L' 
ELSE 'B' END AS kunjungan_bl, 
CASE a.kasus_bl 
WHEN 0 THEN 'L' 
ELSE 'B' END AS kasus_bl, 
a.icd_code, a.icd_code2, a.icd_code3, a.icd_code4, a.icd_code5, a.icd_code6, a.icd_code7, a.icd_code8, a.icd_code9, a.icd_code10,a.icd_code11,a.icd_code12,a.icd_code13,a.icd_code14,a.icd_code15,a.icd_code16,a.icd_code17,a.icd_code18,a.icd_code19,a.icd_code20,a.icd_code21,a.icd_code22,a.icd_code23,a.icd_code24,a.icd_code25,a.icd_code26,a.icd_code27,a.icd_code28,a.icd_code29,a.icd_code30,a.icd_9,a.icd_92,a.icd_93,a.icd_94,a.icd_95,a.icd_96,a.icd_97,a.icd_98,a.icd_99,a.icd_910,a.icd_911,a.icd_912,a.icd_913,a.icd_914,a.icd_915,a.icd_916,a.icd_917,a.icd_918,a.icd_919,a.icd_920,a.icd_921,a.icd_922,a.icd_923,a.icd_924,a.icd_925,a.icd_926,a.icd_927,a.icd_928,a.icd_929,a.icd_930,e.jenis_penyakit, f.namadokter, l.KODE_CBG, l.TARIF, k.NAMA AS RUJUKAN, c.KETRUJUK,a.NIP
FROM t_pendaftaran c 
LEFT JOIN t_diagnosadanterapi a ON a.idxdaftar=c.idxdaftar
LEFT JOIN res_cbg l ON l.IDXDAFTAR=c.idxdaftar 
INNER JOIN m_poly p ON p.kode=a.kdpoly 
INNER JOIN m_pasien b ON a.nomr=b.nomr 

LEFT JOIN m_statuskeluar d ON c.status=d.status 
LEFT JOIN icd e ON (a.ICD_CODE = e.icd_code)
INNER JOIN m_dokter f ON (c.kddokter=f.kddokter) 
LEFT JOIN m_rujukan k ON k.KODE = c.KDRUJUK".$search;

	$sqlcounter = "select count(a.tanggal) from t_diagnosadanterapi a
inner join m_poly p on p.kode=a.kdpoly
inner join m_pasien b on a.nomr=b.nomr
inner join t_pendaftaran c on a.idxdaftar=c.idxdaftar
left join m_statuskeluar d on c.status=d.status
LEFT JOIN icd e ON (a.ICD_CODE = e.icd_code)
inner join m_dokter f on (c.kddokter=f.kddokter)".$search;

	$pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan."&tgl_kunjungan2=".$tgl_kunjungan2."&poli=".$poli,"index.php?link=133&");
	
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
            <td><div align="left"><? echo $data['tanggal'];?> </div></td>
            <td><div align="left"><? echo $data['poly'];?> </div></td>
            <td><div align="left"><strong><? echo $data['nomr'];?><input type='hidden' name='NOMR' id='NOMR' value= <? echo $data['nomr'] ?> ><input type='hidden' name='idxdaftar' id='idxdaftar' value= <? echo $data['idxdaftar'] ?> ></strong></div></td>
            <td align="center"><div align="left"><? echo $data['nama'];?> </div></td>
            <td align="center"><div align="left"><? echo $data['jeniskelamin']; ?> </div></td>
 <?php 
		  if ($data['tanggal']==""){
			  $a = datediff(date("Y/m/d"), date("Y/m/d"));
		  }
		  else {
		       $a = datediff($data['tanggal'], $data['TGLLAHIR']);
		  }            
   ?>         
            <td align="center"><div align="left"><?php echo $a[years].' thn '.$a[months].' bln '.$a[days].' hr'; ?></div></td>
           <!-- <td align="center"><div align="left"><? #echo $data['kdkecamatan']; ?> </div></td>
            <td align="center"><div align="left"><? #echo $data['kota']; ?> </div></td>-->
            <!--<<td align="center"><div align="left"><? #echo $data['diagnosa'];?> </div></td>
            <td align="center"><div align="left"><? #echo $data['NIP'];?> </div></td>
            <td align="center"><div align="left"><? #echo $data['terapi'];?> </div></td>-->
            <td align="center"><div align="left"><? echo $data['kdcarabayar'];?> </div></td>
            <!--<td width="7%" align="center"><div align="center"><? #echo $data['kdtujuanrujuk'];?> </div></td>
            <td width="7%" align="center"><div align="center"><? #echo $data['pasienbaru'];?> </div></td>
            <td width="6%" align="center"><div align="center"><? #echo $data['kunjungan_bl'];?> </div></td>
            <td width="7%" align="center"><div align="center"><? #echo $data['kasus_bl'];?> </div></td>-->
            <td><div align="left"><? echo $data['namadokter'];?> </div></td>
            <td><div align="left"><? echo $data['RUJUKAN'];?> </div></td>
            <td><div align="left"><? echo $data['KETRUJUK'];?> </div></td>
            <td align="left">
			
			<? echo $data['icd_code'];?><br><? echo $data['jenis_penyakit'];?> </td>         
            <td align="left"><? echo $data['icd_code2'];?> </td>            
            <td><? if ($data['KODE_CBG']==''){
			#echo '<a href="#" onclick="get_cbg(NOMR,idxdaftar)" class="text">GET CBG</a>'; 
			echo '<a href=?link=133c&NOMR='.$data['nomr'].'&IDXDAFTAR='.$data['idxdaftar'].' class="text">GET CBG</a>';
				}else{
			echo $data['KODE_CBG'];}?>
			</td>            
            <td><? echo $data['TARIF'];?></td>
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
$qry_excel = "SELECT a.tanggal, p.nama AS poly, 
a.nomr, b.nama, b.TGLLAHIR, b.jeniskelamin, DATE_FORMAT(FROM_DAYS(DATEDIFF(a.tanggal,b.TGLLAHIR)), '%Y')+0 AS umur, b.kota, 
(select namakecamatan from m_kecamatan where idkecamatan = b.kdkecamatan) AS kdkecamatan, 
a.diagnosa,a.terapi, 
(select nama from m_carabayar where kode = c.kdcarabayar) AS kdcarabayar,
CASE c.pasienbaru 
WHEN 0 THEN 'L' 
ELSE 'B' END AS pasienbaru, 
d.keterangan AS kdtujuanrujuk, 
CASE c.pasienbaru 
WHEN 0 THEN 'L' 
ELSE 'B' END AS pasienbaru, 
CASE a.kunjungan_bl 
WHEN 0 THEN 'L' 
ELSE 'B' END AS kunjungan_bl, 
CASE a.kasus_bl 
WHEN 0 THEN 'L' 
ELSE 'B' END AS kasus_bl,
k.NAMA AS RUJUKAN, c.KETRUJUK,
a.icd_code,a.icd_code2, e.jenis_penyakit, f.namadokter
FROM t_diagnosadanterapi a
INNER JOIN m_poly p ON p.kode=a.kdpoly 
INNER JOIN m_pasien b ON a.nomr=b.nomr 
INNER JOIN t_pendaftaran c ON a.idxdaftar=c.idxdaftar 
LEFT JOIN m_statuskeluar d ON c.status=d.status 
LEFT JOIN icd e ON (a.ICD_CODE = e.icd_code)
INNER JOIN m_dokter f ON (c.kddokter=f.kddokter) 
LEFT JOIN m_rujukan k ON k.KODE = c.KDRUJUK ".$search;
?>
<br />
<form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
<!--<input type="hidden" name="query" value="<?=$qry_excel?>" />-->
<input type="hidden" name="query" value="<?=$qry_excel?>" />
<input type="hidden" name="header" value="SENSUS HARIAN RAWAT JALAN" />
<input type="hidden" name="filename" value="sensus_rajal" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
</div>
