<? session_start();
include("../include/connect.php");

$larikdokter=$_POST['dokter'];
$xnomr = "";


		if ($larikdokter=='')
				{
				header("Location:../index.php?link=r06&idxorder=".$_POST['idxorder']."&psn=Data Dokter Belum Ada!");
				}
		else
		{
				for($i=0;$i<=count($larikdokter);$i++)
				{
					if($larikdokter[$i] != '')
					{
					$insertdokter="INSERT INTO t_radiologi_petugas VALUES('','".$_POST['idxorder']."','".$larikdokter[$i]."','DOKTER')";
					mysql_query($insertdokter);	
					}
				}
				
				for($i2=0;$i2<=count($larikpetugas);$i2++)
					{
					if($larikpetugas[$i2] != '')
						{
							//echo $larikpetugas[$i2];
			$insertpetugas="INSERT INTO t_radiologi_petugas VALUES('','".$_POST['idxorder']."','".$larikpetugas[$i2]."','PETUGAS')";
			mysql_query($insertpetugas);	
					
						}
					}
				

		
		}
	
$idx_order = $_POST['idxorder']; 
$resume = $_POST['resume']; 
	   
	   $edit1="update t_radiologi_aps set HASILRESUME='".$resume."' where idxorderrad='".$idx_order."'";
		mysql_query($edit1);

?>

<script language="javascript">
  alert("Update Sukess");
  window.location="../index.php?link=r05";
  </script>