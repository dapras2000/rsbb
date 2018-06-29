<?php
session_start();
$farmasi ="x";
if($_SESSION['KDUNIT']=="12") {
    $farmasi ="1";
}else if($_SESSION['KDUNIT']=="13") {
    $farmasi ="0";
}

include("../include/connect.php");
include("../include/function.php");

$ip = getRealIpAddr();
if(empty($_GET['optbarang'])) {
	
	if(empty($_POST['nmsuplier']) || empty($_POST['jns']) || empty($_POST['tglterima']) || empty($_POST['nm_barang']) || empty($_POST['kd_barang']) || empty($_POST['jml_barang'])) 
	{
        echo "<fieldset class='fieldset'>";
        echo "<legend>Error</legend>";
        echo "Isian Belum Lengkap";
        echo "</fieldset>";
    }
	else
	{
        $no = $_POST['no_batch'];
        $suplier = $_POST['nmsuplier'];
        $jns = $_POST['jns'];
        $tgl_terima = $_POST['tglterima'];
        $kd_barang = $_POST['kd_barang'];
        $jml_terima = $_POST['jml_barang'];
        $tgl_expire = $_POST['tgl_kadaluarsa'];
        $grp =  $_POST['grpbarang'];
        $nip = $_SESSION['NIP'];
        $kdunit = $_SESSION['KDUNIT'];
        $ket = $_POST['ket'];
        @mysql_query("INSERT INTO temp_cartbarang_penerimaan (kodebarang, no_batch, expire_date, pengirim, terimadari, tglterima, jmlterima, NIP, KDUNIT, IP, KET)
					VALUES ('$kd_barang', '$no', '$tgl_expire', '$suplier', '$jns', '$tgl_terima', '$jml_terima', '$nip', '$kdunit', '$ip', '$ket')");
    }
}else{
    $idxbarang = $_GET['optbarang'];
    @mysql_query("DELETE FROM temp_cartbarang_penerimaan WHERE IDXBARANG = $idxbarang");
}
$sql = "SELECT  
				 temp_cartbarang_penerimaan.IDXBARANG, 
				 m_barang_group.nama_group,
				  m_barang.nama_barang,
				  m_barang.farmasi,
				  m_barang.satuan,
				  temp_cartbarang_penerimaan.terimadari,
				  temp_cartbarang_penerimaan.pengirim,
				  temp_cartbarang_penerimaan.kodebarang,
				  temp_cartbarang_penerimaan.no_batch,
			      DATE_FORMAT(temp_cartbarang_penerimaan.expire_date, '%d -%m -%Y') as expire_date,
				  temp_cartbarang_penerimaan.jmlterima,
				  DATE_FORMAT(temp_cartbarang_penerimaan.tglterima, '%d -%m -%Y') as tglterima,
				  temp_cartbarang_penerimaan.IP, temp_cartbarang_penerimaan.KET 
				FROM
				  m_barang
				  INNER JOIN m_barang_group ON (m_barang.group_barang = m_barang_group.group_barang) AND (m_barang.farmasi = m_barang_group.farmasi)
				  INNER JOIN temp_cartbarang_penerimaan ON (m_barang.kode_barang = temp_cartbarang_penerimaan.kodebarang)
			WHERE temp_cartbarang_penerimaan.IP = '$ip' AND  m_barang.farmasi = '".$farmasi."'";
$row = mysql_query($sql)or die(mysql_error());
if(mysql_num_rows($row) > 0) {
    ?>
<fieldset class="fieldset">
    <table class="tb" border="0" cellpadding="1" cellspacing="1">
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Group</th>
            <th>Expire</th>
            <th>No Batch</th>
            <th>Keterangan</th>
            <th>Pilihan</th>
        </tr>
            <?php
            $i = 1;
            while($data = mysql_fetch_array($row)) {
                ?>
        <tr>
            <td><?=$i?></td>
            <td><?=$data['kodebarang']?></td>
            <td><?=$data['nama_barang']?></td>
            <td align="right"><?=$data['jmlterima']?></td>
            <td><?=$data['satuan']?></td>
            <td><?=$data['nama_group']?></td>
            <td><?=$data['expire_date']?></td>
            <td><?=$data['no_batch']?></td>
            <td><?=$data['KET']?></td>
            <td><a href="#" onclick="javascript: MyAjaxRequest('validbarang','gudang/addbarangpenerimaan.php?optbarang=<?=$data['IDXBARANG']?>'); return false;" >Hapus</a></td>
        </tr>
                <?php } ?>
    </table>
    <form name="savebarang" id="savebarang" action="gudang/saveorderbarangpenerimaan.php" method="post" >
        <input class="text" type="submit" value="S i m p a n" onclick="submitform (document.getElementById('savebarang'),'gudang/saveorderbarangpenerimaan.php','validbarang',validatetask); return false;"/>
    </form>
</fieldset>   
    <? } ?>
