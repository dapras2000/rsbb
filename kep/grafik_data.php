<? 

include("../kep/include/FusionCharts.php");
	include("../kep/include/DBConn.php");
error_reporting("E_ALL");
?>
<html>
	<SCRIPT LANGUAGE="Javascript" SRC="JS/FusionCharts.js"></SCRIPT>
</head>

<body bgcolor="#FFFFFF">
<div><? echo"<a href='../index.php?link=pengkajian_kep&NOMR=$_GET[nomr]&nama=$_GET[nama]' target='_self' title='Back'>Back</a>"; ?></div>
<table>
<tr> 
    <td align="center" valign="top" colspan="2" style="padding-left:150px;">
	<CENTER>
		<?php
		//In this example, we show how to connect FusionCharts to a database.
		//For the sake of ease, we've used an MySQL databases containing two
		//tables.
	
		// Connect to the DB
		$link = connectToDB();
	
		//We also keep a flag to specify whether we've to animate the chart or not.
		//If the user is viewing the detailed chart and comes back to this page, he shouldn't
		//see the animation again.
		
	
		//$strXML will be used to store the entire XML document generated
		//Generate the chart element

     

		  $strXML = "<graph caption='Grafik Pemeriksaan Data Vital Pasien $_GET[nama]' formatNumberScale='0' showBorder='1' showNames='1' decimalPrecision='0' xAxisName='in Hours' yAxisName='mmhg' >";
	
	$strXML .= "<categories >";
        $strXML .= "<category name='07.00' />";
		 $strXML .= "<category name='08.00' />";
		  $strXML .= "<category name='09.00' />";
		   $strXML .= "<category name='10.00' />";
		    $strXML .= "<category name='11.00' />";
			 $strXML .= "<category name='12.00' />";
        	$strXML .= "<category name='13.00' />";
			 $strXML .= "<category name='14.00' />";
			 $strXML .= "<category name='15.00' />";
			 $strXML .= "<category name='16.00' />";
			 $strXML .= "<category name='17.00' />";
			 $strXML .= "<category name='18.00' />";
			 $strXML .= "<category name='19.00' />";
			 $strXML .= "<category name='20.00' />";
			 $strXML .= "<category name='21.00' />";
			$strXML .= "<category name='22.00' />";
			$strXML .= "<category name='23.00' />";
			$strXML .= "<category name='24.00' />"; 
		//$strXML .= "<category name='Asia' />";
            $strXML .= "</categories>";

        
				//Now create a second query to get details for this factory
	
				$strQuery = "SELECT * from data_vital where nomr='$_GET[nomr]' and data='Sistole'";
				$result2 = mysql_query($strQuery) or die(mysql_error()); 
$strQuery2 = "SELECT * from data_vital where nomr='$_GET[nomr]' and data='Diastole'";
				$result3 = mysql_query($strQuery2) or die(mysql_error()); 
				$strQuery3 = "SELECT * from data_vital where nomr='$_GET[nomr]' and data='Nadi'";
				$result4 = mysql_query($strQuery3) or die(mysql_error()); 
