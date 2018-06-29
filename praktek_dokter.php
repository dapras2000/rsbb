<?php 
include("include/connect.php");
require_once('ps_pagebill.php');
?>
<link href="admission/date/examples-offline.css" rel="stylesheet">
    <link href="admission/date/kendo.common.min.css" rel="stylesheet">
    <link href="admission/date/kendo.default.min.css" rel="stylesheet">

    <script src="admission/date/js/jquery.min.js"></script>
    <script src="admission/date/js/kendo.web.min.js"></script>
    <script src="admission/date/js/console.js"></script>
 <script>
                $(document).ready(function() {
                    function startChange() {
                        var startTime = start.value();

                        if (startTime) {
                            startTime = new Date(startTime);

                            end.max(startTime);

                            startTime.setMinutes(startTime.getMinutes() + this.options.interval);

                            end.min(startTime);
                            end.value(startTime);
                        }
                    }

                    //init start timepicker
                    var start = $("#start").kendoTimePicker({
						change: startChange
                    }).data("kendoTimePicker");

                    //init end timepicker
                    var end = $("#end").kendoTimePicker().data("kendoTimePicker");

                    //define min/max range
                    start.min("7:00 AM");
                    start.max("6:30 PM");

                    //define min/max range
                    end.min("8:00 AM");
                    end.max("7:30 AM");
                });
            </script>

            <style scoped>
                #example .k-timepicker {
                    vertical-align: middle;
                }

                #example h3 {
                    clear: both;
                }

                #example .code-sample {
                    width: 60%;
                    float:left;
                    margin-bottom: 20px;
                }

                #example .output {
                    width: 24%;
                    margin-left: 4%;
                    float:left;
                }
                
            </style>

