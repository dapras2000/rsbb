<?php
session_start();

// Include MySQL class
require_once('inc/mysql.class.php');
// Include database connection
require_once('inc/global.inc.php');
// Include functions
require_once('inc/functions.inc.php');
require_once('inc/function.php');
// Start the session
// Process actions
$cart = $_SESSION['cart'];
$action = $_GET['action'];
switch ($action) {
	
	case 'add':
		if ($cart) {
			$cart .= ','.$_GET['id'];
			$qty_cart= 1;
		} else {
			$cart = $_GET['id'];
		}
		break;
	case 'delete':
		if ($cart) {
			$items = explode(',',$cart);
			$newcart = '';
			foreach ($items as $item) {
				if ($_GET['id'] != $item) {
					if ($newcart != '') {
						$newcart .= ','.$item;
					} else {
						$newcart = $item;
						mysql_query("DELETE FROM temp_cart where id_kode = '".$_GET['id']."'");
					}
				}
			}
			$cart = $newcart;
		}
		break;
		
	case 'update':
	if ($cart) {
		$newcart = '';
		foreach ($_POST as $key=>$value) {
			if (stristr($key,'qty')) {
				$id = str_replace('qty','',$key);
				$items = ($newcart != '') ? explode(',',$newcart) : explode(',',$cart);
				$newcart = '';
				foreach ($items as $item) {
					if ($id != $item) {
						if ($newcart != '') {
							$newcart .= ','.$item;							
						} else {
							$newcart = $item;
						}
					}
				}
			$kode1 = "kode".$id;
			@mysql_query("UPDATE temp_cart set qty = '$_POST[$qty1]' WHERE id_kode = '$_POST[$kode1]'");
			
				for ($i=1;$i<=$value;$i++) {
					if ($newcart != '') {
						$newcart .= ','.$id;
						
						$qty1 = "qty".$id;
						$kode1 = "kode".$id;
						$tarif1 = "tarif".$id;
						$nama1 = "nama".$id;
						//echo $id ." and ". $_POST[$kode1]."<br>";
						//$id2 = substr($_POST[$kode1], 0, 8);
						//echo "Qty : ".$_POST[$qty1]."<br />";
						//echo "Kode : ".$_POST[$kode1]."<br />";
						//echo "Tarif : ".$_POST[$tarif1]."<br />";
						//echo "nama : ".$_POST[$nama1]."<br />";
						
						//kondisi insert atau update ke tabel temporary
						//@mysql_query("UPDATE temp_cart set qty ='$_POST[$qty1]' WHERE id_kode='$_POST[$kode1]'");
						if($_POST[$kode1] == $id){
							//mengambil maxnobyr
							$qry=mysql_query("SELECT * FROM m_maxnobyr");
							$get_data = mysql_fetch_assoc($qry);
							$maxnobyr = $get_data['nomor'];
							//menyimpan ke temp_cart
							@mysql_query("INSERT INTO temp_cart VALUES ('$_POST[$kode1]','$_POST[$nama1]','$_POST[$qty1]','$_POST[$tarif1]','$maxnobyr','')");
							//menyimpan ke t_bayar
							//@mysql_query("INSERT INTO t_bayar VALUES ('','$_POST[$kode1]','','current_date()','$_POST[$tarif1]','','','$_POST[$qty1]','','$maxnobyr')");
						}
					} else {
						$newcart = $id;
					}
				}
			}
		}

	}
	$cart = $newcart;
	break;

	case 'insert_all':
			//mengambil index pendaftaran
			$query=mysql_query("SELECT * FROM t_pendaftaran WHERE NOMR = '".$_POST['NOMR']."'");
			$getdat = mysql_fetch_assoc($query);
			 $IDXDAFTAR = $getdat['IDXDAFTAR'];
			 $NIP = $getdat['NIP'];
			 $_POST['NOMR'];
			 $_POST['SHIFT'];
			 $_POST['nobyr'];
			 
			 if($_POST['NOMR']=="" || $_POST['SHIFT']==""){
				 echo " <div style='padding:5px; border:1px solid #FFCACA; background-color:#FFECEC'>";
				 echo "<strong>Maaf Form Pembayaran Belum Terisi Lengkap :</strong>";
				 if($_POST['NOMR']==""){
					 echo "<p><strong>No MR Belum Terisi.</strong></p>";
					 }
				 if($_POST['SHIFT']==""){
					 echo "<p><strong>SHIFT Belum Terisi.</strong></p>";
					 }
				  echo"<br /></div><br /><br />";
				 
			 }else{
			
			//input ke t_bayar dari temp_cart
			mysql_query("INSERT INTO t_bayar (kodetarif,jmbayar,qty,no_bayar) SELECT id_kode,tarif,qty,no_byr FROM temp_cart WHERE no_byr = '$_POST[nobyr]'");
			
			//upadate t_bayar
			mysql_query("UPDATE t_bayar SET NOMR='$_POST[NOMR]', TGLBAYAR = current_date(), SHIFT='$_POST[SHIFT]',NIP ='$NIP', IDXDAFTAR='$IDXDAFTAR' WHERE NO_BAYAR='$_POST[nobyr]'")or die(mysql_error());
			
 		    echo " <div style='padding:5px; border:1px solid #FFCACA; background-color:#CBFECD'>";
			echo "<p><strong>Pembayaran Sukses!</strong></p>";
			echo "<br /></div><br /><br />";
			//menghapus temp_cart
			mysql_query("DELETE FROM temp_cart WHERE no_byr = '$_POST[nobyr]'")or die(mysql_error());
			mysql_query("UPDATE m_maxnobyr SET nomor=nomor+1")or die(mysql_error());
			unset($_SESSION['cart']); 
			}
	break;

}
$_SESSION['cart'] = $cart;
?>

<div id="contents">

<h1>List Pembayaran (Per Quantity)</h1>

<?php
echo showCart();
?>
</div>
