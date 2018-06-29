<?php 
$hostname = "localhost";
$database = "test";
$username = "root";
$password = "";
$connect = mysql_connect($hostname, $username, $password) or die(mysql_error()); 
mysql_select_db($database,$connect)or die(mysql_error());

$uploaddir = 'file/';
$uploadfile = $uploaddir . basename($_FILES['upload_file']['name']);
$UPLOAD_TYPES['xls'] = 1; 
$UPLOAD_SIZES['max'] = 100000; 
$UPLOAD_SIZES['min'] = 0; 
echo "File:  ". $_FILES['upload_file']['name'] .
'<br>' .
'Size: ' .$_FILES['upload_file']['size'] .
'<br>';
if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $uploadfile)) 
{
require_once 'reader.php';
$reader1 = new Spreadsheet_Excel_Reader();
$reader1->setOutputEncoding("UTF-8");
$reader1->read($uploadfile);

$DPSNOKA  =$_POST['DPSNOKA'];
$NOKK     =$_POST['NOKK'];
$NOPEN    =$_POST['NOPEN']; 
$KDDESA	  =$_POST['KDDESA'];
$KDKC	  =$_POST['KDKC'];
$DPSKDKEC =$_POST['DPSKDKEC'];
$DPSNMCTK =$_POST['DPSNMCTK'];
$DPSTGLLHR=$_POST['DPSTGLLHR'];
$DPSJK	  =$_POST['DPSJK'];
$DPSSTSKWN=$_POST['DPSSTSKWN'];
$DPSJLN	  =$_POST['DPSJLN'];
$DPSRTRW  =$_POST['DPSRTRW'];
$DPSTGLREG=$_POST['DPSTGLREG'];
//echo "<table>";
for ($i1 = $baris-1; $i1 <= $reader1->sheets[0]["numRows"]; $i1++)
{
		$d = explode("/", $reader1->sheets[0]['cells'][$i1+1][$DPSTGLLHR]);
		$formatteddate = $d[2]."/".$d[1]."/".$d[0];
		//echo "<br> tgl lahir=".$formatteddate;
		$TGLLHR=$formatteddate;

		$d = explode("/", $reader1->sheets[0]['cells'][$i1+1][$DPSTGLREG]);
		$formatteddate = $d[2]."/".$d[1]."/".$d[0];
		$TGLREG=$formatteddate;
		//echo "<br> tgl reg=".$formatteddate;
	$query1="insert into m_jamkesda(DPSNOKA,NOKK,NOPEN ,KDDESA	,KDKC	,DPSKDKEC	,DPSNM	,DPSNMCTK	,DPSTGLLHR	,DPSJK	,DPSSTSKWN	,DPSJLN	,DPSRTRW,DPSTGLREG	) values(
'".$reader1->sheets[0]['cells'][$i1+1][$DPSNOKA]."',
'".$reader1->sheets[0]['cells'][$i1+1][$NOKK]."',
'".$reader1->sheets[0]['cells'][$i1+1][$NOPEN]."',
'".$reader1->sheets[0]['cells'][$i1+1][$KDDESA]."',
'".$reader1->sheets[0]['cells'][$i1+1][$KDKC]."',
'".$reader1->sheets[0]['cells'][$i1+1][$DPSKDKEC]."',
'".$reader1->sheets[0]['cells'][$i1+1][$DPSNM]."',
'".$reader1->sheets[0]['cells'][$i1+1][$DPSNMCTK]."',
'".$TGLLHR."',
'".$reader1->sheets[0]['cells'][$i1+1][$DPSJK]."',
'".$reader1->sheets[0]['cells'][$i1+1][$DPSSTSKWN]."',
'".$reader1->sheets[0]['cells'][$i1+1][$DPSJLN]."',
'".$reader1->sheets[0]['cells'][$i1+1][$DPSRTRW]."',
'".$TGLREG."'
)";
/*echo "<tr>
<td>'".$reader1->sheets[0]['cells'][$i1+1][$DPSNOKA]."'</td>
<td>'".$reader1->sheets[0]['cells'][$i1+1][$NOKK]."'</td>
<td>'".$reader1->sheets[0]['cells'][$i1+1][$NOPEN]."'</td>
<td>'".$reader1->sheets[0]['cells'][$i1+1][$KDDESA]."'</td>
<td>'".$reader1->sheets[0]['cells'][$i1+1][$KDKC]."'</td>
<td>'".$reader1->sheets[0]['cells'][$i1+1][$DPSKDKEC]."'</td>
<td>'".$reader1->sheets[0]['cells'][$i1+1][$DPSNM]."'</td>
<td>'".$reader1->sheets[0]['cells'][$i1+1][$DPSNMCTK]."'</td>
<td>'".$TGLLHR."'</td>
<td>'".$reader1->sheets[0]['cells'][$i1+1][$DPSJK]."'</td>
<td>'".$reader1->sheets[0]['cells'][$i1+1][$DPSSTSKWN]."'</td>
<td>'".$reader1->sheets[0]['cells'][$i1+1][$DPSJLN]."'</td>
<td>'".$reader1->sheets[0]['cells'][$i1+1][$DPSRTRW]."'</td>
<td>'".$TGLREG."'</td>
</tr>";*/

$hasil=mysql_query($query1);

}
//echo "</tabe>";
echo "proses ".$reader1->sheets[0]["numRows"]." baris. Selesai!";
}
?>