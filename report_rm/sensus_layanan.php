<?php 
session_start();
include("include/connect.php");
include("report_rm/ps_pagination.php");

$bulan = "";
if(!empty($_GET['bulan'])){
	$bulan =$_GET['bulan']; 
} 

$tahun = "";
if(!empty($_GET['tahun'])){
	$tahun =$_GET['tahun']; 
} 

?>
<div id="addbarang" align="right">
<form name="filterlap" id="filterlap" method="get" >
<input type="hidden" name="link" value="109" />
<table class="tb" style="width:20%">
<tr>
<?php
 $m = date('m');
?>
   <td>Bulan</td>
   <td><select name="bulan" id="bulan" class="text">
   <option value="1" <? if($m == "1"){ echo "selected=selected"; } ?> >Januari</option>
   <option value="2" <? if($m == "2"){ echo "selected=selected"; } ?> >Pebruari</option>
   <option value="3" <? if($m == "3"){ echo "selected=selected"; } ?> >Maret</option>
   <option value="4" <? if($m == "4"){ echo "selected=selected"; } ?> >April</option>
   <option value="5" <? if($m == "5"){ echo "selected=selected"; } ?> >Mei</option>
   <option value="6" <? if($m == "6"){ echo "selected=selected"; } ?> >Juni</option>
   <option value="7" <? if($m == "7"){ echo "selected=selected"; } ?> >Juli</option>
   <option value="8" <? if($m == "8"){ echo "selected=selected"; } ?> >Agustus</option>
   <option value="9" <? if($m == "9"){ echo "selected=selected"; } ?> >September</option>
   <option value="10" <? if($m == "10"){ echo "selected=selected"; } ?> >Oktober</option>
   <option value="11" <? if($m == "11"){ echo "selected=selected"; } ?> >Nopember</option>
   <option value="12" <? if($m == "12"){ echo "selected=selected"; } ?> >Desember</option>
   </select></td>
 </tr>
  <tr>
 <?php
  $akhtahun = date('Y') - 20;
  $c = date('Y');
 ?>
   <td>Tahun</td>
   <td><select name="tahun" id="tahun" class="text" >
 <? while($akhtahun <= $c){ ?>  
   <option value="<?=$akhtahun?>" <? if($akhtahun == $c){ echo "selected=selected"; } ?>><?=$akhtahun?></option>
 <? $akhtahun++; } ?>  
   </select></td>
 </tr>
   <tr>
   <td><input type="submit" value="Open" class="text" /></td>
   <td></td>
 </tr>
</table>
</form>

</div>
<div align="center">
    <div id="frame" style="width:100%">
<? switch ($bulan)
{
	case "1" :
	$bulan_name = "Januari";
	break;
	case "2" :
	$bulan_name = "Pebruari";
	break;
	case "3" :
	$bulan_name = "Maret";
	break;
	case "4" :
	$bulan_name = "April";
	break;
	case "5" :
	$bulan_name = "Mei";
	break;
	case "6" :
	$bulan_name = "Juni";
	break;
	case "7" :
	$bulan_name = "Juli";
	break;
	case "8" :
	$bulan_name = "Agustus";
	break;
	case "9" :
	$bulan_name = "September";
	break;
	case "10" :
	$bulan_name = "Oktober";
	break;
	case "11" :
	$bulan_name = "Nopember";
	break;
	case "12" :
	$bulan_name = "Desember";
	break;
}
?>    
    
    <div id="frame_title"><h3>SENSUS PELAYANAN FARMASI BULAN <?=$bulan_name." ".$tahun?></h3></div>
    <div align="center" style="margin:5px;"> 
        <div id="table_search">
<strong>A. PENGADAAN OBAT </strong>
<table width="50%" border="0" cellspacing="1" cellpadding="1" class="tb">
  <tr>
    <th width="6%" rowspan="2"><div align="center">NO</div></th>
    <th width="44%" rowspan="2"><div align="center">GOLONGAN OBAT</div></th>
    <th colspan="2"><div align="center">JUMLAH ITEM OBAT</div></th>
    </tr>
  <tr>
    <th width="26%"><div align="center">SESUAI DENGAN KEBUTUHAN</div></th>
    <th width="24%"><div align="center">TERSEDIA DI RS</div></th>
  </tr>

  <tr class="tr1">
    <td><div align="center">1</div></td>
    <td>FORMULARIUM</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="tr1">
    <td><div align="center"></div></td>
    <td>a. Generik</td>
    
