<?php session_start();
include("include/connect.php");
include("ps_pagination.php");

$search = "";
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
} 
else $tgl_kunjungan=date('Y/m/d');
if(!empty($_GET['tgl_kunjungan2'])){
	$tgl_kunjungan2 =$_GET['tgl_kunjungan2']; 
} 
else $tgl_kunjungan2=date('Y/m/d');

if($tgl_kunjungan !=""){
	$search = " and ( e.tglmasuk between '".$tgl_kunjungan."' and   '".$tgl_kunjungan2."')";
}else{
	$search = " and ( e.tglmasuk  = curdate()  )";
}


$sql="select a.id_admission,a.nomr, b.nama,b.jeniskelamin,b.tgllahir, b.KDKECAMATAN, DATE_FORMAT(e.tglmasuk,'%d/%m/%Y') as tglmasuk, DATE_FORMAT(e.tglkeluar,'%d/%m/%Y') as tglkeluar,
datediff(e.tglkeluar,e.tglmasuk)+1 as lamadirawat, a.kirimdari,c.nama as ruang,c.kelas, d.nama as crbayar,diagnosapulang, icdkeluar,f.nama as poly,e.STATUSPULANG
from m_pasien b, m_ruang c, m_carabayar d,  m_poly f ,t_admission a 
left join t_resumepulang e on e.idadmission=a.id_admission  
where a.nomr=b.nomr and a.noruang=c.no and a.statusbayar=d.kode and 
 a.kirimdari=f.kode ".$search." order by e.tglmasuk";
 /*
 $sql = "SELECT a.id_admission,a.nomr, b.nama,b.jeniskelamin,b.tgllahir, b.KDKECAMATAN,
DATE_FORMAT(e.tglmasuk,'%d/%m/%Y') AS tglmasuk, DATE_FORMAT(e.tglkeluar,'%d/%m/%Y') AS tglkeluar,
DATEDIFF(e.tglkeluar,e.tglmasuk)+1 AS lamadirawat, 
a.kirimdari,c.nama AS ruang,c.kelas, d.nama AS crbayar,diagnosapulang, icdkeluar,f.nama AS poly,
e.STATUSPULANG, h.nama_tindakan, i.NAMADOKTER
FROM t_admission a 
JOIN m_pasien b ON a.nomr = b.nomr
JOIN t_billranap g ON g.IDXDAFTAR = a.id_admission
JOIN m_tarif2012 h ON h.kode_tindakan = g.KODETARIF
JOIN m_dokter i ON i.KDDOKTER = g.KDDOKTER
LEFT JOIN t_resumepulang e ON a.id_admission = e.idadmission
JOIN m_ruang c ON a.noruang = c.no
JOIN m_carabayar d ON a.statusbayar = d.KODE
JOIN m_poly f ON a.kirimdari = f.kode
WHERE a.nomr != '' ".$search."
ORDER BY e.tglmasuk"*/
 /*
 $sqlcounter = "
  select count(a.id_admission) from m_pasien b, m_ruang c, m_carabayar d,  m_poly f ,t_admission a
left join t_resumepulang e on e.idadmission=a.id_admission
where a.nomr=b.nomr and a.noruang=c.no and a.statusbayar=d.kode and
 a.kirimdari=f.kode ".$search." order by e.tglmasuk";
 */
?>
<div align="center">
    <div id="frame" style="width:95%">
    <div id="frame_title">
      <h3>LAPORAN HARIAN PASIEN RAWAT INAP</h3></div>
    <div align="right" style="margin:5px;">
    <form name="formsearch" method="get" >
     <table width="431" border="0" cellspacing="0" class="tb">
  <tr>
    <td width="47">Tanggal</td>
    <td width="178"><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan!=""){
			  echo $tgl_kunjungan;}?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
    <td width="18" align="center">sampai</td>
    <td width="180"><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan2!=""){
			  echo $tgl_kunjungan2;}?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
              
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cari" class="text"/>
    <input type="hidden" name="link" value="138" /></td>
        <td>&nbsp;</td>    <td>&nbsp;</td>
  </tr>
