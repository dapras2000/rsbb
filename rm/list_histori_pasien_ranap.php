<?php 
session_start();
include("include/connect.php");
require_once('ps_pagination_x.php');

$search = "";
$norm = "";
if(!empty($_GET['norm'])) {
    $norm =$_GET['norm'];
} 

if($norm !="") {
    $search = " WHERE m_pasien.NOMR = '".$norm."' ";
}

$nama = "";
if(!empty($_GET['nama'])) {
    $nama =$_GET['nama'];
} 

if($nama !="") {
    if($search !="") {
        $search = $search." AND m_pasien.NAMA LIKE '%".$nama."%' ";
    }else {
        $search = " WHERE m_pasien.NAMA LIKE '%".$nama."%' ";
    }
}
?>

<div align="center">
    <div id="frame">
        <div id="frame_title">
            <h3>LIST PASIEN RAWAT INAP</h3></div>
        <div align="right" style="margin:5px;">
            <form name="formsearch" method="get" >
                <table width="248" border="0" cellspacing="0" class="tb">
                    <tr>
                        <td width="52">No RM</td>
                        <td width="192"><input type="text" name="norm" id="norm" value="<? if($norm!="") {
                                echo $norm;
                                               }?>"></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td><input type="text" name="nama" id="nama" value="<? if($nama!="") {
                                echo $nama;
                                   }?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Cari" class="text"/>
                            <input type="hidden" name="link" value="rm5" /></td>
                    </tr>
                </table>

            </form>
            <div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr align="center">
                        <th>No</th>
                        <th width="14%">No RM</th>
                        <th width="10%">Nama</th>
                        <th width="20%">Jns Kelamin</th>
                        <th width="15%">Tgl Lahir</th>
                        <th width="28%">Alamat</th>

                        <th width="13%">&nbsp;</th>
                    </tr>
                    <?
                    $sql = "SELECT
  		m_pasien.NOMR,
  		m_pasien.NAMA,
  		m_pasien.ALAMAT,
  		m_pasien.JENISKELAMIN,
  		m_pasien.TGLLAHIR
		FROM
  		m_pasien 
		INNER JOIN t_admission ON (m_pasien.NOMR=t_admission.NOMR)
		".$search;
		
		 $sqlcounter = "SELECT
  		count(m_pasien.NOMR)
		FROM
  		m_pasien
		INNER JOIN t_admission ON (m_pasien.NOMR=t_admission.NOMR)
		".$search;

                    $NO=0;
                    $pager = new PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "nama=".$nama."&norm=".$norm,"index.php?link=rm5&");
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
                        <td><? echo $data['NOMR'];?></td>
                        <td><? echo $data['NAMA']; ?></td>
                        <td><?
                                if($data['JENISKELAMIN']=="L") {
                                    echo "Laki - laki";
                                }else {
                                    echo "Perempuan";
    }?></td>
                        <td><? echo $data['TGLLAHIR']; ?></td>
                        <td><? echo $data['ALAMAT']; ?></td>

                        <td><a href="index.php?link=rm7&amp;nomr=<?php echo $data['NOMR']?>&nama=<?php echo $data['NAMA']?>" ><input type="button" value="DETAIL RIWAYAT" class="text"/></a></td>
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