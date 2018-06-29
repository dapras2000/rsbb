<?
error_reporting("E_ALL");
include('db.php');

if ($_POST) {

	extract($_POST);

	

	// Daftar Kabupaten

	if ($reqdata=='nip' && !empty($nama)) {
$s="SELECT NAMA from m_perawat where NIP='$nip'";
$h=mysql_query($s);

		while ($row=mysql_fetch_array($h)) {

			extract($row);

			echo "<option>$NAMA</option>\n";

		};

	}

	

	// Update email

	if ($reqdata=='email_update') {

		// Hapus email lama

		$sql	=	"delete from email where 1";

		$hasil	=	mysql_query($sql);

		$sql='';

		// Masukkan daftar email baru

		foreach ($_POST as $key => $value) {

			if (strpos($value,'@')>0) {

				$sql	=	"insert into email (email) value ('$value');";

				$hasil	=	mysql_query($sql);

			};

		}

		echo "

		<b>Email berhasil di-update.</b></br>

		<a href='javascript:history.back();'>Kembali ke halaman sebelumnya.</a>

		";

	};



        // Pencarian



        if ($reqdata=='pencarian') {

            	$sql	=	"select * from datadasar_rs where rs_nama like '%$nama_rs%' and kontak_email like '%$email%' and status like '%$status%'";

		$hasil	=	mysql_query($sql);

                echo "

                    <table id='tbl_rs'>

                        <tr>

                            <th>No</th>

                            <th>Nama RS</th>
							
							<th>Kode RS</th>


                            <th>Propinsi</th>

                            <th>Kabupaten/Kota</th>

                            <th>Kontak Email</th>

                            <th>Status</th>

                            <th>Hapus</th>
							<th>Create Kode</th>
                           	<th>Auto Import</th>
						    <th>Keterangan</th>
							 

                        </tr>

                ";

                $n=0;

		while ($row=mysql_fetch_array($hasil)) {

			extract($row);$n++;$s0='';$s1='';$s2='';

                        if ($status=='0') $s0="selected='selected'";

                        if ($status=='1') $s1="selected='selected'";

                        if ($status=='2') $s2="selected='selected'";

                        echo "

                            <tr style='border-top:1px dotted #888888;'>

                            <td>$n</td>

                            <td>$rs_nama</td>

							<td><input type='text' name='kode' id='kode' value= $rs_kode></td>
                            <td>$alamat_prop</td>

                            <td>$alamat_kabkota</td>

                            <td>$kontak_email</td>

                            <td>

                                <select id='status_$n' name='status_$n' onchange=\"

                                    $.post('ambildata.php',

                                    {

                                        'reqdata'       :'update_status',

                                        'status_update' :$('#status_$n').val(),

                                        'id_update'     :$('#id_$id').text(),
										'kode'			:$('#kode').val()

                                    },

                                    function (data) {

                                            $('#ket_update$n').html(data);

                                    }

                                );\">

                                    <option value='0' $s0>Administrasi</option>

                                    <option value='1' $s1 style=\"background-color:yellow;\">Legalisasi</option>

                                    <option value='2' $s2 style=\"background-color:#84ffb9;\">Selesai</option>

                                </select>

                            </td>

							<td align='center'>

								<img id='img_$n' src='del.jpg' width='24px' height='24px' style='cursor:pointer'

									onclick=\"

										$.post('ambildata.php',

										{

											'reqdata'       :'hapus_data',

											'id_update'     :$('#id_$id').text(),

											'id_status'		: '$n'

										},

										function (data) {

												$('#ket_update$n').html(data);

										}

									);

									\"

								>

							</td>
							
							<td align='center'>

								<button 
'
									
									onclick=\"

										$.post('ambildata.php',

										{

											'reqdata'       :'create_data',

											'id_update'     :$('#id_$id').text(),

											'id_status'		: '$n'

										},

										function (data) {

												$('#ket_update$n').html(data);

										}

									);

									\"

								>Create Kode
								</button>

							</td>

							<td align='center'>

								<button 
'
									
									onclick=\"

										$.post('ambildata.php',

										{

											'reqdata'       :'import_data',

											'id_update'     :$('#id_$id').text(),

											'id_status'		: '$n'

										},

										function (data) {

												$('#ket_update$n').html(data);

										}

									);

									\"

								>IMPORT
								</button>

							</td>

                            <td nowrap>

                                <span id='ket_update$n'></span><span id='id_$id' name='id_$id' style='visibility:hidden;'>$id</span>

                            </td>

                        </tr>

                        ";

		};

                echo "</table><hr>";

        }



        if ($reqdata=='update_status') {

            $sql="update datadasar_rs set rs_kode= '$kode',status='$status_update' where id='$id_update'";

            if ($hasil=mysql_query($sql)) {
				
                echo "<blink><font color='#013f1c'><b>Status terupdate</b></font></blink> ";

            } else {

                echo "Gagal di-update.";

            }

        }

		

        if ($reqdata=='hapus_data') {

            $sql="delete from datadasar_rs where id='$id_update'";

            if ($hasil=mysql_query($sql)) {

                echo "<blink><font color='#013f1c'><b>Record $n berhasil dihapus.</b></font></blink> ";

				echo "

					<script language='javascrip'>

						$('#status_$id_status').attr('disabled', 'disabled');

						$('#img_$id_status').hide();

					</script>";

            } else {

                echo "Gagal dihapus. $sql";

}
            }
			if ($reqdata=='create_data') {
$sql2	=	"select A.propinsi_kode,B.alamat_kabkota from propinsi A LEFT JOIN datadasar_rs B on B.alamat_prop=A.propinsi_name where B.id = '$id_update' ";
		$hasil2	=	mysql_query($sql2);
		$row2=mysql_fetch_array($hasil2);
		$prop=$row2[propinsi_kode];
		$kab=$row2[alamat_kabkota];
		
$sql3= "SELECT prop_id,kab_id,no_urut FROM `kab/kota`  where propinsi_kode='$row2[propinsi_kode]' and `KAB/KOTA`='$kab' ";
		$hasil3	=	mysql_query($sql3);
		$row3=mysql_fetch_array($hasil3);
			
			extract($row3);
			$no=$no_urut+1;
			if ($no>=100){
	$kode=$prop_id.$kab_id.$no;}
	else if ($no>=10 and $no<100){
	$kode=$prop_id.$kab_id."0".$no;}
	else{
	$kode=$prop_id.$kab_id."00".$no;}
            $sql3="Update datadasar_rs SET rs_kode='$kode' where id='$id_update'";

            if ($hasil3=mysql_query($sql3)) {
				mysql_query("update `kab/kota` SET no_urut='$no' where propinsi_kode='$row2[propinsi_kode]' and `KAB/KOTA`='$kab' ");
                echo "<font color='#013f1c'><b>Kode RS = $kode</b></font>";

				echo "

					<script language='javascript'>

						$('#status_$id_status').attr('disabled', 'disabled');

						$('#img_$id_status').hide();

					</script>";

            } else {
			
                 echo "Create Kode Gagal. $sql3 ";

            }

        }



        }
		
		if ($reqdata=='import_data') {
$sql2	=	"select * from datadasar_rs where id = '$id_update' ";

		$hasil2	=	mysql_query($sql2);
		$row2=mysql_fetch_array($hasil2);

			extract($row2);
            $sql3="INSERT INTO data (NO,Propinsi,TglReg,RUMAH_SAKIT,JENIS,KLS_RS,DIREKTUR_RS,ALAMAT,STATUS_PENYELENGGARA,`KAB/KOTA`,KODE,TELEPON,FAX,EMAIL,TELEPON_HUMAS,WEBSITE,LUAS_TANAH,LUAS_BANGUNAN,NO_SURAT_IJIN,TANGGAL_SURAT_IJIN,OLEH_SURAT_IJIN,SIFAT_SURAT_IJIN,MASA_BERLAKU_SURAT_IJIN,NAMA_PENYELENGGARA,PENYELENGGARA,SWASTA,PENTAHAPAN_AKREDITASI,STATUS_AKREDITASI,TT_KELAS_UTAMA,TT_KELAS_I,TT_KELAS_II,TT_KELAS_III,TT_TANPA_KELAS,TT_KELAS_III_JAMKESMAS,KAMAR_BAYI,ICU,PICU,NICU,CICU,HCU,UGD,VK,OK,tt_isolasi,SpA,SpOg,Dspd,Spb,Spr,Sprm,Span,Spjp,Spm,SptHt,Spkj,SpPK,dr_subspesialis,dr_spesialis_lain,Dr_Umum,Drg,Drg_Sp,Perawat,Bidan,Farmasi,Tenaga_Kes_Lainnya,Tenaga_Non_Kes,usrpwd,pwd,lvl,aktive,profile,usrpwd2,`TANGGAL UPDATE`,today)
VALUES( '','$rs_kode','$tgl_buat','$rs_nama','$rs_jenis','$rs_kelas','$nama_dir','$alamat','$penyelenggara_status','$alamat_kabkota','$alamat_kodepos','$alamat_telfaxemail','','','$alamat_tel_umum','$alamat_web','$luas_tanah','$luas_bangunan','$izin_no','','$izin_oleh','$izin_sifat','$izin_berlaku','$penyelenggara_status','$penyelenggara_nama','$jenis_swasta','$akreditasi_pentahapan','$akreditasi_status','$tt_utama','$vip','$tt_1','$tt_2','$tt_3','$tt_3_jkm','$perinatal','$tt_tk','$picu','$nicu','$cicu','$hcu','$ugd','$vk','$ok', '$isolasi','$spa','$spog','$sppd','$spb','$spr','$sprm','$span','$spjp','$spm','$sptht','$spkj','$sppk','$dr_subspesialis','$dr_spesialis_lain','$d_umum','$d_gigi','$d_gigi_sp','$perawat','$bidan','$farmasi','$tng_kes_lain','$tng_non_kes','$rs_kode','827ccb0eea8a706c4c34a16891f84e7b','0','1','','','00-00-0000 00:00:00','00-00-0000 00:00:00')";
mysql_query("INSERT INTO prorprp11_ugmembers (UserName, GroupID) Values ('$rs_kode',5)");
mysql_query("INSERT INTO pass (NO_URUT,usrpwd,pwd,email,aktive,profile) values ('','$rs_kode','827ccb0eea8a706c4c34a16891f84e7b','-',1,'')");


            if ($hasil3=mysql_query($sql3)) {

                echo "<blink><font color='#013f1c'><b>Record $n berhasil diimport.</b></font></blink> ";

					echo "

					<script language='javascript'>

						$('#kode').value('$kode');

						
					</script>";
// Setting koneksi ke MySQL
	$connection = mysql_connect(
					'localhost','root','n3v3rm1nd')	
					or die('Tidak bisa tersambung ke server database.');
	// Nama Database
	$db 		= mysql_select_db('sirs',$connection)
					or die('Tidak bisa tersambung ke database.');
mysql_query("INSERT INTO kode (`NAMA RS`, `KODE RS`, user, pwd) values ('$rs_nama','$rs_kode', '$rs_kode', '827ccb0eea8a706c4c34a16891f84e7b')");
mysql_query("INSERT INTO prorprp11_ugmembers (UserName, GroupID) Values ('$rs_kode',5)");
mysql_query("INSERT INTO pass (NO_URUT, usrpwd, pwd, email, aktive, profile) values ('', '$rs_kode','827ccb0eea8a706c4c34a16891f84e7b','-','1','')");



            } else {

                 echo "Import Gagal. $sql3 ";

            }

        


		

};



?>