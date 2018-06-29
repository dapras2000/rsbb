<?php 
session_start();
include("include/connect.php");
include("report_rm/ps_pagination.php");

$search = "";
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
} 

if($tgl_kunjungan !=""){
	$search = " and (date(e.tglmasuk) = '".$tgl_kunjungan."' or date(e.tglkeluar) = '".$tgl_kunjungan."')";
}else{
	$search = " and (date(e.tglmasuk) = curdate() or date(e.tglkeluar) = curdate())";
}

$sql="select a.nomr, b.nama,b.jeniskelamin,b.tgllahir, DATE_FORMAT(e.tglmasuk,'%d/%m/%Y') as tglmasuk, DATE_FORMAT(e.tglkeluar,'%d/%m/%Y') as tglkeluar,
datediff(e.tglkeluar,e.tglmasuk) as lamadirawat, c.nama as ruang,c.kelas, d.nama as crbayar,diagnosapulang, icdkeluar,f.nama as poly
from t_admission a , m_pasien b, m_ruang c, m_carabayar d, t_resumepulang e, m_poly f 
where a.nomr=b.nomr and a.noruang=c.no and a.statusbayar=d.kode and e.idadmission=a.id_admission  and
 a.kirimdari=f.kode and ifnull(e.tglkeluar,'0000/00/00')<>'0000/00/00' ".$search;
?>
<div align="center">
    <div id="frame" style="width:95%">
    <div id="frame_title">
      <h3>LAPORAN HARIAN PASIEN KELUAR RUMAH SAKIT (HIDUP & MENINGGAL)</h3></div>
    <div align="right" style="margin:5px;">
    <form name="formsearch" method="get" >
     <table width="248" border="0" cellspacing="0" class="tb">
  <tr>
    <td>Tanggal</td>
    <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan!=""){
			  echo $tgl_kunjungan;}?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cari" class="text"/>
    <input type="hidden" name="link" value="138" /></td>
  </tr>
</table>

    </form> 
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

    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan,"index.php?link=138&");
	
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
                <td>&nbsp;</td>
                <td><?=$data['nomr']; ?></td>
                <td><?=$data['nama']; ?></td>
                <td><?php 
				      $a = datediff($data['tanggal'], $data['TGLLAHIR']);
					  if ($data['jeniskelamin']=='L'){echo $a[years].' tahun '; }?></td>
                <td><?php 
				      $a = datediff($data['tanggal'], $data['TGLLAHIR']);
					  if ($data['jeniskelamin']=='P'){echo $a[years].' tahun '; }?></td>
                <td><?=$data['tglmasuk'];?></td>
                <td><?=$data['tglkeluar'];?></td>
                <td><?=$data['lamadirawat'];?></td>
                <td>X</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?=$data['ruang'];?></td>
                <td><?=$data['kelas'];?></td>
                <td><?=$data['crbayar'];?></td>
                <td><?=$data['diagnosapulang'];?></td>
                <td><?=$data['icdkeluar'];?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?=$data['poly'];?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <?	} 
	
	
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
<p></p>
