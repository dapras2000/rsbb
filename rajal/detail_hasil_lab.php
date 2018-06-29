<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>HASIL ORDER LAB</h3></div>
<?php 
include("../include/connect.php");

$idx_daftar = $_GET["nomr"];
$sql = "SELECT t_orderlab.IDXORDERLAB, t_orderlab.KODE, t_orderlab.QTY, t_orderlab.IDXDAFTAR,
  		t_orderlab.NOMR, t_orderlab.TANGGAL, t_orderlab.DRPENGIRIM,  m_lab.nama_jasa,
		m_lab.nilai_normal, t_orderlab.HASIL_PERIKSA, t_orderlab.KETERANGAN 
		FROM t_orderlab 
		INNER JOIN m_lab ON (t_orderlab.KODE = m_lab.kode_jasa)
		WHERE t_orderlab.NOMR = '".$_SESSION['nomrx123']."'";
$row = mysql_query($sql);		
?>
   
<fieldset class="fieldset">
      <legend>Hasil Periksa</legend>
      
<div id="savelaborder" ></div>
     <table class="tb" width="100%">
       <tr>
         <th>No</th>
         <th width="40%">Jenis Pemeriksaan</th>
         <th>Hasil</th>
         <th>Nilai Normal</th>
         <th>Keterangan</th>
       </tr>
 <?php $i=1; while ( $data = mysql_fetch_array($row)){  ?>
       <tr>
         <td><?php echo $i?></td>
         <td><?php echo $data['nama_jasa']?></td>
         <td><?php echo $data['HASIL_PERIKSA']?></td>
         <td><?php echo $data['nilai_normal']?></td>
         <td><?php echo $data['KETERANGAN']?></td>
       </tr>
 <?php $i = $i + 1; } ?>
    </table>
     </fieldset>
</div>
</div>