<script>
jQuery(document).ready(function(){
	jQuery('.loader').hide();
	jQuery('.button').click(function(){
		var kdpoly	= jQuery(this).attr('svn');
		var kddokter= jQuery('#dokter_'+kdpoly).val();
		var kddokter2= jQuery('#dokter2_'+kdpoly).val();
		jQuery('#loader_'+kdpoly).show();
		jQuery.post('<?php echo _BASE_; ?>include/ajaxload.php',{kdpoly:kdpoly,kddokter:kddokter,kddokter2:kddokter2,dokterpraktek:'true'},function(data){
			//location.reload();
			jQuery('#btn_'+kdpoly).val('U P D A T E').css({'background':'#ff9900'});
			jQuery('#loader_'+kdpoly).hide();
		});
	});
	jQuery('.buttonadd').click(function(){
		var kdpoly	= jQuery(this).attr('svn');
		jQuery.post('<?php echo _BASE_; ?>include/ajaxload.php',{kdpoly:kdpoly,add_dokterprak:'true'},function(data){
			//location.reload();
			jQuery('#btn_'+kdpoly).val('U P D A T E').css({'background':'#ff9900'});
			jQuery('#loader_'+kdpoly).hide();
		});
	});
	jQuery('#addnew').click(function(){
		var poly 	= jQuery('#namapoly').val();
		var dokter	= jQuery('#namadokter').val();
		var jadwal 	= jQuery('#jadwal_prak').val();
		var start	= jQuery('#start').val();
		var end 	= jQuery('#end').val();
		if(poly == ''){
			alert('Poly Belum dipilih');
			return false;
		}
		if(dokter == ''){
			alert('Dokter Belum dipilih');
			return false;
		}
		if(jadwal == ''){
			alert('Jadwal Belum dipilih');
			return false;
		}
		if(start == ''){
			alert('Awal Praktek Belum dipilih');
			return false;
		} 
		if(end == ''){
			alert('Akhir Praktek Belum dipilih');
			return false;
		} 
		jQuery.post('<?php echo _BASE_; ?>include/ajaxload.php',{poly:poly,dokter:dokter,jadwal:jadwal,start:start,end:end,add_dokterprak:true},function(data){
			if(data == 'error'){
				alert('Tidak bisa mendaftarkan satu dokter dalam poly yang sama');
				return false;
			}else{
				jQuery('#listdokter_prak'+poly).load('<?php echo _BASE_;?>include/ajaxload.php?loaddokter='+poly);
				window.location="?link=praktek_dokter";
			}
		});
	});
	jQuery('#batal').click(function(){
		window.location="?link=praktek_dokter";
	});
	jQuery('#editdata').click(function(){
		var kode 	= jQuery('#kode').val();
		var poly 	= jQuery('#namapoly').val();
		var dokter	= jQuery('#namadokter').val();
		var jadwal 	= jQuery('#jadwal_prak').val();
		var start	= jQuery('#start').val();
		var end 	= jQuery('#end').val();
		if(poly == ''){
			alert('Poly Belum dipilih');
			return false;
		}
		if(dokter == ''){
			alert('Dokter Belum dipilih');
			return false;
		}
		if(jadwal == ''){
			alert('Jadwal Belum dipilih');
			return false;
		}
		if(start == ''){
			alert('Awal Praktek Belum dipilih');
			return false;
		} 
		if(end == ''){
			alert('Akhir Praktek Belum dipilih');
			return false;
		}
		jQuery.post('<?php echo _BASE_; ?>include/ajaxload.php',{kode:kode,poly:poly,dokter:dokter,jadwal:jadwal,start:start,end:end,editdokter:true},function(data){
			if(data == 'error'){
				alert('Tidak bisa mendaftarkan satu dokter dalam poly yang sama');
				return false;
			}else{
				jQuery('#listdokter_prak'+poly).load('<?php echo _BASE_;?>include/ajaxload.php?loaddokter='+poly);
				window.location="?link=praktek_dokter";
			}
		});
	});
	jQuery('.hapus').click(function(){
		var id 	= jQuery(this).attr('id');
		var poly= jQuery(this).attr('poly');
//		var dokter = jQuery(this).attr('dokter');
		jQuery.post('<?php echo _BASE_; ?>include/ajaxload.php',{id:id,removedokter:true},function(data){
			jQuery('#listdokter_prak'+poly).load('<?php echo _BASE_;?>include/ajaxload.php?loaddokter='+poly);
			window.location="?link=praktek_dokter";
		});						
	});
	jQuery('.edit').click(function(){
		var id 	= jQuery(this).attr('id');
		var poly= jQuery(this).attr('poly');
		var dokter = jQuery(this).attr('dokter');
		jQuery.post('<?php echo _BASE_; ?>include/ajaxload.php',{id:id,dokter:dokter,editdokter:true},function(data){
			jQuery('#listdokter_prak'+poly).load('<?php echo _BASE_;?>include/ajaxload.php?loaddokter='+poly);
		//	window.location="?link=praktek_dokter&nama=<?=$hsl['nama'];?>&dokter=<?=$hsl['kddokter']?>";
		});						
	});
});
</script>
<script>
  function UpdateRecord(id)
  {
      jQuery.ajax({
       type: "POST",
       url: "update.php",
       data: 'id='+id,
       cache: false,
       success: function(response)
       {
         alert("Record successfully updated");
       }
     });
 }
</script>

