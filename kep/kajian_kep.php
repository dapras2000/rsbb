<?php 
include("../include/connect.php");
include '../include/function.php';
require_once('./ps_pagination_x.php');


  $myquery = "SELECT 
  m_login.NIP,
  m_login.DEPARTEMEN,
  m_login.KDUNIT
FROM
  m_login
WHERE  m_login.NIP='".$_SESSION['NIP']."'";

$get = mysql_query ($myquery)or die(mysql_error());
$userdata = mysql_fetch_assoc($get);
$nip=$userdata['NIP'];
$kdpoly=$userdata['KDUNIT'];
$bagian=$userdata['DEPARTEMEN'];

//$search = " AND a.tanggal = curdate() ";

$tgl_reg = "";
if(!empty($_GET['tgl_reg'])) {
    $tgl_reg =$_GET['tgl_reg'];
}

if($tgl_reg !="") {
    $search = " AND a.tanggal BETWEEN  '".$tgl_reg."' ";
}

$tgl_reg2 = "";
if(!empty($_GET['tgl_reg2'])) {
    $tgl_reg2 =$_GET['tgl_reg2'];
}


if($tgl_reg !="") {
    if($tgl_reg2 !="") {
        $search = $search." AND '".$tgl_reg2."' ";
    }else {
        $search = $search." AND '".$tgl_reg."' ";
    }
}


?>
<script>
jQuery(document).ready(function(){
	jQuery(".tab_content").hide(); //Hide all content
	jQuery("ul.tabs li:first").addClass("active").show(); //Activate first tab
	jQuery(".tab_content:first").show(); //Show first tab content
	
	
	//On Click Event
	jQuery("ul.tabs li").click(function() {
		jQuery("ul.tabs li").removeClass("active"); //Remove any "active" class
		jQuery(this).addClass("active"); //Add "active" class to selected tab
		jQuery(".tab_content").hide(); //Hide all tab content
		var activeTab = jQuery(this).find("span").attr("id"); //Find the rel attribute value to identify the active tab + content
		jQuery(activeTab).fadeIn(); //Fade in the active content
		return false;
	});
	
	jQuery('#add_jenislayanan').click(function(){
		var nomr	= jQuery('#NOMR').val();
		var obat			= jQuery('#NAMA_OBAT').val();
		var dosis			= jQuery('#DOSIS').val();
		var aturan			= jQuery('#ATURAN').val();
		var frekuensi			= jQuery('#FREKUENSI').val();
		var tgl			= jQuery('#WAKTU_TGL').val();
		var waktu			= jQuery('#LAMA_WAKTU').val();
		jQuery.post('<?php echo _BASE_;?>kep/save_obat.php',{nomr:nomr,obat:obat,dosis:dosis,aturan:aturan,frekuensi:frekuensi,tgl:tgl,waktu:waktu},function(data){
			jQuery('#validobat').load('<?php echo _BASE_;?>kep/load_obat.php?nomr='+nomr);
		});
		});
		jQuery('#show_jenislayanan').click(function(){
		var nomr	= jQuery('#NOMR').val();
		jQuery('#validobat').load('<?php echo _BASE_;?>kep/load_obat.php?nomr='+nomr);});
	jQuery(".tab_content3").hide(); //Hide all content
	jQuery("ul.tabs3 li:first").addClass("active").show(); //Activate first tab
	jQuery(".tab_content3:first").show(); //Show first tab content
	//On Click Event
	jQuery("ul.tabs3 li").click(function() {
		jQuery("ul.tabs3 li").removeClass("active"); //Remove any "active" class
		jQuery(this).addClass("active"); //Add "active" class to selected tab
		jQuery(".tab_content3").hide(); //Hide all tab content
		var activeTab = jQuery(this).find("span").attr("id"); //Find the rel attribute value to identify the active tab + content
		jQuery(activeTab).fadeIn(); //Fade in the active content
		return false;
	});
	
	/*jQuery('#simpan').click(function(){
		jQuery.post('<?php echo _BASE_;?>lab/save_order_lab.php',jQuery('#order_lab').serialize(),function(data){
			if(!data){
				window.location ='<?php echo _BASE_;?>index.php?link=kajian_kep';
			}
		});
	});*/
});

jQuery('.kdrujuk').click(function(){
		var val = jQuery(this).val();
		if(val != 1){
			jQuery('#keterangan').show();
		}else{
			jQuery('#keterangan').hide();
		}
	});
