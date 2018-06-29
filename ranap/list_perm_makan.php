<?php 
session_start();
include("include/connect.php");
require_once('new_pagination.php');

$ruang = "";
if(!empty($_GET['ruang'])) {
    $ruang = $_GET['ruang'];

    if($ruang !="-Pilih Ruang-") {
        $search = $search." AND a.noruang ='".$ruang."' ";
    }
}

$norm = "";
if(!empty($_GET['norm'])) {
    $norm =$_GET['norm'];
} 

if($norm !="") {
    $search = $search." AND b.nomr = '".$norm."' ";
}

$nama = "";
if(!empty($_GET['nama'])) {
    $nama =$_GET['nama'];
} 

if($nama !="") {
    $search = $search." AND b.nama LIKE '%".$nama."%' ";
}
?>

<div align="center">
    <div id="frame">
        <div id="frame_title">
            <h3>LIST PERMINTAAN MAKAN PASIEN</h3></div>
        <div align="right" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table class="tb">
                    <tr>
                        <td>NO MR</td>
                        <td><input type="text" name="norm" id="norm" value="<? if($norm!="") {
                                echo $norm;
                                   }?>" class="text" /></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
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
                    <tr><td colspan="4" >
                            <input type="hidden" name="link" value="129x" />
                            <input type="submit" value="Cari" class="text"/>
                        </td>
                    </tr>
                </table>
            </form>
            <div id="table_search">
                <table width="95%" class="tb" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Rawat Inap">
                    <tr>
                        <th>NOMR</th>
                        <th>Nama Pasien</th>
                        <th>Alamat Pasien</th>
                        <th>Jenis Pembayaran</th>
                        <th>Tanggal Masuk RS</th>
                        <th>Tanggal Pindah</th>
                        <th>Nama Ruang</th>
                        <th>No Bed</th>
                        <th>Jenis Makanan</th>
                        <th>Tipe</th>
                        <th>Keterangan</th>
                        <th>&nbsp;</th>
                    </tr>
                    <?
                    $sql = "SELECT a.id_admission, b.nama as namapasien, a.tgl_pindah, a.nomr, b.alamat, a.statusbayar, c.nama as jenisbayar, a.masukrs, a.noruang, e.nama, a.nott, a.icd_masuk, a.NIP, d.jenis_penyakit,
    			 (select case TYPEMAKANAN
					   when 1 then 'PASIEN YANG MENDAPAT MAKANAN BIASA'
					   when 2 then 'PASIEN YANG MENDAPAT MAKANAN KHUSUS'
					   ELSE '-'
			 end from t_dpmp where idxdaftar=a.id_admission order by idx desc limit 1) as TYPEMAKANAN,
                         (select case KETERANGAN
		 		   when 1 then 'TKTP'
 				   when 2 then 'RG'
				   when 3 then 'DL'
                   when 4 then 'DH'
				   when 5 then 'DM'
				   when 6 then 'DJ'
				   when 7 then 'TP'
				   when 8 then 'RP.r'
				   when 9 then 'RP'
				   ELSE '-'
		 end from t_dpmp where idxdaftar=a.id_admission order by idx desc limit 1) as KETERANGAN,
 	     (select case JENISMAKANAN
		           when 1 then 'NASI'
 				   when 2 then 'LUNAK'
				   when 3 then 'BUBUR SARING'
                   when 4 then 'CAIR'
				   when 5 then 'SONDE'
				   ELSE '-'
		 end from t_dpmp where idxdaftar=a.id_admission order by idx desc limit 1) as JENISMAKANAN 
FROM t_admission a inner join m_pasien b on a.nomr=b.nomr
inner join m_carabayar c on a.statusbayar=c.kode 
left join icd d on a.icd_masuk=d.icd_code 
inner join m_ruang e on a.noruang=e.no
WHERE (a.keluarrs is null or a.keluarrs='NULL') ".$search." ORDER BY a.nott ASC";

                    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan."&ruang=".$ruang."&nama=".$nama."&nomr=".$nomr,"index.php?link=129x&");

                    //The paginate() function returns a mysql result set
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
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
                        <td><? echo $data['nomr'];?></td>
                        <td><?php echo $data['namapasien']; ?></td>
                        <td><?php echo $data['alamat']; ?></td>
                        <td><?php echo $data['jenisbayar']; ?></td>
                        <td><?php echo $data['masukrs']; ?></td>
                        <td><?php if($data['tgl_pindah']=="0000-00-00") {
                                    echo "-";
                                }else {
                                    echo $data['tgl_pindah'];
                                } ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['nott']; ?></td>
                        <td><?php echo $data['JENISMAKANAN']; ?></td>
                        <td><?php echo $data['TYPEMAKANAN']; ?></td>
                        <td><?php echo $data['KETERANGAN']; ?></td>
                        <td><?php if($data['JENISMAKANAN']!="") { ?>
                            <a href="index.php?link=121&amp;id_admission=<?php echo $data['id_admission']?>&amp;makan=ubah" ><input type="button" class="text" value="Ubah" /></a>
                                    <?php }else { ?>
                            <a href="index.php?link=121&amp;id_admission=<?php echo $data['id_admission']?>&amp;makan=tambah" ><input type="button" class="text" value="Tambah" /></a>
                                    <?php } ?>
                        </td>
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
    <br />
    <?
    $qry_dpmp = "SELECT a.id_admission, a.nomr, a.noruang,
    			 (select TYPEMAKANAN
                            from t_dpmp where idxdaftar=a.id_admission order by idx desc limit 1) as TYPEMAKANAN,
                         (select KETERANGAN
                            from t_dpmp where idxdaftar=a.id_admission order by idx desc limit 1) as KETERANGAN,
                         (select JENISMAKANAN
		           from t_dpmp where idxdaftar=a.id_admission order by idx desc limit 1) as JENISMAKANAN,
                         (select SNACK
		           from t_dpmp where idxdaftar=a.id_admission order by idx desc limit 1) as SNACK,
                           (select KETERANGANTAMBAHAN
		           from t_dpmp where idxdaftar=a.id_admission order by idx desc limit 1) as KETERANGANTAMBAHAN
FROM t_admission a inner join m_pasien b on a.nomr=b.nomr
inner join m_carabayar c on a.statusbayar=c.kode
left join icd d on a.icd_masuk=d.icd_code
inner join m_ruang e on a.noruang=e.no
WHERE (a.keluarrs is null or a.keluarrs='NULL') ".$search." ORDER BY a.nott ASC";
    ?>
    <div align="left">
        <form name="formdpmp" method="post" action="ranap/save_all_dpmp.php" target="_blank" >
            <input type="hidden" name="query" value="<?=$qry_dpmp?>" />
            Shift :
            <input type="radio" name="SHIFT" value="1" checked="checked"/> Pagi
            <input type="radio" name="SHIFT" value="2"/> Siang
            <input type="radio" name="SHIFT" value="3"/> Sore
            &nbsp; &nbsp; &nbsp;
            <input type="submit" value="KIRIM KE GIZI" class="text" />
        </form>
    </div>
</div>