<div align="center">
  <div id="frame">
  <div id="frame_title">
  <h3 align="left">IDENTITAS PEGAWAI</h3>
  <? IF(ISSET($_REQUEST['NOMR']))$t_pendaftaran->READ(ARRAY($_REQUEST['NOMR']));?>
  <? IF(ISSET($_REQUEST['NOMR']))$m_pasien->READ(ARRAY($_REQUEST['NOMR']));?>
</div>
	<div id="all">
    <form name="myform" id="myform" <? if($m_pasien->NOMR){?> action="../gudang/models/edit_pasien.php"<? }else{ ?>action="models/pendaftaran.php"<? }?> method="post">
    
	<div id="list_data"></div>
    <fieldset class="fieldset">
      <legend>List Data Pegawai</legend>
<div id="wrapper">
	<div id="content">
	<div class="tab"><h3 class="tabtxt" title="second"><a href="#">List Data Pegawai</a></h3></div>
	<div class="tab"><h3 class="tabtxt" title="third"><a href="#">List Data Absensi</a></h3></div>
	<div class="tab"><h3 class="tabtxt" title="fourth"><a href="#">List Tamu</a></h3></div>
	<div class="boxholder">
		<div class="box">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <th width="9%">NIP</th>
    <th width="11%">Nama</th>
    <th width="17%">Tgl Lahir</th>
    <th width="24%">Alamat</th>
    <th width="11%">Kota</th>
    <th width="16%">No Telepon</th>
    <th colspan="2">Action</th>
    </tr>
  <tr>
    <td>1000310</td>
    <td> Dadang M T</td>
    <td>12-02-2009</td>
    <td>Jln Paguyuban 1</td>
    <td>Sumendang</td>
    <td>08545993829</td>
    <td width="6%" align="center"><a id="frm1" href="#" class="highslide" onclick="return hs.expand(this)">Edit</a></td>
    <td width="6%" align="center"><a id="frm2" href="#" class="highslide" onclick="return hs.expand(this)">Hapus</a></td>
  </tr>
  <tr>
    <td>1000311</td>
    <td>Asep M Top</td>
    <td>12-02-2009</td>
    <td>Komp Resto no 2</td>
    <td>Cianjur</td>
    <td>08148493383</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
		</div>
		<div class="box">
		<p>The Second Box
Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut molestie nunc eu turpis. Donec facilisis enim sed dui. Sed nunc. Cras eu arcu. Praesent vel augue vel dolor ultricies convallis. Nam consectetuer risus eu urna. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam suscipit. Duis quis lacus sed tellus auctor blandit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin eget massa in ante vehicula pharetra. Ut massa pede, ornare id, ultrices eget, porta et, metus.</p>
</div>
		<div class="box">
        <p>The Second Box
Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut molestie nunc eu turpis. Donec facilisis enim sed dui. Sed nunc. Cras eu arcu. Praesent vel augue vel dolor ultricies convallis. Nam consectetuer risus eu urna. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam suscipit. Duis quis lacus sed tellus auctor blandit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin eget massa in ante vehicula pharetra. Ut massa pede, ornare id, ultrices eget, porta et, metus.</p>
</div>
</div>
    </fieldset>
  </form>
  
  <div class="hidden-container">
	<a href="" class="highslide" onclick="return hs.expand(this, { thumbnailId: 'frm1' })"></a>
	<div class="highslide-caption">
		Caption for the second image.
	</div>

	<a href="" class="highslide" onclick="return hs.expand(this, { thumbnailId: 'frm2' })"></a>
	<div class="highslide-caption">
		Caption for the third image.
	</div>
</div>
   </div>
  </div>
  </div>
  <script type="text/javascript">
	Element.cleanWhitespace('content');
	init();
</script>
