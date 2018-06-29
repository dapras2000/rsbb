<script language="javascript">
    function printIt()
    {
        content=document.getElementById('table_search');
        head=document.getElementById('head_report');
        w=window.open('about:blank');
        w.document.writeln("<link href='dq_sirs.css' type='text/css' rel='stylesheet' />");
        w.document.write( head.innerHTML );
        w.document.write( content.innerHTML );
        w.document.writeln("<script>");
        w.document.writeln("window.print()");
        w.document.writeln("</"+"script>");
    }
</script>
<script language="javascript" type="text/javascript">
    function dopilih(){
        document.cari.submit();
    }
</script>
<?php 
include("../include/connect.php");
require_once('pantri/ps_pagination_pantri.php');
$search 	= " tanggal = curdate()";
$tgl_kunjungan 	= "";
if(!empty($_GET['tgl_kunjungan'])) {
    $tgl_kunjungan =$_GET['tgl_kunjungan'];
}
if($tgl_kunjungan !="") {
    $search = " tanggal BETWEEN  '".$tgl_kunjungan."' ";
}
$tgl_kunjungan2 = "";
if(!empty($_GET['tgl_kunjungan2'])) {
    $tgl_kunjungan2 =$_GET['tgl_kunjungan2'];
} 
if($tgl_kunjungan !="") {
    if($tgl_kunjungan2 !="") {
        $search = $search." AND '".$tgl_kunjungan2."' ";
    }else {
        $search = $search." AND '".$tgl_kunjungan."' ";
    }
}
	
$ruang = "";
if(!empty($_GET['ruang'])) {
    $ruang = $_GET['ruang'];

    if($ruang !="-Pilih Ruang-") {
        $search = $search." AND a.noruang ='".$ruang."' ";
    }
}

?>
<div align="center">
    <div id="frame">
        <div id="frame_title"><h3>LIST PERENCANAAN PEMBELIAN MAKANAN</h3></div>
        <div align="right" style="margin:5px; margin-right:10px;">
	
            <form name="formsearch" method="get">
            <table class="tb">
			<tr>
				<td>Dari Tanggal</td>
				<td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" value="<? if($_REQUEST['tgl_kunjungan'] !=""): echo $_REQUEST['tgl_kunjungan']; else: echo date('Y/m/d'); endif;
?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
			</tr>
			<tr>
				<td>Sampai Tanggal</td>
				<td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" value="<?if($_REQUEST['tgl_kunjungan2'] !=""): echo $_REQUEST['tgl_kunjungan2']; else: echo date('Y/m/d'); endif;
?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
			</tr>
                    <!--<tr>
                        <td>Nama Ruang</td>
						<td><select name="ruang" id="ruang" class="text">
							<option selected="selected">-Pilih Ruang-</option>
							<?php 
								$sql = mysql_query('select * from m_ruang');
								while($data=mysql_fetch_array($sql)){
							?>
								<option value="<?=$data['no']?>" <?
                                    if($data['no']==$_GET['ruang']) echo "selected=selected";
                                            ?>><?=$data['nama']?></option>
								<?php } ?>
                            </select></td>
						</tr>-->
                    <tr>
                        <td align="right"><input type="submit" onclick="dopilih()" value="C A R I" class="text" /></td>
                    </tr>
                </table>
                <input type="hidden" name="link" value="list_jenis_makanan"/>
            </form>

            <div id="head_report" style="display:none" >
                <div align="left" style="clear:both; padding:20px">
                    <div style="letter-spacing:-1px; font-size:16px; font:bold;"><?=strtoupper($header1)?></div>
                    <div style="letter-spacing:-2px; font-size:24px; color:#666; font:bold;"><?=strtoupper($header2)?></div>
					<div><?=$header3?><br /><?=$header4?></div>
                    <hr style="margin:5px;" />
                    <h2>LIST DATA PASIEN</h2>
                </div>            
            </div>
			<?php
			$qry = "SELECT a.* FROM m_ruang a WHERE a.no = '".$ruang."'";
					$get = mysql_query ($qry);
					$userdata = mysql_fetch_array($get);
			?>
            <div id="table_search">
                <table width="95%" style="margin:10px;" border="1" class="tb" cellspacing="1" cellspading="1" title="List Semua Data.">
                    <tr align="center">
                        <th>JENIS DIET</th>
						<th>Tanggal</th>
						<th>Satuan</th>
						<th>Jumlah</th>
						<th>Harga Satuan (Rp.)</th>
						<th>Jumlah Harga (Rp.)</th>
					</tr>
