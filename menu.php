<? session_start();
if(!isset($_SESSION['SES_REG'])){
    header("location:login.php");
}
if($_SESSION['ROLES']=="3") { ?>
<link href="../css/dropdown/dropdown.css" media="all" rel="stylesheet" type="text/css" />
<link href="../css/dropdown/themes/default/default.css" media="all" rel="stylesheet" type="text/css" />
    <? }else { ?>
<link href="css/dropdown/dropdown.css" media="all" rel="stylesheet" type="text/css" />
<link href="css/dropdown/themes/default/default.css" media="all" rel="stylesheet" type="text/css" />
    <? } ?>
<? if($_SESSION['ROLES']=="1017") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
    <li><a class="dir" href="#">MASTER</a>
        <ul>
            <li><a href="index.php?link=add_user">ADD USER</a></li>
            <li><a href="index.php?link=private">LIST USER</a></li>
            <li><a href="?link=191">EDIT ICD</a></li>
            <li><a href="?link=19">LIST ICD</a></li>
            <li><a href="index.php?link=jdoc2">ADD JADWAL</a></li>
            <li><a href="index.php?link=jdoc3">LIST JADWAL</a></li>
        </ul>
    </li>
</ul>

    <? }elseif($_SESSION['ROLES']=="1") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
    <li><a href="index.php?link=2" class="dir">PENDAFTARAN</a>
    	<ul>
			<li><a href="index.php?link=telepon">PENDAFTARAN MELALUI TELEPON</a></li>
            <li><a href="index.php?link=2bayi">PENDAFTARAN BAYI BARU LAHIR</a></li>
        </ul>
    </li>
    <li><a href="index.php?link=21">LIST DATA PASIEN</a></li>
    <li><a href="index.php?link=22">LIST KUNJUNGAN PASIEN</a></li>
    <li><a href="index.php?link=14_">ASURANSI</a></li>
    <li><a class="dir" href="#">LAPORAN</a>
        <ul>
            <li><a href="index.php?link=140">REKAP PENDAFTARAN PASIEN RAWAT JALAN</a></li>
        </ul>
    </li>
</ul>

    <? }elseif($_SESSION['ROLES']=="2") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
    <li><a href="index.php?link=33" class="dir">BILL RAJAL</a>
    	<ul>
            <li><a href="index.php?link=billaps">BILL APS</a></li>
		</ul>
    </li>
    <li><a href="index.php?link=37">DEPOSIT RANAP</a></li>
    <li><a href="index.php?link=33a">BILL RANAP</a></li>
	<li><a href="index.php?link=33depo_rajal">DEPO RAJAL</a></li>
	<li><a href="index.php?link=33gizi_rajal">GIZI RAJAL</a></li>
    <li><a class="dir" href="#">LAPORAN</a>
        <ul>
            <li><a href="index.php?link=31">LAPORAN RAWAT JALAN</a></li>
            <li><a href="index.php?link=35">LAPORAN RAWAT INAP</a></li>
        </ul>
    </li>
