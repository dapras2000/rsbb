<table width="98%" class="tb">
    <tr>
        <td>
            <!-- -->
            <form name="pasien_masuk" id="pasien_masuk" action="vk/valid_keluar-masuk.php" method="post">
                <input type="hidden" name="NOMR" value="<? echo $nomr; ?>" />
                <input type="hidden" name="IDXDAFTAR2" value="<?php echo $userdata['IDXDAFTAR']; ?>"/>
                <table width="98%" >
                    <tr>
                        <td width="5%">Masuk</td>
                        <td width="15%"><input type="text" class="text" name="Masuk" value="" id="Masuk" style="width:80px" /></td>
                        <td width="10%">Dokter</td>
                        <td width="25%">
                            <select name="dokter" class="text">
                                <?
                                $sql_dokter = "SELECT a.kdpoly, a.kddokter, b.NAMADOKTER FROM m_dokter_jaga a join m_dokter b on b.KDDOKTER = a.kddokter where a.kdpoly = ".$kdpoly;
                                $get_dokter = mysql_query($sql_dokter);
                                while($dat_dokter = mysql_fetch_array($get_dokter)) {
                                    ?>
                                <option value="<?=$dat_dokter['kddokter']?>"
                                    <?
                                    if($dat_dokter['kddokter']==$kddokter) echo "selected=selected";
                                            ?> ><?=$dat_dokter['NAMADOKTER']?></option>
                                            <? } ?>
                            </select>
                        </td>
                        <td width="20%">
                            <?
                            $SQL = "SELECT `STATUS`,MASUKPOLY,KELUARPOLY FROM t_pendaftaran WHERE IDXDAFTAR='".$_GET['idx']."'";
                            $QUERY = mysql_query($SQL);
                            $JAM = mysql_fetch_assoc($QUERY);
                            if($JAM['MASUKPOLY']=="00:00:00") {
                                ?>
                            <input type="submit" class="text" name="save2" onclick="submitform (document.getElementById('pasien_masuk'),'vk/valid_keluar-masuk.php','valid_masuk',validatetask); return false;" value=" M a s u k " />
                                <? }else {
                                echo "<strong> Jam Masuk ".$JAM['MASUKPOLY']."</strong>";
                            } ?>
                        </td>
                        <td><span id="valid_masuk">&nbsp;</span></td>
                    </tr>
                </table>
            </form>
            <!-- -->
        </td>
    </tr>
    <tr>
        <td>
            <!-- -->
            <form name="pasien_keluar" id="pasien_keluar" action="vk/valid_keluar-masuk.php" method="post">
                <input type="hidden" name="NOMR" value="<? echo $nomr; ?>" />
                <input type="hidden" name="IDXDAFTAR2" value="<?php echo $userdata['IDXDAFTAR']; ?>"/>
                <table width="98%" >
                    <tr>
                        <td width="5%">Keluar</td>
                        <td width="15%"> <input type="text" name="Keluar" class="text" value="" id="Keluar" style="width:80px" /></td>
                        <td width="10%">Status Keluar</td>
                        <td width="25%">
                            <select name="Status" class="text" onchange="javascript: MyAjaxRequest('rujuk','rujukan/alasan_rujuk.php?rujuk=' + this.value); return false;">
                                <option selected="selected">- Pilih Status -</option>
                                <?
                                $qey = mysql_query("SELECT * FROM m_statuskeluar Where `status` <> 11");
                                while ($show = mysql_fetch_array($qey)) { ?>
                              <option value="<?=$show['status']?>" <?
                                    if($JAM['STATUS']==$show['status']) {
                                        echo "selected='selected'";
                                    }
                                            ?>class=""><?=$show['keterangan']?></option>
                                            <?
                                        }
                                        ?>
                            </select>
                        </td>
                        <td width="20%">
                            <? if($JAM['KELUARPOLY']=="00:00:00") { ?>
                            <input type="submit" name="keluar" class="text" value=" K e l u a r " onclick="submitform (document.getElementById('pasien_keluar'),'vk/valid_keluar-masuk.php','valid_keluar',validatetask); return false;"/>
                                <?  }else {
                                echo "<strong> Jam Keluar ".$JAM['KELUARPOLY']."</strong>";
                            } ?>
                        </td><td><span id="valid_keluar">&nbsp;</span></td>
                    </tr>
                </table>

                <div id="rujuk" >

                </div>
            </form>
            <!-- -->
        </td>
    </tr>
</table>
<script>
    <!--
    /*By George Chiang (JK's JavaScript tutorial)
http://javascriptkit.com
Credit must stay intact for use*/
    function show(){
        var Digital=new Date()
        var hours=Digital.getHours()
        var minutes=Digital.getMinutes()
        var seconds=Digital.getSeconds()
        var curTime =
            ((hours < 10) ? "0" : "") + hours + ":"
            + ((minutes < 10) ? "0" : "") + minutes + ":"
            + ((seconds < 10) ? "0" : "") + seconds
        var dn="AM"

        if (hours>12){
            dn="PM"
            hours=hours-12
        }
        if (hours==0)
            hours=12
        if (minutes<=9)
            minutes="0"+minutes
        if (seconds<=9)
            seconds="0"+seconds
        document.pasien_masuk.Masuk.value=curTime
        document.pasien_keluar.Keluar.value=curTime
        setTimeout("show()",1000)
    }
    show()
    //-->
    <!-- hide from old browsers
    var curDateTime = new Date()
    var curHour = curDateTime.getHours()
    var curMin = curDateTime.getMinutes()
    var curSec = curDateTime.getSeconds()
    var curTime =
        ((curHour < 10) ? "0" : "") + curHour + ":"
        + ((curMin < 10) ? "0" : "") + curMin + ":"
        + ((curSec < 10) ? "0" : "") + curSec
    //-->
</script>