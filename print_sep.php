<style type="text/css" media="print">
 #tbl_rs {	width:800px;
					height:550px;                    
                    font: 10px arial;			
					padding:3px
                    }
</style>					
<?php

if(isset($_REQUEST['idx']) && isset($_REQUEST['poly'])){
	include("include/connect.php");
	$idx	= $_REQUEST['idx'];
	$poly	= $_REQUEST['poly'];

	$sql	= 	'select t_pendaftaran.NOMR, m_pasien.nama as pasien, m_poly.nama as poly, t_pendaftaran.idxdaftar, t_pendaftaran.NOKARTU as sep, t_pendaftaran.TGLREG, m_pasien.NO_KARTU, m_pasien.TGLLAHIR, m_pasien.JENISKELAMIN, m_pasien.NMPROVIDER, t_pendaftaran.DIAGNOSA_AWAL, m_pasien.JNS_PASIEN, m_pasien.Kelas from t_pendaftaran 
				join m_pasien on t_pendaftaran.NOMR = m_pasien.NOMR 
				join m_poly on m_poly.kode = t_pendaftaran.KDPOLY
				where t_pendaftaran.KDPOLY ='.$poly.' and t_pendaftaran.IDXDAFTAR="'.$idx.'"';
	$res	= mysql_query($sql) or die(mysql_error());
	$a		= mysql_num_rows($res);
	$data	= mysql_fetch_array($res);
	extract($data);
	$tgl= date("d-m-Y",strtotime($TGLREG));
	$tgllhr= date("d-m-Y",strtotime($TGLLAHIR));
		?>
<style type="text/css">
<!--
.style1 {font-size: 12px}
.style2 {font-size: 14px}
-->
</style>

        <table align="left" id='tbl_rs'>
            <tr><th align="left" rowspan=2><img src="img/bpjs.png" border=0></th><th colspan="4" align="center" valign="bottom" style="font-size=10;">SURAT ELIGIBILITAS PESERTA</th><th>&nbsp;</th></tr>
              <tr>
                <th colspan="4" style="font-size=10;">RS. KETERGANTUNGAN OBAT JAKARTA </th><th>&nbsp;</th>
              </tr>
        <tr>
          <td width="104">&nbsp;</td>
          <td width="162">&nbsp;</td>
          <td width="100">&nbsp;</td>
          <td width="118">&nbsp;</td><td width="208">&nbsp;</td></tr>
        <tr>
          <td>Nomor SEP</td>
          <td>: <?php echo $sep; ?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
		<tr>
          <td>TGL SEP</td>
          <td>: <?php echo $tgl; ?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
		<tr>
          <td>No. Kartu</td>
          <td>: <?php echo $NO_KARTU; ?></td>
          <td>&nbsp;</td>
          <td>Peserta</td>
          <td>: <?php echo $JNS_PASIEN; ?></td>
        </tr>
		<tr>
          <td>Nama Peserta</td>
          <td>: <?php echo $pasien; ?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Tgl Lahir</td>
          <td>: <?php echo $tgllhr; ?></td>
          <td>&nbsp;</td>
          <td>COB</td>
          <td>:</td>
        </tr>
        <tr>
          <td>Jenis Kelamin</td>
          <td>: <?php echo $JENISKELAMIN; ?></td>
          <td>&nbsp;</td>
          <td>Jns Rawat</td><td>: Rawat Jalan</td></tr>
         <tr>
          <td>Poli Tujuan</td>
          <td>: <?php echo $poly; ?></td>
          <td>&nbsp;</td>
          <td>Kls Rawat</td><td>: <?php echo $Kelas; ?></td></tr>
        <tr>
          <td>Asal Faskes Tk.1</td>
          <td>: <?php echo $NMPROVIDER; ?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td><td>&nbsp;</td></tr>
        <tr>
          <td>Diagnosa Awal</td>
          <td>: <?php echo $DIAGNOSA_AWAL; ?></td>
          <td>&nbsp;</td>
          <td valign='top'>Pasien/ Keluarga Pasien</td><td valign='top'>Petugas BPJS Kesehatan</td></tr>
        <tr>
          <td>Catatan</td>
          <td>:</td>
          <td>&nbsp;</td>
          <td rowspan=2 valign='bottom'>------------------</td><td rowspan=2 valign='bottom'>------------------</td></tr>
        <tr>
          <td colspan=3>Saya menyetujui BPJS Kesehatan menggunakan informasi medis apabila dibutuhkan</td>
          </tr>
		 <tr>
          <td colspan=3>SEP bukan bukti penjamin peserta</td>
		  <td colspan=2>&nbsp;</td>
          </tr> 
        
        </table>
        <?php
	echo '</div>';
}