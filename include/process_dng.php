<?php
session_start();
header("Content-Type: text/html; charset=ISO-8859-15");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include("connect.php");
include("function.php");
require_once('../ps_pagination.php');

//login validasi

if(!empty($_GET['NIP'])){
		  $ip	= getRealIpAddr();
		  mysql_query('delete from tmp_cartbayar where IP = "'.$ip.'"');
		  mysql_query('delete from tmp_orderpenunjang where ip = "'.$ip.'"');
		  mysql_query('delete from tmp_cartresep where IP = "'.$ip.'"');
		  
  		  $sql="SELECT * FROM m_login WHERE NIP = '".$_GET['NIP']."'"; 
		  $query=mysql_query($sql)or die(mysql_error());
		  $data=mysql_fetch_assoc($query);
		  $NIP = $data['NIP'];
		  $KDUNIT = $data['KDUNIT'];
		  if($_GET['NIP'] == $NIP){
			  $_SESSION['NIP'] 		= $NIP;
			  $_SESSION['KDUNIT'] 	= $KDUNIT; 
			  echo	"<font color='green'> USERNAME Valid</font>";
		  }else{
			  echo	"<font color='red'> USERNAME Tidak Valid</font>";
		  }
}

if(!empty($_GET['PWD'])){
		  $NIP1 = $_SESSION['NIP'];
  		  $sql="SELECT * FROM m_login WHERE NIP = '".$NIP1."' AND PWD = '".$_GET['PWD']."'"; 
		  $query = mysql_query($sql)or die(mysql_error());
		  $data  = mysql_fetch_assoc($query);
		  $PWD2  = $_GET['PWD'];
		  $PWD   = $data['PWD'];
		  $SES_REG  = $data['SES_REG'];
		  if($_GET['PWD'] == $PWD){			  	  
				  $_SESSION['SES_REG'] = $SES_REG; ?> 
				  <SCRIPT language="JavaScript">
					alert('test');
				  </SCRIPT>
<script>
jQuery(document).ready(function(event){
	jQuery("#PWD").keyup(function(event){
		if(event.keyCode == 13){
			jQuery("#LOGIN").click();
		}
	});
});
</script>
				  <input type="button" onclick="window.location='user_level.php';" value=" LOGIN " class=" text "  name="LOGIN" id="LOGIN"/>
				  
				  <?
		  }else{
			  echo"<font color='red'>PASSWORD Tidak Valid</font>";
		  }
}

//kondisi total list-----------------------------------------------------------------------------------
if(!empty($_GET['code'])){
	if($_GET['code']){
		$sql = "SELECT * FROM m_tarif WHERE kode = '".htmlspecialchars($_GET['code'])."'";
		$query = mysql_query($sql)or die(mysql_error());
		$data = mysql_fetch_assoc($query);
		$_SESSION['cart'][$data['tarif']];
		echo "<br /><strong>TOTAL : Rp. ".number_format($_SESSION['cart'], 0)." <input type='submit' value=' chex ' class=' text '></strong>";
	}
	
}

if(!empty($_GET['edit_pasien'])){
	echo"data pasien di edit ";
	}

//kondisi cek no rm PENDAFTARAN-----------------------------------------------------------------------------
if(!empty($_GET['NOMR'])){
	include 'connect.php';
$sql = "SELECT * FROM m_pasien WHERE NOMR='".htmlspecialchars($_GET['NOMR'])."'";
$qry = mysql_query($sql);
$data = mysql_fetch_assoc($qry);
$lihat = str_pad($_GET['NOMR'],6,"0",STR_PAD_LEFT);       
	if($lihat == $data['NOMR']){
		  $_SESSION['kosong'] = "";
		  $_SESSION['new_nomr'] ="";
		  include("function.php");
		  include("view_prosess.php");
		  
		}else{
  		  //$_SESSION['new_nomr'] = str_pad($_GET['NOMR'],6,"0",STR_PAD_LEFT);			
		  $_SESSION['new_nomr'] = $_GET['NOMR'];			
		  $_SESSION['kosong'] = "Data No MR tidak Ditemukan";
  		  include("function.php");
		  include("view_prosess.php");
		}
}

