<?php
session_start();
include("../include/connect.php");
include("inc/function.php");
$nip = $_SESSION['NIP'];
$kdunit = $_SESSION['KDUNIT'];

if(!empty($_GET['idxracik'])){
    $idxracik = $_GET['idxracik'];
    if($_GET['opt']=="5"){
       @mysql_query("UPDATE  t_permintaan_apotek_rajal_racikan SET status_acc = '2',
                    nip_keluar = '".$nip."',
                    jmlh_keluar = NULL,
                    tgl_keluar = NULL
                    WHERE idxracik = '$idxracik'")or die(mysql_error());
       echo "<font color=orange>Tidak disetujui</font>";
    }else if($_GET['opt']=="4"){
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
                @mysql_query("UPDATE  t_permintaan_apotek_rajal_racikan SET status_acc = '1',
                        jmlh_keluar = $jml,
                        tgl_keluar = '$tgl',
                        nip_keluar = '".$nip."'
                        WHERE idxracik = '$idxracik'")or die(mysql_error());
                echo "<font color=green>Sudah disetujui</font>";
            }
    }
}


$sqlbarangitem_racik_cih = "SELECT status_acc FROM
                                t_permintaan_apotek_rajal_racikan
                            WHERE
                                idxpesanobat='$_GET[idxpesanobat]' AND
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


        $sqlbarangitem_racik = "SELECT a.idxpesanobat, a.kode_obat, a.jmlh_keluar, a.tgl_keluar, a.koderacik,  a.idxdaftar, a.harga_obat, 
                      m_barang.satuan, a.no, a.idxracik
                FROM
                  t_permintaan_apotek_rajal_racikan as a
                LEFT JOIN m_barang ON a.kode_obat=m_barang.kode_barang
                WHERE a.no = '".$_REQUEST['no']."'
                AND a.status_save='0' 
                AND a.jmlh_keluar>'0' ";
        $tgl2 = date("Y-m-d");
        $x = 1;
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
            $total                  = $databarangitem_racik['harga_obat'] * $databarangitem_racik['jmlh_keluar'];
                        
            


            if($qty_obat_racik !=""){
                @mysql_query("UPDATE t_permintaan_apotek_rajal_racikan SET status_save = '1',
                        jmlh_keluar = $qty_obat_racik
                        WHERE idxracik = '$idxracik' AND status_acc='1' ")or die(mysql_error());
            }


        mysql_query("INSERT INTO t_billobat_racikan (idxdaftar, kode_obat, qty, tanggal, harga, nobill, kode_racikan, noresep) 
                     VALUES ('$idxdaftar_racik','$kode_obat_racik','$qty_obat_racik','$tgl2','$harga_racik','$maxnobyr','$koderacik_racik','$noresep')")or die(mysql_error());

        mysql_query("INSERT INTO tmp_total_bayar_racik (kode_obat, total) 
                     VALUES ('$koderacik_racik','$total')")or die(mysql_error());

        

        $x++;
        }

?>

<script language="javascript" type="text/javascript" >
    alert("Proses obat racikan berhasil.");
    window.location="../index.php?link=10proses&no=<?=$_GET['no']?>";
</script>

<?php } ?>