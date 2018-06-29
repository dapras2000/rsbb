
<? include("include/connect.php"); ?>

<div align="center">
  <div id="frame">
    <div id="frame_title"><h3>Tambah Deposit Pasien</h3></div>
    	<div style="margin:10px;">
        
      <?
  			echo $pmb -> begin_round("700px","FFF","CCC","CCC"); //  (width, fillcolor, edgecolor, shadowcolor)

  			$SqlDeposit = "SELECT 
					  m_pasien.NOMR,
					  m_pasien.NAMA,
					  m_pasien.TGLLAHIR,
					  m_pasien.JENISKELAMIN,
					  m_pasien.ALAMAT,
					  m_pasien.KDCARABAYAR,
					  t_admission.id_admission,
					  t_admission.nomr,
					  t_admission.nott,
					  t_admission.deposit,
					  t_admission.noruang,
					  t_billranap.IDXDAFTAR,
					  m_carabayar.KODE,
					  m_ruang.`no`,
					  m_ruang.ruang,
  					  m_carabayar.NAMA AS ncarabayar
					FROM
					  m_pasien
					  INNER JOIN t_admission ON (m_pasien.NOMR = t_admission.nomr)
					  INNER JOIN t_billranap ON (t_admission.id_admission = t_billranap.IDXDAFTAR)
					  INNER JOIN m_carabayar ON (m_pasien.KDCARABAYAR = m_carabayar.KODE)
					  INNER JOIN m_ruang ON (t_admission.noruang = m_ruang.`no`)
					WHERE
					  t_billranap.IDXDAFTAR='".$_GET['idxb']."'";
					

			$QryData = mysql_query($SqlDeposit);
			$userdata = mysql_fetch_assoc($QryData);
		?>
		  <table width="90%" border="0" cellpadding="0" cellspacing="0" class="tb" style="background-color:#EFF8F7; border:2px solid #CCC;">
            <tr>
              <td width="25%">No MR</td>
              <td width="33%"><?php echo $userdata['nomr'];?></td>
              <td width="42%" rowspan="2"><strong>Total Billing : </strong>
                <h1>Rp. <?=number_format($_GET['t'], 0).",00";?></h1></td>
            </tr>
            <tr>
              <td>Nama Lengkap Pasien</td>
              <td><?php echo $userdata['NAMA'];?></td>
            </tr>
            <tr>
              <td valign="top">Alamat Pasien</td>
              <td><?php echo $userdata['ALAMAT'];?></td>
              <td rowspan="5">
                <strong>Deposit Awal:</strong>
               
                  <h1>Rp. <?=number_format($userdata['deposit'], 0).",00";?></h1><br />
               <div id="cart_valid">
              	<strong>Tambah Deposit :</strong><br>
              	Rp. <input type="text" name="tambah_deposit" id="tambah_deposit" size="25" class="text"> 
                <input class="text" type="submit" name="tambah" onclick="javascript: MyAjaxRequest('cart_valid','carttambahdeposit_valid.php?nomr=<?=$userdata['nomr']?>&idx=<?=$_GET['idxb']?>&tambah_deposit=','tambah_deposit');" value="Tambah">
              </div>
              </td>
            </tr>
            <tr>
              <td valign="top">Jenis Kelamin</td>
              <td ><? if($userdata['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L"){echo"Laki-Laki";}elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P"){echo"Perempuan";} ?>
                <?php echo"( ". $userdata['JENISKELAMIN']." )";?></td>
            </tr>
            <tr>
              <td valign="top">Tanggal Lahir</td>
              <td><?php echo $userdata['TGLLAHIR'];?></td>
              <td width="0%"></td>
            </tr>
            <tr>
              <td valign="top">Umur</td>
              <td><?php
		  $a = datediff($userdata['TGLLAHIR'], date("Y-m-d"));
		  echo "umur ".$a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td>
            </tr>
            <tr>
              <td valign="top">Cara Bayar</td>
              <td><?php echo $userdata['ncarabayar'];?></td>
            </tr>
            <tr>
              <td valign="top">Ruang</td>
              <td><?php echo $userdata['ruang'];?></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td valign="top">No. Tempat Tidur</td>
              <td><?php echo $userdata['nott'];?></td>
              <td>&nbsp;</td>
            </tr>
          </table>

	  <? 
          	echo $pmb -> end_round();
        ?>    
    	</div>    
    </div>
</div>