</ul>

    <? }elseif($_SESSION['ROLES']=="4") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
    <li><a href="index.php?link=5&page=<?=$_SESSION['page']?>&tgl_reg=<?=$_SESSION['tgl_reg']?>&tgl_reg2=<?=$_SESSION['tgl_reg2']?>&nama=<?=$_SESSION['nama']?>&norm=<?=$_SESSION['norm']?>">LIST KUNJUNGAN PASIEN</a></li>

        <? if($_SESSION['KDUNIT']=="10") { ?>
	<li><a href="index.php?link=5ranap">LIST PASIEN RAWAT INAP VK</a></li>
    <li><a href="index.php?link=v01">REGISTRASI PARTUS</a></li>
    <li><a class="dir" href="#">LAPORAN</a>
        <ul>
            <li><a href="?link=139">SENSUS HARIAN</a></li>
            <li><a href="?link=jas9">JASPEL</a></li>
        </ul>
    </li>

            <? }elseif($_SESSION['KDUNIT']=="9") { ?>

    <li><a class="dir" href="#">LAPORAN</a>
        <ul>
            <li><a href="?link=54">SENSUS HARIAN</a></li>
        </ul>
    </li>

            <? }else { ?>

    <li><a class="dir" href="#">LAPORAN</a>
        <ul>
            <li><a href="?link=54">SENSUS HARIAN</a></li>
            <li><a href="?link=jas1">JASPEL</a></li>
        </ul>
    </li>

            <? } ?>

    <li><a class="dir" href="#">FARMASI & LOGISTIK</a>
        <ul>
            <li><a href="index.php?link=f04" >PENGELUARAN</a></li>
            <li><a href="index.php?link=f06" >LIST PENGELUARAN</a></li>
            <li><a href="index.php?link=f01" >PERMINTAAN</a></li>
            <li><a href="index.php?link=f02" >LIST PERMINTAAN</a></li>
            <li><a href="index.php?link=f21" >PENGEMBALIAN</a></li>
            <li><a href="index.php?link=f22" >LIST PENGEMBALIAN</a></li>
            <li><a href="index.php?link=f07" >PERENCANAAN PENGADAAN</a></li>
            <li><a href="index.php?link=f08" >LIST PRENCANAAN PENGADAAN</a></li>
            <li><a href="index.php?link=f09" >LAPORAN BULANAN</a></li>
            <li><a href="index.php?link=f11" >LAPORAN HARIAN</a></li>
            <li><a href="index.php?link=f66" >LAPORAN STOK</a></li>
        </ul>
    </li>
	<? if($_SESSION['KDUNIT']=="40") { ?>
	<li><a href="?link=16">DATA DPMP</a></li>
    <li><a class="dir" href="#">LAPORAN</a>
        <ul>
            <li><a href="?link=161" >REKAP DPMP</a></li>
        </ul>
    </li>
	<? } ?>
    <li><a class="dir" href="#">MASTER</a>
        <ul>
            <li><a href="index.php?link=19" >ICD</a></li>
        </ul>
    </li>

</ul>

    <? }elseif($_SESSION['ROLES']=="5") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
	<li><a href="?link=6">LIST ORDER LAB</a></li>
    <li><a href="?link=6order">LIST PEMERIKSAAN LAB</a></li>
    <li><a href="?link=61">HASIL PEMERIKSAAN LAB</a></li>
    <li><a href="?link=61pasien">JASA LAB PASIEN</a></li>
    <li><a href="?link=l01">DAFTAR APS</a></li>
	<li><a href="?link=list_pasien_ranap_lab">DAFTAR PASIEN RANAP</a></li>
    <li><a href="?link=list_pasien_rajal_lab">DAFTAR PASIEN RAJAL</a></li>
    <li><a href="?link=sisipan_lab">SISIPAN</a></li>
    <li><a class="dir" href="#">LAPORAN</a>
        <ul>
            <li><a href="?link=l05">REGISTER PELAYANAN</a></li>
            <li><a href="?link=jas5">JASPEL</a></li>
        </ul>
    </li>
</ul>

    <? }elseif($_SESSION['ROLES']=="6") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">

    <li><a href="?link=7">LIST ORDER RADIOLOGI</a></li>
    <li><a href="?link=71">HASIL PEMERIKSAAN RADIOLOGI</a></li>
    <li><a href="?link=r01">DAFTAR APS</a></li>
    <li><a href="?link=list_pasien_ranap_rad">DAFTAR PASIEN RANAP</a></li>
    <li><a href="?link=list_pasien_rajal_rad">DAFTAR PASIEN RAJAL</a></li>
    <li><a class="dir" href="#">LAPORAN</a>
        <ul>
            <li><a href="?link=74">REGISTER PELAYANAN</a></li>
            <li><a href="?link=jas6">JASPEL</a></li>
        </ul>
    </li>