</table>

    </form> 
    
    <div id="change_icd" <? 
	if(empty($_GET['opt'])) echo "style='display:none;'"; 
	
	$sqlx = "SELECT a.id_admission, a.nomr, 
					b.icdkeluar, icd.jenis_penyakit
			FROM t_admission a
			left join t_resumepulang b on a.id_admission=b.idadmission
  			LEFT JOIN icd ON (b.icdkeluar= icd.icd_code) where a.id_admission= '".$_GET['id_admission']."'";

	$getx = mysql_query($sqlx);
	$datax = mysql_fetch_assoc($getx);
	?> >
    
    <form name="form_1" action="rm/save_icdranap.php" method="post" >
<table class="tb" width="248">
  <tr>
      <td>No RM</td>
      <td><input type="text" name="noRm" value="<?=$datax['nomr']?>" readonly="readonly" class="text" /></td>
  </tr>
 	<tr>
      <td>Diagnosa</td>
      <td colspan="2"><input name="icdv" type="text" class="text" id="icdv" size="30" onKeyPress="if(enter_pressed(event))
          				{
                        var str=document.getElementById('icdv').value;
                        var kode=str.split('--');
                        document.getElementById('icd_code').value=kode[1];
                        document.getElementById('icdv').value=kode[0];  
                        document.getElementById('subjektif').focus();                    
                        }" value="<? if(!empty($datax['jenis_penyakit'])){ echo $datax['jenis_penyakit']; 
	  }?>" /></td>
     </tr>
    <tr>
      <td>ICD</td>
      <td colspan="2"><input type="text" name="icd_code" id="icd_code" class="text" onKeyPress="if(enter_pressed(event))
          				{
                        var str=document.getElementById('icd_code').value;
                        var kode=str.split('--');
                        document.getElementById('icd_code').value=kode[0];
                        document.getElementById('icdv').value=kode[1];  
                        document.getElementById('subjektif').focus();                    
                        }" value="<? if(!empty($datax['icdkeluar'])){ echo $datax['icdkeluar']; 
	  }?>" /></td>
     </tr>  
 
  <tr>
  	<td colspan="2" ><input type="hidden" name="id_admission" value="<?=$datax['id_admission']?>" />
    <input type="hidden" name="page" value="<?=$_GET['page']?>" />
    <input type="hidden" name="tgl_kunjungan" value="<?=$_GET['tgl_kunjungan']?>" />
    <input type="hidden" name="tgl_kunjungan2" value="<?=$_GET['tgl_kunjungan2']?>" />    
    <input type="submit" value="Simpan" class="text" /></td> 
  </tr>
