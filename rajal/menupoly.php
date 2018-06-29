<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript">
  function enter_pressed(e){
  var keycode;
  if (window.event) keycode = window.event.keyCode;
  else if (e) keycode = e.which;
  else return false;
  return (keycode == 13);
  return false;
  }
</script>

<script language="javascript">
  function printIt(){
  	content=document.getElementById('askep');
  	w=window.open('about:blank');
  	w.document.write( content.innerHTML );
  	w.document.writeln("<script>");
  	w.document.writeln("window.print()");
  w.document.writeln("</"+"script>");
  }
  function printIt(){
  	content=document.getElementById('valid');
  	head=document.getElementById('head_report');
  	w=window.open('about:blank');
  	w.document.writeln("<link href='dq_sirs.css' type='text/css' rel='stylesheet' />");
  	w.document.write( head.innerHTML );
  	w.document.write( content.innerHTML );
  	w.document.writeln("<script>");
  	w.document.writeln("window.print()");
  	w.document.writeln("</"+"script>");
  }
  function popUp(URL) {
  	day = new Date();
  	id = 'keringanan';
  	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=1000,height=400,left=50,top=50');");
  }

  jQuery(document).ready(function(){
  	jQuery('.tindakan').click(function(){
  		var nomr		= jQuery('#nomr').val();
  		var idxdaftar	= jQuery('#idxdaftar').val();
  		var carabayar	= jQuery('#carabayar').val();
  		var poly		= jQuery(this).attr('id');
  		popUp('daftar_tindakan_poly.php?nomr='+nomr+'&idx='+idxdaftar+'&carabayar='+carabayar+'&poly='+poly);
  	});
  	
  	jQuery('.konsultasi_gizi').click(function(){
  		var nomr		= jQuery('#nomr').val();
  		var idxdaftar	= jQuery('#idxdaftar').val();
  		var dokter		= jQuery('#dokter').val();
  		var carabayar	= jQuery('#carabayar').val();
  		var poly		= jQuery(this).attr('id');
  		var rajal		= 1;
  		jQuery.get('cartbill_save_bayar_gizi.php?nomr='+nomr+'&idx='+idxdaftar+'&carabayar='+carabayar+'&dokter='+dokter+'&poly='+poly+'&rajal='+rajal,function(data){
  			if(!data){
  				alert("Berhasil didaftarkan di Konsultasi Gizi");
  			}
  		});
  	});
  });
</script>

<?php 
include("include/connect.php");
require_once('ps_pagination.php');