</ul>

    <? }elseif($_SESSION['ROLES']=="7") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
    <li><a class="dir" href="#">PERMINTAAN</a>
        <ul>
            <li><a href="?link=8">LIST PERMINTAAN</a></li>
            <li><a href="?link=85">HISTORI PERMINTAAN</a></li>
        </ul>
    </li>
    <li><a class="dir" href="#">PENERIMAAN BARANG</a>
        <ul>
            <li><a href="?link=83">FORM PENERIMAAN</a></li>
            <li><a href="?link=x83">HISTORI PENERIMAAN</a></li>
        </ul>
    </li>
    <li><a href="?link=89">PERENCANAAN PENGADAAN</a></li>
    <li><a href="?link=82">MASTER BARANG</a></li>
    <li><a class="dir" href="#">LAPORAN</a>
        <ul>
            <li><a href="index.php?link=84&lap=2" >BULANAN</a></li>
            <li><a href="index.php?link=84&lap=3" >REKAP BULANAN</a></li>
            <li><a href="index.php?link=84&lap=4" >REKAP TRIWULAN</a></li>
            <li><a href="index.php?link=84&lap=5" >REKAP TAHUNAN</a></li>
            <li><a href="index.php?link=84&lap=6" >STOK UNIT</a></li>
        </ul>
    </li>
</ul>

    <? }elseif($_SESSION['ROLES']=="8") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
    <li><a class="dir" href="#">PERMINTAAN</a>
        <ul>
            <li><a href="?link=8">LIST PERMINTAAN</a></li>
            <li><a href="?link=85">HISTORI PERMINTAAN</a></li>
        </ul>
    </li>
    <li><a class="dir" href="#">PENERIMAAN BARANG</a>
        <ul>
            <li><a href="?link=83">FORM PENERIMAAN</a></li>
            <li><a href="?link=x83">HISTORI PENERIMAAN</a></li>
        </ul>
    </li>
    <li><a href="?link=x83">PENGEMBALIAN BARANG</a></li>
    <li><a href="?link=89">PERENCANAAN PENGADAAN</a></li>
    <li><a href="?link=82">MASTER BARANG</a></li>
    <li><a class="dir" href="#">LAPORAN</a>
        <ul>
            <li><a href="index.php?link=84&lap=1" >HARIAN</a></li>
            <li><a href="index.php?link=84&lap=2" >BULANAN</a></li>
            <li><a href="index.php?link=84&lap=3" >REKAP BULANAN</a></li>
            <li><a href="index.php?link=84&lap=4" >REKAP TRIWULAN</a></li>
            <li><a href="index.php?link=84&lap=5" >REKAP TAHUNAN</a></li>
            <li><a href="index.php?link=84&lap=6" >STOK UNIT</a></li>
        </ul>
    </li>
