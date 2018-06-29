<?php
include("../include/connect.php");
include("../rajal/inc/function.php");

$ip = getRealIpAddr();
$sql = "SELECT temp_cartbarang_pengadaan.IDXBARANG AS IDX,
		  m_barang_group.nama_group,
		  m_barang_group.nama_farmasi,
		  m_barang.kode_barang,
		  m_barang.nama_barang,
		  m_barang.satuan,
		  temp_cartbarang_pengadaan.QTY,
		  temp_cartbarang_pengadaan.IP,
		  temp_cartbarang_pengadaan.NIP,
		  temp_cartbarang_pengadaan.KDUNIT,
		  temp_cartbarang_pengadaan.tahun,
		  temp_cartbarang_pengadaan.IDXBARANG
		FROM
		  m_barang
		  INNER JOIN m_barang_group ON (m_barang.group_barang = m_barang_group.group_barang)
		  AND (m_barang.farmasi = m_barang_group.farmasi)
		  INNER JOIN temp_cartbarang_pengadaan ON (m_barang.kode_barang = temp_cartbarang_pengadaan.KDBARANG)
		WHERE temp_cartbarang_pengadaan.IP = '$ip'";

if(empty($_GET['optbarang'])) {
    if(empty($_POST['r_barang']) || empty($_POST['tahun']) 
            || empty($_POST['nm_barang']) || empty($_POST['kd_barang']) || empty($_POST['grpbarang'])
            || empty($_POST['jml_permintaan'])) {

        echo "<fieldset class='fieldset'>";
        echo "<legend>Error</legend>";
        echo "Isian Belum Lengkap";
        echo "</fieldset>";

    }else {

        $periode = $_POST['tahun'];
        $kd_barang = $_POST['kd_barang'];
        $jml_permintaan = $_POST['jml_permintaan'];
        $nip = $_POST['NIP'];
        $kdunit = $_POST['KDUNIT'];
        $tgl_pesan =date("Y-m-d");
		
        @mysql_query("INSERT INTO temp_cartbarang_pengadaan (IDXBARANG,KDBARANG, QTY, tahun, tglpesan,
						  NIP, KDUNIT, IP)  
					VALUES ('$idxbarang','$kd_barang', '$jml_permintaan', '$periode', '$tgl_pesan', '$nip', '$kdunit', '$ip')");
    }
}else {
    $idxbarang = $_GET['optbarang'];
    @mysql_query("DELETE FROM temp_cartbarang_pengadaan WHERE IDXBARANG = $idxbarang");
}
$row = mysql_query($sql)or die(mysql_error());
if(mysql_num_rows($row) > 0) {
    ?>
<fieldset class="fieldset">
    <legend>Daftar Penerimaan</legend>
    <table class="tb">
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Tujuan</th>
            <th>Group Barang</th>
            <th>Pilihan</th>
        </tr>
            <?php
            $i = 1;
            while($data = mysql_fetch_array($row)) {
                ?>
        <tr>
            <td><?=$i?></td>
            <td><?=$data['kode_barang']?></td>
            <td><?=$data['nama_barang']?></td>
            <td align="right"><?=$data['QTY']?></td>
            <td><?=$data['satuan']?></td>
            <td><?=$data['nama_farmasi']?></td>
            <td><?=$data['nama_group']?></td>
            <td><a href="#" onclick="javascript: MyAjaxRequest('validbarang','orderbarang/addbarangpengadaan.php?optbarang=<?=$data['IDX']?>'); return false;" >Hapus</a></td>
        </tr>
                <?php } ?>
    </table>
    <form name="savebarang" id="savebarang" action="orderbarang/savepengadaanbarang.php" method="post" >
        <table>
            <tr>
                <td>NIP</td>
                <td><input type="text" name="u_name" /></td>
            <tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="u_pass" /></td>
            <tr>
            <tr>
                <td colspan="2" ><input class="text" type="submit" value="S i m p a n" onclick="submitform (document.getElementById('savebarang'),'orderbarang/savepengadaanbarang.php','validbarang',validatetask); return false;"/></td>
            </tr>
        </table>
    </form>
</fieldset>   
    <? } ?>
