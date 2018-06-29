<?php 
include 'include/connect.php';
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

$bayar=1;
if(!empty($_GET['carabayar'])) {
    $bayar =$_GET['carabayar'];
}
/*

$qry_poly = "SELECT  m_poly.nama
			FROM m_poly
			WHERE m_poly.kode = ".$_SESSION['KDUNIT'];
$get_poly = mysql_query($qry_poly);
$dat_poly = mysql_fetch_assoc($get_poly);*/
?>
<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>JASPEL KAMAR OPERASI</h3></div>
<div align="left" >
    	<form name="formsearch" method="get" >
     <table width="248" border="0" cellspacing="0" class="tb">
 

  <tr>
    <td>Tanggal</td>
    <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan!=""){
			  echo $tgl_kunjungan;}?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
   <tr>
    <td>Sd</td>
    <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan2!=""){
			  echo $tgl_kunjungan2;}?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
<tr>
<td>Cara Bayar</td>
<td><select name="carabayar" id="carabayar" class="text" >
       <?
                                $qrybayar = mysql_query("SELECT kode,nama FROM m_carabayar ORDER BY kode ASC")or die (mysql_error());
                                while ($listbayar = mysql_fetch_array($qrybayar)) {
                                    ?>
       <option value="<? echo $listbayar['kode'];?>" <? if($listbayar['kode']==$bayar) echo "selected=selected"; ?>><? echo $listbayar['nama'];?></option>
       <? } ?>
     </select></td>
      </tr>   
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cari" class="text"/>
    <input type="hidden" name="link" value="jas2" /></td>
  </tr>
  
</table>

    </form> 
    </div>
  <br />
<fieldset>
<legend >
<?php				
$sql="CALL pr_jaspel_ok('".$tgl_kunjungan."','".$tgl_kunjungan2."',".$bayar.")";
$qry = mysql_query($sql) or die (mysql_error());
?>
</legend>
<p><form action="jaspel/jaspel_ok_xls.php" method="get">
				 <input type="hidden" name="tgl_kunjungan" id="tgl_kunjungan" value="<?=$tgl_kunjungan?>" />
                <input type="hidden" name="tgl_kunjungan2" id="tgl_kunjungan2" value="<?=$tgl_kunjungan2?>" />                
                <input type="hidden" name="poly" id="poly" value="<?=$poly?>" />    
                <input type="hidden" name="carabayar" id="carabayar" value="<?=$carabayar?>" />                                
                   <input type="submit" value="export xls"  />
                </form></p>
<table width="1184" border="0" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <th colspan="12">Tindakan Kamar Operasi</th>
  </tr>
  <tr>
    <th  align="center" width="140">Tindakan</th>
    <th  align="center" width="75">Pasien</th>
    <th  align="center" width="75">Jml Tindakan</th>

    <th  align="center" width="111">Dokter  Operator</th>
    <th  align="center" width="116">Jasa dr Operator</th>
    <th  align="center" width="116">Dokter Anaestesi</th>
    <th  align="center" width="94">Jasa dr Anastesi</th>
    <th  align="center" width="94">Dokter Anak</th>
    <th  align="center" width="69">Jasa dr Anak</th>
    <th  align="center" width="69">Asisten</th>    
    <th  align="center" width="71">Manajemen</th>    
    <th  align="center" width="78">Pendukung</th>
  </tr>
  <? while ($list = mysql_fetch_array($qry)){  ?>  
  <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
    <td><?= $list['nama_jasa'];?></td>
    <td><?= $list['pasien'];?></td>
    <td><?= number_format($list['qty'],0);?></td>
    <td><?= $list['dokteroperator'];?> </td>
    <td><?= number_format($list['jsdrOperator'],0);?></td>
    <td><?= $list['dokteranastesi'];?> </td>
    <td><?= number_format($list['jsdranastesi'],0);?></td>
    <td><?= $list['dokteranak'];?></td>
    <td><?= number_format($list['jsdranak'],0);?></td>
    <td><?= number_format($list['asisten'],0);?></td>
    <td><?= number_format($list['manajemen'],0);?></td>
    <td><?= number_format($list['pendukung'],0);?></td>    
  </tr>
 <?php } ?>
</table>

</fieldset>
</div>
</div>
