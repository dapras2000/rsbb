<script language="javascript">
function printIt()
{
content=document.getElementById('print_selection');
w=window.open('about:blank');
w.document.writeln("<? session_start(); ?>");
w.document.writeln("<link href='dq_sirs.css' type='text/css' rel='stylesheet' />");
w.document.write( content.innerHTML );
w.document.writeln("<? $var = $_SESSION['cetak']; ?>");
w.document.writeln("<script>");
w.document.writeln("window.print()");
w.document.writeln("</"+"script>");
}
</script>
<script language="javascript" type="text/javascript">
function jumpTo (link)
   {
   var new_url=link;
   if (  (new_url != "")  &&  (new_url != null)  )
      window.location=new_url;
}
function terbilangnya(bilangan) {
  bilangan    = String(bilangan);
  var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
  var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
  var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');

  var panjang_bilangan = bilangan.length;

  /* pengujian panjang bilangan */
  if (panjang_bilangan > 15) {
    kaLimat = "Diluar Batas";
    return kaLimat;
  }

  /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
  for (i = 1; i <= panjang_bilangan; i++) {
    angka[i] = bilangan.substr(-(i),1);
  }

  i = 1;
  j = 0;
  kaLimat = "";


  /* mulai proses iterasi terhadap array angka */
  while (i <= panjang_bilangan) {

    subkaLimat = "";
    kata1 = "";
    kata2 = "";
    kata3 = "";

    /* untuk Ratusan */
    if (angka[i+2] != "0") {
      if (angka[i+2] == "1") {
        kata1 = "Seratus";
      } else {
        kata1 = kata[angka[i+2]] + " Ratus";
      }
    }

    /* untuk Puluhan atau Belasan */
    if (angka[i+1] != "0") {
      if (angka[i+1] == "1") {
        if (angka[i] == "0") {
          kata2 = "Sepuluh";
        } else if (angka[i] == "1") {
          kata2 = "Sebelas";
        } else {
          kata2 = kata[angka[i]] + " Belas";
        }
      } else {
        kata2 = kata[angka[i+1]] + " Puluh";
      }
    }

    /* untuk Satuan */
    if (angka[i] != "0") {
      if (angka[i+1] != "1") {
        kata3 = kata[angka[i]];
      }
    }

    /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
    if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")) {
      subkaLimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
    }

    /* gabungkan variabe sub kaLimat (untuk Satu blok 3 angka) ke variabel kaLimat */
    kaLimat = subkaLimat + kaLimat;
    i = i + 3;
    j = j + 1;

  }

  /* mengganti Satu Ribu jadi Seribu jika diperlukan */
  if ((angka[5] == "0") && (angka[6] == "0")) {
    kaLimat = kaLimat.replace("Satu Ribu","Seribu");
  }

  return kaLimat + "Rupiah";
}
	
function isibayar(kondisi){
	if (kondisi) {
		document.getElementById("jumlah_dibayar").value=document.getElementById("tanda_terimah").value;				
		document.getElementById('terbilang').value=terbilangnya(document.getElementById("tanda_terimah").value);
	}
	else {
		document.getElementById("jumlah_dibayar").value="";
		document.getElementById('terbilang').value="";
	}
}
function isiterbilangnya(s){
	document.getElementById('terbilang').value=terbilangnya(s);
}
</script>
<div align="center">
<div id="frame" style="width:100%;">
	<div id="frame_title"><h3>Cart Bayar Rawat Jalan</h3></div>
<form name="byr1" action="include/process.php" action="post" id="byr1">
    <fieldset class="fieldset">
      <legend>Identitas </legend>
