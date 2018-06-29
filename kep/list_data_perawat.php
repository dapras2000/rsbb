<script language="javascript">
    function printIt()
    {
        content=document.getElementById('table_search');
        head=document.getElementById('head_report');
        w=window.open('about:blank');
        w.document.writeln("<link href='./dq_sirs.css' type='text/css' rel='stylesheet' />");
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
include("./include/connect.php");
require_once('./ps_pagination_x.php');

$search = "";
if(!empty($_GET['searchkey'])) {
    $searchkey = $_GET['searchkey'];
}

if(!empty($_GET['searchfield'])) {
    $searchfield = $_GET['searchfield'];
}

if($searchkey!="") {
    if($searchfield=="nip") {
        $search = " WHERE NIP like '%".$searchkey."%'";
    }
    if($searchfield=="nama") {
        $search = " WHERE NAMA like '%".$searchkey."%'";
    }
    if($searchfield=="alamat") {
        $search = " WHERE ALAMAT like '%".$searchkey."%'";
    }
    if($searchfield=="telepon") {
        $search = " WHERE NOTELP like '%".$searchkey."%'";
    }
    if($searchfield=="tgllahir") {
        $search = " WHERE TGLLAHIR like '%".$searchkey."%'";
    }
    if($searchfield=="noktp") {
        $search = " WHERE NOKTP like '%".$searchkey."%'";
    }
    if($searchfield=="pendidikan") {
        $search = " WHERE PENDIDIKAN like '%".$searchkey."%'";
    }
    if($searchfield=="jabatan") {
        $search = " WHERE JABATAN like '%".$searchkey."%'";
    }
}

$order=" order by ";
if(!empty($_GET['orderby'])) {
    $orderby = $_GET['orderby'];

    if($orderby=="nip") {
        $order=$order."NIP";
    }
    if($orderby=="nama") {
        $order=$order."NAMA";
    }
    if($orderby=="alamat") {
        $order=$order."ALAMAT";
    }
    if($orderby=="telepon") {
        $order=$order."NOTELP";
    }
    if($orderby=="tgllahir") {
        $order=$order."TGLLAHIR";
    }
    if($orderby=="noktp") {
        $order=$order."NOKTP";
    }
    if($orderby=="pendidikan") {
        $order=$order."PENDIDIKAN";
    }
    if($orderby=="jabatan") {
        $order=$order."JABATAN";
    }
}else {
    $order = $order."NIP";
}

?>
<div align="center">
    <div id="frame">
        <div id="frame_title"><h3>LIST DATA PERAWAT</h3></div>		
        <div align="right" style="margin:5px; margin-right:10px;">


            <form name="cari" method="get">				
                <table class="tb" >
                    <tr>
                        <td>Cari <input type="TEXT" name="searchkey" id="searchkey" size="25" class="text" value="<?=$searchkey?>" style="width:145px;" /></td>
                        <td>Berdasarkan <select name="searchfield" id="searchfield" class="text">
                                <option value="nip" <? if($searchfield=="nip") echo "selected"; ?>>nip</option>
                                <option value="nama" <? if($searchfield=="nama") echo "selected"; ?>>nama</option>
                                <option value="alamat" <? if($searchfield=="alamat") echo "selected"; ?>>alamat</option>
                                <option value="telepon" <? if($searchfield=="telepon") echo "selected"; ?>>telepon</option>
                                <option value="tgllahir" <? if($searchfield=="tgllahir") echo "selected"; ?>>tgllahir</option>
                                <option value="noktp" <? if($searchfield=="noktp") echo "selected"; ?>>noktp</option>
                                <option value="pendidikan" <? if($searchfield=="pendidikan") echo "selected"; ?>>pendidikan</option>
                                <option value="jabatan" <? if($searchfield=="jabatan") echo "selected"; ?>>jabatan</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Sort
                            <select name="orderby" id="orderby" class="text">
                                <option value="nip" <? if($order=="nip") echo "selected"; ?>>nip</option>
                                <option value="nama" <? if($order=="nama") echo "selected"; ?>>nama</option>
                                <option value="alamat" <? if($order=="alamat") echo "selected"; ?>>alamat</option>
                                <option value="telepon" <? if($order=="telepon") echo "selected"; ?>>telepon</option>
                                <option value="tgllahir" <? if($order=="tgllahir") echo "selected"; ?>>tgllahir</option>
                                <option value="noktp" <? if($order=="noktp") echo "selected"; ?>>noktp</option>
                                <option value="pendidikan" <? if($order=="pendidikan") echo "selected"; ?>>pendidikan</option>
                                <option value="jabatan" <? if($order=="jabatan") echo "selected"; ?>>jabatan</option>
                            </select></td>
                            <td align="right"><input type="submit" onclick="dopilih()" value="C A R I" class="text" />
                            <input type="button" class="text" value="P R I N T" onclick="printIt()" /></td>
                    </tr>
                </table>
                <input type="hidden" name="link" value="list_kep" />				
				<div align="right" style="margin:5px; margin-right:308px;"><a href="?link=kep2"><input type="button" value="Tambah" class="text" /></a></div>
            </form>			
            <div id="head_report" style="display:none" >
                <div align="left" style="clear:both; padding:20px">
                    <div style="letter-spacing:-1px; font-size:16px; font:bold;"><?=strtoupper($header1)?></div>
                    <div style="letter-spacing:-2px; font-size:24px; color:#666; font:bold;"><?=strtoupper($header2)?></div>
					<div><?=$header3?><br /><?=$header4?></div>
                    <hr style="margin:5px;" />
                    <h2>LIST DATA PERAWAT</h2>
                </div>            
            </div>
            <div id="table_search">
                <table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
                    <tr align="center">
                        <th width="5%">NIP</th>
                        <th width="12%">Nama</th>
                        <th width="9%"> TanggalLahir</th>
                        <th width="15%">Alamat</th>
                        <th width="18%">NO KTP</th>
                        <th width="12%">Jenis Kelamin</th>
                        <th width="8%">No telepon</th>
                        <th width="14%">Pendidikan</th>
                        <th width="7%">Jabatan</th>
                        <th width="7%">EDIT</th>
                    </tr>
                    <?
                    $sql="SELECT a.* , DATE_FORMAT(TGLLAHIR,'%d/%m/%Y') as TGLLAHIR1
					FROM m_perawat a ".$search.$order;
		  		 	$sql1="SELECT count(*) FROM m_perawat a ".$search.$order;

                    $pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=".$orderby."&searchkey=".$searchkey."&searchfield=".$searchfield, "index.php?link=list_kep&");
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
                        <td><? echo $data['NIP'];?></td>
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
                        <td><? if($data['PENDIDIKAN']=="1") {
                                    echo"SPK";
                                }elseif($data['PENDIDIKAN']=="2") {
                                    echo"D III Keperawatan";
                                }elseif($data['PENDIDIKAN']=="3") {
                                    echo"Ners (S.Kp dan Ns.)";
                                }elseif($data['PENDIDIKAN']=="4") {
                                    echo"S2 Magister Keperawatan (Manajemen & Kepemimpinan)";
                                }elseif($data['PENDIDIKAN']=="5") {
                                    echo"Ners Spesialis";
                                }elseif($data['PENDIDIKAN']=="6") {
                                    echo"S3 Keperawatan";
                                } ?></td>
                        <td><? if($data['JABFUNG']=="1") { echo"Perawat terampil pelaksana pemula";
                                }elseif($data['JABFUNG']=="2") { echo"Perawat terampil pelaksana";
                                }elseif($data['JABFUNG']=="3") { echo"Perawat terampil pelaksana lanjutan";
                                }elseif($data['JABFUNG']=="4") { echo"Perawat terampil penyelia";
                                }elseif($data['JABFUNG']=="5") { echo"Perawat ahli pertama";
                                }elseif($data['JABFUNG']=="6") { echo"Perawat ahli muda";
                                }elseif($data['JABFUNG']=="7") { echo"Perawat ahli madya";
                                }elseif($data['JABFUNG']=="8") { echo"Perawat ahli Utama";
                                }elseif($data['JABFUNG']=="9") { echo"ketua komite keperawatan";
                                }elseif($data['JABFUNG']=="10") { echo"kepala instalasi";
                                }elseif($data['JABFUNG']=="11") { echo"supervisor";
                                }elseif($data['JABFUNG']=="12") { echo"kepala ruangan";
                                } ?></td>
                        <td><a href="?link=kep2&NIP=<?=$data['NIP'];?>&PERID=<?=$data['IDPERAWAT']?>"><input type="button" value="edit perawat" class="text" /></a><a href="?link=kep3&NIP=<?=$data['NIP'];?>&PERID=<?=$data['IDPERAWAT']?>"><input type="button" value="pengajuan mutasi" class="text" /></a><a href="?link=kep4&NIP=<?=$data['NIP'];?>&PERID=<?=$data['IDPERAWAT']?>"><input type="button" value="pengajuan keluar" class="text" /></a><a href="?link=kep5&NIP=<?=$data['NIP'];?>&PERID=<?=$data['IDPERAWAT']?>"><input type="button" value="program pengembangan" class="text" /></a></td>

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
    $qry_excel = "SELECT m_perawat.NIP,
					 m_perawat.NAMA AS NAMA_PASIEN,
					 m_perawat.TEMPAT AS TMP_LAHIR,
					 m_perawat.TGLLAHIR AS TGL_LAHIR,
					 m_perawat.JENISKELAMIN AS JNS_KELAMIN,
					 m_perawat.ALAMAT,
					 m_perawat.KELURAHAN,
					 m_perawat.KDKECAMATAN AS KECAMATAN,
					 m_perawat.KOTA,
					 m_perawat.NOTELP AS NO_TELP,
					 m_perawat.NOKTP AS NO_KTP,
					 m_perawat.ALAMAT_KTP,
					 m_perawat.AGAMA,
					 m_perawat.PENDIDIKAN,
					 m_perawat.JABATAN
			   FROM m_perawat ".$search.$order;
    ?>
    <div align="left">
        <form name="formprint" method="post" action="./gudang/excelexport.php" target="_blank" >
            <input type="hidden" name="query" value="<?=$qry_excel?>" />
            <input type="hidden" name="header" value="DATA PASIEN" />
            <input type="hidden" name="filename" value="data_perawat" />
            <input type="submit" value="Export To Ms Excel Document" class="text" />
        </form>
    </div>
</div>