</ul>

    <? }elseif($_SESSION['ROLES']=="9") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
    <li><a class="dir" href="#">PERMINTAAN RAJAL</a>
        <ul>
            <li><a href="?link=10permintaan">LIST PERMINTAAN</a></li>
            <li><a href="?link=10histori">HISTORI PERMINTAAN</a></li>
        </ul>
    </li>
    <li><a href="?link=list_pasien_apotek_rajal">LIST PASIEN RAJAL</a></li>
    <li><a href="?link=list_pasien_apotek_ranap">LIST PASIEN RANAP</a></li>
	<li><a href="?link=list_pasien_apotek_aps">LIST PASIEN APS</a></li>
    <li><a href="?link=retur">RETUR RANAP</a></span></li>
    <script>function info(){alert('Maaf Sementara Fungsi Ini Didisable');}</script>
    <li><a class="dir" href="#">LAPORAN</a>
        <ul>
        	<li><a href="?link=list_obat_rajal">PENGELUARAN OBAT RAJAL</a></li>
            <li><a href="?link=list_obat_ranap">PENGELUARAN OBAT RANAP</a></li>
			<li><a href="?link=list_obat_aps">PENGELUARAN OBAT APS</a></li>
            <li><a href="?link=114" >REKAP RESEP</a></li>
            <li><a href="#" >LAPORAN PEMANTAUAN RESEP OBAT GENERIK</a>
            	<ul>
                	<li><a href="?link=110x" >RAWAT JALAN</a></li>
                    <li><a href="?link=110xt" >RAWAT INAP</a></li>
                </ul>
            </li>
            
        </ul>
    </li>
    <li><a class="dir" href="#">FARMASI & LOGISTIK</a>
        <ul>
            <li><a href="index.php?link=f04" >PENGELUARAN</a></li>
            <li><a href="index.php?link=f06" >LIST PENGELUARAN</a></li>
            <li><a href="index.php?link=f01" >PERMINTAAN</a></li>
            <li><a href="index.php?link=f02" >LIST PERMINTAAN</a></li>
            <li><a href="index.php?link=f21" >PENGEMBALIAN</a></li>
            <li><a href="index.php?link=f22" >LIST PENGEMBALIAN</a></li>
            <li><a href="index.php?link=f07" >PERENCANAAN PENGADAAN</a></li>
            <li><a href="index.php?link=f08" >LIST PRENCANAAN PENGADAAN</a></li>
            <li><a href="index.php?link=f09" >LAPORAN BULANAN</a></li>
            <li><a href="index.php?link=f11" >LAPORAN HARIAN</a></li>
            <li><a href="index.php?link=f66" >LAPORAN STOK</a></li>
        </ul>
    </li>
</ul>

    <? }elseif($_SESSION['ROLES']=="100") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
    <li><a class="dir" href="#">MASTER PANTRI</a>
        <ul>
            <li><a href="?link=add_pantri">TAMBAH BAHAN MAKANAN</a></li>
            <li><a href="index.php?link=data_makanan">LIST BAHAN MAKANAN</a></li>
			<li><a href="?link=add_rencana_makanan">TAMBAH PERENCANAAN PEMBELIAN MAKANAN</a></li>
            <li><a href="index.php?link=list_jenis_makanan">LIST PERENCANAAN PEMBELIAN MAKANAN</a></li>
			<li><a href="?link=add_jenis_makanan">TAMBAH JENIS MAKANAN</a></li>
            <li><a href="index.php?link=rekap_jenis_makanan">REKAP JENIS MAKANAN</a></li>
        </ul>
    </li>
</ul>

    <? }elseif($_SESSION['ROLES']=="10") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
    <li><a href="?link=11">LIST KUNJUNGAN PASIEN UGD</a></li>
    <li><a href="?link=111">PEMERIKSAAN</a></li>
</ul>

    <? }elseif($_SESSION['ROLES']=="11") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
    <li><a class="dir" href="?link=12">LIST PASIEN RAWAT INAP</a> 
        <ul>
            <li><a href="?link=12aktif">RANAP AKTIF</a></li>
            <li><a href="?link=12nonaktif">RANAP NON AKTIF</a></li>
        </ul>
    </li>    
    <li><a href="?link=129x">PERM. MAKAN</a></li>
    <li><a href="?link=124">DATA KAMAR</a></li>
    <li><a href="?link=125">PENCARIAN PASIEN</a></li>
    <li><a class="dir" href="#">LAPORAN</a>
        <ul>
            <li><a href="?link=122harian">LAPORAN HARIAN</a></li>
            <li><a href="?link=122harianpasienkeluar">LAPORAN HARIAN PASIEN KELUAR</a></li>
            <li><a href="?link=122">SENSUS HARIAN</a></li>
            <li><a href="?link=122x">BUKU REGISTER</a></li>
            <li><a href="?link=jas4">JASPEL</a></li>
        </ul>
    </li>
    <li><a class="dir" href="#">FARMASI & LOGISTIK</a>
        <ul>
            <li><a href="index.php?link=f04" >PENGELUARAN</a></li>
            <li><a href="index.php?link=f06" >LIST PENGELUARAN</a></li>
            <li><a href="index.php?link=f01" >PERMINTAAN</a></li>
            <li><a href="index.php?link=f02" >LIST PERMINTAAN</a></li>
            <li><a href="index.php?link=f21" >PENGEMBALIAN</a></li>
            <li><a href="index.php?link=f22" >LIST PENGEMBALIAN</a></li>
            <li><a href="index.php?link=f07" >PERENCANAAN PENGADAAN</a></li>
            <li><a href="index.php?link=f08" >LIST PRENCANAAN PENGADAAN</a></li>
            <li><a href="index.php?link=f09" >LAPORAN BULANAN</a></li>
            <li><a href="index.php?link=f11" >LAPORAN HARIAN</a></li>
            <li><a href="index.php?link=f66" >LAPORAN STOK</a></li>
        </ul>
    </li>
    <li><a class="dir" href="#">MASTER</a>
        <ul>
            <li><a href="?link=19">ICD</a></li>
        </ul>
    </li>
