<?php
	error_reporting( 'E_ALL' );
	include( '../include/connect.php' );
	//include( 'lib/function.php' );

	if ($_POST) {
		$tgl = date( 'Y-m-d' );
		extract( $_POST );

		if ($reqdata  == 'masuk') {
			echo 'OK';
		}

		if (( $reqdata  == 'propinsi' && !empty( $nama ) )) {
			$s = '' . 'SELECT propinsi_kode from propinsi where propinsi_name=\'' . $nama . '\'';
			$h = mysql_query( $s );
			$r = mysql_fetch_array( $h );
			$sql = '' . 'select `KAB/KOTA` as kabupaten from `KAB/KOTA` where propinsi_kode=\'' . $r['propinsi_kode'] . '\' order by `KAB/KOTA`';
			$hasil = mysql_query( $sql );

			if ($row = mysql_fetch_array( $hasil )) {
				extract( $row );
				echo '' . '<option>' . $kabupaten . '</option>';
			}
		}


		if (( $reqdata  = 'tipe_pasien' && !empty( $tipe ) )) {
			$s = '' . 'SELECT kode_tipe_pasien from tipe_pasien where tipe_pasien=\'' . $tipe . '\'';
			$h = mysql_query( $s );
			$r = mysql_fetch_array( $h );
			extract( $r );
			
			$hasil = $sql = '' . 'SELECT a.kode_kelas_ruang,b.nama_kelas_ruang from total_tempat_tidur a left join kelas_ruang b on b.kode_kelas_ruang=a.kode_kelas_ruang where a.kode_RS=\'' . $koders . '\' and a.kode_tipe_pasien=' . $kode_tipe_pasien;
			mysql_query( $sql );
			
			if ($row = mysql_fetch_array( $hasil )) {
				extract( $row );
				echo '' . '<option  style=\'font-size=14px;\'>' . $nama_kelas_ruang . '</option>
';
			}
		}
	}
	
	if ($reqdata  = 'simpan') {
			$tgl_si = date_format( $masa_berlaku, 'Y-m-d' );
			$tgl1 = explode( '-', $tglberlaku12 );
			$tgl_berlaku = $tgl1[2] . '-' . $tgl1[1] . '-' . $tgl1[0];
			$sql = '' . 'UPDATE data_rs SET RUMAH_SAKIT=\'' . $namars . '\', JENIS=\'' . $jenisrs . '\', KLS_RS=\'' . $kelasrs . '\', SK_KLS=\'' . $nosk . '\', DIREKTUR_RS=\'' . $direktur . '\', ALAMAT=\'' . $alamat . '\', ' . ( '' . 'KAB_KOTA=\'' . $kab . '\', KODE=\'' . $kopos . '\', FAX=\'' . $fax . '\', TELEPON=\'' . $tlp . '\', EMAIL=\'' . $email . '\', WEBSITE=\'' . $web . '\', LUAS_TANAH=\'' . $ltanah . '\', ' ) . ( '' . 'LUAS_BANGUNAN=\'' . $lbangunan . '\', NO_SURAT_IJIN=\'' . $no_si . '\', MASA_BERLAKU_SURAT_IJIN=\'' . $masa_berlaku . '\', PENYELENGGARA=\'' . $penyelenggara . '\', ' ) . ( '' . 'RSPENDIDIKAN=\'' . $skpendidikan . '\', NOSK_PENDIDIKAN=\'' . $noskpendidikan . '\', akreditasi2012=\'' . $stakreditasi_12 . '\', ' ) . ( '' . 'tahapan_akr_2012=\'' . $tahapan_akreditasi12 . '\', berlaku_akr_2012=\'' . $tgl_berlaku . '\', simrs=\'' . $simrs . '\', bank_darah=\'' . $bank_darah . '\', ' ) . ( '' . 'ponek=\'' . $ponek . '\', hemodialisa=\'' . $hemodialisa . '\', akupunktur=\'' . $akupunktur . '\', hiperbarik=\'' . $hiperbarik . '\' where Propinsi=\'' . $koders . '\'' );
			
			$hasil = mysql_query( $sql );
			echo '<b>Data berhasil di-update.</b></br>';
		}


		if ($reqdata  = 'del_tt') {
			
			mysql_query('delete from tt where id=\'' . $id . '\' and koders=\''.$koders. '\'');
			
		}

		if ($reqdata  = 'data_tt') {
			$sql = mysql_query('select * from tt where koders= \'' . $koders . '\' and jenislayanan=\'' . $layanan . '\'' );
			$nr = mysql_num_rows( $sql );

			if (1 <= $nr) {
				echo 'Data pelayanan Sudah Ada, silahkan Klik Icon Update Data';
			}else {
				$sql = mysql_query('INSERT INTO tt (koders,jenislayanan,supervip,vip,I,II,III,isolasi,intensif,intermediate) values(\'' . $koders . '\',\'' . $layanan . '\',\'' . $svip . '\',\'' . $vip . '\',\'' . $i . '\',\'' . $ii . '\',\'' . $iii . '\',\'' . $isolasi . '\',\'' . $intensif . '\',\'' . $intermediate . '\')' );
			
			}
		}