$strQuery4 = "SELECT * from data_vital where nomr='$_GET[nomr]' and data='Temperatur'";
				$result5 = mysql_query($strQuery4) or die(mysql_error()); 
				
				
				if ($result2) {
        while($ors2 = mysql_fetch_array($result2)) {
				//$strXML = "<dataset seriesname='Revenue'>";
				//Note that we're setting link as Detailed.php?FactoryId=<<FactoryId>>
					$strXML .= "<dataset seriesname='Sistole' color='000000' alpha='100'>";
				$strXML .= "<set name='07.00' value='" . $ors2['j1'] . "'/>";
				$strXML .= "<set name='08.00' value='" . $ors2['j2'] . "'/>";
				$strXML .= "<set name='09.00' value='" . $ors2['j3'] . "'/>";
				$strXML .= "<set name='10.00' value='" . $ors2['j4'] . "'/>";
				$strXML .= "<set name='11.00' value='" . $ors2['j5'] . "'/>";
				$strXML .= "<set name='12.00' value='" . $ors2['j6'] . "'/>";
				$strXML .= "<set name='13.00' value='" . $ors2['j7'] . "'/>";
				$strXML .= "<set name='14.00' value='" . $ors2['j8'] . "'/>";
				$strXML .= "<set name='15.00' value='" . $ors2['j9'] . "'/>";
				$strXML .= "<set name='16.00' value='" . $ors2['j10'] . "'/>";
				$strXML .= "<set name='17.00' value='" . $ors2['j11'] . "'/>";
				$strXML .= "<set name='18.00' value='" . $ors2['j12'] . "'/>";
				$strXML .= "<set name='19.00' value='" . $ors2['j13'] . "'/>";
				$strXML .= "<set name='20.00' value='" . $ors2['j14'] . "'/>";
				$strXML .= "<set name='21.00' value='" . $ors2['j15'] . "'/>";
				$strXML .= "<set name='22.00' value='" . $ors2['j16'] . "'/>";
				$strXML .= "<set name='23.00' value='" . $ors2['j17'] . "'/>";
				$strXML .= "<set name='24.00' value='" . $ors2['j18'] . "'/>";
				$strXML .= "<set name='01.00' value='" . $ors2['j19'] . "'/>";
				$strXML .= "<set name='02.00' value='" . $ors2['j20'] . "'/>";
				$strXML .= "<set name='03.00' value='" . $ors2['j21'] . "'/>";
				$strXML .= "<set name='04.00' value='" . $ors2['j22'] . "'/>";
				$strXML .= "<set name='05.00' value='" . $ors2['j23'] . "'/>";
				$strXML .= "<set name='06.00' value='" . $ors2['j24'] . "'/>";

				$strXML .= "</dataset>";		
									//free the resultset
				mysql_free_result($result2);
			}}
			if ($result3) {
        while($ors3 = mysql_fetch_array($result3)) {
				//$strXML = "<dataset seriesname='Revenue'>";
				//Note that we're setting link as Detailed.php?FactoryId=<<FactoryId>>
					$strXML .= "<dataset seriesname='Diastole' color='000000' alpha='100'>";
				$strXML .= "<set name='07.00' value='" . $ors3['j1'] . "'/>";
				$strXML .= "<set name='08.00' value='" . $ors3['j2'] . "'/>";
				$strXML .= "<set name='09.00' value='" . $ors3['j3'] . "'/>";
				$strXML .= "<set name='10.00' value='" . $ors3['j4'] . "'/>";
				$strXML .= "<set name='11.00' value='" . $ors3['j5'] . "'/>";
				$strXML .= "<set name='12.00' value='" . $ors3['j6'] . "'/>";
				$strXML .= "<set name='13.00' value='" . $ors3['j7'] . "'/>";
				$strXML .= "<set name='14.00' value='" . $ors3['j8'] . "'/>";
				$strXML .= "<set name='15.00' value='" . $ors3['j9'] . "'/>";
				$strXML .= "<set name='16.00' value='" . $ors3['j10'] . "'/>";
				$strXML .= "<set name='17.00' value='" . $ors3['j11'] . "'/>";
				$strXML .= "<set name='18.00' value='" . $ors3['j12'] . "'/>";
				$strXML .= "<set name='19.00' value='" . $ors3['j13'] . "'/>";
				$strXML .= "<set name='20.00' value='" . $ors3['j14'] . "'/>";
				$strXML .= "<set name='21.00' value='" . $ors3['j15'] . "'/>";
				$strXML .= "<set name='22.00' value='" . $ors3['j16'] . "'/>";
				$strXML .= "<set name='23.00' value='" . $ors3['j17'] . "'/>";
				$strXML .= "<set name='24.00' value='" . $ors3['j18'] . "'/>";
				$strXML .= "<set name='01.00' value='" . $ors3['j19'] . "'/>";
				$strXML .= "<set name='02.00' value='" . $ors3['j20'] . "'/>";
				$strXML .= "<set name='03.00' value='" . $ors3['j21'] . "'/>";
				$strXML .= "<set name='04.00' value='" . $ors3['j22'] . "'/>";
				$strXML .= "<set name='05.00' value='" . $ors3['j23'] . "'/>";
				$strXML .= "<set name='06.00' value='" . $ors3['j24'] . "'/>";	

				$strXML .= "</dataset>";		
									//free the resultset
				mysql_free_result($result3);


			}}
				if ($result4) {
        while($ors4 = mysql_fetch_array($result4)) {
				//$strXML1 = "<dataset seriesname='Revenue'>";
				//Note that we're setting link as Detailed.php?FactoryId=<<FactoryId>>
					$strXML .= "<dataset seriesname='Nadi' color='f6556c' alpha='100'>";
				$strXML .= "<set name='07.00' value='" . $ors4['j1'] . "'/>";
				$strXML .= "<set name='08.00' value='" . $ors4['j2'] . "'/>";
				$strXML .= "<set name='09.00' value='" . $ors4['j3'] . "'/>";
				$strXML .= "<set name='10.00' value='" . $ors4['j4'] . "'/>";
				$strXML .= "<set name='11.00' value='" . $ors4['j5'] . "'/>";
				$strXML .= "<set name='12.00' value='" . $ors4['j6'] . "'/>";
				$strXML .= "<set name='13.00' value='" . $ors4['j7'] . "'/>";
				$strXML .= "<set name='14.00' value='" . $ors4['j8'] . "'/>";
				$strXML .= "<set name='15.00' value='" . $ors4['j9'] . "'/>";
				$strXML .= "<set name='16.00' value='" . $ors4['j10'] . "'/>";
				$strXML .= "<set name='17.00' value='" . $ors4['j11'] . "'/>";
				$strXML .= "<set name='18.00' value='" . $ors4['j12'] . "'/>";
				$strXML .= "<set name='19.00' value='" . $ors4['j13'] . "'/>";
				$strXML .= "<set name='20.00' value='" . $ors4['j14'] . "'/>";
				$strXML .= "<set name='21.00' value='" . $ors4['j15'] . "'/>";
				$strXML .= "<set name='22.00' value='" . $ors4['j16'] . "'/>";
				$strXML .= "<set name='23.00' value='" . $ors4['j17'] . "'/>";
				$strXML .= "<set name='24.00' value='" . $ors4['j18'] . "'/>";
				$strXML .= "<set name='01.00' value='" . $ors4['j19'] . "'/>";
				$strXML .= "<set name='02.00' value='" . $ors4['j20'] . "'/>";
				$strXML .= "<set name='03.00' value='" . $ors4['j21'] . "'/>";
				$strXML .= "<set name='04.00' value='" . $ors4['j22'] . "'/>";
				$strXML .= "<set name='05.00' value='" . $ors4['j23'] . "'/>";
				$strXML .= "<set name='06.00' value='" . $ors4['j24'] . "'/>";	
				$strXML .= "</dataset>";		
									//free the resultset
				mysql_free_result($result4);
			}}
			if ($result5) {
        while($ors5 = mysql_fetch_array($result5)) {
				//$strXML1 = "<dataset seriesname='Revenue'>";
				//Note that we're setting link as Detailed.php?FactoryId=<<FactoryId>>
					$strXML .= "<dataset seriesname='Temperatur' color='0d24fe' alpha='100'>";
				$strXML .= "<set name='07.00' value='" . $ors5['j1'] . "'/>";
				$strXML .= "<set name='08.00' value='" . $ors5['j2'] . "'/>";
				$strXML .= "<set name='09.00' value='" . $ors5['j3'] . "'/>";
				$strXML .= "<set name='10.00' value='" . $ors5['j4'] . "'/>";
				$strXML .= "<set name='11.00' value='" . $ors5['j5'] . "'/>";
				$strXML .= "<set name='12.00' value='" . $ors5['j6'] . "'/>";
				$strXML .= "<set name='13.00' value='" . $ors5['j7'] . "'/>";
				$strXML .= "<set name='14.00' value='" . $ors5['j8'] . "'/>";
				$strXML .= "<set name='15.00' value='" . $ors5['j9'] . "'/>";
				$strXML .= "<set name='16.00' value='" . $ors5['j10'] . "'/>";
				$strXML .= "<set name='17.00' value='" . $ors5['j11'] . "'/>";
				$strXML .= "<set name='18.00' value='" . $ors5['j12'] . "'/>";
				$strXML .= "<set name='19.00' value='" . $ors5['j13'] . "'/>";
				$strXML .= "<set name='20.00' value='" . $ors5['j14'] . "'/>";
				$strXML .= "<set name='21.00' value='" . $ors5['j15'] . "'/>";
				$strXML .= "<set name='22.00' value='" . $ors5['j16'] . "'/>";
				$strXML .= "<set name='23.00' value='" . $ors5['j17'] . "'/>";
				$strXML .= "<set name='24.00' value='" . $ors5['j18'] . "'/>";
				$strXML .= "<set name='01.00' value='" . $ors5['j19'] . "'/>";
				$strXML .= "<set name='02.00' value='" . $ors5['j20'] . "'/>";
				$strXML .= "<set name='03.00' value='" . $ors5['j21'] . "'/>";
				$strXML .= "<set name='04.00' value='" . $ors5['j22'] . "'/>";
				$strXML .= "<set name='05.00' value='" . $ors5['j23'] . "'/>";
				$strXML .= "<set name='06.00' value='" . $ors5['j24'] . "'/>";	
				$strXML .= "</dataset>";		
									//free the resultset
				mysql_free_result($result5);
			}}


		mysql_close($link);
	
	   
		//Finally, close <chart> element
	   $strXML .= "</graph>";
	
		//Create the chart - Pie 3D Chart with data from strXML
		echo renderChart("Charts/FCF_MSLine.swf", "", $strXML, "",900, 600);
	?>
	
	</CENTER>
	</td></tr>
</table>

	
</body>


</html>