</ul>

    <? }elseif($_SESSION['ROLES']=="12") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
    <li><a href="?link=13">TRACER</a> </li>
    <li><a class="dir" href="#">LAPORAN INTERNAL</a>
        <ul>
            <li><a href="?link=133">SENSUS HARIAN RAWAT JALAN</a></li>
            <li><a href="?link=140">SENSUS PENDAFTARAN RAWAT JALAN</a></li>
            <li><a href="?link=134">SENSUS HARIAN RAWAT INAP</a></li>
			<li><a href="?link=135">LIST PASIEN RAWAT INAP</a></li>
            <li><a href="?link=138">LAPORAN HARIAN RAWAT INAP</a></li>
            <li><a href="?link=139">LAPORAN HARIAN VK</a></li>
            <li><a href="?link=lapok">LAPORAN HARIAN KAMAR OPERASI</a></li>
            <li><a href="?link=1311">SENSUS LAB</a></li>
            <li><a href="?link=1316">SENSUS HARIAN UGD</a></li>
            <li><a href="?link=1313">SENSUS RADIOLOGI</a></li>
            
        </ul>
    </li>
    <li><a class="dir" href="#">REKAPAN INTERNAL</a>
        <ul>
            <li><a href="?link=140R">REKAP PENDAFTARAN RAWAT JALAN</a></li>
            <li><a href="?link=144R">REKAP STATUS PULANG RAWAT JALAN</a></li>
            <li><a href="?link=141R">REKAP POLIKLINIK RAWAT JALAN</a></li>
            <li><a href="?link=142R">REKAP PENDAFTARAN RAWAT INAP</a></li>
        </ul>
    </li>
	<li><a href="?link=133b">INACBG</a> </li>
    <li><a class="dir" href="#">RIWAYAT PASIEN</a>
        <ul>
            <li><a href="?link=rm4">RAWAT JALAN</a></li>
            <li><a href="?link=rm5">RAWAT INAP</a></li>
        </ul>
    </li>
    <li><a class="dir" href="#">LAPORAN</a>
        <ul>
            <li><a href="?link=private21">GRAFIK KUNJUNGAN PASIEN</a></li>
            <li><a href="?link=jas1">JASPEL</a></li>
            <li><a href="?link=iso2" >ISO PENDAFTARAN</a></li>
            <li><a href="?link=pasienrujukan">PASIEN RUJUKAN</a></li>
        </ul>
    </li>
    <li><a class="dir" href="#">LAPORAN RL</a>
		<ul>
			<li><a href="?link=rl1">RL 1 Data Dasar</a>
				
			</li>
			<li><a href="?link=rl2">RL 2 Data Ketenagaan Fungsional</a></li>
			<li><a href="#">RL 3 Data Kegiatan Pelayanan Instalasi</a>
				<ul>
					<li><a href="?link=rl311">RL 3.1.1 Kegiatan Pelayanan & Cara Bayar Instalasi Rawat Jalan</a></li>
					<li><a href="?link=rl321">RL 3.2.1 Kegiatan Pelayanan Instalasi Gawat Darurat</a></li>
					<li><a href="?link=rl322">RL 3.2.2 Kegiatan Pelayanan Kecelakaan</a></li>
					<li><a href="?link=rl323">RL 3.2.3 Kegiatan Pelayanan Kebidanan</a></li>
					<li><a href="?link=rl324">RL 3.2.4 Kegiatan Pelayanan Anak</a></li>
					<li><a href="?link=rl331">RL 3.3.1 Kegiatan Pelayanan & Cara Bayar Instalasi Rawat Inap</a></li>
					<li><a href="?link=rl332">RL 3.3.2 Infeksi Nosokomial di Instalasi Rawat Inap</a></li>
					<li><a href="?link=rl341">RL 3.4.1 Kegiatan Pelayanan & Cara Bayar Instalasi Intensif</a></li>
					<li><a href="?link=rl342">RL 3.4.2 Infeksi Nosokomial di Instalasi Intensif</a></li>
					<li><a href="?link=rl351">RL 3.5.1 Kegiatan Pelayanan & Cara Bayar Instalasi Bedah Sentral</a></li>
					<li><a href="?link=rl36">RL 3.6 Kegiatan Pelayanan Radiologi</a></li>
					<li><a href="?link=rl37">RL 3.7 Kegiatan Pelayanan Laboratorium</a></li>
					<li><a href="?link=rl38">RL 3.8 Kegiatan Pelayanan Rehabilitasi Medik</a></li>
					<li><a href="?link=rl39">RL 3.9 Kegiatan Pelayanan Farmasi</a></li>
					<li><a href="?link=rl310">RL 3.10 Kegiatan Pelayanan Gizi</a></li>
				</ul>
			</li>
			<li><a href="#">RL 4 Data Mordibitas dan Mortalitas</a>
				<ul>
					<li><a href="?link=rl41">RL 4.1 Morbiditas Pasien Rawat Inap</a></li>
					<li><a href="?link=rl42">RL 4.2 Morbiditas Pasien Rawat Jalan</a></li>
					<li><a href="?link=rl43">RL 4.3 Mortalitas Pasien</a></li>
				</ul>
			</li>
		</ul>
	</li>
    <li><a class="dir" href="#">MASTER</a>
        <ul>
            <li><a href="?link=19">ICD</a></li>
        </ul>
    </li>