if(!empty($_GET['psn'])){
	$sql = "SELECT * FROM m_pasien WHERE NOMR='".$_GET['psn']."'";
	$qry = mysql_query($sql);
	$data = mysql_fetch_assoc($qry);
	$lihat = str_pad($_GET['psn'],6,"0",STR_PAD_LEFT);       
	#print_r($lihat);
	if($lihat == $data['NOMR']){
	#if(mysql_num_rows($qry) > 0){
	  $r	= 0;
	  $a = datediff($data['TGLLAHIR'],date("Y-m-d"));
	  $umur = $a[years]." tahun ".$a[months]." bulan ".$a[days]." hari";
	  $nama	= explode(',',str_replace('.',' ',$data['NAMA']));
	  $CleanArray = TrimArray($nama);
	  
	  //$a	= array('Tn.','Ny.','Nn.','An.');
	  
	  if(array_search('Tn',$CleanArray)){
		  $title	= 'Tn';
	  }elseif(array_search('Nn',$CleanArray)){
		  $title	= 'Nn';
	  }elseif(array_search('Ny',$CleanArray)){
		  $title	= 'Ny';
	  }elseif(array_search('An',$CleanArray)){
		  $title	= 'An';
	  }
	  echo 	$r.'|'.
	  		$data['NOMR'].'|'.
			$nama[0].'|'.
			$data['TEMPAT'].'|'.
			$data['TGLLAHIR'].'|'.
			strtoupper($data['JENISKELAMIN']).'|'.
			$data['ALAMAT'].'|'.
			$data['KELURAHAN'].'|'.
			$data['KDKECAMATAN'].'|'.
			$data['KOTA'].'|'.
			$data['KDPROVINSI'].'|'.
			$data['NOTELP'].'|'.
			$data['NOKTP'].'|'.
			$data['SUAMI_ORTU'].'|'.$data['PEKERJAAN'].'|'.$data['STATUS'].'|'.$data['AGAMA'].'|'.$data['PENDIDIKAN'].'|'.$data['KDCARABAYAR'].'|'.$data['ALAMAT_KTP'].'|'.$umur.'|'.$title.'|'.$data['PENANGGUNGJAWAB_NAMA'].'|'.$data['PENANGGUNGJAWAB_HUBUNGAN'].'|'.$data['PENANGGUNGJAWAB_ALAMAT'].'|'.$data['PENANGGUNGJAWAB_PHONE'].'|'.$data['NO_KARTU'].'|'.$data['JNS_PASIEN'].'|'.$data['KDPROVIDER'].'|'.$data['NMPROVIDER'].'|'.$data['Kelas'];
	}else{
	  $r 	= 1;
	  echo $r.'|'.$data['NOMR'].'|'.$data['nama'];
	}
}


        #echo '<input type="hidden" name="PASIENBARU" id="PASIENBARU" value="'.$r.'">';
  		#echo '<input type="radio"  name="STATUSPASIEN" id="STATUSPASIEN" class="statuspasien" value="1" '.if($r != '0'): echo'checked="checked"'; endif;.'> Pasien Baru';
		#echo '<input type="radio"  name="STATUSPASIEN" id="STATUSPASIEN" class="statuspasien" value="0" '.if($r == '0'): echo'checked="checked"'; endif;.'> Pasien Lama';
        

//kondisi get no mr untuk pembayaran