</script>
<style type="text/css">
ul.tabs {margin: 0;padding: 0;float: left;list-style: none;height: 32px;border-bottom: 1px solid #999;border-left: 1px solid #999;width: 100%;}
ul.tabs li {float: left;margin: 0;padding: 0 3px;height: 31px;line-height: 31px;border: 1px solid #999;border-left: none;margin-bottom: -1px;background: #e0e0e0;overflow: hidden;position: relative;}
ul.tabs li:hover{ background:#FF9; display:block; cursor:pointer;}
ul.tabs li a {text-decoration: none;color: #000;display: block;font-size: 10px;padding: 0 10px;border: 1px solid #fff;outline: none;}
ul.tabs li a:hover {background: #ccc;}	
html ul.tabs li.active, html ul.tabs li.active a:hover  {background: #fff;border-bottom: 1px solid #fff;}
.tab_container {border: 1px solid #999;	border-top: none;clear: both;float: left; width: 100%;background: #fff;	-moz-border-radius-bottomright: 5px;-khtml-border-radius-bottomright: 5px;	-webkit-border-bottom-right-radius: 5px;-moz-border-radius-bottomleft: 5px;	-khtml-border-radius-bottomleft: 5px;	-webkit-border-bottom-left-radius: 5px; padding-top:30px;}
.tab_content {padding: 5px;font-size: 11px; text-align:left;}

ul.tabs3 {margin: 0;padding: 0;float: left;list-style: none;height: 32px;border-bottom: 1px solid #999;border-left: 1px solid #999;width: 100%;}
ul.tabs3 li {float: left;margin: 0;padding: 0 3px;height: 31px;line-height: 31px;border: 1px solid #999;border-left: none;margin-bottom: -1px;background: #e0e0e0;overflow: hidden;position: relative;}
ul.tabs3 li:hover{ background:#FF9; display:block; cursor:pointer;}
ul.tabs3 li a {text-decoration: none;color: #000;display: block;font-size: 10px;padding: 0 10px;border: 1px solid #fff;outline: none;}
ul.tabs3 li a:hover {background: #ccc;}	
html ul.tabs3 li.active, html ul.tabs3 li.active a:hover  {background: #fff;border-bottom: 1px solid #fff;}
.tab_container3 {border: 1px solid #999;	border-top: none;clear: both;float: left; width: 100%;background: #fff;	-moz-border-radius-bottomright: 5px;-khtml-border-radius-bottomright: 5px;	-webkit-border-bottom-right-radius: 5px;-moz-border-radius-bottomleft: 5px;	-khtml-border-radius-bottomleft: 5px;	-webkit-border-bottom-left-radius: 5px; padding-top:5px;}
.tab_content3 {padding: 5px;font-size: 11px; text-align:left;}
.tr_u	{	border:1px solid;
	}
	
		.td_u{border-right:black 1px solid;border-left:black 1px solid; vertical-align:top; font-size:11;}

</style>
<?php
$sql	= mysql_query('select * from m_pasien where NOMR = "'.$_REQUEST['NOMR'].'"');
$datapasien	= mysql_fetch_array($sql);

?>
<div align="center">
    <div id="frame" style="width: 100%;">
        <div id="frame_title"><h3>Pengkajian Keperawatan</h3></div>
        <div align="right" style="margin:5px;">
		<ul class="tabs">
    		
        <li><span id="#101">Data Umum Pasien</span></li>
			
			
        <li><span id="#102">Diagnosa Pasien</span></li>
			
        <li><span id="#103">Perawat Penanggungjawab</span></li>
			
        <li><span id="#104">Status Keperawatan Pasien</span></li>
			
        <li><span id="#105">Status Kesehatan Pasien</span></li>
			
        <li><span id="#106">Riwayat Kesehatan Keluarga</span></li>
			
        <li><span id="#107">Riwayat Tumbuh Kembang</span></li>
			
        <li><span id="#108">Status Fisiologis</span></li>
			
        <li><span id="#109">Psikologis</span></li>
		
    	</ul>
	
	<script>
(function(a){var b=(a.browser.msie?"paste":"input")+".mask",c=window.orientation!=undefined;a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},dataName:"rawMaskFn"},a.fn.extend({caret:function(a,b){if(this.length!=0){if(typeof a=="number"){b=typeof b=="number"?b:a;return this.each(function(){if(this.setSelectionRange)this.setSelectionRange(a,b);else if(this.createTextRange){var c=this.createTextRange();c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select()}})}if(this[0].setSelectionRange)a=this[0].selectionStart,b=this[0].selectionEnd;else if(document.selection&&document.selection.createRange){var c=document.selection.createRange();a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length}return{begin:a,end:b}}},unmask:function(){return this.trigger("unmask")},mask:function(d,e){if(!d&&this.length>0){var f=a(this[0]);return f.data(a.mask.dataName)()}e=a.extend({placeholder:"_",completed:null},e);var g=a.mask.definitions,h=[],i=d.length,j=null,k=d.length;a.each(d.split(""),function(a,b){b=="?"?(k--,i=a):g[b]?(h.push(new RegExp(g[b])),j==null&&(j=h.length-1)):h.push(null)});return this.trigger("unmask").each(function(){function v(a){var b=f.val(),c=-1;for(var d=0,g=0;d<k;d++)if(h[d]){l[d]=e.placeholder;while(g++<b.length){var m=b.charAt(g-1);if(h[d].test(m)){l[d]=m,c=d;break}}if(g>b.length)break}else l[d]==b.charAt(g)&&d!=i&&(g++,c=d);if(!a&&c+1<i)f.val(""),t(0,k);else if(a||c+1>=i)u(),a||f.val(f.val().substring(0,c+1));return i?d:j}function u(){return f.val(l.join("")).val()}function t(a,b){for(var c=a;c<b&&c<k;c++)h[c]&&(l[c]=e.placeholder)}function s(a){var b=a.which,c=f.caret();if(a.ctrlKey||a.altKey||a.metaKey||b<32)return!0;if(b){c.end-c.begin!=0&&(t(c.begin,c.end),p(c.begin,c.end-1));var d=n(c.begin-1);if(d<k){var g=String.fromCharCode(b);if(h[d].test(g)){q(d),l[d]=g,u();var i=n(d);f.caret(i),e.completed&&i>=k&&e.completed.call(f)}}return!1}}function r(a){var b=a.which;if(b==8||b==46||c&&b==127){var d=f.caret(),e=d.begin,g=d.end;g-e==0&&(e=b!=46?o(e):g=n(e-1),g=b==46?n(g):g),t(e,g),p(e,g-1);return!1}if(b==27){f.val(m),f.caret(0,v());return!1}}function q(a){for(var b=a,c=e.placeholder;b<k;b++)if(h[b]){var d=n(b),f=l[b];l[b]=c;if(d<k&&h[d].test(f))c=f;else break}}function p(a,b){if(!(a<0)){for(var c=a,d=n(b);c<k;c++)if(h[c]){if(d<k&&h[c].test(l[d]))l[c]=l[d],l[d]=e.placeholder;else break;d=n(d)}u(),f.caret(Math.max(j,a))}}function o(a){while(--a>=0&&!h[a]);return a}function n(a){while(++a<=k&&!h[a]);return a}var f=a(this),l=a.map(d.split(""),function(a,b){if(a!="?")return g[a]?e.placeholder:a}),m=f.val();f.data(a.mask.dataName,function(){return a.map(l,function(a,b){return h[b]&&a!=e.placeholder?a:null}).join("")}),f.attr("readonly")||f.one("unmask",function(){f.unbind(".mask").removeData(a.mask.dataName)}).bind("focus.mask",function(){m=f.val();var b=v();u();var c=function(){b==d.length?f.caret(0,b):f.caret(b)};(a.browser.msie?c:function(){setTimeout(c,0)})()}).bind("blur.mask",function(){v(),f.val()!=m&&f.change()}).bind("keydown.mask",r).bind("keypress.mask",s).bind(b,function(){setTimeout(function(){f.caret(v(!0))},0)}),v()})}})})(jQuery)

jQuery(document).ready(function(){
		jQuery('#TGLLAHIR').blur(function(){
		var tgl = jQuery(this).val();						  
		if(tgl == ('0000/00/00') || tgl == ('0000-00-00') || tgl == ('00-00-0000') || tgl == ('00/00/0000')  ){
			alert('Tanggal Lahir Tidak Boleh 0000-00-00');
			jQuery(this).val('');
		}
	});
	jQuery('#myform').validate();
	jQuery("#TGLLAHIR").mask("9999/99/99");
});

jQuery(document).ready(function(){
		jQuery('#theDate').blur(function(){
		var tgl = jQuery(this).val();						  
		if(tgl == ('0000/00/00') || tgl == ('0000-00-00') || tgl == ('00-00-0000') || tgl == ('00/00/0000')  ){
			alert('Tanggal Lahir Tidak Boleh 0000-00-00');
			jQuery(this).val('');
		}
	});
	jQuery('#myform').validate();
	jQuery("#theDate").mask("9999/99/99");
});

jQuery(document).ready(function(){
		jQuery('#TGL').blur(function(){
		var tgl = jQuery(this).val();						  
		if(tgl == ('0000/00/00') || tgl == ('0000-00-00') || tgl == ('00-00-0000') || tgl == ('00/00/0000')  ){
			alert('Tanggal Lahir Tidak Boleh 0000-00-00');
			jQuery(this).val('');
		}
	});
	jQuery('#myform').validate();
	jQuery("#TGL").mask("9999/99/99");
});

</script>

        <form id="myform" name="myform" action="./kep/edit_kajian_kep.php" method="post">
        <div class="tab_container">
			<div id="101" class="tab_content">
<table width="80%" border="0" cellspacing="0" class="tb">
            <tr>
              <td>No Rekam Medik</td>
			  <td><?=$datapasien['NOMR']?><input class="text" value="<?=$datapasien['NOMR']?>" type="hidden" name="NOMR" id="NOMR" size="25" ></td>
              <td>Awal daftar</td>
              <td><input class="text" type="text" value="<?=$datapasien['TGLDAFTAR']?>" name="awaldaftar" size="25" id="awaldaftar"/></td>
              <td width="17%" rowspan="14" valign="top"> Jenis Kelamin:<br />
                <input type="radio" name="JENISKELAMIN" value="L" <? if($datapasien['JENISKELAMIN']=="L" || $datapasien['JENISKELAMIN']=="l")echo "Checked";?>/>
                Laki-laki<br />
                <input type="radio" name="JENISKELAMIN" value="P" <? if($datapasien['JENISKELAMIN']=="P")echo "Checked";?>/>
                Perempuan<br />
                <br />
                <br />
                Cara Pembayaran :<br>
				<?$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
				  while($ds = mysql_fetch_array($ss)){
					if($datapasien['KDCARABAYAR'] == $ds['KODE']): $sel = "Checked"; else: $sel = ''; endif;
					echo '<input type="radio" name="KDCARABAYAR" value="'.$ds['KODE'].'" '.$sel.' /> '.$ds['NAMA'].'<br>';
				  }?>
                <input type="hidden" name="TGLREG" value="<?php echo date("Y-m-d"); ?>" size="10" />            
              </td>
            </tr>
            <tr>
          <td>Nama Lengkap Pasien</td>
          <td><input type="text" class="text" value="<?=$datapasien['NAMA']?>"></td>
          <td width="22%" colspan="2">&nbsp;</td>
          </tr>
		  <tr>
          <td>No KTP </td>
          <td><input  class="text" value="<?=$datapasien['NOKTP']?>" type="text" name="NOKTP" size="25" name="NAMA" size="25" id="NAMA"/></td>
          <td colspan="2">&nbsp;</td>
        </tr>
		<tr>
          <td>Tempat Tanggal Lahir</td>
          <td colspan="3">Tempat
            <input type="text" value="<?=$datapasien['TEMPAT']?>" class="text" name="TEMPAT" size="15" />
            <input type="text" class="text required" value="<?=$datapasien['TGLLAHIR']?>" name="TGLLAHIR" size="20" id="TGLLAHIR" onblur="calage(this.value,'umur');"/>
            <a href="javascript:showCal('Calendar1')"><img align="top" src="img/date.png" border="0" /></a> ex : 1999/09/29</td>
          </tr>
		<tr>
          <td>Nama Suami / Orang Tua Pasien</td>
          <td><input class="text" type="text" value="<?=$datapasien['SUAMI_ORTU']?>" name="SUAMI_ORTU" size="25" /></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        
		 <tr>
          <td valign="top">Agama </td>
          <td colspan="4"><input type="radio" name="AGAMA" value="1" <? if($datapasien['AGAMA']=="1")echo "Checked";?> />
            Islam
            <input type="radio" name="AGAMA" value="2" <? if($datapasien['AGAMA']=="2")echo "Checked";?>/>
            Kristen Protestan
            <input type="radio" name="AGAMA" value="3" <? if($datapasien['AGAMA']=="3")echo "Checked";?>/>
            Katholik
            <input type="radio" name="AGAMA" value="4" <? if($datapasien['AGAMA']=="4")echo "Checked";?>/>
            Hindu
            <input type="radio" name="AGAMA" value="5" <? if($datapasien['AGAMA']=="5")echo "Checked";?>/>
            Budha
            <input type="radio" name="AGAMA" value="6" <? if($datapasien['AGAMA']=="6")echo "Checked";?>/>
            Lain - lain </td>
        </tr>
		 <tr>
          <td valign="top">Alamat Pasien</td>
          <td colspan="1"><input name="ALAMAT" type="text" value="<?=$datapasien['ALAMAT']?>" size="45" class="text" /></td>
          <td colspan="2">&nbsp;</td>
        </tr>
		 <tr>
          <td>Pekerjaan Pasien / Orang Tua</td>
          <td><input class="text" type="text" value="<?=$datapasien['PEKERJAAN']?>" name="PEKERJAAN" size="25" /></td>
          <td colspan="2">&nbsp;</td>
        </tr>
		<tr>
          <td>Status Perkawinan</td>
          <td><input type="radio" name="STATUS" value="1" <? if($datapasien['STATUS']=="1")echo "Checked";?>/>
            Belum Kawin
            <input type="radio" name="STATUS" value="2" <? if($datapasien['STATUS']=="2")echo "Checked";?> />
            Kawin
            <input type="radio" name="STATUS" value="3" <? if($datapasien['STATUS']=="3")echo "Checked";?>/>
            Janda / Duda</td>
          <td colspan="2">&nbsp;</td>
        </tr>
	<?php
  $myquery = "SELECT a.nomr, a.noruang, a.nott, b.NAMA, b.ALAMAT, b.JENISKELAMIN, b.TGLLAHIR, c.NAMA AS CARABAYAR, a.id_admission, a.noruang, d.NAMA AS POLY, e.NAMADOKTER, f.kelas, f.nama AS nm_ruang, DATE_FORMAT(TGLLAHIR,'%d/%m/%Y') AS TGLLAHIR1, a.statusbayar
FROM t_admission a
JOIN m_pasien b ON a.nomr=b.NOMR
JOIN m_carabayar c ON a.statusbayar=c.KODE 
JOIN m_poly d ON d.KODE=a.kirimdari 
JOIN m_ruang f ON f.no=a.noruang
JOIN m_dokter e ON a.dokterpengirim=e.KDDOKTER 
WHERE a.NOMR ='".$_GET["NOMR"]."'";
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get);
		$id_admission	= $userdata['id_admission'];
		$nomr			= $userdata['nomr'];
		$noruang		= $userdata['noruang'];
		$kdpoly			= $userdata['kirimdari'];
		$kddokter		= $userdata['dokter_penanggungjawab'];
		$tglreg			= $userdata['TGLREG'];
		$kelas			= $userdata['kelas'];
		$masukrs		= $userdata['masukrs'];
		$jk				= $userdata['JENISKELAMIN'];
?>
		<tr>
		<td>Ruang Rawat</td>
		<td><input type="text" value="<?php echo $userdata['nm_ruang'];?>"></td>
		</tr>
      </table>
		</div>
									
			<div id="102" class="tab_content">
				<fieldset class="fieldset">
            <table width="317" border="0" cellspacing="0" class="tb">
                <tr><td width="80">No RM :</td><td width="233"><?=$_GET['NOMR']?></td></tr>
                <tr><td>Nama :</td><td><?=$_GET['nama']?></td></tr>
            </table>
			</fieldset>
			<?php
           $page=1;
				$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=pengkajian_kep&");
				$rs = $pager->paginate();?>
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr align="center">
                        <th width="5%">NO</th>
                        <th width="10%">Tanggal</th>
                        <th width="15%">Poli / UGD</th>
                        <th width="22%">Diagnosa</th>
                        <th width="21%">Tindakan</th>
                        <th width="13%">Dokter</th>
                        <th width="13%">Cara Bayar</th>
                    </tr>
                <?    $sql = "SELECT
			  t_diagnosadanterapi.IDXTERAPI,
			  t_diagnosadanterapi.IDXDAFTAR,
			  t_diagnosadanterapi.NOMR,
			  t_diagnosadanterapi.TANGGAL,
			  t_diagnosadanterapi.DIAGNOSA,
			  t_diagnosadanterapi.TERAPI,
			  t_diagnosadanterapi.KDPOLY,
			  t_diagnosadanterapi.KDDOKTER,
			  m_poly.nama AS NAMAPOLY,
			  m_dokter.NAMADOKTER,
                          m_carabayar.NAMA AS CARABAYAR
			FROM
			  t_diagnosadanterapi
			  INNER JOIN m_poly ON (t_diagnosadanterapi.KDPOLY = m_poly.kode)
			  INNER JOIN m_dokter ON (t_diagnosadanterapi.KDDOKTER = m_dokter.KDDOKTER)
                          INNER JOIN t_pendaftaran ON (t_diagnosadanterapi.IDXDAFTAR = t_pendaftaran.IDXDAFTAR)
                          INNER JOIN m_carabayar ON (m_carabayar.KODE = t_pendaftaran.KDCARABAYAR)
			WHERE t_diagnosadanterapi.NOMR ='".$_GET['NOMR']."' ORDER BY t_diagnosadanterapi.IDXTERAPI";
                $sqlcounter = "SELECT
			  count(t_diagnosadanterapi.IDXTERAPI)
			FROM
			  t_diagnosadanterapi
			  INNER JOIN m_poly ON (t_diagnosadanterapi.KDPOLY = m_poly.kode)
			  INNER JOIN m_dokter ON (t_diagnosadanterapi.KDDOKTER = m_dokter.KDDOKTER)
                          INNER JOIN t_pendaftaran ON (t_diagnosadanterapi.IDXDAFTAR = t_pendaftaran.IDXDAFTAR)
                          INNER JOIN m_carabayar ON (m_carabayar.KODE = t_pendaftaran.KDCARABAYAR)
			WHERE t_diagnosadanterapi.NOMR ='".$_GET['NOMR']."' ORDER BY t_diagnosadanterapi.IDXTERAPI";
			

                    $pager->PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "","index.php?link=kajian_kep&");
                    //The paginate() function returns a mysql result set
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
					$NO = 0;
                    while($data = mysql_fetch_array($rs)) {?>
                    <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
                        <td><? $NO=($NO+1);
                                if (isset($_GET['page'])==0) {
                                    $hal=0;
                                }else {
                                    $hal=isset($_GET['page'])-1;
                                } echo
					($hal*15)+$NO;?></td>
                        <td align='center'><? echo $data['TANGGAL']; ?></td>
                        <td><? echo $data['NAMAPOLY']; ?></td>
                        <td><? echo $data['DIAGNOSA']; ?></td>
                        <td><? echo $data['TERAPI']; ?></td>

                        <td align='center'><? echo $data['NAMADOKTER']; ?></td>
                        <td align='center'><? echo $data['CARABAYAR']; ?></td>
                    </tr>
                        <?	}

                    //Display the full navigation in one go
                    //echo $pager->renderFullNav();

                    //Or you can display the inidividual links
                    echo "<div style='padding:5px;' align=\"center\"><br />";

                    //Display the link to first page: First
                    echo $pager->renderFirst()." | ";

                    //Display the link to previous page: <<
                    echo $pager->renderPrev()." | ";

                    //Display page links: 1 2 3
                    echo $pager->renderNav()." | ";

                    //Display the link to next page: >>
                    echo $pager->renderNext()." | ";

                    //Display the link to last page: Last
                    echo $pager->renderLast();

                    echo "</div>";
                    ?>

                </table>

                <?php

                //Display the full navigation in one go
                //echo $pager->renderFullNav();

                //Or you can display the inidividual links
                echo "<div style='padding:5px;' align=\"center\"><br />";

                //Display the link to first page: First
                echo $pager->renderFirst()." | ";

                //Display the link to previous page: <<
                echo $pager->renderPrev()." | ";

                //Display page links: 1 2 3
                echo $pager->renderNav()." | ";

                //Display the link to next page: >>
                echo $pager->renderNext()." | ";

                //Display the link to last page: Last
                echo $pager->renderLast();

                echo "</div>";
                ?>
            
			</div>
			
			
			<div id="103" class="tab_content">
			<fieldset class="fieldset">
            <table width="317" border="0" cellspacing="0" class="tb">
                <tr><td width="80">No RM :</td><td width="233"><?=$_GET['NOMR']?></td></tr>
                <tr><td>Nama :</td><td><?=$_GET['nama']?></td></tr>
            </table>
			</fieldset>
			<br>
			
			 <div id="table_search">
                <table class="tb" width="30%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                   
                    <?
                    $sql = "SELECT
			  t_admission.masukrs,
			  t_admission.keluarrs,
			  t_admission.icd_keluar,
			  m_ruang.nama AS namaruang,
			  m_perawat.NAMA,
			  (select icd.jenis_penyakit from icd
			  where icd.icd_code = t_admission.icd_keluar) as jenis_penyakit,
                           m_carabayar.NAMA AS CARABAYAR
			FROM
			  t_admission
			  INNER JOIN m_perawat ON (t_admission.PERAWAT = m_perawat.IDPERAWAT)
			  INNER JOIN m_ruang ON (t_admission.noruang = m_ruang.`no`)
                          INNER JOIN m_carabayar ON (m_carabayar.KODE = t_admission.statusbayar)
			WHERE t_admission.nomr ='".$_GET['NOMR']."'";
			
			$sqlcounter = "SELECT
			  count(t_admission.masukrs)
			FROM
			  t_admission
			  INNER JOIN m_perawat ON (t_admission.PERAWAT = m_perawat.IDPERAWAT)
			  INNER JOIN m_ruang ON (t_admission.noruang = m_ruang.`no`)
                          INNER JOIN m_carabayar ON (m_carabayar.KODE = t_admission.statusbayar)
			WHERE t_admission.nomr ='".$_GET['NOMR']."'";

                    $NO=0;
                    $pager = new PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "","index.php?link=pengkajian_kep&");
                    //The paginate() function returns a mysql result set
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
                    $data = mysql_fetch_array($rs); ?>
                    <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
                        <td>Nama Perawat</td>
                        <td><?php echo $data['NAMA']; ?></td>
                    </tr>
                </table>

            </div>
					</div>
		
		<?php
		$nomr=$_GET['NOMR'];
		$query ="SELECT DIAGNOSA AS diag FROM t_diagnosadanterapi WHERE NOMR=$nomr";
		$qry = mysql_query($query); 
		$rsl = mysql_fetch_array($qry); 
		$h=mysql_num_rows($qry);
		
		?> 
		 
		<div id="104" class="tab_content">
		<fieldset class="fieldset">
            <table width="317" border="0" cellspacing="0" class="tb">
                <tr><td width="80">No RM :</td><td width="233"><?=$_GET['NOMR']?></td></tr>
                <tr><td>Nama :</td><td><?=$_GET['nama']?></td></tr>
            </table>
			</fieldset>
			
			<fieldset class="fieldset">
			<table width="80%" border="0" cellspacing="0" class="tb">
            <tr>
              <td>Keluhan utama</td>
              <td><input type="text" name="KELUHANUTAMA" id="KELUHANUTAMA" value="<?php echo $rsl['diag'];?>"/></td>
			  </tr>
		<?php
		 $sql= mysql_query('SELECT a.* FROM t_pendaftaran a where a.NOMR = "'.$_REQUEST['NOMR'].'" and tglreg = (select max(tglreg) from t_pendaftaran where nomr = "'.$_REQUEST['NOMR'].'")');
		$data = mysql_fetch_array($sql);
		?>
			<tr>
              <td>Alasan Masuk RS</td>
              <td colspan="2"><div align="left">
          <input type="radio" id="asal1" name="KDRUJUK" class="kdrujuk" value="1" <? if($data['KDRUJUK']=="1")echo "Checked";?>/> Datang Sendiri
          <input type="radio" id="asal2" name="KDRUJUK" class="kdrujuk" value="2" <? if($data['KDRUJUK']=="2") echo "Checked";?>/> Puskesmas
          <input type="radio" id="asal3" name="KDRUJUK" class="kdrujuk" value="3" <? if($data['KDRUJUK']=="3") echo "Checked";?>/> Rumah Sakit lain
          <input type="radio" id="asal4" name="KDRUJUK" class="kdrujuk" value="4" <? if($data['KDRUJUK']=="4") echo "Checked";?>/> Lain-Lain &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          
          <?php 
		  	if($userdata['KETRUJUK'] != ''):
          	echo '<span style="text-align:right;" id="keterangan"><input type="text" name="KETRUJUK" value="'.$data['KETRUJUK'].'"></span>';
			else:
			echo '<span style="text-align:right;" id="keterangan"></span>';
			endif;
		  ?>
          
        </div></td>
            </tr>
			</table>
			</fieldset>
			</div>
			
			<div id="105" class="tab_content">
			<table width="317" border="0" cellspacing="0" class="tb">
                <tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['NOMR']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>

                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr align="center">
                        <th width="5%">No</th>
                        <th width="15%">Tgl Masuk</th>
                        <th width="15%">Tgl Keluar</th>
                        <th width="15%">Ruang/ Kelas Rawat</th>
                        <th width="15%">Dokter Yg Merawat</th>

                        <th width="20%">Diagnosa</th>
                        <th width="10%">Cara Bayar</th>
                    </tr>
                    <?
                    $sql = "SELECT
			  t_admission.masukrs,
			  t_admission.keluarrs,
			  t_admission.icd_keluar,
			  m_ruang.nama AS namaruang,
			  m_dokter.NAMADOKTER,
			  (select icd.jenis_penyakit from icd
			  where icd.icd_code = t_admission.icd_keluar) as jenis_penyakit,
                           m_carabayar.NAMA AS CARABAYAR
			FROM
			  t_admission
			  INNER JOIN m_dokter ON (t_admission.dokterpengirim = m_dokter.KDDOKTER)
			  INNER JOIN m_ruang ON (t_admission.noruang = m_ruang.`no`)
                          INNER JOIN m_carabayar ON (m_carabayar.KODE = t_admission.statusbayar)
			WHERE t_admission.nomr ='".$_GET['NOMR']."'";
			
			$sqlcounter = "SELECT
			  count(t_admission.masukrs)
			FROM
			  t_admission
			  INNER JOIN m_dokter ON (t_admission.dokterpengirim = m_dokter.KDDOKTER)
			  INNER JOIN m_ruang ON (t_admission.noruang = m_ruang.`no`)
                          INNER JOIN m_carabayar ON (m_carabayar.KODE = t_admission.statusbayar)
			WHERE t_admission.nomr ='".$_GET['NOMR']."'";

                    $NO=0;
                    $pager = new PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "","index.php?link=pengkajian_kep&");
                    //The paginate() function returns a mysql result set
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
                    while($data = mysql_fetch_array($rs)) {?>
                    <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
                        <td><? $NO=($NO+1);
                                if ($_GET['page']==0) {
                                    $hal=0;
                                }else {
                                    $hal=$_GET['page']-1;
                                } echo
					($hal*15)+$NO;?></td>
                        <td><? echo $data['masukrs']; ?></td>
                        <td><? echo $data['keluarrs']; ?></td>
                        <td><? echo $data['namaruang']; ?></td>
                        <td><? echo $data['NAMADOKTER']; ?></td>

                        <td><? echo $data['jenis_penyakit']; ?></td>
                        <td><? echo $data['CARABAYAR']; ?></td>
                    </tr>
                        <?	}

                    //Display the full navigation in one go
                    //echo $pager->renderFullNav();

                    //Or you can display the inidividual links
                    echo "<div style='padding:5px;' align=\"center\"><br />";

                    //Display the link to first page: First
                    echo $pager->renderFirst()." | ";

                    //Display the link to previous page: <<
                    echo $pager->renderPrev()." | ";

                    //Display page links: 1 2 3
                    echo $pager->renderNav()." | ";

                    //Display the link to next page: >>
                    echo $pager->renderNext()." | ";

                    //Display the link to last page: Last
                    echo $pager->renderLast();

                    echo "</div>";
?>

                </table>

                <?php

                //Display the full navigation in one go
                //echo $pager->renderFullNav();

                //Or you can display the inidividual links
                echo "<div style='padding:5px;' align=\"center\"><br />";

                //Display the link to first page: First
                echo $pager->renderFirst()." | ";

                //Display the link to previous page: <<
                echo $pager->renderPrev()." | ";

                //Display page links: 1 2 3
                echo $pager->renderNav()." | ";

                //Display the link to next page: >>
                echo $pager->renderNext()." | ";

                //Display the link to last page: Last
                echo $pager->renderLast();

                echo "</div>";
?>

	<fieldset class="fieldset"><legend>Riwayat pengobatan</legend>
	<table width="100%" align="center" border="0" cellspacing="0" class="tb">
            <tr>
              <td>Nama Obat</td>
              <td><input class="text" size="25" type="text" value="<?=$datapasien['NAMA_OBAT']?>" name="NAMA_OBAT" id="NAMA_OBAT"/>&nbsp;<input type="button" name="add" value="add" id="add_jenislayanan" class="text" /></td>
			  <td rowspan="6" width="40%" valign="top">&nbsp;<input type="button" name="show" value="show" id="show_jenislayanan" class="text" /><br><div id="validobat" ></div></td>
			  </tr>
			
			<tr>
			<? $dosis = split("",$val[$i]);?>
              <td>Dosis</td>
              <td><input class="text" size="25" type="text" name="DOSIS" id="DOSIS" value="<?=$datapasien['DOSIS']?>"/></td>
			  </tr>
	       <tr>
		   <? $aturan = split("",$val[$i]);?>
              <td>Cara Pemberian</td>
              <td><input class="text" size="25" type="text" name="ATURAN" id="ATURAN" value="<?=$datapasien['CARA_PEMBERIAN']?>"/></td>
			  </tr>
	        <tr>
			<? $frekuensi = split("",$val[$i]);?>
              <td>Frekuensi</td>
              <td><input class="text" size="25" type="text" name="FREKUENSI" id="FREKUENSI" value="<?=$datapasien['FREKUENSI']?>"/></td>
			  
			  <td colspan='3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			  
			  </tr>
			<tr>
			<? $WAKTU_TGL = split("",$val[$i]);?>
              <td>Waktu & tanggal terakhir makan obat</td>
              <td><input class="text" size="25" type="text" name="WAKTU_TGL" id="WAKTU_TGL" value="<?=$datapasien['WAKTU_TGL']?>"/></td>
            <!--<a href="javascript:showCal('Calendar_')"><img align="top" src="img/date.png" border="0" /></a> ex : 1999/09/29 -->
			  </tr>
			<tr>
			<? $lama = split("",$val[$i]);?>
              <td>Lama menggunakan obat</td>
              <td><input class="text" size="25" type="text" name="LAMA_WAKTU" id="LAMA_WAKTU" value="<?=$datapasien['LAMA_WAKTU']?>"/></td>
			  </tr>
			  </table>
			  </fieldset>
			  
			  <fieldset class="fieldset"><legend>Riwayat alergi</legend>
			<table width="80%" align="center" border="0" cellspacing="0" class="tb">
			  <tr>
			  <td valign='top' rowspan='2'>Alergi obat</td>
			 <?$val_1 = split(",",$datapasien['ALERGI_OBAT']); $i = 0;?>
			 <td><input type="checkbox" name="ALERGI_OBAT[]" value="_1_" <? if($val_1[$i]=="_1_"){echo "Checked"; $i++;}?> />  Jenis/nama obat&nbsp;&nbsp;&nbsp;|&nbsp;Nama Obat :&nbsp;<input class="text" size="25" type="text" name="nama_obat2" id="nama_obat2" value="<?=$datapasien['NAMA_OBAT2']?>"/></td></tr>
			  <tr>
			  <td>&nbsp;</td>
			  </tr>

			  <tr>
			  <td rowspan='6' valign='top'>Lain-lain</td>
			  <td><input type="checkbox" name="ALERGI_OBAT[]" value="_2_" <? if($val_1[$i]=="_2_"){echo "Checked"; $i++;}?> > Sabun</td></tr>
			  <tr>
			  <td><input type="checkbox" name="ALERGI_OBAT[]" value="_3_" <? if($val_1[$i]=="_3_"){echo "Checked"; $i++;}?>> Debu</td></tr>
			  <tr>
			  <td><input type="checkbox" name="ALERGI_OBAT[]" value="_4_" <? if($val_1[$i]=="_4_"){echo "Checked"; $i++;}?>> Udara</td></tr>
			  <tr>
			  <td><input type="checkbox" name="ALERGI_OBAT[]" value="_M_" <? if(substr($val_1[$i],0,3)=="_M_"){echo "Checked"; $val9 = split("_M_",$val_1[$i]); $i++;}?> />
			  Makanan <input type="text" value= "<?=$val9[1]?>" name="ALERGI_MAKAN" id="ALERGI_MAKAN"></td></tr>
			  
			  <tr>
			  <td><input type="checkbox" name="ALERGI_OBAT[]" value="_L_" <? if(substr($val_1[$i],0,3)=="_L_"){echo "Checked"; $vol_1 = split("_L_",$val_1[$i]); $i++;}?> />
			  Lain-lain <input type="text" value="<?=$vol_1[1]?>" name="lainALERGI" id="lainALERGI"></td></tr>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			</tr>
			
			  <tr>
			  <td rowspan='5' valign='top'>Reaksi yang timbul</td>
			  <?$val_2 = split(",",$datapasien['REAKSI_ALERGI']); $i = 0;?>
			  <td><input type="checkbox" name="REAKSI_ALERGI[]" value="_1_" <? if($val_2[$i]=="_1_"){echo "Checked"; $i++;} ?>> Kulit kemerahan/rash</td></tr>
			  <tr>
			  <td><input type="checkbox" name="REAKSI_ALERGI[]" value="_2_" <? if($val_2[$i]=="_2_"){echo "Checked"; $i++;} ?>> Gatal</td></tr>
			  </tr>
			  <tr>
			  <td><input type="checkbox" name="REAKSI_ALERGI[]" value="_3_" <? if($val_2[$i]=="_3_"){echo "Checked"; $i++;} ?>> Sesak napas</td></tr>
			  <tr>
			  <td><input type="checkbox" name="REAKSI_ALERGI[]" value="_4_" <? if($val_2[$i]=="_4_"){echo "Checked"; $i++;} ?>> Lesi</td></tr>
			  <tr>
			  <td><input type="checkbox" name="REAKSI_ALERGI[]" value="_L_" <? if(substr($val_2[$i],0,3)=="_L_"){echo "Checked"; $vol_2 = split("_L_",$val_2[$i]); $i++;}?> />
			  Lain-lain <input type="text" value="<?=$vol_2[1]?>" name="lainREAKSI" id="lainREAKSI"></td>
			  </tr>
			  </table>
			  </fieldset>
				</div>
			
			<div id="106" class="tab_content">
			<fieldset class="fieldset">
	  <table width="317" border="0" cellspacing="0" class="tb">
                <tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['NOMR']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>
			</fieldset>
			
<fieldset class="fieldset"><legend>Riwayat Kesehatan Keluarga</legend>
<table width="100%" align="center" border="0" cellspacing="0" class="tb">
            <tr>
              <td width="10%" rowspan='9' valign='top'>Riwayat kesehatan</td>
			  <?$val_3 = split(",",$datapasien['RIWAYAT_KES']); $i = 0;?>
			  <td><input type="checkbox" name="RIWAYAT_KES[]" value="_1_" <? if($val_3[$i]=="_1_"){echo "Checked"; $i++;} ?>> DM</td>
			</tr>
			
			<tr>
             <td><input type="checkbox" name="RIWAYAT_KES[]" value="_2_" <? if($val_3[$i]=="_2_"){echo "Checked"; $i++;} ?>> Jantung</td>
			  </tr>
	       <tr>
         	  <td><input type="checkbox" name="RIWAYAT_KES[]" value="_3_" <? if($val_3[$i]=="_3_"){echo "Checked"; $i++;} ?>> Hipertensi</td>
			  </tr>
	        <tr>
              <td><input type="checkbox" name="RIWAYAT_KES[]" value="_4_" <? if($val_3[$i]=="_4_"){echo "Checked"; $i++;} ?>> Hepatitis</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="RIWAYAT_KES[]" value="_5_" <? if($val_3[$i]=="_5_"){echo "Checked"; $i++;} ?>> Asma</td>
			  </tr>
			<tr>
    		  <td><input type="checkbox" name="RIWAYAT_KES[]" value="_6_" <? if($val_3[$i]=="_6_"){echo "Checked"; $i++;} ?>> TBC</td>
			  </tr>
			<tr>
    		  <td><input type="checkbox" name="RIWAYAT_KES[]" value="_7_" <? if($val_3[$i]=="_7_"){echo "Checked"; $i++;} ?>> Cancer</td>
			  </tr>
			<tr>
    		  <td><input type="checkbox" name="RIWAYAT_KES[]" value="_8_" <? if($val_3[$i]=="_8_"){echo "Checked"; $i++;} ?>> Congenital</td>
			  </tr>
			<tr>
			<td><input type="checkbox" name="RIWAYAT_KES[]" value="_L_" <? if(substr($val_3[$i],0,3)=="_L_"){echo "Checked"; $vol_3 = split("_L_",$val_3[$i]); $i++;}?> />
			  Lain-lain <input type="text" value="<?=$vol_3[1]?>" name="lainRIWAYAT" id="lainRIWAYAT"></td>
			  </tr>
			  </table>
			  </fieldset>
			</div>
			
			<div id="107" class="tab_content">
			<fieldset class="fieldset">
	  <table width="317" border="0" cellspacing="0" class="tb">
                <tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['NOMR']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>
			</fieldset>
			
<fieldset class="fieldset"><legend>Tumbuh Kembang</legend>
<table width="65%" align="center" border="0" cellspacing="0" class="tb">
            <tr>
              <td>Berat Badan Lahir</td>
			  <td><input type="text" name="BB_LAHIR" id="BB_LAHIR" value="<?=$datapasien['BB_LAHIR']?>"> Gram</td>
			  
			</tr>
			<tr>
             <td valign='top'>Berat Badan Sekarang</td>
			  <td><input type="text" name="BB_SEKARANG" id="BB_SEKARANG" value="<?=$datapasien['BB_SEKARANG']?>"> Gram/kg</td>
			  
			  </tr>
	       <tr>
			<td valign='top'>Perkembangan Fisik</td>
			<td>:</td>
			</tr>
			<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fontanel</td>
			<td align="left"><input type="text" name="FISIK_FONTANEL" id="FISIK_FONTANEL" value="<?=$datapasien['FISIK_FONTANEL']?>"></td>
			</tr>
			<tr>
			
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Refleks</td>
			<td><input type="text" name="FISIK_REFLEKS" id="FISIK_REFLEKS" value="<?=$datapasien['FISIK_REFLEKS']?>"></td>
			</tr>
			<tr>
			
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sensasi</td>
			<td><input type="text" name="FISIK_SENSASI" id="FISIK_SENSASI" value="<?=$datapasien['FISIK_SENSASI']?>"></td>
			  </tr>
			<tr>
				
			</tr>
	         <tr>
			<td valign='top'>Kemampuan Motorik</td>
			<td>:</td>
			</tr>
			<tr>
			
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kasar</td>
			<td><input type="text" name="MOTORIK_KASAR" id="MOTORIK_KASAR" value="<?=$datapasien['MOTORIK_KASAR']?>"></td>
				</tr>
			<tr>
			
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Halus</td>
			<td><input type="text" name="MOTORIK_HALUS" id="MOTORIK_HALUS" value="<?=$datapasien['MOTORIK_HALUS']?>"></td>
			</tr>
			<tr>
				<td>Kemampuan Bicara & Bahasa</td>
				<td><input type="text" name="MAMPU_BICARA" id="MAMPU_BICARA" value="<?=$datapasien['MAMPU_BICARA']?>"></td>
			</tr>
			<tr>
				<td>Kemampuan Sosialisasi & Kemandirian</td>
			<td><input type="text" name="MAMPU_SOSIALISASI" id="MAMPU_SOSIALISASI" value="<?=$datapasien['MAMPU_SOSIALISASI']?>"></td>
			</tr>
			  </table>
			  </fieldset>
			  
	<fieldset class="fieldset"><legend>Status Imunisasi</legend>
<table width="65%" align="center" border="0" cellspacing="0" class="tb">
            <tr>
              <td>BCG</td>
			  <td><input type="text" name="BCG" id="BCG" value="<?=$datapasien['BCG']?>"></td>
			</tr>
			<tr>
             <td valign='top'>&nbsp;&nbsp;&nbsp;&nbsp;Polio</td>
			  <td><input type="text" name="POLIO" id="POLIO" value="<?=$datapasien['POLIO']?>"></td>
			</tr>
			<tr>
              <td>DPT</td>
			  <td><input type="text" name="DPT" id="DPT" value="<?=$datapasien['DPT']?>"></td>
			</tr>
			<tr>
              <td>Campak</td>
			 <td><input type="text" name="CAMPAK" id="CAMPAK" value="<?=$datapasien['CAMPAK']?>"></td>
			</tr>
			<tr>
              <td>Hepatitis B</td>
			  <td><input type="text" name="HEPATITIS" id="HEPATITIS" value="<?=$datapasien['HEPATITIS_B']?>"></td>
			</tr>
			</table>
			</fieldset>
			  </div>
			  
			  
			<div id="108" class="tab_content">
			<fieldset class="fieldset">
	  <table width="317" border="0" cellspacing="0" class="tb">
                <tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['NOMR']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>
		</fieldset>
            <div id="table_search">
                <table width="100%" border="0" cellspacing="0" cellspading="0" class="tb">
                    <tr align="center">
                        <th width="5%">NO</th>
                        <th width="5%">TANGGAL</th>
                        <th width="5%">NOMR</th>
                        <th width="8%">NAMA</th>
                        <th width="2%">L/P</th>
                        <th width="5%">UMUR</th>
                        <th width="11%">KECAMATAN</th>
                        <th width="7%">KOTA</th>
                        <th width="10%">DIAGNOSA</th>
                        <th width="9%">TINDAKAN </th>
                        <th width="8%">CARABAYAR</th>
                        <th width="5%">DOKTER</th>                        
                        <th width="5%">KELUAR</th>
                        <th width="8%">PE<br />NGUN<br />JUNG</th>
                        <th width="6%">KUN<br />JU<br />NGAN</th>
                        <th width="8%">KA<br />SUS</th>
                        <th width="8%">RUJUKAN</th>
                        <th width="8%">KET RUJUKAN</th>
                        <th width="8%">ICD X</th>
                    </tr>
                    <?
                    $sql = "SELECT a.nomr,b.nama,b.TGLLAHIR, b.jeniskelamin, b.kota, 
(select namakecamatan from m_kecamatan where idkecamatan = b.kdkecamatan) AS kdkecamatan, 
a.diagnosa,a.terapi, 
(select nama from m_carabayar where kode = c.kdcarabayar) AS kdcarabayar, 
CASE c.pasienbaru 
WHEN 0 THEN 'L' ELSE 'B' END AS pasienbaru, 
d.keterangan AS kdtujuanrujuk, dr.namadokter, 
CASE c.pasienbaru 
WHEN 0 THEN 'L' ELSE 'B' END AS pasienbaru, 
CASE a.kunjungan_bl 
WHEN 0 THEN 'L' ELSE 'B' END AS kunjungan_bl, 
CASE a.kasus_bl 
WHEN 0 THEN 'L' ELSE 'B' END AS kasus_bl, 
a.icd_code, k.NAMA AS RUJUKAN, c.KETRUJUK
FROM t_diagnosadanterapi a 
INNER JOIN m_dokter dr ON dr.kddokter=a.kddokter 
INNER JOIN m_pasien b ON a.nomr=b.nomr 
INNER JOIN t_pendaftaran c ON a.idxdaftar=c.idxdaftar 
LEFT JOIN m_statuskeluar d ON c.status=d.status
LEFT JOIN m_rujukan k ON k.KODE = c.KDRUJUK
where a.nomr='".$_GET['NOMR']."' ";

  $sqlcounter = "select count(a.nomr) from t_diagnosadanterapi a
inner join m_dokter dr on dr.kddokter=a.kddokter
inner join m_pasien b on a.nomr=b.nomr
inner join t_pendaftaran c on a.idxdaftar=c.idxdaftar
left join m_statuskeluar d on c.status=d.status
where a.nomr='".$_GET['NOMR']."' ";

           $pager = new PS_Pagination($connect, $sql, $sqlcounter, 5, "", "index.php?link=pengkajian_kep&");
                    //The paginate() function returns a mysql result set
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
                    while($data = mysql_fetch_array($rs)) {?>
                    <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
                        <td><? $NO=($NO+1);
                                if ($_GET['page']==0) {
                                    $hal=0;
                                }else {
                                    $hal=$_GET['page']-1;
                                } echo

				($hal*15)+$NO;?></td>
                        <td><? echo $data['tanggal'];?></td>
                        <td><strong><? echo $data['nomr'];?></strong></td>
                        <td align="center"><? echo $data['nama'];?> </td>
                        <td align="center"><? echo $data['jeniskelamin']; ?> </td>
                            <?php
                            if ($data['TGLLAHIR']=="") {
                                $a = datediff(date("Y/m/d"), date("Y/m/d"));
                            }
                            else {
                                $a = datediff($data['TGLLAHIR'],date("Y-m-d"));
                            }
							/* if ($m_pasien->TGLLAHIR==""){
			  $a = datediff(date("Y/m/d"), date("Y/m/d"));
		  }
		  else {
			   $a = datediff($m_pasien->TGLLAHIR, date("Y/m/d"));
		  }*/
    ?>
                        <td align="center"><?php echo 'umur '.$a[years].' tahun '.$a[months].' bulan '.$a[days].' hari'; ?></td>
                        <td align="center"><? echo $data['kdkecamatan']; ?> </td>
                        <td align="center"><? echo $data['kota']; ?> </td>
                        <td align="center"><? echo $data['diagnosa'];?> </td>
                        <td align="center"><? echo $data['terapi'];?> </td>
                        <td align="center"><? echo $data['kdcarabayar'];?> </td>
                        <td width="8%" align="center"><? echo $data['namadokter'];?> </td>                        
                        <td width="5%" align="center"><? echo $data['kdtujuanrujuk'];?> </td>
                        <td width="8%" align="center"><? echo $data['pasienbaru'];?> </td>
                        <td width="6%" align="center"><? echo $data['kunjungan_bl'];?> </td>
                        <td width="8%" align="center"><? echo $data['kasus_bl'];?> </td>
                        <td width="8%" align="left"><? echo $data['RUJUKAN'];?> </td>
                        <td width="8%" align="left"><? echo $data['KETRUJUKAN'];?> </td>
                        <td align="center"><? echo $data['icd_code'];?> </td>
                    </tr>
                        <?	}

                    //Display the full navigation in one go
                    //echo $pager->renderFullNav();

                    //Or you can display the inidividual links
                    echo "<div style='padding:5px;' align=\"center\"><br />";

                    //Display the link to first page: First
                    echo $pager->renderFirst()." | ";

                    //Display the link to previous page: <<
                    echo $pager->renderPrev()." | ";

                    //Display page links: 1 2 3
                    echo $pager->renderNav()." | ";

                    //Display the link to next page: >>
                    echo $pager->renderNext()." | ";

                    //Display the link to last page: Last
                    echo $pager->renderLast();

                    echo "</div>";
?>

                </table>

                <?php

                //Display the full navigation in one go
                //echo $pager->renderFullNav();

                //Or you can display the inidividual links
                echo "<div style='padding:5px;' align=\"center\"><br />";

                //Display the link to first page: First
                echo $pager->renderFirst()." | ";

                //Display the link to previous page: <<
                echo $pager->renderPrev()." | ";

                //Display page links: 1 2 3
                echo $pager->renderNav()." | ";

                //Display the link to next page: >>
                echo $pager->renderNext()." | ";

                //Display the link to last page: Last
                echo $pager->renderLast();

                echo "</div>";
?>
       </div>
   
    <br />
    <?
    $qry_excel = "select a.tanggal AS TGL_DAFTAR,
    a.nomr AS NORM,
					b.nama AS NAMA_PASIEN,
					b.TGLLAHIR AS TGL_LAHIR, 
					b.jeniskelamin AS JNS_KELAMIN,
					(select namakecamatan from m_kecamatan where idkecamatan = b.kdkecamatan) AS ALAMAT_KECAMATAN,
					b.kota AS KOTA,
       				a.diagnosa AS DIAGNOSA,
					a.terapi AS TERAPI,
       				(select nama from m_carabayar where kode = c.kdcarabayar) AS STATUS_BAYAR,
					d.keterangan AS KET_KELUAR,
					dr.namadokter,
					case a.kunjungan_bl when 0 then 'L' else 'B' end AS PENGUNJUNG,
       				case c.pasienbaru when 0 then 'L' else 'B' end AS PASIEN_BARU_LAMA,
              		case a.kasus_bl when 0 then  'L' else 'B' end as KASUS_BARU_LAMA, 
					a.icd_code AS ICD_X 
				from t_diagnosadanterapi a
				inner join m_dokter dr on dr.kddokter=a.kddokter
				inner join m_pasien b on a.nomr=b.nomr 
				inner join t_pendaftaran c on a.idxdaftar=c.idxdaftar  
				left join m_statuskeluar d on c.status=d.status
				where a.kdpoly='$kdpoly' ".$search;
?>
	 
	<fieldset class="fieldset"><legend>Head to toe</legend>
<table width="100%" align="left" border="0" cellspacing="0" class="tb">
            <tr>
              <td>TD</td>
			  <td><input type="text" name="TD" id="TD" value="<?=$datapasien['TD']?>"> mmHG</td>
			</tr>
			<tr>
             <td valign='top'>Suhu</td>
			  <td><input type="text" name="SUHU" id="SUHU" value="<?=$datapasien['SUHU']?>"> °C</td>
			</tr>
			<tr>
             <td valign='top'>RR</td>
			  <td><input type="text" name="RR" id="RR" value="<?=$datapasien['RR']?>"> x/mt</td>
			</tr>
			<tr>
             <td valign='top'>Nadi</td>
			  <td><input type="text" name="NADI" id="NADI" value="<?=$datapasien['NADI']?>"> x/mnt</td>
			</tr>
			<tr>
             <td valign='top'>BB</td>
			  <td><input type="text" name="BB" id="BB" value="<?=$datapasien['BB']?>"> Kg</td>
			</tr>
			<tr>
             <td valign='top'>TB</td>
			  <td><input type="text" name="TB" id="TB" value="<?=$datapasien['TB']?>"> cm</td>
			</tr>
			
			<tr>
				<td colspan='2'>&nbsp;</td>
				</tr>
			<tr>
				<td rowspan="6" valign='top'>GCS</td>
				<td>:</td>
			</tr>
			
<script type='text/javascript'>
	function totalise() {    
    var qtd   = document.getElementById('eye').value;
    var price  = document.getElementById('motorik').value;
	var verb  = document.getElementById('verbal').value;
    var result = document.getElementById('total');
    result.value= parseInt(qtd)+parseInt(price)+parseInt(verb);
}
</script>
			<tr>
				<td align="left" width="27%">Eye</td>
				<td><select name="eye" id="eye" onChange="totalise()">
				<!--	<option value=""> -- pilih --</option>-->
					<option name="eye" value="0" <? if($datapasien['EYE']=="0") echo "selected=Selected";?>>0</option>
					<option name="eye" value="1" <? if($datapasien['EYE']=="1") echo "selected=Selected";?>>1</option>
					<option name="eye" value="2" <? if($datapasien['EYE']=="2") echo "selected=Selected";?>>2</option>
					<option name="eye" value="3" <? if($datapasien['EYE']=="3") echo "selected=Selected";?>>3</option>
					<option name="eye" value="4" <? if($datapasien['EYE']=="4") echo "selected=Selected";?>>4</option>
					<option name="eye" value="5" <? if($datapasien['EYE']=="5") echo "selected=Selected";?>>5</option>
					<option name="eye" value="6" <? if($datapasien['EYE']=="6") echo "selected=Selected";?>>6</option>
					</select></td>
			</tr>
			<tr>
				<td align="left">Motorik</td>
				<td><select name="motorik" id="motorik" onChange="totalise()">
				<!-- <option value=""> -- pilih --</option>-->
					<option value="0" <? if($datapasien['MOTORIK']=="0") echo "selected=Selected";?>>0</option>
					<option value="1" <? if($datapasien['MOTORIK']=="1") echo "selected=Selected";?>>1</option>
					<option value="2" <? if($datapasien['MOTORIK']=="2") echo "selected=Selected";?>>2</option>
					<option value="3" <? if($datapasien['MOTORIK']=="3") echo "selected=Selected";?>>3</option>
					<option value="4" <? if($datapasien['MOTORIK']=="4") echo "selected=Selected";?>>4</option>
					<option value="5" <? if($datapasien['MOTORIK']=="5") echo "selected=Selected";?>>5</option>
					<option value="6" <? if($datapasien['MOTORIK']=="6") echo "selected=Selected";?>>6</option>
					</select></td>
			</tr>
			<tr>
				<td align="left">Verbal</td>
				<td><select name="verbal" id="verbal" onChange="totalise()">
				<!--<option value=""> -- pilih --</option>-->
					<option value="0" <? if($datapasien['VERBAL']=="0") echo "selected=Selected";?>>0</option>
					<option value="1" <? if($datapasien['VERBAL']=="1") echo "selected=Selected";?>>1</option>
					<option value="2" <? if($datapasien['VERBAL']=="2") echo "selected=Selected";?>>2</option>
					<option value="3" <? if($datapasien['VERBAL']=="3") echo "selected=Selected";?>>3</option>
					<option value="4" <? if($datapasien['VERBAL']=="4") echo "selected=Selected";?>>4</option>
					<option value="5" <? if($datapasien['VERBAL']=="5") echo "selected=Selected";?>>5</option>
					<option value="6" <? if($datapasien['VERBAL']=="6") echo "selected=Selected";?>>6</option>
					</select></td>
			</tr>
			<tr>
				<td>Total GCS</td>
				<td><input type="text" size="10" class="text" name="total" id="total" value="<?=$datapasien['TOTAL_GCS']?>"/></td>
			</tr>
			
			<tr>
				<td>Reaksi Pupil</td>
				<td><select name="REAKSI_PUPIL" class="text">
            <option value=""> --pilih-- </option>
            <option value="Y" <? if($datapasien['REAKSI_PUPIL']=="Y")echo "selected=Selected";?> >Ya</option>
            <option value="T" <? if($datapasien['REAKSI_PUPIL']=="T")echo "selected=Selected";?> >Tidak</option>
          </select></td>
			</tr>

			<tr>
				<td colspan="2"></td>
			</tr>
			<tr>
				<td rowspan="6" valign="top">Kesadaran</td>
				<td>:</td>
			</tr>
			<tr>
			<? $val = split(",",$datapasien['KESADARAN']); $i = 0; ?>
				<td align="left" width="27%"><input type="checkbox" name="KESADARAN[]" value="1" <? if($val[$i]=="1"){echo "checked"; $i++;}?>> Composmentis</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="KESADARAN[]" value="2" <? if($val[$i]=="2"){echo "checked"; $i++;}?>> Apatis</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="KESADARAN[]" value="3" <? if($val[$i]=="3"){echo "checked"; $i++;}?>> Somnolen</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="KESADARAN[]" value="4" <? if($val[$i]=="4"){echo "checked"; $i++;}?>> Sopor</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="KESADARAN[]" value="5" <? if($val[$i]=="5"){echo "checked"; $i++;}?>> Koma</td>
			</tr>
			
			<tr>
				<td rowspan="6" valign="top">Kepala</td>
				<td>:</td>
			</tr>
			<tr>
			<? $val = split(",",$datapasien['KEPALA']); $i = 0; ?>
				<td align="left" width="27%"><input type="checkbox" name="KEPALA[]" value="1" <? if($val[$i]=="1"){echo "checked"; $i++;}?>> Tidak ada kelainan</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="KEPALA[]" value="2" <? if($val[$i]=="2"){echo "checked"; $i++;}?>> Mesosefal</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="KEPALA[]" value="3" <? if($val[$i]=="3"){echo "checked"; $i++;}?>> Asimetris</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="KEPALA[]" value="4" <? if($val[$i]=="4"){echo "checked"; $i++;}?>> Hematoma</td>
			</tr>
			<tr>
			<td align="left" width="27%"><input type="checkbox" name="KEPALA[]" value="_L_" <? if(substr($val[$i],0,3)=="_L_"){echo "checked"; $vol = split("_L_",$val[$i]); $i++;}?>> 
				Lain-lain <input type="text" name="lainKEPALA" id="lainKEPALA" value="<?=$vol[1]?>"></td>
			</tr>
			
			<tr>
				<td rowspan="7" valign="top">Rambut</td>
				<td>:</td>
			</tr>
			<tr>
			<? $val = split(",",$datapasien['RAMBUT']); $i = 0; ?>
				<td align="left" width="27%"><input type="checkbox" name="RAMBUT[]" value="1" <? if($val[$i]=="1"){echo "checked"; $i++;}?>> Tidak ada kelainan</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="RAMBUT[]" value="2" <? if($val[$i]=="2"){echo "checked"; $i++;}?>> Kotor</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="RAMBUT[]" value="3" <? if($val[$i]=="3"){echo "checked"; $i++;}?>> Berminyak</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="RAMBUT[]" value="4" <? if($val[$i]=="4"){echo "checked"; $i++;}?>> Kering</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="RAMBUT[]" value="5" <? if($val[$i]=="5"){echo "checked"; $i++;}?>> Rontok</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="RAMBUT[]" value="_L_" <? if(substr($val[$i],0,3)=="_L_"){echo "checked"; $vol_ = split ("_L_",$val[$i]); $i++;}?>> 
				Lain-lain <input type="text" name="lainRAMBUT" id="lainRAMBUT" value="<?=$vol_[1]?>"></td>
			</tr>
			
			<tr>
				<td rowspan="8" valign="top">Muka</td>
				<td>:</td>
			</tr>
			<tr>
			<? $val = split(",",$datapasien['MUKA']); $i = 0; ?>
			<td align="left" width="27%"><input type="checkbox" name="MUKA[]" value="1" <? if($val[$i]=="1"){echo "checked"; $i++;}?>> Simetris</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="MUKA[]" value="2" <? if($val[$i]=="2"){echo "checked"; $i++;}?>> Asimetris</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="MUKA[]" value="3" <? if($val[$i]=="3"){echo "checked"; $i++;}?>> Bells palsy</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="MUKA[]" value="4" <? if($val[$i]=="4"){echo "checked"; $i++;}?>> Tic Facialls</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="MUKA[]" value="5" <? if($val[$i]=="5"){echo "checked"; $i++;}?>> Kelainan congenital</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="MUKA[]" value="6" <? if($val[$i]=="6"){echo "checked"; $i++;}?>> Moon face</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="MUKA[]" value="_L_" <? if(substr($val[$i],0,3)=="_L_"){echo "checked"; $vol_muka = split("_L_",$val[$i]); $i++;}?>>
				Lain-lain <input type="text" name="lainMUKA" id="lainMUKA" value="<?=$vol_muka[1]?>"></td>
			</tr>
			
			<tr>
				<td rowspan="23" valign="top">Mata</td>
				<td>:</td>
			</tr>
			<tr>
			<? $val = split(",",$datapasien['MATA']); $i = 0; ?>
				<td align="left" width="27%"><input type="checkbox" name="MATA[]" value="1" <? if($val[$i]=="1"){echo "checked"; $i++;}?>> Tidak ada kelainan</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="MATA[]" value="2" <? if($val[$i]=="2"){echo "checked"; $i++;}?>> Sklera anemis</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="MATA[]" value="3" <? if($val[$i]=="3"){echo "checked"; $i++;}?>> Ikterik</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="MATA[]" value="4" <? if($val[$i]=="4"){echo "checked"; $i++;}?>> Konjungtivitis</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="MATA[]" value="5" <? if($val[$i]=="5"){echo "checked"; $i++;}?>> Anisokor</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="MATA[]" value="6" <? if($val[$i]=="6"){echo "checked"; $i++;}?>> Midriasis</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="MATA[]" value="7" <? if($val[$i]=="7"){echo "checked"; $i++;}?>> Miosis</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="MATA[]" value="8" <? if($val[$i]=="8"){echo "checked"; $i++;}?>> Tdak ada reaksi cahaya</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="MATA[]" value="9" <? if($val[$i]=="9"){echo "checked"; $i++;}?>> Cekung</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="MATA[]" value="10" <? if($val[$i]=="10"){echo "checked"; $i++;}?>> Kantung mata</td>
			</tr>
			<tr>
				<td align="left" width="27%"><input type="checkbox" name="MATA[]" value="_L_" <? if(substr($val[$i],0,3)=="_L_"){echo "checked"; $vol_mata = split("_L_",$val[$i]); $i++;}?>> 
				Lain-lain <input type="text" name="lainMATA" id="lainMATA" value="<?=$vol_mata[1]?>"></td>
			</tr>
			
			<tr>
				<td align="left" rowspan="8" valign="top"> Gangguan penglihatan</td>
				<? $val_gang = split (",",$datapasien['GANG_LIHAT']); $i = 0; ?>
				<td align="left"><input type="checkbox" name="GANG_LIHAT[]" value="1" <? if($val_gang[$i]=="1"){echo "checked"; $i++;}?>> Katarak</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="GANG_LIHAT[]" value="2" <? if($val_gang[$i]=="2"){echo "checked"; $i++;}?>> Glaukoma</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="GANG_LIHAT[]" value="3" <? if($val_gang[$i]=="3"){echo "checked"; $i++;}?>> Diplopia</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="GANG_LIHAT[]" value="4" <? if($val_gang[$i]=="4"){echo "checked"; $i++;}?>> Strabismus</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="GANG_LIHAT[]" value="5" <? if($val_gang[$i]=="5"){echo "checked"; $i++;}?>> Low Vision</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="GANG_LIHAT[]" value="6" <? if($val_gang[$i]=="6"){echo "checked"; $i++;}?>> Buta</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="GANG_LIHAT[]" value="_L_" <? if(substr($val_gang[$i],0,3)=="_L_"){echo "checked"; $vol_gang = split("_L_",$val_gang[$i]); $i++;}?>> 
				Lain-lain <input type="text" name="lainGANG" id="lainGANG" value="<?=$vol_gang[1]?>"></td>
			</tr>
			<tr>
				<td>&nbsp;</td></tr>
			<tr>
			<? $val = split (",",$datapasien['ALATBANTU_LIHAT']); $i = 0; ?>
				<td align="left" rowspan="3" valign="top"> Alat bantu penglihatan</td>
				<td align="left"><input type="checkbox" name="ALATBANTU_LIHAT[]" value="1" <? if($val[$i]=="1"){echo "checked"; $i++;}?>> Kacamata</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="ALATBANTU_LIHAT[]" value="2" <? if($val[$i]=="2"){echo "checked"; $i++;}?>> Lensa kotak</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="ALATBANTU_LIHAT[]" value="3" <? if($val[$i]=="3"){echo "checked"; $i++;}?>> Mata palsu</td>
			</tr>
			
			<tr>
				<td rowspan="15" valign="top">Telinga</td>
				<td>:</td>
			</tr>
			<tr>
				<td align="left" rowspan="3" valign="top"> Bentuk</td>
				<? $val = split (",",$datapasien['BENTUK']); $i = 0; ?>
				<td align="left"><input type="checkbox" name="BENTUK[]" value="1" <? if($val[$i]=="1"){echo "checked"; $i++;} ?>> Simetris</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="BENTUK[]" value="2" <? if($val[$i]=="2"){echo "checked"; $i++;} ?>> Tidak simetris</td></tr>
			<tr>
				<td>&nbsp;</td></tr>
			<tr>
				<td align="left" rowspan="6" valign="top"> Pendengaran</td>
				<? $val = split (",",$datapasien['PENDENGARAN']); $i = 0; ?>
				<td align="left"><input type="checkbox" name="PENDENGARAN[]" value="1" <? if($val[$i]=="1"){echo "checked"; $i++;} ?>> Baik</td>
			</tr>
			<tr>
				<td align="left" valign="top"> Kurang/Tuli</td>
				<td><select name="PENDENGARAN[]" class="text">
            <option value=""> --pilih-- </option>
            <option value="2" <? if($val[$i]=="2"){echo "selected=Selected"; $i++; }?> >Telinga kanan</option>
            <option value="3" <? if($val[$i]=="3"){echo "selected=Selected"; $i++;} ?> >Telinga kiri</option>
          </select></td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="PENDENGARAN[]" value="4" <? if($val[$i]=="4"){echo "checked"; $i++;} ?>> Berdengung</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="PENDENGARAN[]" value="5" <? if($val[$i]=="5"){echo "checked"; $i++;} ?>> Nyeri</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="PENDENGARAN[]" value="6" <? if($val[$i]=="6"){echo "checked"; $i++;} ?>> Keluar cairan</td>
			</tr>
			<tr>
				<td>&nbsp;</td></tr>
			<tr>
				<td align="left" rowspan="5" valign="top"> Lubang telinga</td>
				<? $val_lub = split (",",$datapasien['LUB_TELINGA']); $i = 0; ?>
				<td align="left"><input type="checkbox" name="LUB_TELINGA[]" value="1" <? if($val_lub[$i]=="1"){echo "checked"; $i++;} ?>> Bersih</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="LUB_TELINGA[]" value="2" <? if($val_lub[$i]=="2"){echo "checked"; $i++;} ?>> Kotor</td>
			</tr>
			<tr>
				<td align="left" valign="top"> Alat bantu pendengaran</td>
				<td><select name="LUB_TELINGA[]" class="text">
            <option value=""> --pilih-- </option>
            <option value="3" <? if($val_lub[$i]=="3"){echo "Selected"; $i++; }?> >Ya</option>
            <option value="4" <? if($val_lub[$i]=="4"){echo "Selected"; $i++;} ?> >Tidak</option>
          </select></td>
			</tr>
			<tr>
			<td align="left"><input type="checkbox" name="LUB_TELINGA[]" value="5" <? if($val_lub[$i]=="5"){echo "checked"; $i++;} ?>> Serumen</td>
			</tr>
			<tr>
<td align="left"><input type="checkbox" name="LUB_TELINGA[]" value="_L_" <? if(substr($val_lub[$i],0,3)=="_L_"){echo "checked"; $vol_lub = split("_L_",$val_lub[$i]); $i++;}?>> 
Warna serumen <input type="text" name="warnaTELINGA" id="warnaTELINGA" value="<?=$vol_lub[1]?>"></td>
			</tr>
			
			
			<tr>
				<td rowspan="12" valign="top">Hidung</td>
				<td>:</td>
			</tr>
			<tr>
				<td align="left" rowspan="5" valign="top"> Bentuk</td>
				<? $val = split (",",$datapasien['BENTUK_HIDUNG']); $i = 0; ?>
				<td align="left"><input type="checkbox" name="BENTUK_HIDUNG[]" value="1" <? if($val[$i]=="1"){echo "checked"; $i++;} ?>> Simetris</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="BENTUK_HIDUNG[]" value="2" <? if($val[$i]=="2"){echo "checked"; $i++;} ?>> Asimetris</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="BENTUK_HIDUNG[]" value="3" <? if($val[$i]=="3"){echo "checked"; $i++;} ?>> Pelana</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="BENTUK_HIDUNG[]" value="4" <? if($val[$i]=="4"){echo "checked"; $i++;} ?>> Polip</td>
			</tr>
			<tr>
				<td>&nbsp;</td></tr>
			<tr>
				<td align="left" rowspan="4" valign="top"> Membran mukosa</td>
				<? $val = split (",",$datapasien['MEMBRAN_MUK']); $i = 0; ?>
				<td align="left"><input type="checkbox" name="MEMBRAN_MUK[]" value="1" <? if($val[$i]=="1"){echo "checked"; $i++;} ?>> Lembab</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="MEMBRAN_MUK[]" value="2" <? if($val[$i]=="2"){echo "checked"; $i++;} ?>> Kering</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="MEMBRAN_MUK[]" value="3" <? if($val[$i]=="3"){echo "checked"; $i++;} ?>> Mengeluarkan lendir/darah (epistaksis)</td>
			</tr>
			<tr>
				<td>&nbsp;</td></tr>
			<tr>
				<td align="left" valign="top"> Kemampuan menghidu</td>
				<td><select name="MAMPU_HIDU" class="text">
				<option value=""> --pilih-- </option>
            <option value="B" <? if($datapasien['MAMPU_HIDU']=="B"){echo "selected=Selected"; $i++; }?> >Berbau</option>
            <option value="TB" <? if($datapasien['MAMPU_HIDU']=="TB"){echo "selected=Selected"; $i++;} ?> >Tidak berbau</option></select></td>
			</tr>
			<tr>
				<td align="left">Hidung terpasang alat</td>
				<td><input type="text" name="ALAT_HIDUNG" id="ALAT_HIDUNG" value="<?=$datapasien['ALAT_HIDUNG']?>"> </td>
			</tr>
			
			<tr>
				<td rowspan="19" valign="top">Mulut</td>
				<td>:</td>
			</tr>
			<tr>
				<td align="left" valign="top"> Rongga mulut</td>
				<td><select name="RONGGA_MULUT" class="text">
				<option value=""> --pilih-- </option>
				<option value="B" <? if($datapasien['RONGGA_MULUT']=="B") echo "selected=Selected";?>> Berbau</option>
				<option value="TB" <? if($datapasien['RONGGA_MULUT']=="TB")echo "selected=Selected";?>> Tidak berbau</option>
				</select></td></tr>
			<tr>
				<td align="left" valign="top"> Warna membrane mukosa</td>
				<td><input type="text" name="WARNA_MEMBRAN" id="WARNA_MEMBRAN" value="<?=$datapasien['WARNA_MEMBRAN']?>"> </td>
			</tr>
			<tr>
				<td align="left" valign="top"> Kelembaban</td>
				<td><select name="LEMBAB" class="text">
				<option value=""> --pilih-- </option>
				<option value="K" <? if($datapasien['LEMBAB']=="K"){echo "selected=Selected"; $i++;}?>> Kering</option>
				<option value="B" <? if($datapasien['LEMBAB']=="B"){echo "selected=Selected"; $i++;}?>> Basah</option>
				</select></td></tr>
			<tr>
				<td align="left" valign="top"> Stomatitis</td>
				<td><select name="STOMATITIS" class="text">
				<option value=""> --pilih-- </option>
				<option value="Y" <? if($datapasien['STOMATITIS']=="Y"){echo "selected=Selected"; $i++;}?>> Ya</option>
				<option value="T" <? if($datapasien['STOMATITIS']=="T"){echo "selected=Selected"; $i++;}?>> Tidak</option>
				</select></td></tr>
			<tr>
				<td align="left" valign="top"> Lidah</td>
				<td><select name="LIDAH" class="text">
				<option value=""> --pilih-- </option>
				<option value="K" <? if($datapasien['LIDAH']=="K"){echo "selected=Selected"; $i++;}?>> Kotor</option>
				<option value="B" <? if($datapasien['LIDAH']=="B"){echo "selected=Selected"; $i++;}?>> Bersih</option>
				</select></td></tr>
			<tr>
				<td align="left" rowspan="6" valign="top"> Gigi</td>
				<? $val_gigi = split (",",$datapasien['GIGI']); $i = 0; ?>
				<td align="left"><input type="checkbox" name="GIGI[]" value="1" <? if($val_gigi[$i]=="1"){echo "checked"; $i++;}?>> Caries</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="GIGI[]" value="2" <? if($val_gigi[$i]=="2"){echo "checked"; $i++;}?>> Gigi palsu</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="GIGI[]" value="3" <? if($val_gigi[$i]=="3"){echo "checked"; $i++;}?>> Goyang</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="GIGI[]" value="4" <? if($val_gigi[$i]=="4"){echo "checked"; $i++;}?>> Tambal</td>
			</tr>
			<tr>
<td align="left"><input type="checkbox" name="GIGI[]" value="_L_" <? if(substr($val_gigi[$i],0,3)=="_L_"){echo "checked"; $vol_gigi = split("_L_",$val_gigi[$i]); $i++;}?>> 
Jumlah gigi <input type="text" name="jumlahGIGI" id="jumlahGIGI" value="<?=$vol_gigi[1]?>"></td>


			</tr>
			<tr>
				<td>&nbsp;</td></tr>
			<tr>
				<td align="left" rowspan="3" valign="top"> Tonsil</td>
				<? $val = split(",",$datapasien['TONSIL']);  $i = 0; ?>
				<td align="left"><input type="checkbox" name="TONSIL[]" value="1" <? if($val[$i]=="1"){echo "checked"; $i++;}?>> Ada pembesaran</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="TONSIL[]" value="2" <? if($val[$i]=="2"){echo "checked"; $i++;}?>> Tidak ada pembesaran</td>
			</tr>
			<tr>
				<td>&nbsp;</td></tr>
			<tr>
				<td align="left" rowspan="4" valign="top"> Kelainan/Gangguan</td>
				<? $val_kel = split (",",$datapasien['KELAINAN']); $i = 0; ?>
				<td align="left"><input type="checkbox" name="KELAINAN[]" value="1" <? if($val_kel[$i]=="1"){echo "checked"; $i++;}?>> Peradangan labio schizis</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="KELAINAN[]" value="2" <? if($val_kel[$i]=="2"){echo "checked"; $i++;}?>> Palato schizis</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="KELAINAN[]" value="3" <? if($val_kel[$i]=="3"){echo "checked"; $i++;}?>> Pelo</td>
			</tr>
			<tr>
		<td align="left"><input type="checkbox" name="KELAINAN[]" value="_L_" <? if(substr($val_kel[$i],0,3)=="_L_"){echo "checked"; $vol_kel = split("_L_",$val_kel[$i]); $i++;}?>>
		Lain-lain <input type="text" name="lainGANGGUAN" id="lainGANGGUAN" value="<?=$vol_kel[1]?>"></td>
			</tr>
			
			<tr>
				<td rowspan="13" valign="top">Leher</td>
				<td>:</td>
			</tr>
			<tr>
				<td align="left" rowspan="5" valign="top"> Pergerakan</td>
				<? $val_per = split (",",$datapasien['PERGERAKAN']); $i = 0; ?>
				<td align="left"><input type="checkbox" name="PERGERAKAN[]" value="1" <? if($val_per[$i]=="1"){echo "checked"; $i++;}?>> Bebas</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="PERGERAKAN[]" value="2" <? if($val_per[$i]=="2"){echo "checked"; $i++;}?>> Kaku</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="PERGERAKAN[]" value="3" <? if($val_per[$i]=="3"){echo "checked"; $i++;}?>> Benjolan</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="PERGERAKAN[]" value="4" <? if($val_per[$i]=="4"){echo "checked"; $i++;}?>> Kaku kuduk</td>
			</tr>
			<tr>
				<td>&nbsp;</td></tr>	
			<tr>
				<td align="left" valign="top"> Kelenjar tiroid</td>
				<td><select name="KEL_TIROID" class="text">
				<option value=""> --pilih-- </option>
				<option value="TT" <? if($datapasien['KEL_TIROID']=="TT")echo "selected=Selected";?>> Tidak teraba</option>
				<option value="T" <? if($datapasien['KEL_TIROID']=="T")echo "selected=Selected"; ?>> Teraba</option>
				</select></td></tr>
			<tr>
				<td align="left" valign="top"> Kelenjar getah bening</td>
				<td><select name="KEL_GETAH" class="text">
				<option value=""> --pilih-- </option>
				<option value="TT" <? if($datapasien['KEL_GETAH']=="TT")echo "selected=Selected";?>> Tidak teraba</option>
				<option value="T" <? if($datapasien['KEL_GETAH']=="T")echo "selected=Selected"; ?>> Teraba</option>
				<option value="P" <? if($datapasien['KEL_GETAH']=="P")echo "selected=Selected"; ?>> Pembesaran</option>
				</select></td></tr>
			<tr>
				<td align="left" valign="top"> Tekanan vena jugularis</td>
				<td><select name="TEKANAN_VENA" class="text">
				<option value=""> --pilih-- </option>
				<option value="M" <? if($datapasien['TEKANAN_VENA']=="M")echo "selected=Selected";?>> Meningkat</option>
				<option value="T" <? if($datapasien['TEKANAN_VENA']=="T")echo "selected=Selected"; ?>> Tidak</option>
				</select></td></tr>
			<tr>
				<td align="left" valign="top"> Reflek menelan</td>
				<td><select name="REF_MENELAN" class="text">
				<option value=""> --pilih-- </option>
				<option value="A" <? if($datapasien['REF_MENELAN']=="A")echo "selected=Selected";?>> Ada</option>
				<option value="T" <? if($datapasien['REF_MENELAN']=="T")echo "selected=Selected"; ?>> Tidak</option>
				</select></td></tr>
			<tr>
				<td align="left" valign="top"> Nyeri</td>
				<td><select name="NYERI" class="text">
				<option value=""> --pilih-- </option>
				<option value="Y" <? if($datapasien['NYERI']=="Y")echo "selected=Selected";?>> Ya</option>
				<option value="T" <? if($datapasien['NYERI']=="T")echo "selected=Selected"; ?>> Tidak</option>
				</select></td></tr>
			<tr>
				<td align="left" valign="top"> Krepitasi</td>
				<td><select name="KREPITASI" class="text">
				<option value=""> --pilih-- </option>
				<option value="Y" <? if($datapasien['KREPITASI']=="Y")echo "selected=Selected";?>> Ya</option>
				<option value="T" <? if($datapasien['KREPITASI']=="T")echo "selected=Selected"; ?>> Tidak</option>
				</select></td></tr>
			<tr>
				<td align="left">Kelainan lain</td>
				<td><input type="text" name="KEL_LAIN" id="KEL_LAIN" value="<?=$datapasien['KEL_LAIN']?>"></td>
			</tr>
			
		<tr>
			<td rowspan="56" valign="top">Toraks</td>
			<td align="left" rowspan="18" valign="top"> Inspeksi</td>
			<td align="left" rowspan="6" valign="top"> Bentuk dada</td>
			</tr>
		<tr>
		<? $val_dada = split (",",$datapasien['BENTUK_DADA']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="BENTUK_DADA[]" value="1" <? if($val_dada[$i]=="1"){echo "checked"; $i++;}?>> Normal</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BENTUK_DADA[]" value="2" <? if($val_dada[$i]=="2"){echo "checked"; $i++;}?>> Pigeon chest</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BENTUK_DADA[]" value="3" <? if($val_dada[$i]=="3"){echo "checked"; $i++;}?>> Funnel chest</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BENTUK_DADA[]" value="4" <? if($val_dada[$i]=="4"){echo "checked"; $i++;}?>> Barrel chest</td>
			</tr>
		<tr>
			<td>&nbsp;</td></tr>
		<tr>
			<td align="left" rowspan="5" valign="top"> Pola napas</td>
			</tr>
			<tr>
			<? $val_pola = split (",",$datapasien['POLA_NAPAS']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="POLA_NAPAS[]" value="1" <? if($val_pola[$i]=="1"){echo "checked"; $i++;}?>> Apnoe</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="POLA_NAPAS[]" value="2" <? if($val_pola[$i]=="2"){echo "checked"; $i++;}?>> Dispnes</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="POLA_NAPAS[]" value="3" <? if($val_pola[$i]=="3"){echo "checked"; $i++;}?>> Ortopnea</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="POLA_NAPAS[]" value="_L_" <? if(substr($val_pola[$i],0,3)=="_L_"){echo "checked"; $vol_pola = split("_L_",$val_pola[$i]); $i++;}?>>
			Lainnya <input type="text" name="polaLAIN" id="polaLAIN" value="<?=$vol_pola[1]?>"></td>
			</tr>
		<tr>
			<td>&nbsp;</td></tr>
		<tr>
			<td align="left" rowspan="6" valign="top"> Bentuk thoraks</td>
			</tr>
		<tr>
		<? $val_thorak = split (",",$datapasien['BENTUK_THORAKS']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="BENTUK_THORAKS[]" value="1" <? if($val_thorak[$i]=="1"){echo "checked"; $i++;}?>> Normal</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BENTUK_THORAKS[]" value="2" <? if($val_thorak[$i]=="2"){echo "checked"; $i++;}?>> Kifosis</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BENTUK_THORAKS[]" value="3" <? if($val_thorak[$i]=="3"){echo "checked"; $i++;}?>> Lordosis</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BENTUK_THORAKS[]" value="4" <? if($val_thorak[$i]=="4"){echo "checked"; $i++;}?>> Scholiosis</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BENTUK_THORAKS[]" value="5" <? if($val_thorak[$i]=="5"){echo "checked"; $i++;}?>> Gibus</td>
			</tr>
		<tr>
			<td>&nbsp;</td></tr>
		<tr>
		<td align="left" rowspan='7' valign='top'>Palpasi</td>
			
			</tr>
		<tr>
			<td align="left" rowspan="2" valign="top"> Krepitasi</td>
			<? $val_krep = split (",",$datapasien['PAL_KREP']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="PAL_KREP[]" value="_1_" <? if(substr($val_krep[$i],0,3)=="_1_"){echo "checked"; $vol_krep = split("_1_",$val_krep[$i]); $i++;}?>>
			Ada, <input type="type" name="krepitasi_ada" id="krepitasi_ada" value="<?=$vol_krep[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PAL_KREP[]" value="2" <? if($val_krep[$i]=="2"){echo "checked"; $i++;}?>> Tidak</td>
			</tr>
		<tr>
			<td align="left" rowspan='2' valign='top'>Benjolan/massa</td>
			<? $val_ben = split (",",$datapasien['BENJOLAN']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="BENJOLAN[]" value="_1_" <? if(substr($val_ben[$i],0,3)=="_1_"){echo "checked"; $vol_ben = split("_1_",$val_ben[$i]); $i++;}?>>
			Ada, <input type="type" name="benjolan_ada" id="benjolan_ada" value="<?=$vol_ben[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BENJOLAN[]" value="2" <? if($val_ben[$i]=="2"){echo "checked"; $i++;}?>> Tidak</td>
			</tr>
		<tr>
			<td align="left" rowspan='2' valign='top'>Nyeri</td>
			<? $val_nyeri = split (",",$datapasien['PAL_NYERI']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="PAL_NYERI[]" value="_1_" <? if(substr($val_nyeri[$i],0,3)=="_1_"){echo "checked"; $vol_nyeri = split("_1_",$val_nyeri[$i]); $i++;}?>>
			Ada, <input type="type" name="nyeri_ada" id="nyeri_ada" value="<?=$vol_nyeri[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PAL_NYERI[]" value="2" <? if($val_nyeri[$i]=="2"){echo "checked"; $i++;}?>> Tidak</td>
			</tr>
		<tr>
			<td align="left" rowspan="5" valign="top"> Perkusi</td>
			<? $val_per = split (",",$datapasien['PERKUSI']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="PERKUSI[]" value="1" <? if($val_per[$i]=="1"){echo "checked"; $i++;}?>> Sonor</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PERKUSI[]" value="2" <? if($val_per[$i]=="2"){echo "checked"; $i++;}?>> Hipersonor</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PERKUSI[]" value="3" <? if($val_per[$i]=="3"){echo "checked"; $i++;}?>> Timpani</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PERKUSI[]" value="4" <? if($val_per[$i]=="4"){echo "checked"; $i++;}?>> Redup</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PERKUSI[]" value="5" <? if($val_per[$i]=="5"){echo "checked"; $i++;}?>> Pekak</td>
			</tr>
		<tr>
			<td align="left" rowspan="25" valign="top"> Auskultasi</td>
			<td align="left" rowspan="11" valign="top"> Paru</td>
			</tr>
		<tr>
		<? $val_paru = split (",",$datapasien['PARU']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="PARU[]" value="1" <? if($val_paru[$i]=="1"){echo "checked"; $i++;}?>> Vesikuler</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PARU[]" value="2" <? if($val_paru[$i]=="2"){echo "checked"; $i++;}?>> Suara vesikuler</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PARU[]" value="3" <? if($val_paru[$i]=="3"){echo "checked"; $i++;}?>> Bronkovesikuler</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PARU[]" value="4" <? if($val_paru[$i]=="4"){echo "checked"; $i++;}?>> Whezzing</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PARU[]" value="5" <? if($val_paru[$i]=="5"){echo "checked"; $i++;}?>> Ronchi basah</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PARU[]" value="6" <? if($val_paru[$i]=="6"){echo "checked"; $i++;}?>> Ronchi kering</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PARU[]" value="7" <? if($val_paru[$i]=="7"){echo "checked"; $i++;}?>> Regular</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PARU[]" value="8" <? if($val_paru[$i]=="8"){echo "checked"; $i++;}?>> Iregular</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PARU[]" value="9" <? if($val_paru[$i]=="9"){echo "checked"; $i++;}?>> Krepitasi</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PARU[]" value="10" <? if($val_paru[$i]=="10"){echo "checked"; $i++;}?>> Pleural friction rub</td>
			</tr>
		<tr>
			<td align="left" rowspan="14" valign="top"> Jantung</td>
			<td align="left" rowspan="4" valign="top"> Suara jantung</td>
			</tr>
		<tr>
		<? $val_suara = split (",",$datapasien['SUARA_JANTUNG']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="SUARA_JANTUNG[]" value="1" <? if($val_suara[$i]=="1"){echo "checked"; $i++;}?>> S1/S2 Normal</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="SUARA_JANTUNG[]" value="2" <? if($val_suara[$i]=="2"){echo "checked"; $i++;}?>> Murmur</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="SUARA_JANTUNG[]" value="3" <? if($val_suara[$i]=="3"){echo "checked"; $i++;}?>> Gallop</td>
			</tr>
		<tr>
		<? $val_jan = split (",",$datapasien['JANTUNG']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="JANTUNG[]" value="_1_" <? if($val_jan[$i]=="_1_"){echo "checked"; $i++;}?>> Nyeri dada</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="JANTUNG[]" value="_2_" <? if($val_jan[$i]=="_2_"){echo "checked"; $i++;}?>> Aritmia</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="JANTUNG[]" value="_3_" <? if($val_jan[$i]=="_3_"){echo "checked"; $i++;}?>> Palpitasi</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="JANTUNG[]" value="_T_" <? if(substr($val_jan[$i],0,3)=="_T_"){echo "checked"; $vol_jan1 = split("_T_",$val_jan[$i]); $i++;}?>>
			Tachikardi <input type="text" name="tacJANTUNG" id="tacJANTUNG" size="10" value="<?=$vol_jan1[1]?>"> x/mnt</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="JANTUNG[]" value="_B_" <? if(substr($val_jan[$i],0,3)=="_B_"){echo "checked"; $vol_jan2 = split("_B_",$val_jan[$i]); $i++;}?>>
			Bradikardi <input type="text" name="braJANTUNG" id="braJANTUNG" size="10" value="<?=$vol_jan2[1]?>"> x/mnt</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="JANTUNG[]" value="_L_" <? if(substr($val_jan[$i],0,3)=="_L_"){echo "checked"; $vol_jan3 = split("_L_",$val_jan[$i]); $i++;}?>>
			Lain-lain</td>
			<td><input type="text" name="JANTUNGlain" id="JANTUNGlain" value="<?=$vol_jan3[1]?>"></td>
			</tr>
			
		<tr>
			<td align="left" rowspan='4' valign='top'>Alat bantu jantung</td>
			<? $val_alat = split (",",$datapasien['ALATBANTU_JAN']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="ALATBANTU_JAN[]" value="1" <? if($val_alat[$i]=="1"){echo "checked"; $i++;}?>> Pacemaker</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="ALATBANTU_JAN[]" value="2" <? if($val_alat[$i]=="2"){echo "checked"; $i++;}?>> Kateter</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="ALATBANTU_JAN[]" value="3" <? if($val_alat[$i]=="3"){echo "checked"; $i++;}?>> Ring</td>
			</tr>
		<tr>
			<td align="left" width="15%"><input type="checkbox" name="ALATBANTU_JAN[]" value="_L_" <? if(substr($val_alat[$i],0,3)=="_L_"){echo "checked"; $vol_alat = split("_L_",$val_alat[$i]); $i++;}?>>
			Lainnya <input type="type" name="lainALAT" id="lainALAT" value="<?=$vol_alat[1]?>"></td>
			</tr>
		<tr>
			<td align="left" rowspan="24" valign="top"> Abdomen</td>
			<td align="left" rowspan="8" valign="top"> Inspeksi</td>
			<td align="left" rowspan="6" valign="top"> Bentuk abdomen</td>
			</tr>
		<tr>
		<? $val_bentuk = split (",",$datapasien['BENTUK_ABDOMEN']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="BENTUK_ABDOMEN[]" value="1" <? if($val_bentuk[$i]=="1"){echo "checked"; $i++;}?>> Normal</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BENTUK_ABDOMEN[]" value="2" <? if($val_bentuk[$i]=="2"){echo "checked"; $i++;}?>> Datar</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BENTUK_ABDOMEN[]" value="3" <? if($val_bentuk[$i]=="3"){echo "checked"; $i++;}?>> Tegang</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BENTUK_ABDOMEN[]" value="4" <? if($val_bentuk[$i]=="4"){echo "checked"; $i++;}?>> Kembung</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BENTUK_ABDOMEN[]" value="5" <? if($val_bentuk[$i]=="5"){echo "checked"; $i++;}?>> Stoma</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BENTUK_ABDOMEN[]" value="6" <? if($val_bentuk[$i]=="6"){echo "checked"; $i++;}?>> Luka operasi</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BENTUK_ABDOMEN[]" value="_L_" <? if(substr($val_bentuk[$i],0,3)=="_L_"){echo "checked"; $vol_bentuk = split("_L_",$val_bentuk[$i]); $i++;}?>>
			Lingkar abdomen <input type="text" name="lingkar" id="lingkar" value="<?=$vol_bentuk[1]?>" size="2"> cm</td>
			</tr>
		<tr>
			<td>&nbsp;</td></tr>
		<tr>
			<td align="left" rowspan="5" valign="top"> Auskultasi</td>
			<? $val_aus = split (",",$datapasien['AUSKULTASI']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="AUSKULTASI[]" value="_1_" <? if(substr($val_aus[$i],0,3)=="_1_"){echo "checked"; $vol_aus1 = split("_1_",$val_aus[$i]); $i++;}?>>
			Kuadran 1 &nbsp;&nbsp;<input type="text" size="15" name="auskultasiSATU" id="auskultasiSATU" value="<?=$vol_aus1[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="AUSKULTASI[]" value="_2_" <? if(substr($val_aus[$i],0,3)=="_2_"){echo "checked"; $vol_aus2 = split("_2_",$val_aus[$i]); $i++;}?>>
			Kuadran 2 &nbsp;&nbsp;<input type="text" size="15" name="auskultasiDUA" id="auskultasiDUA" value="<?=$vol_aus2[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="AUSKULTASI[]" value="_3_" <? if(substr($val_aus[$i],0,3)=="_3_"){echo "checked"; $vol_aus3 = split("_3_",$val_aus[$i]); $i++;}?>>
			Kuadran 3 &nbsp;&nbsp;<input type="text" size="15" name="auskultasiTIGA" id="auskultasiTIGA" value="<?=$vol_aus3[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="AUSKULTASI[]" value="_4_" <? if(substr($val_aus[$i],0,3)=="_4_"){echo "checked"; $vol_aus4 = split("_4_",$val_aus[$i]); $i++;}?>>
			Kuadran 4 &nbsp;&nbsp;<input type="text" size="15" name="auskultasiEMPAT" id="auskultasiEMPAT" value="<?=$vol_aus4[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="AUSKULTASI[]" value="_5_" <? if(substr($val_aus[$i],0,3)=="_5_"){echo "checked"; $vol_aus5 = split("_5_",$val_aus[$i]); $i++;}?>>
			Bising usus &nbsp;<input type="text" size="15" name="auskultasiLIMA" id="auskultasiLIMA" value="<?=$vol_aus5[1]?>"> x/mnt</td>
			</tr>
		<tr>
			<td align="left" rowspan="6" valign="top"> Palpasi</td>
			<td align="left" rowspan="3" valign="top"> Nyeri</td>
			<? $val_pasi = split (",",$datapasien['NYERI_PASI']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="NYERI_PASI[]" value="1" <? if($val_pasi[$i]=="1"){echo "checked"; $i++;}?>> Nyeri tekan</td>
			</tr>
		<tr>
		<td align="left"><input type="checkbox" name="NYERI_PASI[]" value="2" <? if($val_pasi[$i]=="2"){echo "checked"; $i++;}?>> Nyeri lepas</td>
			</tr>
		<tr>
		<td align="left"><input type="checkbox" name="NYERI_PASI[]" value="3" <? if($val_pasi[$i]=="3"){echo "checked"; $i++;}?>> Pembesaran massa</td>
			</tr>
		<tr>
			<td align="left" rowspan="3" valign="top"> Pembesaran kelenjar</td>
			<? $val_pem = split (",",$datapasien['PEM_KELENJAR']); $i = 0; ?>
		<td align="left"><input type="checkbox" name="PEM_KELENJAR[]" value="1" <? if($val_pem[$i]=="1"){echo "checked"; $i++;}?>> Inguinalis</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PEM_KELENJAR[]" value="2" <? if($val_pem[$i]=="2"){echo "checked"; $i++;}?>> Umbilikus</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PEM_KELENJAR[]" value="3" <? if($val_pem[$i]=="3"){echo "checked"; $i++;}?>> Tidak ada pembesaran</td>
			</tr>
		<tr>
			<td align="left" rowspan="4" valign="top"> Perkusi</td>
			<? $val_per = split (",",$datapasien['PERKUSI_AUS']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="PERKUSI_AUS[]" value="1" <? if($val_per[$i]=="1"){echo "checked"; $i++;}?>> Timpani</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PERKUSI_AUS[]" value="2" <? if($val_per[$i]=="2"){echo "checked"; $i++;}?>> Redup</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PERKUSI_AUS[]" value="3" <? if($val_per[$i]=="3"){echo "checked"; $i++;}?>> Pekak</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="PERKUSI_AUS[]" value="4" <? if($val_per[$i]=="4"){echo "checked"; $i++;}?>> Nyeri ketok CVA (pinggang)</td>
			</tr>
		
		<tr>
			<td align="left" rowspan="38" valign="top"> Genitalia/Reproduksi</td>
			<td align="left" rowspan="20" valign="top"> Perempuan</td>
			<td align="left" rowspan="5" valign="top"> Genitalia</td>
			<td align="left" rowspan="2" valign="top"> Vagina</td>
			</tr>
		<tr>
		<td><select name="VAGINA" class="text">
				<option value=""> --pilih-- </option>
				<option value="B" <? if($datapasien['VAGINA']=="B")echo "selected=Selected";?>> Bersih</option>
				<option value="K" <? if($datapasien['VAGINA']=="K")echo "selected=Selected"; ?>> Kotor</option>
				</select></td></tr>
		<tr>
			<td align="left" valign="top"> Peudomenstruasi</td>
			<td><select name="MENSTRUASI" class="text">
				<option value=""> --pilih-- </option>
				<option value="Y" <? if($datapasien['MENSTRUASI']=="Y")echo "selected=Selected";?>> Ya</option>
				<option value="T" <? if($datapasien['MENSTRUASI']=="T")echo "selected=Selected"; ?>> Tidak</option>
				</select></td></tr>
		<tr>
			<td align="left" valign="top"> Kateter</td>
			<td><select name="KATETER" class="text">
				<option value=""> --pilih-- </option>
				<option value="Y" <? if($datapasien['KATETER']=="Y")echo "selected=Selected";?>> Ya</option>
				<option value="T" <? if($datapasien['KATETER']=="T")echo "selected=Selected"; ?>> Tidak</option>
				</select></td></tr>
		<tr>
			<td align="left" valign="top"> Labia prominen</td>
			<td><select name="LABIA_PROM" class="text">
				<option value=""> --pilih-- </option>
				<option value="Y" <? if($datapasien['LABIA_PROM']=="Y")echo "selected=Selected";?>> Ya</option>
				<option value="T" <? if($datapasien['LABIA_PROM']=="T")echo "selected=Selected"; ?>> Tidak</option>
				</select></td></tr>
		<tr>
			<td align="left" rowspan="15" valign="top"> Seksual</td>
			<td align="left" rowspan="2" valign="top"> Hamil</td>
			<? $val_ham = split(",",$datapasien['HAMIL']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="HAMIL[]" value="_Y_" <? if(substr($val_ham[$i],0,3)=="_Y_")echo "checked"; $vol_ham = split("_Y_",$val_ham[$i]); $i++; $vol_ham1 = split("_Y_",$val_ham[$i]); $i++; $vol_ham2 = split("_Y_",$val_ham[$i]); $i++;?>>
			Ya, G <input type="type" name="G" id="G" size="1" value="<?=$vol_ham[1]?>"> P <input type="type" name="P" id="P" size="1" value="<?=$vol_ham1[1]?>"> A <input type="type" name="A" id="A" size="1" value="<?=$vol_ham2[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="HAMIL[]" value="_2_" <? if($val_ham[$i]=="_2_"){echo "checked"; $i++;}?>> Tidak</td>
			</tr>
		
		<script>
(function(a){var b=(a.browser.msie?"paste":"input")+".mask",c=window.orientation!=undefined;a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},dataName:"rawMaskFn"},a.fn.extend({caret:function(a,b){if(this.length!=0){if(typeof a=="number"){b=typeof b=="number"?b:a;return this.each(function(){if(this.setSelectionRange)this.setSelectionRange(a,b);else if(this.createTextRange){var c=this.createTextRange();c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select()}})}if(this[0].setSelectionRange)a=this[0].selectionStart,b=this[0].selectionEnd;else if(document.selection&&document.selection.createRange){var c=document.selection.createRange();a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length}return{begin:a,end:b}}},unmask:function(){return this.trigger("unmask")},mask:function(d,e){if(!d&&this.length>0){var f=a(this[0]);return f.data(a.mask.dataName)()}e=a.extend({placeholder:"_",completed:null},e);var g=a.mask.definitions,h=[],i=d.length,j=null,k=d.length;a.each(d.split(""),function(a,b){b=="?"?(k--,i=a):g[b]?(h.push(new RegExp(g[b])),j==null&&(j=h.length-1)):h.push(null)});return this.trigger("unmask").each(function(){function v(a){var b=f.val(),c=-1;for(var d=0,g=0;d<k;d++)if(h[d]){l[d]=e.placeholder;while(g++<b.length){var m=b.charAt(g-1);if(h[d].test(m)){l[d]=m,c=d;break}}if(g>b.length)break}else l[d]==b.charAt(g)&&d!=i&&(g++,c=d);if(!a&&c+1<i)f.val(""),t(0,k);else if(a||c+1>=i)u(),a||f.val(f.val().substring(0,c+1));return i?d:j}function u(){return f.val(l.join("")).val()}function t(a,b){for(var c=a;c<b&&c<k;c++)h[c]&&(l[c]=e.placeholder)}function s(a){var b=a.which,c=f.caret();if(a.ctrlKey||a.altKey||a.metaKey||b<32)return!0;if(b){c.end-c.begin!=0&&(t(c.begin,c.end),p(c.begin,c.end-1));var d=n(c.begin-1);if(d<k){var g=String.fromCharCode(b);if(h[d].test(g)){q(d),l[d]=g,u();var i=n(d);f.caret(i),e.completed&&i>=k&&e.completed.call(f)}}return!1}}function r(a){var b=a.which;if(b==8||b==46||c&&b==127){var d=f.caret(),e=d.begin,g=d.end;g-e==0&&(e=b!=46?o(e):g=n(e-1),g=b==46?n(g):g),t(e,g),p(e,g-1);return!1}if(b==27){f.val(m),f.caret(0,v());return!1}}function q(a){for(var b=a,c=e.placeholder;b<k;b++)if(h[b]){var d=n(b),f=l[b];l[b]=c;if(d<k&&h[d].test(f))c=f;else break}}function p(a,b){if(!(a<0)){for(var c=a,d=n(b);c<k;c++)if(h[c]){if(d<k&&h[c].test(l[d]))l[c]=l[d],l[d]=e.placeholder;else break;d=n(d)}u(),f.caret(Math.max(j,a))}}function o(a){while(--a>=0&&!h[a]);return a}function n(a){while(++a<=k&&!h[a]);return a}var f=a(this),l=a.map(d.split(""),function(a,b){if(a!="?")return g[a]?e.placeholder:a}),m=f.val();f.data(a.mask.dataName,function(){return a.map(l,function(a,b){return h[b]&&a!=e.placeholder?a:null}).join("")}),f.attr("readonly")||f.one("unmask",function(){f.unbind(".mask").removeData(a.mask.dataName)}).bind("focus.mask",function(){m=f.val();var b=v();u();var c=function(){b==d.length?f.caret(0,b):f.caret(b)};(a.browser.msie?c:function(){setTimeout(c,0)})()}).bind("blur.mask",function(){v(),f.val()!=m&&f.change()}).bind("keydown.mask",r).bind("keypress.mask",s).bind(b,function(){setTimeout(function(){f.caret(v(!0))},0)}),v()})}})})(jQuery)

jQuery(document).ready(function(){
		jQuery('#TGL_HAID').blur(function(){
		var tgl = jQuery(this).val();						  
		if(tgl == ('0000-00-00') || tgl == ('0000-00-00') || tgl == ('00-00-0000') || tgl == ('00/00/0000')  ){
			alert('Tanggal Lahir Tidak Boleh 0000-00-00');
			jQuery(this).val('');
		}
	});
	jQuery('').validate();
	jQuery("#TGL_HAID").mask("9999-99-99");
});
</script>
			
		<tr>
			<td align="left" valign="top"> Tanggal Haid terakhir</td>
			<td><input type="text" value="<?=$datapasien['TGL_HAID']?>" name="TGL_HAID" size="10" id="TGL_HAID"/> ex : 2012-12-12</td>
<!--			onblur="calage(this.value,'umur');"/>
            <a href="javascript:showCal('CAL')"><img align="top" src="img/date.png" border="0" /></a> -->
		</tr>	
		
		<tr>
			<td align="left" valign="top"> Pemeriksaan cervix terakhir</td>
			<td><input type="text" name="PERIKSA_CERVIX" id="PERIKSA_CERVIX" value="<?=$datapasien['PERIKSA_CERVIX']?>" size="10"></td>
		</tr>
		<tr>
			<td align="left" rowspan="8" valign="top"> Pemeriksaan payudara</td>
			<td align="left" rowspan="2" valign="top"> Bentuk payudara</td>
			<? $val_payu = split (",",$datapasien['BENTUK_PAYUDARA']); $i = 0; ?>
			<td><input type="checkbox" name="BENTUK_PAYUDARA[]" value="1" <? if($val_payu[$i]=="1"){echo "checked"; $i++;}?>> Simetris</td>
		</tr>
		<tr>
			<td><input type="checkbox" name="BENTUK_PAYUDARA[]" value="2" <? if($val_payu[$i]=="2"){echo "checked"; $i++;}?>> Asimetris</td>
		</tr>
		<tr>
			<td align="left" valign="top"> Kekenyalan</td>
			<td><input type="text" name="KENYAL" id="kenyal" value="<?=$datapasien['KENYAL']?>" size="5"></td>
		</tr>
		<tr>
			<td align="left" valign="top" rowspan="2">Massa/benjolan </td>
		<? $val_massa = split (",",$datapasien['MASSA']); $i = 0; ?>
			<td><input type="checkbox" name="MASSA[]" value="_1_" <? if (substr($val_massa[$i],0,3)=="_1_"){echo "checked"; $vol_mas = split("_1_",$val_massa[$i]); $i++;}?>>
			Ada <input type="type" name="ADAbenjolan" id="ADAbenjolan" value="<?=$vol_mas[1]?>" size="5"></td>
		</tr>
		<tr>
			<td><input type="checkbox" name="MASSA[]" value="2" <? if($val_massa[$i]=="2"){echo "checked"; $i++;}?>> Tidak</td>
		</tr>
		<tr>
			<td align="left" valign="top" rowspan="2"> Nyeri raba</td>
			<? $val_raba = split (",",$datapasien['NYERI_RABA']); $i = 0; ?>
			<td><input type="checkbox" name="NYERI_RABA[]" value="_1_" <? if (substr($val_raba[$i],0,3)=="_1_"){echo "checked"; $vol_raba = split("_1_",$val_raba[$i]); $i++;}?>>
			Ada <input type="text" name="nyeri" id="nyeri" size="5" value="<?=$vol_raba[1]?>"></td>
		</tr>
		<tr>
			<td><input type="checkbox" name="NYERI_RABA[]" value="2" <? if($val_raba[$i]=="2"){echo "checked"; $i++;}?>> Tidak</td>
		</tr>
		<tr>
		<td>Bentuk puting susu</td>
		<td><input type="type" name="BENTUK_PUTING" id="BENTUK_PUTING" value="<?=$datapasien['BENTUK_PUTING']?>" size="10"></td>
		</tr>
		<tr>
			<td align="left" valign="top"> Mammografi terakhir tgl</td>
			<td><input type="type" name="MAMMO" id="MAMMO" size="10" value="<?=$datapasien['MAMMO']?>"></td>
		</tr>
		<tr>
			<td align="left" valign="top"> Penggunaan alat kontrasepsi</td>
			<td><input type="type" name="ALAT_KONTRASEPSI" id="ALAT_KONTRASEPSI" size="10" value="<?=$datapasien['ALAT_KONTRASEPSI']?>"></td>
		</tr>
		<tr>
			<td align="left" valign="top" rowspan="2"> Permasalahan seksual/reproduksi</td>
			<td><input type="type" name="masalah_seks" id="masalah_seks" size="32" value="<?=$datapasien['MASALAH_SEKS']?>"></td>
		</tr>
		<tr>
			<td>&nbsp;</td></tr>
		<tr>
			<td align="left" rowspan="17" valign="top"> Laki-laki</td>
			<td align="left" rowspan="3" valign="top"> Genitalia</td>
			<td align="left" rowspan="2" valign="top"> Preputium</td>
			</tr>
			<? $val_pre = split (",",$datapasien['PREPUTIUM']); $i = 0; ?>
		<tr>
			<td><select name="PREPUTIUM[]" class="text">
			<option value=""> --pilih-- </option>
			<option value="1" <? if($val_pre[$i]=="1"){echo "selected=Selected"; $i++;}?>> Bersih</option>
			<option value="2" <? if($val_pre[$i]=="2"){echo "selected=Selected"; $i++;}?>> Kotor</option>
			</select></td></tr>
		<tr>
		<td align="left"><input type="checkbox" name="PREPUTIUM[]" value="3" <? if($val_pre[$i]=="3"){echo "checked"; $i++;}?>> Kelainan congenital</td>
		</tr>
		<tr>
			<td>&nbsp;</td></tr>
		<tr>
			<td align="left" rowspan="13" valign="top"> Seksual</td>
			</tr>
		<tr>
			<td align="left" valign="top"> Masalah prostat</td>
			<td><input type="text" name="masalah_prostat" id="masalah_prostat" value="<?=$datapasien['MASALAH_PROSTAT']?>" size='10'></td>
			</tr>
		<tr>
			<td align="left" rowspan="9" valign="top"> Pemeriksaan skrotum</td>
			<td align="left" rowspan='2' valign='top'> Bentuk skrotum</td>
			<? $val_skr = split (",",$datapasien['BENTUK_SKROTUM']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="BENTUK_SKROTUM[]" value="1" <? if($val_skr[$i]=="1"){echo "checked"; $i++;}?>> Simetris</td>
			</tr>
		<tr>
		<td align="left"><input type="checkbox" name="BENTUK_SKROTUM[]" value="2" <? if($val_skr[$i]=="2"){echo "checked"; $i++;}?>> Asimetris</td>
		</tr>
		<tr>
			<td align="left" rowspan='2' valign='top'> Testis</td>
			<? $val_tes = split (",",$datapasien['TESTIS']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="TESTIS[]" value="1" <? if($val_tes[$i]=="1"){echo "checked"; $i++;}?>> Lengkap</td>
			</tr>
		<tr>
		<td align="left"><input type="checkbox" name="TESTIS[]" value="2" <? if($val_skr[$i]=="2"){echo "checked"; $i++;}?>> Tidak lengkap</td>
		</tr>
		<tr>
			<td align="left" rowspan='2' valign='top'> Massa/benjolan</td>
			<? $val_benjolan = split (",",$datapasien['MASSA_BEN']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="MASSA_BEN[]" value="_1_" <? if(substr($val_benjolan[$i],0,3)=="_1_"){echo "checked"; $vol_benjolan = split("_1_",$val_benjolan[$i]); $i++;}?>>
			Ada <input type="text" name="ADAmassa" id="ADAmassa" size='3' value="<?=$vol_benjolan[1]?>"></td>
			</tr>
		<tr>
		<td align="left"><input type="checkbox" name="MASSA_BEN[]" value="_2_" <? if($val_benjolan[$i]=="_2_"){echo "checked"; $i++;}?>> Tidak</td>
		</tr>
		<tr>
			<td align="left" rowspan='2' valign='top'> Herniasi</td>
			<? $val_her = split (",",$datapasien['HERNIASI']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="HERNIASI[]" value="_1_" <? if(substr($val_her[$i],0,3)=="_1_"){echo "checked"; $vol_her = split("_1_",$val_her[$i]); $i++;}?>>
			Ada <input type="text" name="ada_hernia" id="ada_hernia" size='3' value="<?=$vol_her[1]?>"></td>
			</tr>
		<tr>
		<td align="left"><input type="checkbox" name="HERNIASI[]" value="_2_" <? if($val_her[$i]=="_2_"){echo "checked"; $i++;}?>> Tidak</td>
		</tr>
		<tr>
			<td align="left" valign='top'> Lainnya 
			<input type="text" name="LAIN2" id="LAIN2" value="<?=$datapasien['LAIN2']?>" size='10'></td>
			</tr>
		<tr>
			<td align="left" valign='top'> Penggunaan alat kontrasepsi</td>
			<td><input type="text" name="ALAT_KONTRA" id="ALAT_KONTRA" value="<?=$datapasien['ALAT_KONTRA']?>"></td>
			</tr>
		<tr>
		<td align="left" valign="top">Permasalahan seksual/reproduksi</td>
		<td><input type="text" name="masalah_reproduksi" id="masalah_reproduksi" value="<?=$datapasien['MASALAH_REPRO']?>"></td>
		</tr>
		
		<tr>
			<td align="left" rowspan="15" valign="top"> Ekstremitas Atas</td>
			<? $val_atas = split (",",$datapasien['EKSTREMITAS_ATAS']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_ATAS[]" value="_1_" <? if(substr($val_atas[$i],0,3)=="_1_"){echo "checked"; $vol_atas = split("_1_",$val_atas[$i]); $i++;}?>>
			Kekuatan otot <input type="text" name="ekstrem_atas" id="ekstrem_atas" value="<?=$vol_atas[1]?>"></td>
			</tr>
		<tr>
			<td align="left" rowspan='2' valign='top'> ROM</td>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_ATAS[]" value="_2_" <? if($val_atas[$i]=="_2_"){echo "checked"; $i++;}?>> Normal</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_ATAS[]" value="_3_" <? if($val_atas[$i]=="_3_"){echo "checked"; $i++;}?>> Tidak</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_ATAS[]" value="_4_" <? if($val_atas[$i]=="_4_"){echo "checked"; $i++;}?>> Paralysis</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_ATAS[]" value="_5_" <? if($val_atas[$i]=="_5_"){echo "checked"; $i++;}?>> Deformitas</td>
			</tr>
		<tr>
			<td align="left" rowspan='2' valign='top'>Riwayat patah tulang</td>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_ATAS[]" value="_6_" <? if(substr($val_atas[$i],0,3)=="_6_"){echo "checked"; $vol_atas2 = split("_6_",$val_atas[$i]); $i++;}?>>
			Ada <input type="text" name="ada_patah" id="ada_patah" value="<?=$vol_atas2[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_ATAS[]" value="_7_" <? if($val_atas[$i]=="_7_"){echo "checked"; $i++;}?>> Tidak</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_ATAS[]" value="_8_" <? if($val_atas[$i]=="_8_"){echo "checked"; $i++;}?>> Tremor</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_ATAS[]" value="_9_" <? if(substr($val_atas[$i],0,3)=="_9_"){echo "checked"; $vol_atas3 = split("_9_",$val_atas[$i]); $i++;}?>>
			Herni/para plegi <input type="text" name="herni" id="herni" value="<?=$vol_atas3[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_ATAS[]" value="_P_" <? if(substr($val_atas[$i],0,3)=="_P_"){echo "checked"; $vol_atas4 = split("_P_",$val_atas[$i]); $i++;}?>>
			Parese <input type="text" name="parese" id="parese" value="<?=$vol_atas4[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_ATAS[]" value="_K_" <? if(substr($val_atas[$i],0,3)=="_K_"){echo "checked"; $vol_atas5 = split("_K_",$val_atas[$i]); $i++;}?>>
			Kelainan kongenital <input type="text" name="kelainan_ekstrem" id="kelainan_ekstrem" value="<?=$vol_atas5[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_ATAS[]" value="_12_" <? if($val_atas[$i]=="_12_"){echo "checked"; $i++;}?>> Inkoordinasi</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_ATAS[]" value="_13_" <? if($val_atas[$i]=="_13_"){echo "checked"; $i++;}?>> Edema</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_ATAS[]" value="_14_" <? if($val_atas[$i]=="_14_"){echo "checked"; $i++;}?>> Rasa baal</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_ATAS[]" value="_L_" <? if(substr($val_atas[$i],0,3)=="_L_"){echo "checked"; $vol_atas6 = split("_L_",$val_atas[$i]); $i++;}?>>
			Kelainan <input type="text" name="kelainan" id="kelainan" value="<?=$vol_atas6[1]?>"></td>
			</tr>
		
		<tr>
			<td align="left" rowspan="22" valign="top"> Ekstremitas Bawah</td>
			<td align="left" rowspan='3' valign='top'> Aktivitas</td>
			</tr>
			<? $val_aktiv = split(",",$datapasien['AKTIVITAS']); $i = 0; ?>
		<tr>
			<td align="left"><input type="checkbox" name="AKTIVITAS[]" value="1" <? if($val_aktiv[$i]=="1"){echo "checked"; $i++;}?>> Kursi roda</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="AKTIVITAS[]" value="2" <? if($val_aktiv[$i]=="2"){echo "checked"; $i++;}?>> Berjalan</td>
			</tr>
		<tr>
			<td align="left" rowspan='9' valign='top'> Berjalan</td>
			<? $val_jalan = split(",",$datapasien['BERJALAN']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="BERJALAN[]" value="1" <? if($val_jalan[$i]=="1"){echo "checked"; $i++;}?>> Tidak ada kesulitan</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BERJALAN[]" value="2" <? if($val_jalan[$i]=="2"){echo "checked"; $i++;}?>> Penurunan kekuatan</td>
			</tr>
		<tr>
			<td align="left" rowspan='2' valign='top'> ROM</td>
			<td align="left"><input type="checkbox" name="BERJALAN[]" value="3" <? if($val_jalan[$i]=="3"){echo "checked"; $i++;}?>> Normal</td>
		</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BERJALAN[]" value="4" <? if($val_jalan[$i]=="4"){echo "checked"; $i++;}?>> Tidak</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BERJALAN[]" value="5" <? if($val_jalan[$i]=="5"){echo "checked"; $i++;}?>> Paralysis</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BERJALAN[]" value="6" <? if($val_jalan[$i]=="6"){echo "checked"; $i++;}?>> Sering jatuh</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BERJALAN[]" value="7" <? if($val_jalan[$i]=="7"){echo "checked"; $i++;}?>> Hilang keseimbangan</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BERJALAN[]" value="8" <? if($val_jalan[$i]=="8"){echo "checked"; $i++;}?>> Deformitas</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="BERJALAN[]" value="9" <? if($val_jalan[$i]=="9"){echo "checked"; $i++;}?>> Riwayat patah tulang</td>
			</tr>
		<tr>
		<? $val_bawah = split(",",$datapasien['EKSTREMITAS_BAWAH']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_BAWAH[]" value="_1_" <? if(substr($val_bawah[$i],0,3)=="_1_"){echo "checked"; $vol_bawah1 = split("_1_",$val_bawah[$i]); $i++;}?>>
			Kekuatan otot <input type="text" name="otot_kuat" id="otot_kuat" value="<?=$vol_bawah1[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_BAWAH[]" value="_2_" <? if($val_bawah[$i]=="_2_"){echo "checked"; $i++;}?>> Kejang</td>
			</tr>
			<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_BAWAH[]" value="_3_" <? if($val_bawah[$i]=="_3_"){echo "checked"; $i++;}?>> Tremor</td>
		</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_BAWAH[]" value="_4_" <? if(substr($val_bawah[$i],0,3)=="_4_"){echo "checked"; $vol_bawah2 = split("_4_",$val_bawah[$i]); $i++;}?>>
			Herni/para plegi <input type="text" name="plegi" id="plegi" value="<?=$vol_bawah2[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_BAWAH[]" value="_5_" <? if(substr($val_bawah[$i],0,3)=="_5_"){echo "checked"; $vol_bawah3 = split("_5_",$val_bawah[$i]); $i++;}?>>
			Parese <input type="text" name="parese_x" id="parese_x" value="<?=$vol_bawah3[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_BAWAH[]" value="_6_" <? if(substr($val_bawah[$i],0,3)=="_6_"){echo "checked"; $vol_bawah4 = split("_6_",$val_bawah[$i]); $i++;}?>>
			Kelainan kongenital <input type="text" name="kelainan_kongenital" id="kelainan_kongenital" value="<?=$vol_bawah4[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_BAWAH[]" value="_7_" <? if($val_bawah[$i]=="_7_"){echo "checked"; $i++;}?>> Inkoordinasi</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_BAWAH[]" value="_8_" <? if($val_bawah[$i]=="_8_"){echo "checked"; $i++;}?>> Edema</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_BAWAH[]" value="_9_" <? if($val_bawah[$i]=="_9_"){echo "checked"; $i++;}?>> Rasa baal</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="EKSTREMITAS_BAWAH[]" value="_L_" <? if(substr($val_bawah[$i],0,3)=="_L_"){echo "checked"; $vol_bawah5 = split("_L_",$val_bawah[$i]); $i++;}?>>
			Kelainan <input type="text" name="LAINkelainan" id="LAINkelainan" value="<?=$vol_bawah5[1]?>"></td>
			</tr>
		<tr>
			<td align="left" rowspan='16' valign='top'> Sistem Integumen</td>
			<? $val_sis = split(",",$datapasien['SISTEM_INTE']); $i = 0; ?>
			<td align="left"><input type="checkbox" name="SISTEM_INTE[]" value="_W_" <? if(substr($val_sis[$i],0,3)=="_W_"){echo "checked"; $vol_sis1 = split("_W_",$val_sis[$i]); $i++;}?>>
			Warna <input type="text" name="SISTEMwarna" id="SISTEMwarna" value="<?=$vol_sis1[1]?>"></td>
			</tr>
		<tr>
			<td align="left" rowspan='2' valign='top'> Kelembaban</td>
			<td align="left"><input type="checkbox" name="SISTEM_INTE[]" value="2" <? if($val_sis[$i]=="2"){echo "checked"; $i++;}?>> Lembab</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="SISTEM_INTE[]" value="3" <? if($val_sis[$i]=="3"){echo "checked"; $i++;}?>> Kering</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="SISTEM_INTE[]" value="4" <? if($val_sis[$i]=="4"){echo "checked"; $i++;}?>> Panas</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="SISTEM_INTE[]" value="5" <? if($val_sis[$i]=="5"){echo "checked"; $i++;}?>> Dingin</td>
			</tr>
		<tr>
			<td align="left" rowspan='2' valign='top'>Turgor kulit</td>
			<td><input type="checkbox" name="SISTEM_INTE[]" value="6" <? if($val_sis[$i]=="6"){echo "checked"; $i++;}?>> Elastis</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="SISTEM_INTE[]" value="7" <? if($val_sis[$i]=="7"){echo "checked"; $i++;}?>> Tidak elastis</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="SISTEM_INTE[]" value="8" <? if($val_sis[$i]=="8"){echo "checked"; $i++;}?>> Lesi</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="SISTEM_INTE[]" value="9" <? if($val_sis[$i]=="9"){echo "checked"; $i++;}?>> Bula</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="SISTEM_INTE[]" value="10" <? if($val_sis[$i]=="10"){echo "checked"; $i++;}?>> Rash</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="SISTEM_INTE[]" value="11" <? if($val_sis[$i]=="11"){echo "checked"; $i++;}?>> Luka parut</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="SISTEM_INTE[]" value="12" <? if($val_sis[$i]=="12"){echo "checked"; $i++;}?>> Luka bakar</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="SISTEM_INTE[]" value="13" <? if($val_sis[$i]=="13"){echo "checked"; $i++;}?>> Lebam</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="SISTEM_INTE[]" value="14" <? if($val_sis[$i]=="14"){echo "checked"; $i++;}?>> Euclema</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="SISTEM_INTE[]" value="15" <? if($val_sis[$i]=="15"){echo "checked"; $i++;}?>> Diaphoresis/kering</td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="SISTEM_INTE[]" value="_L_" <? if(substr($val_sis[$i],0,3)=="_L_"){echo "checked"; $vol_sis2 = split("_L_",$val_sis[$i]); $i++;}?>>
			Lain-lain <input type="text" name="lain-lain" id="lain-lain" value="<?=$vol_sis2[1]?>"></td>
			</tr>
		
		<tr>
			<td align='left' rowspan='20' valign='top'>Kenyamanan (Nyeri)</td>
			<td align='left' valign='top'>Nyeri/tidak nyaman</td>
			<? $val_man = split(",",$datapasien['KENYAMANAN']); $i = 0; ?>
			<td><select name="KENYAMANAN[]" class="text">
			<option value=""> -- pilih -- </option>
			<option value="1" <? if($val_man[$i]=="1"){echo "selected=Selected"; $i++;}?>> Ya</option>
			<option value="2" <? if($val_man[$i]=="2"){echo "selected=Selected"; $i++;}?>> Tidak</option>
			</select></td></tr>
		<tr>
			<td align='left' valign='top'>Nyeri akut di muskuloskeletal</td>
			<td><select name="KENYAMANAN[]" class="text">
			<option value=""> -- pilih -- </option>
			<option value="3" <? if($val_man[$i]=="3"){echo "selected=selected"; $i++;}?>> Ya</option>
			<option value="4" <? if($val_man[$i]=="4"){echo "selected=selected"; $i++;}?>> Tidak</option>
			</select></td></tr>
		<tr>
			<td align="left"><input type="checkbox" name="KENYAMANAN[]" value="_1_" <? if(substr($val_man[$i],0,3)=="_1_"){echo "checked"; $vol_man1 = split("_1_",$val_man[$i]); $i++;}?>>
			Lokasi</td>
			<td><input type="text" name="lokasi" id="lokasi" value="<?=$vol_man1[1]?>"></td>
			</tr>
		<tr>
			<td align="left">Intensitas (0-10)</td>
			<td><select name='KENYAMANAN[]' class='text'>
			<option value=""> -- pilih --</option>
			<option value='0' <? if($val_man[$i]=="0"){echo "selected=selected"; $i++;}?>> 0</option>
			<option value='1' <? if($val_man[$i]=="1"){echo "selected=selected"; $i++;}?>> 1</option>
			<option value='2' <? if($val_man[$i]=="2"){echo "selected=selected"; $i++;}?>> 2</option>
			<option value='3' <? if($val_man[$i]=="3"){echo "selected=selected"; $i++;}?>> 3</option>
			<option value='4' <? if($val_man[$i]=="4"){echo "selected=selected"; $i++;}?>> 4</option>
			<option value='5' <? if($val_man[$i]=="5"){echo "selected=selected"; $i++;}?>> 5</option>
			<option value='6' <? if($val_man[$i]=="6"){echo "selected=selected"; $i++;}?>> 6</option>
			<option value='7' <? if($val_man[$i]=="7"){echo "selected=selected"; $i++;}?>> 7</option>
			<option value='8' <? if($val_man[$i]=="8"){echo "selected=selected"; $i++;}?>> 8</option>
			<option value='9' <? if($val_man[$i]=="9"){echo "selected=selected"; $i++;}?>> 9</option>
			<option value='10' <? if($val_man[$i]=="10"){echo "selected=selected"; $i++;}?>> 10</option></select></td>
			</tr>	
		<tr>
			<td align="left">Sasaran (0-10)</td>
			<td><select name='KENYAMANAN[]' class='text'>
			<option value=""> -- pilih --</option>
			<option value='11' <? if($val_man[$i]=="11"){echo "selected=selected"; $i++;}?>> 0</option>
			<option value='12' <? if($val_man[$i]=="12"){echo "selected=selected"; $i++;}?>> 1</option>
			<option value='13' <? if($val_man[$i]=="13"){echo "selected=selected"; $i++;}?>> 2</option>
			<option value='14' <? if($val_man[$i]=="14"){echo "selected=selected"; $i++;}?>> 3</option>
			<option value='15' <? if($val_man[$i]=="15"){echo "selected=selected"; $i++;}?>> 4</option>
			<option value='16' <? if($val_man[$i]=="16"){echo "selected=selected"; $i++;}?>> 5</option>
			<option value='17' <? if($val_man[$i]=="17"){echo "selected=selected"; $i++;}?>> 6</option>
			<option value='18' <? if($val_man[$i]=="18"){echo "selected=selected"; $i++;}?>> 7</option>
			<option value='19' <? if($val_man[$i]=="19"){echo "selected=selected"; $i++;}?>> 8</option>
			<option value='20' <? if($val_man[$i]=="20"){echo "selected=selected"; $i++;}?>> 9</option>
			<option value='21' <? if($val_man[$i]=="21"){echo "selected=selected"; $i++;}?>> 10</option></select></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="KENYAMANAN[]" value="_2_" <? if(substr($val_man[$i],0,3)=="_2_"){echo "checked"; $vol_man2 = split("_2_",$val_man[$i]); $i++;}?>>
			Lama nyeri</td>
			<td><input type="text" name="lama_nyeri" id="lama_nyeri" value="<?=$vol_man2[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="KENYAMANAN[]" value="_3_" <? if(substr($val_man[$i],0,3)=="_3_"){echo "checked"; $vol_man3 = split("_3_",$val_man[$i]); $i++;}?>>
			Faktor pencetus</td>
			<td><input type="text" name="faktor_pencetus" id="faktur_pencetus" value="<?=$vol_man3[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="KENYAMANAN[]" value="_4_" <? if(substr($val_man[$i],0,3)=="_4_"){echo "checked"; $vol_man4 = split("_4_",$val_man[$i]); $i++;}?>>
			Kualitas nyeri</td>
			<td><input type="text" name="kualitas_nyeri" id="kualitas_nyeri" value="<?=$vol_man4[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="KENYAMANAN[]" value="_5_" <? if(substr($val_man[$i],0,3)=="_5_"){echo "checked"; $vol_man5 = split("_5_",$val_man[$i]); $i++;}?>>
			Pola serangan</td>
			<td><input type="text" name="pola_serangan" id="pola_serangan" value="<?=$vol_man5[1]?>"></td>
			</tr>
		<tr>
			<td align="left"><input type="checkbox" name="KENYAMANAN[]" value="_6_" <? if(substr($val_man[$i],0,3)=="_6_"){echo "checked"; $vol_man6 = split("_6_",$val_man[$i]); $i++;}?>>
			Hal-hal yang menyebabkan nyeri hilang</td>
			<td><input type="text" name="hal_hal" id="hal_hal" size="40" value="<?=$vol_man6[1]?>"></td>
			</tr>
		<tr>
			<td align="left" rowspan='5' valign='top'>Nyeri mempengaruhi</td>
			<td><input type="checkbox" name="KENYAMANAN[]" value="1" <? if($val_man[$i]=="1"){echo "checked"; $i++;}?>> Tidur</td>
			</tr>
		<tr>
			<td><input type="checkbox" name="KENYAMANAN[]" value="2" <? if($val_man[$i]=="2"){echo "checked"; $i++;}?>> Aktivitas fisik</td>
			</tr>
		<tr>
			<td><input type="checkbox" name="KENYAMANAN[]" value="3" <? if($val_man[$i]=="3"){echo "checked"; $i++;}?>> Emosi</td>
			</tr>
		<tr>
			<td><input type="checkbox" name="KENYAMANAN[]" value="4" <? if($val_man[$i]=="4"){echo "checked"; $i++;}?>> Nafsu makan</td>
			</tr>
		<tr>
			<td><input type="checkbox" name="KENYAMANAN[]" value="5" <? if($val_man[$i]=="5"){echo "checked"; $i++;}?>> Konsentrasi</td>
			</tr>
			</table>
			</fieldset> 
			</div>
		
		<div id="109" class="tab_content">
		<fieldset class="fieldset">
	  <table width="317" border="0" cellspacing="0" class="tb">
                <tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['NOMR']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>
			</fieldset>
			
<fieldset class="fieldset">
<table width="100%" align="center" border="0" cellspacing="0" class="tb">
            <tr>
              <td rowspan='7' valign='top'>Keseimbangan diri</td>
			  <?$val = split(",",$datapasien['KES_DIRI']); $i = 0;?>
			  <td><input type="checkbox" name="KES_DIRI[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;} ?>> Tidak semangat</td>
			</tr>
			<tr>
             <td><input type="checkbox" name="KES_DIRI[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;} ?>> Rasa tertekan</td>
			  </tr>
	       <tr>
         	  <td><input type="checkbox" name="KES_DIRI[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;} ?>> Sulit tidur</td>
			  </tr>
	        <tr>
              <td><input type="checkbox" name="KES_DIRI[]" value="4" <? if($val[$i]=="4"){echo "Checked"; $i++;} ?>> Cepat lelah</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="KES_DIRI[]" value="5" <? if($val[$i]=="5"){echo "Checked"; $i++;} ?>> Sulit berbicara</td>
			  </tr>
			 <tr>
              <td><input type="checkbox" name="KES_DIRI[]" value="6" <? if($val[$i]=="6"){echo "Checked"; $i++;} ?>> Merasa bersalah</td>
			  </tr>
			 <tr>
				<td>&nbsp;</td></tr>

			<tr>
				<td align="left" rowspan="6" valign="top">Sosial support</td>
				 <?$val = split(",",$datapasien['SOS_SUPORT']); $i = 0;?>
              <td><input type="checkbox" name="SOS_SUPORT[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;} ?>> Suami</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="SOS_SUPORT[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;} ?>> Orang tua</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="SOS_SUPORT[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;} ?>> Mertua</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="SOS_SUPORT[]" value="4" <? if($val[$i]=="4"){echo "Checked"; $i++;} ?>> Anak</td>
			  </tr>
			<tr>
            <td><input type="checkbox" name="SOS_SUPORT[]" value="_L_" <? if(substr($val[$i],0,3)=="_L_"){echo "Checked"; $vol = split("_L_",$val[$i]); $i++;} ?>> Anak
			  Keluarga lain <input type="text" value="<?=$vol[1]?>" name="lainKEL" id="lainKEL"></td>
			  </tr>
			<tr>
				<td>&nbsp;</td></tr>
			<tr>
              <td>Ansietas (skala 1-10)</td>
				<td><input type="text" name="ANSIETAS" id="ANSIETAS" value="<?=$datapasien['ANSIETAS']?>"></td>
			  </tr>
			  <tr>
			  <td>&nbsp;</td></tr>
			
			<tr>
				<td rowspan='5' valign='top'>Kehilangan</td>
				<? $val = split (",",$datapasien['KEHILANGAN']); $i = 0;?>
              <td><input type="checkbox" name="KEHILANGAN[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;} ?>> Harga diri</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="KEHILANGAN[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;} ?>> Body image</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="KEHILANGAN[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;} ?>> Peran diri</td>
			  </tr>
			<tr>
			<td><input type="checkbox" name="KEHILANGAN[]" value="_L_" <? if(substr($val[$i],0,3)=="_L_"){echo "Checked"; $vol_4 = split("_L_",$val[$i]); $i++;} ?>>
			Lainnya <input type="text" value="<?=$vol_4[1]?>" name="lainHILANG" id="lainHILANG"></td>
			  </tr>
			<tr>
				<td>&nbsp;</td></tr>
			<tr>
			<td rowspan='5' valign='top'>Status emosi</td>
			<? $val = split (",",$datapasien['STATUS_EMOSI']); $i = 0;?>
              <td><input type="checkbox" name="STATUS_EMOSI[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;} ?>> Sedih</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="STATUS_EMOSI[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;} ?>> Marah</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="STATUS_EMOSI[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;} ?>> Gembira</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="STATUS_EMOSI[]" value="4" <? if($val[$i]=="4"){echo "Checked"; $i++;} ?>> Curiga</td>
			  </tr>
			<tr>
				<td>&nbsp;</td></tr>
			<tr>
				<td rowspan='6' valign='top'>Konsep diri</td>
				<? $val = split (",",$datapasien['KONSEP_DIRI']); $i = 0;?>
              <td><input type="checkbox" name="KONSEP_DIRI[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;} ?>> Citra diri</td>
			  </tr>
			<tr>
            <td><input type="checkbox" name="KONSEP_DIRI[]" value="_I_" <? if(substr($val[$i],0,3)=="_I_"){echo "Checked"; $vol_1 = split("_I_",$val[$i]); $i++;} ?>>
			  Identitas <input type="text" name="identitas" id="identitas" value="<?=$vol_1[1]?>"></td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="KONSEP_DIRI[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;} ?>> Peran</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="KONSEP_DIRI[]" value="4" <? if($val[$i]=="4"){echo "Checked"; $i++;} ?>> Ideal diri</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="KONSEP_DIRI[]" value="_H_" <? if(substr($val[$i],0,3)=="_H_"){echo "Checked"; $vol_2 = split("_H_",$val[$i]); $i++;} ?>>
			  Harga diri <input type="text" name="harga_diri" id="harga_diri" value="<?=$vol_2[1]?>"></td>
			  </tr>
			<tr>
				<td>&nbsp;</td></tr>
			<tr>
				<td rowspan='6' valign='top'>Respon terhadap kehilangan</td>
				<? $val = split (",",$datapasien['RESPON_HILANG']); $i = 0;?>
              <td><input type="checkbox" name="RESPON_HILANG[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;} ?>> Denial (Menolak/tidak percaya)</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="RESPON_HILANG[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;} ?>> Anger (Marah)</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="RESPON_HILANG[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;} ?>> Bargaining (Tawar menawar)</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="RESPON_HILANG[]" value="4" <? if($val[$i]=="4"){echo "Checked"; $i++;} ?>> Depresi</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="RESPON_HILANG[]" value="5" <? if($val[$i]=="5"){echo "Checked"; $i++;} ?>> Menerima (Acception)</td>
			  </tr>
			<tr>
				<td>&nbsp;</td></tr>
			<tr>
				<td rowspan='4' valign='top'>Sumber stress bagi pasien</td>
				<? $val = split (",",$datapasien['SUMBER_STRESS']); $i = 0;?>
              <td><input type="checkbox" name="SUMBER_STRESS[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;} ?>> Diri sendiri</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="SUMBER_STRESS[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;} ?>> Keluarga</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="SUMBER_STRESS[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;} ?>> Orang terdekat</td>
			  </tr>
			<tr>
              <td><input type="checkbox" name="SUMBER_STRESS[]" value="4" <? if($val[$i]=="4"){echo "Checked"; $i++;} ?>> Lingkungan</td>
			  </tr>
			  </table>
			  </fieldset>
			  </div>
			 
			  
			  
			  <div id="101" class="tab_content3">
				<ul class="tabs">
					
              
            <li><span id="#110">Sosial</span></li>
					
              
            <li><span id="#111">Budaya</span></li>
					
              
            <li><span id="#112">Spiritual</span></li>
					
              
            <li><span id="#113">Kebutuhan Edukasi Pasien</span></li>
					
              
            <li><span id="#114">Pola Kebiasaan</span></li>
					
              
            <li><span id="#115">Hasil Pemeriksaan</span></li>
					
              
            <li><span id="#116">Prioritas Resiko Masalah</span></li>
					
              
            <li><span id="#119">Tindakan Medis</span></li>
					
              
            <li><span id="#117">Alasan Alih Rawat Internal</span></li>
					
              
            <li><span id="#118">Alasan Rujuk Eksternal</span></li>
			  
			  
            <li><span id="#120">Skoring</span></li>
			   
            <li><span id="#121">Data Vital</span></li>
			</ul>
			
			<!--<form id="order_lab">-->
			<div id="110" class="tab_content">
			  <fieldset class="fieldset">
	  <table width="317" border="0" cellspacing="0" class="tb">
                <tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['NOMR']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>
			<!--</form>-->
			</fieldset>
			
<fieldset class="fieldset">
<table width="100%" align="center" border="0" cellspacing="0" class="tb">
            <tr>
              <td rowspan='5' valign='top' width='35%'>Orang yang paling berarti</td>
			  <?$val = split(",",$datapasien['BERARTI']); $i = 0;?>
			  <td colspan='3' ><input type="checkbox" name="BERARTI[]" value="_1_" <? if($val[$i]=="_1_"){echo "Checked"; $i++;}?> /> Suami/Istri</td>
			</tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="BERARTI[]" value="_2_" <? if($val[$i]=="_2_"){echo "Checked"; $i++;}?> /> Orangtua</td>
			  </tr>
	       <tr>
         	  <td colspan='3'><input type="checkbox" name="BERARTI[]" value="_3_" <? if($val[$i]=="_3_"){echo "Checked"; $i++;}?> /> Anak</td>
			  </tr>
	        <tr>
              <td colspan='3'><input type="checkbox" name="BERARTI[]" value="_4_" <? if($val[$i]=="_4_"){echo "Checked"; $i++;}?> /> Sahabat</td>
			  </tr>
			<tr>
              <td colspan='1' width='8%'><input type="checkbox" name="BERARTI[]" value="_L_" <? if(substr($val[$i],0,3)=="_L_"){echo "Checked";}?> /> Lain-lain </td>
			  <?$val2 = split("_L_",$val[$i]);?>
			  <td colspan='2'><input type="text" value= "<?=$val2[1]?>" name="lainBERARTI" id="lainBERARTI"></td>
			  </tr>
			<tr>
				<td >Keterlibatan pasien dalam kelompok/masyarakat/organisasi</td>
              <td colspan='3'><select name="TERLIBAT" class="text">
            <option value=""> --pilih-- </option>
            <option value="Y" <? if($datapasien['TERLIBAT']=="Y")echo "selected=Selected";?> >Ya</option>
            <option value="T" <? if($datapasien['TERLIBAT']=="T")echo "selected=Selected";?> >Tidak</option>
          </select></td>
			  </tr>
			<tr>
			  <td>Hambatan dalam berhubungan dengan orang lain</td>
              <td colspan='3'><select name="HUBUNGAN" class="text">
            <option value=""> --pilih-- </option>
            <option value="Y" <? if($datapasien['HUBUNGAN']=="Y")echo "selected=Selected";?> >Ya</option>
            <option value="T" <? if($datapasien['HUBUNGAN']=="T")echo "selected=Selected";?> >Tidak</option>
          </select></td>
			  </tr>
			<tr>
				<td rowspan='14' valign='top'>Komunikasi</td>
				<?$val = split(",",$datapasien['KOMUNIKASI']); $i = 0;?>
				<td colspan='3'><input type="checkbox" name="KOMUNIKASI[]" value="_1_" <? if($val[$i]=="_1_"){echo "Checked"; $i++;}?> /> Sedikit bicara</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="KOMUNIKASI[]" value="_2_" <? if($val[$i]=="_2_"){echo "Checked"; $i++;}?> /> Nada bicara rendah/tinggi</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="KOMUNIKASI[]" value="_3_" <? if($val[$i]=="_3_"){echo "Checked"; $i++;}?> /> Sopan</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="KOMUNIKASI[]" value="_4_" <? if($val[$i]=="_4_"){echo "Checked"; $i++;}?> /> Ekspresi wajah</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="KOMUNIKASI[]" value="_5_" <? if($val[$i]=="_5_"){echo "Checked"; $i++;}?> /> Ramah saat berkomunikasi</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="KOMUNIKASI[]" value="_6_" <? if($val[$i]=="_6_"){echo "Checked"; $i++;}?> /> Judes saat berkomuniksi</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="KOMUNIKASI[]" value="_7_" <? if($val[$i]=="_7_"){echo "Checked"; $i++;}?> /> Menjaga jarak saat berkomunikasi</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="KOMUNIKASI[]" value="_8_" <? if($val[$i]=="_8_"){echo "Checked"; $i++;}?> /> Menggunakan alat bantu saat berkomunikasi</td>
			  </tr>
			<tr>
              <td colspan='2' width='28%'><input type="checkbox" name="KOMUNIKASI[]" value="_9_" <? if(substr($val[$i],0,3)=="_9_"){echo "Checked"; $val3 = split("_9_",$val[$i]); $i++;}?> /> Komunikasi dalam keluarga </td>
			  <td><input type="text" value= "<?=$val3[1]?>" name="komunikasi_kel" id="komunikasi_kel"></td>
			  </tr>
			<tr>
              <td colspan='2'><input type="checkbox" name="KOMUNIKASI[]" value="_10_" <? if(substr($val[$i],0,4)=="_10_"){echo "Checked"; $val4 = split("_10_",$val[$i]); $i++;}?> /> Komunikasi dalam masyarakat </td>
			  <td><input type="text" value= "<?=$val4[1]?>" name="komunikasi_mas" id="komunikasi_mas"></td>
			  </tr>
			<tr>
              <td colspan='2'><input type="checkbox" name="KOMUNIKASI[]" value="_11_" <? if(substr($val[$i],0,4)=="_11_"){echo "Checked"; $val5 = split("_11_",$val[$i]); $i++;}?> /> Bahasa yang digunakan dalam berkomunikasi </td>
			  <td><input type="text" value= "<?=$val5[1]?>" name="bahasaKOMUNIKASI" id="bahasaKOMUNIKASI"></td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="KOMUNIKASI[]" value="_12_" <? if($val[$i]=="_12_"){echo "Checked"; $i++;}?> /> Introvert</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="KOMUNIKASI[]" value="_13_" <? if($val[$i]=="_13_"){echo "Checked"; $i++;}?> /> Ekstrovert</td>
			  </tr>
			<tr>
              <td colspan='1'><input type="checkbox" name="KOMUNIKASI[]" value="_14_" <? if(substr($val[$i],0,4)=="_14_"){echo "Checked"; $val6 = split("_14_",$val[$i]); $i++;}?> /> Lain-lain </td>
			  <td colspan='2'><input type="text" value= "<?=$val6[1]?>" name="lainKOMUNIKASI" id="lainKOMUNIKASI"></td>
			  </tr>
			<tr>
				<td rowspan='6' valign='top'>Pengambilan keputusan dalam keluarga</td>
				<?$val = split(",",$datapasien['KEPUTUSAN']); $i = 0;?>
              <td colspan='3'><input type="checkbox" name="KEPUTUSAN[]" value="_1_" <? if($val[$i]=="_1_"){echo "Checked"; $i++;}?> /> Diri sendiri</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="KEPUTUSAN[]" value="_2_" <? if($val[$i]=="_2_"){echo "Checked"; $i++;}?> /> Suami/Istri</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="KEPUTUSAN[]" value="_3_" <? if($val[$i]=="_3_"){echo "Checked"; $i++;}?> /> Orangtua</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="KEPUTUSAN[]" value="_4_" <? if($val[$i]=="_4_"){echo "Checked"; $i++;}?> /> Anak</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="KEPUTUSAN[]" value="_5_" <? if($val[$i]=="_5_"){echo "Checked"; $i++;}?> /> Musyawarah</td>
			  </tr>
			<tr>
              <td colspan='1'><input type="checkbox" name="KEPUTUSAN[]" value="_6_" <? if(substr($val[$i],0,3)=="_6_"){echo "Checked"; $val7 = split("_6_",$val[$i]); $i++;}?> /> Lain-lain </td>
			  <td><input type="text" value= "<?=$val7[1]?>" name="lainKEPUTUSAN" id="lainKEPUTUSAN"></td>
			  </tr>
			<tr>
				<td rowspan='5' valign='top'>Orang yang mengasuh dalam kehidupan pasien</td>
				<?$val = split(",",$datapasien['MENGASUH']); $i = 0;?>
              <td colspan='3'><input type="checkbox" name="MENGASUH[]" value="_1_" <? if($val[$i]=="_1_"){echo "Checked"; $i++;}?> /> Orangtua</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="MENGASUH[]" value="_2_" <? if($val[$i]=="_2_"){echo "Checked"; $i++;}?> /> Nenek/Kakek</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="MENGASUH[]" value="_3_" <? if($val[$i]=="_3_"){echo "Checked"; $i++;}?> /> Keluarga dekat</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="MENGASUH[]" value="_4_" <? if($val[$i]=="_4_"){echo "Checked"; $i++;}?> /> Pembantu</td>
			  </tr>
			<tr>
              <td colspan='1'><input type="checkbox" name="MENGASUH[]" value="_5_" <? if(substr($val[$i],0,3)=="_5_"){echo "Checked"; $val8 = split("_5_",$val[$i]); $i++;}?> /> Lain-lain </td>
			  <td><input type="text" value= "<?=$val8[1]?>" name="lainMENGASUH" id="lainMENGASUH"></td>
			  </tr>
			
			<tr>
				<td rowspan='3' valign='top'>Dukungan Keluarga</td>
				<?$val = split(",",$datapasien['DUKUNGAN']); $i = 0;?>
              <td colspan='3'><input type="checkbox" name="DUKUNGAN[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;}?> /> Aktif</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="DUKUNGAN[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;}?> /> Kurang</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="DUKUNGAN[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;}?> /> Tidak ada</td>
			  </tr>
			
			<tr>
				<td rowspan='5' valign='top'>Reaksi selama interaksi</td>
				<?$val = split(",",$datapasien['REAKSI']); $i = 0;?>
              <td colspan='3'><input type="checkbox" name="REAKSI[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;}?> /> Kooperatif</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="REAKSI[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;}?> /> Bermusuhan</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="REAKSI[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;}?> /> Defensif</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="REAKSI[]" value="4" <? if($val[$i]=="4"){echo "Checked"; $i++;}?> /> Aktif</td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="REAKSI[]" value="5" <? if($val[$i]=="5"){echo "Checked"; $i++;}?> /> Curiga</td>
			  </tr>
			  </table>
			  </fieldset>
			  </div>
	
			<div id="111" class="tab_content">
			<fieldset class="fieldset">
	  <table width="317" border="0" cellspacing="0" class="tb">
                <tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['NOMR']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>
			</fieldset>
			
<fieldset class="fieldset">
<table width="100%" align="center" border="0" cellspacing="0" class="tb">
            <tr>
              <td rowspan='5' valign='top' width='36%'>Nilai kebudayaan yang dianut terkait penyebab penyakit/masalah kesehatan</td>
			  <?$val = split(",",$datapasien['BUDAYA']); $i = 0;?>
			  <td colspan='3'><input type="checkbox" name="BUDAYA[]" value="_1_" <? if($val[$i]=="_1_"){echo "Checked"; $i++;}?> /> Hukuman</td>
			</tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="BUDAYA[]" value="_2_" <? if($val[$i]=="_2_"){echo "Checked"; $i++;}?> /> Ujian</td>
			  </tr>
	       <tr>
         	  <td colspan='3'><input type="checkbox" name="BUDAYA[]" value="_3_" <? if($val[$i]=="_3_"){echo "Checked"; $i++;}?> /> Kesalahan</td>
			  </tr>
	        <tr>
              <td colspan='3'><input type="checkbox" name="BUDAYA[]" value="_4_" <? if($val[$i]=="_4_"){echo "Checked"; $i++;}?> /> Keturunan</td>
			  </tr>
			<tr>
              <td colspan='1' width='8%'><input type="checkbox" name="BUDAYA[]" value="_5_" <? if(substr($val[$i],0,3)=="_5_"){echo "Checked"; $val9 = split("_5_",$val[$i]); $i++;}?> /> Lain-lain </td>
			  <td colspan='2' width='60%'><input type="text" value= "<?=$val9[1]?>" name="lainBUDAYA" id="lainBUDAYA"></td>
			  </tr>
			<tr>
				<td valign='top'>Kebiasaan pasien saat sehat (pola aktivitas istirahat)</td>
              <td colspan='3' valign='top'><input type="text" value="<?=$datapasien['POLA_AKTIVITAS']?>" name="POLA_AKTIVITAS" id="POLA_AKTIVITAS" size='70'></td>
			  </tr>
			<tr>
				<td valign='top'>Kebiasaan pasien saat sakit (pola aktivitas istirahat)</td>
              <td colspan='3' valign='top'><input type="text" value="<?=$datapasien['POLA_ISTIRAHAT']?>" name="POLA_ISTIRAHAT" id="POLA_ISTIRAHAT" size='70'></td>
			  </tr>
			<tr>
				<td rowspan='3' valign='top'>Pola makan</td>
				<?$val = split(",",$datapasien['POLA_MAKAN']); $i = 0;?>
              <td colspan='3'><input type="checkbox" name="POLA_MAKAN[]" value="_1_" <? if($val[$i]=="_1_"){echo "Checked"; $i++;}?> /> Makan nasi</td>
			  </tr>
			<tr>
              <td colspan='1'><input type="checkbox" name="POLA_MAKAN[]" value="_2_" <? if(substr($val[$i],0,3)=="_2_"){echo "Checked"; $val10 = split("_2_",$val[$i]); $i++;}?> /> Selain nasi </td>
			  <td colspan='2'><input type="text" value= "<?=$val10[1]?>" name="lainPOLA_MAKAN" id="lainPOLA_MAKAN"></td>
			  </tr>
			<tr>
              <td colspan='3'><input type="checkbox" name="POLA_MAKAN[]" value="_3_" <? if($val[$i]=="_3_"){echo "Checked"; $i++;}?> /> Vegetarian</td>
			  </tr>
			<tr>
				<td valign='top'>Pantangan makanan</td>
				<td colspan='3'><select name="PANTANGAN" class="text">
					<option value=""> --pilih-- </option>
					<option value="Y" <? if($datapasien['PANTANGAN']=="Y")echo "selected=Selected";?> >Ya</option>
					<option value="T" <? if($datapasien['PANTANGAN']=="T")echo "selected=Selected";?> >Tidak</option>
				  </select></td>
			  </tr>
			<tr>
				<td rowspan='2' valign='top'>Kepercayaan yang dianut terhadap penyakit</td>
				<td colspan='1'><input type="radio" name="KEPERCAYAAN" value="_1_" <? if(substr($datapasien['KEPERCAYAAN'],0,3)=="_1_")echo "Checked";?>/>
				Ya </td><td colspan='2'><? $val11 = split("_1_",$datapasien['KEPERCAYAAN']); ?><input type="text" value="<?=$val11[1]?>" name="PERCAYA" id="PERCAYA"></td>
			</tr>
			<tr>
              <td colspan='3'><input type="radio" name="KEPERCAYAAN" value="_2_" <? if($datapasien['KEPERCAYAAN']=="_2_")echo "Checked";?> />
				Tidak</td>
			  </tr>
			<tr>
				<td rowspan='2' valign='top'>Pantangan hari</td>
              <td colspan='1'><input type="radio" name="PANTANGAN_HARI" value="_1_" <? if(substr($datapasien['PANTANGAN_HARI'],0,3)=="_1_")echo "Checked";?>/>
				Ya </td><td colspan='2'><? $val12 = split("_1_",$datapasien['PANTANGAN_HARI']); ?><input type="text" value="<?=$val12[1]?>" name="HARI_PANTANGAN" id="HARI_PANTANGAN"></td>
			</tr>
			<tr>
              <td colspan='3'><input type="radio" name="PANTANGAN_HARI" value="_2_" <? if($datapasien['PANTANGAN_HARI']=="_2_")echo "Checked";?> />
				Tidak</td>
			  </tr>
			<tr>
				<td valign='top'>Pantangan lainnya</td>
              <td colspan='3'><input type="text" value="<?=$datapasien['PANTANGAN_LAIN']?>" name="PANTANGAN_LAIN" id="PANTANGAN_LAIN"></td>
			  </tr>
			<tr>
				<td valign='top'>Anjuran yang dianut terhadap penyakit</td>
              <td colspan='3'><input type="text" value="<?=$datapasien['ANJURAN']?>" name="ANJURAN" id="ANJURAN"></td>
			  </tr>
			  </table>
			  </fieldset>
			  </div>
			  
			  <div id="112" class="tab_content">
			   <fieldset class="fieldset">
	  <table width="317" border="0" cellspacing="0" class="tb">
                <tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['NOMR']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>
			</fieldset>
			
<fieldset class="fieldset">
<table width="70%" align="center" border="0" cellspacing="0" class="tb">
            <tr>
              <td valign='top' width='35%'>Nilai dan keyakinan</td>
			  <td colspan='3'><input type="text" value="<?=$datapasien['NILAI_KEYAKINAN']?>" name="NILAI_KEYAKINAN" id="NILAI_KEYAKINAN"></td>
			</tr>
			<tr>
				<td>Kegiatan ibadah</td>
             <td colspan='3'><input type="text" value="<?=$datapasien['KEGIATAN_IBADAH']?>" name="KEGIATAN_IBADAH" id="KEGIATAN_IBADAH"></td>
			  </tr>
	       <tr>
			<td rowspan='2' valign='top'>Pengaruh agama yang dianut terhadap penyakit</td>
         	  <td colspan='1' width='5%'><input type="radio" name="PENG_AGAMA" value="_1_" <? if(substr($datapasien['PENG_AGAMA'],0,3)=="_1_")echo "Checked";?>/>
				Ya </td><td colspan='2'><? $val13 = split("_1_",$datapasien['PENG_AGAMA']); ?><input type="text" value="<?=$val13[1]?>" name="PENGARUH_AGAMA" id="PENGARUH_AGAMA"></td>
			</tr>
			<tr>
              <td colspan='3'><input type="radio" name="PENG_AGAMA" value="_2_" <? if($datapasien['PENG_AGAMA']=="_2_")echo "Checked";?> />
				Tidak</td>
			  </tr>
			<tr>
			<td rowspan='2' valign='top'>Spirit untuk sembuh</td>
         	  <td colspan='1'><input type="radio" name="SPIRIT" value="_1_" <? if(substr($datapasien['SPIRIT'],0,3)=="_1_")echo "Checked";?>/>
				Ya </td><td colspan='2'><? $val14 = split("_1_",$datapasien['SPIRIT']); ?><input type="text" value="<?=$val14[1]?>" name="SPIRIT_SEMBUH" id="SPIRIT_SEMBUH"></td>
			</tr>
			<tr>
              <td colspan='3'><input type="radio" name="SPIRIT" value="_2_" <? if($datapasien['SPIRIT']=="_2_")echo "Checked";?> />
				Tidak</td>
			  </tr>
			<tr>
			<td rowspan='2' valign='top'>Bantuan spiritual yang diperlukan</td>
         	  <td colspan='1'><input type="radio" name="BANTUAN" value="_1_" <? if(substr($datapasien['BANTUAN'],0,3)=="_1_")echo "Checked";?>/>
				Ya </td><td colspan='2'><? $val15 = split("_1_",$datapasien['BANTUAN']); ?><input type="text" value="<?=$val15[1]?>" name="BANTUAN_SPIRITUAL" id="BANTUAN_SPIRITUAL"></td>
			</tr>
			<tr>
              <td colspan='3'><input type="radio" name="BANTUAN" value="_2_" <? if($datapasien['BANTUAN']=="_2_")echo "Checked";?> />
				Tidak</td>
			  </tr>
			  </table>
			  </fieldset>
			  </div>
			  
			  <div id="113" class="tab_content">
			  <fieldset class="fieldset">
	  <table width="317" border="0" cellspacing="0" class="tb">
                <tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['NOMR']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>
			</fieldset>
			
<fieldset class="fieldset">
<table width="80%" align="center" border="0" cellspacing="0" class="tb">
            <tr>
              <td valign='top' rowspan='13'>Kebutuhan belajar</td>
			  <td valign='top'>Pemahaman tentang penyakit</td>
			  <td colspan='3'><select name="PAHAM_PENYAKIT" class="text">
            <option value=""> --pilih-- </option>
            <option value="Y" <? if($datapasien['PAHAM_PENYAKIT']=="Y")echo "selected=Selected";?> >Ya</option>
            <option value="T" <? if($datapasien['PAHAM_PENYAKIT']=="T")echo "selected=Selected";?> >Tidak</option>
          </select></td>
			  </tr>
			<td valign='top'>Pemahaman tentang pengobatan</td>
			  <td colspan='3'><select name="PAHAM_OBAT" class="text">
            <option value=""> --pilih-- </option>
            <option value="Y" <? if($datapasien['PAHAM_OBAT']=="Y")echo "selected=Selected";?> >Ya</option>
            <option value="T" <? if($datapasien['PAHAM_OBAT']=="T")echo "selected=Selected";?> >Tidak</option>
          </select></td>
			  </tr>
			<td valign='top'>Pemahaman tentang nutrisi/diet</td>
			  <td colspan='3'><select name="PAHAM_NUTRISI" class="text">
            <option value=""> --pilih-- </option>
            <option value="Y" <? if($datapasien['PAHAM_NUTRISI']=="Y")echo "selected=Selected";?> >Ya</option>
            <option value="T" <? if($datapasien['PAHAM_NUTRISI']=="T")echo "selected=Selected";?> >Tidak</option>
          </select></td>
			  </tr>
			<td valign='top' rowspan='10'>Pemahaman tentang perawatan</td>
			  <?$val = split(",",$datapasien['PAHAM_RAWAT']); $i = 0;?>
			  <td><input type="checkbox" name="PAHAM_RAWAT[]" value="01" <? if($val[$i]=="01"){echo "Checked"; $i++;}?> /> Aktivitas</td>
			</tr>
			<tr>
             <td><input type="checkbox" name="PAHAM_RAWAT[]" value="02" <? if($val[$i]=="02"){echo "Checked"; $i++;}?> /> Makanan</td>
			  </tr>
			<tr>
             <td><input type="checkbox" name="PAHAM_RAWAT[]" value="03" <? if($val[$i]=="03"){echo "Checked"; $i++;}?> /> Senam/Olahraga</td>
			  </tr>
			<tr>
             <td><input type="checkbox" name="PAHAM_RAWAT[]" value="04" <? if($val[$i]=="04"){echo "Checked"; $i++;}?> /> Perawatan luka dengan proses penyembuhan lama/permanen</td>
			  </tr>
			<tr>
             <td><input type="checkbox" name="PAHAM_RAWAT[]" value="05" <? if($val[$i]=="05"){echo "Checked"; $i++;}?> /> Tumbuh kembang</td>
			  </tr>
			<tr>
             <td><input type="checkbox" name="PAHAM_RAWAT[]" value="06" <? if($val[$i]=="06"){echo "Checked"; $i++;}?> /> Seksual</td>
			  </tr>
			<tr>
             <td><input type="checkbox" name="PAHAM_RAWAT[]" value="07" <? if($val[$i]=="07"){echo "Checked"; $i++;}?> /> Modifikasi lingkungan</td>
			  </tr>
			<tr>
             <td><input type="checkbox" name="PAHAM_RAWAT[]" value="08" <? if($val[$i]=="08"){echo "Checked"; $i++;}?> /> Menejemen stress</td>
			  </tr>
			<tr>
             <td><input type="checkbox" name="PAHAM_RAWAT[]" value="09" <? if($val[$i]=="09"){echo "Checked"; $i++;}?> /> Pencegahan penyakit</td>
			  </tr>
			<tr>
             <td><input type="checkbox" name="PAHAM_RAWAT[]" value="10" <? if($val[$i]=="10"){echo "Checked"; $i++;}?> /> Pencegahan komplikasi</td>
			  </tr>
			<tr>
				<td rowspan='11' valign='top'>Hambatan dalam menerima edukasi</td>
				<?$val = split(",",$datapasien['HAMBATAN_EDUKASI']); $i = 0; $tampungTIDAK_MAMPU = "";?>
             <td><input type="checkbox" name="HAMBATAN_EDUKASI[]" value="01" <? if($val[$i]=="01"){echo "Checked"; $i++;}?> /> Tidak ada hambatan</td>
			  </tr>
			<tr>
             <td><input type="checkbox" name="HAMBATAN_EDUKASI[]" value="02" <? if($val[$i]=="02"){echo "Checked"; $i++;}?> /> Tidak bersedia/tidak termotivasi</td>
			  </tr>
			<tr>
             <td rowspan='9' valign='top'><input type="checkbox" name="HAMBATAN_EDUKASI[]" value="03" <? if($val[$i]=="03"){echo "Checked"; $tampungTIDAK_MAMPU = $val[$i]; $i++;}?> /> Tidak mampu</td>
             <td><input type="checkbox" name="TIDAK_MAMPU[]" value="31" <? if($val[$i]=="31" && $tampungTIDAK_MAMPU=="03"){echo "Checked"; $i++;}?> /> Ada gangguan penglihatan</td>
			  </tr>
			<tr>
             <td><input type="checkbox" name="TIDAK_MAMPU[]" value="32" <? if($val[$i]=="32" && $tampungTIDAK_MAMPU=="03"){echo "Checked"; $i++;}?> /> Ada gangguan</td>
			  </tr>
			<tr>
             <td><input type="checkbox" name="TIDAK_MAMPU[]" value="33" <? if($val[$i]=="33" && $tampungTIDAK_MAMPU=="03"){echo "Checked"; $i++;}?> /> Ada gangguan fisik</td>
			  </tr>
			<tr>
             <td><input type="checkbox" name="TIDAK_MAMPU[]" value="34" <? if($val[$i]=="34" && $tampungTIDAK_MAMPU=="03"){echo "Checked"; $i++;}?> /> Ada gangguan emosi</td>
			  </tr>
			<tr>
             <td><input type="checkbox" name="TIDAK_MAMPU[]" value="35" <? if($val[$i]=="35" && $tampungTIDAK_MAMPU=="03"){echo "Checked"; $i++;}?> /> Ada gangguan kognitif</td>
			  </tr>
			<tr>
             <td><input type="checkbox" name="TIDAK_MAMPU[]" value="36" <? if($val[$i]=="36" && $tampungTIDAK_MAMPU=="03"){echo "Checked"; $i++;}?> /> Buta huruf</td>
			  </tr>
			<tr>
             <td><input type="checkbox" name="TIDAK_MAMPU[]" value="37" <? if($val[$i]=="37" && $tampungTIDAK_MAMPU=="03"){echo "Checked"; $i++;}?> /> Keterbatasan dalam berbahasa</td>
			  </tr>
			<tr>
             <td><input type="checkbox" name="TIDAK_MAMPU[]" value="38" <? if($val[$i]=="38" && $tampungTIDAK_MAMPU=="03"){echo "Checked"; $i++;}?> /> Keterbatasan dalam hal budaya/spiritual/agama</td>
			  </tr>
			<tr>
             <td><input type="checkbox" name="TIDAK_MAMPU[]" value="39" <? if($val[$i]=="39" && $tampungTIDAK_MAMPU=="03"){echo "Checked"; $i++;}?> /> Keterbatasan tingakt pendidikan</td>
			  </tr>
			  </table>
			  </fieldset>
			  </div>
			  
			  <div id="114" class="tab_content">
			    <fieldset class="fieldset">
	  <table width="317" border="0" cellspacing="0" class="tb">
                <tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['NOMR']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>
			</fieldset>
			
<fieldset class="fieldset">
<table width="70%" align="center" border="0" cellspacing="0" class="tb">
            <tr>
              <td valign='top' rowspan='33' colspan='1' width='9%'>Pola makan</td>
			  <td valign='top' rowspan='4' colspan='4'>Frekuensi makan dalam sehari</td>
			  <?$val = split(",",$datapasien['FREK_MAKAN']); $i = 0;?>
			  <td colspan='2'><input type="checkbox" name="FREK_MAKAN[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;}?> /> 1 kali</td>
			</tr>
			<tr>
             <td colspan='2'><input type="checkbox" name="FREK_MAKAN[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;}?> /> 2 kali</td>
			  </tr>
			<tr>
             <td colspan='2'><input type="checkbox" name="FREK_MAKAN[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;}?> /> 3 kali</td>
			  </tr>
			<tr>
             <td colspan='2'><input type="checkbox" name="FREK_MAKAN[]" value="4" <? if($val[$i]=="4"){echo "Checked"; $i++;}?> /> Lebih dari 3 kali</td>
			  </tr>
			<td valign='top' rowspan='3' colspan='3'>Jumlah satu kali makan</td>
			  <?$val = split(",",$datapasien['JUM_MAKAN']); $i = 0;?>
			  <td colspan='3'><input type="checkbox" name="JUM_MAKAN[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;}?> /> Setengah porsi</td>
			</tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="JUM_MAKAN[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;}?> /> 1 porsi</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="JUM_MAKAN[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;}?> /> Lebih dari 1 porsi</td>
			  </tr>
			<td valign='top' rowspan='3' colspan='3'>Jenis</td>
			  <?$val = split(",",$datapasien['JEN_MAKAN']); $i = 0;?>
			  <td colspan='3'><input type="checkbox" name="JEN_MAKAN[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;}?> /> Padat</td>
			</tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="JEN_MAKAN[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;}?> /> Lunak</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="JEN_MAKAN[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;}?> /> Cair</td>
			  </tr>
			<tr>
				<td rowspan='5' valign='top' colspan='4'>Komposisi kandungan makanan</td>
				<?$val = split(",",$datapasien['KOM_MAKAN']); $i = 0;?>
             <td colspan='2'><input type="checkbox" name="KOM_MAKAN[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;}?> /> Karbohidrat</td>
			  </tr>
			<tr>
             <td colspan='2'><input type="checkbox" name="KOM_MAKAN[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;}?> /> Protein</td>
			  </tr>
			<tr>
             <td colspan='2'><input type="checkbox" name="KOM_MAKAN[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;}?> /> Lemak</td>
			  </tr>
			<tr>
             <td colspan='2'><input type="checkbox" name="KOM_MAKAN[]" value="4" <? if($val[$i]=="4"){echo "Checked"; $i++;}?> /> Serat</td>
			  </tr>
			<tr>
             <td colspan='2'><input type="checkbox" name="KOM_MAKAN[]" value="5" <? if($val[$i]=="5"){echo "Checked"; $i++;}?> /> Vitamin & mineral</td>
			  </tr>
			<tr>
				<td rowspan='10' valign='top' colspan='3'>Diet</td>
				<?$val = split(",",$datapasien['DIET']); $i = 0;?>
             <td colspan='3'><input type="checkbox" name="DIET[]" value="_1_" <? if($val[$i]=="_1_"){echo "Checked"; $i++;}?> /> Tidak ada diet tertentu</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="DIET[]" value="_2_" <? if($val[$i]=="_2_"){echo "Checked"; $i++;}?> /> Diet hati</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="DIET[]" value="_3_" <? if($val[$i]=="_3_"){echo "Checked"; $i++;}?> /> Diet jantung</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="DIET[]" value="_4_" <? if($val[$i]=="_4_"){echo "Checked"; $i++;}?> /> Diet ginjal</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="DIET[]" value="_5_" <? if($val[$i]=="_5_"){echo "Checked"; $i++;}?> /> Diet DM</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="DIET[]" value="_6_" <? if($val[$i]=="_6_"){echo "Checked"; $i++;}?> /> Diet garam</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="DIET[]" value="_7_" <? if($val[$i]=="_7_"){echo "Checked"; $i++;}?> /> Diet gula</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="DIET[]" value="_8_" <? if($val[$i]=="_8_"){echo "Checked"; $i++;}?> /> Diet serat</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="DIET[]" value="_9_" <? if($val[$i]=="_9_"){echo "Checked"; $i++;}?> /> Diet asam urat</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="DIET[]" value="_10_" <? if(substr($val[$i],0,4)=="_10_"){echo "Checked"; $val16 = split("_10_",$val[$i]); $i++;}?> /> Diet lainnya <input type="text" value="<?=$val16[1]?>" name="lainDIET" id="lainDIET"></td>
			  </tr>
			<tr>
			<td rowspan='3' valign='top' colspan='3'>Cara makan</td>
			 <?$val = split(",",$datapasien['CARA_MAKAN']); $i = 0;?>
             <td colspan='3'><input type="checkbox" name="CARA_MAKAN[]" value="_1_" <? if($val[$i]=="_1_"){echo "Checked"; $i++;}?> /> Sendiri</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="CARA_MAKAN[]" value="_2_" <? if($val[$i]=="_2_"){echo "Checked"; $i++;}?> /> Dengan bantuan</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="CARA_MAKAN[]" value="_3_" <? if(substr($val[$i],0,3)=="_3_"){echo "Checked"; $val17 = split("_3_",$val[$i]); $i++;}?> /> Lain-lain <input type="text" value="<?=$val17[1]?>" name="lainCARA_MAKAN" id="lainCARA_MAKAN"></td>
			  </tr>
			<tr>
			<td rowspan='5' valign='top' colspan='3'>Gangguan</td>
			 <?$val = split(",",$datapasien['GANGGUAN']); $i = 0;?>
             <td colspan='3'><input type="checkbox" name="GANGGUAN[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;}?> /> Poliphagia</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="GANGGUAN[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;}?> /> Mual</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="GANGGUAN[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;}?> /> Muntah</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="GANGGUAN[]" value="4" <? if($val[$i]=="4"){echo "Checked"; $i++;}?> /> Kemampuan mengunyah</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="GANGGUAN[]" value="5" <? if($val[$i]=="5"){echo "Checked"; $i++;}?> /> Kemampuan menelan</td>
			  </tr>
			<tr>
			<td rowspan='11' valign='top' colspan='1'>Pola minum</td>
             <td colspan='4' valign='top'>Frekuensi minum dalam sehari</td>
			 <td colspan='2'><input type="text" value="<?=$datapasien['FREK_MINUM']?>" name="FREK_MINUM" id="FREK_MINUM"> kali/hari</td>
			  </tr>
			<tr>
			<td valign='top' colspan='3'>Jumlah</td>
             <td colspan='3'><input type="text" value="<?=$datapasien['JUM_MINUM']?>" name="JUM_MINUM" id="JUM_MINUM"> cc</td>
			  </tr>
			<tr>
			<td rowspan='6' valign='top' colspan='3'>Jenis</td>
			 <?$val = split(",",$datapasien['JEN_MINUM']); $i = 0;?>
             <td colspan='3'><input type="checkbox" name="JEN_MINUM[]" value="_1_" <? if($val[$i]=="_1_"){echo "Checked"; $i++;}?> /> Air putih</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="JEN_MINUM[]" value="_2_" <? if($val[$i]=="_2_"){echo "Checked"; $i++;}?> /> Teh</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="JEN_MINUM[]" value="_3_" <? if($val[$i]=="_3_"){echo "Checked"; $i++;}?> /> Kopi</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="JEN_MINUM[]" value="_4_" <? if($val[$i]=="_4_"){echo "Checked"; $i++;}?> /> Susu</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="JEN_MINUM[]" value="_5_" <? if($val[$i]=="_5_"){echo "Checked"; $i++;}?> /> Manis</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="JEN_MINUM[]" value="_6_" <? if(substr($val[$i],0,3)=="_6_"){echo "Checked"; $val18 = split("_6_",$val[$i]); $i++;}?> /> Lain-lain <input type="text" value="<?=$val18[1]?>" name="lainJEN_MINUM" id="lainJEN_MINUM"></td>
			  </tr>
			<tr>
			<td rowspan='3' valign='top' colspan='3'>Gangguan minum</td>
			 <?$val = split(",",$datapasien['GANG_MINUM']); $i = 0;?>
             <td colspan='3'><input type="checkbox" name="GANG_MINUM[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;}?> /> Polidipsi</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="GANG_MINUM[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;}?> /> Kemampuan menelan</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="GANG_MINUM[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;}?> /> Kemampuan menyedot</td>
			  </tr>
			<tr>
			<td rowspan='25' valign='top' colspan='2' width='10%'>Poli eliminasi</td>
			<td rowspan='13' valign='top' colspan='1' width='8%'>BAK</td>
             <td colspan='4' valign='top'>Frekuensi <input type="text" value="<?=$datapasien['FREK_BAK']?>" name="FREK_BAK" id="FREK_BAK"> kali/hari</td>
			  </tr>
			<tr>
			<td rowspan='2' valign='top' colspan='1' width='5%'>Warna</td>
			 <?$val = split(",",$datapasien['WARNA_BAK']); $i = 0;?>
             <td colspan='3'><input type="checkbox" name="WARNA_BAK[]" value="_1_" <? if($val[$i]=="_1_"){echo "Checked"; $i++;}?> /> Jernih</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="WARNA_BAK[]" value="_2_" <? if(substr($val[$i],0,3)=="_2_"){echo "Checked"; $val19 = split("_2_",$val[$i]); $i++;}?> /> Keruh <input type="text" value="<?=$val19[1]?>" name="lainWARNA_BAK" id="lainWARNA_BAK"></td>
			  </tr>
			<tr>
             <td colspan='4'>Jumlah <input type="text" value="<?=$datapasien['JMLH_BAK']?>" name="JMLH_BAK" id="JMLH_BAK"> cc/24 jam</td>
			  </tr>
			<tr>
			<td colspan='2'>Penggunaan kateter</td>
             <td colspan='2'><select name="PENG_KAT_BAK" class="text">
				<option value=""> --pilih-- </option>
				<option value="Y" <? if($datapasien['PENG_KAT_BAK']=="Y")echo "selected=Selected";?> >Ya</option>
				<option value="T" <? if($datapasien['PENG_KAT_BAK']=="T")echo "selected=Selected";?> >Tidak</option>
			  </select></td>
			  </tr>
			<tr>
			<td colspan='2' width='15%'>Kemampuan menahan BAK</td>
             <td colspan='2'><select name="KEM_HAN_BAK" class="text">
				<option value=""> --pilih-- </option>
				<option value="Y" <? if($datapasien['KEM_HAN_BAK']=="Y")echo "selected=Selected";?> >Ya</option>
				<option value="T" <? if($datapasien['KEM_HAN_BAK']=="T")echo "selected=Selected";?> >Tidak</option>
			  </select></td>
			  </tr>
			<tr>
			<td colspan='1'>Inkontinensia</td>
             <td colspan='3'><select name="INKONT_BAK" class="text">
				<option value=""> --pilih-- </option>
				<option value="Y" <? if($datapasien['INKONT_BAK']=="Y")echo "selected=Selected";?> >Ya</option>
				<option value="T" <? if($datapasien['INKONT_BAK']=="T")echo "selected=Selected";?> >Tidak</option>
			  </select></td>
			  </tr>
			<tr>
			<td rowspan='6' valign='top' colspan='1'>Diuresis</td>
			 <?$val = split(",",$datapasien['DIURESIS_BAK']); $i = 0;?>
             <td colspan='3'><input type="checkbox" name="DIURESIS_BAK[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;}?> /> Poliuri</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="DIURESIS_BAK[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;}?> /> Anuri</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="DIURESIS_BAK[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;}?> /> Enuriis</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="DIURESIS_BAK[]" value="4" <? if($val[$i]=="4"){echo "Checked"; $i++;}?> /> Hematuri</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="DIURESIS_BAK[]" value="5" <? if($val[$i]=="5"){echo "Checked"; $i++;}?> /> Nokturi</td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="DIURESIS_BAK[]" value="6" <? if($val[$i]=="6"){echo "Checked"; $i++;}?> /> Disuri</td>
			  </tr>
			<tr>
			<td rowspan='12' valign='top' colspan='1'>BAB</td>
             <td valign='top' colspan='4'>Frekuensi <input type="text" value="<?=$datapasien['FREK_BAB']?>" name="FREK_BAB" id="FREK_BAB"> kali/hari</td>
			  </tr>
			<tr>
			<td colspan='4'>Warna <input type="text" value="<?=$datapasien['WARNA_BAB']?>" name="WARNA_BAB" id="WARNA_BAB"> </td>
			  </tr>
			<td rowspan='3' valign='top' colspan='1'>Konsistensi</td>
			 <?$val = split(",",$datapasien['KONSIST_BAB']); $i = 0;?>
             <td colspan='3'><input type="checkbox" name="KONSIST_BAB[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;}?> /> Lunak</td>
			  </tr>
             <td colspan='3'><input type="checkbox" name="KONSIST_BAB[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;}?> /> Keras</td>
			  </tr>
             <td colspan='3'><input type="checkbox" name="KONSIST_BAB[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;}?> /> Cair</td>
			  </tr>
			<td rowspan='3' valign='top' colspan='2'>Gangguan BAB</td>
			<?$val = split(",",$datapasien['GANG_BAB']); $i = 0;?>
             <td colspan='2'><input type="checkbox" name="GANG_BAB[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;}?> /> Obstipasi</td>
			  </tr>
			<td colspan='2'><input type="checkbox" name="GANG_BAB[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;}?> /> Konstipasi</td>
			  </tr>
			<td colspan='2'><input type="checkbox" name="GANG_BAB[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;}?> /> Nkontinensia alvi</td>
			  </tr>
			<tr>
			<td rowspan='3' valign='top' colspan='1'>Stoma</td>
			 <?$val = split(",",$datapasien['STOMA_BAB']); $i = 0;?>
             <td colspan='3'><input type="checkbox" name="STOMA_BAB[]" value="_1_" <? if($val[$i]=="_1_"){echo "Checked"; $i++;}?> /> Ya</td>
			<tr>
             <td colspan='3'><input type="checkbox" name="STOMA_BAB[]" value="_2_" <? if(substr($val[$i],0,3)=="_2_"){echo "Checked"; $val20 = split("_2_",$val[$i]); $i++;}?> /> Kondisi stoma <input type="text" value="<?=$val20[1]?>" name="lainSTOMA_BAB" id="lainSTOMA_BAB"> </td>
			  </tr>
			<tr>
             <td colspan='3'><input type="checkbox" name="STOMA_BAB[]" value="_3_" <? if($val[$i]=="_3_"){echo "Checked"; $i++;}?> /> Tidak</td>
			</tr>
			<tr>
			<td valign='top' colspan='2'>Penggunaan obat-obatan</td>
             <td colspan='2'><input type="text" value="<?=$datapasien['PENG_OBAT_BAB']?>" name="PENG_OBAT_BAB" id="PENG_OBAT_BAB"></td>
			</tr>
			
			<tr>
			<td rowspan='13' valign='top' colspan='2'>Istirahat tidur</td>
			<td rowspan='5' valign='top' colspan='2'>Kebiasaan tidur</td>
             <td colspan='3'>Siang <input type="text" value="<?=$datapasien['IST_SIANG']?>" name="IST_SIANG" id="IST_SIANG"> Jam/hari</td>
			</tr>
			<tr>
             <td colspan='3'>Malam <input type="text" value="<?=$datapasien['IST_MALAM']?>" name="IST_MALAM" id="IST_MALAM"> Jam/hari</td>
			</tr>
			<tr>
             <td colspan='3'>Pencahayaan <input type="text" value="<?=$datapasien['IST_CAHAYA']?>" name="IST_CAHAYA" id="IST_CAHAYA"> </td>
			</tr>
			<tr>
             <td colspan='3'>Posisi tidur <input type="text" value="<?=$datapasien['IST_POSISI']?>" name="IST_POSISI" id="IST_POSISI"></td>
			</tr>
			<tr>
             <td colspan='3'>Ketenangan lingkungan <input type="text" value="<?=$datapasien['IST_LING']?>" name="IST_LING" id="IST_LING"></td>
			</tr>
			<tr>
			<td rowspan='7' valign='top' colspan='2'>Gangguan tidur</td>
			<?$val = split(",",$datapasien['IST_GANG_TIDUR']); $i = 0;?>
			<td colspan='3'><input type="checkbox" name="IST_GANG_TIDUR[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;}?> /> Tidak ada</td>
 			</tr>
			<tr>
           <td colspan='3'><input type="checkbox" name="IST_GANG_TIDUR[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;}?> /> Insomnia</td>			
			</tr>
			<tr>
           <td colspan='3'><input type="checkbox" name="IST_GANG_TIDUR[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;}?> /> Parasomnia</td>			
			</tr>
			<tr>
           <td colspan='3'><input type="checkbox" name="IST_GANG_TIDUR[]" value="4" <? if($val[$i]=="4"){echo "Checked"; $i++;}?> /> Hipersomnia</td>			
			</tr>
			<tr>
           <td colspan='3'><input type="checkbox" name="IST_GANG_TIDUR[]" value="5" <? if($val[$i]=="5"){echo "Checked"; $i++;}?> /> Narkolepsi</td>
			</tr>
			<tr>
           <td colspan='3'><input type="checkbox" name="IST_GANG_TIDUR[]" value="6" <? if($val[$i]=="6"){echo "Checked"; $i++;}?> /> Apnea saat tidur</td>			
			</tr>
			<tr>
           <td colspan='3'><input type="checkbox" name="IST_GANG_TIDUR[]" value="7" <? if($val[$i]=="7"){echo "Checked"; $i++;}?> /> Stridor</td>
			</tr>
			<tr>
			<td colspan='2'>Penggunaan obat tidur</td>
           <td colspan='3'><select name="PENG_OBAT_IST" class="text">
				<option value=""> --pilih-- </option>
				<option value="Y" <? if($datapasien['PENG_OBAT_IST']=="Y")echo "selected=Selected";?> >Ya</option>
				<option value="T" <? if($datapasien['PENG_OBAT_IST']=="T")echo "selected=Selected";?> >Tidak</option>
			  </select></td>
			</tr>
			<tr>
			<td rowspan='7' valign='top' colspan='3'>Kebersihan diri</td>
			<td rowspan='4' valign='top' colspan='1'>Mandi</td>
           <td colspan='3'>Frekuensi <input type="text" value="<?=$datapasien['FREK_MAND']?>" name="FREK_MAND" id="FREK_MAND"> kali/hari</td>			
			</tr>
			<tr>
           <td colspan='3'>Cuci rambut <input type="text" value="<?=$datapasien['CUC_RAMB_MAND']?>" name="CUC_RAMB_MAND" id="CUC_RAMB_MAND"> hari sekali</td>
			</tr>
			<tr>
           <td colspan='3'>Membersihkan gigi <input type="text" value="<?=$datapasien['SIH_GIGI_MAND']?>" name="SIH_GIGI_MAND" id="SIH_GIGI_MAND"> kali/hari</td>			
			</tr>
			<tr>
           <td colspan='3'>Bantuan <input type="text" value="<?=$datapasien['BANT_MAND']?>" name="BANT_MAND" id="BANT_MAND"></td>			
			</tr>
			<tr>
			<td rowspan='3' valign='top' colspan='2'>Berpakaian</td>
			<td colspan='2'>Ganti pakaian <input type="text" value="<?=$datapasien['GANT_PAKAI']?>" name="GANT_PAKAI" id="GANT_PAKAI"> kali/hari</td>
           <tr>
			<td colspan='1' width='20%'>Pakaian dicuci setiap hari</td>
           <td colspan='1'><select name="PAK_CUCI" class="text">
				<option value=""> --pilih-- </option>
				<option value="Y" <? if($datapasien['PAK_CUCI']=="Y")echo "selected=Selected";?> >Ya</option>
				<option value="T" <? if($datapasien['PAK_CUCI']=="T")echo "selected=Selected";?> >Tidak</option>
			  </select></td>
			</tr>
		<tr>
		<td colspan='2'>Bantuan <input type="text" value="<?=$datapasien['PAK_BANT']?>" name="PAK_BANT" id="PAK_BANT"></td>			
			</tr>
			<tr>
			<td rowspan='6' valign='top' colspan='3'>Kognitif perseptual</td>
			<td rowspan='2' valign='top' colspan='2'>Alat bantu yang digunakan</td>
			<?$val = split(",",$datapasien['ALT_BANT']); $i = 0;?>
           <td colspan='2'><input type="checkbox" name="ALT_BANT[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;}?> /> Kacamata</td>			
			</tr>
			<tr>
           <td colspan='2'><input type="checkbox" name="ALT_BANT[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;}?> /> Alat bantu dengar</td>			
			</tr>
			<tr>
			<td rowspan='4' valign='top' colspan='3'>Kemampuan kognitif yang mengalami kemunduran</td>
			<?$val = split(",",$datapasien['KEMP_MUND']); $i = 0;?>
           <td colspan='1'><input type="checkbox" name="KEMP_MUND[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;}?> /> Kemampuan mengingat</td>		
			</tr>
			<tr>
           <td colspan='1'><input type="checkbox" name="KEMP_MUND[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;}?> /> Bicara & memahami pesan yang diterima</td>			
			</tr>
			<tr>
           <td colspan='1'><input type="checkbox" name="KEMP_MUND[]" value="3" <? if($val[$i]=="3"){echo "Checked"; $i++;}?> /> Kemampuan menangkap komunikasi verbal dan non-verbal</td>
			</tr>
			<tr>
           <td colspan='1'><input type="checkbox" name="KEMP_MUND[]" value="4" <? if($val[$i]=="4"){echo "Checked"; $i++;}?> /> Kebiasaan mengambil keputusan sendiri</td>
			</tr>
			<tr>
			<td rowspan='4' valign='top' colspan='3'>Koping & Toleransi stress</td>
			<td rowspan='2' valign='top' colspan='2'>Mengambil keputusan</td>
			<?$val = split(",",$datapasien['BIL_PUT']); $i = 0;?>
           <td colspan='2'><input type="checkbox" name="BIL_PUT[]" value="1" <? if($val[$i]=="1"){echo "Checked"; $i++;}?> /> Sendiri</td>
			</tr>
			<tr>
           <td colspan='2'><input type="checkbox" name="BIL_PUT[]" value="2" <? if($val[$i]=="2"){echo "Checked"; $i++;}?> /> Dibantu</td>
			</tr>
			<tr>
			<td rowspan='2' valign='top' colspan='2'>Koping menghadapi stressor</td>
           <td colspan='2'>Adaptif <input type="text" value="<?=$datapasien['ADAPTIF']?>" name="ADAPTIF" id="ADAPTIF" size='15'></td>
			</tr>
			<tr>
           <td colspan='2'>Maladaptif <input type="text" value="<?=$datapasien['MALADAPTIF']?>" name="MALADAPTIF" id="MALADAPTIF" size='15'></td>
			</tr>
			  </table>
			  </fieldset>
			  </div>
			  </div>

	
	<?
$nomr = "";
if(!empty($_GET['NOMR'])){
	$nomr =$_GET['NOMR']; 
} 

if($nomr !=""){
	$search = " AND a.NOMR = '".$nomr."' ";
}

$nama = "";
if(!empty($_GET['nama'])){
	$nama =$_GET['nama']; 
} 

if($nama !=""){
	$search = $search.' AND b.NAMA LIKE "%'.trim($nama).'%" ';
} 
?>
			<div id="115" class="tab_content">
			<br>
			 <fieldset class="fieldset">
	  <table width="317" border="0" cellspacing="0" class="tb">
                <tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['NOMR']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>
			</fieldset>
			
			<fieldset class="fieldset"><legend>List Hasil Radiologi</legend>
			<div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr align="center">
                        <th>No</th>
                        <th>No Foto</th>
                        <th>NOMR</th>
                        <th>Nama Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Nama Poliklinik Pengirim</th>
                        <th>Nama Dokter Pengirim</th>
                        <th>Permintaan Photo</th>
                        <th>Jenis Film</th>
                    </tr>
            <?php $sql = "SELECT a.IDXORDERRAD,a.HASILRESUME, a.NO_FILM, a.NOMR, p.nama_unit AS POLY,d.NAMADOKTER AS DOKTER,t.nama_tindakan,a.jenisfilm,
CASE a.aps WHEN 1 THEN (SELECT nama FROM m_pasien_aps b WHERE b.NOMR = a.NOMR) 
ELSE (SELECT nama FROM m_pasien b WHERE b.NOMR = a.NOMR) END AS nama,
CASE a.aps WHEN 1 THEN (SELECT JENISKELAMIN FROM m_pasien_aps b WHERE b.NOMR = a.NOMR) 
ELSE (SELECT JENISKELAMIN FROM m_pasien b WHERE b.NOMR = a.NOMR) END AS jeniskelamin
FROM t_radiologi a 
JOIN m_pasien b ON b.NOMR = a.NOMR
JOIN m_unit p ON p.kode_unit = a.POLYPENGIRIM
JOIN m_dokter d ON d.KDDOKTER = a.DRPENGIRIM
JOIN m_tarif2012 t ON t.kode_tindakan = a.JENISPHOTO
AND 1 = 1".$search;
					$sqlcounter = "SELECT count(a.nomr)
FROM t_radiologi a 
JOIN m_pasien b ON b.NOMR = a.NOMR
JOIN m_unit p ON p.kode_unit = a.POLYPENGIRIM
JOIN m_dokter d ON d.KDDOKTER = a.DRPENGIRIM
JOIN m_tarif2012 t ON t.kode_tindakan = a.JENISPHOTO
AND 1 = 1".$search;
                    $NO=0;
                    $pager = new PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "", "index.php?link=pengkajian_kep&");
                    //The paginate() function returns a mysql result set
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
                    while($data = mysql_fetch_array($rs)) {?>
                    <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
                        <td><? $NO=($NO+1);
                                if ($_GET['page']==0) {
                                    $hal=0;
                                }else {
                                    $hal=$_GET['page']-1;
                                } echo
						($hal*15)+$NO;?></td>
                        <td><?php echo $data['NO_FILM']; ?></td>
                        <td><?php echo $data['NOMR']; ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['jeniskelamin']; ?></td>
                        <td><?php echo $data['POLY']; ?></td>
                        <td><?php echo $data['DOKTER']; ?></td>
                        <td><?php echo $data['nama_tindakan']; ?></td>
                        <td><?php echo $data['jenisfilm']; ?></td>
                    </tr>
                        <?	}

                    //Display the full navigation in one go
                    //echo $pager->renderFullNav();

                    //Or you can display the inidividual links
                    echo "<div style='padding:5px;' align=\"center\"><br />";

                    //Display the link to first page: First
                    echo $pager->renderFirst()." | ";

                    //Display the link to previous page: <<
                    echo $pager->renderPrev()." | ";

                    //Display page links: 1 2 3
                    echo $pager->renderNav()." | ";

                    //Display the link to next page: >>
                    echo $pager->renderNext()." | ";

                    //Display the link to last page: Last
                    echo $pager->renderLast();

                    echo "</div>";
?>

                </table>

                <?php

                //Display the full navigation in one go
                //echo $pager->renderFullNav();

                //Or you can display the inidividual links
                echo "<div style='padding:5px;' align=\"center\"><br />";

                //Display the link to first page: First
                echo $pager->renderFirst()." | ";

                //Display the link to previous page: <<
                echo $pager->renderPrev()." | ";

                //Display page links: 1 2 3
                echo $pager->renderNav()." | ";

                //Display the link to next page: >>
                echo $pager->renderNext()." | ";

                //Display the link to last page: Last
                echo $pager->renderLast();

                echo "</div>";
?>
            </fieldset>
			
	<?
$nomr = "";
if(!empty($_GET['NOMR'])){
	$nomr =$_GET['NOMR']; 
} 

if($nomr !=""){
	$search = " AND a.NOMR = '".$nomr."' ";
}

$nama = "";
if(!empty($_GET['nama'])){
	$nama =$_GET['nama']; 
} 

if($nama !=""){
	$search = $search.' AND b.NAMA LIKE "%'.trim($nama).'%" ';
}
?>
			<br>
			<fieldset class="fieldset"><legend>List Hasil Laboratorium</legend>
			<div id="table_search">
        <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
          <tr align="center">
              <th>No</th>
            <th>No RM</th>
            <th>NO LAB</th>
            <th>Tanggal</th>
            <th>Nama Pasien</th>
            <th>Alamat</th>
            <th>Poli/Ruang</th>
            <th>Dokter Pengirim</th>
            <th>Cara Bayar</th>
            <th>Rujukan</th>
            <th width="100">&nbsp;</th>
          </tr>
          <?
	$sql = 'SELECT a.`NOLAB`,a.`TANGGAL`,a.`KODE`, c.`nama_tindakan`, a.`HASIL_PERIKSA`, a.`nilai_normal`, a.`UNIT`, b.`NAMA`,  b.`ALAMAT`, d.`NAMADOKTER`,
e.`nama`, g.`NAMA` AS CARABAYAR, a.NOMR, e.NAMA as POLY, a.IDXDAFTAR
FROM t_orderlab a
JOIN m_pasien b ON a.`NOMR` = b.`NOMR`
JOIN m_tarif2012 c ON a.`KODE` = c.`kode_tindakan`
JOIN m_dokter d ON a.`DRPENGIRIM` = d.`KDDOKTER`
LEFT JOIN m_poly e ON a.`KDPOLY` = e.`kode`
JOIN t_pendaftaran f ON a.`IDXDAFTAR` = f.`IDXDAFTAR`
JOIN m_carabayar g ON f.`KDCARABAYAR` = g.`KODE`
WHERE a.`STATUS` = 1 '.$search.' GROUP BY a.`TANGGAL`, a.`NOMR`, a.`KDPOLY`';
	$sqlcounter = 'SELECT count(a.nomr)
FROM t_orderlab a
JOIN m_pasien b ON a.`NOMR` = b.`NOMR`
JOIN m_tarif2012 c ON a.`KODE` = c.`kode_tindakan`
JOIN m_dokter d ON a.`DRPENGIRIM` = d.`KDDOKTER`
LEFT JOIN m_poly e ON a.`KDPOLY` = e.`kode`
JOIN t_pendaftaran f ON a.`IDXDAFTAR` = f.`IDXDAFTAR`
JOIN m_carabayar g ON f.`KDCARABAYAR` = g.`KODE`
WHERE a.`STATUS` = 1 '.$search.' GROUP BY a.`TANGGAL`, a.`NOMR`, a.`KDPOLY`';
	 $NO=0;
	$pager = new PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "", "index.php?link=pengkajian_kep&");
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	while($data = mysql_fetch_array($rs)) {?>
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
            <td><? $NO=($NO+1);
                                if ($_GET['page']==0) {
        $hal=0;
    }else {
        $hal=$_GET['page']-1;
    } echo
    
    ($hal*15)+$NO;?></td>
              <td><? echo $data['NOMR'];?></td>
            <td><? echo $data['NOLAB'];?></td>
            <td><? echo $data['TANGGAL']; ?></td>
            <td><? echo $data['NAMA']; ?></td>
            <td><? echo $data['ALAMAT']; ?></td>
            <td><? echo $data['POLY']; ?></td>
             <td><? echo $data['NAMADOKTER']; ?></td>
            <td><? echo $data['CARABAYAR'];?></td>
            <td><? echo $data['RUJUKAN'];?></td>
            <td align="center"><a href="index.php?link=63&amp;nomr=<?php echo $data['NOMR']?>&idx=<?php echo $data['IDXDAFTAR']?>&nolab=<?php echo $data['NOLAB']?>" ><input type="button" value="LIHAT" class="text"/></a></td>
          </tr>
	 <?	} 
	
	//Display the full navigation in one go
	//echo $pager->renderFullNav();
	
	//Or you can display the inidividual links
	echo "<div style='padding:5px;' align=\"center\"><br />";
	
	//Display the link to first page: First
	echo $pager->renderFirst()." | ";
	
	//Display the link to previous page: <<
	echo $pager->renderPrev()." | ";
	
	//Display page links: 1 2 3
	echo $pager->renderNav()." | ";
	
	//Display the link to next page: >>
	echo $pager->renderNext()." | ";
	
	//Display the link to last page: Last
	echo $pager->renderLast();
	
	echo "</div>";
?>
  
</table>

	<?php
	
	//Display the full navigation in one go
	//echo $pager->renderFullNav();
	
	//Or you can display the inidividual links
	echo "<div style='padding:5px;' align=\"center\"><br />";
	
	//Display the link to first page: First
	echo $pager->renderFirst()." | ";
	
	//Display the link to previous page: <<
	echo $pager->renderPrev()." | ";
	
	//Display page links: 1 2 3
	echo $pager->renderNav()." | ";
	
	//Display the link to next page: >>
	echo $pager->renderNext()." | ";
	
	//Display the link to last page: Last
	echo $pager->renderLast();
	
	echo "</div>";
			?>
        </div>
	</fieldset>
	</div>
		<div id="116" class="tab_content">
			<br>
			 <fieldset class="fieldset">
	  <table width="317" border="0" cellspacing="0" class="tb">
                <tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['NOMR']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>
			</fieldset>
			
			<fieldset class="fieldset"><legend>Status Fisiologis</legend>
			<div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="Status Fisiologis">
                    <tr align="center">
                        <th rowspan="2">TD</th>
                        <th rowspan="2">Suhu</th>
                        <th rowspan="2">RR</th>
                        <th rowspan="2">Nadi</th>
                        <th rowspan="2">BB</th>
                        <th rowspan="2">TB</th>
                        <th colspan="5">G C S</th>
                        <th rowspan="2">Kesadaran</th>
						<th rowspan="2">Kepala</th>
						<th rowspan="2">Rambut</th>
						<th rowspan="2">Muka</th>
						<th rowspan="2">Mata</th>
														
                    </tr>
					<tr align="center">
                        <th>eye</th>
                        <th>motorik</th>
                        <th>verbal</th>
                        <th>total GCS</th>
						<th>reaksi pupil</th>
						</tr>
            <?php $sql = "SELECT a.TD,a.SUHU, a.RR, a.NADI, a.BB, a.TB, a.EYE, a.MOTORIK, a.VERBAL, a.TOTAL_GCS, a.REAKSI_PUPIL, a.KESADARAN, a.KEPALA, a.RAMBUT, a.MUKA, a.MATA FROM m_pasien a where NOMR='$_GET[NOMR]'";
$dsql=mysql_query($sql);
while ($hsql=mysql_fetch_array($dsql)){
$a=explode(",",$hsql[KESADARAN]);
$kes1=mysql_query("select kajian from m_kajian_kep where kajian_id=1 and no_id='$a[1]'");
$hkes1=mysql_fetch_array($kes1);
echo"
                 <tr class='tr_u'>
				        <td class='td_u'>$hsql[TD]</td>
                        <td class='td_u'>$hsql[SUHU]</td>
                        <td class='td_u'>$hsql[RR]</td>
                        <td class='td_u'>$hsql[NADI]</td>
                        <td class='td_u'>$hsql[BB]</td>
                        <td class='td_u'>$hsql[TB]</td>
                        <td class='td_u'>$hsql[EYE]</td>
                        <td class='td_u'>$hsql[MOTORIK]</td>
						<td class='td_u'>$hsql[VERBAL]</td>
						<td class='td_u'>$hsql[TOTAL_GCS]</td>
						<td class='td_u'>$hsql[REAKSI_PUPIL]</td>
						<td class='td_u'>$hkes1[kajian]<br>
						</td>
						<td class='td_u'>$hsql[KEPALA]</td>
						<td class='td_u'>$hsql[RAMBUT]</td>
						<td class='td_u'>$hsql[MUKA]</td>
						<td class='td_u'>$dsql[MATA]</td>
                    ";?>
                         <? echo "</tr>" ?>				<?  }; ?>

                                    </table>

                </div>

            </fieldset>
<fieldset class="fieldset"><legend>PSIKOLOGIS</legend>
			<div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr align="center">
                        <th>Keseimbangan Diri</th>
                        <th>Sosial Support</th>
                        <th>Ansietas</th>
                        <th>Kehilangan</th>
                        <th>Status Emosi</th>
                        <th>Konsep Diri</th>
                        <th>Respon terhadap kehilangan</th>
                        <th>Sumber Stress</th>
                        
                    </tr>
            <?php $sql = "SELECT a.KES_DIRI,a.SOS_SUPORT, a.ANSIETAS, a.KEHILANGAN, a.STATUS_EMOSI, a.KONSEP_DIRI, a.RESPON_HILANG, a.SUMBER_STRESS from m_pasien a where a.NOMR='$_GET[NOMR]'";
          $psql=mysql_query($sql);
		  $hpsql=mysql_fetch_array($psql);
		  $b=explode(",",$hpsql[KES_DIRI]);
		  $c=explode(",",$hpsql[SOS_SUPORT]);
		  $d=explode(",",$hpsql[KEHILANGAN]);
		  $e=explode(",",$hpsql[RESPON_HILANG]);
		  $f=explode(",",$hpsql[SUMBER_STRESS]);
			$kesdiri1=mysql_query("Select kajian from m_kajian_kep where kajian_id=2 and no_id='$b[1]'");
			$hkesdiri1=mysql_fetch_array($kesdiri1);
			$kesdiri2=mysql_query("Select kajian from m_kajian_kep where kajian_id=2 and no_id='$b[2]'");
			$hkesdiri2=mysql_fetch_array($kesdiri2);
			$kesdiri3=mysql_query("Select kajian from m_kajian_kep where kajian_id=2 and no_id='$b[3]'");
			$hkesdiri3=mysql_fetch_array($kesdiri3);
			$kesdiri4=mysql_query("Select kajian from m_kajian_kep where kajian_id=2 and no_id='$b[4]'");
			$hkesdiri4=mysql_fetch_array($kesdiri4);
			$kesdiri5=mysql_query("Select kajian from m_kajian_kep where kajian_id=2 and no_id='$b[5]'");
			$hkesdiri5=mysql_fetch_array($kesdiri5);
		 	$ss1=mysql_query("Select kajian from m_kajian_kep where kajian_id=3 and no_id='$c[1]'");
			$hss1=mysql_fetch_array($ss1);
			$ss2=mysql_query("Select kajian from m_kajian_kep where kajian_id=3 and no_id='$c[2]'");
			$hss2=mysql_fetch_array($ss2);
			$ss3=mysql_query("Select kajian from m_kajian_kep where kajian_id=3 and no_id='$c[3]'");
			$hss3=mysql_fetch_array($ss3);
			$ss4=mysql_query("Select kajian from m_kajian_kep where kajian_id=3 and no_id='$c[4]'");
			$hss4=mysql_fetch_array($ss4);
			$ss5=mysql_query("Select kajian from m_kajian_kep where kajian_id=3 and no_id='$c[5]'");
			$hss5=mysql_fetch_array($ss5);
			$kh1=mysql_query("Select kajian from m_kajian_kep where kajian_id=4 and no_id='$d[1]'");
			$hkh1=mysql_fetch_array($kh1);
			$kh2=mysql_query("Select kajian from m_kajian_kep where kajian_id=4 and no_id='$d[2]'");
			$hkh2=mysql_fetch_array($kh2);
			$kh3=mysql_query("Select kajian from m_kajian_kep where kajian_id=4 and no_id='$d[3]'");
			$hkh3=mysql_fetch_array($kh3);
			$rh1=mysql_query("Select kajian from m_kajian_kep where kajian_id=5 and no_id='$e[1]'");
			$hrh1=mysql_fetch_array($rh1);
			$rh2=mysql_query("Select kajian from m_kajian_kep where kajian_id=5 and no_id='$e[2]'");
			$hrh2=mysql_fetch_array($rh2);
			$rh3=mysql_query("Select kajian from m_kajian_kep where kajian_id=5 and no_id='$e[3]'");
			$hrh3=mysql_fetch_array($rh3);
			$rh4=mysql_query("Select kajian from m_kajian_kep where kajian_id=5 and no_id='$e[4]'");
			$hrh4=mysql_fetch_array($rh4);
			$rh5=mysql_query("Select kajian from m_kajian_kep where kajian_id=5 and no_id='$e[5]'");
			$hrh5=mysql_fetch_array($rh5);
			$sbs1=mysql_query("Select kajian from m_kajian_kep where kajian_id=6 and no_id='$f[1]'");
			$hsbs1=mysql_fetch_array($sbs1);
			$sbs2=mysql_query("Select kajian from m_kajian_kep where kajian_id=6 and no_id='$f[2]'");
			$hsbs2=mysql_fetch_array($sbs2);
			$sbs3=mysql_query("Select kajian from m_kajian_kep where kajian_id=6 and no_id='$f[3]'");
			$hsbs3=mysql_fetch_array($sbs3);
			$sbs4=mysql_query("Select kajian from m_kajian_kep where kajian_id=6 and no_id='$f[4]'");
			$hsbs4=mysql_fetch_array($sbs4);
			
			if($hpsql[STATUS_EMOSI]==1){
			$STE="Sedih";}
			else if($hpsql[STATUS_EMOSI]==2){
			$STE="Marah";}
			else if($hpsql[STATUS_EMOSI]==3){
			$STE="Gembira";}
			else if($hpsql[STATUS_EMOSI]==4){
			$STE="Curiga";}
			if($hpsql[KONSEP_DIRI]==1){
			$ksd="Citra diri";}
			else if($hpsql[KONSEP_DIRI]==2){
			$ksd="Identitas";}
			else if($hpsql[KONSEP_DIRI]==3){
			$ksd="Peran";}
			else if($hpsql[KONSEP_DIRI]==4){
			$ksd="Ideal Diri";}
			else if($hpsql[KONSEP_DIRI]==5){
			$ksd="Harga Diri";}
		  ?>
		  <tr>
                        <td><?php echo "$hkesdiri1[kajian]"; ?><br>
						<?php echo "$hkesdiri2[kajian]"; ?><br>
						<?php echo "$hkesdiri3[kajian]"; ?><br>
						<?php echo "$hkesdiri4[kajian]"; ?><br>
						<?php echo "$hkesdiri5[kajian]"; ?><br>
						</td>
                                   <td><?php echo "$hss1[kajian]"; ?><br>
						<?php echo "$hss2[kajian]"; ?><br>
						<?php echo "$hss3[kajian]"; ?><br>
						<?php echo "$hss4[kajian]"; ?><br>
						<?php echo "$hss5[kajian]"; ?><br>
						</td>
                        <td valign="top"><?php echo $hpsql['ANSIETAS']; ?></td>
                        <td valign="top"><?php echo "$hkh1[kajian]"; ?><br>
						<?php echo "$hkh2[kajian]"; ?><br>
						<?php echo "$hkh3[kajian]"; ?></td>
                        <td  valign="top"><?php echo "$STE"; ?></td>
                        <td   valign="top"><?php echo "$ksd"; ?></td>
                        <td valign="top"> <?php echo "$hrh1[kajian]"; ?><br>
						<?php echo "$hrh2[kajian]"; ?><br>
						<?php echo "$hrh3[kajian]"; ?><br>
						<?php echo "$hrh4[kajian]"; ?><br>
						<?php echo "$hrh5[kajian]"; ?></td>
                        <td valign="top"><?php echo "$hsbs1[kajian]"; ?><br>
						<?php echo "$hsbs2[kajian]"; ?><br>
						<?php echo "$hsbs3[kajian]"; ?><br>
						<?php echo "$hsbs4[kajian]"; ?><br>
						</td>
                    </tr>
                        
                </table>
</fieldset>
<fieldset class="fieldset"><legend>SOSIAL</legend>
			<div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr align="center">
                        <th>Orang yng paling berarti</th>
                        <th>Keterlibatan dalam kelompok</th>
                        <th>Hambatan dalam berhubungan</th>
                        <th>Komunikasi</th>
                        <th>pengambilan keputusan dalam keluarga</th>
                        <th>Orang yang mengasuh</th>
                        <th>Dukungan Keluarga</th>
                        <th>Reaksi dalam interaksi</th>
                        
                    </tr>
            <?php $sql = "SELECT a.BERARTI,a.TERLIBAT, a.HUBUNGAN, a.KOMUNIKASI, a.KEPUTUSAN, a.MENGASUH, a.DUKUNGAN, a.REAKSI from m_pasien a where a.NOMR='$_GET[NOMR]'";
          $psql=mysql_query($sql);
		  $hpsql=mysql_fetch_array($psql);
		  $g=explode(",",$hpsql[BERARTI]);
		  $g0=explode("_",$g[0]);
		  $g1=explode("_",$g[1]);
		  $g2=explode("_",$g[2]);
		  $g3=explode("_",$g[3]);
		  $g4=explode("_",$g[4]);
		  $h=explode(",",$hpsql[KOMUNIKASI]);
		  $h0=explode("_",$h[0]);
		  $h1=explode("_",$h[1]);
		  $h2=explode("_",$h[2]);
		  $h3=explode("_",$h[3]);
		  $h4=explode("_",$h[4]);
		  $h5=explode("_",$h[5]);
		  $h6=explode("_",$h[6]);
		  $h7=explode("_",$h[7]);
		  $h8=explode("_",$h[8]);
		  $h9=explode("_",$h[9]);
		  $h10=explode("_",$h[10]);
		  $h11=explode("_",$h[11]);
		  $h12=explode("_",$h[12]);
		  $h13=explode("_",$h[13]);
		  $e=explode(",",$hpsql[RESPON_HILANG]);
		  $f=explode(",",$hpsql[SUMBER_STRESS]);
			$berarti1=mysql_query("Select kajian from m_kajian_kep where kajian_id=7 and no_id='$g0[1]'");
			$hberarti1=mysql_fetch_array($berarti1);
			$berarti2=mysql_query("Select kajian from m_kajian_kep where kajian_id=7 and no_id='$g1[1]'");
			$hberarti2=mysql_fetch_array($berarti2);
			$berarti3=mysql_query("Select kajian from m_kajian_kep where kajian_id=7 and no_id='$g2[2]'");
			$hberarti3=mysql_fetch_array($berarti3);
			$berarti4=mysql_query("Select kajian from m_kajian_kep where kajian_id=7 and no_id='$g3[3]'");
			$hberarti4=mysql_fetch_array($berarti4);
			$berarti5=mysql_query("Select kajian from m_kajian_kep where kajian_id=7 and no_id='$g4[4]'");
			$hberarti5=mysql_fetch_array($berarti5);
		 	$hbt1=mysql_query("Select kajian from m_kajian_kep where kajian_id=8 and no_id='$h0[1]'");
			$hhbt1=mysql_fetch_array($hbt1);
			$hbt2=mysql_query("Select kajian from m_kajian_kep where kajian_id=8 and no_id='$h1[1]'");
			$hhbt2=mysql_fetch_array($hbt2);
			$hbt3=mysql_query("Select kajian from m_kajian_kep where kajian_id=8 and no_id='$h2[1]'");
			$hhbt3=mysql_fetch_array($hbt3);
			$hbt4=mysql_query("Select kajian from m_kajian_kep where kajian_id=8 and no_id='$h3[1]'");
			$hhbt4=mysql_fetch_array($hbt4);
			$hbt5=mysql_query("Select kajian from m_kajian_kep where kajian_id=8 and no_id='$h4[1]'");
			$hhbt5=mysql_fetch_array($hbt5);
			$hbt6=mysql_query("Select kajian from m_kajian_kep where kajian_id=8 and no_id='$h5[1]'");
			$hhbt6=mysql_fetch_array($hbt6);
			$hbt7=mysql_query("Select kajian from m_kajian_kep where kajian_id=8 and no_id='$h6[1]'");
			$hhbt7=mysql_fetch_array($hbt7);
			$hbt8=mysql_query("Select kajian from m_kajian_kep where kajian_id=8 and no_id='$h7[1]'");
			$hhbt8=mysql_fetch_array($hbt8);
			$hbt9=mysql_query("Select kajian from m_kajian_kep where kajian_id=8 and no_id='$h8[1]'");
			$hhbt9=mysql_fetch_array($hbt9);
			$hbt10=mysql_query("Select kajian from m_kajian_kep where kajian_id=8 and no_id='$h9[1]'");
			$hhbt10=mysql_fetch_array($hbt10);
			$hbt11=mysql_query("Select kajian from m_kajian_kep where kajian_id=8 and no_id='$h10[1]'");
			$hhbt11=mysql_fetch_array($hbt11);
			$hbt12=mysql_query("Select kajian from m_kajian_kep where kajian_id=8 and no_id='$h11[1]'");
			$hhbt12=mysql_fetch_array($hbt12);
			$hbt13=mysql_query("Select kajian from m_kajian_kep where kajian_id=8 and no_id='$h12[1]'");
			$hhbt13=mysql_fetch_array($hbt13);
			if($hpsql[KEPUTUSAN]=="_1_"){
			$STE="Diri sendiri";}
			else if($hpsql[KEPUTUSAN]=="_2_"){
			$STE="Suami/ Istri";}
			else if($hpsql[KEPUTUSAN]=='_3_'){
			$STE="Orang Tua";}
			else if($hpsql[KEPUTUSAN]=="_4_"){
			$STE="Anak";}
			else if($hpsql[KEPUTUSAN]=="_5_"){
			$STE="Musyawarah";}
			if($hpsql[MENGASUH]=="_1_"){
			$ksd="Orangtua";}
			else if($hpsql[MANGASUH]=="_2_"){
			$ksd="Nenek/Kakek";}
			else if($hpsql[MENGASUH]=="_3_"){
			$ksd="Keluarga Dekat";}
			else if($hpsql[MENGASUH]=="_4_"){
			$ksd="Pembantu";}
			else if($hpsql[Mengasuh]=="_5_"){
			$ksd="Lain-Lain";}
			if($hpsql[DUKUNGAN]=="1"){
			$asuh="Aktif";}
			else if($hpsql[DUKUNGAN]=="2"){
			$asuh="Kurang";}
			else if($hpsql[DUKUNGAN]=="3"){
			$asuh="Tidak Ada";}
			if($hpsql[REAKSI]=="1"){
			$reaksi="Kooperatif";}
			else if($hpsql[REAKSI]=="2"){
			$reaksi="Bermusuhan";}
			else if($hpsql[REAKSI]=="3"){
			$reaksi="Defensif";}
			else if($hpsql[REAKSI]=="4"){
			$reaksi="Aktif";}
			else if($hpsql[REAKSI]=="3"){
			$reaksi="Curiga";}
		  ?>
		  <tr>
                        <td valign="top"><?php echo "$hberarti1[kajian]"; ?><br>
						<?php echo "$hberarti2[kajian]"; ?><br>
						<?php echo "$hberarti3[kajian]"; ?><br>
						<?php echo "$hberarti4[kajian]"; ?><br>
						<?php echo "$hberarti5[kajian]"; ?><br>
						</td>
                                   <td><?php echo "$hpsql[TERLIBAT]"; ?>
						</td>
                        <td valign="top"><?php echo "$hpsql[HUBUNGAN]"; ?></td>
                        <td valign="top"><?php echo "$hhbt1[kajian]:$h0[2]"; ?><br>
						<?php echo "$hhbt2[kajian]-$h1[2]"; ?><br>
						<?php echo "$hhbt3[kajian]-$h2[2]"; ?><br>
						<?php echo "$hhbt4[kajian]-$h3[2]"; ?><br>
						<?php echo "$hhbt5[kajian]-$h4[2]"; ?><br>
						<?php echo "$hhbt6[kajian]-$h5[2]"; ?><br>
						<?php echo "$hhbt7[kajian]-$h6[2]"; ?><br>
						<?php echo "$hhbt8[kajian]-$h7[2]"; ?><br>
						<?php echo "$hhbt9[kajian]-$h8[2]"; ?><br>
						<?php echo "$hhbt10[kajian]-$h9[2]"; ?><br>
						<?php echo "$hhbt11[kajian]-$h10[2]"; ?><br>
						<?php echo "$hhbt12[kajian]-$h11[2]"; ?><br>
						<?php echo "$hhbt13[kajian]-$h12[2]"; ?><br>
						</td>
                        <td  valign="top"><?php echo "$STE"; ?></td>
                        <td   valign="top"><?php echo "$ksd"; ?></td>
                        <td valign="top"> <?php echo "$asuh"; ?></td>
                        <td valign="top"><?php echo "$hsbs1[kajian]"; ?><br>
						<?php echo "$hsbs2[kajian]"; ?><br>
						<?php echo "$hsbs3[kajian]"; ?><br>
						<?php echo "$hsbs4[kajian]"; ?><br>
						</td>
                    </tr>
                        
                </table>
</fieldset>
<fieldset class="fieldset"><legend>BUDAYA</legend>
			<div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr align="center">
                        <th>Nilai Kebudayaan Yang dianut terkait masalah kesehatan</th>
                        <th>Kebiasaan saat sehat</th>
                        <th>Kebiasan saat sakit</th>
                        <th>Pola Makan</th>
                        <th>Pantangan Makan</th>
                        <th>Kepercayaan yang dianut thdp penyakit</th>
                        <th>Pantangan</th>
                        <th>Pantangan lainnya</th>
                        <th>Anjuran yang dianut</th>
                    </tr>
            <?php $sql = "SELECT a.BUDAYA,a.POLA_AKTIVITAS, a.POLA_ISTIRAHAT, a.POLA_MAKAN, a.PANTANGAN, a.KEPERCAYAAN, a.PANTANGAN_HARI, a.PANTANGAN_LAIN, a.ANJURAN from m_pasien a where a.NOMR='$_GET[NOMR]'";
          $psql=mysql_query($sql);
		  $hpsql=mysql_fetch_array($psql);
		  $g=explode(",",$hpsql[BUDAYA]);
		  $g0=explode("_",$g[0]);
		  $g1=explode("_",$g[1]);
		  $g2=explode("_",$g[2]);
		  $g3=explode("_",$g[3]);
		  $g4=explode("_",$g[4]);
		  	$budaya1=mysql_query("Select kajian from m_kajian_kep where kajian_id=9 and no_id='$g0[1]'");
			$hbudaya1=mysql_fetch_array($budaya1);
			$budaya2=mysql_query("Select kajian from m_kajian_kep where kajian_id=9 and no_id='$g1[1]'");
			$hbudaya2=mysql_fetch_array($budaya2);
			$budaya3=mysql_query("Select kajian from m_kajian_kep where kajian_id=9 and no_id='$g2[2]'");
			$hbudaya3=mysql_fetch_array($budaya3);
			$budaya4=mysql_query("Select kajian from m_kajian_kep where kajian_id=9 and no_id='$g3[3]'");
			$hbudaya4=mysql_fetch_array($budaya4);
			$budaya5=mysql_query("Select kajian from m_kajian_kep where kajian_id=9 and no_id='$g4[4]'");
			$hbudaya5=mysql_fetch_array($budaya5);
		 	
			if($hpsql[POLA_MAKAN]=="_1_"){
			$STE="Makan Nasi";}
			else if($hpsql[POLA_MAKAN]=="_2_"){
			$STE="Selain Nasi";}
			else if($hpsql[KEPUTUSAN]=='_3_'){
			$STE="Vegetarian";}
			if($hpsql[PANTANGAN]=="Y"){
			$ksd="YA";}
			else{
			$ksd="TIDAK";}
			if($hpsql[KEPERCAYAAN]=="_1_"){
			$asuh="YA";}
			else if($hpsql[KEPERCAYAAN]=="_2_"){
			$asuh="Tidak";}
			if($hpsql[PANTANGAN_HARI]=="_1_"){
			$reaksi="YA";}
			else if($hpsql[PANTANGAN_HARI]=="_2_"){
			$reaksi="TIDAK";}
					  ?>
		  <tr>
                        <td valign="top"><?php echo "$hbudaya1[kajian]"; ?><br>
						<?php echo "$hbudaya2[kajian]"; ?><br>
						<?php echo "$hbudaya3[kajian]"; ?><br>
						<?php echo "$hbudaya4[kajian]"; ?><br>
						<?php echo "$hbudaya5[kajian]"; ?><br>
						</td>
                                   <td valign="top"><?php echo "$hpsql[POLA_AKTIVITAS]"; ?>
						</td>
                        <td valign="top"><?php echo "$hpsql[POLA_ISTIRAHAT]"; ?></td>
                        <td  valign="top"><?php echo "$STE"; ?></td>
                        <td   valign="top"><?php echo "$ksd"; ?></td>
                        <td valign="top"> <?php echo "$asuh"; ?></td>
						<td valign="top"> <?php echo "$reaksi"; ?></td>
                        <td valign="top"><?php echo "$hpsql[PANTANGAN_LAIN]"; ?>
						</td>
						<td valign="top"><?php echo "$hpsql[ANJURAN]"; ?>
						</td>

                    </tr>
                        
                </table>
</fieldset>

</div>
	<div id="119" class="tab_content">
	<fieldset class="fieldset">
			<table width="317" border="0" cellspacing="0" class="tb">
				<tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['NOMR']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>
		</fieldset>
		<fieldset class="fieldset"><legend>Tindakan Medis</legend>
<?
$nomr = "";
if(!empty($_GET['NOMR'])) {
    $nomr =$_GET['NOMR'];
} 

if($nomr !="") {
    $search = " and m_pasien.nomr = '".$nomr."' ";
}

$nama = "";
if(!empty($_GET['nama'])) {
    $nama =$_GET['nama'];
} 

if($nama !="") {
    $search = $search.' AND m_pasien.nama LIKE "%'.$nama.'%" ';
}
?>

<div align="center">
        <div align="right" style="margin:5px;">
            <div id="table_search">
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" >
                    <tr align="center">
                        <th>NO</th>
                        <th>NOMR</th>
                        <th>NAMA PASIEN</th>
                        <th>TANGGAL OPERASI</th>
                        <th>JAM MULAI</th>
                        <th>JAM SELESAI</th>
                        <th>DOKTER OPERATOR</th>
                        <th>DOKTER ANASTESI</th>
                        <th><div align="center">LIHAT LAPORAN</div></th>
                    </tr>
                    <?
                    $sql = "SELECT 
			  t_operasi.*,
			  m_pasien.NAMA AS namapasien,
			  m_carabayar.NAMA as carabayar				
			FROM
			  t_operasi
			  INNER JOIN m_pasien ON (t_operasi.nomr = m_pasien.NOMR)
			  LEFT JOIN t_pendaftaran ON (t_operasi.IDXDAFTAR = t_pendaftaran.IDXDAFTAR)
			  LEFT JOIN m_carabayar ON (t_pendaftaran.KDCARABAYAR = m_carabayar.KODE)
			where (t_operasi.status = 'selesai' or t_operasi.status is null)
			and t_operasi.tanggal is not null ".$search." order by t_operasi.tanggal asc";			
					$sqlcounter = "SELECT count(t_operasi.nomr)
			FROM
			  t_operasi
			  INNER JOIN m_pasien ON (t_operasi.nomr = m_pasien.NOMR)
			  LEFT JOIN t_pendaftaran ON (t_operasi.IDXDAFTAR = t_pendaftaran.IDXDAFTAR)
			  LEFT JOIN m_carabayar ON (t_pendaftaran.KDCARABAYAR = m_carabayar.KODE)
			where (t_operasi.status = 'selesai' or t_operasi.status is null)
			and t_operasi.tanggal is not null ".$search." order by t_operasi.tanggal asc";

                    $NO=0;
					$pager = new PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "", "index.php?link=pengkajian_kep&");
//The paginate() function returns a mysql result set 
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
                    while($data = mysql_fetch_array($rs)) {?>
                    <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                                echo "tr1";
    }
    else {
        echo "tr2";
    }
    ?>>
    <td><? $NO=($NO+1);
                                if ($_GET['page']==0) {
                                    $hal=0;
                                }else {
                                    $hal=$_GET['page']-1;
                                } echo
    ($hal*20)+$NO;?></td>
                        <td><?php echo $data['nomr']; ?></td>
                        <td><?php echo $data['namapasien']; ?></td>
                        <td><?php echo $data['tanggal']; ?></td>
                        <td><?php echo $data['jammulai']; ?></td>
                        <td><?php echo $data['jamselesai']; ?></td>
                        <td><?php echo $data['dokteroperator']; ?></td>
                        <td><?php echo $data['dokteranastesi']; ?></td>
                        <td>
                            <div align="center">
    <?
    if ($js != 'NULL') {
                                        ?>
                                <a href="index.php?link=203&idoperasi=<?php echo $data['id_operasi']; ?>&amp;tanggal=<?php echo $data['tanggal']; ?>" class="text">LAPORAN</a>

                                        <?
        $pemakaianobat='1';
    }
    ?>
                            </div></td>
                    </tr>
                        <?	}
                    echo "<div style='padding:5px;' align=\"center\"><br />";

                    //Display the link to first page: First
                    echo $pager->renderFirst()." | ";

                    //Display the link to previous page: <<
                    echo $pager->renderPrev()." | ";

                    //Display page links: 1 2 3
                    echo $pager->renderNav()." | ";

                    //Display the link to next page: >>
                    echo $pager->renderNext()." | ";

                    //Display the link to last page: Last
                    echo $pager->renderLast();

echo "</div>";
?>

                </table>

                <?php

                //Display the full navigation in one go
                //echo $pager->renderFullNav();

                //Or you can display the inidividual links
                echo "<div style='padding:5px;' align=\"center\"><br />";

                //Display the link to first page: First
                echo $pager->renderFirst()." | ";

                //Display the link to previous page: <<
                echo $pager->renderPrev()." | ";

                //Display page links: 1 2 3
                echo $pager->renderNav()." | ";

                //Display the link to next page: >>
                echo $pager->renderNext()." | ";

                //Display the link to last page: Last
                echo $pager->renderLast();

echo "</div>";
?>
            </div>
        </div>
    </div>
		</fieldset>
	</div>
	  <div id="120" class="tab_content">
			  <fieldset class="fieldset">
	  <table width="317" border="0" cellspacing="0" class="tb">
                <tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['NOMR']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>
			</fieldset>
			
<fieldset class="fieldset"><legend>Resiko Jatuh dan Decubitus</legend>
<table width="90%" align="center" border="0" class="tb">
<tr><td>
<table width="50%" align="center" border="0" cellspacing="0" class="tb">
            <tr>
              <th>Faktor Resiko</th>
			  <th>Skala</th>
			
			  </tr>
			  <tr>
			  <td valign="top">Perbandingan BB/ TB</td>
			  <td valign="top">
			  <select name="PERBANDINGAN_BB" class="text">
            <option value=""> --pilih-- </option>
            <option value="0" <? if($datapasien['PERBANDINGAN_BB']=="0")echo "selected=Selected";?> >RATA-RATA</option>
            <option value="1" <? if($datapasien['PERBANDINGAN_BB']=="1")echo "selected=Selected";?> > > RATA-RATA</option>
			<option value="2" <? if($datapasien['PERBANDINGAN_BB']=="2")echo "selected=Selected";?> >OBESITAS</option>
			<option value="3" <? if($datapasien['PERBANDINGAN_BB']=="3")echo "selected=Selected";?> > < RATA-RATA </option>
          </select></td>
		  
			  </tr>
			  <TR>
			   <td valign="top">KONTINENSIA</td>
			  <td valign="top">
			  <select name="KONTINENSIA" class="text">
            <option value=""> --pilih-- </option>
            <option value="0" <? if($datapasien['KONTINENSIA']=="0")echo "selected=Selected";?> >Terpasang Kateter</option>
            <option value="1" <? if($datapasien['KONTINENSIA']=="1")echo "selected=Selected";?> >Kadang-Kadang</option>
			 <option value="2" <? if($datapasien['KONTINENSIA']=="2")echo "selected=Selected";?> >Inkontinensia Fekal</option>
         	 <option value="3" <? if($datapasien['KONTINENSIA']=="3")echo "selected=Selected";?> >Inkontinensia Ganda</option>
		  </select></td>
		  
			  </tr>
			  <TR>
			   <td valign="top">Jenis Kulit</td>
			  <td valign="top">
			  <select name="JENIS_KULIT1" class="text">
            <option value=""> --pilih-- </option>
            <option value="0" <? if($datapasien['JENIS_KULIT1']=="0")echo "selected=Selected";?> >Sehat</option>
              <option value="1" <? if($datapasien['JENIS_KULIT1']=="1")echo "selected=Selected";?> >Tipis</option>
			  <option value="2" <? if($datapasien['JENIS_KULIT1']=="2")echo "selected=Selected";?> >Kering</option>
			  <option value="3" <? if($datapasien['JENIS_KULIT1']=="3")echo "selected=Selected";?> >Edema</option>
			  <option value="4" <? if($datapasien['JENIS_KULIT1']=="4")echo "selected=Selected";?> >Lembab</option>
			  <option value="5" <? if($datapasien['JENIS_KULIT1']=="5")echo "selected=Selected";?> >Pucat</option>
			  <option value="6" <? if($datapasien['JENIS_KULIT1']=="6")echo "selected=Selected";?> >Pecah-Pecah</option>
		  </select></td>
		  
			  </tr>
			  <TR>
			   <td valign="top">Mobilitas</td>
			  <td valign="top">
			  <select name="MOBILITAS" class="text">
            <option value=""> --pilih-- </option>
            <option value="0" <? if($datapasien['MOBILITAS']=="0")echo "selected=Selected";?> >Penuh</option>
            <option value="1" <? if($datapasien['MOBILITAS']=="1")echo "selected=Selected";?> >Gelisah</option>
			<option value="2" <? if($datapasien['MOBILITAS']=="2")echo "selected=Selected";?> >Apatis</option>
			<option value="3" <? if($datapasien['MOBILITAS']=="3")echo "selected=Selected";?> >Terbatas</option>
			<option value="4" <? if($datapasien['MOBILITAS']=="4")echo "selected=Selected";?> >Kaku</option>
			<option value="5" <? if($datapasien['MOBILITAS']=="5")echo "selected=Selected";?> >Dengan Kursi Roda</option>
          </select></td>
		  
			  </tr>
			  <TR>
			   <td valign="top">Jenis Kelamin</td>
			  <td valign="top">
			  <input type="text" value="<? if($datapasien['JENISKELAMIN']=='L')echo "Laki-Laki"; else if($datapasien['JENISKELAMIN']=='P')echo "Perempuan"; ?>" name="JK" >
			  
			  </td>
		  
		 </tr>
		  <TR>
			   <td valign="top">Umur</td>
			 
			 
		  <td><input type="text" name="UMUR" value="<? $umur=(date('Y-m-d')-$datapasien['TGLLAHIR']); echo"$umur"; ?>" title="tanggal penilaian"></td>
			  </tr>
 <TR>
			   <td valign="top">Nafsu Makan</td>
			  <td valign="top">
			  <select name="NAFSU_MAKAN" class="text">
            <option value=""> --pilih-- </option>
            <option value="0" <? if($datapasien['NAFSU_MAKAN']=="0")echo "selected=Selected";?> >Rata-Rata</option>
            <option value="1" <? if($datapasien['NAFSU_MAKAN']=="1")echo "selected=Selected";?> >Buruk</option>
			<option value="2" <? if($datapasien['NAFSU_MAKAN']=="2")echo "selected=Selected";?> >NGT</option>
			<option value="3" <? if($datapasien['NAFSU_MAKAN']=="3")echo "selected=Selected";?> >Anoreksia</option>
			
          </select></td>
		  
			  </tr>
		  
<TR>
			   <td valign="top">Obat</td>
			  <td valign="top">
			  <select name="OBAT1" class="text">
            <option value="0"> --pilih-- </option>
            <option value="4" <? if($datapasien['OBAT1']=="4")echo "selected=Selected";?> >Steroid Sitotoksik Anti Inflamasi</option>
           
			
          </select></td>
		  
			  </tr>
			  <TR>
			   <td valign="top">MalNutrisi</td>
			  <td valign="top">
			  <select name="MALNUTRISI" class="text">
            <option value=""> --pilih-- </option>
            <option value="8" <? if($datapasien['MALNUTRISI']=="8")echo "selected=Selected";?> >Terminal</option>
            <option value="5" <? if($datapasien['MALNUTRISI']=="5")echo "selected=Selected";?> >Gagal Jantung</option>
			<option value="3" <? if($datapasien['MALNUTRISI']=="3")echo "selected=Selected";?> >Penyakit Pada Perifer</option>
			<option value="2" <? if($datapasien['MALNUTRISI']=="2")echo "selected=Selected";?> >Anemia</option>
			<option value="1" <? if($datapasien['MALNUTRISI']=="1")echo "selected=Selected";?> >Merokok</option>
			
          </select></td>
		  
			  </tr>
<TR>
			   <td valign="top">Skala Motorik/ Sensorik</td>
			  <td valign="top">
			  <select name="MOTORIK1" class="text">
            <option value=""> --pilih-- </option>
            <option value="4" <? if($datapasien['MOTORIK1']=="4")echo "selected=Selected";?> >4</option>
            <option value="5" <? if($datapasien['MOTORIK1']=="5")echo "selected=Selected";?> >5</option>
			<option value="6" <? if($datapasien['MOTORIK1']=="6")echo "selected=Selected";?> >6</option>
			
          </select></td>
		  
			  </tr>
<TR>
			   <td valign="top">Spinal</td>
			  <td valign="top">
			  <select name="SPINAL" class="text">
            <option value="0"> --pilih-- </option>
            <option value="5" <? if($datapasien['SPINAL']=="5")echo "selected=Selected";?> >Ya</option>
            
			
          </select></td>
		  
			  </tr>
<TR>
			   <td valign="top">Diatas Meja Operasi</td>
			  <td valign="top">
			  <select name="MEJA_OPERASI" class="text">
            <option value="0"> --pilih-- </option>
            <option value="5" <? if($datapasien['MEJA_OPERASI']=="5")echo "selected=Selected";?> >Ya</option>
            
			
          </select></td>
		  
			  </tr>
<tr>
<td valign="top">Score</td>
<td valign="top"><? $score=$datapasien['PERBANDINGAN_BB']+$datapasien['KONTINENSIA']+$datapasien['JENIS_KULIT1']+$datapasien['MOBILITAS']+$datapasien['JK']+$datapasien['UMUR']+$datapasien['NASFU_MAKAN']+$datapasien['OBAT1']+$datapasien['MALNUTRISI']+$datapasien['MOTORIK1']+$datapasien['SPINAL']+$datapasien['MEJA_OPERASI']; echo"$score"; ?></td>
</tr>
			  </table></td>
			  <td valign="top">
			  <table width="50%" align="center" border="0" cellspacing="0" class="tb">
            <tr>
              <th>Faktor Resiko</th>
			  <th>Skala</th>
			
			  </tr>
			  <tr>
			  <td valign="top">Riwayat jatuh</td>
			  <td valign="top">
			  <select name="RIWAYAT_JATUH" class="text">
            <option value=""> --pilih-- </option>
            <option value="25" <? if($datapasien['RIWAYAT_JATUH']=="25")echo "selected=Selected";?> >Ya</option>
            <option value="0" <? if($datapasien['RIWAYAT_JATUH']=="0")echo "selected=Selected";?> >Tidak</option>
          </select></td>  </tr>
			  <TR>
			   <td valign="top">Diagnosis Sekunder</td>
			  <td valign="top">
			  <select name="DIAGNOSIS_SEKUNDER" class="text">
            <option value=""> --pilih-- </option>
            <option value="15" <? if($datapasien['DIAGNOSIS_SEKUNDER']=="15")echo "selected=Selected";?> >Ya</option>
            <option value="0" <? if($datapasien['DIAGNOSIS_SEKUNDER']=="0")echo "selected=Selected";?> >Tidak</option>
          </select></td>
		  			  </tr>
			  <TR>
			   <td valign="top">Menggunakan alat bantu</td>
			  <td valign="top">
			  <select name="ALAT_BANTU" class="text">
            <option value=""> --pilih-- </option>
            <option value="30" <? if($datapasien['ALAT_BANTU']=="30")echo "selected=Selected";?> >Furnitur</option>
            <option value="15" <? if($datapasien['ALAT_BANTU']=="15")echo "selected=Selected";?> >Penyokong Tongkat</option>
            <option value="0" <? if($datapasien['ALAT_BANTU']=="0")echo "selected=Selected";?> >Bed Rest</option>
		  </select></td>
		  
			  </tr>
			  <TR>
			   <td valign="top">Heparin</td>
			  <td valign="top">
			  <select name="HEPARIN" class="text">
            <option value=""> --pilih-- </option>
            <option value="20" <? if($datapasien['HEPARIN']=="20")echo "selected=Selected";?> >Ya</option>
            <option value="0" <? if($datapasien['HEPARIN']=="0")echo "selected=Selected";?> >Tidak</option>
          </select></td>
		  
			  </tr>
			  <TR>
			   <td valign="top">GAYA BERJALAN</td>
			  <td valign="top">
			  <select name="GAYA_BERJALAN" class="text">
            <option value=""> --pilih-- </option>
            <option value="20" <? if($datapasien['GAYA_BERJALAN']=="20")echo "selected=Selected";?> >TERGANGGU</option>
            <option value="10" <? if($datapasien['GAYA_BERJALAN']=="10")echo "selected=Selected";?> >LEMAH</option>
          </select></td>
		  
		 </tr>
		  <TR>
			   <td valign="top">Kesadaran</td>
			  <td valign="top">
			  <select name="KESADARAN1" class="text">
            <option value=""> --pilih-- </option>
            <option value="15" <? if($datapasien['KESADARAN1']=="15")echo "selected=Selected";?> >PELUPA</option>
            <option value="0" <? if($datapasien['KESADARAN1']=="0")echo "selected=Selected";?> >BAIK</option>
          </select></td>
		  			  </tr>
		  <tr><td valign="top">
		  Score : 
		  </td><td>
		  <? $score2=$datapasien['RIWAYAT_JATUH']+$datapasien['DIAGNOSIS_SEKUNDER']+$datapasien['ALAT_BANTU']+$datapasien['HEPARIN']+$datapasien['GAYA_BERJALAN']+$datapasien['KESADARAN1']; echo"$score2"; ?>
		  </td></tr>
			  </table>
			  </td>
			  </tr></table>
			  </fieldset>


			  </div>

 <div id="121" class="tab_content">
			  <fieldset class="fieldset">
	  <table width="317" border="0" cellspacing="0" class="tb">
                <tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['NOMR']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>
			</fieldset>
			
<fieldset class="fieldset"><legend>DATA VITAL</legend>
<table width="90%" align="center" border="0">

<tr><td><div><? echo"<a href='kep/grafik_data.php?nomr=$_GET[NOMR]&nama=$_GET[nama]'' target='_self' title='Grafik Data Vital'>Lihat Grafik</a>"; ?></div></table>

<table width="90%" align="center" border="0" class="tb">

<tr><td>
<table width="80%" align="center" border="0" cellspacing="0" class="tb">
            <tr>
              <th rowspan="2">DATA VITAL</th>
			  <th colspan=24 align="center">Jam</th>
			
			  </tr>
<tr>
               <th>07.00</th>
			   <th>08.00</th>
			   <th>09.00</th>
			   <th>10.00</th>
			   <th>11.00</th>
			   <th>12.00</th>
			   <th>13.00</th>
			   <th>14.00</th>
			   <th>15.00</th>
			   <th>16.00</th>
			   <th>17.00</th>
			   <th>18.00</th>
			   <th>19.00</th>
			   <th>20.00</th>
			   <th>21.00</th>
			  <th>22.00</th>
			  <th>23.00</th>
			  <th>24.00</th>
			  <th>01.00</th>
			  <th>02.00</th>
			  <th>03.00</th>
			  <th>04.00</th>
			  <th>05.00</th>
			  <th>06.00</th> 
			
			  </tr>
			  <? $datavital=mysql_query("select * from data_vital where nomr='$_GET[NOMR]' and data='Sistole'");
			  	 $hasildata=mysql_fetch_array($datavital);
				 $datavital2=mysql_query("select * from data_vital where nomr='$_GET[NOMR]' and data='Diastole'");
			  	 $hasildata2=mysql_fetch_array($datavital2);
				 $datavital3=mysql_query("select * from data_vital where nomr='$_GET[NOMR]' and data='Nadi'");
			  	 $hasildata3=mysql_fetch_array($datavital3);
				 $datavital4=mysql_query("select * from data_vital where nomr='$_GET[NOMR]' and data='Temperatur'");
			  	 $hasildata4=mysql_fetch_array($datavital4);
				 ?>
			  <tr>
			  <td>Sistole</td><td><input type="text" size="3" id="st1" name="st1" value="<?php echo $hasildata['j1']; ?>"></td>
			  <td><input type="text" size="3" id="st2" name="st2"  value="<?php echo $hasildata['j2']; ?>"></td>
			  <td><input type="text" size="3" id="st3" name="st3"  value="<?php echo $hasildata['j3']; ?>"></td>
			  <td><input type="text" size="3" id="st4" name="st4"  value="<?php echo $hasildata['j4']; ?>"></td>
			 <td><input type="text" size="3" id="st5" name="st5"  value="<?php echo $hasildata['j5']; ?>"></td>
			 <td><input type="text" size="3" id="st6" name="st6"  value="<?php echo $hasildata['j6']; ?>"></td>
			 <td><input type="text" size="3" id="st7" name="st7"  value="<?php echo $hasildata['j7']; ?>"></td>
			 <td><input type="text" size="3" id="st8" name="st8"  value="<?php echo $hasildata['j8']; ?>"></td>
			 <td><input type="text" size="3" id="st9" name="st9"  value="<?php echo $hasildata['j9']; ?>"></td>
			 <td><input type="text" size="3" id="st10" name="st10  value="<?php echo $hasildata['j10']; ?>""></td>
			  <td><input type="text" size="3" id="st11" name="st11"  value="<?php echo $hasildata['j11']; ?>"></td>
			   <td><input type="text" size="3" id="st12" name="st12"  value="<?php echo $hasildata['j12']; ?>"></td>
			    <td><input type="text" size="3" id="st13" name="st13"  value="<?php echo $hasildata['j13']; ?>"></td>
			 <td><input type="text" size="3" id="st14" name="st14"  value="<?php echo $hasildata['j14']; ?>"> </td>
			  <td><input type="text" size="3" id="st15" name="st15"  value="<?php echo $hasildata['j15']; ?>"></td>
			   <td><input type="text" size="3" id="st16" name="st16"  value="<?php echo $hasildata['j16']; ?>"></td>
			   <td><input type="text" size="3" id="st17" name="st17"  value="<?php echo $hasildata['j17']; ?>"></td>
			    <td><input type="text" size="3" id="st18" name="st18"  value="<?php echo $hasildata['j18']; ?>"></td>
				 <td><input type="text" size="3" id="st19" name="st19"  value="<?php echo $hasildata['j19']; ?>"></td>
				  <td><input type="text" size="3" id="st20" name="st20"  value="<?php echo $hasildata['j20']; ?>"></td>
				   <td><input type="text" size="3" id="st21" name="st21"  value="<?php echo $hasildata['j21']; ?>"></td>
				    <td><input type="text" size="3" id="st22" name="st22"  value="<?php echo $hasildata['j22']; ?>"></td>
					 <td><input type="text" size="3" id="st23" name="st23"  value="<?php echo $hasildata['j23']; ?>"></td>
					  <td><input type="text" size="3" id="st24" name="st24"  value="<?php echo $hasildata['j24']; ?>"></td>
			  </tr>
	  <tr>
			  <td>Diastole</td><td><input type="text" size="3" id="dt1" name="dt1"   value="<?php echo $hasildata2['j1']; ?>"></td>
			  <td><input type="text" size="3" id="dt2" name="dt2"   value="<?php echo $hasildata2['j2']; ?>"></td>
			  <td><input type="text" size="3" id="dt3" name="dt3"   value="<?php echo $hasildata2['j3']; ?>"></td>
			  <td><input type="text" size="3" id="dt4" name="dt4"  value="<?php echo $hasildata2['j4']; ?>"></td>
			 <td><input type="text" size="3" id="dt5" name="dt5"  value="<?php echo $hasildata2['j5']; ?>"></td>
			 <td><input type="text" size="3" id="dt6" name="dt6"  value="<?php echo $hasildata2['j6']; ?>"></td>
			 <td><input type="text" size="3" id="dt7" name="dt7"  value="<?php echo $hasildata2['j7']; ?>"></td>
			 <td><input type="text" size="3" id="dt8" name="dt8"  value="<?php echo $hasildata2['j8']; ?>"></td>
			 <td><input type="text" size="3" id="dt9" name="dt9"  value="<?php echo $hasildata2['j9']; ?>"></td>
			 <td><input type="text" size="3" id="dt10" name="dt10"  value="<?php echo $hasildata2['j10']; ?>"></td>
			  <td><input type="text" size="3" id="dt11" name="dt11"  value="<?php echo $hasildata2['j11']; ?>"></td>
			   <td><input type="text" size="3" id="dt12" name="dt12"  value="<?php echo $hasildata2['j12']; ?>"></td>
			    <td><input type="text" size="3" id="dt13" name="dt13" value="<?php echo $hasildata2['j13']; ?>"></td>
			 <td><input type="text" size="3" id="dt14" name="dt14"  value="<?php echo $hasildata2['j14']; ?>"></td>
			  <td><input type="text" size="3" id="dt15" name="dt15"  value="<?php echo $hasildata2['j15']; ?>"></td>
			   <td><input type="text" size="3" id="dt16" name="dt16"  value="<?php echo $hasildata2['j16']; ?>"></td>
			   <td><input type="text" size="3" id="dt17" name="dt17"  value="<?php echo $hasildata2['j17']; ?>"></td>
			    <td><input type="text" size="3" id="dt18" name="dt18"  value="<?php echo $hasildata2['j18']; ?>"></td>
				 <td><input type="text" size="3" id="dt19" name="dt19"  value="<?php echo $hasildata2['j19']; ?>"></td>
				  <td><input type="text" size="3" id="dt20" name="dt20"  value="<?php echo $hasildata2['j20']; ?>"></td>
				   <td><input type="text" size="3" id="dt21" name="dt21"  value="<?php echo $hasildata2['j21']; ?>"></td>
				    <td><input type="text" size="3" id="dt22" name="dt22"  value="<?php echo $hasildata2['j22']; ?>"></td>
					 <td><input type="text" size="3" id="dt23" name="dt23"  value="<?php echo $hasildata2['j23']; ?>"></td>
					  <td><input type="text" size="3" id="dt24" name="dt24"  value="<?php echo $hasildata2['j24']; ?>"></td>
			  </tr>
<tr>
			  <td>Nadi</td><td><input type="text" size="3" id="nd1" name="nd1"   value="<?php echo $hasildata3['j1']; ?>"></td>
			  <td><input type="text" size="3" id="nd2" name="nd2"   value="<?php echo $hasildata3['j2']; ?>"></td>
			  <td><input type="text" size="3" id="nd3" name="nd3"   value="<?php echo $hasildata3['j3']; ?>"></td>
			  <td><input type="text" size="3" id="nd4" name="nd4"  value="<?php echo $hasildata3['j4']; ?>"></td>
			 <td><input type="text" size="3" id="nd5" name="nd5"  value="<?php echo $hasildata3['j5']; ?>"></td>
			 <td><input type="text" size="3" id="nd6" name="nd6"  value="<?php echo $hasildata3['j6']; ?>"></td>
			 <td><input type="text" size="3" id="nd7" name="nd7"  value="<?php echo $hasildata3['j7']; ?>"></td>
			 <td><input type="text" size="3" id="nd8" name="nd8"  value="<?php echo $hasildata3['j8']; ?>"></td>
			 <td><input type="text" size="3" id="nd9" name="nd9"  value="<?php echo $hasildata3['j9']; ?>"></td>
			 <td><input type="text" size="3" id="nd10" name="nd10"  value="<?php echo $hasildata3['j10']; ?>"></td>
			  <td><input type="text" size="3" id="nd11" name="nd11"  value="<?php echo $hasildata3['j11']; ?>"></td>
			   <td><input type="text" size="3" id="nd12" name="nd12"  value="<?php echo $hasildata3['j12']; ?>"></td>
			    <td><input type="text" size="3" id="nd13" name="nd13" value="<?php echo $hasildata3['j13']; ?>"></td>
			 <td><input type="text" size="3" id="nd14" name="nd14"  value="<?php echo $hasildata3['j14']; ?>"></td>
			  <td><input type="text" size="3" id="nd15" name="nd15"  value="<?php echo $hasildata3['j15']; ?>"></td>
			   <td><input type="text" size="3" id="nd16" name="nd16"  value="<?php echo $hasildata3['j16']; ?>"></td>
			   <td><input type="text" size="3" id="nd17" name="nd17"  value="<?php echo $hasildata3['j17']; ?>"></td>
			    <td><input type="text" size="3" id="nd18" name="nd18"  value="<?php echo $hasildata3['j18']; ?>"></td>
				 <td><input type="text" size="3" id="nd19" name="nd19"  value="<?php echo $hasildata3['j19']; ?>"></td>
				  <td><input type="text" size="3" id="nd20" name="nd20"  value="<?php echo $hasildata3['j20']; ?>"></td>
				   <td><input type="text" size="3" id="nd21" name="nd21"  value="<?php echo $hasildata3['j21']; ?>"></td>
				    <td><input type="text" size="3" id="nd22" name="nd22"  value="<?php echo $hasildata3['j22']; ?>"></td>
					 <td><input type="text" size="3" id="nd23" name="nd23"  value="<?php echo $hasildata3['j23']; ?>"></td>
					  <td><input type="text" size="3" id="nd24" name="nd24"  value="<?php echo $hasildata3['j24']; ?>"></td>
			  </tr>
<tr>
			  <td>Temperatur Record</td><td><input type="text" size="3" id="tm1" name="tm1"   value="<?php echo $hasildata4['j1']; ?>"></td>
			  <td><input type="text" size="3" id="tm2" name="tm2"   value="<?php echo $hasildata4['j2']; ?>"></td>
			  <td><input type="text" size="3" id="tm3" name="tm3"   value="<?php echo $hasildata4['j3']; ?>"></td>
			  <td><input type="text" size="3" id="tm4" name="tm4"  value="<?php echo $hasildata4['j4']; ?>"></td>
			 <td><input type="text" size="3" id="tm5" name="tm5"  value="<?php echo $hasildata4['j5']; ?>"></td>
			 <td><input type="text" size="3" id="tm6" name="tm6"  value="<?php echo $hasildata4['j6']; ?>"></td>
			 <td><input type="text" size="3" id="tm7" name="tm7"  value="<?php echo $hasildata4['j7']; ?>"></td>
			 <td><input type="text" size="3" id="tm8" name="tm8"  value="<?php echo $hasildata4['j8']; ?>"></td>
			 <td><input type="text" size="3" id="tm9" name="tm9"  value="<?php echo $hasildata4['j9']; ?>"></td>
			 <td><input type="text" size="3" id="tm10" name="tm10"  value="<?php echo $hasildata4['j10']; ?>"></td>
			  <td><input type="text" size="3" id="tm11" name="tm11"  value="<?php echo $hasildata4['j11']; ?>"></td>
			   <td><input type="text" size="3" id="tm12" name="tm12"  value="<?php echo $hasildata4['j12']; ?>"></td>
			    <td><input type="text" size="3" id="tm13" name="tm13" value="<?php echo $hasildata4['j13']; ?>"></td>
			 <td><input type="text" size="3" id="tm14" name="tm14"  value="<?php echo $hasildata4['j14']; ?>"></td>
			  <td><input type="text" size="3" id="tm15" name="tm15"  value="<?php echo $hasildata4['j15']; ?>"></td>
			   <td><input type="text" size="3" id="tm16" name="tm16"  value="<?php echo $hasildata4['j16']; ?>"></td>
			   <td><input type="text" size="3" id="tm17" name="tm17"  value="<?php echo $hasildata4['j17']; ?>"></td>
			    <td><input type="text" size="3" id="tm18" name="tm18"  value="<?php echo $hasildata4['j18']; ?>"></td>
				 <td><input type="text" size="3" id="tm19" name="tm19"  value="<?php echo $hasildata4['j19']; ?>"></td>
				  <td><input type="text" size="3" id="tm20" name="tm20"  value="<?php echo $hasildata4['j20']; ?>"></td>
				   <td><input type="text" size="3" id="tm21" name="tm21"  value="<?php echo $hasildata4['j21']; ?>"></td>
				    <td><input type="text" size="3" id="tm22" name="tm22"  value="<?php echo $hasildata4['j22']; ?>"></td>
					 <td><input type="text" size="3" id="tm23" name="tm23"  value="<?php echo $hasildata4['j23']; ?>"></td>
					  <td><input type="text" size="3" id="tm24" name="tm24"  value="<?php echo $hasildata4['j24']; ?>"></td>
			  </tr>

</table>
</table>

</fieldset>
</div>
	
			<div id="117" class="tab_content">
			<fieldset class="fieldset">
			<!--<form name="tglkalender" id="tglkalender">-->
	  <table width="317" border="0" cellspacing="0" class="tb">
                <tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['NOMR']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>
			</fieldset>
			
<fieldset class="fieldset"><legend>Alih Rawat Internal</legend>
<table width="100%" align="center" border="0" cellspacing="0" class="tb">
            <tr>
              <td width="20%" valign='top'>Tanggal alih rawat</td>
			  <?php 
				$sql_dokter	= mysql_query('SELECT a.*, if(a.noruang != a.noruang_asal, "Pindah Ruangan", Null) alasan FROM t_admission a where nomr = "'.$_GET['NOMR'].'" and keluarrs is null and masukrs = (select max(masukrs) from t_admission where nomr = "'.$_GET['NOMR'].'")');
				$dd = mysql_fetch_array($sql_dokter);
			  ?>
			  <td><input type='text' class="text" value="<?=$dd['tgl_pindah']?>" name="theDate" size="20" id="theDate" onblur="calage(this.value,'tanggal alih rawat');"/>
			   <a href="javascript:showCal('theDate')"><img align="top" src="img/date.png" border="0" /></td>
			  </tr>
			<tr>
			  <td>Alasan alih rawat internal</td>
<!--			  <td><textarea name="rawat_internal" id="rawat_internal" cols="45" rows="8"></textarea></td>-->
			  <td><input type="text" value="<?=$dd['alasan']?>" size="45" name="rawat_internal" id="rawat_internal"/></td>
			</tr>
			  </table>
			  <!--</form>-->
			  </fieldset>
			  </div>
			  
			  <div id="118" class="tab_content">
			 <fieldset class="fieldset">
	  <table width="317" border="0" cellspacing="0" class="tb">
                <tr>
                    <td width="80">No RM :</td>
                    <td width="233"><?=$_GET['NOMR']?></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><?=$_GET['nama']?></td>
                </tr>
            </table>
			</fieldset>

<fieldset class="fieldset"><legend>Alasan Rujuk Eksternal</legend>
<table width="100%" align="center" border="0" cellspacing="0" class="tb">
            <tr>
              <td width="20%" valign='top'>Tanggal rujukan</td>
			  <td><input type='text' class="text" value="<?=$data['TGL']?>" name="TGL" size="20" id="TGL" onblur="calage(this.value,'umur');"/>
			   <a href="javascript:showCal('Calendar_')"><img align="top" src="img/date.png" border="0" /></td>
			</tr>
			<tr>
			  <td>Alasan rujuk eksternal</td>
			  <td><select name="rujuk_eksternal" id="rujuk_eksternal" class="text">
    				<?php 
					$sdasar	= mysql_query('select * from m_dasarrujuk');
					while($dsr_rujuk = mysql_fetch_array($sdasar)){ ?>
    				<option value="<?=$dsr_rujuk['kode']?>" ><?=$dsr_rujuk['nama']?></option>
					<?php } ?> 
			  	</select></td>
<!--			  <td><input type="text" size="45" rows='6' name="rujuk_eksternal" id="rujuk_eksternal"></td>-->
			</tr>
			  </table>
			  </fieldset>
			  </div>
    	</div>
    	<br clear="all" />
    	<input type="submit" name="simpan" value="S I M P A N" id="simpan" class="text" />
    	</form>
		</div>
	</div>
	<br clear="all" />
</div>