</ul>


    <? }elseif($_SESSION['ROLES']=="13") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
    <li><a href="?link=14_">VERIFIKASI</a></li>
    <li><a href="?link=14_askes">DATA BPJS</a></li>
    <li><a href="?link=33a_asuransi" >BILLING RANAP</a></li>
    <li><a href="?link=33_asuransi" >BILLING RAJAL</a></li>
    <li><a class="dir" href="#">LAPORAN</a>
        <ul>
        	<li><a href="?link=144_rekap" >REKAPITULASI KLAIM ASURANSI RAJAL</a></li>
            <li><a href="?link=144_rekap_ranap" >REKAPITULASI KLAIM ASURANSI RANAP</a></li>
            <li><a href="?link=140">REKAP PENDAFTARAN RAWAT JALAN</a></li>
            <li><a href="?link=142R">REKAP PENDAFTARAN RAWAT INAP</a></li>
            <li><a href="?link=14h" >HISTORI PASIEN</a></li>
        </ul>
    </li>
    <li><a class="dir" href="#">TOOL</a>
    </li>
</ul>
	

    <? }elseif($_SESSION['ROLES']=="16") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
    <li><a class="dir" href="#">RAWAT JALAN, UGD & VK</a>
        <ul>
            <li><a href="?link=private21">REKAP KUNJUNGAN PASIEN</a></li>
            <li><a href="?link=private22">REKAP KUNJUNGAN PER RUJUKAN</a></li>
            <li><a href="?link=private23">REKAP KUNJUNGAN PER CARA BAYAR</a></li>
            <li><a href="?link=private24">REKAP 10 PENYAKIT TERBANYAK</a></li>
            <li><a href="?link=private25">REKAP PENDAPATAN</a></li>
            <li><a href="?link=private27">REKAP PENDAPATAN PER CARABAYAR</a></li>
        </ul>
    </li>
    <li><a class="dir" href="#">RAWAT INAP</a>
        <ul>
            <li><a href="?link=private26">REKAP PASIEN</a></li>
            <li><a href="?link=private26_crbyr">REKAP PASIEN PER CARABAYAR</a></li>
        </ul>
    </li>
    <li><a class="dir" href="#">LABORATORIUM</a>
        <ul>
            <li><a href="?link=privatelab1">REKAP CARA BAYAR</a></li>
        </ul>
    </li>
    <li><a class="dir" href="#">RADIOLOGI</a>
        <ul>
            <li><a href="?link=privaterad1">REKAP CARA BAYAR</a></li>
        </ul>
    </li>
    <li><a class="dir" href="#">KAMAR OPERASI</a>
        <ul>
            <li><a href="?link=privatekam1">REKAP CARA BAYAR</a></li>
        </ul>
    </li>
    <li><a class="dir" href="?link=privategizi1">GIZI</a></li>
    <li><a class="dir" href="?link=privateapotek1">APOTEK</a></li>
    <li><a class="dir" href="?link=private27All">TOTAL SEMUA PENDAPATAN</a></li>
    	

