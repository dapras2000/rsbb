<?php
include '../include/connect.php';
?>
<select name="poli" class="text required" title="*" id="poli">
                              <option value=""> -- PILIH -- </option>
                                      <?php
                                        $ss = mysql_query('SELECT DISTINCT kode, nama
                                                            FROM m_poly
                                                            WHERE kode
                                                            NOT IN (
                                                                SELECT kode_unit
                                                                FROM m_tarif2012
                                                                WHERE kode_unit IS NOT NULL
                                                                )');

                                        while($ds = mysql_fetch_array($ss)){
                                       // if($_GET['poli'] == $ds['kode']): $sel = "selected=Selected"; else: $sel = ''; endif;
    echo '<option value="'.$ds['kode'].'" '.$sel.' >'.$ds['kode'].' | '.$ds['nama'].'</option>';
                                        }
                                      ?>
</select>