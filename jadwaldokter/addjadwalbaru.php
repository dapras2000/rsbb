<?php include("../include/connect.php"); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
$query_rsj = "SELECT a.*,b.* FROM m_dokter a LEFT JOIN t_jadwaldokter b ON a.KDDOKTER=b.iddokter and b.tanggal='".gmdate('Y-m-d')."'";
$rsj = mysql_query($query_rsj) or die(mysql_error());
$row_rsj = mysql_fetch_assoc($rsj);
$totalRows_rsj = mysql_num_rows($rsj);
?>
<div align="center" style="width:100%;">
    <div id="frame">
    <div id="frame_title"><h3>Tambah Jadwal Dokter</h3></div>

<form method="post" action="index.php?link=jdoc4" name="formjadwal">
  <div align="center">
    <label></label>
Waktu:
<select name="waktu" id="waktu" class="text">
      <option value="P">PAGI</option>
      <option value="S">SORE</option>
      <option value="M">MALAM</option>
      <option value="L">LIBUR</option>
      <option value="LM">LEPAS MALAM</option>
      <option value="PR">PAGI RANAP</option>
      <option value="PU">PAGI UGD</option>
    </select>
    <input name="Simpan" type="submit" value="Input Jadwal Hari Ini" class="text"/>
    <input name="tglbaru" type="hidden" id="tglbaru" value="<?=$_POST['tgl1'];?>" />
  </div>
  <table width="95%" border="0" align="center" class="tb" cellpadding="1" cellspacing="1">
  <tr>
    <th rowspan="2"><div align="center">KD DOKTER</div></th>
    <th rowspan="2"><div align="center">NAMA DOKTER</div></th>
    <th colspan="31"><div align="center">TANGGAL</div></th>
    </tr>
  <tr>
    <th><div align="center">01</div></th>
    <th><div align="center">02</div></th>
    <th><div align="center">03</div></th>
    <th><div align="center">04</div></th>
    <th><div align="center">05</div></th>
    <th><div align="center">06</div></th>
    <th><div align="center">07</div></th>
    <th><div align="center">08</div></th>
    <th><div align="center">09</div></th>
    <th><div align="center">10</div></th>
    <th><div align="center">11</div></th>
    <th><div align="center">12</div></th>
    <th><div align="center">13</div></th>
    <th><div align="center">14</div></th>
    <th><div align="center">15</div></th>
    <th><div align="center">16</div></th>
    <th><div align="center">17</div></th>
    <th><div align="center">18</div></th>
    <th><div align="center">19</div></th>
    <th><div align="center">20</div></th>
    <th><div align="center">21</div></th>
    <th><div align="center">22</div></th>
    <th><div align="center">23</div></th>
    <th><div align="center">24</div></th>
    <th><div align="center">25</div></th>
    <th><div align="center">26</div></th>
    <th><div align="center">27</div></th>
    <th><div align="center">28</div></th>
    <th><div align="center">29</div></th>
    <th><div align="center">30</div></th>
    <th><div align="center">31</div></th>
  </tr>
  <?php do { ?>
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
      <td><div align="center"><?php echo $row_rsj['KDDOKTER']; ?></div></td>
      <td><div align="left"><?php echo $row_rsj['NAMADOKTER']; ?></div></td>
      <td><div align="center">
        <?php if ($row_rsj['t1']<>''){echo $row_rsj['t1'];}else{echo "<input type=checkbox name=t1[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t2']<>''){echo $row_rsj['t2'];}else{echo "<input type=checkbox name=t2[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t3']<>''){echo $row_rsj['t3'];}else{echo "<input type=checkbox name=t3[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t4']<>''){echo $row_rsj['t4'];}else{echo "<input type=checkbox name=t4[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t5']<>''){echo $row_rsj['t5'];}else{echo "<input type=checkbox name=t5[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t6']<>''){echo $row_rsj['t6'];}else{echo "<input type=checkbox name=t6[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t7']<>''){echo $row_rsj['t7'];}else{echo "<input type=checkbox name=t7[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t8']<>''){echo $row_rsj['t8'];}else{echo "<input type=checkbox name=t8[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t9']<>''){echo $row_rsj['t9'];}else{echo "<input type=checkbox name=t9[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t10']<>''){echo $row_rsj['t10'];}else{echo "<input type=checkbox name=t10[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t11']<>''){echo $row_rsj['t11'];}else{echo "<input type=checkbox name=t11[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t12']<>''){echo $row_rsj['t12'];}else{echo "<input type=checkbox name=t12[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t13']<>''){echo $row_rsj['t13'];}else{echo "<input type=checkbox name=t13[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t14']<>''){echo $row_rsj['t14'];}else{echo "<input type=checkbox name=t14[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t15']<>''){echo $row_rsj['t15'];}else{echo "<input type=checkbox name=t15[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t16']<>''){echo $row_rsj['t16'];}else{echo "<input type=checkbox name=t16[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t17']<>''){echo $row_rsj['t17'];}else{echo "<input type=checkbox name=t17[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t18']<>''){echo $row_rsj['t18'];}else{echo "<input type=checkbox name=t18[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t19']<>''){echo $row_rsj['t19'];}else{echo "<input type=checkbox name=t19[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t20']<>''){echo $row_rsj['t20'];}else{echo "<input type=checkbox name=t20[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t21']<>''){echo $row_rsj['t21'];}else{echo "<input type=checkbox name=t21[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t22']<>''){echo $row_rsj['t22'];}else{echo "<input type=checkbox name=t22[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t23']<>''){echo $row_rsj['t23'];}else{echo "<input type=checkbox name=t23[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t24']<>''){echo $row_rsj['t24'];}else{echo "<input type=checkbox name=t24[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t25']<>''){echo $row_rsj['t25'];}else{echo "<input type=checkbox name=t25[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t26']<>''){echo $row_rsj['t26'];}else{echo "<input type=checkbox name=t26[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t27']<>''){echo $row_rsj['t27'];}else{echo "<input type=checkbox name=t27[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t28']<>''){echo $row_rsj['t28'];}else{echo "<input type=checkbox name=t28[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t29']<>''){echo $row_rsj['t29'];}else{echo "<input type=checkbox name=t29[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t30']<>''){echo $row_rsj['t30'];}else{echo "<input type=checkbox name=t30[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
      <td><div align="center">
        <?php if ($row_rsj['t31']<>''){echo $row_rsj['t31'];}else{echo "<input type=checkbox name=t31[] value=".$row_rsj['KDDOKTER']."/>";}?>
      </div></td>
    </tr>
    <?php } while ($row_rsj = mysql_fetch_assoc($rsj)); ?>
</table>
<div align="center">
<label></label>
</div>
</form>
</div>
</div>
<?php
mysql_free_result($rsj);
?>