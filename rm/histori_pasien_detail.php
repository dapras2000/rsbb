<?php
require ('ps_pagination_x.php');
$pager = new PS_Pagination()
?>

<div align="center">
    <div id="frame">
        <div id="frame_title"><h3>RINGKASAN RIWAYAT RAWAT JALAN</h3></div>
        <div align="left" style="margin:5px;">
            <table width="317" border="0" cellspacing="0" class="tb">
                <tr><td width="80">No RM :</td><td width="233"><?=$_GET['nomr']?></td></tr>
                <tr><td>Nama :</td><td><?=$_GET['nama']?></td></tr>
            </table>


            <div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="Ringkasan Riwayat Rawat Jalan Pasien">
                    <tr align="center">
                        <th width="5%">NO</th>
                        <th width="10%">Tanggal</th>
                        <th width="15%">Poli / UGD</th>
                        <th width="20%">Diagnosa</th>
                        <th width="20%">Tindakan</th>
                        <th width="10%">Dokter</th>
                        <th width="10%">Cara Bayar</th>
						<th width="15%">Lab & Radiologi</th>
                    </tr>
                    <?
                    $sql = "SELECT
			  t_diagnosadanterapi.IDXTERAPI,
			  t_diagnosadanterapi.IDXDAFTAR,
			  t_diagnosadanterapi.NOMR,
			  t_diagnosadanterapi.TANGGAL,
			  t_diagnosadanterapi.DIAGNOSA,
			  t_diagnosadanterapi.TERAPI,
			  t_diagnosadanterapi.KDPOLY,
			  t_diagnosadanterapi.KDDOKTER,
			  m_poly.nama AS NAMAPOLY,
			  m_dokter.NAMADOKTER,
                          m_carabayar.NAMA AS CARABAYAR
			FROM
			  t_diagnosadanterapi
			  INNER JOIN m_poly ON (t_diagnosadanterapi.KDPOLY = m_poly.kode)
			  INNER JOIN m_dokter ON (t_diagnosadanterapi.KDDOKTER = m_dokter.KDDOKTER)
                          INNER JOIN t_pendaftaran ON (t_diagnosadanterapi.IDXDAFTAR = t_pendaftaran.IDXDAFTAR)
                          INNER JOIN m_carabayar ON (m_carabayar.KODE = t_pendaftaran.KDCARABAYAR)
			WHERE t_diagnosadanterapi.NOMR ='".$_GET['nomr']."' ORDER BY t_diagnosadanterapi.IDXTERAPI";
                $sqlcounter = "SELECT
			  count(t_diagnosadanterapi.IDXTERAPI)
			FROM
			  t_diagnosadanterapi
			  INNER JOIN m_poly ON (t_diagnosadanterapi.KDPOLY = m_poly.kode)
			  INNER JOIN m_dokter ON (t_diagnosadanterapi.KDDOKTER = m_dokter.KDDOKTER)
                          INNER JOIN t_pendaftaran ON (t_diagnosadanterapi.IDXDAFTAR = t_pendaftaran.IDXDAFTAR)
                          INNER JOIN m_carabayar ON (m_carabayar.KODE = t_pendaftaran.KDCARABAYAR)
			WHERE t_diagnosadanterapi.NOMR ='".$_GET['nomr']."' ORDER BY t_diagnosadanterapi.IDXTERAPI";

                    $pager->PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "","index.php?link=rm6&");
                    //The paginate() function returns a mysql result set
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
					$NO = 0;
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
                                if (isset($_GET['page'])==0) {
                                    $hal=0;
                                }else {
                                    $hal=isset($_GET['page'])-1;
                                } echo






    ($hal*15)+$NO;?></td>
                        <td><? echo $data['TANGGAL']; ?></td>
                        <td><? echo $data['NAMAPOLY']; ?></td>
                        <td><? echo $data['DIAGNOSA']; ?></td>
                        <td><? echo $data['TERAPI']; ?></td>

                        <td><? echo $data['NAMADOKTER']; ?></td>
                        <td><? echo $data['CARABAYAR']; ?></td>
						<td><? $sqllabcek = "select * from t_orderlab where idxdaftar = '".$data['IDXDAFTAR']."' and nomr = '".$data['NOMR']."'"; 
									$labok= mysql_query($sqllabcek)or die(mysql_error());
									if(mysql_num_rows($labok) > 0){
										?><a href="?link=rm6l&nomr=<?=$data['NOMR']?>&idx=<?=$data['IDXDAFTAR']?>"><input type="button" class="text" name="Riwayat Laboratorium" value="Laboratorium" /></a><?
									}
									$sqlradiologicek = "select * from t_radiologi where idxdaftar = '".$data['IDXDAFTAR']."' and nomr = '".$data['NOMR']."'";
									$radiologiok= mysql_query($sqlradiologicek)or die(mysql_error());
									if(mysql_num_rows($radiologiok) > 0){
										?><a href="?link=rm6r&nomr=<?=$data['NOMR']?>&idx=<?=$data['IDXDAFTAR']?>"><input type="button" class="text" name="Riwayat Radiologi" value="Radiologi" /></a><?
									} ?></td>
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