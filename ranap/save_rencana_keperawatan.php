<?php session_start(); 

include("../include/connect.php");

if(isset($_POST['IDADMISSION'])){
	
	$id_admission = $_POST['IDADMISSION']; 
	$nomr = $_POST['NOMR'];
	$ruang = $_POST['KDRUANG'];
	$nip = $_SESSION['NIP'];
	$d = $_POST['diagnosa'];
	$t = $_POST['tujuan'];
	$rk = $_POST['rk'];
	
	$sql_keperawatan = "SELECT idxd_perawat FROM m_diagnosa_keperawatan";
    $get_keperawatan = mysql_query($sql_keperawatan);
	while($dk = mysql_fetch_array($get_keperawatan)){ 
	    if(!empty($_POST['ck'.$dk['idxd_perawat']])){
			$idxd = $dk['idxd_perawat'];
			$tgl = $_POST['tgl'.$dk['idxd_perawat']];
			
			$q_perawat = "INSERT INTO t_rencanakeperawatan (IDX_DK, ID_ADMISSION, NOMR, RUANG, TGLMASUK, TGL, DIAGKEP, 
															HASIL, RT, NIP)
						VALUES ('$idxd', '$id_admission', '$nomr', '$ruang', '', '$tgl', '$d', '$t', '$rk', '$nip')";
			mysql_query($q_perawat);			
		}
	}
}

$v_perawat = "SELECT t_rencanakeperawatan.IDXRKEP,
					  t_rencanakeperawatan.TGL,
					  t_rencanakeperawatan.DIAGKEP,
					  t_rencanakeperawatan.HASIL,
					  t_rencanakeperawatan.RT,
					  t_rencanakeperawatan.NIP,
					  m_diagnosa_keperawatan.diagnosa,
					  m_diagnosa_keperawatan.tujuan,
					  m_diagnosa_keperawatan.rencana_keperawatan
			  FROM t_rencanakeperawatan
  			  INNER JOIN m_diagnosa_keperawatan 
			  ON (t_rencanakeperawatan.IDX_DK = m_diagnosa_keperawatan.idxd_perawat)
			  WHERE t_rencanakeperawatan.id_admission = '$id_admission'";
$g_perawat = mysql_query($v_perawat);
?>


<table border="0" width="95%" cellpadding="1" cellspacing="1" class="tb">
	<tr align="center" valign="top">
	  <th width="54" rowspan="2">Tanggal</th>
	  <th width="131" rowspan="2">Diagnosa Keperawatan</th>
	  <th width="277" rowspan="2">Hasil yang diharapkan<br />(Tujuan Sasaran)</th>
	  <th align="center">Rencana Tindakan</th>
	  <th width="80" rowspan="2">Petugas</th>
	  </tr>
	<tr>
    	<th align="center">Meliputi : Tindakan,keperawatan, tindakan observatif, penyuluhan, pelaksanaan program dokter</th>
   	  </tr>
<? while($d_perawat = mysql_fetch_array($g_perawat)){ ?>	
    
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?> valign="top">
    	<td valign="top"><?=$d_perawat['TGL']?></td>
    	<td><?=$d_perawat['diagnosa']?></td>
    	<td><?=$d_perawat['tujuan']?></td>
    	<td><?=$d_perawat['rencana_keperawatan']?></td>
    	<td valign="top"><?=$d_perawat['NIP']?></td>
    </tr>

<? } ?>    
</table>