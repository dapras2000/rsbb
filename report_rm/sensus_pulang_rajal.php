<div align="center">
<div id="frame" style="width:100%">
	<div id="frame_title"><h3>Rekap Status Pulang Rawat Jalan</h3></div>
<?php 
include "../include/connect.php";

$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
}else{
    $tgl_kunjungan =date('Y/m/d'); 
}

$tgl_kunjungan2 = "";
if(!empty($_GET['tgl_kunjungan2'])){
	$tgl_kunjungan2 =$_GET['tgl_kunjungan2']; 
}else{
    $tgl_kunjungan2 =date('Y/m/d'); 
}

$poly = "";
if(!empty($_GET['poly'])) {
    $poly =$_GET['poly'];
}
else $poly=0;

?>

<form name="formsearch" method="get" >
     <table width="286" border="0" cellspacing="0" class="tb">
  <tr>
    <td width="78">Dari Tanggal</td>
    <td width="204"><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan!=""){
			  echo $tgl_kunjungan;}?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
  <tr>
    <td>Sampai Tanggal</td>
    <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan2!=""){
			  echo $tgl_kunjungan2;}?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>

  <tr>
    <td>Poly</td>
    <td><select name="poly" id="poly" class="text" >
                                <option value=""> -- </option>
                                <?
                                $qrypoly = mysql_query("SELECT * FROM m_poly ORDER BY kode ASC")or die (mysql_error());
                                while ($listpoly = mysql_fetch_array($qrypoly)) {
                                    ?>
                                <option value="<? echo $listpoly['kode'];?>" <? if($listpoly['kode']==$poly) echo "selected=selected"; ?>><? echo $listpoly['nama'];?></option>
                                    <? } ?>
                            </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cari" class="text"/>
    <input type="hidden" name="link" value="144R" /></td>
  </tr>
</table>

    </form>
    
