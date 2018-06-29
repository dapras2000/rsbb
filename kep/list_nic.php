<?php 
include("include/connect.php");
require_once('ps_pagination_x.php');
$kegiatan=$_GET[kegiatan];
?>
<div align="center">
    <div id="frame">
        <div id="frame_title"><h3>DAFTAR INTERVENSI</h3></div>
        <div align="right" style="margin:5px; margin-right:10px;">

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
			<form method="get" action="list_nic.php" name="formku" id="formku" onSubmit="return validasi()" >
                <table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Pasien.">
                   <tr><td colspan="5">Search:&nbsp;<input type="text" name="kegiatan" id="kegiatan" width="200" maxlength="200"><input type="submit" value="search"></td></tr>
				    <tr align="center">
                        <th width="2%">No</th>
                        <th width="53%">Kelompok Kegiatan</th>
                        <th width="20%">Kode</th>
                        <th width="20%">Aktivitas</th>
                        <th width="5%">Keterangan</th>
                    </tr>
                    <?
					if($kegiatan==''){
                    $sql="SELECT a.* FROM m_intervensi a order by a.id_intervensi";
		  		 	$sql1="SELECT count(*) FROM m_intervensi ";
					}
					else{
					$sql="SELECT a.* FROM m_intervensi a where a.kegiatan like '%$kegiatan%' order by a.id_intervensi";
		  		 	$sql1="SELECT count(*) FROM m_intervensi ";
					}
					$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=".$orderby."&searchkey=".$searchkey."&searchfield=".$searchfield, "index.php?link=nic_list&");
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
                        <td align="center"><? $NO=($NO+1);
                                if (isset($_GET['page'])==0) {
                                    $hal=0;
                                }else {
                                    $hal=isset($_GET['page'])-1;
                                } echo
									($hal*15)+$NO;?></td>
                        <td><? echo $data['kegiatan']; ?></td>
                        <td><? echo $data['kode']; ?></td>
                        <td><? echo $data['aktivitas']; ?></td>
                        <td align="center"><? if($data['link'] != '') { ?><a href="implementasi/<? echo $data['link']; ?>"><input type="button" value="dokumen" class="text" /></a><?}?></td>
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
				</form>
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