//kondisi cek no rm----------------------------------------------------------------------------------
if(!empty($_GET['cek_rm'])){
$sql = "SELECT a.NOMR,b.NAMA 
	FROM t_pendaftaran a, m_pasien b 
	where tglreg=current_date() and a.nomr=b.nomr and a.nomr='".htmlspecialchars($_GET['cek_rm'])."'";
$qry = mysql_query($sql);
$data = mysql_fetch_assoc($qry);
	if($_GET['cek_rm'] == $data['NOMR']){
		echo "<input type='text' class='text' name='NAMA' value='". $data['NAMA'] ."'> No Rm
			  <input type='text' class='text' name='NAMA' value='". $data['NOMR'] ."'> ";		  
		}else{
		  //echo "<input type='text' class='text' name='NAMA'> Data No MR tidak Ditemukan";
		}

}


/*if($_GET['NOMR']==""){
		  ?>
                  <div id="frame" style="margin:20px; width:300px;">
                  	<div id="frame_title"><strong>MISSING VALUE NO MR</strong></div>
                    	<p align="center">
                        	Anda Belum Melakukan Pengisian No MR<br /><br />
                            <input class="text" type="button" onclick="window.location='index.php?link=2';" value="   OK   " />

                        </p>
                   </div>
		  <?
}*/

//kondisi cek poli -------------------------------------------------------------------------------------------------
if(!empty($_GET['jadwal_dokter'])){
	if($_GET['jadwal_dokter']){
		$sql="SELECT * FROM m_dokter WHERE KDPOLY='".htmlspecialchars($_GET['jadwal_dokter'])."'";
		$qry = mysql_query($sql);
		echo"<select name=\"KDDOKTER\" class='text'>";
			while($data = mysql_fetch_array($qry)){
				echo"<option nama='".$data['KDDOKTER']."' value='".$data['KDDOKTER']."'>".$data['NAMADOKTER']."</option>";
				}
		echo"</select>";
		}
	}


//searching pasien---------------------------------------------------------------------------------

if(!empty($_GET['search'])){
	if($_GET['search']){
		
		echo $pos = strpos($_GET['search'],'.');

		?>
        
		<table width="95%" style="margin:10px;" border="0" cellspacing="0" cellspading="0">
          <tr align="center">
            <th>NO RM</th>
            <th>Nama Pasien</th>
            <th>Tempat Tanggal lahir</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>No telepon</th>
            <th>Edit</th>
          </tr>
          
          <? 
		  
  		  if (substr($_GET['search'],0,$pos)=='nomr' ){
			$sql="SELECT * 
		  		FROM m_pasien 
				WHERE NOMR like '".substr($_GET['search'],$pos+1,strlen($_GET['search'])-$pos)."%'";  
		  }
  		  if (substr($_GET['search'],0,$pos)=='nama' ){
			$sql="SELECT * 
		  		FROM m_pasien 
				WHERE NAMA like '".substr($_GET['search'],$pos+1,strlen($_GET['search'])-$pos)."%'";  
		  }
  		  if (substr($_GET['search'],0,$pos)=='alamat' ){
			$sql="SELECT * 
		  		FROM m_pasien 
				WHERE ALAMAT like '".substr($_GET['search'],$pos+1,strlen($_GET['search'])-$pos)."%'";  
		  }
  		  if (substr($_GET['search'],0,$pos)=='telepon' ){
			$sql="SELECT * 
		  		FROM m_pasien 
				WHERE NOTELP like '".substr($_GET['search'],$pos+1,strlen($_GET['search'])-$pos)."%'";  
		  }

	$pager = new PS_Pagination($connect, $sql, 15, 5, "param1=valu1&param2=value2");
	
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	while($data = mysql_fetch_array($rs)) {?>
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
            <td><? echo $data['NOMR'];?></td>
            <td><? echo $data['NAMA']; ?></td>
            <td><? echo $data['TGLLAHIR']; ?></td>
            <td><? echo $data['ALAMAT']; ?></td>
            <td><? if($data['JENISKELAMIN']=="l" || $data['JENISKELAMIN']=="L"){echo"Laki-Laki";}else{echo"Perempuan";} ?></td>
            <td><? echo $data['NOTELP'] ?></td>
            <td align="center"><a href="?link=24&NOMR=<?=$data['NOMR'];?>">edit pasien</a></td>
        
          </tr>
	 <?	} ?>
  
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
        </table>		
		<?
	}
}

