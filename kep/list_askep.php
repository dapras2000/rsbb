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
include("include/connect.php");
require_once('ps_pagination_x.php');

$search = "";
if(!empty($_GET['searchkey'])) {
    $searchkey = $_GET['searchkey'];
}

if(!empty($_GET['searchfield'])) {
    $searchfield = $_GET['searchfield'];
}

if($searchkey!="") {
    if($searchfield=="nomr") {
        $search = " AND a.NOMR like '%".$searchkey."%'";
    }
    if($searchfield=="nama") {
        $search = " AND a.NAMA like '%".$searchkey."%'";
    }
    if($searchfield=="alamat") {
        $search = " AND a.ALAMAT like '%".$searchkey."%'";
    }
    if($searchfield=="telepon") {
        $search = " AND a.NOTELP like '%".$searchkey."%'";
    }
    if($searchfield=="tgllahir") {
        $search = " AND a.TGLLAHIR like '%".$searchkey."%'";
    }
    if($searchfield=="noktp") {
        $search = " AND a.NOKTP like '%".$searchkey."%'";
    }
    if($searchfield=="tgldaftar") {
        $search = " AND a.TGLDAFTAR like '%".$searchkey."%'";
    }
    if($searchfield=="namasuami_orangtua") {
        $search = " AND a.SUAMI_ORTU like '%".$searchkey."%'";
    }
}

$order=" order by ";
if(!empty($_GET['orderby'])) {
    $orderby = $_GET['orderby'];

    if($orderby=="nomr") {
        $order=$order."a.NOMR";
    }
    if($orderby=="nama") {
        $order=$order."a.NAMA";
    }
    if($orderby=="alamat") {
        $order=$order."a.ALAMAT";
    }
    if($orderby=="telepon") {
        $order=$order."a.NOTELP";
    }
    if($orderby=="tgllahir") {
        $order=$order."a.TGLLAHIR";
    }
    if($orderby=="noktp") {
        $order=$order."a.NOKTP";
    }
    if($orderby=="tgldaftar") {
        $order=$order."a.TGLDAFTAR";
    }
    if($orderby=="namasuami_orangtua") {
        $order=$order."a.SUAMI_ORTU";
    }
}else {
    $order = $order."a.NOMR";
}

?>

