<?php 
session_start();
include("../include/connect.php");
require_once('new_pagination.php');

$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])) {
    $tgl_kunjungan =$_GET['tgl_kunjungan'];
} 

if($tgl_kunjungan !="") {
    $search = " DATE(a.masukrs) = '".$tgl_kunjungan."' ";
}else {
    $search = "";
}

$ruang = "";
if(!empty($_GET['ruang'])) {
    $ruang = $_GET['ruang'];

    if($ruang !="-Pilih Ruang-") {
        if($search != "") {
            $search = $search." AND a.noruang ='".$ruang."' ";
        }else {
            $search = "a.noruang ='".$ruang."' ";
        }
    }
}

$norm = "";
if(!empty($_GET['norm'])) {
    $norm =$_GET['norm'];
} 

if($norm !="") {
    if($search != "") {
        $search = $search." AND b.nomr = '".$norm."' ";
    }else {
        $search = "b.nomr = '".$norm."' ";
    }
}

$nama = "";
if(!empty($_GET['nama'])) {
    $nama =$_GET['nama'];
} 

if($nama !="") {
    if($search != "") {
        $search = $search." AND b.nama LIKE '%".$nama."%' ";
    }else {
        $search = "b.nama LIKE '%".$nama."%' ";
    }
}

?>
<div align="center">
    <div id="frame">
        <div id="frame_title"><h3>List Rawat Inap</h3></div>
        <div align="right" style="margin:5px;">

            <form name="formsearch" method="get" >
                <table class="tb">
                    <tr>
                        <td>NO MR</td>
                        <td><input type="text" name="norm" id="norm" value="<? if($norm!="") {
                                echo $norm;
                                   }?>" class="text" /></td>
                        <td>Tanggal</td>
                        <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" class="text"
                                   value="<? if($tgl_kunjungan!="") {
                                       echo $tgl_kunjungan;
                                   }?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td>Nama Pasien</td>
                        <td><input type="text" name="nama" id="nama" value="<? if($nama!="") {
                                echo $nama;
                                   }?>" class="text" /></td>
                        <td >Ruang</td>
                        <td>
                            <select name="ruang" class="text">
                                <option selected="selected">-Pilih Ruang-</option>
                                <?	$QRY_RUANG = mysql_query("SELECT * FROM m_ruang ORDER BY no ASC");
                                while($DATA_RUANG = mysql_fetch_array($QRY_RUANG)) {
                                    ?>
                                <option value="<?=$DATA_RUANG['no']?>" <?
                                    if($DATA_RUANG['no']==$_GET['ruang']) echo "selected=selected";
                                            ?>><?=$DATA_RUANG['nama']?></option>
                                            <? } ?>
                            </select></td>
                    </tr>
                    <tr><td colspan="4" ><input type="checkbox" name="pulang" value="1"
                            <?php if(!empty($_GET['pulang'])) echo "checked=checked";  ?>
                                                />&nbsp;Pulang&nbsp;&nbsp;
                            <input type="hidden" name="link" value="list_billing_ranap" />
                            <input type="submit" value="Cari" class="text"/>
                        </td>
                    </tr>
                </table>
            </form>
            <div id="table_search">
                <table border="0" class="tb" cellpadding="1" cellspacing="1">
                    <tr align="center">
                        <th>NO</th>
                        <th>NOMR</th>
                        <th>Nama Pasien</th>
                        <th>Alamat Pasien</th>
                        <th>Tgl Lahir</th>
                        <th>Jenis Pembayaran</th>
                        <th>Tanggal Masuk RS</th>
                        <th>Tanggal Pindah </th>
                        <th>Tanggal Keluar RS </th>
                        <th>Nama Ruang</th>
                        <th>No Tempat Tidur</th>
                        <th>Admin</th>
                        <th colspan="2">Actions</th>
                    </tr>
                    <?
                    if($search != "") {
                        $search = "WHERE ".$search;
                    }
                    $sql="SELECT a.id_admission, a.nomr, a.statusbayar, a.masukrs, a.noruang, a.nott,
					a.icd_masuk, a.NIP, a.tgl_pindah, b.nama as namapasien, b.alamat, b.tgllahir, a.keluarrs,
					c.nama as jenisbayar, e.nama
					FROM t_admission a
					join  m_pasien b on a.nomr=b.nomr 
					join  m_carabayar c on a.statusbayar=c.kode 
					join t_bayarranap d on d.idxdaftar = a.id_admission
					inner join   m_ruang e on a.noruang=e.no ".$search;
                    if(empty($_GET['pulang'])) {
                        if($search=="") {
                            $sql = $sql." WHERE (a.keluarrs is null or a.keluarrs='NULL')";
                        }else {
                            $sql = $sql." AND (a.keluarrs is null or a.keluarrs='NULL')";
                        }
                    }


                    $NO=0;
                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan."&ruang=".$ruang."&nama=".$nama."&nomr=".$nomr,"index.php?link=list_billing_ranap&");

                    //The paginate() function returns a mysql result set
                    $NO=0;
                    $rs = $pager->paginate();
                    while($data = mysql_fetch_array($rs)) {?>
                    <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>                 <td ><? $NO=($NO+1);
                                    if ($_GET['page']==0) {
                                        $hal=0;
                                    }else {
                                        $hal=$_GET['page']-1;
                                    } echo

    ($hal*15)+$NO;?></td>
                        <td><?php echo $data['nomr']; ?></td>
                        <td><?php echo $data['namapasien']; ?></td>
                        <td><?php echo $data['alamat']; ?></td>
                        <td><?php echo $data['tgllahir']; ?></td>
                        <td><?php echo $data['jenisbayar']; ?></td>
                        <td><?php echo $data['masukrs']; ?></td>
                        <td><?php if($data['tgl_pindah']=="0000-00-00") {
                                    echo "-";
                                }else {
                                    echo $data['tgl_pindah'];
    } ?></td>
                        <td><?php echo $data['keluarrs']; ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['nott']; ?></td>
                        <td><?php echo $data['NIP']; ?></td>
                        <td><a href="admission/detail_billing.php?id=<?=$data['id_admission'];?>" ><input class="text" type="button" name="hapusadmission" value="Detail"/></a></td>
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
<p></p>
