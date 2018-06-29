<script src="js/jquery-1.7.min.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript">
    function pilih(){
        window.location = "index.php?link=<?php echo $_GET['link'];?>&bulan=<?php echo $_GET['bulan'];?>&tahun=<?php echo $_GET['tahun'];?>&r_barang=<?php echo $_GET['r_barang'];?>&grpbarang=<?php echo $_GET['grpbarang'];?>&nm_barang=<?php echo $_GET['nm_barang'];?>&jml="+m;}
    function pilih10(){window.location = "index.php?link=<?php echo $_GET['link'];?>&bulan=<?php echo $_GET['bulan'];?>&tahun=<?php echo $_GET['tahun'];?>&r_barang=<?php echo $_GET['r_barang'];?>&grpbarang=<?php echo $_GET['grpbarang'];?>&nm_barang=<?php echo $_GET['nm_barang'];?>&jml="+m;}
    function pilih100(){window.location = "index.php?link=<?php echo $_GET['link'];?>&bulan=<?php echo $_GET['bulan'];?>&tahun=<?php echo $_GET['tahun'];?>&r_barang=<?php echo $_GET['r_barang'];?>&grpbarang=<?php echo $_GET['grpbarang'];?>&nm_barang=<?php echo $_GET['nm_barang'];?>&jml="+m;}
    function pilih500(){window.location = "index.php?link=<?php echo $_GET['link'];?>&bulan=<?php echo $_GET['bulan'];?>&tahun=<?php echo $_GET['tahun'];?>&r_barang=<?php echo $_GET['r_barang'];?>&grpbarang=<?php echo $_GET['grpbarang'];?>&nm_barang=<?php echo $_GET['nm_barang'];?>&jml="+m;}
</script>
<?php 
session_start();
include("ps_pagination.php");

$jmle=$_GET['jml'];
if ($jmle=='ALL'){
    $jml =' AND saldo < 10000000 ';
}
if ($jmle=='10'){
    $jml =' AND saldo < 10 ';
}
if ($jmle=='100'){
    $jml =' AND saldo < 100 ';
}
if ($jmle=='500'){
    $jml =' AND saldo < 500 ';
}
$unit = $_SESSION['KDUNIT']; 
$c = $_GET['r_barang'];

$bulan = "";
if(!empty($_GET['bulan'])) {
    $bulan =$_GET['bulan'];
} 

$tahun = "";
if(!empty($_GET['tahun'])) {
    $tahun =$_GET['tahun'];
} 

$group = "";
if(!empty($_GET['grpbarang'])) {
    $group =$_GET['grpbarang'];
} 

if(strlen($bulan)==1) {
    $bl = "0".$bulan;
}else {
    $bl = $bulan;
}

$search = "";
if(!empty($_GET['nm_barang'])) {
    $nm_barang =$_GET['nm_barang'];
    $search = " AND m_barang.nama_barang like '".$nm_barang."%'";
} 