?>
<div align="center">
  <div id="frame">
    <div id="frame_title">
      <h3 align="left">IDENTITAS PASIEN</h3>
    </div>
  	<div id="all">
      <fieldset class="fieldset">
        <legend>Identitas </legend>
        <?php
          $myquery = "select a.NOMR,a.KDPOLY,a.KDDOKTER,a.TGLREG,b.NAMA,b.ALAMAT,b.JENISKELAMIN,b.TGLLAHIR,c.NAMA as CARABAYAR, a.IDXDAFTAR, d.NAMA as POLY, e.NAMADOKTER,a.KDCARABAYAR
        			  from t_pendaftaran a, m_pasien b, m_carabayar c, m_poly d, m_dokter e
        			  where a.NOMR=b.NOMR AND a.KDCARABAYAR=c.KODE AND d.KODE=a.KDPOLY and a.KDDOKTER=e.KDDOKTER
        			        and a.IDXDAFTAR='".$_GET["idx"]."'";
                                     //echo $myquery;
          		$get = mysql_query ($myquery)or die(mysql_error());
        		$userdata = mysql_fetch_assoc($get); 		
        		$nomr=$userdata['NOMR'];
        		$idxdaftar=$userdata['IDXDAFTAR'];
        		$kdpoly=$userdata['KDPOLY'];
        		$kddokter=$userdata['KDDOKTER'];
        		$tglreg=$userdata['TGLREG'];
        		$_SESSION['nomrx123'] = $nomr;
        		$_SESSION['kdpoly']   = $kdpoly;
        ?>
        <table width="95%" border="0">
          <tr>
            <td width="60%">
              <table width="100%" border="0" class="tb" align="left" cellpadding="0" cellspacing="0">
                <tr><td><strong>No MR</strong></td><td>: <?php echo $userdata['NOMR'];?></td></tr>
                <tr>
                  <td width="25%"><strong>Nama Lengkap Pasien</strong></td>
                  <td width="75%">: <?php echo $userdata['NAMA'];?></td>
                </tr>
                <tr>
                  <td valign="top"><strong>Alamat Pasien</strong></td>
                  <td>: <?php echo $userdata['ALAMAT'];?></td>
                </tr>
                <tr>
                  <td valign="top"><strong>Jenis Kelamin</strong></td>
                  <td colspan="2">: <? if($userdata['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L"){echo"Laki-Laki";}elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P"){echo"Perempuan";} ?>            <?php echo"( ". $userdata['JENISKELAMIN']." )";?></td>
                </tr>
                <tr>
                  <td valign="top"><strong>Tanggal Lahir</strong></td>
                  <td>: <?php echo date('d/m/Y', strtotime($userdata['TGLLAHIR']));?> </td>
                </tr>
                <tr>
                  <td valign="top"><strong>Umur</strong></td>
                  <td>: <?php
                		  $a = datediff($userdata['TGLLAHIR'], date("Y-m-d"));
                		  echo $a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td>
                </tr>
                <tr>
                  <td valign="top"><strong>Poly</strong></td>
                  <td>: <?php echo $userdata['POLY'];?></td>
                </tr>
                <tr>
                  <td valign="top"><strong>Cara Bayar</strong></td>
                  <td>: <?php echo $userdata['CARABAYAR'];?></td>
                </tr>
               </table>    
            </td>
            <td width="31%" valign="top" align="right">
              <div class="tb">
        	        <div id="frame_title">
        	         <h3>History Pasien</h3>
                  </div>
                  <div>
                    <a href="?link=detail_billing&nomr=<?=$_GET['nomr']?>&idxdaftar=<?php echo $_REQUEST['idx'];?>"><input type="button" class="text" name="Riwayat Pasien" value="Status Pembayaran" /></a>
                    <a href="?link=rm6&nomr=<?=$_GET['nomr']?>&nama=<?=$userdata['NAMA']?>"><input type="button" class="text" name="Riwayat Pasien" value="Riwayat Pasien" /></a>
		  		        </div>
              </div>
              <?php if($_SESSION['ROLES'] == 26 || $_SESSION['ROLES'] == 4): ?>
              <br />
              <div class="tb">
        	       <div id="frame_title">
        	         <h3>Jasa Tindakan</h3>
                 </div>
                  <div>
                  	  <input type="hidden" name="nomr" id="nomr" value="<?php echo $userdata['NOMR']; ?>" />
                      <input type="hidden" name="idxdaftar" id="idxdaftar" value="<?php echo $userdata['IDXDAFTAR']; ?>" />
                      <input type="hidden" name="carabayar" id="carabayar" value="<?php echo $userdata['KDCARABAYAR']; ?>" />
                      <input type="hidden" name="dokter" id="dokter" value="<?php echo $userdata['KDDOKTER']; ?>" />

                  	
                       <?php if($_SESSION['KDUNIT']=='40'){ ?>
              				    <input type="button" name="tindakan_poly" class="tindakan text" id="<?php echo "40";?>" value="Jasa Tindakan Poly" /> | 
              				 <?php }else{ ?>
              						<input type="button" name="tindakan_poly" class="tindakan text" id="<?php echo $kdpoly;?>" value="Jasa Tindakan Poly" /> | 
              				 <?php } ?>
              				<?php if($_SESSION['KDUNIT']!='40'){ ?>
              				<input type="button" name="tindakan_poly" class="tindakan text" id="0" value="Jasa Tindakan Lain Lain" /> | 
                      <input type="button" name="konsultasi_gizi" class="konsultasi_gizi text" id="<?php echo $kdpoly;?>" value="Konsultasi Gizi" />
                      <?php } ?>
                  </div>
              </div>
              <?php endif;?>
            </td>
          </tr>
        </table>
      </fieldset>

      <div id="list_data"></div>
      
      <fieldset class="fieldset">
        <legend>Data Rekam Medik</legend>
          <div id="tabmenu">
	  	   
      <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=5&idx=<?=$idxdaftar?>">PASIEN KELUAR/MASUK</a>
      <?php if($_SESSION['KDUNIT']!='40'){ ?>
  	  <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=10&idx=<?=$idxdaftar?>">ANAMNESA DENGAN POLA</a>
  		<?php } ?>
      <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=2&idx=<?=$idxdaftar?>">DIAGNOSA DAN TERAPI</a> 

	  	<?php if($_SESSION['KDUNIT']!='40'){ ?>
        <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=1&idx=<?=$idxdaftar?>">ADD ITEM OBAT</a>
        <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=3&idx=<?=$idxdaftar?>">ORDER RADIOLOGI</a> 
        <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=4&idx=<?=$idxdaftar?>">ORDER LAB</a>
        <a href="?link=51&nomr=<?= $_GET['nomr'];?>&menu=6&idx=<?=$idxdaftar?>">ORDER KAMAR OPERASI</a>
      <?php }
      	 		  
      	  ?>
    </div>
      
      <div id="wrapper">
           
	<div class="boxholder">	
    <div id="cart_resep">
    	<? if(!empty($pesan)){ ?>
		<div style="border:1px solid #DF7; padding:5px; margin:5px; color:#093; width:95%; background-color:#FFF;" align="left">
			<strong><?=$pesan;?></strong>
        </div>
        <? } ?>
    </div>	

 <? 
 if ($_GET['menu']=='2')
 {
 ?>  
<div class="box">
<div id="frame">
    <div id="frame_title">
  <h3>Diagnosa & Terapi</h3>
    </div>
    <? include("diagnosa_terapi.php"); ?>
        </div>
</div>

    <? }else if ($_GET['menu']=='1') { ?> 
    <div class="box">
      <div id="frame">
        <div id="frame_title">
          <h3>Add Item Obat</h3>
        </div>
          <? include("apotek/additemobat.php"); ?>
      </div>
    </div>
   
<? } 
 elseif ($_GET['menu']=='3')
 {?>   
    <div class="box">
				<? include("rad/order_rad.php");?>  
    </div>

 <? } 
 elseif ($_GET['menu']=='4')
 {?>    
    <div class="box">
        <? include("lab/order_lab.php"); ?>
    </div>
  <? } 
 elseif ($_GET['menu']=='5' || $_GET['menu']=='')
 {?>   
    
   <div class="box">
      <div id="frame"><div id="frame_title"><h3>Pasien Keluar Masuk</h3></div>
         <? include("masuk_keluar.php"); ?>
	 </div>		
  </div>



<? } 
 elseif ($_GET['menu']=='6')
 {?> 
    <div class="box">
    <p>
    <? include("rajal/operasi/form_daftar_operasi.php");?>
    </div>
    
    
	</div>
    </div>
          <div id="autocompletediv" class="autocomp"></div>
</fieldset>
</div>
</div></div>
<? }  
elseif ($_GET['menu']=='10')
 {?> 
 

         <? include("anamnesa.php"); ?>

<? } ?>         