<!--<div style="overflow:scroll;width:98%;height:auto;">-->
<div>
  <table width="148%" style="font-size:9px;" border="0" align="center" class="tb" cellpadding="1" cellspacing="1">
    <tr>
      <th width="34" rowspan="2">Tanggal</th>
      <th colspan="12">Status Keluar Rawat Jalan</th>
    </tr>
    <tr>
      <th>Belum Pulang</th>
      <th>Pulang</th>
      <th>Ranap</th>
      <th>Kabur</th>
      <th>DOA</th>
      <th>Rujuk Poly</th>
      <th>Rujuk RS</th>
      <th>Meninggal</th>
      <th>Paksa</th>
      <th>Batal</th>
      <th>Rujuk VK</th>
      <th>Rujuk OK</th>
    </tr>
    <?php   

      $tot_pulang= 0;
      $tot_ranap= 0;
      $tot_kabur= 0;
      $tot_doa= 0;
      $tot_rujuk_poly= 0;
      $tot_rujuk_rs= 0;
      $tot_meninggal= 0;
      $tot_paksa= 0;
      $tot_batal= 0;
      $tot_rujuk_vk= 0;
      $tot_rujuk_ok= 0;
	  $tot_belum_pulang=0;

       $sql="CALL pr_sensus_pulang_rajal('".$tgl_kunjungan."','".$tgl_kunjungan2."',".$poly. ")";
       $rs=mysql_query($sql);
	  if(!$rs) die(mysql_error());
	   $count=0;
       while ($data = mysql_fetch_array($rs)) {
		   $tot_belum_pulang= $tot_belum_pulang + $data['belum_pulang'];
		  $tot_pulang= $tot_pulang + $data['pulang'];
		  $tot_ranap= $tot_ranap + $data['ranap'];
		  $tot_kabur= $tot_kabur + $data['kabur'];
		  $tot_doa= $tot_doa + $data['doa'];
		  $tot_rujuk_poly= $tot_rujuk_poly + $data['rujuk_poly'];
		  $tot_rujuk_rs= $tot_rujuk_rs + $data['rujuk_rs'];
		  $tot_meninggal= $tot_meninggal + $data['meninggal'];
		  $tot_paksa= $tot_paksa + $data['paksa'];
		  $tot_batal= $tot_batal + $data['batal'];
		  $tot_rujuk_vk= $tot_rujuk_vk + $data['rujuk_vk'];
		  $tot_rujuk_ok= $tot_rujuk_ok + $data['rujuk_ok'];
	 ?>
    <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
      <td><? echo $data['tglreg'];?></td>
      <td width="33"><a href="?link=144Rdet&tglreg=<?=$data['tglreg']?>&kdpoly=<?=$data['kdpoly']?>&status=0"><?=$data['belum_pulang'];?></a></td>
      <td width="33"><a href="?link=144Rdet&tglreg=<?=$data['tglreg']?>&kdpoly=<?=$data['kdpoly']?>&status=1"><?=$data['pulang'];?></a></td>
      <td width="33"><a href="?link=144Rdet&tglreg=<?=$data['tglreg']?>&kdpoly=<?=$data['kdpoly']?>&status=2"><?=$data['ranap'];?></a></td>
      <td width="33"><a href="?link=144Rdet&tglreg=<?=$data['tglreg']?>&kdpoly=<?=$data['kdpoly']?>&status=7"><?=$data['kabur'];?></a></td>
      <td width="33"><a href="?link=144Rdet&tglreg=<?=$data['tglreg']?>&kdpoly=<?=$data['kdpoly']?>&status=3"><?=$data['doa'];?></a></td>
      <td width="33"><a href="?link=144Rdet&tglreg=<?=$data['tglreg']?>&kdpoly=<?=$data['kdpoly']?>&status=5"><?=$data['rujuk_poly'];?></a></td>
      <td width="33"><a href="?link=144Rdet&tglreg=<?=$data['tglreg']?>&kdpoly=<?=$data['kdpoly']?>&status=6"><?=$data['rujuk_rs'];?></a></td>
      <td width="33"><a href="?link=144Rdet&tglreg=<?=$data['tglreg']?>&kdpoly=<?=$data['kdpoly']?>&status=8"><?=$data['meninggal'];?></a></td>
      <td width="33"><a href="?link=144Rdet&tglreg=<?=$data['tglreg']?>&kdpoly=<?=$data['kdpoly']?>&status=9"><?=$data['paksa'];?></a></td>
      <td width="33"><a href="?link=144Rdet&tglreg=<?=$data['tglreg']?>&kdpoly=<?=$data['kdpoly']?>&status=11"><?=$data['batal'];?></a></td>
      <td width="51"><a href="?link=144Rdet&tglreg=<?=$data['tglreg']?>&kdpoly=<?=$data['kdpoly']?>&status=12"><?=$data['rujuk_vk'];?></a></td>
      <td width="27"><a href="?link=144Rdet&tglreg=<?=$data['tglreg']?>&kdpoly=<?=$data['kdpoly']?>&status=13"><?=$data['rujuk_ok'];?></a></td>
    </tr>
    <?php } ?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Total</td>
      <td><?php echo $tot_belum_pulang; ?></td>
      <td><?php echo $tot_pulang; ?></td>
      <td><?php echo $tot_ranap; ?></td>
      <td><?php echo $tot_kabur; ?></td>
      <td><?php echo $tot_doa; ?></td>
      <td><?php echo $tot_rujuk_poly; ?></td>
      <td><?php echo $tot_rujuk_rs; ?></td>
      <td><?php echo $tot_meninggal; ?></td>
      <td><?php echo $tot_paksa; ?></td>
      <td><?php echo $tot_batal; ?></td>
      <td><?php echo $tot_rujuk_vk; ?></td>
      <td><?php echo $tot_rujuk_ok; ?></td>
    </tr>
  </table>
</div>
</div></div>
