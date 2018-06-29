<script language="javascript">
    function printIt()
    {
        content=document.getElementById('print_selection');
        w=window.open('about:blank');
        w.document.write( content.innerHTML );
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
    <div id="frame">
        <div id="frame_title">
            <h3>Pembayaran Rawat Inap</h3></div>
        <fieldset class="fieldset">
            <legend>Identitas </legend>
            <?php
            $myquery = "SELECT a.nomr,a.kirimdari,a.dokterpengirim,a.masukrs,b.NAMA,b.ALAMAT,b.JENISKELAMIN, b.TGLLAHIR,c.NAMA as CARABAYAR, a.id_admission, d.NAMA as POLY, h.nama as ruang, a.nott
			  FROM t_admission a, m_pasien b, m_carabayar c, m_poly d, m_ruang h
			  WHERE a.nomr=b.NOMR AND a.statusbayar=c.KODE AND d.KODE=a.kirimdari and h.no=a.noruang
			        and a.id_admission='".$_GET['idx']."'";

            $get = mysql_query ($myquery)or die(mysql_error());
            $userdata = mysql_fetch_assoc($get);
            ?>
            <form name="bayar" action="include/process.php" method="post" id="bayar">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>No MR</td>
                        <td>
                            <?php echo $userdata['nomr'];?>

                        </td>
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
                        <td colspan="2"><? if($userdata['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L") {
                                echo"Laki-Laki";
                            }elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P") {
                                echo"Perempuan";
                            } ?> <?php echo"( ". $userdata['JENISKELAMIN']." )";?></td>
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
                    <tr>
                        <td valign="top">Ruang</td>
                        <td><?php echo $userdata['ruang'];?></td>
                    </tr>
                    <tr>
                        <td valign="top">No. Tempat Tidur</td>
                        <td><?php echo $userdata['nott'];?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="button" onclick="javascript:history.back();" class="text" value="K e m b a l i" /></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </div>
   
    <div id="frame">
        <div id="frame_title"><h3>List Pembayaran</h3></div>
        <fieldset>
            <legend>Cart List Bayar</legend>
            <table width="95%" border="0" cellpadding="0" cellspacing="0" class="tb">
                <tr>
                    <th>Nama Jasa</th>
                    <th style="width:200px;text-align:center;">Pelaksana</th>
                    <th style="width:100px;text-align:center;">Tanggal </th>
                    <th style="width:100px;text-align:center;">Tarif</th>
                    <th style="width:100px;text-align:center;">Quantity</th>
                    <th style="width:100px;text-align:center;">Subtotal</th>
                    <th style="width:100px;text-align:center;">Carabayar</th>
                    <th style="width:100px;text-align:center;">Aksi</th>
                </tr>
                        <?php
                  $sql = "SELECT a.nama_tindakan AS nama_jasa, d.NAMADOKTER,
DATE_FORMAT(b.TANGGAL,'%d/%m/%Y') AS TGL1, b.qty, b.TARIFRS, c.NAMA as carabayar, b.idxbill as kdbill 
FROM m_tarif2012 a, t_billranap b 
join m_carabayar c on c.KODE = b.CARABAYAR 
JOIN m_dokter d on d.KDDOKTER = b.KDDOKTER
WHERE a.kode_tindakan=b.KODETARIF AND b.idxdaftar='".$_REQUEST['idx']."'";
						$total	= 0;
                        $qry = mysql_query($sql)or die(mysql_error());
                        while($data = mysql_fetch_array($qry)) {
							$total = $total + $data['TARIFRS'] * $data['qty'] ;
                            ?>
                <tr>
                    <td><? echo $data['nama_jasa']; ?></td>
                    <td><? echo $data['NAMADOKTER']; ?></td>
                    <td align="center"><? echo $data['TGL1']; ?></td>
                    <td align="right"><? echo "Rp. ".curformat($data['TARIFRS']); ?></td>
                    <td align="center"><? echo $data['qty']; ?></td>
                    <td align="right"><? echo "Rp. ".curformat($data['TARIFRS'] * $data['qty']); ?></td>
                    <td align="center"><?php echo $data['carabayar']; ?></td>
                    <td align="center"><a onclick="return confirm ('Yakin hapus --<?php echo $data['nama_jasa']." .:: Tgl ".$data['TGL1']." ::."."Rp. ".curformat($data['TARIFRS'] * $data['qty']);?>-- .? ');" class="btn btn-sm btn-danger tooltips" data-placement="bottom" data-toggle="tooltip" title="Hapus Jasa" href="ranap/hapus_listbayar_ranap.php?link=<?php echo $_GET['link'];?>&nomr=<?php echo $_GET['nomr'];?>&idx=<?php echo $_GET['idx'];?>&idxbill=<?php echo $data['kdbill'];?>">Hapus</a></td>
                </tr>
                    <?php } ?>
                <tr>
                    <td colspan="3" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;">TOTAL</td>
                    <td align="right" style="background:#999; font-weight:bold;"></td>
                    <td align="center" style="background:#999; font-weight:bold;"></td>
                    <td align="center" style="background:#999; font-weight:bold; text-align:right;"><? echo "Rp. ".curformat($total); ?></td>
                    <td align="center" style="background:#999; font-weight:bold;"></td>
                </tr>
            </table>
        </fieldset>
    </div>
</div>