<style type="text/css">
.loader{background:url(js/loading.gif) no-repeat; width:16px; height:16px; float:right; margin-right:30px;}
.hapus{cursor:pointer;}
.edit{cursor:pointer;}
.listdokter{height:20px;}
.listpoly{border-bottom:1px solid #000;}
.namadokter{float:left; height:20px; margin-right:20px;}
</style>
<div align="center">
    <div id="frame">
    	<div id="frame_title">
			<h3>Jadwal Praktek Dokter</h3>
    	</div>
<?php
//$sql_	= mysql_query('select a.*, b.*,c.* from m_dokter_praktek a join m_poly b join m_dokter c on a.kdpoly = b.kode AND a.kddokter = c.KDDOKTER where id = "'.$_REQUEST['id'].'" GROUP BY nama ORDER BY nama ASC');
if(isset($_REQUEST['kode'])){
	$sql_	= mysql_query('select * from m_dokter_praktek where id = "'.$_REQUEST['kode'].'"');
	$hsl	= mysql_fetch_array($sql_);
}
?>
        <table width="100%" border="0" style="background:none;">
		<tr>
		<td width="11%" rowspan="8" valign="top"></td>
		<td>Nama Layanan</td>
		<td><input value="<?=$hsl['id']?>" type="hidden" id="kode" name="kode"/><select name="nama_poly" id="namapoly" style="float:left; margin-right:20px;">
        							<option value=""> -- Pilih Poly -- </option>
<?php
//$sql_pol = mysql_query('select * from m_poly');
//$dpol	= mysql_fetch_array($sql_pol);  ?> 
					<option value="1" <? if($hsl['kdpoly']=="1")echo "selected=Selected";?> >DALAM</option>
					<option value="2" <? if($hsl['kdpoly']=="2")echo "selected=Selected";?> >KB dan KD</option>
					<option value="3" <? if($hsl['kdpoly']=="3")echo "selected=Selected";?> >ANAK</option>
					<option value="4" <? if($hsl['kdpoly']=="4")echo "selected=Selected";?> >BEDAH</option>
					<option value="5" <? if($hsl['kdpoly']=="5")echo "selected=Selected";?> >GIGI</option>
					<option value="6" <? if($hsl['kdpoly']=="6")echo "selected=Selected";?> >PSIKIATRI</option>
					<option value="7" <? if($hsl['kdpoly']=="7")echo "selected=Selected";?> >NEUROLOGI</option>
					<option value="8" <? if($hsl['kdpoly']=="8")echo "selected=Selected";?> >ANESTESI</option>
					<option value="9" <? if($hsl['kdpoly']=="9")echo "selected=Selected";?> >UGD</option>
					<option value="10" <? if($hsl['kdpoly']=="10")echo "selected=Selected";?> >VK</option>
					<option value="11" <? if($hsl['kdpoly']=="11")echo "selected=Selected";?> >RUJUKAN</option>
					<option value="28" <? if($hsl['kdpoly']=="28")echo "selected=Selected";?> >THT</option>
					<option value="29" <? if($hsl['kdpoly']=="29")echo "selected=Selected";?> >MATA</option>
					<option value="30" <? if($hsl['kdpoly']=="30")echo "selected=Selected";?> >PARU</option>
					<option value="31" <? if($hsl['kdpoly']=="31")echo "selected=Selected";?> >FISIOTERAPI</option>
<?
//									$sql_poly	= mysql_query('select * from m_poly');
//									while($dat = mysql_fetch_array($sql_poly)){
									//	echo '<option value="'.$dat['kode'].'">'.$dat['nama'].'</option>';
								//	}
									?>
        						   </select></td></tr>
			<tr>
			<td>Petugas</td>
			<td><select name="nama_dokter" id="namadokter">
        							<option value=""> -- Pilih Dokter -- </option>
                                    <?php 
									$sql_dokter	= mysql_query('SELECT DISTINCT NAMADOKTER, KDDOKTER FROM m_dokter GROUP BY NAMADOKTER ORDER BY NAMADOKTER ASC');
									while($hsl1 = mysql_fetch_array($sql_dokter)){
										if($hsl1['KDDOKTER']==$hsl['kddokter']) { $tambah = 'selected=Selected'; }else{ $tambah = ''; }
										echo '<option value="'.$hsl1['KDDOKTER'].'" '.$tambah.' >'.$hsl1['NAMADOKTER'].'</option>';
									}
									?>
        							
        						   </select></td></tr>
		<tr>
			<td>Ruangan</td>
			<td><select name="ruangan_prak" id="ruangan_prak">
				<option value=""> -- Pilih Ruangan -- </option>
				<?php
					$sql_ruangan = mysql_query('SELECT * from m_ruang');
					while($hsl2 = mysql_fetch_array($sql_ruangan)){
						echo '<option value="'.$hsl2['no'].'">'.$hsl2['nama'].'</option>';
					}
					?>
				</select></td></tr>
		<?
//		$sql_jadwal	= mysql_query('select * from m_dokter_praktek');
//		$data = mysql_fetch_array($sql_jadwal); ?>
		<tr>
			<td>Jadwal Praktek</td>
				<td><select name="jadwal_praktek" id="jadwal_prak">
				<option value=""> -- Jadwal -- </option>
				<option name="JADWAL" value="Senin" <? if($hsl['jadwal']=="Senin") echo "selected=Selected";?>>Senin</option>
			<option name="JADWAL" value="Selasa" <? if($hsl['jadwal']=="Selasa") echo "selected=Selected";?>>Selasa</option>
			<option name="JADWAL" value="Rabu" <? if($hsl['jadwal']=="Rabu") echo "selected=Selected";?>>Rabu</option>
			<option name="JADWAL" value="Kamis" <? if($hsl['jadwal']=="Kamis") echo "selected=Selected";?>>Kamis</option>
			<option name="JADWAL" value="Jumat" <? if($hsl['jadwal']=="Jumat") echo "selected=Selected";?>>Jumat</option>
			<option name="JADWAL" value="Sabtu" <? if($hsl['jadwal']=="Sabtu") echo "selected=Selected";?>>Sabtu</option>
			<option name="JADWAL" value="Minggu" <? if($hsl['jadwal']=="Minggu") echo "selected=Selected";?>>Minggu</option>
			</select></td></tr>
	
		<tr>
			<td><label for="start">Dari Jam</label></td>
			<td><input type="text" name="start" id="start" name="start" value="<?php echo $hsl['dari_jam'];?>" /></td></tr>
		<tr>
			<td><label for="end">Sampai Jam</label></td>
			<td><input type="text" name="end" id="end" value="<?php echo $hsl['sampai_jam'];?>"></td></tr>
			<tr><td>&nbsp;</td></tr>
			
		<tr><td>&nbsp;</td>
		<?if(isset($_REQUEST['kode'])){?>
			<td colspan="2" align="left"><input type="button" name="tambah" value="S I M P A N" id="editdata" class="text" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="tambah" value="B A T A L" id="batal" class="text" /></td></tr>
		<?}else{?>
			<td colspan="2" align="left"><input type="button" name="tambah" value="T A M B A H" id="addnew" class="text" /></td></tr>
		<?}?>
		</table>
		<br><br>
	<table width="98%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Praktek Dokter">
                    <tr align="center">
                        <th width="5%">No</th>
                        <th width="12%">Nama Layanan</th>
                        <th width="15%">Nama Dokter</th>
						<th width="8%">Jadwal</th>
                        <th width="15%">Ruangan</th>
                        <th width="8%">Dari</th>
                        <th width="8%">Sampai</th>
                        <th colspan='2' width="10%">Aksi</th>
                    </tr>
				
				<?php $i = 1;
	$sql	= mysql_query('select a.*,b.*,c.* from m_dokter_praktek a join m_poly b join m_dokter c on a.kdpoly = b.kode AND a.kddokter = c.KDDOKTER GROUP BY nama ORDER BY nama ASC');
				while($dpoly = mysql_fetch_array($sql)){
				echo '<tr>';
				echo '<td align="center">'.$i++.'</td>';
				echo '<td class="listpoly">'.$dpoly['nama'].'</td>';
				echo '<td class="listpoly"><div class="listdokter" id="listdokter_prak'.$dpoly['kode'].'" style="display:block;">';
				$sql_3	= mysql_query('select a.id, a.kddokter,a.kdpoly,a.jadwal,a.dari_jam,a.sampai_jam, b.NAMADOKTER, a.id from m_dokter_praktek a join m_dokter b on a.kddokter = b.KDDOKTER where a.kdpoly = '.$dpoly['kode'].'');
				if(mysql_num_rows($sql_3) > 0):
					while($ddok	= mysql_fetch_array($sql_3)){
					echo '<div class="namadokter">'.$ddok['NAMADOKTER'].'</div> <span id="'.$ddok['id'].'" poly="'.$dpoly['kode'].'" </span><br clear="all">';
					}
				endif;
				echo '</div></td>';
		
				echo '<td class="listpoly"><div class="listdokter" id="listdokter_prak'.$dpoly['kode'].'" style="display:block;">';
				$sql_3	= mysql_query('select a.kddokter,a.jadwal,a.kdpoly, b.NAMADOKTER, a.id from m_dokter_praktek a join m_dokter b on a.kddokter = b.KDDOKTER where a.kdpoly = '.$dpoly['kode'].'');
				if(mysql_num_rows($sql_3) > 0):
					while($ddok	= mysql_fetch_array($sql_3)){
					echo '<div class="namadokter">'.$ddok['jadwal'].'</div> <span id="'.$ddok['id'].'" poly="'.$dpoly['kode'].'" </span><br clear="all">';
					}
				endif;
				echo '</div></td>';
			
				$qry = mysql_query('SELECT a.no,a.nama, b.kode, a.no from m_ruang a join m_poly b on a.no = b.kode where a.no = '.$dpoly['kode'].'');
				$ddok = mysql_fetch_array($qry);
				echo '<td align="center" class="listpoly">'.$ddok['nama'].'</td>';
				echo '<td class="listpoly"><div class="listdokter" id="listdokter_prak'.$dpoly['kode'].'" style="display:block;">';
				$sql_3	= mysql_query('select a.kddokter,a.dari_jam,a.kdpoly, b.NAMADOKTER, a.id from m_dokter_praktek a join m_dokter b on a.kddokter = b.KDDOKTER where a.kdpoly = '.$dpoly['kode'].'');
				if(mysql_num_rows($sql_3) > 0):
					while($ddok	= mysql_fetch_array($sql_3)){
					echo '<div class="namadokter">'.$ddok['dari_jam'].'</div> <span id="'.$ddok['id'].'" poly="'.$dpoly['kode'].'" </span><br clear="all">';
					}
				endif;
				echo '</div></td>';
	echo '<td class="listpoly"><div class="listdokter" id="listdokter_prak'.$dpoly['kode'].'" style="display:block;">';
				$sql_3	= mysql_query('select a.kddokter,a.sampai_jam,a.kdpoly, b.NAMADOKTER, a.id from m_dokter_praktek a join m_dokter b on a.kddokter = b.KDDOKTER where a.kdpoly = '.$dpoly['kode'].'');
				if(mysql_num_rows($sql_3) > 0):
					while($ddok	= mysql_fetch_array($sql_3)){
					echo '<div class="namadokter">'.$ddok['sampai_jam'].'</div> <span id="'.$ddok['id'].'" poly="'.$dpoly['kode'].'" </span><br clear="all">';
					}
				endif;
				echo '</div></td>';
				
		echo '<td class="listpoly"><div class="listdokter" id="listdokter_prak'.$dpoly['kode'].'" style="display:block;">';
				$sql_2	= mysql_query('select a.kddokter,a.jadwal,a.kdpoly, b.NAMADOKTER, a.id from m_dokter_praktek a join m_dokter b on a.kddokter = b.KDDOKTER where a.kdpoly = '.$dpoly['kode'].'');
				if(mysql_num_rows($sql_2) > 0):
					while($ddok	= mysql_fetch_array($sql_2)){
					echo '<div class="namadokter"></div> <span id="'.$ddok['id'].'" poly="'.$dpoly['kode'].'" class="hapus text">Hapus </span><br clear="all">';
				}
				endif;
				echo '</div></td>';

				echo '<td class="listpoly"><div class="listdokter" id="listdokter_prak'.$dpoly['kode'].'" style="display:block;">';
				$sql_4	= mysql_query('select a.kddokter,a.jadwal,a.kdpoly,a.dari_jam,a.sampai_jam,a.id, b.NAMADOKTER,c.kode,c.nama from m_dokter_praktek a join m_dokter b join m_poly c on a.kddokter = b.KDDOKTER AND a.kdpoly = c.kode where a.kdpoly = '.$dpoly['kode'].'');
				if(mysql_num_rows($sql_4) > 0):
					while($ddok = mysql_fetch_array($sql_4)){ ?>
	<div class="namadokter"></div>
<a href="?link=praktek_dokter&kode=<?=$ddok['id'];?>">
					<span class="edit text">Edit </span><br clear="all"></a>

				<?
				}
				endif;
				echo '</div></td>';	
			echo '</tr>';
		}
		?>
<!-- 	<a href=?link=praktek_dokter&poly='.$ddok['nama'].'&dokter='.$ddok['NAMADOKTER'].'&jadwal='.$ddok['jadwal'].'>
					<span class="edit text">Edit </span><br clear="all"></a>';-->
					</table>
        <br clear="all" />
	</div>
</div>
