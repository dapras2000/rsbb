<?php
session_start();
include("../include/connect.php");
include("inc/function.php");
$nip = $_SESSION['NIP'];
$kdunit = $_SESSION['KDUNIT'];

$cek_status = mysql_query("SELECT koderacik,status_save FROM t_permintaan_apotek_rajal_racikan
                           WHERE idxpesanobat= '$_GET[idxpesanobat]' ");
$get_status = mysql_fetch_assoc($cek_status);
$status_racikan = $get_status['status_save'];

if(substr($_GET['cih'],0,1) == "R" AND $status_racikan==0){
    echo "<font color=red>Proses dulu racikan</font>";
}else{
//if(!empty($_GET['idxpesanobat'])){
    $idxpesanobat = $_GET['idxpesanobat'];
    if($_GET['opt']=="2"){
       @mysql_query("UPDATE t_permintaan_apotek_rajal SET status_acc = '2',
                    nip_keluar = '".$nip."',
                    jmlh_keluar = NULL,
                    tgl_keluar = NULL
                    WHERE idxpesanobat = '$idxpesanobat'")or die(mysql_error());
       echo "<font color=orange>Tidak disetujui</font>";
    }else if($_GET['opt']=="1"){
       if(!empty($_GET['jml'])){
            $jml = $_GET['jml'];
            $jml_pesan = $_GET['jml_pesan'];
        }else{
            $jml='';
        }
       
       $tgl = date("Y-m-d");
            if($jml==''){
                echo "<font color=red>Tidak boleh kosong</font>";
            }elseif($jml > $jml_pesan){
                echo "<font color=red>Tidak boleh lebih dari ".$jml_pesan."</font>";
            }else{
               @mysql_query("UPDATE t_permintaan_apotek_rajal SET status_acc = '1',
                            jmlh_keluar = $jml,
                            tgl_keluar = '$tgl',
                            nip_keluar = '".$nip."'
                            WHERE idxpesanobat = '$idxpesanobat'")or die(mysql_error());       
                echo "<font color=green>Sudah disetujui</font>";;
            }
    }
//}


$sqlbarangitem_racik_cih = "SELECT status_acc FROM
                                t_permintaan_apotek_rajal
                            WHERE
                                no='$_GET[no]' AND
                                status_acc = '0'
                            ";
$getbarangitem_racik_cih = mysql_query ($sqlbarangitem_racik_cih)or die(mysql_error());
$databarangitem_racik_cih = mysql_num_rows($getbarangitem_racik_cih);
if($databarangitem_racik_cih>0){
?>


<script language="javascript" type="text/javascript" >
    alert("Beri tindakan pada permintaan obat.");
    window.location="../index.php?link=10proses&no=<?php echo $_GET[no] ?>";
</script>


<?php
}else{



$qrynobil=mysql_query("SELECT * FROM m_maxnobyr");
            $get_data = mysql_fetch_assoc($qrynobil);
            $maxnobyr = $get_data['nomor'];
        $qrynoresep = mysql_query('SELECT CONCAT(tahun,LPAD(bulan,2,"0"),LPAD(nomor,5,"0")) as nomorrr FROM m_maxnorsp WHERE tahun = YEAR(CURDATE()) AND bulan = MONTH(CURDATE())');
            $get_dataresep = mysql_fetch_assoc($qrynoresep);
            $noresep = $get_dataresep['nomorrr'];


              $sqlbarangitem = "SELECT DISTINCT a.idxpesanobat, a.kode_obat, a.jmlh_keluar, a.tgl_keluar, a.kdpoli, a.nip, a.idxdaftar, a.harga_obat, 
                  a.kddokter, a.aturan_pakai, a.lapkemenkes, a.laplain, a.aps, a.norm, m_barang.satuan, c.SHIFT, c.KDCARABAYAR, a.no
                FROM
                  t_permintaan_apotek_rajal as a
                LEFT JOIN m_barang ON a.kode_obat=m_barang.kode_barang
                LEFT JOIN t_pendaftaran c On a.norm=c.NOMR
                WHERE a.no = '".$_REQUEST['no']."'
                AND a.status_save='0'";
       
        $getbarangitem = mysql_query ($sqlbarangitem)or die(mysql_error());
        $tgl2 = date("Y-m-d");
        $x = 1;
        $qrynobil=mysql_query("SELECT * FROM m_maxnobyr");
            $get_data = mysql_fetch_assoc($qrynobil);
            $maxnobyr = $get_data['nomor'];
        $qrynoresep = mysql_query('SELECT CONCAT(tahun,LPAD(bulan,2,"0"),LPAD(nomor,5,"0")) as nomorrr FROM m_maxnorsp WHERE tahun = YEAR(CURDATE()) AND bulan = MONTH(CURDATE())');
            $get_dataresep = mysql_fetch_assoc($qrynoresep);
            $noresep = $get_dataresep['nomorrr'];
        


        while ($databarangitem = mysql_fetch_array($getbarangitem)){
            $qty_obat       = $databarangitem['jmlh_keluar'];
            $tgl_obat       = $databarangitem['tgl_keluar'];
            $kode_obat      = $databarangitem['kode_obat'];
            $idxpesanobat   = $databarangitem['idxpesanobat'];
            $unit_tujuan    = $databarangitem['kdpoli'];
            $nip_tujuan     = $databarangitem['nip'];
            $idxdaftar      = $databarangitem['idxdaftar'];
            $harga          = $databarangitem['harga_obat'];
            $dokter         = $databarangitem['kddokter'];
            $aturan_pakai   = $databarangitem['aturan_pakai'];
            $lapkemenkes    = $databarangitem['lapkemenkes'];
            $laplain        = $databarangitem['laplain'];
            $aps            = $databarangitem['aps'];
            $satuan         = $databarangitem['satuan'];
            $norm           = $databarangitem['norm'];
            $shift          = $databarangitem['SHIFT'];
            $carabayar      = $databarangitem['KDCARABAYAR'];
            
            
            

            
            if($qty_obat !=""){
                //Keur ngitung t_barang_stok
                $sqlsaldo = "SELECT saldo FROM t_barang_stok  
                    WHERE kode_barang = '$kode_obat'  AND KDUNIT = ".$kdunit."
                    ORDER BY  kd_stok DESC LIMIT 1";
                
                $get = mysql_query ($sqlsaldo)or die(mysql_error());
                $saldodata = mysql_fetch_assoc($get);
                if(mysql_num_rows($get) > 0){
                            $saldo = $saldodata['saldo'] - $qty_obat;
                        }else{
                            $saldo = 0 - $qty_obat;
                }
                
                @mysql_query("UPDATE t_permintaan_apotek_rajal SET status_save = '1',
                        jmlh_keluar = $qty_obat
                        WHERE idxpesanobat = '$idxpesanobat' AND status_acc='1' ")or die(mysql_error());
                
                if (substr($kode_obat,0,1) != "R"){
                        mysql_query("INSERT INTO t_barang_stok (kode_barang, tanggal, keluar, saldo, KDUNIT) 
                        VALUES ('$kode_obat', '$tgl_obat', '$qty_obat', '$saldo', '".$kdunit."')")or die(mysql_error());

                        mysql_query("INSERT INTO t_pengeluaran_barang (NIP, KDUNIT, kodebarang, tglkeluar, jmlkeluar, UNIT_TUJUAN) 
                        VALUES ('$nip', '$kdunit', '$kode_obat', '$tgl_obat', '$qty_obat', '$unit_tujuan')")or die(mysql_error());
                }

                mysql_query("INSERT INTO t_billobat_rajal (idxdaftar, kode_obat, qty, tanggal, harga, nobill, noresep, status, 
                            dokter, aturan_pakai, sediaan, lapkemenkes, laplain, aps) 
                            VALUES ('$idxdaftar','$kode_obat','$qty_obat','$tgl2','$harga','$maxnobyr','$noresep','Keluar',
                                '$dokter','$aturan_pakai','$satuan','$lapkemenkes','$laplain','$aps')")or die(mysql_error());
            }


        $x++;
        }




        //UNTUK MENAMBAH JML PESAN DI RAJAL KE RACIK
        $a = mysql_query("SELECT a.jmlh_keluar, a.idxpesanobat FROM t_permintaan_apotek_rajal a
                 LEFT JOIN t_permintaan_apotek_rajal_racikan b ON a.kode_obat=b.koderacik where a.no = '".$_GET['no']."' and a.kode_obat=b.koderacik");
            while($b = mysql_fetch_assoc($a)){
                $c = $b['jmlh_keluar'];
                $h = $b['idxpesanobat'];

                @mysql_query("UPDATE t_permintaan_apotek_rajal_racikan SET jmlh_keluar_rajal = '$c' 
                        WHERE idxpesanobat = '$h' ")or die(mysql_error());
        }


        $sqlbarangitem_racik = "SELECT a.idxpesanobat, a.jmlh_keluar_rajal, a.kode_obat, a.jmlh_keluar, a.tgl_keluar, a.koderacik,  a.idxdaftar, a.harga_obat, 
                      m_barang.satuan, a.no, a.idxracik
                FROM
                  t_permintaan_apotek_rajal_racikan as a
                LEFT JOIN m_barang ON a.kode_obat=m_barang.kode_barang
                WHERE a.no = '".$_GET['no']."'
                AND a.status_save!='0'";
       
        $getbarangitem_racik = mysql_query ($sqlbarangitem_racik)or die(mysql_error());
        


        while ($databarangitem_racik = mysql_fetch_array($getbarangitem_racik)){
  
            $idxracik               = $databarangitem_racik['idxracik'];
            $kode_obat_racik        = $databarangitem_racik['kode_obat'];
            $harga_racik            = $databarangitem_racik['harga_obat'];
            $qty_obat_racik         = $databarangitem_racik['jmlh_keluar'];
            $idxdaftar_racik        = $databarangitem_racik['idxdaftar'];
            $idxpesanobat_racik     = $databarangitem_racik['idxpesanobat'];
            $koderacik_racik        = $databarangitem_racik['koderacik'];
            $tgl_obat_racik         = $databarangitem_racik['tgl_keluar'];
            $jmlh_keluar_rajal      = $databarangitem_racik['jmlh_keluar_rajal'];

            if($qty_obat_racik !=""){

            $sqlsaldo_racik = "SELECT  saldo FROM t_barang_stok  
                    WHERE kode_barang = '$kode_obat_racik'  AND KDUNIT = ".$kdunit."
                    ORDER BY  kd_stok DESC LIMIT 1";

                $get_racik = mysql_query ($sqlsaldo_racik)or die(mysql_error());
                $saldodata_racik = mysql_fetch_assoc($get_racik);

                $qty_racik2 = $qty_obat_racik * 1;


                        if(mysql_num_rows($get_racik) > 0){
                            $saldo_racik = $saldodata_racik['saldo'] - $qty_racik2 ;
                        }else{
                            $saldo_racik = 0 - $qty_racik2 ;
                        }

                @mysql_query("INSERT INTO t_barang_stok (kode_barang, tanggal, keluar, saldo, KDUNIT) 
                            VALUES ('$kode_obat_racik', '$tgl_obat_racik', '$qty_racik2', '$saldo_racik', '".$kdunit."')")or die(mysql_error());



                mysql_query("INSERT INTO t_pengeluaran_barang (NIP, KDUNIT, kodebarang, tglkeluar, jmlkeluar, UNIT_TUJUAN) 
                            VALUES ('".$nip."', '".$kdunit."', '$kode_obat_racik', '$tgl_obat_racik', '$qty_racik2', '$unit_tujuan')")or die(mysql_error());

            }

        $x++;
        }

        $sqltarif2 = mysql_query("SELECT SUM(harga*qty) as harga 
                                            FROM t_billobat_racikan 
                                            WHERE idxdaftar = '".$idxdaftar_racik."' and nobill = '".$maxnobyr."'  group by kode_racikan ");
            $rag2 = mysql_fetch_array($sqltarif2);
            $harhar2 = $rag2['harga'];

        //UPDET HARGA TOTAL DI TABLE t_billobat_rajal
        $sqlbarangitem_racik2 = "SELECT kode_obat,qty FROM t_billobat_rajal WHERE kode_obat LIKE  'R%' ";      
        $getbarangitem_racik2 = mysql_query ($sqlbarangitem_racik2)or die(mysql_error());
        while ($data_update_harga = mysql_fetch_array($getbarangitem_racik2)){
            $sqlbarangitem_racik3 = "SELECT SUM(total) AS total, kode_obat FROM tmp_total_bayar_racik WHERE kode_obat='$data_update_harga[kode_obat]' ";      
            $getbarangitem_racik3 = mysql_query ($sqlbarangitem_racik3)or die(mysql_error());
            while ($data_update_harga2 = mysql_fetch_array($getbarangitem_racik3)){
				$hartotbill = $data_update_harga2['total'] / $data_update_harga['qty'];
                @mysql_fetch_array(mysql_query("UPDATE t_billobat_rajal SET harga = '$hartotbill' WHERE kode_obat='$data_update_harga[kode_obat]' and idxdaftar = '".$idxdaftar."' and nobill = '".$maxnobyr."'"));
            }
        }

        if($_GET['opt']=="3"){mysql_query("TRUNCATE tmp_total_bayar_racik");}


                $sqltarif = mysql_query("SELECT SUM(harga*qty) as harga FROM t_billobat_rajal 
                            where idxdaftar = '".$idxdaftar."' and nobill = '".$maxnobyr."'");
                    $rag = mysql_fetch_assoc($sqltarif);
                    $harhar = $rag['harga'];

                mysql_query("INSERT INTO t_billrajal (KODETARIF, NOMR, KDPOLY, TANGGAL, SHIFT, NIP, IDXDAFTAR, NOBILL, KDDOKTER, 
                            KETERANGAN, STATUS, CARABAYAR, APS, UNIT, QTY, TARIFRS) 
                        VALUES ('07','$norm','$unit_tujuan','$tgl2','$shift','$nip','$idxdaftar','$maxnobyr','$dokter',
                            '','SELESAI','$carabayar','$aps','$kdunit','1','$harhar')")or die(mysql_error());
                
                if ($carabayar > 1){
                    mysql_query("INSERT INTO t_bayarrajal (NOMR,SHIFT,NIP,IDXDAFTAR,NOBILL,TOTTARIFRS,CARABAYAR,
                            APS,TGLBAYAR,JAMBAYAR,JMBAYAR,TBP,LUNAS,STATUS,UNIT) 
                        VALUES ('$norm','$shift','$nip','$idxdaftar','$maxnobyr','$harhar','$carabayar',
                            '$aps','CURDATE()','CURTIME()','$harhar','0','1','LUNAS','$kdunit')")or die(mysql_error()); 
                }else{
                    mysql_query("INSERT INTO t_bayarrajal (NOMR,SHIFT,NIP,IDXDAFTAR,NOBILL,TOTTARIFRS,CARABAYAR,
                            APS,STATUS,UNIT) 
                        VALUES ('$norm','$shift','$nip','$idxdaftar','$maxnobyr','$harhar','$carabayar',
                            '$aps','TRX','$kdunit')")or die(mysql_error());     
                }
                
                
        mysql_query("UPDATE m_maxnobyr SET nomor=nomor+1")or die(mysql_error());
        mysql_query("UPDATE m_maxnorsp SET nomor=nomor+1 WHERE tahun = YEAR(CURDATE()) AND bulan = MONTH(CURDATE())")or die(mysql_error());
        mysql_query("DELETE FROM t_pengeluaran_barang WHERE kodebarang='0'")or die(mysql_error());
        mysql_query("DELETE FROM t_barang_stok WHERE kode_barang='0'")or die(mysql_error());




?>

<script language="javascript" type="text/javascript" >
    alert("Simpan Data Permintaan Berhasil.");
    window.location="../index.php?link=10permintaan";
</script>

<?php

if(!empty($_GET['cekbarang'])){
    $kdbarang = $_GET['cekbarang'];
    $sqlcek = "select hide_when_print from m_barang 
              where kode_barang = ".$kdbarang;
    $getcek = mysql_query ($sqlcek)or die(mysql_error());
    $cek = mysql_fetch_assoc($getcek);
    if(mysql_num_rows($getcek) > 0){
        $cekdata = $cek['hide_when_print'];
    }
    
    if($cekdata == "1"){
        @mysql_query("UPDATE m_barang SET hide_when_print = '0'
                    WHERE kode_barang =".$kdbarang)or die(mysql_error());   
?>
   <input type="checkbox" name="<?=$kdbarang?>" value="1" onclick="javascript: MyAjaxRequest('cek<?=$kdbarang?>','gudang/saveorderbarangpengeluaran.php?cekbarang=<?=$kdbarang?>'); return false;" />
<?      
    }else{
        @mysql_query("UPDATE m_barang SET hide_when_print = '1'
                    WHERE kode_barang =".$kdbarang)or die(mysql_error());   
?>
   <input type="checkbox" name="<?=$kdbarang?>" value="1" checked=checked onclick="javascript: MyAjaxRequest('cek<?=$kdbarang?>','gudang/saveorderbarangpengeluaran.php?cekbarang=<?=$kdbarang?>'); return false;" />   
<?      
    }
       
}


}


}
?>