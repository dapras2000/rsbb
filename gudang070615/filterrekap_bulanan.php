<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>REKAP BULANAN</h3></div>
        <div align="left" style="margin:5px;">
            <fieldset >
                <form name="filterlap" id="filterlap" method="get" >
                    <input type="hidden" name="link" value="g03" />
                    <table class="tb" align="left">
                        <tr>
                            <?php
                            $akhtahun = date('Y') - 20;
                            $c = date('Y');
                            ?>
                            <td>Tahun</td>
                            <td><select name="tahun" id="tahun" class="text" >
                                    <? while($akhtahun <= $c) { ?>
                                    <option value="<?=$akhtahun?>" <? if($akhtahun == $c) {
                                            echo "selected=selected";
    } ?>><?=$akhtahun?></option>
    <? $akhtahun++;
} ?>  
                                </select></td>
                        </tr>
                        <tr>
                            <td>Group Barang</td>
                            <td><select name="group" id="group" class="text">
<? if($_SESSION['KDUNIT']=="12") { ?>
                                    <option value="1" >Obat</option>
                                    <option value="2" >Alat Kesehatan Pakai Habis</option>
                                    <option value="3" >Bahan Radiologi</option>
                                    <option value="4" >Gas</option>
                                    <option value="5" >Reagensia</option>
    <? }else if($_SESSION['KDUNIT']=="13") { ?>
                                    <option value="1" >ATK</option>
                                    <option value="2" >Cetakan</option>
                                    <option value="3" >ART</option>
                                    <option value="4" >Alat Bersih dan Pembersih</option>
                                    <option value="5" >Lain - Lain</option>
    <? } ?>

                                </select></td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td><input type="text" name="nm_barang" class="text" /></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" value="Open" class="text" /></td>
                        </tr>
                    </table>
                </form>
            </fieldset >
        </div></div>
</div>