</table>
 </form>
 </div>
        <div id="table_search">
          <!--<div style="overflow:scroll;width:98%;height:auto;" >-->
          <div style="overflow:scroll;" align="center">
            <table width="95%" style="margin:10px;" border="1" cellspacing="0" cellspading="0" class="tb">
              <tr align="center">
                <th width="3%" rowspan="2">NO</th>
                <th width="9%" rowspan="2">NOMOR RM</th>
                <th width="13%" rowspan="2">NAMA PASIEN</th>
                <th colspan="2">UMUR</th>
                <th width="3%" rowspan="2">TGL MASUK</th>
                <th width="4%" rowspan="2">TGL KELUAR</th>
                <th width="8%" rowspan="2">LAMA DIRAWAT</th>
                <th width="11%" colspan="4">ASAL PASIEN</th>
                <th width="12%" rowspan="2">RUANG</th>
                <th width="12%" rowspan="2">KELAS</th>
                <th width="12%" rowspan="2">CARA BAYAR</th>
                <th width="7%" rowspan="2">DIAGNOSA AKHIR</th>
                <th width="9%" rowspan="2">ICD-X</th>
                <th width="4%" rowspan="2">TINDAKAN</th>
                <th width="2%" rowspan="2">ICD-9 CM</th>
                <th width="0%" rowspan="2">DOKTER</th>
                <th width="0%" rowspan="2">ASAL WILAYAH</th>
                <th width="0%" rowspan="2">MASUK DARI</th>
                <th width="0%" colspan="4">KEADAAN KELUAR</th>
                <th width="1%" rowspan="2">KET</th>
              </tr>
              <tr align="center">
                <th width="6%">L</th>
                <th width="6%">P</th>
                <th width="11%">DS</th>
                <th width="6%">PKM</th>
                <th width="11%">RS LAIN</th>
                <th width="11%">INSTANSI LAIN</th>
                <th width="0%">H</th>
                <th width="0%">R</th>
                <th width="0%">K</th>
                <th width="0%">M</th>
              </tr>
              <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15</td>
                <td>16</td>
                <td>17</td>
                <td>18</td>
                <td>19</td>
                <td>20</td>
                <td>21</td>
                <td>22</td>
                <td>23</td>
                <td>24</td>
                <td>25</td>
                <td>26</td>
                <td>27</td>
              </tr>
              
              <? 

    $pager = new PS_Pagination($connect, $sql,15, 5, "tgl_kunjungan=".$tgl_kunjungan."&tgl_kunjungan2=".$tgl_kunjungan2,"index.php?link=138&");
	
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	$NO=0;
	while($data = mysql_fetch_array($rs)) {?>
              <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
        
                <td> <? $NO=($NO+1);if ($_GET['page']==0){$hal=0;}else{$hal=$_GET['page']-1;} echo ($hal*15)+$NO;?></td>
                <td><?=$data['nomr']; ?></td>
                <td><?=$data['nama']; ?></td>
                <td><?php 
				      $a = datediff($data['tglmasuk'], $data['tgllahir']);
					  if ($data['jeniskelamin']=='L'){echo $a[years].' tahun '; }?></td>
                <td><?php 
				      $a = datediff($data['tglmasuk'], $data['tgllahir']);
					  if ($data['jeniskelamin']=='P'){echo $a[years].' tahun '; }?></td>
                <td><?=$data['tglmasuk'];?></td>
                <td><?=$data['tglkeluar'];?></td>
                <td><?=$data['lamadirawat'];?></td>
                <td><?php if ($data['kirimdari']==1) echo "X";?></td>
                <td><?php if ($data['kirimdari']==2) echo "X";?></td>
                <td><?php if ($data['kirimdari']==3) echo "X";?></td>
                <td><?php if ($data['kirimdari']==4) echo "X";?></td>
                <td><?=$data['ruang'];?></td>
                <td><?=$data['kelas'];?></td>
                <td><?=$data['crbayar'];?></td>
                <td><?=$data['diagnosapulang'];?></td>
                <td><?=$data['icdkeluar'];?><br /><br />
                [<a href="?link=138&page=<?=$_GET['page']?>&opt=1&id_admission=<?=$data['id_admission']?>&tgl_kunjungan=<?=$tgl_kunjungan?>&tgl_kunjungan2=<?=$tgl_kunjungan2?>" class="text" >Edit</a>]
                </td>
                <td></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?php echo getKecamatanName($data['KDKECAMATAN']);?></td>
                <td><?=$data['poly'];?></td>
                <td><?php if(($data['STATUSPULANG'] == 1) || ($data['STATUSPULANG'] == 2)) echo 'x'; ?></td>
                <td><?php if($data['STATUSPULANG'] == 6) echo 'x'; ?></td>
                <td><?php if($data['STATUSPULANG'] == 4) echo 'x'; ?></td>
                <td><?php if($data['STATUSPULANG'] == 7) echo 'x'; ?></td>
                <td>&nbsp;</td>
              </tr>
              <?	$no=$no+1;} 
	
	
?>
            </table>
          </div>
          
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
<br />
<form name="formprint" method="get" action="report_rm/lapharian_ranap_xls.php" target="_blank" >
<input type="hidden" name="tgl_kunjungan" value="<?php echo $_REQUEST['tgl_kunjungan'];?>" />
<input type="hidden" name="tgl_kunjungan2" value="<?php echo $_REQUEST['tgl_kunjungan2'];?>" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
</div>

<p></p>