<? 
if(!empty($bulan) && !empty($tahun)){
	$cari = "WHERE MONTH(tglkeluar) = ".$bulan." AND YEAR(tglkeluar) = ".$tahun;
}
$sql_obat_item = "select count(kodebarang) AS jmlitem from t_permintaan_apotek ".$cari;
					
$get_obat_item = mysql_query($sql_obat_item);
$dat_obat_item = mysql_fetch_assoc($get_obat_item);

$sql_obat_item2 = "select count(kode_barang) AS jmlitem from m_barang 
					WHERE farmasi = '1' AND group_barang = '1'";
$get_obat_item2 = mysql_query($sql_obat_item2);
$dat_obat_item2 = mysql_fetch_assoc($get_obat_item2);

?>    
    
    <td bgcolor="#CCCCCC"><div align="right"><?=$dat_obat_item2['jmlitem']?></div></td>
    <td bgcolor="#CCCCCC"><div align="right"><?=$dat_obat_item['jmlitem']?></div></td>
  </tr>
  <tr class="tr1">
    <td><div align="center"></div></td>
    <td>b. Non Generik</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="tr1">
    <td><div align="center">2</div></td>
    <td>NON FORMULARIUM</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="tr1">
    <td><div align="center"></div></td>
    <td>a. Generik. </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="tr1">
    <td><div align="center"></div></td>
    <td>b. Non Generik</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="tr1">
    <td><div align="center">3</div></td>
    <td>TOTAL</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="tr1">
    <td><div align="center"></div></td>
    <td>a. Generik</td>
    <td bgcolor="#CCCCCC"><div align="right">
      <?=$dat_obat_item2['jmlitem']?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="right">
      <?=$dat_obat_item['jmlitem']?>
    </div></td>
  </tr>
  <tr class="tr1">
    <td><div align="center"></div></td>
    <td>b. Non Generik</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
    </table>
  <br>
  
<? 
$search = "";
if(!empty($tahun) && !empty($bulan)){
  $search = " AND YEAR(tglkeluar) = '".$tahun."' AND MONTH(tglkeluar) = '".$bulan."'";
}
?> 
 
  <strong>B. PENULISAN DAN PELAYANAN RESEP</strong>
  <table width="80%" border="0" cellspacing="1" cellpadding="1" class="tb">
  <tr>
    <th width="3%"><div align="center">NO</div></th>
    <th width="25%"><div align="center">GOLONGAN OBAT</div></th>
    <th width="15%"><div align="center"></div>      <div align="center">RAWAT JALAN</div></th>
    <th width="8%"><div align="center">UGD</div></th>
    <th width="9%"><div align="center">RAWAT INAP</div></th>
    <th width="13%"><div align="center">TOTAL JUMLAH R/</div></th>
    <th width="27%"><div align="center"> JUMLAH R/ YANG DILAYANI RS</div></th>
  </tr>
  <tr class="tr1">
    <td><div align="center">1</div></td>
    <td>Obat Generik</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr class="tr1">
    <td><div align="center">2</div></td>
    <td>Obat Generik Formularium</td>
 
<? $sql_gen_rajal = "SELECT COUNT(IDXRESEP) AS GEN_RAJAL FROM t_permintaan_apotek 
                     WHERE (KDUNIT = 1 OR
					 KDUNIT = 2 OR
					 KDUNIT = 3 OR
					 KDUNIT = 4 OR
					 KDUNIT = 5 OR
					 KDUNIT = 6 OR
					 KDUNIT = 7 OR
					 KDUNIT = 8 OR
					 KDUNIT = 10 OR
					 KDUNIT = 11) AND non_generik <> '1' ".$search;
					 
   $get_gen_rajal = mysql_query($sql_gen_rajal);
   $dat_gen_rajal = mysql_fetch_assoc($get_gen_rajal);
?>   

    <td align="right"><?=$dat_gen_rajal['GEN_RAJAL']?></td>

