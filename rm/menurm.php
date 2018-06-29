<div align="center">
  <div id="frame">
    <div id="frame_title">  <h3 align="left">PENGIRIMAN BERKAS REKAM MEDIK</h3></div>
    <fieldset class="fieldset">
      <legend>Identitas </legend>
<?php
 $myquery = "select a.NOMR,a.KDPOLY,a.KDDOKTER,a.TGLREG,b.NAMA,b.ALAMAT,b.JENISKELAMIN,b.TGLLAHIR,c.NAMA as CARABAYAR, a.IDXDAFTAR, d.NAMA as POLY, e.NAMADOKTER, d.nama as POLY1
			  from t_pendaftaran a, m_pasien b, m_carabayar c, m_poly d, m_dokter e
			  where a.NOMR=b.NOMR AND a.KDCARABAYAR=c.KODE AND d.KODE=a.KDPOLY and a.KDDOKTER=e.KDDOKTER
			        and a.idxdaftar='".$_GET["idx"]."'";
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get); 		
		$nomr=$userdata['NOMR'];
		$idxdaftar=$userdata['IDXDAFTAR'];
		$kdpoly=$userdata['KDPOLY'];
		$kddokter=$userdata['KDDOKTER'];
		$tglreg=$userdata['TGLREG'];
?>
<form name="myform" id="myform" action="rm/save_tracer.php" method="post">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>No MR</td>
          <td><?php echo $userdata['NOMR'];?></td>
          <td width="11%">Pengirim RM</td>
          <td width="25%"><input type="text" class="text" id="pengirim_rm" name="pengirim_rm" value="" size="20"></td>
        </tr>
        <tr>
          <td width="18%">Nama Lengkap Pasien</td>
          <td width="46%"><?php echo $userdata['NAMA'];?></td>
          <td>Tgl Kirim</td>
          <td><input type="text" class="text" id="tglkirim" name="tglkirim" value="<?php echo date("Y-m-d"); ?>" size="20"> </td>

        </tr>
        <tr>
          <td valign="top">Alamat Pasien</td>
          <td><?php echo $userdata['ALAMAT'];?></td>
          <td>Poly Tujuan</td>
          <td><?=$userdata['POLY1']?></td>
        </tr>
        <tr>
          <td valign="top">Jenis Kelamin</td>
          <td><? if($userdata['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L"){echo"Laki-Laki";}elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P"){echo"Perempuan";} ?> <?php echo"( ". $userdata['JENISKELAMIN']." )";?></td>
          <td>Status RM</td>
          <td><select name="statusrm" id="statusrm" class="text">
            <option value="0" selected="selected"> RM Lengkap</option>
            <option value="1">RM Sementara</option>
          </select></td>          
        </tr>
        <tr>
          <td valign="top">Tanggal Lahir</td>
          <td>
            <?php echo $userdata['TGLLAHIR'];?>
          </td>
          <td></td>
          <td></td>          
        </tr>
        <tr>
          <td valign="top">Umur</td>
          <td><?php
		  $a = datediff($userdata['TGLLAHIR'], date("Y-m-d"));
		  echo "umur ".$a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td>
          <td></td>
          <td></td>          
        </tr>
        <tr>
          <td valign="top">Cara Bayar</td>
          <td><?php echo $userdata['CARABAYAR'];?></td>
          <td></td>
          <td><input type="submit" name="simpan" id="simpan" class="text" value="  S a v e  "/> </td>          
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td><input type="hidden" name="kdpoly" id="kdpoly" value="<?=$userdata['KDPOLY']?>"> </td>
          <td><input type="hidden" name="idxdaftar" id="idxdaftar" value="<?=$userdata['IDXDAFTAR']?>"> </td>
          <td></td>          
        </tr>

      </table>
      </form>
    </fieldset>
  </div>
</div>

<div align="center">
  <div id="frame">
    <div id="frame_title">  <h3 align="left">PENERIMAAN BERKAS REKAM MEDIK</h3></div>
    <fieldset class="fieldset">
      <legend>Identitas </legend>
<?php
	 $myquery = "select a.NOMR,a.KDPOLY,a.KDDOKTER,a.TGLREG,b.NAMA,b.ALAMAT,b.JENISKELAMIN,b.TGLLAHIR,c.NAMA as CARABAYAR,
	  				a.IDXDAFTAR, d.NAMA as POLY, e.NAMADOKTER, d.nama as POLY1,
					case RM.STATUSRM when 0 then 'RM Lengkap' else 'RM Sementara' end as STATRM
				  from t_pendaftaran a
					INNER JOIN m_pasien b on a.NOMR=b.NOMR 
					INNER JOIN m_carabayar c on a.KDCARABAYAR=c.KODE 
					INNER JOIN m_poly d on d.KODE=a.KDPOLY 
					INNER JOIN m_dokter e on a.KDDOKTER=e.KDDOKTER
					LEFT JOIN t_rekammedik RM on RM.IDXDAFTAR = a.IDXDAFTAR
			        WHERE a.idxdaftar='".$_GET["idx"]."'";
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata1 = mysql_fetch_assoc($get); 		
		$nomr=$userdata1['NOMR'];
		$idxdaftar=$userdata1['IDXDAFTAR'];
		$kdpoly=$userdata1['KDPOLY'];
		$kddokter=$userdata['KDDOKTER'];
		$tglreg=$userdata1['TGLREG'];
		//$_SESSION['nomrx123'] = $nomr;
?>
<form name="myformterima" id="myformterima" action="rm/save_terimatracer.php" method="post">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>No MR</td>
          <td><?php echo $userdata1['NOMR'];?></td>
          <td width="11%">Penerima RM</td>
          <td width="25%"><input type="text" class="text" id="penerima_rm" name="penerima_rm" value="" size="20"></td>
        </tr>
        <tr>
          <td width="18%">Nama Lengkap Pasien</td>
          <td width="46%"><?php echo $userdata1['NAMA'];?></td>
          <td>Tgl Terima</td>
          <td><input type="text" class="text" id="tgl_terima" name="tgl_terima" value="<?php echo date("Y-m-d"); ?>" size="20"> </td>

        </tr>
        <tr>
          <td valign="top">Alamat Pasien</td>
          <td><?php echo $userdata1['ALAMAT'];?></td>
          <td>Dari Poliklinik </td>
          <td><?=$userdata1['POLY1']?></td>
        </tr>
        <tr>
          <td valign="top">Jenis Kelamin</td>
          <td><? if($userdata1['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L"){echo"Laki-Laki";}elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P"){echo"Perempuan";} ?> <?php echo"( ". $userdata['JENISKELAMIN']." )";?></td>
          <td>Status RM</td>
          <td><?=$userdata1['STATRM']?></td>          
        </tr>
        <tr>
          <td valign="top">Tanggal Lahir</td>
          <td>
            <?php echo $userdata1['TGLLAHIR'];?>
          </td>
          <td></td>
          <td></td>          
        </tr>
        <tr>
          <td valign="top">Umur</td>
          <td><?php
		  $a = datediff($userdata['TGLLAHIR'], date("Y-m-d"));
		  echo "umur ".$a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td>
          <td></td>
          <td></td>          
        </tr>
        <tr>
          <td valign="top">Cara Bayar</td>
          <td><?php echo $userdata1['CARABAYAR'];?></td>
          <td></td>
          <td><input type="submit" name="simpan" id="simpan" class="text" value="  S a v e  "/> </td>          
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td><input type="hidden" name="kdpoly" id="kdpoly" value="<?=$userdata1['KDPOLY']?>"> </td>
          <td><input type="hidden" name="idxdaftar" id="idxdaftar" value="<?=$userdata1['IDXDAFTAR']?>"> </td>
          <td></td>          
        </tr>

      </table>
      </form>
    </fieldset>
  </div>
</div>

    
        
    