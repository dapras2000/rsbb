<?php 
session_start();
include("farmasi_new.php");

$tgl_pesan = "";
if(!empty($_GET['tgl_pesan'])){
	$tgl_pesan =$_GET['tgl_pesan']; 
} 

if($tgl_pesan !=""){
	$search = " AND t_permintaan_barang.tglpesan = '".$tgl_pesan."' ";
}else{
	$search = "";
}


$sql = "SELECT 
		  m_barang_group.nama_group,
		  m_barang_group.nama_farmasi,
		  m_barang.kode_barang,
		  m_barang.nama_barang,
		  m_barang.satuan,
		  m_barang.no_batch,
		  DATE_FORMAT(m_barang.expiry, '%d -%m -%Y') as expiry,
		  t_permintaan_barang.jumlahpesan,
		  m_barang.satuan,
		  DATE_FORMAT(t_permintaan_barang.tglpesan, '%d -%m -%Y') as tglpesan,
		  t_permintaan_barang.jumlahpesan,
		  t_permintaan_barang.statusacc,
		  t_permintaan_barang.status_save,
		  t_permintaan_barang.jmlkeluar,
		  DATE_FORMAT(t_permintaan_barang.tglkeluar, '%d -%m -%Y') as tglkeluar
		FROM
		  m_barang
		  INNER JOIN m_barang_group ON (m_barang.group_barang = m_barang_group.group_barang)
		  AND (m_barang.farmasi = m_barang_group.farmasi)
		  INNER JOIN t_permintaan_barang ON (m_barang.kode_barang = t_permintaan_barang.kodebarang)
		WHERE t_permintaan_barang.KDUNIT ='".$_SESSION['KDUNIT']."' ".$search;
		
		$sqlcounter = "SELECT
		  count(m_barang_group.nama_group)
		FROM
		  m_barang
		  INNER JOIN m_barang_group ON (m_barang.group_barang = m_barang_group.group_barang)
		  AND (m_barang.farmasi = m_barang_group.farmasi)
		  INNER JOIN t_permintaan_barang ON (m_barang.kode_barang = t_permintaan_barang.kodebarang)
		WHERE t_permintaan_barang.KDUNIT ='".$_SESSION['KDUNIT']."' ".$search;
		
$qry_order = mysql_query($sql);

$order = mysql_fetch_assoc($qry_order);
?>
<div align="center">
    <div id="frame" style="width:100%;">
    <div id="frame_title"><h3>LIST PERMINTAAN BARANG</h3></div>
    <div align="right" style="margin:5px;">
    <form name="formsearch" method="get" >
     <table class="tb">
       <tr>
           <td align="right">Tanggal Pesan&nbsp;<input type="text" name="tgl_pesan" id="tgl_pesan" readonly="readonly" class="text" style="width:100px;"
              value="<? if($_REQUEST['tgl_pesan'] !=""): echo $_REQUEST['tgl_pesan']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a>
              <input type="hidden" name="link" value="f02" />
              <input type="submit" value="Cari" class="text"/></td>
          </tr>
     </table>
    </form> 
        <div id="search">
        <table width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" class="tb">
          <tr align="center">
            <th width="5%">KODE</th>
            <th width="30%">NAMA BARANG</th>
            <th>NO BATCH</th>
            <th>TGL KADALUARSA</th>
            <th>JML PERMINTAAN</th>
            <th>SATUAN</th>
            <th>TUJUAN</th>
            <th>TGL PERMINTAAN</th>
            <th>STATUS</th>
            <th>TGL DISETUJUI</th>
            <th>JML DISETUJUI</th>
          </tr>
          <?

    $pager = new PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "tgl_pesan=".$tgl_pesan,"index.php?link=f02&");
	
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
            <td><? echo $data['kode_barang']; ?></td>
            <td><? echo $data['nama_barang']; ?></td>
            <td><? echo $data['no_batch']; ?></td>
            <td><? echo $data['expiry']; ?></td>
            <td align="right"><? echo $data['jumlahpesan']; ?></td>
            <td><? echo $data['satuan']; ?></td>
            <td><? echo $data['nama_farmasi']; ?></td> 
            <td><? echo $data['tglpesan']; ?></td>
            <td><? if($data['status_save']=="1"){
			    if($data['statusacc']=="1"){
				   echo "Disetujui";
				}else{
				   echo "Tdk Disetujui";
				}
			}?></td>
            <td><? if($data['status_save']=="1"){
			      echo $data['tglkeluar'];				
			}?></td>
            <td align="right"><? if($data['status_save']=="1"){
			      echo $data['jmlkeluar'];				
			}?></td>
         </tr>
	 <?	} 
	
	
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
<div align="left" >
<p><a href="#" onClick="printIt()"><input type="button" class="text" value="P R I N T"/></a></p>
</div>
</div>
</div>