</ul>

    <? }elseif($_SESSION['ROLES']=="17") { ?>
	<script>
	function popUpWARNING(URL) {
		//day = new Date();
		//id = day.getTime();
		id	= 'popcuy';
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=1000,height=400,left=50,top=50');");
	}
	jQuery(document).ready(function(){
								
		var auto_refresh = setInterval(function (){
			//popUpWARNING('daftar_pasien_harus_dipulangkan.php');
			jQuery.get('daftar_pasien_harus_dipulangkan.php',function(data){
				if(data){
					popUpWARNING('daftar_pasien_harus_dipulangkan.php');
				}
			});
		}, <?php echo _POPUPTIME_;?>);
	});
	</script>
<ul id="nav" class="dropdown dropdown-horizontal">
    <li><a href="?link=17a">DAFTAR RAWAT INAP</a></li>
    <li><a href="?link=171">LIST PASIEN RAWAT INAP</a></li>
    <li><a href="?link=17f">LIST PASIEN RAWAT JALAN</a></li>
    <li><a href="?link=173">DATA KAMAR</a></li>
    <li><a class="dir" href="#">LAPORAN</a>
        <ul>
            <li><a href="?link=138" >SENSUS RAWAT INAP</a></li>
            <li><a href="?link=122x" >BUKU REGISTER RAWAT INAP</a></li>
        </ul>
    </li>
    <li><a href="index.php?link=list_billing_ranap">LIST BILLING RANAP</a></li>
    <li><a class="dir" href="index.php?link=setting_dokter">SETTING DOKTER JAGA</a> 
		<ul>
            <li><a href="index.php?link=praktek_dokter" >PRAKTEK DOKTER</a></li>
		</ul>
    </li>
</ul>

    <? }elseif($_SESSION['ROLES']=="19") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
	<li><a href="?link=20">LIST OPERASI</a></li>
    <li><a href="?link=205">LIST RENCANA OPERASI</a></li>
    
    <li><a class="dir" href="#">LAPORAN</a>
        <ul>
        	<li><a href="?link=lapok" >Pasien OK</a></li>
        </ul>
    </li>
    <li><a class="dir" href="#">FARMASI & LOGISTIK</a>
        <ul>
            <li><a href="index.php?link=f04" >PENGELUARAN</a></li>
            <li><a href="index.php?link=f06" >LIST PENGELUARAN</a></li>
            <li><a href="index.php?link=f01" >PERMINTAAN</a></li>
            <li><a href="index.php?link=f02" >LIST PERMINTAAN</a></li>
            <li><a href="index.php?link=f21" >PENGEMBALIAN</a></li>
            <li><a href="index.php?link=f22" >LIST PENGEMBALIAN</a></li>
            <li><a href="index.php?link=f07" >PERENCANAAN PENGADAAN</a></li>
            <li><a href="index.php?link=f08" >LIST PRENCANAAN PENGADAAN</a></li>
            <li><a href="index.php?link=f09" >LAPORAN BULANAN</a></li>
            <li><a href="index.php?link=f11" >LAPORAN HARIAN</a></li>
            <li><a href="index.php?link=f66" >LAPORAN STOK</a></li>
        </ul>
    </li>