<? $sql_gen_ugd = "SELECT COUNT(IDXRESEP) AS GEN_UGD FROM t_permintaan_apotek 
                     WHERE KDUNIT = 9 AND non_generik <> '1' ".$search;
					 
   $get_gen_ugd = mysql_query($sql_gen_ugd);
   $dat_gen_ugd = mysql_fetch_assoc($get_gen_ugd);
?> 

    <td align="right"><?=$dat_gen_ugd['GEN_UGD']?></td>
    
<? $sql_gen_ranap = "SELECT COUNT(IDXRESEP) AS GEN_RANAP FROM t_permintaan_apotek 
                     WHERE KDUNIT = 19 AND non_generik <> '1' ".$search;
					 
   $get_gen_ranap = mysql_query($sql_gen_ranap);
   $dat_gen_ranap = mysql_fetch_assoc($get_gen_ranap);
?> 
    
    
    <td align="right"><?=$dat_gen_ranap['GEN_RANAP']?></td>
    <td align="right"><?=$dat_gen_rajal['GEN_RAJAL'] + $dat_gen_ugd['GEN_UGD'] + $dat_gen_ranap['GEN_RANAP']?></td>
     <td align="right"><?=$dat_gen_rajal['GEN_RAJAL'] + $dat_gen_ugd['GEN_UGD'] + $dat_gen_ranap['GEN_RANAP']?></td>
  </tr>
  <tr class="tr1">
    <td><div align="center">3</div></td>
    <td>Obat Non Generik</td>

<? $sql_nongen_rajal = "SELECT COUNT(IDXRESEP) AS NONGEN_RAJAL FROM t_permintaan_apotek 
                     WHERE (KDUNIT = 1 OR
					 KDUNIT = 2 OR
					 KDUNIT = 3 OR
					 KDUNIT = 4 OR
					 KDUNIT = 5 OR
					 KDUNIT = 6 OR
					 KDUNIT = 7 OR
					 KDUNIT = 8 OR
					 KDUNIT = 10 OR
					 KDUNIT = 11) AND non_generik = '1' ".$search;
					 
   $get_nongen_rajal = mysql_query($sql_nongen_rajal);
   $dat_nongen_rajal = mysql_fetch_assoc($get_nongen_rajal);
?> 
    
    <td align="right"><?=$dat_nongen_rajal['NONGEN_RAJAL']?></td>
    
<? $sql_nongen_ugd = "SELECT COUNT(IDXRESEP) AS NONGEN_UGD FROM t_permintaan_apotek 
                     WHERE KDUNIT = 9
					 AND non_generik = '1' ".$search;
					 
   $get_nongen_ugd = mysql_query($sql_nongen_ugd);
   $dat_nongen_ugd = mysql_fetch_assoc($get_nongen_ugd);
?>     
    
    <td align="right"><?=$dat_nongen_ugd['NONGEN_UGD']?></td>
    
<? $sql_nongen_ranap = "SELECT COUNT(IDXRESEP) AS NONGEN_RANAP FROM t_permintaan_apotek 
                     WHERE KDUNIT = 19
					 AND non_generik = '1' ".$search;
					 
   $get_nongen_ranap = mysql_query($sql_nongen_ranap);
   $dat_nongen_ranap = mysql_fetch_assoc($get_nongen_ranap);
?>     
    
    
    <td align="right"><?=$dat_nongen_ranap['NONGEN_RANAP']?></td>
    <td align="right"><?=$dat_nongen_rajal['NONGEN_RAJAL'] + $dat_nongen_ugd['NONGEN_UGD'] + $dat_nongen_ranap['NONGEN_RANAP']?></td>
    <td align="right"><?=$dat_nongen_rajal['NONGEN_RAJAL'] + $dat_nongen_ugd['NONGEN_UGD'] + $dat_nongen_ranap['NONGEN_RANAP']?></td>
  </tr>
    </table>
        
        </div>
    </div>
</div>
</div>
<br />
<div id="msg" >
<form name="formprint" method="post" action="gudang/printlapbarang.php" target="_blank" >
<input type="hidden" name="tahun" value="<?=$tahun?>" />
<input type="hidden" name="bulan" value="<?=$bulan?>" />
<input type="hidden" name="group" value="<?=$group?>" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
</div>
<p></p>