<?php
  $myquery = "select a.NOMR,a.KDPOLY,a.KDDOKTER,a.TGLREG,b.NAMA,b.ALAMAT,b.JENISKELAMIN, b.TGLLAHIR,c.NAMA as CARABAYAR, a.IDXDAFTAR, d.NAMA as POLY, e.NAMADOKTER, g.NOBILL, g.IDXBILL 
			  from t_pendaftaran a, m_pasien b, m_carabayar c, m_poly d, m_dokter e, t_billrajal g
			  where a.NOMR=b.NOMR AND a.KDCARABAYAR=c.KODE AND d.KODE=a.KDPOLY and a.KDDOKTER=e.KDDOKTER
			        and a.IDXDAFTAR=g.IDXDAFTAR AND g.IDXDAFTAR='".$_GET["idxdaftar"]."'";
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get); 		
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>No MR</td>
          <td><?php echo $userdata['NOMR'];?></td>
        </tr>
        <tr>
          <td width="21%">Nama Lengkap Pasien</td>
          <td width="79%"><?php echo $userdata['NAMA'];?></td>
        </tr>
        <tr>
          <td valign="top">Alamat Pasien</td>
          <td><?php echo $userdata['ALAMAT'];?></td>
        </tr>
        <tr>
          <td valign="top">Jenis Kelamin</td>
          <td colspan="2"><? if($userdata['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L"){echo"Laki-Laki";}elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P"){echo"Perempuan";} ?> <?php echo"( ". $userdata['JENISKELAMIN']." )";?></td>
        </tr>
        <tr>
          <td valign="top">Tanggal Lahir</td>
          <td>
            <?php echo $userdata['TGLLAHIR'];?>          </td>
        </tr>
        <tr>
          <td valign="top">Umur</td>
          <td><?php
		  $a = datediff($userdata['TGLLAHIR'], date("Y-m-d"));
		  echo "umur ".$a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td>
        </tr>
        <tr>
          <td valign="top">Cara Bayar</td>
          <td><?php echo $userdata['CARABAYAR'];?></td>
        </tr>
      </table>   
    </fieldset>
    </form>
</div>


<div id="print_selection" style="display:none; font-family:'Courier New', Courier, monospace; ">
<div style="border:1px solid #999; padding:5px; margin:5px; width:900px; font:0.7em Arial; font-size:12px;">

<div align="left" style="clear:both; width:100%">
<table width="100%" border="0" style=" font-family:'Courier New', Courier, monospace; ">
  <tr>
    <td width="10%" valign="top"><img src="img/log.png" width="71" height="79" /></td>
    <td width="58%" valign="top">
<div style="letter-spacing:-1px; font-size:14px; font:bold;"><?=strtoupper($header1)?></div>
<div style="letter-spacing:-2px; font-size:20px; color:#666; font:bold;"><?=strtoupper($header2)?></div>
<div><?=$header3?><br /><?=$header4?></div>
    
    </td>
    <td width="32%" valign="bottom">
<table width="100%" border="0" style=" font-family:'Courier New', Courier, monospace; font-size:12px;">
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Kepada Yth.</td>
    </tr>
  <tr>
    <td width="55%">Nama Pasien</td>
    <td width="3%">:</td>
    <td width="42%"><?php echo $userdata['NAMA'];?></td>
  </tr>
  <tr>
    <td>No MR</td>
    <td>:</td>
    <td><?php echo $userdata['NOMR'];?></td>
  </tr>
  <tr>
    <td>Tanggal Pembayaran</td>
    <td>:</td>
    <td><?php echo date("d/m/Y"); ?></td>
  </tr>
  </table>    
    </td>
  </tr>
  </table>
</div>

<br>
<div align="center" style="font-size:16px; font-family:'Courier New', Courier, monospace; "><strong>Kwitansi Pembayaran Rawat Jalan</strong></div>
<div align="left" style=" font-family:'Courier New', Courier, monospace; ">No Transaksi : <?php echo $_GET["idxb"]; ?></div>
<hr style='border:1px solid #5AC54B;'>
<table width="98%" border="0" cellpadding="1" cellspacing="1" class="tb" style=" font-family:'Courier New', Courier, monospace; font-size:12px;">
  <tr>
    <th width="29%">Kode Jasa</th>
    <th width="29%">Nama Jasa</th>
    <th width="22%">Quantity</th>
    <th width="20%" colspan="2">Tarif</th>
    </tr>
    <?php
  $sql = "SELECT a.kode, a.nama_jasa, b.qty, b.TARIFRS FROM m_tarif a, t_billrajal b WHERE a.kode=b.KODETARIF AND b.idxdaftar='".$_GET["idxdaftar"]."'";
  $qry = mysql_query($sql)or die(mysql_error());
  while($data = mysql_fetch_array($qry)){
  ?>
            <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
              <td><? echo $data['kode']; ?></td>
              <td><? echo $data['nama_jasa']; ?></td>
              <td align="center"><? echo $data['qty']; ?></td>
              <td align="center"><?php echo "Rp. ".number_format($data['TARIFRS']); ?></td>
            </tr>
            <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
    <?php } ?>
    <td colspan="3" align="right"><strong>Total Yang Harus Dibayar</strong></td>
    <td align="center"><strong><?php echo "Rp. ".number_format($_GET['t'], 0); ?></strong></td>
    </tr>
  </table>
<br />
<div align="left" style=" font-family:'Courier New', Courier, monospace; ">Terbilang : <i><strong><?=terbilang($_GET['t'])?></strong></i></div>
<div style=" font-family:'Courier New', Courier, monospace;">
<table width="98%" border="0" cellpadding="1" cellspacing="1" class="tb" style=" font-family:'Courier New', Courier, monospace; font-size:12px;">
    <tr>
      <td width="57%">&nbsp;</td>
      <td width="20%" align="center">Hormat Kami</td>
      <td width="23%">&nbsp;</td>
    </tr>
    <tr>
      <td>Catatan :</td>
      <td align="center">an. Kasir</td>
      <td align="center">an. Pasien</td>
    </tr>
    <tr>
      <td>Lembar 1 : Pasien / Penjamin</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Lembar 2 : Kasir</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td> Lembar 3 : Keuangan</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center">( <?php echo $_SESSION["NIP"]; ?> )</td>
      <td align="center">( <?php echo $userdata['NAMA'];?> )</td>
    </tr>
  </table>
  <? 
  ?>
  <div align="left"><i>Dicetak oleh [ <? echo $_SESSION['NIP']; ?> ] sebanyak [ 5 ]</i> &nbsp;&nbsp;&nbsp;tanggal : <?php echo date("d/m/Y"); ?></div>
</div>
</div>
</div>

<br /> 
<div id="frame" style="width:100%;">
<div id="frame_title"><h3>List Pembayaran</h3></div>
<fieldset>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb">
  <tr>
    <th>No</th>
    <th width="42%">Nama Jasa</th>
    <th width="24%">Tarif</th>
    <th width="34%" colspan="2">Quantity</th>
    </tr>
            <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
    <?php
  $sql = "SELECT a.kode, a.nama_jasa, b.qty, b.TARIFRS FROM m_tarif a, t_billrajal b WHERE a.kode=b.KODETARIF AND b.idxdaftar='".$_GET["idxdaftar"]."'";
  $qry = mysql_query($sql)or die(mysql_error());
  $total=0;
  $i=1;
  while($data = mysql_fetch_array($qry)){
  ?>
    <td><?=$i;?></td>
    <td><? echo $data['nama_jasa']; ?></td>
    <td align="right"><? echo "Rp. ".number_format($data['TARIFRS'], 0).",00"; ?></td>
    <td align="center"><? echo $data['qty']; ?> Kali</td>
    </tr>
    <?php 
	$i++;
	$total=$total+($data['TARIFRS']*$data['qty']);
	} ?>
  <tr class="tr2">
    <td colspan="3"  align="right">Total : <? echo "Rp. ".number_format($total, 0).",00"; ?></td>
    <td>&nbsp;</td>
  </tr>
  </table>


</fieldset>
</div>
</div>

