
<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>KATEGORI PENCARIAN</h3>
    </div>
<form name="tglkalender" action="index.php?link=72" method="post">
      <table width="99%" border="0" cellspacing="0" cellpadding="1" style="background:none;color:#333333;">
        <tr>
          <td>
          <fieldset>
          <legend style="font-size:12px; color:#333333">Cara Pembayaran</legend>
           <select class="text" name="carab" id="carab">
      <? include("../include/connect.php");
	  $q="select * from m_carabayar";
	  $h=mysql_query($q);
	  
	  while($b=mysql_fetch_array($h))
	  {
	  ?>
        <option value="<?=$b[0];?>"><?=$b[1];?></option>
        <? }?>
      </select>
          
                <input class="text" type="submit" name="Submit" id="Submit" value="Cari[1]"/></p>

          
          </fieldset></td>
          <td>
          <fieldset>
          <legend style="font-size:12px; color:#333333">Jenis Pemeriksaan</legend>
          
           <select class="text" name="jp" id="jp">
      <? include("../include/connect.php");
	  $q1="select * from m_radiologi where gr_rad <> '-'";
	  $h1=mysql_query($q1);
	  
	  while($b1=mysql_fetch_array($h1))
	  {
	  ?>
        <option value="<?=$b1[0];?>"><?=$b1[2];?></option>
        <? }?>
      </select>
          
                <input class="text" type="submit" name="Submit" id="Submit" value="Cari[2]"/></p>

          </fieldset>
          </td>
          <td>
          <fieldset>
          <legend style="font-size:12px; color:#333333">Pemakaian Photo/Film</legend>
         
          <select name="jenisfilm" id="jenisfilm">
        <option value="35x35">35x35</option>
        <option value="30x40">30x40</option>
        <option value="24x30">24x30</option>
        <option value="18x24">18x24</option>
        <option value="GIGI">GIGI</option>
      </select> 
               <input class="text" type="submit" name="Submit" id="Submit" value="Cari[3]"/></p>

         
          </fieldset>
          </td>
          <td>
          <fieldset>
          <legend style="font-size:12px; color:#333333">Tanggal</legend>
         
    Dari
  <input onblur="calage(this.value,'umur');" type="text" class="text" value="" name="theDate" id="theDate" size="10" />
        <a href="javascript:showCal('Calendar4')"><img src="img/date.png" width="20" height="20" border="0" align="top" id="mulai"/></a>- 
       
        
        <input onblur="calage(this.value,'umur');" type="text" class="text" value="" name="tglsampai" id="tglsampai" size="10" />
        <a href="javascript:showCal('Calendar10')"><img src="img/date.png" width="20" height="20" border="0" align="top" id="mulai"/></a>
        
        
        <input class="text" type="submit" name="Submit" id="Submit" value="Cari[4]"/>
          </fieldset>
          </td>
        </tr>
      </table>
      <p>&nbsp;</p>
      
      <label>
      
      </label>
</form>
<br />
    </div>
</div>
