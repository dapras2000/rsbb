<?php
#session_start();
switch ($link) {
    default:
        if (!file_exists ("main.php"))
            die ("main.php File Empty!");
        include 'main.php';
        break;
    //grafik dashboard
    case 'private'            :
        if (!file_exists ("adm/list_data_user.php"))
            die ("adm/list_data_user.php File Empty!");
        include 'adm/list_data_user.php';
        break;
    //begin-Retur Apotek
    case 'retur'            :
        if (!file_exists ("retur-apotek/retur-apotek.php"))
            die ("retur-apotek/retur-apotek.php File Empty!");
        include 'retur-apotek/retur-apotek.php';
        break;
    //end-Retur Apotek
    case 'private2'            :
        if (!file_exists ("main.php"))
            die ("main.php File Empty!");
        include 'main.php';
        break;
    case 'private21'            :
        if (!file_exists ("adm/eksekutif/slide/index.php"))
            die ("adm/eksekutif/slide/index.php File Empty!");
        include 'adm/eksekutif/slide/index.php';
        break;
    case 'private22'            :
        if (!file_exists ("adm/eksekutif/slide/index_rujukan.php"))
            die ("adm/eksekutif/slide/index_rujukan.php File Empty!");
        include 'adm/eksekutif/slide/index_rujukan.php';
        break;
    case 'private23'            :
        if (!file_exists ("adm/eksekutif/slide/index_carabayar.php"))
            die ("adm/eksekutif/slide/index_carabayar.php File Empty!");
        include 'adm/eksekutif/slide/index_carabayar.php';
        break;
    case 'private24'            :
        if (!file_exists ("adm/eksekutif/slide/index_10penyakit.php"))
            die ("adm/eksekutif/slide/index_10penyakit.php File Empty!");
        include 'adm/eksekutif/slide/index_10penyakit.php';
        break;
    case 'private25'            :
        if (!file_exists ("adm/eksekutif/slide/index_pendapatan.php"))
            die ("adm/eksekutif/slide/index_pendapatan.php File Empty!");
        include 'adm/eksekutif/slide/index_pendapatan.php';
        break;
    case 'private26'            :
        if (!file_exists ("adm/eksekutif/slide/index_ranap.php"))
            die ("adm/eksekutif/slide/index_ranap.php File Empty!");
        include 'adm/eksekutif/slide/index_ranap.php';
        break;
	case 'private26_crbyr'            :
        if (!file_exists ("adm/eksekutif/slide/pendapatan_ranap_percarabayar.php"))
            die ("adm/eksekutif/slide/pendapatan_ranap_percarabayar.php File Empty!");
        include 'adm/eksekutif/slide/pendapatan_ranap_percarabayar.php';
        break;
	case 'private27'            :
        if (!file_exists ("adm/eksekutif/slide/pendapatan_rajal_percarabayar.php"))
            die ("adm/eksekutif/slide/pendapatan_rajal_percarabayar.php File Empty!");
        include 'adm/eksekutif/slide/pendapatan_rajal_percarabayar.php';
        break;
	case 'private27All'            :
        if (!file_exists ("adm/eksekutif/slide/total_pendapatan.php"))
            die ("adm/eksekutif/slide/total_pendapatan.php File Empty!");
        include 'adm/eksekutif/slide/total_pendapatan.php';
        break;
    case 'privatelab1'            :
        if (!file_exists ("adm/eksekutif/slide/lab_index_carabayar.php"))
            die ("adm/eksekutif/slide/lab_index_carabayar.php File Empty!");
        include 'adm/eksekutif/slide/lab_index_carabayar.php';
        break;
    case 'privatelab2'            :
        if (!file_exists ("adm/eksekutif/slide/lab_index_10periksa.php"))
            die ("adm/eksekutif/slide/lab_index_10periksa.php File Empty!");
        include 'adm/eksekutif/slide/lab_index_10periksa.php';
        break;
    case 'privaterad1'            :
        if (!file_exists ("adm/eksekutif/slide/rad_index_carabayar.php"))
            die ("adm/eksekutif/slide/rad_index_carabayar.php File Empty!");
        include 'adm/eksekutif/slide/rad_index_carabayar.php';
        break;
    case 'privaterad2'            :
        if (!file_exists ("adm/eksekutif/slide/rad_index_10periksa.php"))
            die ("adm/eksekutif/slide/rad_index_10periksa.php File Empty!");
        include 'adm/eksekutif/slide/rad_index_10periksa.php';
        break;
    case 'privatekam1'            :
        if (!file_exists ("adm/eksekutif/slide/kam_index_carabayar.php"))
            die ("adm/eksekutif/slide/kam_index_carabayar.php File Empty!");
        include 'adm/eksekutif/slide/kam_index_carabayar.php';
        break;
    case 'privatekam2'            :
        if (!file_exists ("adm/eksekutif/slide/kam_index_pembedahan.php"))
            die ("adm/eksekutif/slide/kam_index_pembedahan.php File Empty!");
        include 'adm/eksekutif/slide/kam_index_pembedahan.php';
        break;
	
	case 'privateapotek1'            :
        if (!file_exists ("adm/eksekutif/slide/apotek_index_carabayar.php"))
            die ("adm/eksekutif/slide/apotek_index_carabayar.php File Empty!");
        include 'adm/eksekutif/slide/apotek_index_carabayar.php';
        break;
   case 'privategizi1'            :
        if (!file_exists ("adm/eksekutif/slide/gizi_index_carabayar.php"))
            die ("adm/eksekutif/slide/gizi_index_carabayar.php File Empty!");
        include 'adm/eksekutif/slide/gizi_index_carabayar.php';
        break;

  case 'pasienrujukan'            :
        if (!file_exists ("rm/pasien_rujukan.php"))
            die ("rm/pasien_rujukan.php File Empty!");
        include 'rm/pasien_rujukan.php';
        break;

    case 'add_user'            :
        if (!file_exists ("adm/form_input_user.php"))
            die ("adm/form_input_user.php File Empty!");
        include 'adm/form_input_user.php';
        break;
    case '2'            :
        if (!file_exists ("Pendaftaran.php"))
            die ("Pendaftaran.php File Empty!");
        include 'Pendaftaran.php';
        break;
	case '2bayi'            :
        if (!file_exists ("Pendaftaran_bayi.php"))
            die ("Pendaftaran_bayi.php File Empty!");
        include 'Pendaftaran_bayi.php';
        break;
    case '2a'            :
        if (!file_exists ("PendaftaranKtpDepok.php"))
            die ("PendaftaranKtpDepok.php File Empty!");
        include 'PendaftaranKtpDepok.php';
        break;
    case '2b'            :
        if (!file_exists ("daftarCariNik.php"))
            die ("daftarCariNik.php File Empty!");
        include 'daftarCariNik.php';
        break;
    case '2c'            :
        if (!file_exists ("daftarCariNama.php"))
            die ("daftarCariNama.php File Empty!");
        include 'daftarCariNama.php';
        break;
    case '2d'            :
        if (!file_exists ("PendaftaranKtp.php"))
            die ("PendaftaranKtp.php File Empty!");
        include 'PendaftaranKtp.php';
        break;
    case '2f'            :
        if (!file_exists ("cari_pasien_asuransi.php"))
            die ("cari_pasien_asuransi.php File Empty!");
        include 'cari_pasien_asuransi.php';
        break;
    case '2g'            :
        if (!file_exists ("daftarCariAsuransi.php"))
            die ("daftarCariAsuransi.php File Empty!");
        include 'daftarCariAsuransi.php';
        break;
    case '21'            :
        if (!file_exists ("list_data_pasien.php"))
            die ("list_data_pasien.php File Empty!");
        include 'list_data_pasien.php';
        break;
    case '22'            :
        if (!file_exists ("list_kunjungan_pasien.php"))
            die ("list_kunjungan_pasien.php File Empty!");
        include 'list_kunjungan_pasien.php';
        break;
    case '23'            :
        if (!file_exists ("rekap_kunjungan_pasien.php"))
            die ("rekap_kunjungan_pasien.php File Empty!");
        include 'rekap_kunjungan_pasien.php';
        break;
    case '24'            :
        if (!file_exists ("edit_m_pasien.php"))
            die ("edit_m_pasien.php File Empty!");
        include 'edit_m_pasien.php';
        break;
    case '25'            :
        if (!file_exists ("include/view_prosess.php"))
            die ("view_prosess.php File Empty!");
        include 'include/view_prosess.php';
        break;

    case '26'            :
        if (!file_exists ("list_filter_data_pasien.php"))
            die ("list_filter_data_pasien.php File Empty!");
        include 'list_filter_data_pasien.php';
        break;
    case '27'            :
        if (!file_exists ("list_filter_kunjungan_pasien.php"))
            die ("list_filter_kunjungan_pasien.php File Empty!");
        include 'list_filter_kunjungan_pasien.php';
        break;
    case '28'            :
        if (!file_exists ("upd_kunjungan_pasien.php"))
            die ("upd_kunjungan_pasien.php File Empty!");
        include 'upd_kunjungan_pasien.php';
        break;
    case '29'            :
        if (!file_exists ("del_pendaftaran.php"))
            die ("del_pendaftaran.php File Empty!");
        include 'del_pendaftaran.php';
        break;

    case '31r'            :
        if (!file_exists ("menu_pembayaran_ranap.php"))
            die ("menu_pembayaran_ranap.php File Empty!");
        include 'menu_pembayaran_ranap.php';
        break;
	case '31s2'            :
        if (!file_exists ("ranap/billranap_rajal.php"))
            die ("ranap/billranap_rajal.php File Empty!");
        include 'ranap/billranap_rajal.php';
        break;
	case '31s3'            :
        if (!file_exists ("ranap/billranap_billrajal.php"))
            die ("ranap/billranap_billrajal.php File Empty!");
        include 'ranap/billranap_billrajal.php';
        break;
    case '31s3x'            :
        if (!file_exists ("ranap/billranap_billrajal_rekap.php"))
            die ("ranap/billranap_billrajal_rekap.php File Empty!");
        include 'ranap/billranap_billrajal_rekap.php';
        break;
    case '31s'            :
        if (!file_exists ("ranap/billranap.php"))
            die ("ranap/billranap.php File Empty!");
        include 'ranap/billranap.php';
        break;
    case '31'            :
        if (!file_exists ("rekap_pembayaran.php"))
            die ("rekap_pembayaran.php File Empty!");
        include 'rekap_pembayaran.php';
        break;
	case '31pertanggal'	:
        if (!file_exists ("rekap_pembayaran_pertanggal.php"))
            die ("rekap_pembayaran_pertanggal.php File Empty!");
        include 'rekap_pembayaran_pertanggal.php';
        break;
	case '31pertanggal_det'	:
        if (!file_exists ("rekap_pembayaran_pertanggal_det.php"))
            die ("rekap_pembayaran_pertanggal_det.php File Empty!");
        include 'rekap_pembayaran_pertanggal_det.php';
        break;
    case '32'            :
        if (!file_exists ("detil_pembayaran.php"))
            die ("detil_pembayaran.php File Empty!");
        include 'detil_pembayaran.php';
        break;
    case '32r'            :
        if (!file_exists ("detil_pembayaran_ranap.php"))
            die ("detil_pembayaran_ranap.php File Empty!");
        include 'detil_pembayaran_ranap.php';
        break;
    case '32rd'            :
        if (!file_exists ("detil_pembayaran_ranap_rinci.php"))
            die ("detil_pembayaran_ranap_rinci.php File Empty!");
        include 'detil_pembayaran_ranap_rinci.php';
        break;
    case '33'            :
        if (!file_exists ("billrajal.php"))
            die ("billrajal.php File Empty!");
        include 'billrajal.php';
        break;
    case '33detail'            :
        if (!file_exists ("billrajal_detail.php"))
            die ("billrajal_detail.php File Empty!");
        include 'billrajal_detail.php';
        break;
    case '33rekapbill'            :
        if (!file_exists ("rekapbill_rajal.php"))
            die ("rekapbill_rajal.php File Empty!");
        include 'rekapbill_rajal.php';
        break;
	case '33_asuransi'            :
        if (!file_exists ("daftarklaim/billrajal.php"))
            die ("daftarklaim/billrajal.php File Empty!");
        include 'daftarklaim/billrajal.php';
        break;
	case '33a_asuransi'            :
        if (!file_exists ("daftarklaim/billranap.php"))
            die ("daftarklaim/billranap.php File Empty!");
        include 'daftarklaim/billranap.php';
        break;
    case '33batal'            :
        if (!file_exists ("billrajal_batal.php"))
            die ("billrajal_batal.php File Empty!");
        include 'billrajal_batal.php';
        break;
    case '33a'            :
        if (!file_exists ("billranap.php"))
            die ("billranap.php File Empty!");
        include 'billranap.php';
        break;
    case '33a2'            :
        if (!file_exists ("billranap_detail.php"))
            die ("billranap_detail.php File Empty!");
        include 'billranap_detail.php';
        break;
	case '33depo_rajal'            :
        if (!file_exists ("billdepo_rajal.php"))
            die ("billdepo_rajal.php File Empty!");
        include 'billdepo_rajal.php';
        break;
	case '33depo_ranap'            :
        if (!file_exists ("billdepo_ranap.php"))
            die ("billdepo_ranap.php File Empty!");
        include 'billdepo_ranap.php';
        break;
	case '33gizi_rajal'            :
        if (!file_exists ("billgizi_rajal.php"))
            die ("billgizi_rajal.php File Empty!");
        include 'billgizi_rajal.php';
        break;
	case '33gizi_ranap'            :
        if (!file_exists ("billgizi_ranap.php"))
            die ("billgizi_ranap.php File Empty!");
        include 'billgizi_ranap.php';
        break;
    case '33a_dup'            :
        if (!file_exists ("billranap_duplicate.php"))
            die ("billranap_duplicate.php File Empty!");
        include 'billranap_duplicate.php';
        break;		
    case '34'            :
        if (!file_exists ("cartbill.php"))
            die ("cartbill.php File Empty!");
        include 'cartbill.php';
        break;
	case '34gizi_rajal'            :
        if (!file_exists ("cartbill_gizirajal.php"))
            die ("cartbill_gizirajal.php File Empty!");
        include 'cartbill_gizirajal.php';
        break;
	case '34depo_rajal'            :
        if (!file_exists ("cartbill_deporajal.php"))
            die ("cartbill_deporajal.php File Empty!");
        include 'cartbill_deporajal.php';
        break;
	case '34depo_ranap'            :
        if (!file_exists ("cartbill_deporanap.php"))
            die ("cartbill_deporanap.php File Empty!");
        include 'cartbill_deporanap.php';
        break;
	case '34_asuransi'            :
        if (!file_exists ("daftarklaim/cartbill.php"))
            die ("daftarklaim/cartbill.php File Empty!");
        include 'daftarklaim/cartbill.php';
        break;
    case '34x'            :
        if (!file_exists ("rajal/cartbill.php"))
            die ("rajal/cartbill.php File Empty!");
        include 'rajal/cartbill.php';
        break;

    case '34a'            :
        if (!file_exists ("cartbillranap.php"))
            die ("cartbillranap.php File Empty!");
        include 'cartbillranap.php';
        break;
    case '34tb'            :
        if (!file_exists ("carttambahdeposit.php"))
            die ("carttambahdeposit.php File Empty!");
        include 'carttambahdeposit.php';
        break;
    case '35'            :
        if (!file_exists ("rekap_pembayaran_ranap.php"))
            die ("rekap_pembayaran_ranap.php File Empty!");
        include 'rekap_pembayaran_ranap.php';
        break;
	case '35pertanggal'            :
        if (!file_exists ("rekap_pembayaran_ranap_pertanggal.php"))
            die ("rekap_pembayaran_ranap_pertanggal.php File Empty!");
        include 'rekap_pembayaran_ranap_pertanggal.php';
        break;
	case '35pertanggal_det'            :
        if (!file_exists ("rekap_pembayaran_ranap_pertanggal_det.php"))
            die ("rekap_pembayaran_ranap_pertanggal_det.php File Empty!");
        include 'rekap_pembayaran_ranap_pertanggal_det.php';
        break;
    case '36'            :
        if (!file_exists ("detil_pembayaran_ranap.php"))
            die ("detil_pembayaran_ranap.php File Empty!");
        include 'detil_pembayaran_ranap.php';
        break;
    case '37'            :
        if (!file_exists ("cartbilldeposit.php"))
            die ("cartbilldeposit.php File Empty!");
        include 'cartbilldeposit.php';
        break;
    case 'p01'            :
        if (!file_exists ("pembayaran/rekap/menu_rekap.php"))
            die ("pembayaran/rekap/menu_rekap.php File Empty!");
        include 'pembayaran/rekap/menu_rekap.php';
        break;
    case 'p02'            :
        if (!file_exists ("pembayaran/rekap/filter_ssrd.php"))
            die ("pembayaran/rekap/filter_ssrd.php File Empty!");
        include 'pembayaran/rekap/filter_ssrd.php';
        break;
    case 'p03'            :
        if (!file_exists ("pembayaran/rekap/f_ssrd.php"))
            die ("pembayaran/rekap/f_ssrd.php File Empty!");
        include 'pembayaran/rekap/f_ssrd.php';
        break;
		
    case '5':
        if($_SESSION['KDUNIT']=="10") {
            if (!file_exists ("vk/listpasien_vk.php"))
                die ("vk/listpasien_vk.php File Empty!");
            include 'vk/listpasien_vk.php';	
		}elseif($_SESSION['KDUNIT']=="9") {
            if (!file_exists ("ugd/listpasien_ugd.php"))
                die ("ugd/listpasien_ugd.php File Empty!");
            include 'ugd/listpasien_ugd.php';
        }elseif($_SESSION['KDUNIT']=="40") {
            if (!file_exists ("gizi/listpasien_gizi.php"))
                die ("gizi/listpasien_gizi.php File Empty!");
            include 'gizi/listpasien_gizi.php';	
        }else {
            if (!file_exists ("rajal/listpasien.php"))
                die ("rajal/listpasien.php File Empty!");
            include 'rajal/listpasien.php';
        }
        break;
	case '5ranap'            :
		if (!file_exists ("vk/listpasien_vkranap.php"))
			die ("vk/listpasien_vkranap.php File Empty!");
		include 'vk/listpasien_vkranap.php';	
		break;
	case '5tindakanranap'            :
		if (!file_exists ("vk/daftar_tindakan_vkranap.php"))
			die ("vk/daftar_tindakan_vkranap.php File Empty!");
		include 'vk/daftar_tindakan_vkranap.php';	
		break;
	case '5vkranap'            :
		if (!file_exists ("vk/vkranap.php"))
			die ("vk/vkranap.php File Empty!");
		include 'vk/vkranap.php';	
		break;
    case '51'            :
        if($_SESSION['KDUNIT']=="9") {
            if (!file_exists ("ugd/menuugd.php"))
                die ("ugd/menuugd.php File Empty!");
            include 'ugd/menuugd.php';
            break;
        }else if($_SESSION['KDUNIT']=="10") {
            if (!file_exists ("vk/menu_vk.php"))
                die ("vk/menu_vk.php File Empty!");
            include 'vk/menu_vk.php';
        }else if($_SESSION['KDUNIT']=="11") {
            if (!file_exists ("rujukan/surat_rujukan.php"))
                die ("rujukan/surat_rujukan.php File Empty!");
            include 'rujukan/surat_rujukan.php';
        }else {
            if (!file_exists ("rajal/menupoly.php"))
                die ("rajal/menupoly.php File Empty!");
            include 'rajal/menupoly.php';
        }
        break;

    case '52'            :
        if (!file_exists ("rajal/permintaanbarang.php"))
            die ("rajal/permintaanbarang.php File Empty!");
        include 'rajal/permintaanbarang.php';
        break;
    case '54'            :
        if($_SESSION['KDUNIT']=="10") {
            if (!file_exists ("vk/sensus_vk.php"))
                die ("vk/sensus_vk.php File Empty!");
            include 'vk/sensus_vk.php';
            break;
        }
        if (!file_exists ("rajal/sensusrajal.php"))
            die ("rajal/sensusrajal.php File Empty!");
        include 'rajal/sensusrajal.php';
        break;
    case '53'            :
        if (!file_exists ("rajal/listpermintaanbarang.php"))
            die ("rajal/listpermintaanbarang.php File Empty!");
        include 'rajal/listpermintaanbarang.php';
        break;
    case '55'            :
        if (!file_exists ("rajal/detail_hasil_lab.php"))
            die ("rajal/detail_hasil_lab.php File Empty!");
        include 'rajal/detail_hasil_lab.php';
        break;
    case '58'            :
        if (!file_exists ("rajal/plan_pengadaan_barang.php"))
            die ("rajal/plan_pengadaan_barang.php File Empty!");
        include 'rajal/plan_pengadaan_barang.php';
        break;
    case '59'            :
        if (!file_exists ("rajal/list_plan_pengadaan_barang.php"))
            die ("rajal/list_plan_pengadaan_barang.php File Empty!");
        include 'rajal/list_plan_pengadaan_barang.php';
        break;
    case '5x'            :
        if (!file_exists ("vk/rencana_keperawatan_perinatologi.htm"))
            die ("vk/rencana_keperawatan_perinatologi.htm File Empty!");
        include 'vk/rencana_keperawatan_perinatologi.htm';
        break;

    //lab
	case 'sisipan_lab'            :
        if (!file_exists ("lab/sisipan_lab.php"))
            die ("lab/sisipan_lab.php File Empty!");
        include 'lab/sisipan_lab.php';
        break;
	case 'detail_billing_lab'            :
        if (!file_exists ("lab/detail_billing_lab.php"))
            die ("lab/detail_billing_lab.php File Empty!");
        include 'lab/detail_billing_lab.php';
        break;
	case 'remove_billing'            :
        if (!file_exists ("lab/remove_billing.php"))
            die ("lab/remove_billing.php File Empty!");
        include 'lab/remove_billing.php';
        break;
		
	case 'formorderlab_tambahan'            :
        if (!file_exists ("lab/formorderlab_tambahan.php"))
            die ("lab/formorderlab_tambahan.php File Empty!");
        include 'lab/formorderlab_tambahan.php';
        break;
		
    case '6'            :
        if (!file_exists ("lab/list_order_lab.php"))
            die ("lab/list_order_lab.php File Empty!");
        include 'lab/list_order_lab.php';
        break;
	case '6order':
		if (!file_exists ("lab/list_periksalab.php"))
            die ("lab/list_periksalab.php File Empty!");
        include 'lab/list_periksalab.php';
        break;
	case '6order_aps':
		if (!file_exists ("lab/list_periksalab_aps.php"))
            die ("lab/list_periksalab_aps.php File Empty!");
        include 'lab/list_periksalab_aps.php';
        break;
    case '61'            :
        if (!file_exists ("lab/list_hasil_lab.php"))
            die ("lab/list_hasil_lab.php File Empty!");
        include 'lab/list_hasil_lab.php';
        break;
    case '61pasien'            :
        if (!file_exists ("lab/list_hasil_lab_pasien.php"))
            die ("lab/list_hasil_lab_pasien.php File Empty!");
        include 'lab/list_hasil_lab_pasien.php';
        break;
    case '62'            :
        if (!file_exists ("lab/orderlab.php"))
            die ("lab/orderlab.php File Empty!");
        include 'lab/orderlab.php';
        break;
	case '62formorderlab'            :
        if (!file_exists ("lab/formorderlab.php"))
            die ("lab/formorderlab.php File Empty!");
        include 'lab/formorderlab.php';
        break;
    case '63'            :
        if (!file_exists ("lab/detail_hasil_lab.php"))
            die ("lab/detail_hasil_lab.php File Empty!");
        include 'lab/detail_hasil_lab.php';
        break;
    case '63pasien'            :
        if (!file_exists ("lab/detail_hasil_lab_pasien.php"))
            die ("lab/detail_hasil_lab_pasien.php File Empty!");
        include 'lab/detail_hasil_lab_pasien.php';
        break;
    case 'l01'            :
        if (!file_exists ("lab/pendaftaran_aps.php"))
            die ("lab/pendaftaran_aps.php File Empty!");
        include 'lab/pendaftaran_aps.php';
        break;
    case 'l02'            :
        if (!file_exists ("lab/add_lab_aps.php"))
            die ("lab/add_lab_aps.php File Empty!");
        include 'lab/add_lab_aps.php';
        break;
    case 'l03'            :
        if (!file_exists ("lab/list_order_aps.php"))
            die ("lab/list_order_aps.php File Empty!");
        include 'lab/list_order_aps.php';
        break;
    case 'l04'            :
        if (!file_exists ("lab/orderlab_aps.php"))
            die ("lab/orderlab_aps.php File Empty!");
        include 'lab/orderlab_aps.php';
        break;
    case 'l05'            :
        if (!file_exists ("lab/reg_pelayanan.php"))
            die ("lab/reg_pelayanan.php File Empty!");
        include 'lab/reg_pelayanan.php';
        break;
    case 'lab1'            :
        if (!file_exists ("lab/change_orderlab.php"))
            die ("lab/change_orderlab.php File Empty!");
        include 'lab/change_orderlab.php';
        break;
    case '7'            :
        if (!file_exists ("radiologi/listradiologi.php"))
            die ("radiologi/listradiologi.php File Empty!");
        include 'radiologi/listradiologi.php';
        break;
	case '7order':
		if (!file_exists ("radiologi/list_periksarad.php"))
            die ("radiologi/list_periksarad.php File Empty!");
        include 'radiologi/list_periksarad.php';
        break;
    case '71'            :
        if (!file_exists ("radiologi/list_hasilradiologi.php"))
            die ("radiologi/list_hasilradiologi.php File Empty!");
        include 'radiologi/list_hasilradiologi.php';
        break;
	case 'list_pasien_ranap_rad':
		if (!file_exists ("radiologi/list_pasien_ranap_rad.php"))
            die ("radiologi/list_pasien_ranap_rad.php File Empty!");
        include 'radiologi/list_pasien_ranap_rad.php';
        break;
	case 'list_pasien_rajal_rad':
		if (!file_exists ("radiologi/list_pasien_rajal_rad.php"))
            die ("radiologi/list_pasien_rajal_rad.php File Empty!");
        include 'radiologi/list_pasien_rajal_rad.php';
        break;
	case '72formorderrad_ranap':
		if (!file_exists ("radiologi/formorderrad_ranap.php"))
            die ("radiologi/formorderrad_ranap.php File Empty!");
        include 'radiologi/formorderrad_ranap.php';
        break;
	case '72formorderrad_rajal':
		if (!file_exists ("radiologi/formorderrad_rajal.php"))
            die ("radiologi/formorderrad_rajal.php File Empty!");
        include 'radiologi/formorderrad_rajal.php';
        break;
	case '72formorderrad'            :
        if (!file_exists ("radiologi/formorderrad.php"))
            die ("radiologi/formorderrad.php File Empty!");
        include 'radiologi/formorderrad.php';
        break;
    case '72'            :
        if (!file_exists ("radiologi/hasillihat.php"))
            die ("radiologi/hasillihat.php File Empty!");
        include 'radiologi/hasillihat.php';
        break;
    case '73'            :
        if (!file_exists ("radiologi/periksa.php"))
            die ("radiologi/periksa.php File Empty!");
        include 'radiologi/periksa.php';
        break;
    case '74'            :
        if (!file_exists ("radiologi/rekap_radiologi.php"))
            die ("radiologi/rekap_radiologi.php File Empty!");
        include 'radiologi/rekap_radiologi.php';
        break;
    case '75'            :
        if (!file_exists ("radiologi/hasil_dokter.php"))
            die ("radiologi/hasil_dokter.php File Empty!");
        include 'radiologi/hasil_dokter.php';
        break;
    case 'rd1'            :
        if (!file_exists ("radiologi/orderbarang/pengeluaranbarang.php"))
            die ("radiologi/orderbarang/pengeluaranbarang.php File Empty!");
        include("radiologi/orderbarang/pengeluaranbarang.php");
        break;

    case 'r01'            :
        if (!file_exists ("radiologi/pendaftaran_aps.php"))
            die ("radiologi/pendaftaran_aps.php File Empty!");
        include 'radiologi/pendaftaran_aps.php';
        break;
    case 'r02'            :
        if (!file_exists ("radiologi/add_rad_aps.php"))
            die ("radiologi/add_rad_aps.php File Empty!");
        include 'radiologi/add_rad_aps.php';
        break;
    case 'r03'            :
        if (!file_exists ("radiologi/list_order_aps.php"))
            die ("radiologi/list_order_aps.php File Empty!");
        include 'radiologi/list_order_aps.php';
        break;
    case 'r04'            :
        if (!file_exists ("radiologi/periksa_aps.php"))
            die ("radiologi/periksa_aps.php File Empty!");
        include 'radiologi/periksa_aps.php';
        break;
    case 'r05'            :
        if (!file_exists ("radiologi/list_hasilradiologi_aps.php"))
            die ("radiologi/list_hasilradiologi_aps.php File Empty!");
        include 'radiologi/list_hasilradiologi_aps.php';
        break;
    case 'r06'            :
        if (!file_exists ("radiologi/hasil_dokter_aps.php"))
            die ("radiologi/hasil_dokter_aps.php File Empty!");
        include 'radiologi/hasil_dokter_aps.php';
        break;
	case 'billaps':
		if (!file_exists ("bill_aps.php"))
            die ("bill_aps.php File Empty!");
        include 'bill_aps.php';
        break;
	case 'cartbill_aps':
		if (!file_exists ("cartbill_aps.php"))
            die ("cartbill_aps.php File Empty!");
        include 'cartbill_aps.php';
        break;

//menu gudang

    case '8'            :
        if (!file_exists ("gudang/listpermintaanbarang.php"))
            die ("gudang/listpermintaanbarang.php File Empty!");
        include 'gudang/listpermintaanbarang.php';
        break;
    case '81'            :
        if (!file_exists ("gudang/permintaanbarang.php"))
            die ("gudang/permintaanbarang.php File Empty!");
        include 'gudang/permintaanbarang.php';
        break;
    case '82'            :
        if (!file_exists ("gudang/listmasterbarang.php"))
            die ("gudang/listmasterbarang.php File Empty!");
        include 'gudang/listmasterbarang.php';
        break;
    case '83'            :
        if (!file_exists ("gudang/penerimaanbarang.php"))
            die ("gudang/penerimaanbarang.php File Empty!");
        include 'gudang/penerimaanbarang.php';
        break;
    case 'x83'            :
        if (!file_exists ("gudang/listhistoripenerimaan.php"))
            die ("gudang/listhistoripenerimaan.php File Empty!");
        include 'gudang/listhistoripenerimaan.php';
        break;
    case '84'            :
        if (!file_exists ("gudang/menu_laporan.php"))
            die ("gudang/menu_laporan.php File Empty!");
        include 'gudang/menu_laporan.php';
        break;
    case '85'            :
        if (!file_exists ("gudang/listhistoripermintaan.php"))
            die ("gudang/listhistoripermintaan.php File Empty!");
        include 'gudang/listhistoripermintaan.php';
        break;
    case '86'            :
        if (!file_exists ("gudang/historipermintaanbarang.php"))
            die ("gudang/historipermintaanbarang.php File Empty!");
        include 'gudang/historipermintaanbarang.php';
        break;
    case '89'            :
        if (!file_exists ("gudang/rencanapengadaan.php"))
            die ("gudang/rencanapengadaan.php File Empty!");
        include 'gudang/rencanapengadaan.php';
        break;
    case '9'            :
        if (!file_exists ("gudang/listpermintaanbarang.php"))
            die ("gudang/listpermintaanbarang.php File Empty!");
        include 'gudang/listpermintaanbarang.php';
        break;

    case 'x83'            :
        if (!file_exists ("gudang/listpengembalianbarang.php"))
            die ("gudang/listpengembalianbarang.php File Empty!");
        include 'gudang/listpengembalianbarang.php';
        break;

    case 'y83'            :
        if (!file_exists ("gudang/pengembalianbarang.php"))
            die ("gudang/pengembalianbarang.php File Empty!");
        include 'gudang/pengembalianbarang.php';
        break;

    case 'g01'            :
        if (!file_exists ("gudang/laporan_harian.php"))
            die ("gudang/laporan_harian.php File Empty!");
        include 'gudang/laporan_harian.php';
        break;

    case 'g02'            :
        if (!file_exists ("gudang/laporan_bulanan.php"))
            die ("gudang/laporan_bulanan.php File Empty!");
        include 'gudang/laporan_bulanan.php';
        break;

    case 'g03'            :
        if (!file_exists ("gudang/rekap_bulanan.php"))
            die ("gudang/rekap_bulanan.php File Empty!");
        include 'gudang/rekap_bulanan.php';
        break;

    case 'g04'            :
        if (!file_exists ("gudang/rekap_triwulan.php"))
            die ("gudang/rekap_triwulan.php File Empty!");
        include 'gudang/rekap_triwulan.php';
        break;

    case 'g05'            :
        if (!file_exists ("gudang/rekap_tahunan.php"))
            die ("gudang/rekap_tahunan.php File Empty!");
        include 'gudang/rekap_tahunan.php';
        break;

    case 'g06'            :
        if (!file_exists ("gudang/laporan_bulanan_unit.php"))
            die ("gudang/laporan_bulanan_unit.php File Empty!");
        include 'gudang/laporan_bulanan_unit.php';
        break;
    case 'g06x'            :
        if (!file_exists ("gudang/laporan_bulanan_unit_detail.php"))
            die ("gudang/laporan_bulanan_unit_detail.php File Empty!");
        include 'gudang/laporan_bulanan_unit_detail.php';
        break;


// end menu gudang		

//menu apotek
	
	case 'form_add_obatracik'            :
        if (!file_exists ("apotek/form_add_obatracik.php"))
            die ("apotek/form_add_obatracik.php File Empty!");
        include 'apotek/form_add_obatracik.php';
        break;
	case 'pengembalian_resep'            :
        if (!file_exists ("apotek/pengembalian_resep.php"))
            die ("apotek/pengembalian_resep.php File Empty!");
        include 'apotek/pengembalian_resep.php';
        break;
	case 'detail_resep'            :
        if (!file_exists ("apotek/detail_resep.php"))
            die ("apotek/detail_resep.php File Empty!");
        include 'apotek/detail_resep.php';
        break;
	case 'detail_resep_aps'            :
        if (!file_exists ("apotek/detail_resep_aps.php"))
            die ("apotek/detail_resep_aps.php File Empty!");
        include 'apotek/detail_resep_aps.php';
        break;
	case 'list_obat_rajal'            :
        if (!file_exists ("apotek/list_obat_rajal.php"))
            die ("apotek/list_obat_rajal.php File Empty!");
        include 'apotek/list_obat_rajal.php';
        break;
	case 'list_obat_aps'            :
        if (!file_exists ("apotek/list_obat_aps.php"))
            die ("apotek/list_obat_aps.php File Empty!");
        include 'apotek/list_obat_aps.php';
        break;
	case 'list_obat_ranap'            :
        if (!file_exists ("apotek/list_obat_ranap.php"))
            die ("apotek/list_obat_ranap.php File Empty!");
        include 'apotek/list_obat_ranap.php';
        break;
	case 'list_pasien_apotek_rajal'            :
        if (!file_exists ("apotek/list_pasien_apotek_rajal.php"))
            die ("apotek/list_pasien_apotek_rajal.php File Empty!");
        include 'apotek/list_pasien_apotek_rajal.php';
        break;
	case 'list_pasien_apotek_aps'            :
        if (!file_exists ("apotek/list_pasien_apotek_aps.php"))
            die ("apotek/list_pasien_apotek_aps.php File Empty!");
        include 'apotek/list_pasien_apotek_aps.php';
        break;
	case 'list_pasien_apotek_ranap'            :
        if (!file_exists ("apotek/list_pasien_apotek_ranap.php"))
            die ("apotek/list_pasien_apotek_ranap.php File Empty!");
        include 'apotek/list_pasien_apotek_ranap.php';
        break;
	case 'add_resep'            :
        if (!file_exists ("apotek/add_resep.php"))
            die ("apotek/add_resep.php File Empty!");
        include 'apotek/add_resep.php';
        break;
	case 'add_resep_aps'            :
        if (!file_exists ("apotek/add_resep_aps.php"))
            die ("apotek/add_resep_aps.php File Empty!");
        include 'apotek/add_resep_aps.php';
        break;
	
	//////////////////////////////RESEP RANAP///////////////
	case 'add_resep_ranap'            :
        if (!file_exists ("apotek/add_resep_ranap.php"))
            die ("apotek/add_resep_ranap.php File Empty!");
        include 'apotek/add_resep_ranap.php';
        break;
		
	///////////////////////////////////////////////////	
	case '10permintaan'            :
        if (!file_exists ("apotek/listpermintaanresep_rajal.php"))
            die ("apotek/listpermintaanresep_rajal.php File Empty!");
        include 'apotek/listpermintaanresep_rajal.php';
        break;
	case '10histori'            :
        if (!file_exists ("apotek/listhistoripermintaan_rajal.php"))
            die ("apotek/listhistoripermintaan_rajal.php File Empty!");
        include 'apotek/listhistoripermintaan_rajal.php';
        break;
	case '10proses'            :
        if (!file_exists ("apotek/prosespermintaan_rajal.php"))
            die ("apotek/prosespermintaan_rajal.php File Empty!");
        include 'apotek/prosespermintaan_rajal.php';
        break;
	case '10histori_rajal'            :
        if (!file_exists ("apotek/historipermintaanresep_rajal.php"))
            die ("apotek/historipermintaanresep_rajal.php File Empty!");
        include 'apotek/historipermintaanresep_rajal.php';
        break;
    case '10'            :
        if (!file_exists ("apotek/listpermintaanresep.php"))
            die ("apotek/listpermintaanresep.php File Empty!");
        include 'apotek/listpermintaanresep.php';
        break;
    case '101'            :
        if (!file_exists ("apotek/addresep.php"))
            die ("apotek/addresep.php File Empty!");
        include 'apotek/addresep.php';
        break;
    case '107'            :
        if (!file_exists ("apotek/listhistoripermintaan.php"))
            die ("apotek/listhistoripermintaan.php File Empty!");
        include 'apotek/listhistoripermintaan.php';
        break;
    case '108'            :
        if (!file_exists ("apotek/historipermintaanresep.php"))
            die ("apotek/historipermintaanresep.php File Empty!");
        include 'apotek/historipermintaanresep.php';
        break;
    case '113'            :
        if (!file_exists ("apotek/printresep.php"))
            die ("apotek/printresep.php File Empty!");
        include 'apotek/printresep.php';
        break;
    case '114'            :
        if (!file_exists ("apotek/rekap_resep.php"))
            die ("apotek/rekap_resep.php File Empty!");
        include 'apotek/rekap_resep.php';
        break;
    case '110x'            :
        if (!file_exists ("apotek/pemantauan_resep.php"))
            die ("apotek/pemantauan_resep.php File Empty!");
        include 'apotek/pemantauan_resep.php';
        break;
	case '110xt'            :
        if (!file_exists ("apotek/pemantauan_resep_ranap.php"))
            die ("apotek/pemantauan_resep_ranap.php File Empty!");
        include 'apotek/pemantauan_resep_ranap.php';
        break;
//end menu apotek

    //menu farmasi
    case 'f01'            :
        if (!file_exists ("orderbarang/permintaanbarang.php"))
            die ("orderbarang/permintaanbarang.php File Empty!");
        include 'orderbarang/permintaanbarang.php';
        break;
    case 'f02'            :
        if (!file_exists ("orderbarang/listpermintaanbarang.php"))
            die ("orderbarang/listpermintaanbarang.php File Empty!");
        include 'orderbarang/listpermintaanbarang.php';
        break;
    case 'f03'            :
        if (!file_exists ("orderbarang/penerimaanbarang.php"))
            die ("orderbarang/penerimaanbarang.php File Empty!");
        include 'orderbarang/penerimaanbarang.php';
        break;
    case 'f04'            :
        if (!file_exists ("orderbarang/pengeluaranbarang.php"))
            die ("orderbarang/pengeluaranbarang.php File Empty!");
        include 'orderbarang/pengeluaranbarang.php';
        break;
    case 'f05'            :
        if (!file_exists ("orderbarang/listpenerimaanbarang.php"))
            die ("orderbarang/listpenerimaanbarang.php File Empty!");
        include 'orderbarang/listpenerimaanbarang.php';
        break;
    case 'f06'            :
        if (!file_exists ("orderbarang/listpengeluaranbarang.php"))
            die ("orderbarang/listpengeluaranbarang.php File Empty!");
        include 'orderbarang/listpengeluaranbarang.php';
        break;
    case 'f07'            :
        if (!file_exists ("orderbarang/pengadaanbarang.php"))
            die ("orderbarang/pengadaanbarang.php File Empty!");
        include 'orderbarang/pengadaanbarang.php';
        break;
    case 'f08'            :
        if (!file_exists ("orderbarang/listpengadaanbarang.php"))
            die ("orderbarang/listpengadaanbarang.php File Empty!");
        include 'orderbarang/listpengadaanbarang.php';
        break;
    case 'f09'            :
        if (!file_exists ("orderbarang/filterlaporan_bulanan.php"))
            die ("orderbarang/filterlaporan_bulanan.php File Empty!");
        include 'orderbarang/filterlaporan_bulanan.php';
        break;
    case 'f10'            :
        if (!file_exists ("orderbarang/laporan_bulanan.php"))
            die ("orderbarang/laporan_bulanan.php File Empty!");
        include 'orderbarang/laporan_bulanan.php';
        break;
    case 'f09'            :
        if (!file_exists ("orderbarang/filterlaporan_bulanan.php"))
            die ("orderbarang/filterlaporan_bulanan.php File Empty!");
        include 'orderbarang/filterlaporan_bulanan.php';
        break;
    case 'f11'            :
        if (!file_exists ("orderbarang/filterlaporan_harian.php"))
            die ("orderbarang/filterlaporan_harian.php File Empty!");
        include 'orderbarang/filterlaporan_harian.php';
        break;
    case 'f12'            :
        if (!file_exists ("orderbarang/laporan_harian.php"))
            die ("orderbarang/laporan_harian.php File Empty!");
        include 'orderbarang/laporan_harian.php';
        break;
    case 'f44'            :
        if (!file_exists ("orderbarang/listpengeluaranbarang_pasien.php"))
            die ("orderbarang/listpengeluaranbarang_pasien.php File Empty!");
        include 'orderbarang/listpengeluaranbarang_pasien.php';
        break;
    case 'f21'            :
        if (!file_exists ("orderbarang/pengembalianbarang.php"))
            die ("orderbarang/pengembalianbarang.php File Empty!");
        include 'orderbarang/pengembalianbarang.php';
        break;
    case 'f22'            :
        if (!file_exists ("orderbarang/listpengembalianbarang.php"))
            die ("orderbarang/listpengembalianbarang.php File Empty!");
        include 'orderbarang/listpengembalianbarang.php';
        break;
    case 'f66'            :
        if (!file_exists ("orderbarang/filterbulanan_unit.php"))
            die ("orderbarang/filterbulanan_unit.php File Empty!");
        include 'orderbarang/filterbulanan_unit.php';
        break;
    case 'f66x'            :
        if (!file_exists ("orderbarang/laporan_bulanan_stok_unit.php"))
            die ("orderbarang/laporan_bulanan_stok_unit.php File Empty!");
        include 'orderbarang/laporan_bulanan_stok_unit.php';
        break;
    case 'f66y'            :
        if (!file_exists ("orderbarang/laporan_bulanan_unit_detail.php"))
            die ("orderbarang/laporan_bulanan_unit_detail.php File Empty!");
        include 'orderbarang/laporan_bulanan_unit_detail.php';
        break;
    //end menu farmasi

    case '11'            :
        if (!file_exists ("ugd/list_kunjungan_pasien.php"))
            die ("ugd/list_kunjungan_pasien.php File Empty!");
        include 'ugd/list_kunjungan_pasien.php';
        break;
    case '111'            :
        if (!file_exists ("ugd/pemeriksaan.php"))
            die ("ugd/pemeriksaan.php File Empty!");
        include 'ugd/pemeriksaan.php';
        break;
    case '12'            :
        if (!file_exists ("ranap/list_ranap.php"))
            die ("ranap/list_ranap.php File Empty!");
        include 'ranap/list_ranap.php';
        break;
    case '12aktif'            :
        if (!file_exists ("ranap/list_ranap_aktif.php"))
            die ("ranap/list_ranap_aktif.php File Empty!");
        include 'ranap/list_ranap_aktif.php';
        break;
    case '12nonaktif'            :
        if (!file_exists ("ranap/list_ranap_nonaktif.php"))
            die ("ranap/list_ranap_nonaktif.php File Empty!");
        include 'ranap/list_ranap_nonaktif.php';
        break;
    case '121'            :
        if (!file_exists ("ranap/ranap.php"))
            die ("ranap/ranap.php File Empty!");
        include 'ranap/ranap.php';
        break;
    case '129x'            :
        if (!file_exists ("ranap/list_perm_makan.php"))
            die ("ranap/list_perm_makan.php File Empty!");
        include 'ranap/list_perm_makan.php';
        break;
	case '129z'            :
        if (!file_exists ("ranap/batal_pulang.php"))
            die ("ranap/batal_pulang.php File Empty!");
        include 'ranap/batal_pulang.php';
        break;
	case '129y'            :
        if (!file_exists ("ranap/batal_pulang_penuh.php"))
            die ("ranap/batal_pulang_penuh.php File Empty!");
        include 'ranap/batal_pulang_penuh.php';
        break;
    case '122'            :
        if (!file_exists ("rm/sensusranap.php"))
            die ("rm/sensusranap.php File Empty!");
        include 'rm/sensusranap.php';
        break;
	case '122harian'            :
        if (!file_exists ("rm/sensusranap_harian.php"))
            die ("rm/sensusranap_harian.php File Empty!");
        include 'rm/sensusranap_harian.php';
        break;
	case '122harianpasienkeluar'            :
        if (!file_exists ("rm/sensusranap_harianpasienkeluar.php"))
            die ("rm/sensusranap_harianpasienkeluar.php File Empty!");
        include 'rm/sensusranap_harianpasienkeluar.php';
        break;
    case '122x'            :
        if (!file_exists ("report_rm/bukuregister_ranap.php"))
            die ("report_rm/bukuregister_ranap.php File Empty!");
        include 'report_rm/bukuregister_ranap.php';
        break;
    case '123'            :
        if (!file_exists ("orderbarang/pengeluaranbarang.php"))
            die ("orderbarang/pengeluaranbarang.php File Empty!");
        include 'orderbarang/pengeluaranbarang.php';
        break;
    case '124'            :
        if (!file_exists ("admission/list_room_pengganti.php"))
            die ("admission/list_room_pengganti.php File Empty!");
        include 'admission/list_room_pengganti.php';
        break;
    case '125'            :
        if (!file_exists ("admission/form_pencarian.php"))
            die ("admission/form_pencarian.php File Empty!");
        include 'admission/form_pencarian.php';
        break;

    //rm
    case '13'            :
        if (!file_exists ("rm/list_tracer.php"))
            die ("rm/list_tracer.php File Empty!");
        include 'rm/list_tracer.php';
        break;
    case '13m'            :
        if (!file_exists ("rm/menu_rm.php"))
            die ("rm/menu_rm.php File Empty!");
        include 'rm/menu_rm.php';
        break;
    case '13n'            :
        if (!file_exists ("rm/menu_rekap.php"))
            die ("rm/menu_rekap.php File Empty!");
        include 'rm/menu_rekap.php';
        break;

    case '131'            :
        if (!file_exists ("rm/list_filter_tracer.php"))
            die ("rm/list_filter_tracer.php File Empty!");
        include 'rm/list_filter_tracer.php';
        break;
    case '132'            :
        if (!file_exists ("rm/menurm.php"))
            die ("rm/menurm.php File Empty!");
        include 'rm/menurm.php';
        break;
    case '133'            :
        if (!file_exists ("rm/sensusrajal.php"))
            die ("rm/sensusrajal.php File Empty!");
        include 'rm/sensusrajal.php';
        break;
	 case '133b'            :
        if (!file_exists ("rm/sensusrajal_2.php"))
            die ("rm/sensusrajal_2.php File Empty!");
        include 'rm/sensusrajal_2.php';
        break;
	case '133c'            :
        if (!file_exists ("rm/get_cbg.php"))
            die ("rm/get_cbg.php File Empty!");
        include 'rm/get_cbg.php';
        break;	
    case '134'            :
        if (!file_exists ("rm/sensusranap.php"))
            die ("rm/sensusranap.php File Empty!");
        include 'rm/sensusranap.php';
        break;
    case '135'            :
        if (!file_exists ("rm/listranap.php"))
            die ("listranap.php File Empty!");
        include 'rm/listranap.php';
        break;
    case '136'            :
        if (!file_exists ("report_rm/lapharian_ok.php"))
            die ("report_rm/lapharian_ok.php File Empty!");
        include 'report_rm/lapharian_ok.php';
        break;
    case '137'            :
        if (!file_exists ("report_rm/lapharian_perinatologi.php"))
            die ("report_rm/lapharian_perinatologi.php File Empty!");
        include 'report_rm/lapharian_perinatologi.php';
        break;
    case '138'            :
        if (!file_exists ("report_rm/lapharian_ranap.php"))
            die ("report_rm/lapharian_ranap.php File Empty!");
        include 'report_rm/lapharian_ranap.php';
        break;
    case '139'            :
        if (!file_exists ("report_rm/lapharian_vk.php"))
            die ("report_rm/lapharian_vk.php File Empty!");
        include 'report_rm/lapharian_vk.php';
        break;
    case '140'            :
        if (!file_exists ("report_rm/sensus_pendaftaran_rajal.php"))
            die ("report_rm/sensus_pendaftaran_rajal.php File Empty!");
        include 'report_rm/sensus_pendaftaran_rajal.php';
        break;
    case '1310'            :
        if (!file_exists ("report_rm/sensus_farmasi.php"))
            die ("report_rm/sensus_farmasi.php File Empty!");
        include 'report_rm/sensus_farmasi.php';
        break;
    case '1311'            :
        if (!file_exists ("report_rm/sensus_lab.php"))
            die ("report_rm/sensus_lab.php File Empty!");
        include 'report_rm/sensus_lab.php';
        break;
    case '1312'            :
        if (!file_exists ("report_rm/sensus_layanan.php"))
            die ("report_rm/sensus_layanan.php File Empty!");
        include 'report_rm/sensus_layanan.php';
        break;
    case '1313'            :
        if (!file_exists ("report_rm/sensus_radiologi.php"))
            die ("report_rm/sensus_radiologi.php File Empty!");
        include 'report_rm/sensus_radiologi.php';
        break;
    case '1314'            :
        if (!file_exists ("report_rm/sensusharian_rajal.php"))
            die ("report_rm/sensusharian_rajal.php File Empty!");
        include 'report_rm/sensusharian_rajal.php';
        break;
    case '1315'            :
        if (!file_exists ("report_rm/sensusharian_ranap.php"))
            die ("report_rm/sensusharian_ranap.php File Empty!");
        include 'report_rm/sensusharian_ranap.php';
        break;
    case '1316'            :
        if (!file_exists ("report_rm/sensusharian_ugd.php"))
            die ("report_rm/sensusharian_ugd.php File Empty!");
        include 'report_rm/sensusharian_ugd.php';
        break;
    case '13xtrnal'            :
        if (!file_exists ("rm/ex_report.php"))
            die ("rm/ex_report.php File Empty!");
        include 'rm/ex_report.php';
        break;

    case 'rm4'            :
        if (!file_exists ("rm/list_histori_pasien.php"))
            die ("rm/list_histori_pasien.php File Empty!");
        include 'rm/list_histori_pasien.php';
        break;
    case 'rm5'            :
        if (!file_exists ("rm/list_histori_pasien_ranap.php"))
            die ("rm/list_histori_pasien_ranap.php File Empty!");
        include 'rm/list_histori_pasien_ranap.php';
        break;
    case 'rm6'            :
        if (!file_exists ("rm/histori_pasien_detail.php"))
            die ("rm/histori_pasien_detail.php File Empty!");
        include 'rm/histori_pasien_detail.php';
        break;
	case 'rm6r'            :
        if (!file_exists ("rm/radiologi_info.php"))
            die ("radiologi_info.php File Empty!");
        include 'rm/radiologi_info.php';
        break;
	case 'rm6l'            :
        if (!file_exists ("rm/lab_info.php"))
            die ("lab_info.php File Empty!");
        include 'rm/lab_info.php';
        break;
    case 'rm7'            :
        if (!file_exists ("rm/histori_pasien_detail_ranap.php"))
            die ("rm/histori_pasien_detail_ranap.php File Empty!");
        include 'rm/histori_pasien_detail_ranap.php';
        break;

    case '140R'            :
        if (!file_exists ("report_rm/RekapanPendaftaranRawatJalan.php"))
            die ("report_rm/RekapanPendaftaranRawatJalan.php File Empty!");
        include 'report_rm/RekapanPendaftaranRawatJalan.php';
        break;
    case '141R'            :
        if (!file_exists ("report_rm/RekapanPolyRawatJalan.php"))
            die ("report_rm/RekapanPolyRawatJalan.php File Empty!");
        include 'report_rm/RekapanPolyRawatJalan.php';
        break;
    case '142R'            :
        if (!file_exists ("report_rm/RekapSensusPendaftaranRanap.php"))
            die ("report_rm/RekapSensusPendaftaranRanap.php File Empty!");
        include 'report_rm/RekapSensusPendaftaranRanap.php';
        break;
    case '143R'            :
        if (!file_exists ("report_rm/RekapMordibitasRajal.php"))
            die ("report_rm/RekapMordibitasRajal.php File Empty!");
        include 'report_rm/RekapMordibitasRajal.php';
        break;
	case '144R'            :
        if (!file_exists ("report_rm/sensus_pulang_rajal.php"))
            die ("report_rm/sensus_pulang_rajal.php File Empty!");
        include 'report_rm/sensus_pulang_rajal.php';
        break;
	case '144Rdet'            :
        if (!file_exists ("report_rm/sensus_pulangdet_rajal.php"))
            die ("report_rm/sensus_pulangdet_rajal.php File Empty!");
        include 'report_rm/sensus_pulangdet_rajal.php';
        break;
    case 'RL2A1'            :
        if (!file_exists ("rm/rl2a1.php"))
            die ("rm/rl2a1.php File Empty!");
        include 'rm/rl2a1.php';
        break;
    case 'RL2B1'            :
        if (!file_exists ("rm/rl2b1.php"))
            die ("rm/rl2b1.php File Empty!");
        include 'rm/rl2b1.php';
        break;

    case 'iso2'            :
        if (!file_exists ("rm/iso_pendaftaran.php"))
            die ("rm/iso_pendaftaran.php File Empty!");
        include 'rm/iso_pendaftaran.php';
        break;

//jamkesmas--------------------------------------
	case '14_askes'            :
        if (!file_exists ("daftarklaim/list_pendaftaran_askes.php"))
            die ("daftarklaim/list_pendaftaran_askes.php File Empty!");
        include 'daftarklaim/list_pendaftaran_askes.php';
        break;
    case '14'            :
        if (!file_exists ("daftarklaim/upload_form.php"))
            die ("daftarklaim/upload_form.php File Empty!");
        include 'daftarklaim/upload_form.php';
        break;
    case '14h'            :
        if (!file_exists ("daftarklaim/history.php"))
            die ("daftarklaim/history.php File Empty!");
        include 'daftarklaim/history.php';
        break;
    case '14_'            :
        if (!file_exists ("daftarklaim/list_pendaftaran.php"))
            die ("daftarklaim/list_pendaftaran.php File Empty!");
        include 'daftarklaim/list_pendaftaran.php';
        break;
    case '14verifikasi'            :
        if (!file_exists ("daftarklaim/verifikasi_data.php"))
            die ("daftarklaim/verifikasi_data.php File Empty!");
        include 'daftarklaim/verifikasi_data.php';
        break;
    case '14rujukan'            :
        if (!file_exists ("daftarklaim/rujukan.php"))
            die ("daftarklaim/rujukan.php File Empty!");
        include 'daftarklaim/rujukan.php';
        break;
    case '14vrujukan'            :
        if (!file_exists ("daftarklaim/valid_rujukan.php"))
            die ("daftarklaim/valid_rujukan.php File Empty!");
        include 'daftarklaim/valid_rujukan.php';
        break;
    case '14fjp'            :
        if (!file_exists ("daftarklaim/fjp.php"))
            die ("daftarklaim/fjp.php File Empty!");
        include 'daftarklaim/fjp.php';
        break;
    case '14vfjp'            :
        if (!file_exists ("daftarklaim/valid_fjp.php"))
            die ("daftarklaim/valid_fjp.php File Empty!");
        include 'daftarklaim/valid_fjp.php';
        break;
    case '141'            :
        if (!file_exists ("daftarklaim/rekap_data_ditolak.php"))
            die ("daftarklaim/rekap_data_ditolak.php File Empty!");
        include 'daftarklaim/rekap_data_ditolak.php';
        break;
    case '142'            :
        if (!file_exists ("daftarklaim/form_klaim_rawat_jalan.php"))
            die ("daftarklaim/form_klaim_rawat_jalan.php File Empty!");
        include 'daftarklaim/form_klaim_rawat_jalan.php';
        break;
    case '143'            :
        if (!file_exists ("daftarklaim/form_klaim_rawat_inap.php"))
            die ("daftarklaim/form_klaim_rawat_inap.php File Empty!");
        include 'daftarklaim/form_klaim_rawat_inap.php';
        break;
	case '144_rekap'            :
        if (!file_exists ("daftarklaim/rekap_asuransi.php"))
            die ("daftarklaim/rekap_asuransi.php File Empty!");
        include 'daftarklaim/rekap_asuransi.php';
        break;
	case '144_pertanggal'            :
        if (!file_exists ("daftarklaim/rekap_asuransi_pertanggal.php"))
            die ("daftarklaim/rekap_asuransi_pertanggal.php File Empty!");
        include 'daftarklaim/rekap_asuransi_pertanggal.php';
        break;
	case '144_pertanggal_det'            :
        if (!file_exists ("daftarklaim/rekap_asuransi_pertanggal_det.php"))
            die ("daftarklaim/rekap_asuransi_pertanggal_det.php File Empty!");
        include 'daftarklaim/rekap_asuransi_pertanggal_det.php';
        break;
	case '144_rekap_ranap'            :
        if (!file_exists ("daftarklaim/rekap_asuransi_ranap.php"))
            die ("daftarklaim/rekap_asuransi_ranap.php File Empty!");
        include 'daftarklaim/rekap_asuransi_ranap.php';
        break;
	case '144_ranap_pertanggal'            :
        if (!file_exists ("daftarklaim/rekap_asuransi_ranap_pertanggal.php"))
            die ("daftarklaim/rekap_asuransi_ranap_pertanggal.php File Empty!");
        include 'daftarklaim/rekap_asuransi_ranap_pertanggal.php';
        break;
	case '144_ranap_pertanggal_det'            :
        if (!file_exists ("daftarklaim/rekap_asuransi_ranap_pertanggal_det.php"))
            die ("daftarklaim/rekap_asuransi_ranap_pertanggal_det.php File Empty!");
        include 'daftarklaim/rekap_asuransi_ranap_pertanggal_det.php';
        break;
    case '144'            :
        if (!file_exists ("daftarklaim/form_rekapitulasi.php"))
            die ("daftarklaim/form_rekapitulasi.php File Empty!");
        include 'daftarklaim/form_rekapitulasi.php';
        break;
    case '145'            :
        if (!file_exists ("daftarklaim/verifikasi_rawat_jalan.php"))
            die ("daftarklaim/verifikasi_rawat_jalan.php File Empty!");
        include 'daftarklaim/verifikasi_rawat_jalan.php';
        break;
    case '146'            :
        if (!file_exists ("daftarklaim/verifikasi_rawat_inap.php"))
            die ("daftarklaim/verifikasi_rawat_inap.php File Empty!");
        include 'daftarklaim/verifikasi_rawat_inap.php';
        break;

    case '147'            :
        if (!file_exists ("daftarklaim/detail_rekap_data_ditolak.php"))
            die ("daftarklaim/detail_rekap_data_ditolak.php File Empty!");
        include 'daftarklaim/detail_rekap_data_ditolak.php';
        break;
    case '148'            :
        if (!file_exists ("daftarklaim/detail_form_klaim_rawat_jalan.php"))
            die ("daftarklaim/detail_form_klaim_rawat_jalan.php File Empty!");
        include 'daftarklaim/detail_form_klaim_rawat_jalan.php';
        break;
    case '149'            :
        if (!file_exists ("daftarklaim/detail_form_klaim_rawat_inap.php"))
            die ("daftarklaim/detail_form_klaim_rawat_inap.php File Empty!");
        include 'daftarklaim/detail_form_klaim_rawat_inap.php';
        break;
    case '150'            :
        if (!file_exists ("daftarklaim/detail_form_rekapitulasi_klaim.php"))
            die ("daftarklaim/detail_form_rekapitulasi_klaim.php File Empty!");
        include 'daftarklaim/detail_form_rekapitulasi_klaim.php';
        break;
    case '151'            :
        if (!file_exists ("daftarklaim/detail_verifikasi_rawat_jalan.php"))
            die ("daftarklaim/detail_verifikasi_rawat_jalan.php File Empty!");
        include 'daftarklaim/detail_verifikasi_rawat_jalan.php';
        break;
    case '152'            :
        if (!file_exists ("daftarklaim/detail_verifikasi_rawat_inap.php"))
            die ("daftarklaim/detail_verifikasi_rawat_inap.php File Empty!");
        include 'daftarklaim/detail_verifikasi_rawat_inap.php';
        break;
    case '153'            :
        if (!file_exists ("daftarklaim/form_pencarian.php"))
            die ("daftarklaim/form_pencarian.php File Empty!");
        include 'daftarklaim/form_pencarian.php';
        break;
    case '154'            :
        if (!file_exists ("daftarklaim/list_pasien_bersarat.php"))
            die ("daftarklaim/list_pasien_bersarat.php File Empty!");
        include 'daftarklaim/list_pasien_bersarat.php';
        break;
    case '156'            :
        if (!file_exists ("daftarklaim/hasil_verifikasi_sarat.php"))
            die ("daftarklaim/hasil_verifikasi_sarat.php File Empty!");
        include 'daftarklaim/hasil_verifikasi_sarat.php';
        break;
    case '157'            :
        if (!file_exists ("daftarklaim/hasil_akhir_verifikasi.php"))
            die ("daftarklaim/hasil_akhir_verifikasi.php File Empty!");
        include 'daftarklaim/hasil_akhir_verifikasi.php';
        break;


    //---------------------------------------jamkesmas


    case '16'            :
        if (!file_exists ("gizi/dpmp.php"))
            die ("gizi/dpmp.php File Empty!");
        include 'gizi/dpmp.php';
        break;
    case '161'            :
        if (!file_exists ("gizi/rekap_dpmp.php"))
            die ("gizi/rekap_dpmp.php File Empty!");
        include 'gizi/rekap_dpmp.php';
        break;
    case '17a'            :
        if (!file_exists ("admission/form_daftarrawatinap.php"))
            die ("admission/form_daftarrawatinap.php File Empty!");
        include 'admission/form_daftarrawatinap.php';
        break;
    case '17b'            :
        if (!file_exists ("admission/batal_daftar.php"))
            die ("admission/batal_daftar.php File Empty!");
        include 'admission/batal_daftar.php';
        break;
    case '17'            :
        if (!file_exists ("admission/form_daftar.php"))
            die ("admission/form_daftar.php File Empty!");
        include 'admission/form_daftar.php';
        break;
    case '171'            :
        if (!file_exists ("admission/list_rawat_inap.php"))
            die ("admission/list_rawat_inap.php File Empty!");
        include 'admission/list_rawat_inap.php';
        break;
    case '172'            :
        if (!file_exists ("admission/response.php"))
            die ("admission/response.php File Empty!");
        include 'admission/response.php';
        break;
    case '173'            :
        if (!file_exists ("admission/list_room.php"))
            die ("admission/list_room.php File Empty!");
        include 'admission/list_room.php';
        break;
    case '173x'            :
        if (!file_exists ("admission/list_room_rujuk.php"))
            die ("admission/list_room_rujuk.php File Empty!");
        include 'admission/list_room_rujuk.php';
        break;
    case '174'            :
        if (!file_exists ("admission/simpandaftar.php"))
            die ("admission/simpandaftar.php File Empty!");
        include 'admission/simpandaftar.php';
        break;
    case '174x'            :
        if (!file_exists ("admission/simpandaftar_rujuk.php"))
            die ("admission/simpandaftar_rujuk.php File Empty!");
        include 'admission/simpandaftar_rujuk.php';
        break;
    case '175'            :
        if (!file_exists ("admission/editadmission.php"))
            die ("admission/editadmission.php File Empty!");
        include 'admission/editadmission.php';
        break;
    case '176'            :
        if (!file_exists ("admission/list_room_pengganti.php"))
            die ("admission/list_room_pengganti.php File Empty!");
        include 'admission/list_room_pengganti.php';
        break;
    case '177'            :
        if (!file_exists ("admission/form_pencarian.php"))
            die ("admission/form_pencarian.php File Empty!");
        include 'admission/form_pencarian.php';
        break;
    case '178'            :
        if (!file_exists ("admission/hasilcariadmission.php"))
            die ("admission/hasilcariadmission.php File Empty!");
        include 'admission/hasilcariadmission.php';
        break;
    case '179'            :
        if (!file_exists ("admission/sensus_pendaftaran_rawat_inap.php"))
            die ("admission/sensus_pendaftaran_rawat_inap.php File Empty!");
        include 'admission/sensus_pendaftaran_rawat_inap.php';
        break;
    case '18'            :
        if (!file_exists ("admission/index.php"))
            die ("admission/index.php File Empty!");
        include 'admission/index.php';
        break;
    case '19'            :
        if (!file_exists ("icd/index.php"))
            die ("icd/index.php File Empty!");
        include 'icd/index.php';
        break;
    case '191'            :
        if (!file_exists ("icd/edit_icd.php"))
            die ("icd/edit_icd.php File Empty!");
        include 'icd/edit_icd.php';
        break;
    case '17f'            :
        if (!file_exists ("admission/listpasien_rajal.php"))
            die ("admission/listpasien_rajal.php File Empty!");
        include 'admission/listpasien_rajal.php';
        break;
    case '17g'            :
        if (!file_exists ("admission/form_daftar_rujuk.php"))
            die ("admission/form_daftar_rujuk.php File Empty!");
        include 'admission/form_daftar_rujuk.php';
        break;

    //Kamar Operasi
	
	case 'lapok'            :
        if (!file_exists ("operasi/laporan_ok.php"))
            die ("operasi/laporan_ok.php File Empty!");
        include 'operasi/laporan_ok.php';
        break;
    case '20'            :
        if (!file_exists ("operasi/list_pasien_operasi.php"))
            die ("operasi/list_pasien_operasi.php File Empty!");
        include 'operasi/list_pasien_operasi.php';
        break;
    case '201'            :
        if (!file_exists ("operasi/form_daftar_operasi.php"))
            die ("operasi/form_daftar_operasi.php File Empty!");
        include 'operasi/form_daftar_operasi.php';
        break;
    case '202'            :
        if (!file_exists ("operasi/selesai_operasi.php"))
            die ("operasi/selesai_operasi.php File Empty!");
        include 'operasi/selesai_operasi.php';
        break;
    case '203'            :
        if (!file_exists ("operasi/laporan_operasi.php"))
            die ("operasi/laporan_operasi.php File Empty!");
        include 'operasi/laporan_operasi.php';
        break;
    case '204'            :
        if (!file_exists ("operasi/tambah_laporan_operasi.php"))
            die ("operasi/tambah_laporan_operasi.php File Empty!");
        include 'operasi/tambah_laporan_operasi.php';
        break;
    case '205'            :
        if (!file_exists ("operasi/list_rencana_operasi_elektif.php"))
            die ("operasi/list_rencana_operasi_elektif.php File Empty!");
        include 'operasi/list_rencana_operasi_elektif.php';
        break;
    case '206'            :
        if (!file_exists ("operasi/pemakaian_obat.php"))
            die ("operasi/pemakaian_obat.php File Empty!");
        include 'operasi/pemakaian_obat.php';
        break;
    case '207'            :
        if (!file_exists ("operasi/tindakan_medis.php"))
            die ("operasi/tindakan_medis.php File Empty!");
        include 'operasi/tindakan_medis.php';
        break;
    case '208'            :
        if (!file_exists ("operasi/pilih_pemakaian_obat.php"))
            die ("operasi/pilih_pemakaian_obat.php File Empty!");
        include 'operasi/pilih_pemakaian_obat.php';
        break;
    case '209'            :
        if (!file_exists ("operasi/pilih_tindakan_medis.php"))
            die ("operasi/pilih_tindakan_medis.php File Empty!");
        include 'operasi/pilih_tindakan_medis.php';
        break;
	case 'tindakan_operasi'            :
        if (!file_exists ("operasi/form_tindakan_operasi.php"))
            die ("operasi/form_tindakan_operasi.php File Empty!");
        include 'operasi/form_tindakan_operasi.php';
        break;
	case 'tindakan_operasilain'            :
        if (!file_exists ("operasi/form_tindakan_operasilain.php"))
            die ("operasi/form_tindakan_operasilain.php File Empty!");
        include 'operasi/form_tindakan_operasilain.php';
        break;
	case 'setting_dokter_operasi'            :
        if (!file_exists ("operasi/setting_dokter_operasi.php"))
            die ("operasi/setting_dokter_operasi.php File Empty!");
        include 'operasi/setting_dokter_operasi.php';
        break;
    case 'op1'            :
        if (!file_exists ("operasi/orderbarang/pengeluaranbarang.php"))
            die ("operasi/orderbarang/pengeluaranbarang.php File Empty!");
        include 'operasi/orderbarang/pengeluaranbarang.php';
        break;
    case 'x206'            :
        if (!file_exists ("operasi/orderbarang/batalpengeluaranbarang.php"))
            die ("operasi/orderbarang/batalpengeluaranbarang.php File Empty!");
        include 'operasi/orderbarang/batalpengeluaranbarang.php';
        break;
    case 'x209'            :
        if (!file_exists ("operasi/bataltindakanmedis.php"))
            die ("operasi/bataltindakanmedis.php File Empty!");
        include 'operasi/bataltindakanmedis.php';
        break;

//multi user - pendaftaran ke admission		

    case 'ad1'            :
        if (!file_exists ("admission/form_daftarrawatinap.php"))
            die ("admission/form_daftarrawatinap.php File Empty!");
        unset($_SESSION['ROLES']);
        $_SESSION['ROLES']=="ad1";
        include 'admission/form_daftarrawatinap.php';
        break;
    case 'ad2'            :
        if (!file_exists ("Pendaftaran.php"))
            die ("Pendaftaran.php File Empty!");
        unset($_SESSION['ROLES']);
        $_SESSION['ROLES']=="1";
        include 'Pendaftaran.php';
        break;


    //kamar bersalin
    case 'v01'            :
        if (!file_exists ("vk/lap_reg_partus.php"))
            die ("vk/lap_reg_partus.php File Empty!");
        include 'vk/lap_reg_partus.php';
        break;
    case 'v02'            :
        if (!file_exists ("vk/lap_harian_vk.php"))
            die ("vk/lap_harian_vk.php File Empty!");
        include 'vk/lap_harian_vk.php';
        break;
    case 'v03'            :
        if (!file_exists ("vk/list_rencana_operasi_elektif.php"))
            die ("vk/list_rencana_operasi_elektif.php File Empty!");
        include 'vk/list_rencana_operasi_elektif.php';
        break;
    case 'v04'            :
        if (!file_exists ("vk/list_rencana_operasi_cito.php"))
            die ("vk/list_rencana_operasi_cito.php File Empty!");
        include 'vk/list_rencana_operasi_cito.php';
        break;
    case 'v05'            :
        if (!file_exists ("vk/operasi/del_kuret.php"))
            die ("vk/operasi/del_kuret.php File Empty!");
        include 'vk/operasi/del_kuret.php';
        break;

    //keuangan
     //keuangan
    case '24k'            :
        if (!file_exists ("keuangan/index.php"))
            die ("keuangan/index.php File Empty!");
        include 'keuangan/index.php';
        break;
    case '24k1'            :
        if (!file_exists ("keuangan/setup/perkiraan.php"))
            die ("keuangan/setup/perkiraan.php File Empty!");
        include 'keuangan/setup/perkiraan.php';
        break;
    case '24k2'            :
        if (!file_exists ("keuangan/setup/realisasi_anggaran.php"))
            die ("keuangan/setup/realisasi_anggaran.php File Empty!");
        include 'keuangan/setup/realisasi_anggaran.php';
        break;		
    case '24k3'            :
        if (!file_exists ("keuangan/setup/arus_kas.php"))
            die ("keuangan/setup/arus_kas.php File Empty!");
        include 'keuangan/setup/arus_kas.php';
        break;			
    case '24k4'            :
        if (!file_exists ("keuangan/setup/tarif.php"))
            die ("keuangan/setup/tarif.php File Empty!");
        include 'keuangan/setup/tarif.php';
        break;			
    case '31k1'            :
        if (!file_exists ("keuangan/entri/perkiraan.php"))
            die ("keuangan/entri/perkiraan.php File Empty!");
        include 'keuangan/entri/perkiraan.php';
        break;
    case '31k2'            :
        if (!file_exists ("keuangan/entri/realisasi_anggaran.php"))
            die ("keuangan/entri/realisasi_anggaran.php File Empty!");
        include 'keuangan/entri/realisasi_anggaran.php';
        break;		
    case '31k3'            :
        if (!file_exists ("keuangan/entri/arus_kas.php"))
            die ("keuangan/entri/arus_kas.php File Empty!");
        include 'keuangan/entri/arus_kas.php';
        break;			
    case '35k1'            :
        if (!file_exists ("keuangan/laporan/perkiraan.php"))
            die ("keuangan/laporan/perkiraan.php File Empty!");
        include 'keuangan/laporan/perkiraan.php';
        break;	
    case '35k2'            :
        if (!file_exists ("keuangan/laporan/realisasi_anggaran.php"))
            die ("keuangan/laporan/realisasi_anggaran.php File Empty!");
        include 'keuangan/laporan/realisasi_anggaran.php';
        break;			
    case '35k3'            :
        if (!file_exists ("keuangan/laporan/arus_kas.php"))
            die ("keuangan/laporan/arus_kas.php File Empty!");
        include 'keuangan/laporan/arus_kas.php';
        break;			
    case '36k1'            :
        if (!file_exists ("keuangan/pendapatan_sirs/pendapatan_unit.php"))
            die ("keuangan/pendapatan_sirs/pendapatan_unit.php File Empty!");
        include 'keuangan/pendapatan_sirs/pendapatan_unit.php';
        break;
    case '36k2'            :
        if (!file_exists ("keuangan/pendapatan_sirs/pendapatan_percarabayar.php"))
            die ("keuangan/pendapatan_sirs/pendapatan_percarabayar.php File Empty!");
        include 'keuangan/pendapatan_sirs/pendapatan_percarabayar.php';
        break;	

//Jaspel
	case 'jas0'            :
        if (!file_exists ("jaspel/jaspel_setting.php"))
            die ("jaspel/jaspel_setting.php File Empty!");
        include 'jaspel/jaspel_setting.php';
        break;
    case 'jas11'            :
        if (!file_exists ("jaspel/jaspel_tarif.php"))
            die ("jaspel/jaspel_tarif.php File Empty!");
        include 'jaspel/jaspel_tarif.php';
        break;
	case 'jas10'            :
        if (!file_exists ("jaspel/jaspel_rekap_all.php"))
            die ("jaspel/jaspel_rekap_all.php File Empty!");
        include 'jaspel/jaspel_rekap_all.php';
        break;
    case 'jas1'            :
        if (!file_exists ("jaspel/jaspel_rj.php"))
            die ("jaspel/jaspel_rj.php File Empty!");
        include 'jaspel/jaspel_rj.php';
        break;
    case 'jas2'            :
        if (!file_exists ("jaspel/jaspel_ok.php"))
            die ("jaspel/jaspel_ok.php File Empty!");
        include 'jaspel/jaspel_ok.php';
        break;
    case 'jas3'            :
        if (!file_exists ("jaspel/jaspel_ugd.php"))
            die ("jaspel/jaspel_ugd.php File Empty!");
        include 'jaspel/jaspel_ugd.php';
        break;
    case 'jas4'            :
        if (!file_exists ("jaspel/jaspel_ranap.php"))
            die ("jaspel/jaspel_ranap.php File Empty!");
        include 'jaspel/jaspel_ranap.php';
        break;
    case 'jas5'            :
        if (!file_exists ("jaspel/jaspel_lab.php"))
            die ("jaspel/jaspel_lab.php File Empty!");
        include 'jaspel/jaspel_lab.php';
        break;
    case 'jas6'            :
        if (!file_exists ("jaspel/jaspel_rad.php"))
            die ("jaspel/jaspel_rad.php File Empty!");
        include 'jaspel/jaspel_rad.php';
        break;
    case 'jas7'            :
        if (!file_exists ("jaspel/jaspel_manajemen.php"))
            die ("jaspel/jaspel_manajemen.php File Empty!");
        include 'jaspel/jaspel_manajemen.php';
        break;
    case 'jas8'            :
        if (!file_exists ("jaspel/jaspel_pendukung.php"))
            die ("jaspel/jaspel_pendukung.php File Empty!");
        include 'jaspel/jaspel_pendukung.php';
        break;
    case 'jas9'            :
        if (!file_exists ("jaspel/jaspel_vk.php"))
            die ("jaspel/jaspel_vk.php File Empty!");
        include 'jaspel/jaspel_vk.php';
        break;
    //jadwal dokter
    case 'jdoc'            :
        if (!file_exists ("jadwaldokter/lihatjadwal.php"))
            die ("jadwaldokter/lihatjadwal.php File Empty!");
        include 'jadwaldokter/lihatjadwal.php';
        break;
    case 'jdoc2'            :
        if (!file_exists ("jadwaldokter/form_addjadwal.php"))
            die ("jadwaldokter/form_addjadwal.php File Empty!");
        include 'jadwaldokter/form_addjadwal.php';
        break;
    case 'jdoc3'            :
        if (!file_exists ("jadwaldokter/hasillihatjadwaldokter.php"))
            die ("jadwaldokter/hasillihatjadwaldokter.php File Empty!");
        include 'jadwaldokter/hasillihatjadwaldokter.php';
        break;
    case 'jdoc4'            :
        if (!file_exists ("jadwaldokter/addjadwal.php"))
            die ("jadwaldokter/addjadwal.php File Empty!");
        include 'jadwaldokter/addjadwal.php';
        break;

    case 'jdoc4'            :
        if (!file_exists ("batal_poly.php"))
            die ("batal_poly.php File Empty!");
        include 'batal_poly.php';
        break;

    case 'batal_r'            :
        if (!file_exists ("rajal/batal_pasien.php"))
            die ("rajal/batal_pasien.php File Empty!");
        include 'rajal/batal_pasien.php';
        break;

    case 'batal_v'            :
        if (!file_exists ("vk/batal_pasien.php"))
            die ("vk/batal_pasien.php File Empty!");
        include 'vk/batal_pasien.php';
        break;

    case 'batal_u'            :
        if (!file_exists ("ugd/batal_pasien.php"))
            die ("ugd/batal_pasien.php File Empty!");
        include 'ugd/batal_pasien.php';
        break;
		
	case 'setting_dokter':
		if (!file_exists ("setting_dokter.php"))
            die ("setting_dokter.php File Empty!");
        include 'setting_dokter.php';
        break;
	case 'adminrajal':
		if (!file_exists ("adminrajal/adminrajal.php"))
            die ("adminrajal/adminrajal.php File Empty!");
        include 'adminrajal/adminrajal.php';
        break;
	case 'adminrajal_aps':
		if (!file_exists ("adminrajal/adminrajal_aps.php"))
            die ("adminrajal/adminrajal_aps.php File Empty!");
        include 'adminrajal/adminrajal_aps.php';
        break;
	case 'adminrajal_daftar_aps':
		if (!file_exists ("adminrajal/daftar_aps.php"))
            die ("adminrajal/daftar_aps.php File Empty!");
        include 'adminrajal/daftar_aps.php';
        break;
	case 'adminrajal_diagnosis':
		if (!file_exists ("adminrajal/adminrajal_diagnosis.php"))
            die ("adminrajal/adminrajal_diagnosis.php File Empty!");
        include 'adminrajal/adminrajal_diagnosis.php';
        break;
	case 'detail_billing':
		if (!file_exists ("detail_billing.php"))
            die ("detail_billing.php File Empty!");
        include 'detail_billing.php';
        break;
	case 'list_pasien_ranap_lab':
		if (!file_exists ("lab/list_pasien_ranap_lab.php"))
            die ("lab/list_pasien_ranap_lab.php File Empty!");
        include 'lab/list_pasien_ranap_lab.php';
        break;
	case 'list_pasien_rajal_lab':
		if (!file_exists ("lab/list_pasien_rajal_lab.php"))
            die ("lab/list_pasien_rajal_lab.php File Empty!");
        include 'lab/list_pasien_rajal_lab.php';
        break;
	case '62formorderlab_ranap':
		if (!file_exists ("lab/formorderlab_ranap.php"))
            die ("lab/formorderlab_ranap.php File Empty!");
        include 'lab/formorderlab_ranap.php';
        break;
	case '62formorderlab_order':
		if (!file_exists ("lab/formorderlab_order.php"))
            die ("lab/formorderlab_order.php File Empty!");
        include 'lab/formorderlab_order.php';
        break;	
	case '62formorderlab_rajal':
		if (!file_exists ("lab/formorderlab_rajal.php"))
            die ("lab/formorderlab_rajal.php File Empty!");
        include 'lab/formorderlab_rajal.php';
        break;
	case 'list_billing_ranap':
		if (!file_exists ("admission/list_billing_ranap.php"))
            die ("admission/list_billing_ranap.php File Empty!");
        include 'admission/list_billing_ranap.php';
        break;
	case 'detail_billing_ranap':
		if (!file_exists ("admission/detail_billing_ranap.php"))
            die ("admission/detail_billing_ranap.php File Empty!");
        include 'admission/detail_billing_ranap.php';
        break;

///////////////////////keperawatan///////////////////
 case 'ind_kep' :
        if (!file_exists("kep/indikator_pelayanan.php"))
            die("indikator_pelayanan.php File Empty!");
        include 'kep/indikator_pelayanan.php';
        break;
		
	 case 'kep_riw_kerja' :
        if (!file_exists("kep/riw_kerja_m_perawat.php"))
            die("riw_kerja_m_perawat.php File Empty!");
        include 'kep/riw_kerja_m_perawat.php';
        break;
	case 'list_kep':
		if (!file_exists ("kep/list_data_perawat.php"))
            die ("list_data_perawat.php File Empty!");
        include 'kep/list_data_perawat.php';
        break;
	case 'kep2'            :
        if (!file_exists ("kep/add_edit_m_perawat.php"))
            die ("add_edit_m_perawat.php File Empty!");
        include 'kep/add_edit_m_perawat.php';
        break;
	case 'kep3':
        if (!file_exists ("kep/mutasi_perawat.php"))
            die ("mutasi_perawat.php File Empty!");
        include 'kep/mutasi_perawat.php';
        break;
	case 'kep4':
        if (!file_exists ("kep/keluar_perawat.php"))
            die ("keluar_perawat.php File Empty!");
        include 'kep/keluar_perawat.php';
        break;
	case 'kep5':
        if (!file_exists ("kep/program_pengembangan.php"))
            die ("program_pengembangan.php File Empty!");
        include 'kep/program_pengembangan.php';
        break;
	case 'sdm_kep':
        if (!file_exists ("kep/sdm_keperawatan.php"))
            die ("sdm_keperawatan.php File Empty!");
        include 'kep/sdm_keperawatan.php';
        break;
	case 'askep__'            :
        if (!file_exists ("kep/list_askep.php"))
            die ("kep/list_askep.php File Empty!");
        include 'kep/list_askep.php';
        break;
	case 'met_gas':
        if (!file_exists ("kep/metode_penugasan.php"))
            die ("metode_penugasan.php File Empty!");
        include 'kep/metode_penugasan.php';
        break;
	case 'supvis':
        if (!file_exists ("kep/supervisi.php"))
            die ("supervisi.php File Empty!");
        include 'kep/supervisi.php';
        break;
	case 'lap_ranap_kep':
        if (!file_exists ("kep/lap_rawat_inap.php"))
            die ("lap_rawat_inap.php File Empty!");
        include 'kep/lap_rawat_inap.php';
        break;
	case 'pengkajian_kep'            :
        if (!file_exists ("kep/kajian_kep.php"))
            die ("kajian_keperawatan.php File Empty!");
        include 'kep/kajian_kep.php';
        break;
	case 'diagnosa_kep'            :
        if (!file_exists ("kep/diagnosa_kep.php"))
            die ("diagnosa_keperawatan.php File Empty!");
        include 'kep/diagnosa_kep.php';
        break;
	case 'det_diagnosa_kep'            :
        if (!file_exists ("kep/diagnosa_kep_detail.php"))
            die ("det_diagnosa_keperawatan.php File Empty!");
        include 'kep/diagnosa_kep_detail.php';
        break;
	case 'nic_list'            :
        if (!file_exists ("kep/list_nic.php"))
            die ("nic_list.php File Empty!");
        include 'kep/list_nic.php';
        break;
	
	#### NEW ###
	case 'createCaseMix':
		if (!file_exists ("adm/eksekutif/slide/casemix.php"))
            die ("adm/eksekutif/slide/casemix.php File Empty!");
        include 'adm/eksekutif/slide/casemix.php';
        break;
	
	case 'pendapatan_cash'            :
        if (!file_exists ("keuangan/setup/pend_cash.php"))
            die ("keuangan/setup/pend_cash.php File Empty!");
        include 'keuangan/setup/pend_cash.php';
        break;
	case 'pendapatan_piutang'            :
        if (!file_exists ("keuangan/setup/pend_piutang.php"))
            die ("keuangan/setup/pend_piutang.php File Empty!");
        include 'keuangan/setup/pend_piutang.php';
        break;
	case 'general_ledger'            :
        if (!file_exists ("keuangan/entri/general_ledger.php"))
            die ("keuangan/entri/general_ledger.php File Empty!");
        include 'keuangan/entri/general_ledger.php';
        break;
	case 'laporan_hutang'            :
        if (!file_exists ("keuangan/entri/laporan_hutang.php"))
            die ("keuangan/entri/laporan_hutang.php File Empty!");
        include 'keuangan/entri/laporan_hutang.php';
        break;
	case 'telepon'            :
        if (!file_exists ("daftar_.php"))
            die ("daftar.php File Empty!");
        include 'daftar_.php';
        break;
	case 'praktek_dokter'            :
        if (!file_exists ("praktek_dokter.php"))
            die ("praktek_dokter.php File Empty!");
        include 'praktek_dokter.php';
        break;
		
		//////////////////////RL AWAL/////////////////////
	case 'rl1'            :
        if (!file_exists ("rm/rl1.php"))
            die ("rm/rl1.php File Empty!");
        include 'rm/rl1.php';
        break;
	case 'rl2'            :
        if (!file_exists ("rm/rl2.php"))
            die ("rm/rl2.php File Empty!");
        include 'rm/rl2.php';
        break;
	case 'rl311'         :
        if (!file_exists ("rm/rl311.php"))
            die ("rm/rl311.php File Empty!");
        include 'rm/rl311.php';
        break;
	case 'rl321'         :
        if (!file_exists ("rm/rl321.php"))
            die ("rm/rl321.php File Empty!");
        include 'rm/rl321.php';
        break;
	case 'rl322'         :
        if (!file_exists ("rm/rl322.php"))
            die ("rm/rl322.php File Empty!");
        include 'rm/rl322.php';
        break;
	case 'rl323'         :
        if (!file_exists ("rm/rl323.php"))
            die ("rm/rl323.php File Empty!");
        include 'rm/rl323.php';
        break;
	case 'rl324'         :
        if (!file_exists ("rm/rl324.php"))
            die ("rm/rl324.php File Empty!");
        include 'rm/rl324.php';
        break;
	case 'rl331'         :
        if (!file_exists ("rm/rl331.php"))
            die ("rm/rl331.php File Empty!");
        include 'rm/rl331.php';
        break;
	case 'rl332'         :
        if (!file_exists ("rm/rl332.php"))
            die ("rm/rl332.php File Empty!");
        include 'rm/rl332.php';
        break;
	case 'rl341'         :
        if (!file_exists ("rm/rl341.php"))
            die ("rm/rl341.php File Empty!");
        include 'rm/rl341.php';
        break;
	case 'rl342'         :
        if (!file_exists ("rm/rl342.php"))
            die ("rm/rl342.php File Empty!");
        include 'rm/rl342.php';
        break;
	case 'rl351'         :
        if (!file_exists ("rm/rl351.php"))
            die ("rm/rl351.php File Empty!");
        include 'rm/rl351.php';
        break;
	case 'rl36'         :
        if (!file_exists ("rm/rl36.php"))
            die ("rm/rl36.php File Empty!");
        include 'rm/rl36.php';
        break;
	case 'rl37'         :
        if (!file_exists ("rm/rl37.php"))
            die ("rm/rl37.php File Empty!");
        include 'rm/rl37.php';
        break;
	case 'rl38'         :
        if (!file_exists ("rm/rl38.php"))
            die ("rm/rl38.php File Empty!");
        include 'rm/rl38.php';
        break;
	case 'rl39'         :
        if (!file_exists ("rm/rl39.php"))
            die ("rm/rl39.php File Empty!");
        include 'rm/rl39.php';
        break;
	case 'rl310'         :
        if (!file_exists ("rm/rl310.php"))
            die ("rm/rl310.php File Empty!");
        include 'rm/rl310.php';
        break;
	case 'rl41'            :
        if (!file_exists ("rm/rl41.php"))
            die ("rm/rl41.php File Empty!");
        include 'rm/rl41.php';
        break;
    case 'rl42'            :
        if (!file_exists ("rm/rl42.php"))
            die ("rm/rl42.php File Empty!");
        include 'rm/rl42.php';
        break;
	case 'rl43'            :
        if (!file_exists ("rm/rl43.php"))
            die ("rm/rl43.php File Empty!");
        include 'rm/rl43.php';
        break;
	
  //////////////////////RL AKHIR/////////////////////
		
	///////////////////////////////////////////////////////////ADD PANTRI //////////////////////////////////////
	case 'page_pantri'            :
        if (!file_exists ("pantri/list_data_pantri.php"))
            die ("pantri/list_data_pantri.php File Empty!");
        include 'pantri/list_data_pantri.php';
        break;
	case 'data_makanan'            :
        if (!file_exists ("pantri/list_data_makanan.php"))
            die ("pantri/list_data_makanan.php File Empty!");
        include 'pantri/list_data_makanan.php';
        break;
	case 'add_pantri'            :
        if (!file_exists ("pantri/form_input_pantri.php"))
            die ("pantri/form_input_pantri.php File Empty!");
        include 'pantri/form_input_pantri.php';
        break;
	case 'add_rencana_makanan'            :
        if (!file_exists ("pantri/form_input_bahan.php"))
            die ("pantri/form_input_bahan.php File Empty!");
        include 'pantri/form_input_bahan.php';
        break;
	case 'list_jenis_makanan'            :
        if (!file_exists ("pantri/list_jenis_makanan.php"))
            die ("pantri/list_jenis_makanan.php File Empty!");
        include 'pantri/list_jenis_makanan.php';
        break;
	case 'add_jenis_makanan'            :
        if (!file_exists ("pantri/form_input_jenis.php"))
            die ("pantri/form_input_jenis.php File Empty!");
        include 'pantri/form_input_jenis.php';
        break;
	case 'rekap_jenis_makanan'            :
        if (!file_exists ("pantri/rekap_jenis_makanan.php"))
            die ("pantri/rekap_jenis_makanan.php File Empty!");
        include 'pantri/rekap_jenis_makanan.php';
        break;
	//////////////////////////AKHIR PANTRI///////////////////////////////////////////////////////
}


?>