</ul>

    <? }elseif($_SESSION['ROLES']=="22") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
    <li><a href="?link=As01">LIST PASIEN BPJS</a></li>
    <li><a class="dir" href="#">LAPORAN</a>
        
    </li>
</ul>

    <? }elseif($_SESSION['ROLES']=="23") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
	<li><a href="#">SETUP</a>
        <ul>
            <li><a href="?link=general_ledger" >General Ledger</a></li>
        </ul>    
    </li>
	<li><a href="#">LAPORAN</a>
        <ul>
            <li><a href="?link=laporan_hutang" >Laporan Hutang</a></li>
            <li><a href="?link=pendapatan_piutang" >Laporan Piutang</a></li>
            <li><a href="?link=general_ledger" >General Ledger</a></li>
        </ul>    
    </li>
    <li><a href="#">PENDAPATAN</a>
     <ul>	
			<li><a href="?link=private27All" >Rekap Pendapatan per Unit</a></li>
            <li><a href="?link=36k2" >Rekap Pendapatan per Cara Bayar</a></li>
    </ul>     
    </li>  
      
</ul>

    <? }elseif($_SESSION['ROLES']=="24") { ?>

<ul id="nav" class="dropdown dropdown-horizontal">
	<li><a href="index.php?link=jas0">SETTING JASPEL</a></li>
    <li><a href="index.php?link=jas1">RAWAT JALAN</a></li>
    <li><a href="index.php?link=jas2">KAMAR OPERASI</a></li>
    <li><a href="index.php?link=jas4">RAWAT INAP</a></li>
    <li><a href="index.php?link=jas5">LABORATORIUM</a></li>
    <li><a href="index.php?link=jas6">RADIOLOGI</a></li>
    <li><a href="index.php?link=jas10">REKAP JASPEL ALL</a></li>
</ul>
	<? } elseif($_SESSION['ROLES'] == '26'){ ?>
    <ul id="nav" class="dropdown dropdown-horizontal">
    <li><a href="index.php?link=adminrajal">DATA PASIEN RAWAT JALAN</a></li>
    <li><a href="index.php?link=adminrajal_aps">DATA PASIEN APS</a></li>
    <li><a href="index.php?link=adminrajal_daftar_aps">PENDAFTARAN PASIEN APS</a></li>
    
</ul>
    <? } elseif($_SESSION['ROLES'] == '27'){ ?>
    <ul id="nav" class="dropdown dropdown-horizontal">
	<li><a href="index.php?link=list_kep">DATA PERAWAT</a></li>
	<li><a href="#" class="dir">ASUHAN KEPERAWATAN</a>
     <ul>
            <li><a href="?link=askep__" >Pengkajian Keperawatan & Diagnosa Keperawatan</a></li>
    </ul>            
    </li>
    <li><a href="#" class="dir">MANAJEMEN PELAYANAN KEPERAWATAN</a>
     <ul>
			<li><a href="?link=sdm_kep" >SDM Keperawatan</a></li>
            <li><a href="?link=met_gas" >Metode Penugasan</a></li>
			<li><a href="?link=supvis" >Supervisi</a></li>
			<li><a href="?link=lap_ranap_kep" >Laporan Rawat Inap</a></li>
			 <li><a href="?link=ind_kep" >Indikator Pelayanan Keperawatan</a></li>
    </ul>     
    </li>
	
</ul>
    <? } else { ?>
<ul id="nav" class="dropdown dropdown-horizontal">
    <li><a href="#">NO MENU FOUND.</a></li>
</ul>
    <? } ?>



