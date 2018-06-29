
<div id="frame_title"><h3>JURNAL PENDAFTARAN RAWAT JALAN <br>PERIODE BULAN <?= $_GET["kdbulan"]?> Tahun <?=$_GET["tahun"] ?> </h3></div>


  <table width="95%" class="tb" border="1" cellpadding="1" cellspacing="1">
    <tr>
      <th rowspan="3">Tgl</th>
      <th rowspan="3">Hari</th>
      <th colspan="7">Baru</th>
      <th colspan="7">Lama</th>
      <th rowspan="3">Total <br />
        Lama<br />
        Baru</th>
      <th colspan="6">Total Per Shif</th>
      <th rowspan="3">Total 3shif</th>
      <th colspan="8">Asal Pasien</th>
      <th rowspan="3">Total</th>
	  <?$ss	= mysql_query('select * from m_poly where spesialis=1 order by kode ASC');?>
      <th colspan="<?=mysql_num_rows($ss)*2;?>">Spesialis</th>
	  <?$ss	= mysql_query('select * from m_poly where spesialis=0 order by kode ASC');?>
      <th colspan="<?=mysql_num_rows($ss)*2;?>">Non Spesialis</th>
      <th rowspan="3">Total</th>
	  <?$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');?>
      <th colspan="<?=mysql_num_rows($ss)*2;?>">Cara Bayar</th>
      <th rowspan="3">Total Pasien</th>
    </tr>
    <tr>
      <th colspan="2">I</th>
      <th colspan="2">II</th>
      <th colspan="2">III</th>
      <th rowspan="2">Total</th>
      <th colspan="2">I</th>
      <th colspan="2">II</th>
      <th colspan="2">III</th>
      <th rowspan="2">Total</th>
      <th colspan="2" rowspan="2">I</th>
      <th colspan="2" rowspan="2">II</th>
      <th colspan="2" rowspan="2">III</th>
      <th colspan="2">DS</th>
      <th colspan="2">PKM</th>
      <th colspan="2">RS Lain</th>
      <th colspan="2">Lain.2</th>
      <?$ss	= mysql_query('select * from m_poly where spesialis = 1 order by kode ASC');
			while($ds = mysql_fetch_array($ss)){
			echo '<th colspan="2">'.$ds['nama'].'</th>';
		}?>
	  <?$ss	= mysql_query('select * from m_poly where spesialis = 0 order by kode ASC');
			while($ds = mysql_fetch_array($ss)){
			echo '<th colspan="2">'.$ds['nama'].'</th>';
		}?>
	  <?$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
			while($ds = mysql_fetch_array($ss)){
			echo '<th colspan="2">'.$ds['NAMA'].'</th>';
		}?>
    </tr>
    <tr>
      <th>L</th>
      <th>P</th>
      <th>L</th>
      <th>P</th>
      <th>L</th>
      <th>P</th>
      <th>L</th>
      <th>P</th>
      <th>L</th>
      <th>P</th>
      <th>L</th>
      <th>P</th>
      <th>B</th>
      <th>L</th>
      <th>B</th>
      <th>L</th>
      <th>B</th>
      <th>L</th>
      <th>B</th>
      <th>L</th>
      <? $banyak_poly_spesialis = 0;
		$ss	= mysql_query('select * from m_poly where spesialis = 1 order by kode ASC');
			while($ds = mysql_fetch_array($ss)){
			echo '<th>B</th> <th>L</th>';
			$tmp_kode_spes[$banyak_poly_spesialis] = $ds['kode'];
			$tmp_nama_spes[$banyak_poly_spesialis] = $ds['nama'];
			$banyak_poly_spesialis++;
		}?>
	  <? $banyak_poly_non_spesialis = 0;
		$ss	= mysql_query('select * from m_poly where spesialis = 0 order by kode ASC');
			while($ds = mysql_fetch_array($ss)){
			echo '<th>B</th> <th>L</th>';
			$tmp_kode_nonspes[$banyak_poly_non_spesialis] = $ds['kode'];
			$tmp_nama_nonspes[$banyak_poly_non_spesialis] = $ds['nama'];
			$banyak_poly_non_spesialis++;
		}?>
	  <? $banyak_cara_bayar = 0;
		$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
			while($ds = mysql_fetch_array($ss)){
			echo '<th>B</th> <th>L</th>';
			$tmp_nama_cara[$banyak_cara_bayar] = $ds['NAMA'];
			$banyak_cara_bayar++;
		}?>
    </tr>
    <?php    
     if (!empty($_GET['kdbulan'])) {
		 $bln=$_GET['kdbulan'];
	} else {$bln='00';}
	 if (!empty($_GET['tahun'])){
		 $thn=$_GET['tahun'];
	} else {$thn='1000';}
	 
     //$sql="CALL pr_rekap_pendaftaranrajal('".$_GET['kdbulan']."','".$_GET['tahun']."')";
	 $sql="CALL pr_rekap_pendaftaranrajal('".$bln."','".$thn."')";
       $rs=mysql_query($sql);
	  if(!$rs) die(mysql_error());
       while ($data = mysql_fetch_array($rs)) {
  ?>
    <tr>
      <td><?=$data['tglreg'];?></td>
      <td><?=$data['hari'];?></td>
      <td><?=$data['Baru_I_L'];?></td>
      <td><?=$data['Baru_I_P'];?></td>
      <td><?=$data['Baru_II_L'];?></td>
      <td><?=$data['Baru_II_P'];?></td>
      <td><?=$data['Baru_III_L'];?></td>
      <td><?=$data['Baru_III_P'];?></td>
      <td><?=$data['Baru_I_L']+$data['Baru_I_P']+$data['Baru_II_L']+$data['Baru_II_P']+$data['Baru_III_L']+$data['Baru_III_P'];?></td>
      <td><?=$data['Lama_I_L'];?></td>
      <td><?=$data['Lama_I_P'];?></td>
      <td><?=$data['Lama_II_L'];?></td>
      <td><?=$data['Lama_II_P'];?></td>
      <td><?=$data['Lama_III_L'];?></td>
      <td><?=$data['Lama_III_P'];?></td>
      <td><?=$data['Lama_I_L']+$data['Lama_I_P']+$data['Lama_II_L']+$data['Lama_II_P']+$data['Lama_III_L']+$data['Lama_III_P']?></td>
      <td><?=$data['Baru_I_L']+$data['Baru_I_P']+$data['Baru_II_L']+$data['Baru_II_P']+$data['Baru_III_L']+$data['Baru_III_P']+
$data['Lama_I_L']+$data['Lama_I_P']+$data['Lama_II_L']+$data['Lama_II_P']+$data['Lama_III_L']+$data['Lama_III_P']?></td>
      <td colspan="2"><?=$data['Baru_I_L']+$data['Baru_I_P']+$data['Lama_I_L']+$data['Lama_I_P'];?></td>
      <td colspan="2"><?=$data['Baru_II_L']+$data['Baru_II_P']+$data['Lama_II_L']+$data['Lama_II_P'];?></td>
      <td colspan="2"><?=$data['Baru_III_L']+$data['Baru_III_P']+$data['Lama_III_L']+$data['Lama_III_P'];?></td>
      <td><?=$data['Baru_I_L']+$data['Baru_I_P']+$data['Lama_I_L']+$data['Lama_I_P']+
			$data['Baru_II_L']+$data['Baru_II_P']+$data['Lama_II_L']+$data['Lama_II_P']+
			$data['Baru_III_L']+$data['Baru_III_P']+$data['Lama_III_L']+$data['Lama_III_P'];
 ?></td>
      <td><?=$data['DS_B'];?></td>
      <td><?=$data['DS_L'];?></td>
      <td><?=$data['PKM_B'];?></td>
      <td><?=$data['PKM_L'];?></td>
      <td><?=$data['RS_B'];?></td>
      <td><?=$data['RS_L'];?></td>
      <td><?=$data['DS_LAIN_B'];?></td>
      <td><?=$data['DS_LAIN_L'];?></td>
      <td><?=$data['DS_B']+$data['DS_L']+$data['PKM_B']+$data['PKM_L']+$data['RS_B']+$data['RS_L']+$data['DS_LAIN_B']+$data['DS_LAIN_L']?></td>
      <? $tmp_jumlah = 0;
		for($i=0;$i<$banyak_poly_spesialis;$i++){
			echo '<td>'.$data[$tmp_nama_spes[$i].'_B'].'</td> <td>'.$data[$tmp_nama_spes[$i].'_L'].'</td>';
			$tmp_jumlah = $tmp_jumlah + $data[$tmp_nama_spes[$i].'_B'] + $data[$tmp_nama_spes[$i].'_L'];
	  }?>
      <?for($i=0;$i<$banyak_poly_non_spesialis;$i++){
			echo '<td>'.$data[$tmp_nama_nonspes[$i].'_B'].'</td> <td>'.$data[$tmp_nama_nonspes[$i].'_L'].'</td>';
			$tmp_jumlah = $tmp_jumlah + $data[$tmp_nama_nonspes[$i].'_B'] + $data[$tmp_nama_nonspes[$i].'_L'];
	  }?>
      <td><?=$tmp_jumlah?></td>
      <? $tmp_jumlah_cara = 0;
		for($i=0;$i<$banyak_cara_bayar;$i++){
			echo '<td>'.$data[$tmp_nama_cara[$i].'_B'].'</td> <td>'.$data[$tmp_nama_cara[$i].'_L'].'</td>';
			$tmp_jumlah_cara = $tmp_jumlah_cara + $data[$tmp_nama_cara[$i].'_B'] + $data[$tmp_nama_cara[$i].'_L'];
	  }?>
      <td> <?=$tmp_jumlah_cara?></td>
    </tr>
    <?php } ?>
  </table>