<?php 
session_start();
include("include/connect.php");
require_once('ps_pagination_x.php');
?>

<div align="center">
    <div id="frame">
        <div id="frame_title"><h3>RINGKASAN RIWAYAT RAWAT INAP</h3></div>
        <div align="left" style="margin:5px;">
            <table width="317" border="0" cellspacing="0" class="tb">
                <tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['nomr']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>


            <div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr align="center">
                        <th width="5%">No</th>
                        <th width="15%">Tgl Masuk</th>
                        <th width="15%">Tgl Keluar</th>
                        <th width="15%">Ruang/ Kelas Rawat</th>
                        <th width="15%">Dokter Yg Merawat</th>

                        <th width="20%">Diagnosa</th>
                        <th width="10%">Cara Bayar</th>
                    </tr>
                    <?
                    $sql = "SELECT
			  t_admission.masukrs,
			  t_admission.keluarrs,
			  t_admission.icd_keluar,
			  m_ruang.nama AS namaruang,
			  m_dokter.NAMADOKTER,
			  (select icd.jenis_penyakit from icd
			  where icd.icd_code = t_admission.icd_keluar) as jenis_penyakit,
                           m_carabayar.NAMA AS CARABAYAR
			FROM
			  t_admission
			  INNER JOIN m_dokter ON (t_admission.dokterpengirim = m_dokter.KDDOKTER)
			  INNER JOIN m_ruang ON (t_admission.noruang = m_ruang.`no`)
                          INNER JOIN m_carabayar ON (m_carabayar.KODE = t_admission.statusbayar)
			WHERE t_admission.nomr ='".$_GET['nomr']."'";
			
			$sqlcounter = "SELECT
			  count(t_admission.masukrs)
			FROM
			  t_admission
			  INNER JOIN m_dokter ON (t_admission.dokterpengirim = m_dokter.KDDOKTER)
			  INNER JOIN m_ruang ON (t_admission.noruang = m_ruang.`no`)
                          INNER JOIN m_carabayar ON (m_carabayar.KODE = t_admission.statusbayar)
			WHERE t_admission.nomr ='".$_GET['nomr']."'";

                    $NO=0;
                    $pager = new PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "","index.php?link=rm7&");
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
                        <td><? $NO=($NO+1);
                                if ($_GET['page']==0) {
                                    $hal=0;
                                }else {
                                    $hal=$_GET['page']-1;
                                } echo







    ($hal*15)+$NO;?></td>
                        <td><? echo $data['masukrs']; ?></td>
                        <td><? echo $data['keluarrs']; ?></td>
                        <td><? echo $data['namaruang']; ?></td>
                        <td><? echo $data['NAMADOKTER']; ?></td>

                        <td><? echo $data['jenis_penyakit']; ?></td>
                        <td><? echo $data['CARABAYAR']; ?></td>
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