=                    <?php
					//$query = "SELECT a.*, (select count(b.jenismakanan) from t_dpmp b where b.jenismakanan = a.id and shift = 1 and DATE(TANGGAL) BETWEEN '".$tgl_kunjungan."' and '".$tgl_kunjungan2."') jumlah_pagi,
//(select count(b.jenismakanan) from t_dpmp b where b.jenismakanan = a.id and shift = 2 and DATE(TANGGAL) BETWEEN '".$tgl_kunjungan."' and '".$tgl_kunjungan2."') jumlah_siang,
//(select count(b.jenismakanan) from t_dpmp b where b.jenismakanan = a.id and shift = 3 and DATE(TANGGAL) BETWEEN '".$tgl_kunjungan."' and '".$tgl_kunjungan2."') jumlah_sore FROM m_jenis_makanan a";
				
				$query = "select * from m_bahan_makanan where ".$search."";
					 $pager = new PS_Pagination($connect, $query, 55, "tgl_kunjungan=".$tgl_kunjungan."&tgl_kunjungan2=".$tgl_kunjungan2,"index.php?link=list_jenis_makanan&");
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
                    while($result = mysql_fetch_array($rs)) {
					?>
					<tr <? echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
						<td><?php echo $result['jenis_barang'];?></td>
						<td align="center"><?php echo $result['tanggal']; ?></td>
						<td align="center"><?php echo $result['satuan']; ?></td>
						<td align="center"><?php echo $result['jumlah']; ?></td>
						<td align="center"><?php echo number_format($result['harga_satuan']); ?></td>
						<td align="center"><?php echo number_format($result['jumlah_harga']); ?></td>
					</tr>
                    <? }
					
					
                    //Display the full navigation in one go
                    //echo $pager->renderFullNav();

                    //Or you can display the inidividual links
                    echo "<div style='padding:5px;' align=\"center\"><br/>";

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
    <br />
	<?php
	//$query = "SELECT a.id as NO, a.jenis_makanan as JENISDIET, (select count(b.jenismakanan) from t_dpmp b where b.jenismakanan = a.id and shift = 1 and DATE(TANGGAL) BETWEEN '".$tgl_kunjungan."' and '".$tgl_kunjungan2."') PAGI, (select count(b.jenismakanan) from t_dpmp b where b.jenismakanan = a.id and shift = 2 and DATE(TANGGAL) BETWEEN '".$tgl_kunjungan."' and '".$tgl_kunjungan2."') SIANG, (select count(b.jenismakanan) from t_dpmp b where b.jenismakanan = a.id and shift = 3 and DATE(TANGGAL) BETWEEN '".$tgl_kunjungan."' and '".$tgl_kunjungan2."') SORE, (select sum(PAGI+SIANG+SORE)) JUMLAH FROM m_jenis_makanan a";
	if($tgl_kunjungan!="" AND $tgl_kunjungan2!=""){
		$query = "SELECT id, jenis_barang, satuan, jumlah, harga_satuan, jumlah FROM m_bahan_makanan WHERE DATE(TANGGAL) BETWEEN '".$tgl_kunjungan."' and '".$tgl_kunjungan2."'";
	}else{
		$query = "SELECT id, jenis_barang, satuan, jumlah, harga_satuan, jumlah FROM m_bahan_makanan WHERE tanggal='".date('Y/m/d')."' ";
	}
	?>
    <div align="left">
        <form name="formprint" method="post" action="gudang/excelexport_perencanaan_makanan.php" target="_blank" >
            <input type="hidden" name="query" value="<?=$query?>" />
            <input type="hidden" name="tanggal1" value="<?=$tgl_kunjungan?>" />
			<input type="hidden" name="tanggal2" value="<?=$tgl_kunjungan2?>" />
			<input type="hidden" name="header" value="LIST PERENCANAAN PEMBELIAN MAKANAN" />
            <input type="hidden" name="filename" value="list_perencanaan_pembilian_makanan" />
            <input type="submit" value="Export To Ms Excel Document" class="text" />
        </form>
    </div>
</div>