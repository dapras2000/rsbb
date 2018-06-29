<div align="center">
    <div id="frame">
        <div id="frame_title"><h3>Lihat Jadwal</h3></div>

        <form id="formsearch" name="formsearch" class="tb" method="post" action="index.php?link=jdoc3">
            <label>Tanggal :
                <input type="text" name="tgl1" id="tgl_pesan" readonly="readonly" class="text" 
						value="<?php if($_REQUEST['tgl1'] !=""): echo $_REQUEST['tgl1']; else: echo date('Y/m/d'); endif; ?>"
                       style="width:100px;"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a>
            </label>
            <label>
                <input type="submit" name="submit" value="L i h a t" />
            </label>
        </form>

    </div>
</div>