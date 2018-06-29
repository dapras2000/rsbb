<?php
session_start();
include("./include/connect.php");
include('./gudang/ps_pagination.php');

$farmasi = "x";

if($_SESSION['KDUNIT']=="12") {
    $farmasi = "1";
}else if($_SESSION['KDUNIT']=="13") {
    $farmasi = "0";
} 

$bulan = "";
if(!empty($_GET['bulan'])) {
    $bulan =$_GET['bulan'];
} 

$tahun = "";
if(!empty($_GET['tahun'])) {
    $tahun =$_GET['tahun'];
}

$nm_barang = "";
if(!empty($_GET['nm_barang'])) {
    $nm_barang =$_GET['nm_barang'];
} 

$grp_barang = "";
if(!empty($_GET['grp_barang'])) {
    $grp_barang =$_GET['grp_barang'];
} 

$exp = "";
$exp_v = "";

if(!empty($_GET['exp_v'])) {

    $exp_v = $_GET['exp_v'];

    if(!empty($_GET['exp'])) {
        $exp =$_GET['exp'];
    }

}

$search = "";
if($nm_barang !="") {
    $search = " AND nama_barang LIKE '%".$nm_barang."%' ";
}

if($grp_barang !="") {
    $search = $search." AND m_barang.group_barang = '".$grp_barang."' ";
}

if($exp !="") {
    if($exp=="6") {
        $search = $search." AND FORMAT(DATEDIFF(m_barang.expiry, CURDATE())/30,0) > 3 AND FORMAT(DATEDIFF(m_barang.expiry, CURDATE())/30,0) <= 6 ";
    }else if($exp=="3") {
        $search = $search." AND FORMAT(DATEDIFF(m_barang.expiry, CURDATE())/30,0) > 0 AND FORMAT(DATEDIFF(m_barang.expiry, CURDATE())/30,0) <= 3 ";
    }else if($exp=="1") {
        $search = $search." AND FORMAT(DATEDIFF(m_barang.expiry, CURDATE())/30,0) <= 0 ";
    }
}

	$sql="SELECT 
			          (SELECT FORMAT(DATEDIFF(m_barang.expiry, CURDATE())/30,0)) AS DATEEXP,
					  m_barang_group.nama_group,
					  m_barang.kode_barang,
					  m_barang.no_batch,
					  DATE_FORMAT(m_barang.expiry, '%d -%m -%Y') as expiry, 
					  m_barang.expiry as kadaluarsa, 
					  m_barang.nama_barang,
					  m_barang.satuan,
					  m_barang.harga,
					  m_barang.hide_when_print, 
					  (SELECT saldo FROM t_barang_stok
					  WHERE kode_barang = m_barang.kode_barang 
					  AND KDUNIT = ".$_SESSION['KDUNIT']." 
					  ORDER BY  kd_stok DESC LIMIT 1) as stok
					  FROM m_barang 
					  INNER JOIN m_barang_group ON (m_barang.group_barang = m_barang_group.group_barang)
  AND (m_barang.farmasi = m_barang_group.farmasi)
					  WHERE m_barang.farmasi = '".$farmasi."' ".$search."
					  ORDER BY m_barang.kode_barang";

$qry_order = mysql_query($sql);
$order = mysql_fetch_assoc($qry_order);
?>