//cari_poly----------------------------------------------------------------------------------

if(!empty($_POST['poly']) && !empty($_POST['TGLREG'])){
if(!empty($_POST['TGLREG'])){
	$tgl_reg = $_POST['TGLREG'];
}else{
	$tgl_reg =date('Y/m/d');
}
?>
<table width="95%" style="margin:10px;" border="0" cellspacing="0" cellspading="0" title="List Kunjungan Data Pasien Per Hari Ini">
          <tr align="center">
            <th>NO RM</th>
            <th>Nama Pasien</th>
            <th>Alamat</th>
            <th>Poly</th>
            <th>Cara Bayar</th>
            <th>Rujukan</th>
          </tr>
          <?
 	$sql="SELECT A.NOMR,A.NAMA,A.ALAMAT,B.NAMA AS POLY1,C.NAMA AS CARABAYAR1,D.NAMA AS RUJUKAN1 
	      FROM m_pasien A, m_poly B, m_carabayar C, m_rujukan D, t_pendaftaran E 
          WHERE A.NOMR=E.NOMR AND E.KDPOLY=".$_POST['poly']." AND E.KDRUJUK=D.KODE AND E.KDCARABAYAR=C.KODE AND E.KDPOLY=B.KODE AND E.TGLREG='$tgl_reg'";
	$pager = new PS_Pagination($connect, $sql, 15, 5, "param1=valu1&param2=value2");
	
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs){ echo"<div class='tb'>anda belum memilih poly</div>"; 
	}else{
	while($data = mysql_fetch_array($rs)) {?>
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
            <td><? echo $data['NOMR'];?></td>
            <td><? echo $data['NAMA']; ?></td>
            <td><? echo $data['ALAMAT']; ?></td>
            <td><? echo $data['POLY1']; ?></td>
            <td><? echo $data['CARABAYAR1'];?></td>
            <td><? echo $data['RUJUKAN1'];?></td>
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
<? }
}

// cek nama pasien
if(!empty($_GET['NAMA'])){
	if($_GET['NAMA']){ 
	$sql_nama = "SELECT NAMA FROM m_pasien WHERE NAMA = '".$_GET['NAMA']."'";
	$qry_nama = mysql_query($sql_nama);
	$data_nama = mysql_fetch_assoc($qry_nama);
		if($data_nama['NAMA'] == $_GET['NAMA']){
	?>		
			<input title="NAMA" disabled="disabled" class="text" type="text" <?php if($_GET['NAMA']){ echo"value='".$data_nama['NAMA']."'";} ?> name="NAMA" size="30" value="<?=$m_pasien->NAMA?>" id="NAMA" onblur="javascript: MyAjaxRequest('nam','include/process.php?NAMA=','NAMA');" /> <span style="color:#F00; font:bold;">Nama Pasien Telah Terdaftar</span>
	
	<?  } 
	} 
}
// switch case ----------------------------------------------------------------------------------------------

switch ($_GET['state'])
{
case 'info':
echo "<p>Klik tarif Pilih untuk melihat Hasil / Total.<br> ".$_SESSION['total2']."</p>";
break;

case 'pendaftaran_val':
echo "test";
break;

case 'puskesmas':
echo " ket. <input name='KETRUJUK'  id='KETRUJUK' type='text' size='20' class='text'>";
break;

case 'rs_lain':
echo " ket. <input type='text' name='KETRUJUK' id='KETRUJUK' size='20' class='text'>";
break;

case 'lain_lain':
echo " ket. <input type='text' name='KETRUJUK' id='KETRUJUK' size='20' class='text'>";
break;

case 'cetak':
 	  mysql_query("INSERT INTO t_cetak_data (IDXBILL,JUMLAH) VALUES('".$_GET['idxb']."','1')")or die (mysql_error());
  	  $sql_cetak = "SELECT sum(JUMLAH) AS JUMLAH FROM t_cetak_data WHERE IDXBILL='".$_GET['idxb']."'";
	  $qry_cetak = mysql_query($sql_cetak)or die(mysql_error());
	  $cetak = mysql_fetch_assoc($qry_cetak);
	  $_SESSION['cetak']=$cetak['JUMLAH'];
	  echo $cetak['JUMLAH'];

break;

case 'tgl_lahir':
$a = datediff($m_pasien->TGLLAHIR, date("Y-m-d"));
echo "<input type='text' value='umur ".$a[years]." tahun ".$a[months]." bulan ".$a[days]." hari' size='45' class='text'>";
break;

case 'list':
include("../list_data_pasien.php");
break;

case 'reset':
unset($_SESSION['total']);
unset($_SESSION['total2']);
echo "Record telah terhapus!";
break;
}