$sql="SELECT 
	  m_barang.kode_barang,
	  m_barang.nama_barang, 
	  m_barang.harga,
	  m_barang.satuan,
	  (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND YEAR(tanggal) = '".$tahun."' 	
			AND MONTH(tanggal) = '".$bulan."' 
			AND KDUNIT = ".$unit." ".$jml."    
			ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR  
    FROM
      m_barang 
	  INNER JOIN m_barang_unit ON m_barang.kode_barang = m_barang_unit.kode_barang
	  AND m_barang_unit.KDUNIT = ".$unit." 
	  WHERE  m_barang.farmasi = '".$c."' AND m_barang.group_barang = '".$group."' ".$search;

$qry_order = mysql_query($sql);
$order = mysql_fetch_assoc($qry_order);
?>
<div id="addbarang"></div>
<div align="center">
    <div id="frame" style="width:100%">
        <? switch ($bulan) {
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

        $sql_unit = "SELECT DEPARTEMEN FROM m_login where KDUNIT = ".$unit;
        $get_unit = mysql_query($sql_unit);
        $dat_unit = mysql_fetch_assoc($get_unit);
        ?>

        <div id="frame_title"><h3>LAPORAN STOK BULAN <?=$bulan_name." ".$tahun?> UNIT <?=$dat_unit['DEPARTEMEN']?><span id="ekspor" onclick="ekspor();" style="cursor: pointer;">                                
                               &nbsp;&nbsp;[ Ekspor Laporan Stok ]
                               
                            </span>
                               &nbsp;&nbsp;&nbsp;&nbsp;<input type="Radio" name="pilih" id="pilih" onclick="pilih(m='all')"<?php if($_GET['jml']=='all'||$_GET['jml']==''){ echo "checked";}?>>All
                               &nbsp;&nbsp;<input type="Radio" name="pilih" id="pilih" onclick="pilih10(m='10')" <?php if($_GET['jml']=='10'){ echo "checked";}?>>< 10
                               &nbsp;&nbsp;<input type="Radio" name="pilih" id="pilih" onclick="pilih100(m='100')"<?php if($_GET['jml']=='100'){ echo "checked";}?>>< 100
                               &nbsp;&nbsp;<input type="Radio" name="pilih" id="pilih" onclick="pilih500(m='500')"<?php if($_GET['jml']=='500'){ echo "checked";}?>>< 500 
                           </h3>
                            
                        </div>
        <div align="center" style="margin:5px;">
            <div id="table_search">
                    <table border="0" cellspacing="1" cellpadding="1" bordercolor="#999999" class="tb" width="99%">
                        <tr>
                          <th width="30"><div align="center">NO</div></th>
                          <th width="70"><div align="center">KODE</div></th>
                          <th width="200"><div align="center">NAMA BARANG</div></th>
                          <th width="80"><div align="center">SATUAN</div></th>
                          <th width="80"><div align="center">STOK</div></th>
                            <th width="80"><div align="center">HARGA SATUAN (Rp)</div></th>
                            <th width="80"><div align="center">JUMLAH (Rp)</div></th>
                            <th width="60">&nbsp;</th>
                        </tr>
                        <?
						$NO=0;		
                        $pager = new PS_Pagination($connect, $sql, 15, 5, "bulan=".$bulan."&tahun=".$tahun."&grpbarang=".$group."&nm_barang=".$nm_barang."&r_barang=".$c."&jml=".$_GET['jml'], "index.php?link=f66x&");

                        //The paginate() function returns a mysql result set
                        $rs = $pager->paginate();
                        if(!$rs) die(mysql_error());
                        $x= 1;
                        while($data = mysql_fetch_array($rs)) {
                            if($data['STOKAKHIR']<10){
                            ?>
                        <tr <?   echo "class =";
                            $count++;
                            if ($count % 2) {
                                echo "tr1";
                            }
                            else {
                                echo "tr2";
                            }
                                ?>>

                             <td><? $NO=($NO+1);if ($_GET['page']==0){$hal=0;}else{$hal=$_GET['page']-1;} echo ($hal*15)+$NO;?></td>
                            <td><?=$data['kode_barang']?></td>
                            <td><?=$data['nama_barang']?></td>
                            <td><?=$data['satuan']?></td>
                            <td align="right"><? if($data['STOKAKHIR']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['STOKAKHIR'];
                                    }?></td>
                            <td align="right"><? if($data['harga']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['harga'];
                                    }?></td>
                            <td align="right"><?=$data['STOKAKHIR'] *  $data['harga'];?></td>
                            <td><a href="index.php?link=f66y&kode=<?=$data['kode_barang']?>&nama=<?=$data['nama_barang']?>&unit=<?=$_SESSION['KDUNIT']?>&bulan=<?=$_GET['bulan']?>&tahun=<?=$_GET['tahun']?>" class="text" >KARTU STOK</a></td>
                        </tr>
                            <?	$x++;
                        } }?>
                    </table>
                <?

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
<br />
<div id="msg" >
</div>
<p></p>
<div id="tablexl">
                    <table>
                        <tr>
                            <th>NO</th>
                            <th>KODE</th>
                            <th>NAMA BARANG</th>
                            <th>SATUAN</th>
                            <th>STOK</th>
                            <th>HARGA SATUAN (Rp)</th>
                            <th>JUMLAH (Rp)</th>
                        </tr>
                        <?
                        $NO=0;      
                        $pager = new PS_Pagination($connect, $sql, 1000000, 5, "bulan=".$bulan."&tahun=".$tahun."&grpbarang=".$group."&nm_barang=".$nm_barang."&r_barang=".$c, "index.php?link=f66x&");

                        //The paginate() function returns a mysql result set
                        $rs = $pager->paginate();
                        if(!$rs) die(mysql_error());
                        $x= 1;
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

                             <td><? $NO=($NO+1);if ($_GET['page']==0){$hal=0;}else{$hal=$_GET['page']-1;} echo ($hal*15)+$NO;?></td>
                            <td><?=$data['kode_barang']?></td>
                            <td><?=$data['nama_barang']?></td>
                            <td><?=$data['satuan']?></td>
                            <td><? if($data['STOKAKHIR']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['STOKAKHIR'];
                                    }?></td>
                            <td><? if($data['harga']=="") {
                                        echo "0";
                                    }else {
                                        echo $data['harga'];
                                    }?></td>
                            <td><?=$data['STOKAKHIR'] *  $data['harga'];?></td>
                            
                        </tr>
                            <?  $x++;
                        } ?>
                    </table>
</div>
<script type="text/javascript">
    $('#tablexl').hide();
    function ekspor(){//table_search
                var bulane = '<?php echo $bulan_name;?>';
                var tahune = '<?php echo $_GET[tahun];?>'
                window.open('data:application/vnd.ms-excel,' + $('#tablexl').html());
                e.preventDefault();
            }
</script>