<? 
$sql_print = "SELECT 
		  m_barang_group.nama_group,
		  m_barang_group.nama_farmasi,
		  m_barang.kode_barang,
		  m_barang.nama_barang,
		  m_barang.satuan,
		  m_barang.no_batch,
		  DATE_FORMAT(m_barang.expiry, '%d -%m -%Y') as expiry,
		  t_permintaan_barang.jumlahpesan,
		  m_barang.satuan,
		  DATE_FORMAT(t_permintaan_barang.tglpesan, '%d -%m -%Y') as tglpesan,
		  t_permintaan_barang.jumlahpesan,
		  t_permintaan_barang.statusacc,
		  t_permintaan_barang.status_save,
		  t_permintaan_barang.jmlkeluar,
		  DATE_FORMAT(t_permintaan_barang.tglkeluar, '%d -%m -%Y') as tglkeluar
		FROM
		  m_barang
		  INNER JOIN m_barang_group ON (m_barang.group_barang = m_barang_group.group_barang)
		  AND (m_barang.farmasi = m_barang_group.farmasi)
		  INNER JOIN t_permintaan_barang ON (m_barang.kode_barang = t_permintaan_barang.kodebarang)
		WHERE t_permintaan_barang.KDUNIT ='".$_SESSION['KDUNIT']."' AND t_permintaan_barang.statusacc='1' ".$search;
$get_print = mysql_query($sql_print);
?>
<div id="print_selection" style="display:none" >
                <div align="left" style="clear:both; padding:20px">
                    <div style="letter-spacing:-1px; font-size:16px; font:bold;"><?=strtoupper($header1)?></div>
                    <div style="letter-spacing:-2px; font-size:24px; color:#666; font:bold;"><?=strtoupper($header2)?></div>
					<div><?=$header3?><br /><?=$header4?></div>
                    <hr style="margin:5px;" />
                    <h1>LIST PERMINTAAN BARANG</h1>
                </div>            
        <table width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" class="tb">
          <tr align="center">
            <th width="5%">KODE</th>
            <th width="30%">NAMA BARANG</th>
            <th>NO BATCH</th>
            <th>TGL KADALUARSA</th>
            <th>JML PERMINTAAN</th>
            <th>SATUAN</th>
            <th>TUJUAN</th>
            <th>TGL PERMINTAAN</th>
            <th>TGL DISETUJUI</th>
            <th>JML DISETUJUI</th>
          </tr>
<?          
while($data_pr = mysql_fetch_array($get_print)) {?>
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
            <td><? echo $data_pr['kode_barang']; ?></td>
            <td><? echo $data_pr['nama_barang']; ?></td>
            <td><? echo $data_pr['no_batch']; ?></td>
            <td><? echo $data_pr['expiry']; ?></td>
            <td align="right"><? echo $data_pr['jumlahpesan']; ?></td>
            <td><? echo $data_pr['satuan']; ?></td>
            <td><? echo $data_pr['nama_farmasi']; ?></td> 
            <td><? echo $data_pr['tglpesan']; ?></td>
            <td><? if($data_pr['status_save']=="1"){
			      echo $data_pr['tglkeluar'];				
			}?></td>
            <td align="right"><? if($data_pr['status_save']=="1"){
			      echo $data_pr['jmlkeluar'];				
			}?></td>
         </tr>
	 <?	} 
?>
</table>
</div>

<script language="javascript">
function printIt()
{
content=document.getElementById('print_selection');
w=window.open('about:blank');
w.document.writeln("<link href='dq_sirs.css' type='text/css' rel='stylesheet' />");
w.document.write( content.innerHTML );
w.document.writeln("<script>");
w.document.writeln("window.print()");
w.document.writeln("</"+"script>");
}
</script>