<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>MASTER BARANG</h3></div>
        <div style="margin:5px;">

            <table width="95%" border="0" class="tb">
                <tr>
                    <td valign="top"><div id="addbarang" align="left"></div></td>
                    <td align="right" valign="top"><form name="formbarang" method="get" >

                            <table class="tb">
                                <tr>
                                    <? if($grp_barang!="") {
                                        $select = $grp_barang;
                                    }else {
                                        $select = "x";
                                    }?>
                                    <td>Group</td>
                                    <td><select name="grp_barang" >
                                            <? if($_SESSION['KDUNIT']=="12") { ?>
                                            <option value="0" <? if($select=="0") {
                                                    echo "selected=selected";
                                                        }?> > -- </option>
                                            <option value="1" <? if($select=="1") {
                                                    echo "selected=selected";
                                                        }?> >Obat</option>
                                            <option value="2" <? if($select=="2") {
                                                    echo "selected=selected";
                                                        }?> >Alat Kesehatan Pakai Habis</option>
                                            <option value="3" <? if($select=="3") {
                                                    echo "selected=selected";
                                                        }?> >Bahan Radiologi</option>
                                            <option value="4" <? if($select=="4") {
                                                    echo "selected=selected";
                                                        }?> >Gas</option>
                                            <option value="5" <? if($select=="5") {
                                                    echo "selected=selected";
                                                        }?> >Reagensia</option>
                                                        <? }else if($_SESSION['KDUNIT']=="13") { ?>
                                            <option value="1" >ATK</option>
                                            <option value="2" >Cetakan</option>
                                            <option value="3" >ART</option>
                                            <option value="4" >Alat Bersih dan Pembersih</option>
                                            <option value="5" >Lain - Lain</option>
                                                <? } ?>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td>Nama Barang</td>
                                    <td><input type="text" name="nm_barang" class="text"
                                               value="<? if($nm_barang!="") {
                                                   echo $nm_barang;
                                               }?>"/></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="exp_v" value="v" <? if($exp_v != "") {
                                            echo "checked=checked";
                                               } ?>  />&nbsp;Tampilkan Hanya</td>
                                    <td><input type="radio" name="exp" value="3" <? if($exp == "3") {
                                            echo "checked=checked";
                                               } ?> />&nbsp;3 Bulan Kadaluarsa</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input type="radio" name="exp" value="6" <? if($exp == "6") {
                                            echo "checked=checked";
                                               } ?> />&nbsp;6 Bulan Kadaluarsa</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input type="radio" name="exp" value="1" <? if($exp == "1") {
                                            echo "checked=checked";
                                               } ?> />&nbsp;Kadaluarsa</td>
                                </tr>
                                <tr><td colspan="2"><input type="hidden" name="link" value="82" />
                                        <input type="submit" value="C a r i" class="text"/></td>
                                </tr>
                            </table>
                        </form></td>
                </tr>
            </table>
            <div align="left" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" class="text" onclick="javascript: MyAjaxRequest('addbarang','gudang/prosesbarang.php?opt=1');" >A d d B a r a n g</a></div>
        </div>
        <div id="table_search"> 
            <table width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" class="tb">
                <tr align="center">
                    <th>Hide</th>
                    <th>Kode</th>
                    <th>No Batch</th>
                    <th>Nama Barang</th>
                    <th>Tgl Kadaluarsa</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Group</th>
                    <th width="80px">Option</th>
                </tr>
                <?

                $pager = new PS_Pagination($connect, $sql, 15, 5, "nm_barang=".$nm_barang."&grp_barang=".$grp_barang, "index.php?link=82&");

//The paginate() function returns a mysql result set 
                $rs = $pager->paginate();
                if(!$rs) die(mysql_error());
                $x= 1;
                while($data = mysql_fetch_array($rs)) {

                    $exp = $data['DATEEXP'];
                    $warna = "";
                    $coret = "";

                    if($exp > 3 && $exp <= 6) {
                        $warna =  "#00F";
                    }else if($exp > 0 && $exp <= 3) {
                        $warna =  "#F00";
                    }else if($exp <= 0) {
                        $coret="text-decoration:line-through";
                    }


                    ?>
                <div id="del<?=$data['kode_barang'];?>" >
                    <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
                        <td align="center"><div id="cek<?=$data['kode_barang']?>" >
                                <input type="checkbox" name="<?=$data['kode_barang']?>" <? if($data['hide_when_print']=="1") {
                                        echo "checked=checked";
                                           } ?> value="1" onclick="javascript: MyAjaxRequest('cek<?=$data['kode_barang']?>','gudang/saveorderbarangpengeluaran.php?cekbarang=<?=$data['kode_barang']?>'); return false;" /></div>
                        </td>
                        <td ><? echo $data['kode_barang']; ?></td>
                        <td ><? echo $data['no_batch']; ?></td>
                        <td ><? echo $data['nama_barang']; ?></td>


                        <td style="color:<?=$warna?>;<?=$coret?>;" ><? echo $data['expiry']; ?></td>

                        <td align="right"><? if(empty($data['stok'])) {
                                    echo"0";
                                }else {
                                    echo $data['stok'];
                                } ?></td>
                        <td><?=$data['satuan']; ?></td>
                        <td align="right"><? echo $data['harga']; ?></td>
                        <td><? echo $data['nama_group']; ?></td>
                        <td><a href="#" class="text" onclick="javascript: MyAjaxRequest('addbarang','gudang/prosesbarang.php?opt=2&amp;idxbarang=<?=$data['kode_barang']?>');" >E d i t</a> | <a href="#" class="text" onclick="javascript: if(confirm('Yakin Dihapus.')){
                            MyAjaxRequest('del<?=$data['kode_barang']?>','gudang/prosesbarang.php?opt=3&amp;idxbarang=<?=$data['kode_barang']?>'); return false; }else{ return false;}" >D e l</a></td>
                    </tr></div>
                    <?	$x++;
                }

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
<div id="msg" ></div>
<p></p>
