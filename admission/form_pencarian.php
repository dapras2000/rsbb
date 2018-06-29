<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p>&nbsp;</p>
<form id="formcariadmission" name="formcariadmission" method="post" action="index.php?link=178">
<div align="center">
<div id="frame">
	<div id="frame_title">
	  <h3>Pencarian Data Pasien</h3>
	</div>

  <table width="100%" border="0" cellspacing="0" cellpadding="0">

    <tr>
      <td>      <fieldset>
          <legend style="font-size:12px; color:#333333">Berdasarkan Nama Pasien</legend>
        <input name="namapasien" type="text" class="text" id="namapasien" size="15" />
        <input type="submit" class="text" name="Submit" id="Pencarian Pasien" value="Cari Nama" />
     </fieldset>      </td>
      <td>
      
            <fieldset>
          <legend style="font-size:12px; color:#333333">Berdasarkan Ruang</legend>

      <select class="text" name="ruangpasien" id="ruangpasien">
      <?
	  include("../include/connect.php");
	  $q1="select no,nama,kelas from m_ruang";
	  $h1=mysql_query($q1);
	  
	  while($b1=mysql_fetch_array($h1))
	  {
	  ?>
        <option value="<?=$b1[0];?>"><?=$b1[1];echo " - " ?><?=$b1[2]; ?></option>
        <? }?>
      </select> 
      
        <input type="submit" name="Submit" class="text" id="Pencarian Pasien2" value="Cari Ruang" />
        </fieldset>      </td>
      <td>
      
      <fieldset>
          <legend style="font-size:12px; color:#333333">Tanggal</legend>
         
    Dari
  <input onblur="calage(this.value,'umur');" type="text" class="text" value="<? if($_REQUEST['daricariadmission'] !=""): echo $_REQUEST['daricariadmission']; else: echo date('Y/m/d'); endif;?>" name="daricariadmission" id="daricariadmission" size="10" />
        <a href="javascript:showCal('daricariadmission')"><img src="img/date.png" width="20" height="20" border="0" align="top" id="mulai"/></a>- 
       
        
        <input onblur="calage(this.value,'umur');" type="text" class="text" value="<? if($_REQUEST['sampaicariadmission'] !=""): echo $_REQUEST['sampaicariadmission']; else: echo date('Y/m/d'); endif;?>" name="sampaicariadmission" id="sampaicariadmission" size="10" />
        <a href="javascript:showCal('sampaicariadmission')"><img src="img/date.png" width="20" height="20" border="0" align="top" id="mulai"/></a>
        <input type="submit" name="Submit" class="text" id="Pencarian Pasien3" value="Cari Tanggal" />
      </fieldset>      </td>
    </tr>
    <tr>
      <td colspan="3"><label></label></td>
    </tr>
  </table>
  </div></div>
</form>
<p>&nbsp;</p>
</body>
</html>
