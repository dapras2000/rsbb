<?php session_start();
include 'include/connect.php';
include 'include/function.php';

$idxbill	= $_REQUEST['idxbill'];
$carabayar	= $_REQUEST['carabayar_update'];
$oldval		= $_REQUEST['oldval'];
$nobill		= $_REQUEST['nobill'];
$t_idx		= count($idxbill);
$umum		= '';
for($i=0; $i<$t_idx; $i++):
	mysql_query('update t_billranap set CARABAYAR = '.$carabayar[$i].' where IDXBILL = '.$idxbill[$i]);
	if($carabayar[$i] == 1)
	{
		if($oldval[$i] > 1)
		{
			$umum = TRUE;
		}
	}
endfor;
if($umum == TRUE)
{
	mysql_query ('update t_bayarranap set TGLBAYAR = NULL, JAMBAYAR = NULL, JMBAYAR = 0, LUNAS = 0, STATUS = "TRX"  where nobill = '.$nobill); 
}