//update t_bayarrajal
if($_REQUEST['idxb']){
	
	$tcount	= mysql_query('SELECT IDXBILL, TARIFRS * QTY AS TOTAL  FROM t_billrajal WHERE nobill = "'.$_REQUEST['idxb'].'"');
	$sisa	= $_REQUEST['keringanan']; #10.000
	$carabayar	= $_REQUEST['carabayar'];
	while($dt = mysql_fetch_array($tcount)){
		if($sisa > 0): # Jika keringanan > 0
			$sisa_s	= $sisa - $dt['TOTAL']; #10.000 - 100.000 = 0;
			if($sisa_s > 0):
				mysql_query("UPDATE t_billrajal SET SHIFT='".$_POST['SHIFT']."', COSTSHARING = '".$dt['TOTAL']."', CARABAYAR = '".$carabayar."' WHERE IDXBILL='".$dt['IDXBILL']."'");
			elseif($sisa_s < 0):
				mysql_query("UPDATE t_billrajal SET SHIFT='".$_POST['SHIFT']."', COSTSHARING = '".$sisa."', CARABAYAR = '".$carabayar."' WHERE IDXBILL='".$dt['IDXBILL']."'");
			else:
				mysql_query("UPDATE t_billrajal SET SHIFT='".$_POST['SHIFT']."', COSTSHARING = '".$dt['TOTAL']."', CARABAYAR = '".$carabayar."' WHERE IDXBILL='".$dt['IDXBILL']."'");
			endif;
			$sisa = $sisa_s;
		endif;
	}
	
	mysql_query("UPDATE t_bayarrajal SET 
				TGLBAYAR=CURDATE(), 
				JAMBAYAR=CURTIME(), 
				JMBAYAR='".$_REQUEST['total']."', 
				NIP = '".$_SESSION['NIP']."', 
				SHIFT='".$_REQUEST['SHIFT']."', 
				TBP='".$_REQUEST['tbp']."', 
				LUNAS = '1', 
				STATUS = 'LUNAS',
				TOTCOSTSHARING = '".$_REQUEST['keringanan']."',
				ALASAN_KERINGANAN = '".$_REQUEST['alasan']."',
				CARABAYAR = '".$carabayar."'
				WHERE NOBILL='".$_REQUEST['idxb']."'")or die(mysql_error());
	
	#mysql_query("UPDATE t_billrajal SET SHIFT='".$_REQUEST['SHIFT']."', COSTSHARING = '".$costsharing."' WHERE NOBILL='".$_REQUEST['idxb']."'")or die(mysql_error());
	$lunas = mysql_query('select * from t_bayarrajal where NOBILL = "'.$_REQUEST['idxb'].'"');
	$rlunas= mysql_fetch_array($lunas);
	if($rlunas['STATUS'] == 'LUNAS'){
		echo 'ok';
	}else{
		echo 'error';
	}
}

//update t_bayarranap
if($_REQUEST['idxranap']){
	
	$nobill			= $_REQUEST['nobill'];
	$keringanan		= str_replace('','',$_REQUEST['keringanan_biaya']);
	$total			= str_replace('','',$_REQUEST['hide_total']);
	$deposit 		= str_replace('','',$_REQUEST['hide_deposit']);
	$total_bayar 	= str_replace('','',$_REQUEST['total_bayar']);
	$asuransi 		= str_replace('','',$_REQUEST['hide_asuransi']);
	$sisa_deposit	= ($deposit - $total);
	$approval		= $_REQUEST['approval'];
	if($approval == ''){
		$approval = '-';
	}
	$tcount	= mysql_query('SELECT IDXBILL, TARIFRS * QTY AS TOTAL  FROM t_billranap WHERE idxdaftar = "'.$_REQUEST['idxranap'].'" AND carabayar = 1 ORDER BY TARIFRS * QTY desc');
	$sisa	= $keringanan; #10.000
	while($dt = mysql_fetch_array($tcount)){
		if($sisa > 0): # Jika keringanan > 0
			$sisa_s	= $sisa - $dt['TOTAL']; #10.000 - 100.000 = 0;
			if($sisa_s > 0):
				mysql_query("UPDATE t_billranap SET SHIFT='".$_POST['SHIFT']."', COSTSHARING = '".$dt['TOTAL']."' WHERE IDXBILL='".$dt['IDXBILL']."'");
			elseif($sisa_s < 0):
				mysql_query("UPDATE t_billranap SET SHIFT='".$_POST['SHIFT']."', COSTSHARING = '".$sisa."' WHERE IDXBILL='".$dt['IDXBILL']."'");
			else:
				mysql_query("UPDATE t_billranap SET SHIFT='".$_POST['SHIFT']."', COSTSHARING = '".$dt['TOTAL']."' WHERE IDXBILL='".$dt['IDXBILL']."'");
			endif;
			$sisa = $sisa_s;
		endif;
	}
	
	if($total <= $deposit){ #jika deposit lebih besar dari total; 1000 <= 100
		# update t_deposit;	
		$totals			= $total * -1;
		mysql_query('insert into t_deposit set NOMR = "'.$_REQUEST['nomr'].'", IDADMISSION = "'.$_REQUEST['id_admission'].'", DEPOSIT = '.$totals.', TANGGAL = NOW()');
		mysql_query('update t_admission set deposit = '.$sisa_deposit.' where id_admission = '.$_REQUEST['id_admission']);
	}else{
		$deposits		= $deposit * -1;
		mysql_query('insert into t_deposit set NOMR = "'.$_REQUEST['nomr'].'", IDADMISSION = "'.$_REQUEST['id_admission'].'", DEPOSIT = '.$deposits.', TANGGAL = NOW()');
		mysql_query('update t_admission set deposit = 0 where id_admission = '.$_REQUEST['id_admission']);
	}
	
	mysql_query('CALL pr_bayar_ranap("'.$nobill.'","'.$_REQUEST['tbp'].'","'.$_REQUEST['SHIFT'].'","'.$total_bayar.'","'.$keringanan.'","'.$deposit.'","'.$asuransi.'","'.$approval.'","'.$_SESSION['NIP'].'")');


?>
<span style="color:#060; width:200px;" class="tb">
	<strong>Simpan Sukses!</strong>
</span>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo _BASE_;?>print_pembayaran_ranap.php?nomr=<?php echo $_REQUEST['nomr'];?>&nobill=<?php echo $_REQUEST['nobill'];?>" ><input type="button" class="text" value=" PRINT "/></a>
<? 
} 

if($_REQUEST['bayardeporanap']=="true"){
	$nobill = $_REQUEST['nobill'];
	$tbp	= $_REQUEST['tbp'];
	$shift	= $_REQUEST['shift'];
	$total	= $_REQUEST['total'];
	$sql = mysql_query('CALL pr_bayar_obat_ranap("'.$nobill.'","'.$tbp.'","'.$shift.'","'.$total.'")');
	if($sql){
		echo 'ok';
	}
}
?>