<div align="center">
    <div id="frame">
        <div id="frame_title"><h3>LIST DATA PASIEN</h3></div>
        <div align="right" style="margin:5px; margin-right:10px;">


            <form name="cari" method="get">
                <table class="tb" >
                    <tr>
                        <td>Cari <input type="TEXT" name="searchkey" id="searchkey" size="25" class="text" value="<?=$searchkey?>" style="width:145px;" /></td>
                        <td>Berdasarkan <select name="searchfield" id="searchfield" class="text">
                                <option value="nomr" <? if($searchfield=="nomr") echo "selected"; ?>>nomr</option>
                                <option value="nama" <? if($searchfield=="nama") echo "selected"; ?>>nama</option>
                                <option value="alamat" <? if($searchfield=="alamat") echo "selected"; ?>>alamat</option>
                                <option value="telepon" <? if($searchfield=="telepon") echo "selected"; ?>>telepon</option>
                                <option value="tgllahir" <? if($searchfield=="tgllahir") echo "selected"; ?>>tgllahir</option>
                                <option value="noktp" <? if($searchfield=="noktp") echo "selected"; ?>>noktp</option>
                                <option value="tgldaftar" <? if($searchfield=="tgldaftar") echo "selected"; ?>>tgldaftar</option>
                                <option value="namasuami_orangtua" <? if($searchfield=="namasuami_orangtua") echo "selected"; ?>>nama suami / orangtua</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Sort
                            <select name="orderby" id="orderby" class="text">
                                <option value="nomr" <? if($order=="nomr") echo "selected"; ?>>nomr</option>
                                <option value="nama" <? if($order=="nama") echo "selected"; ?>>nama</option>
                                <option value="alamat" <? if($order=="alamat") echo "selected"; ?>>alamat</option>
                                <option value="telepon" <? if($order=="telepon") echo "selected"; ?>>telepon</option>
                                <option value="tgllahir" <? if($order=="tgllahir") echo "selected"; ?>>tgllahir</option>
                                <option value="noktp" <? if($order=="noktp") echo "selected"; ?>>noktp</option>
                                <option value="tgldaftar" <? if($order=="tgldaftar") echo "selected"; ?>>tgldaftar</option>
                                <option value="namasuami_orangtua" <? if($order=="namasuami_orangtua") echo "selected"; ?>>nama suami / orangtua</option>
                            </select></td>
                            <td align="right"><input type="submit" onclick="dopilih()" value="C A R I" class="text" />
                            <input type="button" class="text" value="P R I N T" onclick="printIt()" /></td>
                    </tr>
                </table>
                <input type="hidden" name="link" value="askep__" />
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
            <div id="table_search">
                <table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Pasien.">
                    <tr align="center">
                        <th width="5%">NoRM</th>
                        <th width="12%">Nama Pasien</th>
                        <th width="9%"> TanggalLahir</th>
                        <th width="15%">Alamat</th>
                        <th width="18%">NO KTP</th>
                        <th width="12%">Jenis Kelamin</th>
                        <th width="8%">No telepon</th>
                        <th width="14%">AwalDaftar</th>
                        <th width="7%">Suami/Keluarga</th>
                        <th colspan='2' width="7%">Aksi</th>
                    </tr>
                    <?
                    $sql="SELECT b.id_admission, a.* , DATE_FORMAT(TGLLAHIR,'%d/%m/%Y') as TGLLAHIR1, DATE_FORMAT(tgldaftar,'%d/%m/%Y') tgldaftar FROM m_pasien a right join t_admission b on a.nomr = b.nomr where (IFNULL(DATE(b.keluarrs),'0000-00-00')='0000-00-00' OR DATE(b.keluarrs)>date(now())) ".$search.$order;
		  		 	$sql1="SELECT count(*) FROM m_pasien a right join t_admission b on a.nomr = b.nomr where (IFNULL(DATE(b.keluarrs),'0000-00-00')='0000-00-00' OR DATE(b.keluarrs)>date(now())) ".$search.$order;
					
					$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=".$orderby."&searchkey=".$searchkey."&searchfield=".$searchfield, "index.php?link=askep__&");
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
                        <td><? echo $data['NOMR'];?></td>
                        <td><? echo $data['NAMA']; ?></td>
                        <td><? echo $data['TGLLAHIR1']; ?></td>
                        <td><? echo $data['ALAMAT']; ?></td>
                        <td><? echo $data['NOKTP']; ?></td>
                        <td><? if($data['JENISKELAMIN']=="l" || $data['JENISKELAMIN']=="L") {
                                    echo"Laki-Laki";
                                }elseif($data['JENISKELAMIN']=="p" || $data['JENISKELAMIN']=="P") {
                                    echo"Perempuan";
                                } ?></td>
                        <td><? echo $data['NOTELP']; ?></td>
                        <td><? echo $data['tgldaftar']; ?></td>
                        <td><? echo $data['SUAMI_ORTU']; ?></td>
                        <td><a href="?link=pengkajian_kep&NOMR=<?=$data['NOMR'];?>&nama=<?php echo $data['NAMA']?>"><input type="button" value="Pengkajian Keperawatan" class="text" /></a><a href="?link=diagnosa_kep&NOMR=<?=$data['NOMR'];?>&nama=<?php echo $data['NAMA']?>&idadmission=<?=$data['id_admission']?>"><input type="button" value="Diagnosa Keperawatan" class="text" /></a></td>
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
    $qry_excel = "SELECT a.NOMR,
					 a.NAMA AS NAMA_PASIEN,
					 a.TEMPAT AS TMP_LAHIR,
					 a.TGLLAHIR AS TGL_LAHIR,
					 a.JENISKELAMIN AS JNS_KELAMIN,
					 a.ALAMAT,
					 a.KELURAHAN,
					 a.KDKECAMATAN AS KECAMATAN,
					 a.KOTA,
					 a.NOTELP AS NO_TELP,
					 a.NOKTP AS NO_KTP,
					 a.ALAMAT_KTP,
					 a.SUAMI_ORTU,
					 a.PEKERJAAN,
					 a.`STATUS`,
					 a.AGAMA,
					 a.PENDIDIKAN,
					 a.TGLDAFTAR TGL_PERTAMA_DAFTAR 
			   FROM m_pasien a where (a.nomr in (SELECT b.nomr FROM t_admission b where (IFNULL(DATE(b.keluarrs),'0000-00-00')='0000-00-00' OR DATE(b.keluarrs)>date(now()))) or a.nomr in (SELECT b.nomr FROM t_diagnosadanterapi a join t_pendaftaran b on a.idxdaftar = b.idxdaftar where b.status = '0')) ".$search.$order;
    ?>
    <div align="left">
        <form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
            <input type="hidden" name="query" value="<?=$qry_excel?>" />
            <input type="hidden" name="header" value="DATA PASIEN" />
            <input type="hidden" name="filename" value="data_pasien" />
            <input type="submit" value="Export To Ms Excel Document" class="text" />
        </form>
    </div>
</div>

