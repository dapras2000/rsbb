<?php 
session_start();

include '../include/connect.php';



$tgl = "";
if(!empty($_GET['tgl'])){
	$tgl =$_GET['tgl']; 
} 

$search = "";
if($tgl !=""){
	$search = "";
}

$sql = "";
?>
<div align="center">
    <div id="frame" style="width:95%">
    <div id="frame_title">
      <h3>SENSUS HARIAN PASIEN RAWAT INAP</h3></div>
    <div align="right" style="margin:5px;">
    
        <div id="table_search">
         <div style="overflow:scroll;width:98%;height:auto;" > 
         <!--<div>-->
          <table width="95%" style="margin:10px;" border="1" cellspacing="0" cellspading="0" class="tb">
            <tr align="center">
              <th width="3%" rowspan="3">NO URUT</th>
              <th width="9%" rowspan="3">RUANG PERAWATAN</th>
              <th width="13%" rowspan="3">TT TERSEDIA</th>
              <th width="6%" rowspan="3">SISA AWAL</th>
              <th width="3%" rowspan="3"> MASUK</th>
              <th width="4%" rowspan="3">PINDAHAN</th>
              <th width="8%" rowspan="3">JUMLAH (4+5+6)</th>
              <th width="11%" rowspan="3">DIPINDAHKAN</th>
              <th width="12%" colspan="8">KELUAR RUMAH SAKIT</th>
              <th width="12%" rowspan="3">JUMLAH (8+13+16)</th>
              <th width="12%" rowspan="3">MASIH DIRAWAT (7-17)</th>
              <th width="7%" rowspan="3">LAMA DIRAWAT</th>
              <th width="0%" colspan="4">RINCIAN HARI PERAWATAN PERKELAS</th>
            </tr>
            <tr align="center">
              <th width="6%" colspan="5">HIDUP</th>
              <th width="6%" colspan="3">MENINGGAL</th>
              <th width="0%" rowspan="2">KELAS II</th>
              <th width="0%" rowspan="2">KELAS III</th>
              <th width="0%" rowspan="2">ISOLASI</th>
              <th width="0%" rowspan="2">PERINA</th>
            </tr>
            <tr align="center">
              <th>DIPULANGKAN</th>
              <th>PERMINTAAN SENDIRI</th>
              <th>MELARIKAN DIRI</th>
              <th>DIRUJUK</th>
              <th>JUMLAH (9+10+11+12)</th>
              <th width="2%">&lt; 48 JAM</th>
              <th width="1%">&gt; 48 JAM</th>
              <th width="3%">JUMLAH (14+15)</th>
            </tr>
            <tr>
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
            </tr>
            <?	
			$sql="CALL pr_sensusharian_ranap()";
	       $rs=mysql_query($sql);
		  
		   if(!$rs) die(mysql_error());     
			while($data = mysql_fetch_array($rs)) {?>
            
            <tr>
              <td>&nbsp;</td>
              <td><?=$data['nama'];?></td>
              <td><?=$data['jmltersedia'];?></td>
              <td><?=$data['sisaawal'];?></td>
              <td><?=$data['masuk'];?></td>
              <td><?=$data['pindahan'];?></td>
              <td><?=$data['jml456'];?></td>
              <td><?=$data['dipindahkan'];?></td>
              <td><?=$data['dipulangkan'];?></td>
              <td><?=$data['permintaansdr'];?></td>              
              <td><?=$data['melarikandiri'];?></td>
              <td><?=$data['dirujuk'];?></td>
              <td><?=$data['keluarhidup'];?></td>
              <td><?=$data['kurang48'];?></td>
              <td><?=$data['lebih48'];?></td>
              <td><?=$data['keluarmeninggal'];?></td>
              <td><?=$data['dipindahkan']+$data['keluarhidup']+$data['keluarmeninggal'];?></td>
              <td><?=$data['jml456']-($data['dipindahkan']+$data['keluarhidup']+$data['keluarmeninggal']);?></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <?	} 
	
	
?>
          </table></div>
          
        </div>
    </div>
</div>
<br />
<? 
$qry_excel = $sql;
?>
<div align="left">
<form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
<input type="hidden" name="query" value="<?=$qry_excel?>" />
<input type="hidden" name="header" value="SENSUS HARIAN RAWAT INAP" />
<input type="hidden" name="filename" value="sensus_harian_ranap" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
</div>
</div>
<p></p>
